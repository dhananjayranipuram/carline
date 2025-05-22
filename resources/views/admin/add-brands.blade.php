@extends('layouts.admin')

@section('content')
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Add Brand</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addBrandModal" > <i class="fa fa-plus"></i> Add Brand </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Brand Name</th>
                                <th>Status</th>
                                <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $key => $value)
                                <tr id="row{{$value->id}}">
                                    <td>{{$value->id}}</td>
                                    <td><img src="{{asset($value->image)}}"></td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->status}}</td>
                                    <td>
                                        <div class="form-button-action">
                                        <button type="button" data-bs-toggle="tooltip" title="Edit Brand" class="btn btn-link btn-primary btn-lg edit-brand" data-original-title="Edit Task" data-id="{{$value->id}}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" data-bs-toggle="tooltip" title="Delete Brand" class="btn btn-link btn-danger delete-brand" data-original-title="Remove" data-id="{{$value->id}}">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addBrandModal" tabindex="-1"role="dialog" aria-hidden="true" >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold"> New</span>
                                    <span class="fw-light"> Brand </span>
                                </h5>
                                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form method="post" enctype="multipart/form-data" id="addBrand">
                                @csrf <!-- {{ csrf_field() }} -->
                                    <div class="modal-body">
                                        <p class="small">Create a new Brand using this form, make sure you fill them all</p>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Name</label>
                                                        <input type="text" name="brName" class="form-control" placeholder="Enter Brand Name"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <input type="file" name="brImage" />
                                                        <label>Select Brand image.</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <input type="checkbox" checked name="brActive" />&nbsp;<span>Active</span>
                                                    </div>
                                                </div>
                                        
                                            </div>
                                    </div>
                                
                                    <div class="modal-footer border-0">
                                        <div id="save-errors"></div>
                                        <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-danger close-modal" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="editBrandModal" tabindex="-1"role="dialog" aria-hidden="true" >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold"> Edit</span>
                                    <span class="fw-light"> Brand </span>
                                </h5>
                                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form method="post" enctype="multipart/form-data" id="editBrand">
                                    @csrf <!-- {{ csrf_field() }} -->
                                    <div class="modal-body">
                                        <p class="small">Edit the Brand using this form, make sure you fill them all</p>
                                        
                                            <input type="hidden" id="brandIdEdit" name="brandId">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group form-group-default">
                                                        <img id="brandImage" style="max-width:100px;"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-group-default">
                                                        <input type="file" id="brandImageUpdate" name="brandImage" />
                                                        <label>Select Brand image to change.</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Name</label>
                                                        <input id="brandName" name="brandName" type="text" class="form-control" placeholder="Enter Brand Name"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <input type="checkbox" name="brandActive" id="brandActive" />&nbsp;<span>Active</span>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer border-0">
                                        <div id="edit-errors"></div>
                                        <button type="button" id="updateBrand" class="btn btn-primary">Update</button>
                                        <button type="button" class="btn btn-danger close-modal" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script>
$(document).ready(function () {

    // Add Row
    $("#add-row").DataTable({
        pageLength: 10,
    });

});

$(".delete-brand").click(function () {
    var t = $('#add-row').DataTable();
    var id = $(this).attr("data-id");
    if(confirm("Do you want to delete this feature?")){
        $.ajax({
            url: baseUrl + '/admin/delete-brand',
            type: 'post',
            data: {
                'id' : id,
            },
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                if(res.status == 200 ){
                    t.row("#row"+id).remove().draw();
                }
            }
        });
    }
});

$(".edit-brand").click(function () {
    $("#editBrandModal").modal("show");
    var id = $(this).attr("data-id");
    $.ajax({
        url: baseUrl + '/admin/edit-brand',
        type: 'post',
        data: {
            'id' : id,
        },
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            // if(res.data[0].status == 200 ){
                $("#brandName").val(res.data[0].name);
                $("#brandIdEdit").val(res.data[0].id);
                if(res.data[0].status == 'Active'){
                    $("#brandActive").attr('checked','true');
                }
                $("#brandImage").attr("src", "{{ asset('') }}" + res.data[0].image);
            // }
        }
    });

});

$("#addRowButton").click(function () {

    let formData = new FormData(document.getElementById("addBrand"));
    $.ajax({
        url: baseUrl + '/admin/new-brand',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            $('#save-errors').css('color', 'green');
            $('#save-errors').html('<div>'+res.message+'</div>');
            setTimeout(function(){
                location.reload();
            }, 2500);
        },error: function(xhr, status, error) {
            $('#save-errors').css('color', 'red');
            $('#save-errors').html('');
            let errors = xhr.responseJSON?.errors;
            if (errors) {
                $.each(errors, function (key, messages) {
                    messages.forEach(message => {
                        $('#save-errors').append('<div>' + message + '</div>');
                    });
                });
            } else {
                $('#save-errors').html('<div>An unexpected error occurred.</div>');
            }
            setTimeout(function(){
                $('#save-errors').html('');
            }, 2500);
        }
    });
});

$("#updateBrand").click(function () {
    let formData = new FormData(document.getElementById("editBrand"));
    $.ajax({
        url: baseUrl + '/admin/update-brand',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            $('#edit-errors').css('color', 'green');
            $('#edit-errors').html('<div>'+res.message+'</div>');
            setTimeout(function(){
                location.reload();
            }, 2500);
        },error: function(xhr, status, error) {
            $('#edit-errors').css('color', 'red');
            $('#edit-errors').html('');
            let errors = xhr.responseJSON?.errors;
            if (errors) {
                $.each(errors, function (key, messages) {
                    messages.forEach(message => {
                        $('#edit-errors').append('<div>' + message + '</div>');
                    });
                });
            } else {
                $('#edit-errors').html('<div>An unexpected error occurred.</div>');
            }
            setTimeout(function(){
                $('#edit-errors').html('');
            }, 2500);
        }
    });
});

$(".close-modal").click(function () {
    $("#addBrandModal").modal("hide");
    $("#editBrandModal").modal("hide");
});

$('#brandImageUpload').change(function(){
    file = this.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
            $("#brandImage").attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection