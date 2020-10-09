<?php

namespace App\Controller;

use Domain\Command\DeleteUser;
use Domain\Model\User\UserNotFoundException;
use Drift\CommandBus\Bus\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteUserController
{
    private $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param string $id
     *
     * @return mixed
     * @throws \Drift\CommandBus\Exception\InvalidCommandException
     */
    public function __invoke(string $id)
    {
        $deleteUser = new DeleteUser($id);

        return $this->bus->execute($deleteUser)
            ->then(
            function () {
                return new JsonResponse(null, 200);
            }
        )
            ->otherwise(
            function (UserNotFoundException $exception) {
                return new JsonResponse('User not found', 404);
            }
        );
    }
}
