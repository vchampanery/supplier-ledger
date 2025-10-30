@extends('layouts.app')
@section('title', 'Payment')
@section('page_title', '')
@section('content')
<div class="card">
  <div class="card-header">Payments / Debit Notes for Bill <b>#{{ $bill->bill_number }}</b></div>
   <a href="{{ route('payments.create', $bill->bill_number) }}" class="btn btn-primary mb-3">Add Payment / Debit Note</a>

  <div class="card-body">
     <table id="example1" class="table table-bordered table-striped">
                   <thead>
            <tr>
                <th>Type</th>
                <th>Amount</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bill->payments as $payment)
                <tr>
                    <td>{{ ucfirst($payment->type) }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->payment_date }}</td>
                </tr>
            @endforeach
        </tbody>
                
                </table>
  </div>
</div>

@endsection
@push('scripts')
<script>
  $(function() {
     $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>
@endpush
