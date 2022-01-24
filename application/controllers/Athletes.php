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
        
        // if($this->session->userdata('user_role_id_fk'))
        // {
        //     $this->athlete_dashboard();
        // }
        // else
        // {
           $this->load->view('athlete_login'); 
       // }
        
    }
    
    public function login_user()
    {   
        $this->form_validation->set_rules('user_name', 'Username', 'required|trim');
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
            $username = $this->input->post('user_name');
            $password = $this->input->post('user_password');
            //$array    = array('user_name'=>$username,'user_password'=>$password,'user_status'=>1);

            // $response = $this->AuthModel->user_login($array); 

            // // print_r($response);die;
            // if(!empty($response))// is user name and passsword valid
            //    {

            //     $this->session->set_userdata('user_id',$response->user_id);
            //     $this->session->set_userdata('user_name',$response->user_name);
            //     $this->session->set_userdata('user_role_id_fk',$response->user_role_id_fk);
            //     $this->session->set_userdata('user_role_name',$response->user_role_name);
            //     redirect('/admin/dashboard'); exit();
               
            //     } // end is user name and passsword valid
            //     else // not match ue name and pass
            //      {
            //         $this->session->set_flashdata('errorMsg', "Username Or Password Invalid");
            //         $this->messages('alert alert-danger',"Username Or Password Invalid");
            //       //  echo "username or passwrod invalid"; 
            //         redirect(base_url());
            //         exit();
            //      }  //end // not match ue name and pass 
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

        // if($this->input->post('user_role_id_fk') == 5) // to for District admin
        // {
        //     $this->form_validation->set_rules('district_id', 'District selection', 'required|trim');
        // } 

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
            $user_password        = $this->input->post('email');
            $user_password        = $this->input->post('mobile_number');
            $user_district_id_fk  = (empty($this->input->post('district_id'))? 0:$this->input->post('district_id'));
            $user_role_id_fk      = $this->input->post('user_role_id_fk');
            $table_name           = 'users';
            $insert_user_array       = array('user_name'=>$user_name,'user_password'=>md5($user_password),'user_role_id_fk'=>5,'user_status'=>1);
            $table_name           = 'users';

            $response = $this->admin_model->insert($insert_user_array,$table_name);

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