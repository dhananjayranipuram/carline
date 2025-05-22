@extends('layouts.admin')

@section('content')
<style>
    
    .button {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 4px;
        margin-left: 10px; /* Spacing between input and button */
    }
    
</style>
<div class="page-inner">
   
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-8">
                        <h4 class="card-title">General Informations</h4>
                    </div>
                </div>
                <form method="post" action="{{ url('/admin/general-info') }}">
                @csrf <!-- {{ csrf_field() }} -->
                    <div class="card-body">
                    <input type="hidden" name="id" value="{{ $content[0]->id }}"/>
                        @if($errors->any())
                            <div class="col-12 error-messages" style="color:red;">
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="heading" placeholder="Enter heading" value="{{ old('heading', $content[0]->heading ?? '') }}"/>
                                    @error('heading') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <textarea rows="6" class="form-control" name="content" placeholder="Enter content">{{ old('content', $content[0]->content ?? '') }}</textarea>
                                    @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        @foreach(explode('~', $content[0]->options) as $key=>$option)
                        <div class="row">
                            <div class="col-md-12 col-lg-10">
                                <div class="form-group" >
                                    <input type="text" class="form-control" name="options[]" placeholder="Enter options" value="{{$option}}"/>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2">
                                <div class="form-group" >
                                    <button type="button" class="btn btn-icon btn-round btn-success add-row"><i class="fas fa-plus-circle"></i></button>
                                    @if($key!=0)
                                    <button type="button" class="btn btn-icon btn-round btn-danger remove-row"><i class="fas fa-minus-circle"></i></button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success" id="save-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        
    </div>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script> 
<script>
$(document).on('click', '.add-row', function () {    
    var str = '<div class="row">'
                +'<div class="col-md-12 col-lg-10">'
                +'<div class="form-group" >'
                +'<input type="text" class="form-control" name="options[]" placeholder="Enter options"/>'
                +'</div>'
                +'</div>'
                +'<div class="col-md-12 col-lg-2">'
                +'<div class="form-group" >'
                +'<button type="button" class="btn btn-icon btn-round btn-success add-row"><i class="fas fa-plus-circle"></i></button>'
                +'<button type="button" class="btn btn-icon btn-round btn-danger remove-row"><i class="fas fa-minus-circle"></i></button>'
                +'</div>'
                +'</div>'
                +'</div>';
    $(this).closest('.card-body').append(str);
});

$(document).on('click', '.remove-row', function () {
    $(this).closest('.row').remove();
});
</script>
@endsection