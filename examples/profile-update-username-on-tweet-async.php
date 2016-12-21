<?php

use ApiClients\Client\Twitter\AsyncClient;
use ApiClients\Client\Twitter\Resource\Async\Tweet;
use ApiClients\Client\Twitter\Resource\ProfileInterface;
use React\EventLoop\Factory;
use function ApiClients\Foundation\resource_pretty_print;

if (!isset($argv[1])) {
    echo 'This example requires you to pass a username for example \'php profile-update-name-async.php "Cees-Jan %s Kiewiet"\'.', PHP_EOL;
    echo 'The %s in there will be replaced with a random emoji.', PHP_EOL;
    exit(255);
}

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$config = require 'resolve_config.php';
$emojis = require 'emoji.php';

$loop = Factory::create();
$client = (new AsyncClient(
    $config['consumer']['key'],
    $config['consumer']['secret'],
    $loop
))->withAccessToken(
    $config['access_token']['token'],
    $config['access_token']['secret']
);

$profile = $client->profile()->done(function (ProfileInterface $profile) use ($client, $argv, $emojis) {
    resource_pretty_print($profile);
    $client->stream()->filtered([
        'follow' => $profile->idStr(),
    ])->filter(function ($resource) {
        return $resource instanceof Tweet;
    })->filter(function (Tweet $tweet) use ($profile) {
        return $tweet->user()->idStr() === $profile->idStr();
    })->subscribeCallback(
        function (Tweet $tweet) use ($profile, $argv, $emojis) {
            echo '------------------', PHP_EOL;
            echo $tweet->text(), PHP_EOL;
            echo '------------------', PHP_EOL;
            $profile = $profile->withName(sprintf(
                $argv[1],
                $emojis[random_int(0, count($emojis) - 1)]
            ));
            $profile->putProfile()->done(function (ProfileInterface $newProfile) use ($profile) {
                $profile = $newProfile;
                resource_pretty_print($profile);
            });
        },
        function ($e) {
            echo (string)$e;
        },
        function () {
            echo PHP_EOL;
            echo '------------------', PHP_EOL;
            echo 'Completed streaming', PHP_EOL;
            echo '------------------', PHP_EOL;
        }
    );
});

$loop->run();
