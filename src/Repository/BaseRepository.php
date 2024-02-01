<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class BaseRepository
{
    protected Connection $connection;


    public function __construct()
    {
        $connectionParams = [
            'dbname' => $_ENV['DB_NAME'],
            'driver' => $_ENV['DB_DRIVER'],
            'host'   => $_ENV['DB_HOST'],
            'password' => $_ENV['DB_PASSWORD'],
            'server_version' => $_ENV['DB_SERVER_VERSION'],
            'user'   => $_ENV['DB_USER'],
        ];

        $this->connection
            = DriverManager::getConnection($connectionParams);
    }
}
