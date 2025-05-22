@extends('layouts.admin')

@section('content')
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Add Specification</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal" > <i class="fa fa-plus"></i> Add Specification </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Spec Name</th>
                                <th>Options</th>
                                <th>Status</th>
                                <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($specification as $key => $value)
                                <tr id="row{{$value->id}}">
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{str_replace('~',',',$value->options)}}</td>
                                    <td>{{$value->status}}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg edit-spec" data-id="{{$value->id}}"><i class="fa fa-edit"></i></button>
                                            <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger delete-spec" data-id="{{$value->id}}"><i class="fa fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true" >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <form method="post" enctype="multipart/form-data" id="add-spec-form">
                                @csrf <!-- {{ csrf_field() }} -->
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold"> New</span>
                                            <span class="fw-light"> Specification </span>
                                        </h5>
                                        <button type="button" class="close close-modal" aria-label="Close" > <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="small"> Create a new Specification using this form, make sure you fill them all </p>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Name</label>
                                                        <input name="specName" type="text" class="form-control" placeholder="Enter name" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default spec-options">
                                                        <label>Options</label>
                                                        <input type="text" name="options[]" class="form-control" placeholder="Enter option" />
                                                    </div>
                                                    <button type="button" data-bs-toggle="tooltip" title="add options" class="btn btn-link btn-primary btn-lg add-options"><i class="fas fa-plus-circle"></i>Add More Options</button>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Icon Image</label>
                                                        <input name="image" type="file" class="form-control" accept="image/*" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <input type="checkbox" checked name="specActive" />&nbsp;<span>Active</span>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer border-0">
                                        <div id="save-errors"></div>
                                        <button type="button" class="btn btn-primary add-spec" > Add </button>
                                        <button type="button" class="btn btn-danger close-modal" data-dismiss="modal" > Close </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="editTypeModal" tabindex="-1"role="dialog" aria-hidden="true" >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold"> Edit</span>
                                    <span class="fw-light"> Car Specification </span>
                                </h5>
                                <button type="button" class="close close-modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form method="post" enctype="multipart/form-data" id="update-spec-form">
                                    @csrf <!-- {{ csrf_field() }} -->
                                    <div class="modal-body">
                                        <p class="small">Edit the Specifications using this form, make sure you fill them all</p>
                                        
                                            <input type="hidden" id="specIdEdit" name="specId">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Name</label>
                                                        <input name="specName" id="specName" type="text" class="form-control" placeholder="Enter name" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default options-edit">
                                                        <label>Options</label>
                                                    </div>
                                                    <button type="button" data-bs-toggle="tooltip" title="add options" class="btn btn-link btn-primary btn-lg add-options-edit"><i class="fas fa-plus-circle"></i>Add More Options</button>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Icon Image</label>
                                                        <input name="image" type="file" class="form-control" accept="image/*" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <input type="checkbox" name="specActive" id="specActive" />&nbsp;<span>Active</span>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer border-0">
                                        <div id="edit-errors"></div>
                                        <button type="button" class="btn btn-primary update-spec">Update</button>
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
    
    $("#add-row").DataTable({
        pageLength: 10,
    });
}); 

$(".edit-spec").click(function () {
    $("#editTypeModal").modal("show");
    var id = $(this).attr("data-id");
    $.ajax({
        url: baseUrl + '/admin/edit-spec',
        type: 'post',
        data: {
            'id' : id,
        },
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            // if(res.data[0].status == 200 ){
                $("#specName").val(res.data[0].name);
                $("#specIdEdit").val(res.data[0].id);
                if(res.data[0].status == 'Active'){
                    $("#specActive").attr('checked','true');
                }
                var arr = res.data[0].options.split('~');
                $('.options-edit').html('');
                $.each( arr, function( index, value ) {
                    $('.options-edit').append('<input type="text" name="options[]" value="'+value+'" class="form-control" placeholder="Enter option" />');

                });
            // }
        }
    });
});

$(".add-spec").click(function () {

    let formData = new FormData(document.getElementById("add-spec-form"));
    $.ajax({
        url: baseUrl + '/admin/add-spec',
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
                $('#save-errors').html('');
                $("#add-spec-form")[0].reset();
                $("#addRowModal").modal("hide");
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

$(".update-spec").click(function () {
    let formData = new FormData(document.getElementById("update-spec-form"));
    $.ajax({
        url: baseUrl + '/admin/update-spec',
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
                $('#edit-errors').html('');
                $("#update-spec-form")[0].reset();
                $("#editTypeModal").modal("hide");
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

$(".delete-spec").click(function () {
    var t = $('#add-row').DataTable();
    var id = $(this).attr("data-id");
    if(confirm("Do you want to delete this Specification?")){
        $.ajax({
            url: baseUrl + '/admin/delete-spec',
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

$(".close-modal").click(function () {
    $("#addRowModal").modal("hide");
    $("#editTypeModal").modal("hide");
});

$(".add-options").click(function () {
    $(".spec-options").append('<input type="text" name="options[]" class="form-control" placeholder="Enter option" />');
});

$(".add-options-edit").click(function () {
    $(".options-edit").append('<input type="text" name="options[]" class="form-control" placeholder="Enter option" />');
}); 
</script>
@endsection