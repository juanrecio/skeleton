<?php

namespace Tests\DBAL\Model\User;

use DBAL\Model\User\DBALUserRepository;
use Doctrine\DBAL\Platforms\SqlitePlatform;
use Domain\Model\User\UserRepository;
use Drift\DBAL\Connection;
use Drift\DBAL\Credentials;
use Drift\DBAL\Driver\SQLite\SQLiteDriver;
use React\EventLoop\LoopInterface;
use Tests\Domain\Model\User\UserRepositoryTest;

class DBALUserRepositoryTest extends UserRepositoryTest
{

    protected function getEmptyRepository(LoopInterface $loop): UserRepository
    {
        $dbalPlatform = new SqlitePlatform();
        $dbalDriver = new SQLiteDriver($loop);
        $credentials = new Credentials('','','root','root',':memory:');

        $connection = Connection::createConnected($dbalDriver,$credentials,$dbalPlatform);

        $connection->createTable('users',['id'=>'string','name'=>'string']);
        return new DBALUserRepository($connection);
    }
}
