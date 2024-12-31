<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Awaiken">
    <meta content="{{ csrf_token() }}" name="csrf-token">
	<!-- Page Title -->
	<title>Home - CarLine</title>
	<!-- Favicon Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}">
	<!-- Google Fonts Css-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<!-- Bootstrap Css -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
	<!-- SlickNav Css -->
	<link href="{{asset('assets/css/slicknav.min.css')}}" rel="stylesheet">
	<!-- Swiper Css -->
	<link rel="stylesheet" href="{{asset('assets/css/swiper-bundle.min.css')}}">
	<!-- Font Awesome Icon Css-->
	<link href="{{asset('assets/css/all.css')}}" rel="stylesheet" media="screen">
	<!-- Animated Css -->
	<link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
	<!-- Magnific Popup Core Css File -->
	<link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
	<!-- Mouse Cursor Css File -->
	<link rel="stylesheet" href="{{asset('assets/css/mousecursor.css')}}">
	<!-- Main Custom Css -->
	<link href="{{asset('assets/css/custom.css')}}?v={{time()}}" rel="stylesheet" media="screen">
    <script> var baseUrl = "{{ url('/') }}"; </script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=places" async defer ></script> -->
    
</head>
<style>
#otp-section{
    display:none;
}
.otp-field {
    display: flex;
}
.otp-field input {
    height: 30px;
    width: 100%;
    font-size: 32px;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    background-color: #d3d3d388;
    border: 2px solid #dad4e5;
    margin: 2px;
    font-weight: bold;
    color: #181313;
    outline: none;
    transition: all 0.1s;
}
.otp-field input:focus {
    border: 2px solid #878689;
    box-shadow: 0 0 2px 2px #878689;
}
.disabled {
    opacity: 0.5;
}
.space {
    margin-right: 1rem !important;
}

.otp-field-forgot {
    display: flex;
}
.otp-field-forgot input {
    height: 30px;
    width: 100%;
    font-size: 32px;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    background-color: #d3d3d388;
    border: 2px solid #dad4e5;
    margin: 2px;
    font-weight: bold;
    color: #181313;
    outline: none;
    transition: all 0.1s;
}
.otp-field-forgot input:focus {
    border: 2px solid #878689;
    box-shadow: 0 0 2px 2px #878689;
}
@keyframes spin {
    100% {
    transform: rotate(360deg);
    }
}


.overlay {
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    position: fixed;
    background: #22222296;
    display:none;
    z-index: 10000000;
}

.overlay__inner {
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    position: absolute;
}

.overlay__content {
    left: 50%;
    position: absolute;
    top: 50%;
    transform: translate(-50%, -50%);
}

.spinner {
    width: 75px;
    height: 75px;
    display: inline-block;
    border-width: 2px;
    border-color: rgba(255, 255, 255, 0.05);
    border-top-color: #fff;
    animation: spin 1s infinite linear;
    border-radius: 100%;
    border-style: solid;
}

.luxury-collection-image a::before {
        background: #00000000;
}

.perfect-fleet-item .image-box img {
    border-radius: 20px;
    height: 210px;
    width: 100%;
}

@media only screen and (max-width: 991px) {
    .perfect-fleet-item .image-box img {
        max-width: 100%;
        height: 210px !important;
    }
}


