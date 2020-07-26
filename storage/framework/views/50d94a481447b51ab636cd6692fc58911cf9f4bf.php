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
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(asset('app-assets')); ?>/img/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('app-assets')); ?>/img/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset('app-assets')); ?>/img/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(asset('app-assets')); ?>/img/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('')); ?>/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('')); ?>/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets')); ?>/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets')); ?>/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets')); ?>/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets')); ?>/vendors/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets')); ?>/vendors/css/prism.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets')); ?>/css/app.css">
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
      <?php if(Session::has('message')): ?>
      <div class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?> alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo e(ucfirst(Session::get('message'))); ?>

      </div>
      <?php endif; ?>
            <div class="card-body login-img">
            <form method="POST" action="<?php echo e(route('userlogin')); ?>">
            <?php echo csrf_field(); ?>
              <div class="row m-0">
                <div class="col-lg-6 d-lg-block d-none py-2 text-center align-middle">
                  <img src="<?php echo e(asset('app-assets')); ?>/img/gallery/login.png" alt="" class="img-fluid mt-5" width="400" height="230">
                </div>
                <div class="col-lg-6 col-md-12 bg-white px-4 pt-3">
                  <div style="margin: 20px 0"><a href="<?php echo e(url('')); ?>"><img style="display:block;" height="60px" src="<?php echo e(asset('/images/medin.png')); ?>" /></a></div>
                  <p class="card-text mb-3">
                    Welcome back, please login to your account.
                  </p>
                  <input name="email" type="text" class="form-control mb-3 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" required autofocus placeholder="Email" />
                  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <fieldset>
                  <div class="input-group" id="show_hide_password">
                    <input class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password" name="password" required autocomplete="current-password" placeholder="Password">
                    <div class="input-group-append">
                      <span class="input-group-text" id="showpassword"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                    </div>
                  </div>
                </fieldset>
                  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  <div class="d-flex justify-content-between mt-2">
                    <div class="remember-me">
                      <div class="custom-control custom-checkbox custom-control-inline mb-3">
                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                        <label class="custom-control-label" for="remember">
                          Remember Me
                        </label>
                      </div>
                    </div>
                    <div class="forgot-password-option">
                    <?php if(Route::has('password.request')): ?>
                                    <a class="text-decoration-none text-primary" href="<?php echo e(route('password.request')); ?>">
                                        <?php echo e(__('Forgot Your Password?')); ?>

                                    </a>
                                <?php endif; ?>
                    </div>
                  </div>
                  <div class="fg-actions d-flex justify-content-between">
                  <div class="login-btn">
                    <a  class="text-decoration-none  btn btn-outline-primary" href="<?php echo e(route('register')); ?>">Register</a>
                  </div>
                    <div class="recover-pass">
                      <button class="btn btn-primary">
                        <a class="text-decoration-none text-white">Login</a>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
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
    <script src="<?php echo e(asset('app-assets')); ?>/vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets')); ?>/vendors/js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets')); ?>/vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets')); ?>/vendors/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets')); ?>/vendors/js/prism.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets')); ?>/vendors/js/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets')); ?>/vendors/js/screenfull.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets')); ?>/vendors/js/pace/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="<?php echo e(asset('app-assets')); ?>/js/app-sidebar.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets')); ?>/js/notification-sidebar.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets')); ?>/js/customizer.js" type="text/javascript"></script>
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
</html><?php /**PATH C:\xampp\htdocs\medin\resources\views/auth/login.blade.php ENDPATH**/ ?>