@extends('layouts.admin')

@section('content')
<div class="page-inner">
    <section class="section">
        <form method="post" action="{{ url('/admin/edit-users') }}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Edit User Details
                                </div>
                                    <div class="card-tools">
                                        <a href="{{ url('/admin/view-user') }}?id={{base64_encode($user[0]->id)}}" class="btn btn-primary">
                                            <i class="icon-action-undo"></i>
                                            Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="col-md-4">
                                        <p>
                                            <strong>First Name</strong><br>
                                            <input type="hidden" class="form-control" name="userId" value="{{$user[0]->id}}">
                                            <input type="text" class="form-control" name="first_name" value="{{$user[0]->first_name}}">
                                            @error('first_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <strong>Last Name</strong><br>
                                            <input type="text" class="form-control" name="last_name" value="{{$user[0]->last_name}}">
                                            @error('last_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>
                                            <strong>Email</strong><br>
                                            <input type="text" class="form-control" name="email" value="{{$user[0]->email}}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <strong>Phone</strong><br>
                                            <input type="text" class="form-control" name="phone" value="{{$user[0]->phone}}">
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>
                                            <strong>Flat</strong><br>
                                            <input type="text" class="form-control" name="flat" value="{{$user[0]->flat}}">
                                            @error('flat')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <strong>Building</strong><br>
                                            <input type="text" class="form-control" name="building" value="{{$user[0]->building}}">
                                            @error('building')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>
                                            <strong>Landmark</strong><br>
                                            <input type="text" class="form-control" name="landmark" value="{{$user[0]->landmark}}">
                                            @error('landmark')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <strong>City/Emirates</strong><br>
                                            <input type="text" class="form-control" name="city" value="{{$user[0]->city}}">
                                            @error('city')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>
                                            <strong>Country</strong><br>
                                            <select class="form-control" name="country">
                                                <option value="">Select Country</option>
                                                @foreach($country as $value)
                                                    <option value="{{$value->id}}" @selected($user[0]->country == $value->id)>{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </p>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Documents</h5>

                        <!-- Vertical Form -->
                        <div class="row g-3">
                                <div class="col-2">
                                    <strong>Passport Front</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->pass_front) }}" alt="No document found" class="imagecheck-image">
                                        </figure>
                                    </label>
                                    <input type="file" accept="image/*" name="pass_front">
                                </div>

                            
                                <div class="col-2">
                                    <strong>Passport Back</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->pass_back) }}" alt="No document found" class="imagecheck-image">
                                        </figure>
                                    </label>
                                    <input type="file" accept="image/*" name="pass_back">
                                </div>
                            

                            
                                <div class="col-2">
                                    <strong>Driving License Front</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->dl_front) }}" alt="No document found" class="imagecheck-image">
                                        </figure>
                                    </label>
                                    <input type="file" accept="image/*" name="dl_front">
                                </div>
                            

                            
                                <div class="col-2">
                                    <strong>Driving License Back</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->dl_back) }}" alt="No document found" class="imagecheck-image">
                                        </figure>
                                    </label>
                                    <input type="file" accept="image/*" name="dl_back">
                                </div>
                            

                            
                                <div class="col-2">
                                    <strong>EID Front</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->eid_front) }}" alt="No document found" class="imagecheck-image">
                                        </figure>
                                    </label>
                                    <input type="file" accept="image/*" name="eid_front">
                                </div>
                            

                            
                                <div class="col-2">
                                    <strong>EID Back</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->eid_back) }}" alt="No document found" class="imagecheck-image">
                                        </figure>
                                    </label>
                                    <input type="file" accept="image/*" name="eid_back">
                                </div>
                            
                        </div><!-- Vertical Form -->
                        <div class="card-action">
                            <a href="{{ url('/admin/view-user') }}?id={{base64_encode($user[0]->id)}}" class="btn btn-danger">Back</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </section>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
@endsection
