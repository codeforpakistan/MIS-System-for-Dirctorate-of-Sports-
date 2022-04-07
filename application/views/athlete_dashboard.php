

<style type="text/css">
  
  #blinking {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
</style>
<!-- start messages --->
    <?php if($this->session->userdata('user_role_id_fk')  == 6 || $this->session->userdata('user_role_id_fk')  == 7){?>

      <!-- Main Content -->
<div class="main-content">
<section class="section">
        <div class="row ">

          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row " >
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15"><strong>Pending MemberShips</strong></h5>

                           <?php  

                               $facility_id         = $this->session->userdata('facility_id'); 
                               $pending_memberships_count = count($this->model->get_status_memberships($facility_id,1));

                                ?>  
                          <h2 class="mb-3 font-18"><?=$pending_memberships_count?></h2>
                          <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 ">
                        <div class="banner-img">
                          <img src="assets/images/form.png" style="height:98px;">
                          <!-- <img src="assets/img/banner/1.png" alt=""> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row " >
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15"><strong>Approve MemberShips</strong></h5>

                          <?php  

                               $facility_id               = $this->session->userdata('facility_id'); 
                               $approve_memberships_count = count($this->model->get_status_memberships($facility_id,2));

                          ?>  

                          <h2 class="mb-3 font-18"><?=$approve_memberships_count?></h2>
                          <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0 " align="center">
                        <div class="banner-img">
                          <img src="assets/images/team.png" style="height: 98px;">
                          <!-- <img src="assets/img/banner/1.png" alt=""> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                           <?php 

                               $facility_id = $this->session->userdata('facility_id');
                                
                               $Rejected_facility_count = count($this->model->get_status_memberships($facility_id,4));


                                ?>  
                          <h5 class="font-15"><strong>Rejected Memberships</strong></h5>
                          <h2 class="mb-3 font-18"><?=$Rejected_facility_count?></h2>
                          <!-- <p class="mb-0"><span class="col-green">18%</span>Increase</p> -->
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                         <img src="assets/images/pending.png" style="height:98px;">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            


            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                           <?php 

                               $facility_id               = $this->session->userdata('facility_id'); 
                               $expired_memberships_count = count($this->model->get_status_memberships($facility_id,3));


                                ?>  
                          <h5 class="font-15"><strong>Expired Memberships</strong></h5>
                          <h2 class="mb-3 font-18"><?=$expired_memberships_count?></h2>
                          <!-- <p class="mb-0"><span class="col-green">18%</span>Increase</p> -->
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                         <img src="assets/images/pending.png" style="height:98px;">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">

                           <?php  


                               $facility_id         = $this->session->userdata('facility_id'); 
                               $approve_facility_count = count($this->model->get_approve_challans(null,$facility_id));

                                ?>  
                          <h5 class="font-15"><strong>Approve Challans</strong></h5>
                          <h2 class="mb-3 font-18"><?=$approve_facility_count?></h2>
                          <!-- <p class="mb-0"><span class="col-orange">09%</span> Decrease</p> -->
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                           <img src="assets/images/approve.png" style="height:98px;">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                           <?php 

                               $facility_id = $this->session->userdata('facility_id');
                                
                               $pending_facility_count = count($this->model->get_pending_challans($facility_id));


                                ?>  
                          <h5 class="font-15"><strong>Pending Challans</strong></h5>
                          <h2 class="mb-3 font-18"><?=$pending_facility_count?></h2>
                          <!-- <p class="mb-0"><span class="col-green">18%</span>Increase</p> -->
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                         <img src="assets/images/pending.png" style="height:98px;">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
          </div>
          <!-- :::::::::::::::::::::::: Second Row start  :::::::::::::::::::::::::::::::::::::::::::: -->

          <div class="section-body">
            <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                  <div class="card-header">
                    <h4><strong>Graph View By Facility</strong></h4>
                  </div>
                  <div class="card-body">
                    <div class="recent-report__chart">
                      <div id="chart1"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
</section>
</div>


<?php } else{?>

  <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <!-- start messages --->
          <div style="text-align: center" class="msg">
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
                  <div class="card-header">
                    <h4>Games</h4>
                  </div>
                  <div class="card-body">
                    <?php if($this->session->userdata('user_role_id_fk')  == 5){?>
                  <button type="button" class="btn btn-primary fa fa-plus" style="float: right" data-toggle="modal" data-target="#addGameModel"> Add New Game</button>               

                <?php }?>

                    <div class="table-responsive">
                      <table class="table table-striped table-hover"  style="width:100%;">
                        <thead >
                          <tr>
                            <th>Game Complex</th>
                            <th>Game</th>
                            <th>Game Fee</th>
                            <th>Admission Fee</th>
                            <th>Game Status</th>
                            <th>Remarks</th>
                            <th>Fee Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                            <tbody>
                              <?php if(!empty($athlete_games)):
                                foreach($athlete_games as $athlete_game):?>
                                  <tr>
                                    <td><?=$athlete_game->facility_name?></td>
                                    <td><?= ucwords($athlete_game->game_name)?></td>
                                    <td><?=$athlete_game->game_fee?></td>
                                    <td><?=$athlete_game->game_admission_fee?></td>
                                    <?php if($athlete_game->ath_game_status == 1):?>
                                    <td> <span class="badge badge-danger">In-active</span></td>
                                    <td></td>
                                    <?php elseif($athlete_game->ath_game_status == 2):?>
                                    <td><span class="badge badge-primary">Active</span></td>
                                    <td></td>
                                    <?php elseif($athlete_game->ath_game_status == 4):?>
                                    <td><span class="badge badge-danger">Rejected</span></td>
                                    <td>sasa</td>
                                    <?php endif;?>
                                    <?php $get_game_fees = $this->model->get_game_fees($athlete_game->ath_game_id);
                                    ?>

                                   <td><?php if($get_game_fees->ath_fee_status == 1){?>
                                   <span style="color: red;font-weight: bold">Payment Not Verified</span>  

                                   <?php } else{?>
                                    <span style="color: green;font-weight: bold">Payment Verified</span>
                                  <?php }?>
                                   </td>

                                    <td> 
                                      <?php 

                                      if($get_game_fees->fee_monthly_end_date < date('Y-m-d')){

                                      $expired_game=array('ath_game_status' => 3);
                                      $this->db->where('ath_id',$athlete_game->ath_id)->where('ath_game_status',$athlete_game->ath_game_status == 1)->update('athlete_games',$expired_game);

                                      $expired_game=array('ath_fee_status' => 4);

                                      $this->db->where('ath_game_fee_id',$get_game_fees->ath_game_fee_id)->where('ath_game_id',$athlete_game->ath_game_id)->where('ath_fee_status',1)->update('athlete_games_fees',$expired_game);

                                        ?>

                                        <a  href="javascript:void(0)" data-toggle="modal" data-target="#feeModel" class="btn btn-primary  fa fa-upload" onclick="get_ath_game_fee_id(<?=$athlete_game->game_fee?>,<?=$athlete_game->ath_game_id?>)" id="blinking">Submit Fee</a>

                                      <?php }  else{ ?>

                                        <?php if($get_game_fees->ath_fee_status ==1){?>

                                      <a href="athletes/bank_challan/<?=$athlete_game->ath_id?>/<?=$get_game_fees->ath_game_fee_id?>" class="btn btn-success  fa fa-download" target="_blank"> Generate Challan</a> 

                                      <a href="javascript:void(0)" data-toggle="modal" data-target="#uploadModel" href="javascript:void(0)" class="btn btn-info  fa fa-upload" onclick=" return get_id(<?=$get_game_fees->ath_game_fee_id?>)"> Upload Challan</a>

                                    <?php  }  }  ?>
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
     </div>
  </section>
</div>


 

<?php }?>

