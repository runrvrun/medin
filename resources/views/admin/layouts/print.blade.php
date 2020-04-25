<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vislog">
    <meta name="keywords" content="advertising">
    <meta name="author" content="ArfianAgus">
    @if (trim($__env->yieldContent('pagetitle')))
    <h1>@yield('pagetitle')</h1>
    @else
    <title>{{ config('app.name', 'VISLOG') }}</title>
    @endif
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/') }}app-assets/img/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/') }}app-assets/img/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/') }}app-assets/img/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/') }}app-assets/img/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('').'/favicon.ico' }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/vendors/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/vendors/css/prism.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/css/app.css?v=4">
    <!-- END APEX CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}css/style.css?v=1">
    <!-- END Custom CSS-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css" media="all">      
      html{
        width: 1000px;
      }
      body{
        -webkit-print-color-adjust: exact;
        background-color: #fff;
      }
      .card-body{
        overflow: hidden;
      }
      h4{
        margin-top:30px;
      }
    </style>
    @yield('pagecss')
</head>
<body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
      <div class="main-panel">
        <!-- BEGIN : Main Content-->
        @yield('content')
        <!-- END : End Main Content-->
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('/') }}app-assets/vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/core/popper.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/prism.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/screenfull.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/pace/pace.min.js" type="text/javascript"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    @yield('pagejs')
    <!-- END PAGE LEVEL JS-->
    @yield('modal')
  </body>
</html>
