<?php

use ApiClients\Client\Twitter\Client;
use function ApiClients\Foundation\resource_pretty_print;
use function React\Promise\all;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$config = require 'resolve_config.php';

$client = (new Client(
    $config['consumer']['key'],
    $config['consumer']['secret']
))->withAccessToken(
    $config['access_token']['token'],
    $config['access_token']['secret']
)->stream();

$users = [
    'WyriHaximus',
];

if (count($argv) > 1) {
    unset($argv[0]);
    foreach ($argv as $track) {
        $tracks[] = $track;
    }
}

$tracks = array_unique($tracks);

$client->filtered(
    function ($document) {
        resource_pretty_print($document);
    },
    [
        'track' => implode(',', $tracks),
    ]
);