</div>
</div>
</div>
</div>
</div>
</section>
</div>

       <!--- edit form -->
      <div class="modal fade" id="addGameModel"  role="dialog" aria-labelledby="formModaladd" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document" style="width:40%">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="formModaladd">Add Game</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?= base_url("athletes/application_form") ?>">
                             
                          <div class="row">
                            <div class="col-md-6 col-sm-12 col-xm-12">
                            <div class="form-group">
                              <label>Game Applied For</label>
                              
                                  <select class="form-control select2" id="game_id"  multiple="" name="game_id[]" style="width:100%">
                                    <?php if(!empty($games)){
                                      foreach($games as $game){

                                      $ath_id = $this->session->userdata('ath_id');
                                      $data  = $this->db->select('game_id')->where('ath_id',$ath_id)->where('game_id',$game->game_id)->get('athlete_games')->row();
                                        if($data->game_id == $game->game_id):
                                        continue;
                                        endif;

                                        ?>
                                    <option value="<?=$game->game_id?>"><?=$game->game_name?></option>
                                   <?php } }?>
                                  </select>
                            </div>
                          </div>
                        <input type="hidden" name="more_games" value="more_games">

                        <div class="col-md-6 col-sm-12 col-xm-12">
                            <div class="form-group">
                                  <label>District</label>

                                  <select  class="form-control "  name="district_id" required>
                                   <option>--Select District--</option>

                                    <?php if(!empty($districts)){
                                      foreach ($districts as $district){?>
                                      ?>
                                    <option value="<?=$district->district_id?>"><?=$district->district_name?></option>

                                  <?php } }?>
                                  </select>
                            </div>
                      </div>

                         <div class="col-md-6 col-sm-12 col-xm-12">
                            <div class="form-group">
                                  <label>Game Complex</label>
                                   <select class="form-control  " id="facility_id"   name="facility_id">
                                    <option  disabled value="" selected hidden>---Select Complex---</option>
                                    <?php if(!empty($facilities)){
                                      foreach($facilities as $facility){?>
                                    <option value="<?=$facility->facility_id?>"><?=$facility->facility_name?></option>
                                   <?php } }?>
                                  </select>
                            </div>
                      </div>

                            <div class="col-md-6 col-sm-12 col-xm-12">
                            
                            <div class="form-group">
                                  <label>Time Prefernce</label>
                                  <select class="form-control" name="time_prefernce">
                                    <option  disabled value="" selected hidden>---Select Prefernce---</option>
                                    <option value="morning">Morning</option>
                                    <option value="evening">Evening</option>
                                  </select>
                            </div>
                          </div>

                            <div class="col-md-6 col-sm-12 col-xm-12">
                            
                            <div class="form-group">
                                  <label>Payment Mode</label>
                                  <select class="form-control" name="payment_mode">
                                    <option  disabled value="" selected hidden>---Select Payment Mode---</option>
                                    <option>Bank</option>
                                  </select>
                            </div>
                          </div>

                           <div class="col-md-6 col-sm-12 col-xm-12">
                            <div class="form-group">
                                  <label>Game Fee</label>
                                  <input type="number" class="form-control game_fee" placeholder="Total Fee" name="game_fee" id="game_fee"  required>
                            </div>
                            </div>

                            <div class="col-md-6 col-sm-12 col-xm-12">
                            <div class="form-group">
                                  <label>Admission Fee</label>
                                  <input type="number" class="form-control admission_fee" placeholder="Total Fee" name="admission_fee" id="admission_fee"  required>
                            </div>
                          </div>

                          <div class="col-md-6 col-sm-12 col-xm-12">

                            <div class="form-group">
                                  <label>Total Fee</label>
                                  <input type="number" class="form-control" placeholder="Total Fee" name="total_fee" id="total_fee"  required>
                            </div>
                          </div>
                          
                               <div class="col-md-6 col-sm-12 col-xm-12">
                                <div class="form-group pull-right">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect pull-right" >Save</button>
                              </div>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- add game modal--->

        <!--- edit form -->
      <div class="modal fade" id="uploadModel"  role="dialog" aria-labelledby="formModaladd" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="formModaladd">Upload Challan </h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post"  action="<?= base_url("athletes/upload_challan") ?>" enctype="multipart/form-data">
                          <input type="hidden" name="ath_game_fee_id" id="ath_game_fee_id" >
                            <div class="form-group">
                                  <label>Attach Challan Picture</label>
                                  <input type="file" class="form-control" placeholder="" name="Upload_challan" required>
                            </div>

                                <div class="form-group">
                                  <label>Challan No</label>
                                  <input type="text" class="form-control" placeholder="" name="challan_no" required>
                                  
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

         <div class="modal fade" id="feeModel"  role="dialog" aria-labelledby="formModaladd" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="formModaladd">Submit Fee</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post"  action="<?= base_url("athletes/submit_monthly_fee") ?>">
                                  <div class="form-group">

                                    <input type="hidden" name="ath_game_id" id="ath_game_id">
                                        <label>Fee months</label>

                                        <select class="form-control" name="fee_months" id="fee_month">
                                          <option value="">Select Month</option>
                                          <option>1 Month</option>
                                          <option>2 Month</option>
                                          <option>3 Month</option>
                                          <option>4 Month</option>
                                          <option>5 Month</option>
                                          <option>6 Month</option>
                                          <option>7 Month</option>
                                          <option>8 Month</option>
                                          <option>9 Month</option>
                                          <option>10 Month</option>
                                          <option>11 Month</option>
                                          <option>12 Month</option>
                                        </select>
                                      
                                  </div>

                                  <input type="hidden" class="game_fee">


                                  <div class="form-group">
                                        <label>Payment Mode</label>
                                        <select class="form-control" name="payment_mode">
                                          <option>-Select Payment Mode-</option>
                                          <option>Bank</option>
                                          <option>Easypaisa</option>
                                        </select>
                                  </div>

                                <div class="form-group">
                                  <label>Total Fee</label>
                                  <input type="text" class="form-control" placeholder="" id="total_game_fee" name="total_game_fee" required>
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

        <div class="modal fade" id="change_status"  role="dialog" aria-labelledby="formModaladd" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="formModaladd">Submit Fee</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post"  action="<?= base_url("athletes/submit_monthly_fee") ?>">
                                  <div class="form-group">

                                    <input type="hidden" name="ath_game_id" id="ath_game_id">
                                        <label>Fee months</label>

                                        <select class="form-control" name="fee_months" id="fee_month">
                                          <option value="">Select Month</option>
                                          <option>1 Month</option>
                                          <option>2 Month</option>
                                          <option>3 Month</option>
                                          <option>4 Month</option>
                                          <option>5 Month</option>
                                          <option>6 Month</option>
                                          <option>7 Month</option>
                                          <option>8 Month</option>
                                          <option>9 Month</option>
                                          <option>10 Month</option>
                                          <option>11 Month</option>
                                          <option>12 Month</option>
                                        </select>
                                      
                                  </div>

                                  <input type="hidden" class="game_fee">


                                  <div class="form-group">
                                        <label>Payment Mode</label>
                                        <select class="form-control" name="payment_mode">
                                          <option>-Select Payment Mode-</option>
                                          <option>Bank</option>
                                          <option>Easypaisa</option>
                                        </select>
                                  </div>

                                <div class="form-group">
                                  <label>Total Fee</label>
                                  <input type="text" class="form-control" placeholder="" id="total_game_fee" name="total_game_fee" required>
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

  $(document).on('change','#fee_month',function(){
     var fee_month = $(this).val();
     var game_fee  = $(".game_fee").val();
     var total_fee = parseInt(fee_month)*parseInt(game_fee); 
     $('#total_game_fee').val(total_fee);

  });

  function get_ath_game_fee_id(game_fee,ath_game_id){

    $('.game_fee').val(game_fee);
    $('#ath_game_id').val(ath_game_id);
  }

  function get_id(ath_game_fee_id){
    $('#ath_game_fee_id').val(ath_game_fee_id);
  }

  function activate_deactivate($status){

    if($status == 1){
      alert('Are You sure want deactivate game');
    }
    else{

      alert('Are you sure want activate game');
    }


   }
</script>


<script>
$(document).ready(function(){

   $(document).on('change','#game_id',function(){
    var game_id = $(this).val();
      $('#game_fee').val(0);
      $('#admission_fee').val(0);
      $('#total_fee').val(0);

     $.ajax({
            url: '<?=base_url()?>Athletes/get_ajax_multiple_game',
            dataType: 'json',
            type:"post",
            data:{game_id:game_id},
            success: function(response){
             $('#game_fee').val(response.game_fee);
             $('#admission_fee').val(response.game_admission_fee);
             $('#total_fee').val(response.total_fee);
            }

          });
  });

   $('#blinking').toogle();
   

});
 
</script>

 

      