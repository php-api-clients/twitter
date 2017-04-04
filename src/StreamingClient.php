<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter;

use ApiClients\Foundation\Hydrator\CommandBus\Command\BuildSyncFromAsyncCommand;
use ApiClients\Foundation\Resource\ResourceInterface;
use ApiClients\Tools\CommandBus\CommandBusInterface;
use React\EventLoop\LoopInterface;
use ReflectionObject;
use Rx\ObservableInterface;
use Rx\React\Promise;

final class StreamingClient implements StreamingClientInterface
{
    /**
     * @var LoopInterface
     */
    protected $loop;

    /**
     * @var CommandBusInterface
     */
    protected $commandBus;

    /**
     * @var AsyncStreamingClientInterface
     */
    protected $client;

    /**
     * @var array
     */
    protected $hydrateClassConstantCache = [];

    /**
     * StreamingClient constructor.
     * @param LoopInterface $loop
     * @param CommandBusInterface $commandBus
     * @param AsyncStreamingClientInterface $client
     */
    public function __construct(
        LoopInterface $loop,
        CommandBusInterface $commandBus,
        AsyncStreamingClientInterface $client
    ) {
        $this->loop = $loop;
        $this->commandBus = $commandBus;
        $this->client = $client;
    }

    public function sample(callable $listener)
    {
        $this->stream($this->client->sample(), $listener);
    }

    public function filtered(callable $listener, array $filter = [])
    {
        $this->stream($this->client->filtered($filter), $listener);
    }

    protected function stream(ObservableInterface $observable, callable $listener)
    {
        $observable->flatMap(function (ResourceInterface $resource) {
            return Promise::toObservable(
                $this->commandBus->handle(
                    new BuildSyncFromAsyncCommand(
                        $this->loopUpHydrateClassConstant($resource),
                        $resource
                    )
                )
            );
        })->subscribe(
            $listener,
            function ($error) {
                throw $error;
            }
        );
        $this->loop->run();
    }

    protected function loopUpHydrateClassConstant(ResourceInterface $resource)
    {
        $class = get_class($resource);
        if (!isset($this->hydrateClassConstantCache[$class])) {
            $this->hydrateClassConstantCache[$class] = (new ReflectionObject($resource))->getConstant('HYDRATE_CLASS');
        }

        return $this->hydrateClassConstantCache[$class];
    }
}
