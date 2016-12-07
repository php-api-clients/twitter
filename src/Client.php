<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Client\Twitter\Resource\TweetInterface;
use ApiClients\Client\Twitter\Resource\UserInterface;
use React\EventLoop\Factory as LoopFactory;
use function Clue\React\Block\await;
use React\EventLoop\LoopInterface;

final class Client
{
    /**
     * @var LoopInterface
     */
    protected $loop;

    /**
     * @var AsyncClient
     */
    protected $client;

    /**
     * @var StreamingClient
     */
    protected $streamingClient;

    public function __construct(
        string $consumerKey,
        string $consumerSecret
    ) {
        $this->loop = LoopFactory::create();
        $this->client = new AsyncClient($consumerKey, $consumerSecret, $this->loop);
    }

    public function withAccessToken(string $accessToken, string $accessTokenSecret): Client
    {
        $clone = clone $this;
        $clone->client = $this->client->withAccessToken($accessToken, $accessTokenSecret);
        return $clone;
    }

    public function withOutAccessToken(): Client
    {
        $clone = clone $this;
        $clone->client = $this->client->withOutAccessToken();
        return $clone;
    }

    public function stream(): StreamingClient
    {
        if (!($this->streamingClient instanceof StreamingClient)) {
            $this->streamingClient = new StreamingClient(
                $this->loop,
                $this->client->getCommandBus(),
                $this->client->stream()
            );
        }

        return $this->streamingClient;
    }

    public function tweet(string $tweet): TweetInterface
    {
        return await(
            $this->client->tweet($tweet),
            $this->loop
        );
    }

    public function user(string $tweet): UserInterface
    {
        return await(
            $this->client->user($tweet),
            $this->loop
        );
    }
}
