
 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Active Cards</h4>
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
                      <table class="table table-striped table-hover" style="width:100%;">
                        <thead class="">
                          <tr>
                            <th>Card No</th>
                            <th>Card Fee</th>
                            <th>Card Status</th>
                            <th>Card Fee Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                            <tbody>
                        <?php if(!empty($dublicate_cards)):

                             foreach($dublicate_cards as $onByOne):?>
                                <tr>
                                    <td><?=$onByOne->ath_card_no?></td>
                                    <td><?=$onByOne->ath_card_fee?></td>

                                    <?php if($onByOne->ath_card_status == 1):?>
                                    <td> <span class="badge badge-danger">In-active</span></td>
                                    <?php elseif($onByOne->ath_card_status == 2):?>
                                    <td><span class="badge badge-primary">Active</span></td>

                                    <?php else:?>

                                      <td><span class="badge badge-danger">Expired</span></td>
                                    <?php endif;?>
                                    <td></td>

                                    <?php $get_game_fees = $this->model->get_dublicate_card_fees($onByOne->ath_game_id);

                                    ?>

                                    <?php if($onByOne->ath_card_status == 1){?>


                                    <td> <a href="athletes/bank_challan/<?=$onByOne->ath_id?>/<?=$get_game_fees->ath_game_fee_id?>/" class="btn btn-success  fa fa-download" target="_blank"> Generate Challan</a> 

                                      <a href="javascript:void(0)" data-toggle="modal" data-target="#uploadModel" href="javascript:void(0)" class="btn btn-info  fa fa-upload" onclick=" return get_id(<?=$get_game_fees->ath_game_fee_id?>)"> Upload Challan</a></td>

                                    <?php } else{?>


                                    <?php }?>

                                    
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        <?php endif; ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      
        <!-- add form -->
        