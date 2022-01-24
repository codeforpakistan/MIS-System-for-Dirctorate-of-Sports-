
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
                  <button type="button" class="btn btn-primary pull-right fa fa-plus" data-toggle="modal" data-target="#addModel" style="margin-top:-5%;"> Add facility</button>
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
                            <th>Facility Name</th>
                            <th>Facility Description</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <?php if(!empty($facilities)):?>
                            <tbody>
                            <?php foreach($facilities as $onByOne):?>
                                <tr>
                                    <td><?= $onByOne->facility_name?></td>
                                    <td><?= $onByOne->facility_description?></td>
                                    <td>
                                       <a class="fa fa-edit text-info" data-toggle="modal" data-target="#editModel" href="javascript:void(0)" onclick="facility_update(<?=$onByOne->facility_id?>)"></a>

                                        <a class="fa fa-trash text-danger" onclick="return confirm('Are you sure to delete?')" href="<?= base_url('admin/facility_delete/'.$onByOne->facility_id) ?>"></a>
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
                    <h5 class="modal-title text-white" id="formModaladd">Add Facility </h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?=base_url("admin/facility_insert") ?>">
                            
                            <div class="form-group">
                                  <label>Facility Name</label>
                                  <input type="text" class="form-control" placeholder="Facility Name" name="facility_name" required>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Facility Description</label>
                                  <input type="text" class="form-control" placeholder="Facility Description" name="facility_description" required>
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
                    <h5 class="modal-title text-white" id="formModaladd">Update Facility </h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?= base_url("admin/facility_update") ?>">
                            <div class="form-group">
                                  <label>Facility Name</label>
                                  <input type="text" class="form-control" placeholder="Facility Name" name="facility_name" id="edit_facility_name" required>
                                  
                                </div>

                                <div class="form-group">
                                  <label>Facility Description</label>
                                  <input type="text" class="form-control" placeholder="Facility Description" name="facility_description" id="edit_facility_description" required>
                                </div>
                                <input type="hidden" name="facility_id" id="edit_facility_id" >
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
          function facility_update(facility_id){ 
          $.ajax({
            url: 'admin/get_ajax_facility/'+facility_id,
            dataType: 'json',
            success: function(response){
              $('#edit_facility_name').val(response.facility_name);
              $('#edit_facility_description').val(response.facility_description);
              $('#edit_facility_id').val(facility_id); 
            }
          });
        }
      </script>