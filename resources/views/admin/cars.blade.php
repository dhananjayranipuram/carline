@extends('layouts.admin')

@section('content')

<div class="page-inner">
   
    <div class="row">

        <div class="col-md-12">
        <div class="card">
            <div class="card-header row">
                <div class="col-md-8">
                    <h4 class="card-title">Our Cars</h4>
                </div>
                <div class="col-md-4" style="text-align: right;">
                    <button class="btn btn-primary" onclick="location.href = '{{url('/admin/add-car')}}';">Add Car</button>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Rate</th>
                        <th style="width: 10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $key => $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->brand_name}}@if($value->offer_flag==1)<span class="btn btn-link btn-warning btn-lg"><i class="fas fa-star"></i></span>@endif</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->model}}</td>
                        <td>{{$value->car_type}}</td>
                        <td>{{$value->rent}}</td>
                        <td>
                            <div class="form-button-action">
                                <a href="{{url('/admin/edit-car')}}?id={{base64_encode($value->id)}}" data-bs-toggle="tooltip" title="Edit Brand" class="btn btn-link btn-primary btn-lg edit-brand" data-original-title="Edit Task">
                                    <i class="fa fa-edit"></i>
                                </a>
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
        </div>

        
    </div>
    </div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script>
$(document).ready(function () {
$("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function () {
        this.api()
            .columns()
            .every(function () {
            var column = this;
            var select = $(
                '<select class="form-select"><option value=""></option></select>'
            )
                .appendTo($(column.footer()).empty())
                .on("change", function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                column
                    .search(val ? "^" + val + "$" : "", true, false)
                    .draw();
                });

            column
                .data()
                .unique()
                .sort()
                .each(function (d, j) {
                select.append(
                    '<option value="' + d + '">' + d + "</option>"
                );
                });
            });
        },
    });
});
</script>    
@endsection