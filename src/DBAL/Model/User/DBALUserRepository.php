<?php

namespace DBAL\Model\User;

use Domain\Model\User\User;
use Domain\Model\User\UserNotFoundException;
use Domain\Model\User\UserRepository;
use Drift\DBAL\Connection;
use Drift\DBAL\Result;
use React\Promise\PromiseInterface;

class DBALUserRepository implements UserRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $id
     *
     * @return PromiseInterface< User, UserNotFoundException >
     */
    public function get(string $id): PromiseInterface
    {
        return $this
            ->connection
            ->findOneBy('users', ['id' => $id])
            ->then(
                function ($userAsArray) {
                    if (empty($userAsArray))
                    {
                        throw new UserNotFoundException();
                    }

                    return new User($userAsArray['id'], $userAsArray['name']);
                }
            );
    }

    /**
     * @param string $id
     *
     * @return PromiseInterface< void, UserNotFoundException >
     */
    public function delete(string $id): PromiseInterface
    {
        return $this
            ->connection
            ->delete('users',['id'=>$id])
            ->then(
                function (Result $result){
                    if ($result->getAffectedRows() !== 1){
                        throw new UserNotFoundException();
                    }
                }
            );
    }

    /**
     * @param User $user
     *
     * @return PromiseInterface <void>
     */
    public function put(User $user): PromiseInterface
    {
        return $this
            ->connection
            ->upsert('users',
                ['id'=>$user->getId()],['name'=>$user->getName()]);
    }
}
