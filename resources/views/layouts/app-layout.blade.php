@php
    $currentRoute = \Request::route()->getName();
    // dd($currentRoute);
    $dashboard = ['dashboard'];
    $roles = ['roles', 'roles.create', 'roles.edit'];
    $users = ['users','user.edit'];

    $frame = ['frame','frame.edit'];
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->

    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

    <style>

#loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999; /* Make sure the overlay is on top of other elements */
}

.loading-spinner {
    text-align: center;
    color: #ffffff;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
    border-width: 0.3em;
}
    </style>
</head>

<body>
    <div class="container-scroller">
        <div id="loading-overlay" class="d-none">
            <div class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="text-primary">Loading, please wait...</p>
            </div>
        </div>
        <!-- partial:partials/_navbar.html -->
        @if (Auth::user()->hasRole('Admin'))
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                    <a class="navbar-brand brand-logo me-5" href="{{ route('dashboard') }}"><img
                            src="{{ asset('assets/img/logo.png') }}" class="me-2" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg"
                            alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>

                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                id="profileDropdown">
                                <img src="{{ asset('assets/images/faces/face28.jpg') }}" alt="profile" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('setting') }}">
                                    <i class="ti-settings text-primary"></i> Settings </a>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="ti-power-off text-primary"></i> Logout </a>
                            </div>
                        </li>

                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="icon-menu"></span>
                    </button>
                </div>
            </nav>
        @endif
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @if (Auth::user()->hasRole('Admin'))
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item @if (in_array($currentRoute, $dashboard)) active @endif">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>

                        {{-- <li class="nav-item @if (in_array($currentRoute, $roles)) active @endif">
                        <a class="nav-link " href="{{ route('roles') }}">
                            <i class="mdi mdi-account-settings menu-icon"></i>
                            <span class="menu-title">Roles</span>
                        </a>
                    </li> --}}
                        <li class="nav-item @if (in_array($currentRoute, $users)) active @endif">
                            <a class="nav-link " href="{{ route('users') }}">
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                                <span class="menu-title">User</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('user.export', ['type' => 'csv']) }}">
                                <i class="mdi mdi-file menu-icon"></i>
                                <span class="menu-title">CSV</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('user.export', ['type' => 'xlsx']) }}">
                                <i class="mdi mdi-file-excel menu-icon"></i>
                                <span class="menu-title">Excel</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('user.export', ['type' => 'pdf']) }}">
                                <i class="mdi mdi-file-pdf-box menu-icon"></i>
                                <span class="menu-title">PDF</span>
                            </a>
                        </li>
                        <li class="nav-item @if (in_array($currentRoute, $frame)) active @endif">
                            <a class="nav-link " href="{{ route('frame') }}">
                                <i class="mdi mdi-image-filter-frames menu-icon"></i>
                                <span class="menu-title">Frame</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
            <!-- partial -->
            <div class="main-panel"
                @if (!Auth::user()->hasRole('Admin')) style="width:100%; margin-left:50px; margin-right:50px;" @endif>
                <div class="@if (Auth::user()->hasRole('Admin')) content-wrapper @endif">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @if (Auth::user()->hasRole('Admin'))
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <a href="https://www.linkedin.com/in/ashish-sitaram-panicker-3448a4187" target="_blank">Developed by Ashish Sitaram Panicker</span>
                        </div>
                    </footer>
                @endif
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->

    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>



    <!-- End plugin js for this page -->
    <!-- inject:js -->



    <!-- endinject -->
    <!-- Custom js for this page-->


    <!-- <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    </script>

    @yield('script')
    <!-- End custom js for this page-->
</body>

</html>
