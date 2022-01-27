<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
    <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Sports Directorate</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
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


  <style>
  buttons-copy
,.buttons-csv
,.buttons-excel
,.buttons-pdf
,.buttons-copy
,.buttons-print{
  display: none !important;
}
    .bg-success{

      background: #126E40 !important;
    }

    .collapse-btn{
      background: none;
      color:none;
    }
    
    .theme-white .navbar .nav-link .feather {
      color:#fff;
    }

     .select2-selection__choice{

    background: #126E40 !important;
    }

  </style>
</head>

<body>
   <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky bg-success">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title"><?= $this->session->userdata('user_role_name')?></div>
              <a href="admin/profile" class="dropdown-item has-icon" > <i class="far
                    fa-user"></i> Profile
              </a> 
              <!-- <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a> -->
              <div class="dropdown-divider"></div>
              <?php if($this->session->userdata('user_role_id_fk') == 1): ?>
              <a href="<?= base_url('admin/logout_user')?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
              Logout
              </a>
              <?php else:?>
              <a href="<?= base_url('Athletes/logout_user')?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
              Logout
              </a>
              <?php endif;?>

            </div>
          </li>
        </ul>
      </nav>

      <!-- add form -->
        <div class="modal fade" id="updateAmdinPasswordModel" tabindex="-1" role="dialog" aria-labelledby="formModaladd" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="formModaladd">Update Password</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- body-->
                        <form class="" method="post" action="<?= base_url("admin/updatePassword") ?>">
                                <div class="form-group">
                                <label>User Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Enter Your Password" name="user_password" required>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                      <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      <script>
        
        $(document).ready(function(){
          $(".msg").delay(3000).fadeOut(1000);

        $(":input").inputmask();


        });
      </script>

      