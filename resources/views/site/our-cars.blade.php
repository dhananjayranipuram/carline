@extends('layouts.site')

@section('content')
<!-- Page Header Start -->
<!-- <div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                Page Header Box Start
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Our Cars</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cars</li>
                        </ol>
                    </nav>
                </div>
                Page Header Box End
            </div>
        </div>
    </div>
</div> -->
<!-- Page Header End -->

<!-- Page Fleets Start -->
<div class="page-fleets">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <!-- Fleets Sidebar Start -->
                <div class="fleets-sidebar wow fadeInUp">
                    <!-- Fleets Search Box Start -->
                    <div class="fleets-search-box">
                        <form id="fleetsForm" action="#" method="POST">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control"  id="search" placeholder="Search..." required>
                                <button type="submit" class="section-icon-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- Fleets Search Box End -->

                    <div class="fleets-sidebar-list-box">
                        <!-- Fleets Sidebar List Start -->
                        <div class="fleets-sidebar-list">
                            <div class="fleets-list-title">
                                <h3>Car Type</h3>
                            </div>

                            <ul>
                                @foreach($carType as $key => $value)
                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$value->id}}">
                                    <label class="form-check-label" for="checkbox1">{{$value->name}}</label>
                                </li>
                                @endforeach                                
                            </ul>
                        </div>
                        <!-- Fleets Sidebar List End -->

                        <!-- Fleets Sidebar List Start -->
                        <div class="fleets-sidebar-list">
                            <div class="fleets-list-title">
                                <h3>Car Brands</h3>
                            </div>

                            <ul>
                                @foreach($brands as $key => $value)
                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$value->id}}">
                                    <label class="form-check-label" for="checkbox7">{{$value->name}}</label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Fleets Sidebar List End -->

                    </div>                        
                </div>
                <!-- Fleets Sidebar End -->
            </div>
            
            <div class="col-lg-9">
                <!-- Fleets Collection Box Start -->
                <div class="fleets-collection-box">
                    <div class="row">
                        @foreach($cars as $key => $value)
                        <div class="col-lg-4 col-md-6">
                            <!-- Perfect Fleets Item Start -->
                            <div class="perfect-fleet-item fleets-collection-item wow fadeInUp">
                                <!-- Image Box Start -->
                                <div class="image-box">
                                    <img src="{{asset($value->image)}}" alt="">
                                </div>
                                <!-- Image Box End -->

                                <!-- Perfect Fleets Content Start -->
                                <div class="perfect-fleet-content">
                                    <!-- Perfect Fleets Title Start -->
                                    <div class="perfect-fleet-title">
                                        <h3>{{$value->car_type}}</h3>
                                        <h2>{{$value->brand_name}} {{$value->name}} {{$value->model}}</h2>
                                    </div>
                                    <!-- Perfect Fleets Content End -->

                                    <!-- Perfect Fleets Body Start -->
                                    <div class="perfect-fleet-body">
                                        <ul>
                                            <li><img src="{{asset('assets/images/icon-fleet-list-1.svg')}}" alt="">4 passenger</li>
                                            <li><img src="{{asset('assets/images/icon-fleet-list-2.svg')}}" alt="">4 door</li>
                                            <li><img src="{{asset('assets/images/icon-fleet-list-3.svg')}}" alt="">bags</li>
                                            <li><img src="{{asset('assets/images/icon-fleet-list-4.svg')}}" alt="">auto</li>
                                        </ul>
                                    </div>
                                    <!-- Perfect Fleets Body End -->

                                    <!-- Perfect Fleets Footer Start -->
                                    <div class="perfect-fleet-footer">
                                        <!-- Perfect Fleets Pricing Start -->
                                        <div class="perfect-fleet-pricing">
                                            <h2>AED 280<span>/day</span></h2>
                                        </div>
                                        <!-- Perfect Fleets Pricing End -->

                                        <!-- Perfect Fleets Btn Start -->
                                        <div class="perfect-fleet-btn">
                                            <a href="{{url('/car-details')}}" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                                        </div>
                                        <!-- Perfect Fleets Btn End -->
                                    </div>
                                    <!-- Perfect Fleets Footer End -->
                                </div>
                                <!-- Perfect Fleets Content End -->
                            </div>
                            <!-- Perfect Fleets Item End -->
                        </div>
                        @endforeach

                        
                        
                    </div>
                </div>
                <!-- Fleets Collection Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Fleets End -->
@endsection