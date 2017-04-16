<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Foundation\Hydrator\Options as HydratorOptions;
use ApiClients\Foundation\Options;
use ApiClients\Foundation\Transport\Options as TransportOptions;
use ApiClients\Middleware\Json\JsonDecodeMiddleware;
use ApiClients\Middleware\Oauth1\Oauth1Middleware;
use ApiClients\Middleware\Oauth1\Options as Oauth1Options;
use ApiClients\Middleware\UserAgent\Options as UserAgentMiddlewareOptions;
use ApiClients\Middleware\UserAgent\UserAgentMiddleware;
use ApiClients\Middleware\UserAgent\UserAgentStrategies;
use ApiClients\Tools\Psr7\Oauth1\Definition;

final class ApiSettings
{
    const NAMESPACE = 'ApiClients\\Client\\Twitter\\Resource';

    const TRANSPORT_OPTIONS = [
        Options::HYDRATOR_OPTIONS => [
            HydratorOptions::NAMESPACE => self::NAMESPACE,
            HydratorOptions::NAMESPACE_DIR => __DIR__ . DIRECTORY_SEPARATOR . 'Resource' . DIRECTORY_SEPARATOR,
        ],
        Options::TRANSPORT_OPTIONS => [
            TransportOptions::HOST => 'api.twitter.com',
            TransportOptions::PATH => '/1.1/',
            TransportOptions::MIDDLEWARE => [
                Oauth1Middleware::class,
                JsonDecodeMiddleware::class,
                UserAgentMiddleware::class,
            ],
            TransportOptions::DEFAULT_REQUEST_OPTIONS => [
                UserAgentMiddleware::class => [
                    UserAgentMiddlewareOptions::STRATEGY => UserAgentStrategies::PACKAGE_VERSION,
                    UserAgentMiddlewareOptions::PACKAGE => 'api-clients/twitter',
                ],
            ],
        ],
    ];

    public static function getOptions(
        string $consumerKey,
        string $consumerSecret,
        string $suffix,
        array $suppliedOptions = []
    ): array {
        // @codingStandardsIgnoreStart
        $options = array_replace_recursive(self::TRANSPORT_OPTIONS, $suppliedOptions);
        $options[Options::HYDRATOR_OPTIONS][HydratorOptions::NAMESPACE_SUFFIX] = $suffix;
        $options[Options::TRANSPORT_OPTIONS][TransportOptions::MIDDLEWARE] = array_unique(
            $options[Options::TRANSPORT_OPTIONS][TransportOptions::MIDDLEWARE]
        );
        $options[Options::TRANSPORT_OPTIONS][TransportOptions::DEFAULT_REQUEST_OPTIONS][Oauth1Middleware::class][Oauth1Options::CONSUMER_KEY] = new Definition\ConsumerKey($consumerKey);
        $options[Options::TRANSPORT_OPTIONS][TransportOptions::DEFAULT_REQUEST_OPTIONS][Oauth1Middleware::class][Oauth1Options::CONSUMER_SECRET] = new Definition\ConsumerSecret($consumerSecret);
        // @codingStandardsIgnoreEnd
        return $options;
    }
}
