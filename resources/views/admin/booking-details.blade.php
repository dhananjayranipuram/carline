@extends('layouts.admin')

@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}&libraries=marker"></script>
<style>
#map {
    height: 250px;
    width: 100%;
}

.custom-marker {
    width: 24px;
    height: 24px;
    background-color: red; /* Change to desired color */
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.3);
}

.custom-marker.blue {
    background-color: blue;
}
.detail-section{
    margin-top: 0px;
}
</style>
<div class="page-inner">
    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                

                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Booking Statistics (<span style="color: {{ $details[0]->status == 1 ? 'green' : 'red' }}">{{$details[0]->status_label}}</span>)</div>
                                <div class="card-tools">
                                    @if($details[0]->status != 0)
                                    <a class="btn btn-danger cancel-booking" data-id="{{$details[0]->id}}">
                                        <i class="icon-close"></i>
                                        Cancel
                                    </a>
                                    @endif
                                    <a href="{{url('/admin/bookings')}}" class="btn btn-primary">
                                        <i class="icon-action-undo"></i>
                                        Back
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12 detail-section">
                                    <p>
                                        <strong>Car Name</strong><br>
                                        <span>{{$details[0]->car_name}}</span>
                                    </p>
                                </div>
                                
                                <div class="col-md-6 detail-section">
                                    <p>
                                        <strong>Customer Name</strong><br>
                                        <span>{{$details[0]->user_name}}</span>
                                    </p>
                                </div>
                                <div class="col-md-6 detail-section">
                                    <p>
                                        <strong>Booked Date</strong><br>
                                        <span>{{$details[0]->booked_on}}</span>
                                    </p>
                                </div>

                                <div class="col-md-6 detail-section">
                                    <p>
                                        <strong>Pickup Date</strong><br>
                                        <span>{{$details[0]->pickup_date}}</span>
                                    </p>
                                </div>
                                <div class="col-md-6 detail-section">
                                    <p>
                                        <strong>Drop Off Date</strong><br>
                                        <span>{{$details[0]->return_date}}</span>
                                    </p>
                                </div>

                                <div class="col-md-6 detail-section">
                                    <p>
                                        <strong>Pickup Time</strong><br>
                                        <span>{{$details[0]->pickup_time}}</span>
                                    </p>
                                </div>
                                <div class="col-md-6 detail-section">
                                    <p>
                                        <strong>Drop Off Time</strong><br>
                                        <span>{{$details[0]->return_time}}</span>
                                    </p>
                                </div>

                                @if($details[0]->carRent > 0)
                                    <div class="col-md-6 detail-section">
                                        <p><strong>Rent:</strong> <span class="text-dark">AED {{$details[0]->carRent}}</span></p>
                                    </div>
                                @endif

                                @if($details[0]->deposit > 0)
                                    <div class="col-md-6 detail-section">
                                        <p><strong>Refundable Deposit:</strong> <span class="text-dark">AED {{$details[0]->deposit}}</span></p>
                                    </div>
                                @endif

                                @if($details[0]->babySeat > 0)
                                    <div class="col-md-6 detail-section">
                                        <p><strong>Baby Seat Charges:</strong> <span class="text-dark">AED {{$details[0]->babySeat}}</span></p>
                                    </div>
                                @endif

                                @if($details[0]->emirate > 0)
                                    <div class="col-md-6 detail-section">
                                        <p><strong>Pick & Drop Charges:</strong> <span class="text-dark">AED {{$details[0]->emirate}}</span></p>
                                    </div>
                                @endif

                                @if($details[0]->vat > 0)
                                    <div class="col-md-6 detail-section">
                                        <p><strong>VAT:</strong> <span class="text-dark">AED {{$details[0]->vat}}</span></p>
                                    </div>
                                @endif
                                <div class="col-md-6 detail-section">
                                    <p><strong>Transaction ID:</strong> <span class="text-dark">{{$details[0]->transaction_id}}</span></p>
                                </div>
                                
                                <div class="col-md-6 detail-section">
                                    <p><strong>Total:</strong> <span class="fw-bold fs-5">AED {{$details[0]->total}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Map</h5>

                        <!-- Vertical Form -->
                        <div class="row g-3">
                            <div class="col-12">
                                <div id="map"></div>
                            </div>
                        </div><!-- Vertical Form -->
                    
                    </div>

                    <div class="card-body">
                            <div class="row g-3">
                                

                                <div class="col-md-6 detail-section">
                                    <p>
                                        <strong>Pickup Location</strong><br>
                                        <span>{{$details[0]->source}}</span><br>
                                        <span>{{str_replace(',', ' , ', $details[0]->s_address)}}</span>
                                    </p>
                                </div>
                                <div class="col-md-6 detail-section">
                                    <p>
                                        <strong>Drop Off Location</strong><br>
                                        <span>{{$details[0]->destination}}</span><br>
                                        <span>{{str_replace(',', ' , ', $details[0]->d_address)}}</span>
                                    </p>
                                </div>

                                
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </section>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script>

$(".cancel-booking").click(function() {
    $(".overlay").show();
    if(confirm("Do you want to cancel this booking?")){
        $.ajax({
            url: baseUrl + '/cancel-booking',
            type: 'post',
            data: {id:$(this).data('id')},
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                if(res.status == 200){
                    location.reload();
                }
            }
        });
    }
});
    function initMap() {
      // Define two geocodes
      const point1 = { lat: {{$details[0]->s_lat}}, lng: {{$details[0]->s_lon}} };
      const point2 = { lat: {{$details[0]->d_lat}}, lng: {{$details[0]->d_lon}} };

      // Initialize the map with a valid Map ID
      const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: (point1.lat + point2.lat) / 2, lng: (point1.lng + point2.lng) / 2 },
        zoom: 10,
        mapId: "YOUR_MAP_ID", // Replace with the valid Map ID
      });

      // Add advanced markers for the points
      new google.maps.marker.AdvancedMarkerElement({
        position: point1,
        map: map,
        title: "Pickup Location",
        content: createCustomMarker("red")
      });

      new google.maps.marker.AdvancedMarkerElement({
        position: point2,
        map: map,
        title: "Drop off Location",
        content: createCustomMarker("blue")
      });
    }

    function createCustomMarker(color) {
      const markerDiv = document.createElement("div");
      markerDiv.className = `custom-marker ${color}`;
      return markerDiv;
    }

    // Load the map after the page loads
    window.onload = initMap;
  </script>
@endsection