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
                      <img src="{{asset('admin_assets/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle" />
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
                            <img
                              src="{{asset('admin_assets/img/profile.jpg')}}"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            <h4>Hizrian</h4>
                            <p class="text-muted">hello@example.com</p>
                            <a
                              href="profile.html"
                              class="btn btn-xs btn-secondary btn-sm"
                              >View Profile</a
                            >
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">My Profile</a>
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
    <script src="{{asset('admin_assets/js/demo.js')}}"></script>
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
    </script>
    <script src="{{asset('admin_assets/js/main.js')}}"></script> 
  </body>
</html>
