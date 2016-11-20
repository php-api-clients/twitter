<?php declare(strict_types=1);

namespace ApiClients\Tests\Twitter\Resource\Async;

use ApiClients\Tools\ResourceTestUtilities\AbstractResourceTest;
use ApiClients\Twitter\ApiSettings;
use ApiClients\Twitter\Resource\DeletedTweet;

class DeletedTweetTest extends AbstractResourceTest
{
    public function getSyncAsync() : string
    {
        return 'Async';
    }
    public function getClass() : string
    {
        return DeletedTweet::class;
    }
    public function getNamespace() : string
    {
        return Apisettings::NAMESPACE;
    }
}
