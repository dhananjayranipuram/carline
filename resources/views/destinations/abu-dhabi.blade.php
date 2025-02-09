@extends('layouts.site')

@section('content')
<!-- Page Header Start -->
<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Abu Dhabi</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Abu Dhabi</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Vision Mission Section Start -->
<div class="vision-mission">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Vision Mission Box Start -->
                <div class="vision-mission-box tab-content" id="myTabContent">
                    <!-- Our Vision Item Start -->
                    <div class="our-vision-item tab-pane fade show active" id="vision" role="tabpanel">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <!-- Vision Image Start -->
                                <div class="vision-image">
                                    <figure class="image-anime reveal">
                                        <img src="{{asset('assets/images/destination/30.jpg')}}" alt="Abu Dhabi">
                                    </figure>
                                </div>
                                <!-- Vision Image End -->
                            </div>

                            <div class="col-lg-6">
                                <!-- Vision Mission Content Start -->
                                <div class="vision-mission-content">
                                    <!-- Section Title Start -->
                                    <div class="section-title">
                                        <h3 class="wow fadeInUp">Abu Dhabi</h3>
                                        <h2 class="text-anime-style-3" data-cursor="-opaque">Abu Dhabi – The Capital of Culture and Innovation</h2>
                                        <p class="wow fadeInUp" data-wow-delay="0.25s">Abu Dhabi, the capital of the UAE, blends modernity with deep-rooted heritage, offering a journey 
                                            through architectural wonders, cultural landmarks, and scenic landscapes. At Carline, we are dedicated to providing seamless car rental 
                                            experiences tailored for this majestic city. Whether you’re visiting the iconic Sheikh Zayed Grand Mosque, indulging in world-class art at 
                                            the Louvre Abu Dhabi, or seeking adrenaline at Ferrari World, we ensure you travel in comfort and style. Our commitment to reliability, 
                                            transparency, and customer satisfaction makes every ride a refined experience, allowing you to explore the grandeur of Abu Dhabi without limits.</p>
                                    </div>
                                    <!-- Section Title End -->
                                    <div class="about-content-footer wow fadeInUp" data-wow-delay="1s" style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                                        <a href="contact.html" class="btn-default">contact us</a>
                                    </div>
                                </div>
                                <!-- Vision Mission Content End -->
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


