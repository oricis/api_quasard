<?php

declare(strict_types=1);

namespace Test\Service\Repository\User\Query;

use App\Service\Repository\User\Query\SelectUserNotesQueryService;
use PHPUnit\Framework\TestCase;
class SelectUserNotesQueryServiceTest extends TestCase
{

    public function testCompose(): void
    {
        // static compose(
        //     int $id,
        //     bool $onlyAlive = true,
        //     string $attributes = '*'
        // ): string

        $result = SelectUserNotesQueryService::compose(1);
        $this->assertIsString($result);
        $this->assertNotEmpty($result);

        $expected = 'SELECT * FROM notes
                WHERE user_id IN (
                    SELECT id FROM users
                        WHERE id = 1
                        AND deleted_at IS NULL
                ) AND deleted_at IS NULL';
        $this->assertEquals($expected, $result);


        $result = SelectUserNotesQueryService::compose(1, false);
        $this->assertIsString($result);
        $this->assertNotEmpty($result);

        $expected = 'SELECT * FROM notes
            WHERE user_id = 1';
        $this->assertEquals($expected, $result);

        $attributes = 'id, name';
        $result = SelectUserNotesQueryService::compose(1, false, $attributes);
        $this->assertIsString($result);
        $this->assertNotEmpty($result);

        $expected = 'SELECT id, name FROM notes
            WHERE user_id = 1';
        $this->assertEquals($expected, $result);
    }
}
