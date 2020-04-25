<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vislog">
    <meta name="keywords" content="advertising">
    <meta name="author" content="ArfianAgus">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <!-- <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/fonts/feather/style.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/fonts/simple-line-icons/style.css"> -->
    <!-- <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/fonts/font-awesome/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/vendors/css/perfect-scrollbar.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/vendors/css/prism.min.css"> -->
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <!-- <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/css/app.css?v=4"> -->
    <!-- END APEX CSS-->
    <!-- BEGIN Custom CSS-->
    <!-- <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}css/style.css?v=1"> -->
    <!-- END Custom CSS-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    body{
      font-family: "Ubuntu", sans-serif;
    }
    .main-panel .main-content {
      padding-left: 0px;
    }
    table{
      width:100%;
      border-collapse: collapse;
    }
    td{
      padding:3px 5px;
    }
    .white{
      color: white;
    }
    .center{
      text-align: center;
    }
    .border-black{
      border: 1px solid black;
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
    @yield('pagejs')
    @yield('modal')
  </body>
</html>
