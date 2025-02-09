@extends('layouts.site')

@section('content')
<!-- Page Header Start -->
<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Dubai</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dubai</li>
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
                                        <img src="{{asset('assets/images/877.jpg')}}" alt="">
                                    </figure>
                                </div>
                                <!-- Vision Image End -->
                            </div>

                            <div class="col-lg-6">
                                <!-- Vision Mission Content Start -->
                                <div class="vision-mission-content">
                                    <!-- Section Title Start -->
                                    <div class="section-title">
                                        <h3 class="wow fadeInUp">Dubai</h3>
                                        <h2 class="text-anime-style-3" data-cursor="-opaque">Dubai – A City of Dreams and Discoveries</h2>
                                        <p class="wow fadeInUp" data-wow-delay="0.25s">Dubai, a city of wonders, is the ultimate destination for travelers seeking luxury, adventure, and 
                                            cultural richness. At Carline, our vision is to revolutionize car rentals by offering seamless mobility solutions tailored for Dubai’s 
                                            dynamic landscape. From the towering Burj Khalifa to the pristine beaches of Jumeirah, we aim to enhance every journey with convenience, 
                                            reliability, and premium service. Whether you're exploring the vibrant streets of Downtown Dubai, venturing into the golden dunes of 
                                            the Arabian Desert, or cruising along the stunning Palm Jumeirah, we ensure a hassle-free experience with transparent pricing and 
                                            top-tier customer service. Our commitment to excellence is driven by a passion for redefining travel—where every ride is more than 
                                            just transportation, it's an experience crafted for comfort, luxury, and unforgettable memories in the heart of Dubai.</p>
                                            
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
                    <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Dubai</h3>
                    <h2 class="text-anime-style-3" style="perspective: 400px;">Top Attractions OF Dubai</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="car-details-slider">
                <div class="swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                    <div class="swiper-wrapper" data-cursor-text="Drag" id="swiper-wrapper-9ebdd264537877106" aria-live="off" style="transition-duration: 0ms; transform: translate3d(-1040px, 0px, 0px); transition-delay: 0ms;">
                        

                        <!-- Testimonial Slide Start -->
                        <div class="swiper-slide" role="group" aria-label="2 / 9" data-swiper-slide-index="1" style="width: 230px; margin-right: 30px;">
                            <div class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <img src="{{asset('assets/images/destination/15.jpg')}}" alt="">
                            </div>  
                            <center><h5>Palm Jumeirah</h5> </center>                          
                        </div>
                        <!-- Testimonial Slide End -->

                        <!-- Testimonial Slide Start -->
                        <div class="swiper-slide" role="group" aria-label="3 / 9" data-swiper-slide-index="2" style="width: 230px; margin-right: 30px;">
                            <div class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <img src="{{asset('assets/images/destination/14.jpg')}}" alt="">
                            </div> 
                            <center><h5>Desert Safari</h5> </center>                            
                        </div>
                        <!-- Testimonial Slide End -->

                        <!-- Testimonial Slide Start -->
                        <div class="swiper-slide" role="group" aria-label="4 / 9" data-swiper-slide-index="3" style="width: 230px; margin-right: 30px;">
                            <div class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <img src="{{asset('assets/images/destination/13.jpg')}}" alt="">
                            </div>    
                            <center><h5>Global Village</h5> </center>                         
                        </div>
                        <!-- Testimonial Slide End -->

                        <!-- Testimonial Slide Start -->
                        <div class="swiper-slide swiper-slide-prev" role="group" aria-label="5 / 9" data-swiper-slide-index="4" style="width: 230px; margin-right: 30px;">
                            <div class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <img src="{{asset('assets/images/destination/16.jpg')}}" alt="">
                            </div>   
                            <center><h5>Jumeirah Beach</h5> </center>                          
                        </div>
                        <!-- Testimonial Slide End -->

                        <!-- Testimonial Slide Start -->
                        <div class="swiper-slide swiper-slide-active" role="group" aria-label="6 / 9" data-swiper-slide-index="5" style="width: 230px; margin-right: 30px;">
                            <div class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <img src="{{asset('assets/images/destination/12.jpg')}}" alt="">
                            </div>  
                            <center><h5>Dubai Museum</h5> </center>                           
                        </div>
                        <!-- Testimonial Slide End -->


                        <!-- Testimonial Slide Start -->
                        <div class="swiper-slide swiper-slide-next" role="group" aria-label="7 / 9" data-swiper-slide-index="6" style="width: 230px; margin-right: 30px;">
                            <div class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <img src="{{asset('assets/images/destination/11.jpg')}}" alt="">
                            </div>     
                            <center><h5>Burj Khalifa</h5> </center>                         
                        </div>
                        <!-- Testimonial Slide End -->


                    </div>
                    <div class="car-details-btn">
                        <div class="car-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-bcb93a9a9e997fc10"></div>
                        <div class="car-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-bcb93a9a9e997fc10"></div>
                    </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span><span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
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