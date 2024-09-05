<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Sales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    
    public function index()
    {
        return Inertia::render('Sales/Summary');
    }

    /**
     * Display a listing of the resource.
     */
    public function history()
    {
        return Inertia::render('Sales/History');
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
        return Sales::create([
            'customer_id' => $request->customer_id,
            'deliver_history_id' => $request->deliver_history_id,
            'qty' => $request->quantity,
            'total' => $request->totalPrice,
            'created_by' => auth()->id(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales)
    {
        //
    }

    public function fetchData() {
        return DB::table('sales as s')
            ->LeftJoin('customers as c', 's.customer_id', 'c.id')
            ->LeftJoin('delivery_history as dh', 's.deliver_history_id', 'dh.id')
            ->select(
                'c.name',
                's.qty',
                's.total',
                'dh.created_at',
            )
            ->get();
    }
}
