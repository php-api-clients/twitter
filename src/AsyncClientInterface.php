<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Tools\CommandBus\CommandBusInterface;
use React\Promise\PromiseInterface;

interface AsyncClientInterface
{
    public function withAccessToken(string $accessToken, string $accessTokenSecret): AsyncClient;

    public function withOutAccessToken(): AsyncClient;

    public function getCommandBus(): CommandBusInterface;

    public function profile(): PromiseInterface;

    public function user(string $user): PromiseInterface;

    public function tweet(string $status, array $tweet): PromiseInterface;

    public function stream(): AsyncStreamingClientInterface;
}
