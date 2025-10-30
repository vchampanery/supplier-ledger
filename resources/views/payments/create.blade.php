@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Payment / Debit Note for Bill #{{ $bill->bill_number }}</h1>

    <form action="{{ route('payments.store', $bill->bill_number) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-control form-select" required>
                <option value="">-- Select --</option>
                <option value="payment">Payment</option>
                <option value="debit_note">Debit Note</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Date</label>
            <input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('bills.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
@push('scripts')
<script>
    $(window).on('load', function () {
    $('.select2').select2({
        placeholder: "Select City",
        allowClear: true,
         width: 'resolve' 
    });
});
</script>
@endpush