<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper" >
          <div class="sidebar-brand">
            <a href="<?= base_url()?>"> <img alt="image" src="assets/images/DG sports logo.png"  style="border-radius:50px;"  class="header-logo" /> 
            </a>
          </div>

          <ul class="sidebar-menu">
            <li class="dropdown active">
              <a href="<?= base_url()?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>

           <?php if($this->session->userdata('user_role_id_fk') == 1): ?>
             <li class="dropdown">
                <a href="admin/events" class="nav-link">
                  <i data-feather="briefcase"></i><span>Events</span>
                  
                </a>
            </li>
          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1): ?>


            <li class="dropdown">
                <a  href="admin/events_trials" class="nav-link">
                  <i data-feather="briefcase"></i><span>Events Trials</span>
                  
                </a>
            </li>
          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1): ?>

            <li class="dropdown">
                <a  href="admin/facilities" class="nav-link">
                  <i data-feather="briefcase"></i><span>Facilities</span>
                  
                </a>
            </li>

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1): ?>


            <li class="dropdown">
                <a  href="admin/games" class="nav-link">
                  <i data-feather="briefcase"></i><span>Games</span>
                </a>
               
            </li>
          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1): ?>
            <li class="dropdown">
                <a href="admin/districts" class="nav-link">
                  <i data-feather="briefcase"></i><span>Districts</span>
                </a>
            </li>

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1 || $this->session->userdata('user_role_id_fk')): ?>


             <li class="dropdown">
                <a href="admin/selected_players" class="nav-link ">
                  <i data-feather="briefcase"></i><span>Selected Players</span>
                </a>
               
            </li>

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1 || $this->session->userdata('user_role_id_fk')): ?>

            <li class="dropdown">
                <a href="admin/selected_officals" class="nav-link ">
                  <i data-feather="briefcase"></i><span>Selected Officals</span>
                </a>   
            </li>

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1):?>

             <li class="dropdown">
                <a href="Athletes" class="nav-link ">
                  <i data-feather="briefcase"></i><span>Athletes</span>
                </a>
            </li>

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1):?>
            <li class="dropdown">
                <a href="admin/users" class="nav-link">
                  <i data-feather="briefcase"></i><span>Users</span>
                </a>
                
            </li> 

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1):?>


            <li class="dropdown">
              <a href="#" class=" nav-link "><i data-feather="image"></i><span>Coach</span></a>
              
            </li> 

          <?php endif;?>

           <?php if($this->session->userdata('user_role_id_fk') == 1):?>

            <li class="dropdown">
                <a href="respondents" class=" nav-link ">
                  <i data-feather="briefcase"></i><span>Fee</span>
                </a>
               
            </li>

          <?php endif;?>
           <?php if($this->session->userdata('user_role_id_fk') == 1):?>

            <li class="dropdown">
                <a href="#"  class="nav-link ">
                  <i data-feather="briefcase"></i><span>Athlete</span>
                </a>
                
            </li>

          <?php endif;?>
            
            <?php /*<li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                  <i data-feather="briefcase"></i><span>District Admins</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="admin/district_admin">View All</a></li>
                    <li><a class="nav-link" href="distrcit_admin_add">Add District Admin</a></li>
                </ul>
            </li>*/?> 
           <?php if($this->session->userdata('user_role_id_fk') == 1):?>

        
            <li class="dropdown">
                <a href="#"  class="nav-link ">
                  <i data-feather="briefcase"></i><span>player Category</span>
                </a>
                
            </li> 

          <?php endif;?>
           <?php if($this->session->userdata('user_role_id_fk') == 1):?>

            <li class="dropdown">
                <a href="#"  class="nav-link ">
                  <i data-feather="briefcase"></i><span>Physical status</span>
                </a>
                
            </li> 
            <?php endif;?>
          </ul>
        </aside>
      </div>