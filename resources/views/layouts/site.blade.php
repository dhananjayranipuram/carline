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
	<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" media="screen">
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
					<a class="navbar-brand" href="{{ url('/') }}">
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
                            </ul>
                        </div>
                        <!-- Let’s Start Button Start -->
                        <div class="header-btn d-inline-flex">
                            <a href="#" class="btn-default">My Account</a>
                        </div>
                        <!-- Let’s Start Button End -->
					</div>
					<!-- Main Menu End -->
					<div class="navbar-toggle"></div>
				</div>
			</nav>
			<div class="responsive-menu"></div>
		</div>
	</header>
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
                            <p>At Carline, we’re fully flexible and client-focused, delivering cars when and where you need them. Our goal is to provide a seamless rental experience tailored to your schedule. </p>
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
                            <li><a href="{{url('/cars')}}">Hatchback</a></li>
                            <li><a href="{{url('/cars')}}">Sedan</a></li>
                            <li><a href="{{url('/cars')}}">SUV</a></li>
                            <li><a href="{{url('/cars')}}">Crossover</a></li>
                            <li><a href="{{url('/cars')}}">luxury cars</a></li>
                        </ul>
                    </div>
                    <!-- Footer Quick Links End -->
                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Menu Start -->
                    <div class="footer-links footer-menu">
                        <h3>quick links</h3>
                        <ul>                            
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="{{ url('/about') }}">about us</a></li>
                            <li><a href="{{ url('/cars') }}">Our cars</a></li>
                            <li><a href="{{ url('/offers') }}">Special Offers</a></li>
                            <li><a href="{{ url('/contact') }}">Contact Us</a></li>
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
                            <p>© 2024 Carline. All Rights Reserved</p>
                        </div>
                        <!-- Footer Copyright End -->
                    </div>

                    <div class="col-lg-4 col-md-7">
                        <!-- Footer Copyright Start -->
                        <div class="footer-copyright-text">
                            <center><p>Designed By  <a href="http://growtharkmedia.com/" target="_blank">GrowthArk Media</a></p></center>
                        </div>
                        <!-- Footer Copyright End -->
                    </div>

                    <div class="col-lg-4 col-md-5">
                        <!-- Footer Social Link Start -->
                        <div class="footer-social-links">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <!-- Footer Social Link End -->
                    </div>
                </div>
            </div>
            <!-- Footer Copyright Section End -->
        </div>
    </footer>
    <!-- Footer End -->

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
            'emirates': $("#emirates").val(),
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
            'emirates': $("#emirates").val(),
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
                        $(".register-user").show();
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

    $(".book-now-form").click(function () {
        if($("#userId").val()==''){
            $.magnificPopup.open({
                items: {
                    src: '#registrationForm', 
                    type: 'inline'
                }
            });
        }else{
            $.magnificPopup.open({
                items: {
                    src: '#bookingform', 
                    type: 'inline'
                }
            });
        }
    });

    $(".register-button").click(function () {
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
            'emirates': $("#emirates").val(),
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

                        $.magnificPopup.open({
                            items: {
                                src: '#bookingform', 
                                type: 'inline'
                            }
                        });
                    }else{
                        
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

    $(".login_button").click(function() {
        var datas = {
            'password': $("#userPassword").val(),
            'username': $("#userName").val()
        };
        if(!validateLoginForm(datas)){
            $.ajax({
                url: baseUrl + '/login',
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

                        $.magnificPopup.open({
                            items: {
                                src: '#bookingform', 
                                type: 'inline'
                            }
                        });
                    }
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
    return chk;
}


</script>
</html>