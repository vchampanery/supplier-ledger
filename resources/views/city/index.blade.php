@extends('layouts.app')

@section('title', 'City')
@section('page_title', 'City Master')

@section('content')
<div class="card">
  
  <div class="card-body">
     <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Country</th>
                    <th>State </th>
                    <th>city</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                     @foreach($cities as $row)
                      <tr>
                          <td>{{ $row['country'] }}</td>
                          <td>{{ $row['state']}}</td>
                          <td>{{ $row['city'] }}</td>
                      </tr>
                      @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                  </tr>
                  </tfoot>
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