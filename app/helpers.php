<?php 

use Carbon\Carbon;

function calculate_next_date($startDate, $gap) {
    // Parse the start date from ISO 8601 format
    $date = Carbon::parse($startDate);
    
    // Add the gap in days
    $nextDate = $date->addDays($gap);

    // Return the formatted next date (as d/m/Y)
    return $nextDate->toISOString();
}
