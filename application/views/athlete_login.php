
<!DOCTYPE html>
<html lang="en">

<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <base href="<?php echo base_url()?>">
  
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Sports Directorate</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon'  href='assets/img/logo/logo-icon.png' />
</head>

<body style="background: #006000;">
  <div class="loader"></div>
  <div id="app" >
    <section class="section" >
      <div class="container mt-5">
        <div class="row">

          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2" style="">

              <div class="row"  style="padding:0px;background: #fff;border-radius:30px;box-shadow:10px 10px 100px #00000082">
                <div class="col-xl-6" style="padding:0px;margin:0px;background: #006000;">
                <img src="assets/images/Asset 1.png" style="width:100% !important;height:100%">
                  </div>

                  <div class="col-xl-6" style="margin-top: 100px;">
                    <!-- start messages --->
                    <div style="text-align: center">
                    <?php if($feedback =$this->session->flashdata('feedback')){
                    $feedback_class =$this->session->flashdata('feedbase_class');  ?>
                    <div class="row">
                    <div class="col-lg-12 col-lg-offset-2">
                    <div class="alert alert-dismissible <?=  $feedback_class;?>">
                    <?= $feedback ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    </div>
                    </div>
                    <?php }?>
                    </div>  
                    <!-- end of messages  --->
           
                <form method="POST" action="<?= base_url('Athletes/login_user')?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Useremail</label>
                    <input id="email" type="email" class="form-control" name="user_email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your Username
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <!-- <div class="float-right">
                      <a href="auth-forgot-password.html" class="text-small">
                      Forgot Password?
                      </a>
                      </div> -->
                      </div>
                    <input id="password" type="password" class="form-control" name="user_password" tabindex="2" required>
                      <div class="invalid-feedback">
                      please fill in your password
                      </div>
                  </div>
                  <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->
                   <div class="col-md-4 offset-sm-4">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block text-center" style="border-radius:50px" tabindex="4">
                      Login
                    </button>
                  </div>
                </div>

                <div class="row sm-gutters">
                      <div class="col-6">
                      <a>
                      <p style="color:#15693F; font-weight: bold">Forgot Password?</p>
                      </a>
                      </div>
                      <div class="col-6" >
                      <a href="Athletes/athlete_sign_up">
                      <p  style="color:#15693F; font-weight: bold;float: right;">Sign Up</p>
                      </a>
                      </div>
                </div>
                </form>
            </div>
            </div>
             <!-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div> --> 
          </div>
        </div>
      </div>
    </section>
  </div>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    </body>
    <!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>