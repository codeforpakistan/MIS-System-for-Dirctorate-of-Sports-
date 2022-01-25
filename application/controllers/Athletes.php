<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Athletes extends CI_Controller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AthletesModel','model');
        $this->load->model('AdminModel','admin_model');
        $this->load->library('auto_no.php','zend');
        $this->load->library('form_validation');
    } 

  public function index()
    { 
        
        if($this->session->userdata('user_role_id_fk'))
        {
            $this->dashboard();
        }
        else
        {
           $this->load->view('athlete_login'); 
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
            $password   = $this->input->post('user_password');
            $array      = array('user_email'=>$user_email,'user_password'=>$password,'user_status'=>1);
            $response   = $this->AuthModel->user_login($array); 

            if(!empty($response))// is user name and passsword valid
               {

                $this->session->set_userdata('user_id',$response->user_id);
                $this->session->set_userdata('user_name',$response->user_name);
                $this->session->set_userdata('user_email',$response->user_email);
                $this->session->set_userdata('user_role_id_fk',$response->user_role_id_fk);
                $this->session->set_userdata('user_role_name',$response->user_role_name);
                redirect('athletes/dashboard'); exit();
               
                } // end is user name and passsword valid
                else // not match ue name and pass
                 {
                    $this->session->set_flashdata('errorMsg', "Useremail Or Password Invalid");
                    $this->messages('alert alert-danger',"Useremail Or Password Invalid");
                  //  echo "username or passwrod invalid"; 
                    redirect(base_url('athletes'));
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
        redirect(base_url('athletes'));
    }
    
    public function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }


   //==========================================================================
    // dashboard
    //==========================================================================
    
    public function dashboard()
    {   
        $data['title']          = 'Dashboard';
        $data['page']           = 'dashboard';
        $this->load->view('template',$data);
    }

    public function athlete_sign_up(){
        $this->load->view('athlete_sign_up'); 
    }


   public function athlete_insert()
    {

        $this->form_validation->set_rules('user_email', 'User Email', 'required|trim|is_unique[users.user_email]');
        $this->form_validation->set_rules('user_password', 'Password', 'required|trim');
        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'required|trim');

        if ($this->form_validation->run() == FALSE)
        {
            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect('Athletes/index');
            
        }
        else
        {
            $user_name            = $this->input->post('user_name');
            $user_password        = $this->input->post('user_password');
            $user_email           = $this->input->post('user_email');
            $mobile_number        = $this->input->post('mobile_number');

            $table_name           = 'users';
            $insert_user_array       = array('user_email'=>$user_email,'user_password'=>md5($user_password),'user_role_id_fk'=>5,'user_status'=>1);

            $response = $this->admin_model->insert($insert_user_array,$table_name);
            $last_user_id = $this->db->insert_id();


            $table_name2           = 'athletes';
            $insert_athlete_array  = array('ath_name'=>$user_name,'ath_contact'=>$mobile_number,'user_id' => $last_user_id );

              $this->admin_model->insert($insert_athlete_array,$table_name2);

                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');
                    return redirect('Athletes/index'); 
                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    return redirect('Athletes/index');
                }
        }


    }

    public function application_form(){



        if($this->input->post()){

            $user_id  = $this->session->userdata('user_role_id_fk'); 

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('f_name', 'Father Name', 'required|trim');
        $this->form_validation->set_rules('cnic', 'CNIC', 'required|trim');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('contact', 'Contact', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        $this->form_validation->set_rules('emergency_contact', 'Emergency Contact', 'required|trim');
        $this->form_validation->set_rules('profession', 'Profession', 'required|trim');
        $this->form_validation->set_rules('date_of_apply', 'Date of Apply', 'required|trim');
        $this->form_validation->set_rules('game_id', 'Game', 'required|trim');
        $this->form_validation->set_rules('cnic_front_copy', 'CNIC Picture', 'required|trim');
        $this->form_validation->set_rules('profile_pic', 'Profile Picture', 'required|trim');
        $this->form_validation->set_rules('time_prefernce', 'Time Prefernce', 'required|trim');
        $this->form_validation->set_rules('total_fee', 'Total Fee', 'required|trim');
        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim');

        if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect('admin/events_trials');
            
        }
        else
        {

            $name               = $this->input->post('name');
            $f_name             = $this->input->post('f_name');
            $cnic               = $this->input->post('cnic');
            $dob                = $this->input->post('dob');
            $address            = $this->input->post('address');
            $contact            = $this->input->post('contact');
            $gender             = $this->input->post('gender');
            $emergency_contact  = $this->input->post('emergency_contact');
            $profession         = $this->input->post('profession');
            $date_of_apply      = $this->input->post('date_of_apply');
            $game_id            = $this->input->post('game_id');
            $cnic_front_copy    = $this->input->post('cnic_front_copy');
            $profile_pic        = $this->input->post('profile_pic');
            $time_prefernce     = $this->input->post('time_prefernce');
            $total_fee          = $this->input->post('total_fee');
            $payment_mode       = $this->input->post('payment_mode');
            $table_name         = 'athletes'; 


            $applicantion_array         = array(

                'event_id'         =>  $name,
                'trial_name'       =>  $f_name,
                'trial_start_date' =>  $cnic,
                'trial_end_date'   =>  $dob,
                'officials'        =>  $address,
                'max_players'      =>  $contact,
                'trial_session'    =>  $gender,
                'facilities'       =>  $emergency_contact,
                'game_id'          =>  $profession,
                'closing_date'     =>  $date_of_apply,
                'closing_date'     =>  $profile_pic,
                'closing_date'     =>  $cnic_front_copy,

            );


            $response = $this->model->update($applicantion_array,$table_name);
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



        $data['title'] = 'Application Form';
        $data['page']  = 'application_form';
        $this->load->view('template',$data);
    }

    


    }