<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource\Sync;

use ApiClients\Client\Twitter\Resource\Warning as BaseWarning;
use ApiClients\Client\Twitter\Resource\WarningInterface;
use ApiClients\Foundation\Hydrator\CommandBus\Command\BuildAsyncFromSyncCommand;

class Warning extends BaseWarning
{
    public function refresh(): Warning
    {
        return $this->wait(
            $this->handleCommand(
                new BuildAsyncFromSyncCommand(self::HYDRATE_CLASS, $this)
            )->then(
                function (WarningInterface $warning) {
                    return $warning->refresh();
                }
            )
        );
    }
}
