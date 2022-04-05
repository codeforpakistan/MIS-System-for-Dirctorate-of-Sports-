<style>
  label{
    font-weight:bold !important;
    font-size:14px !important;

  }

</style>

<!-- Main Content -->
      <div class="main-content">
        <section class="section">
<!-- start messages --->
          <div style="text-align: center" class="msg">
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
      <div class="section-body">
         <form class="" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  
                  <div class="card-header">
                    <h2>Profile Info</h2>
                  </div>
                  <div class="card-body">
                      <div class="row">

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" class="form-control" name="name" value="<?=$athlete['ath_name']?>"  maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" required>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Father Name</label>
                                  <input type="text" class="form-control" name="f_name"  maxlength="30" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" required>
                            </div>
                          </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>CNIC No</label>
                                  <input type="text" class="form-control" name="cnic" data-inputmask="'mask': '99999-9999999-9'" required minlength="15" maxlength="15" required>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Gender</label>
                                 <select class="form-control" name="gender">
                                    <option>-Select Gender-</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    
                                  </select>
                            </div>
                      </div>

                       <div class="col-4">
                            <div class="form-group">
                                  <label>Date of Birth</label>
                                  <input type="text" class="form-control datepicker" name="dob" required>
                            </div>
                      </div>

                       <div class="col-4">
                            <div class="form-group">
                                  <label>Address</label>
                                  <input type="text" class="form-control"  name="address" required>
                            </div>
                      </div>

                      <div class="col-4">
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



                       <div class="col-4">
                            <div class="form-group">
                                  <label>Contact</label>
                                  <input type="text" class="form-control"  name="contact" value="<?=$athlete['ath_contact']?>" data-inputmask="'mask': '0399-9999999'" minlength="12" maxlength="12" required>
                            </div>
                      </div>

                      

                       <div class="col-4">
                            <div class="form-group">
                                  <label>Emergency Contact</label>
                                  <input type="text" class="form-control"  name="emergency_contact" data-inputmask="'mask': '0399-9999999'" minlength="12" maxlength="12" required>
                            </div>
                      </div>


                       <div class="col-4">
                            <div class="form-group">
                                  <label>Profession</label>
                                 <select class="form-control" name="profession">
                                    <option>-Select Profession-</option>
                                    <option value="student">Student</option>
                                    <option value="player">Player</option>
                                    
                                  </select>
                            </div>
                      </div>

                       
                       <div class="col-4">
                            <div class="form-group">
                                  <label>Attach Profile Picture</label>
                                  <input type="file" class="form-control"  name="profile_pic" required>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Attach NIC Front Photocopy</label>
                                  <input type="file" class="form-control"  name="cnic_front_copy" required>
                            </div>
                      </div>
              </div>
            </div>
          </div>
        </div> 
      </div>

        <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h2>Game Info</h2>
                  </div>
                  <div class="card-body">
                      <div class="row">
                      <div class="col-12">
                            <div class="form-group">
                              <label>Game Applied For</label>
                                  <select class="form-control select2 " id="game_id"  multiple name="game_id[]">
                                    <?php if(!empty($games)){
                                      foreach($games as $game){?>
                                    <option value="<?=$game->game_id?>"><?=$game->game_name?></option>
                                   <?php } }?>
                                  </select>
                            </div>
                    </div>  

                    <div class="col-4">
                            <div class="form-group">
                                  <label>Game Complex</label>
                                   <select class="form-control  " id="facility_id"   name="facility_id">
                                    <option  disabled value="" selected hidden>---Select Complex---</option>
                                    <?php if(!empty($facilities)){
                                      foreach($facilities as $facility){?>
                                    <option value="<?=$facility->facility_id?>"><?=$facility->facility_name?></option>
                                   <?php } }?>
                                  </select>
                            </div>
                      </div>

                       

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Time Prefernce</label>
                                  <select class="form-control" name="time_prefernce">
                                    <option  disabled value="" selected hidden>---Select Prefernce---</option>
                                    <option value="morning">Morning</option>
                                    <option value="evening">Evening</option>
                                  </select>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Game Fee</label>
                                  <input type="number" class="form-control game_fee"  name="game_fee" id="game_fee"  required>
                            </div>
                      </div>


                      <div class="col-4">
                            <div class="form-group">
                                  <label>Admission Fee</label>
                                  <input type="number" class="form-control admission_fee" name="admission_fee" id="admission_fee"  required>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Total Fee</label>
                                  <input type="number" class="form-control"  name="total_fee" id="total_fee"  required>
                            </div>
                      </div>

                      <div class="col-4">
                            <div class="form-group">
                                  <label>Payment Mode</label>
                                  <select class="form-control" name="payment_mode">
                                    <option>-Select Payment Mode-</option>
                                    <option>Bank</option>
                                  </select>
                            </div>
                      </div>

                      <!--  <div class="col-4">
                            <div class="form-group">
                                  <label>Date of apply</label>
                                  <input type="date" class="form-control" name="date_of_apply" required>
                            </div>
                      </div> -->

                    </div>

                       <div class="col-12">
                        <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect pull-right" >Save</button>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div> 
      </form>                
    </div>
  </div>


<script>


$(document).ready(function(){

   $(document).on('change','#game_id',function(){
    var game_id = $(this).val();
      $('#game_fee').val(0);
      $('#admission_fee').val(0);
      $('#total_fee').val(0);

     $.ajax({
            url: '<?=base_url()?>Athletes/get_ajax_multiple_game',
            dataType: 'json',
            type:"post",
            data:{game_id:game_id},
            success: function(response){
             
             console.log(response);

             $('#game_fee').val(response.game_fee);
             $('#admission_fee').val(response.game_admission_fee);
             $('#total_fee').val(response.total_fee);
            }

          });
  });
});
 
</script>
