<?php

declare(strict_types=1);

namespace Test\Service\Repository;

use App\Service\Repository\BaseRepositoryService;
use PHPUnit\Framework\TestCase;

final class FooClass extends BaseRepositoryService
{

    public function prepareQueryBuilderValues(array $data): array
    {
        return parent::prepareQueryBuilderValues($data);
    }
}

class BaseRepositoryServiceTest extends TestCase
{

    public function testPrepareQueryBuilderValues(): void
    {
        // prepareQueryBuilderValues(array $data): array

        $arr = [
            'one' => 'Foo',
            'two' => 'Baz',
        ];
        $result = (new FooClass)
            ->prepareQueryBuilderValues($arr);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(count($arr), $result);

        $expected = [
            'one' => '?',
            'two' => '?',
        ];
        $this->assertEquals($expected, $result);
    }
}
