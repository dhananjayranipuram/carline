@extends('layouts.site')

@section('content')
<!-- Page Feets Single Start -->
<style>
    .pac-container {
        z-index: 10000;
    }

    
</style>
<style>
    .pricing-table {
        margin-top: 30px;
        overflow-x: auto; /* Allows horizontal scroll on small screens */
    }

    .pricing-table table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .pricing-table th, .pricing-table td {
        text-align: center;
        padding: 15px 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .pricing-table th {
        background-color: #000080;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
    }

    .pricing-table tr:last-child td {
        border-bottom: none;
    }

    .pricing-table tbody tr {
        transition: background-color 0.3s ease;
    }

    .pricing-table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .pricing-table td {
        font-size: 16px;
        color: #333;
    }

    @media screen and (max-width: 768px) {
        .pricing-table th, .pricing-table td {
            font-size: 14px;
            padding: 12px;
        }
    }

    @media screen and (max-width: 480px) {
        .pricing-table th, .pricing-table td {
            font-size: 12px;
            padding: 10px;
        }
    }
    ul{
        color: var(--white-color);
        margin: 0;
        font-weight: normal;
    }
    a.disabled {
        pointer-events: none;
        cursor: default;
    }

    .fleets-amenities-list ul li:before{
        color:white;
    }

    .policy-link{
        color:#000080;
        cursor: pointer;
    }
</style>
<style>
    .booking-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        color: #333;
        background-color: #f9f9f9; /* Subtle background color */
        border: 1px solid #ddd; /* Border for the table */
        border-radius: 8px;
        overflow: hidden;
    }

    .booking-table th, .booking-table td {
        text-align: left;
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
    }

    .booking-table th {
        background-color: #f1f1f1; /* Faded header color */
        color: #000080;
        font-weight: bold;
    }

    .booking-table tr:nth-child(even) {
        background-color: #f7f7f7; /* Alternating row color */
    }

    .booking-table tr:nth-child(odd) {
        background-color: #ffffff; /* Alternating row color */
    }

    .booking-table tr:last-child td {
        border-bottom: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .booking-table {
            font-size: 14px;
        }

        .booking-table th, .booking-table td {
            padding: 10px;
        }
    }
</style>
<style>
        @media only screen and (max-width: 991px) {
    .fleets-single-slider {
        margin-bottom: 2px;
    }
}
@media only screen and (max-width: 991px) {
    .page-fleets-single {
        padding: 0px 0;
    }
}
@media only screen and (max-width: 991px) {
    .fleets-information {
        margin-bottom: 5px;
        padding-bottom: 5px;
    }
    .pricing-table {
    margin-top: 1px;
    overflow-x: auto;
}
.fleets-slider-image {
    position: relative;
    border-radius: 30px;
    overflow: hidden;
    padding-top: 20px;
}
}

/* Hide the page header on desktop and laptop (above 1024px) */
@media only screen and (min-width: 1025px) {
    .page-header {
        display: none;
    }
}

