@extends('layouts.site')

@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCq0y9JbWvjemcHSpRNzUwstBeCQs0VS9k&libraries=places"></script>
<style>
@media only screen and (max-width: 600px) {
    .bannneru {
        width: 200%;
    }
}
.search-form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #ffffff;
    padding: 10px;
    width: 350px;
    margin: 20px auto;
    border-radius: 30px;
}
    
.search-form {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px; /* Adds spacing between elements */
}

.form-icon-wrapper {
    display: flex;
    align-items: center;
}

.form-icon {
    width: 40px;
    height: 40px;
}

.form-field {
    display: flex;
    align-items: center;
}

.form-select {
    width: 100%;
    max-width: 300px;
    padding: 10px 30px 10px 30px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    background-color: #fff;
}

.search-button {
    color: #ffffff;
    background-color: var(--accent-color);
    border-radius: 50%;
    width: 50px !important;
    height: 50px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease-in-out;
}

.search-button:hover {
    background-color: #000000;
}

@media screen and (max-width: 768px) {
    .search-form {
        flex-wrap: wrap; /* Stack items on smaller screens */
        gap: 10px;
    }

    .form-select, .search-button {
        width: 100%;
    }
}
@media (min-width: 1024px) {
    .hero-video {
        width: 100%;
    }
    .hero-slider-layout .hero-slide {
        position: relative;
        padding: 80px 0 120px;
    }
}
</style>
<!-- Hero Slider Section Start -->
<div class="hero hero-slider">
    <div class="hero-section bg-section hero-slider-layout">
        <div class="swiper">
            <div class="swiper-wrapper">
                <!-- Hero Slide Start -->
                <div class="swiper-slide">
                    <div class="hero-slide">
                        <!-- Slider Image Start -->
                        <div class="hero-slider-image">
                            <video autoplay muted loop id="heroVideo" class="hero-video">
                                <source src="{{asset('assets/images/videos.mp4')}}" type="video/mp4">
                            </video>
                        </div>
                        <!-- Slider Image End -->

                        <!-- Slider Content Start -->
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <!-- Hero Content Start -->
                                    <div class="hero-content text-center">
                                        <div class="section-title">
                                            <h3 class="fadeInUp">Welcome to Carline Car Rental</h3>
                                            <h1 class="text-highlight">Dubai’s Trusted Car Rental Experts</h1>
                                            <p class="fadeInUp" data-wow-delay="0.25s">
                                                Whether you're planning a weekend getaway, a business trip, or just need a reliable ride for the day, we offer a wide range of vehicles to suit your needs.
                                            </p>
                                            <!-- Search Form Start -->
                                            <div class="search-form-container">
                                                <form action="#" method="get" class="search-form">
                                                    <!-- Car Icon -->
                                                    <div class="form-icon-wrapper">
                                                        <img src="{{asset('assets/images/icon-rent-details-1.svg')}}" alt="Car Icon" class="form-icon">
                                                    </div>
                                                    <!-- Car Types Dropdown -->
                                                    <div class="form-field">
                                                        <select class="rent-details-form form-select select-type" aria-label="Choose Car Type">
                                                            <option value="" disabled selected>Choose Car Type</option>
                                                                @foreach($carType as $key => $value)
                                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- Search Button -->
                                                    <div class="form-field">
                                                        <button type="button" class="search-button type-button">
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </button>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                            <!-- Search Form End -->
                                        </div>
                                    </div>
                                    <!-- Hero Content End -->
                                </div>
                            </div>
                        </div>
                        <!-- Slider Content End -->
                    </div>
                </div>
                <!-- Hero Slide End -->
            </div>
            <div class="hero-pagination"></div>
        </div>
    </div>
</div>
<!-- Hero Slider Section End -->



