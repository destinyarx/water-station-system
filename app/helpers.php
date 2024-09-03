<?php 

use Carbon\Carbon;

function calculate_next_date($startDate, $gap) {
    $date = Carbon::parse($startDate);

    $nextDate = $date->addDays($gap);

    // Handle month-end issues by adjusting the day to the last day of the month if necessary
    if ($date->day > $nextDate->day && $date->month !== $nextDate->month) {
        $nextDate->day = $nextDate->daysInMonth;
    }

    return $nextDate;
}
