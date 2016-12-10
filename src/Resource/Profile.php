<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Hydrator\Annotations\EmptyResource;
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

    public function putProfile()
    {

    }
}
