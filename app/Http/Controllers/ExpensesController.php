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
        return Inertia::render('Expenses/Summary', 
            [
                'expenseCategory' => config('options.expense_category'),
                'expenseCategoryValue' => config('options.expense_category_value')
            ]
        );
    }

    public function history()
    {
        return Inertia::render('Expenses/Expenses',
            [
                'expenseCategory' => config('options.expense_category'),
                'expenseCategoryValue' => config('options.expense_category_value')
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

    public function fetchData(Request $request) {
        $filter = $request->filter['code'] ?? null;

        return Expenses::where('created_by', auth()->id())
            ->whereNull('deleted_at')
            ->when($filter, function($query) use ($filter) {
                $query->where('category', $filter);
            })
            ->select('*')
            ->paginate(10);

    }
}
