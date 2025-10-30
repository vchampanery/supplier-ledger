<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BillController extends Controller
{
    public function index()
    {
  


        $bills = Bill::with(['supplier','payments'])->latest()->get();
         $today = Carbon::today();
        // return inertia('Bills/Index', compact('bills'));
          return view('bill.index', compact('bills','today'));
    }

    public function create()
    {
        $nextBillNo = (Bill::max('bill_number') ?? 0) + 1;

        $suppliers = Supplier::with('city')->get();
        // $cities = City::all();
        return view('bill.create', compact('suppliers', 'nextBillNo'));
        // return inertia('Bills/Create', compact('suppliers'));
    }

    public function store(Request $request)
    {
         $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric|min:0',
            'bill_date' => 'required|date',
        ]);
        // Get supplier credit days
        $supplier = Supplier::find($validated['supplier_id']);
        $creditDays = $supplier->credit_days ?? 0;
        

        // Calculate due date
        $validated['due_date'] = Carbon::parse($validated['bill_date'])->addDays($creditDays)->toDateString();

        // bill_number auto increments in DB
        $bill = Bill::create($validated);

        return redirect()->route('bills.index')->with('success', 'Bill created successfully.');
    }

    public function edit(string $id)
    {
        $bill = Bill::where('bill_number',$id)->first();
        $suppliers = Supplier::with('city')->get();
        return view('bill.edit', compact('bill', 'suppliers'));
    }

    public function update(Request $request, Bill $bill)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric|min:0',
            'bill_date' => 'required|date',
            'due_date' => 'required|date',
        ]);
        // dd($validated);
        
        $bill->update($validated);

        return redirect()->route('bills.index')->with('success', 'Bill updated successfully.');
    }
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('bills.index')->with('success', 'Bill deleted successfully.');
    }
}
