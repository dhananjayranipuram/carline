@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add a Car</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email2" placeholder="Enter Car Name" />
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <select class="form-control" name="brand">
                                <option>Select Brand</option>
                                @foreach($brands as $key => $value)
                                    <option value="{{$value->id}}" @if(old('brand') == $value->id) selected @endif>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <select class="form-control" name="model">
                                <option>Select Model</option>
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
                                <option>Select Car Type</option>
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
                                    <input type="checkbox" name="value" value="{{$value->id}}" class="selectgroup-input" checked="" />
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
                                            <div class="tab-pane fade @if($key == 0) show active @endif" id="v-pills-{{$value->id}}-nobd" role="tabpanel" aria-labelledby="v-pills-{{$value->id}}-tab-nobd">
                                                <p>{{$value->id}}Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>                                                
                                            </div>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">About the Car</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" id="comment" rows="5" style="width=">
                                            </textarea>
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
        </div>
    </div>
</div>

@endsection