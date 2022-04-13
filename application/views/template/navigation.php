

<style type="text/css">
  .nav-link{

    color: #fff !important;
    font-weight: bold  !important;
    font-size:16px !important;
  }
  .light-sidebar.sidebar-mini .main-sidebar:after {
    background: #126E40 !important;
  }


  .sidebar-mini .main-sidebar .sidebar-menu>li {

     background: #126E40 !important;
    color: #fff !important;
    font-weight: bold  !important;
    font-size:16px !important;
  }
  .sidebar-menu{

    margin-top: 50px !important;
  }

  .main-sidebar .sidebar-menu :hover {
    background:#0d2e010f !important;

  }

</style>

<div class="main-sidebar sidebar-style-2" style="background: #126E40 ">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a><img alt="image" src="assets/images/DG_sports_logo.png" class="" style=";width:60%; margin-top: 30px;"  /> 
            </a>
          </div>

         

          <ul class="sidebar-menu">
            <li class="dropdown" >
              <?php if($this->session->userdata('user_role_id_fk') == 5 || $this->session->userdata('user_role_id_fk') == 6  || $this->session->userdata('user_role_id_fk') == 7):?>
              <a href="Athletes" class="nav-link" ><i class=" fa fa-home"></i><span>Dashboard</span></a>
              <?php else:?>
              <a href="admin" class="nav-link"  ><i></i><span >Dashboard</span></a>

                <?php endif;?>
            </li>

           <?php if($this->session->userdata('user_role_id_fk') == 1): ?>
             <li class="dropdown"  style="color:#fff !important">
                <a href="admin/events" class="nav-link">
                  <i ></i><span>Events</span>
                  
                </a>
            </li>
          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1): ?>


            <li class="dropdown">
                <a  href="admin/events_trials" class="nav-link">
                  <i ></i><span>Events Trials</span>
                  
                </a>
            </li>
          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1): ?>

            <li class="dropdown">
                <a  href="admin/facilities" class="nav-link">
                  <i ></i><span>Facilities</span>
                  
                </a>
            </li>

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1): ?>


            <li class="dropdown">
                <a  href="admin/games" class="nav-link">
                  <i ></i><span>Games</span>
                </a>
               
            </li>
          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1): ?>
            <li class="dropdown">
                <a href="admin/districts" class="nav-link">
                  <i ></i><span>Districts</span>
                </a>
            </li>

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1 || $this->session->userdata('user_role_id_fk') == 3): ?>


             <li class="dropdown">
                <a href="admin/selected_players" class="nav-link ">
                  <i ></i><span>Selected Players</span>
                </a>
               
            </li>

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1 || $this->session->userdata('user_role_id_fk') == 3): ?>

            <li class="dropdown">
                <a href="admin/selected_officals" class="nav-link ">
                  <i ></i><span>Selected Officals</span>
                </a>   
            </li>

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1):?>
            <li class="dropdown">
                <a href="admin/users" class="nav-link">
                  <i ></i><span>Users</span>
                </a>
                
            </li> 

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1):?>


            <li class="dropdown">
              <a href="#" class=" nav-link "><i></i><span>Coach</span></a>
              
            </li> 

          <?php endif;?>

           
            <?php /*<li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                  <i ></i><span>District Admins</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="admin/district_admin">View All</a></li>
                    <li><a class="nav-link" href="distrcit_admin_add">Add District Admin</a></li>
                </ul>
            </li>*/?> 
           <?php if($this->session->userdata('user_role_id_fk') == 1):?>

        
            <li class="dropdown">
                <a href="#"  class="nav-link ">
                  <i ></i><span>player Category</span>
                </a>
                
            </li> 

          <?php endif;?>
          
          

            <?php if($this->session->userdata('user_role_id_fk') == 5):
               $ath_id = $this->session->userdata('ath_id');
              ?>


            <li class="dropdown">
                <a href="athletes/approve_athlete_challans"  class="nav-link ">
                  <i class="fa fa-clock" ></i><span>Payment History</span>
                </a>
                
            </li> 
            <?php endif;?>
          
            <?php if($this->session->userdata('user_role_id_fk') == 5):?>

            <li class="dropdown">
                <a href="athletes/user_profile"  class="nav-link ">
                  <i class="fa fa-user"></i><span>Update Profile</span>
                </a>
            </li> 
            <?php endif;?>

           

        

            <?php if($this->session->userdata('user_role_id_fk') == 6 || $this->session->userdata('user_role_id_fk') == 7):?>

            <li class="dropdown">
                <a href="Athletes/general_report"  class="nav-link ">
                  <i class="fa fa-file"></i><span>Reports</span>
                </a>
            </li> 
            <?php endif;?>

            <?php if($this->session->userdata('user_role_id_fk') == 6 || $this->session->userdata('user_role_id_fk') == 7):
            
            

            ?>

            <li class="dropdown">
                <a href="Athletes/pending_challans"  class="nav-link ">
                  <i class="fa fa-file"></i><span>Pending Challans</span>
                </a>
            </li> 
            <?php endif;?>

            <?php if($this->session->userdata('user_role_id_fk') == 6 || $this->session->userdata('user_role_id_fk') == 7):
          
            ?>

            <li class="dropdown">
                <a href="Athletes/approve_facility_challans"  class="nav-link ">
                  <i class="fa fa-file"></i><span>Approve Challans</span>
                </a>
            </li> 
            <?php endif;?>

            

            <?php if($this->session->userdata('user_role_id_fk') == 6 || $this->session->userdata('user_role_id_fk') == 7):?>

            <li class="dropdown">
                <a href="Athletes/memberships"  class="nav-link ">
                  <i class="fa fa-file"></i><span>Memberships</span>
                </a>
            </li> 
            <?php endif;?>
            <?php if($this->session->userdata('user_role_id_fk') == 6 ):
            


            ?>

            <li class="dropdown">
                <a href="Athletes/card"  class="nav-link ">
                  <i class="fa fa-file"></i><span>Card</span>
                </a>
            </li> 
            <?php endif;?>

            <?php if($this->session->userdata('user_role_id_fk') == 5 ):
            


            ?>

            <li class="dropdown">
                <a href="Athletes/dublicate_card"  class="nav-link ">
                  <i class="fa fa-file"></i><span>Dublicate Card</span>
                </a>
            </li> 
            <?php endif;?>


            <?php if($this->session->userdata('user_role_id_fk') == 6):?>

            <li class="dropdown">
                <a href="Athletes/users"  class="nav-link ">
                  <i class="fa fa-file"></i><span>users</span>
                </a>
            </li> 
            <?php endif;?>
            
          </ul>
        </aside>
      </div>