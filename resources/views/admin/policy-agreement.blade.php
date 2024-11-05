@extends('layouts.admin')

@section('content')
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Policies and Agreements</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal" > <i class="fa fa-plus"></i> Add Policy & Agreement </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Policy Name</th>
                                <th>Status</th>
                                <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($policy as $key => $value)
                                <tr id="row{{$value->id}}">
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->status}}</td>
                                    <td>
                                        <div class="form-button-action">
                                        <button type="button" data-bs-toggle="tooltip" title="Edit Feature" class="btn btn-link btn-primary btn-lg edit-feature" data-name="{{$value->name}}" data-id="{{$value->id}}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" data-bs-toggle="tooltip" title="Delete Feature" class="btn btn-link btn-danger delete-feature" data-id="{{$value->id}}">
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
                    <div class="modal fade" id="addRowModal" tabindex="-1"role="dialog" aria-hidden="true" >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold"> New</span>
                                        <span class="fw-light"> Policy & Agreement </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Create a new policy and agreements using this form, make sure you fill them all</p>
                                    <form>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Name</label>
                                                    <input id="addName" type="text" class="form-control" placeholder="Enter policy / agreement name"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Content</label>
                                                    <textarea id="addContent" rows="4" class="form-control" placeholder="Enter content"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <input type="checkbox" checked id="pActive" />&nbsp;<span>Active</span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer border-0">
                                    <div id ="save-errors"></div>
                                    <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-danger close-modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editRowModal" tabindex="-1"role="dialog" aria-hidden="true" >
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold"> Edit</span>
                                <span class="fw-light"> Policy & Agreement </span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p class="small">Edit policy and agreements using this form, make sure you fill them all</p>
                                <form>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Name</label>
                                                <input id="pId" type="hidden"/>
                                                <input id="pName" type="text" class="form-control" placeholder="Enter policy / agreement name"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Content</label>
                                                <textarea id="pContent" rows="4" class="form-control" placeholder="Enter content"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <input type="checkbox" checked id="poActive" />&nbsp;<span>Active</span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer border-0">
                                <div id ="edit-errors"></div>
                                <button type="button" id="updateRowButton" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-danger close-modal">Close</button>
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
        ordering:  false,
    });

    $("#updateRowButton").click(function () {
        
        $.ajax({
            url: baseUrl + '/admin/update-policy-agreement',
            type: 'post',
            data: {
                'id' : $("#pId").val(),
                'name' : $("#pName").val(),
                'content' : $("#pContent").val(),
                'active' : $("#poActive").prop('checked'),
            },
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                $('#edit-errors').css('color', 'green');
                $('#edit-errors').html('<div>'+res.message+'</div>');
                setTimeout(function(){
                    if(res.data != -1){
                        location.reload();
                    }
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
        $("#addRowModal").modal("hide");
        $("#editRowModal").modal("hide");
    });
});

$(".delete-feature").click(function () {
    var t = $('#add-row').DataTable();
    var id = $(this).attr("data-id");
    if(confirm("Do you want to delete this policy?")){
        $.ajax({
            url: baseUrl + '/admin/delete-policy-agreement',
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

$(".edit-feature").click(function () {
    $("#editRowModal").modal("show");
    $.ajax({
        url: baseUrl + '/admin/edit-policy-agreement',
        type: 'post',
        data: {
            'id' : $(this).attr("data-id"),
        },
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            // if(res){
                $("#pId").val(res[0].id);
                $("#pName").val(res[0].name);
                $("#pName").val(res[0].name);
                $("#pContent").val(res[0].content);
                if(res[0].status == 'Active'){
                    $("#poActive").attr('checked','true');
                }
            // }
        }
    });
});

$("#addRowButton").click(function () {
        
        $.ajax({
            url: baseUrl + '/admin/save-policy-agreement',
            type: 'post',
            data: {
                'name' : $("#addName").val(),
                'content' : $("#addContent").val(),
                'active' : $("#pActive").prop('checked'),
            },
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                
                $('#save-errors').css('color', 'green');
                $('#save-errors').html('<div>'+res.message+'</div>');
                setTimeout(function(){
                    if(res > 0){
                        var action = '<div class="form-button-action"><button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-primary btn-lg edit-feature" data-name="'+$("#addName").val()+'" data-id="'+res+'" aria-label="Edit Feature" data-bs-original-title="Edit Feature" aria-describedby="tooltip939116"><i class="fa fa-edit"></i></button><button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-danger delete-feature" data-id="'+res+'" aria-label="Delete Feature" data-bs-original-title="Delete Feature"><i class="fa fa-times"></i></button></div>';
                        
                        $("#add-row")
                        .dataTable()
                        .fnAddData([
                            res,
                            $("#addName").val(),
                            ($("#pActive").prop('checked')==true)?'Active':'Inactive',
                            action,
                        ]);
                    }
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
</script>
@endsection