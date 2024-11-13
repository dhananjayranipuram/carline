@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <form method="post" action="{{ url('/admin/add-car') }}" enctype="multipart/form-data">
                @csrf <!-- {{ csrf_field() }} -->
                <div class="card-header">
                    <div class="card-title">Add a Car</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($errors->any())
                            <div class="col-12 error-messages" style="color:red;">
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Enter Car Name" value="{{old('name')}}"/>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="brand">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $value)
                                        <option value="{{$value->id}}" @if(old('brand') == $value->id) selected @endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @error('brand') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="model">
                                    <option value="">Select Model</option>
                                    @for ($i = date('Y'); $i >= 1990; $i--)
                                        <option value="{{$i}}" @if(old('model') == $i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                                @error('model') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="cartype">
                                    <option value="">Select Car Type</option>
                                    @foreach($type as $value)
                                        <option value="{{$value->id}}" @if(old('cartype') == $value->id) selected @endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @error('cartype') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Available Features</label><br>
                                <div class="selectgroup selectgroup-pills">
                                    @foreach($features as $value)
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="features[]" value="{{$value->id}}" checked class="selectgroup-input" 
                                               @if(is_array(old('features')) && in_array($value->id, old('features'))) checked @endif />
                                        <span class="selectgroup-button">{{$value->feature}}</span>
                                    </label>
                                    @endforeach
                                </div>
                                @error('features') <span class="text-danger">{{ $message }}</span> @enderror
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
                                    <input type="file" name="carImages[]" multiple="multiple" accept="image/*">
                                    @error('carImages') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Rent per day in AED</h4>
                                </div>
                                <div class="card-body">
                                    <input type="text" name="rent" class="form-control" value="{{old('rent')}}">
                                    @error('rent') <span class="text-danger">{{ $message }}</span> @enderror

                                    <div class="form-group mt-2">
                                        <input class="form-check-input" type="checkbox" name="offerFlag" id="offerFlag"
                                               @if(old('offerFlag')) checked @endif>
                                        <label class="form-check-label" for="offerFlag">Avail special offers</label>
                                    </div>

                                    <div class="form-group special-offer" style="display: none;">
                                        <input type="text" name="specialOffer" placeholder="Enter Offer Price" class="form-control" value="{{old('specialOffer')}}">
                                        @error('specialOffer') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Deposit in AED</h4>
                                </div>
                                <div class="card-body">
                                    <input type="text" name="deposit" placeholder="Enter Deposit Amount" class="form-control" value="{{old('deposit')}}">
                                    @error('deposit') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Quantity</h4>
                                </div>
                                <div class="card-body">
                                    <input type="text" name="qty" placeholder="Enter Quantity" class="form-control" value="{{old('qty')}}">
                                    @error('qty') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Others</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="general_info" @if(old('general_info')) checked @endif> Include general information
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="rental_condition" @if(old('rental_condition')) checked @endif> Include rental conditions
                                    </div>
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
                                        <div class="col-5 col-md-4">
                                            <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                @foreach($specification as $key => $value)
                                                <a class="nav-link @if($key == 0) active @endif" id="v-pills-{{$value->id}}-tab" data-bs-toggle="pill" href="#v-pills-{{$value->id}}" role="tab">{{$value->name}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-8">
                                            <div class="tab-content">
                                                @foreach($specification as $key => $value)
                                                <div class="tab-pane fade @if($key == 0) show active @endif" id="v-pills-{{$value->id}}" role="tabpanel">
                                                    <select class="form-control" name="specifications[]">
                                                        <option disabled selected>Select {{$value->name}}</option>
                                                        @foreach(explode('~', $value->options) as $option)
                                                        <option value="{{$value->id}}~{{$option}}">{{$option}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ url('/admin/cars') }}'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to toggle the special offer input field -->
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
</script>

@endsection
