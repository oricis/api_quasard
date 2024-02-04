<?php

declare(strict_types=1);

namespace Service\Common;

use App\Repository\Data\Data;
use App\Service\Common\DaysOffDateTimeService;
use Common\LalalaTrait;
use PHPUnit\Framework\TestCase;

class DaysOffDateTimeServiceTest extends TestCase
{

    public function testNotFoundHandling(): void
    {
        // static get(int $daysOff): string

        $result = DaysOffDateTimeService::get(1);
        $this->assertIsString($result);

        $now = (new \DateTime())
            ->setTimestamp(time())
            ->format(Data::DATE_TIME_FORMAT);
        $this->assertTrue($result < $now);
    }
}
