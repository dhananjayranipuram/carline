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
    .with-errors{
        color:red;
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
    /* ul{
        color: var(--white-color);
        margin: 0;
        font-weight: normal;
    } */
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
        display: block;
    }
}
    </style>
<style>
        /* General Popup Styles */
.carline-popup {
    display: none; /* Hidden by default */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Overlay effect */
    z-index: 1050; /* Above other content */
    overflow: auto; /* Enable scrolling */
}

.carline-popup-content {
    background: #fff;
    margin: 5% auto;
    padding: 20px;
    width: 90%;
    max-width: 800px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    font-family: 'Poppins Semibold', sans-serif;
}

/* Close Button */
.carline-close-btn {
    float: right;
    font-size: 1.5em;
    cursor: pointer;
    color: #333;
}

/* Two-Column Container */
.carline-terms-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 10px;
}

.carline-terms-column {
    flex: 1;
    min-width: 300px;
    max-height: 400px; /* Set scrollable height */
    overflow-y: auto; /* Scrollbar for overflow */
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background: #f9f9f9;
}

/* Column Content Styling */
.carline-terms-column h3 {
    font-family: 'Copperplate Gothic', sans-serif;
    margin-top: 0;
}

.carline-terms-column p {
    line-height: 1.5;
    margin: 10px 0;
}

.rental-condition-accordion h3{
    font-size: 1.25rem;
}

