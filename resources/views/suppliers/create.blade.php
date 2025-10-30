@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Supplier</h2>

    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Supplier Name</label>
            <input type="text" name="supplier_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>City</label>
            <select name="city_id" class="form-control select2" required>
                <option value="">Select City</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->city }} ({{ $city->state }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Credit Days</label>
            <input type="number" name="credit_days" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
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