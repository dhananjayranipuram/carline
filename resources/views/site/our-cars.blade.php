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
     /* Style for the select dropdown */
.fleets-sort select {
    padding: 8px 12px;
    font-size: 16px;
    color: #6c757d; /* Default placeholder color */
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    margin-bottom: 20px !important;
}

/* Style for the filter button */
.filter-toggle-btn i {
    font-size: 18px;
}

/* Style for icons inside the dropdown */
.fleets-sort i {
    margin-right: 8px;
    font-size: 18px;
}

/* Mobile-specific styles */
@media only screen and (max-width: 600px) {
    .fleets-sort {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between;
        align-items: center !important;
    }

    /* Style for the select dropdown on mobile */
    .fleets-sort select {
        color: #ffffff;
        background: #000000;
        text-align: center;
        flex-grow: 1; /* Allow the select to take the remaining space */
        margin-bottom: 8px !important;
    }

    /* Style for the filter button */
    .filter-toggle-btn {
        margin-left: 10px; /* Add space between the dropdown and button */
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

                    <div class="fleets-sort d-flex flex-column flex-sm-row align-items-center">
                        <!-- Sort Dropdown -->
                        <select class="form-control mb-2 mb-sm-0" id="sortOptions">
                            <option value="default" selected disabled>⬇️ Sort By </option>
                            <option value="asc"> Price: Low to High</option>
                            <option value="desc"> Price: High to Low</option>
                        </select>
                        
                        <!-- Filter Button -->
                        <button class="form-control mb-2 mb-sm-0 d-lg-none filter-toggle-btn" type="button" style="background: #000080;color: #ffffff;padding: 8px 12px;">
                            <i class="fa-solid fa-filter me-2"></i>Filters
                        </button>
                    </div>

                    <div class="filter-section">
                        <div class="collapse d-lg-block" id="filterOptions">
                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>Car Type</h3>
                                </div>

                                <ul>
                                    @foreach($carType as $key => $value)
                                    <li class="form-check filterLi" search-value="{{$value->name}}">
                                        <input class="form-check-input car-type" type="checkbox" value="{{$value->id}}">
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
                                    <li class="form-check filterLi" search-value="{{$value->name}}">
                                        <input class="form-check-input car-brand" type="checkbox" value="{{$value->id}}">
                                        <label class="form-check-label" for="checkbox7">{{$value->name}}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->
                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>Transmission</h3>
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
                                <ul class="transmission-id" data-value="{{$transId}}">
                                    @foreach($transArr as $key1 => $value1)
                                        <li class="form-check filterLi" search-value="{{$value1}}">
                                            <input class="form-check-input car-transmision" type="checkbox" value="{{$value1}}">
                                            <label class="form-check-label" for="checkbox7">{{$value1}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->
                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>Seat</h3>
                                </div>
                                <ul class="seat-id" data-value="{{$seatId}}">
                                    @foreach($passArr as $key2 => $value2)
                                        <li class="form-check filterLi" search-value="{{$value2}}">
                                            <input class="form-check-input car-seats" type="checkbox" value="{{$value2}}">
                                            <label class="form-check-label" for="checkbox7">{{$value2}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->
                        </div> 
                    </div>                        
                </div>
                <!-- Fleets Sidebar End -->
            </div>
            
            <div class="col-lg-9">
                <!-- Fleets Collection Box Start -->
                <div class="fleets-collection-box">
                    <div class="row" id="carList">
                        @foreach($cars as $key => $value)
                        <div class="col-lg-4 col-md-6">
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
$(document).ready(function () {
    var xhr = null;
    var carType = localStorage.getItem("searchType");
    var carBrand = localStorage.getItem("brandClick");
    localStorage.clear();

    if(carType!=null){
        $('.car-type').each(function() {
            if($(this).val() == carType){
                $(this).prop('checked', true);;
            }
            getCars();
        });
    }else if(carBrand!=null){
        $('.car-brand').each(function() {
            if($(this).val() == carBrand){
                $(this).prop('checked', true);;
            }
            getCars();
        });
    }

    $(".form-check-input").click(function () {
        getCars();
    });

    $("#sortOptions").change(function () {
        getCars();
    });

    function getCars(){
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
                'sortBy':$("#sortOptions").val(),
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
                                        +'<img src="'+baseUrl+'/'+image[0]+'" alt="Image not available">'
                                +'</div>'
                                +'<div class="perfect-fleet-content">'
                                    +'<div class="perfect-fleet-title">'
                                        +'<h3>'+item.car_type+'</h3>'
                                        +'<h2>'+item.brand_name+' '+item.name+' '+item.model+'</h2>'
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
                                            +'<h2>AED '+item.rent+'<span>/day</span></h2>'
                                        +'</div>'
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

    $("#search").on("keyup change paste", function() {
        getCars()
        // var searchKeyword = $(this).val().toLowerCase(); // Convert to lowercase for case-insensitive search
        // $(".filterLi").each(function() {
        //     $(this).removeClass('show')
        //     $(this).removeClass('hide')
        //     // $(this).addClass('active');
        // });
        // if(searchKeyword==''){
        //     return false;
        // }
        // $(".filterLi").each(function() {
        //     var searchValue = $(this).attr('search-value').toLowerCase(); // Convert to lowercase for comparison
        //     if (searchValue.includes(searchKeyword) && searchKeyword) {
        //         $(this).addClass('show').removeClass('hide');
        //     } else {
        //         $(this).removeClass('show').addClass('hide');
        //     }
        // });
    });

});
</script>
<script>
    // Custom toggle behavior for filter button
    const filterToggleBtn = document.querySelector('.filter-toggle-btn');
    const filterOptions = document.getElementById('filterOptions');

    filterToggleBtn.addEventListener('click', () => {
        filterOptions.classList.toggle('collapse');
    });
</script>
@endsection