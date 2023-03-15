<?php

namespace App\View\Composers;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\View\View;

class CalenderComposer
{
    /**
     * Create a new calender composer.
     */
    public function __construct()
    {
    }

    /**
     * Returns month dates formatted to fit to six weeks and a value indicating whether the day is part of the current month
     * @return [][day_number=>number,day_name=>string,within_month=>boolean]
     */
    private static function buildMonthDays($startOfMonth, $endOfMonth)
    {
        // $now = Carbon::now();
        //get start and end of week so that we can get the date values as multiples of 7
        $startOfWeek = $startOfMonth->startOfWeek(Carbon::SUNDAY);
        $endOfWeek = $startOfWeek->addWeeks(6)->subDay();

        // print_r($startOfWeek->toPeriod($endOfWeek)->toArray());
        $dates = $startOfWeek->toPeriod($endOfWeek)->toArray();

        $results = [];

        //build the
        foreach ($dates as $date_instance) {
            $current_day = [];

            $current_day['day_number'] = $date_instance->day;
            $current_day['day_name'] = $date_instance->dayName;
            $current_day['within_month'] = $date_instance->between($startOfMonth, $endOfMonth);
            $current_day['is_today'] = $date_instance->isToday();


            $results[] = $current_day;
        }

        return $results;
    }

    /**
     *Build month values using the provided year and month values.
     *If no year or month value is provided it uses current year or month as the default.
     */
    private static function buildMonth($year = null, $month = null)
    {
        $now = Carbon::now();

        $year = $year ?? $now->year;
        $month = $month ?? $now->month;

        //get the start & end date of the month based on passed year and month
        $startOfMonth = CarbonImmutable::create($year, $month);
        $endOfMonth = $startOfMonth->endOfMonth();
        $days = static::buildMonthDays($startOfMonth, $endOfMonth);

        return [
            'year' => $startOfMonth->year,
            'month' => $startOfMonth->format('F'),
            'dates' => $days
        ];
    }

    /**
     * Get days initials
     */
    private static function daysInitials()
    {
        $daysOfTheWeek = [];
        $carbonDay = Carbon::parse('Sunday');

        for ($index = 0; $index < 7; $index++) {
            $daysOfTheWeek[] = $carbonDay->shortDayName;
            $carbonDay->addDay();
        }

        return $daysOfTheWeek;
    }

    /**
     * Bind data to the view
     */
    public function compose(View $view): void
    {
        $current_month = $this->buildMonth();

        $view->with('calender', [
            'year' => $current_month['year'],
            'month' => $current_month['month'],
            'dates' => $current_month['dates'],
            'days_initials' => $this->daysInitials()
        ]);
    }
}
