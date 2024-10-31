@extends('layouts.site')

@section('content')
<!-- Page Feets Single Start -->
<style>
    .pac-container {
        z-index: 10000;
    }

    
</style>
@php
$timeSlots = [];
$startTime = strtotime("12:00 AM");
$endTime = strtotime("11:59 PM");
while ($startTime <= $endTime) {
    $timeSlots[] = date("g:i A", $startTime);
    $startTime = strtotime('+30 minutes', $startTime);
}
@endphp
<div class="page-fleets-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Feets Single Sidebar Start -->
                    <div class="fleets-single-sidebar">
                        <div class="fleets-single-sidebar-box wow fadeInUp">
                            <!-- Feets Single Sidebar Pricing Start -->
                            <div class="fleets-single-sidebar-pricing">
                                <input type="hidden" value="{{$carDet[0]->id}}" id="carId">
                                <h2>AED {{$carDet[0]->rent}}<span>/ DAY</span></h2>
                                @if($carDet[0]->offer_flag==1)
                                    <h5>Offer Price {{$carDet[0]->offer_price}}<span>/ DAY</span></h5>
                                @endif
                            </div>
                            <!-- Feets Single Sidebar Pricing End -->

                            <div class="contact-us-form">
                                <form id="contactForm" action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.5s" novalidate="true" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                    <div class="row">
                                        
                                        <!-- Pickup Location -->
                                        <div class="form-group col-12 mb-4">
                                            <input class="form-control" id="source" type="text" placeholder="Pick Up Location" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        
                                        <!-- Pickup Date -->
                                        <div class="form-group col-12 mb-4">
                                            <label>Pickup Date</label>
                                            <input type="date" name="pickup_date" class="form-control" id="pickupdate" required min="{{ date('Y-m-d') }}" onkeydown="return false">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        
                                        <!-- Pickup Time -->
                                        <div class="form-group col-12 mb-4">
                                            <label>Pickup Time</label>
                                            <select class="form-control" name="pickup_time" id="pickuptime">
                                                <option selected disabled>Select Pickup Time</option>
                                                @foreach($timeSlots as $key => $value)
                                                    <option value="{{ date('G:i', strtotime($value))}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        
                                        <!-- Return to the Same Location Toggle -->
                                        <div class="form-group col-12 mb-4">
                                            
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="returnLocationToggle" name="return_to_same_location"><label for="returnLocationToggle">Return to the Same Location</label>
                                            </div>
                                        </div>
                                        
                                        <!-- Dropoff Section -->
                                        <div id="dropoffSection">
                                            <!-- Dropoff Location -->
                                            <div class="form-group col-12 mb-4">
                                                <input class="form-control" id="destination" type="text" placeholder="Drop Off Location" />
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            
                                            <!-- Dropoff Date -->
                                            <div class="form-group col-12 mb-4">
                                                <label>Dropoff Date</label>
                                                <input type="date" name="dropoff_date" class="form-control" id="returndate" required min="{{ date('Y-m-d') }}" onkeydown="return false">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            
                                            <!-- Dropoff Time -->
                                            <div class="form-group col-12 mb-4">
                                                <label>Dropoff Time</label>
                                                <!-- <input type="time" class="form-control" name="dropoff_time" id="returntime"> -->
                                                <select class="form-control" name="dropoff_time" id="returntime">
                                                    <option selected disabled>Select Pickup Time</option>
                                                    @foreach($timeSlots as $key => $value)
                                                        <option value="{{ date('H:i', strtotime($value))}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="fleets-single-sidebar-list" id="booking-errors">
                                        </div>
                                        <div class="fleets-single-sidebar-list" id="rate-details" style="display:none;">
                                            <ul>
                                                <li><img src="{{asset('assets/images/icon-how-it-work-2.svg')}}" alt="">Rent <span id="rent-message"> AED 1500</span></li>
                                                <li><img src="{{asset('assets/images/icon-service-2.svg')}}" alt="">Deposit <span id="deposit-message">AED 100</span></li>
                                                <li><img src="{{asset('assets/images/icon-service-2.svg')}}" alt="">Total <span id="total-message">AED 100</span></li>
                                            </ul>
                                        </div>
                                        <!-- Feets Single Sidebar Btn Start -->
                                        <div class="fleets-single-sidebar-btn">
                                            <a href="#" class="btn-default popup-with-form book-now-form">book now</a>
                                            <span>or</span>
                                            <a href="#" class="wp-btn"><i class="fa-brands fa-whatsapp"></i></a>                                
                                        </div>
                                        <!-- Feets Single Sidebar Btn End -->
                                    </div>
                                </form>
                            </div>
                            
                        </div>


                    </div>
                    <!-- Feets Single Sidebar End -->
                </div>

                <div class="col-lg-8">
                    <!-- Feets Single Content Start -->
                    <div class="fleets-single-content">
                        <!-- Feets Single Slider Start -->
                        <div class="fleets-single-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper">

                                    @php $imgArr = explode(',',$carDet[0]->image); @endphp
                                    @foreach($imgArr as $key => $value)
                                    <!-- Fleets Image Slide Start -->
                                    <div class="swiper-slide">
                                        <div class="fleets-slider-image">
                                            <figure class="image-anime">
                                                <img src="{{asset($value)}}" alt="">
                                            </figure>
                                        </div>
                                    </div>
                                    <!-- Fleets Image Slide End -->
                                    @endforeach

                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <!-- Feets Single Slider End -->

                        <div class="fleets-single-sidebar-list">
                            <h2>{{$carDet[0]->brand_name}} {{$carDet[0]->name}} - {{$carDet[0]->model}} Model</h2>
                        </div>
                        <div class="fleets-single-sidebar-list">
                            <div class="row">

                                @php
                                $pieces = array_chunk($specs, ceil(count($specs) / 2));
                                @endphp

                                <div class="col-md-6">
                                    <ul>
                                        @foreach($pieces[0] as $key => $value)
                                        <li><img src="{{asset($value->image)}}" alt="">{{$value->name}} <span>{{$value->details}}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        @foreach($pieces[1] as $key => $value)
                                        <li><img src="{{asset($value->image)}}" alt="">{{$value->name}} <span>{{$value->details}}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Feets Information Start -->
                        <div class="fleets-information">
                            {!! trim(html_entity_decode($generalInfo[0]->content)) !!} 
                        </div>
                        <!-- Feets Information End -->

                        <!-- Feets Amenities Start -->
                        <div class="fleets-amenities">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">amenities</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Amenities and features</h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Feets Amenities List Start -->
                            <div class="fleets-amenities-list wow fadeInUp" data-wow-delay="0.25s">
                                <ul>
                                    @foreach($features as $key => $value)
                                        <li>{{$value->feature}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Feets Amenities List End -->
                        </div>
                        <!-- Feets Amenities End -->

                        @if($carDet[0]->rental_condition_flag == 1)
                        <!-- Rental Conditions Faqs Start -->
                        <div class="rental-conditions-faqs">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">rental conditions</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Policies and agreement</h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Rental Conditions FAQ Accordion Start -->
                            <div class="rental-condition-accordion" id="rentalaccordion">
                                @foreach($policy as $key => $value)
                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp">
                                    <h2 class="accordion-header" id="rentalheading1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#rentalcollapse{{$key}}" aria-expanded="false" aria-controls="rentalcollapse{{$key}}">
                                            {{$value->name}}
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="rentalheading{{$key}}"
                                        data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>{{$value->content}}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->
                                @endforeach

                            </div>
                            <!-- Rental Conditions FAQ Accordion End -->
                        </div>
                        <!-- Rental Conditions Faqs End -->
                        @endif

                    </div>
                    <!-- Feets Single Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Feets Single End -->
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>  
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmX5w5ltGt09cjDod_YMamphRRgS8L-ZQ&region=ae&libraries=places"></script>
<script>
var sourceData = [];
var destinationData = [];    

// var sourceData = [
//     {
//         "Latitude": 25.2489204,
//         "Longitude": 55.30605509999999,
//         "Emirates": "Dubai",
//         "Address": "Al Karama,Dubai,Dubai,United Arab Emirates,"
//     }
// ];
//     var destinationData = [
//     {
//         "Latitude": 25.1250606,
//         "Longitude": 55.3837419,
//         "Emirates": "Dubai",
//         "Address": "Dubai Silicon Oasis,Dubai,Dubai,United Arab Emirates,"
//     }
// ];
$(document).ready(function () {

    // Initialize the Autocomplete object for the input field
    var source = new google.maps.places.Autocomplete(document.getElementById('source'), {
        types: ['geocode']
    });
    var destination = new google.maps.places.Autocomplete(document.getElementById('destination'), {
        types: ['geocode']
    });

    // Add an inline event listener for 'place_changed'
    source.addListener('place_changed', function () {
        // Get the place details from the autocomplete object
        var place = source.getPlace();

        // Check if the place has geometry
        if (place.geometry) {
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();

            var emiratesName = '';

            // Find the Emirates name from address components
            var tempAddress = '';
            place.address_components.forEach(function(component) {
                if (component.types.includes('administrative_area_level_1')) {
                    emiratesName = component.long_name; // Get the Emirates name
                }
                tempAddress += component.long_name+',';
            });

            sourceData.push({
                'Latitude': lat,
                'Longitude': lng,
                'Emirates': emiratesName,
                'Address': tempAddress,
            });
            // console.log(sourceData)
        } else {
            console.log('No geometry data found for this place.');
        }
    });

    destination.addListener('place_changed', function () {
        // Get the place details from the autocomplete object
        var place = destination.getPlace();

        // Check if the place has geometry
        if (place.geometry) {
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();

            var emiratesName = '';

            // Find the Emirates name from address components
            var tempAddress = '';
            place.address_components.forEach(function(component) {
                if (component.types.includes('administrative_area_level_1')) {
                    emiratesName = component.long_name; // Get the Emirates name
                }
                tempAddress += component.long_name+',';
            });

            destinationData.push({
                'Latitude': lat,
                'Longitude': lng,
                'Emirates': emiratesName,
                'Address': tempAddress,
            });
            // console.log( destinationData);
        } else {
            console.log('No geometry data found for this place.');
        }
    });

    

});

$("#source").keyup(function(){
    if($('#returnLocationToggle').is(":checked")){
        $("#destination").val($("#source").val());
    }
});

$("#returnLocationToggle").click(function() {
    if($('#returnLocationToggle').is(":checked")){
        $("#destination").prop('disabled', true);
        $("#destination").val($("#source").val());
    }else{
        $("#destination").prop('disabled', false);
        $("#destination").val('');
    }
});

$("#pickupdate, #returndate, #destination, #source, #returntime, #pickuptime").on("change paste keyup click", function() {

    if(destinationData.length != 0 && sourceData.length != 0 && $("#pickupdate").val() != '' && $("#returndate").val() != '' && $("#pickuptime").val() != '' && $("#returntime").val() != ''){
        if ($("#pickupdate").val() < $("#returndate").val()) {

            $.ajax({
                url: baseUrl + '/check-rate',
                type: 'post',
                data: { 
                    'destinationEmirate': destinationData[0].Emirates, 
                    'sourceEmirates': sourceData[0].Emirates, 
                    'pickupdate': $("#pickupdate").val(),
                    'returndate': $("#returndate").val(),
                    'pickuptime': $("#pickuptime").val(),
                    'returntime': $("#returntime").val(),
                    'returntosame': $("#returnLocationToggle").val(),
                    'id': $("#carId").val()},
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res) {
                    $("#rate-details").show();
                    $("#rent-message").html('AED '+res.rate);
                    $("#deposit-message").html('AED '+res.deposit);
                    $("#total-message").html('AED '+total);
                    
                }
            });
        }else{
            $("#booking-errors").html('<span style="color:red;">Error in dates</span>');
            setTimeout(function () {
                $('#booking-errors').html('');
            }, 2500);
        }
    }
});

    $(".book-now-form").click(function () {
        if($("#userId").val()==''){
            $.magnificPopup.open({
                items: {
                    src: '#registrationForm', 
                    type: 'inline'
                }
            });
        }else{
            localStorage.setItem("action",'booking');
            checkDocumentUploaded();
        }
    });

function bookCarAction(){
    $.ajax({
        url: baseUrl + '/save-car-booking',
        type: 'post',
        data: { 
            'destinationData': destinationData[0], 
            'sourceData': sourceData[0], 
            'destinationEmirate': destinationData[0].Emirates, 
            'sourceEmirates': sourceData[0].Emirates,
            'pickupdate': $("#pickupdate").val(),
            'returndate': $("#returndate").val(),
            'pickuptime': $("#pickuptime").val(),
            'returntime': $("#returntime").val(),
            'carId': $("#carId").val(),
            'userId': $("#userId").val()
        },
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            if(res.status==200){
                var str = '<span style="color:green;">Car Booked. Booking ID:'+res.bookingId+'</span>'
                $("#booking-errors").html(str);
            }else{
                var str = '<span style="color:red;">'+res.message+'</span>'
                $("#booking-errors").html(str);
            }
            
        }
    });


}


</script>
@endsection