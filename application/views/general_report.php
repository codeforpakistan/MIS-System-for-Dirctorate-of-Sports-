






<!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-body">

          <form class="" method="post">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  
                  <div class="card-header">
                    <h2></h2>
                  </div>
                  <div class="card-body">
                      <div class="row">

                      <div class="col-3">
                            <div class="form-group">
                                  <label>From</label>
                                  <input type="date" class="form-control" name="from_date" value="<?=$from_date?>"  required>
                            </div>
                      </div>

                      <div class="col-3">
                            <div class="form-group">
                                  <label>To</label>
                                  <input type="date" class="form-control" name="to_date" value="<?=$to_date?>"  required>
                            </div>
                      </div>

                      <div class="col-3">
                            <div class="form-group">
                                  <label>Gender</label>
                                 <select class="form-control" name="gender" value="<?=$gender?>">
                                    <option disabled value="" selected hidden>---Select Gender---</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    
                                  </select>
                            </div>
                      </div>

                      <?php if($this->session->userdata('user_role_id_fk') == 6):?>

                       <div class="col-3">
                            <div class="form-group">
                                  <label>Facility</label>
                                 <select class="form-control select2" name="facility" value="<?=$facility?>">
                                    <option disabled value="" selected hidden>---Select facility---</option>

                                    <?php if(!empty($facilities)){foreach ($facilities as $facility) {?>
                                      
                                    <option value="<?=$facility->facility_id?>"><?=$facility->facility_name?></option>

                                  <?php } }?>
                                    
                                    
                                  </select>
                            </div>
                      </div>
                    <?php endif;?>

                      <div class="col-3">
                            <div class="form-group">
                                  <label>Membership Status</label>
                                 <select class="form-control" name="Membership_status" value="<?=$membership?>">
                                    <option disabled value="" selected hidden>---Select Membership status---</option>
                                    <option value="2">Active</option>
                                    <option value="1">In-active</option>
                                    <option value="4">Rejected</option>
                                    <option value="3">Expired</option>
                                    
                                  </select>
                            </div>
                      </div>

                      <div class="col-3">
                            <div class="form-group">
                                  <label>Fee Challan Status</label>
                                 <select class="form-control" name="fee_challan_status" value="<?=$fee_challan?>">
                                    <option disabled value="" selected hidden>---Select fee challan status---</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Approve</option>
                                    <option value="3">Rejected</option>
                                    <option value="4">Expired</option>
                                    
                                  </select>
                            </div>
                      </div>

                      <div class="col-3">
                            <div class="form-group">
                                  <label>Games</label>
                                 <select class="form-control select2" name="game" value="<?=$game?>">
                                    <option disabled value="" selected hidden>---Select Games---</option>
                                    <?php if(!empty($games)){foreach ($games as $game) {?>
                                    <option value="<?=$game->game_id?>"><?=$game->game_name?></option>
                                  <?php } }?>
                                  </select>
                            </div>
                      </div>
                      
                       <div class="col-3">
                            <div class="form-group mt-4">
                              <input type="submit" name="" class="btn btn-primary  pb-3" value="Search" style="font-weight: bolder;box-shadow: none" >

                            </div>
                        </div>

                        <div class="col-1"></div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>

        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?=$title?></h4>
                  </div>
                  <div class="card-body">
                  
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
                    
                    <div class="table-responsive">
                      <table class="table table-striped table-hover"  id="tableExport"  style="width:100%;">
                        <thead >
                          <tr>
                            <th>Profile Photo</th>
                            <th>Nic Photo</th>
                            <th>Student Certificate</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Cnic</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>District</th>
                            <th>Profession</th>
                            <th>Game</th>
                            <th>Game Time</th>
                            <th>Admission Fee</th>
                            <th>Game Fee</th>
                            <th>Payment Mode</th>
                            <th>Bank Challan</th>
                            <th>Game Status</th>
                            <th>Game fee Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                            <tbody>
                              <?php if(!empty($reports)):
                                foreach($reports as $report):?>
                                  <tr>
                                  <?php if(!empty($report->ath_profile_photo)){?>
                                    <td><a href="assets/images/athlete_images/<?=$report->ath_profile_photo?>"  target="_blank"><img src="assets/images/athlete_images/<?=$report->ath_profile_photo?>" style="height:50px;width:50px;"></a></td>
                                    <?php } else{?>

                                      <td></td>
                                    <?php }?>

                                    <?php if(!empty($report->ath_nic_photo)){?>
                                    <td><a href="assets/images/athlete_images/<?=$report->ath_nic_photo?>" target="_blank"><img src="assets/images/athlete_images/<?=$report->ath_nic_photo?>" style="height:50px;width:50px;"></a></td>
                                     <?php } else{?>

                                      <td></td>
                                    <?php }?>

                                     <?php if(!empty($report->certificate_pic)){?>
                                    <td><a href="assets/images/athlete_images/<?=$report->certificate_pic?>"  target="_blank"><img src="assets/images/athlete_images/<?=$report->certificate_pic?>" style="height:50px;width:50px;"></a></td>
                                     <?php } else{?>

                                      <td></td>
                                    <?php }?>
                                    <td><?=ucwords($report->ath_name)?></td>
                                    <td><?=ucwords($report->ath_father_name)?></td>
                                    <td><?=$report->ath_cnic?></td>
                                    <td><?=ucwords($report->ath_address)?></td>
                                    <td><?=$report->ath_contact?></td>
                                    <td><?=ucwords($report->district_name)?></td>
                                    <td><?=ucwords($report->ath_profession)?></td>
                                    <td><?=ucwords($report->game_name)?></td>
                                    <td><?=ucwords($report->ath_game_time_preference)?></td>
                                    <td><?=$report->game_admission_fee?></td>
                                    <td><?=$report->game_fee?></td>
                                    <td><?=ucwords($report->ath_payment_mode)?></td>
                                    <?php if($report->ath_upload_challan > 0){?>
                                    <td><img src="assets/images/challan/<?=$report->ath_upload_challan?>" style="height:50px;width:50px;"></td>
                                    
                                    <?php } else{?>
                                      <td></td>
                                    <?php }?>
                                     
                                     <td>
                                    <?php if($report->ath_game_status == 1){?>
                                    <span class="badge badge-primary">Pending</span>
                                    <?php } elseif ($report->ath_game_status == 2) {?>
                                    <span class="badge badge-success">Approve</span>
                                    <?php } elseif ($report->ath_game_status == 3) {?>
                                    <span class="badge badge-danger">Expired</span>

                                    <?php } elseif ($report->ath_game_status == 4) {?>
                                    <span class="badge badge-danger">Rejected</span>
                                    <?php }?>
                                  </td>

                                  <td>
                                    <?php if($report->ath_fee_status == 1){?>
                                    <span class="badge badge-primary">Pending</span>
                                    <?php } elseif ($report->ath_fee_status == 2) {?>
                                    <span class="badge badge-success">Approve</span>
                                    <?php } elseif ($report->ath_fee_status == 3) {?>
                                    <span class="badge badge-danger">Rejected</span>

                                    <?php } elseif ($report->ath_fee_status == 4) {?>
                                    <span class="badge badge-danger">Expired</span>
                                    <?php }?>
                                  </td>
                                    <td>
                                    
                                  </td> 

                                  </tr>
                                <?php  endforeach;endif;?>
                            </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
