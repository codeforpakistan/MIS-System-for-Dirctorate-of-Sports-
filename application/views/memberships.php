    <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>membership</h4>
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
                      <table class="table table-striped table-hover"  id="tableExport"  style="width:100%;">
                        <thead >
                          <tr>
                            <th>Profile Photo</th>
                            <th>Nic Photo</th>
                            <th>Student Certificate</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <!-- <th>Cnic</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>District</th> -->
                            <th>Profession</th>
                            <th>Game</th>
                            <th>Game Time</th>
                            <th>Admission Fee</th>
                            <th>Game Fee</th>
                            <th>Payment Mode</th>
                            <th>Bank Challan</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                            <tbody>
                              <?php if(!empty($memberships)):
                                foreach($memberships as $membership):?>
                                  <tr>
                                  <?php if(!empty($membership->ath_profile_photo)){?>
                                    <td><a href="assets/images/athlete_images/<?=$membership->ath_profile_photo?>"  target="_blank"><img src="assets/images/athlete_images/<?=$membership->ath_profile_photo?>" style="height:50px;width:50px;"></a></td>
                                    <?php } else{?>

                                      <td></td>
                                    <?php }?>

                                    <?php if(!empty($membership->ath_nic_photo)){?>
                                    <td><a href="assets/images/athlete_images/<?=$membership->ath_nic_photo?>" target="_blank"><img src="assets/images/athlete_images/<?=$membership->ath_nic_photo?>" style="height:50px;width:50px;"></a></td>
                                     <?php } else{?>

                                      <td></td>
                                    <?php }?>

                                     <?php if(!empty($membership->certificate_pic)){?>
                                    <td><a href="assets/images/athlete_images/<?=$membership->certificate_pic?>"  target="_blank"><img src="assets/images/athlete_images/<?=$membership->certificate_pic?>" style="height:50px;width:50px;"></a></td>
                                     <?php } else{?>

                                      <td></td>
                                    <?php }?>
                                    <td><?=$membership->ath_name?></td>
                                    <td><?=$membership->ath_father_name?></td>
                                    <!-- <td><?=$membership->ath_cnic?></td> -->
                                    <!-- <td><?=$membership->ath_address?></td>
                                    <td><?=$membership->ath_contact?></td>
                                    <td><?=$membership->district_name?></td> -->
                                    <td><?=$membership->ath_profession?></td>
                                    <td><?=$membership->game_name?></td>
                                    <td><?=$membership->ath_game_time_preference?></td>
                                    <td><?=$membership->game_admission_fee?></td>
                                    <td><?=$membership->game_fee?></td>
                                    <td><?=$membership->ath_payment_mode?></td>
                                    <?php if($membership->ath_upload_challan > 0){?>
                                    <td><img src="assets/images/challan/<?=$membership->ath_upload_challan?>" style="height:50px;width:50px;"></td>
                                    
                                    <?php } else{?>
                                      <td></td>
                                    <?php }?>
                                     
                                     <td>
                                    <?php if($membership->ath_game_status == 1){?>
                                    <span class="badge badge-primary">Pending</span>
                                    <?php } elseif ($membership->ath_game_status == 2) {?>
                                    <span class="badge badge-success">Approve</span>
                                    <?php } elseif ($membership->ath_game_status == 3) {?>
                                    <span class="badge badge-danger">Expired</span>

                                    <?php } elseif ($membership->ath_game_status == 4) {?>
                                    <span class="badge badge-danger">Rejected</span>
                                    <?php }?>
                                  </td>
                                    <td>
                                    <div class="dropdown">
                                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Change Status
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="width: 10%;text-align: center;color:#000 !important;">

                                        <li><a href="athletes/change_fee_satus/<?=$membership->ath_game_id?>/<?=$membership->ath_game_fee_id?>/2/<?=$membership->ath_card_id?>" style="color:#000;text-decoration: none;"onclick="return confirm('Are you sure you want to approve this membership?')">Approve</a></li>

                                        <li><a  href="javascript:void(0)" data-toggle="modal" data-target="#change_status" onclick="get_ath_game_fee_id(<?=$membership->ath_game_id?>,<?=$membership->ath_card_id?>,4)" style="color:#000;text-decoration: none;">Rejected</a></li> 

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

<div class="modal fade" id="change_status"  role="dialog" aria-labelledby="formModaladd" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="formModaladd">Remarks</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post"  action="<?= base_url("athletes/change_game_satus") ?>">

                          <input type="hidden" name="ath_game_id" id="ath_game_id">
                          <input type="hidden" name="status" id="status">
                          <input type="hidden" name="ath_card_id" id="ath_card_id">
                                 
                                  <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea name="ath_game_remarks" class="form-control" placeholder="Enter remarks "></textarea>
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
        </div>

<script>
  $(document).ready(function(){

    $('#approve').alert("Are You sure you want to approve this membership");


  });
  
 function get_ath_game_fee_id(ath_game_id,ath_card_id,status){




    $('#ath_game_id').val(ath_game_id);
    $('#ath_card_id').val(ath_card_id);
    $('#status').val(status);
  }

</script>
