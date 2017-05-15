<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Hydrator\Annotation\EmptyResource;
use ApiClients\Foundation\Resource\AbstractResource;

/**
 * @EmptyResource("EmptyDeletedTweet")
 */
abstract class DeletedTweet extends AbstractResource implements DeletedTweetInterface
{
    /**
     * @var array
     */
    protected $status;

    /**
     * @var string
     */
    protected $timestamp_ms;

    /**
     * @return array
     */
    public function status(): array
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function timestampMs(): string
    {
        return $this->timestamp_ms;
    }
}
