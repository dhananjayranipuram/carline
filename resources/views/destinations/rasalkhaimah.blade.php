@extends('layouts.site')

@section('content')
<!-- Page Header Start -->
<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Ras Al Khaimah</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ras Al Khaimah</li>
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
                                    <img src="{{asset('assets/images/destination/70.jpg')}}" alt="Ras Al Khaimah">
                                </figure>
                            </div>
                            <!-- Vision Image End -->
                        </div>

                        <div class="col-lg-6">
                            <!-- Vision Mission Content Start -->
                            <div class="vision-mission-content">
                                <!-- Section Title Start -->
                                <div class="section-title">
                                    <h3 class="wow fadeInUp">Ras Al Khaimah</h3>
                                    <h2 class="text-anime-style-3" data-cursor="-opaque">Ras Al Khaimah – Adventure Awaits</h2>
                                    <p class="wow fadeInUp" data-wow-delay="0.25s">
                                        Ras Al Khaimah, the northernmost emirate of the UAE, offers a breathtaking mix of mountains, beaches, and 
                                        deserts. At Carline, our mission is to provide seamless car rental services that let you explore Ras Al 
                                        Khaimah’s natural beauty and adventurous experiences. Whether you’re hiking the rugged **Hajar Mountains**, 
                                        relaxing on the pristine **Al Marjan Island**, or discovering the **Al Hamra Fort**, we ensure a smooth and 
                                        luxurious experience with transparent pricing and excellent service. Ras Al Khaimah is a playground for adventure, 
                                        and we are here to make your journey through it truly unforgettable, offering you flexibility and comfort every 
                                        step of the way.
                                    </p>
                                </div>
                                <!-- Section Title End -->
                                <div class="about-content-footer wow fadeInUp" data-wow-delay="1s">
                                    <a href="contact.html" class="btn-default">Contact Us</a>
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


<!-- Attractions Slider Section Start -->
<div class="exclusive-partners bg-section">
<div class="container">
    <div class="row section-row">
        <div class="col-lg-12">
            <!-- Section Title Start -->
            <div class="section-title">
                <h3 class="wow fadeInUp">Ras Al Khaimah</h3>
                <h2 class="text-anime-style-3">Top Attractions of Ras Al Khaimah</h2>
            </div>
            <!-- Section Title End -->
        </div>
    </div>

    <div class="row">
        <div class="car-details-slider">
            <div class="swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                <div class="swiper-wrapper" data-cursor-text="Drag">

                    <!-- Attraction Slide Start -->
                    <div class="swiper-slide">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/71.jpg')}}" alt="Hajar Mountains">
                        </div>  
                        <center><h5>Hajar Mountains</h5></center>                          
                    </div>
                    <!-- Attraction Slide End -->

                    <!-- Attraction Slide Start -->
                    <div class="swiper-slide">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/72.jpg')}}" alt="Al Marjan Island">
                        </div>  
                        <center><h5>Al Marjan Island</h5></center>                            
                    </div>
                    <!-- Attraction Slide End -->

                    <!-- Attraction Slide Start -->
                    <div class="swiper-slide">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/73.jpg')}}" alt="Al Hamra Fort">
                        </div>  
                        <center><h5>Al Hamra Fort</h5></center>                          
                    </div>
                    <!-- Attraction Slide End -->

                    <!-- Attraction Slide Start -->
                    <div class="swiper-slide">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/74.jpg')}}" alt="Jebel Jais">
                        </div>  
                        <center><h5>Jebel Jais</h5></center>                          
                    </div>
                    <!-- Attraction Slide End -->

                    <!-- Attraction Slide Start -->
                    <div class="swiper-slide">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/75.jpg')}}" alt="Ras Al Khaimah National Museum">
                        </div>  
                        <center><h5>Ras Al Khaimah National Museum</h5></center>                          
                    </div>
                    <!-- Attraction Slide End -->

                    <!-- Attraction Slide Start -->
                    <div class="swiper-slide">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('assets/images/destination/76.jpg')}}" alt="Al Wadi Nature Reserve">
                        </div>  
                        <center><h5>Al Wadi Nature Reserve</h5></center>                          
                    </div>
                    <!-- Attraction Slide End -->

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
<!-- Attractions Slider Section End -->



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