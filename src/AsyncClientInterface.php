<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Tools\CommandBus\CommandBusInterface;
use React\Promise\PromiseInterface;

interface AsyncClientInterface
{
    public function withAccessToken(string $accessToken, string $accessTokenSecret): AsyncClient;

    public function withOutAccessToken(): AsyncClient;

    public function getCommandBus(): CommandBusInterface;

    public function user(string $user): PromiseInterface;

    public function stream(): AsyncStreamingClient;
}