@media (max-width: 768px) {
    .header-btn-mobile {
        display: inline-flex;
        margin-right: -10px;
    }

    .btn-mobile-account {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px 10px;
        color: #000080;
        font-size: 30px;
        text-decoration: none;
        margin-right: -30px;
    }
}
@media (min-width: 769px) {
    .header-btn-mobile {
        display: none !important;
    }
}
@media only screen and (max-width: 600px) {
  .navbar-brand {
    width: 220px;
}
}
</style>
<body>
    <div class="overlay">
        <div class="overlay__inner">
            <div class="overlay__content"><span class="spinner"></span></div>
        </div>
    </div>
    <!-- Preloader Start -->
	<div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="{{asset('assets/images/loader.svg')}}" alt=""></div>
		</div>
	</div>
	<!-- Preloader End -->

    <!-- Header Start -->
	<header class="main-header">
		<div class="header-sticky">
			<nav class="navbar navbar-expand-lg">
				<div class="container">
					<!-- Logo Start -->
					<a class="navbar-brand" href="{{ url('/home') }}">
						<img src="{{asset('assets/images/logo.png')}}" alt="Logo">
					</a>
					<!-- Logo End -->

                    <!-- Main Menu Start -->
					<div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/cars') }}">Our Cars</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/offers') }}">Special Offers</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/news') }}">News</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact Us</a></li>
                                @if(session()->has('userdata') || session()->has('userId'))
                                    <li class="nav-item"><a href="{{ url('/my-account') }}" class="btn-default" style=" color: #ffffff; ">My Account</a></li>
                                @else  
                                    <li class="nav-item"><a href="javascript:void(0);" class="btn-default register-user" style=" color: #ffffff; ">My Account</a></li>
                                @endif
                            </ul>
                        </div>
					</div>
					<!-- Main Menu End -->
                    @if(session()->has('userdata') || session()->has('userId'))
					<div class="header-btn-mobile d-inline-flex">
                        <a href="{{ url('/my-account') }}" class="btn-mobile-account"><i class="fa fa-user"></i></a>
                    </div>
                    @else
                    <div class="header-btn-mobile d-inline-flex">
                        <a href="javascript:void(0);" class="btn-mobile-account register-user"><i class="fa fa-user"></i></a>
                    </div>
                    @endif
					<div class="navbar-toggle"></div>
				</div>
			</nav>
			<div class="responsive-menu"></div>
		</div>
	</header>
            <input type="hidden" id="userId" value="@if(session()->has('userId')){{Session::get('userId')}}@endif">
    
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
                                <input type="text" id="city" class="booking-form-control" placeholder="City/Emirates" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="booking-form-group col-md-6 mb-4">
                                <select class="booking-form-control form-select" id="country" required>
                                    <option value="" disabled selected>Country</option>
                                    @foreach($country as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="row" id="otp-section">
                                <div class="col-md-12 mb-12 pb-2">
                                    <div class="otpSection">
                                        <p class="otpSentTo">OTP has been sent to your email address.</p>
                                        <p class="resend">Resend otp after <span class="countdown"></span></p>
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
                                <button type="submit" class="btn-default send-otp">Create Account</button>
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
                                <input class="booking-form-control" id="userName" type="text" placeholder="Enter your email" autocomplete = "off"/>
                                <div class="help-block with-errors"></div>
                            </div>   

                            <div class="booking-form-group col-md-12 mb-4">
                                <input class="booking-form-control" id="userPassword" type="password" placeholder="Enter your password." autocomplete = "off"/>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="booking-form-group col-md-12 mb-4" id="loginErrors">
                                
                            </div>

                            <div class="booking-form-group col-md-12 mb-4">
                                <button type="button" class="btn-default login_button">Login</button>
                                <div id="login" class="h3 hidden"></div>
                            </div>
                            <div class="col-md-12 booking-form-group send-otp-button">
                                <a id="forgotpopup" style="cursor:pointer; color:blue;">Forgot Password?</a><br>
                                <label >Not registered? <a id="registrationPopup" style="cursor:pointer; color:blue;">Register here</a></label>
                            </div>
                        </div>                                    
                    </fieldset>
                </div>
                <!-- Booking PopUp Form End -->
            </div>
            <!-- Login Form Box End -->

            <!-- Login Form Box Start -->
            <div class="booking-form-box">
                <!-- Booking PopUp Form Start -->
                <div id="forgotForm" class="white-popup-block mfp-hide booking-form">
                    <div class="section-title">
                        <h2>Forgot Password</h2>
                    </div>                                
                    <fieldset>
                        <div class="row">
                            <div class="booking-form-group col-md-12 mb-4" >
                                <input class="booking-form-control" id="forgotEmailId" type="text" placeholder="Enter your email" autocomplete = "off"/>
                                <div class="help-block with-errors"></div>
                            </div>   

                            <div class="booking-form-group col-md-12 mb-4" id="resetErrors">
                                
                            </div>

                            <div class="booking-form-group col-md-12 mb-4">
                                <button type="button" class="btn-default reset_button">Send Reset Link</button>
                                <div id="login" class="h3 hidden"></div>
                            </div>
                        </div>                                    
                    </fieldset>
                </div>
                <!-- Booking PopUp Form End -->
            </div>
            <!-- Login Form Box End -->

            <div class="booking-form-box">
                <!-- Booking PopUp Form Start -->
                <div id="bookingConfirm" class="white-popup-block mfp-hide booking-form">
                    <div class="section-title" style="text-align: center;">
                        <h2 style="color: #000080; font-weight: bold;">Booking Confirmation</h2>
                    </div>                                
                    <fieldset>
                        <div class="row">
                            <div class="booking-form-group col-md-12 text-center">
                                <i class="fas fa-check-circle" style="font-size: 100px; color: #006d09; margin-bottom: 20px;"></i>
                                <div id="booking-details"></div>
                            </div>
                        </div>                                    
                    </fieldset>
                </div>
                <!-- Booking PopUp Form End -->
            </div>

            <!-- Booking Form Box Start -->
            <div class="booking-form-box">
                <!-- Booking PopUp Form Start -->
                <div id="documentUploadForm" class="white-popup-block mfp-hide booking-form">
                    <div class="section-title">
                        <h2>Document Upload</h2>
                    </div>                                
                    <fieldset>
                        <form id="uploadDocs" enctype="multipart/form-data" method="POST">
                            <input type="hidden" id="docUploadType">
                            <div class="row">
                                <div class="booking-form-group col-md-12 mb-4">
                                    <div class="row">
                                        <div class="booking-form-group col-md-6 mb-4">
                                            <label for="returnLocationToggle">Driver Type :</label>
                                            <input type="radio" class="form-check-input rider_type" name="rider_type" value="resident" checked>  <label for="rider_type">Resident</label>
                                            &nbsp;<input type="radio" class="form-check-input rider_type" name="rider_type" value="tourist">  <label for="rider_type">Tourist</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="booking-form-group col-md-12 mb-4">
                                    <div class="row" id="passport-section" style="display:none;">
                                        
                                        <div class="booking-form-group col-md-6 mb-4" id="passf" style="display:none;">
                                        <label for="returnLocationToggle">Passport Front</label>
                                            <input type="file" name="pass_front" class="booking-form-control" placeholder="Front" accept="image/*" required>
                                            <div class="help-block with-errors pass_front"></div>
                                        </div>
                                        
                                        <div class="booking-form-group col-md-6 mb-4" id="passb" style="display:none;">
                                        <label for="returnLocationToggle">Visit/Tourist Visa</label>
                                            <input type="file" name ="pass_back" class="booking-form-control" placeholder="Back" accept="image/*" required>
                                            <div class="help-block with-errors pass_back"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="booking-form-group col-md-12 mb-4">
                                    <div class="row" id="dl-section">
                                        <label for="returnLocationToggle" id="dl_label">Driving Licence</label>
                                        <div class="booking-form-group col-md-6 mb-4" id="dlf" style="display:none;">
                                            <label>Front</label>
                                            <input type="file" name="dl_front" class="booking-form-control" placeholder="Front" accept="image/*" required>
                                            <div class="help-block with-errors dl_front"></div>
                                        </div>
                                        <div class="booking-form-group col-md-6 mb-4" id="dlb" style="display:none;">
                                            <label>Back</label>
                                            <input type="file" name="dl_back" class="booking-form-control" placeholder="Back" accept="image/*" required>
                                            <div class="help-block with-errors dl_back"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="booking-form-group col-md-12 mb-4" id="eid-section">
                                    <div class="row" >
                                        <label for="returnLocationToggle">EID</label>
                                        <div class="booking-form-group col-md-6 mb-4" id="eidf" style="display:none;">
                                            <label>Front</label>
                                            <input type="file" name="eid_front" class="booking-form-control" placeholder="Front" accept="image/*" required>
                                            <div class="help-block with-errors eid_front"></div>
                                        </div>
                                        <div class="booking-form-group col-md-6 mb-4" id="eidb" style="display:none;">
                                            <label>Back</label>
                                            <input type="file" name="eid_back" class="booking-form-control" placeholder="Back" accept="image/*" required>
                                            <div class="help-block with-errors eid_back"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="booking-form-group col-md-12 mb-4" id="country-dl-section" style="display:none;">
                                    <div class="row">
                                        <label for="returnLocationToggle" id="dl_label">Country Licence</label>
                                        <div class="booking-form-group col-md-6 mb-4" id="cdlf">
                                            <label>Front</label>
                                            <input type="file" name="cdl_front" class="booking-form-control" placeholder="Front" accept="image/*,application/pdf" required>
                                            <div class="help-block with-errors cdl_front"></div>
                                        </div>
                                        <div class="booking-form-group col-md-6 mb-4" id="cdlb">
                                            <label>Back</label>
                                            <input type="file" name="cdl_back" class="booking-form-control" placeholder="Back" accept="image/*,application/pdf" required>
                                            <div class="help-block with-errors cdl_back"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-12 pb-2" id="docErrorMessages">

                                    </div>
                                </div>
                                <div class="col-md-12 booking-form-group">
                                    <button type="button" class="btn-default upload_docs">Upload</button>
                                    <div id="msgSubmit" class="h3 hidden"></div>
                                </div>
                            </div>   
                        </form>                                 
                    </fieldset>
                </div>
                <!-- Registration PopUp Form End -->
            </div>
            <!-- Registration Form Box End -->

	<!-- Header End -->

    @yield('content')

    <!-- Footer Start -->
    <footer class="main-footer bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- About Footer Start -->
                     <div class="about-footer">
                        <!-- Footer Logo Start -->
                        <div class="footer-logo">
                            <img src="{{asset('assets/images/footer-logo.png')}}" alt="">
                        </div>
                        <!-- Footer Logo End -->

                        <!-- About Footer Content Start -->
                         <div class="about-footer-content">
                            <p>At Carline, we're fully flexible and client-focused, delivering cars when and where you need them. Our goal is to provide a seamless rental experience tailored to your schedule. </p>
                         </div>
                        <!-- About Footer Content End -->
                     </div>
                    <!-- About Footer End -->
                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Quick Links Start -->
                    <div class="footer-links footer-quick-links">
                        <h3>Our Cars</h3>
                        <ul>                            
                            @foreach($layoutCarTypes as $key => $value)
                                <li><a href="{{url('/cars')}}" class="type-click" data-id="{{$value->id}}">{{$value->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Footer Quick Links End -->
                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Menu Start -->
                    <div class="footer-links footer-menu">
                        <h3>quick links</h3>
                        <ul>                            
                            <li><a href="{{ url('/home') }}">home</a></li>
                            <!-- <li><a href="{{ url('/about') }}">about us</a></li>
                            <li><a href="{{ url('/cars') }}">Our cars</a></li>
                            <li><a href="{{ url('/offers') }}">Special Offers</a></li>
                            <li><a href="{{ url('/contact') }}">Contact Us</a></li> -->
                            <li><a href="{{ url('/terms-conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ url('/refund-policy') }}">Refund policy</a></li>
                            <li><a href="{{ url('/cancelation-policy') }}">Cancelation policy</a></li>
                        </ul>
                    </div>
                    <!-- Footer Menu End -->
                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Newsletter Start -->
                    <div class="footer-newsletter">
                        <h3>Our Address</h3>
                        <div class="about-footer">
                        <div class="about-footer-content">
                        <p><i class="fa fa-home"></i> Near Saffron Boutique Hotel, Omar Bin Al Khattab Road Deira Dubai U.A.E</p>
                        <p><i class="fa fa-phone"></i> <a href="tel:+971565738866">+971 56 573 8866</a></p>
                        <p><i class="fa fa-phone"></i> <a href="tel:+97145292722">+971 4 52 92 722</a></p>
                        <p><i class="fa fa-envelope"></i> <a href="mailto:carlinellc32@gmail.com">carlinellc32@gmail.com</a></p>
                        <p><i class="fa-brands fa-whatsapp"></i> <a href="https://api.whatsapp.com/send?phone=971565738866">+971 56 573 8866</a></p>
                    </div> </div>
                        
                    </div>
                    <!-- Footer Newsletter End -->
                </div>
            </div>

            <!-- Footer Copyright Section Start -->
            <div class="footer-copyright">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-7">
                        <!-- Footer Copyright Start -->
                        <div class="footer-copyright-text">
                            <p>© 2024 Carline. All Rights Reserved. <br>Designed By  <a href="http://growtharkmedia.com/" target="_blank">GrowthArk Media</a></p>
                        </div>
                        <!-- Footer Copyright End -->
                    </div>

                    <div class="col-lg-4 col-md-7">
                        <!-- Footer Copyright Start -->
                        <div class="footer-copyright-text">
                            <center><p>Cards Accepted: </p><img src="{{asset('assets/images/cards.png')}}" alt=""></center>
                        </div>
                        <!-- Footer Copyright End -->
                    </div>

                    <div class="col-lg-4 col-md-5">
                        <!-- Footer Social Link Start -->
                        <div class="footer-social-links">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- Footer Social Link End -->
                    </div>
                </div>
            </div>
            <!-- Footer Copyright Section End -->
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Jquery Library File -->
    <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <!-- Jquery Ui Js File -->
    <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <!-- Bootstrap js file -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- Validator js file -->
    <script src="{{asset('assets/')}}js/validator.min.js"></script>
    <!-- SlickNav js file -->
    <script src="{{asset('assets/js/jquery.slicknav.js')}}"></script>
    <!-- Swiper js file -->
    <script src="{{asset('assets/js/swiper-bundle.min.js')}}"></script>
    <!-- Counter js file -->
    <script src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
    <!-- Magnific js file -->
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- SmoothScroll -->
    <script src="{{asset('assets/js/SmoothScroll.js')}}"></script>
    <!-- Parallax js -->
    <script src="{{asset('assets/js/parallaxie.js')}}"></script>
    <!-- MagicCursor js file -->
    <script src="{{asset('assets/js/gsap.min.js')}}"></script>
    <script src="{{asset('assets/js/magiccursor.js')}}"></script>
    <!-- Text Effect js file -->
    <script src="{{asset('assets/js/SplitText.js')}}"></script>
    <script src="{{asset('assets/js/ScrollTrigger.min.js')}}"></script>
    <!-- YTPlayer js File -->
    <script src="{{asset('assets/js/jquery.mb.YTPlayer.min.js')}}"></script>
    <!-- Wow js file -->
    <script src="{{asset('assets/js/wow.js')}}"></script>
    <!-- Main Custom js file -->
    <script src="{{asset('assets/js/function.js')}}"></script>
</body>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script> 
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>

<script>
$(document).ready(function () {
    $(".send-otp").click(function () {
        var datas = {
            'firstName': $("#firstName").val(),
            'lastName': $("#lastName").val(),
            'email': $("#email").val(),
            'phone': $("#phone").val(),
            'password': $("#password").val(),
            'flat': $("#flat").val(),
            'building': $("#building").val(),
            'landmark': $("#landmark").val(),
            'city': $("#city").val(),
            'country': $("#country").val(),
        };
        
        if(!validateForm(datas)){
            $(".overlay").show();
            $.ajax({
                url: baseUrl + '/send-otp',
                type: 'post',
                data: datas,
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res) {
                    if(res.status == 200){
                        $("#otp-section").show();
                        $(".send-otp-button").hide();
                        $('.resend').html('Resend otp after <span class="countdown"></span>');
                        var timer2 = "15:00";
                        var interval = setInterval(function() {
                            var timer = timer2.split(':');
                            //by parsing integer, I avoid all extra string processing
                            var minutes = parseInt(timer[0], 10);
                            var seconds = parseInt(timer[1], 10);
                            --seconds;
                            minutes = (seconds < 0) ? --minutes : minutes;
                            if (minutes < 0) clearInterval(interval);
                            seconds = (seconds < 0) ? 59 : seconds;
                            seconds = (seconds < 10) ? '0' + seconds : seconds;
                            $('.countdown').html(minutes + ':' + seconds);
                            timer2 = minutes + ':' + seconds;
                            if(timer2=='0:00'){
                                $('.resend').html('<a class="resend-otp" onclick="resendOtp();">Resend OTP</a>');
                                clearInterval(interval);
                            }
                        }, 1000);
                    }else{
                        $('#errorMessages').append('<br><span style="color:red;">OTP did not sent.</span>');
                        setTimeout(function () {
                            $('#errorMessages').html('');
                        }, 2500);
                    }
                    $(".overlay").hide();
                }
            });
        }else{
            $('#errorMessages').append('<br><span style="color:red;">Please fill valid data.</span>');
            setTimeout(function () {
                $('#errorMessages').html('');
            }, 2500);
            $(".overlay").hide();
        }
    });

    const inputs = document.querySelectorAll(".otp-field input");
    inputs.forEach((input, index) => {
        input.dataset.index = index;
        input.addEventListener("keyup", handleOtp);
        input.addEventListener("paste", handleOnPasteOtp);
    });
    function handleOtp(e) {
        const input = e.target;
        let value = input.value;
        let isValidInput = value.match(/[0-9a-z]/gi);
        input.value = "";
        input.value = isValidInput ? value[0] : "";
        let fieldIndex = input.dataset.index;
        if (fieldIndex < inputs.length - 1 && isValidInput) {
            input.nextElementSibling.focus();
        }
        if (e.key === "Backspace" && fieldIndex > 0) {
            input.previousElementSibling.focus();
        }
        if (fieldIndex == inputs.length - 1 && isValidInput) {
            submit();
        }
    }
    function handleOnPasteOtp(e) {
        const data = e.clipboardData.getData("text");
        const value = data.split("");
        if (value.length === inputs.length) {
            inputs.forEach((input, index) => (input.value = value[index]));
            submit();
        }
    }

    function submit() {

        let  otp = "";
        inputs.forEach((input) => {
            otp += input.value;
            input.disabled = true;
            input.classList.add("disabled");
        });

        var datas = {
            'firstName': $("#firstName").val(),
            'lastName': $("#lastName").val(),
            'email': $("#email").val(),
            'phone': $("#phone").val(),
            'password': $("#password").val(),
            'flat': $("#flat").val(),
            'building': $("#building").val(),
            'landmark': $("#landmark").val(),
            'city': $("#city").val(),
            'country': $("#country").val(),
        };
        datas.otp = otp;
        if(!validateForm(datas)){
            $(".overlay").show();
            $.ajax({
                url: baseUrl + '/verify-otp',
                type: 'post',
                data: datas,
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res) {
                    $('#errorMessages').append('<br><span style="color:green;">'+res.message+'</span>');
                    setTimeout(function () {
                        $('#errorMessages').html('');
                    }, 2500);

                    if(res.status == 200){
                        $("#otp-section").hide();
                        $(".send-otp-button").hide();
                        // $('#errorMessages').append('<br><span style="color:green;">OTP Verified succesfully.</span>');
                        setTimeout(function () {
                            // $('#errorMessages').html('');
                            createUser();
                        }, 5000);
                        
                    }else{
                        inputs.forEach((input) => {
                            otp += input.value;
                            input.value = '';
                            input.disabled = false;
                        });
                    }
                    $(".overlay").hide();
                }
            });
        }else{
            $('#errorMessages').append('<br><span style="color:red;">Please fill valid data.</span>');
            setTimeout(function () {
                $('#errorMessages').html('');
            }, 2500);
            $(".overlay").hide();
        }
    }

    $(".register-user").click(function () {
        if($("#userId").val()==''){
            $.magnificPopup.open({
                items: {
                    src: '#registrationForm', 
                    type: 'inline'
                }
            });
        }else{
            window.location.href = baseUrl + "/my-account";
        }
    });

    function createUser(){
        var datas = {
            'firstName': $("#firstName").val(),
            'lastName': $("#lastName").val(),
            'email': $("#email").val(),
            'phone': $("#phone").val(),
            'password': $("#password").val(),
            'flat': $("#flat").val(),
            'building': $("#building").val(),
            'landmark': $("#landmark").val(),
            'city': $("#city").val(),
            'country': $("#country").val(),
        };
        
        if(!validateForm(datas)){
            $(".overlay").show();
            $.ajax({
                url: baseUrl + '/register-user',
                type: 'post',
                data: datas,
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res) {

                    $('#errorMessages').append('<br><span style="color:green;">'+res.message+'</span>');
                    setTimeout(function () {
                        $('#errorMessages').html('');
                    }, 2500);

                    if(res.status == 200){
                        $("#userId").val(res.userId);
                        $.magnificPopup.close();
                        checkDocumentUploaded();
                    }
                    $(".overlay").hide();
                }
            });
        }else{
            $('#errorMessages').append('<br><span style="color:red;">Please fill valid data.</span>');
            setTimeout(function () {
                $('#errorMessages').html('');
            }, 2500);
            $(".overlay").hide();
        }
    }
    $("#loginPopup").click(function() {
        $(".overlay").show();
        $.magnificPopup.close();

        setTimeout(function() {
            $.magnificPopup.open({
                items: {
                    src: '#loginForm',
                    type: 'inline'
                }
            });
            $(".overlay").hide();
        }, 150);
    });

    $("#registrationPopup").click(function() {
        $(".overlay").show();
        $.magnificPopup.close();

        setTimeout(function() {
            $.magnificPopup.open({
                items: {
                    src: '#registrationForm',
                    type: 'inline'
                }
            });
            $(".overlay").hide();
        }, 150);
    });

    $("#forgotpopup").click(function() {
        $(".overlay").show();
        $.magnificPopup.close();

        setTimeout(function() {
            $.magnificPopup.open({
                items: {
                    src: '#forgotForm',
                    type: 'inline'
                }
            });
            $(".overlay").hide();
        }, 150);
    });

    $(".reset_button").click(function() {
        var datas = {
            'email': $("#forgotEmailId").val()
        };
        $(".overlay").show();
        if(!validateForgotForm(datas)){
            $.ajax({
                url: baseUrl + '/send-reset-link',
                type: 'post',
                data: datas,
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res) {
                    var color = 'green';
                    if(res.status != 200){
                        color = 'red';
                    }
                    $('#resetErrors').html('<br><span style="color:'+color+';">'+res.message+'</span>');
                    

                    
                    $(".overlay").hide();
                }
            });
        }else{
            $('#loginErrors').append('<br><span style="color:red;">Please fill valid data.</span>');
            setTimeout(function () {
                $('#loginErrors').html('');
            }, 2500);
            $(".overlay").hide();
        }
    });

    $(".login_button").click(function() {
        var datas = {
            'password': $("#userPassword").val(),
            'username': $("#userName").val()
        };
        $(".overlay").show();
        if(!validateLoginForm(datas)){
            $.ajax({
                url: baseUrl + '/user-login',
                type: 'post',
                data: datas,
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res) {
                    $.magnificPopup.close();
                    $('#loginErrors').append('<br><span style="color:green;">'+res.message+'</span>');
                    // setTimeout(function () {
                        $('#loginErrors').html('');
                        if(res.status == 200){
                            $("#userId").val(res.userId);
                            if($('#pickupdate').length){
                                checkDocumentUploaded();
                            }else{
                                location.reload();
                            }
                            
                        }
                    // }, 5000);

                    
                    $(".overlay").hide();
                }
            });
        }else{
            $('#loginErrors').append('<br><span style="color:red;">Please fill valid data.</span>');
            setTimeout(function () {
                $('#loginErrors').html('');
            }, 2500);
            $(".overlay").hide();
        }
    });
});

