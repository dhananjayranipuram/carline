@extends('layouts.admin')

@section('content')

<div class="page-inner">
   
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-8">
                        <h4 class="card-title">Customers</h4>
                    </div>
                    <div class="col-md-4" style="text-align: right;">
                        <a class="btn btn-primary" href="{{url('/admin/export-users')}}">Export</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Emirate</th>
                                <th style="width: 10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->first_name}}</td>
                                <td>{{$value->last_name}}</td>
                                <td>{{$value->email}}</td>
                                <td>{{$value->phone}}</td>
                                <td>{{$value->emirates}}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{url('/admin/view-user')}}?id={{base64_encode($value->id)}}" data-bs-toggle="tooltip" title="View User" class="btn btn-link btn-primary btn-lg edit-brand" data-original-title="View User">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="{{url('/admin/edit-users')}}?id={{base64_encode($value->id)}}" data-bs-toggle="tooltip" title="Edit User" class="btn btn-link btn-primary btn-lg edit-brand" data-original-title="Edit User">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" data-bs-toggle="tooltip" title="Delete User" class="btn btn-link btn-danger delete-user" data-original-title="Remove" data-id="{{$value->id}}">
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
        </div>

        
    </div>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script>
$(document).ready(function () {
    $("#multi-filter-select").DataTable({
        pageLength: 10,
        
    });

    $(".delete-user").click(function () {
        var id = $(this).attr("data-id");
        if(confirm("Do you want to delete this user?")){
            $.ajax({
                url: baseUrl + '/admin/delete-user',
                type: 'post',
                data: {
                    'id' : id,
                },
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res) {
                    location.reload();
                }
            });
        }
    });
});

</script>  
 
@endsection