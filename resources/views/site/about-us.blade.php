@extends('layouts.site')

@section('content')
<!-- Page Header Start -->
<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">About Us</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">about us</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


    <!-- Why Choose Us Section Start -->
    <div class="why-choose-us">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">why choose us</h3>
                    <h2 class="text-anime-style-3">Why you should choose us?</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 order-lg-1 order-md-1 order-1">
                <!-- Why Choose Item Start -->
                <div class="why-choose-item wow fadeInUp">
                    <div class="icon-box">
                        <img src="{{asset('assets/images/icon-service-1.svg')}}" alt="">
                    </div>
                    <div class="why-choose-content">
                        <h3>Loyalty</h3>
                        <p>Become a Privilege member to unlock free hires, discount and priority check-in</p>
                    </div>
                </div>
                <!-- Why Choose Item End -->

                <!-- Why Choose Item Start -->
                <div class="why-choose-item wow fadeInUp" data-wow-delay="0.25s">
                    <div class="icon-box">
                        <img src="{{asset('assets/images/icon-why-choose-4.svg')}}" alt="">
                    </div>
                    <div class="why-choose-content">
                        <h3>New Vehicles</h3>
                        <p>Our vehicles are new and well maintained, ranging from compact to luxury, drive away happy.</p>
                    </div>
                </div>
                <!-- Why Choose Item End -->
            </div>

            <div class="col-lg-4 col-md-12 order-lg-2 order-md-3 order-2">
                <div class="why-choose-image">
                    <figure class="reveal">
                        <img src="{{asset('assets/images/why-choose-img.jpg')}}" alt="">
                    </figure>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 order-lg-3 order-md-2 order-3">
                <!-- Why Choose Item Start -->
                <div class="why-choose-item wow fadeInUp">
                    <div class="icon-box">
                        <img src="{{asset('assets/images/icon-service-6.svg')}}" alt="">
                    </div>
                    <div class="why-choose-content">
                        <h3>No hidden fees</h3>
                        <p>Transparent pricing—know exactly what you’re paying for with no surprises.</p>
                    </div>
                </div>
                <!-- Why Choose Item End -->

                <!-- Why Choose Item Start -->
                <div class="why-choose-item wow fadeInUp" data-wow-delay="0.25s">
                    <div class="icon-box">
                        <img src="{{asset('assets/images/icon-why-choose-4.svg')}}" alt="">
                    </div>
                    <div class="why-choose-content">
                        <h3>Rent a Car with Best Prices</h3>
                        <p>Get the best car rental price in Dubai when you book direct with carline</p>
                    </div>
                </div>
                <!-- Why Choose Item End -->
            </div>
        </div>
    </div>
</div>
<!-- Why Choose Us Section End -->


<!-- Exclusive Partners Section Start -->
<div class="exclusive-partners bg-section">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
            
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <!-- About Us Image Start -->
                <div class="about-image">
                    <!-- About Image Start -->
                    <div class="about-img-1">
                        <figure class="reveal">
                            <img src="{{asset('assets/images/about-img-1.jpg')}}" alt="">
                        </figure>
                    </div>
                    <!-- About Image End -->

                    <!-- About Image Start -->
                    <div class="about-img-2">
                        <figure class="reveal">
                            <img src="{{asset('assets/images/about-img-2.jpg')}}" alt="">
                        </figure>
                    </div>
                    <!-- About Image End -->
                </div>
                <!-- About Us Image End -->
            </div>

            <div class="col-lg-6">
                <!-- About Us Content Start -->
                <div class="about-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">about us</h3>
                        <h2 class="text-anime-style-3">What We Do</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.25s">At Carline, we specialize in providing flexible, convenient, and reliable car rental solutions. Whether you need a car for a day, a week, or longer, we ensure a hassle-free experience. Our service is tailored to meet your specific needs, delivering vehicles to your preferred location at the right time. From economy to luxury vehicles, we offer a wide range of options, all maintained to the highest standards to guarantee your satisfaction.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- About Content Body Start -->
                    <div class="about-content-body">
                        <!-- About Trusted Booking Start -->
                        <div class="about-trusted-booking wow fadeInUp" data-wow-delay="0.5s">
                            <div class="icon-box">
                                <img src="{{asset('assets/images/icon-about-trusted-1.svg')}}" alt="">
                            </div>
                            <div class="trusted-booking-content">
                                <h3>easy booking process</h3>
                                <p>We Have Optimized The Booking Process So That Our Clients Can Experience The Easiest And The Safest Service</p>
                            </div>
                        </div>
                        <!-- About Trusted Booking End -->
                            
                        <!-- About Trusted Booking Start -->
                        <div class="about-trusted-booking wow fadeInUp" data-wow-delay="0.75s">
                            <div class="icon-box">
                                <img src="{{asset('assets/images/icon-about-trusted-2.svg')}}" alt="">
                            </div>
                            <div class="trusted-booking-content">
                                <h3>convenient pick-up & return process</h3>
                                <p>We Have Optimized The Booking Process So That Our Clients Can Experience The Easiest And The Safest Service</p>
                            </div>
                        </div>
                        <!-- About Trusted Booking End -->
                    </div>
                    <!-- About Content Body End -->

                    <!-- About Content Footer Start -->
                    <div class="about-content-footer wow fadeInUp" data-wow-delay="1s">
                        <a href="{{ url('/contact') }}" class="btn-default">contact us</a>
                    </div>
                    <!-- About Content Footer End -->
                </div>
                <!-- About Us Content End -->
            </div>

            

            

            
        </div>
    </div>
