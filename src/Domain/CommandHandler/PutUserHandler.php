<?php

namespace Domain\CommandHandler;

use Domain\Command\PutUser;
use Domain\Event\UserWasPut;
use Domain\Model\User\UserRepository;
use Drift\EventBus\Bus\EventBus;

class PutUserHandler
{
    private $userRepository;

    private $eventBus;

    public function __construct(UserRepository $userRepository, EventBus $eventBus)
    {
        $this->userRepository = $userRepository;
        $this->eventBus = $eventBus;
    }

    public function handle(PutUser $putUser)
    {
        $user = $putUser->getUser();
        return $this
            ->userRepository
            ->put($user)
            ->then(function () use ($user){
                return $this->eventBus->dispatch(new UserWasPut($user));
            });
    }
}
