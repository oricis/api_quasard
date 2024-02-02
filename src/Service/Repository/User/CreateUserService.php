<?php

declare(strict_types=1);

namespace App\Service\Repository\User;

use App\Service\Repository\BaseRepositoryService;
use App\Service\Repository\Common\Traits\CreateTrait;
use Doctrine\DBAL\Connection;

final class CreateUserService extends BaseRepositoryService
{
    use CreateTrait;

    private Connection $connection;
    private string $table = 'users';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}
