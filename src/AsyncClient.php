<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Foundation\Factory;
use ApiClients\Foundation\Hydrator\CommandBus\Command\HydrateCommand;
use ApiClients\Foundation\Client;
use ApiClients\Foundation\Transport\CommandBus\Command\RequestCommand;
use ApiClients\Foundation\Transport\CommandBus\Command\StreamingRequestCommand;
use GuzzleHttp\Psr7\Request;
use JacobKiers\OAuth\Consumer\Consumer;
use JacobKiers\OAuth\Token\Token;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;
use function React\Promise\resolve;
use Rx\Extra\Operator\CutOperator;
use Rx\Observable;
use Rx\React\Promise;

class AsyncClient
{
    const STREAM_DELIMITER = "\r\n";

    /**
     * @var Client
     */
    protected $client;

    public function __construct(
        string $consumerKey,
        string $consumerSecret,
        string $accessToken,
        string $accessTokenSecret,
        LoopInterface $loop,
        Client $client = null
    ) {
        if (!($client instanceof Client)) {
            $this->options = ApiSettings::getOptions(
                $consumerKey,
                $consumerSecret,
                $accessToken,
                $accessTokenSecret,
                'Async'
            );
            $client = Factory::create($loop, $this->options);
        }
        $this->client = $client;
    }

    public function user(string $user): PromiseInterface
    {
        return $this->client->handle(new RequestCommand(
            new Request('GET', 'users/show.json?screen_name=' . $user)
        ))->then(function (ResponseInterface $response) {
            return resolve($this->client->handle(new HydrateCommand('User', $response->getBody()->getJson())));
        });
    }

    public function sampleStream(): Observable
    {
        return $this->stream(
            new Request('GET', 'https://stream.twitter.com/1.1/statuses/sample.json')
        );
    }

    public function filteredStream(array $filter = []): Observable
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

    protected function stream(RequestInterface $request): Observable
    {
        return Promise::toObservable($this->client->handle(new StreamingRequestCommand(
            $request
        )))->switchLatest()->lift(function () {
            return new CutOperator(self::STREAM_DELIMITER);
        })->filter(function (string $json) {
            return trim($json) !== ''; // To keep the stream alive Twitter sends an empty line at times
        })->jsonDecode()->flatMap(function (array $document) {
            if (isset($document['delete'])) {
                return Promise::toObservable($this->client->handle(
                    new HydrateCommand('DeletedTweet', $document['delete'])
                ));
            }

            return Promise::toObservable($this->client->handle(new HydrateCommand('Tweet', $document)));
        });
    }
}
