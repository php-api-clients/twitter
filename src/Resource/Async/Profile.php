<?php declare(strict_types=1);

namespace ApiClients\Client\Twitter\Resource\Async;

use ApiClients\Client\Twitter\Resource\Profile as BaseProfile;
use ApiClients\Foundation\Hydrator\CommandBus\Command\HydrateCommand;
use ApiClients\Foundation\Transport\CommandBus\Command\RequestCommand;
use Psr\Http\Message\ResponseInterface;
use React\Promise\PromiseInterface;
use RingCentral\Psr7\Request;
use function React\Promise\resolve;

class Profile extends BaseProfile
{
    public function putProfile(): PromiseInterface
    {
        $fields = [];
        foreach ($this->changedFields as $field) {
            $fields[$field] = $this->$field;
        }

        $uri = 'account/update_profile.json?' . http_build_query($fields);

        return $this->handleCommand(new RequestCommand(
            new Request('POST', $uri)
        ))->then(function (ResponseInterface $response) {
            return resolve($this->handleCommand(new HydrateCommand('Profile', $response->getBody()->getJson())));
        });
    }

    public function refresh() : Profile
    {
        throw new \Exception('TODO: create refresh method!');
    }
}
