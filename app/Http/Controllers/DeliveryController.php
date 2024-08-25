<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Delivery/Delivery');
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
        $frequencyGap = config('options.frequency_gap');

        $nextDeliveryDate = calculate_next_date('22/08/24', $frequencyGap['1W']);
        dd($nextDeliveryDate);

        return Delivery::create([
            'customer_id' => $request->data,
            'schedule_id' => $request->data,
            'target_date' => $request->data,
            'next_delivery_date' => $request->data,
            'price' => $request->data,
            'total_qty' => $request->data,
            'created_by' => auth()->id(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(delivery $delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, delivery $delivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(delivery $delivery)
    {
        //
    }

    
}


