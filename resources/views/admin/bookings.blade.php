@extends('layouts.admin')

@section('content')

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
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="table-responsive">
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
                </div>
            </div>
        </div>

        
    </div>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script>
$(document).ready(function () {
$("#multi-filter-select").DataTable({
        pageLength: 10,
        
    });
});

</script>  
 
@endsection