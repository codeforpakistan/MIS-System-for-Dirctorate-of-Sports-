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
          <li class="dropdown">
            <a href="#" data-toggle="dropdown"
                 class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.png"
                 class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <?php if($this->session->userdata('user_role_id_fk') == 5):?>
              <div class="dropdown-title"><?= $this->session->userdata('ath_name')?></div>

              <?php else:?>
              <div class="dropdown-title"><?= $this->session->userdata('user_role_name')?></div>
            <?php endif;?>

              <?php if($this->session->userdata('user_role_id_fk') == 5):?>
                <a href="Athletes/athlete_profile" class="dropdown-item has-icon" ><i class="far
                    fa-user"></i> Profile
              </a>
              <?php else:?>
                 <a href="admin/profile" class="dropdown-item has-icon" ><i class="far
                    fa-user"></i> Profile
              </a>
                
            <?php endif;?>

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

      <script>
        
        $(document).ready(function(){
          $(".msg").delay(3000).fadeOut(1000);

        $(":input").inputmask();


        });
      </script>

      