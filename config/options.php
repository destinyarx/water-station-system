<?php 
return [

    'frequency' => [
        ['name' => 'Once', 'code' => 'O'],
        ['name' => 'Daily', 'code' => 'D'],
        ['name' => 'Every other Day', 'code' => 'EOD'],
        ['name' => 'Once a week', 'code' => '1W'],
        ['name' => 'Twice a week', 'code' => '2W'],
        ['name' => 'Three times a week', 'code' => '3W'],
        ['name' => 'Every two weeks', 'code' => '2WK']
    ],

    'frequency_value' => [
        'O' => 'Once',
        'D' => 'Daily',
        'EOD' => 'Every other Day',
        '1W' => 'Once a week',
        '2W' => 'Twice a week',
        '3W' => 'Three times a week',
        '2WK' => 'Every two weeks'
    ],
    
    'frequency_gap' => [
        'D' => 1,      // Daily
        'EOD' => 2,    // Every other Day
        '1W' => 7,     // Once a week
        '2W' => 3,     // Twice a week (assuming a 3-day gap)
        '3W' => 2,     // Three times a week (assuming a 2-day gap)
        '2WK' => 14    // Every two weeks
    ],

    'expense_category' => [
        ['name' => 'Once', 'code' => 'O'],
        ['name' => 'Electric Bill', 'code' => 'electric'],
        ['name' => 'Water Bill', 'code' => 'water'],
        ['name' => 'Manpower', 'code' => 'manpower'],
        ['name' => 'Rent', 'code' => 'rent'],
        ['name' => 'Packaging', 'code' => 'packaging'],
        ['name' => 'Supplies', 'code' => 'supplies'],
        ['name' => 'Maintenance and Repair', 'code' => 'maintenance'],
        ['name' => 'Fuel and Transportation', 'code' => 'transpo'],
        ['name' => 'Licensing and Permits', 'code' => 'permits'],
        ['name' => 'Other', 'code' => 'other']
    ],

    'expense_category_value' => [
        'O' => 'Once',
        'electric' => 'Electric Bill',
        'water' => 'Water Bill',
        'manpower' => 'Manpower',
        'rent' => 'Rent',
        'packaging' => 'Packaging',
        'supplies' => 'Supplies',
        'maintenance' => 'Maintenance and Repair',
        'transpo' => 'Fuel and Transportation',
        'permits' => 'Licensing and Permits',
        'other' => 'Other'
    ],

];
