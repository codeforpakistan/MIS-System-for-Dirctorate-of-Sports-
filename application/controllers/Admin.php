<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel','model');
        $this->load->library('auto_no.php','zend');
        $this->load->library('form_validation');
    } 
    
    public function check_role_privileges($page_name,$role_id)
    {
        $pages_data = $this->model->check_page($page_name);  

        if(is_object($pages_data))
        {
          $response = $this->model->check_role_privileges($pages_data->page_id,$role_id);
          if($response == TRUE)
           {
              return true; exit;
           }
           else
           {
             return redirect(base_url());
           }
        } 
    }
    //==========================================================================
    // Auth
    //==========================================================================
    
    public function index()
    { 

        
        if($this->session->userdata('user_role_id_fk'))
        {
            $this->dashboard();
        }
        else
        {
           $this->load->view('authLogin'); 
        }
        
    }
    
    public function login_user()
    {   
        $this->form_validation->set_rules('user_email', 'Useremail', 'required|trim');
        $this->form_validation->set_rules('user_password', 'Password', 'required|trim');
        if ($this->form_validation->run() == FALSE)
        {
            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect(base_url());
            
        }
        else
        {
            $user_email = $this->input->post('user_email');
            $password = $this->input->post('user_password');
            $array    = array('user_email'=>$user_email,'user_password'=>$password,'user_status'=>1);

            $response = $this->AuthModel->user_login($array); 



            if(!empty($response))// is user name and passsword valid
               {

                $this->session->set_userdata('user_id',$response->user_id);
                $this->session->set_userdata('user_name',$response->user_name);
                $this->session->set_userdata('user_email',$response->user_email);
                $this->session->set_userdata('user_role_id_fk',$response->user_role_id_fk);
                $this->session->set_userdata('user_role_name',$response->user_role_name);
                redirect('/admin/dashboard'); exit();
               
                } // end is user name and passsword valid
                else // not match ue name and pass
                 {
                    $this->session->set_flashdata('errorMsg', "Username Or Password Invalid");
                    $this->messages('alert alert-danger',"Username Or Password Invalid");
                  //  echo "username or passwrod invalid"; 
                    redirect(base_url());
                    exit();
                 }  //end // not match ue name and pass 
        }  
    }
    public function messages($className,$messages)
    { 
       $this->session->set_flashdata('feedback',$messages);
       $this->session->set_flashdata('feedbase_class',$className);
   
    }
    public function logout_user()
    {
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_id'); 
        $this->session->unset_userdata('user_role_id_fk'); 
        $this->session->sess_destroy();
        $this->clear_cache();
        redirect(base_url());
    }
    
    public function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }


    function check_privileges($page_name)
    {
        $user_role_id = 1; // get active user's ROLE
     
    }

    function users()
    { 
     $this->check_role_privileges('users',$this->session->userdata('user_role_id_fk'));
        
        $table_name                 = 'users';
        $table_name2                = 'districts';
        $table_status_column_name   = 'is_active';
        $user_district_id_fk        = 3;
        $table_status_column_value  = 1;
        $data['users']              = $this->model->district_admins();
        $data['district']           = $this->model->status_active_record($table_name2,$table_status_column_name,$table_status_column_value);
        $data['title']              = 'Users';
        $data['page']               = 'users';
        $this->load->view('template',$data);
    }
    //==========================================================================
    // insert user
    //==========================================================================
    function users_insert()
    {
        $this->form_validation->set_rules('user_email', 'User Email', 'required|trim|is_unique[users.user_email]');
        $this->form_validation->set_rules('user_name', 'User Email', 'required|trim|is_unique[users.user_name]');
        $this->form_validation->set_rules('user_password', 'Password', 'required|trim');

        if($this->input->post('user_role_id_fk') == 3) // to for District admin
        {
            $this->form_validation->set_rules('district_id', 'Dostrict selection', 'required|trim');
        } 

        if ($this->form_validation->run() == FALSE)
        {
            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect('admin/users');
            
        }
        else
        {
            $user_email           = $this->input->post('user_email');
            $user_name           = $this->input->post('user_name');
            $user_password        = $this->input->post('user_password');
            $user_district_id_fk  = (empty($this->input->post('district_id'))? 0:$this->input->post('district_id'));
            $user_role_id_fk      = $this->input->post('user_role_id_fk');
            $table_name           = 'users';
            $inert_array       = array('user_email'=> $user_email,'user_name'=> $user_name,'user_password'=>md5($user_password),'user_district_id_fk'=>$user_district_id_fk,'user_status'=>1,'user_role_id_fk'=>$user_role_id_fk);
            $table_name           = 'users';

            $response = $this->model->insert($inert_array,$table_name);

                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');
                    return redirect('admin/users'); 
                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    return redirect('admin/users');
                }
        }
    }
    //==========================================================================
    // update user modal view
    //==========================================================================
    function users_edit_model($user_id)
    { 
        $table_name        = "users";
        $talbe_column_name = 'user_id';
        $table_id          = $user_id;

        $userss = $this->model->exist_record_row($talbe_column_name,$table_id,$table_name);  // get row
        echo json_encode($userss); exit;      
    }
    //==========================================================================
    // update user
    //==========================================================================
    function users_update()
    {
        if($this->input->post('user_id'))
        {   
            $user_id           = $this->input->post('user_id');
            $user_email        = $this->input->post('user_email');
            $user_name         = $this->input->post('user_name');
            $user_password     = $this->input->post('user_password');
            // $user_district_id_fk=$this->input->post('district_id');
            $user_status       = $this->input->post('user_status');
            $table_name        = "users";
            $talbe_column_name = 'user_id';
            $table_id          = $user_id;

            $district_email = $this->model->exist_record_row($talbe_column_name,$table_id,$table_name);  // get row
            $exists_user_name =  $district_email->user_email;
            if($exists_user_name != $user_email)
            {
              $this->form_validation->set_rules('user_email', 'Useremail', 'required|trim|is_unique[users.user_email]');  
              $this->form_validation->set_rules('user_name', 'Username', 'required|trim|is_unique[users.user_name]');  
            }
            else
            {
                $this->form_validation->set_rules('user_email', 'User email', 'required|trim');
                $this->form_validation->set_rules('user_name',  'Username', 'required|trim');
            }
            if($this->input->post('user_role_id_fk') == 3) // to for District admin
            {
                $this->form_validation->set_rules('district_id', 'For Dostrict-admin District selection', 'required|trim');
            }
            
            $this->form_validation->set_rules('user_password', 'Password', 'required|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $error   = array('error' => validation_errors());
                $message = implode(" ",$error);
                $this->messages('alert-danger',$message);
                return redirect('admin/users');
                
            }
            else
            {
                $user_district_id_fk= (empty($this->input->post('district_id'))? 0:$this->input->post('district_id'));
                $update_it_array   = array('user_name'=>$user_name,'user_password'=>md5($user_password),'user_status'=>$user_status,'user_district_id_fk'=>$user_district_id_fk);
                $response = $this->model->update($update_it_array,$table_name,$talbe_column_name,$table_id);
                    if($response == true)
                    {
                        $this->messages('alert-success','Successfully Update');
                        return redirect('admin/users'); 
                    }
                    else
                    {
                        $this->messages('alert-danger','Some Thing Wrong');
                        return redirect('admin/users');
                    }
            }
        }
    }
    //==========================================================================
    // Delete User
    //==========================================================================
    function users_delete($user_id= null)
    {
        if($user_id > 0)
        {   
            $talbe_column_name = 'user_id';
            $table_name        = 'users';
            $table_id          = $user_id; 
            // $update_it_array   = array('user_status'=>0);
            // $response = $this->model->update($update_it_array,$table_name,$talbe_column_name,$table_id);
            $response = $this->model->delete($talbe_column_name,$table_id,$table_name); 
            if($response == true)
            {
                $this->messages('alert-success','Successfully Deleted');
                return redirect('admin/users'); 
            }
            else
            {
                $this->messages('alert-danger','Some Thing Wrong');
                return redirect('admin/users');
            }
        }
    }
    
    //==========================================================================
    // dashboard
    //==========================================================================
    
    public function dashboard()
    { 

     $this->check_role_privileges('users',$this->session->userdata('user_role_id_fk'));

        $data['title']          = 'Dashboard';
        $data['page']           = 'dashboard';
        $data['it_staff']       = $this->model->countUsersByRoleId(2);
        $data['district_admin'] = $this->model->countUsersByRoleId(3);
        $data['complainant']    = $this->model->countUsersByRoleId(4);
        $this->load->view('template',$data);
    }
   
    
    //==========================================================================
    // District Admin
    //==========================================================================

    function district_admin()
    { 

        $this->check_role_privileges('district_admin',$this->session->userdata('user_role_id_fk'));

        $table_name                 = 'users';
        $user_role_id_fk            = 3;
        $table_name2                = 'districts';
        $table_status_column_name   = 'is_active';
        $user_district_id_fk        = 3;
        $table_status_column_value  = 1;
        $data['district_admin'] = $this->model->user_by_role($table_name,$user_role_id_fk,$user_district_id_fk);
        $data['district']       = $this->model->status_active_record($table_name2,$table_status_column_name,$table_status_column_value);
        $data['title']          = 'District Admin';
        $data['page']           = 'district_admin';
        $this->load->view('template',$data);
    }




    function district_admin_insert()
    {
        $this->form_validation->set_rules('user_name', 'Username', 'required|trim|is_unique[users.user_name]');
        $this->form_validation->set_rules('user_password', 'Password', 'required|trim');
        $this->form_validation->set_rules('district_id','District', 'required|trim');
        if ($this->form_validation->run() == FALSE)
        {
            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect('admin/district_admin');
            
        }
        else
        {
            $user_name         = $this->input->post('user_name');
            $user_password     = $this->input->post('user_password');
            $user_district_id_fk=$this->input->post('district_id');
            $table_name        = 'users';
            $inert_it_array   = array('user_name'=>$user_name,'user_password'=>md5($user_password),'user_district_id_fk'=>$user_district_id_fk,'user_status'=>1,'user_role_id_fk'=>3);
            $table_name        = 'users';
            $response = $this->model->insert($inert_it_array,$table_name);
                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');
                    return redirect('admin/district_admin'); 
                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    return redirect('admin/district_admin');
                }
        }
    }
    function district_admin_edit_model($user_id)
    { 
        $table_name        = "users";
        $talbe_column_name = 'user_id';
        $table_id          = $user_id;

        $district_admins = $this->model->exist_record_row($talbe_column_name,$table_id,$table_name);  // get row
        echo json_encode($district_admins); exit;      
    }
    function district_admin_update()
    {
        if($this->input->post('user_id'))
        {   
            $user_id           = $this->input->post('user_id');
            $user_name         = $this->input->post('user_name');
            $user_password     = $this->input->post('user_password');
            $user_district_id_fk=$this->input->post('district_id');
            $user_status       = $this->input->post('user_status');
            $table_name        = "users";
            $talbe_column_name = 'user_id';
            $table_id          = $user_id;

            $IT_staff = $this->model->exist_record_row($talbe_column_name,$table_id,$table_name);  // get row
            $exists_user_name =  $IT_staff->user_name;
            if($exists_user_name != $user_name)
            {
              $this->form_validation->set_rules('user_name', 'Username', 'required|trim|is_unique[users.user_name]');  
            }
            else
            {
                $this->form_validation->set_rules('user_name', 'Username', 'required|trim');
            }
            
            $this->form_validation->set_rules('user_password', 'Password', 'required|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $error   = array('error' => validation_errors());
                $message = implode(" ",$error);
                $this->messages('alert-danger',$message);
                return redirect('admin/district_admin');
                
            }
            else
            {

                $update_it_array   = array('user_name'=>$user_name,'user_password'=>md5($user_password),'user_status'=>$user_status,'user_district_id_fk'=>$user_district_id_fk);
                $response = $this->model->update($update_it_array,$table_name,$talbe_column_name,$table_id);
                    if($response == true)
                    {
                        $this->messages('alert-success','Successfully Update');
                        return redirect('admin/district_admin'); 
                    }
                    else
                    {
                        $this->messages('alert-danger','Some Thing Wrong');
                        return redirect('admin/district_admin');
                    }
            }
        }
    }
    function district_admin_delete($user_id= null)
    {
        if($user_id > 0)
        {   
            $talbe_column_name = 'user_id';
            $table_name        = 'users';
            $table_id          = $user_id; 
            $update_it_array   = array('user_status'=>0);
            $response = $this->model->update($update_it_array,$table_name,$talbe_column_name,$table_id); 
            if($response == true)
            {
                $this->messages('alert-success','Successfully Deleted');
                return redirect('admin/district_admin'); 
            }
            else
            {
                $this->messages('alert-danger','Some Thing Wrong');
                return redirect('admin/district_admin');
            }
        }
    }
   
    //================= Trials start ==========
     public function events_trials()
    {

        $this->check_role_privileges('events_trials',$this->session->userdata('user_role_id_fk'));



            
        $table               = 'events_trials';
        $data['events_trials']      = $this->model->get_trials();

        $table               = 'events';
        $data['events']      = $this->model->get_all_records($table);

        $data['title']     = 'Events Trials';
        $data['page']      = 'events_trials';
        $this->load->view('template',$data);
    }

    public function trial_insert()
    {

        $this->form_validation->set_rules('event_id', 'Event Id', 'required|trim');
        $this->form_validation->set_rules('trial_start_date', 'Trial Start Date', 'required|trim');
        $this->form_validation->set_rules('trial_end_date', 'Trial End Date', 'required|trim');
        $this->form_validation->set_rules('max_players', 'Max Players', 'required|trim');
        $this->form_validation->set_rules('officials', 'Officials', 'required|trim');
        $this->form_validation->set_rules('facilities', 'Facility', 'required|trim');
        $this->form_validation->set_rules('session', 'Session', 'required|trim');
        $this->form_validation->set_rules('game_id', 'Game Name', 'required|trim');
        $this->form_validation->set_rules('closing_date', 'Closing Date', 'required|trim');
        $this->form_validation->set_rules('trial_name', 'Trial Name', 'required|trim');

        if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect('admin/events_trials');
            
        }
        else
        {

            $event_id            = $this->input->post('event_id');
            $trial_name            = $this->input->post('trial_name');
            $session             = $this->input->post('session');
            $trial_start_date    = $this->input->post('trial_start_date');
            $trial_end_date      = $this->input->post('trial_end_date');
            $officials           = $this->input->post('officials');
            $max_players         = $this->input->post('max_players');
            $facilities            = $this->input->post('facilities');
            $session             = $this->input->post('session');
            $game_id             = $this->input->post('game_id');
            $closing_date        = $this->input->post('closing_date');
            $table_name          = 'events_trials'; 


            $trial_array         = array(

                'event_id'         =>  $event_id,
                'trial_name'       =>  $trial_name,
                'trial_start_date' =>  $trial_start_date,
                'trial_end_date'   =>  $trial_end_date,
                'officials'        =>  $officials,
                'max_players'      =>  $max_players,
                'trial_session'    =>  $session,
                'facilities'       =>  $facilities,
                'game_id'          =>  $game_id,
                'closing_date'     =>  $closing_date,

            );


            $response = $this->model->insert($trial_array,$table_name);
                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');
                    return redirect('admin/events_trials'); 
                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    return redirect('admin/events_trials');
                }
        }
    }

     public function trial_update()

    {
        if($this->input->post())
        {   



            $this->form_validation->set_rules('event_id', 'Event Id', 'required|trim');
            $this->form_validation->set_rules('trial_start_date', 'Trial Start Date', 'required|trim');
            $this->form_validation->set_rules('trial_end_date', 'Trial End Date', 'required|trim');
            $this->form_validation->set_rules('max_players', 'Max Players', 'required|trim');
            $this->form_validation->set_rules('officials', 'Officials', 'required|trim');
            $this->form_validation->set_rules('facilities', 'Facility', 'required|trim');
            $this->form_validation->set_rules('session', 'Session', 'required|trim');
            $this->form_validation->set_rules('game_id', 'Game Name', 'required|trim');
            $this->form_validation->set_rules('closing_date', 'Closing Date', 'required|trim');
            $this->form_validation->set_rules('trial_name', 'Trial Name', 'required|trim');

            $event_id            = $this->input->post('event_id');
            $trial_name          = $this->input->post('trial_name');
            $session             = $this->input->post('session');
            $trial_start_date    = $this->input->post('trial_start_date');
            $trial_end_date      = $this->input->post('trial_end_date');
            $officials           = $this->input->post('officials');
            $max_players         = $this->input->post('max_players');
            $facilities          = $this->input->post('facilities');
            $session             = $this->input->post('session');
            $game_id             = $this->input->post('game_id');
            $closing_date        = $this->input->post('closing_date');
            $table_name          = "events_trials";
            $talbe_column_name   = 'trial_id';
            $table_id            = $this->input->post('edit_trial_id');

        
            if ($this->form_validation->run() == FALSE)
            {
                $error   = array('error' => validation_errors());
                $message = implode(" ",$error);
                $this->messages('alert-danger',$message);
                return redirect('admin/events_trials');
                
            }
            else
            {

            $update_trial_array         = array(

                
                'event_id'         =>  $event_id,
                'trial_name'       =>  $trial_name,
                'trial_start_date' =>  $trial_start_date,
                'trial_end_date'   =>  $trial_end_date,
                'officials'        =>  $officials,
                'max_players'      =>  $max_players,
                'trial_session'    =>  $session,
                'facilities'       =>  $facilities,
                'game_id'          =>  $game_id,
                'closing_date'     =>  $closing_date,


            );


                $response = $this->model->update($update_trial_array,$table_name,$talbe_column_name,$table_id);
                    if($response == true)
                    {
                        $this->messages('alert-success','Successfully Update');
                        return redirect('admin/events_trials'); 
                    }
                    else
                    {
                        $this->messages('alert-danger','Some Thing Wrong');
                        return redirect('admin/events_trials');
                    }
            }
        }
    }

     public function get_ajax_trial($event_trial_id)
    { 
        $single_trial = $this->model->get_single_trials($event_trial_id);
        echo json_encode($single_trial); exit;      
    }


    public function trial_delete($trial_id= null)
    {
        if($trial_id > 0)
        {   
            $talbe_column_name = 'trial_id';
            $table_name        = 'events_trials';
            $table_id          = $trial_id; 
            $update_trial_array   = array('is_active'=> 0);
            $response = $this->model->update($update_trial_array,$table_name,$talbe_column_name,$table_id); 
            if($response == true)
            {
                $this->messages('alert-success','Successfully Deleted');
                return redirect('admin/events_trials'); 
            }
            else
            {
                $this->messages('alert-danger','Some Thing Wrong');
                return redirect('admin/events_trials');
            }
        }
    }
     public function get_ajax_event_game($event_id)
    { 
        $event_games = $this->model->get_event_games($event_id); 

        echo json_encode($event_games); exit;      
    }

     public function get_ajax_event_trials($event_id)
    { 
        $event_trials = $this->model->get_event_trials($event_id); 

        echo json_encode($event_trials); exit;      
    }

    public function get_ajax_event_trial_game($event_trial_id)
    { 
        $trial_game = $this->model->get_event_trial_game($event_trial_id); 
        echo json_encode($trial_game); exit;      
    }


    //================= Trials end ==========

    //===============facility start==================

     public function facilities()
    {

        $this->check_role_privileges('facilities',$this->session->userdata('user_role_id_fk'));

        
        $table             = 'facilities';
        $data['facilities']    = $this->model->get_all_records($table);
        $data['title']     = 'Facilities';
        $data['page']      = 'facilities';
        $this->load->view('template',$data);
    }

    public function facility_insert()
    {

        $this->form_validation->set_rules('facility_name', 'FacilityName', 'required|trim|is_unique[facilities.facility_name]');
        $this->form_validation->set_rules('facility_description', 'Facility Description', 'required|trim');

        if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect('admin/facilities');
            
        }
        else
        {

            $facility_name          = $this->input->post('facility_name');
            $facility_description   = $this->input->post('facility_description');
            $table_name             = 'facilities'; 


            $facility_array = array(

                'facility_name'         =>  $facility_name,
                'facility_description'  =>  $facility_description,

            );


            $response = $this->model->insert($facility_array,$table_name);
                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');
                    return redirect('admin/facilities'); 
                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    return redirect('admin/facilities');
                }
        }
    }

    public function facility_update()
    {
        if($this->input->post('facility_id'))
        {   

           $this->form_validation->set_rules('facility_name', 'Event Name', 'required|trim|is_unique[events.event_title]');
           $this->form_validation->set_rules('facility_description', 'Facility Description', 'required|trim');

            $facility_name          = $this->input->post('facility_name',true);
            $facility_id               = $this->input->post('facility_id',true);
            $facility_description   = $this->input->post('facility_description');
            $table_name             = "facilities";
            $talbe_column_name      = 'facility_id';
            $table_id               = $facility_id;

        
            if ($this->form_validation->run() == FALSE)
            {
                $error   = array('error' => validation_errors());
                $message = implode(" ",$error);
                $this->messages('alert-danger',$message);
                return redirect('admin/facilities');
                
            }
            else
            {

            $facility_array = array(

                'facility_name'         =>  $facility_name,
                'facility_description'  =>  $facility_description,

            );

                $response = $this->model->update($facility_array,$table_name,$talbe_column_name,$table_id);
                    if($response == true)
                    {
                        $this->messages('alert-success','Successfully Update');
                        return redirect('admin/facilities'); 
                    }
                    else
                    {
                        $this->messages('alert-danger','Some Thing Wrong');
                        return redirect('admin/facilities');
                    }
            }
        }
    }


     public function facility_delete($facility_id= null)
    {
        if($facility_id > 0)
        {   
            $talbe_column_name    = 'facility_id';
            $table_name           = 'facilities';
            $table_id             = $facility_id; 
            $update_facility_array   = array('is_active'=> 0);
            $response = $this->model->update($update_facility_array,$table_name,$talbe_column_name,$table_id); 
            if($response == true)
            {
                $this->messages('alert-success','Successfully Deleted');
                return redirect('admin/facilities'); 
            }
            else
            {
                $this->messages('alert-danger','Some Thing Wrong');
                return redirect('admin/facilities');
            }
        }
    }

     public function get_ajax_facility($facility_id)
    { 
        $table_name        = "facilities";
        $talbe_column_name = 'facility_id';
        $table_id          = $facility_id;

        $facility = $this->model->exist_record_row($talbe_column_name,$table_id,$table_name);  // get row
        echo json_encode($facility); exit;      
    }

    //==================Events start =========================

     public function events()
    {

        $this->check_role_privileges('events',$this->session->userdata('user_role_id_fk'));

        $table1             = 'events';
        $table2             = 'games';
        $data['events']    = $this->model->get_events($table1);
        $data['games']     = $this->model->get_all_records($table2);
        $data['title']     = 'Events';
        $data['page']      = 'events';
        $this->load->view('template',$data);
    }
    //==================Events end =========================

    public function event_insert()
    {

        $this->form_validation->set_rules('event_name', 'Event Name', 'required|trim|is_unique[events.event_title]');
       // $this->form_validation->set_rules('game_id', 'Game Name', 'required|trim');
        $this->form_validation->set_rules('event_start_date', 'Event Start Date', 'required|trim');
        $this->form_validation->set_rules('event_end_date', 'Event End Date', 'required|trim');
        $this->form_validation->set_rules('event_year', 'Event Year', 'required|trim');

        if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect('admin/events');
            
        }
        else
        {

            $event_name          = $this->input->post('event_name');
            $game_id             = $this->input->post('game_id');
            $event_year          = $this->input->post('event_year');
            $event_start_date    = $this->input->post('event_start_date');
            $event_end_date      = $this->input->post('event_end_date');
            $table_name          = 'events'; 


            $event_array         = array(

                'event_title'      =>  $event_name,
                'session'          =>  $event_year,
                'event_start_date' =>  $event_start_date,
                'event_end_date'   =>  $event_end_date,

            );



            $response = $this->model->insert($event_array,$table_name);
            $event_id = $this->db->insert_id();

            $table_name1 = 'events_games';

             /* for insert into multiple games */
            for($i=0; $i < count($game_id); $i++){
                $event_games_array1    = array(
                'game_id'    =>  $game_id[$i],
                'event_id'   =>  $event_id,
            );


             $this->model->insert($event_games_array1,$table_name1);


        }

                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');
                    return redirect('admin/events'); 
                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    return redirect('admin/events');
                }


        }
    }

    public function event_update()
    {
        if($this->input->post('event_id'))
        {   

            $this->form_validation->set_rules('event_name', 'Event Name', 'required|trim|is_unique[events.event_title]');
            $this->form_validation->set_rules('game_id', 'Game name', 'required|trim');
            $this->form_validation->set_rules('event_start_date', 'Event Start Date', 'required|trim');
            $this->form_validation->set_rules('event_end_date', 'Event End Date', 'required|trim');
            $this->form_validation->set_rules('event_year', 'Event Year', 'required|trim');

            $event_name          = $this->input->post('event_name');
            $game_id             = $this->input->post('game_id');
            $event_id            = $this->input->post('event_id');
            $event_year          = $this->input->post('event_year');
            $event_start_date    = $this->input->post('event_start_date');
            $event_end_date      = $this->input->post('event_end_date');
            $table_name          = "events";
            $talbe_column_name   = 'event_id';
            $table_id            = $event_id;

        
            if ($this->form_validation->run() == FALSE)
            {
                $error   = array('error' => validation_errors());
                $message = implode(" ",$error);
                $this->messages('alert-danger',$message);
                return redirect('admin/events');
                
            }
            else
            {

            $event_array         = array(

                'event_title'      =>  $event_name,
                'game_id'          =>  $game_id,
                'session'          =>  $event_year,
                'event_start_date' =>  $event_start_date,
                'event_end_date'   =>  $event_end_date,

            );
                $response = $this->model->update($event_array,$table_name,$talbe_column_name,$table_id);
                    if($response == true)
                    {
                        $this->messages('alert-success','Successfully Update');
                        return redirect('admin/events'); 
                    }
                    else
                    {
                        $this->messages('alert-danger','Some Thing Wrong');
                        return redirect('admin/events');
                    }
            }
        }
    }


     public function event_delete($event_id= null)
    {
        if($event_id > 0)
        {   
            $talbe_column_name = 'event_id';
            $table_name        = 'events';
            $table_id          = $event_id; 
            $update_event_array   = array('is_active'=> 0);
            $response = $this->model->update($update_event_array,$table_name,$talbe_column_name,$table_id); 
            if($response == true)
            {
                $this->messages('alert-success','Successfully Deleted');
                return redirect('admin/events'); 
            }
            else
            {
                $this->messages('alert-danger','Some Thing Wrong');
                return redirect('admin/events');
            }
        }
    }

     public function get_ajax_event($event_id)
    { 
        $table_name        = "events";
        $talbe_column_name = 'event_id';
        $table_id          = $event_id;

        $events = $this->model->exist_record_row($talbe_column_name,$table_id,$table_name);  // get row
        echo json_encode($events); exit;      
    }

    ////////game start //////////////

    public function games()
    {



        $this->check_role_privileges('games',$this->session->userdata('user_role_id_fk')); 
        $table             = 'games';
        $data['games']    = $this->model->get_all_records($table);
        $data['title']     = 'Games';
        $data['page']      = 'games';
        $this->load->view('template',$data);
    }
    

    public function game_insert()
    {

        $this->form_validation->set_rules('game_name', 'Game Name', 'required|trim|is_unique[games.game_name]');
        $this->form_validation->set_rules('game_fee', 'Game Fee', 'required|trim');
        $this->form_validation->set_rules('game_admission_fee', 'Game Admission Fee', 'required|trim');
        $this->form_validation->set_rules('game_description', 'Game Description', 'required|trim');
        if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect('admin/games');
            
        }
        else
        {

            $game_name           = $this->input->post('game_name');
            $game_fee            = $this->input->post('game_fee');
            $game_admission_fee  = $this->input->post('game_admission_fee');
            $game_description    = $this->input->post('game_description');
            $table_name          = 'games'; 

            $game_array         = array(

                'game_name'           =>  $game_name,
                'game_fee'            =>  $game_fee,
                'game_admission_fee'  =>  $game_admission_fee,
                'game_description'    =>  $game_description,

            );


            $response = $this->model->insert($game_array,$table_name);
                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');
                    return redirect('admin/games'); 
                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    return redirect('admin/games');
                }
        }
    }

    public function game_update()
    { 
        if($this->input->post('game_id'))
        {   

            $this->form_validation->set_rules('game_name', 'Game Name', 'required|trim');
            $this->form_validation->set_rules('game_fee', 'Game Fee', 'required|trim');
            $this->form_validation->set_rules('game_admission_fee', 'Game Admission Fee', 'required|trim');
            $this->form_validation->set_rules('game_description', 'Game Description', 'required|trim');

            $game_name           = $this->input->post('game_name');
            $game_fee            = $this->input->post('game_fee');
            $game_admission_fee  = $this->input->post('game_admission_fee');
            $game_id             = $this->input->post('game_id');
            $game_description    = $this->input->post('game_description');
            $table_name          = "games";
            $talbe_column_name   = 'game_id';
            $table_id            = $game_id;

        
            if ($this->form_validation->run() == FALSE)
            {
                $error   = array('error' => validation_errors());
                $message = implode(" ",$error);
                $this->messages('alert-danger',$message);
                return redirect('admin/games');
                
            }
            else
            {

            $game_array         = array(

                'game_name'            =>  $game_name,
                'game_fee'             =>  $game_fee,
                'game_admission_fee'   =>  $game_admission_fee,
                'game_description'     =>  $game_description,
               

            );
                $response = $this->model->update($game_array,$table_name,$talbe_column_name,$table_id);
                    if($response == true)
                    {
                        $this->messages('alert-success','Successfully Update');
                        return redirect('admin/games'); 
                    }
                    else
                    {
                        $this->messages('alert-danger','Some Thing Wrong');
                        return redirect('admin/games');
                    }
            }
        }
    }


     public function game_delete($game_id= null)
    {
        if($game_id > 0)
        {   

           


            $talbe_column_name = 'game_id';
            $table_name        = 'games';
            $table_id          = $game_id; 
            $update_game_array   = array('is_active'=> 0);
            $response = $this->model->update($update_game_array,$table_name,$talbe_column_name,$table_id); 

            if($response == true)
            {
                $this->messages('alert-success','Successfully Deleted');
                return redirect('admin/games'); 
            }
            else
            {
                $this->messages('alert-danger','Some Thing Wrong');
                return redirect('admin/games');
            }
        }
    }

     public function get_ajax_game($game_id)
    {
        $table_name        = "games";
        $talbe_column_name = 'game_id';
        $table_id          = $game_id;

        $games = $this->model->exist_record_row($talbe_column_name,$table_id,$table_name);  // get row
        echo json_encode($games);

         exit;      
    }

    ////////game end //////////////


    



    
    //==========================================================================
    // district
    //==========================================================================
    
    public function districts()
    {

        $this->check_role_privileges('districts',$this->session->userdata('user_role_id_fk'));

        $table_name = 'districts';
        $data['districts'] = $this->model->get_all_records($table_name);
        $data['title']    = 'KPK Districts';
        $data['page']     = 'districts';
        $this->load->view('template',$data);
    }
    public function districts_edit_model($district_id)
    {
            $table_name        = "districts";
            $talbe_column_name = 'district_id';
            $table_id          = $district_id;

            $districts = $this->model->exist_record_row($talbe_column_name,$table_id,$table_name);  // get row
            echo json_encode($districts); exit(); 
    }

    public function district_insert(){

        {

        $this->form_validation->set_rules('district_name', 'District Name', 'required|trim|is_unique[districts.district_name]');
        if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect('admin/districts');
            
        }
        else
        {

            $district_name          = $this->input->post('district_name');
            $table_name             = 'districts'; 

            $district_array         = array(

                'district_name'        =>  $district_name,

            );


            $response = $this->model->insert($district_array,$table_name);
                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');
                    return redirect('admin/districts'); 
                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    return redirect('admin/districts');
                }
        }
    }


    }
    public function district_update()
    {
        if($this->input->post('district_id'))
        {
            $this->form_validation->set_rules('district_id', 'District Name', 'required|trim');
            $this->form_validation->set_rules('district_status', 'District Status', 'required|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $error   = array('error' => validation_errors());
                $message = implode(" ",$error);
                $this->messages('alert-danger',$message);
                return redirect('admin/districts');
                
            }
            else
            {
                $district_id    = $this->input->post('district_id');
                $district_name   = $this->input->post('district_name');
                $district_status = $this->input->post('district_status');

                $update_district_array   = array('district_name'=>$district_name,'is_active'=>$district_status);
                $table_name        = 'districts';
                $talbe_column_name = 'district_id';
                $table_id          = $district_id;
                $response = $this->model->update($update_district_array,$table_name,$talbe_column_name,$table_id);
                    if($response == true)
                    {
                        $this->messages('alert-success','Successfully Update');
                        return redirect('admin/districts'); 
                    }
                    else
                    {
                        $this->messages('alert-danger','Some Thing Wrong');
                        return redirect('admin/districts');
                    }
            }
        }
    }


    //////Selected Player start//////////

    public function selected_players()
    {


        $this->check_role_privileges('selected_players',$this->session->userdata('user_role_id_fk'));

        
        $type                        = 'player';
        $data['selected_players']    = $this->model->get_selected_officals_players($type);

        $table_name = 'districts';
        $data['districts'] = $this->model->get_all_records($table_name);

        $table                   = 'events';
        $data['events']          = $this->model->get_all_records($table);

        $table                   = 'events_trials';
        $data['events_trials']   = $this->model->get_trials();


        $data['title']     = 'Selected Players';
        $data['page']      = 'selected_players';
        $this->load->view('template',$data);
    }


   

    //////Selected Player end//////////


