<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use Rx\Observable;

interface AsyncStreamingClientInterface
{
    public function sample(): Observable;

    public function filtered(array $filter = []): Observable;

    public function searchTweets(array $filter): Observable;
}
