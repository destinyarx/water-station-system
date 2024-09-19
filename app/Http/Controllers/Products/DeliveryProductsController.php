<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\DeliveryProducts;
use Illuminate\Http\Request;

class DeliveryProductsController extends Controller
{

    public function update (Request $request) {
        return DeliveryProducts::where('id', $request->id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'qty' => $request->qty,
            ]);
        
    }
    
    public function fetchData() {
        return DeliveryProducts::where('created_by', auth()->id())->get();
    }
}
