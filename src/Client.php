<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Client\Twitter\Resource\Async\Profile;
use ApiClients\Client\Twitter\Resource\ProfileInterface;
use ApiClients\Client\Twitter\Resource\TweetInterface;
use ApiClients\Client\Twitter\Resource\UserInterface;
use ApiClients\Foundation\Client as FoundationClient;
use ApiClients\Foundation\Factory;
use ApiClients\Foundation\Hydrator\CommandBus\Command\BuildSyncFromAsyncCommand;
use ApiClients\Foundation\Options;
use ApiClients\Foundation\Transport\Options as TransportOptions;
use ApiClients\Middleware\Oauth1\Oauth1Middleware;
use ApiClients\Middleware\Oauth1\Options as Oauth1Options;
use ApiClients\Tools\Psr7\Oauth1\Definition;
use React\EventLoop\Factory as LoopFactory;
use React\EventLoop\LoopInterface;
use function Clue\React\Block\await;

final class Client implements ClientInterface
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
    protected $loop;

    /**
     * @var AsyncClient
     */
    protected $asyncClient;

    /**
     * @var FoundationClient
     */
    protected $client;

    /**
     * @var StreamingClient
     */
    protected $streamingClient;

    /**
     * @var array
     */
    protected $options;

    public function __construct(
        string $consumerKey,
        string $consumerSecret
    ) {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->loop = LoopFactory::create();

        $this->options = ApiSettings::getOptions(
            $consumerKey,
            $consumerSecret,
            'Sync'
        );

        $this->client = Factory::create($this->loop, $this->options);

        $this->asyncClient = new AsyncClient($consumerKey, $consumerSecret, $this->loop, [], $this->client);
    }

    public function withAccessToken(string $accessToken, string $accessTokenSecret): Client
    {
        $options = $this->options;
        // @codingStandardsIgnoreStart
        $options[Options::TRANSPORT_OPTIONS][TransportOptions::DEFAULT_REQUEST_OPTIONS][Oauth1Middleware::class][Oauth1Options::ACCESS_TOKEN] = new Definition\AccessToken($accessToken);
        $options[Options::TRANSPORT_OPTIONS][TransportOptions::DEFAULT_REQUEST_OPTIONS][Oauth1Middleware::class][Oauth1Options::TOKEN_SECRET] = new Definition\TokenSecret($accessTokenSecret);
        // @codingStandardsIgnoreEnd

        $clone = clone $this;
        $clone->client = Factory::create($this->loop, $options);
        $clone->asyncClient = (new AsyncClient(
            $this->consumerKey,
            $this->consumerSecret,
            $this->loop,
            [],
            $this->client
        ))->withAccessToken($accessToken, $accessTokenSecret);
        return $clone;
    }

    public function withOutAccessToken(): Client
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

        $clone = clone $this;
        $clone->client = Factory::create($this->loop, $options);
        $clone->asyncClient = (new AsyncClient(
            $this->consumerKey,
            $this->consumerSecret,
            $this->loop,
            [],
            $this->client
        ));
        return $clone;
    }

    public function stream(): StreamingClient
    {
        if (!($this->streamingClient instanceof StreamingClient)) {
            $this->streamingClient = new StreamingClient(
                $this->loop,
                $this->asyncClient->getCommandBus(),
                $this->asyncClient->stream()
            );
        }

        return $this->streamingClient;
    }

    public function tweet(string $tweet): TweetInterface
    {
        return await(
            $this->asyncClient->tweet($tweet),
            $this->loop
        );
    }

    public function profile(): ProfileInterface
    {
        return await(
            $this->asyncClient->profile()->then(function (Profile $profile) {
                return $this->client->handle(new BuildSyncFromAsyncCommand(ProfileInterface::HYDRATE_CLASS, $profile));
            }),
            $this->loop
        );
    }

    public function user(string $tweet): UserInterface
    {
        return await(
            $this->asyncClient->user($tweet),
            $this->loop
        );
    }
}
