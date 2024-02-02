<?php

declare(strict_types=1);

namespace App\Service\Repository\Note;

use App\Service\Repository\BaseRepositoryService;
use App\Service\Repository\Common\Traits\DeleteTrait;
use Doctrine\DBAL\Connection;

final class DeleteNoteService extends BaseRepositoryService
{
    use DeleteTrait;

    private Connection $connection;
    private string $table = 'notes';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}
