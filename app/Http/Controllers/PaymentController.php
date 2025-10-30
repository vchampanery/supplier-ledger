<?php
namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function create($bill_number)
    {
        $bill = Bill::with('supplier')->findOrFail($bill_number);
        return view('payments.create', compact('bill'));
    }

    public function store(Request $request, $bill_number)
    {
        $bill = Bill::findOrFail($bill_number);

        $validated = $request->validate([
            'type' => 'required|in:payment,debit_note',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        $validated['bill_number'] = $bill_number;

        Payment::create($validated);

        return redirect()->route('bills.index')->with('success', 'Payment added successfully.');
    }

    public function index($bill_number)
    {
        $bill = Bill::with('payments')->findOrFail($bill_number);
        return view('payments.index', compact('bill'));
    }
}
