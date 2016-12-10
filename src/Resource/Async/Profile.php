<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource\Async;

use ApiClients\Client\Twitter\Resource\Profile as BaseProfile;

class Profile extends BaseProfile
{
    public function refresh() : Profile
    {
        throw new \Exception('TODO: create refresh method!');
    }
}
