@extends('layouts.site')

@section('content')
<style> .btn-default.btn-highlighted { background-color: #000000; color: #ffffff; } .btn-default.btn-highlighted:before { background-color: #b9b9b9; } /* Booking History Background */ .booking-history { background-color: #f5f5f5; /* Light grey background */ padding: 20px; border-radius: 8px; margin-bottom: 20px; } /* Car Image Styling */ .car-image img { width: 100%; height: auto; border-radius: 5px; margin-bottom: 15px; } /* Booking Details Styling */ /* Booking Details Styling */ .booking-details p { font-size: 14px; color: #333; margin: 4px 0; } .booking-details p span { display: block; margin-top: 2px; /* Optional: Adds a small gap between the label and the value */ } /* Buttons Styling */ .booking-actions { display: flex; flex-direction: column; gap: 10px; /* Spacing between buttons */ align-items: flex-end; margin-top: 20px; } /* Button Styling */ .btn { padding: 10px 20px; font-size: 14px; font-weight: 600; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease; width: 100px; /* Set a fixed width for consistency */ text-align: center; } /* Edit Button Styling */ .btn-edit { background-color: #4caf50; /* Green background */ color: #fff; } .btn-edit:hover { background-color: #45a049; /* Darker green on hover */ color: #FFEB3B; } /* View Button Styling */ .btn-view { background-color: #007bff; /* Blue background */ color: #fff; } .btn-view:hover { background-color: #0069d9; /* Darker blue on hover */ color: #FFEB3B; } /* Default single-column layout for larger screens */ .booking-details { display: block; } /* Two-column layout for smaller screens (mobile) */ @media (max-width: 576px) { .booking-details { display: grid; grid-template-columns: 1fr 1fr; /* Two equal columns */ gap: 10px; /* Space between columns */ } .booking-details p { margin: 4px 0; } } </style>
<!-- Page Team Single Start -->
<div class="page-team-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <!-- Team member Details Start -->
                <div class="team-member-details">
                    <!-- Team member Image Start -->
                    
                    <!-- Team member Image End -->

                    <!-- Team member Content Start -->
                    <div class="team-member-content">
                        <!-- Team member Title Start -->
                        <div class="team-member-title">
                            <h2 class="wow fadeInUp">{{$userAccount[0]->first_name}} {{$userAccount[0]->last_name}}</h2>
                        </div>
                        <!-- Team member Title End -->

                        <!-- Team member Body Start -->
                        <div class="team-member-body wow fadeInUp" data-wow-delay="0.5s">
                            <ul>
                                <li><span>Phone: </span>(+01) {{$userAccount[0]->phone}}</li>
                                <li><span>Email: </span>{{$userAccount[0]->email}}</li>
                                <li><span>Address: </span>{{$userAccount[0]->flat}}, {{$userAccount[0]->building}}, {{$userAccount[0]->landmark}}, {{$userAccount[0]->city}}, {{$userAccount[0]->emirates}}</li>
                            </ul>
                        </div>
                        <!-- Team member Body End -->

                        <div class="hero-content-body wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                            <a href="#" class="btn-default">Edit Details</a>   <a href="{{ url('/logout') }}" class="btn-default btn-highlighted">Log Out</a>
                        </div></br>

                        <!-- member Social List Start -->
                        <div class="">
                                <img src="{{asset('assets/images/logo.png')}}" alt="">
                        </div>
                        <!-- member Social List End -->
                    </div>
                    <!-- Team member Content End -->
                </div>
                <!-- Team member Details End -->
            </div>

            <div class="col-lg-7">
                <!-- Booking History Section Start -->
                <div class="booking-history">
                    <!-- Booking Item Start -->
                    <div class="booking-item">
                        <div class="row">
                            <!-- Car Image Column Start -->
                            <div class="col-md-4">
                                <p><strong>Kia picanto 2024</strong></p>
                                <div class="car-image">
                                    <img src="{{asset('assets/images/car/4.jpg')}}" alt="Car Image">
                                </div>
                            </div>
                            <!-- Car Image Column End -->
            
                            <!-- Pickup Details Column Start -->
                            <div class="col-md-3">
                                <div class="booking-details">
                                    <p><strong>Pickup Location:</strong> <span>Downtown Dubai</span></p>
                                    <p><strong>Pickup Date:</strong> <span>2023-12-10</span></p>
                                    <p><strong>Pickup Time:</strong> <span>10:00 AM</span></p>
                                </div>
                            </div>
                            <!-- Pickup Details Column End -->
            
                            <!-- Dropoff Details Column Start -->
                            <div class="col-md-3">
                                <div class="booking-details">
                                    <p><strong>Dropoff Location:</strong> <span>Dubai Airport</span></p>
                                    <p><strong>Dropoff Date:</strong> <span>2023-12-15</span></p>
                                    <p><strong>Dropoff Time:</strong> <span>6:00 PM</span></p>
                                </div>
                            </div>
                            <!-- Dropoff Details Column End -->
            
                            <!-- Buttons Column Start -->
                            <div class="col-md-2 text-right">
                                <div class="booking-actions">
                                    <button class="btn btn-edit">Edit</button>
                                    <button class="btn btn-view">View</button>
                                </div>
                            </div>
                            <!-- Buttons Column End -->
                        </div>
                    </div>
                    <!-- Booking Item End -->
                </div>
                <!-- Booking History Section End -->

                <div class="booking-history">
                    <!-- Booking Item Start -->
                    <div class="booking-item">
                        <div class="row">
                            <!-- Car Image Column Start -->
                            <div class="col-md-4">
                                <p><strong>Kia picanto 2024</strong></p>
                                <div class="car-image">
                                    <img src="{{asset('assets/images/car/4.jpg')}}" alt="Car Image">
                                </div>
                            </div>
                            <!-- Car Image Column End -->
            
                            <!-- Pickup Details Column Start -->
                            <div class="col-md-3">
                                <div class="booking-details">
                                    <p><strong>Pickup Location:</strong> <span>Downtown Dubai</span></p>
                                    <p><strong>Pickup Date:</strong> <span>2023-12-10</span></p>
                                    <p><strong>Pickup Time:</strong> <span>10:00 AM</span></p>
                                </div>
                            </div>
                            <!-- Pickup Details Column End -->
            
                            <!-- Dropoff Details Column Start -->
                            <div class="col-md-3">
                                <div class="booking-details">
                                    <p><strong>Dropoff Location:</strong> <span>Dubai Airport</span></p>
                                    <p><strong>Dropoff Date:</strong> <span>2023-12-15</span></p>
                                    <p><strong>Dropoff Time:</strong> <span>6:00 PM</span></p>
                                </div>
                            </div>
                            <!-- Dropoff Details Column End -->
            
                            <!-- Buttons Column Start -->
                            <div class="col-md-2 text-right">
                                <div class="booking-actions">
                                    <button class="btn btn-edit">Edit</button>
                                    <button class="btn btn-view">View</button>
                                </div>
                            </div>
                            <!-- Buttons Column End -->
                        </div>
                    </div>
                    <!-- Booking Item End -->
                </div>
                <!-- Booking History Section End -->

                <div class="booking-history">
                    <!-- Booking Item Start -->
                    <div class="booking-item">
                        <div class="row">
                            <!-- Car Image Column Start -->
                            <div class="col-md-4">
                                <p><strong>Kia picanto 2024</strong></p>
                                <div class="car-image">
                                    <img src="{{asset('assets/images/car/4.jpg')}}" alt="Car Image">
                                </div>
                            </div>
                            <!-- Car Image Column End -->
            
                            <!-- Pickup Details Column Start -->
                            <div class="col-md-3">
                                <div class="booking-details">
                                    <p><strong>Pickup Location:</strong> <span>Downtown Dubai</span></p>
                                    <p><strong>Pickup Date:</strong> <span>2023-12-10</span></p>
                                    <p><strong>Pickup Time:</strong> <span>10:00 AM</span></p>
                                </div>
                            </div>
                            <!-- Pickup Details Column End -->
            
                            <!-- Dropoff Details Column Start -->
                            <div class="col-md-3">
                                <div class="booking-details">
                                    <p><strong>Dropoff Location:</strong> <span>Dubai Airport</span></p>
                                    <p><strong>Dropoff Date:</strong> <span>2023-12-15</span></p>
                                    <p><strong>Dropoff Time:</strong> <span>6:00 PM</span></p>
                                </div>
                            </div>
                            <!-- Dropoff Details Column End -->
            
                            <!-- Buttons Column Start -->
                            <div class="col-md-2 text-right">
                                <div class="booking-actions">
                                    <button class="btn btn-edit">Edit</button>
                                    <button class="btn btn-view">View</button>
                                </div>
                            </div>
                            <!-- Buttons Column End -->
                        </div>
                    </div>
                    <!-- Booking Item End -->
                </div>
                <!-- Booking History Section End -->
            </div>
            
            


        </div>
    </div>
</div>
<!-- Page Team Single End -->

@endsection