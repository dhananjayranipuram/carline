@extends('layouts.site')

@section('content')
<style>
.break-word{
    word-wrap: break-word;
}

.show {
  display: block;
}
.hide {
  display: none;
}
</style>
<style>
        .filter-bar {
            display: flex;
            gap: 10px;
            padding: 15px;
            background-color: #efefef;
            border: 1px solid #ddd;
            border-radius: 5px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
    
        .filter-group {
            flex: 1;
            min-width: 150px;
        }
    
        .filter-dropdown {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    
        .search-btn {
            background-color: #000080;
            color: #fff;
            border: none;
            padding: 5px 25px;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-btn:hover {
            background-color: #000000;
        }
    
        .page-fleets {
            padding: 30px 0;
        }
    
        @media (max-width: 768px) {
            .filter-group {
                min-width: 48%;
            }
            .form-control {
                width: 195px;
            }
            .page-fleets {
                padding: 5px 0;
            }
        }
    
        /* Sticky filter bar on scroll for desktops and laptops */
        @media (min-width: 769px) {
            .filter-bar {
                position: -webkit-sticky; /* For Safari */
                position: sticky;
                top: 0;
                z-index: 10;
                width: 100%;
            }
        }
        @media only screen and (max-width: 600px) {
            .filter-bar {
    background-color: #f6f7ff;
}
}
    </style>
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
            <!-- Filter Bar Start -->
            <div class="filter-bar">
                        
                        <div class="filter-group">
                            <select class="filter-dropdown carTypes" data-label="type">
                                <option value="">Car Type</option>
                                @foreach($carType as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-group">
                            <select class="filter-dropdown carBrands" data-label="brand">
                                <option value="">Car Brands</option>
                                @foreach($brands as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach($all_specs as $keyspec => $valuespec)
                            @if($valuespec->name=='Transmission')
                                @php $transArr = explode('~',$valuespec->options); @endphp
                                @php $transId = $valuespec->id; @endphp
                            @endif
                            @if($valuespec->name=='Passenger')
                                @php $passArr = explode('~',$valuespec->options); @endphp
                                @php $seatId = $valuespec->id; @endphp
                            @endif
                        @endforeach
                        <div class="filter-group">
                            <select class="filter-dropdown carFuel" data-label="fuel">
                                <option value="">Fuel Type</option>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Electric">Electric</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <select class="filter-dropdown carTransmission" data-value="{{$transId}}" data-label="transmission">
                                <option value="">Transmission</option>
                                @foreach($transArr as $key1 => $value1)
                                    <option value="{{$value1}}">{{$value1}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-group">
                            <select class="filter-dropdown carSeats" data-value="{{$seatId}}" data-label="seats">
                                <option value="">Seats</option>
                                @foreach($passArr as $key2 => $value2)
                                    <option value="{{$value2}}">{{$value2}} Seats</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-group">
                            <select class="filter-dropdown carSort" data-label="sort">
                                <option value="">Sort by Price</option>
                                <option value="low_to_high">Low to High</option>
                                <option value="high_to_low">High to Low</option>
                            </select>
                        </div>
                        <!-- Search Form End -->
                    </div>
                    <!-- Filter Bar End -->
            
            <div class="col-lg-12">
                <!-- Fleets Collection Box Start -->
                <div class="fleets-collection-box">
                    <div class="row" id="carList">
                        @foreach($cars as $key => $value)
                        <div class="col-lg-3 col-md-6">
                            <!-- Perfect Fleets Item Start -->
                            <div class="perfect-fleet-item fleets-collection-item wow fadeInUp">
                                <!-- Image Box Start -->
                                <div class="image-box">
                                    @if($value->image!='')
                                        @php $imgArr = explode(',',$value->image); @endphp
                                        @if(!empty($imgArr))
                                            <a href="{{url('/car-details')}}?id={{base64_encode($value->id)}}"><img src="{{asset($imgArr[0])}}" alt="Image not available"></a>
                                        @endif
                                    @else
                                        <img src="" alt="Image not available">
                                    @endif
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
                        @endforeach

                        
                        
                    </div>
                </div>
                <!-- Fleets Collection Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Fleets End -->
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script> 
<script>
var xhr = null;

$(document).ready(function () {
    var carType = localStorage.getItem("searchType");
    var carBrand = localStorage.getItem("brandClick");
    localStorage.clear();

    if(carType!=null){
        $('.car-type').each(function() {
            if($(this).val() == carType){
                $(this).prop('checked', true);;
            }
            var textContent = $('.custom-dropdown-btn').text().trim();
            if (textContent.includes("Low to High")) {
                var sortData = 'low_to_high';
            } else if (textContent.includes("High to Low")) {
                var sortData = 'high_to_low';
            }
            getCars(sortData);
        });
    }else if(carBrand!=null){
        $('.car-brand').each(function() {
            if($(this).val() == carBrand){
                $(this).prop('checked', true);;
            }
            var textContent = $('.custom-dropdown-btn').text().trim();
            if (textContent.includes("Low to High")) {
                var sortData = 'low_to_high';
            } else if (textContent.includes("High to Low")) {
                var sortData = 'high_to_low';
            }
            getCars(sortData);
        });
    }

    $(".form-check-input").click(function () {
        var textContent = $('.custom-dropdown-btn').text().trim();
        if (textContent.includes("Low to High")) {
            var sortData = 'low_to_high';
        } else if (textContent.includes("High to Low")) {
            var sortData = 'high_to_low';
        }
        getCars(sortData);
    });    

    $("#search").on("keyup change paste", function() {
        var textContent = $('.custom-dropdown-btn').text().trim();
        if (textContent.includes("Low to High")) {
            var sortData = 'low_to_high';
        } else if (textContent.includes("High to Low")) {
            var sortData = 'high_to_low';
        }
        getCars(sortData);
    });
    
    $(".filter-dropdown").change(function () {
        var sortData = $(".carSort").val();
        var dataLabel = $(this).data('label');
        getCarsNew(sortData);
        getFiltersNew(dataLabel);
    });

    $(".carTypes").on("click", function () {
        $(".filter-dropdown").not($(this)).each(function () {
            $(this).val('');
        });
    });
});

function getCars(sortData){
        
    var carType = [];
    var carBrand = [];
    var carTransmission = [];
    var carSeats = [];
    $('.car-type').each(function() {
        if($(this).prop('checked') == true){
            carType.push($(this).val());
        }
    });

    $('.car-brand').each(function() {
        if($(this).prop('checked') == true){
            carBrand.push($(this).val());
        }
    });
    $('.car-transmision').each(function() {
        if($(this).prop('checked') == true){
            carTransmission.push($(this).val());
        }
    });
    $('.car-seats').each(function() {
        if($(this).prop('checked') == true){
            carSeats.push($(this).val());
        }
    });
    if (xhr !== null) {
        xhr.abort();
    }
    xhr = $.ajax({
        url: baseUrl + '/site/filter-cars',
        type: 'post',
        dataType: "json",
        data: {
            'type' : carType,
            'brand':carBrand,
            'carTransmission':carTransmission,
            'carSeats':carSeats,
            'transId':$(".transmission-id").attr('data-value'),
            'seatId':$(".seat-id").attr('data-value'),
            'searchText':$("#search").val(),
            'sortBy':(sortData === 'low_to_high') ? 'asc' : (sortData === 'high_to_low') ? 'desc' : 'asc',
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            var html = '';
            res.carDet.forEach(function(item) {
                if(item.image!=null)
                    var image = item.image.split(',');
                else
                    var image = '';
                // console.log(window.btoa(item.id));
                html += '<div class="col-lg-4 col-md-6">'
                    +'<div class="perfect-fleet-item fleets-collection-item wow fadeInUp">'
                            +'<div class="image-box">'
                                    +'<a href="'+baseUrl+'/car-details?id='+window.btoa(item.id)+'"><img src="'+baseUrl+'/'+image[0]+'" alt="Image not available"></a>'
                            +'</div>'
                            +'<div class="perfect-fleet-content">'
                                +'<div class="perfect-fleet-title">'
                                    +'<h3>'+item.car_type+'</h3>'
                                    +'<a href="'+baseUrl+'/car-details?id='+window.btoa(item.id)+'"><h2>'+item.brand_name+' '+item.name+' '+item.model+'</h2></a>'
                                +'</div>'
                                +'<div class="perfect-fleet-body">'
                                    +'<ul>';
                                        if(res.specs[item.id] != null){
                                            res.specs[item.id].forEach(function(items,keys) {
                                                // console.log(items)
                                                if(keys<=3){
                                                    html+='<li class="break-word"><img src="'+baseUrl+'/'+items.image+'" alt="" width="21">';
                                                    if(items.name!="Transmission"){
                                                        if(items.details!='Yes'){
                                                            html+=items.details;
                                                        } 
                                                        html+=' '+items.name+'</li>';
                                                    }else{
                                                        if(items.details!='Yes'){
                                                            html+=items.details;
                                                        } 
                                                    }
                                                }
                                            });
                                        }
                                    html+='</ul>'
                                +'</div>'
                                +'<div class="perfect-fleet-footer">'
                                    +'<div class="perfect-fleet-pricing">'
                                        if(item.offer_flag == 1){
                                            html+= '<del><h6>AED '+item.rent+'<span>/day</span></h6></del>'
                                                +'<h2>AED '+item.offer_price+' <span>/day</span></h2>';
                                        }else{
                                            html+= '<h2>AED '+item.rent+'<span>/day</span></h2>';
                                        }
                                    html+='</div>'
                                    +'<div class="perfect-fleet-btn">'
                                        +"<a href='"+baseUrl+"/car-details?id="+window.btoa(item.id)+"' class='section-icon-btn'><img src='"+baseUrl+'/'+"assets/images/arrow-white.svg' alt=''></a>"
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                        +'</div>'
                    +'</div>';
            });
            $("#carList").html(html)
        }
    });
}

function getCarsNew(sortData){
        
    var carType = [];
    var carBrand = [];
    var carTransmission = [];
    var carSeats = [];
    
    $(".carTypes").val() && carType.push($(".carTypes").val());
    $(".carBrands").val() && carBrand.push($(".carBrands").val());
    $(".carTransmission").val() && carTransmission.push($(".carTransmission").val());
    $(".carSeats").val() && carSeats.push($(".carSeats").val());
    
    if (xhr !== null) {
        xhr.abort();
    }
    xhr = $.ajax({
        url: baseUrl + '/site/filter-cars',
        type: 'post',
        dataType: "json",
        data: {
            'type' : carType,
            'brand':carBrand,
            'carTransmission':carTransmission,
            'carSeats':carSeats,
            'transId':$(".carTransmission").attr('data-value'),
            'seatId':$(".carSeats").attr('data-value'),
            'searchText':$("#search").val(),
            'sortBy':(sortData === 'low_to_high') ? 'asc' : (sortData === 'high_to_low') ? 'desc' : 'asc',
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            var html = '';
            res.carDet.forEach(function(item) {
                if(item.image!=null)
                    var image = item.image.split(',');
                else
                    var image = '';
                // console.log(window.btoa(item.id));
                html += '<div class="col-lg-3 col-md-6">'
                    +'<div class="perfect-fleet-item fleets-collection-item wow fadeInUp">'
                            +'<div class="image-box">'
                                    +'<a href="'+baseUrl+'/car-details?id='+window.btoa(item.id)+'"><img src="'+baseUrl+'/'+image[0]+'" alt="Image not available"></a>'
                            +'</div>'
                            +'<div class="perfect-fleet-content">'
                                +'<div class="perfect-fleet-title">'
                                    +'<h3>'+item.car_type+'</h3>'
                                    +'<a href="'+baseUrl+'/car-details?id='+window.btoa(item.id)+'"><h2>'+item.brand_name+' '+item.name+' '+item.model+'</h2></a>'
                                +'</div>'
                                +'<div class="perfect-fleet-body">'
                                    +'<ul>';
                                        if(res.specs[item.id] != null){
                                            res.specs[item.id].forEach(function(items,keys) {
                                                // console.log(items)
                                                if(keys<=3){
                                                    html+='<li class="break-word"><img src="'+baseUrl+'/'+items.image+'" alt="" width="21">';
                                                    if(items.name!="Transmission"){
                                                        if(items.details!='Yes'){
                                                            html+=items.details;
                                                        } 
                                                        html+=' '+items.name+'</li>';
                                                    }else{
                                                        if(items.details!='Yes'){
                                                            html+=items.details;
                                                        } 
                                                    }
                                                }
                                            });
                                        }
                                    html+='</ul>'
                                +'</div>'
                                +'<div class="perfect-fleet-footer">'
                                    +'<div class="perfect-fleet-pricing">'
                                        if(item.offer_flag == 1){
                                            html+= '<del><h6>AED '+item.rent+'<span>/day</span></h6></del>'
                                                +'<h2>AED '+item.offer_price+' <span>/day</span></h2>';
                                        }else{
                                            html+= '<h2>AED '+item.rent+'<span>/day</span></h2>';
                                        }
                                    html+='</div>'
                                    +'<div class="perfect-fleet-btn">'
                                        +"<a href='"+baseUrl+"/car-details?id="+window.btoa(item.id)+"' class='section-icon-btn'><img src='"+baseUrl+'/'+"assets/images/arrow-white.svg' alt=''></a>"
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                        +'</div>'
                    +'</div>';
            });
            $("#carList").html(html)
        }
    });
}

function getFiltersNew(dataLabel){
        
        var carType = [];
        var carBrand = [];
        var carTransmission = [];
        var carSeats = [];
        var carFuel = [];
        
        $(".carTypes").val() && carType.push($(".carTypes").val());
        $(".carBrands").val() && carBrand.push($(".carBrands").val());
        $(".carTransmission").val() && carTransmission.push($(".carTransmission").val());
        $(".carSeats").val() && carSeats.push($(".carSeats").val());
        $(".carFuel").val() && carFuel.push($(".carFuel").val());

        $.ajax({
            url: baseUrl + '/site/get-filters',
            type: 'post',
            dataType: "json",
            data: {
                'type' : carType,
                'brand':carBrand,
                'carTransmission':carTransmission,
                'carSeats':carSeats,
                'carFuel':carFuel,
                'transId':$(".carTransmission").attr('data-value'),
                'seatId':$(".carSeats").attr('data-value'),
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                if(dataLabel == 'type'){
                    populateDropdownWithSelectedValue($(".carBrands"), "Car Brands", res.brand, "id", "name");
                    populateDropdownWithSelectedValue($(".carTransmission"), "Transmission", res.transmission, "details", "details");
                    populateDropdownWithSelectedValue($(".carSeats"), "Seats", res.seat, "details", "details");
                    populateDropdownWithSelectedValue($(".carFuel"), "Fuel Type", res.fuel, "fuel_type", "fuel_type");
                }else if(dataLabel == 'brand'){
                    populateDropdownWithSelectedValue($(".carTransmission"), "Transmission", res.transmission, "details", "details");
                    populateDropdownWithSelectedValue($(".carSeats"), "Seats", res.seat, "details", "details");
                    populateDropdownWithSelectedValue($(".carFuel"), "Fuel Type", res.fuel, "fuel_type", "fuel_type");
                }else if(dataLabel == 'fuel'){
                    populateDropdownWithSelectedValue($(".carTransmission"), "Transmission", res.transmission, "details", "details");
                    populateDropdownWithSelectedValue($(".carSeats"), "Seats", res.seat, "details", "details");
                }else if(dataLabel == 'transmission'){
                    populateDropdownWithSelectedValue($(".carSeats"), "Seats", res.seat, "details", "details");
                }
            }
        });
    }

function populateDropdownWithSelectedValue(dropdown, defaultOption, data, valueKey, textKey) {
    const selectedValue = dropdown.val();

    dropdown.empty(); 
    dropdown.append(`<option value="">${defaultOption}</option>`);

    data.forEach(function (item) {
        if (item[textKey]) {
            const isSelected = item[valueKey] == selectedValue ? 'selected' : '';
            dropdown.append(`<option value="${item[valueKey]}" ${isSelected}>${item[textKey]}</option>`);
        }
    });
}    
</script>
@endsection