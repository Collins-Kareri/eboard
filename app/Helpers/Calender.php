<?php

namespace App\Helpers;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class Calender
{
    /**
     * Add time period to start time to get end date
     */
    public static function endDate(Carbon $startTime, string $timePeriod)
    {
        preg_match('/^(\d+)\s+(.*)$/', $timePeriod, $matches);

        list($_, $number, $unit)=$matches;
        $startTime=Carbon::createFromTimestampUTC($startTime);

        switch(Str::lower($unit)) {
            case 'day':
                return $startTime->addDays($number)->utc();
            case 'week':
                return $startTime->addWeeks($number)->utc();
            case 'month':
                return $startTime->addMonths($number)->utc();
            case 'year':
                return $startTime->addYears($number)->utc();
        }
    }

    /**
     * Generate month names
     */
    public static function monthNames()
    {
        $monthNames = [];

        if (Cache::has("month_names")) {
            return Cache::get("month_names");
        }

        for ($month = 1; $month <= 12; $month++) {
            $monthNames[] = Carbon::createFromDate(null, $month, 1)->format("F");
        }

        Cache::put("month_names", $monthNames);

        return $monthNames;
    }

    /**
     * Get days names
     */
    public static function dayAbbreviations()
    {
        $daysOfTheWeek = [];
        $carbonDay = Carbon::parse('Sunday');

        if (Cache::has("day_abbreviations")) {
            return Cache::get("day_abbreviations");
        }

        for ($index = 0; $index < 7; $index++) {
            $daysOfTheWeek[] = $carbonDay->shortDayName;
            $carbonDay->addDay();
        }

        Cache::put("day_abbreviations", $daysOfTheWeek);

        return $daysOfTheWeek;
    }

    /**
     * Returns month dates formatted to fit to six weeks and a value indicating whether the day is part of the current month
     * @return [][day_number=>number,day_name=>string,within_month=>boolean]
     */
    private static function buildMonthDays($startOfMonth, $endOfMonth)
    {
        $startOfWeek = $startOfMonth->startOfWeek(Carbon::SUNDAY);

        $endOfWeek = $startOfWeek->addWeeks(6)->subDay();

        $dates = $startOfWeek->toPeriod($endOfWeek)->toArray();

        $results = [];

        //build the
        foreach ($dates as $date_instance) {
            $current_day = [];

            $current_day['day_number'] = $date_instance->day;

            $current_day['within_month'] = $date_instance->between($startOfMonth, $endOfMonth);

            $results[] = $current_day;
        }

        return $results;
    }

    /**
     * Build months
     */
    public static function buildMonths($year = null)
    {
        $now = Carbon::now();
        $year = $year ?? $now->year;
        $monthNames = static::monthNames();
        $results = [];

        for ($month = 0; $month < 12; $month++) {
            $results[$monthNames[$month]] = static::buildMonth($year, $month+1);
        }

        return $results;
    }

    /**
     *Build month values using the provided year and month values.
     *The month value should not be zero indexed
     */
    private static function buildMonth($year, $month)
    {
        $now = Carbon::now();

        $year = $year ?? $now->year;
        $month = $month ?? $now->month;

        //get the start & end date of the month based on passed year and month
        $startOfMonth = CarbonImmutable::create($year, $month);

        $endOfMonth = $startOfMonth->endOfMonth();

        // if($month==4) {
        //     dd("{$startOfMonth} {$endOfMonth}");
        // }


        $days = static::buildMonthDays($startOfMonth, $endOfMonth);

        return [
            'dates' => $days
        ];
    }
}
