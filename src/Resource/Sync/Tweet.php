<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource\Sync;

use ApiClients\Client\Twitter\Resource\Tweet as BaseTweet;

class Tweet extends BaseTweet
{
    public function refresh(): Tweet
    {
        return $this->wait($this->callAsync('refresh'));
    }
}
