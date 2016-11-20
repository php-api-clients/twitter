<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Hydrator\Annotations\EmptyResource;
use ApiClients\Foundation\Hydrator\Annotations\Nested;
use ApiClients\Foundation\Resource\AbstractResource;
use DateTime;

/**
 * @Nested(
 *     user="User"
 * )
 * @EmptyResource("EmptyTweet")
 */
abstract class Tweet extends AbstractResource implements TweetInterface
{
    /**
     * @var bool
     */
    protected $favorited;

    /**
     * @var bool
     */
    protected $truncated;

    /**
     * @var DateTime
     */
    protected $created_at;

    /**
     * @var string
     */
    protected $id_str;

    /**
     * @var string
     */
    //protected $in_reply_to_user_id_str;

    /**
     * @var array
     */
    protected $contributors;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var int
     */
    //protected $retweet_count;

    /**
     * @var string
     */
    //protected $in_reply_to_status_id_str;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var bool
     */
    protected $retweeted;

    /**
     * @var bool
     */
    //protected $possibly_sensitive;

    /**
     * @var int
     */
    //protected $in_reply_to_user_id;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    //protected $in_reply_to_screen_name;

    /**
     * @var string
     */
    //protected $source;

    /**
     * @var int
     */
    //protected $in_reply_to_status_id;

    /**
     * @return bool
     */
    public function favorited() : bool
    {
        return $this->favorited;
    }

    /**
     * @return bool
     */
    public function truncated() : bool
    {
        return $this->truncated;
    }

    /**
     * @return DateTime
     */
    public function createdAt() : DateTime
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function idStr() : string
    {
        return $this->id_str;
    }

    /**
     * @return string
     */
    public function inReplyToUserIdStr() : string
    {
        return $this->in_reply_to_user_id_str;
    }

    /**
     * @return array
     */
    public function contributors() : array
    {
        return $this->contributors;
    }

    /**
     * @return string
     */
    public function text() : string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function retweetCount() : int
    {
        return $this->retweet_count;
    }

    /**
     * @return string
     */
    public function inReplyToStatusIdStr() : string
    {
        return $this->in_reply_to_status_id_str;
    }

    /**
     * @return int
     */
    public function id() : int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function retweeted() : bool
    {
        return $this->retweeted;
    }

    /**
     * @return bool
     */
    public function possiblySensitive() : bool
    {
        return $this->possibly_sensitive;
    }

    /**
     * @return int
     */
    public function inReplyToUserId() : int
    {
        return $this->in_reply_to_user_id;
    }

    /**
     * @return User
     */
    public function user() : User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function inReplyToScreenName() : string
    {
        return $this->in_reply_to_screen_name;
    }

    /**
     * @return string
     */
    public function source() : string
    {
        return $this->source;
    }

    /**
     * @return int
     */
    public function inReplyToStatusId() : int
    {
        return $this->in_reply_to_status_id;
    }
}
