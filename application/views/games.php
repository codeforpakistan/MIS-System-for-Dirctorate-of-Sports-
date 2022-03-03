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
                  <button type="button" class="btn btn-primary pull-right fa fa-plus" data-toggle="modal" data-target="#addModel" style="margin-top:-5%;"> Add Game</button>
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
                            <th>Games Name</th>
                            <th>Games Fee</th>
                            <th>Game Admission Fee</th>
                            <th>Games Description</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <?php if(!empty($games)):?>
                            <tbody>
                            <?php foreach($games as $onByOne):?>
                                <tr>
                                    <td><?= $onByOne->game_name?></td>
                                    <td><?= $onByOne->game_fee?></td>
                                    <td><?= $onByOne->game_admission_fee?></td>
                                    <td><?= $onByOne->game_description?></td>
                                    <td>
                                       <a class="fa fa-edit text-info" data-toggle="modal" data-target="#editModel" href="javascript:void(0)" onclick="game_update(<?= $onByOne->game_id ?>)"></a>

                                        <a class="fa fa-trash text-danger" onclick="return confirm('Are you sure to delete?')" href="<?= base_url('admin/game_delete/'.$onByOne->game_id) ?>"></a>
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
        <div class="modal fade" id="addModel"  role="dialog" aria-labelledby="formModaladd" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="formModaladd">Add Game </h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?=base_url("admin/game_insert") ?>">
                            
                            <div class="form-group">
                                  <label>Game Name</label>
                                  <input type="text" class="form-control" placeholder="Game Name" name="game_name" maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" required>
                                  
                                </div>

                                 <div class="form-group">
                                  <label>Game Fee</label>
                                  <input type="number" class="form-control" placeholder="Game Fee" name="game_fee" required>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Game Admission Fee</label>
                                  <input type="number" class="form-control" placeholder="Game Admission Fee" name="game_admission_fee" required>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Game Description</label>
                                  <input type="text" class="form-control" placeholder="Game Description" name="game_description" required>
                                  
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

        <!--- edit form -->
      <div class="modal fade" id="editModel"  role="dialog" aria-labelledby="formModaladd" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="formModaladd">Update Game </h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;<0/span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?= base_url("admin/game_update") ?>">
                            <div class="form-group">
                                  <label>Game Name</label>
                                  <input type="text" class="form-control" placeholder="Game Name" name="game_name" maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" id="edit_game_name" required>
                                  
                                </div>


                                 <div class="form-group">
                                  <label>Game Fee</label>
                                  <input type="number" class="form-control" placeholder="Game Fee" name="game_fee" id="edit_game_fee" required>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Game Admission Fee</label>
                                  <input type="number" class="form-control" placeholder="Game Admission Fee" name="game_admission_fee" id="edit_game_admission_fee" required>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Game Description</label>
                                  <input type="text" class="form-control" placeholder="Game Description" name="game_description" id="edit_game_description" required>
                                  
                                </div>
                                </div> -->
                                <input type="hidden" name="game_id" id="edit_game_id" >
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
          function game_update(game_id){ 

          $.ajax({
            url: 'admin/get_ajax_game/'+game_id,
            dataType: 'json',
            success: function(response){
              $('#edit_game_name').val(response.game_name);
              $('#edit_game_fee').val(response.game_fee);
              $('#edit_game_admission_fee').val(response.game_admission_fee);
              $('#edit_game_description').val(response.game_description);
              $('#edit_game_id').val(response.game_id); 
            }
          });
        }
      </script>