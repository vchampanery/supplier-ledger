@extends('layouts.app')

@section('title', 'Home')
@section('page_title', 'Dashboard')

@section('content')
<div class="container-fluid">
  <h5 class="mb-2">{{ __('messages.total_pending_amount') }}</h5>
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
  </div>
    <h5 class="mb-2">{{ __('messages.overdue_amount') }}</h5>
  <div class="row">
         @foreach($overdue_amount as $inx=>$pending)
                   <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3>₹ {{number_format($pending)}}</h3>

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

@endsection
