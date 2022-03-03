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
                  <div class="card-body">
                  <button type="button" class="btn btn-primary pull-right fa fa-plus" data-toggle="modal" data-target="#addGameModel" style="margin-top:-5%;"> Add New Game</button>
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
                            <th>Game Name</th>
                            <th>Game Time</th>
                            <th>Game Fee</th>
                            <th>Payment Mode</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                            <tbody>
                              <?php if(!empty($athlete_games)):
                                foreach($athlete_games as $athlete_game):?>
                                  <tr>
                                    <td><?=$athlete_game->game_name?></td>
                                    <td><?=$athlete_game->ath_game_time_preference?></td>
                                    <td><?=$athlete_game->ath_game_fee?></td>
                                    <td><?=$athlete_game->ath_payment_mode?></td>
                                    <td><?=$athlete_game->ath_game_status?></td>
                                    <td>

                                      <?php if(empty($athlete_game->ath_game_fee_id > 0)){?>
                                       <a href="javascript:void(0)" data-toggle="modal" data-target="#feeModel" href="javascript:void(0)" class="btn btn-primary" onclick="return get_id(<?=$athlete_game->ath_game_id?>,<?=$athlete_game->game_id?>);">Submit Fee</a>
                                      <?php } else{?>

                                       <a href="athletes/bank_challan/<?=$athlete_game->ath_id?>/<?=$athlete_game->ath_game_id?>" class="btn btn-primary">Download Challan</a>

                                      <a href="javascript:void(0)" data-toggle="modal" data-target="#uploadModel" href="javascript:void(0)" class="btn btn-primary" onclick="return get_id(<?=$athlete_game->ath_game_id?>);">Upload Challan</a>
                                    <?php }?>
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
            <div class="modal-dialog" role="document">
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
                            <div class="form-group">
                              <label>Game Applied For</label>
                                  <select class="form-control select2" multiple="" name="game_id[]" style="width:100%">
                                    <option>-Select Games</option>
                                    <?php if(!empty($games)){
                                      foreach($games as $game){?>
                                    <option value="<?=$game->game_id?>"><?=$game->game_name?></option>
                                   <?php } }?>
                                  </select>
                            </div>

                        <input type="hidden" name="more_games" value="more_games">


                            <div class="form-group">
                                  <label>Time Prefernce</label>
                                  <select class="form-control" name="time_prefernce">
                                    <option>-Select Prefernce-</option>
                                    <option value="morning">Morning</option>
                                    <option value="evening">Evening</option>
                                  </select>
                            </div>

                            <div class="form-group">
                                  <label>Total Fee</label>
                                  <input type="text" class="form-control" placeholder="Total Fee" name="total_fee" required>
                            </div>
                            
                            <div class="form-group">
                                  <label>Date of apply</label>
                                  <input type="date" class="form-control" placeholder="" name="date_of_apply" required>
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
      