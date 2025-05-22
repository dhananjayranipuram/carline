<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Carline : Admin Login</title>
    <!-- MDB -->
    <link rel="stylesheet" href="{{asset('login_assets/css/mdb.min.css')}}" />
</head>
<body>
    <header>
        <style>
        #intro {
            background-image: url({{asset('login_assets/images/008.jpg')}});
            height: 100vh;
        }

        /* Height for devices larger than 576px */
        @media (min-width: 992px) {
            #intro {
            margin-top: -58.59px;
            }
        }

        .navbar .nav-link {
            color: #fff !important;
        }
        </style>

        <!-- Background image -->
        <div id="intro" class="bg-image shadow-2-strong">
        <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-md-8">
                <form class="bg-white rounded shadow-5-strong p-5" method="POST" action="{{ url('/admin/login') }}">
                    @csrf <!-- {{ csrf_field() }} -->
                    <!-- Email input -->
                    <div class="form-outline mb-4" data-mdb-input-init>
                    <input type="email" name="email" class="form-control" />
                    <label class="form-label" for="form1Example1">Email address</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4" data-mdb-input-init>
                    <input type="password" name="password" class="form-control" />
                    <label class="form-label" for="form1Example2">Password</label>
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                        <label class="form-check-label" for="form1Example3">
                            Remember me
                        </label>
                        </div>
                    </div>

                    <div class="col text-center">
                        <a href="#">Forgot password?</a>
                    </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block" data-mdb-ripple-init>Sign in</button>
                    <div class="col-12" style="color:red;">
                      @if ($errors->any())
                        <label>{{ $errors->first('username') }}{{ $errors->first('error') }}</label>
                      @endif
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        </div>
        <!-- Background image -->
    </header>

    <!--Footer-->
    <footer class="bg-light text-lg-start">  
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            Designed by <a href="https://growtharkmedia.com">GrowthArk Media</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!--Footer-->
    
        <script type="text/javascript" src="{{asset('login_assets/js/mdb.umd.min.js')}}"></script>
    </body>
</html>