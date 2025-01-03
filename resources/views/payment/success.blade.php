@extends('layouts.site')

@section('content')

<div class="container">
    <div class="row">
        <div class="booking-form-group col-md-12 text-center" style="padding: 50px 0 50px 0;">
            <i class="fas fa-check-circle" style="font-size: 200px; color: #006d09; margin-bottom: 20px;"></i>
            <div id="booking-details">
                <table class="table booking-table">
                    <tbody>
                        <tr>
                            <th>Booking ID:</th>
                            <td>{{$bookingId}}</td>
                        </tr>
                        <tr>
                            <th>Pickup Date:</th>
                            <td>{{$pickupdate}}</td>
                        </tr>
                        <tr>
                            <th>Dropoff Date:</th>
                            <td>{{$returndate}}</td>
                        </tr>
                        <tr>
                            <th>Pickup Time:</th>
                            <td>{{$pickuptime}}</td>
                        </tr>
                        <tr>
                            <th>Dropoff Time:</th>
                            <td>{{$returntime}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection