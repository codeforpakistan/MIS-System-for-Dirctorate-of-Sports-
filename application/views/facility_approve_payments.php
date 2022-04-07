
 <!-- Main Content -->
 <div class="main-content">
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
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead class="">
                          <tr>
                            <th>Profile Photo</th>
                            <th>Nic Photo</th>
                            <th>Student Certificate</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Cnic</th>
                            <th>Game </th>
                            <th>Challan No</th>
                            <th>Challan Admission fee</th>
                            <th>Challan Fee</th>
                            <th>Months</th> 
                            <th>Payment Mode</th>
                            <th>Status</th>
                            <th>Upload Challan</th>
                          </tr>
                        </thead>
                            <tbody>

                              <?php if(!empty($payments)){
                                foreach ($payments as $payment){?>

                              <tr>
                                <?php if(!empty($payment->ath_profile_photo)){?>
                                    <td><a href="assets/images/athlete_images/<?=$payment->ath_profile_photo?>"  target="_blank"><img src="assets/images/athlete_images/<?=$payment->ath_profile_photo?>" style="height:50px;width:50px;"></a></td>
                                    <?php } else{?>

                                      <td></td>
                                    <?php }?>

                                    <?php if(!empty($payment->ath_nic_photo)){?>
                                    <td><a href="assets/images/athlete_images/<?=$payment->ath_nic_photo?>" target="_blank"><img src="assets/images/athlete_images/<?=$payment->ath_nic_photo?>" style="height:50px;width:50px;"></a></td>
                                     <?php } else{?>

                                      <td></td>
                                    <?php }?>

                                     <?php if(!empty($payment->certificate_pic)){?>
                                    <td><a href="assets/images/athlete_images/<?=$payment->certificate_pic?>"  target="_blank"><img src="assets/images/athlete_images/<?=$payment->certificate_pic?>" style="height:50px;width:50px;"></a></td>
                                     <?php } else{?>

                                      <td></td>
                                    <?php }?>

                                    <td><?=$payment->ath_name?></td>
                                    <td><?=$payment->ath_father_name?></td>
                                    <td><?=$payment->ath_cnic?></td>
                                    <td><?= ucwords($payment->game_name)?></td>
                                    <td><?=$payment->ath_challan_no?></td>
                                    <td><?=$payment->ath_challan_admission_fee?></td>
                                    <td><?=$payment->ath_challan_fee?></td>
                                    <td><?=$payment->ath_fee_months?></td>
                                    <td><?=$payment->ath_payment_mode?></td>
                                    <?php if($payment->ath_fee_status == 1){?>
                                    <td> <span class="badge badge-primary">Pending</span></td>
                                    <?php } elseif ($payment->ath_fee_status == 2) {?>
                                    <td><span class="badge badge-success">Approve</span></td>
                                    <?php } elseif ($payment->ath_fee_status == 3) {?>
                                    <td><span class="badge badge-danger">Rejcted</span></td>
                                    <?php }?>

                                    <?php if($payment->ath_upload_challan > 0){?>

                                    <td><img src="assets/images/challan/<?=$payment->ath_upload_challan?>" style="height:50px;width:50px;"></td>

                                  <?php } else{?>
                                    <td></td>
                                  <?php }?>
                                    
                                  </tr>
                                  

                            <?php } }?>
                        
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
