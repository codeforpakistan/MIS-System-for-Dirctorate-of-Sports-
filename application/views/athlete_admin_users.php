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
                  <button type="button" class="btn btn-primary pull-right fa fa-plus" data-toggle="modal" data-target="#addModel" style="margin-top:-5%;"> Add User</button>
                      <!-- start messages --->
                      <div style="text-align: center">
                              <?php if($feedback =$this->session->flashdata('feedback')){
                                $feedback_class =$this->session->flashdata('feedbase_class');  ?>
                                    <div class="row">
                                      <div class="col-md-6 offset-3">
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
                      <table class="table table-striped table-hover" id="table-1" style="width:100%;">
                        <thead class="">
                          <tr>
                            <th>Staff Name</th>
                            <th>Facility/Complex</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <?php if($users):?>
                            <tbody>
                            <?php foreach($users as $onByOne):?>
                                <tr>
                                    <td><?= $onByOne->ath_name?></td>
                                    <td><?= $onByOne->facility_name?></td>
                                    <td><?= $onByOne->user_role_name?></td>
                                    <td><?= ($onByOne->is_active == 1)?'<span class="text-success">Active</span>':'<span class="text-danger">Inactive</span>'?></td>
                                    <td>
                                       <a class="fa fa-edit text-info" data-toggle="modal" data-target="#editModel" href="javascript:void(0)" onclick="users_update(<?= $onByOne->ath_id?>)"></a>

                                        <a class="fa fa-trash text-danger" onclick="return confirm('Are you sure to delete?')" href="<?= base_url('athletes/users_delete/'.$onByOne->ath_id) ?>"></a>
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

      <!--- edit form -->
      <div class="modal fade" id="editModel"  role="dialog" aria-labelledby="formModaladd" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="formModaladd">Update User </h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?= base_url("athletes/users_update") ?>">
                          
                            <div class="form-group">
                              <label>User</label>
                              <div class="input-group">
                                  <select class="form-control" id="toggleFacilitySection_edit" name="user_role_id_fk" style="width:90%" required>
                                    <option value="4">super admin</option>
                                    
                                    <option value="7">Facility Admin</option>
                                </select>
                              </div>
                            </div>
                            
                            <div class="form-group" id="hideShowFacilityEdit">
                                  <label>District</label>
                                  <div class="input-group">
                                      <select class="form-control select2" id="edit_facility_id" name="facility_id" style="width:90%">
                                     <option disabled value="" selected hidden>Please Select Facility</option>
                                        <?php if($facilities){ foreach($facilities as $facility){?>
                                           <option value="<?= $facility->facility_id?>"><?= $facility->facility_name?></option>
                                        <?php } }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>User Name</label>
                                  <div class="input-group">
                                      <input type="text" class="form-control" placeholder="User name" name="user_name" id="edit_user_name" required>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>User Email</label>
                                  <div class="input-group">
                                      <input type="email" class="form-control" placeholder="User Email" id="edit_user_email" name="user_email" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Password" id="edit_user_password" name="user_password" requored >
                                </div>
                                </div>
                                <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                      <select class="form-control" name="user_status" id="edit_user_status">
                                          <option value="1" >Active</option>
                                          <option value="0" >Inactive<option>
                                      </select>
                                 </div>
                                </div>
                                <input type="hidden" name="user_id" id="edit_user_id" >
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>                                    </div>
                                </div>
                                
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- add form -->
        <div class="modal fade" id="addModel"  role="dialog" aria-labelledby="formModaladd" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="formModaladd">Add User </h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?= base_url("athletes/users_insert") ?>">
                            <div class="form-group">
                              <label>User Role</label>
                              <div class="input-group">
                                  <select class="form-control"  id="toggleFacilitySection" name="user_role_id_fk" style="width:90%" required>
                                    <option value="1">Super Admin</option>
                                    <option value="7">FacilityAdmin</option>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group"  id="hideShowFacility">
                                  <label>Facility/Complex</label>
                                  <div class="input-group">
                                      <select class="form-control select2" name="facility_id" id="facility_id" style="width:100%">
                                        <option disabled value="" selected hidden>Please Select Facility</option>
                                        <?php if($facilities){ foreach($facilities as $facility){?>
                                           <option value="<?= $facility->facility_id?>"><?= $facility->facility_name?></option>
                                        <?php } }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>User Name</label>
                                  <div class="input-group">
                                      <input type="text" class="form-control" placeholder="User name" name="user_name" required>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>User Email</label>
                                  <div class="input-group">
                                      <input type="email" class="form-control" placeholder="User Email" name="user_email" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Password" name="user_password" requored >
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                      <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                                    </div>
                                </div>
                                
                        </form>
                    </div>
                </div>
            </div>
        </div>
      <script>
        
        $( document ).ready(function() {
            $('#hideShowFacility').hide();
            $( "#toggleFacilitySection" ).change(function() {
              var userRole = $("#toggleFacilitySection :selected").val();
              if(userRole == 7)
              {
                $('#hideShowFacility').show();
              }
              else
              {
                $('#hideShowFacility').hide();
              }
              
            });
            // edit form
            $( "#toggleFacilitySection_edit" ).change(function() {
              var userRole = $("#toggleFacilitySection_edit :selected").val();
              if(userRole == 7)
              {
                $('#hideShowFacilityEdit').show();
              }
              else
              {
                $('#hideShowFacilityEdit').hide();
                // $('#edit_facility_id').val('');
                // $('#edit_facility_id').trigger("change");
              }
              
            });
            
        });


          function users_update(user_id){ 
          $.ajax({
            url: 'athletes/users_edit_model/'+user_id,
            dataType: 'json',
            success: function(response){ 
              $('#edit_user_email').val(response.ath_email);
              $('#edit_user_name').val(response.ath_name);
              $('#edit_user_password').val(response.ath_password);
              $('#edit_user_id').val(response.ath_id); 
              $('#toggleFacilitySection_edit option[value="' + response.user_role_id_fk + '"]').prop('selected', true);
              $('#edit_user_status option[value="' + response.is_active + '"]').prop('selected', true);
              // if(response.user_role_id_fk == 2)
              // {
              //   $('#hideShowFacilityEdit').hide();
              //   $('#edit_facility_id').val('');
              //   $('#edit_facility_id').trigger("change");
              // }
              // else
              // {
              //   $('#hideShowFacilityEdit').show();
              //   $('#edit_facility_id').val(response.user_district_id_fk);
              //   $('#edit_facility_id').trigger("change"); 
              // }
              
            }
          });
        }
      </script>