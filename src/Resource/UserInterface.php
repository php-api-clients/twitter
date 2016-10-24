<?php declare(strict_types=1);

namespace ApiClients\Twitter\Resource;

use ApiClients\Foundation\Resource\ResourceInterface;
use DateTime;

interface UserInterface extends ResourceInterface
{
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
     * @return bool
     */
    public function protected() : bool;

    /**
     * @return int
     */
    public function followersCount() : int;

    /**
     * @return int
     */
    public function friendsCount() : int;

    /**
     * @return int
     */
    public function listedCount() : int;

    /**
     * @return DateTime
     */
    public function createdAt() : DateTime;

    /**
     * @return int
     */
    public function favouritesCount() : int;

    /**
     * @return int
     */
    public function utcOffset() : int;

    /**
     * @return string
     */
    public function timeZone() : string;

    /**
     * @return bool
     */
    public function geoEnabled() : bool;

    /**
     * @return bool
     */
    public function verified() : bool;

    /**
     * @return int
     */
    public function statusesCount() : int;

    /**
     * @return string
     */
    public function lang() : string;

    /**
     * @return array
     */
    public function status() : array;

    /**
     * @return bool
     */
    public function contributorsEnabled() : bool;

    /**
     * @return bool
     */
    public function isTranslator() : bool;

    /**
     * @return bool
     */
    public function isTranslatorEnabled() : bool;

    /**
     * @return string
     */
    public function profileBackgroundColor() : string;

    /**
     * @return string
     */
    public function profileBackgroundImageUrl() : string;

    /**
     * @return string
     */
    public function profileBackgroundImageUrlHttps() : string;

    /**
     * @return bool
     */
    public function profileBackgroundTile() : bool;

    /**
     * @return string
     */
    public function profileImageUrl() : string;

    /**
     * @return string
     */
    public function profileImageUrlHttps() : string;

    /**
     * @return string
     */
    public function profileBannerUrl() : string;

    /**
     * @return string
     */
    public function profileLinkColor() : string;

    /**
     * @return string
     */
    public function profileSidebarBorderColor() : string;

    /**
     * @return string
     */
    public function profileSidebarFillColor() : string;

    /**
     * @return string
     */
    public function profileTextColor() : string;

    /**
     * @return bool
     */
    public function profileUseBackgroundImage() : bool;

    /**
     * @return bool
     */
    public function hasExtendedProfile() : bool;

    /**
     * @return bool
     */
    public function defaultProfile() : bool;

    /**
     * @return bool
     */
    public function defaultProfileImage() : bool;

    /**
     * @return bool
     */
    public function following() : bool;

    /**
     * @return bool
     */
    public function followRequestSent() : bool;

    /**
     * @return bool
     */
    public function notifications() : bool;
}
