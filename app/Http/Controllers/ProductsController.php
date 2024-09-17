<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\DeliveryProducts;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Products');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Products::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'qty' => $request->qty,
            'created_by' => auth()->id(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        // dd((int) $request->id);
        return Products::where('id', (int) $request->id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'qty' => $request->qty,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }

    public function fetchProducts(Request $request) {
        $filter = json_decode($request->filter);
        // dd($filter->status);

        return Products::with('created_by')->orderBy('created_at', 'desc')->get();
    }

    public function getContainerPrices() {

        return DeliveryProducts::where('created_by', auth()->id())
            ->whereIn('title', ['Slim Container', 'Round Container'])
            ->get();
    }
}
