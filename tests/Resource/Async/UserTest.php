<?php declare(strict_types=1);

namespace ApiClients\Tests\Client\Twitter\Resource\Async;

use ApiClients\Client\Twitter\ApiSettings;
use ApiClients\Client\Twitter\Resource\User;
use ApiClients\Tools\ResourceTestUtilities\AbstractResourceTest;

class UserTest extends AbstractResourceTest
{
    public function getSyncAsync() : string
    {
        return 'Async';
    }
    public function getClass() : string
    {
        return User::class;
    }
    public function getNamespace() : string
    {
        return Apisettings::NAMESPACE;
    }
}
