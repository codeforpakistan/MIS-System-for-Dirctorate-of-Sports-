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
        $this->form_validation->set_rules('user_email', 'Useremail', 'required|trim');
        $this->form_validation->set_rules('user_password', 'Password', 'required|trim');
        if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect(base_url('athletes'));
            
        }
        else
        {
             $ath_email_mobile   = $this->input->post('user_email');
             $ath_password       = $this->input->post('user_password');
             $response           = $this->AuthModel->athlete_login($ath_email_mobile,$ath_password); 





            if(!empty($response))// is user name and passsword valid
               {               
                $this->session->set_userdata('ath_id',$response['ath_id']);
                $this->session->set_userdata('ath_name',$response['ath_name']);
                $this->session->set_userdata('ath_email',$response['ath_email']);
                $this->session->set_userdata('user_role_id_fk',$response['user_role_id_fk']);
                $this->session->set_userdata('facility_id',$response['facility_id']);
                $this->session->set_userdata('facility_name',$response['facility_name']);
                $this->session->set_userdata('profile_image',$response['ath_profile_photo']);
              

            if($response['ath_cnic'] > 0 || $response['user_role_id_fk'] == 6 || $response['user_role_id_fk'] == 7 ){

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
      if($this->session->userdata('user_role_id_fk'))
    {


        $table_name = 'districts';
        $data['districts'] = $this->admin_model->get_all_records($table_name);

        $table_name = 'facilities';
        $data['facilities'] = $this->admin_model->get_all_records($table_name);


        $table            = 'games';
        $data['games']    = $this->admin_model->get_all_records($table);

        $ath_id = $this->session->userdata('ath_id');
        $data['athlete_games']   = $this->model->get_athlete_games($ath_id); 

        $data['title']  = 'Dashboard';
        $data['page']   = 'athlete_dashboard';
        $this->load->view('template',$data);
    }
    else
    {
        return redirect(base_url('athletes'));
    }    
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

        if(!empty($more_games))

        {
       $this->form_validation->set_rules('time_prefernce', 'Time Prefernce', 'required|trim');
       $this->form_validation->set_rules('game_fee', 'Game Fee', 'required|trim');
       $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim');
       $this->form_validation->set_rules('facility_id', 'Facility', 'required|trim');
       $this->form_validation->set_rules('district_id', 'District', 'required|trim');
        }
        else
        {

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
        $this->form_validation->set_rules('facility_id', 'Facility', 'required|trim');

    }

        if ($this->form_validation->run() == FALSE)
        {
            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);

            if(!empty($more_games)){

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
            $certificate_pic     = $_FILES['certificate_pic']['name'];
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
            $facility_id         = $this->input->post('facility_id');
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

            $config['upload_path'] = 'assets/images/athlete_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['encrypt_name']  = TRUE;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            $this->upload->do_upload('certificate_pic');
            $upload_certificate_pic = $this->upload->data(); 
            $file_name3 = $upload_certificate_pic['file_name'];


            
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
            'ath_nic_photo'          =>  $file_name1,
            'ath_profile_photo'      =>  $file_name2,
            'certificate_pic'        =>  $file_name3,
            'facility_id'            =>  $facility_id

            );


             $this->admin_model->update($applicantion_array,$table_name,$talbe_column_name,$table_id);
}

            $ath_game_table      = 'athlete_games';
            $game_id             = $this->input->post('game_id');
            $time_prefernce      = $this->input->post('time_prefernce');
            $payment_mode        = $this->input->post('payment_mode');
            $total_fee           = $this->input->post('total_fee');
            $facility_id         = $this->input->post('facility_id');
            $district_id         = $this->input->post('district_id');

           

             /* for insert into multiple games */

            for($i=0; $i < count($game_id); $i++){
                $game_table          = 'games';
                $talbe_column_name   = 'game_id';
                $table_id            = $game_id[$i];
                $data['games']       = $this->admin_model->exist_record_row($talbe_column_name,$table_id,$game_table);

                $challan_fee               = $data['games']['game_fee'];
                $ath_challan_admission_fee = $data['games']['game_admission_fee']; 

                if($profession == 'student'){

                   $challan_fee =  $challan_fee /2;

                  $ath_challan_admission_fee  = $ath_challan_admission_fee/2;

                }

                $athlete_games_array1    = array(
                'game_id'                     =>  $game_id[$i],
                'ath_id'                      =>  $ath_id,
                'facility_id'                 =>  $facility_id,
                'district_id'                 =>  $district_id,
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
                'challan_status'            =>  1,
                'ath_challan_admission_fee' =>  $ath_challan_admission_fee,
                'ath_game_id'               =>  $ath_game_id,
                'fee_monthly_start_date'    =>  $date_of_apply,
                'fee_monthly_end_date'      =>  $expire_date
            );

              $this->admin_model->insert($athlete_games_fees,$fee_table_name);
              $this->model->set_auto_no('challan');



              $card_no   =  new auto_no();
              $card_no   = $card_no->get_auto_num('card','auto_no');
               $fee_table_name = "athlete_membership_cards"; 
              $athlete_card_data  = array(

                'ath_card_no'     =>  $card_no,
                'ath_game_id'     =>  $ath_game_id,
                'ath_id'          =>  $ath_id,
                'ath_card_status' =>  1,
              );


              $this->admin_model->insert($athlete_card_data,$fee_table_name);
              $this->model->set_auto_no('card'); 
          }

          $this->messages('alert-success','Successfully Added');
          return redirect('athletes'); 


                // if($response == true)
                // {
                //     $this->messages('alert-success','Successfully Added');
                //     return redirect('athletes'); 
                // }
                // else
                // {
                //     $this->messages('alert-danger','Some Thing Wrong');
                //     return redirect('athletes');
                // }
    }
}


        $table           = 'games';
        $data['games']    = $this->admin_model->get_all_records($table);

        $table_name = 'districts';
        $data['districts'] = $this->admin_model->get_all_records($table_name);

        $table_name = 'facilities';
        $data['facilities'] = $this->admin_model->get_all_records($table_name);


        $table_name          = "athletes";
        $talbe_column_name   = 'ath_id';
        $table_id            =  $ath_id;
        $data['athlete']    = $this->admin_model->exist_record_row($talbe_column_name,$table_id,$table_name);

        $data['title'] = 'Application Form';
        $data['page']  = 'application_form';
        $this->load->view('template',$data);

    }

    // public function athlete_profile()
    // {   
    //     //$this->check_role_privileges('dashboard',$this->session->userdata('user_role_id_fk'));
    //     $data['title']       = 'User Profile';
  
    //     $data['page']        = 'athlete_profile';
    //     $ath_id              = $this->session->userdata('ath_id');

    //     if(empty($ath_id))
    //     {
    //         $this->logout_user();
    //     } 
        
    //     $data['athlete_profile']  = $this->model->athlete_profile($ath_id); 

    //     $this->load->view('template',$data);
    // }

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


        $data['bank_challan']  = $this->model->athlete_games_fees_challans($ath_id,$ath_game_fee_id);
        $data['title']         = 'Bank Copy';
        $this->load->view('bank_challan',$data);
    }

    public function upload_challan()
    {
        if($this->input->post()){

            $ath_game_fee_id = $this->input->post('ath_game_fee_id',true);
            $challan_no      = $this->input->post('challan_no',true);
            $challan        = $_FILES['Upload_challan']['name'];

            if($challan == ''){

                $this->messages('alert-danger','Challan Not Uploaded');
                redirect('athletes/athlete_dashboard');
            }

            else{

            $config = array(
            'upload_path'   => 'assets/images/challan/',
            'allowed_types' => 'png|jpg|jpeg|pdf',
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


    public function approve_athlete_challans()

    {

        $ath_id              = $this->session->userdata('ath_id');
        $data['payments']    = $this->model->get_approve_challans($ath_id,null);
        $data['title']       = 'Payments History';
        $data['page']        = 'athletes_payments';     
        $this->load->view('template',$data);



    }

    public function approve_facility_challans()

    {

        $facility_id         = $this->session->userdata('facility_id');
        $data['payments']    = $this->model->get_approve_challans(null,$facility_id);
        $data['title']       = 'Payments History';
        $data['page']        = 'facility_approve_payments';     
        $this->load->view('template',$data);

    }


    public function change_fee_satus($ath_game_id,$ath_game_fee_id,$fee_status,$ath_card_id){


        $data = array('ath_fee_status' => $fee_status);
        $this->db->where('ath_game_fee_id',$ath_game_fee_id)->update('athlete_games_fees',$data);

        if($fee_status ==2){

        $update_game_status = array('ath_game_status' => 2);
        $this->db->where('ath_game_id',$ath_game_id)->update('athlete_games',$update_game_status);

        $update_card_status = array('ath_card_status' => 2);
        $this->db->where('ath_card_id',$ath_card_id)->update('athlete_membership_cards',$update_card_status);

       }

        redirect('athletes/memberships');
    }

     public function change_game_satus(){

         $status        =  $this->input->post('status');
         $ath_game_id   = $this->input->post('ath_game_id');
         $ath_card_id   = $this->input->post('ath_card_id');



        $data = array('ath_game_status'=> $status,'ath_game_remarks' => $this->input->post('ath_game_remarks',true));
        $this->db->where('ath_game_id',$ath_game_id)->update('athlete_games',$data);

        $update_card_status = array('ath_card_status' => 1);
        $this->db->where('ath_card_id',$ath_card_id)->update('athlete_membership_cards',$update_card_status);


        $this->messages('alert-success','Successfully Rejected');
        redirect('athletes/memberships');
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
            $challan_no   =  new auto_no();
            $challan_no   = $challan_no->get_auto_num('challan','auto_no');

            $athlete_games_fees    = array(
                'ath_payment_mode'         =>  $payment_mode,
                'ath_challan_no'           =>  $challan_no,
                'ath_fee_status'           =>  1,
                'ath_fee_months'           =>  $fee_months,
                'ath_challan_fee'          =>  $total_game_fee,
                'ath_game_id'              =>  $ath_game_id,
                'fee_monthly_start_date'   =>  $date_of_apply,
                'fee_monthly_end_date'     =>  $expire_date
            );

              $response = $this->admin_model->insert($athlete_games_fees,$fee_table_name);
              $this->model->set_auto_no('challan');


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

public function pending_challans(){

    $facility_id = $this->session->userdata('facility_id');

    $data['pending_challans']   = $this->model->get_pending_challans($facility_id);

    $data['title']              = 'Pending Challans';
    $data['page']               = 'pending_challans';     
    $this->load->view('template',$data);
}

 public function forgot_passord(){

         $this->load->view("athlete_forgot_password");


    }

    function forgot_email_validation()
    {
        $user_email = $this->input->post('user_email');
        $returing_array = array();
        if(!empty($user_email))
        {
            $returing_array = $this->email_send_otp($user_email);
            
        }
        else
        {
            $returing_array['message'] = "Email filed is required";
        }
        echo json_encode($returing_array); exit;
    }
    function email_send_otp($user_email)
    {
        $response = $this->model->forgot_email_validation($user_email);
            if(!empty($response))
            {
                $user_first_name = $response->ath_name;
                $user_email      = $response->ath_email;
                $user_id         = $response->ath_id;
                $otp = substr(str_shuffle(time()), 0, 6);

                $update_array = array('vcode'=>trim($otp));
                $this->model->update($update_array,'athletes','ath_id',$user_id);
                $htmlContent = "
                                    <p>Hi, ".$user_first_name.", </p>
                                    <p>We received a request to reset your password through your email address. Your PPSC verification code is: </p>
                                    <h2>".$otp."</h2>
                                    <p>
                                        If you did not request this code, it is possible that someone else is trying to access your PPSC Account. 
                                        <b>Do not forward or give this code to anyone.</b>
                                    </p>
                                    <a href='https://ppsc.kp.gov.pk'> https://ppsc.kp.gov.pk </a>
                                ";
                            $this->load->library('email');
                            $this->email->from('salmanzafar@codeforpakistan.org', 'PPSC');
                            $this->email->to($user_email);
                            $this->email->subject('PPSC Verification Code');
                            $this->email->message($htmlContent); 
                            $this->email->set_mailtype("html");
                            
                            if($this->email->send())
                            {
                                $message =  "Kindly check your email for verification code.";
                                $returing_array['message'] = $message;
                                $returing_array['user_email'] = $user_email;
                                $returing_array['user_id'] = $user_id;
                                
                            }
                            else
                            {  $message =  "Kindly check your email for verification code.";
                                // echo "Failed to send verification code on email."; exit;
                                //$message =  "Kindly check your email for verification code.";
                                $returing_array['message'] = $message;
                                $returing_array['user_email'] = $user_email;
                                $returing_array['user_id'] = $user_id;
                            }
            }
            else
            {
                $returing_array['message'] = "Invalid Email";
            }
            return $returing_array; exit;
    }

    function conformation_code()
    {
       $user_email =  $this->input->post('user_email');
       $user_id    =  $this->input->post('user_id');
       $vcode      =  $this->input->post('vcode');
       $resend_code = $this->input->post('resend_code'); 
       $returing_array = array();
        if(isset($resend_code))
        {
           $returing_array = $this->email_send_otp($user_email); 
        //    $returing_array['user_id']=  $user_id;
        //    $returing_array['user_email']=  $user_email;
           echo json_encode($returing_array); exit;
        }
        else
        {
            if(!empty($user_id) && !empty($vcode) )
            {
                $array = array('ath_email'=>$user_email,'vcode'=>$vcode,'ath_id'=>$user_id);
                $user_response = $this->model->check_record_by_array($array,'athletes');
                if(!empty($user_response))
                {
                    $returing_array['message']    =  "record exists";
                    $returing_array['user_id']    =  $user_id;
                    $returing_array['user_email'] =  $user_email;
                }
                else
                {
                    $returing_array['message'] =  "invalic conformation code";
                }
            }
            else
            {
                $returing_array['message'] = "vscode field is required";
            }
        }
       
       
       echo json_encode($returing_array); exit;
    }
    function update_password()
    {
       $user_email        =  $this->input->post('user_email');
       $user_id           =  $this->input->post('user_id');
       $user_cpassword    =  $this->input->post('r_cpassword');
       $user_password     =  $this->input->post('r_password');
       if($user_password  !== $user_cpassword)
       {
           echo "Password Not Match"; exit;
       }

       if(!empty($user_id) && !empty($user_password) )
       {
           $update_array = array('ath_password'=>md5($user_password),'vcode'=>'');
           $user_response = $this->model->update($update_array,'athletes','ath_id',$user_id);
           if(!empty($user_response))
           {
               echo "Password Update Successfully please Login now"; exit;
           }
           else
           {
               echo "invalic conformation code"; exit;
           }
       }
       else
       {
           echo "vscode field is required"; exit;
       }
       echo "password and conform passwor field is required"; exit;
    }


    public function athlete_profile()
    {   
        //$this->check_role_privileges('dashboard',$this->session->userdata('user_role_id_fk'));
        $data['title']       = 'User Profile';
        $data['page']        = 'athlete_profile';
        $user_role_id_fk     = $this->session->userdata('user_role_id_fk');
        if(empty($user_role_id_fk))
        {
            $this->logout_user();
        } 
        
        $data['athlete_profile']  = $this->model->athlete_profile($user_role_id_fk); 
        $this->load->view('template',$data);
    }

      public function users()
    { 

     //$this->check_role_privileges('users',$this->session->userdata('user_role_id_fk'));
        
        $table_name                 = 'athletes';
        $table_name2                = 'facilities';
        $table_status_column_name   = 'is_active';
        $facility_id                = 7;
        $table_status_column_value  = 1;
        $data['users']              = $this->model->facility_admins();
        $data['facilities']           = $this->admin_model->status_active_record($table_name2,$table_status_column_name,$table_status_column_value);

        $data['title']              = 'Users';
        $data['page']               = 'athlete_admin_users';
        $this->load->view('template',$data);
    }


    function users_insert()
    {


        $this->form_validation->set_rules('user_email', 'User Email', 'required|trim|is_unique[athletes.ath_email]');
        $this->form_validation->set_rules('user_name', 'User Email', 'required|trim|is_unique[athletes.ath_name]');
        $this->form_validation->set_rules('user_password', 'Password', 'required|trim');

        if($this->input->post('user_role_id_fk') == 7) // to for District admin
        {
            $this->form_validation->set_rules('facility_id', 'Facility selection', 'required|trim');
        } 

        if ($this->form_validation->run() == FALSE)
        {

            $error   = array('error' => validation_errors());
            $message = implode(" ",$error);
            $this->messages('alert-danger',$message);
            return redirect('athletes/users');
            
        }
        else
        {
            $user_email           = $this->input->post('user_email');
            $user_name           = $this->input->post('user_name');
            $user_password        = $this->input->post('user_password');
            $user_facility_id_fk  = (empty($this->input->post('facility_id'))? 0:$this->input->post('facility_id'));
            $user_role_id_fk      = $this->input->post('user_role_id_fk');
            $table_name           = 'users';
            $inert_array       = array('ath_email'=> $user_email,'ath_name'=> $user_name,'ath_password'=>md5($user_password),'facility_id'=>$user_facility_id_fk,'is_active'=>1,'user_role_id_fk'=>$user_role_id_fk);
            $table_name           = 'athletes';

            $response = $this->admin_model->insert($inert_array,$table_name);

                if($response == true)
                {
                    $this->messages('alert-success','Successfully Added');
                    return redirect('athletes/users'); 
                }
                else
                {
                    $this->messages('alert-danger','Some Thing Wrong');
                    return redirect('athletes/users');
                }
        }
    }
    //==========================================================================
    // update user modal view
    //==========================================================================
    function users_edit_model($user_id)
    { 
        $table_name        = "athletes";
        $talbe_column_name = 'ath_id';
        $table_id          = $user_id;

        $userss = $this->admin_model->exist_record_row($talbe_column_name,$table_id,$table_name);  // get row
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
            $table_name        = "athletes";
            $talbe_column_name = 'ath_id';
            $table_id          = $user_id;

            $facility_email = $this->model->exist_record_row($talbe_column_name,$table_id,$table_name);  // get row
            $exists_user_name =  $facility_email->ath_email;
            if($exists_user_name != $user_email)
            {
              $this->form_validation->set_rules('user_email', 'Useremail', 'required|trim|is_unique[athletes.ath_email]');  
              $this->form_validation->set_rules('user_name', 'Username', 'required|trim|is_unique[athletes.ath_name]');  
            }
            else
            {
                $this->form_validation->set_rules('user_email', 'User email', 'required|trim');
                $this->form_validation->set_rules('user_name',  'Username', 'required|trim');
            }
            if($this->input->post('user_role_id_fk') == 3) // to for District admin
            {
                $this->form_validation->set_rules('facility_id', 'For facility-admin District selection', 'required|trim');
            }
            
            $this->form_validation->set_rules('user_password', 'Password', 'required|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $error   = array('error' => validation_errors());
                $message = implode(" ",$error);
                $this->messages('alert-danger',$message);
                return redirect('athletes/users');
                
            }
            else
            {
                $user_district_id_fk= (empty($this->input->post('facility_id'))? 0:$this->input->post('facility_id'));
                $update_it_array   = array('ath_name'=>$user_name,'ath_password'=>md5($user_password),'is_active'=>$user_status,'user_district_id_fk'=>$user_district_id_fk);
                $response = $this->model->update($update_it_array,$table_name,$talbe_column_name,$table_id);
                    if($response == true)
                    {
                        $this->messages('alert-success','Successfully Update');
                        return redirect('athletes/users'); 
                    }
                    else
                    {
                        $this->messages('alert-danger','Some Thing Wrong');
                        return redirect('athletes/users');
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
            $talbe_column_name = 'ath_id';
            $table_name        = 'athletes';
            $table_id          = $user_id; 
            // $update_it_array   = array('user_status'=>0);
            // $response = $this->model->update($update_it_array,$table_name,$talbe_column_name,$table_id);
            $response = $this->admin_model->delete($talbe_column_name,$table_id,$table_name); 
            if($response == true)
            {
                $this->messages('alert-success','Successfully Deleted');
                return redirect('athletes/users'); 
            }
            else
            {
                $this->messages('alert-danger','Some Thing Wrong');
                return redirect('athletes/users');
            }
        }
    }


    public function memberships(){



        $facility_id = $this->session->userdata('facility_id');
        $data['memberships'] = $this->model->get_memberships($facility_id);

        $data['title']              = 'Memberships';
        $data['page']               = 'memberships';
        $this->load->view('template',$data);



    }

    public function general_report(){

         $facility_id = $this->session->userdata('facility_id');

            $from_date   = "";
            $to_date     = "";
            $facility    = "";
            $gender      = "";
            $membership  = "";
            $fee_challan = "";
            $game        = "";


        if($this->input->post()){

            $from_date   = $this->input->post('from_date');
            $to_date     = $this->input->post('to_date');
            $facility    = $this->input->post('facility');
            $gender      = $this->input->post('gender');
            $membership  = $this->input->post('Membership_status');
            $fee_challan = $this->input->post('fee_challan_status');
            $game        = $this->input->post('game');

            $data["reports"]      = $this->model->get_FilterDetails($from_date,$to_date,$facility,$gender,$membership,$fee_challan,$game,$facility_id);


        }


            $data['from_date']   = $from_date;
            $data['to_date']     = $to_date;
            $data['facility']    = $facility;
            $data['gender']      = $gender;
            $data['membership']  = $membership;
            $data['fee_challan'] = $fee_challan;
            $data['game']        = $game;



        $table_name = 'districts';
        $data['districts'] = $this->admin_model->get_all_records($table_name);

        $table_name = 'facilities';
        $data['facilities'] = $this->admin_model->get_all_records($table_name);


        $table            = 'games';
        $data['games']    = $this->admin_model->get_all_records($table);

       
        $data['title'] = 'Report Result';
        $data['page']   = 'general_report';
        $this->load->view('template',$data);
    }

    public function card(){



        $table            = 'cards';
        $data['cards']    = $this->admin_model->get_all_records($table);


        $data['title'] = 'Card';
        $data['page']   = 'card';
        $this->load->view('template',$data);


    }

    public function get_ajax_card($card_id)
    { 


        $table_name        = "cards";
        $talbe_column_name = 'card_id';
        $table_id          = $card_id;


        $card_game = $this->admin_model->exist_record_row($talbe_column_name,$table_id,$table_name); 
        echo json_encode($card_game); exit;      
    }

    public function card_update()
    {


        $card_id            = $this->input->post('card_id');
        $card_fee            = $this->input->post('card_fee');

        $table_name        = "cards";
        $talbe_column_name = 'card_id';
        $table_id          = $card_id;
        

            $card_array         = array(
                'card_fee'      =>  $card_fee,
                

            );
                $response = $this->model->update($card_array,$table_name,$talbe_column_name,$table_id);
                    if($response == true)
                    {
                        $this->messages('alert-success','Successfully Update');
                        return redirect('athletes/card'); 
                    }
                    else
                    {
                        $this->messages('alert-danger','Some Thing Wrong');
                        return redirect('athletes/card');
                    }
    }

    public function dublicate_card(){

        $ath_id = $this->session->userdata('ath_id');


        $table                   = 'athlete_membership_cards';
        $data['dublicate_cards']  = $this->model->get_dublicate_card($ath_id);

        $data['title']  = 'Dublicate Card';
        $data['page']   = 'dublicate_card';
        $this->load->view('template',$data);


    }


    public function dublicate_card_add($ath_id,$ath_game_id){

        $update_card_array = array(
            'ath_card_status'  => 3,
        );

       $this->db->where('ath_id',$ath_id)
                ->where('ath_game_id',$ath_game_id)
                ->where('ath_card_status',2)
                ->update(' athlete_membership_cards',$update_card_array);

        $data         = $this->model->get_card();
        $ath_card_fee = $data['card_fee'];
    
        $card_no   =  new auto_no();
        $card_no   = $card_no->get_auto_num('card','auto_no');

        $dublicate_card_arry = array(

            'ath_id'       => $ath_id,
            'ath_game_id'  => $ath_game_id,
            'ath_card_no'  => $card_no,
            'ath_card_fee' => $ath_card_fee 
        );

        $this->db->insert('athlete_membership_cards',$dublicate_card_arry);
        $this->model->set_auto_no('card');

         $fee_table_name = "athlete_games_fees"; 

         $challan_no   =  new auto_no();
            $challan_no   = $challan_no->get_auto_num('challan','auto_no');

            $dublicate_card_fees    = array(
                'ath_payment_mode'          =>  'Bank',
                'ath_challan_no'            =>  $challan_no,
                'ath_fee_status'            =>  1,
                'ath_challan_fee'           =>  $ath_card_fee,
                'challan_status'            =>  2,
                'ath_game_id'               =>  $ath_game_id,
            );


        $this->admin_model->insert($dublicate_card_fees,$fee_table_name);
        $this->model->set_auto_no('challan');
        $this->messages('alert-success','Successfully Applied for Dublicate Card');
        return redirect('athletes/dublicate_card'); 


    }




}