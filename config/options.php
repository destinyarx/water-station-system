<?php 
return [

    'frequency' => [
        ['name' => 'Once', 'code' => 'O'],
        ['name' => 'Daily', 'code' => 'D'],
        ['name' => 'Every other Day', 'code' => 'EOD'],
        ['name' => 'Once a week', 'code' => '1W'],
        ['name' => 'Twice a week', 'code' => '2W'],
        ['name' => 'Three times a week', 'code' => '3W'],
        ['name' => 'Weekly (once a week)', 'code' => 'W1'],
        ['name' => 'Every two weeks', 'code' => '2Wk'],
    ],

    'frequency_value' => [
        'O' => 'Once',
        'EOD' => 'Every other Day',
    ],
    
    'frequency_gap' => [
        'D' => 1,      // Daily
        'EOD' => 2,    // Every other Day
        '1W' => 7,     // Once a week
        '2W' => 3,     // Twice a week (assuming a 3-day gap)
        '3W' => 2,     // Three times a week (assuming a 2-day gap)
        'W1' => 7,     // Weekly (once a week)
        '2Wk' => 14,   // Every two weeks
    ],

];