<div class="perfect-fleet bg-section">
    <div class="container-fluid">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Limited-Time Offers</h3>
                    <h2 class="text-anime-style-3">Drive More, Spend Less</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Testimonial Slider Start -->
                <div class="car-details-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper" data-cursor-text="Drag">

                            @foreach($cars as $key => $value)
                            <!-- Testimonial Slide Start -->
                            <div class="swiper-slide">
                                <!-- Perfect Fleets Item Start -->
                                <div class="perfect-fleet-item">

                                    @php $imgArr = explode(',',$value->image); @endphp
                                    <!-- Image Box Start -->
                                    <div class="image-box">
                                        @foreach($imgArr as $keys => $values)
                                            <a href="{{url('/car-details')}}?id={{base64_encode($value->id)}}"><img src="{{asset($values)}}" alt=""></a>
                                            @if($keys==0) @break @endif
                                        @endforeach
                                    </div>
                                    <!-- Image Box End -->

                                    <!-- Perfect Fleets Content Start -->
                                    <div class="perfect-fleet-content">
                                        <!-- Perfect Fleets Title Start -->
                                        <div class="perfect-fleet-title">
                                            <h3>{{$value->car_type}}</h3>
                                            <a href="{{url('/car-details')}}?id={{base64_encode($value->id)}}"><h2>{{$value->brand_name}} {{$value->name}} {{$value->model}}</h2></a>
                                        </div>
                                        <!-- Perfect Fleets Content End -->

                                        <!-- Perfect Fleets Body Start -->
                                        <div class="perfect-fleet-body">
                                            <ul>
                                                @if(!empty($specs[$value->id]))
                                                    @foreach($specs[$value->id] as $keys => $values)
                                                        <li class="break-word"><img src="{{asset($values->image)}}" alt="" width="21">
                                                        @if($values->name=='Transmission')
                                                            {{$values->details}}
                                                        @else
                                                            @if($values->details!='Yes')
                                                                {{$values->details}}
                                                            @endif 
                                                            {{$values->name}}
                                                        @endif
                                                        
                                                        </li>
                                                        @if($keys==3) @break @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- Perfect Fleets Body End -->

                                        <!-- Perfect Fleets Footer Start -->
                                        <div class="perfect-fleet-footer">
                                            <!-- Perfect Fleets Pricing Start -->
                                            <div class="perfect-fleet-pricing">
                                                @if($value->offer_flag==1) 
                                                    <del><h6>AED {{$value->rent}}<span>/day</span></h6></del>
                                                    <h2>AED {{$value->offer_price}} <span>/day</span></h2>
                                                @else
                                                    <h2>AED {{$value->rent}} <span>/day</span></h2>
                                                @endif
                                            </div>
                                            <!-- Perfect Fleets Pricing End -->

                                            <!-- Perfect Fleets Btn Start -->
                                            <div class="perfect-fleet-btn">
                                                <a href="{{url('/car-details')}}?id={{base64_encode($value->id)}}" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                                            </div>
                                            <!-- Perfect Fleets Btn End -->
                                        </div>
                                        <!-- Perfect Fleets Footer End -->
                                    </div>
                                    <!-- Perfect Fleets Content End -->
                                </div>
                                <!-- Perfect Fleets Item End -->                                    
                            </div>
                            <!-- Testimonial Slide End -->
                            @endforeach
                            


                        </div>
                        <div class="car-details-btn">
                            <div class="car-button-prev"></div>
                            <div class="car-button-next"></div>
                        </div>
                    </div>
                </div>
                <!-- Testimonial Slider End -->
            </div>
        </div>
    </div>
</div>

<!-- Exclusive Partners Section Start -->
<div class="exclusive-partners bg-section">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Cars By Brands</h3>
                    <h2 class="text-anime-style-3">Discover the Ideal Ride</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            @foreach($brands as $key => $value)
                <div class="col-lg-3 col-6" style="cursor:pointer;">
                    <!-- Partners Logo Start -->
                    <div class="partners-logo wow fadeInUp brand-click" data-wow-delay="0.2s" data-id="{{$value->id}}">
                        <img src="{{asset($value->image)}}" alt="{{asset($value->name)}}">
                    </div>
                    <!-- Partners Logo End -->
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Exclusive Partners Section End -->

