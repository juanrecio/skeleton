<?php

namespace App\Domain\Model\User;

use Domain\Model\User\User;
use Domain\Model\User\UserNotFoundException;
use Domain\Model\User\UserRepository;
use React\Promise\PromiseInterface;
use function React\Promise\reject;
use function React\Promise\resolve;

class InMemoryUserRepository implements UserRepository
{
    private $users;

    public function __construct()
    {
        $this->users = [];
    }

    /**
     * @param string $id
     *
     * @return PromiseInterface< User, UserNotFoundException >
     */
    public function get(string $id): PromiseInterface
    {
        if (!array_key_exists($id, $this->users))
        {
            return reject(new UserNotFoundException());
        }

        return (resolve($this->users[$id]));
    }

    /**
     * @param string $id
     *
     * @return PromiseInterface< void, UserNotFoundException >
     */
    public function delete(string $id): PromiseInterface
    {
        if (!array_key_exists($id, $this->users))
        {
            return reject(new UserNotFoundException());
        }

        unset($this->users[$id]);

        return (resolve());
    }

    /**
     * @param User $user
     *
     * @return PromiseInterface <void>
     */
    public function put(User $user): PromiseInterface
    {
        $this->users[$user->getId()] = $user;

        return resolve();
    }
}
