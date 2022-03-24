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
            $this->athlete_dashboard();
        }
        else
        {
           $this->load->view('athlete_login'); 
        }
        
    }
    
    public function login_user(){
        $this->form_validation->set_rules('ath_email_mobile', 'Useremail', 'required|trim');
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
             $ath_email_mobile   = $this->input->post('ath_email_mobile');
             $ath_password       = $this->input->post('ath_password');
             $response           = $this->AuthModel->athlete_login($ath_email_mobile,$ath_password); 


            if(!empty($response))// is user name and passsword valid
               {               
                $this->session->set_userdata('ath_id',$response['ath_id']);
                $this->session->set_userdata('ath_name',$response['ath_name']);
                $this->session->set_userdata('ath_email',$response['ath_email']);
                $this->session->set_userdata('user_role_id_fk',$response['user_role_id_fk']);
                $this->session->set_userdata('prifile_image',$response['ath_profile_photo']);
              

            if($response['ath_cnic'] > 0 || $response['user_role_id_fk'] == 6 ){
                redirect('athletes/athlete_dashboard');


            }
            else{


                redirect('athletes/application_form');

            }
               
                } // end is user name and passsword valid
                else // not match ue name and pass
                 {
                    $this->session->set_flashdata('errorMsg', "Useremail or password invalid");
                    $this->messages('alert alert-danger',"Useremail or password invalid");
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

        $table            = 'games';
        $data['games']    = $this->admin_model->get_all_records($table);

        $ath_id = $this->session->userdata('ath_id');
        $data['athlete_games']   = $this->model->get_athlete_games($ath_id);

        $data['athlete_games_fee']   = $this->model->get_athlete_games_fees($ath_id);


        $data['title']  = 'Dashboard';
        $data['page']   = 'athlete_dashboard';
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

        $date_of_apply = date('Y-m-d');

        $more_games = $this->input->post('more_games');

        if(!empty($more_games)){
        //$this->form_validation->set_rules('game_id', 'Name', 'required|trim');
       $this->form_validation->set_rules('time_prefernce', 'Time Prefernce', 'required|trim');
       $this->form_validation->set_rules('game_fee', 'Game Fee', 'required|trim');
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
        $this->form_validation->set_rules('district_id', 'District', 'required|trim');     
        $this->form_validation->set_rules('time_prefernce', 'Time Prefernce', 'required|trim');
        $this->form_validation->set_rules('game_fee', 'Game Fee', 'required|trim');
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

            if(empty($more_games))
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
            $district_id         = $this->input->post('district_id');
            $table_name          = 'athletes'; 
            $talbe_column_name   = 'ath_id';
            $table_id            = $ath_id;

            $config['upload_path'] = 'assets/images/athlete_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['encrypt_name']  = TRUE;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            $this->upload->do_upload('cnic_front_copy');
            $upload_cnic_data = $this->upload->data(); 
            $file_name1 = $upload_cnic_data['file_name'];


            $config['upload_path'] = 'assets/images/athlete_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['encrypt_name']  = TRUE;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            $this->upload->do_upload('profile_pic');
            $upload_profile_data = $this->upload->data(); 
            $file_name2 = $upload_profile_data['file_name'];

            
            $applicantion_array  = array(

            'ath_name'               =>  $name,
            'ath_father_name'        =>  $f_name,
            'ath_cnic'               =>  $cnic,
            'ath_dob'                =>  $dob,
            'ath_address'            =>  $address,
            'ath_contact'            =>  $contact,
            'ath_gender'             =>  $gender,
            'ath_emergency_contact'  =>  $emergency_contact,
            'district_id'            =>  $district_id,
            'ath_profession'         =>  $profession,
            'ath_profile_photo'      =>  $file_name2,
            'ath_nic_photo'          =>  $file_name1

            );

            $response = $this->admin_model->update($applicantion_array,$table_name,$talbe_column_name,$table_id);
}
            $ath_game_table = 'athlete_games';

            $game_id             = $this->input->post('game_id');
            $time_prefernce      = $this->input->post('time_prefernce');
            $payment_mode        = $this->input->post('payment_mode');
            $total_fee           = $this->input->post('total_fee');

           

             /* for insert into multiple games */

            for($i=0; $i < count($game_id); $i++){
                $game_table          = 'games';
                $talbe_column_name   = 'game_id';
                $table_id            = $game_id[$i];
                $data['games']       = $this->admin_model->exist_record_row($talbe_column_name,$table_id,$game_table);

                $challan_fee               = $data['games']['game_fee'];
                $ath_challan_admission_fee = $data['games']['game_admission_fee']; 

                $athlete_games_array1    = array(
                'game_id'                     =>  $game_id[$i],
                'ath_id'                      =>  $ath_id,
                'ath_game_time_preference'    =>  $time_prefernce,
                'ath_game_fee            '    =>  $challan_fee,
                'ath_game_admission_fee'      =>  $ath_challan_admission_fee,
                'ath_game_apply_date'         =>  $date_of_apply,
                'ath_game_status'             =>  1,
            );

            $this->admin_model->insert($athlete_games_array1,$ath_game_table);

            $ath_game_id    = $this->db->insert_id();
            $expire_date    =  date('Y-m-d', strtotime($date_of_apply . "+1 months"));
            $fee_table_name = "athlete_games_fees"; 

            $challan_no   =  new auto_no();
            $challan_no   = $challan_no->get_auto_num('challan','auto_no');
            $athlete_games_fees    = array(
                'ath_payment_mode'          =>  $payment_mode,
                'ath_challan_no'            =>  $challan_no,
                'ath_fee_status'            =>  1,
                'ath_fee_months'            =>  '1 Month',
                'ath_challan_fee'           =>  $challan_fee,
                'ath_challan_admission_fee' =>  $ath_challan_admission_fee,
                'ath_game_id'               =>  $ath_game_id,
                'fee_monthly_start_date'    =>  $date_of_apply,
                'fee_monthly_end_date'      =>  $expire_date
            );

              $this->admin_model->insert($athlete_games_fees,$fee_table_name);
              $this->model->set_auto_no('challan');


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

    public function bank_challan($ath_id = null,$ath_game_fee_id = null)
    {


        $data['bank_challan']  = $this->model->athlete_games_fees_challans($ath_id,$ath_game_fee_id,null);
        $data['title']         = 'Bank Copy';
       // $data['page']          = 'bank_challan';
        $this->load->view('bank_challan',$data);
    }

    public function upload_challan()
    {
        if($this->input->post()){

            $ath_game_fee_id = $this->input->post('ath_game_fee_id',true);
            $challan_no      = $this->input->post('challan_no',true);


            $challan        = $_FILES['Upload_challan']['name'];

            if($challan == ''){
                redirect('athletes/athlete_dashboard');
            }

            else{

            $config = array(
            'upload_path'   => 'assets/images/challan/',
            'allowed_types' => 'png|jpg|jpeg',
            );

            $this->load->library('upload',$config);
            $this->upload->do_upload('Upload_challan');

            $data = array(

                'ath_challan_no'     => $challan_no,
                'ath_upload_challan' => $this->upload->data('file_name'),
            );

            $this->db->where('ath_game_fee_id',$ath_game_fee_id)->update('athlete_games_fees',$data);
            $this->messages('alert-success','Challan Uploaded');
            redirect('athletes/athlete_dashboard');
            }
        }
    }

     public function get_ajax_multiple_game()
    { 

        $game_id = $this->input->post('game_id');
        $total_fee = 0;
        $admision_fee = 0;
        $game_fee = 0;
        $games = array();

        for($i=0; $i < count($game_id); $i++){


        $table_name        = "games";
        $talbe_column_name = 'game_id';
        $table_id          = $game_id[$i];
        
        $games      = $this->admin_model->exist_record_row($talbe_column_name,$table_id,$table_name);

        $game_fee         += $games['game_fee'];
        $admision_fee     += $games['game_admission_fee'];
    }

        $games['total_fee']     = $admision_fee+$game_fee;
         echo json_encode($games);

         exit;   

          
    }


    // :::::::::::::::::: update user profile

    // function user_profile()
    // {
    //     // $this->load->view('user_profile');
    //     //$this->check_role_privileges('dashboard',$this->session->userdata('user_role_id_fk'));
    //     $data['title']       = 'User Profile';
    //     $data['page']        = 'user_profile';
    //     $ath_id     = $this->session->userdata('ath_id');
        
    //     $data['athlete_profile']  = $this->model->athlete_profile($ath_id); 

    //     $this->load->view('template',$data);
    // }

    public function user_profile()
    {   
        $data['title']       = 'User Profile';
        $data['page']        = 'user_profile';
        $user_role_id_fk     = $this->session->userdata('ath_id');
        if(empty($user_role_id_fk))
        {
            $this->logout_user();
        }       
        $this->load->view('template',$data);
    } 
    //==========================================================================
    // profile info ajax
    //==========================================================================

    public function profle_info()
    {   
        $user_role_id_fk = $this->session->userdata('user_role_id_fk');
        $profile         = $this->model->profile($user_role_id_fk);      
        echo json_encode($profile); exit;
    }

    function update_profile_users()
    { 
        $old_password = $this->input->post('old_password');
        $user_id      = $this->session->userdata('ath_id');
        // check user session is available
            if($user_id > 0)
            {
            $user_password = $this->model->user_password($user_id);
                if(md5($old_password) !== $user_password) 
                {
                    echo "Invalid Old  Password"; exit;
                }
            }
            else
            {
                echo "Please login now"; exit;
            }
            // ::::::::::: profile image 
                $uploadPath     = 'assets/images/athlete_images';
                $this->load->library('image_lib');
                    if (!file_exists($uploadPath)) 
                    {
                        mkdir($uploadPath);
                        chmod($uploadPath, 0777);
                    }
                if (!empty($_FILES['attachment']['name']))
                {
                    $this->load->library('upload');
                    $config['upload_path']   = $uploadPath;
                    $config['allowed_types'] = '*';
                    $config['max_width']     = '';
                    $config['max_height']    = '';
                    $config['remove_spaces'] = TRUE;
                    $config['encrypt_name']  = FALSE;
                    $config['detect_mime']   = TRUE;
                    $config['overwrite']     = FALSE;
                    $varAttachment = 'attachment_'.date("YmdHis");;
                    $config['file_name'] = $varAttachment;
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('attachment')):
                        echo "Error in uploading attachment";
                        exit;
                    else:
                        $image_data =   $this->upload->data();
                            $data = array(
                                'upload_data' => $this->upload->data()
                            );
                            $prifile_image = $data['upload_data']['file_name'];
                    endif;
                }
                else
                {
                 $prifile_image = ''; 
                }
            // ::::::::::  profile image end
            if(!empty($prifile_image))
            {
                $update_profile = array(
                    'ath_name'               =>  $this->input->post('ath_name'),
                        'ath_father_name'        =>  $this->input->post('ath_father_name'),
                        'ath_dob'                =>  $this->input->post('ath_dob'),
                        'ath_address'            =>  $this->input->post('ath_address'),
                        'ath_contact'            =>  $this->input->post('ath_contact'),
                        'ath_gender'             =>  $this->input->post('ath_gender'),
                        'ath_emergency_contact'  =>  $this->input->post('ath_emergency_contact'),
                        'ath_profession'         =>  $this->input->post('ath_profession'),
                        'ath_password'           => md5($this->input->post('confirm')),
                        'ath_profile_photo'      =>  $prifile_image
                   );

                        
            }
            else
            {
                $update_profile = array(
                    'ath_name'               =>  $this->input->post('ath_name'),
                        'ath_father_name'        =>  $this->input->post('ath_father_name'),
                        'ath_dob'                =>  $this->input->post('ath_dob'),
                        'ath_address'            =>  $this->input->post('ath_address'),
                        'ath_contact'            =>  $this->input->post('ath_contact'),
                        'ath_gender'             =>  $this->input->post('ath_gender'),
                        'ath_emergency_contact'  =>  $this->input->post('ath_emergency_contact'),
                        'ath_profession'         =>  $this->input->post('ath_profession'),
                        'ath_password'           => md5($this->input->post('confirm'))
                   );
            }
        
        $response = $this->model->update($update_profile,'athletes','ath_id',$user_id);
            if($response == true)
            {
                if($this->input->post('remember') == 'on')
                {
                    echo "Please login now"; exit;
                }
                else
                { 
                    echo "Record Update"; exit;   
                }
                
            }
            else
            {
                echo "Some Thing Wrong"; exit;
            }                       
    }


    public function athletes_payments($ath_id,$payments)

    {

        $data['payments'] = $this->model->athlete_games_fees_challans($ath_id,null,$payments);


        $data['title']       = 'Payments History';
        $data['page']        = 'athletes_payments';     
        $this->load->view('template',$data);



    }


    public function change_fee_satus($ath_game_id,$ath_game_fee_id,$fee_status){


        $data = array('ath_fee_status' => $fee_status);
        $this->db->where('ath_game_fee_id',$ath_game_fee_id)->update('athlete_games_fees',$data);

        if($fee_status ==2){
        $update_game_status = array('ath_game_status' => 2);
        $this->db->where('ath_game_id',$ath_game_id)->update('athlete_games',$update_game_status);

       }

        redirect('athletes/athlete_dashboard');
    }

     public function change_game_satus($ath_game_id,$status){

        $data = array('ath_game_status'=> $status);
        $this->db->where('ath_game_id',$ath_game_id)->update('athlete_games',$data);
        redirect('athletes/athlete_dashboard');
    }



      public function get_ajax_athlete_game($ath_game_id)
    {


        $table_name        = "athlete_games";
        $talbe_column_name = 'ath_game_id';
        $table_id          = $ath_game_id;

        $athlete_games = $this->admin_model->exist_record_row($talbe_column_name,$table_id,$table_name); 
        echo json_encode($athlete_games);

         exit;      
    }


    public function submit_monthly_fee(){

        if($this->input->post()){

        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim');

         if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);

            return redirect('Athletes/athlete_dashboard');
        }
            
        else
        {


            $date_of_apply = date('Y-m-d');

            $ath_game_id       = $this->input->post('ath_game_id');
            $payment_mode      = $this->input->post('payment_mode');
            $total_game_fee    = $this->input->post('total_game_fee');
            $fee_months        = $this->input->post('fee_months');           
            $expire_date    =  date('Y-m-d', strtotime($date_of_apply ."+".intVal($fee_months)." months"));

            $fee_table_name = "athlete_games_fees"; 

            $athlete_games_fees    = array(
                'ath_payment_mode'         =>  $payment_mode,
                'ath_challan_no'           =>  10,
                'ath_fee_status'           =>  1,
                'ath_fee_months'           =>  $fee_months,
                'ath_challan_fee'          =>  $total_game_fee,
                'ath_game_id'              =>  $ath_game_id,
                'fee_monthly_start_date'   =>  $date_of_apply,
                'fee_monthly_end_date'     =>  $expire_date
            );

              $response = $this->admin_model->insert($athlete_games_fees,$fee_table_name);

              if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');
                    return redirect('athletes/athlete_dashboard'); 
                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    return redirect('athletes/athlete_dashboard');
                }


          }

    }
}


}