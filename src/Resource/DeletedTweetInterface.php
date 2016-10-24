<?php declare(strict_types=1);

namespace ApiClients\Twitter\Resource;

use ApiClients\Foundation\Resource\ResourceInterface;

interface DeletedTweetInterface extends ResourceInterface
{
    /**
     * @return array
     */
    public function status() : array;

    /**
     * @return string
     */
    public function timestampMs() : string;
}
