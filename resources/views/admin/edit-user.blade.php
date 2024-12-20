@extends('layouts.admin')

@section('content')
<style>
.delete-icon {
    position: absolute;
    top: 15px;
    right: 58px;
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

.view-icon {
    position: absolute;
    top: 15px;
    right: 110px;
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

.imagecheck-figure:hover .view-icon {
    opacity: 1;
}
.download-icon {
    position: absolute;
    top: 15px;
    right: 5px;
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

.imagecheck-figure:hover .download-icon {
    opacity: 1;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/css/lightbox.min.css" rel="stylesheet">

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
                                    
                                    <div class="col-md-4">
                                        <p>
                                            <strong>Driver Type</strong><br>
                                            <select class="form-control user_type" name="user_type">
                                                <option value="">Select Type</option>
                                                    <option value="R" @selected($user[0]->user_type == 'R')>Resident</option>
                                                    <option value="T" @selected($user[0]->user_type == 'T')>Tourist</option>
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
                @if($user[0]->user_type == 'R')              
                    @php $showEid = 'block'; @endphp
                @else
                    @php $showEid = 'none'; @endphp
                @endif
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Documents</h5>

                        <!-- Vertical Form -->
                        <div class="row g-3">
                                <div class="col-2 pass_section" >
                                    <strong>Passport Front</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->pass_front) }}" alt="No document found" class="imagecheck-image">
                                            @if(!empty($user[0]->pass_front))
                                            <a class="view-icon view-doc" href="{{ asset($user[0]->pass_front) }}" data-lightbox="user-documents" data-title="Passport Front"><i class="far fa-eye"></i></a>
                                            <a class="delete-icon delete-doc" data-type="pass_front" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                            <a class="download-icon" href="{{ url('/admin/download-document') }}?id={{base64_encode($user[0]->id)}}&doc=pf"><i class="fas fa-download"></i></a>
                                            @endif
                                        </figure>
                                    </label>
                                    <input type="file" accept="image/*" name="pass_front">
                                </div>

                            
                                <div class="col-2 pass_section">
                                    <strong>Visit/Tourist Visa</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->pass_back) }}" alt="No document found" class="imagecheck-image">
                                            @if(!empty($user[0]->pass_back))
                                            <a class="view-icon view-doc" href="{{ asset($user[0]->pass_back) }}" data-lightbox="user-documents" data-title="Passport Back"><i class="far fa-eye"></i></a>
                                            <a class="delete-icon delete-doc" data-type="pass_back" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                            <a class="download-icon" href="{{ url('/admin/download-document') }}?id={{base64_encode($user[0]->id)}}&doc=pb"><i class="fas fa-download"></i></a>
                                            @endif
                                        </figure>
                                    </label>
                                    <input type="file" accept="image/*" name="pass_back">
                                </div>
                            

                            
                                <div class="col-2 dl_section">
                                    <strong>Driving License Front</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->dl_front) }}" alt="No document found" class="imagecheck-image">
                                            @if(!empty($user[0]->dl_front))
                                            <a class="view-icon view-doc" href="{{ asset($user[0]->dl_front) }}" data-lightbox="user-documents" data-title="Driving License Front"><i class="far fa-eye"></i></a>
                                            <a class="delete-icon delete-doc" data-type="dl_front" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                            <a class="download-icon" href="{{ url('/admin/download-document') }}?id={{base64_encode($user[0]->id)}}&doc=df"><i class="fas fa-download"></i></a>
                                            @endif
                                        </figure>
                                    </label>
                                    <input type="file" accept="image/*" name="dl_front">
                                </div>
                            

                            
                                <div class="col-2 dl_section">
                                    <strong>Driving License Back</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->dl_back) }}" alt="No document found" class="imagecheck-image">
                                            @if(!empty($user[0]->dl_back))
                                            <a class="view-icon view-doc" href="{{ asset($user[0]->dl_back) }}" data-lightbox="user-documents" data-title="Driving License Back"><i class="far fa-eye"></i></a>
                                            <a class="delete-icon delete-doc" data-type="dl_back" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                            <a class="download-icon" href="{{ url('/admin/download-document') }}?id={{base64_encode($user[0]->id)}}&doc=db"><i class="fas fa-download"></i></a>
                                            @endif
                                        </figure>
                                    </label>
                                    <input type="file" accept="image/*" name="dl_back">
                                </div>
                            

                            
                                <div class="col-2 eid_section" style="display:{{$showEid}}">
                                    <strong>EID Front</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->eid_front) }}" alt="No document found" class="imagecheck-image">
                                            @if(!empty($user[0]->eid_front))
                                            <a class="view-icon view-doc" href="{{ asset($user[0]->eid_front) }}" data-lightbox="user-documents" data-title="EID Front"><i class="far fa-eye"></i></a>
                                            <a class="delete-icon delete-doc" data-type="eid_front" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                            <a class="download-icon" href="{{ url('/admin/download-document') }}?id={{base64_encode($user[0]->id)}}&doc=ef"><i class="fas fa-download"></i></a>
                                            @endif
                                        </figure>
                                    </label>
                                    <input type="file" accept="image/*" name="eid_front">
                                </div>
                            

                            
                                <div class="col-2 eid_section" style="display:{{$showEid}}">
                                    <strong>EID Back</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            <img src="{{ asset($user[0]->eid_back) }}" alt="No document found" class="imagecheck-image">
                                            @if(!empty($user[0]->eid_back))
                                            <a class="view-icon view-doc" href="{{ asset($user[0]->eid_back) }}" data-lightbox="user-documents" data-title="EID Back"><i class="far fa-eye"></i></a>
                                            <a class="delete-icon delete-doc" data-type="eid_back" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                            <a class="download-icon" href="{{ url('/admin/download-document') }}?id={{base64_encode($user[0]->id)}}&doc=eb"><i class="fas fa-download"></i></a>
                                            @endif
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
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>
<script>
$(document).ready(function () {
    var userType = '{{ $user[0]->user_type }}';
    if(userType=='R'){
        $(".eid_section").show();
        $(".dl_section").show();
        $(".pass_section").hide();
    }else{
        $(".eid_section").hide();
        $(".dl_section").show();
        $(".pass_section").show();
    }
});
$(".delete-doc").click(function () {
        
    var userId = $(this).attr("data-id");
    var docType = $(this).attr("data-type");
    $.ajax({
        url: baseUrl + '/admin/update-document-status',
        type: 'post',
        data: {
            'userId' : userId,
            'docType' : docType,
            'status' : 'delete',
        },
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            location.reload();
        }
    });
    
});

$(".user_type").change(function () {
    if($(this).val()=='R'){
        $(".eid_section").show();
        $(".dl_section").show();
        $(".pass_section").hide();
    }else{
        $(".eid_section").hide();
        $(".dl_section").show();
        $(".pass_section").show();
    }
});
</script>
@endsection
