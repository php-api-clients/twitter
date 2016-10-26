<?php declare(strict_types=1);

$configFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php';

if (!file_exists($configFile)) {
    echo 'No config file found, copy config.sample.php to config.php and add your Twitter OAuth details.', PHP_EOL;
    exit(1);
}

return require $configFile;
