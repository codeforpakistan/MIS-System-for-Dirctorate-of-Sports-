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

                    <?php if($this->session->userdata('user_role_id_fk') == '3'):?>

                  <button type="button" class="btn btn-primary pull-right fa fa-plus" data-toggle="modal" data-target="#addModel" style="margin-top:-5%;"> Add Player</button>

                <?php endif;?>
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
                            <th>Event Trial</th>
                            <th>Trial Game </th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>CNIC</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Physical Status</th>
                            <th>Category</th>
                            <th>Domicle</th>
                            <th>District</th>
                    <?php if($this->session->userdata('user_role_id_fk') == '3'):?>

                            <th>Action</th>

                          <?php endif;?>
                          </tr>
                        </thead>

                        <tbody>
                          <?php if(!empty($selected_players)){
                            foreach($selected_players as $selected_player){?>
                          
                          <tr>
                          <td><?=ucwords($selected_player->event_title)?></td>
                          <td><?=ucwords($selected_player->trial_name)?></td>
                          <td><?=ucwords($selected_player->game_name)?></td>
                          <td><?=ucwords($selected_player->name)?></td>
                          <td><?=ucwords($selected_player->father_name)?></td>
                          <td><?=$selected_player->cnic?></td>
                          <td><?=$selected_player->age?></td>
                          <td><?=ucwords($selected_player->gender)?></td>
                          <td><?=ucwords($selected_player->physical_status)?></td>
                          <td><?=ucwords($selected_player->category)?></td>
                          <td><?=ucwords($selected_player->domicle)?></td>
                          <td><?=ucwords($selected_player->district_name)?></td>

                    <?php if($this->session->userdata('user_role_id_fk') == '3'):?>

                           <td>
                             <a class="fa fa-edit text-info" href="javascript:void(0)" onclick="open_edit_modal(<?=$selected_player->player_offical_id ?>)"></a>

                              <a class="fa fa-trash text-danger" onclick="return confirm('Are you sure to delete?')" href="<?= base_url("admin/selected_player_offical_delete/player/$selected_player->player_offical_id")?>"></a>
                            </td>

                          <?php endif;?>
                        </tr>
                      <?php } } ?>
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


       <!-- Large modal add-->
        <div class="modal fade bd-example-modal-lg" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="myLargeModalLabel">Add Player</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

                  <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?=base_url("admin/selected_player_offical_insert/player")?>">
                          <div class="row">
                            <div class="col-6">
                            <div class="form-group">
                                  <label>Event Name</label>
                                  <select  name="event_id"  class="form-control event_id" onchange="event_changed(this)">      
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
                                  <label>Event Trials</label>
                                  <select  name="event_trial_id" class="form-control event_trial_id" onchange="event_trial_changed(this)">      
                                  </select>
                                  
                                </div>
                              </div>

                            <div class="col-6">
                                <div class="form-group">
                                  <label>Trial Games</label>
                                  <input type="text" name="game_id" class="form-control event_trial_game_id"  readonly>
                                  </select>
                                  
                                </div>
                              </div>

                              <div class="col-6">                            
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Enter Name" name="name" maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" required> 
                                </div>
                              </div>
                            <div class="col-6">
                                <div class="form-group">
                                  <label>Father Name</label>
                                  <input type="text" class="form-control" placeholder="Enter Father Name" maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" name="father_name" required>
                                  
                                </div>
                              </div>

                            <div class="col-6">
                                <div class="form-group">
                                  <label>CNIC</label>
                                  <input type="text" class="form-control" placeholder="Enter CNIC" name="cnic" data-inputmask="'mask': '99999-9999999-9'" required minlength="15" maxlength="15">
                                </div>
                              </div>

                            <div class="col-6">


                                <div class="form-group">
                                  <label>Age</label>
                                  <input type="text" class="form-control" placeholder="Enter Age" name="age" required>
                                 
                                  
                                </div>
                              </div>

                            <div class="col-6">
                                <div class="form-group">
                                  <label>Gender</label>
                                  <select  class="form-control "  name="gender" required>
                                    <option>--Select Gender--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="">Other</option>
                                  </select>
                                </div>
                              </div>

                            

                            <div class="col-6">
                                <div class="form-group">
                                  <label>Category</label>
                                  <select  class="form-control "  name="category" required>
                                    <option>--Select Category--</option>
                                    <option>under 17</option>
                                    <option>under 18</option>
                                    <option>under 19</option>
                                    <option>under 22</option>
                                    <option>under 21</option>
                                  </select>
                                  
                                </div>
                              </div>

                               <div class="col-6">
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

                               <div class="col-6">
                                <div class="form-group">
                                  <label>Domicle</label>
                                  <select  class="form-control "  name="domicle_id" required>
                                    <option>--Select Domicle--</option>

                                    <?php if(!empty($districts)){
                                      foreach ($districts as $district){?>
                                      ?>
                                    <option value="<?=$district->district_name?>"><?=$district->district_name?></option>

                                  <?php } }?>
                                  </select>
                                  
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                  <label>Physical Status</label>
                                  <input type="text" class="form-control" placeholder="Enter Physical Status" name="physical_status" required>
                                  
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
                <h5 class="modal-title  text-white" id="myLargeModalLabel">Update Selected Player</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

                   <div class="modal-body">
                    <!-- body-->
                       <form class="" method="post" action="<?=base_url("admin/selected_player_offical_update/player")?>">
                          <div class="row">
                            <div class="col-6">
                            <div class="form-group">
                                  <label>Event Name</label>
                                  <select  name="event_id"  class="form-control event_id" id="edit_event_id" onchange="event_changed(this)">      
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
                                  <label>Event Trials</label>

                                <select  name="event_trial_id" class="form-control event_trial_id" id="edit_event_trial_id" onchange="event_trial_changed(this)">
                                </select>
                                  
                                </div>
                              </div>

                            
                            <div class="col-6">
                                <div class="form-group">
                                  <label>Trial Games</label>
                                  <input type="text" name="game_id" class="form-control game_id" id="edit_trial_game_id" >
                                  
                                </div>
                              </div>

                              <div class="col-6">                            
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Enter Name" name="name" maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" id="edit_name" required> 
                                </div>
                              </div>
                            <div class="col-6">
                                <div class="form-group">
                                  <label>Father Name</label>
                                  <input type="text" class="form-control" placeholder="Enter Father Name" id="edit_father_name" name="father_name" maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" required>
                                  
                                </div>
                              </div>

                            <div class="col-6">
                                <div class="form-group">
                                  <label>CNIC</label>
                                  <input type="text" class="form-control" placeholder="Enter CNIC" id="edit_cnic" name="cnic"  data-inputmask="'mask': '99999-9999999-9'" required minlength="15" maxlength="15">
                                </div>
                              </div>

                            <div class="col-6">
                                <div class="form-group">
                                  <label>Age</label>
                                  <input type="text" class="form-control" placeholder="Enter Age" name="age" id="edit_age"required>
                                 
                                </div>
                              </div>

                            <div class="col-6">
                                <div class="form-group">
                                  <label>Gender</label>
                                  <select  class="form-control "  name="gender" id="edit_gender" required>
                                    <option>--Select Gender--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="">Other</option>
                                  </select>
                                </div>
                              </div>

                            

                            <div class="col-6">
                                <div class="form-group">
                                  <label>Category</label>
                                  <select  class="form-control "  name="category" id="edit_category" required>
                                    <option>--Select Category--</option>
                                    <option>under 17</option>
                                    <option>under 18</option>
                                    <option>under 19</option>
                                    <option>under 22</option>
                                  </select>
                                  
                                </div>
                              </div>

                               <div class="col-6">
                                <div class="form-group">
                                  <label>District</label>

                                  <select  class="form-control "  name="district_id" id="edit_district_id" required>
                                   <option>--Select District--</option>

                                    <?php if(!empty($districts)){
                                      foreach ($districts as $district){?>
                                      ?>
                                    <option value="<?=$district->district_id?>"><?=$district->district_name?></option>

                                  <?php } }?>
                                  </select>
                                  
                                </div>
                              </div>

                               <div class="col-6">
                                <div class="form-group">
                                  <label>Domicle</label>
                                  <select  class="form-control "  name="domicle_id" id="edit_domicle_id" required>
                                    <option>--Select Domicle--</option>

                                    <?php if(!empty($districts)){
                                      foreach ($districts as $district){?>
                                      ?>
                                    <option value="<?=$district->district_name?>"><?=$district->district_name?></option>

                                  <?php } }?>
                                  </select>
                                  
                                </div>
                              </div>
                               <input type="hidden" name="player_offical_id" id="edit_player_offical_id" >

                              <div class="col-6">
                                <div class="form-group">
                                  <label>Physical Status</label>
                                  <input type="text" class="form-control" id="edit_physical_status" placeholder="Enter Physical Status" name="physical_status" required>
                                  
                                </div>
                              </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect pull-right" >Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>

        $(document).ready(function(){

        $('#addModel form')[0].reset();

        $(":input").inputmask();
        }); 

        function open_edit_modal(player_offical_id)
        {
        $.ajax({
        url: 'admin/get_ajax_officals_player/'+player_offical_id+'/player',
        dataType: 'json',
        success: function(res){
        var event_id = res.event_id;
        $('#editModel form')[0].reset();
        $('#editModel').modal('show');

        setTimeout(function() { 
        $('#edit_event_id').val(event_id).trigger('change'); 
        }, 100); 

        setTimeout(function() { 
        $('#edit_event_trial_id').val(res.event_trial_id).trigger('change'); 
        }, 200); 


        $('#edit_gender option[value='+res.gender+']').attr('selected','selected'); 
        $('#edit_district_id option[value='+res.district_id+']').attr('selected','selected'); 
        $("#edit_domicle_id option:selected" ).text(res.domicle);
        $('#edit_category option:selected').text(res.category);
        $('#edit_name').val(22); 
        $('#edit_father_name').val(res.father_name); 
        $('#edit_cnic').val(res.cnic); 
        $('#edit_age').val(res.age); 
        $('#edit_physical_status').val(res.physical_status);
        $('#edit_player_offical_id').val(player_offical_id);
        }
        });
        }

        function event_changed(_this)
        {

        $('#edit_trial_game_id').val('');
        var event_id = $(_this).val();
        $.ajax({
        url: 'admin/get_ajax_event_trials/'+event_id,
        dataType: 'json',
        success: function(response){
        $('.event_trial_id').empty();
        $(".event_trial_id").append('<option value="">Select Event Trial </option>');  

        $.each(response, function(key, value){
        $('.event_trial_id').append('<option value="'+ value.event_trial_id +'">'+value.trial_name+'</option>');
        });

        $(_this).closest('.event_trial_id').val(event_id).trigger('change'); 

        }           
        });
        }

        function event_trial_changed(_this,_selected_value)
        {

        var event_trial_id = $(_this).val();

        $.ajax({
        url: 'admin/get_ajax_event_trial_game/'+event_trial_id,
        dataType: 'json',
        success: function(response)
        {
        $('#edit_trial_game_id').val(response.game_name);
        $('.event_trial_game_id').val(response.game_name);
        }
        }); 
        }
        </script>