/////// selected officals start //////////



    public function selected_officals()
    {

        $this->check_role_privileges('selected_officals',$this->session->userdata('user_role_id_fk'));  


        $type                         = 'offical';
        $data['selected_officals']    = $this->model->get_selected_officals_players($type);

    

        $table_name = 'districts';
        $data['districts'] = $this->model->get_all_records($table_name);

        $table               = 'events';
        $data['events']      = $this->model->get_all_records($table);

        $data['title']     = 'Selected Officals';
        $data['page']      = 'selected_officals';
        $this->load->view('template',$data);
    }

//////////seelcted officals end//////////


     public function selected_player_offical_insert($type){

            if($type == 'player'){

                $type = 'player';
            }
            else{
                $type = 'offical';
            }

        if($this->input->post()){
        $this->form_validation->set_rules('event_id', 'Event Name', 'required|trim');
        $this->form_validation->set_rules('event_trial_id', 'Event Trial Name', 'required|trim');
        //$this->form_validation->set_rules('game_id', 'Game Name', 'required|trim');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('father_name', 'Father Name', 'required|trim');
        $this->form_validation->set_rules('cnic', 'CNIC', 'required|trim');
        $this->form_validation->set_rules('age', 'AGE', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        $this->form_validation->set_rules('category', 'Category', 'required|trim');
        $this->form_validation->set_rules('district_id', 'District', 'required|trim');
        $this->form_validation->set_rules('domicle_id', 'Domicle', 'required|trim');
        $this->form_validation->set_rules('physical_status', 'Physical Status', 'required|trim');
        $this->form_validation->set_rules('physical_status', 'Physical Status', 'required|trim');

        if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            if($type == 'player'){

               return redirect('admin/selected_players');
            }
            else{
               return redirect('admin/selected_officals');
            }
            
            
        }
        else
        {

            $event_id            = $this->input->post('event_id');
            $event_trial_id      = $this->input->post('event_trial_id');
           // $game_id             = $this->input->post('game_id');die;
            $name                = $this->input->post('name');
            $father_name         = $this->input->post('father_name');
            $cnic                = $this->input->post('cnic');
            $age                 = $this->input->post('age');
            $gender              = $this->input->post('gender');
            $category            = $this->input->post('category');
            $district_id         = $this->input->post('district_id');
            $domicle_id          = $this->input->post('domicle_id');
            $physical_status     = $this->input->post('physical_status');
            $table_name          = 'selected_players_officials'; 

            $players_officials_array = array(

                'name'            => $name,   
                'father_name'     => $father_name,
                'cnic'            => $cnic,
                'age'             => $age,
                'gender'          => $gender,
                'physical_status'  => $physical_status,
                'category'        => $category,
                'domicle'         => $domicle_id,
                'district_id'     => $district_id,
                'event_id'        => $event_id,
                //'game_id'       => $game_id,
                'event_trial_id'  => $event_trial_id,
                'type'            => $type,
                'user_id'         => $this->session->userdata('user_id')
            );


            $response = $this->model->insert($players_officials_array,$table_name);
                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');

                            if($type == 'player'){

                       return redirect('admin/selected_players');
                    }
                    else{
                       return redirect('admin/selected_officals');
                    }


                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    if($type == 'player'){

                           return redirect('admin/selected_players');
                        }
                        else{
                           return redirect('admin/selected_officals');
                        }
                }
        }
    }
}


