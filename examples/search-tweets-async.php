<?php

use ApiClients\Client\Twitter\AsyncClient;
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
)->stream();

$hashtags = [];

if (count($argv) > 1) {
    unset($argv[0]);
    foreach ($argv as $hashtag) {
        $hashtags[] = '#' . $hashtag;
    }
}

$hashtags = array_unique($hashtags);

$client->searchTweets([
    // Any parameters from: https://developer.twitter.com/en/docs/tweets/search/api-reference/get-search-tweets.html
    'q' => 'nasa',
    'result_type' => 'popular',
])->subscribe(function ($document) {
    resource_pretty_print($document);
});

$loop->run();
