<?php

declare(strict_types=1);


namespace App\DTO;

class TimeProcessDTO
{
    public string $date;
    public string $timezone;
    public string $diffMinutes;
    public string $currentMonth;
    public string $currentMonthDays;
    public string $februaryDays;

    /**
     * @param string $date
     * @param string $timezone
     * @param string $diffMinutes
     * @param string $currentMonth
     * @param string $currentMonthDays
     * @param string $februaryDays
     */
    public function __construct(string $date, string $timezone, string $diffMinutes, string $currentMonth, string $currentMonthDays, string $februaryDays)
    {
        $this->date = $date;
        $this->timezone = $timezone;
        $this->diffMinutes = $diffMinutes;
        $this->currentMonth = $currentMonth;
        $this->currentMonthDays = $currentMonthDays;
        $this->februaryDays = $februaryDays;
    }


}