<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Client\Twitter\Resource\TweetInterface;
use ApiClients\Client\Twitter\Resource\UserInterface;
use React\EventLoop\Factory as LoopFactory;
use function Clue\React\Block\await;
use React\EventLoop\LoopInterface;

class Client
{
    /**
     * @var LoopInterface
     */
    protected $loop;

    /**
     * @var AsyncClient
     */
    protected $client;

    public function __construct(
        string $consumerKey,
        string $consumerSecret,
        string $accessToken,
        string $accessTokenSecret
    ) {
        $this->loop = LoopFactory::create();
        $this->client = new AsyncClient($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, $this->loop);
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
