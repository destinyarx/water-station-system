<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\DeliverySchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Customer', [
            'data' => [],
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
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function fetchCustomers(Request $request) {
        $filter = json_decode($request->filter);

        return Customer::with(['address' => function($query) {
                $query->select(
                    'customer_id',
                    DB::raw("CONCAT(description, ' ', unit_number, ' ', street, ' St. Brgy.', barangay, ' ', municipality, ', ', province) as full_address")
                );
            }])
            ->with('delivery_schedule')
            ->where('created_by', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function insertCustomer($form) {
        return Customer::create([
            'name' => $form['name'], 
            'cellphone_number' => $form['cellphone_number'], 
            'email' => $form['email'], 
            'messenger_name' => $form['messenger_name'],
            'created_by' => auth()->id()
        ]);
    }

    public function insertAddress($id, $form) {        
        return Address::create([
            'customer_id' => $id, 
            'description' => $form['description'], 
            'unit_number' => $form['unit'], 
            'street' => $form['street'], 
            'barangay' => $form['barangay'], 
            'municipality' => $form['municipality'], 
            'province' => $form['province']           
        ]);
    }

    public function insertDeliverySchedule($id, $form) {
        return DeliverySchedule::create([
            'customer_id' => $id,
            'notes' => $form['remarks'],
            'slim_qty' => $form['slim_qty'],
            'round_qty' => $form['round_qty'],
            'frequency_type' => $form['frequency']['name'],
            'frequency_value' => 'none',
            'created_by' => auth()->id(),
            'exact_date' => $form['delivery_date']
        ]);
    }

    public function addCustomer(Request $request) {
        // DB::beginTransaction();
        
        try {
            $customer = $this->insertCustomer($request->details);
            $this->insertAddress($customer->id, $request->address);

            if ($request->delivery['frequency']['name'])
                $this->insertDeliverySchedule($customer->id, $request->delivery);
            // DB::commit();
        } catch (Exception $e) {
            // DB::rollback();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        return true;
    }
}
