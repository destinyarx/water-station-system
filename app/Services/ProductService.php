<?php 

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductService 
{

    public function getContainerPrices() {
        $containerPrices = Products::where('created_by', auth()->id())
            ->whereIn('title', ['Slim Container', 'Round Container'])
            ->get();

        $prices = [];
        $index = null;

        foreach ($containerPrices as $price) {
            $index = $price->title === 'Slim Container' ? 'slim_qty' : 'round_qty';
            $prices[$index] =$price->price;
        }

        return $prices;
    }
}