.rental-condition-accordion b,li{
    color: black;
}
    </style>
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
	<!-- Page Header End -->

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
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Terms & Conditions</h2>
                            </div>
                            <!-- Section Title End -->
                            <div class="rental-condition-accordion" id="rentalaccordion">
                                <div class="row">
                                    <div class="col-md-6 mb-4 first-section">
                                        
                                    </div>
                                    <div class="col-md-6 mb-4 second-section">
                                        
                                    </div>
                                </div>
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
                                <form id="contactForm" action="{{ url('/payment/initiate') }}" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.5s" novalidate="true" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                    @csrf
                                    <div class="row">
                                        
                                        <!-- Pickup Location -->
                                        <div class="form-group col-12 mb-4">
                                            <input class="form-control" id="source" type="text" placeholder="Pick Up Location" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        
                                        <!-- Pickup Date -->
                                        <div class="form-group col-12 mb-4">
                                            <label>Pickup Date</label>
                                            <input type="text" name="pickup_date" placeholder="DD-MM-YYYY" class="form-control" id="pickupdate-hidden" required min="{{ date('d-m-Y') }}" >
                                            <input type="hidden" id="pickupdate" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        
                                        <!-- Pickup Time -->
                                        <div class="form-group col-12 mb-4">
                                            <label>Pickup Time</label>
                                            <select class="form-control" name="pickup_time" id="pickuptime">
                                                <option selected disabled value="">Select Pickup Time</option>
                                                
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
                                                <input type="text" name="dropoff_date" placeholder="DD-MM-YYYY" class="form-control" id="returndate-hidden" required min="{{ date('d-m-Y') }}">
                                                <input type="hidden" id="returndate" />
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            
                                            <!-- Dropoff Time -->
                                            <div class="form-group col-12 mb-4">
                                                <label>Dropoff Time</label>
                                                <!-- <input type="time" class="form-control" name="dropoff_time" id="returntime"> -->
                                                <select class="form-control" name="dropoff_time" id="returntime">
                                                    <option selected disabled value="">Select Dropoff Time</option>
                                                    
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="form-group col-12 mb-4">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" id="babySeat" name="baby_seat"><label for="babySeatToggle">Baby Seat</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="fleets-single-sidebar-list" id="rate-details" style="display:none;">
                                            <ul>
                                                <li><img src="{{asset('assets/images/icon-how-it-work-2.svg')}}" alt="">Rate <span id="rate-message"> AED 1500</span></li>
                                                <li><img src="{{asset('assets/images/icon-service-2.svg')}}" alt="">Refundable Deposit <span id="deposit-message">AED 100</span></li>
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
                                            <input type="checkbox" id="agreePolicy"> I have read and agree to Carline's <span class="policy-link">Terms & Conditions</span>
                                        </div>

                                        <!-- Feets Single Sidebar Btn Start -->
                                        <div class="fleets-single-sidebar-btn">
                                            <a href="#" class="btn-default popup-with-form book-now-form disabled" id="bookNowButton">book now</a>
                                            @if($carDet[0]->online_flag != 0 && $carDet[0]->whatsapp_flag != 0)
                                                <span>or</span>
                                            @endif
                                            @if($carDet[0]->online_flag == 0)
                                                @if($carDet[0]->whatsapp_flag != 0)
                                                    <a class="btn-default wp-msg-button">book now <i class="fa-brands fa-whatsapp"></i></a>
                                                @endif
                                            @else
                                                @if($carDet[0]->whatsapp_flag != 0)
                                                    <a class="wp-btn wp-msg-button"><i class="fa-brands fa-whatsapp"></i></a>
                                                @endif
                                            @endif
                                        </div>

                                        <div class="fleets-single-sidebar-list" id="booking-errors"></div>
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
                                <!-- Navigation Arrows -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
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
                                        <li class="additional-charges" style="display:none;"><img src="{{asset('assets/images/tower.svg')}}" alt="">Salik ? Toll charges<span>{{$carDet[0]->toll_charges}}/Salik or toll</span></li>
                                        <li class="additional-charges" style="display:none;"><img src="{{asset('assets/images/petrol.svg')}}" alt="">Fuel policy <span>Same to Same</span></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        @foreach($pieces[1] as $key => $value)
                                        <li><img src="{{asset($value->image)}}" alt="">{{$value->name}} <span>{{$value->details}}</span></li>
                                        @endforeach
                                        <li class="additional-charges" style="display:none;"><img src="{{asset('assets/images/milage.svg')}}" alt="">Additional mileage charges<span>{{$carDet[0]->add_mileage_charge}}/km</span></li>
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


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('admin_assets/js/moment.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.43/moment-timezone-with-data.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmX5w5ltGt09cjDod_YMamphRRgS8L-ZQ&components=country:ae&libraries=places"></script>
<script src="{{asset('assets/js/swiper-bundle.min.js')}}"></script>
<script>
var swiper = new Swiper(".swiper", {
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});


var sourceData = [];
var destinationData = [];    
var onlineFlag = '{{$carDet[0]->online_flag}}';

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


    var disabledDates = [];
    $.ajax({
        url: baseUrl + '/get-available-dates',
        type: 'post',
        data: {
            'carId': $("#carId").val()},
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            disabledDates = res;
        }
    });

    function disableDates(date) {
        const myDate = moment(date, "YYYY-MM-DD");
        const formattedDate = myDate.format("YYYY-MM-DD");
        return [!disabledDates.includes(formattedDate)];
    }

    $("#pickupdate-hidden").datepicker({
        dateFormat: "dd-mm-yy",
        altField: "#pickupdate",
        altFormat: "yy-mm-dd",
        minDate: 0,
        beforeShowDay: disableDates,
        
    });

    $("#returndate-hidden").datepicker({
        dateFormat: "dd-mm-yy",
        altField: "#returndate",
        altFormat: "yy-mm-dd",
        minDate: 0,
        beforeShowDay: disableDates
    });
    
