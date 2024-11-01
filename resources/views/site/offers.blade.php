@extends('layouts.site')

@section('content')
<!-- Page Header Start -->
<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Special Offers</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Special Offers</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


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
                                    <!-- Image Box Start -->
                                    <div class="image-box">
                                        <a href="{{url('/car-details')}}?id={{base64_encode($value->id)}}">
                                        @if($value->image!='')
                                            @php $imgArr = explode(',',$value->image); @endphp
                                            @if(!empty($imgArr))
                                                <img src="{{asset($imgArr[0])}}" alt="Image not available">
                                            @endif
                                        @else
                                            <img src="" alt="Image not available">
                                        @endif</a>
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
@endsection