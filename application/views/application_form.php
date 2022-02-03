     <!-- Main Content -->
      <div class="main-content">
        <section class="section">
<!-- start messages --->
          <div style="text-align: center">
                  <?php if($feedback =$this->session->flashdata('feedback')){
                    $feedback_class =$this->session->flashdata('feedbase_class');  ?>
                        <div class="row">
                          <div class="col-md-6 col-md-offset-6 msg">
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
      <div class="section-body">
         <form class="" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <h2><span style="padding: 0px 10px;border-radius:0px 0px 20px 0px;" class="bg-success text-white">Profile Info</span></h2>
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                      <div class="row">

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" class="form-control" placeholder="Name" name="name" value="<?=$athlete['ath_name']?>"  maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" required>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Father Name</label>
                                  <input type="text" class="form-control" placeholder="Father Name" name="f_name"  maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" required>
                            </div>
                          </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>CNIC No</label>
                                  <input type="text" class="form-control" placeholder="CNIC No" name="cnic" data-inputmask="'mask': '99999-9999999-9'" required minlength="15" maxlength="15" required>
                            </div>
                      </div>

                    

                       <div class="col-4">
                            <div class="form-group">
                                  <label>Date of Birth</label>
                                  <input type="date" class="form-control datepicker" placeholder="Date of Birth" name="dob" required>
                            </div>
                      </div>

                       <div class="col-4">
                            <div class="form-group">
                                  <label>Address</label>
                                  <input type="text" class="form-control" placeholder="Address" name="address" required>
                            </div>
                      </div>


                       <div class="col-4">
                            <div class="form-group">
                                  <label>Contact</label>
                                  <input type="text" class="form-control" placeholder="Contact" name="contact" value="<?=$athlete['ath_contact']?>" required>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Gender</label>
                                 <select class="form-control" name="gender">
                                    <option>-Select Gender-</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    
                                  </select>
                            </div>
                      </div>

                       <div class="col-4">
                            <div class="form-group">
                                  <label>Emergency Contact</label>
                                  <input type="text" class="form-control" placeholder="Emergency Contact" name="emergency_contact" required>
                            </div>
                      </div>


                       <div class="col-4">
                            <div class="form-group">
                                  <label>Profession</label>
                                 <select class="form-control" name="profession">
                                    <option>-Select Profession-</option>
                                    <option value="student">Student</option>
                                    <option value="player">Player</option>
                                    
                                  </select>
                            </div>
                      </div>

                       <div class="col-4">
                            <div class="form-group">
                                  <label>Attach Profile Picture</label>
                                  <input type="file" class="form-control" placeholder="profile_picture" name="profile_pic" required>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Attach NIC Front Photocopy</label>
                                  <input type="file" class="form-control" placeholder="" name="cnic_front_copy" required>
                            </div>
                      </div>
              </div>
            </div>
          </div>
        </div> 
      </div>

        <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <h2><span style="padding: 0px 10px;border-radius:0px 0px 20px 0px;" class="bg-success text-white">Game Info</span></h2>
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                      <div class="row">

                    

                      <div class="col-12">
                            <div class="form-group">
                              <label>Game Applied For</label>
                                  <select class="form-control select2" multiple="" name="game_id[]">
                                    <option>-Select Games</option>
                                    <?php if(!empty($games)){
                                      foreach($games as $game){?>
                                    <option value="<?=$game->game_id?>"><?=$game->game_name?></option>
                                   <?php } }?>
                                  </select>
                            </div>
                    </div>  

                       

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Time Prefernce</label>
                                  <select class="form-control" name="time_prefernce">
                                    <option>-Select Prefernce-</option>
                                    <option value="morning">Morning</option>
                                    <option value="evening">Evening</option>
                                  </select>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Total Fee</label>
                                  <input type="text" class="form-control" placeholder="Total Fee" name="total_fee" required>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Payment Mode</label>
                                  <select class="form-control" name="payment_mode">
                                    <option>-Select Payment Mode-</option>
                                    <option>online</option>
                                    <option>easypaisa</option>
                                    <option>Bank</option>
                                  </select>
                            </div>
                      </div>

                       <div class="col-4">
                            <div class="form-group">
                                  <label>Date of apply</label>
                                  <input type="date" class="form-control" placeholder="" name="date_of_apply" required>
                            </div>
                      </div>

                    </div>

                       <div class="col-12">
                        <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect pull-right" >Save</button>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div> 

        


      </form>                
    </div>
  </div>


               <script>

                $(document).ready(function(){

                 $(".datepicker" ).datepicker();




                });
                 
               </script>