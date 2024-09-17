<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryProducts extends Model
{
    use HasFactory;
    
    protected $table = 'delivery_products';

    protected $fillable = [
        'title',
        'description',
        'product_code',
        'price',
        'qty',
        'created_by',
    ];
}
