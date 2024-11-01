@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Add Emirates</h4>
                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal" > <i class="fa fa-plus"></i> Add Emirates </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Modal -->
            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <form method="post" action="{{url('/admin/add-new-emirates')}}">
                        @csrf <!-- {{ csrf_field() }} -->
                            <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold"> New</span>
                                    <span class="fw-light"> Emirates </span>
                                </h5>
                                <button type="button" class="close close-modal" aria-label="Close" > <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p class="small"> Create a new Emirate using this form, make sure you fill them all </p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Name</label>
                                                <input name="name" type="text" class="form-control" placeholder="fill name" />
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Rate</label>
                                                <input name="rate" type="text" class="form-control" placeholder="fill rate" />
                                            </div>
                                        </div>
                
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <input type="checkbox" checked name="active" />&nbsp;<span>Active</span>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer border-0">
                                <button type="submit" class="btn btn-primary" > Add </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" > Close </button>
                            </div>
                        </form>
                    </div>
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
                            <span class="fw-light"> Emirates </span>
                        </h5>
                        <button type="button" class="close close-modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post" action="{{url('/admin/update-emirates')}}">
                            @csrf <!-- {{ csrf_field() }} -->
                            <div class="modal-body">
                                <p class="small">Edit the Emirates using this form, make sure you fill them all</p>
                                
                                    <input type="hidden" id="emIdEdit" name="emId">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Name</label>
                                                <input name="emName" id="emName" type="text" class="form-control" placeholder="fill name" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Rate</label>
                                                <input name="emRate" id="emRate" type="text" class="form-control" placeholder="fill rate" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <input type="checkbox" name="emActive" id="emActive" />&nbsp;<span>Active</span>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer border-0">
                                <button type="submit" class="btn btn-primary">Update</button>
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
                    <th>Emirate Name</th>
                    <th>Emirate Rate</th>
                    <th>Status</th>
                    <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($emirates as $key => $value)
                    <tr id="row{{$value->id}}">
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->rate}}</td>
                        <td>{{$value->status}}</td>
                        <td>
                            <div class="form-button-action">
                                <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg edit-spec" data-id="{{$value->id}}"><i class="fa fa-edit"></i></button>
                                <!-- <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger delete-spec" data-id="{{$value->id}}"><i class="fa fa-times"></i></button> -->
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

$(".add-options").click(function () {
    $(".spec-options").append('<input type="text" name="options[]" class="form-control" placeholder="Enter option" />');
}); 

$(".edit-spec").click(function () {
    $("#editTypeModal").modal("show");
    var id = $(this).attr("data-id");
    $.ajax({
        url: baseUrl + '/admin/edit-emirates',
        type: 'post',
        data: {
            'id' : id,
        },
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res) {
            // if(res.data[0].status == 200 ){
                $("#emName").val(res.data[0].name);
                $("#emIdEdit").val(res.data[0].id);
                $("#emRate").val(res.data[0].rate);
                if(res.data[0].status == 'Active'){
                    $("#emActive").attr('checked','true');
                }
                
            // }
        }
    });
});

// $(".delete-spec").click(function () {
//     var t = $('#add-row').DataTable();
//     var id = $(this).attr("data-id");
//     if(confirm("Do you want to delete this Specification?")){
//         $.ajax({
//             url: baseUrl + '/admin/delete-spec',
//             type: 'post',
//             data: {
//                 'id' : id,
//             },
//             dataType: "json",
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             success: function(res) {
//                 if(res.status == 200 ){
//                     t.row("#row"+id).remove().draw();
//                 }
//             }
//         });
//     }
// });

</script>
@endsection