<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\DeliveryService;

class DeliveryController extends Controller
{
    public function __construct(
        protected DeliveryService $delivery,
    ) {}


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
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delivery $delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery $delivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        dd($id);
    }

    public function updateStatus(Request $request) {
        return Delivery::where('id', $request->id)->update(['status' => 0]);
    }

    public function completeDelivery(Request $request) {
        $data = $this->delivery->buildDeliveryData($request);

        // Add new pending delivery based on the next delivery date
        if ($request->status !== 'stop')
            $this->delivery->addDelivery($request->customer_id, $request->schedule_id, $data, $request->price);
    }

    public function fetchData(Request $request) {
        $filterCode = $request->filter['code'] ?? null;

        return DB::table('deliveries as d')
            ->leftJoin('customers as c', 'd.customer_id', 'c.id')
            ->leftJoin('address as a', 'c.id', 'a.customer_id')
            ->leftJoin('delivery_schedules as ds', 'c.id', 'ds.customer_id')
            ->where('d.created_by', auth()->id())
            ->whereNull('d.status')

            ->when($filterCode === 'today', function ($query) {
                $query->whereDate('d.target_date', Carbon::today());
            })
            
            ->when($filterCode === 'tomorrow', function ($query) {
                $query->whereDate('d.target_date', Carbon::tomorrow());
            })

            ->when($filterCode === 'overdue', function ($query) {
                $query->whereDate('d.target_date', '<', Carbon::today());
            })

            ->when($filterCode === 'upcoming', function ($query) {
                $query->whereDate('d.target_date', '>', Carbon::today());
            })

            ->when($filterCode === 'day_after_tomorrow', function ($query) {
                $query->whereDate('d.target_date', Carbon::tomorrow()->addDay());
            })

            ->when($filterCode === 'this_week', function ($query) {
                $query->whereDate('d.target_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })

            ->orderBy('d.target_date', 'asc')
            ->select(
                'd.id',
                'd.customer_id',
                'd.schedule_id',
                'd.target_date',
                'd.next_delivery_date',
                'd.total_qty',
                'd.price',
                'ds.frequency_type',
                'ds.slim_qty',
                'ds.round_qty',
                'c.name',
                DB::raw("CONCAT(a.description, ' ', a.unit_number, ' ', a.street, ' St. Brgy.', a.barangay, ' ', a.municipality, ', ', a.province) as full_address")
            )
            ->get();
    }

    
}