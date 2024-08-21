<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cellphone_number',
        'email',
        'messenger_name',
    ];

    public function address() {
        return $this->hasOne(Address::class);
    }

    public function delivery_schedule() {
        return $this->hasOne(DeliverySchedule::class);
    }

    public function sales() {
        return $this->hasMany(Sales::class);
    }

    public function delivery_history() {
        return $this->hasMany(DeliverySchedule::class);
    }
}
