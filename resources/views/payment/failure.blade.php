@extends('layouts.site')

@section('content')

<div class="container">
    <div class="row">
        <div class="booking-form-group col-md-12 text-center" style="padding: 50px 0 50px 0;">
            <i class="fas fa-times-circle" style="font-size: 200px; color: red; margin-bottom: 20px;"></i>
            <div id="booking-details">
                <h3>{{$message}}</h3>
            </div>
        </div>
    </div>
</div>

@endsection