@extends('layouts.app')

@section('title', 'Bill')
@section('page_title', 'Bill Master')

@section('content')
<div class="card">
   <a href="{{ route('bills.create') }}" class="btn btn-primary mb-3">Add Bill</a>
  <div class="card-body">
     <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Bill Number</th>
                      <th>Bill Date</th>
                      <th>Supplier Name</th>
                      <th>City</th>
                      <th>Amount (Rs.)</th>
                      <th>Total Payment</th>
                      <th>Total Debit Note</th>
                      <th>Pending Amount</th>
                      <th>Payment</th>
                      <th>Due date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($bills as $bill)
                      <tr>
                          <td>{{ $bill->bill_number }}</td>
                          <td>{{ $bill->bill_date }}</td>
                          <td>{{ $bill->supplier->supplier_name }}</td>
                          <td>{{ $bill->supplier->city->city}}</td>
                          <td>{{ number_format($bill->amount)}}</td>
                          <td>{{ number_format($bill->totalPayments(),2) }}</td>
                          <td>{{ number_format($bill->totalDebitNotes(),2) }}</td>
                          <td>{{ number_format($bill->pendingAmount(),2) }}</td>
                          <td @if($bill->isDuePast()) class="text-danger" @endif >{{ $bill->due_date}}</td>
                          <td><a href="{{ route('payments.index', $bill->bill_number) }}" class="btn btn-sm btn-info">Payments</a>
</td>
                          <td class="{{ $bill->status()['color'] }}">
                    {{ $bill->status()['label'] }}
                </td>
                          <td>
                              <a href="{{ route('bills.edit', $bill->bill_number) }}" class="btn btn-sm btn-warning">Edit</a>
                              <form action="{{ route('bills.destroy', $bill->bill_number) }}" method="POST" style="display:inline-block">
                                  @csrf @method('DELETE')
                                  <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                              </form>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
                
                </table>
  </div>
</div>

@endsection
@push('scripts')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush