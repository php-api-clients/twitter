<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource\Async;

use ApiClients\Client\Twitter\Resource\User as BaseUser;

class User extends BaseUser
{
    public function refresh() : User
    {
        return $this->wait($this->callAsync('refresh'));
    }
}
