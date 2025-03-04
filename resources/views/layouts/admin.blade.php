<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Carline - Admin</title>
        <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
        <meta content="{{ csrf_token() }}" name="csrf-token">
        <link rel="icon" href="{{asset('admin_assets/img/kaiadmin/favicon.png')}}" type="image/x-icon"/>

        <!-- Fonts and icons -->
        <script> var baseUrl = "{{ url('/') }}"; </script>
        <script src="{{asset('admin_assets/js/plugin/webfont/webfont.min.js')}}"></script>
        <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{asset('admin_assets/css/fonts.min.css')}}"],
            },
            active: function () {
            sessionStorage.fonts = true;
            },
        });
        </script>

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{asset('admin_assets/css/bootstrap.min.css')}}" />
        <link href="{{asset('admin_assets/css/quill.snow.css')}}" rel="stylesheet">
        <link href="{{asset('admin_assets/css/quill.bubble.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('admin_assets/css/plugins.min.css')}}" />
        <link rel="stylesheet" href="{{asset('admin_assets/css/kaiadmin.min.css')}}" />

        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{asset('admin_assets/css/demo.css')}}" />
        <style>
          .logo-width{
            height:50px;
          }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar -->
            <div class="sidebar" data-background-color="dark">
                <div class="sidebar-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{url('/admin/dashboard')}}" class="logo">
                            <img src="{{asset('admin_assets/img/kaiadmin/footer-logo.png')}}" alt="navbar brand" class="navbar-brand logo-width" height="20"/>
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <div class="sidebar-wrapper scrollbar scrollbar-inner">
                    <div class="sidebar-content">
                        <ul class="nav nav-secondary">
                            <li class="nav-item @if(Request::path() == 'admin/dashboard') active @endif">
                                <a href="{{url('/admin/dashboard')}}" ><i class="fas fa-home"></i><p>Dashboard</p></a>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Pages</h4>
                            </li>
                            <li class="nav-item @if(Request::path() == 'admin/cars') active @endif">
                                <a href="{{url('/admin/cars')}}" ><i class="fas fa-car"></i><p>Our Cars</p></a>
                            </li>
                            <li class="nav-item @if(Request::path() == 'admin/add-specifications') active @endif">
                                <a href="{{url('/admin/add-specifications')}}" ><i class="fas fa-list"></i><p>Specifications</p></a>
                            </li>
                            <li class="nav-item @if(Request::path() == 'admin/add-features') active @endif">
                                <a href="{{url('/admin/add-features')}}" ><i class="fas fa-list"></i><p>Features</p></a>
                            </li>
                            <li class="nav-item @if(Request::path() == 'admin/add-brand') active @endif">
                                <a href="{{url('/admin/add-brand')}}" ><i class="fas fa-bold"></i><p>Brands</p></a>
                            </li>
                            <li class="nav-item @if(Request::path() == 'admin/add-type') active @endif">
                                <a href="{{url('/admin/add-type')}}" ><i class="fas fa-car-side"></i><p>Car Type</p></a>
                            </li>
                            <li class="nav-item @if(Request::path() == 'admin/general-info') active @endif">
                                <a href="{{url('/admin/general-info')}}" ><i class="fas fa-list"></i><p>General Info</p></a>
                            </li>
                            <li class="nav-item @if(Request::path() == 'admin/policies-agreement') active @endif">
                                <a href="{{url('/admin/policies-agreement')}}" ><i class="fas fa-list"></i><p>Policies & Agreements</p></a>
                            </li>
                            <li class="nav-item @if(Request::path() == 'admin/add-emirates') active @endif">
                                <a href="{{url('/admin/add-emirates')}}" ><i class="fas fa-list"></i><p>Emirates</p></a>
                            </li>
                            <li class="nav-item @if(Request::path() == 'admin/users') active @endif">
                                <a href="{{url('/admin/users')}}" ><i class="fas fa-list"></i><p>User List</p></a>
                            </li>
                            <li class="nav-item @if(Request::path() == 'admin/bookings') active @endif">
                                <a href="{{url('/admin/bookings')}}" ><i class="fas fa-list"></i><p>Bookings</p></a>
                            </li>
                            <li class="nav-item @if(Request::path() == 'admin/reports') active @endif">
                                <a href="{{url('/admin/reports')}}" ><i class="fas fa-list"></i><p>Reports</p></a>
                            </li>
                            <li class="nav-item">
                                <a class="additional-settings" href="#" data-bs-toggle="modal" data-bs-target="#additionalSettings"><i class="fas fa-list"></i><p>Additional Settings</p></a>
                            </li>
              
              <!-- <li class="nav-item">
                <a href="widgets.html">
                  <i class="fas fa-desktop"></i>
                  <p>Widgets</p>
                  <span class="badge badge-success">4</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../documentation/index.html">
                  <i class="fas fa-file"></i>
                  <p>Documentation</p>
                  <span class="badge badge-secondary">1</span>
                </a>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#submenu">
                  <i class="fas fa-bars"></i>
                  <p>Menu Levels</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="submenu">
                  <ul class="nav nav-collapse">
                    <li>
                      <a data-bs-toggle="collapse" href="#subnav1">
                        <span class="sub-item">Level 1</span>
                        <span class="caret"></span>
                      </a>
                      <div class="collapse" id="subnav1">
                        <ul class="nav nav-collapse subnav">
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a data-bs-toggle="collapse" href="#subnav2">
                        <span class="sub-item">Level 1</span>
                        <span class="caret"></span>
                      </a>
                      <div class="collapse" id="subnav2">
                        <ul class="nav nav-collapse subnav">
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a href="#">
                        <span class="sub-item">Level 1</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li> -->
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img src="{{asset('admin_assets/img/kaiadmin/logo_light.svg')}}" alt="navbar brand" class="navbar-brand" height="20" />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom" >
            <div class="container-fluid">
              <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex" >
                
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                
                
                
                

                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false" >
                    <div class="avatar-sm">
                      <i class="fa fa-user-tie fa-2x"></i>
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">Admin</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <i class="fa fa-user-tie fa-3x"></i>
                            <!-- <img
                              src="{{asset('admin_assets/img/profile.jpg')}}"
                              alt="image profile"
                              class="avatar-img rounded"
                            /> -->
                          </div>
                          <div class="u-text">
                            <h4>{{$userAdminData->first_name}}</h4>
                            <p class="text-muted">{{$userAdminData->email}}</p>
                            <!-- <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a> -->
                          </div>
                        </div>
                      </li>
                      <li>
                        <!-- <div class="dropdown-divider"></div> -->
                        <!-- <a class="dropdown-item" href="#">My Profile</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url('/admin/logout')}}">Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

        <div class="container">
        @yield('content')
        </div>

        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <div>
              Designed by <a href="https://growtharkmedia.com">GrowthArk Media</a>
            </div>
          </div>
        </footer>
      </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="additionalSettings" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="post" id="additional-settings-form">
                @csrf <!-- {{ csrf_field() }} -->
                    <div class="modal-header border-0">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold"> Additional</span>
                            <span class="fw-light"> Settings </span>
                        </h5>
                        <button type="button" class="close close-modal" aria-label="Close" > <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p class="small"> Update basic settings using this form, make sure you fill them all </p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Baby seat charges (AED)</label>
                                        <input name="babySeat" id="babySeat" type="text" class="form-control" placeholder="Enter amount" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>VAT Rate (%)</label>
                                        <input name="vatRate" id="vatRate" type="text" class="form-control" placeholder="Enter percentage" />
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer border-0">
                        <div id="as-edit-errors"></div>
                        <button type="button" class="btn btn-primary update-settings" > Update </button>
                        <button type="button" class="btn btn-danger close-modal" data-dismiss="modal" > Close </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <!--   Core JS Files   -->
    <script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/core/bootstrap.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{asset('admin_assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{asset('admin_assets/js/plugin/chart.js/chart.min.js')}}"></script>

    <script src="{{asset('admin_assets/js/quill.js')}}"></script>
    <!-- jQuery Sparkline -->
    <script src="{{asset('admin_assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Chart Circle -->
    <script src="{{asset('admin_assets/js/plugin/chart-circle/circles.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{asset('admin_assets/js/plugin/datatables/datatables.min.js')}}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{asset('admin_assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{asset('admin_assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/plugin/jsvectormap/world.js')}}"></script>

    <!-- Sweet Alert -->
    <script src="{{asset('admin_assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{asset('admin_assets/js/kaiadmin.min.js')}}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{asset('admin_assets/js/setting-demo.js')}}"></script>
    <!-- <script src="{{asset('admin_assets/js/demo.js')}}"></script> -->
    <script src="{{asset('admin_assets/js/setting-demo2.js')}}"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });

      $(".close-modal").click(function () {
          $("#additionalSettings").modal("hide");
      });

      $(".update-settings").click(function () {
        let formData = new FormData(document.getElementById("additional-settings-form"));
        $.ajax({
            url: baseUrl + '/admin/update-add-settings',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res) {
                $('#as-edit-errors').css('color', 'green');
                $('#as-edit-errors').html('<div>'+res.message+'</div>');
                setTimeout(function(){
                    $('#as-edit-errors').html('');
                    $("#additionalSettings").modal("hide");
                }, 2500);
            },error: function(xhr, status, error) {
                $('#as-edit-errors').css('color', 'red');
                $('#as-edit-errors').html('');
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    $.each(errors, function (key, messages) {
                        messages.forEach(message => {
                            $('#as-edit-errors').append('<div>' + message + '</div>');
                        });
                    });
                } else {
                    $('#as-edit-errors').html('<div>An unexpected error occurred.</div>');
                }
                setTimeout(function(){
                    $('#as-edit-errors').html('');
                }, 2500);
            }
        });
    });
    $(".additional-settings").click(function () {
      $.ajax({
          url: baseUrl + '/admin/get-additional-settings',
          type: 'post',
          dataType: "json",
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function(res) {
              if(res.status == 200 ){
                  $("#babySeat").val(res.data[0].baby_seat_charge);
                  $("#vatRate").val(res.data[0].vat_rate);
              }
          }
      });
    });
    </script>
    <script src="{{asset('admin_assets/js/main.js')}}"></script> 
  </body>
</html>
