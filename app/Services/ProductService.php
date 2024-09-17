<?php 

namespace App\Services;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\DeliveryProducts;

class ProductService 
{

    public function getContainerPrices() {
        $containerPrices = DeliveryProducts::where('created_by', auth()->id())
            ->whereIn('product_code', ['slim_container', 'round_container'])
            ->get();

        $prices = [];
        $index = null;

        foreach ($containerPrices as $price) {
            $index = $price->product_code === 'slim_container' ? 'slim_qty' : 'round_qty';
            $prices[$index] =$price->price;
        }

        return $prices;
    }
}