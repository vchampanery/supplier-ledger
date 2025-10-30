@extends('layouts.app')

@section('title', 'Home')
@section('page_title', '')

@section('content')
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ number_format($overdueAmount) }}</h3>

        <p>{{ __('messages.overdue_amount') }}</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ number_format($currentMonthAmount) }}</h3>

        <p>{{ __('messages.current_month_amount') }}</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ number_format($comingMonthAmount) }}</h3>

        <p>{{ __('messages.coming_month_amount') }}</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ number_format($totalAmount) }}</h3>

        <p>{{ __('messages.total_pending_amount') }}</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
<!-- <h5 class="mb-2 mt-4">Small Box</h5> -->
<div class="row">
  <div class="col-lg-6 col-6">
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Total Pending Amount</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
  <div class="col-lg-6 col-6">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Over Due Amount</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</div>

 <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
             <div class="card">
              <div class="card-header border-0">
               
              </div>
              <div class="card-body table-responsive p-0">
                 <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>City</th>
                    <th>OverDue Total</th>
                    <th>Current Month Due</th>
                    <th>Comming Month Due</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ( $cityWise as $overduebycity )
                      <tr>
                        <td>
                          <!-- <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2"> -->
                          {{ $overduebycity->city }}
                        </td>
                        <td>{{ number_format($overduebycity->overdue_total)}}</td>
                        <td>
                          
                          {{ number_format($overduebycity->current_month_due)}}
                        </td>
                        <td>
                          {{ number_format($overduebycity->next_month_due)}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
 </div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-labels@1.1.0/dist/chartjs-plugin-labels.min.js"></script>

<script>
  
  $(function() {
     $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    var donutData = {
      labels: @json($donutLabels),
      datasets: [{
        data: @json($donutData),
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
      }]
    }
    var areaChartData = {
      labels: @json($areaLabels),
      datasets: [{
          label: 'Over Dues',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: @json($areaData1)
        }
      
      ]
    }
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = donutData;
   var pieOptions = {
  maintainAspectRatio: false,
  responsive: true,
  legend: {
    display: true
  },
  plugins: {
    labels: {
      render: 'label',       // 👈 show label text
      position: 'inside',    // inside slice
      fontColor: '#fff',     // white text
      fontStyle: 'bold',
      fontSize: 12
    }
  }
};

new Chart(pieChartCanvas, {
  type: 'pie',
  data: pieData,
  options: pieOptions
});

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    
    barChartData.datasets[0] = temp0

    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false,
       scales: {
             yAxes: [{
      ticks: {
        beginAtZero: true,
        stepSize: 50,   // 👈 force increments of 50
        suggestedMax: undefined         // max: 500     // (optional) set a fixed maximum if needed
      }
    }]
        }
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })


  });
</script>
@endpush