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
	<!-- Page Title -->
	<title>Home - CarLine</title>
	<!-- Favicon Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
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
    
</head>
<body>

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
                                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
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
                            <img src="images/footer-logo.png" alt="">
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
                            <li><a href="cars.html">Hatchback</a></li>
                            <li><a href="cars.html">Sedan</a></li>
                            <li><a href="cars.html">SUV</a></li>
                            <li><a href="cars.html">Crossover</a></li>
                            <li><a href="cars.html">luxury cars</a></li>
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
</html>