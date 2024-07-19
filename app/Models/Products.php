<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'qty',
        'created_by',
    ];

    
    public function created_by() {
        return $this->belongsTo(User::class);
    }
}
