<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Client\Twitter\Resource\TweetInterface;
use ApiClients\Client\Twitter\Resource\UserInterface;
use function Clue\React\Block\await;

interface ClientInterface
{
    public function withAccessToken(string $accessToken, string $accessTokenSecret): Client;
    public function withOutAccessToken(): Client;
    public function stream(): StreamingClient;
    public function tweet(string $tweet): TweetInterface;
    public function user(string $tweet): UserInterface;
}