public function selected_player_offical_delete($type,$player_offical_id){

    {
        if($player_offical_id > 0)
        {   
            if($type == 'player'){

                $type = 'player';
            }
            else{

                $type = 'offical';
            }

            $talbe_column_name = 'player_offical_id';
            $table_name        = 'selected_players_officials';
            $table_id          = $player_offical_id; 
            $update_players_officials = array('is_active'=> 0);

            $response = $this->model->update($update_players_officials,$table_name,$talbe_column_name,$table_id); 


            if($response == true)
                {
                    $this->messages('alert-success','Successfully Deleted');

                            if($type == 'player'){

                       return redirect('admin/selected_players');
                    }
                    else{
                       return redirect('admin/selected_officals');
                    }


                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    if($type == 'player'){

                           return redirect('admin/selected_players');
                        }
                        else{
                           return redirect('admin/selected_officals');
                        }
                }
        }
    }
}

public function get_ajax_officals_player($player_offical_id,$type)
    { 

        $single_officals_player = $this->model->get_single_selected_officals_player($player_offical_id,$type);
        echo json_encode($single_officals_player); exit;      
    }


     public function selected_player_offical_update($type){


            if($type == 'player'){

                $type = 'player';
            }
            else{
                $type = 'offical';
            }

        if($this->input->post()){
        $this->form_validation->set_rules('event_id', 'Event Name', 'required|trim');
        $this->form_validation->set_rules('event_trial_id', 'Event Trial Name', 'required|trim');
       // $this->form_validation->set_rules('game_id', 'Game Name', 'required|trim');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('father_name', 'Father Name', 'required|trim');
        $this->form_validation->set_rules('cnic', 'CNIC', 'required|trim');
        $this->form_validation->set_rules('age', 'AGE', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        $this->form_validation->set_rules('category', 'Category', 'required|trim');
        $this->form_validation->set_rules('district_id', 'District', 'required|trim');
        $this->form_validation->set_rules('domicle_id', 'Domicle', 'required|trim');
        $this->form_validation->set_rules('physical_status', 'Physical Status', 'required|trim');
        $this->form_validation->set_rules('physical_status', 'Physical Status', 'required|trim');

        if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            if($type == 'player'){

               return redirect('admin/selected_players');
            }
            else{
               return redirect('admin/selected_officals');
            }
            
            
        }
        else
        {

            $player_offical_id   = $this->input->post('player_offical_id');
            $event_id            = $this->input->post('event_id');
            $event_trial_id      = $this->input->post('event_trial_id');
           // $game_id             = $this->input->post('game_id');die;
            $name                = $this->input->post('name');
            $father_name         = $this->input->post('father_name');
            $cnic                = $this->input->post('cnic');
            $age                 = $this->input->post('age');
            $gender              = $this->input->post('gender');
            $category            = $this->input->post('category');
            $district_id         = $this->input->post('district_id');
            $domicle_id          = $this->input->post('domicle_id');
            $physical_status     = $this->input->post('physical_status');
            $table_name          = 'selected_players_officials'; 
            $talbe_column_name   = 'player_offical_id';
            $table_id            = $player_offical_id;

            $players_officials_update_array = array(

                'name'            => $name,   
                'father_name'     => $father_name,
                'cnic'            => $cnic,
                'age'             => $age,
                'gender'          => $gender,
                'physical_status'  => $physical_status,
                'category'        => $category,
                'domicle'         => $domicle_id,
                'district_id'     => $district_id,
                'event_id'        => $event_id,
                //'game_id'       => $game_id,
                'event_trial_id'  => $event_trial_id,
                'type'            => $type,
                'user_id'         => $this->session->userdata('user_id')
            );


            $response = $this->model->update($players_officials_update_array,$table_name,$talbe_column_name,$table_id);
                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');

                            if($type == 'player'){

                       return redirect('admin/selected_players');
                    }
                    else{
                       return redirect('admin/selected_officals');
                    }


                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    if($type == 'player'){

                           return redirect('admin/selected_players');
                        }
                        else{
                           return redirect('admin/selected_officals');
                        }
                }
        }
    }
}

