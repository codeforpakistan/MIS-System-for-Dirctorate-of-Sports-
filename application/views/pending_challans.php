    <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Pending Challans</h4>
                  </div>
                  <?php $ath_id = $this->session->userdata('ath_id')?>
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
                      <table class="table table-striped table-hover" id="tableExport"  style="width:100%;">
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
                            <th>Game Fee</th>
                            <th>Admission Fee</th>
                            <th>Payment Mode</th>
                            <th>Bank Challan</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                            <tbody>
                              <?php if(!empty($pending_challans)):
                                foreach($pending_challans as $pending_challan):?>
                                  <tr>

                                    <?php if(!empty($pending_challan->ath_profile_photo)){?>
                                    <td><a href="assets/images/athlete_images/<?=$pending_challan->ath_profile_photo?>"  target="_blank"><img src="assets/images/athlete_images/<?=$pending_challan->ath_profile_photo?>" style="height:50px;width:50px;"></a></td>
                                    <?php } else{?>

                                      <td></td>
                                    <?php }?>

                                    <?php if(!empty($pending_challan->ath_nic_photo)){?>
                                    <td><a href="assets/images/athlete_images/<?=$pending_challan->ath_nic_photo?>" target="_blank"><img src="assets/images/athlete_images/<?=$pending_challan->ath_nic_photo?>" style="height:50px;width:50px;"></a></td>
                                     <?php } else{?>

                                      <td></td>
                                    <?php }?>

                                     <?php if(!empty($pending_challan->certificate_pic)){?>
                                    <td><a href="assets/images/athlete_images/<?=$pending_challan->certificate_pic?>"  target="_blank"><img src="assets/images/athlete_images/<?=$pending_challan->certificate_pic?>" style="height:50px;width:50px;"></a></td>
                                     <?php } else{?>

                                      <td></td>
                                    <?php }?>

                                    <td><?=$pending_challan->ath_name?></td>
                                    <td><?=$pending_challan->ath_father_name?></td>
                                    <td><?=$pending_challan->ath_cnic?></td>
                                    <td><?=$pending_challan->ath_address?></td>
                                    <td><?=$pending_challan->ath_contact?></td>
                                    <td><?=$pending_challan->district_name?></td>
                                    <td><?=$pending_challan->ath_profession?></td>
                                    <td><?=$pending_challan->game_name?></td>
                                    <td><?=$pending_challan->ath_game_time_preference?></td>
                                    <td><?=$pending_challan->game_fee?></td>
                                    <td><?=$pending_challan->game_admission_fee?></td>
                                    <td><?=$pending_challan->ath_payment_mode?></td>
                                    <?php if($pending_challan->ath_upload_challan > 0){?>
                                    <td><img src="assets/images/challan/<?=$pending_challan->ath_upload_challan?>" style="height:50px;width:50px;"></td>
                                    
                                    <?php } else{?>
                                      <td></td>
                                    <?php }?>
                                     
                                     <td>
                                    <?php if($pending_challan->ath_fee_status == 1){?>
                                    <span class="badge badge-primary">Pending</span>
                                    <?php } elseif ($pending_challan->ath_fee_status == 2) {?>
                                    <span class="badge badge-success">Approve</span>
                                    <?php } elseif ($pending_challan->ath_fee_status == 3) {?>
                                    <span class="badge badge-danger">Rejcted</span>
                                    <?php }?>
                                  </td>

                                
                                    <td>
                                    <div class="dropdown">
                                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Change Status
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="width: 10%;text-align: center;color:#000 !important;">
                                        <li><a href="athletes/change_fee_satus/<?=$pending_challan->ath_game_id?>/<?=$pending_challan->ath_game_fee_id?>/2/<?=$pending_challan->ath_game_status?>" style="color:#000;text-decoration: none;">Approve</a></li>
                                        <li><a href="athletes/change_fee_satus/<?=$pending_challan->ath_game_id?>/<?=$pending_challan->ath_game_fee_id?>/3/<?=$pending_challan->ath_game_status?>" style="color:#000;text-decoration: none;">Rejected</a></li> 
                                      </ul>
                                    </div>
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