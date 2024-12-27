@extends('layouts.site')

@section('content')
<style> .btn-default.btn-highlighted { background-color: #000000; color: #ffffff; } .btn-default.btn-highlighted:before { background-color: #b9b9b9; } /* Booking History Background */ .booking-history { background-color: #f5f5f5; /* Light grey background */ padding: 20px; border-radius: 8px; margin-bottom: 20px; } /* Car Image Styling */ .car-image img { width: 100%; height: auto; border-radius: 5px; margin-bottom: 15px; } /* Booking Details Styling */ /* Booking Details Styling */ .booking-details p { font-size: 14px; color: #333; margin: 4px 0; } .booking-details p span { display: block; margin-top: 2px; /* Optional: Adds a small gap between the label and the value */ } /* Buttons Styling */ .booking-actions { display: flex; flex-direction: column; gap: 10px; /* Spacing between buttons */ align-items: flex-end; margin-top: 20px; } /* Button Styling */ .btn { padding: 10px 20px; font-size: 14px; font-weight: 600; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease; width: 100px; /* Set a fixed width for consistency */ text-align: center; } /* Edit Button Styling */ .btn-edit { background-color: #4caf50; /* Green background */ color: #fff; } .btn-edit:hover { background-color: #45a049; /* Darker green on hover */ color: #FFEB3B; } /* View Button Styling */ .btn-view { background-color: #007bff; /* Blue background */ color: #fff; } .btn-view:hover { background-color: #0069d9; /* Darker blue on hover */ color: #FFEB3B; } /* Default single-column layout for larger screens */ .booking-details { display: block; } /* Two-column layout for smaller screens (mobile) */ @media (max-width: 576px) { .booking-details { display: grid; grid-template-columns: 1fr 1fr; /* Two equal columns */ gap: 10px; /* Space between columns */ } .booking-details p { margin: 4px 0; } } </style>
<style>
    .responsive-button {
        display: block; /* Ensures full-width behavior */
        width: 100%; /* Full width of the container */
        max-width: 400px; /* Optional: Limit maximum width */
        margin: 10px auto; /* Center the button and add spacing */
        text-align: center; /* Center the text */
        padding: 15px; /* Add padding for better appearance */
        background-color: #007BFF; /* Example color */
        color: #fff; /* Text color */
        text-decoration: none; /* Remove underline */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer;
        transition: background-color 0.3s ease; /* Hover effect */
    }
    
    .responsive-button:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }
