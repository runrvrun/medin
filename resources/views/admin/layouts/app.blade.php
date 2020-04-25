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
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/prism.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/app.css?v=9">
    <!-- END APEX CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/style.css?v=1">
    <!-- END Custom CSS-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('pagecss')
</head>
<body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">

      <!-- main menu-->
      <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
      <div data-active-color="white" data-background-color="man-of-steel" data-image="{{ asset('/') }}app-assets/img/sidebar-bg/05.jpg" class="app-sidebar">
        <!-- main menu header-->
        <!-- Sidebar Header starts-->
        <div class="sidebar-header">
          <div class="logo clearfix"><a href="{{ url('/admin/') }}" class="logo-text float-left">
              <div class="logo-img"><img src="{{ asset('images/vislog-logo-white.png') }}" width="32px" /></div><span class="text align-middle"> VISLOG</span></a><a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="toggle-icon ft-toggle-right"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i></a></div>
        </div>
        <!-- Sidebar Header Ends-->
        <!-- / main menu header-->
        <!-- main menu content-->
        <div class="sidebar-content">
          <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" data-scroll-to-active="true" class="navigation navigation-main">
              @if(session('privilege')['admin/highlight']['browse'] ?? 0)<li class=" home-nav nav-item"><a href="{{ url('/admin/highlight') }}"><i class="ft-award"></i><span data-i18n="" class="menu-title">Highlight</span></a></li>@endif
              @if(session('privilege')['admin/dashboard']['browse'] ?? 0)<li class=" home-nav nav-item"><a href="{{ url('/admin/dashboard') }}"><i class="ft-bar-chart-2"></i><span data-i18n="" class="menu-title">Dashboard</span></a></li>@endif
              @if(session('privilege')['admin/adsperformance']['browse'] ?? 0)<li class=" nav-item"><a href="{{ url('/admin/adsperformance') }}"><i class="ft-activity"></i><span data-i18n="" class="menu-title">Ads Performance</span></a></li>@endif
              <li class="has-sub nav-item" id="cliplibrary"><a href="#"><i class="ft-film"></i><span data-i18n="" class="menu-title">Clip Library</span></a>
                <ul class="menu-content">
                @if(session('privilege')['admin/tvads']['browse'] ?? 0)<li><a href="{{ url('/admin/tvads') }}" class="menu-item"><i class="ft-monitor"></i>TV Ads</a></li>@endif
                  @if(session('privilege')['admin/tvprogramme']['browse'] ?? 0)<li><a href="{{ url('/admin/tvprogramme') }}" class="menu-item"><i class="ft-play-circle"></i>TV Programme</a></li>@endif
                </ul>
              </li>
              @if((session('privilege')['admin/mktsummary']['browse'] ?? 0) || (session('privilege')['admin/adexnett']['browse'] ?? 0) || (session('privilege')['admin/spotmatching']['browse'] ?? 0))
              <li class="has-sub nav-item" id="marketingtools"><a href="#"><i class="ft-phone-call"></i><span data-i18n="" class="menu-title">Marketing Tools</span></a>
                <ul class="menu-content">
                  @if(session('privilege')['admin/mktsummary']['browse'] ?? 0)<li><a href="{{ url('/admin/mktsummary') }}" class="menu-item"><i class="ft-aperture"></i>Summary</a></li>@endif
                  @if(session('privilege')['admin/adexnett']['browse'] ?? 0)<li><a href="{{ url('/admin/adexnett') }}" class="menu-item"><i class="ft-target"></i>Adex Nett</a></li>@endif
                  @if(session('privilege')['admin/spotmatching']['browse'] ?? 0)<li><a href="{{ url('/admin/spotmatching') }}" class="menu-item"><i class="ft-check-circle"></i>Spot Matching</a></li>@endif
                </ul>
              </li>
              @endif
              @if((session('privilege')['admin/uploaddata/commercial']['browse'] ?? 0) || (session('privilege')['admin/uploadsearch/commercial']['browse'] ?? 0) || (session('privilege')['admin/spotpairing']['browse'] ?? 0) || (session('privilege')['admin/notification']['browse'] ?? 0))
              <li class="has-sub nav-item" id="administrator"><a href="#"><i class="ft-aperture"></i><span data-i18n="" class="menu-title">Administrator</span></a>
                <ul class="menu-content">
                  <li class="has-sub nav-item" id="administrator"><a href="#"><i class="ft-upload-cloud"></i><span data-i18n="" class="menu-title">Upload Data</span></a>
                    <ul class="menu-content">
                      @if(session('privilege')['admin/uploaddata/commercial']['browse'] ?? 0)<li><a href="{{ url('/admin/uploaddata/commercial') }}" class="menu-item"><i class="ft-upload-cloud"></i>Commercial</a></li>@endif
                      @if(session('privilege')['admin/uploaddata/commercialgrouped']['browse'] ?? 0)<li><a href="{{ url('/admin/uploaddata/commercialgrouped') }}" class="menu-item"><i class="ft-upload-cloud"></i>Commercial Grouped</a></li>@endif
                      @if(session('privilege')['admin/uploaddata/tvprogramme']['browse'] ?? 0)<li><a href="{{ url('/admin/uploaddata/tvprogramme') }}" class="menu-item"><i class="ft-upload-cloud"></i>TV Programme</a></li>@endif
                      @if(session('privilege')['admin/uploaddata/adexnett']['browse'] ?? 0)<li><a href="{{ url('/admin/uploaddata/adexnett') }}" class="menu-item"><i class="ft-upload-cloud"></i>Adex Nett</a></li>@endif
                      @if(session('privilege')['admin/uploaddata/spotmatching']['browse'] ?? 0)<li><a href="{{ url('/admin/uploaddata/spotmatching') }}" class="menu-item"><i class="ft-upload-cloud"></i>Spot Matching</a></li>@endif
                    </ul>
                  </li>
                  <li class="has-sub nav-item" id="administrator"><a href="#"><i class="ft-zoom-in"></i><span data-i18n="" class="menu-title">Search Data</span></a>
                    <ul class="menu-content">
                      @if(session('privilege')['admin/uploadsearch/commercial']['browse'] ?? 0)<li><a href="{{ url('/admin/uploadsearch/commercial') }}" class="menu-item"><i class="ft-zoom-in"></i>Commercial</a></li>@endif
                      @if(session('privilege')['admin/uploadsearch/tvprogramme']['browse'] ?? 0)<li><a href="{{ url('/admin/uploadsearch/tvprogramme') }}" class="menu-item"><i class="ft-zoom-in"></i>TV Programme</a></li>@endif
                      @if(session('privilege')['admin/uploadsearch/adstype']['browse'] ?? 0)<li><a href="{{ url('/admin/uploadsearch/adstype') }}" class="menu-item"><i class="ft-zoom-in"></i>Ads Type</a></li>@endif
                    </ul>
                  </li>
                  @if(session('privilege')['admin/spotpairing']['browse'] ?? 0)<li><a href="{{ url('/admin/spotpairing') }}" class="menu-item"><i class="ft-voicemail"></i>Spot Pairing</a></li>@endif
                  @if(session('privilege')['admin/videodata']['browse'] ?? 0)<li><a href="{{ url('/admin/videodata') }}" class="menu-item"><i class="ft-video"></i>Video Data</a></li>@endif
                  @if(session('privilege')['admin/targetaudience']['browse'] ?? 0)<li><a href="{{ url('/admin/targetaudience') }}" class="menu-item"><i class="ft-star"></i>Target Audience</a></li>@endif
                  @if(session('privilege')['admin/daypartsetting']['browse'] ?? 0)<li><a href="{{ url('/admin/daypartsetting') }}" class="menu-item"><i class="ft-sun"></i>Daypart Setting</a></li>@endif
                  @if(session('privilege')['admin/tvchighlight']['browse'] ?? 0)<li><a href="{{ url('/admin/tvchighlight') }}" class="menu-item"><i class="ft-tv"></i>TVC Highlight</a></li>@endif
                  @if(session('privilege')['admin/channel']['browse'] ?? 0)<li><a href="{{ url('/admin/channel') }}" class="menu-item"><i class="ft-tv"></i>Channel</a></li>@endif
                  @if(session('privilege')['admin/notification']['browse'] ?? 0)<li><a href="{{ url('/admin/notification') }}" class="menu-item"><i class="ft-bell"></i>Notification</a></li>@endif
                </ul>
              </li>
              @endif
              <li class="has-sub nav-item" id="usermgt"><a href="#"><i class="ft-user-check"></i><span data-i18n="" class="menu-title">User Management</span></a>
                <ul class="menu-content">
                  @if(session('privilege')['admin/user']['browse'] ?? 0)<li><a href="{{ url('/admin/user') }}" class="menu-item"><i class="ft-user"></i>User</a></li>@endif
                  @if(session('privilege')['admin/role']['browse'] ?? 0)<li><a href="{{ url('/admin/role') }}" class="menu-item"><i class="ft-users"></i>Role</a></li>@endif
                </ul>
              </li>
              @if(session('privilege')['admin/demorequest']['browse'] ?? 0)<li class=" nav-item"><a href="{{ url('/admin/demorequest') }}"><i class="ft-phone-incoming"></i><span data-i18n="" class="menu-title">Demo Request</span></a></li>@endif
            </ul>
          </div>
        </div>
        <!-- main menu content-->
        <div class="sidebar-background"></div>
        <!-- main menu footer-->
        <!-- include includes/menu-footer-->
        <!-- main menu footer-->
      </div>
      <!-- / main menu-->


      <!-- Navbar (Header) Starts-->
      <nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><span class="d-lg-none navbar-right navbar-collapse-toggle"><a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black"><i class="ft-more-vertical"></i></a></span>
          </div>
          <div class="navbar-container">
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
              <ul class="navbar-nav">
                <li class="nav-item mr-2 d-none d-lg-block"><a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen"><i class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">fullscreen</p></a></li>
                <li class="dropdown nav-item"><a id="ddnotif" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-bell font-medium-3 blue-grey darken-4"></i>
                <?php
                // $notif = App\Notification::where('user_to_notify',Auth::user()->id)->get();
                $notif = App\Notification::get();
                ?>
                <span class="notification badge badge-pill badge-danger">{{ ($notif->count()>0)? $notif->count():'' }}</span>
                  <p class="d-none">Notifications</p></a>
                  <div class="notification-dropdown dropdown-menu dropdown-menu-right">
                    <div class="noti-list">
                      @if(!$notif->count())
                      <a class="dropdown-item noti-container py-3 border-bottom border-bottom-blue-grey border-bottom-lighten-4">
                        <span class="noti-wrapper">
                          <span class="noti-text">No new notification.</span>
                        </span>
                      </a>
                      @endif
                      @foreach($notif as $noti)
                      <a class="dropdown-item noti-container py-3 border-bottom border-bottom-blue-grey border-bottom-lighten-4">
                        <span class="noti-wrapper">
                          <span class="noti-title line-height-1 d-block text-bold-400 info">{{ $noti->data['title'] ?? '' }}</span>
                          <span class="noti-text">{!! nl2br($noti->data['message'])  ?? '' !!}</span>
                        </span>
                      </a>
                      @endforeach
                  </div>
                </li>
                <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-user font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">User Settings</p></a>
                  <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right">
                  @if (Auth::check()) 
                  <a href="#" class="dropdown-item py-1">Hi, <span>{{ Auth::user()->name }}</span></a>
                  <a href="{{ url('admin/myprofile') }}" class="dropdown-item py-1"><i class="ft-user"></i> My Profile</a>
                  <a href="{{ url('admin/changepassword') }}" class="dropdown-item py-1"><i class="fa fa-key"></i> Change Password</a>
                  @endif
                  <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="ft-power mr-2"></i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!-- Navbar (Header) Ends-->

      <div class="main-panel">
        <!-- BEGIN : Main Content-->
        @yield('content')
        <!-- END : End Main Content-->

        <!-- BEGIN : Footer-->
        <footer class="footer footer-static footer-light">
        <p class="pull-left clearfix text-muted text-sm-center px-2">
          <span>Copyright  &copy; 2019 VISLOG - Integrated Advertising Analysis & Monitoring Tools. </span>
          <span style="font-size:6px;">Powered by <a href="http://arfianagus.com/">arfianagus.com</a> </span>
        </p>
        </footer>
        <!-- End : Footer-->

      </div>
    </div>
    @yield('filterer')
    <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block"><a class="customizer-close"><i class="ft-x font-medium-3"></i></a>
      <a id="customizer-toggle-icon" class="customizer-toggle bg-danger"><i class="ft-settings font-medium-4 fa fa-spin white align-middle"></i></a>
      <div data-ps-id="2bb45d65-1dd1-e754-6429-f5fef5ad065a" class="customizer-content p-3 ps-container ps-theme-dark ps-active-y">
        <h4 class="text-uppercase mb-0 text-bold-400">Theme Customizer</h4>
        <p>Customize &amp; Preview in Real Time</p>
        <hr>
        <!-- Layout Options-->
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Layout Options</h6>
        <div class="layout-switch ml-4">
          <div class="custom-control custom-radio d-inline-block custom-control-inline light-layout">
            <input id="ll-switch" type="radio" name="layout-switch" checked="" class="custom-control-input">
            <label for="ll-switch" class="custom-control-label">Light</label>
          </div>
          <div class="custom-control custom-radio d-inline-block custom-control-inline dark-layout">
            <input id="dl-switch" type="radio" name="layout-switch" class="custom-control-input">
            <label for="dl-switch" class="custom-control-label">Dark</label>
          </div>
          <div class="custom-control custom-radio d-inline-block custom-control-inline transparent-layout">
            <input id="tl-switch" type="radio" name="layout-switch" class="custom-control-input">
            <label for="tl-switch" class="custom-control-label">Transparent</label>
          </div>
        </div>
        <hr>
        <!-- Sidebar Options Starts-->
        <h6 class="text-center text-bold-500 mb-3 text-uppercase sb-options">Sidebar Color Options</h6>
        <div class="cz-bg-color sb-color-options">
          <div class="row p-1">
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="pomegranate" class="gradient-pomegranate d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="king-yna" class="gradient-king-yna d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="ibiza-sunset" class="gradient-ibiza-sunset d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="flickr" class="gradient-flickr d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="purple-bliss" class="gradient-purple-bliss d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="man-of-steel" class="gradient-man-of-steel d-block rounded-circle selected"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="purple-love" class="gradient-purple-love d-block rounded-circle"></span></div>
          </div>
          <div class="row p-1">
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="black" class="bg-black d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="white" class="bg-grey d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="primary" class="bg-primary d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="success" class="bg-success d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="warning" class="bg-warning d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="info" class="bg-info d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="danger" class="bg-danger d-block rounded-circle"></span></div>
          </div>
        </div>
        <!-- Sidebar Options Ends-->
        <!-- Transparent Layout Bg color Options-->
        <h6 class="text-center text-bold-500 mb-3 text-uppercase tl-color-options d-none">Background Colors</h6>
        <div class="cz-tl-bg-color d-none">
          <div class="row p-1">
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="hibiscus" class="bg-hibiscus d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="bg-purple-pizzazz" class="bg-purple-pizzazz d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="bg-blue-lagoon" class="bg-blue-lagoon d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="bg-electric-viloet" class="bg-electric-violet d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="bg-protage" class="bg-portage d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="bg-tundora" class="bg-tundora d-block rounded-circle"></span></div>
          </div>
        </div>
        <!-- Transparent Layout Bg color Ends-->
        <hr>
        <!-- Sidebar BG Image Starts-->
        <h6 class="text-center text-bold-500 mb-3 text-uppercase sb-bg-img">Sidebar Bg Image</h6>
        <div class="cz-bg-image row sb-bg-img">
          <div class="col-sm-2 mb-3"><img src="{{ asset('/') }}app-assets/img/sidebar-bg/01.jpg" width="90" class="rounded sb-bg-01 selected"></div>
          <div class="col-sm-2 mb-3"><img src="{{ asset('/') }}app-assets/img/sidebar-bg/02.jpg" width="90" class="rounded sb-bg-02"></div>
          <div class="col-sm-2 mb-3"><img src="{{ asset('/') }}app-assets/img/sidebar-bg/03.jpg" width="90" class="rounded sb-bg-03"></div>
          <div class="col-sm-2 mb-3"><img src="{{ asset('/') }}app-assets/img/sidebar-bg/04.jpg" width="90" class="rounded sb-bg-04"></div>
          <div class="col-sm-2 mb-3"><img src="{{ asset('/') }}app-assets/img/sidebar-bg/05.jpg" width="90" class="rounded sb-bg-05"></div>
          <div class="col-sm-2 mb-3"><img src="{{ asset('/') }}app-assets/img/sidebar-bg/06.jpg" width="90" class="rounded sb-bg-06"></div>
        </div>
        <!-- Transparent BG Image Ends-->
        <div class="tl-bg-img d-none">
          <h6 class="text-center text-bold-500 text-uppercase">Background Images</h6>
          <div class="cz-tl-bg-image row">
            <div class="col-sm-3"><img src="{{ asset('/') }}app-assets/img/gallery/bg-glass-1.jpg" width="90" class="rounded bg-glass-1 selected"></div>
            <div class="col-sm-3"><img src="{{ asset('/') }}app-assets/img/gallery/bg-glass-2.jpg" width="90" class="rounded bg-glass-2"></div>
            <div class="col-sm-3"><img src="{{ asset('/') }}app-assets/img/gallery/bg-glass-3.jpg" width="90" class="rounded bg-glass-3"></div>
            <div class="col-sm-3"><img src="{{ asset('/') }}app-assets/img/gallery/bg-glass-4.jpg" width="90" class="rounded bg-glass-4"></div>
          </div>
        </div>
        <!-- Transparent BG Image Ends    -->
        <hr>
        <!-- Sidebar BG Image Toggle Starts-->
        <div class="togglebutton toggle-sb-bg-img">
          <div class="switch"><span>Sidebar Bg Image</span>
            <div class="float-right">
              <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input id="sidebar-bg-img" type="checkbox" checked="" class="custom-control-input cz-bg-image-display">
                <label for="sidebar-bg-img" class="custom-control-label"></label>
              </div>
            </div>
          </div>
          <hr>
        </div>
        <!-- Sidebar BG Image Toggle Ends-->
        <!-- Compact Menu Starts-->
        <div class="togglebutton">
          <div class="switch"><span>Compact Menu</span>
            <div class="float-right">
              <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input id="cz-compact-menu" type="checkbox" class="custom-control-input cz-compact-menu">
                <label for="cz-compact-menu" class="custom-control-label"></label>
              </div>
            </div>
          </div>
        </div>
        <!-- Compact Menu Ends-->
        <hr>
        <!-- Sidebar Width Starts-->
        <div>
          <label for="cz-sidebar-width">Sidebar Width</label>
          <select id="cz-sidebar-width" class="custom-select cz-sidebar-width float-right">
            <option value="small">Small</option>
            <option value="medium" selected="">Medium</option>
            <option value="large">Large</option>
          </select>
        </div>
        <!-- Sidebar Width Ends-->
      <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 610px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 463px;"></div></div></div>
    </div>
    @yield('modal')
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
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="{{ asset('/') }}app-assets/js/app-sidebar.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/js/notification-sidebar.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}app-assets/js/customizer.js?v=11" type="text/javascript"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script>
      var url = String( document.location.href ).replace( "#", "" );         
      if(url!=='/'){
        $('a.menu-item[href="'+ url +'"]').parent().addClass('active');
        $('a.menu-item[href="'+ url +'"]').parents('li.has-sub').addClass('open');
      }else{
        $('.home-nav').addClass('active');
      }
    </script>
    <script>
      $(document).ready(function(){
        if(!$("#masterdata>ul").children().length){
          $("#masterdata").hide();
        }
        if(!$("#usermgt>ul").children().length){
          $("#usermgt").hide();
        }
      });
      $('#ddnotif').click(function(){
        $.ajax( "{{ url('admin/notification/markallread') }}" );
      });
    </script>
    <script>
    $(document).ready(function(){
      $("#ll-switch").on("click", function() {
        getstyle();
      });
      $("#dl-switch").on("click", function() {
        getstyle();
      });
      $("#tl-switch").on("click", function() {
        getstyle();        
      });
      $(".customizer").on("click", function() {
        getstyle();        
      });
      $(".cz-tl-bg-image").on("click", function() {
        getstyle();        
      });
      $(".customizer-content").on("click", function() {
        getstyle();        
      });
      $(".cz-bg-color").on("click", function() {
        getstyle();        
      });
      $(".cz-bg-image").on("click", function() {
        getstyle();        
      });
      $(".cz-bg-image-display").on("click", function() {
        getstyle();        
      });
      $(".cz-compact-menu").on("click", function() {
        getstyle();        
      });
      $(".cz-sidebar-width").on("change", function() {
        getstyle();        
      });
      $("#sidebar-bg-img").on("click", function() {
        getstyle();        
      });
  
      setstyle();
    });
    function getstyle(){
      var bgColor = $(".app-sidebar").attr("data-background-color");
      Cookies.set('bgColor',bgColor);
      var src = $(".app-sidebar").css("background-image");
      Cookies.set('src',src);        
      var bodyclass = $("body").attr("class");
      Cookies.set('bodyclass',bodyclass);        
      var src = $(".app-sidebar").css("background-image");
      Cookies.set('src',src);        
      var src2 = $(".sidebar-background").css("background-image");
      Cookies.set('src2',src2);        
    }
    function setstyle(){
      $(".app-sidebar").attr("data-background-color",Cookies.get('bgColor'));
      $(".app-sidebar").css("background-image",Cookies.get('src'));
      $("body").attr("class",Cookies.get('bodyclass'));
      $(".sidebar-background").css("background-image",Cookies.get('src2'));
    }
    </script>
    @yield('pagejs')
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
