<!DOCTYPE html>
<html lang="en" class="loading">
  <!-- BEGIN : Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>MedIn</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('app-assets') }}/img/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('app-assets') }}/img/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('app-assets') }}/img/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('app-assets') }}/img/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="{{ asset('') }}/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/prism.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/app.css">
    <!-- END APEX CSS-->
    <!-- BEGIN Page Level CSS-->
    <!-- END Page Level CSS-->
  </head>
  <!-- END : Head-->

  <!-- BEGIN : Body-->
  <body data-col="1-column" class=" 1-column  blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
      <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!--Login Page Starts-->
<section id="login">
  <div class="container-fluid">
    <div class="row full-height-vh m-0">
      <div class="col-12 d-flex align-items-center justify-content-center">        
        <div class="card">
          <div class="card-content">
      @if(Session::has('message'))
      <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ ucfirst(Session::get('message')) }}
      </div>
      @endif
          <div class="card-body">
              @if (session('resent'))
                  <div class="alert alert-success" role="alert">
                      {{ __('A fresh verification link has been sent to your email address.') }}
                  </div>
              @endif
              <p>Hi {{ Auth::user()->name }},</p>
              <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
              {{ __('If you did not receive the email') }},
              <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                  @csrf
                  <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
              </form>
              <br/><br/><br/>
              or <a href="{{ route('logout') }}" class="btn btn-outline-primary"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                  <i class="ft-power mr-2"></i>{{ __('Login as another user') }}
              </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Login Page Ends-->

          </div>
        </div>
        <!-- END : End Main Content-->
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('app-assets') }}/vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/core/popper.min.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/prism.min.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/screenfull.min.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/pace/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="{{ asset('app-assets') }}/js/app-sidebar.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/js/notification-sidebar.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/js/customizer.js" type="text/javascript"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script type="text/javascript">
    $(document).ready(function() {
        $("#showpassword").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
    });
    </script>
    <!-- END PAGE LEVEL JS-->
  </body>
  <!-- END : Body-->
</html>