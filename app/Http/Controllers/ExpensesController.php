<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Expenses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Expenses/Summary');
    }

    public function history()
    {
        return Inertia::render('Expenses/Expenses');
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
        return Expenses::create([
            'category' => $request->category['code'],
            'expense_date' => $request->expense_date,
            'description' => $request->description,
            'price' => $request->price,
            'created_by' => auth()->id(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(expenses $expenses)
    {
        //
    }

    public function fetchData() {

    }
}
