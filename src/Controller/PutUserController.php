<?php

namespace App\Controller;

use Domain\Command\PutUser;
use Domain\Model\User\User;
use Drift\CommandBus\Bus\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PutUserController
{

    private $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(string $id,Request $request)
    {
        $name = json_decode($request->getContent(),true)['name'];
        $user = new User($id,$name);
        $putUser = new PutUser($user);

        return $this->bus->execute($putUser)
            ->then(
                function () {
                    return new JsonResponse(null, 200);
                }
            );
    }
}
