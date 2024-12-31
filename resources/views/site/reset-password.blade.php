@extends('layouts.site')

@section('content')

<!-- Page Header Start -->
<!-- <div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">reset password</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Page Header End -->

<!-- Page Contact Us Start -->
<div class="page-contact-us">
    <div class="contact-info-form">
        <div class="container">
            <div class="row">
                
                
                <div class="col-lg-12">
                    
                    <div id="msgSubmit" class="h3">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {!! session('success') !!}
                        </div>
                        @endif
                    </div>
                    <!-- Contact Form Start -->
                    <div class="contact-us-form">
                        <form action="{{url('/reset-user-password')}}" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.5s">
                        @csrf <!-- {{ csrf_field() }} -->
                            <div class="row">
                                
                                <div class="form-group col-md-6 mb-4">
                                    <label>Password</label>
                                    <input type="password" name ="password" class="form-control" placeholder="Enter new password" required>
                                    @error('password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm password" required>
                                    @error('confirmPassword')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <div class="contact-form-btn">
                                        <button type="submit" class="btn-default">Reset Password</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger mt-3">
                                {!! session('error') !!}
                            </div>
                        @endif
                    </div>
                    <!-- Contact Form End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Contact Us End -->
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script> 
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script>
$(".reset-popup").click(function() {
    $(".overlay").show();
    $.magnificPopup.close();


    $.magnificPopup.open({
        items: {
            src: '#forgotForm',
            type: 'inline'
        }
    });
    $(".overlay").hide();

});

$(".login-popup").click(function() {
    $(".overlay").show();
    $.magnificPopup.close();

    $.magnificPopup.open({
        items: {
            src: '#loginForm',
            type: 'inline'
        }
    });
    $(".overlay").hide();

});
</script>
@endsection