/* Ensure the page header is visible on mobile and tablets (up to 1024px) */
@media only screen and (max-width: 1024px) {
    .page-header {
        display: block;
    }
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
<!-- Page Header Start -->
<div class="page-header bg-section parallaxie">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- Page Header Box Start -->
					<div class="page-header-box">
						<h1 class="text-anime-style-3" data-cursor="-opaque">{{$carDet[0]->brand_name}} {{$carDet[0]->name}} - {{$carDet[0]->model}} Model</h1>
					</div>
					<!-- Page Header Box End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header End -->
<!-- Booking Form Box Start -->
<div class="booking-form-box">
    <!-- Booking PopUp Form Start -->
    <div id="termsCondition" class="white-popup-block mfp-hide booking-form">                              
        <fieldset>
            <div class="row">
                <div class="booking-form-group col-md-12 mb-4">
                    <!-- Feets Single Content Start -->
                    <div class="fleets-single-content">

                        <!-- Rental Conditions Faqs Start -->
                        <div class="rental-conditions-faqs">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">rental conditions</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Policies and agreement</h2>
                            </div>
                            <!-- Section Title End -->
                            <div class="rental-condition-accordion" id="rentalaccordion">
                            
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>                                    
        </fieldset>
    </div>
    <!-- Registration PopUp Form End -->
</div>
<!-- Registration Form Box End -->
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
                                @if($carDet[0]->offer_flag==1)
                                    <h5>AED <del>{{$carDet[0]->rent}}</del><span>/ DAY</span></h5>
                                    <h2>Offer Price <br>AED {{$carDet[0]->offer_price}}<span>/ DAY</span></h2>
                                @else
                                    <h2>AED {{$carDet[0]->rent}}<span>/ DAY</span></h2>
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
                                            <input type="date" name="pickup_date" class="form-control" id="pickupdate" required min="{{ date('Y-m-d') }}" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        
                                        <!-- Pickup Time -->
                                        <div class="form-group col-12 mb-4">
                                            <label>Pickup Time</label>
                                            <select class="form-control" name="pickup_time" id="pickuptime">
                                                <option selected disabled value="-1">Select Pickup Time</option>
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
                                                <input type="date" name="dropoff_date" class="form-control" id="returndate" required min="{{ date('Y-m-d') }}">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            
                                            <!-- Dropoff Time -->
                                            <div class="form-group col-12 mb-4">
                                                <label>Dropoff Time</label>
                                                <!-- <input type="time" class="form-control" name="dropoff_time" id="returntime"> -->
                                                <select class="form-control" name="dropoff_time" id="returntime">
                                                    <option selected disabled value="-1">Select Dropoff Time</option>
                                                    @foreach($timeSlots as $key => $value)
                                                        <option value="{{ date('H:i', strtotime($value))}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="form-group col-12 mb-4">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" id="babySeat" name="baby_seat"><label for="babySeatToggle">Baby Seat</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fleets-single-sidebar-list" id="booking-errors">
                                        </div>
                                        <div class="fleets-single-sidebar-list" id="rate-details" style="display:none;">
                                            <ul>
                                                <li><img src="{{asset('assets/images/icon-how-it-work-2.svg')}}" alt="">Rate <span id="rate-message"> AED 1500</span></li>
                                                <li><img src="{{asset('assets/images/icon-service-2.svg')}}" alt="">Deposit <span id="deposit-message">AED 100</span></li>
                                                <li><img src="{{asset('assets/images/icon-service-2.svg')}}" alt="">Dropoff Charges <span id="emirate-message">AED 100</span></li>
                                                <li><img src="{{asset('assets/images/icon-service-2.svg')}}" alt="">VAT <span id="vat-message">AED 100</span></li>
                                                <li><img src="{{asset('assets/images/icon-service-2.svg')}}" alt="">Total <span id="total-message">AED 100</span></li>
                                            </ul>
                                        </div>
                                        <div class="fleets-single-sidebar-list" id="additionalNotes" style="display:none;">
                                            <p style="margin-bottom: 0px;"><i class="fas fa-info-circle"></i> Additional mileage charge - AED {{$carDet[0]->add_mileage_charge}}/km</p>
                                            <p style="margin-bottom: 0px;"><i class="fas fa-info-circle"></i> Salik / Toll Charges - AED {{$carDet[0]->toll_charges}}/Salik or toll </p>
                                            <p style="margin-bottom: 0px;"><i class="fas fa-info-circle"></i> Fuel Policy - Same to Same </p>
                                        </div>

                                        <div class="fleets-single-sidebar-list">
                                            <input type="checkbox" id="agreePolicy"> I have read and agree to Carline's <span class="policy-link">Policies and Agreement</span>
                                        </div>

                                        <!-- Feets Single Sidebar Btn Start -->
                                        <div class="fleets-single-sidebar-btn">
                                            <a href="#" class="btn-default popup-with-form book-now-form disabled" id="bookNowButton">book now</a>
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
                        
                        <!-- Responsive Table Start -->
                        <div class="pricing-table wow fadeInUp fleets-information" data-wow-delay="0.5s">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Rental Period</th>
                                        <th>Rental Cost</th>
                                        <th>Mileage Limit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Daily</td>
                                        <td> 
                                        @if($carDet[0]->offer_flag==1)
                                            <del>AED {{$carDet[0]->rent}}</del>
                                            AED {{$carDet[0]->offer_price}}
                                        @else
                                            AED {{$carDet[0]->rent}}
                                        @endif
                                        </td>
                                        <td>{{$carDet[0]->daily_mileage}} KM</td>
                                    </tr>
                                    <tr>
                                        <td>Weekly</td>
                                        <td>
                                        @if($carDet[0]->offer_flag_weekly==1)
                                            <del>AED {{$carDet[0]->per_week}}</del>
                                            AED {{$carDet[0]->offer_price_weekly}}
                                        @else
                                            AED {{$carDet[0]->per_week}}
                                        @endif
                                        </td>
                                        <td>{{$carDet[0]->weekly_mileage}} KM</td>
                                    </tr>
                                    <tr>
                                        <td>Monthly</td>
                                        <td>
                                        @if($carDet[0]->offer_flag_monthly==1)
                                            <del>AED {{$carDet[0]->per_month}}</del>
                                            AED {{$carDet[0]->offer_price_monthly}}
                                        @else
                                            AED {{$carDet[0]->per_month}}
                                        @endif
                                        </td>
                                        <td>{{$carDet[0]->monthly_mileage}} KM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Responsive Table End -->

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

                        <!-- Feets Amenities Start -->
                        <!-- <div class="fleets-amenities">

                            <div class="section-title">
                                <h3 class="wow fadeInUp">amenities</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Amenities and features</h2>
                            </div>

                            <div class="fleets-amenities-list wow fadeInUp" data-wow-delay="0.25s">
                                <ul>
                                    @foreach($features as $key => $value)
                                        <li>{{$value->feature}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div> -->
                        <!-- Feets Amenities Start -->

                        <div class="fleets-amenities">
                            <div class="rental-condition-accordion">
                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#rentalcollapse" aria-expanded="false" aria-controls="rentalcollapse">
                                            Amenities and features
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse" class="accordion-collapse collapse" aria-labelledby="rentalheading"
                                        data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <div class="fleets-amenities-list wow fadeInUp" data-wow-delay="0.25s" >
                                                <ul>
                                                    @foreach($features as $key => $value)
                                                        <li style="color:white;">{{$value->feature}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                            </div>
                        </div>

                        @if($carDet[0]->general_info_flag == 1)
                        <!-- Feets Information Start -->
                        <div class="fleets-information">
                            <div class="section-title">
                                <h3 class="wow fadeInUp">General Information</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">{{$generalInfo[0]->heading}}</h2>
                                <p class="wow fadeInUp" data-wow-delay="0.25s">
                                    {{$generalInfo[0]->content}}
                                </p>
                            </div>
                            <div class="fleets-information-list wow fadeInUp" data-wow-delay="0.5s">
                                <div class="row">
                                    @php
                                    $options = explode('~',$generalInfo[0]->options);
                                    $pieces = array_chunk($options, ceil(count($options) / 2));
                                    @endphp

                                    <div class="col-md-6">
                                        <ul>
                                            @foreach($pieces[0] as $key => $value)
                                            <li>{{$value}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul>
                                            @foreach($pieces[1] as $key => $value)
                                            <li>{{$value}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Feets Information End -->
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmX5w5ltGt09cjDod_YMamphRRgS8L-ZQ&components=country:ae&libraries=places"></script>

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
        types: ['geocode', 'establishment'],
        componentRestrictions: { country: "AE" }
    });
    var destination = new google.maps.places.Autocomplete(document.getElementById('destination'), {
        types: ['geocode', 'establishment'],
        componentRestrictions: { country: "AE" }
    });

    // Add an inline event listener for 'place_changed'
    source.addListener('place_changed', function () {
        // Get the place details from the autocomplete object
        var place = source.getPlace();

        // Check if the place has geometry
        if (place.geometry) {
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();

            var isAirport = false;
            var emiratesName = '';

            // Find the Emirates name from address components
            var tempAddress = '';

            place.types.forEach(function (type) {
                if (type === 'airport' || place.name.toLowerCase().includes('airport')) {
                    isAirport = true;
                }
            });

            place.address_components.forEach(function(component) {
                if (component.types.includes('administrative_area_level_1')) {
                    emiratesName = component.long_name; // Get the Emirates name
                }
                tempAddress += component.long_name+',';
            });

            if (!isAirport) {
                sourceData.push({
                    'placeName': place.name,
                    'Latitude': lat,
                    'Longitude': lng,
                    'Emirates': emiratesName,
                    'Address': place.name + ',' + tempAddress,
                });
            } else {
                $("#booking-errors").html('<span style="color:red;">Cannot pickup from airports.</span>');
                $("#source").val('');
                sourceData = [];
                setTimeout(function () {
                    $('#booking-errors').html('');
                }, 2500);
            }
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

            var isAirport = false;
            var emiratesName = '';

            // Find the Emirates name from address components
            var tempAddress = '';

            place.types.forEach(function (type) {
                if (type === 'airport' || place.name.toLowerCase().includes('airport')) {
                    isAirport = true;
                }
            });

            place.address_components.forEach(function(component) {
                if (component.types.includes('administrative_area_level_1')) {
                    emiratesName = component.long_name; // Get the Emirates name
                }
                tempAddress += component.long_name+',';
            });

            if (!isAirport) {
                destinationData.push({
                    'placeName': place.name,
                    'Latitude': lat,
                    'Longitude': lng,
                    'Emirates': emiratesName,
                    'Address': place.name + ',' + tempAddress,
                });

            } else {
                $("#booking-errors").html('<span style="color:red;">Cannot drop off to airports.</span>');
                $("#destination").val('');
                destinationData = []; 
                setTimeout(function () {
                    $('#booking-errors').html('');
                }, 2500);
            }
            
        } else {
            console.log('No geometry data found for this place.');
        }
    });

    

});

$("#source").keyup(function(){
    if($('#returnLocationToggle').is(":checked")){
        $("#destination").val($("#source").val());
        destinationData = sourceData;
    }
});

$("#returnLocationToggle").click(function() {
    if($('#returnLocationToggle').is(":checked")){
        $("#destination").prop('disabled', true);
        $("#destination").val($("#source").val());
        destinationData = sourceData;
    }else{
        $("#destination").prop('disabled', false);
        $("#destination").val('');
        destinationData = [];
    }
});

$("#pickupdate").on("change", function() {
    // var d = new Date();
    // if($("#pickupdate").val().length){
    //     $('#returndate').attr( 'min',$("#pickupdate").val());
    // }else{
    //     $('#returndate').attr( 'min',formatDate(d));
    // }
    $.ajax({
        url: baseUrl + '/check-time',
        type: 'post',
        data: { 
            'returndate': $("#returndate").val(),
            'pickupdate': $("#pickupdate").val(),
            'pickuptime': $("#pickuptime").val(),
            'returntime': $("#returntime").val(),
            'type': 'pickup',
            'carId': $("#carId").val()},
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            if(res){
                if($("#returndate").val().length>0 && $("#pickupdate").val().length>0){
                    
                    if($("#pickuptime").val()==-1 || $("#pickuptime").val()==null){
                        $("#pickuptime").html('');
                        $("#pickuptime").append('<option selected disabled value="-1">Select Pickup Time</option>');
                        $.each(res, function(key, value) {
                            $("#pickuptime").append(`<option value="${value}">${value}</option>`);
                        });
                    }
                    if($("#returntime").val()==-1 || $("#returntime").val()==null){
                        $("#returntime").html('');
                        $("#returntime").append('<option selected disabled value="-1">Select Pickup Time</option>');
                        $.each(res, function(key, value) {
                            $("#returntime").append(`<option value="${value}">${value}</option>`);
                        });
                    }
                }else{
                    $("#pickuptime").html('');
                    $("#pickuptime").append('<option selected disabled value="-1">Select Pickup Time</option>');
                    $.each(res, function(key, value) {
                        $("#pickuptime").append(`<option value="${value}">${value}</option>`);
                    });
                }
            }else{
                $("#pickuptime").html('');
            }
        }
    });
});

