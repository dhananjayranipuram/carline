@extends('layouts.site')

@section('content')

<!-- Page Header Start -->
<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Policies and agreement</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Policies and agreement</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="page-fleets-single">
        <div class="container">
            <div class="row">
                

                <div class="col-lg-12">
                    <!-- Feets Single Content Start -->
                    <div class="fleets-single-content">

                        <!-- Rental Conditions Faqs Start -->
                        <div class="rental-conditions-faqs">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">rental conditions</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Policies and agreement</h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Rental Conditions FAQ Accordion Start -->
                            <div class="rental-condition-accordion" id="rentalaccordion">
                                @foreach($policy as $key => $value)
                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp">
                                    <h2 class="accordion-header" id="rentalheading1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#rentalcollapse{{$key}}" aria-expanded="false" aria-controls="rentalcollapse{{$key}}">
                                            {{$value->name}}
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="rentalheading{{$key}}"
                                        data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>{!!html_entity_decode(nl2br(e($value->content)))!!}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->
                                @endforeach

                            </div>
                            <!-- Rental Conditions FAQ Accordion End -->
                        </div>
                        <!-- Rental Conditions Faqs End -->

                    </div>
                    <!-- Feets Single Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Feets Single End -->




@endsection