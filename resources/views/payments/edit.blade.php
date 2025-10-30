@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Supplier</h2>

    <form action="{{ route('bills.update', $bill->bill_number) }}" method="POST">
        @csrf @method('PUT')
         <div class="mb-3">
            <label class="form-label">Bill Number</label>
            <input type="text" class="form-control" value="{{ $bill->bill_number }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Supplier</label>
            <select name="supplier_id" class=" form-control form-select select2" required>
                <option value="">-- Select Supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $bill->supplier_id == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->supplier_name }} ({{ $supplier->city->city ?? 'N/A' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $bill->amount }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Bill Date</label>
            <input type="date" name="bill_date" class="form-control" value="{{ $bill->bill_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Bill</button>
        <a href="{{ route('bills.index') }}" class="btn btn-secondary">Cancel</a>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