</div>
<!-- Exclusive Partners Section End -->

<!-- Vision Mission Section Start -->
<div class="vision-mission">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">vision mission</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">Driving excellence and innovation in car rental services</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Sidebar Our Vision Mission Nav start -->
                <div class="our-projects-nav wow fadeInUp" data-wow-delay="0.25s">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#vision" type="button" role="tab" aria-selected="true">our vision</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#mission" type="button" role="tab" aria-selected="false">our mission</button>
                        </li>
                        
                    </ul>
                </div>
                <!-- Sidebar Our Vision Mission Nav End -->

                <!-- Vision Mission Box Start -->
                <div class="vision-mission-box tab-content" id="myTabContent">
                    <!-- Our Vision Item Start -->
                    <div class="our-vision-item tab-pane fade show active" id="vision" role="tabpanel">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <!-- Vision Mission Content Start -->
                                <div class="vision-mission-content">
                                    <!-- Section Title Start -->
                                    <div class="section-title">
                                        <h3 class="wow fadeInUp">vision</h3>
                                        <h2 class="text-anime-style-3" data-cursor="-opaque">Our Vision</h2>
                                        <p class="wow fadeInUp" data-wow-delay="0.25s">We envision becoming the leading car rental service in Dubai by consistently exceeding customer expectations through innovation, quality, and dedication to seamless, stress-free rentals. Our goal is to create a lasting bond with our clients, built on trust, reliability, and value.</p>
                                    </div>
                                    <!-- Section Title End -->

                                    <!-- Vision Mission List Start -->
                                    <div class="vision-mission-list wow fadeInUp" data-wow-delay="0.5s">
                                        <ul>
                                            <li>Customer Loyalty</li>
                                            <li>Sustainability and Innovation</li>
                                            <li>Market Leadership</li>
                                        </ul>
                                    </div>
                                    <!-- Vision Mission List End -->
                                </div>
                                <!-- Vision Mission Content End -->
                            </div>

                            <div class="col-lg-6">
                                <!-- Vision Image Start -->
                                <div class="vision-image">
                                    <figure class="image-anime reveal">
                                        <img src="{{asset('assets/images/our-vision-img.jpg')}}" alt="">
                                    </figure>
                                </div>
                                <!-- Vision Image End -->
                            </div>
                        </div>
                    </div>
                    <!-- Our Vision Item End -->

                    <!-- Our Vision Item Start -->
                    <div class="our-vision-item tab-pane fade" id="mission" role="tabpanel">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <!-- Vision Mission Content Start -->
                                <div class="vision-mission-content">
                                    <!-- Section Title Start -->
                                    <div class="section-title">
                                        <h3>mission</h3>
                                        <h2 data-cursor="-opaque">Our mission</h2>
                                        <p>Our mission is to redefine the car rental experience by offering unparalleled flexibility, transparency, and customer-centric service. We aim to ensure that our clients have access to the perfect vehicle, without hidden costs, and delivered with exceptional service.</p>
                                    </div>
                                    <!-- Section Title End -->

                                    <!-- Vision Mission List Start -->
                                    <div class="vision-mission-list">
                                        <ul>
                                            <li>Customer-Centric Flexibility</li>
                                            <li>Transparent Pricing</li>
                                            <li>Quality and Reliability</li>
                                        </ul>
                                    </div>
                                    <!-- Vision Mission List End -->
                                </div>
                                <!-- Vision Mission Content End -->
                            </div>

                            <div class="col-lg-6">
                                <!-- Vision Image Start -->
                                <div class="vision-image">
                                    <figure class="image-anime reveal">
                                        <img src="{{asset('assets/images/our-mission-img.jpg')}}" alt="">
                                    </figure>
                                </div>
                                <!-- Vision Image End -->
                            </div>
                        </div>
                    </div>
                    <!-- Our Vision Item End -->

                    

                </div>
                <!-- Vision Mission Box End -->                
            </div>
        </div>
    </div>
</div>
<!-- Vision Mission Section End -->
@endsection