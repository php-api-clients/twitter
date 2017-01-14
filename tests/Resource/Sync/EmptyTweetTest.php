<?php declare(strict_types=1);

namespace ApiClients\Tests\Client\Twitter\Resource\Sync;

use ApiClients\Tools\ResourceTestUtilities\AbstractEmptyResourceTest;
use ApiClients\Client\Twitter\Resource\Sync\EmptyTweet;

final class EmptyTweetTest extends AbstractEmptyResourceTest
{
    public function getSyncAsync() : string
    {
        return 'Sync';
    }
    public function getClass() : string
    {
        return EmptyTweet::class;
    }
}
