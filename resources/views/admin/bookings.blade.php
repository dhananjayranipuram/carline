@extends('layouts.admin')

@section('content')
<link href="{{asset('admin_assets/css/daterangepicker.css')}}" rel="stylesheet">
<div class="page-inner">
   
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-8">
                        <h4 class="card-title">Bookings</h4>
                    </div>
                    <div class="col-md-4" style="text-align: right;">
                        <!-- <button class="btn btn-primary" onclick="location.href = '{{url('/admin/add-car')}}';">Add Car</button> -->
                    </div>
                </div>
                <form class="card-body" id="booking-table" method="post" action="{{ url('/admin/bookings') }}">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="row">
                        <div class="col-md-3">
                            <label for="validationDefault02" class="form-label">Date</label>
                            <div id="reportrange" class="word-wrap-custom" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                                <input type="hidden" id="from" name="from">
                                <input type="hidden" id="to" name="to">
                            </div>
                        </div>
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="table-responsive" style="padding-top: 10px;">
                        <table id="multi-filter-select" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Car Name</th>
                                <th>Pickup Date</th>
                                <th>Pickup Time</th>
                                <th>Pickup Location</th>
                                <th>Return Date</th>
                                <th>Return Time</th>
                                <th>Return Location</th>
                                <th>Rate</th>
                                <th style="width: 10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $key => $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->car_name}}</td>
                                <td>{{$value->pickup_date}}</td>
                                <td>{{$value->pickup_time}}</td>
                                <td>{{$value->source}}</td>
                                <td>{{$value->return_date}}</td>
                                <td>{{$value->return_time}}</td>
                                <td>{{$value->destination}}</td>
                                <td>{{$value->rate}} AED</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="#" data-bs-toggle="tooltip" title="View Booking" class="btn btn-link btn-primary btn-lg edit-brand" data-original-title="View Booking">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>

        
    </div>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('admin_assets/js/moment.min.js')}}"></script>
<script src="{{asset('admin_assets/js/daterangepicker.min.js')}}" defer></script>
<script>
$(function() {
    
    // var start = moment().subtract(29, 'days');
    var fromDate = "{{old('from')}}";
    var toDate = "{{old('to')}}";

    if(fromDate === '' ){
      var start = moment();
    }else{
      var start = moment(fromDate);
    }
    if(toDate === ''){
      var end = moment();
    }else{
      var end = moment(toDate);
    }
    
    function cb(start, end) {
        $('#reportrange span').html(start.format('DD-MM-Y') + ' - ' + end.format('DD-MM-Y'));
        $("#from").val(start.format('Y-MM-DD'));
        $("#to").val(end.format('Y-MM-DD'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'This Year': [moment().startOf('year'), moment().endOf('year')],
        }
    }, cb);

    cb(start, end);

});
$(document).ready(function () {
    $("#multi-filter-select").DataTable({
        pageLength: 10,
        
    });

    $('.ranges li').click(function(){
        if($(this).attr('data-range-key')!='Custom Range'){
            setTimeout(function () {
                $("#booking-table").submit();
            }, 200);
        }
    });
    $('.applyBtn').click(function(){
        setTimeout(function () {
            $("#booking-table").submit();
        }, 200);
    });

});

</script>  
 
@endsection