<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Resource\EmptyResourceInterface;

abstract class EmptyProfile implements ProfileInterface, EmptyResourceInterface
{
    /**
     * @return int
     */
    public function id(): int
    {
        return null;
    }

    /**
     * @return string
     */
    public function idStr(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function screenName(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function location(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function profileLocation(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return null;
    }

    /**
     * @param  string           $name
     * @return ProfileInterface
     */
    public function withName(string $name): ProfileInterface
    {
        return clone $this;
    }

    /**
     * @param  string           $location
     * @return ProfileInterface
     */
    public function withLocation(string $location): ProfileInterface
    {
        return clone $this;
    }

    /**
     * @param  string           $description
     * @return ProfileInterface
     */
    public function withDescription(string $description): ProfileInterface
    {
        return clone $this;
    }

    /**
     * @param  string           $url
     * @return ProfileInterface
     */
    public function withUrl(string $url): ProfileInterface
    {
        return clone $this;
    }

    public function putProfile()
    {
    }
}
