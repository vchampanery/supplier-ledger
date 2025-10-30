<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::with('city')->get();
        return view('suppliers.index_new', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('suppliers.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'supplier_name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'credit_days' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        Supplier::create($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $supplier = Supplier::find($id)->first();
        $cities = City::all();
        return view('suppliers.edit', compact('supplier', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'credit_days' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);
        $supplier = Supplier::find($id)->first();
        $supplier->update($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
  
    }
}
