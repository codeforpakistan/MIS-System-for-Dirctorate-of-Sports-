 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?= $title ?></h4>
                  </div>
                  <div class="card-body">
                  <button type="button" class="btn btn-primary pull-right fa fa-plus" data-toggle="modal" data-target="#addModel" style="margin-top:-5%;"> Add Event Trial</button>
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
                            <th>Event</th>
                            <th>Trial</th>
                            <th>Game</th>
                            <th>Maximum players</th>
                            <th>Officials</th>
                            <th>Facilities</th>
                            <th>Session</th>
                            <th>Trial Start Date</th>
                            <th>Trial End Date</th>
                            <th>Closing Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <?php if(!empty($events_trials)):?>
                            <tbody>
                            <?php foreach($events_trials as $onByOne):?>
                                <tr>
                                    <td><?= ucwords($onByOne->event_title)?></td>
                                    <td><?= ucwords($onByOne->trial_name)?></td>
                                    <td><?= ucwords($onByOne->game_name)?></td>
                                    <td><?= $onByOne->max_players?></td>
                                    <td><?= ucwords($onByOne->officials)?></td>
                                    <td><?= ucwords($onByOne->facilities)?></td>
                                    <td><?= $onByOne->trial_session?></td>
                                    <td><?= $onByOne->trial_start_date?></td>
                                    <td><?= $onByOne->trial_end_date?></td>
                                    <td><?= $onByOne->closing_date?></td>
                                    <td>
                                       <a class="fa fa-edit text-info" data-toggle="modal" data-target="#editModel" href="javascript:void(0)" onclick="trial_update(<?=$onByOne->event_trial_id?>)"></a>

                                        <a class="fa fa-trash text-danger" onclick="return confirm('Are you sure to delete?')" href="<?= base_url('admin/trial_delete/'.$onByOne->event_trial_id) ?>"></a>
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


       <!-- Large modal add-->
        <div class="modal fade bd-example-modal-lg" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="myLargeModalLabel">Add Event Trial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

                  <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?=base_url("admin/trial_insert")?>">
                          <div class="row">
                            <div class="col-6">
                            <div class="form-group">
                                <label>Trial Name</label>
                                <input type="text" class="form-control" placeholder="Trial Name" name="trial_name"  required>        
                                </div>
                              </div>
                            <div class="col-6">


                            <div class="form-group">
                                  <label>Event Name</label>
                                  <select  name="event_id"  class="form-control event_id">      
                                    <option>Select event</option>
                                    <?php if(!empty($events)):
                                      foreach($events as $event):?>
                                    <option value="<?=$event->event_id?>"><?=$event->event_title?></option>
                                  <?php endforeach;endif;?>
                                  </select>    
                                </div>
                              </div>

                            <div class="col-6">
                                <div class="form-group">
                                  <label>Event Games</label>
                                  <select  name="game_id" class="form-control game_id" >      
                                    <option>Select Game</option>  
                                  </select>
                                </div>
                              </div>
                            <div class="col-6">


                                <div class="form-group">
                                  <label>Maximum players</label>
                                  <input type="text" class="form-control" placeholder="Maximum Palyers" name="max_players" required>
                                  
                                </div>
                              </div>
                            <div class="col-6">


                                <div class="form-group">
                                  <label>Officials</label>
                                  <input type="text" class="form-control" placeholder="Officials" name="officials" required>
                                </div>
                              </div>

                            <div class="col-6">


                                <div class="form-group">
                                  <label>venue</label>
                                  <input type="text" class="form-control" placeholder="Facility" name="facilities" required>
                                 
                                  
                                </div>
                              </div>
                            <div class="col-6">


                                <div class="form-group">
                                  <label>Session</label>
                                  <input type="text" class="form-control" placeholder="Session" name="session" required>
                                  
                                </div>
                              </div>
                            <div class="col-6">




                                <div class="form-group">
                                  <label>Trial Start Date</label>
                                  <input type="date" class="form-control" placeholder="Trial Start Date" name="trial_start_date" required>
                                  
                                </div>
                              </div>
                            <div class="col-6">


                                <div class="form-group">
                                  <label>Trial End Date</label>
                                  <input type="date" class="form-control " placeholder="Trial End Date" name="trial_end_date" required>
                                  
                                </div>
                              </div>
                            <div class="col-6">
                                <div class="form-group">
                                  <label>Closing Date</label>
                                  <input type="date" class="form-control " placeholder="Closing Date" name="closing_date" required>
                                </div>
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
        </div>


     <!-- Large modal edit -->
        <div class="modal fade bd-example-modal-lg" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-success">
                <h5 class="modal-title  text-white" id="myLargeModalLabel">Update Event Trial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

                  <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?=base_url("admin/trial_update")?>">

                          <div class="row">

                            <div class="col-6">

                              <input type="hidden" name="edit_trial_id" id="edit_trial_id">
                            
                            <div class="form-group">
                                  <label>Trial Name</label>
                                  <input type="text" class="form-control" placeholder="Trial Name" name="trial_name" id="edit_trial_name" required>
                                  
                                </div>
                              </div>
                            <div class="col-6">


                            <div class="form-group">
                                  <label>Event Name</label>
                                  <select  name="event_id"  class="form-control event_id" id="edit_event_id">      
                                    <option>Select event</option>
                                    <?php if(!empty($events)):
                                      foreach($events as $event):?>
                                    <option value="<?=$event->event_id?>"><?=$event->event_title?></option>
                                  <?php endforeach;endif;?>
                                  </select>
                                  
                                </div>
                              </div>
                            <div class="col-6">


                                <div class="form-group">
                                  <label>Event Games</label>
                                  <select  name="game_id" class="form-control game_id" id="edit_game_id" >      
                                    <option>Select Game</option>
                                    
                                  </select>
                                  
                                </div>
                              </div>
                            <div class="col-6">


                                <div class="form-group">
                                  <label>Maximum players</label>
                                  <input type="text" class="form-control" placeholder="Maximum Palyers" id="edit_max_players" name="max_players" required>
                                  
                                </div>
                              </div>
                            <div class="col-6">


                                <div class="form-group">
                                  <label>Officials</label>
                                  <input type="text" class="form-control" placeholder="Officials" id="edit_officials" name="officials" required>
                                </div>
                              </div>

                            <div class="col-6">


                                <div class="form-group">
                                  <label>Facility</label>
                                  <input type="text" class="form-control" placeholder="Facility" id="edit_facilities" name="facilities" required>
                                 
                                  
                                </div>
                              </div>
                            <div class="col-6">


                                <div class="form-group">
                                  <label>Session</label>
                                  <input type="text" class="form-control" placeholder="Session" id="edit_Session" name="session" required>
                                  
                                </div>
                              </div>
                            <div class="col-6">




                                <div class="form-group">
                                  <label>Trial Start Date</label>
                                  <input type="date" class="form-control" placeholder="Trial Start Date" id="edit_trial_start_date" name="trial_start_date" required>
                                  
                                </div>
                              </div>
                            <div class="col-6">


                                <div class="form-group">
                                  <label>Trial End Date</label>
                                  <input type="date" class="form-control " placeholder="Trial End Date" id="edit_trial_end_date" name="trial_end_date" required>
                                  
                                </div>
                              </div>
                            <div class="col-6">
                                <div class="form-group">
                                  <label>Closing Date</label>
                                    

                                  <input type="date" class="form-control " placeholder="Closing Date" id="edit_closing_date" name="closing_date" required>
                                </div>
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
          function trial_update(event_trial_id){ 

          $.ajax({
            url: 'admin/get_ajax_trial/'+event_trial_id,
            dataType: 'json',
            success: function(res){
              $('#edit_trial_name').val(res.trial_name);
              $('#edit_event_id option[value='+res.event_id+']').attr('selected','selected'); 
              $('.game_id').append('<option value="'+ res.game_id +'">'+res.game_name+'</option>');
              $('#edit_game_id option[value='+res.game_id+']').attr('selected','selected'); 
              $('#edit_trial_start_date').val(res.trial_start_date); 
              $('#edit_trial_end_date').val(res.trial_end_date);
              $('#edit_Session').val(res.trial_session);
              $('#edit_officials').val(res.officials);
              $('#edit_facilities').val(res.facilities);
              $('#edit_max_players').val(res.max_players);
              $('#edit_closing_date').val(res.closing_date); 
              $('#edit_trial_id').val(event_trial_id); 
            }
          });
        }

      </script>

      <script>


        $(document).on( "change",'.event_id',function(){
          var event_id = $(this).val();
            $.ajax({
            url: 'admin/get_ajax_event_game/'+event_id,
            dataType: 'json',
            success: function(response){

              $('.game_id').empty();
              $.each(response, function(key, value) {
              $('.game_id').append('<option value="'+ value.game_id +'">'+value.game_name+'</option>');
              $('.game_id option[value='+value.game_id+']').attr('selected','selected'); 
              });
              
            }
          });
        });



      </script>