$("#returndate").on("change", function() {
    // var d = new Date();
    // if($("#returndate").val().length){
    //     $('#pickupdate').attr( 'min',$("#returndate").val());
    // }else{
    //     $('#pickupdate').attr( 'min',formatDate(d));
    // }
    $.ajax({
        url: baseUrl + '/check-time',
        type: 'post',
        data: { 
            'pickupdate': $("#pickupdate").val(),
            'returndate': $("#returndate").val(),
            'pickuptime': $("#pickuptime").val(),
            'returntime': $("#returntime").val(),
            'type': 'dropoff',
            'carId': $("#carId").val()},
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            if(res){
                
                if($("#returndate").val().length>0 && $("#pickupdate").val().length>0){
                    
                    if($("#pickuptime").val()==-1 || $("#pickuptime").val()==null){
                        $("#pickuptime").html('');
                        $("#pickuptime").append('<option selected disabled value="-1">Select Pickup Time</option>');
                        $.each(res, function(key, value) {
                            $("#pickuptime").append(`<option value="${value}">${value}</option>`);
                        });
                    }
                    
                    if($("#returntime").val()==-1 || $("#returntime").val()==null){
                        $("#returntime").html('');
                        $("#returntime").append('<option selected disabled value="-1">Select DropOff Time</option>');
                        $.each(res, function(key, value) {
                            $("#returntime").append(`<option value="${value}">${value}</option>`);
                        });
                    }
                }else{
                    $("#returntime").html('');
                    $("#returntime").append('<option selected disabled value="-1">Select Drop Off Time</option>');
                    $.each(res, function(key, value) {
                        $("#returntime").append(`<option value="${value}">${value}</option>`);
                    });
                }
            }else{
                $("#returntime").html('');
            }
        }
    });
});

