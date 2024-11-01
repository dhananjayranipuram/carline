@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Add Car Type</h4>
                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addTypeModal" > <i class="fa fa-plus"></i> Add Car Type </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Modal -->
            <div class="modal fade" id="addTypeModal" tabindex="-1"role="dialog" aria-hidden="true" >
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> New</span>
                        <span class="fw-light"> Car Type </span>
                    </h5>
                    <button type="button" class="close close-modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="{{url('/admin/new-type')}}">
                    @csrf <!-- {{ csrf_field() }} -->
                        <div class="modal-body">
                            <p class="small">Create a new Car Types using this form, make sure you fill them all</p>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Name</label>
                                            <input type="text" name="tyName" class="form-control" placeholder="Enter Car Type"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <input type="file" name="tyImage" />
                                            <label>Select Car Type image.</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <input type="checkbox" checked name="tyActive" />&nbsp;<span>Active</span>
                                        </div>
                                    </div>
                            
                                </div>
                        </div>
                    
                        <div class="modal-footer border-0">
                            <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-danger close-modal" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!-- Modal -->
            <div class="modal fade" id="editTypeModal" tabindex="-1"role="dialog" aria-hidden="true" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold"> Edit</span>
                            <span class="fw-light"> Car Type </span>
                        </h5>
                        <button type="button" class="close close-modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post" enctype="multipart/form-data" action="{{url('/admin/update-type')}}">
                            @csrf <!-- {{ csrf_field() }} -->
                            <div class="modal-body">
                                <p class="small">Edit the Car Type using this form, make sure you fill them all</p>
                                
                                    <input type="hidden" id="typeIdEdit" name="typeId">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <img id="typeImage" style="max-width:100px;"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <input type="file" id="typeImageUpdate" name="typeImage" />
                                                <label>Select Car Type image to change.</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Name</label>
                                                <input id="typeName" name="typeName" type="text" class="form-control" placeholder="Enter Car Type"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <input type="checkbox" name="typeActive" id="typeActive" />&nbsp;<span>Active</span>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer border-0">
                                <button type="submit" id="updateType" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-danger close-modal" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="add-row" class="display table table-striped table-hover" >
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Car Type</th>
                    <th>Status</th>
                    <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($type as $key => $value)
                    <tr id="row{{$value->id}}">
                        <td>{{$value->id}}</td>
                        <td><img src="{{asset($value->image)}}" style="max-width:100px;"></td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->status}}</td>
                        <td>
                            <div class="form-button-action">
                            <button type="button" data-bs-toggle="tooltip" title="Edit type" class="btn btn-link btn-primary btn-lg edit-type" data-id="{{$value->id}}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" data-bs-toggle="tooltip" title="Delete type" class="btn btn-link btn-danger delete-type" data-id="{{$value->id}}">
                                <i class="fa fa-times"></i>
                            </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

$(".delete-type").click(function () {
    var t = $('#add-row').DataTable();
    var id = $(this).attr("data-id");
    if(confirm("Do you want to delete this car type?")){
        $.ajax({
            url: baseUrl + '/admin/delete-type',
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

$(".edit-type").click(function () {
    $("#editTypeModal").modal("show");
    var id = $(this).attr("data-id");
    $.ajax({
        url: baseUrl + '/admin/edit-type',
        type: 'post',
        data: {
            'id' : id,
        },
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            // if(res.data[0].status == 200 ){
                $("#typeName").val(res.data[0].name);
                $("#typeIdEdit").val(res.data[0].id);
                if(res.data[0].status == 'Active'){
                    $("#typeActive").attr('checked','true');
                }
                $("#typeImage").attr("src", "{{ asset('') }}" + res.data[0].image);
            // }
        }
    });

});

$(".close-modal").click(function () {
    $("#addTypeModal").modal("hide");
    $("#editTypeModal").modal("hide");
});

$('#typeImageUpdate').change(function(){
    file = this.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
            $("#typeImage").attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection