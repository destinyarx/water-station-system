<?php 

use Carbon\Carbon;

function calculate_next_date($startDate, $gap) {
    // Convert 2-digit year to 4-digit year format
    $startDate = Carbon::createFromFormat('d/m/y', $startDate)->format('d/m/Y');
    
    // Parse the start date with a 4-digit year
    $date = Carbon::createFromFormat('d/m/Y', $startDate);

    // Add the gap in days
    $nextDate = $date->addDays($gap);

    // Return the formatted next date
    return $nextDate->format('d/m/Y');
}
?>