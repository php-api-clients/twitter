<?php declare(strict_types=1);

namespace ApiClients\Tests\Client\Twitter;

use ApiClients\Client\Twitter\Client;
use ApiClients\Tools\TestUtilities\TestCase;

class ClientTest extends TestCase
{
    public function testImmutability()
    {
        $client = new Client('foo', 'bar');
        $newClient = $client->withAccessToken('beer', 'baz');
        $this->assertNotSame($client, $newClient);
        $anotherNewClient = $newClient->withOutAccessToken();
        $this->assertNotSame($client, $anotherNewClient);
        $this->assertNotSame($newClient, $anotherNewClient);
    }
}
