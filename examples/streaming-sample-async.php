<?php

use React\EventLoop\Factory;
use ApiClients\Client\Twitter\AsyncClient;
use function ApiClients\Foundation\resource_pretty_print;

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

$client->sampleStream()->subscribeCallback(function ($document) {
    resource_pretty_print($document);
});

$loop->run();
