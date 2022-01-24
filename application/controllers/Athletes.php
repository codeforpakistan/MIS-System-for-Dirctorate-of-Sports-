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
                $this->session->set_userdata('user_role_id_fk',$response->user_role_id_fk);
                $this->session->set_userdata('user_role_name',$response->user_role_name);
                redirect('/admin/dashboard'); exit();
               
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
    // public function logout_user()
    // {
    //     $this->session->unset_userdata('user_name');
    //     $this->session->unset_userdata('user_id'); 
    //     $this->session->unset_userdata('user_role_id_fk'); 
    //     $this->session->sess_destroy();
    //     $this->clear_cache();
    //     redirect(base_url());
    // }
    
    public function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }


      public function athlete_dashboard()
    {   
        $data['title']          = 'Dashboard';
        $data['page']           = 'athlete_dashboard';
        $this->load->view('template',$data);
    }

    public function athlete_sign_up(){
        $this->load->view('athlete_sign_up'); 
    }


   public function athlete_insert()
    {

        $this->form_validation->set_rules('user_name', 'Username', 'required|trim|is_unique[users.user_name]');
        $this->form_validation->set_rules('user_password', 'Password', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
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
            $user_email           = $this->input->post('email');
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

    


    }