<!-- Hero Slider Section End -->
<div class="perfect-fleet bg-section">
        <div class="container-fluid">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Choose Your Car Type</h3>
                        <h2 class="text-anime-style-3">Find the Perfect Fit</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Testimonial Slider Start -->
                    <div class="car-details-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper" data-cursor-text="Drag">

                                @foreach($carType as $key => $value)
                                    <!-- Testimonial Slide Start -->
                                    <div class="swiper-slide type-click" data-id="{{$value->id}}">
                                        <div class="luxury-collection-image" data-cursor-text="View">
                                            <a ><figure><img src="{{asset($value->image)}}" alt=""></figure></a>
                                        </div>
                                        <div class="luxury-collection-title"><h2>{{$value->name}}</h2></div>
                                        <div class="luxury-collection-btn"><a  class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a></div>                               
                                    </div>
                                    <!-- Testimonial Slide End -->
                                @endforeach

                               

                                
                                </div>
                            </div>
                            <div class="car-details-btn">
                                <div class="car-button-prev"></div>
				                <div class="car-button-next"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Slider End -->
                </div>
            </div>
        </div>
    </div>


<!-- Our Services Section Start -->
<div class="our-services bg-section">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Explore UAE's Top Attractions</h3>
                    <h2 class="text-anime-style-3">Discover Your Next Adventure</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <!-- Service Item Start -->
                <div class="service-item wow fadeInUp">
                    <div class="service-content">
                        <img src="{{asset('assets/images/destination/1.jpg')}}" alt="" style="padding-bottom: 15px;">
                        <h3>Dubai</h3>
                        <p>Home to the opulent Burj Khalifa, Dubai is leading the list of the best places to visit in UAE with family.</p>
                    </div>
                    <div class="service-footer">
                        <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                    </div>
                </div>
                <!-- Service Item End -->
            </div>

            <div class="col-lg-3 col-md-6">
                <!-- Service Item Start -->
                <div class="service-item wow fadeInUp" data-wow-delay="0.25s">
                    <div class="service-content">
                        <img src="{{asset('assets/images/destination/2.jpg')}}" alt="" style="padding-bottom: 15px;">
                        <h3>Sharjah</h3>
                        <p>A wonderful city to explore the heritage of UAE, Sharjah is packed with a number of sites giving you a rich culture. </p>
                    </div>
                    <div class="service-footer">
                        <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                    </div>
                </div>
                <!-- Service Item End -->
            </div>

            <div class="col-lg-3 col-md-6">
                <!-- Service Item Start -->
                <div class="service-item wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-content">
                        <img src="{{asset('assets/images/destination/3.jpg')}}" alt="" style="padding-bottom: 15px;">
                        <h3>Abu Dhabi</h3>
                        <p>One of the best places to visit in UAE during summer as it has a number of waterparks, and a stunning shore.</p>
                    </div>
                    <div class="service-footer">
                        <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                    </div>
                </div>
                <!-- Service Item End -->
            </div>

            <div class="col-lg-3 col-md-6">
                <!-- Service Item Start -->
                <div class="service-item wow fadeInUp" data-wow-delay="0.75s">
                    <div class="service-content">
                        <img src="{{asset('assets/images/destination/4.jpg')}}" alt="" style="padding-bottom: 15px;">
                        <h3>Al Ain</h3>
                        <p>Also known as the Garden city of the Gulf, Al Ain is known to be one of the greenest cities of UAE.</p>
                    </div>
                    <div class="service-footer">
                        <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                    </div>
                </div>
                <!-- Service Item End -->
            </div>

            <div class="col-lg-12">
                <!-- Service Box Footer Start -->
                <div class="services-box-footer wow fadeInUp" data-wow-delay="1s">
                    <a href="#" class="btn-default">view all Destinations</a>
                </div>
                <!-- Service Box Footer End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Services Section End -->

<!-- About Us Section Start -->
<div class="about-us">
    <div class="container">
        <div class="row align-items-center">
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
                        <h2 class="text-anime-style-3">We are fully flexible and tailored to the client</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.25s">What this means is that we will deliver your cars to you when you need them – at the right time, in the right place.
                            We work in an energetic and continuous way to make sure our customers can find the rental car that is perfect for them. This includes making sure they know the exact costs. Our ethos includes making sure all mandatory fees are included in the price customers see so there are no surprises upon arrival….
                        </p>
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
<!-- About Us Section End -->

