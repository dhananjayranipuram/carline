@extends('layouts.site')

@section('content')

<!-- Page Header Start -->
<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Contact Us</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">contact us</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Page Contact Us Start -->
<div class="page-contact-us">
    <div class="contact-info-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Contact Information Start -->
                    <div class="contact-information">
                        <!-- Contact Information Title Start -->
                        <div class="section-title">
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Contact information</h2>
                            <!-- <p>Say something to start a live chat!</p> -->
                        </div>
                        <!-- Contact Information Title End -->

                        <!-- Contact Information List Start -->
                        <div class="contact-info-list">
                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.25s">
                                <!-- Icon Box Start -->
                                <div class="icon-box">
                                    <img src="{{asset('assets/images/icon-phone.svg')}}" alt="">
                                </div>
                                <!-- Icon Box End -->

                                <!-- Contact Info Content Start -->
                                <div class="contact-info-content">
                                    <p>+971 56 573 8866</p>
                                    <p>+971 50 86 89 526</p>
                                    <p>+971 4 52 92 722</p>
                                </div>
                                <!-- Contact Info Content End -->
                            </div>
                            <!-- Contact Info Item End -->

                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.5s">
                                <!-- Icon Box Start -->
                                <div class="icon-box">
                                    <img src="{{asset('assets/images/icon-mail.svg')}}" alt="">
                                </div>
                                <!-- Icon Box End -->

                                <!-- Contact Info Content Start -->
                                <div class="contact-info-content">
                                    <p>info@carlinerental.com</p>
                                </div>
                                <!-- Contact Info Content End -->
                            </div>
                            <!-- Contact Info Item End -->

                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.75s">
                                <!-- Icon Box Start -->
                                <div class="icon-box">
                                    <img src="{{asset('assets/images/icon-location.svg')}}" alt="">
                                </div>
                                <!-- Icon Box End -->

                                <!-- Contact Info Content Start -->
                                <div class="contact-info-content">
                                    <p>Near Saffron Boutique Hotel, Omar Bin Al Khattab Road Deira Dubai U.A.E</p>
                                </div>
                                <!-- Contact Info Content End -->
                            </div>
                            <!-- Contact Info Item End -->
                        </div>
                        <!-- Contact Information List End -->

                        <!-- Contact Information Social Start -->
                        <div class="contact-info-social wow fadeInUp" data-wow-delay="0.5s">
                            <ul>
                                <li><a href="https://www.facebook.com/AdsRentACar" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="https://www.tiktok.com/@carliine2?_t=ZS-8tVBaxLhhY7&_r=1" target="_blank"><i class="fa-brands fa-brands fa-tiktok"></i></a></li>
                                <li><a href="https://x.com/carlinecarrent?t=shn3hwBqpzzUOHUfLtv3_w&s=09" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/in/car-line-car-rental-080693349?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                <li><a href="https://www.instagram.com/car_line.car_rental?igsh=c2g1MXlnaTQxbjYx" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>                                                                
                            </ul>
                        </div>
                        <!-- Contact Information Social End -->
                    </div>
                    <!-- Contact Information End -->
                </div>
                
                <div class="col-lg-6">
                    
                    <div id="msgSubmit" class="h3 hidden">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                    <!-- Contact Form Start -->
                    <div class="contact-us-form">
                        <form action="{{url('/send-contact-us')}}" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.5s">
                        @csrf <!-- {{ csrf_field() }} -->
                            <div class="row">
                                <div class="form-group col-md-6 mb-4">
                                    <label>first name</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="Enter Your Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <label>last name</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Enter Your Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <label>email</label>
                                    <input type="email" name ="email" class="form-control" placeholder="Enter Your Email" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <label>phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Your Number" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <label>message</label>
                                    <textarea name="message" class="form-control" rows="4" placeholder="Write Your Message" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="contact-form-btn">
                                        <button type="submit" class="btn-default">send message</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Contact Form End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Contact Us End -->

<!-- Google Map Start -->
<div class="google-map">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">location</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">How to reach our location</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Google Map Iframe Start -->
                <div class="google-map-iframe">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d461798.9309653719!2d55.314722!3d25.277173!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5cb2d60cf4df%3A0xb571d0f808a3b0d8!2sCAR%20LINE%20RENT%20A%20CAR!5e0!3m2!1sen!2sus!4v1725612887834!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- Google Map Iframe End -->
            </div>
        </div>
    </div>
</div>
<!-- Google Map End -->

@endsection