
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
                      <table class="table table-striped table-hover" style="width:100%;">
                        <thead class="">
                          <tr>
                            <th>Dulicate Card Fee</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                            <tbody>
                        <?php if(!empty($cards)):

                             foreach($cards as $onByOne):?>
                                <tr>
                                    <td><?=$onByOne->card_fee?></td>
                                    <td>
                                       <a class="fa fa-edit text-info" data-toggle="modal" data-target="#editModel" href="javascript:void(0)" onclick="event_update(<?=$onByOne->card_id?>)"></a>
                                        
                                    </td>
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
        

        <!--- edit form -->
      <div class="modal fade" id="editModel"  role="dialog" aria-labelledby="formModaladd" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="formModaladd">Update Event </h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?= base_url("athletes/card_update") ?>">
                            <div class="form-group">
                                  <label>Card Fee</label>
                                  <input type="text" class="form-control" placeholder="Card Fee" name="card_fee" id="edit_card_fee" required>
                                  
                                </div>

                                </div>
                                <input type="hidden" name="card_id" id="edit_card_id" >
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
       
      <script>
          function event_update(card_id){ 
          $.ajax({
            url: 'athletes/get_ajax_card/'+card_id,
            dataType: 'json',
            success: function(response){
              $('#edit_card_fee').val(response.card_fee);
              $('#edit_card_id').val(card_id); 
            }
          });
        }
      </script>