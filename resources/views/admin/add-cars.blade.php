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
                                <input type="text" class="form-control" name="name" placeholder="Enter Car Name" />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="brand">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $key => $value)
                                        <option value="{{$value->id}}" @if(old('brand') == $value->id) selected @endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="model">
                                    <option value="">Select Model</option>
                                    {{ $now = date('Y') }}
                                    @for ($i = $now; $i >= 1990; $i--)
                                        <option value="{{$i}}" @if(old('model') == $i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="cartype">
                                    <option value="">Select Car Type</option>
                                    @foreach($type as $key => $value)
                                        <option value="{{$value->id}}" @if(old('cartype') == $value->id) selected @endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Available Features</label><br>
                                <div class="selectgroup selectgroup-pills">
                                    @foreach($features as $key => $value)
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="features[]" value="{{$value->id}}" class="selectgroup-input" checked="" />
                                        <span class="selectgroup-button">{{$value->feature}}</span>
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
                                            <div class="form-group">
                                                <input type="file" name="carImages[]" multiple="multiple" accept="image/*">
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
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="rent" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <input class="form-check-input offer-flag" type="checkbox" name="offerFlag" checked >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Avail special offers
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-12 special-offer">
                                            <div class="form-group">
                                                <input type="text" name="specialOffer" placeholder="Enter Offer Price" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Deposit in AED</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="deposit" placeholder="Enter Deposit Amount" class="form-control">
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
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <input type="checkbox" name="general_info"> Include general information
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <input type="checkbox" name="rental_condition"> Include rental conditions
                                            </div>
                                        </div>
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
                                            <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd" id="v-pills-tab-without-border" role="tablist" aria-orientation="vertical">
                                                @foreach($specification as $key => $value)
                                                <a class="nav-link @if($key == 0) active @endif" id="v-pills-{{$value->id}}-tab-nobd" data-bs-toggle="pill" href="#v-pills-{{$value->id}}-nobd" role="tab" aria-controls="v-pills-{{$value->id}}-nobd" aria-selected="true">{{$value->name}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-8">
                                            <div class="tab-content" id="v-pills-without-border-tabContent">
                                                @foreach($specification as $key => $value)
                                                @php $arr = explode('~',$value->options); @endphp
                                                <div class="tab-pane fade @if($key == 0) show active @endif" id="v-pills-{{$value->id}}-nobd" role="tabpanel" aria-labelledby="v-pills-{{$value->id}}-tab-nobd">
                                                    <select class="form-control" name="specifications[]">
                                                        <option disabled selected>Select {{$value->name}}</option>
                                                    @foreach($arr as $keys => $values)
                                                        <option value="{{$value->id}}~{{$values}}">{{$values}}</option>
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
                    <button class="btn btn-success">Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                </div>
                <div class="col-12" style="color:red;">
                    @if ($errors->any())
                    <label>{{ $errors->first('username') }}{{ $errors->first('error') }}</label>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@endsection