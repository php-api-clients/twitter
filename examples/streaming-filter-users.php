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
);

$users = [
    'WyriHaximus',
];

if (count($argv) > 1) {
    unset($argv[0]);
    foreach ($argv as $user) {
        $users[] = $user;
    }
}

$users = array_unique($users);

$userIds = [];
foreach ($users as $user) {
    $userIds[] = $client->user($user)->idStr();
}

$client->stream()->filtered(
    function ($document) {
        resource_pretty_print($document);
    },
    [
        'follow' => implode(',', $userIds),
    ]
);
