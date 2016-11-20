<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Resource\ResourceInterface;
use DateTime;

interface TweetInterface extends ResourceInterface
{
    /**
     * @return bool
     */
    public function favorited() : bool;

    /**
     * @return bool
     */
    public function truncated() : bool;

    /**
     * @return DateTime
     */
    public function createdAt() : DateTime;

    /**
     * @return string
     */
    public function idStr() : string;

    /**
     * @return string
     */
    public function inReplyToUserIdStr() : string;

    /**
     * @return array
     */
    public function contributors() : array;

    /**
     * @return string
     */
    public function text() : string;

    /**
     * @return int
     */
    //public function retweetCount() : int;

    /**
     * @return string
     */
    public function inReplyToStatusIdStr() : string;

    /**
     * @return int
     */
    public function id() : int;

    /**
     * @return bool
     */
    public function retweeted() : bool;

    /**
     * @return bool
     */
    public function possiblySensitive() : bool;

    /**
     * @return int
     */
    public function inReplyToUserId() : int;

    /**
     * @return User
     */
    public function user() : User;

    /**
     * @return string
     */
    public function inReplyToScreenName() : string;

    /**
     * @return string
     */
    public function source() : string;

    /**
     * @return int
     */
    public function inReplyToStatusId() : int;
}
