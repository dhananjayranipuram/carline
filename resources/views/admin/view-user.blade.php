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

                                <div class="col-md-4">
                                    <p>
                                        <strong>Driver Type</strong><br>
                                        <span>
                                        @if($user[0]->user_type == 'R')
                                            
                                            Resident
                                        @else
                                            Tourist
                                        @endif    
                                        </span>
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
                        @php
                            // List of document fields with display names and correct doc values
                            $documentFields = [
                                'pf' => ['field' => 'pass_front', 'label' => 'Passport Front'],
                                'pb' => ['field' => 'pass_back', 'label' => 'Visit/Tourist Visa'],
                                'df' => ['field' => 'dl_front', 'label' => 'Driving License Front'],
                                'db' => ['field' => 'dl_back', 'label' => 'Driving License Back'],
                                'ef' => ['field' => 'eid_front', 'label' => 'EID Front'],
                                'eb' => ['field' => 'eid_back', 'label' => 'EID Back'],
                                'cf' => ['field' => 'cdl_front', 'label' => 'Country License Front'],
                                'cb' => ['field' => 'cdl_back', 'label' => 'Country License Back']
                            ];
                        @endphp

                        @foreach ($documentFields as $docKey => $docInfo)
                            @php
                                $field = $docInfo['field'];
                                $label = $docInfo['label'];
                            @endphp

                            @if (!empty($user[0]->$field) && 
                                (($field === 'cdl_front' || $field === 'cdl_back') ? $user[0]->user_type === 'T' : true) &&
                                (($field === 'eid_front' || $field === 'eid_back') ? $user[0]->user_type === 'R' : true))
                                
                                <div class="col-2">
                                    <strong>{{ $label }}</strong><br>
                                    <label class="imagecheck mb-2 image-outer">
                                        <figure class="imagecheck-figure">
                                            @php
                                                $fileData = $user[0]->base64_images[$field] ?? null; // Get Base64 data
                                                $isBase64 = preg_match('/^data:(.*?);base64,/', $fileData, $matches);
                                            @endphp

                                            @if ($isBase64) <!-- Encrypted Image (Base64) -->
                                                @php
                                                    $mimeType = $matches[1]; // Get MIME type from Base64
                                                    $fileType = explode('/', $mimeType)[0]; // Check file type (image, pdf)
                                                @endphp

                                                @if ($fileType === 'image')
                                                    <img src="{{ $fileData }}" alt="No document found" class="imagecheck-image">
                                                @elseif ($mimeType === 'application/pdf')
                                                    <embed src="{{ $fileData }}" type="application/pdf" width="100%" height="200px" alt="No document found">
                                                @endif

                                            @else <!-- Unencrypted Image (Direct File Path) -->
                                                @php
                                                    $filePath = asset($user[0]->$field); // Get file path for unencrypted file
                                                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                @endphp

                                                @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ $filePath }}" alt="No document found" class="imagecheck-image">
                                                @elseif (strtolower($fileExtension) === 'pdf')
                                                    <embed src="{{ $filePath }}" type="application/pdf" width="100%" height="200px" alt="No document found">
                                                @endif
                                            @endif
                                            
                                            <!-- Lightbox -->
                                            <a class="view-icon view-doc lightbox-trigger"
                                            href="#" 
                                            data-base64="{{ $fileData ?? $filePath }}" 
                                            data-mime-type="{{ $mimeType ?? 'image/jpeg' }}" 
                                            data-lightbox="user-documents" 
                                            data-title="{{ $label }}">
                                                <i class="far fa-eye"></i>
                                            </a>

                                            <!-- Delete & Download -->
                                            <a class="delete-icon delete-doc" data-type="{{ $docKey }}" data-id="{{ $user[0]->id }}">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                            <a class="download-icon" href="{{ url('/admin/download-document') }}?id={{ base64_encode($user[0]->id) }}&doc={{ $docKey }}">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </figure>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div><!-- Vertical Form -->
                    <br>
                    <div class="row g-3">
                        <div class="col-2">
                            <a class="btn btn-primary" href="{{ url('/admin/download-document') }}?id={{base64_encode($user[0]->id)}}&doc=all"><i class="fas fa-download"></i> Download All</a>
                        </div>
                    </div>
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

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".lightbox-trigger").forEach(link => {
        let base64Data = link.getAttribute("data-base64");
        let mimeType = link.getAttribute("data-mime-type");

        // If it's a Base64 image, convert it to Blob URL
        if (base64Data && mimeType) {
            fetch(base64Data)
                .then(res => res.blob())
                .then(blob => {
                    let blobUrl = URL.createObjectURL(blob);
                    link.setAttribute("href", blobUrl); // Set Blob URL for Lightbox
                })
                .catch(err => console.error("Error converting Base64 to Blob:", err));
        } else {
            // For regular file URLs (images and PDFs), just set the URL
            link.setAttribute("href", base64Data);
        }
    });
});
</script>
@endsection
