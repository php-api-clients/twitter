# Twitter API Client for PHP 7

[![Build Status](https://travis-ci.org/php-api-clients/twitter.svg?branch=master)](https://travis-ci.org/php-api-clients/twitter)
[![Latest Stable Version](https://poser.pugx.org/api-clients/twitter/v/stable.png)](https://packagist.org/packages/api-clients/twitter)
[![Total Downloads](https://poser.pugx.org/api-clients/twitter/downloads.png)](https://packagist.org/packages/api-clients/twitter)
[![Code Coverage](https://scrutinizer-ci.com/g/php-api-clients/twitter/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/php-api-clients/twitter/?branch=master)
[![License](https://poser.pugx.org/api-clients/twitter/license.png)](https://packagist.org/packages/api-clients/twitter)
[![PHP 7 ready](http://php7ready.timesplinter.ch/php-api-clients/twitter/badge.svg)](https://travis-ci.org/php-api-clients/twitter)


# Installation

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require api-clients/twitter 
```

# Usage

```
<?php

use React\EventLoop\Factory;
use ApiClients\Client\Twitter\AsyncClient;
use ApiClients\Client\Twitter\Resource\UserInterface;
use function ApiClients\Foundation\resource_pretty_print;

require 'vendor/autoload.php';
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

$client->user('php_api_clients')->done(function (UserInterface $user) {
    resource_pretty_print($user);
});

$loop->run();
```

# License

The MIT License (MIT)

Copyright (c) 2016 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
