<?php

declare(strict_types=1);

namespace App\Service\Repository\Category;

use App\Service\Repository\BaseRepositoryService;
use App\Service\Repository\Common\Traits\UpdateTrait;
use Doctrine\DBAL\Connection;

final class UpdateCategoryService extends BaseRepositoryService
{
    use UpdateTrait;

    private Connection $connection;
    private string $table = 'categories';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}
