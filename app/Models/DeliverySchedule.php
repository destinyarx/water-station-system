<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status',
        'notes',
        'frequency_type',
        'exact_date',
        'slim_qty',
        'round_qty',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at'
    ];

    public function customer() {
        return $this->hasOne(Customer::class);
    }

    public function deliveryHistory() {
        return $this->hasMany(DeliveryHistory::class);
    }
}
