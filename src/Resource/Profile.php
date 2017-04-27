<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Hydrator\Annotation\EmptyResource;
use ApiClients\Foundation\Resource\AbstractResource;

/**
 * @EmptyResource("EmptyProfile")
 */
abstract class Profile extends AbstractResource implements ProfileInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $id_str;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $screen_name;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var string
     */
    protected $profile_location;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $changedFields = [];

    /**
     * @return int
     */
    public function id() : int
    {
        return $this->id;
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
    public function name() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function screenName() : string
    {
        return $this->screen_name;
    }

    /**
     * @return string
     */
    public function location() : string
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function profileLocation() : string
    {
        return $this->profile_location;
    }

    /**
     * @return string
     */
    public function description() : string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function url() : string
    {
        return $this->url;
    }

    /**
     * @param string $name
     * @return ProfileInterface
     */
    public function withName(string $name): ProfileInterface
    {
        $clone = clone $this;
        $clone->name = $name;
        $clone->changedFields['name'] = 'name';
        return $clone;
    }

    /**
     * @param string $location
     * @return ProfileInterface
     */
    public function withLocation(string $location): ProfileInterface
    {
        $clone = clone $this;
        $clone->location = $location;
        $clone->changedFields['location'] = 'location';
        return $clone;
    }

    /**
     * @param string $description
     * @return ProfileInterface
     */
    public function withDescription(string $description): ProfileInterface
    {
        $clone = clone $this;
        $clone->description = $description;
        $clone->changedFields['description'] = 'description';
        return $clone;
    }

    /**
     * @param string $url
     * @return ProfileInterface
     */
    public function withUrl(string $url): ProfileInterface
    {
        $clone = clone $this;
        $clone->url = $url;
        $clone->changedFields['url'] = 'url';
        return $clone;
    }

    public function putProfile()
    {
    }
}
