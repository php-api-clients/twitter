<?php

use ApiClients\Client\Twitter\Client;
use function ApiClients\Foundation\resource_pretty_print;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$config = require 'resolve_config.php';

$client = (new Client(
    $config['consumer']['key'],
    $config['consumer']['secret']
))->withAccessToken(
    $config['access_token']['token'],
    $config['access_token']['secret']
);

resource_pretty_print($client->profile());
