@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Add Feature</h4>
                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal" > <i class="fa fa-plus"></i> Add Feature </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Modal -->
            <div class="modal fade" id="addRowModal" tabindex="-1"role="dialog" aria-hidden="true" >
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> New</span>
                        <span class="fw-light"> Feature </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p class="small">Create a new Feature using this form, make sure you fill them all</p>
                        <form>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Name</label>
                                        <input id="addName" type="text" class="form-control" placeholder="fill feature"/>
                                    </div>
                                </div>
                        
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-danger close-modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="modal fade" id="editRowModal" tabindex="-1"role="dialog" aria-hidden="true" >
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> Edit</span>
                        <span class="fw-light"> Feature </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p class="small">Edit Feature using this form, make sure you fill them all</p>
                        <form>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Name</label>
                                        <input id="featureName" type="text" class="form-control" placeholder="fill feature"/>
                                    </div>
                                </div>
                        
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-danger close-modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="add-row" class="display table table-striped table-hover" >
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Feature Name</th>
                    <th>Status</th>
                    <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($features as $key => $value)
                    <tr id="row{{$value->id}}">
                        <td>{{$value->id}}</td>
                        <td>{{$value->feature}}</td>
                        <td>{{$value->status}}</td>
                        <td>
                            <div class="form-button-action">
                            <button type="button" data-bs-toggle="tooltip" title="Edit Feature" class="btn btn-link btn-primary btn-lg edit-feature" data-name="{{$value->feature}}" data-id="{{$value->id}}">
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
    </div>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script>
    $(document).ready(function () {

    $("#add-row").DataTable({
        pageLength: 5,
        ordering:  false,
    });

    var action = '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    $("#addRowButton").click(function () {
        $.ajax({
            url: baseUrl + '/admin/save-feature',
            type: 'post',
            data: {
                'name' : $("#addName").val(),
            },
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                if(res.data != -1){
                    $("#add-row")
                    .dataTable()
                    .fnAddData([
                        res.data[0].id,
                        res.data[0].feature,
                        res.data[0].status,
                        action,
                    ]);
                }
            }
        });
        $("#addRowModal").modal("hide");
    });

    $(".delete-feature").click(function () {
        var t = $('#add-row').DataTable();
        var id = $(this).attr("data-id");
        if(confirm("Do you want to delete this feature?")){
            $.ajax({
                url: baseUrl + '/admin/delete-feature',
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
        $("#featureName").val($(this).attr("data-name"));
    });

    $(".close-modal").click(function () {
        $("#addRowModal").modal("hide");
        $("#editRowModal").modal("hide");
    });
});
</script>
@endsection