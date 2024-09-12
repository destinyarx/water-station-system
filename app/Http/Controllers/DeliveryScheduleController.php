<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\DeliverySchedule;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\ProductService;


class DeliveryScheduleController extends Controller
{
    public function __construct(
        protected ProductService $product,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = $this->product->getContainerPrices();

        return Inertia::render('Delivery/DeliverySchedule', [
            'title' => 'Delivery Schedule',
            'frequency' => config('options.frequency'),
            'frequency_value' => config('options.frequency_value'),
            'prices' => $prices
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
    public function update(Request $request)
    {
        return DeliverySchedule::where('id', $request->id)
            ->update([
                'frequency_type' => $request->frequency['code'],
                'slim_qty' => $request->slim_qty,
                'round_qty' => $request->round_qty,
                'notes' => $request->remarks,
                'exact_date' => $request->delivery_date,
                'updated_at' => now(),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return DeliverySchedule::where('id', $request->id)
            ->update(['deleted_at' => now()]);
    }

    public function getDeliverySchedule() {
        return DB::table('delivery_schedules as d')
            ->leftJoin('customers as c', 'd.customer_id', 'c.id')
            ->leftJoin('address as a', 'c.id', 'a.customer_id')
            ->where('d.created_by', auth()->id())
            ->whereNull('d.deleted_at')
            ->select(
                'c.name',
                'd.id',
                'd.notes',
                'd.frequency_type',
                'd.exact_date',
                'd.created_at',
                'd.slim_qty',
                'd.round_qty',
                DB::raw("CONCAT(a.description, ' ', a.unit_number, ' ', a.street, ' St. Brgy.', a.barangay, ' ', a.municipality, ', ', a.province) as full_address")
            )
            ->orderBy('d.created_at', 'desc')
            ->paginate(10);
    }
}
