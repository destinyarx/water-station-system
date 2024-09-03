<?php 

use Carbon\Carbon;

function calculate_next_date($startDate, $gap) {
    $date = Carbon::parse($startDate);

    $nextDate = $date->addDays($gap);

    // If nextDate is schedule next month
    if ($date->day > $nextDate->day && $date->month !== $nextDate->month) {
        $nextDate->day = $nextDate->daysInMonth;
    }

    return $nextDate;
}
