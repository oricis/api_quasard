<?php

declare(strict_types=1);

namespace App\Service\Repository\Category;

use App\Service\Repository\BaseRepositoryService;
use App\Service\Repository\Common\Traits\CreateTrait;
use Doctrine\DBAL\Connection;

final class CreateCategoryService extends BaseRepositoryService
{
    use CreateTrait;

    private Connection $connection;
    private string $table = 'categories';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}
