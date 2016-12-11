<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource\Sync;

use ApiClients\Client\Twitter\Resource\Async\Profile as AsyncProfile;
use ApiClients\Foundation\Hydrator\CommandBus\Command\BuildAsyncFromSyncCommand;
use ApiClients\Client\Twitter\Resource\Profile as BaseProfile;
use ApiClients\Client\Twitter\Resource\ProfileInterface;
use ApiClients\Foundation\Hydrator\CommandBus\Command\BuildSyncFromAsyncCommand;

class Profile extends BaseProfile
{
    public function putProfile(): Profile
    {
        return $this->wait(
            $this->handleCommand(
                new BuildAsyncFromSyncCommand(self::HYDRATE_CLASS, $this)
            )->then(function (AsyncProfile $profile) {
                return $profile->putProfile();
            })->then(function (Profile $profile) {
                return $this->handleCommand(new BuildSyncFromAsyncCommand(self::HYDRATE_CLASS, $profile));
            })
        );
    }

    public function refresh() : Profile
    {
        return $this->wait(
            $this->handleCommand(
                new BuildAsyncFromSyncCommand(self::HYDRATE_CLASS, $this)
            )->then(function (ProfileInterface $profile) {
                return $profile->refresh();
            })
        );
    }
}
