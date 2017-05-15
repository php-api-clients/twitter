<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Resource\EmptyResourceInterface;
use DateTime;

abstract class EmptyUser implements UserInterface, EmptyResourceInterface
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
     * @return bool
     */
    public function protected(): bool
    {
        return null;
    }

    /**
     * @return int
     */
    public function followersCount(): int
    {
        return null;
    }

    /**
     * @return int
     */
    public function friendsCount(): int
    {
        return null;
    }

    /**
     * @return int
     */
    public function listedCount(): int
    {
        return null;
    }

    /**
     * @return DateTime
     */
    public function createdAt(): DateTime
    {
        return null;
    }

    /**
     * @return int
     */
    public function favouritesCount(): int
    {
        return null;
    }

    /**
     * @return int
     */
    public function utcOffset(): int
    {
        return null;
    }

    /**
     * @return string
     */
    public function timeZone(): string
    {
        return null;
    }

    /**
     * @return bool
     */
    public function geoEnabled(): bool
    {
        return null;
    }

    /**
     * @return bool
     */
    public function verified(): bool
    {
        return null;
    }

    /**
     * @return int
     */
    public function statusesCount(): int
    {
        return null;
    }

    /**
     * @return string
     */
    public function lang(): string
    {
        return null;
    }

    /**
     * @return array
     */
    public function status(): array
    {
        return null;
    }

    /**
     * @return bool
     */
    public function contributorsEnabled(): bool
    {
        return null;
    }

    /**
     * @return bool
     */
    public function isTranslator(): bool
    {
        return null;
    }

    /**
     * @return bool
     */
    public function isTranslatorEnabled(): bool
    {
        return null;
    }

    /**
     * @return string
     */
    public function profileBackgroundColor(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function profileBackgroundImageUrl(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function profileBackgroundImageUrlHttps(): string
    {
        return null;
    }

    /**
     * @return bool
     */
    public function profileBackgroundTile(): bool
    {
        return null;
    }

    /**
     * @return string
     */
    public function profileImageUrl(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function profileImageUrlHttps(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function profileBannerUrl(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function profileLinkColor(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function profileSidebarBorderColor(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function profileSidebarFillColor(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function profileTextColor(): string
    {
        return null;
    }

    /**
     * @return bool
     */
    public function profileUseBackgroundImage(): bool
    {
        return null;
    }

    /**
     * @return bool
     */
    public function hasExtendedProfile(): bool
    {
        return null;
    }

    /**
     * @return bool
     */
    public function defaultProfile(): bool
    {
        return null;
    }

    /**
     * @return bool
     */
    public function defaultProfileImage(): bool
    {
        return null;
    }

    /**
     * @return bool
     */
    public function following(): bool
    {
        return null;
    }

    /**
     * @return bool
     */
    public function followRequestSent(): bool
    {
        return null;
    }

    /**
     * @return bool
     */
    public function notifications(): bool
    {
        return null;
    }

    /**
     * @return string
     */
    public function translatorType(): string
    {
        return null;
    }
}