$("#pickupdate, #returndate, #destination, #source, #returntime, #pickuptime, #babySeat").on("change paste keyup click", function() {

    if(destinationData.length != 0 && sourceData.length != 0 && $("#pickupdate").val() != '' && $("#returndate").val() != '' && $("#pickuptime").val() != '' && $("#returntime").val() != ''){
        if ($("#pickupdate").val() < $("#returndate").val()) {
            // $(".overlay").show();

            if($('#returnLocationToggle').is(":checked")){
                var returnTo = 'on';
            }else{
                var returnTo = 'off';
            }
            if($('#babySeat').is(":checked")){
                var babySeat = 'on';
            }else{
                var babySeat = 'off';
            }
            $.ajax({
                url: baseUrl + '/check-rate',
                type: 'post',
                data: { 
                    'destinationEmirate': destinationData[0].Emirates, 
                    'destinationData': destinationData[0], 
                    'sourceEmirates': sourceData[0].Emirates, 
                    'sourceData': sourceData[0], 
                    'pickupdate': $("#pickupdate").val(),
                    'returndate': $("#returndate").val(),
                    'pickuptime': $("#pickuptime").val(),
                    'returntime': $("#returntime").val(),
                    'returntosame': returnTo,
                    'babySeat': babySeat,
                    'carId': $("#carId").val()},
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res) {

                    var str = '<ul>'+
                                '<li><img src="'+baseUrl+'/assets/images/icon-how-it-work-2.svg'+'" alt="Image not available">Rent <span id="rate-message"> AED '+res.rate+'</span></li>';
                            if(res.deposit!=0){
                                str += '<li><img src="'+baseUrl+'/assets/images/icon-service-6.svg'+'" alt="Image not available">Deposit <span id="deposit-message">AED '+res.deposit+'</span></li>';
                            }
                            if(res.emirate!=0){
                                str += '<li><img src="'+baseUrl+'/assets/images/icon-why-choose-3.svg'+'" alt="Image not available">Pick & Drop Charges <span id="emirate-message">AED '+res.emirate+'</span></li>';
                            }
                            if(res.babySeat!=0){
                                str += '<li><img src="'+baseUrl+'/assets/images/icon-service-2.svg'+'" alt="Image not available">Baby Seat Charges <span id="emirate-message">AED '+res.babySeat+'</span></li>';
                            }
                                str += '<li><img src="'+baseUrl+'/assets/images/icon-service-2.svg'+'" alt="Image not available">VAT <span id="vat-message">AED '+res.vat+'</span></li>'+
                                '<li><img src="'+baseUrl+'/assets/images/icon-service-2.svg'+'" alt="Image not available">Total <span id="total-message">AED '+res.total+'</span></li>'+
                                '</ul>';
                    $("#rate-details").show();
                    $("#rate-details").html(str);
                    $("#additionalNotes").show();
                    // $(".overlay").hide();
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

    $("#agreePolicy").click(function() {
        if ($(this).prop('checked')==true){ 
            $('#bookNowButton').removeClass('disabled')
        }else{
            $('#bookNowButton').addClass('disabled');
        }
    });

function bookCarAction(){
    $(".overlay").show();
    if(destinationData.length>0 && sourceData.length>0){
        $.ajax({
            url: baseUrl + '/check-car-booking',
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
                'userId': $("#userId").val(),
                'type': 'default'
            },
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                $(".overlay").hide();
                if(res.status==200){
                    bookCarActionFinal()
                }else{
                    $("#booking-errors").html('<span style="color:red;">Booking cannot be done in these days.</span>');
                    setTimeout(function () {
                        $('#booking-errors').html('');
                    }, 2500);
                }
                
            }
        });
    }else{
        $(".overlay").hide();
        return false;
    }

}

function bookCarActionFinal(){
    $(".overlay").show();
    if($('#babySeat').is(":checked")){
        var babySeat = 'on';
    }else{
        var babySeat = 'off';
    }
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
            'babySeat': babySeat,
            'carId': $("#carId").val(),
            'userId': $("#userId").val()
        },
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            $(".overlay").hide();
            if(res.status==200){
                $.magnificPopup.open({
                    items: {
                        src: '#bookingConfirm',
                        type: 'inline'
                    }
                });
                // var str = '<span style="color:green;">Car Booked.<br> Booking ID:'+res.bookingId+'</span>';

                var babySeat = (res.bookingData["babySeat"]=='on')?'Included':'Not Included';
                var str = '<table class="table booking-table">'+
                                        '<tbody>'+
                                            '<tr>'+
                                                '<th>Booking ID:</th>'+
                                                '<td>'+res.bookingId+'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<th>Pickup Date:</th>'+
                                                '<td>'+res.bookingData["pickupdate"]+'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<th>Dropoff Date:</th>'+
                                                '<td>'+res.bookingData["returndate"]+'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<th>Pickup Time:</th>'+
                                                '<td>'+res.bookingData["pickuptime"]+'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<th>Dropoff Time:</th>'+
                                                '<td>'+res.bookingData["returntime"]+'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<th>Baby Seat:</th>'+
                                                '<td>'+ babySeat +'</td>'+
                                            '</tr>'+
                                        '</tbody>'+
                                    '</table>';
                $("#booking-details").html(str);
                setTimeout(function () {
                    location.reload();
                }, 10000);
            }else{
                var str = '<span style="color:red;">'+res.message+'</span>'
                $("#booking-errors").html(str);
            }
            
        }
    });


}

