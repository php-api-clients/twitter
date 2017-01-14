<?php declare(strict_types=1);

namespace ApiClients\Tests\Client\Twitter;

use ApiClients\Client\Twitter\AsyncStreamingClientInterface;
use ApiClients\Client\Twitter\StreamingClient;
use ApiClients\Foundation\Hydrator\CommandBus\Command\BuildSyncFromAsyncCommand;
use ApiClients\Foundation\Resource\ResourceInterface;
use ApiClients\Tools\CommandBus\CommandBusInterface;
use ApiClients\Tools\TestUtilities\TestCase;
use Prophecy\Argument;
use React\EventLoop\Factory;
use Rx\Observable;

final class StreamingClientTest extends TestCase
{
    public function streamingClientProvider()
    {
        yield [
            'sample',
            [],
        ];

        yield [
            'filtered',
            [
                [
                    'follow' => 'php_api_clients',
                ],
            ],
        ];

        yield [
            'filtered',
            [
                [
                    'track' => 'php',
                ],
            ],
        ];

        yield [
            'filtered',
            [
                [
                    'track' => 'php,phpc,reactphp,async',
                ],
            ],
        ];

        yield [
            'filtered',
            [
                [
                    'track' => '#php',
                ],
            ],
        ];

        yield [
            'filtered',
            [
                [
                    'track' => '#php,#phpc,#reactphp,#async',
                ],
            ],
        ];
    }

    /**
     * @dataProvider streamingClientProvider
     */
    public function testStreamingClient(string $method, array $args)
    {
        $resource = $this->prophesize(ResourceInterface::class);
        $listener = function () {};
        $loop = Factory::create();
        $commandBus = $this->prophesize(CommandBusInterface::class);
        $commandBus->handle(Argument::type(BuildSyncFromAsyncCommand::class))->shouldBeCalled()->willReturn(\React\Promise\reject());
        /*$container = ContainerBuilder::buildDevContainer();
        $container->set(LoopInterface::class, Factory::create());
        $container->set(CommandBusInterface::class, $commandBus->reveal());
        $client = new Client($container);*/
        $observableSecond = $this->prophesize(Observable::class);
        $observableSecond->subscribeCallback($listener, Argument::type('callable'))->shouldBeCalled();
        $observableFirst = $this->prophesize(Observable::class);
        $observableFirst->flatMap(Argument::that(function (callable $callable) use ($resource) {
            $callable($resource->reveal());
            return true;
        }))->shouldBeCalled()->willReturn($observableSecond->reveal());
        $asyncStreamingClient = $this->prophesize(AsyncStreamingClientInterface::class);
        $asyncStreamingClient->$method(...$args)->willReturn($observableFirst->reveal());
        $streamingClient = new StreamingClient(
            $loop,
            $commandBus->reveal(),
            $asyncStreamingClient->reveal()
        );
        $streamingClient->$method(
            $listener,
            ...$args
        );
    }
}
