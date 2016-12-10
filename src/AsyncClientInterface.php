<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Tools\CommandBus\CommandBusInterface;
use ApiClients\Tools\Psr7\Oauth1\Definition;
use React\Promise\PromiseInterface;
use Rx\Observable;
use function React\Promise\resolve;

interface AsyncClientInterface
{
    public function withAccessToken(string $accessToken, string $accessTokenSecret): AsyncClient;
    public function withOutAccessToken(): AsyncClient;
    public function getCommandBus(): CommandBusInterface;
    public function user(string $user): PromiseInterface;
    public function stream(): AsyncStreamingClient;
}
