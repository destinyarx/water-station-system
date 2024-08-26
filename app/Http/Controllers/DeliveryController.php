<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Delivery/Delivery',
            [
                'frequency' => config('options.frequency'),
                'frequency_value' => config('options.frequency_value')
            ]
        );
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

    public function fetchData() {
        return DB::table('deliveries as d')
            ->where('d.created_by', auth()->id())
            ->leftJoin('customers as c', 'd.customer_id', 'c.id')
            ->leftJoin('address as a', 'c.id', 'd.customer_id')
            ->whereNull('d.status')
            ->orderBy('d.created_at', 'asc')
            ->select(
                'd.target_date',
                'd.next_delivery_date',
                'd.total_qty',
                'd.price',
                'c.name',
                DB::raw("CONCAT(a.description, ' ', a.unit_number, ' ', a.street, ' St. Brgy.', a.barangay, ' ', a.municipality, ', ', a.province) as full_address")
            )
            ->get();
    }

    
}


