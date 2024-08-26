<?php 

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\DeliverySchedule;
use App\Models\DeliveryHistory;


class DeliveryService
{
    public function addDelivery($customer_id, $schedule_id, $data) {
        $frequencyGap = config('options.frequency_gap');

        $nextDeliveryDate = $data->delivery['frequency']['code'] !== 'O' ? calculate_next_date($data->delivery['delivery_date'], $frequencyGap[$data->delivery['frequency']['code']]) : null;

        return Delivery::create([
            'customer_id' => $customer_id,
            'schedule_id' => $schedule_id,
            'target_date' => $data->delivery['delivery_date'],
            'next_delivery_date' => $nextDeliveryDate,
            'price' => 0, // add total price
            'total_qty' => $data->delivery['round_qty'] + $data->delivery['slim_qty'],
            'created_by' => auth()->id(),
        ]);
    }
}