$(document).ready(function () { 

    if(onlineFlag == 0){
        $('#bookNowButton').hide();
        $('#bookNowButton').closest('.fleets-single-sidebar-btn').find('span').hide();
    }
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

            isAirport = isAirportPlace(place);

            place.address_components.forEach(function(component) {
                if (component.types.includes('administrative_area_level_1')) {
                    emiratesName = component.long_name; // Get the Emirates name
                }
                tempAddress += component.long_name+',';
            });

            if (!isAirport) {
                sourceData = [];
                sourceData.push({
                    'placeName': place.name,
                    'Latitude': lat,
                    'Longitude': lng,
                    'Emirates': emiratesName,
                    'Address': place.name + ',' + tempAddress,
                });
            } else {
                $("#source").css('border-color', 'red');
                $("#source").closest('div').find('.with-errors').html('Cannot pickup from airports.');
                $("#source").val('');
                sourceData = [];
                setTimeout(function () {
                    $("#source").css('border-color', '');
                    $("#source").closest('div').find('.with-errors').html('');
                }, 2500);
            }
            checkRate();
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

            isAirport = isAirportPlace(place);

            place.address_components.forEach(function(component) {
                if (component.types.includes('administrative_area_level_1')) {
                    emiratesName = component.long_name; // Get the Emirates name
                }
                tempAddress += component.long_name+',';
            });

            if (!isAirport) {
                destinationData = [];
                destinationData.push({
                    'placeName': place.name,
                    'Latitude': lat,
                    'Longitude': lng,
                    'Emirates': emiratesName,
                    'Address': place.name + ',' + tempAddress,
                });

            } else {
                $("#destination").css('border-color', 'red');
                $("#destination").closest('div').find('.with-errors').html('Cannot drop off to airports.');
                $("#destination").val('');
                destinationData = [];
                setTimeout(function () {
                    $("#destination").css('border-color', '');
                    $("#destination").closest('div').find('.with-errors').html('');
                }, 2500);
               
            }
            checkRate();
        } else {
            console.log('No geometry data found for this place.');
        }
    });

    

});

function isAirportPlace(place) {
    let isAirport = false;

    const placeName = place.name ? place.name.toLowerCase() : '';
    const formattedAddress = place.formatted_address ? place.formatted_address.toLowerCase() : '';

    if (place.types && place.types.includes('airport')) {
        isAirport = true;
    }

    if (placeName.includes('airport') || formattedAddress.includes('airport') ||
        placeName.includes('terminal 1') || formattedAddress.includes('terminal 1') ||
        placeName.includes('terminal 2') || formattedAddress.includes('terminal 2') ||
        placeName.includes('terminal 3') || formattedAddress.includes('terminal 3')) {
        isAirport = true;
    }

    if (place.address_components) {
        place.address_components.forEach(component => {
            const longName = component.long_name ? component.long_name.toLowerCase() : '';
            if (longName.includes('terminal 1') || longName.includes('terminal 2') || longName.includes('terminal 3')) {
                isAirport = true;
            }
        });
    }

    return isAirport;
}

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

