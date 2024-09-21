<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Dashboard - HRMS admin template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">

    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
    
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
        <style>
            .mobile-view{
                margin-top: 15px;
            }
        </style>
</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="index.html" class="logo" style="margin-top: 10px">
                    <img src="{{ asset('assets/img/logo.png')}}" width="40" height="40" alt="">
                </a>
            </div>
            <!-- /Logo -->

            <a id="toggle_btn" href="javascript:void(0);">
                <span class="bar-icon" style="margin-top: 20px">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars mobile-view"></i></a>

            <!-- Header Menu -->
            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img src="assets/img/profiles/avatar-21.jpg" alt="">
                            <span class="status online"></span></span>
                        <span>Soeng Souy</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="settings.html">Settings</a>
                        <a class="dropdown-item" href="login.html">Logout</a>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v mobile-view"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->

        </div>
        <!-- /Header -->

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                   @include('layout.nav_'.currentUser())
                </div>
            </div>
        </div>
        <!-- /Sidebar -->

       
            @yield('content')
       

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{ asset('assets/js/chart.js')}}"></script>
    
    <script src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/app.js')}}"></script>
    @stack('scripts')

</body>

</html>
