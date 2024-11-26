@extends('layouts.admin')

@section('content')
<style>
.delete-icon {
    position: absolute;
    top: 15px;
    right: 40px;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.imagecheck-figure:hover .delete-icon {
    opacity: 1;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form method="post" action="{{ url('/admin/edit-car') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <div class="card-title">Edit a Car</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($errors->any())
                            <div class="col-12 error-messages">
                                <div class="alert alert-danger">
                                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                                </div>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <input type="hidden" name="carId" value="{{ $cars[0]->id }}">
                                <input type="text" class="form-control" name="name" placeholder="Enter Car Name" value="{{ $cars[0]->name }}"/>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="brand">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" @selected($cars[0]->brand_id == $brand->id)>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="model">
                                    <option value="">Select Model</option>
                                    @for ($i = date('Y'); $i >= 1990; $i--)
                                        <option value="{{ $i }}" @selected($cars[0]->model == $i)>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('model')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="cartype">
                                    <option value="">Select Car Type</option>
                                    @foreach($type as $carType)
                                        <option value="{{ $carType->id }}" @selected($cars[0]->type_id == $carType->id)>{{ $carType->name }}</option>
                                    @endforeach
                                </select>
                                @error('cartype')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Available Features</label><br>
                                <div class="selectgroup selectgroup-pills">
                                    @foreach($features as $feature)
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="features[]" value="{{ $feature->id }}" class="selectgroup-input" @if(in_array($feature->id, $carFeatures)) checked @endif />
                                            <span class="selectgroup-button">{{ $feature->feature }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Images</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            @php $imgArr = explode(',', $cars[0]->image); @endphp
                                            @foreach($imgArr as $img)
                                                <label class="imagecheck mb-4 image-outer" style="width:25%;">
                                                    <figure class="imagecheck-figure">
                                                        <img src="{{ asset($img) }}" alt="Car Image" class="imagecheck-image">
                                                        <a class="delete-icon delete-car-image" data-id="{{$img}}" data-car-id="{{ $cars[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                                    </figure>
                                                </label>
                                            @endforeach
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <input type="file" name="carImages[]" id="carImages" multiple accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Rent per day in AED</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" name="rent" placeholder="Enter Rent Amount" class="form-control" value="{{ $cars[0]->rent }}">
                                        @error('rent')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="form-check-input offer-flag" type="checkbox" name="offerFlag" id="offerFlag" @if($cars[0]->offer_flag == 1) checked @endif>
                                        <label class="form-check-label">Avail special offers</label>
                                    </div>
                                    <div class="col-12 col-md-12 special-offer" style="display: @if($cars[0]->offer_flag == 1) block; @else none; @endif;">
                                        <div class="form-group">
                                            <input type="text" name="specialOffer" placeholder="Enter Offer Price" class="form-control" value="{{ $cars[0]->offer_price }}">
                                            @error('specialOffer')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Deposit in AED</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" name="deposit" placeholder="Enter Deposit Amount" class="form-control" value="{{ $cars[0]->deposit }}">
                                        @error('deposit')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Quantity</h4>
                                </div>
                                <div class="card-body">
                                    <input type="text" name="qty" placeholder="Enter Quantity" class="form-control" value="{{ $cars[0]->qty }}">
                                    @error('qty') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Kilometers Driven</h4>
                                </div>
                                <div class="card-body">
                                    <input type="text" name="kmeter" placeholder="Enter Kilometer" class="form-control" value="{{ $cars[0]->kmeter }}">
                                    @error('kmeter') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Specifications</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd" id="v-pills-tab-without-border" role="tablist" aria-orientation="vertical">
                                                @foreach($carSpecification as $key => $spec)
                                                    <a class="nav-link @if($key == 0) active @endif" id="v-pills-{{$spec->id}}-tab" data-bs-toggle="pill" href="#v-pills-{{$spec->id}}" role="tab" aria-controls="v-pills-{{$spec->id}}" aria-selected="@if($key == 0) true @else false @endif">{{ $spec->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="tab-content" id="v-pills-without-border-tabContent">
                                                @foreach($carSpecification as $key => $spec)
                                                    @php $options = explode('~', $spec->options); @endphp
                                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="v-pills-{{$spec->id}}" role="tabpanel" aria-labelledby="v-pills-{{$spec->id}}-tab">
                                                        <select class="form-control" name="specifications[]">
                                                            <option disabled selected>Select {{ $spec->name }}</option>
                                                            @foreach($options as $option)
                                                                <option value="{{ $spec->id }}~{{ $option }}" @if($option == $spec->details) selected @endif>{{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Others</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="checkbox" name="general_info" @if($cars[0]->general_info_flag == 1) checked @endif> Include general information
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="rental_condition" @if($cars[0]->rental_condition_flag == 1) checked @endif> Include rental conditions
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <a href="{{ url('/admin/cars') }}" class="btn btn-danger">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const offerFlag = document.getElementById('offerFlag');
        const specialOffer = document.querySelector('.special-offer');

        function toggleSpecialOffer() {
            specialOffer.style.display = offerFlag.checked ? 'block' : 'none';
        }

        offerFlag.addEventListener('change', toggleSpecialOffer);
        toggleSpecialOffer();
    });

    $(".delete-car-image").click(function () {
        
        var image = $(this).attr("data-id");
        var carId = $(this).attr("data-car-id");
        var obj = $(this);
            $.ajax({
                url: baseUrl + '/admin/delete-car-image',
                type: 'post',
                data: {
                    'carId' : carId,
                    'image' : image,
                },
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res) {
                    if(res){
                        obj.closest('.image-outer').hide();
                    }
                }
            });
        
    });
</script>  

@endsection
