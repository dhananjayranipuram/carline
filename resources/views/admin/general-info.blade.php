@extends('layouts.admin')

@section('content')
<div class="page-inner">
   
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-8">
                        <h4 class="card-title">General Informations</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="quill-editor-full" style="min-height:300px;">
                        {!!$content[0]->content!!} 
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-success" id="save-info">Submit</button>
                </div>
            </div>
        </div>

        
    </div>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script> 
<script>
$(document).ready(function () {
    $("#save-info").click(function () {
        $.ajax({
            url: baseUrl + '/admin/save-general-info',
            type: 'post',
            data: {
                'content' : $(".ql-editor").html(),
            },
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                
            }
        });
    });
});
</script>
@endsection