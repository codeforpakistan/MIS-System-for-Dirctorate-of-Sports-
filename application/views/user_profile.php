      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle author-box-picture">
                      <div class="clearfix"></div>
                      <div class="author-box-name" style="margin-top:10px;">
                        <a href="#"><span class="user_profile_name"></span></a>
                      </div>
                      <div class="author-box-job"><span class="user_profile_role"></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4>Personal Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="">
                      <p class="clearfix">
                        <span class="float-left">
                          District
                        </span>
                        <span class="float-right text-muted">
                        <span class="user_profile_district"></span>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Phone
                        </span>
                        <span class="float-right text-muted">
                        <span class="user_profile_contact"></span>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Email
                        </span>
                        <span class="float-right text-muted">
                        <span class="user_profile_email"></span>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Address
                        </span>
                        <span class="float-right text-muted">
                        <span class="user_profile_address"></span>
                        </span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <form method="post" class="needs-validation profile_add_form">
                            <div class="card-header">
                              <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="form-group col-md-6 col-12">
                                  <label>First Name</label>
                                  <input type="text" class="form-control" name="ath_name" value="" maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');">
                                  <div class="invalid-feedback">
                                    Please fill in the first name
                                  </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                  <label>Father Name</label>
                                  <input type="text" class="form-control" name="ath_father_name" value=" " maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');">
                                  <div class="invalid-feedback">
                                    Please fill in the Father Name
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="form-group col-md-6 col-12">
                                  <label>Date Of Birth</label>
                                  <input type="date" class="form-control" name="ath_dob">
                                  <div class="invalid-feedback">
                                    Please fill in the Date Of Birth
                                  </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                  <label>Gender</label>
                                    <select class="form-control" name="ath_gender">
                                      <option>-Select Gender-</option>
                                      <option value="male">Male</option>
                                      <option value="female">Female</option>
                                    </select>
                                  <div class="invalid-feedback">
                                    Please fill in the Gender
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="form-group col-md-6 col-12">
                                  <label>Emergency Contact No</label>
                                  <input type="tel" class="form-control" name="ath_emergency_contact" value="" data-inputmask="'mask': '0399-99999999'" required maxlength = "12" minlenth="12">
                                  <div class="invalid-feedback">
                                    Please fill in the Emergency Contact No 
                                  </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                  <label>Profession</label>
                                  <input type="text" class="form-control" name="ath_profession">
                                  <div class="invalid-feedback">
                                    Please fill in the profession
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="form-group col-md-7 col-12">
                                  <label>Email</label>
                                  <input type="email" class="form-control" name="ath_email" value="">
                                  <div class="invalid-feedback">
                                    Please fill in the email
                                  </div>
                                </div>
                                <div class="form-group col-md-5 col-12">
                                  <label>Phone</label>
                                  <input type="tel" class="form-control" name="ath_contact" value="" data-inputmask="'mask': '0399-99999999'" required maxlength = "12" minlenth="12">
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-9">
                                  <label>Address</label>
                                  <textarea
                                    class="form-control summernote-simple" name="ath_address"></textarea>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Profile Image</label>
                                    <input type="file" name="attachment"  class="form-control dropify ath_profile_photo" data-default-file="" data-height="100"  data-max-file-size="40M" data-allowed-file-extensions="png jpg jpeg" >
                                    <!-- <input type="text" name="old_profile_image" id="old_profile_image" />  -->
                                </div> <!-- end of col-md-3 --> 
                              </div>
                              <div class="row">
                                  <div class="form-group col-md-12 col-12">
                                    <label>Old Password</label>
                                    <input type="password" class="form-control" name="old_password">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group col-md-6 col-12">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" name="password" onChange="onChange()" >
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
                              <button class="btn btn-primary update_button">Save Changes</button>
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
      $(document).ready(function()
      {
        $('.dropify').dropify();
        user_profile_list();
        function user_profile_list()
        {
          var ath_name = '';
          var ath_father_name  = '';
          var ath_dob ='';
          var ath_gender ='';
          var ath_emergency_contact ='';
          var ath_profession ='';
          var ath_email      = '';
          var ath_address    = '';
          var ath_contact    = '';
          var user_role_name  = '';
          var district_name   = ''; 
          var ath_profile_photo   = '';
          $.ajax({
            url: 'Athletes/profle_info',
            dataType:'json',
            success: function(response)
            {  
              $.each(response, function( index, oneByOne ) 
              { 
                 ath_name = oneByOne.ath_name;
                 ath_father_name = oneByOne.ath_father_name;
                 ath_dob         = oneByOne.ath_dob;
                 ath_gender      = oneByOne.ath_gender;
                 ath_emergency_contact  = oneByOne.ath_emergency_contact;
                 ath_profession         = oneByOne.ath_profession;
                 ath_email           = oneByOne.ath_email;
                 ath_address         = oneByOne.ath_address;
                 ath_contact         = oneByOne.ath_contact;
                 user_role_name      = oneByOne.user_role_name;
                 ath_profile_photo   = oneByOne.ath_profile_photo;
                 if(oneByOne.district_name == '' || oneByOne.district_name == null || oneByOne.district_name == 0)
                 {
                  district_name   = 'District Missing';
                 }
                 else
                 {
                  district_name   = oneByOne.district_name;

                 } 
                 
              }); 
              // profile 
              $('.user_profile_name').html(ath_name);
              $('.user_profile_role').html(user_role_name);
              $('.user_profile_district').html(district_name);
              $('.user_profile_contact').html(ath_contact);
              $('.user_profile_email').html(ath_email);
              $('.user_profile_address').html(ath_address);
              $('.author-box-picture').attr('src','assets/images/athlete_images/'+ath_profile_photo);
              $('.user-img-radious-style').attr('src','assets/images/athlete_images/'+ath_profile_photo);
              // form values
              $('[name="ath_name"]').val(ath_name);
              $('[name="ath_father_name"]').val(ath_father_name);
              $('[name="ath_email"]').val(ath_email);
              $('[name="ath_contact"]').val(ath_contact);
              $('[name="ath_dob"]').val(ath_dob);
              $('[name="ath_gender"]').val(ath_gender); 
              $('[name="ath_emergency_contact"]').val(ath_emergency_contact);
              $('[name="ath_profession"]').val(ath_profession);
              $('[name="ath_address"]').val(ath_address);
              $('.ath_profile_photo').attr('data-default-file','assets/images/athlete_images/'+ath_profile_photo);
              $('.ath_profile_photo').dropify();
              $('[name="old_password"]').val('');
              $('[name="password"]').val('');
              $('[name="confirm"]').val('');

            }
          }); 
        }  // end profile
          // update profile 
        $('.profile_add_form').submit(function(e){
              e.preventDefault(); 
              $('.update_button').prop("disabled", true);
              var formData = new FormData( $(".profile_add_form")[0] );

              $.ajax({
                          url:"<?php echo base_url(); ?>Athletes/update_profile_users",
                          type:"post",
                          data:formData,
                          processData:false,
                          contentType:false,
                          cache:false,
                          async:false,
                          success: function(response)
                          { 
                            $('.update_button').prop("disabled", false);
                              if(response == 'Record Update')
                              {
                                  user_profile_list();
                                  message(1,response);
                              }
                              else if(response == 'Please login now')
                              {
                                window.location.href = "Athletes/logout_user";
                              }
                              else
                              { 
                                message(0,response);
                              }
                          }
                      }); 
                      
          });

      });    
  </script>