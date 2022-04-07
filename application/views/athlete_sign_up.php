
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
  <script src="assets/js/jquery.min.js"></script>

</head>

<body>
  <div class="loader"></div>
  <div id="app" >
    <section class="section" >
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <div class="card card-primary">
              <div class="card-header">
                <div class="col-md-4 offset-sm-4">
                 <img alt="image" src="assets/images/DG sports logo.png"  style="height:100px;width:100px;"/> 
               </div>
              </div>
              <div class="card-body" >
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
           
              <form method="POST" action="<?= base_url('Athletes/athlete_insert')?>" class="needs-validation" novalidate="" onsubmit="return myFunction()">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" name="ath_name" maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" required autofocus>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="ath_email" required autofocus>
                   
                  </div>

                  <div class="form-group">
                    <label for="ath_contact">Mobile Number</label>
                    <input id="mobile_number" type="text" class="form-control" name="ath_contact" data-inputmask="'mask': '0399-9999999'" minlength="12" maxlength="12" required >
                  </div>

                  <div class="form-group">
                      <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      </div>
                    <input id="password" type="password" class="form-control" name="ath_password"   required>   
                  </div>


                  <div class="form-group">
                    <label for="c_user_password">Confirm Password</label>
                    <input id="c_password" type="password" class="form-control" name="c_ath_password"  required autofocus>
                   
                  </div>
                   <div class="col-md-4 offset-sm-4">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block text-center"  >
                      Sign Up
                    </button>
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

    <script src="assets/js/jquery.inputmask.bundle.js"></script>
    </body>
    <!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>

<script>

  function myFunction(){

      var pass   = $('#password').val();
      var c_pass = $('#c_password').val();


      if(pass == c_pass){

        return true;

      }
      else{

        alert('Password Not Matched')
        return false;
      }
    }
</script>

 <script>
        
        $(document).ready(function(){
          $(".msg").delay(3000).fadeOut(1000);

        $(":input").inputmask();


        });
      </script>