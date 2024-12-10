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
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/css/lightbox.min.css" rel="stylesheet">
<div class="page-inner">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">User Details
                            </div>
                                <div class="card-tools">
                                    <a href="{{url('/admin/users')}}" class="btn btn-primary">
                                        <i class="icon-action-undo"></i>
                                        Back
                                    </a>
                                    <a href="{{url('/admin/edit-users')}}?id={{base64_encode($user[0]->id)}}" class="btn btn-primary">
                                        <i class="far fa-edit"></i>
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <p>
                                        <strong>First Name</strong><br>
                                        <span>{{$user[0]->first_name}}</span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <strong>Last Name</strong><br>
                                        <span>{{$user[0]->last_name}}</span>
                                    </p>
                                </div>

                                <div class="col-md-4">
                                    <p>
                                        <strong>Email</strong><br>
                                        <span>{{$user[0]->email}}</span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <strong>Phone</strong><br>
                                        <span>{{$user[0]->phone}}</span>
                                    </p>
                                </div>

                                <div class="col-md-4">
                                    <p>
                                        <strong>Flat</strong><br>
                                        <span>{{$user[0]->flat}}</span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <strong>Building</strong><br>
                                        <span>{{$user[0]->building}}</span>
                                    </p>
                                </div>

                                <div class="col-md-4">
                                    <p>
                                        <strong>Landmark</strong><br>
                                        <span>{{$user[0]->landmark}}</span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <strong>City/Emirates</strong><br>
                                        <span>{{$user[0]->city}}</span>
                                    </p>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <strong>Country</strong><br>
                                        <span>{{$user[0]->country_name}}</span>
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
                        @if(!empty($user[0]->pass_front))
                            <div class="col-2">
                                <strong>Passport Front</strong><br>
                                <label class="imagecheck mb-2 image-outer">
                                    <figure class="imagecheck-figure">
                                        <a href="{{ asset($user[0]->pass_front) }}" data-lightbox="user-documents" data-title="Passport Front">
                                            <img src="{{ asset($user[0]->pass_front) }}" alt="No document found" class="imagecheck-image">
                                        </a>
                                        <a class="delete-icon delete-doc" data-type="pass_front" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                    </figure>
                                </label>
                            </div>
                        @endif

                        @if(!empty($user[0]->pass_back))
                            <div class="col-2">
                                <strong>Passport Back</strong><br>
                                <label class="imagecheck mb-2 image-outer">
                                    <figure class="imagecheck-figure">
                                        <a href="{{ asset($user[0]->pass_back) }}" data-lightbox="user-documents" data-title="Passport Back">
                                            <img src="{{ asset($user[0]->pass_back) }}" alt="No document found" class="imagecheck-image">
                                        </a>
                                        <a class="delete-icon delete-doc" data-type="pass_back" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                    </figure>
                                </label>
                            </div>
                        @endif

                        @if(!empty($user[0]->dl_front))
                            <div class="col-2">
                                <strong>Driving License Front</strong><br>
                                <label class="imagecheck mb-2 image-outer">
                                    <figure class="imagecheck-figure">
                                        <a href="{{ asset($user[0]->dl_front) }}" data-lightbox="user-documents" data-title="Driving License Front">
                                            <img src="{{ asset($user[0]->dl_front) }}" alt="No document found" class="imagecheck-image">
                                        </a>
                                        <a class="delete-icon delete-doc" data-type="dl_front" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                    </figure>
                                </label>
                            </div>
                        @endif

                        @if(!empty($user[0]->dl_back))
                            <div class="col-2">
                                <strong>Driving License Back</strong><br>
                                <label class="imagecheck mb-2 image-outer">
                                    <figure class="imagecheck-figure">
                                        <a href="{{ asset($user[0]->dl_back) }}" data-lightbox="user-documents" data-title="Driving License Back">
                                            <img src="{{ asset($user[0]->dl_back) }}" alt="No document found" class="imagecheck-image">
                                        </a>
                                        <a class="delete-icon delete-doc" data-type="dl_back" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                    </figure>
                                </label>
                            </div>
                        @endif

                        @if(!empty($user[0]->eid_front))
                            <div class="col-2">
                                <strong>EID Front</strong><br>
                                <label class="imagecheck mb-2 image-outer">
                                    <figure class="imagecheck-figure">
                                        <a href="{{ asset($user[0]->eid_front) }}" data-lightbox="user-documents" data-title="EID Front">
                                            <img src="{{ asset($user[0]->eid_front) }}" alt="No document found" class="imagecheck-image">
                                        </a>
                                        <a class="delete-icon delete-doc" data-type="eid_front" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                    </figure>
                                </label>
                            </div>
                        @endif

                        @if(!empty($user[0]->eid_back))
                            <div class="col-2">
                                <strong>EID Back</strong><br>
                                <label class="imagecheck mb-2 image-outer">
                                    <figure class="imagecheck-figure">
                                        <a href="{{ asset($user[0]->eid_back) }}" data-lightbox="user-documents" data-title="EID Back">
                                            <img src="{{ asset($user[0]->eid_back) }}" alt="No document found" class="imagecheck-image">
                                        </a>
                                        <a class="delete-icon delete-doc" data-type="eid_back" data-id="{{ $user[0]->id }}"><i class="far fa-trash-alt"></i></a>
                                    </figure>
                                </label>
                            </div>
                        @endif
                    </div><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>
<script>
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
</script>
@endsection
