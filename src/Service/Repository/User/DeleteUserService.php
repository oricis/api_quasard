<?php

declare(strict_types=1);

namespace App\Service\Repository\User;

use App\Service\Repository\BaseRepositoryService;
use App\Service\Repository\Common\Traits\DeleteTrait;
use Doctrine\DBAL\Connection;

final class DeleteUserService extends BaseRepositoryService
{
    use DeleteTrait;

    private Connection $connection;
    private string $table = 'users';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}
