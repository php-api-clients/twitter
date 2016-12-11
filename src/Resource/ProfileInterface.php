<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Resource\ResourceInterface;

interface ProfileInterface extends ResourceInterface
{
    const HYDRATE_CLASS = 'Profile';

    /**
     * @return int
     */
    public function id() : int;

    /**
     * @return string
     */
    public function idStr() : string;

    /**
     * @return string
     */
    public function name() : string;

    /**
     * @return string
     */
    public function screenName() : string;

    /**
     * @return string
     */
    public function location() : string;

    /**
     * @return string
     */
    public function profileLocation() : string;

    /**
     * @return string
     */
    public function description() : string;

    /**
     * @return string
     */
    public function url() : string;

    /**
     * @param string $name
     * @return static
     */
    public function withName(string $name);

    /**
     * @param string $location
     * @return static
     */
    public function withLocation(string $location);

    /**
     * @param string $description
     * @return static
     */
    public function withDescription(string $description);

    /**
     * @param string $url
     * @return static
     */
    public function withUrl(string $url);

    /**
     * @return static
     */
    public function putProfile();
}
