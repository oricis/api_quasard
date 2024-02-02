<?php

declare(strict_types=1);

namespace App\Service\Repository\User;

use App\Service\Repository\BaseRepositoryService;
use App\Service\Repository\Common\Traits\UpdateTrait;
use Doctrine\DBAL\Connection;

final class UpdateUserService extends BaseRepositoryService
{
    use UpdateTrait;

    private Connection $connection;
    private string $table = 'users';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}
