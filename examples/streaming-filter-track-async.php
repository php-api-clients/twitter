<?php

use React\EventLoop\Factory;
use ApiClients\Client\Twitter\AsyncClient;
use ApiClients\Client\Twitter\Resource\UserInterface;
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

$users = [
    'WyriHaximus',
];

if (count($argv) > 1) {
    unset($argv[0]);
    foreach ($argv as $track) {
        $tracks[] = $track;
    }
}

$client->filteredStream([
    'track' => implode(',', $tracks),
])->subscribeCallback(function ($document) {
    resource_pretty_print($document);
});

$loop->run();
