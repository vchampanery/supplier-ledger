@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Supplier</h2>

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Supplier Name</label>
            <input type="text" name="supplier_name" class="form-control" value="{{ $supplier->supplier_name }}" required>
        </div>

        <div class="mb-3">
            <label>City</label>
            <select name="city_id" class="form-control" required>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ $supplier->city_id == $city->id ? 'selected' : '' }}>
                        {{ $city->city }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Credit Days</label>
            <input type="number" name="credit_days" class="form-control" value="{{ $supplier->credit_days }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ $supplier->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$supplier->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