<div class="exclusive-partners bg-section">
<div class="container">
    <div class="row section-row">
        <div class="col-lg-12">
            <!-- Section Title Start -->
            <div class="section-title">
                <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Abu Dhabi</h3>
                <h2 class="text-anime-style-3" style="perspective: 400px;">Top Attractions of Abu Dhabi</h2>
            </div>
            <!-- Section Title End -->
        </div>
    </div>

    <div class="row">
        <div class="car-details-slider">
            <div class="swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                <div class="swiper-wrapper" data-cursor-text="Drag" id="swiper-wrapper-9ebdd264537877106" aria-live="off">

                    <!-- Testimonial Slide Start -->
                    <div class="swiper-slide" role="group" aria-label="1 / 6" data-swiper-slide-index="0">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/31.jpg')}}" alt="Sheikh Zayed Grand Mosque">
                        </div>  
                        <center><h5>Sheikh Zayed Grand Mosque</h5></center>                          
                    </div>
                    <!-- Testimonial Slide End -->

                    <!-- Testimonial Slide Start -->
                    <div class="swiper-slide" role="group" aria-label="2 / 6" data-swiper-slide-index="1">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/32.jpg')}}" alt="Louvre Abu Dhabi">
                        </div>  
                        <center><h5>Louvre Abu Dhabi</h5></center>                            
                    </div>
                    <!-- Testimonial Slide End -->

                    <!-- Testimonial Slide Start -->
                    <div class="swiper-slide" role="group" aria-label="3 / 6" data-swiper-slide-index="2">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/33.jpg')}}" alt="Ferrari World">
                        </div>  
                        <center><h5>Ferrari World</h5></center>                          
                    </div>
                    <!-- Testimonial Slide End -->

                    <!-- Testimonial Slide Start -->
                    <div class="swiper-slide" role="group" aria-label="4 / 6" data-swiper-slide-index="3">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/34.jpg')}}" alt="Emirates Palace">
                        </div>  
                        <center><h5>Emirates Palace</h5></center>                          
                    </div>
                    <!-- Testimonial Slide End -->

                    <!-- Testimonial Slide Start -->
                    <div class="swiper-slide" role="group" aria-label="5 / 6" data-swiper-slide-index="4">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/35.jpg')}}" alt="Yas Island">
                        </div>  
                        <center><h5>Yas Island</h5></center>                          
                    </div>
                    <!-- Testimonial Slide End -->

                    <!-- Testimonial Slide Start -->
                    <div class="swiper-slide" role="group" aria-label="6 / 6" data-swiper-slide-index="5">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/36.jpg')}}" alt="Corniche Beach">
                        </div>  
                        <center><h5>Corniche Beach</h5></center>                          
                    </div>
                    <!-- Testimonial Slide End -->

                </div>
                <div class="car-details-btn">
                    <div class="car-button-prev" tabindex="0" role="button" aria-label="Previous slide"></div>
                    <div class="car-button-next" tabindex="0" role="button" aria-label="Next slide"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<div class="our-testimonial">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">testimonials</h3>
                    <h2 class="text-anime-style-3" style="perspective: 400px;"><div class="split-line" style="display: block; text-align: center; position: relative;"><div style="position:relative;display:inline-block;"><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">W</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">h</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">a</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">t</div></div> <div style="position:relative;display:inline-block;"><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">o</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">u</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">r</div></div> <div style="position:relative;display:inline-block;"><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">c</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">u</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">s</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">t</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">o</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">m</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">e</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">r</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">s</div></div> <div style="position:relative;display:inline-block;"><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">a</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">r</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">e</div></div> </div><div class="split-line" style="display: block; text-align: center; position: relative;"><div style="position:relative;display:inline-block;"><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">s</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">a</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">y</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">i</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">n</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">g</div></div> <div style="position:relative;display:inline-block;"><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">a</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">b</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">o</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">u</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">t</div></div> <div style="position:relative;display:inline-block;"><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">u</div><div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">s</div></div></div></h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Testimonial Slider Start -->
                <div class="testimonial-slider">
                    <div class="swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                        <div class="swiper-wrapper" data-cursor-text="Drag" id="swiper-wrapper-ae1235f24fdac88a" aria-live="off" style="transition-duration: 0ms; transform: translate3d(-433.333px, 0px, 0px); transition-delay: 0ms;">
                            <!-- Testimonial Slide Start -->
                            
                            <!-- Testimonial Slide End -->
                                
                            <!-- Testimonial Slide Start -->
                            
                            <!-- Testimonial Slide End -->

                            <!-- Testimonial Slide Start -->
                            
                            <!-- Testimonial Slide End -->

                            <!-- Testimonial Slide Start -->
                            
                            <!-- Testimonial Slide End -->
                        <div class="swiper-slide swiper-slide-prev" role="group" aria-label="2 / 4" data-swiper-slide-index="1" style="width: 403.333px; margin-right: 30px;">
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
                            </div><div class="swiper-slide swiper-slide-active" role="group" aria-label="3 / 4" data-swiper-slide-index="2" style="width: 403.333px; margin-right: 30px;">
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
                            </div><div class="swiper-slide swiper-slide-next" role="group" aria-label="4 / 4" data-swiper-slide-index="3" style="width: 403.333px; margin-right: 30px;">
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
                            </div><div class="swiper-slide" role="group" aria-label="1 / 4" data-swiper-slide-index="0" style="width: 403.333px; margin-right: 30px;">
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
                            </div></div>
                        <div class="testimonial-btn">
                            <div class="testimonial-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-ae1235f24fdac88a"></div>
                            <div class="testimonial-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-ae1235f24fdac88a"></div>
                        </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                </div>
                <!-- Testimonial Slider End -->
            </div>
        </div>
    </div>
</div>
@endsection