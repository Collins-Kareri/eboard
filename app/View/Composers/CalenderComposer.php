<?php

// namespace App\View\Composers;

// use Carbon\Carbon;
// use Carbon\CarbonImmutable;
// use Illuminate\View\View;

// class CalenderComposer
// {
//     /**
//      * Create a new calender composer.
//      */
//     public function __construct()
//     {
//     }

//     /**
//      * Generate month names
//      */
//     private function monthNames()
//     {
//         $monthNames = [];

//         for ($month = 1; $month <= 12; $month++) {
//             $monthNames[] = Carbon::createFromDate(null, $month, 1)->format("F");
//         }

//         return $monthNames;
//     }

//     /**
//      * Get days names
//      */
//     private function daysInitials()
//     {
//         $daysOfTheWeek = [];
//         $carbonDay = Carbon::parse('Sunday');

//         for ($index = 0; $index < 7; $index++) {
//             $daysOfTheWeek[] = $carbonDay->shortDayName;
//             $carbonDay->addDay();
//         }

//         return $daysOfTheWeek;
//     }

//     /**
//      * Returns month dates formatted to fit to six weeks and a value indicating whether the day is part of the current month
//      * @return [][day_number=>number,day_name=>string,within_month=>boolean]
//      */
//     private function buildMonthDays($startOfMonth, $endOfMonth)
//     {
//         $startOfWeek = $startOfMonth->startOfWeek(Carbon::SUNDAY);

//         $endOfWeek = $startOfWeek->addWeeks(6)->subDay();

//         $dates = $startOfWeek->toPeriod($endOfWeek)->toArray();

//         $results = [];

//         //build the
//         foreach ($dates as $date_instance) {
//             $current_day = [];

//             $current_day['day_number'] = $date_instance->day;

//             $current_day['within_month'] = $date_instance->between($startOfMonth, $endOfMonth);

//             $results[] = $current_day;
//         }

//         return $results;
//     }

//     /**
//      * Build months
//      */
//     private function buildMonths($year=null){
//         $now=Carbon::now();
//         $year = $year ?? $now->year;
//         $monthNames=$this->monthNames();
//         $results=[];

//         for($month=0;$month<12;$month++){
//             $results[$monthNames[$month]]=$this->buildMonth($year,$month);
//         }

//         return $results;
//     }

//     /**
//      *Build month values using the provided year and month values.
//      */
//     private function buildMonth($year, $month)
//     {
//         $now = Carbon::now();

//         $year = $year ?? $now->year;
//         $month = $month ?? $now->month;

//         //get the start & end date of the month based on passed year and month
//         $startOfMonth = CarbonImmutable::create($year, $month);
//         $endOfMonth = $startOfMonth->endOfMonth();
//         $days = static::buildMonthDays($startOfMonth, $endOfMonth);

//         return [
//             'year' => $startOfMonth->year,
//             'month' => $startOfMonth->format('F'),
//             'dates' => $days
//         ];
//     }

//     /**
//      * Bind data to the view
//      */
//     public function compose(View $view): void
//     {
//         $current_month = $this->buildMonth();

//         $view->with('calender', [
//             'year' => $current_month['year'],
//             'month' => $current_month['month'],
//             'dates' => $current_month['dates'],
//             'days_initials' => $this->daysInitials()
//         ]);
//     }
// }
