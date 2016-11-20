<?php

use React\EventLoop\Factory;
use ApiClients\Twitter\AsyncClient;
use function ApiClients\Foundation\resource_pretty_print;
use function React\Promise\all;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$config = require 'resolve_config.php';

$loop = Factory::create();
$client = new AsyncClient(
    $config['consumer']['key'],
    $config['consumer']['secret'],
    $config['access_token']['token'],
    $config['access_token']['secret'],
    $loop
);

$hashtags = [];

if (count($argv) > 1) {
    unset($argv[0]);
    foreach ($argv as $hashtag) {
        $hashtags[] = '#' . $hashtag;
    }
}

$client->filteredStream([
    'track' => implode(',', $hashtags),
])->subscribeCallback(function ($document) {
    resource_pretty_print($document);
});

$loop->run();
