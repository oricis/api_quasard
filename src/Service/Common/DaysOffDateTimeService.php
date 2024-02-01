<?php

declare(strict_types=1);

namespace App\Service\Common;

use App\Repository\Data\Data;

final class DaysOffDateTimeService
{

    public static function get(int $daysOff): string
    {
        $timestamp = time() - $daysOff * 24 * 60 * 60 * 1000;
        $date = new \DateTime();
        $date->setTimestamp($timestamp);

        return $date->format(Data::DATE_TIME_FORMAT);
    }
}
