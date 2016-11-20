<?php declare(strict_types=1);

namespace ApiClients\Twitter;

use ApiClients\Foundation\Hydrator\Options as HydratorOptions;
use ApiClients\Foundation\Oauth1\Middleware\Oauth1Middleware;
use ApiClients\Foundation\Options;
use ApiClients\Foundation\Transport\Middleware\JsonDecodeMiddleware;
use ApiClients\Foundation\Transport\Options as TransportOptions;
use ApiClients\Foundation\Transport\UserAgentStrategies;
use JacobKiers\OAuth\Consumer\Consumer;
use JacobKiers\OAuth\Token\Token;

class ApiSettings
{
    const NAMESPACE = 'ApiClients\\Twitter\\Resource';

    const TRANSPORT_OPTIONS = [
        Options::HYDRATOR_OPTIONS => [
            HydratorOptions::NAMESPACE => self::NAMESPACE,
            HydratorOptions::NAMESPACE_DIR => __DIR__ . DIRECTORY_SEPARATOR . 'Resource' . DIRECTORY_SEPARATOR,
        ],
        Options::TRANSPORT_OPTIONS => [
            TransportOptions::HOST => 'api.twitter.com',
            TransportOptions::PATH => '/1.1/',
            TransportOptions::USER_AGENT_STRATEGY => UserAgentStrategies::PACKAGE_VERSION,
            TransportOptions::PACKAGE => 'api-clients/twitter',
        ],
    ];

    public static function getOptions(
        string $consumerKey,
        string $consumerSecret,
        string $accessToken,
        string $accessTokenSecret,
        string $suffix
    ): array {
        $options = self::TRANSPORT_OPTIONS;
        $options[Options::HYDRATOR_OPTIONS][HydratorOptions::NAMESPACE_SUFFIX] = $suffix;
        $options['auth'] = [
            'consumer' => [
                'key' => $consumerKey,
                'secret' => $consumerSecret,
            ],
            'access_token' => [
                'token' => $accessToken,
                'secret' => $accessTokenSecret,
            ],
        ];
        $options[Options::TRANSPORT_OPTIONS][TransportOptions::MIDDLEWARE] = [
            Oauth1Middleware::class,
            JsonDecodeMiddleware::class,
        ];
        $options[Options::TRANSPORT_OPTIONS][TransportOptions::DEFAULT_REQUEST_OPTIONS] = [
            Oauth1Middleware::class => [
                \ApiClients\Foundation\Oauth1\Options::CONSUMER => new Consumer($options['auth']['consumer']['key'], $options['auth']['consumer']['secret']),
                \ApiClients\Foundation\Oauth1\Options::TOKEN => new Token($options['auth']['access_token']['token'], $options['auth']['access_token']['secret']),
            ],
        ];
        return $options;
    }
}
