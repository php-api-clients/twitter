<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource;

use ApiClients\Foundation\Resource\ResourceInterface;

interface WarningInterface extends ResourceInterface
{
    const HYDRATE_CLASS = 'Warning';

    /**
     * @return array
     */
    public function status() : array;

    /**
     * @return string
     */
    public function timestampMs() : string;
}
