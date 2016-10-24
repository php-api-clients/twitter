<?php declare(strict_types=1);

namespace ApiClients\Twitter\Resource\Sync;

use ApiClients\Twitter\Resource\User as BaseUser;

class User extends BaseUser
{
    public function refresh() : User
    {
        return $this->wait($this->callAsync('refresh'));
    }
}
