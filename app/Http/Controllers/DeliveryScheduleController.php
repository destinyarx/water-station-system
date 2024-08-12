<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\DeliverySchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DeliveryScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('DeliverySchedule', [
            'title' => 'Delivery Schedule'
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliverySchedule $deliverySchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliverySchedule $deliverySchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeliverySchedule $deliverySchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliverySchedule $deliverySchedule)
    {
        //
    }

    public function getDeliverySchedule() {
        return DB::table('delivery_schedules as d')
            ->leftJoin('customers as c', 'd.customer_id', 'c.id')
            ->leftJoin('address as a', 'c.id', 'a.customer_id')
            ->where('d.created_by', auth()->id())
            ->whereNull('d.deleted_at')
            ->select(
                'c.name',
                'd.notes',
                'd.frequency_type',
                'd.exact_date',
                'd.created_at',
                'd.slim_qty',
                'd.round_qty',
                'd.total_qty',
                DB::raw("CONCAT(a.description, ' ', a.street, ' ', a.unit_number, ' ', a.barangay, ' ', a.municipality, ' ', a.province) as full_address")
            )->get();
    }
}
