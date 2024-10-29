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
                                            <img src="{{asset($imgArr[0])}}" alt="Image not available">
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
                                        <h2>{{$value->brand_name}} {{$value->name}} {{$value->model}}</h2>
                                    </div>
                                    <!-- Perfect Fleets Content End -->

                                    <!-- Perfect Fleets Body Start -->
                                    <div class="perfect-fleet-body">
                                        <ul>
                                            @if(!empty($specs[$value->id]))
                                                @foreach($specs[$value->id] as $keys => $values)
                                                    <li class="break-word"><img src="{{asset($values->image)}}" alt="" width="21">
                                                    @if($values->name=='Transmission' || $values->details=='Manual')
                                                        MT
                                                    @elseif($values->name=='Transmission' || $values->details=='Automatic')
                                                        AT
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
                                            <h2>AED {{$value->rent}}<span>/day</span></h2>
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

    function getCars(){
        var carType = [];
        var carBrand = [];
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
        if (xhr !== null) {
            xhr.abort();
        }
        xhr = $.ajax({
            url: baseUrl + '/site/filter-cars',
            type: 'post',
            dataType: "json",
            data: {'type' : carType,'brand':carBrand},
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
                                                    if(keys<=3){
                                                        html+='<li class="break-word"><img src="'+baseUrl+'/'+items.image+'" alt="" width="21">';
                                                        if(items.details!='Yes'){
                                                            html+=items.details;
                                                        } 
                                                        html+=' '+items.name+'</li>';
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
        var searchKeyword = $(this).val().toLowerCase(); // Convert to lowercase for case-insensitive search
        $(".filterLi").each(function() {
            $(this).removeClass('show')
            $(this).removeClass('hide')
            // $(this).addClass('active');
        });
        if(searchKeyword==''){
            return false;
        }
        $(".filterLi").each(function() {
            var searchValue = $(this).attr('search-value').toLowerCase(); // Convert to lowercase for comparison
            if (searchValue.includes(searchKeyword) && searchKeyword) {
                $(this).addClass('show').removeClass('hide');
            } else {
                $(this).removeClass('show').addClass('hide');
            }
        });
    });

});
</script>
@endsection