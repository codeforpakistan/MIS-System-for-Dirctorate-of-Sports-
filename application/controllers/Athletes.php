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

         // if(!$this->session->userdata('ath_id')){
         //     redirect('athletes');
         // }
    } 

  public function index()
    {         
        if($this->session->userdata('user_role_id_fk'))
        {
            $this->athlete_dashboard();
        }
        else
        {
           $this->load->view('athlete_login'); 
        }
        
    }
    
    public function login_user(){
        $this->form_validation->set_rules('ath_email', 'Useremail', 'required|trim');
        $this->form_validation->set_rules('ath_password', 'Password', 'required|trim');
        if ($this->form_validation->run() == FALSE)
        {
            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect(base_url('athletes'));
            
        }
        else
        {
            $ath_email     = $this->input->post('ath_email');
            $ath_password  = $this->input->post('ath_password');
            $response      = $this->AuthModel->athlete_login($ath_email,$ath_password); 




            if(!empty($response))// is user name and passsword valid
               {

                $this->session->set_userdata('ath_id',$response['ath_id']);
                $this->session->set_userdata('ath_name',$response['ath_name']);
                $this->session->set_userdata('ath_email',$response['ath_email']);
                $this->session->set_userdata('user_role_id_fk',$response['user_role_id_fk']);
                //$this->session->set_userdata('user_role_name',$response->user_role_name);


            if($response['ath_cnic'] > 0){
                redirect('athletes/athlete_dashboard');

            }
            else{

                redirect('athletes/application_form');

            }
               
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
        $this->session->unset_userdata('ath_name');
        $this->session->unset_userdata('ath_email');
        $this->session->unset_userdata('ath_id'); 
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
    
    public function athlete_dashboard()
    {   
         $table           = 'games';
        $data['games']    = $this->admin_model->get_all_records($table);

        $ath_id = $this->session->userdata('ath_id');
        $data['athlete_games']   = $this->model->get_athlete_games($ath_id,$ath_game_id=null); 
        $data['title']          = 'Dashboard';
        $data['page']           = 'athlete_dashboard';
        $this->load->view('template',$data);
    }

    public function athlete_sign_up(){
        $this->load->view('athlete_sign_up'); 
    }


   public function athlete_insert()
    {


        $this->form_validation->set_rules('ath_email', 'User Email', 'required|trim|is_unique[athletes.ath_email]');
        $this->form_validation->set_rules('ath_name',  'User Name', 'required|trim|is_unique[athletes.ath_name]');
        $this->form_validation->set_rules('ath_password', 'Password', 'required|trim');
        $this->form_validation->set_rules('ath_contact', 'Mobile Number', 'required|trim');

        if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect('Athletes/index');
            
        }
        else
        {

            $ath_name             = $this->input->post('ath_name');
            $ath_password         = $this->input->post('ath_password');
            $ath_email            = $this->input->post('ath_email');
            $ath_contact          = $this->input->post('ath_contact');

            $table_name            = 'athletes';
            $insert_athlete_array  = array(

                'ath_name'        => $ath_name,
                'ath_email'       => $ath_email,
                'ath_password'    => md5($ath_password),
                'ath_contact'     => $ath_contact,
                'user_role_id_fk' => 5,
                'is_active'       => 1
            );


            $response = $this->admin_model->insert($insert_athlete_array,$table_name);
          

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

        $ath_id  = $this->session->userdata('ath_id'); 

        if($this->input->post()){

        $more_games = $this->input->post('more_games');

        if($more_games > 0){

        $this->form_validation->set_rules('time_prefernce', 'Time Prefernce', 'required|trim');
        $this->form_validation->set_rules('total_fee', 'Total Fee', 'required|trim');
        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim');

        }
        else{


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
        $this->form_validation->set_rules('district_id', 'District', 'required|trim');
      //  $this->form_validation->set_rules('game_id', 'Game', 'required|trim');
        //$this->form_validation->set_rules('cnic_front_copy', 'CNIC Picture', 'required|trim');
       // $this->form_validation->set_rules('profile_pic', 'Profile Picture', 'required|trim');
        $this->form_validation->set_rules('time_prefernce', 'Time Prefernce', 'required|trim');
        $this->form_validation->set_rules('total_fee', 'Total Fee', 'required|trim');
        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim');

    }

        if ($this->form_validation->run() == FALSE)
        {
            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);

            if($more_games > 0){
            return redirect('Athletes');
}
            else{
                 return redirect('Athletes/application_form');
            }
            
        }
        else
        {


           $cnic_picture        = $_FILES['cnic_front_copy']['name'];
           $profile_picture     = $_FILES['profile_pic']['name'];
            $name                = $this->input->post('name');
            $f_name              = $this->input->post('f_name');
            $cnic                = $this->input->post('cnic');
            $dob                 = $this->input->post('dob');
            $address             = $this->input->post('address');
            $contact             = $this->input->post('contact');
            $gender              = $this->input->post('gender');
            $emergency_contact   = $this->input->post('emergency_contact');
            $profession          = $this->input->post('profession');
            $date_of_apply       = $this->input->post('date_of_apply');
            $district_id         = $this->input->post('district_id');
            $game_id             = $this->input->post('game_id');
            $time_prefernce      = $this->input->post('time_prefernce');
            $total_fee           = $this->input->post('total_fee');
            $payment_mode        = $this->input->post('payment_mode');
            $table_name          = 'athletes'; 
            $talbe_column_name   = 'ath_id';
            $table_id            = $ath_id;

            


            $config = array(
            'upload_path'   => 'assets/images/athlete_images/',
            'allowed_types' => 'png|jpg|jpeg',
            );

            $this->load->library('upload',$config);
            $this->upload->do_upload('cnic_front_copy');
            $this->upload->do_upload('profile_pic');
            
            $applicantion_array         = array(

                        'ath_name'               =>  $name,
                        'ath_father_name'        =>  $f_name,
                        'ath_cnic'               =>  $cnic,
                        'ath_dob'                =>  $dob,
                        'ath_address'            =>  $address,
                        'ath_contact'            =>  $contact,
                        'ath_gender'             =>  $gender,
                        'ath_emergency_contact'  =>  $emergency_contact,
                        'district_id'     => $district_id,
                        'ath_profession'         =>  $profession,
                        'ath_date_apply'         =>  $date_of_apply, 
                        'ath_profile_photo'      =>  $this->upload->data('file_name'),
                        'ath_nic_photo'          =>  $this->upload->data('file_name')

            );

            $response = $this->admin_model->update($applicantion_array,$table_name,$talbe_column_name,$table_id);

            $table_name1 = 'athlete_games';

             /* for insert into multiple games */
            for($i=0; $i < count($game_id); $i++){
                $athlete_games_array1    = array(
                'game_id'                     =>  $game_id[$i],
                'ath_id'                      =>  $ath_id,
                'ath_game_time_preference'    =>  $time_prefernce,
                'ath_game_payment_mode'       =>  $payment_mode,
                'ath_game_total_fee'          =>  $total_fee,
                'ath_game_status'             =>  'pending',
            );


             $this->admin_model->insert($athlete_games_array1,$table_name1);

         }
                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');
                    return redirect('athletes'); 
                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    return redirect('athletes');
                }
    }
}


        $table           = 'games';
        $data['games']    = $this->admin_model->get_all_records($table);

        $table_name = 'districts';
        $data['districts'] = $this->admin_model->get_all_records($table_name);

        $table_name          = "athletes";
        $talbe_column_name   = 'ath_id';
        $table_id            =  $ath_id;
        $data['athlete']    = $this->admin_model->exist_record_row($talbe_column_name,$table_id,$table_name);

        $data['title'] = 'Application Form';
        $data['page']  = 'application_form';
        $this->load->view('template',$data);

    }

    public function athlete_profile()
    {   
        //$this->check_role_privileges('dashboard',$this->session->userdata('user_role_id_fk'));
        $data['title']       = 'User Profile';
        $data['page']        = 'profile';
        $ath_id     = $this->session->userdata('ath_id');

        if(empty($ath_id))
        {
            $this->logout_user();
        } 
        
        $data['athlete_profile']  = $this->model->athlete_profile($ath_id); 

        $this->load->view('template',$data);
    }

    public function update_profile()
    { 

        $update_profile = array(
             'ath_name'        => $this->input->post('user_name'),
             'ath_email'       => $this->input->post('user_email'),
             'ath_contact'     => $this->input->post('user_contact'),
             'ath_address'     => $this->input->post('user_address'),
             'ath_password'    => md5($this->input->post('confirm'))
                                );
        $response = $this->admin_model->update($update_profile,'athletes','user_role_id_fk',$this->session->userdata('user_role_id_fk'));
            if($response == true)
            {
                if($this->input->post('remember') == 'on')
                {
                    $this->messages('alert-success','Please login now');
                    return redirect('athletes/logout_user');
                }
                else
                {
                    $this->messages('alert-success','Successfully Update');
                    return redirect('athletes/athlete_profile');    
                }
                
            }
            else
            {
                $this->messages('alert-danger','Some Thing Wrong');
                return redirect('athletes/athlete_profile');
            }                       
    }

    public function bank_challan($ath_id,$ath_game_id)
    {

        $data['bank_challan']  = $this->model->get_athlete_games($ath_id,$ath_game_id); 
        $data['title'] = 'Bank Copy';
        $data['page']  = 'bank_challan';
        $this->load->view('template',$data);
    }


}