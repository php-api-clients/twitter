<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Resource\EmptyResourceInterface;

abstract class EmptyDeletedTweet implements DeletedTweetInterface, EmptyResourceInterface
{
    /**
     * @return array
     */
    public function status(): array
    {
        return null;
    }

    /**
     * @return string
     */
    public function timestampMs(): string
    {
        return null;
    }
}
