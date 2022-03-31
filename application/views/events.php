
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
                  <button type="button" class="btn btn-primary pull-right fa fa-plus" data-toggle="modal" data-target="#addModel" style="margin-top:-5%;"> Add Event</button>
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
                            <th>Event Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Session</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                            <tbody>
                        <?php if(!empty($events)):

                             foreach($events as $onByOne):?>
                                <tr>
                                    <td><?=$onByOne->event_title?></td>
                                    <td><?= $onByOne->event_start_date?></td>
                                    <td><?= $onByOne->event_end_date?></td>
                                    <td><?= $onByOne->session?></td>

                                    <td>
                                       <a class="fa fa-edit text-info" data-toggle="modal" data-target="#editModel" href="javascript:void(0)" onclick="event_update(<?=$onByOne->event_id?>)"></a>

                                        <a class="fa fa-trash text-danger" onclick="return confirm('Are you sure to delete?')" href="<?= base_url('admin/event_delete/'.$onByOne->event_id) ?>"></a>
                                        
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
                    <h5 class="modal-title text-white" id="formModaladd">Add Event </h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?=base_url("admin/event_insert") ?>">
                            
                            <div class="form-group">
                                  <label>Event Name</label>
                                  <input type="text" class="form-control" placeholder="Event Name" name="event_name" required>
                                  
                                </div>

                                 <div class="form-group">
                                  <label>Event Game</label>
                                  <select name="game_id[]" class="form-control select2" style="width:100% !important" multiple required="">

                                    <?php  if(!empty($games)){
                                      foreach ($games as $game){?>
                                    <option value="<?=$game->game_id?>"><?=$game->game_name?></option>
                                  <?php } }?>
                                  </select>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Event Start Date</label>
                                  <input type="date" class="form-control" placeholder="Event Start Date" name="event_start_date" required>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Event End Date</label>
                                  <input type="date" class="form-control " placeholder="Event End Date" name="event_end_date" required>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Session</label>
                                  <input type="text" class="form-control" placeholder="Event Session" name="event_year" required>
                                  
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
                    <h5 class="modal-title text-white" id="formModaladd">Update Event </h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?= base_url("admin/event_update") ?>">
                            <div class="form-group">
                                  <label>Event Name</label>
                                  <input type="text" class="form-control" placeholder="Event Name" name="event_name" id="edit_event_title" required>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Event Game</label>
                                  <select name="game_id[]" class="form-control" id="edit_game_id" required="">
                                    <option>-Select Game-</option>

                                    <?php  if(!empty($games)){
                                      foreach ($games as $game){?>
                                    <option value="<?=$game->game_id?>"><?=$game->game_name?></option>
                                  <?php } }?>
                                  </select>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Event Start Date</label>
                                  <input type="date" class="form-control" placeholder="Event Start Date" name="event_start_date" id="edit_event_start_date" required>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Event End Date</label>
                                  <input type="date" class="form-control" id="edit_event_end_date" placeholder="Event End Date" name="event_end_date" required>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Session</label>
                                  <input type="text" class="form-control" id="edit_event_year" placeholder="Event Session" name="event_year" required>
                                  
                                </div>
                                <input type="hidden" name="event_id" id="edit_event_id" >
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
          function event_update(event_id){ 
          $.ajax({
            url: 'admin/get_ajax_event/'+event_id,
            dataType: 'json',
            success: function(response){
              $('#edit_event_title').val(response.event_title);
              $('#edit_game_id option[value='+response.game_id+']').attr('selected','selected'); 
              $('#edit_event_start_date').val(response.event_start_date); 
              $('#edit_event_year').val(response.session); 
              $('#edit_event_end_date').val(response.event_end_date); 
              $('#edit_event_id').val(event_id); 
            }
          });
        }
      </script>