$(".rider_type").click(function() {
    if($(this).val()=='tourist'){
        $("#passport-section").show();
        $("#passf").show();
        $("#passb").show();
        $("#dl-section").show();
        $("#eid-section").hide();
        $("#country-dl-section").show();
        $("#dl_label").html("International Driving Licence");
    }else{
        $("#passport-section").show();
        $("#passf").show();
        $("#passb").hide();
        $("#eid-section").show();
        $("#dl-section").show();
        $("#country-dl-section").hide();
        $("#dl_label").html("Driving Licence");
    }
});

$(".upload_docs").click(function(e) {
    if($("#docUploadType").val()=='new'){
        e.preventDefault();
        let formData = new FormData($('#uploadDocs')[0]);
        $(".overlay").show();
        $.ajax({
            url: baseUrl + '/upload-docs',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                $("#docErrorMessages").html('<span style="color:green;">Documents uploaded successfully.<span>');
                setTimeout(function () {
                    $("#docErrorMessages").html('');
                    $.magnificPopup.close();
                    $('#uploadDocs')[0].reset();
                    if($('#pickupdate').length){
                        if(!bookCarAction()){
                            // location.reload();
                        }
                    }
                    
                }, 5000);
                $(".overlay").hide();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(key) {
                        $("."+key+"").html('<span style="color:red;">'+errors[key][0]+'<span>');
                        setTimeout(function () {
                            $("."+key+"").html('');
                        }, 5000);
                    });
                } else {
                    $("#docErrorMessages").html('<span style="color:red;">An error occurred during the upload.<span>');
                    setTimeout(function () {
                        $("#docErrorMessages").html('');
                    }, 5000);
                }
                $(".overlay").hide();
            }
        });
    }else{
        e.preventDefault();
        let formData = new FormData($('#uploadDocs')[0]);
        console.log(formData)
        $(".overlay").show();
        $.ajax({
            url: baseUrl + '/missing-upload-docs',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                $("#edit_docErrorMessages").html('<span style="color:green;">Documents uploaded successfully.<span>');
                $("#docErrorMessages").html('<span style="color:green;">Documents uploaded successfully.<span>');
                setTimeout(function () {
                    $("#edit_docErrorMessages").html('');
                    $("#docErrorMessages").html('');
                    if(!bookCarAction()){
                        // location.reload();
                    }
                    $.magnificPopup.close();
                    $('#edit_uploadDocs')[0].reset();
                    // location.reload();
                    
                }, 5000);
                $(".overlay").hide();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(key) {
                        $("."+key+"").html('<span style="color:red;">'+errors[key][0]+'<span>');
                        setTimeout(function () {
                            $("."+key+"").html('');
                        }, 5000);
                    });
                } else {
                    $("#edit_docErrorMessages").html('<span style="color:red;">An error occurred during the upload.<span>');
                    setTimeout(function () {
                        $("#edit_docErrorMessages").html('');
                    }, 5000);
                }
                $(".overlay").hide();
            }
        });
    }
});

