<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

interface StreamingClientInterface
{
    public function sample(callable $listener);

    public function filtered(callable $listener, array $filter = []);
}
