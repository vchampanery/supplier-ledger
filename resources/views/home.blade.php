@extends('layouts.app')

@section('title', 'Home')
@section('page_title', 'Dashboard')

@section('content')
<div class="card">
  <!-- <div class="card-header">Welcome</div> -->
  <div class="card-body">

     <!-- /.row -->
    <div class="row">
       <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">{{ __('messages.total_pending_amount') }}</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                   @foreach($pending_amount as $pending)
                   <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3>₹ {{number_format($pending['amount'])}}</h3>

                          <p>{{$pending['label'] ?: 'N/A'}}</p>
                        </div>
                        <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    @endforeach
                  <!-- /.info-box -->
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div>
     <!-- /.row -->
    <div class="row">
       <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">{{ __('messages.overdue_amount') }}</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
                   @foreach($overdue_amount as $inx=>$pending)
                     <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3>₹ {{ number_format($pending)}}</h3>

                          <p>{{$inx}}</p>
                        </div>
                       
                        <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    @endforeach
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div>
     <!-- /.row -->
    <div class="row">
       <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">{{ __('messages.current_month_amount') }}</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div class="row">
                   @foreach($current_month_amount as $inx=>$pending)
                    <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3>₹ {{ number_format($pending)}}</h3>

                          <p>{{$inx}}</p>
                        </div>
                       
                        <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    @endforeach
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div>
     <!-- /.row -->
    <div class="row">
       <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">{{ __('messages.coming_month_amount') }}</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                   @foreach($upcoming_month_amount as $inx=>$pending)
                      <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3>₹ {{ number_format($pending)}}</h3>

                          <p>{{$inx}}</p>
                        </div>
                       
                        <a href="#" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    @endforeach
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div>

    
  </div>
</div>
@endsection
