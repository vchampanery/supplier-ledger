@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Suppliers</h2>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">Add Supplier</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Supplier Name</th>
                <th>City</th>
                <th>Credit Days</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->id }}</td>
                <td>{{ $supplier->supplier_name }}</td>
                <td>{{ $supplier->city->city}} ({{$supplier->city->state}})</td>
                <td>{{ $supplier->credit_days }}</td>
                <td>
                    <span class="badge {{ $supplier->status ? 'bg-success' : 'bg-danger' }}">
                        {{ $supplier->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $suppliers->links() }}
</div>
@endsection
