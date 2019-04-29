<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Foundation\Client;
use ApiClients\Foundation\Hydrator\CommandBus\Command\HydrateCommand;
use ApiClients\Foundation\Transport\CommandBus\Command\RequestCommand;
use ApiClients\Foundation\Transport\CommandBus\Command\StreamingRequestCommand;
use ApiClients\Foundation\Transport\ParsedContentsInterface;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\LoopInterface;
use Rx\Observable;
use Rx\Operator\CutOperator;
use Rx\React\Promise;
use Rx\Scheduler\ImmediateScheduler;
use function ApiClients\Tools\Rx\observableFromArray;
use function RingCentral\Psr7\build_query;

final class AsyncStreamingClient implements AsyncStreamingClientInterface
{
    const STREAM_DELIMITER = "\r\n";

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var LoopInterface
     */
    private $loop;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sample(): Observable
    {
        return $this->stream(
            new Request('GET', 'https://stream.twitter.com/1.1/statuses/sample.json')
        );
    }

    public function filtered(array $filter = []): Observable
    {
        $postData = http_build_query($filter);

        return $this->stream(
            new Request(
                'POST',
                'https://stream.twitter.com/1.1/statuses/filter.json',
                [
                    'Content-Type' =>  'application/x-www-form-urlencoded',
                    'Content-Length' => strlen($postData),
                ],
                $postData
            )
        );
    }

    public function searchTweets(array $filter = []): Observable
    {
        $query = build_query($filter);

        return Promise::toObservable($this->client->handle(new RequestCommand(
            new Request(
                'GET',
                'https://api.twitter.com/1.1/search/tweets.json?' . $query,
                []
            )
        ))->then(function (ResponseInterface $response) {
            /** @var ParsedContentsInterface $body */
            $body = $response->getBody();

            return $body->getParsedContents()['statuses'];
        }))->flatMap(function (array $statuses) {
            return observableFromArray($statuses);
        })->flatMap(function (array $document) {
            return Promise::toObservable($this->client->handle(new HydrateCommand('Tweet', $document)));
        });
    }

    protected function stream(RequestInterface $request): Observable
    {
        return Promise::toObservable($this->client->handle(new StreamingRequestCommand(
            $request
        )))->switchLatest()->lift(function () {
            return new CutOperator(self::STREAM_DELIMITER, new ImmediateScheduler());
        })->filter(function (string $json) {
            return trim($json) !== ''; // To keep the stream alive Twitter sends an empty line at times
        })->_ApiClients_jsonDecode()->flatMap(function (array $document) {
            if (isset($document['delete'])) {
                return Promise::toObservable($this->client->handle(
                    new HydrateCommand('DeletedTweet', $document['delete'])
                ));
            }

            return Promise::toObservable($this->client->handle(new HydrateCommand('Tweet', $document)));
        });
    }
}
