<?php

use ApiClients\Client\Twitter\Client;
use function ApiClients\Foundation\resource_pretty_print;

if (!isset($argv[1])) {
    echo 'This example requires you to pass a username for example \'php profile-update-name-async.php "Cees-Jan %s Kiewiet"\'.', PHP_EOL;
    echo 'The %s in there will be replaced with a random emoji.', PHP_EOL;
    exit(255);
}

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$config = require 'resolve_config.php';
$emojis = require 'emoji.php';

$profile = (new Client(
    $config['consumer']['key'],
    $config['consumer']['secret']
))->withAccessToken(
    $config['access_token']['token'],
    $config['access_token']['secret']
)->profile();

echo 'Fetched profile', PHP_EOL;
resource_pretty_print($profile);
echo 'Setting new name', PHP_EOL;
$profile = $profile->withName(sprintf(
    $argv[1],
    $emojis[random_int(0, count($emojis) - 1)]
));
resource_pretty_print($profile);

echo 'Updating profile', PHP_EOL;
$profile = $profile->putProfile();
echo 'Profile updated', PHP_EOL;
resource_pretty_print($profile);
