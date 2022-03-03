      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      <!-- <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle author-box-picture"> -->
                      <div class="clearfix"></div>
                      <div class="author-box-name" style="margin-top:10px;">

                        <?php if($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6):?>
                           <a href="#"><?=$athlete_profile['ath_name'];?></a>
                           <?php else:?>
                        <a href="#"><?=$profile['user_name'];endif;?></a>
                      </div>
                      <div class="author-box-job">
                        <?=($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6 )? '': ucwords($profile['user_role_name']) ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4>Personal Details test</h4>
                  </div>
                  <div class="card-body">
                    <div class="">
                      <p class="clearfix">
                        <span class="float-left">
                          District
                        </span>
                        <span class="float-right text-muted">
                         <!--  <?= ucwords(($profile['district_name'] != '')? $profile['district_name'] : 'Super admin' ) ?> -->
                          <?php if($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6): echo $athlete_profile['district_name']; elseif($this->session->userdata('user_role_id_fk') == 3):  echo $profile['district_name']; else: echo 'Super admin'; endif;?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Phone
                        </span>
                        <span class="float-right text-muted">
                          <?php if($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6): echo $athlete_profile['ath_contact']; else:  echo $profile['user_contact'];endif;?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Email
                        </span>
                        <span class="float-right text-muted">
                         <?php if($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6): echo $athlete_profile['ath_email']; else:  echo $profile['user_email'];endif;?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Address
                        </span>
                        <span class="float-right text-muted">
                          <?php if($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6): echo $athlete_profile['ath_address']; else:  echo $profile['user_address'];endif;?>
                        </span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <?php if($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6):?>
                  <form method="post" class="needs-validation" action="athletes/update_profile">
                  <?php else:?>
                  <form method="post" class="needs-validation" action="admin/update_profile">
                  <?php endif;?>
                            <div class="card-header">
                              <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="form-group col-md-6 col-12">
                                  <label>Name</label>
                                  <input type="text" class="form-control" name="user_name" value="<?php if($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6): echo $athlete_profile['ath_name']; else:  echo $profile['user_name'];endif;?>" maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');">
                                  <div class="invalid-feedback">
                                    Please fill in the name
                                  </div>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                  <label>Phone</label>
                                  <input type="tel" class="form-control" name="user_contact" value="<?php if($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6): echo $athlete_profile['ath_contact']; else:  echo $profile['user_contact'];endif;?>" data-inputmask="'mask': '0399-99999999'" required maxlength = "12" minlenth="12">
                                </div>

                              </div>

                              <div class="row">
                                <div class="form-group col-md-6 col-12">
                                  <label>Email</label>
                                  <input type="email" class="form-control" name="user_email" value="<?php if($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6): echo $athlete_profile['ath_email'];else:  echo $profile['user_email'];endif;?> ">
                                  <div class="invalid-feedback">
                                    Please fill in the email
                                  </div>
                                </div>
                                 <div class="form-group col-md-6 col-12">
                                  <label>Address</label>
                                  <textarea
                                    class="form-control summernote-simple" name="user_address"><?php if($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6): echo $athlete_profile['ath_address']; else:  echo $profile['user_address'];endif;?></textarea>
                                </div>
                                
                              </div>
                              
                              <div class="row">
                                  <div class="form-group col-md-6 col-12">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" name="password" onChange="onChange()">
                                  </div>
                                  <div class="form-group col-md-6 col-12">
                                    <label>Re-type New Password</label>
                                    <input type="password" class="form-control" name="confirm" onChange="onChange()">
                                  </div>
                              </div>
                              <div class="row">
                                <div class="form-group mb-0 col-12">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="newsletter">
                                    <label class="custom-control-label" for="newsletter">Logout after password change</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="card-footer text-right">
                              <button class="btn btn-primary">Save Changes</button>
                            </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery.inputmask.bundle.js"></script>
  <<script>
    $(":input").inputmask();

        function onChange() 
        {
          const password = document.querySelector('input[name=password]');
          const confirm = document.querySelector('input[name=confirm]');
          if (confirm.value === password.value) {
            confirm.setCustomValidity('');
          } else {
            confirm.setCustomValidity('Passwords do not match');
          }
        }
        </script>