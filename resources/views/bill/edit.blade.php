@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Bill</h2>

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
            <input type="date" name="bill_date" id="bill_date" class="form-control" value="{{ $bill->bill_date }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Due Date</label>
            <input type="date"  name="due_date" id="due_date" class="form-control" value="{{ $bill->due_date }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Update Bill</button>
        <a href="{{ route('bills.index') }}" class="btn btn-secondary">Cancel</a>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
@push('scripts')
<script>
     const suppliers = @json($suppliers); // suppliers with credit_days
        const supplierSelect = document.querySelector('select[name="supplier_id"]');
        const billDateInput = document.getElementById('bill_date');
        const dueDateInput = document.getElementById('due_date');

        function calculateDueDate() {
            const supplierId = supplierSelect.value;
            const supplier = suppliers.find(s => s.id == supplierId);
            const creditDays = supplier ? supplier.credit_days : 0;
            const billDate = new Date(billDateInput.value);
            if (billDate) {
                billDate.setDate(billDate.getDate() + creditDays);
                dueDateInput.value = billDate.toISOString().split('T')[0];
            }
        }

    supplierSelect.addEventListener('change', calculateDueDate);
    billDateInput.addEventListener('change', calculateDueDate);
    $(window).on('load', function () {
    $('.select2').select2({
        placeholder: "Select Supplier",
        allowClear: true,
         width: 'resolve' 
    });
});
</script>
@endpush