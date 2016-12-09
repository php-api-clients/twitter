<?php declare(strict_types=1);

namespace ApiClients\Tests\Client\Twitter;

use ApiClients\Client\Twitter\AsyncStreamingClient;
use ApiClients\Client\Twitter\AsyncStreamingClientInterface;
use ApiClients\Client\Twitter\StreamingClient;
use ApiClients\Foundation\Client;
use ApiClients\Foundation\Hydrator\CommandBus\Command\BuildSyncFromAsyncCommand;
use ApiClients\Foundation\Transport\CommandBus\Command\StreamingRequestCommand;
use ApiClients\Tools\CommandBus\CommandBusInterface;
use ApiClients\Tools\TestUtilities\TestCase;
use DI\ContainerBuilder;
use Prophecy\Argument;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use Rx\Observable;
use Rx\ObservableInterface;

class StreamingClientTest extends TestCase
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
    }

    /**
     * @dataProvider streamingClientProvider
     */
    public function testStreamingClient(string $method, array $args)
    {
        $listener = function () {};
        $loop = Factory::create();
        $commandBus = $this->prophesize(CommandBusInterface::class);
        $commandBus->handle(Argument::type(BuildSyncFromAsyncCommand::class))->willReturn(\React\Promise\reject());
        /*$container = ContainerBuilder::buildDevContainer();
        $container->set(LoopInterface::class, Factory::create());
        $container->set(CommandBusInterface::class, $commandBus->reveal());
        $client = new Client($container);*/
        $observableSecond = $this->prophesize(Observable::class);
        $observableSecond->flatMap($listener, Argument::type('callable'));
        $observableFirst = $this->prophesize(Observable::class);
        $observableFirst->flatMap(Argument::type('callable'))->willReturn($observableSecond->reveal());
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
