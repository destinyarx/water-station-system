<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\DeliveryHistory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DeliveryHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Delivery/DeliveryHistory');
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
        return DeliveryHistory::create([
                'customer_id' => $request->customer_id,
                'schedule_id' => $request->schedule_id,
                'status' => $request->status,
                'notes' =>  null, //$request->notes,
                'created_by' => auth()->id(),    
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryHistory $deliveryHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliveryHistory $deliveryHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeliveryHistory $deliveryHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryHistory $deliveryHistory)
    {
        //
    }

    public function fetchData(Request $request) {
        $filterStatus = $request->filterStatus['code'] ?? null;

        return DB::table('delivery_history as dh')
            ->leftJoin('customers as c', 'dh.customer_id', 'c.id')
            ->leftJoin('address as a', 'dh.customer_id', 'a.customer_id')
            ->leftJoin('users as u', 'dh.created_by', 'u.id')
            ->where('dh.created_by', auth()->id())
            ->when($filterStatus, function($query) use ($filterStatus) {
                $query->where('dh.status', $filterStatus);
            })
            ->select(
                'c.name',
                'u.name as created_by_name',
                'dh.status',
                'dh.notes',
                'dh.created_at',
                DB::raw("CONCAT(a.description, ' ', a.unit_number, ' ', a.street, ' St. Brgy.', a.barangay, ' ', a.municipality, ', ', a.province) as full_address")
            )
            ->get();

    }
}