</style>
<!-- Booking Form Box Start -->
<div class="booking-form-box">
    <!-- Booking PopUp Form Start -->
    <div id="UserEditForm" class="white-popup-block mfp-hide booking-form">
        <div class="section-title">
            <h2>Edit User</h2>
        </div>                                
        <fieldset>
            <div class="row">
                <div class="booking-form-group col-md-6 mb-4">
                    <input type="text" id="firstNameEdit" class="booking-form-control" placeholder="First Name" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="booking-form-group col-md-6 mb-4">
                    <input type="text" id="lastNameEdit" class="booking-form-control" placeholder="Last Name" required>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="booking-form-group col-md-6 mb-4">
                    <input type="email" id ="emailEdit" class="booking-form-control" disabled placeholder="Enter Your Email" required>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="booking-form-group col-md-6 mb-4">
                    <input type="text" id="phoneEdit" class="booking-form-control" placeholder="Enter Your Mobile Number" required>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="booking-form-group col-md-6 mb-4">
                    <input type="text" id="flatEdit" class="booking-form-control" placeholder="Flat/Villa number" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="booking-form-group col-md-6 mb-4">
                    <input type="text" id="buildingEdit" class="booking-form-control" placeholder="Building name" required>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="booking-form-group col-md-6 mb-4">
                    <input type="text" id="landmarkEdit" class="booking-form-control" placeholder="Landmark" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="booking-form-group col-md-6 mb-4">
                    <input type="text" id="cityEdit" class="booking-form-control" placeholder="City" required>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="booking-form-group col-md-6 mb-4">
                    <select class="booking-form-control form-select" id="emiratesEdit" required>
                        <option value="" disabled selected>Emirates</option>
                        @foreach($emirates as $key => $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="booking-form-group col-md-6 mb-4">
                    <select class="booking-form-control form-select" id="countryEdit" required>
                        <option value="" disabled selected>Country</option>
                        @foreach($country as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-12 pb-2" id="errorMessages">

                    </div>
                </div>
                <div class="col-md-12 booking-form-group register-user">
                    <button type="button" onclick="updateUser()" class="btn-default">Update</button>
                    <div id="msgSubmitEdit" class="h3 hidden"></div>
                </div>
            </div>                                    
        </fieldset>
    </div>
    <!-- Registration PopUp Form End -->
</div>
<!-- Registration Form Box End -->

<!-- Booking Form Box Start -->
<div class="booking-form-box">
    <!-- Booking PopUp Form Start -->
    <div id="documentUpdateForm" class="white-popup-block mfp-hide booking-form">
        <div class="section-title">
            <h2>Document Update</h2>
        </div>                                
        <fieldset>
            <form id="edit_uploadDocs" enctype="multipart/form-data" method="POST">
                <div class="row">
                    <div class="booking-form-group col-md-12 mb-4" id="edit_passport-section">
                        <div class="row" id="passport-section">
                            <label for="returnLocationToggle">Passport</label>
                            <div class="booking-form-group col-md-6 mb-4">
                                <label>Front</label>
                                <input type="file" name="edit_pass_front" class="booking-form-control" placeholder="Front" accept="image/*" required>
                                <div class="help-block with-errors pass_front"></div>
                            </div>
                            <div class="booking-form-group col-md-6 mb-4">
                                <label>Back</label>
                                <input type="file" name ="edit_pass_back" class="booking-form-control" placeholder="Back" accept="image/*" required>
                                <div class="help-block with-errors pass_back"></div>
                            </div>
                        </div>
                    </div>

                    <div class="booking-form-group col-md-12 mb-4" id="edit_dl-section">
                        <div class="row" id="dl-section">
                            <label for="returnLocationToggle">Driving Licence</label>
                            <div class="booking-form-group col-md-6 mb-4">
                                <label>Front</label>
                                <input type="file" name="edit_dl_front" class="booking-form-control" placeholder="Front" accept="image/*" required>
                                <div class="help-block with-errors dl_front"></div>
                            </div>
                            <div class="booking-form-group col-md-6 mb-4">
                                <label>Back</label>
                                <input type="file" name="edit_dl_back" class="booking-form-control" placeholder="Back" accept="image/*" required>
                                <div class="help-block with-errors dl_back"></div>
                            </div>
                        </div>
                    </div>

                    <div class="booking-form-group col-md-12 mb-4" id="edit_eid-section">
                        <div class="row" >
                            <label for="returnLocationToggle">EID</label>
                            <div class="booking-form-group col-md-6 mb-4">
                                <label>Front</label>
                                <input type="file" name="edit_eid_front" class="booking-form-control" placeholder="Front" accept="image/*" required>
                                <div class="help-block with-errors eid_front"></div>
                            </div>
                            <div class="booking-form-group col-md-6 mb-4">
                                <label>Back</label>
                                <input type="file" name="edit_eid_back" class="booking-form-control" placeholder="Back" accept="image/*" required>
                                <div class="help-block with-errors eid_back"></div>
                            </div>
                        </div>
                    </div>

                    <div class="booking-form-group col-md-12 mb-4" id="edit_cdl-section">
                        <div class="row">
                            <label for="returnLocationToggle" id="dl_label">Country Licence</label>
                            <div class="booking-form-group col-md-6 mb-4" id="dlf">
                                <label>Front</label>
                                <input type="file" name="edit_cdl_front" class="booking-form-control" placeholder="Front" accept="image/*,application/pdf" required>
                                <div class="help-block with-errors cdl_front"></div>
                            </div>
                            <div class="booking-form-group col-md-6 mb-4" id="dlb">
                                <label>Back</label>
                                <input type="file" name="edit_cdl_back" class="booking-form-control" placeholder="Back" accept="image/*,application/pdf" required>
                                <div class="help-block with-errors cdl_back"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-12 pb-2" id="edit_docErrorMessages">

                        </div>
                    </div>
                    <div class="col-md-12 booking-form-group">
                        <button type="button" class="btn-default edit_upload_docs">Upload</button>
                        <div id="edit_msgSubmit" class="h3 hidden"></div>
                    </div>
                </div>   
            </form>                                 
        </fieldset>
    </div>
    <!-- Registration PopUp Form End -->
</div>
<!-- Registration Form Box End -->
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
                                <li><span>Phone: </span>{{$userAccount[0]->phone}}</li>
                                <li><span>Email: </span>{{$userAccount[0]->email}}</li>
                                <li><span>Address: </span>{{$userAccount[0]->flat}}, {{$userAccount[0]->building}}, {{$userAccount[0]->landmark}}, {{$userAccount[0]->city}}, {{$userAccount[0]->emirates}}</li>
                            </ul>
                            <a href="{{ url('/my-account') }}" class="responsive-button">Booking History</a>
                            <a href="{{ url('/my-documents') }}" class="responsive-button">My Documents</a>
                        </div>
                        <!-- Team member Body End -->

                        <div class="hero-content-body wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                            <a onclick="getUserData()" class="btn-default edit-user">Edit Details</a>   <a href="{{ url('/logout') }}" class="btn-default btn-highlighted">Log Out</a>
                        </div></br>
                        
                        <!-- member Social List Start -->
                        <!-- <div class="">
                                <img src="{{asset('assets/images/logo.png')}}" alt="">
                        </div> -->
                        <!-- member Social List End -->
                    </div>
                    <!-- Team member Content End -->
                </div>
                <!-- Team member Details End -->
            </div>

            <div class="col-lg-7">
                @if(empty($userDocument[0]->pass_front) && empty($userDocument[0]->pass_back) && empty($userDocument[0]->dl_front) && empty($userDocument[0]->dl_back) && empty($userDocument[0]->eid_front) && empty($userDocument[0]->eid_back))
                    <div class="booking-history">
                        <!-- Booking Item Start -->
                        <div class="booking-item">
                            <div class="row">
                                <h3>No Documents Found!</h3>
                                
                            </div>            
                        </div>
                        <!-- Booking Item End -->
                    </div>
                    <!-- Booking History Section End -->
                @endif
                @if((!empty($userDocument[0]->pass_front) || !empty($userDocument[0]->pass_back)) && $userDocument[0]->user_type =='T')
                    <!-- Booking History Section Start -->
                    <div class="booking-history">
                        <!-- Booking Item Start -->
                        <div class="booking-item">
                            <div class="row">
                                
                                <!-- Car Image Column Start -->
                                <div class="col-md-5">
                                    <p><strong>Passport Front Page</strong></p>
                                    <div class="car-image">
                                        @php
                                            $frontFile = asset($userDocument[0]->pass_front);
                                            $frontFileExtension = strtolower(pathinfo($frontFile, PATHINFO_EXTENSION));
                                        @endphp
                                        @if (in_array($frontFileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                            <img src="{{asset($userDocument[0]->pass_front)}}" alt="Passport Front">
                                        @elseif ($frontFileExtension === 'pdf')
                                            <iframe src="{{ $frontFile }}" style="width: 100%; height: 250px;" frameborder="0"></iframe>
                                        @endif
                                    </div>
                                </div>
                                <!-- Car Image Column End -->
                
                               <!-- Car Image Column Start -->
                                <div class="col-md-5">
                                <p><strong>Visit/Tourist Visa</strong></p>
                                <div class="car-image">
                                    @php
                                        $backFile = asset($userDocument[0]->pass_back);
                                        $backFileExtension = strtolower(pathinfo($backFile, PATHINFO_EXTENSION));
                                    @endphp
                                    @if (in_array($backFileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                        <img src="{{asset($userDocument[0]->pass_back)}}" alt="Visit/Tourist Visa">
                                    @elseif ($backFileExtension === 'pdf')
                                        <iframe src="{{ $backFile }}" style="width: 100%; height: 250px;" frameborder="0"></iframe>
                                    @endif
                                </div>
                            </div>
                            <!-- Car Image Column End -->
                
                                <!-- Buttons Column Start -->
                                <div class="col-md-2 text-right">
                                    <div class="booking-actions">
                                        <button class="btn btn-edit upload-doc" data-section="passport">Edit</button>
                                        <!-- <button class="btn btn-view">Delete</button> -->
                                    </div>
                                </div>
                                <!-- Buttons Column End -->
                            </div>
                        </div>
                        <!-- Booking Item End -->
                    </div>
                    <!-- Booking History Section End -->
                @endif

                @if(!empty($userDocument[0]->dl_front) || !empty($userDocument[0]->dl_back))
                     <!-- Booking History Section Start -->
                    <div class="booking-history">
                        <!-- Booking Item Start -->
                        <div class="booking-item">
                            <div class="row">
                                @if($userDocument[0]->user_type =='T')
                                <h3>INTERNATIONAL DRIVING LICENCE</h3>
                                @else
                                <h3>DRIVING LICENCE</h3>
                                @endif
                                <!-- Car Image Column Start -->
                                <div class="col-md-5">
                                    <p><strong>Front Page</strong></p>
                                    <div class="car-image">
                                        @php
                                            $frontFile = asset($userDocument[0]->dl_front);
                                            $frontFileExtension = strtolower(pathinfo($frontFile, PATHINFO_EXTENSION));
                                        @endphp
                                        @if (in_array($frontFileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                            <img src="{{asset($userDocument[0]->dl_front)}}" alt="Driving Licence Front">
                                        @elseif ($frontFileExtension === 'pdf')
                                            <iframe src="{{ $frontFile }}" style="width: 100%; height: 250px;" frameborder="0"></iframe>
                                        @endif
                                    </div>
                                </div>
                                <!-- Car Image Column End -->
                
                               <!-- Car Image Column Start -->
                               <div class="col-md-5">
                                <p><strong>Back Page</strong></p>
                                <div class="car-image">
                                    @php
                                        $backFile = asset($userDocument[0]->dl_back);
                                        $backFileExtension = strtolower(pathinfo($backFile, PATHINFO_EXTENSION));
                                    @endphp
                                    @if (in_array($backFileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                        <img src="{{asset($userDocument[0]->dl_back)}}" alt="Driving Licence Back">
                                    @elseif ($backFileExtension === 'pdf')
                                        <iframe src="{{ $backFile }}" style="width: 100%; height: 250px;" frameborder="0"></iframe>
                                    @endif
                                </div>
                            </div>
                            <!-- Car Image Column End -->
                
                                <!-- Buttons Column Start -->
                                <div class="col-md-2 text-right">
                                    <div class="booking-actions">
                                        <button class="btn btn-edit upload-doc" data-section="dl">Edit</button>
                                        <!-- <button class="btn btn-view">Delete</button> -->
                                    </div>
                                </div>
                                <!-- Buttons Column End -->
                            </div>
                        </div>
                        <!-- Booking Item End -->
                    </div>
                    <!-- Booking History Section End -->
                @endif

                @if((!empty($userDocument[0]->eid_front) || !empty($userDocument[0]->eid_back)) && $userDocument[0]->user_type =='R')
                    <!-- Booking History Section Start -->
                    <div class="booking-history">
                        <!-- Booking Item Start -->
                        <div class="booking-item">
                            <div class="row">
                                <h3>EID</h3>
                                <!-- Car Image Column Start -->
                                <div class="col-md-5">
                                    <p><strong>Front Page</strong></p>
                                    <div class="car-image">
                                        @php
                                            $frontFile = asset($userDocument[0]->eid_front);
                                            $frontFileExtension = strtolower(pathinfo($frontFile, PATHINFO_EXTENSION));
                                        @endphp
                                        @if (in_array($frontFileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                            <img src="{{asset($userDocument[0]->eid_front)}}" alt="EID Front">
                                        @elseif ($frontFileExtension === 'pdf')
                                            <iframe src="{{ $frontFile }}" style="width: 100%; height: 250px;" frameborder="0"></iframe>
                                        @endif
                                    </div>
                                </div>
                                <!-- Car Image Column End -->
                
                               <!-- Car Image Column Start -->
                               <div class="col-md-5">
                                <p><strong>Back Page</strong></p>
                                <div class="car-image">
                                    @php
                                        $backFile = asset($userDocument[0]->eid_back);
                                        $backFileExtension = strtolower(pathinfo($backFile, PATHINFO_EXTENSION));
                                    @endphp
                                    @if (in_array($backFileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                        <img src="{{asset($userDocument[0]->eid_back)}}" alt="EID Back">
                                    @elseif ($backFileExtension === 'pdf')
                                        <iframe src="{{ $backFile }}" style="width: 100%; height: 250px;" frameborder="0"></iframe>
                                    @endif
                                </div>
                            </div>
                            <!-- Car Image Column End -->
                
                                <!-- Buttons Column Start -->
                                <div class="col-md-2 text-right">
                                    <div class="booking-actions">
                                        <button class="btn btn-edit upload-doc" data-section="eid">Edit</button>
                                        <!-- <button class="btn btn-view">Delete</button> -->
                                    </div>
                                </div>
                                <!-- Buttons Column End -->
                            </div>
                        </div>
                        <!-- Booking Item End -->
                    </div>
                    <!-- Booking History Section End -->
                @endif

                @if((!empty($userDocument[0]->cdl_front) || !empty($userDocument[0]->cdl_back)) && $userDocument[0]->user_type =='T')
                    <!-- Booking History Section Start -->
                    <div class="booking-history">
                        <!-- Booking Item Start -->
                        <div class="booking-item">
                            <div class="row">
                                <h3>Country License</h3>
                                <!-- Car Image Column Start -->
                                <div class="col-md-5">
                                    <p><strong>Front Page</strong></p>
                                    <div class="car-image">
                                    @php
                                        $frontFile = asset($userDocument[0]->cdl_front);
                                        $frontFileExtension = strtolower(pathinfo($frontFile, PATHINFO_EXTENSION));
                                    @endphp
                                    @if (in_array($frontFileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                        <img src="{{asset($userDocument[0]->cdl_front)}}" alt="Country Lisence Front">
                                    @elseif ($frontFileExtension === 'pdf')
                                        <iframe src="{{ $frontFile }}" style="width: 100%; height: 250px;" frameborder="0"></iframe>
                                    @endif
                                    </div>
                                </div>
                                <!-- Car Image Column End -->
                
                               <!-- Car Image Column Start -->
                               <div class="col-md-5">
                                <p><strong>Back Page</strong></p>
                                <div class="car-image">
                                    @php
                                        $backFile = asset($userDocument[0]->cdl_back);
                                        $backFileExtension = strtolower(pathinfo($backFile, PATHINFO_EXTENSION));
                                    @endphp
                                    @if (in_array($backFileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                        <img src="{{asset($userDocument[0]->cdl_back)}}" alt="Country Lisence Front">
                                    @elseif ($backFileExtension === 'pdf')
                                        <iframe src="{{ $backFile }}" style="width: 100%; height: 250px;" frameborder="0"></iframe>
                                    @endif
                                </div>
                            </div>
                            <!-- Car Image Column End -->
                
                                <!-- Buttons Column Start -->
                                <div class="col-md-2 text-right">
                                    <div class="booking-actions">
                                        <button class="btn btn-edit upload-doc" data-section="cdl">Edit</button>
                                        <!-- <button class="btn btn-view">Delete</button> -->
                                    </div>
                                </div>
                                <!-- Buttons Column End -->
                            </div>
                        </div>
                        <!-- Booking Item End -->
                    </div>
                    <!-- Booking History Section End -->
                @endif
            </div>
            
            


        </div>
    </div>
</div>
<!-- Page Team Single End -->
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script> 
<script>
$(".upload-doc").click(function() {
    if($(this).attr('data-section')=='passport'){
        $("#edit_passport-section").show();
        $("#edit_dl-section").hide();
        $("#edit_eid-section").hide();
        $("#edit_cdl-section").hide();
    }else if($(this).attr('data-section')=='dl'){
        $("#edit_passport-section").hide();
        $("#edit_dl-section").show();
        $("#edit_eid-section").hide();
        $("#edit_cdl-section").hide();
    }else if($(this).attr('data-section')=='eid'){
        $("#edit_passport-section").hide();
        $("#edit_dl-section").hide();
        $("#edit_eid-section").show();
        $("#edit_cdl-section").hide();
    }else if($(this).attr('data-section')=='cdl'){
        $("#edit_cdl-section").show();
        $("#edit_passport-section").hide();
        $("#edit_dl-section").hide();
        $("#edit_eid-section").hide();
    }
    $.magnificPopup.open({
        items: {
            src: '#documentUpdateForm', 
            type: 'inline'
        }
    });
});

$(".edit_upload_docs").click(function(e) {
    e.preventDefault();
    let formData = new FormData($('#edit_uploadDocs')[0]);
    console.log(formData)
    $(".overlay").show();
    $.ajax({
        url: baseUrl + '/edit-upload-docs',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {
            $("#edit_docErrorMessages").html('<span style="color:green;">Documents uploaded successfully.<span>');
            setTimeout(function () {
                $("#edit_docErrorMessages").html('');
                $.magnificPopup.close();
                $('#edit_uploadDocs')[0].reset();
                location.reload();
            }, 5000);
            $(".overlay").hide();
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                Object.keys(errors).forEach(function(key) {
                    $("."+key+"").html('<span style="color:red;">'+errors[key][0]+'<span>');
                    setTimeout(function () {
                        $("."+key+"").html('');
                    }, 5000);
                });
            } else {
                $("#edit_docErrorMessages").html('<span style="color:red;">An error occurred during the upload.<span>');
                setTimeout(function () {
                    $("#edit_docErrorMessages").html('');
                }, 5000);
            }
            $(".overlay").hide();
        }
    });
});

function getUserData(){
    $(".overlay").show();
    $.ajax({
        url: baseUrl + '/my-account-details',
        type: 'post',
        data: {},
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {

            
            if(res){
                
                $.magnificPopup.open({
                    items: {
                        src: '#UserEditForm', 
                        type: 'inline'
                    }
                });
                $("#firstNameEdit").val(res[0].first_name);
                $("#lastNameEdit").val(res[0].last_name);
                $("#emailEdit").val(res[0].email);
                $("#phoneEdit").val(res[0].phone);
                $("#flatEdit").val(res[0].flat);
                $("#buildingEdit").val(res[0].building);
                $("#landmarkEdit").val(res[0].landmark);
                $("#cityEdit").val(res[0].city);
                $('#emiratesEdit option').each(function() {
                    if($(this).val()==res[0].emirateid){
                        $(this).attr('selected','selected');
                    }
                });
                $('#countryEdit option').each(function() {
                    if($(this).val()==res[0].country){
                        $(this).attr('selected','selected');
                    }
                });
            }
            $(".overlay").hide();
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: ", status, error);
        }
    });
}

function updateUser(){
    var datas = {
        'firstName': $("#firstNameEdit").val(),
        'lastName': $("#lastNameEdit").val(),
        // 'email': $("#email").val(),
        'phone': $("#phoneEdit").val(),
        'flat': $("#flatEdit").val(),
        'building': $("#buildingEdit").val(),
        'landmark': $("#landmarkEdit").val(),
        'city': $("#cityEdit").val(),
        'emirates': $("#emiratesEdit").val(),
        'country': $("#countryEdit").val(),
    };
    
    if(!validateForm(datas)){
        $(".overlay").show();
        $.ajax({
            url: baseUrl + '/update-user',
            type: 'post',
            data: datas,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {

                $('#errorMessages').append('<br><span style="color:green;">'+res.message+'</span>');
                setTimeout(function () {
                    $('#errorMessages').html('');
                }, 2500);

                if(res.status == 200){
                    $("#userId").val(res.userId);
                    $.magnificPopup.close();
                    checkDocumentUploaded();
                }
                $(".overlay").hide();
            }
        });
    }else{
        $('#errorMessages').append('<br><span style="color:red;">Please fill valid data.</span>');
        setTimeout(function () {
            $('#errorMessages').html('');
        }, 2500);
        $(".overlay").hide();
    }
}

function getUserDocData(){
    $(".overlay").show();
    $.ajax({
        url: baseUrl + '/my-document-details',
        type: 'post',
        data: {},
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {

            
            if(res){
                
                $.magnificPopup.open({
                    items: {
                        src: '#documentUpdateForm', 
                        type: 'inline'
                    }
                });
                // $("#firstNameEdit").val(res[0].first_name);
                // $("#lastNameEdit").val(res[0].last_name);
                // $("#emailEdit").val(res[0].email);
                // $("#phoneEdit").val(res[0].phone);
                // $("#flatEdit").val(res[0].flat);
                // $("#buildingEdit").val(res[0].building);
                // $("#landmarkEdit").val(res[0].landmark);
                // $("#cityEdit").val(res[0].city);
                
            }
            $(".overlay").hide();
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: ", status, error);
        }
    });
}

$(".rider_type").click(function() {
    if($(this).val()=='tourist'){
        $("#edit_eid-section").hide();
    }else{
        $("#edit_eid-section").show();
    }
});

function validateForm(datas){
    chk = 0;
    if(datas.firstName == ''){
        chk = 1;
        $('#firstNameEdit').css('border-color', 'red');
    }else{
        $('#firstNameEdit').css('border-color', '');
    }
    if(datas.lastName == ''){
        chk = 1;
        $('#lastNameEdit').css('border-color', 'red');
    }else{
        $('#lastNameEdit').css('border-color', '');
    }
    if(datas.email == ''){
        chk = 1;
        $('#emailEdit').css('border-color', 'red');
    }else{
        $('#emailEdit').css('border-color', '');
    }
    if(datas.phone == ''){
        chk = 1;
        $('#phoneEdit').css('border-color', 'red');
    }else{
        $('#phoneEdit').css('border-color', '');
    }
    if(datas.password == ''){
        chk = 1;
        $('#passwordEdit').css('border-color', 'red');
    }else{
        $('#passwordEdit').css('border-color', '');
    }
    if(datas.flat == ''){
        chk = 1;
        $('#flatEdit').css('border-color', 'red');
    }else{
        $('#flatEdit').css('border-color', '');
    }
    if(datas.building == ''){
        chk = 1;
        $('#buildingEdit').css('border-color', 'red');
    }else{
        $('#buildingEdit').css('border-color', '');
    }
    if(datas.landmark == ''){
        chk = 1;
        $('#landmarkEdit').css('border-color', 'red');
    }else{
        $('#landmarkEdit').css('border-color', '');
    }
    if(datas.city == ''){
        chk = 1;
        $('#cityEdit').css('border-color', 'red');
    }else{
        $('#cityEdit').css('border-color', '');
    }
    if(datas.emirates == ''){
        chk = 1;
        $('#emiratesEdit').css('border-color', 'red');
    }else{
        $('#emiratesEdit').css('border-color', '');
    }
    return chk;
}
</script>
@endsection