<!-- Intro Video Section Start -->
<div class="intro-video bg-section parallaxie">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">watch full video</h3>
                    <h2 class="text-anime-style-3">Discover the ease and convenience of renting with Us</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Intro Video Box Start -->
                <div class="intro-video-box">
                    <!-- Video Play Button Start -->
                    <div class="video-play-button">
                        <a href="https://www.youtube.com/watch?v=IdejM6wCkxA" class="popup-video" data-cursor-text="Play">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                    <!-- Video Play Button End -->

                    <!-- Client Slider Start -->
                    <div class="client-slider">
                        <div class="swiper client_logo_slider">
                            <div class="swiper-wrapper">

                                @foreach($brands as $key => $value)
                                    <!-- company Logo Start -->
                                    <div class="swiper-slide brand-click" data-id="{{$value->id}}" style="cursor:pointer;">
                                        <div class="company-logo">
                                            <img src="{{asset($value->image)}}" alt="">
                                        </div>
                                    </div>
                                    <!-- company Logo End -->
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!-- Client Slider End -->
                </div>
                <!-- Intro Video Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Intro Video Section End -->

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

<!-- Our FAQs Section Start -->
<div class="our-faqs bg-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-1 order-md-2 order-2">
                <!-- Our Faqs Image Start -->
                <div class="our-faqs-image">
                    <div class="faqs-img-1">
                        <figure class="image-anime">
                            <img src="{{asset('assets/images/our-faqs-img-1.jpg')}}" alt="">
                        </figure>
                    </div>

                    <div class="faqs-img-2">
                        <figure class="image-anime">
                            <img src="{{asset('assets/images/our-faqs-img-2.jpg')}}" alt="">
                        </figure>
                    </div>
                </div>
                <!-- Our Faqs Image End -->
            </div>

            <div class="col-lg-6 order-lg-2 order-md-1 order-1">
                <!-- Our Faqs Content Start -->
                <div class="our-faqs-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">frequently asked questions</h3>
                        <h2 class="text-anime-style-3">Everything you need to know about our services</h2>
                    </div>
                    <!-- Section Title End -->

                    <!-- Our Faqs Accordion Start -->
                    <div class="our-faqs-accordion" id="faqsaccordion">
                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.25s">
                            <h2 class="accordion-header" id="faqheading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqcollapse1" aria-expanded="true" aria-controls="faqcollapse1">
                                    Do you require a deposit to rent a vehicle?
                                </button>
                            </h2>
                            <div id="faqcollapse1" class="accordion-collapse collapse show" aria-labelledby="faqheading1"
                                data-bs-parent="#faqsaccordion">
                                <div class="accordion-body">
                                    <p>Yes credit card approval is made on your credit card to cover unpaid expenses like salik ,traffic fines and damages during the time of the rental.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s">
                            <h2 class="accordion-header" id="faqheading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqcollapse2" aria-expanded="false" aria-controls="faqcollapse2">
                                    How much I will be charged for crossing salik gate?
                                </button>
                            </h2>
                            <div id="faqcollapse2" class="accordion-collapse collapse" aria-labelledby="faqheading2"
                                data-bs-parent="#faqsaccordion">
                                <div class="accordion-body">
                                    <p>You will be charged AED 5 on every salik gate crossing and will be billed at the end of your rental duration.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->
                        
                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.75s">
                            <h2 class="accordion-header" id="faqheading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqcollapse3" aria-expanded="false" aria-controls="faqcollapse3">
                                    What type of vehicle insurance will I receive by default?
                                </button>
                            </h2>
                            <div id="faqcollapse3" class="accordion-collapse collapse" aria-labelledby="faqheading3"
                                data-bs-parent="#faqsaccordion">
                                <div class="accordion-body">
                                    <p>Vehicles are covered by full comprehensive insurance as per the UAE laws. However, a police report must be obtained at the time of an accident or in case of damage. If the renter failed to produce a valid police report to Car Provider, all charges incurred will be the responsibility of the client, even if CDW has been taken. No replacement vehicle will be supplied and rental charges will continue until a police report is received along with any other relevant documents. In case of an accident and/or damage, the client is required to pay excess liability if CDW is not taken. A valid Police report is also required. In the event of theft of a rented vehicle, the police must be notified immediately; otherwise cover would be rendered void. Insurance covers use of the vehicle in U.A.E. only, unless prior agreement is given by Car Provider.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->
                    </div>
                    <!-- Our Faqs Accordion End -->
                </div>
                <!-- Our Faqs Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Our FAQs Section End -->

