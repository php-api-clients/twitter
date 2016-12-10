<?php

use ApiClients\Client\Twitter\AsyncClient;
use ApiClients\Client\Twitter\Resource\UserInterface;
use GuzzleHttp\Exception\ClientException;
use React\EventLoop\Factory;
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

foreach ($users as $user) {
    $client->user($user)->done(function (UserInterface $user) {
        resource_pretty_print($user);
    });
}

$loop->run();
