<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 
        'description', 
        'unit_number', 
        'street', 
        'barangay', 
        'municipality', 
        'province'
    ];

    protected $table = 'address';

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