<!-- Our Testiminial Start -->
<div class="our-testimonial">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">testimonials</h3>
                    <h2 class="text-anime-style-3">What our customers are saying about us</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Testimonial Slider Start -->
                <div class="testimonial-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper" data-cursor-text="Drag">
                            <!-- Testimonial Slide Start -->
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="testimonial-header">
                                        <div class="testimonial-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="testimonial-content">
                                            <p>Renting a car from carline was a great decision. Not only did I get a reliable and comfortable vehicle, but the prices were also very competitive.</p>								
                                        </div>
                                    </div>
                                    <div class="testimonial-body">
                                        <div class="author-image">
                                            <figure class="image-anime">
                                                <img src="{{asset('assets/images/author-1.jpg')}}" alt="">
                                            </figure>
                                        </div>            
                                        <div class="author-content">
                                            <h3>floyd miles</h3>
                                            <p>project manager</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Testimonial Slide End -->
                                
                            <!-- Testimonial Slide Start -->
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="testimonial-header">
                                        <div class="testimonial-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="testimonial-content">
                                            <p>Renting a car from carline was a great decision. Not only did I get a reliable and comfortable vehicle, but the prices were also very competitive.</p>								
                                        </div>
                                    </div>
                                    <div class="testimonial-body">
                                        <div class="author-image">
                                            <figure class="image-anime">
                                                <img src="{{asset('assets/images/author-2.jpg')}}" alt="">
                                            </figure>
                                        </div>            
                                        <div class="author-content">
                                            <h3>annette black</h3>
                                            <p>project manager</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Testimonial Slide End -->

                            <!-- Testimonial Slide Start -->
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="testimonial-header">
                                        <div class="testimonial-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="testimonial-content">
                                            <p>Renting a car from carline was a great decision. Not only did I get a reliable and comfortable vehicle, but the prices were also very competitive.</p>								
                                        </div>
                                    </div>
                                    <div class="testimonial-body">
                                        <div class="author-image">
                                            <figure class="image-anime">
                                                <img src="{{asset('assets/images/author-3.jpg')}}" alt="">
                                            </figure>
                                        </div>            
                                        <div class="author-content">
                                            <h3>leslie alexander</h3>
                                            <p>project manager</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Testimonial Slide End -->

                            <!-- Testimonial Slide Start -->
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="testimonial-header">
                                        <div class="testimonial-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="testimonial-content">
                                            <p>Renting a car from carline was a great decision. Not only did I get a reliable and comfortable vehicle, but the prices were also very competitive.</p>								
                                        </div>
                                    </div>
                                    <div class="testimonial-body">
                                        <div class="author-image">
                                            <figure class="image-anime">
                                                <img src="{{asset('assets/images/author-4.jpg')}}" alt="">
                                            </figure>
                                        </div>            
                                        <div class="author-content">
                                            <h3>alis white</h3>
                                            <p>project manager</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Testimonial Slide End -->
                        </div>
                        <div class="testimonial-btn">
                            <div class="testimonial-button-prev"></div>
                            <div class="testimonial-button-next"></div>
                        </div>
                    </div>
                </div>
                <!-- Testimonial Slider End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Testiminial End -->
    
<!-- CTA Box Section Start -->
<div class="cta-box bg-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-md-12">
                <!-- Cta Box Content Start -->
                <center><div class="cta-box-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-3">Ready to hit the road? <br>Book your car today !</h2>
                        <p class="wow fadeInUp">Our friendly customer service team is here to help. Contact us anytime for support and inquiries.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Cta Box Btn Start -->
                    <div class="cta-box-btn wow fadeInUp" data-wow-delay="0.5s">
                        <a href="{{ url('/contact') }}" class="btn-default">contact us</a>
                    </div>
                    <!-- Cta Box Btn End -->
                </div></center>
                <!-- Cta Box Content End -->
            </div>

        </div>
    </div>
</div>
<!-- CTA Box Section End -->

