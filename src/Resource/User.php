<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Hydrator\Annotations\EmptyResource;
use ApiClients\Foundation\Resource\AbstractResource;
use DateTime;

/**
 * @EmptyResource("EmptyUser")
 */
abstract class User extends AbstractResource implements UserInterface
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
    //protected $profile_location;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var bool
     */
    protected $protected;

    /**
     * @var int
     */
    protected $followers_count;

    /**
     * @var int
     */
    protected $friends_count;

    /**
     * @var int
     */
    protected $listed_count;

    /**
     * @var DateTime
     */
    protected $created_at;

    /**
     * @var int
     */
    protected $favourites_count;

    /**
     * @var int
     */
    protected $utc_offset;

    /**
     * @var string
     */
    protected $time_zone;

    /**
     * @var bool
     */
    protected $geo_enabled;

    /**
     * @var bool
     */
    protected $verified;

    /**
     * @var int
     */
    protected $statuses_count;

    /**
     * @var string
     */
    protected $lang;

    /**
     * @var array
     */
    //protected $status;

    /**
     * @var bool
     */
    protected $contributors_enabled;

    /**
     * @var bool
     */
    //protected $is_translator;

    /**
     * @var bool
     */
    //protected $is_translator_enabled;

    /**
     * @var string
     */
    protected $profile_background_color;

    /**
     * @var string
     */
    protected $profile_background_image_url;

    /**
     * @var string
     */
    protected $profile_background_image_url_https;

    /**
     * @var bool
     */
    protected $profile_background_tile;

    /**
     * @var string
     */
    protected $profile_image_url;

    /**
     * @var string
     */
    protected $profile_image_url_https;

    /**
     * @var string
     */
    //protected $profile_banner_url;

    /**
     * @var string
     */
    protected $profile_link_color;

    /**
     * @var string
     */
    protected $profile_sidebar_border_color;

    /**
     * @var string
     */
    protected $profile_sidebar_fill_color;

    /**
     * @var string
     */
    protected $profile_text_color;

    /**
     * @var bool
     */
    protected $profile_use_background_image;

    /**
     * @var bool
     */
    //protected $has_extended_profile;

    /**
     * @var bool
     */
    protected $default_profile;

    /**
     * @var bool
     */
    protected $default_profile_image;

    /**
     * @var bool
     */
    protected $following;

    /**
     * @var bool
     */
    protected $follow_request_sent;

    /**
     * @var bool
     */
    protected $notifications;

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
     * @return bool
     */
    public function protected() : bool
    {
        return $this->protected;
    }

    /**
     * @return int
     */
    public function followersCount() : int
    {
        return $this->followers_count;
    }

    /**
     * @return int
     */
    public function friendsCount() : int
    {
        return $this->friends_count;
    }

    /**
     * @return int
     */
    public function listedCount() : int
    {
        return $this->listed_count;
    }

    /**
     * @return DateTime
     */
    public function createdAt() : DateTime
    {
        return $this->created_at;
    }

    /**
     * @return int
     */
    public function favouritesCount() : int
    {
        return $this->favourites_count;
    }

    /**
     * @return int
     */
    public function utcOffset() : int
    {
        return $this->utc_offset;
    }

    /**
     * @return string
     */
    public function timeZone() : string
    {
        return $this->time_zone;
    }

    /**
     * @return bool
     */
    public function geoEnabled() : bool
    {
        return $this->geo_enabled;
    }

    /**
     * @return bool
     */
    public function verified() : bool
    {
        return $this->verified;
    }

    /**
     * @return int
     */
    public function statusesCount() : int
    {
        return $this->statuses_count;
    }

    /**
     * @return string
     */
    public function lang() : string
    {
        return $this->lang;
    }

    /**
     * @return array
     */
    public function status() : array
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function contributorsEnabled() : bool
    {
        return $this->contributors_enabled;
    }

    /**
     * @return bool
     */
    public function isTranslator() : bool
    {
        return $this->is_translator;
    }

    /**
     * @return bool
     */
    public function isTranslatorEnabled() : bool
    {
        return $this->is_translator_enabled;
    }

    /**
     * @return string
     */
    public function profileBackgroundColor() : string
    {
        return $this->profile_background_color;
    }

    /**
     * @return string
     */
    public function profileBackgroundImageUrl() : string
    {
        return $this->profile_background_image_url;
    }

    /**
     * @return string
     */
    public function profileBackgroundImageUrlHttps() : string
    {
        return $this->profile_background_image_url_https;
    }

    /**
     * @return bool
     */
    public function profileBackgroundTile() : bool
    {
        return $this->profile_background_tile;
    }

    /**
     * @return string
     */
    public function profileImageUrl() : string
    {
        return $this->profile_image_url;
    }

    /**
     * @return string
     */
    public function profileImageUrlHttps() : string
    {
        return $this->profile_image_url_https;
    }

    /**
     * @return string
     */
    public function profileBannerUrl() : string
    {
        return $this->profile_banner_url;
    }

    /**
     * @return string
     */
    public function profileLinkColor() : string
    {
        return $this->profile_link_color;
    }

    /**
     * @return string
     */
    public function profileSidebarBorderColor() : string
    {
        return $this->profile_sidebar_border_color;
    }

    /**
     * @return string
     */
    public function profileSidebarFillColor() : string
    {
        return $this->profile_sidebar_fill_color;
    }

    /**
     * @return string
     */
    public function profileTextColor() : string
    {
        return $this->profile_text_color;
    }

    /**
     * @return bool
     */
    public function profileUseBackgroundImage() : bool
    {
        return $this->profile_use_background_image;
    }

    /**
     * @return bool
     */
    public function hasExtendedProfile() : bool
    {
        return $this->has_extended_profile;
    }

    /**
     * @return bool
     */
    public function defaultProfile() : bool
    {
        return $this->default_profile;
    }

    /**
     * @return bool
     */
    public function defaultProfileImage() : bool
    {
        return $this->default_profile_image;
    }

    /**
     * @return bool
     */
    public function following() : bool
    {
        return $this->following;
    }

    /**
     * @return bool
     */
    public function followRequestSent() : bool
    {
        return $this->follow_request_sent;
    }

    /**
     * @return bool
     */
    public function notifications() : bool
    {
        return $this->notifications;
    }
}
