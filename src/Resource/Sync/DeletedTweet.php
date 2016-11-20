<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource\Sync;

use ApiClients\Client\Twitter\Resource\DeletedTweet as BaseDeletedTweet;

class DeletedTweet extends BaseDeletedTweet
{
    public function refresh() : DeletedTweet
    {
        return $this->wait($this->callAsync('refresh'));
    }
}
