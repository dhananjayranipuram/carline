@extends('layouts.site')

@section('content')
<!-- Page Header Start -->
<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Our Cars</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cars</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
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
                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox1">
                                    <label class="form-check-label" for="checkbox1">Hatchback</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox2">
                                    <label class="form-check-label" for="checkbox2">Sedan</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox3">
                                    <label class="form-check-label" for="checkbox3">SUV</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox4">
                                    <label class="form-check-label" for="checkbox4">Crossover</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox5">
                                    <label class="form-check-label" for="checkbox5">luxury cars</label>
                                </li>
                                
                            </ul>
                        </div>
                        <!-- Fleets Sidebar List End -->

                        <!-- Fleets Sidebar List Start -->
                        <div class="fleets-sidebar-list">
                            <div class="fleets-list-title">
                                <h3>Car Brands</h3>
                            </div>

                            <ul>
                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox7">
                                    <label class="form-check-label" for="checkbox7">Mercedes</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox8">
                                    <label class="form-check-label" for="checkbox8">Nissan</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox9">
                                    <label class="form-check-label" for="checkbox9">Toyota</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                    <label class="form-check-label" for="checkbox10">MG</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                    <label class="form-check-label" for="checkbox10">Kia</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                    <label class="form-check-label" for="checkbox10">Hyundai</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                    <label class="form-check-label" for="checkbox10">Suzuki</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                    <label class="form-check-label" for="checkbox10">Lamborghini</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                    <label class="form-check-label" for="checkbox10">Mazda</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                    <label class="form-check-label" for="checkbox10">Porsche</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                    <label class="form-check-label" for="checkbox10">Land Rover</label>
                                </li>

                                <li class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                    <label class="form-check-label" for="checkbox10">GMC</label>
                                </li>
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
                        <div class="col-lg-4 col-md-6">
                            <!-- Perfect Fleets Item Start -->
                            <div class="perfect-fleet-item fleets-collection-item wow fadeInUp">
                                <!-- Image Box Start -->
                                <div class="image-box">
                                    <img src="{{asset('assets/images/car/1.jpg')}}" alt="">
                                </div>
                                <!-- Image Box End -->

                                <!-- Perfect Fleets Content Start -->
                                <div class="perfect-fleet-content">
                                    <!-- Perfect Fleets Title Start -->
                                    <div class="perfect-fleet-title">
                                        <h3>Crossover</h3>
                                        <h2>Hyundai Creta 2024</h2>
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
                                            <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                                        </div>
                                        <!-- Perfect Fleets Btn End -->
                                    </div>
                                    <!-- Perfect Fleets Footer End -->
                                </div>
                                <!-- Perfect Fleets Content End -->
                            </div>
                            <!-- Perfect Fleets Item End -->
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <!-- Perfect Fleets Item Start -->
                            <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="0.2s">
                                <!-- Image Box Start -->
                                <div class="image-box">
                                    <img src="{{asset('assets/images/car/2.jpg')}}" alt="">
                                </div>
                                <!-- Image Box End -->

                                <!-- Perfect Fleets Content Start -->
                                <div class="perfect-fleet-content">
                                    <!-- Perfect Fleets Title Start -->
                                    <div class="perfect-fleet-title">
                                        <h3>Sedan</h3>
                                        <h2>Toyota Corolla 2024</h2>
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
                                            <h2>AED 300<span>/day</span></h2>
                                        </div>
                                        <!-- Perfect Fleets Pricing End -->

                                        <!-- Perfect Fleets Btn Start -->
                                        <div class="perfect-fleet-btn">
                                            <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                                        </div>
                                        <!-- Perfect Fleets Btn End -->
                                    </div>
                                    <!-- Perfect Fleets Footer End -->
                                </div>
                                <!-- Perfect Fleets Content End -->
                            </div>
                            <!-- Perfect Fleets Item End --> 
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <!-- Perfect Fleets Item Start -->
                            <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="0.4s">
                                <!-- Image Box Start -->
                                <div class="image-box">
                                    <img src="{{asset('assets/images/car/3.jpg')}}" alt="">
                                </div>
                                <!-- Image Box End -->

                                <!-- Perfect Fleets Content Start -->
                                <div class="perfect-fleet-content">
                                    <!-- Perfect Fleets Title Start -->
                                    <div class="perfect-fleet-title">
                                        <h3>Sedan</h3>
                                        <h2>Nissan Sunny 2024</h2>
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
                                            <h2>AED 250<span>/day</span></h2>
                                        </div>
                                        <!-- Perfect Fleets Pricing End -->

                                        <!-- Perfect Fleets Btn Start -->
                                        <div class="perfect-fleet-btn">
                                            <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                                        </div>
                                        <!-- Perfect Fleets Btn End -->
                                    </div>
                                    <!-- Perfect Fleets Footer End -->
                                </div>
                                <!-- Perfect Fleets Content End -->
                            </div>
                            <!-- Perfect Fleets Item End -->
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <!-- Perfect Fleets Item Start -->
                            <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="0.6s">
                                <!-- Image Box Start -->
                                <div class="image-box">
                                    <img src="{{asset('assets/images/car/4.jpg')}}" alt="">
                                </div>
                                <!-- Image Box End -->

                                <!-- Perfect Fleets Content Start -->
                                <div class="perfect-fleet-content">
                                    <!-- Perfect Fleets Title Start -->
                                    <div class="perfect-fleet-title">
                                        <h3>Hatchback</h3>
                                        <h2>Kia picanto 2024</h2>
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
                                            <h2>AED 220<span>/day</span></h2>
                                        </div>
                                        <!-- Perfect Fleets Pricing End -->

                                        <!-- Perfect Fleets Btn Start -->
                                        <div class="perfect-fleet-btn">
                                            <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                                        </div>
                                        <!-- Perfect Fleets Btn End -->
                                    </div>
                                    <!-- Perfect Fleets Footer End -->
                                </div>
                                <!-- Perfect Fleets Content End -->
                            </div>
                            <!-- Perfect Fleets Item End -->
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <!-- Perfect Fleets Item Start -->
                            <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="0.8s">
                                <!-- Image Box Start -->
                                <div class="image-box">
                                    <img src="{{asset('assets/images/car/5.jpg')}}" alt="">
                                </div>
                                <!-- Image Box End -->

                                <!-- Perfect Fleets Content Start -->
                                <div class="perfect-fleet-content">
                                    <!-- Perfect Fleets Title Start -->
                                    <div class="perfect-fleet-title">
                                        <h3>Crossover</h3>
                                        <h2>Kia Sportage 2024</h2>
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
                                            <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                                        </div>
                                        <!-- Perfect Fleets Btn End -->
                                    </div>
                                    <!-- Perfect Fleets Footer End -->
                                </div>
                                <!-- Perfect Fleets Content End -->
                            </div>
                            <!-- Perfect Fleets Item End -->
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <!-- Perfect Fleets Item Start -->
                            <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="1s">
                                <!-- Image Box Start -->
                                <div class="image-box">
                                    <img src="{{asset('assets/images/car/6.jpg')}}" alt="">
                                </div>
                                <!-- Image Box End -->

                                <!-- Perfect Fleets Content Start -->
                                <div class="perfect-fleet-content">
                                    <!-- Perfect Fleets Title Start -->
                                    <div class="perfect-fleet-title">
                                        <h3>Sedan</h3>
                                        <h2>Hyundai Accent 2024</h2>
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
                                            <h2>AED 320<span>/day</span></h2>
                                        </div>
                                        <!-- Perfect Fleets Pricing End -->

                                        <!-- Perfect Fleets Btn Start -->
                                        <div class="perfect-fleet-btn">
                                            <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                                        </div>
                                        <!-- Perfect Fleets Btn End -->
                                    </div>
                                    <!-- Perfect Fleets Footer End -->
                                </div>
                                <!-- Perfect Fleets Content End -->
                            </div>
                            <!-- Perfect Fleets Item End --> 
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <!-- Perfect Fleets Item Start -->
                            <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="1.2s">
                                <!-- Image Box Start -->
                                <div class="image-box">
                                    <img src="{{asset('assets/images/car/7.jpg')}}" alt="">
                                </div>
                                <!-- Image Box End -->

                                <!-- Perfect Fleets Content Start -->
                                <div class="perfect-fleet-content">
                                    <!-- Perfect Fleets Title Start -->
                                    <div class="perfect-fleet-title">
                                        <h3>Sedan</h3>
                                        <h2>Hyundai Elantra 2024</h2>
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
                                            <h2>AED 450<span>/day</span></h2>
                                        </div>
                                        <!-- Perfect Fleets Pricing End -->

                                        <!-- Perfect Fleets Btn Start -->
                                        <div class="perfect-fleet-btn">
                                            <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                                        </div>
                                        <!-- Perfect Fleets Btn End -->
                                    </div>
                                    <!-- Perfect Fleets Footer End -->
                                </div>
                                <!-- Perfect Fleets Content End -->
                            </div>
                            <!-- Perfect Fleets Item End -->
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <!-- Perfect Fleets Item Start -->
                            <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="1.4s">
                                <!-- Image Box Start -->
                                <div class="image-box">
                                    <img src="{{asset('assets/images/car/3.png')}}" alt="">
                                </div>
                                <!-- Image Box End -->

                                <!-- Perfect Fleets Content Start -->
                                <div class="perfect-fleet-content">
                                    <!-- Perfect Fleets Title Start -->
                                    <div class="perfect-fleet-title">
                                        <h3>luxury car</h3>
                                        <h2>Mercedes Benz S-Class</h2>
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
                                            <h2>AED 520<span>/day</span></h2>
                                        </div>
                                        <!-- Perfect Fleets Pricing End -->

                                        <!-- Perfect Fleets Btn Start -->
                                        <div class="perfect-fleet-btn">
                                            <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                                        </div>
                                        <!-- Perfect Fleets Btn End -->
                                    </div>
                                    <!-- Perfect Fleets Footer End -->
                                </div>
                                <!-- Perfect Fleets Content End -->
                            </div>
                            <!-- Perfect Fleets Item End -->
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <!-- Perfect Fleets Item Start -->
                            <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="1.4s">
                                <!-- Image Box Start -->
                                <div class="image-box">
                                    <img src="{{asset('assets/images/car/4.png')}}" alt="">
                                </div>
                                <!-- Image Box End -->

                                <!-- Perfect Fleets Content Start -->
                                <div class="perfect-fleet-content">
                                    <!-- Perfect Fleets Title Start -->
                                    <div class="perfect-fleet-title">
                                        <h3>luxury car</h3>
                                        <h2>GMC Yukon</h2>
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
                                            <h2>AED 750<span>/day</span></h2>
                                        </div>
                                        <!-- Perfect Fleets Pricing End -->

                                        <!-- Perfect Fleets Btn Start -->
                                        <div class="perfect-fleet-btn">
                                            <a href="#" class="section-icon-btn"><img src="{{asset('assets/images/arrow-white.svg')}}" alt=""></a>
                                        </div>
                                        <!-- Perfect Fleets Btn End -->
                                    </div>
                                    <!-- Perfect Fleets Footer End -->
                                </div>
                                <!-- Perfect Fleets Content End -->
                            </div>
                            <!-- Perfect Fleets Item End -->
                        </div>
                        
                    </div>
                </div>
                <!-- Fleets Collection Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Fleets End -->
@endsection