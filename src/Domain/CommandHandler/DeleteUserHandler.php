<?php

namespace Domain\CommandHandler;

use Domain\Model\User\UserRepository;
use Domain\Command\DeleteUser;

class DeleteUserHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(DeleteUser $deleteUser)
    {
        return $this->userRepository->delete($deleteUser->getId());
    }
}
