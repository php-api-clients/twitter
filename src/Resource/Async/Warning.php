<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource\Async;

use ApiClients\Client\Twitter\Resource\Warning as BaseWarning;

class Warning extends BaseWarning
{
    public function refresh(): Warning
    {
        throw new \Exception('TODO: create refresh method!');
    }
}
