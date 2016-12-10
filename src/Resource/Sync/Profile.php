<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource\Sync;

use ApiClients\Foundation\Hydrator\CommandBus\Command\BuildAsyncFromSyncCommand;
use ApiClients\Client\Twitter\Resource\Profile as BaseProfile;
use ApiClients\Client\Twitter\Resource\ProfileInterface;

class Profile extends BaseProfile
{
    public function putProfile()
    {
        // TODO: Implement putProfile() method.
    }

    public function refresh() : Profile
    {
        return $this->wait($this->handleCommand(new BuildAsyncFromSyncCommand(self::HYDRATE_CLASS, $this))->then(function (ProfileInterface $profile) {
            return $profile->refresh();
        }));
    }
}
