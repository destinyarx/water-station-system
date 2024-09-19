<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\DeliveryProducts;
use Illuminate\Http\Request;

class DeliveryProductsController extends Controller
{
    public function fetchData() {
        return DeliveryProducts::where('created_by', auth()->id())->get();
    }
}