<!-- Our Latest Article Start -->
<div class="latest-article">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">latest articles</h3>
                    <h2 class="text-anime-style-3">Stay informed and inspired for your next journey</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <!-- Highlighted Article Post Start -->
                <div class="highlighted-article-post wow fadeInUp">
                    <!-- Highlighted Article Featured Image Start -->
                    <div class="highlighted-article-featured-img">
                        <figure>
                            <a href="#" class="image-anime" data-cursor-text="View">
                                <img src="{{asset('assets/images/post-1.jpg')}}" alt="">
                            </a>
                        </figure>
                    </div>
                    <!-- Highlighted Article Featured Image End -->

                    <!-- Highlighted Article Body Start -->
                    <div class="highlighted-article-body">
                        <!-- Article Meta Start -->
                        <div class="article-meta">
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-calendar-days"></i> sep 19, 2024</a></li>
                            </ul>
                        </div>
                        <!-- Article Meta End -->

                        <!-- Highlighted Article Content Start -->
                        <div class="highlighted-article-content">
                            <h3><a href="#">Road Trip Essentials: What to Pack for a Smooth Journey</a></h3>
                            <a href="news1.html" class="section-icon-btn">
                                <img src="{{asset('assets/images/arrow-white.svg')}}" alt="">
                            </a>
                        </div>
                        <!-- Highlighted Article Content End -->
                    </div>
                    <!-- Highlighted Article Body End -->
                </div>
                <!-- Highlighted Article Post End -->
            </div>
            <div class="col-lg-6">
                <!-- Article Post Start -->
                <div class="article-post wow fadeInUp">
                    <div class="article-featured-img">
                        <figure>
                            <a href="#" class="image-anime" data-cursor-text="View">
                                <img src="{{asset('assets/images/post-2.jpg')}}" alt="">
                            </a>
                        </figure>
                    </div>

                    <div class="article-post-body">
                        <!-- Article Meta Start -->
                        <div class="article-meta">
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-calendar-days"></i> sep 20, 2024</a></li>
                            </ul>
                        </div>
                        <!-- Article Meta End -->

                        <div class="article-post-content">
                            <h3><a href="#">Exploring the City: Best Urban Destinations for a Weekend Getaway</a></h3>
                            <a href="news1.html" class="read-story-btn">read story</a>
                        </div>
                    </div>
                </div>
                <!-- Article Post End -->

                <!-- Article Post Start -->
                <div class="article-post wow fadeInUp" data-wow-delay="0.25s">
                    <div class="article-featured-img">
                        <figure>
                            <a href="#" class="image-anime" data-cursor-text="View">
                                <img src="{{asset('assets/images/post-3.jpg')}}" alt="">
                            </a>
                        </figure>
                    </div>

                    <div class="article-post-body">
                        <!-- Article Meta Start -->
                        <div class="article-meta">
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-calendar-days"></i> sep 21, 2024</a></li>
                            </ul>
                        </div>
                        <!-- Article Meta End -->

                        <div class="article-post-content">
                            <h3><a href="#">Exploring the City: Best Urban Destinations for a Weekend Getaway</a></h3>
                            <a href="news1.html" class="read-story-btn">read story</a>
                        </div>
                    </div>
                </div>
                <!-- Article Post End -->

                <!-- Article Post Start -->
                <div class="article-post wow fadeInUp" data-wow-delay="0.5s">
                    <div class="article-featured-img">
                        <figure>
                            <a href="#" class="image-anime" data-cursor-text="View">
                                <img src="{{asset('assets/images/post-4.jpg')}}" alt="">
                            </a>
                        </figure>
                    </div>

                    <div class="article-post-body">
                        <!-- Article Meta Start -->
                        <div class="article-meta">
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-calendar-days"></i> sep 22, 2024</a></li>
                            </ul>
                        </div>
                        <!-- Article Meta End -->

                        <div class="article-post-content">
                            <h3><a href="#">Exploring the City: Best Urban Destinations for a Weekend Getaway</a></h3>
                            <a href="news1.html" class="read-story-btn">read story</a>
                        </div>
                    </div>
                </div>
                <!-- Article Post End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Latest Article End -->
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script> 
<script>

var source = new google.maps.places.Autocomplete(document.getElementById('source'));



function fillInAddress() {
  var place = source.getPlace();

  // Get the latitude and longitude of the location
  var lat = place.geometry.location.lat();
  var lng = place.geometry.location.lng();
//   console.log(lat)
//   console.log(lng)
}

// Listen for when the user selects a location from the autocomplete dropdown
source.addListener('place_changed', fillInAddress);
</script>
@endsection