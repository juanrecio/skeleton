<?php

namespace App\Controller;

use Domain\Model\User\User;
use Domain\Model\User\UserNotFoundException;
use Domain\Query\GetUser;
use Drift\CommandBus\Bus\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUserController
{
    private $bus;

    public function __construct(QueryBus $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(string $id)
    {
        $getUser = new GetUser($id);

        return $this->bus->ask($getUser)->then(
            function (User $user) {
                return new JsonResponse(['id' => $user->getId()], 200);
            }
        )->otherwise(
            function (UserNotFoundException $exception) {
                return new JsonResponse('User not found', 404);
            }
        );
    }
}
