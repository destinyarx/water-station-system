<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryHistory extends Model
{
    use HasFactory;

    protected $table = 'delivery_history';

    protected $fillable = [
        'customer_id',
        'schedule_id',
        'status',
        'notes',
        'created_by'
    ];

    public function deliverySchedule() {
        return $this->hasOne(DeliverySchedule::class);
    }
}
