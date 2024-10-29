@extends('layouts.site')

@section('content')
<!-- Page Feets Single Start -->
<style>
    .pac-container {
        z-index: 10000;
    }

    
</style>
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
                                        <div class="col-md-12 booking-form-group send-otp-button">
                                            <label >Already registered? <a id="loginPopup" style="cursor:pointer; color:blue;">Login here</a></label>
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
                            <div id="bookingform" class="white-popup-block mfp-hide booking-form">
                                <div class="section-title">
                                    <h2>Reserve your vehicle today!</h2>
                                    <p>Fill out the form below to reserve your vehicle. Complete the necessary details to ensure a smooth rental experience.</p>
                                </div>                                
                                <fieldset>
                                    <div class="row">
                                    <input type="hidden" id="userId" value="@if(session()->has('userId')){{Session::get('userId')}}@endif">

                                        <div class="booking-form-group col-md-6 mb-4" >
                                            <input class="booking-form-control" id="source" type="text" placeholder="Pick Up Location" />
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
                                            <input class="booking-form-control" id="destination" type="text" placeholder="Drop Off Location" />
                                            <!-- <select name="droplocation" class="booking-form-control form-select" id="droplocation" required>
                                                <option value="" disabled selected>Drop Off Location</option>
                                                <option value="abu_dhabi">abu dhabi</option>
                                                <option value="alain">alain</option>
                                                <option value="sharjah">sharjah</option>
                                            </select> -->
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="date" placeholder="PickUp Date" class="booking-form-control" id="pickupdate" required min="{{ date('Y-m-d') }}" onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'">
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="date" class="booking-form-control" id="returndate" placeholder="Return Date" required min="{{ date('Y-m-d') }}" onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'">
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="date" placeholder="PickUp Time" class="booking-form-control" id="pickuptime" required min="{{ date('Y-m-d') }}" onfocus="(this.type='time')" onblur="if(!this.value) this.type='text'">
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="date" class="booking-form-control" id="returntime" placeholder="Return Time" required min="{{ date('Y-m-d') }}" onfocus="(this.type='time')" onblur="if(!this.value) this.type='text'">
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-md-12 booking-form-group">
                                        
                                            <button type="submit" class="btn-default save-car-booking">Book now</button>
                                            <div id="msgSubmit" class="h3 hidden"></div>
                                            <div id="rent-message"></div>
                                        </div>
                                    </div>                                    
                                </fieldset>
                            </div>
                            <!-- Booking PopUp Form End -->
                        </div>
                        <!-- Booking Form Box End -->

                        <!-- Login Form Box Start -->
                        <div class="booking-form-box">
                            <!-- Booking PopUp Form Start -->
                            <div id="loginForm" class="white-popup-block mfp-hide booking-form">
                                <div class="section-title">
                                    <h2>Login</h2>
                                </div>                                
                                <fieldset>
                                    <div class="row">
                                        <div class="booking-form-group col-md-12 mb-4" >
                                            <input class="booking-form-control" id="userName" type="text" placeholder="Enter your email" />
                                            <div class="help-block with-errors"></div>
                                        </div>   

                                        <div class="booking-form-group col-md-12 mb-4">
                                            <input class="booking-form-control" id="userPassword" type="password" placeholder="Enter your password." />
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-12 mb-4" id="loginErrors">
                                            
                                        </div>

                                        <div class="booking-form-group col-md-12 mb-4">
                                            <button type="button" class="btn-default login_button">Login</button>
                                            <div id="login" class="h3 hidden"></div>
                                        </div>
                                        <div class="col-md-12 booking-form-group send-otp-button">
                                            <label >Not registered? <a id="registrationPopup" style="cursor:pointer; color:blue;">Register here</a></label>
                                        </div>
                                    </div>                                    
                                </fieldset>
                            </div>
                            <!-- Booking PopUp Form End -->
                        </div>
                        <!-- Login Form Box End -->

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
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>  
<!-- <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmX5w5ltGt09cjDod_YMamphRRgS8L-ZQ&libraries=places"></script>
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
            console.log(sourceData)
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
            console.log( destinationData);
        } else {
            console.log('No geometry data found for this place.');
        }
    });
});


$("#pickupdate, #returndate, #destination, #source, #returntime, #pickuptime").on("change paste keyup click", function() {

    // console.log('source'+sourceData.length)
    // console.log('destination'+destinationData.length)
    // console.log('pickupdate'+$("#pickupdate").val())
    // console.log('returndate'+$("#returndate").val())
    if(destinationData.length != 0 && sourceData.length != 0 && $("#pickupdate").val() != '' && $("#returndate").val() != '' && $("#pickuptime").val() != '' && $("#returntime").val() != ''){
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
                'id': $("#carId").val()},
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                var str = '<h2>Rent : '+res.total+' AED</h2>'
                $("#rent-message").html(str);
                
            }
        });
    }
});

$(".save-car-booking").click(function() {

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
                $("#rent-message").html(str);
                $.magnificPopup.close();
            }else{
                var str = '<span style="color:red;">'+res.message+'</span>'
                $("#rent-message").html(str);
            }
            
        }
    });
});


</script>
@endsection