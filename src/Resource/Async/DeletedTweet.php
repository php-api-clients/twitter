<?php declare(strict_types=1);

namespace ApiClients\Twitter\Resource\Async;

use ApiClients\Twitter\Resource\DeletedTweet as BaseDeletedTweet;

class DeletedTweet extends BaseDeletedTweet
{
    public function refresh() : DeletedTweet
    {
        return $this->wait($this->callAsync('refresh'));
    }
}
