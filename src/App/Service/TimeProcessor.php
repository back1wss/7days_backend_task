<?php

declare(strict_types=1);


namespace App\Service;

use App\DTO\TimeProcessDTO;
use App\DTO\TimeRequestDTO;
use DateTime;
use DateTimeZone;

class TimeProcessor
{
    public function process(TimeRequestDTO $timeRequestDTO): TimeProcessDTO
    {
        $date = new DateTime($timeRequestDTO->date, new DateTimeZone($timeRequestDTO->timezone));
        $february = (clone $date)->modify('February 1st');

        $diffInMinutes = $date->getOffset() / 60;

        $month = $date->format('F');
        $monthDays = $date->format('t');
        $monthFeb = $february->format('t');

        return new TimeProcessDTO(
            $timeRequestDTO->date,
            $timeRequestDTO->timezone,
            $diffInMinutes < 0 ? "-$diffInMinutes" : "+$diffInMinutes",
            $month,
            $monthDays,
            $monthFeb
        );
    }
}