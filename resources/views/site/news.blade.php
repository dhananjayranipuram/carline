@extends('layouts.site')

@section('content')

<!-- Page Header Start -->
<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">News</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">News</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Page Blog Start -->
<div class="page-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <!-- Blog Item Start -->
                <div class="post-item wow fadeInUp">
                    <!-- Post Featured Image Start-->
                    <div class="post-featured-image" data-cursor-text="View">
                        <figure>
                            <a href="#" class="image-anime">
                                <img src="{{asset('assets/images/post-1.jpg')}}" alt="">
                            </a>
                        </figure>
                    </div>
                    <!-- Post Featured Image End -->

                    <!-- post Item Body Start -->
                    <div class="post-item-body">
                        <!-- Post Meta Start -->
                        <div class="post-meta">
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-calendar-days"></i> july 26, 2024</a></li>
                            </ul>
                        </div>
                        <!-- Post Meta End -->

                        <!-- post Item Content Start -->
                        <div class="post-item-content">
                            <h2><a href="#">top tips for booking your car rental: what you need to know</a></h2>
                        </div>
                        <!-- Post Item Content End-->

                        <!-- Post Item Footer Start-->
                        <div class="post-item-btn">
                            <a href="#" class="read-story-btn">read more</a>
                        </div>
                        <!-- Post Item Footer End-->
                    </div>
                    <!-- Post Item Body End-->                      
                </div>
                <!-- Blog Item End -->
            </div>

            <div class="col-lg-4 col-md-6">
                <!-- Blog Item Start -->
                <div class="post-item wow fadeInUp" data-wow-delay="0.25s">
                    <!-- Post Featured Image Start-->
                    <div class="post-featured-image" data-cursor-text="View">
                        <figure>
                            <a href="#" class="image-anime">
                                <img src="{{asset('assets/images/post-2.jpg')}}" alt="">
                            </a>
                        </figure>
                    </div>
                    <!-- Post Featured Image End -->

                    <!-- post Item Body Start -->
                    <div class="post-item-body">
                        <!-- Post Meta Start -->
                        <div class="post-meta">
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-calendar-days"></i> july 25, 2024</a></li>
                            </ul>
                        </div>
                        <!-- Post Meta End -->

                        <!-- post Item Content Start -->
                        <div class="post-item-content">
                            <h2><a href="#">exploring your rental car options: sedan, suv, or convertible?</a></h2>
                        </div>
                        <!-- Post Item Content End-->

                        <!-- Post Item Footer Start-->
                        <div class="post-item-btn">
                            <a href="#" class="read-story-btn">read more</a>
                        </div>
                        <!-- Post Item Footer End-->
                    </div>
                    <!-- Post Item Body End-->                      
                </div>
                <!-- Blog Item End -->
            </div>

            <div class="col-lg-4 col-md-6">
                <!-- Blog Item Start -->
                <div class="post-item wow fadeInUp" data-wow-delay="0.5s">
                    <!-- Post Featured Image Start-->
                    <div class="post-featured-image" data-cursor-text="View">
                        <figure>
                            <a href="#" class="image-anime">
                                <img src="{{asset('assets/images/post-3.jpg')}}" alt="">
                            </a>
                        </figure>
                    </div>
                    <!-- Post Featured Image End -->

                    <!-- post Item Body Start -->
                    <div class="post-item-body">
                        <!-- Post Meta Start -->
                        <div class="post-meta">
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-calendar-days"></i> july 24, 2024</a></li>
                            </ul>
                        </div>
                        <!-- Post Meta End -->

                        <!-- post Item Content Start -->
                        <div class="post-item-content">
                            <h2><a href="#">the pros and cons of renting a car vs. using rideshare services</a></h2>
                        </div>
                        <!-- Post Item Content End-->

                        <!-- Post Item Footer Start-->
                        <div class="post-item-btn">
                            <a href="#" class="read-story-btn">read more</a>
                        </div>
                        <!-- Post Item Footer End-->
                    </div>
                    <!-- Post Item Body End-->                      
                </div>
                <!-- Blog Item End -->
            </div>

        
        </div>
    </div>
</div>
<!-- Page Blog End -->

@endsection