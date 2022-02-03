<!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Applied Games</h4>
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
                      <table class="table table-striped table-hover"  style="width:100%;">
                        <thead >
                          <tr>
                            <th>Game Name</th>
                            <th>Game Fee</th>
                            <th>Game Time</th>
                            <th>Payment Mode</th>
                            <th>Game Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                            <tbody>

                              <?php if(!empty($athlete_games)):
                                foreach($athlete_games as $athlete_game):?>
                                  <tr>
                                    <td><?=$athlete_game->game_name?></td>
                                    <td><?=$athlete_game->game_fee?></td>
                                    <td><?=$athlete_game->ath_game_time_preference?></td>
                                    <td><?=$athlete_game->ath_game_payment_mode?></td>
                                    <td><?=$athlete_game->ath_game_status?></td>
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

      