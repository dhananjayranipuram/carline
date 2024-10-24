@extends('layouts.site')

@section('content')
<!-- Page Feets Single Start -->
<div class="page-fleets-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Feets Single Sidebar Start -->
                    <div class="fleets-single-sidebar">
                        <div class="fleets-single-sidebar-box wow fadeInUp">
                            <!-- Feets Single Sidebar Pricing Start -->
                            <div class="fleets-single-sidebar-pricing">
                                <h2>AED {{$carDet[0]->rent}}<span>/ DAY</span></h2>
                                @if($carDet[0]->offer_flag==1)
                                    <h2>Offer Price {{$carDet[0]->offer_price}}<span>/ DAY</span></h2>
                                @endif
                            </div>
                            <!-- Feets Single Sidebar Pricing End -->

                            <!-- Feets Single Sidebar List Start -->
                            <div class="fleets-single-sidebar-list">
                                <ul>
                                    @foreach($specs as $key => $value)
                                    <li><img src="{{asset($value->image)}}" alt="">{{$value->name}} <span>{{$value->details}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Feets Single Sidebar List End -->

                            <!-- Feets Single Sidebar Btn Start -->
                            <div class="fleets-single-sidebar-btn">
                                <a href="#" class="btn-default popup-with-form book-now-form">book now</a>
                                <span>or</span>
                                <a href="#" class="wp-btn"><i class="fa-brands fa-whatsapp"></i></a>                                
                            </div>
                            <!-- Feets Single Sidebar Btn End -->
                        </div>

                        <!-- Booking Form Box Start -->
                        <div class="booking-form-box">
                            <!-- Booking PopUp Form Start -->
                            <div id="registrationForm" class="white-popup-block mfp-hide booking-form">
                                <div class="section-title">
                                    <h2>Registration</h2>
                                </div>                                
                                <fieldset>
                                    <div class="row">
                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" id="firstName" class="booking-form-control" placeholder="First Name" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" id="lastName" class="booking-form-control" placeholder="Last Name" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="email" id ="email" class="booking-form-control" placeholder="Enter Your Email" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" id="phone" class="booking-form-control" placeholder="Enter Your Mobile Number" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="password" id="password" class="booking-form-control" placeholder="Password" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" id="flat" class="booking-form-control" placeholder="Flat/Villa number" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" id="building" class="booking-form-control" placeholder="Building name" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" id="landmark" class="booking-form-control" placeholder="Landmark" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" id="city" class="booking-form-control" placeholder="City" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <select class="booking-form-control form-select" id="emirates" required>
                                                <option value="" disabled selected>Emirates</option>
                                                @foreach($emirates as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="row" id="otp-section">
                                            <div class="col-md-12 mb-12 pb-2">
                                                <div class="otpSection">
                                                    <p class="otpSentTo">OTP has been sent to your email address.</p>
                                                    <!-- <p class="resend">Resend otp after <span class="countdown"></span></p> -->
                                                    <h3>Enter OTP</h3>
                                                    <div class="otp-field">
                                                        <input type="text" maxlength="1" />
                                                        <input type="text" maxlength="1" />
                                                        <input class="space" type="text" maxlength="1" />
                                                        <input type="text" maxlength="1" />
                                                        <input type="text" maxlength="1" />
                                                        <input type="text" maxlength="1" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-12 pb-2" id="errorMessages">

                                            </div>
                                        </div>
                                        <div class="col-md-12 booking-form-group send-otp-button">
                                            <button type="submit" class="btn-default send-otp">Send OTP</button>
                                            <div id="msgSubmit" class="h3 hidden"></div>
                                        </div>
                                        <div class="col-md-12 booking-form-group register-user" style="display:none;">
                                            <button type="submit" class="btn-default register-button">Register Now</button>
                                            <div id="msgSubmit" class="h3 hidden"></div>
                                        </div>
                                    </div>                                    
                                </fieldset>
                            </div>
                            <!-- Registration PopUp Form End -->
                        </div>
                        <!-- Registration Form Box End -->
                        
                        <!-- Booking Form Box Start -->
                        <div class="booking-form-box">
                            <!-- Booking PopUp Form Start -->
                            <form id="bookingform" class="white-popup-block mfp-hide booking-form">
                                <div class="section-title">
                                    <h2>Reserve your vehicle today!</h2>
                                    <p>Fill out the form below to reserve your vehicle. Complete the necessary details to ensure a smooth rental experience.</p>
                                </div>                                
                                <fieldset>
                                    <div class="row">
                                    <input type="hidden" id="userId" value="@if(session()->has('userId')){{Session::get('userId')}}@endif">

                                        <div class="booking-form-group col-md-6 mb-4" id="locationField">
                                            <input id="source" type="text" placeholder="Enter Pick Up Location" />
                                            <!-- <select name="location" class="booking-form-control form-select" id="pickuplocation" required>
                                                <option value="" disabled selected>Pick Up Location</option>
                                                <option value="abu_dhabi">abu dhabi</option>
                                                <option value="alain">alain</option>
                                                <option value="dubai">dubai</option>
                                                <option value="sharjah">sharjah</option>
                                            </select> -->
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="date" placeholder="PickUp Date" class="booking-form-control datepicker" id="pickupdate" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <select name="droplocation" class="booking-form-control form-select" id="droplocation" required>
                                                <option value="" disabled selected>Drop Off Location</option>
                                                <option value="abu_dhabi">abu dhabi</option>
                                                <option value="alain">alain</option>
                                                <option value="sharjah">sharjah</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="date" class="booking-form-control datepicker" id="returndate" placeholder="Return Date" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-md-12 booking-form-group">
                                            <button type="submit" class="btn-default">rent now</button>
                                            <div id="msgSubmit" class="h3 hidden"></div>
                                        </div>
                                    </div>                                    
                                </fieldset>
                            </form>
                            <!-- Booking PopUp Form End -->
                        </div>
                        <!-- Booking Form Box End -->
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

                       
                        <h2>{{$carDet[0]->brand_name}} {{$carDet[0]->name}} - {{$carDet[0]->model}} Model</h2>
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
    
<script>
    
    var source = new google.maps.places.Autocomplete(document.getElementById('source'));



    function fillInAddress() {
    var place = source.getPlace();

    // Get the latitude and longitude of the location
    var lat = place.geometry.location.lat();
    var lng = place.geometry.location.lng();
    console.log(lat)
    console.log(lng)
    }

    // Listen for when the user selects a location from the autocomplete dropdown
    source.addListener('place_changed', fillInAddress);
</script>
@endsection