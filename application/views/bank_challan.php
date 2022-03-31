<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
    <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Sports Directorate</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
  
  <link rel="stylesheet" href="assets/bundles/izitoast/css/iziToast.min.css">
  <link rel="stylesheet" href="assets/bundles/chocolat/dist/css/chocolat.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
     <!-- select 2 lib -->
  <link rel="stylesheet" href="assets/bundles/select2/dist/css/select2.min.css">
  <!----breadcrumb----->
  <link rel="stylesheet" href="breadcrumb_assets/style.css">

  <link rel="stylesheet" href="assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/logo/logo-icon.png'  />
  <script src="assets/js/jquery.min.js"></script>

<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    
                  </div>
                  <div class="card-body">
                    <div class="row">

                      <?php for($i = 0; $i<3; $i++){?>

                      <div class="col-4" style="border:1px solid #000">
                        <img alt="image" src="assets/images/Duplicate Card Receipt.png" class="header-logo" style="width:100%;" />
                        
                        <table  width="100%" border="0" cellpadding="0px" cellpadding="0px"   style="margin-top: 20px;">
                        <tr>
                          <th width="40%">Branch Code:</th>
                          <td style="border-bottom: 1px solid #000;"></td>
                        </tr>
                        <tr>
                          <th width="30%">Branch Name:</th>
                          <td style="border-bottom: 1px solid #000;"></td>
                        </tr>

                        <tr>
                          <th width="26%">Date:</th>
                          <td style="border-bottom: 1px solid #000;"></td>
                        </tr>
                      </table>

                      <table style="margin-top: 10px;" width="100%">
                        <tr>
                          <th width="25.33%">Mcb</th>
                          <td width="50.33%"></td>
                          <th width="25.33%">easypaisa</th>
                        </tr>
                      </table>

                      <br>

                       <table width="100%" border="1" style="margin-top: 10px;">
                        <tr>
                          <th width="150px;">Challan No:</th>
                          <td><?=$bank_challan['ath_challan_no']?></td>
                        </tr>

                        <tr>
                          <th>Name:</th>
                          <td><?=$bank_challan['ath_name']?></td>
                        </tr>

                        <tr>
                          <th>CNIC:</th>
                          <td><?=$bank_challan['ath_cnic']?></td>
                        </tr>

                        <tr>
                          <th>Payment Mode:</th>
                          <td><?=$bank_challan['ath_payment_mode']?></td>
                        </tr>

                        <tr>
                          <th>Games:</th>
                          <td><?=$bank_challan['game_name']?></td>
                        </tr>

                        <tr>
                          <th>Game Fee:</th>
                          <td><?=$bank_challan['game_fee']?></td>
                        </tr>

                        <?php if($bank_challan['game_admission_fee'] > 0):?>

                        <tr>
                          <th>Admission Fee:</th>
                          <td><?=$bank_challan['game_admission_fee']?></td>
                        </tr>

                        <tr>
                          <th>Total Fee:</th>
                          <td><?=$bank_challan['game_fee']+$bank_challan['game_admission_fee']?></td>
                        </tr>

                      <?php endif;?>

                      <tr>
                          <th>Total Fee:</th>
                          <td><?=$bank_challan['game_fee']?></td>
                        </tr>
                        <tr>
                          <td>Due Date:</td>
                          <td></td>
                        </tr>
                      </table>
                      <br>

                      <table width="100%" style="margin-top: 20px;">
                        <tr>
                          <td style="border-bottom: 1px solid #000;width:46%"></td>
                          <td width="5%"></td>
                          <td style="border-bottom: 1px solid #000;width:22%"></td>
                          <td width="5%"></td>
                          <td style="border-bottom: 1px solid #000;width:22%"></td>
                        </tr>

                        <tr>
                          <td align="center">Applicant Signature</td>
                          <td></td>
                          <td align="center">Casier</td>
                          <td></td>
                          <td align="center">Officer</td>
                        </tr>
                      </table>
                      </div>

                    <?php }?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/datatables/datatables.min.js"></script>
  <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>

  <script src="assets/bundles/cleave-js/dist/cleave.min.js"></script>
  <script src="assets/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>

  <script src="assets/bundles/select2/dist/js/select2.full.min.js"></script>

  <script src="assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <!-- Page Specific JS File -->
   <script src="assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/bundles/izitoast/js/iziToast.min.js"></script>
  <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  <script src="breadcrumb_assets/script.js"></script>
  <script src="assets/js/jquery.inputmask.bundle.js"></script>
  
 
</body>


<script>
window.print();

</script>