$("#pickupdate-hidden").on("change", function() {
    var pickupDate = moment($("#pickupdate").val());
    var returnDate = moment($("#returndate").val());

    if (pickupDate.isBefore(returnDate)) {
        
    } else if (pickupDate.isSame(returnDate)) {
        
    } else if (pickupDate.isAfter(returnDate)) {
        $("#returndate").val('');
        $("#pickuptime").html('');
        $("#booking-errors").append('<span style="color:red;">Pickup date must be before return date.</span>');
        setTimeout(function () {
            $('#booking-errors').html('');
        }, 2500);
    }

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
                $("#pickuptime").html('');
                $("#pickuptime").append('<option selected disabled value="-1">Select Pickup Time</option>');
                if(res!="Invalid time range"){
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

$("#returndate-hidden").on("change", function() {
    var pickupDate = moment($("#pickupdate").val());
    var returnDate = moment($("#returndate").val());

    if (pickupDate.isBefore(returnDate)) {
        
    } else if (pickupDate.isSame(returnDate)) {

    } else if (pickupDate.isAfter(returnDate)) {
        $("#returndate").val('');
        $("#pickuptime").html('');
        $("#booking-errors").append('<span style="color:red;">Pickup date must be before return date.</span>');
        setTimeout(function () {
            $('#booking-errors').html('');
        }, 2500);
    }
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
                
                $("#returntime").html('');
                $("#returntime").append('<option selected disabled value="-1">Select Dropoff Time</option>');
                if(res!="Invalid time range"){
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

$("#pickuptime, #returntime").change(function () {

    if ($("#pickupdate").val() != '' && $("#pickupdate").val() != null &&
        $("#returndate").val() != '' && $("#returndate").val() != null &&
        $("#pickuptime").val() != '' && $("#pickuptime").val() != null &&
        $("#returntime").val() != '' && $("#returntime").val() != null) {
        
        var timezone = "Asia/Dubai";
        var pickupDateTime = moment.tz($("#pickupdate").val() + " " + $("#pickuptime").val(), timezone);
        var returnDateTime = moment.tz($("#returndate").val() + " " + $("#returntime").val(), timezone);

        if (returnDateTime.isSameOrAfter(pickupDateTime.clone().add(2, 'hours'))) {
            checkRate();
        } else {
            $("#rate-details").hide();
            $(".additional-charges").hide();
            $("#booking-errors").append('<span style="color:red;">Return time must be at least 2 hours after the pickup time.</span>');
            setTimeout(function () {
                $('#booking-errors').html('');
            }, 2500);
            $("#returntime").val('');
        }
    }

});

$("#pickupdate-hidden, #returndate-hidden, #babySeat").on("change paste keyup click", function() {

    checkRate();
});

function checkRate(){
    if(destinationData.length != 0 && sourceData.length != 0 && $("#pickupdate").val() != '' && $("#returndate").val() != '' && $("#pickuptime").val() != '' && $("#returntime").val() != ''){
        if (moment($("#pickupdate").val()).isSameOrBefore($("#returndate").val())) {
            // $(".overlay").show();

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
                    'returntosame': $('#returnLocationToggle').is(":checked") ? 'on' : 'off',
                    'babySeat': $('#babySeat').is(":checked") ? 'on' : 'off',
                    'carId': $("#carId").val()},
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res) {
                    updateRateDetails(res);
                },error: function(xhr, status, error) {
                    $("#rate-details").hide();
                    $(".additional-charges").hide();
                }
            });
        }else{
            $("#booking-errors").append('<span style="color:red;">Pickup date must be before return date1.</span>');
            setTimeout(function () {
                $('#booking-errors').html('');
            }, 2500);
        }
    }
}

function updateRateDetails(res) {
    let str = `<ul>
        <li><img src="${baseUrl}/assets/images/icon-how-it-work-2.svg" alt="Image not available">Rent <span id="rate-message">AED ${res.rate}</span></li>`;
    if (res.deposit!=0) str += `<li><img src="${baseUrl}/assets/images/icon-service-6.svg" alt="Image not available">Refundable Deposit <span id="deposit-message">AED ${res.deposit}</span></li>`;
    if (res.emirate!=0) str += `<li><img src="${baseUrl}/assets/images/icon-why-choose-3.svg" alt="Image not available">Pick & Drop Charges <span id="emirate-message">AED ${res.emirate}</span></li>`;
    if (res.babySeat!=0) str += `<li><img src="${baseUrl}/assets/images/icon-service-2.svg" alt="Image not available">Baby Seat Charges <span id="emirate-message">AED ${res.babySeat}</span></li>`;
    str += `<li><img src="${baseUrl}/assets/images/icon-service-2.svg" alt="Image not available">VAT <span id="vat-message">AED ${res.vat}</span></li>
        <li><img src="${baseUrl}/assets/images/icon-service-2.svg" alt="Image not available">Total <span id="total-message">AED ${res.total}</span></li>
        </ul>`;

    $("#rate-details").show().html(str);
    $(".additional-charges").show();
}

    $(".book-now-form").click(function () {
        if($("#userId").val()==''){
            if(!validateBookingForm()){
                $.magnificPopup.open({
                    items: {
                        src: '#registrationForm', 
                        type: 'inline'
                    }
                });
            }
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
        if($('#babySeat').is(":checked")){
            var babySeat = 'on';
        }else{
            var babySeat = 'off';
        }
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
                'type': 'default',
                'babySeat': babySeat,
            },
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                // $(".overlay").hide();
                if(res.status==200){
                    $('#contactForm').submit();
                    // makePayment()
                    // bookCarActionFinal()
                }else{
                    $("#booking-errors").html('<span style="color:red;">Booking cannot be done in these days.</span>');
                    
                    $('html, body').animate({
                        scrollTop: $('#booking-errors').offset().top
                    }, 1000);
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

function makePayment(){
    $.ajax({
        url: baseUrl + '/payment/initiate',
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
                // bookCarActionFinal()
            }else{
                $("#booking-errors").html('<span style="color:red;">Booking cannot be done in these days.</span>');
                setTimeout(function () {
                    $('#booking-errors').html('');
                }, 2500);
            }
            
        }
    });
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
            var str1 = str2 = '';
            var indexToSplit = res.policy.length/2;
            var first = res.policy.slice(0, indexToSplit);
            var second = res.policy.slice(indexToSplit);

            $.each(first, function (index,value) {
                str1 += '<b>'+value.name+'</b>'+
                        '<p style="color:black;">'+nl2br(value.content)+'</p>';
            });

            $.each(second, function (index,value) {
                str2 += '<b>'+value.name+'</b>'+
                        '<p style="color:black;">'+nl2br(value.content)+'</p>';
            });
            
            $(".first-section").html(str1);
            $(".second-section").html(str2);
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

function validateBookingForm(){

    chk = 0;
    if($("#source").val() == ''){
        chk = 1;
        $("#source").css('border-color', 'red');
        $("#source").closest('div').find('.with-errors').html('Pickup location should not be blank.');
    }else{
        $("#source").css('border-color', '');
        $("#source").closest('div').find('.with-errors').html('');
    }
    if($("#pickupdate").val() == ''){
        chk = 1;
        $("#pickupdate").css('border-color', 'red');
        $("#pickupdate").closest('div').find('.with-errors').html('Pickup date should not be blank.');
    }else if(isPreviousDate($("#pickupdate").val())){
        chk = 1;
        $("#pickupdate").css('border-color', 'red');
        $("#pickupdate").closest('div').find('.with-errors').html('Pickup date should not be older than todays.');
    }else{
        $("#pickupdate").css('border-color', '');
        $("#pickupdate").closest('div').find('.with-errors').html('');
    }
    if($("#pickuptime").val() == null){
        chk = 1;
        $("#pickuptime").css('border-color', 'red');
        $("#pickuptime").closest('div').find('.with-errors').html('Pickup time should not be blank.');
    }else{
        $("#pickuptime").css('border-color', '');
        $("#pickuptime").closest('div').find('.with-errors').html('');
    }
    if($("#destination").val() == ''){
        chk = 1;
        $("#destination").css('border-color', 'red');
        $("#destination").closest('div').find('.with-errors').html('Dropoff location should not be blank.');
    }else{
        $("#destination").css('border-color', '');
        $("#destination").closest('div').find('.with-errors').html('');
    }
    if($("#returndate").val() == ''){
        chk = 1;
        $("#returndate").css('border-color', 'red');
        $("#returndate").closest('div').find('.with-errors').html('Dropoff date should not be blank.');
    }else if(isPreviousDate($("#returndate").val())){
        chk = 1;
        $("#returndate").css('border-color', 'red');
        $("#returndate").closest('div').find('.with-errors').html('Dropoff date should not be older than todays.');
    }else{
        $("#returndate").css('border-color', '');
        $("#returndate").closest('div').find('.with-errors').html('');
    }
    if($("#returntime").val() == null){
        chk = 1;
        $("#returntime").css('border-color', 'red');
        $("#returntime").closest('div').find('.with-errors').html('Dropoff time should not be blank.');
    }else{
        $("#returntime").css('border-color', '');
        $("#returntime").closest('div').find('.with-errors').html('');
    }
    
    return chk;
}

function isPreviousDate(inputDate) {
    
    var date = new Date(inputDate);
    var today = new Date();
    today.setHours(0, 0, 0, 0);
    
    return date < today;
}

$(".wp-msg-button").click(function () {
    // if(!validateBookingForm()){

        $.ajax({
            url: baseUrl + '/get-whatsapp-msg',
            type: 'post',
            data: { 
                'destinationData': destinationData?.[0] || null, 
                'sourceData': sourceData?.[0] || null, 
                'destinationEmirate': destinationData?.[0]?.Emirates || null, 
                'sourceEmirates': sourceData?.[0]?.Emirates || null,
                'pickupdate': $("#pickupdate").val() || null,
                'returndate': $("#returndate").val() || null,
                'pickuptime': $("#pickuptime").val() || null,
                'returntime': $("#returntime").val() || null,
                'babySeat': $('#babySeat').is(":checked") ? 'on' : 'off',
                'carId': $("#carId").val() || null
            },
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                const phone = 971508689526;
                const message = res.message;
                const url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
                window.open(url, '_blank');
            }
        });
        
    // }
});
</script>

@endsection