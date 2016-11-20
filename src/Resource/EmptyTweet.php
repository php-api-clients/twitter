<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Resource\EmptyResourceInterface;
use DateTime;

abstract class EmptyTweet implements TweetInterface, EmptyResourceInterface
{
    /**
     * @return bool
     */
    public function favorited() : bool
    {
        return null;
    }

    /**
     * @return bool
     */
    public function truncated() : bool
    {
        return null;
    }

    /**
     * @return DateTime
     */
    public function createdAt() : DateTime
    {
        return null;
    }

    /**
     * @return string
     */
    public function idStr() : string
    {
        return null;
    }

    /**
     * @return string
     */
    public function inReplyToUserIdStr() : string
    {
        return null;
    }

    /**
     * @return array
     */
    public function contributors() : array
    {
        return null;
    }

    /**
     * @return string
     */
    public function text() : string
    {
        return null;
    }

    /**
     * @return int
     */
    public function retweetCount() : int
    {
        return null;
    }

    /**
     * @return string
     */
    public function inReplyToStatusIdStr() : string
    {
        return null;
    }

    /**
     * @return int
     */
    public function id() : int
    {
        return null;
    }

    /**
     * @return bool
     */
    public function retweeted() : bool
    {
        return null;
    }

    /**
     * @return bool
     */
    public function possiblySensitive() : bool
    {
        return null;
    }

    /**
     * @return int
     */
    public function inReplyToUserId() : int
    {
        return null;
    }

    /**
     * @return User
     */
    public function user() : User
    {
        return null;
    }

    /**
     * @return string
     */
    public function inReplyToScreenName() : string
    {
        return null;
    }

    /**
     * @return string
     */
    public function source() : string
    {
        return null;
    }

    /**
     * @return int
     */
    public function inReplyToStatusId() : int
    {
        return null;
    }
}
