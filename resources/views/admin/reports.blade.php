@extends('layouts.admin')

@section('content')
<link href="{{asset('admin_assets/css/daterangepicker.css')}}" rel="stylesheet">
<div class="page-inner">
    <form id="booking-table" method="post" action="{{ url('/admin/reports') }}">
    @csrf <!-- {{ csrf_field() }} -->               
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Report</div>
                                
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label for="validationDefault02" class="form-label">Select Date Range</label>
                                <div id="reportrange" class="word-wrap-custom" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                    <input type="hidden" id="from" name="from">
                                    <input type="hidden" id="to" name="to">
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Car wise sales</div>
                                
                            
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="padding-top: 10px;">
                            <table id="multi-filter-select" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Car Name</th>
                                        <th>Total Sales</th>
                                        <th>Total Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @foreach($car_wise_sales as $key => $value)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$value['car_name']}}</td>
                                        <td>AED {{$value['total_sales']}}</td>
                                        <td>{{$value['sales_count']}}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Brand wise sales</div>
                                
                            
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="padding-top: 10px;">
                            <table id="multi-filter-select-type" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Brand Name</th>
                                        <th>Total Sales</th>
                                        <th>Total Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @foreach($brand_wise_sales as $key => $value)
                                    @php $i++; @endphp
                                    <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$value['brand_name']}}</td>
                                    <td>AED {{$value['total_sales']}}</td>
                                    <td>{{$value['sales_count']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                
                <div class="card card-stats card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Sales for the salected date</div>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                            <thead>
                                <tr>
                                    <th>Total Sales</th>
                                    <th>Total Bookings</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>AED {{$total_sales}}</td>
                                    <td>{{$total_sales_count}}</td>
                                </tr>
                            </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <div class="card card-stats card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Car type wise sales</div>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="padding-top: 10px;">
                            <table id="multi-filter-select-brand" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Brand Name</th>
                                        <th>Total Sales</th>
                                        <th>Total Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @foreach($car_type_wise_sales as $key => $value)
                                    @php $i++; @endphp
                                    <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$value['type_name']}}</td>
                                    <td>AED {{$value['total_sales']}}</td>
                                    <td>{{$value['sales_count']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                

                
            </div>
        </div>
    </form>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('admin_assets/js/moment.min.js')}}"></script>
<script src="{{asset('admin_assets/js/daterangepicker.min.js')}}" defer></script>
<script>
$(function() {
    
    // var start = moment().subtract(29, 'days');
    var fromDate = "{{ old('from') ?? '' }}";
    var toDate = "{{ old('to') ?? '' }}";

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
        if(start.format('DD-MM-Y') == '01-01-1970'){
            $('#reportrange span').html('Starting point - ' + end.format('DD-MM-Y'));
        }else{
            $('#reportrange span').html(start.format('DD-MM-Y') + ' - ' + end.format('DD-MM-Y'));
        }
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
            'Maximum': [moment("1970-01-01"), moment()],
        }
    }, cb);

    cb(start, end);

});
$(document).ready(function () {
    $("#multi-filter-select").DataTable({
        pageLength: 5,
        
    });
    $("#multi-filter-select-brand").DataTable({
        pageLength: 5,
        
    });
    $("#multi-filter-select-type").DataTable({
        pageLength: 5,
        
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

    $('.brand-select , .type-select').change(function(){
        $("#booking-table").submit();
    });

});

</script>  
 
@endsection