$(".policy-link").click(function () {

    $.ajax({
        url: baseUrl + '/policies-agreements',
        type: 'post',
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            var str = '';
            $.each(res.policy, function (index,value) {
                str += '<div class="accordion-item wow fadeInUp">'+
                    '<h2 class="accordion-header" id="rentalheading1">'+
                        '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rentalcollapse'+index+'" aria-expanded="false" aria-controls="rentalcollapse'+index+'">'+value.name+'</button>'+
                    '</h2>'+
                    '<div id="rentalcollapse'+index+'" class="accordion-collapse collapse" aria-labelledby="rentalheading'+index+'" data-bs-parent="#rentalaccordion">'+
                        '<div class="accordion-body">'+
                            '<p>'+nl2br(value.content)+'</p>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            });
            
            $("#rentalaccordion").html(str);
            $.magnificPopup.open({
                items: {
                    src: '#termsCondition',
                    type: 'inline'
                }
            });
        }
    });
});

function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}
</script>

<script>
  // JavaScript to move the sections dynamically on mobile
window.addEventListener('load', function() {
    if (window.innerWidth <= 768) {
        const fleetsSection = document.querySelector('.fleets-single-slider');
        const pricingTable = document.querySelector('.pricing-table');
        const pageHeader = document.querySelector('.page-header'); // Reference to the page header

        if (fleetsSection && pricingTable && pageHeader) {
            // Insert fleets section just after the page header
            pageHeader.parentNode.insertBefore(fleetsSection, pageHeader.nextSibling);
            
            // Insert pricing table just after the fleets section
            fleetsSection.parentNode.insertBefore(pricingTable, fleetsSection.nextSibling);
        }
    }
});
</script>
@endsection