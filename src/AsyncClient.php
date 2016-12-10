<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Foundation\Client;
use ApiClients\Foundation\Factory;
use ApiClients\Foundation\Hydrator\CommandBus\Command\HydrateCommand;
use ApiClients\Foundation\Oauth1\Middleware\Oauth1Middleware;
use ApiClients\Foundation\Oauth1\Options as Oauth1Options;
use ApiClients\Foundation\Options;
use ApiClients\Foundation\Transport\CommandBus\Command\RequestCommand;
use ApiClients\Foundation\Transport\Options as TransportOptions;
use ApiClients\Tools\CommandBus\CommandBusInterface;
use ApiClients\Tools\Psr7\Oauth1\Definition;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;
use Rx\Observable;
use function React\Promise\resolve;

final class AsyncClient implements AsyncClientInterface
{
    /**
     * @var string
     */
    private $consumerKey;

    /**
     * @var string
     */
    private $consumerSecret;

    /**
     * @var LoopInterface
     */
    private $loop;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var AsyncStreamingClient
     */
    protected $streamingClient;

    public function __construct(
        string $consumerKey,
        string $consumerSecret,
        LoopInterface $loop,
        array $options = [],
        Client $client = null
    ) {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->loop = $loop;

        if (!($client instanceof Client)) {
            $this->options = ApiSettings::getOptions(
                $consumerKey,
                $consumerSecret,
                'Async',
                $options
            );

            $client = Factory::create($this->loop, $this->options);
        }

        $this->client = $client;
    }

    public function withAccessToken(string $accessToken, string $accessTokenSecret): AsyncClient
    {
        $options = $this->options;
        // @codingStandardsIgnoreStart
        $options[Options::TRANSPORT_OPTIONS][TransportOptions::DEFAULT_REQUEST_OPTIONS][Oauth1Middleware::class][Oauth1Options::ACCESS_TOKEN] = new Definition\AccessToken($accessToken);
        $options[Options::TRANSPORT_OPTIONS][TransportOptions::DEFAULT_REQUEST_OPTIONS][Oauth1Middleware::class][Oauth1Options::TOKEN_SECRET] = new Definition\TokenSecret($accessTokenSecret);
        // @codingStandardsIgnoreEnd

        return new self(
            $this->consumerKey,
            $this->consumerSecret,
            $this->loop,
            $options
        );
    }

    public function withOutAccessToken(): AsyncClient
    {
        $options = $this->options;
        // @codingStandardsIgnoreStart
        if (isset($options[Options::TRANSPORT_OPTIONS][TransportOptions::DEFAULT_REQUEST_OPTIONS][Oauth1Middleware::class][Oauth1Options::ACCESS_TOKEN])) {
            unset($options[Options::TRANSPORT_OPTIONS][TransportOptions::DEFAULT_REQUEST_OPTIONS][Oauth1Middleware::class][Oauth1Options::ACCESS_TOKEN]);
        }
        if (isset($options[Options::TRANSPORT_OPTIONS][TransportOptions::DEFAULT_REQUEST_OPTIONS][Oauth1Middleware::class][Oauth1Options::TOKEN_SECRET])) {
            unset($options[Options::TRANSPORT_OPTIONS][TransportOptions::DEFAULT_REQUEST_OPTIONS][Oauth1Middleware::class][Oauth1Options::TOKEN_SECRET]);
        }
        // @codingStandardsIgnoreEnd

        return new self(
            $this->consumerKey,
            $this->consumerSecret,
            $this->loop,
            $options
        );
    }

    public function getCommandBus(): CommandBusInterface
    {
        return $this->client->getFromContainer(CommandBusInterface::class);
    }

    public function user(string $user): PromiseInterface
    {
        return $this->client->handle(new RequestCommand(
            new Request('GET', 'users/show.json?screen_name=' . $user)
        ))->then(function (ResponseInterface $response) {
            return resolve($this->client->handle(new HydrateCommand('User', $response->getBody()->getJson())));
        });
    }

    public function stream(): AsyncStreamingClient
    {
        if (!($this->streamingClient instanceof AsyncStreamingClient)) {
            $this->streamingClient = new AsyncStreamingClient($this->client);
        }

        return $this->streamingClient;
    }
}
