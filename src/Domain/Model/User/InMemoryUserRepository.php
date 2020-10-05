<?php

namespace App\Domain\Model\User;

use Domain\Model\User\User;
use Domain\Model\User\UserNotFoundException;
use Domain\Model\User\UserRepository;
use React\Promise\PromiseInterface;

class InMemoryUserRepository implements UserRepository
{
    /**
     * @param string $id
     *
     * @return PromiseInterface< User, UserNotFoundException >
     */
    public function get(string $id): PromiseInterface
    {
        // TODO: Implement get() method.
    }

    /**
     * @param string $id
     *
     * @return PromiseInterface< void, UserNotFoundException >
     */
    public function delete(string $id): PromiseInterface
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param User $user
     *
     * @return PromiseInterface <void>
     */
    public function put(User $user): PromiseInterface
    {
        // TODO: Implement put() method.
    }
}
