@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Add Brand</h4>
                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addBrandModal" > <i class="fa fa-plus"></i> Add Brand </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Modal -->
            <div class="modal fade" id="addBrandModal" tabindex="-1"role="dialog" aria-hidden="true" >
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> New</span>
                        <span class="fw-light"> Brand </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="{{url('/admin/new-brand')}}">
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
                            <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-danger close-modal" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!-- Modal -->
            <div class="modal fade" id="editBrandModal" tabindex="-1"role="dialog" aria-hidden="true" >
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> Edit</span>
                        <span class="fw-light"> Brand </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="{{url('/admin/update-brand')}}">
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
                            <button type="submit" id="updateBrand" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-danger close-modal" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
    </div>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script>
$(document).ready(function () {

    // Add Row
    $("#add-row").DataTable({
        pageLength: 10,
    });

    // var action = '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    // $("#addRowButton").click(function () {
    //     $("#add-row")
    //     .dataTable()
    //     .fnAddData([
    //         '#',
    //         $("#addName").val(),
    //         'Active',
    //         action,
    //     ]);
    //     $("#addRowModal").modal("hide");
    // });
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