function checkDocumentUploaded(){
    $(".overlay").show();
    $.ajax({
        url: baseUrl + '/check-document-uploaded',
        type: 'post',
        data: {},
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            if(res.cnt == 0){
                if(!validateBookingForm()){
                    if(res.data.eidf_flag == 0 && res.data.eidb_flag == 0 && res.data.dlf_flag == 0 && res.data.dlb_flag == 0 && res.data.passf_flag == 0 && res.data.passb_flag == 0 && res.data.cdlf_flag == 0 && res.data.cdlb_flag == 0 ){
                        $("#docUploadType").val('new');
                        $(".rider_type").prop("disabled", false); 
                        $("#passport-section").show();
                        $("#passf").show();
                        $("#passb").hide();
                        $("#dlf").show();
                        $("#dlb").show();
                        $("#eidf").show();
                        $("#eidb").show();
                        $("#country-dl-section").hide();
                        $.magnificPopup.open({
                            items: {
                                src: '#documentUploadForm',
                                type: 'inline'
                            }
                        });
                    }else{
                        $(".rider_type").prop("disabled", true); 
                        $("#docUploadType").val('old');
                        if(res.data.passf_flag == 0){
                            $("#passport-section").show();
                            $("#passf").show();
                        }
                        if(res.data.passb_flag == 0){
                            $("#passport-section").show();
                            $("#passb").show();
                        }
                        if(res.data.dlf_flag == 0){
                            $("#dlf").show();
                        }
                        if(res.data.dlb_flag == 0){
                            $("#dlb").show();
                        }
                        if(res.data.eidf_flag == 0 && res.data.user_type == 'R'){
                            $("#eidf").show();
                        }
                        if(res.data.eidb_flag == 0 && res.data.user_type == 'R'){
                            $("#eidb").show();
                        }
                        if(res.data.passf_flag != 0 && res.data.passb_flag != 0){
                            $("#passport-section").hide();
                        }
                        if(res.data.dlf_flag != 0 && res.data.dlb_flag != 0){
                            $("#dl-section").hide();
                        }
                        if(res.data.eidf_flag != 0 && res.data.eidb_flag != 0){
                            $("#eid-section").hide();
                        }
                        if(res.data.user_type == 'T'){
                            $("#eid-section").hide();
                        }
                        if((res.data.cdlf_flag == 0 || res.data.cdlb_flag == 0) && res.data.user_type == 'T'){
                            $("#country-dl-section").show();
                        }
                        if(res.data.cdlf_flag == 0 && res.data.user_type == 'T'){
                            $("#cdlf").show();
                        }
                        if(res.data.cdlb_flag == 0 && res.data.user_type == 'T'){
                            $("#cdlb").show();
                        }
                        $.magnificPopup.open({
                            items: {
                                src: '#documentUploadForm',
                                type: 'inline'
                            }
                        });
                    }
                }
            }else{
                if(!validateBookingForm()){
                    if($('#pickupdate').length){
                        if(!bookCarAction()){
                            // location.reload();
                        }
                    }else{
                        $("#docErrorMessages").html('<span style="color:red;">Please fill up the booking details.<span>');
                        setTimeout(function () {
                            $("#docErrorMessages").html('');
                        }, 5000);
                    }
                }
            }
            $(".overlay").hide();
        }
    });
}

function validateLoginForm(datas){
    chk = 0;
    if(datas.username == ''){
        chk = 1;
        $('#userName').css('border-color', 'red');
    }else{
        $('#userName').css('border-color', '');
    }
    if(datas.password == ''){
        chk = 1;
        $('#userPassword').css('border-color', 'red');
    }else{
        $('#userPassword').css('border-color', '');
    }

    return chk;
}

function validateForgotForm(datas){
    chk = 0;
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if(datas.email == ''){
        chk = 1;
        $('#forgotEmailId').css('border-color', 'red');
    } else if (!emailPattern.test(datas.email)) {
        chk = 1;
        $('#forgotEmailId').css('border-color', 'red');
    } else {
        $('#forgotEmailId').css('border-color', '');
    }

    return chk;
}

function validateForm(datas){
    chk = 0;
    if(datas.firstName == ''){
        chk = 1;
        $('#firstName').css('border-color', 'red');
    }else{
        $('#firstName').css('border-color', '');
    }
    if(datas.lastName == ''){
        chk = 1;
        $('#lastName').css('border-color', 'red');
    }else{
        $('#lastName').css('border-color', '');
    }
    if(datas.email == ''){
        chk = 1;
        $('#email').css('border-color', 'red');
    }else{
        $('#email').css('border-color', '');
    }
    if(datas.phone == ''){
        chk = 1;
        $('#phone').css('border-color', 'red');
    }else{
        $('#phone').css('border-color', '');
    }
    if(datas.password == ''){
        chk = 1;
        $('#password').css('border-color', 'red');
    }else{
        $('#password').css('border-color', '');
    }
    if(datas.flat == ''){
        chk = 1;
        $('#flat').css('border-color', 'red');
    }else{
        $('#flat').css('border-color', '');
    }
    if(datas.building == ''){
        chk = 1;
        $('#building').css('border-color', 'red');
    }else{
        $('#building').css('border-color', '');
    }
    if(datas.landmark == ''){
        chk = 1;
        $('#landmark').css('border-color', 'red');
    }else{
        $('#landmark').css('border-color', '');
    }
    if(datas.city == ''){
        chk = 1;
        $('#city').css('border-color', 'red');
    }else{
        $('#city').css('border-color', '');
    }
    if(datas.emirates == ''){
        chk = 1;
        $('#emirates').css('border-color', 'red');
    }else{
        $('#emirates').css('border-color', '');
    }
    if(datas.country == ''){
        chk = 1;
        $('#country').css('border-color', 'red');
    }else{
        $('#country').css('border-color', '');
    }
    return chk;
}

