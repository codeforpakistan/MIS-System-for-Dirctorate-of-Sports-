      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <h4 class="bg-success text-white" ><?=$title?></h4>
                  <div class="card-header">

                  </div>
                  <div class="card-body">

                    <form class="" method="post">
                      <div class="row">

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" class="form-control" placeholder="Name" name="name" required>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Father Name</label>
                                  <input type="text" class="form-control" placeholder="Name" name="f_name" required>
                            </div>
                          </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>CNIC No</label>
                                  <input type="text" class="form-control" placeholder="CNIC No" name="cnic" required>
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
                                  <input type="text" class="form-control" placeholder="Contact" name="contact" required>
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
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    
                                  </select>
                            </div>
                      </div>


                       <div class="col-4">
                            <div class="form-group">
                                  <label>Date of apply</label>
                                  <input type="date" class="form-control" placeholder="" name="date_of_apply" required>
                            </div>
                      </div>

                      <div class="col-12">
                            <div class="form-group">
                              <label>Game Applied For</label>
                                  <select class="form-control select2" multiple="" name="game_id">
                                   
                                  </select>
                            </div>
                    </div>  

                       <div class="col-4">
                            <div class="form-group">
                                  <label>Attach NIC Front Photocopy</label>
                                  <input type="file" class="form-control" placeholder="" name="cnic_front_copy" required>
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
                    </div>

                       <div class="col-12">
                        <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect pull-right" >Save</button>
                      </div>
                    </div>
                               
                        </form>
                                    
                  </div>
                </div>
               </div>


               <script>

                $(document).ready(function(){

                 $(".datepicker" ).datepicker();




                });
                 
               </script>