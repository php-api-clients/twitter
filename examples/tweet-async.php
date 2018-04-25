<?php

use ApiClients\Client\Twitter\AsyncClient;
use ApiClients\Client\Twitter\Resource\TweetInterface;
use function ApiClients\Foundation\resource_pretty_print;
use GuzzleHttp\Exception\ClientException;
use React\EventLoop\Factory;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$config = require 'resolve_config.php';

$loop = Factory::create();
$client = (new AsyncClient(
    $config['consumer']['key'],
    $config['consumer']['secret'],
    $loop
))->withAccessToken(
    $config['access_token']['token'],
    $config['access_token']['secret']
);

$client->tweet($argv[1])->done(function (TweetInterface $tweet) {
    resource_pretty_print($tweet);
});
$loop->run();