function resendOtp(){
    var datas = {
        'firstName': $("#firstName").val(),
        'lastName': $("#lastName").val(),
        'email': $("#email").val(),
        'phone': $("#phone").val(),
        'password': $("#password").val(),
        'flat': $("#flat").val(),
        'building': $("#building").val(),
        'landmark': $("#landmark").val(),
        'city': $("#city").val(),
        'country': $("#country").val(),
    };
    
    if(!validateForm(datas)){
        $(".overlay").show();
        $.ajax({
            url: baseUrl + '/send-otp',
            type: 'post',
            data: datas,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                if(res.status == 200){
                    $("#otp-section").show();
                    $(".send-otp-button").hide();
                    $('.resend').html('Resend otp after <span class="countdown"></span>');
                    var timer2 = "15:00";
                    var interval = setInterval(function() {
                        var timer = timer2.split(':');
                        //by parsing integer, I avoid all extra string processing
                        var minutes = parseInt(timer[0], 10);
                        var seconds = parseInt(timer[1], 10);
                        --seconds;
                        minutes = (seconds < 0) ? --minutes : minutes;
                        if (minutes < 0) clearInterval(interval);
                        seconds = (seconds < 0) ? 59 : seconds;
                        seconds = (seconds < 10) ? '0' + seconds : seconds;
                        $('.countdown').html(minutes + ':' + seconds);
                        timer2 = minutes + ':' + seconds;
                        if(timer2=='0:00'){
                            $('.resend').html('<a class="resend-otp" onclick="resendOtp();">Resend OTP</a>');
                            clearInterval(interval);
                        }
                    }, 1000);
                }else{
                    $('#errorMessages').append('<br><span style="color:red;">OTP did not sent.</span>');
                    setTimeout(function () {
                        $('#errorMessages').html('');
                    }, 2500);
                }
                $(".overlay").hide();
            }
        });
    }else{
        $('#errorMessages').append('<br><span style="color:red;">Please fill valid data.</span>');
        setTimeout(function () {
            $('#errorMessages').html('');
        }, 2500);
        $(".overlay").hide();
    }
}

$(document).ready(function () {
    $(".select-type").change(function () {
        localStorage.setItem("searchType",$(this).val());
    });

    $(".brand-click").click(function () {
        localStorage.setItem("brandClick",$(this).attr('data-id'));
        window.location = baseUrl + '/cars';
    });
    
    $(".type-button").click(function () {
        window.location = baseUrl + '/cars';
    });

    $(".type-click").click(function () {
        localStorage.setItem("searchType",$(this).attr('data-id'));
        window.location = baseUrl + '/cars';
    });
});
</script>
</html>