<?php declare(strict_types=1);

namespace ApiClients\Tests\Client\Twitter;

use ApiClients\Client\Twitter\AsyncClient;
use ApiClients\Tools\TestUtilities\TestCase;
use React\EventLoop\Factory;

class AsyncClientTest extends TestCase
{
    public function testImmutability()
    {
        $client = new AsyncClient('foo', 'bar', Factory::create());
        $newClient = $client->withAccessToken('beer', 'baz');
        $this->assertNotSame($client, $newClient);
        $anotherNewClient = $newClient->withOutAccessToken();
        $this->assertNotSame($client, $anotherNewClient);
        $this->assertNotSame($newClient, $anotherNewClient);
    }
}
