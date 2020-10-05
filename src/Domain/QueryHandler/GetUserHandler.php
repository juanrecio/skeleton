<?php

namespace Domain\QueryHandler;

use Domain\Model\User\UserRepository;
use Domain\Query\GetUser;

class GetUserHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(GetUser $getUser)
    {
        return $this->userRepository->get($getUser->getId());
    }
}