public function profile()
    {   
        //$this->check_role_privileges('dashboard',$this->session->userdata('user_role_id_fk'));
        $data['title']       = 'User Profile';
        $data['page']        = 'profile';
        $user_role_id_fk     = $this->session->userdata('user_role_id_fk');
        if(empty($user_role_id_fk))
        {
            $this->logout_user();
        } 
        
        $data['profile']  = $this->model->profile($user_role_id_fk); 
        $this->load->view('template',$data);
    }


    public function update_profile()
    { 
        $update_profile = array(
             'user_name'        => $this->input->post('user_name',true),
             'user_email'       => $this->input->post('user_email',true),
             'user_contact'     => $this->input->post('user_contact',true),
             'user_address'     => $this->input->post('user_address',true),
             'user_password'    => md5($this->input->post('confirm',true))
                                );
        $response = $this->model->update($update_profile,'users','user_role_id_fk',$this->session->userdata('user_role_id_fk'));
            if($response == true)
            {
                if($this->input->post('remember') == 'on')
                {
                    $this->messages('alert-success','Please login now');
                    return redirect('admin/logout_user');
                }
                else
                {
                    $this->messages('alert-success','Successfully Update');
                    return redirect('admin/profile');    
                }
                
            }
            else
            {
                $this->messages('alert-danger','Some Thing Wrong');
                return redirect('admin/profile');
            }                       
    }


   


}

?>