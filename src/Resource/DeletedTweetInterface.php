<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Resource\ResourceInterface;

interface DeletedTweetInterface extends ResourceInterface
{
    const HYDRATE_CLASS = 'DeletedTweet';

    /**
     * @return array
     */
    public function status() : array;

    /**
     * @return string
     */
    public function timestampMs() : string;
}
