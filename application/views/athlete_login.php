<!DOCTYPE html>
<html lang="en">

<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <base href="<?=base_url()?>">
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Directorate of Sports, Khyber Pakhtunkhwa</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/logo/logo-icon.png' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">

              <div class="card-header">
                
              </div>
              <img alt="image" src="assets/images/dg_sport.png"  style="padding: 0% 35%" />
              <div class="card-body">
              <h5 class="card-title text-center"><strong>Login</strong></h5>
                <!-- start messages --->
                  <div style="text-align: center" class="msg">
                      <?php if($feedback =$this->session->flashdata('feedback')){
                        $feedback_class =$this->session->flashdata('feedbase_class');  ?>
                            <div class="row">
                              <div class="col-lg-12 col-lg-offset-2 msg">
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
                
                  <div class="form-row">
                    <div class="col-12">
                      <div class="input-group mb-3"> 
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                        </div>
                        <input name="user_email" type="text" value="" class="input form-control" id="user_email" placeholder="User Email / User Contact" aria-label="user_email" aria-describedby="basic-addon1"  require autofocus/>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                        </div>
                        <input name="user_password" type="password" value="" class="input form-control" id="password" placeholder="password" required="true" aria-label="password" aria-describedby="basic-addon1" />
                        <div class="input-group-append">
                          <span class="input-group-text" onclick="hideShowPassword();">
                            <i class="fas fa-eye" id="show_eye"></i>
                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                          </span>
                        </div>
                      </div>
                    </div>


                    <div class="col-12" style="margin-top: 10px;">
                    <div class="float-right">
                        <a href="Athletes/athlete_sign_up">
                          <strong>SignUp</strong>
                        </a>
                      </div> 

                       <div class="float-left">
                        <a href="Athletes/forgot_passord/" class="text-small">
                          <strong>Forgot Password?</strong>
                        </a>
                      </div> 


                       
                    </div>
                  </div><br>
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                
                </div>
              </div>
            </div>
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

<!-- captcha refresh code -->
<script>
$(document).ready(function(){
    $('.refreshCaptcha').on('click', function(){
        $.get('<?= base_url().'admin/refreshCaptcha'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});
function hideShowPassword() 
{
  var passsword = document.getElementById("password");

  if (passsword.type === "password") 
  {
    passsword.type = "text";
    $('#show_eye').addClass('d-none');
    $('#hide_eye').removeClass('d-none');
    
  } 
  else 
  {
    passsword.type = "password";
    $('#show_eye').removeClass('d-none');
    $('#hide_eye').addClass('d-none');
  }
}
</script>