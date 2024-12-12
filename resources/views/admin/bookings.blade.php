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
                        <a class="btn btn-primary" href="{{url('/admin/export-bookings')}}">Export</a>
                    </div>
                </div>
                <form class="card-body" id="booking-table" method="post">
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
                        <div class="col-md-3">
                            <label for="validationDefault02" class="form-label">Car Brand</label>
                            <select name="brand" class="form-select brand-select">
                                    <option value="">All Brand</option>
                                    @foreach($brands as $key => $value)
                                        <option value="{{$value->id}}" @if(old('brand') == $value->id) selected @endif>{{$value->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="validationDefault02" class="form-label">Car Type</label>
                            <select name="type" class="form-select type-select">
                                <option value="">All Car Type</option>
                                @foreach($type as $key => $value)
                                    <option value="{{$value->id}}" @if(old('type') == $value->id) selected @endif>{{$value->name}}</option>
                                @endforeach
                            </select>
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
                                <th>Customer Name</th>
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
                        <tbody id="booking-data">
                            @foreach($bookings as $key => $value)
                            <tr data-url="{{url('/admin/booking-details')}}?id={{base64_encode($value->id)}}">
                                <td>{{$value->id}}</td>
                                <td>{{$value->user_name}}</td>
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
                                        <a href="{{url('/admin/booking-details')}}?id={{base64_encode($value->id)}}" data-bs-toggle="tooltip" title="View Booking" class="btn btn-link btn-primary btn-lg edit-brand" data-original-title="View Booking">
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
    var fromDate = "{{ old('from') ?? session('bookingFilter.from') ?? '' }}";
    var toDate = "{{ old('to') ?? session('bookingFilter.to') ?? '' }}";

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
        pageLength: 10,
        
    });

    $('.ranges li').click(function(){
        if($(this).attr('data-range-key')!='Custom Range'){
            setTimeout(function () {
                // $("#booking-table").submit();
                buildTable();
            }, 200);
        }
    });
    $('.applyBtn').click(function(){
        setTimeout(function () {
            // $("#booking-table").submit();
            buildTable();
        }, 200);
    });

    $('.brand-select , .type-select').change(function(){
        // $("#booking-table").submit();
        buildTable();
    });

});

function buildTable(){
    let formData = new FormData(document.getElementById("booking-table"));
    $.ajax({
        url: baseUrl + '/admin/bookings',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            let table = $('#multi-filter-select').DataTable();
            table.destroy();

            $("#booking-data").empty();
            if(res.bookings.length>0){
                res.bookings.forEach(function (data) {
                    let encodedId = btoa(data.id);
                    let row = `
                        <tr data-url="${baseUrl}/admin/booking-details?id=${encodedId}">
                            <td>${data.id}</td>
                            <td>${data.user_name}</td>
                            <td>${data.car_name}</td>
                            <td>${data.pickup_date}</td>
                            <td>${data.pickup_time}</td>
                            <td>${data.source}</td>
                            <td>${data.return_date}</td>
                            <td>${data.return_time}</td>
                            <td>${data.destination}</td>
                            <td>${data.rate}</td>
                            <td>
                            <div class="form-button-action">
                                <a href="${baseUrl}/admin/booking-details?id=${encodedId}" data-bs-toggle="tooltip" title="View Booking" class="btn btn-link btn-primary btn-lg edit-brand" data-original-title="View Booking">
                                    <i class="far fa-eye"></i>
                                </a>
                            </div>
                        </td>
                        </tr>
                    `;
                    $("#booking-data").append(row);
                });
            }
            $('#multi-filter-select').DataTable({
                pageLength: 10,
                responsive: true, // Enables responsive behavior
                processing: true, // Displays a processing indicator
                searching: true,  // Enables search functionality
                paging: true,     // Enables pagination
                autoWidth: false  // Prevents automatic column width calculation
            });
            
        },error: function(xhr, status, error) {
            
        }
    });
}

$('#multi-filter-select tbody').on('click', 'tr', function () {
    const url = $(this).data('url');

    if (url) {
        window.location.href = url;
    }
});
</script>  
 
@endsection