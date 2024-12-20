<?php

namespace App\Http\Controllers;

use App\Models\SaleProducts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleProductsController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        dd($request->products);
    }

    public function show(SaleProducts $saleProducts)
    {
        //
    }

    public function update(Request $request, SaleProducts $saleProducts)
    {
        //
    }

    public function destroy(SaleProducts $saleProducts)
    {
        
    }
}
