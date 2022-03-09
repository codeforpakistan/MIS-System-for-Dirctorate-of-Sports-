<!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>List of Active Games</h4>
                  </div>
                  <?php $ath_id = $this->session->userdata('ath_id')?>
                  <div class="card-body">
                   
                   <?php if($this->session->userdata('user_role_id_fk')  == 5){?>
                  <button type="button" class="btn btn-primary pull-right fa fa-plus" data-toggle="modal" data-target="#addGameModel"> Add New Game</button>                

                  <button type="button" class="btn btn-primary pull-right fa fa-plus" data-toggle="modal" data-target="#addGameModel" style="margin-right: 4px;">Dublicate Card</button> 

                <?php }?>

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
                      <table class="table table-striped table-hover"  style="width:100%;">
                        <thead >
                          <tr>
                            <?php if($this->session->userdata('user_role_id_fk')  == 6){?>
                            <th>Nic Photo</th>
                            <th>Profile Photo</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Cnic</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>District</th>
                            <th>Profession</th>
                          <?php }?>
                          <th>Game</th>
                            <th>Game Time</th>
                            <th>Game Fee</th>
                            <th>Admission Fee</th>
                            <th>Payment Mode</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                            <tbody>
                              <?php if(!empty($athlete_games)):
                                foreach($athlete_games as $athlete_game):?>
                                  <tr>

                                    
                                    <td></td>
                                    <td></td>
                                    <td><?=$athlete_game->ath_name?></td>
                                    <td><?=$athlete_game->ath_father_name?></td>
                                    <td><?=$athlete_game->ath_cnic?></td>
                                    <td><?=$athlete_game->ath_address?></td>
                                    <td><?=$athlete_game->ath_contact?></td>
                                    <td><?=$athlete_game->district_name?></td>
                                    <td><?=$athlete_game->ath_profession?></td>
                                    <td><?=$athlete_game->game_name?></td>
                                    <td><?=$athlete_game->ath_game_time_preference?></td>
                                    <td><?=$athlete_game->game_fee?></td>
                                    <td><?=$athlete_game->game_admission_fee?></td>
                                    <td><?=$athlete_game->ath_payment_mode?></td>

                                    <?php if($athlete_game->ath_fee_status == 1){?>
                                    <td> <span class="badge badge-primary">Pending</span></td>
                                    <?php } elseif ($athlete_game->ath_fee_status == 2) {?>
                                    <td><span class="badge badge-success">Approve</span></td>
                                    <?php } elseif ($athlete_game->ath_fee_status == 3) {?>
                                    <td><span class="badge badge-danger">Rejcted</span></td>
                                    <?php }?>

                                    <td> 
                                      <?php if($this->session->userdata('user_role_id_fk')  == 6){?>

                                      <?php } else{?>

                                      <?php if($athlete_game->ath_fee_status == 1){?>
                                      <a href="javascript:void(0)" data-toggle="modal" data-target="#uploadModel" href="javascript:void(0)" class="btn btn-info  fa fa-upload" > Upload Challan</a>

                                      <a href="athletes/bank_challan/<?=$ath_id?>/<?=$athlete_game->ath_game_fee_id?>/challan" class="btn btn-success  fa fa-download"> Download Challan</a> 

                                      <?php } else{?>

                                        <?php if($athlete_game->fee_monthly_end_date < date('Y-m-d')){?>

                                         <a href="javascript:void(0)" data-toggle="modal" data-target="#feeModel" href="javascript:void(0)" class="btn btn-light pull-right fa fa-upload" style="float: left">Submit Fee</a>
                                    
                                      <?php } }  }?>  
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
                            <div class="col-6">
                            <div class="form-group">
                              <label>Game Applied For</label>
                                  <select class="form-control select2" id="game_id"  multiple="" name="game_id[]" style="width:100%">
                                    <option>-Select Games</option>
                                    <?php if(!empty($games)){
                                      foreach($games as $game){?>
                                    <option value="<?=$game->game_id?>"><?=$game->game_name?></option>
                                   <?php } }?>
                                  </select>
                            </div>
                          </div>
                        <input type="hidden" name="more_games" value="more_games">

                            <div class="col-6">
                            
                            <div class="form-group">
                                  <label>Time Prefernce</label>
                                  <select class="form-control" name="time_prefernce">
                                    <option>-Select Prefernce-</option>
                                    <option value="morning">Morning</option>
                                    <option value="evening">Evening</option>
                                  </select>
                            </div>
                          </div>

                            <div class="col-6">
                            
                            <div class="form-group">
                                  <label>Payment Mode</label>
                                  <select class="form-control" name="payment_mode">
                                    <option>-Select Payment Mode-</option>
                                    <option>Bank</option>
                                  </select>
                            </div>
                          </div>

                           <div class="col-6">
                            <div class="form-group">
                                  <label>Game Fee</label>
                                  <input type="number" class="form-control game_fee" placeholder="Total Fee" name="game_fee" id="game_fee"  required>
                            </div>
                            </div>

                            <div class="col-6">
                            <div class="form-group">
                                  <label>Admission Fee</label>
                                  <input type="number" class="form-control admission_fee" placeholder="Total Fee" name="admission_fee" id="admission_fee"  required>
                            </div>
                          </div>

                          <div class="col-6">

                            <div class="form-group">
                                  <label>Total Fee</label>
                                  <input type="number" class="form-control" placeholder="Total Fee" name="total_fee" id="total_fee"  required>
                            </div>
                          </div>
                            
                            <div class="col-6">
                            <div class="form-group">
                                  <label>Date of apply</label>
                                  <input type="date" class="form-control" placeholder="" name="date_of_apply" required>
                            </div>

                          </div>

                               <div class="col-12">
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
                        <form class="" method="post"  action="<?= base_url("athletes/add_athlete_challan") ?>" enctype="multipart/form-data">
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
                        <form class="" method="post"  action="<?= base_url("athletes/add_athlete_challan") ?>">

                                <div class="form-group">
                                  <label>Game</label>
                                  <input type="text" class="form-control" placeholder="" name="game_name" id="game" readonly="">
                                </div> 

                                 <div class="form-group">
                                  <label>Game Fee</label>
                                  <input type="text" class="form-control" placeholder="" name="game_name" id="game" readonly="">
                                </div> 

                                <div class="form-group">
                                        <label>Fee Type</label>
                                        <select class="form-control" name="payment_mode">
                                          <option>-Select Months-</option>
                                          <option>january</option>
                                          <option>Febraray</option>
                                        </select>
                                  </div>


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
                                  <input type="text" class="form-control" placeholder="" id="game_fee" name="game_fee" required>
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
  function get_id(ath_game_id,game_id){

    $('#ath_game_fee_id').val(ath_game_id);
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
             
             console.log(response);

             $('#game_fee').val(response.game_fee);
             $('#admission_fee').val(response.game_admission_fee);
             $('#total_fee').val(response.total_fee);
            }

          });
  });
});
 
</script>
      