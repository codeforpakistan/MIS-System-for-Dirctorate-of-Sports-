<?php 

if (!defined('BASEPATH'))	exit('No direct script access allowed');

class AthletesModel extends CI_Model
{

    // public function athlete_profile($ath_id)
    
    // {


    //     $query = $this->db->select('athletes.`ath_id`,athletes.`ath_name`,athletes.`ath_father_name`,athletes.`ath_cnic`,athletes.`ath_dob`,athletes.`ath_address`,athletes.`ath_contact`,athletes.`ath_gender`,athletes.`ath_emergency_contact`,athletes.`ath_profession`,athletes.`ath_date_apply`,athletes.`ath_nic_photo`,athletes.`ath_profile_photo`,athletes.`ath_email`,athletes.`ath_password`,athletes.`district_id`,athletes.`user_id`,athletes.`user_role_id_fk`,athletes.`is_active`,districts.district_name')
    //     ->from('athletes')
    //     ->join('districts','athletes.district_id=districts.district_id','left')
    //     ->where('athletes.ath_id =',$ath_id)
    //     ->get();

    //     return $query->row_array();
    // }



 public function get_pending_challans($facility_id=null)
    
     {


         $this->db->select('athlete_games.`ath_game_id`,athlete_games.`ath_game_time_preference`,athlete_games.`ath_game_status`,athlete_games.`ath_game_fee`,athlete_games.`ath_game_admission_fee`,athlete_games.`ath_id`,athlete_games.`game_id`,

            athlete_games_fees.`ath_game_fee_id`,athlete_games_fees.`ath_payment_mode`,athlete_games_fees.`ath_challan_no`,athlete_games_fees.`ath_upload_challan`,athlete_games_fees.`ath_challan_fee,athlete_games_fees.`ath_fee_status`,athlete_games_fees.`fee_monthly_end_date`,athlete_games_fees.ath_challan_admission_fee,

            games.game_name,games.game_fee,games.game_admission_fee,

            athletes.`ath_id`,athletes.`ath_name`,athletes.`ath_father_name`,athletes.`certificate_pic`,athletes.`ath_cnic`,athletes.`ath_dob`,athletes.`ath_address`,athletes.`ath_contact`,athletes.`ath_gender`,athletes.`ath_emergency_contact`,athletes.`ath_profession`,athletes.`ath_date_apply`,athletes.`ath_nic_photo`,athletes.`ath_profile_photo`,athletes.`ath_email`,athletes.`ath_password`,athletes.`district_id`,athletes.`user_role_id_fk`,districts.district_name
        ');
        
        $this->db->from('athlete_games');
        $this->db->join('athletes','athletes.ath_id=athlete_games.ath_id','left');
        $this->db->join('athlete_games_fees','athlete_games.ath_game_id=athlete_games_fees.ath_game_id','left');
        $this->db->join('games','athlete_games.game_id=games.game_id','left');
        $this->db->join('districts','athletes.district_id=districts.district_id','left');

        if(!empty($facility_id)){
        $this->db->where('athlete_games.facility_id',$facility_id); 
        }

        $this->db->where('athlete_games_fees.ath_fee_status',1);                 
      
        
         $query = $this->db->get();



         return $query->result();
       }


       public function get_approve_challans($ath_id,$facility_id)
    
     {


         $this->db->select('athlete_games.`ath_game_id`,athlete_games.`ath_game_time_preference`,athlete_games.`ath_game_status`,athlete_games.`ath_game_fee`,athlete_games.`ath_game_admission_fee`,athlete_games.`ath_id`,athlete_games.`facility_id`,athlete_games.`game_id`,

            athlete_games_fees.`ath_game_fee_id`,athlete_games_fees.`ath_payment_mode`,athlete_games_fees.`ath_challan_no`,athlete_games_fees.`ath_upload_challan`,athlete_games_fees.`ath_challan_fee,athlete_games_fees.`ath_fee_status`,athlete_games_fees.`fee_monthly_end_date`,athlete_games_fees.`ath_fee_months`,athlete_games_fees.ath_challan_admission_fee,

            games.game_name,games.game_fee,games.game_admission_fee,

            athletes.`ath_id`,athletes.`ath_name`,athletes.`ath_father_name`,athletes.`ath_cnic`,athletes.`ath_dob`,athletes.`ath_address`,athletes.`ath_contact`,athletes.`ath_gender`,athletes.`ath_emergency_contact`,athletes.`ath_profession`,athletes.`ath_date_apply`,athletes.`ath_nic_photo`,athletes.`ath_profile_photo`,athletes.`ath_email`,athletes.`ath_password`,athletes.`district_id`,athletes.`user_role_id_fk`,districts.district_name
        ');
        
        $this->db->from('athlete_games');
        $this->db->join('athletes','athletes.ath_id=athlete_games.ath_id','left');
        $this->db->join('athlete_games_fees','athlete_games.ath_game_id=athlete_games_fees.ath_game_id','left');
        $this->db->join('games','athlete_games.game_id=games.game_id','left');
        $this->db->join('districts','athletes.district_id=districts.district_id','left');

        if(!empty($ath_id)){
        $this->db->where('athlete_games.ath_id',$ath_id);  

      }

      if(!empty($facility_id)){
        $this->db->where('athlete_games.facility_id',$facility_id);  

      }

        $this->db->where('athlete_games_fees.ath_fee_status',2);  

         $query = $this->db->get();
         return $query->result();

       }

       public function get_status_memberships($facility_id,$status)
    
     {


         $this->db->select('athlete_games.`ath_game_id`,athlete_games.`ath_game_time_preference`,athlete_games.`ath_game_status`,athlete_games.`ath_game_fee`,athlete_games.`ath_game_admission_fee`,athlete_games.`ath_id`,athlete_games.`facility_id`,athlete_games.`game_id`,

            athlete_games_fees.`ath_game_fee_id`,athlete_games_fees.`ath_payment_mode`,athlete_games_fees.`ath_challan_no`,athlete_games_fees.`ath_upload_challan`,athlete_games_fees.`ath_challan_fee,athlete_games_fees.`ath_fee_status`,athlete_games_fees.`fee_monthly_end_date`,athlete_games_fees.`ath_fee_months`,athlete_games_fees.ath_challan_admission_fee,

            games.game_name,games.game_fee,games.game_admission_fee,

            athletes.`ath_id`,athletes.`ath_name`,athletes.`ath_father_name`,athletes.`ath_cnic`,athletes.`ath_dob`,athletes.`ath_address`,athletes.`ath_contact`,athletes.`ath_gender`,athletes.`ath_emergency_contact`,athletes.`ath_profession`,athletes.`ath_date_apply`,athletes.`ath_nic_photo`,athletes.`ath_profile_photo`,athletes.`ath_email`,athletes.`ath_password`,athletes.`district_id`,athletes.`user_role_id_fk`,districts.district_name
        ');
        
        $this->db->from('athlete_games');
        $this->db->join('athletes','athletes.ath_id=athlete_games.ath_id','left');
        $this->db->join('athlete_games_fees','athlete_games.ath_game_id=athlete_games_fees.ath_game_id','left');
        $this->db->join('games','athlete_games.game_id=games.game_id','left');
        $this->db->join('districts','athletes.district_id=districts.district_id','left');
        $this->db->where('athlete_games_fees.ath_challan_admission_fee >',0);

       
      if(!empty($facility_id)){
        $this->db->where('athlete_games.facility_id',$facility_id);  

      }

        $this->db->where('athlete_games.ath_game_status',$status);  

         $query = $this->db->get();
         return $query->result();

       }

        public function get_memberships($facility_id=null)
    
       {


         $this->db->select('athlete_games.`ath_game_id`,athlete_games.`ath_game_time_preference`,athlete_games.`ath_game_status`,athlete_games.`ath_game_fee`,athlete_games.`ath_game_admission_fee`,athlete_games.`ath_id`,athlete_games.`game_id`,

            athlete_games_fees.`ath_game_fee_id`,athlete_games_fees.`ath_payment_mode`,athlete_games_fees.`ath_challan_no`,athlete_games_fees.`ath_upload_challan`,athlete_games_fees.`ath_challan_fee,athlete_games_fees.`ath_fee_status`,athlete_games_fees.`fee_monthly_end_date`,athlete_games_fees.ath_challan_admission_fee,

            games.game_name,games.game_fee,games.game_admission_fee,

            athletes.`ath_id`,athletes.`ath_name`,athletes.`ath_father_name`,athletes.`ath_cnic`,athletes.`ath_dob`,athletes.`ath_address`,athletes.`ath_contact`,athletes.`ath_gender`,athletes.`ath_emergency_contact`,athletes.`ath_profession`,athletes.`ath_date_apply`,athletes.`ath_nic_photo`,athletes.`ath_profile_photo`,athletes.`ath_email`,athletes.`ath_password`,athletes.`district_id`,athletes.`user_role_id_fk`,districts.district_name
        ');
        
        $this->db->from('athlete_games');
        $this->db->join('athletes','athletes.ath_id=athlete_games.ath_id','left');
        $this->db->join('athlete_games_fees','athlete_games.ath_game_id=athlete_games_fees.ath_game_id','left');
        $this->db->join('games','athlete_games.game_id=games.game_id','left');
        $this->db->join('districts','athletes.district_id=districts.district_id','left');
        $this->db->where('athlete_games_fees.ath_challan_admission_fee >',0);
        $this->db->order_by('athlete_games.ath_game_id','desc');
       // $this->db->where('athlete_games_fees.ath_fee_status',1);

        if(!empty($facility_id)){
        $this->db->where('athlete_games.facility_id',$facility_id); 
        }      
        
         $query = $this->db->get();
         return $query->result();
       }

       public function get_athlete_games($ath_id)
    
     {


         $this->db->select('athlete_games.`ath_game_id`,athlete_games.`ath_game_time_preference`,athlete_games.`ath_game_status`,athlete_games.`ath_game_fee`,athlete_games.`ath_game_admission_fee`,athlete_games.`ath_id`,athlete_games.`game_id`,

      
            games.game_name,games.game_fee,games.game_admission_fee,

            athletes.`ath_id`,athletes.`ath_name`,athletes.`ath_father_name`,athletes.`ath_cnic`,athletes.`ath_dob`,athletes.`ath_address`,athletes.`ath_contact`,athletes.`ath_gender`,athletes.`ath_emergency_contact`,athletes.`ath_profession`,athletes.`ath_date_apply`,athletes.`ath_nic_photo`,athletes.`ath_profile_photo`,athletes.`ath_email`,athletes.`ath_password`,athletes.`district_id`,athletes.`user_role_id_fk`,districts.district_name,facilities.facility_name
        ');
        
        

        $this->db->from('athlete_games');
        $this->db->join('athletes','athletes.ath_id=athlete_games.ath_id');
        $this->db->join('games','athlete_games.game_id=games.game_id');
        $this->db->join('districts','athlete_games.district_id=districts.district_id','left');
        $this->db->join('facilities','facilities.facility_id=athlete_games.facility_id','left');
        $this->db->where('athlete_games.ath_id',$ath_id);
        $this->db->where('athlete_games.ath_game_status !=',3);
        $query = $this->db->get();
        return $query->result();
       }
    
   // :::::::::::::::::::  user profile 


       public function get_game_fees($ath_game_id){

         $query =  $this->db->select('`ath_game_fee_id`, `ath_payment_mode`, `ath_challan_no`, `ath_upload_challan`, `ath_challan_fee`, `ath_challan_admission_fee`, `ath_fee_months`, `ath_fee_status`, `fee_monthly_start_date`, `fee_monthly_end_date`, `ath_game_id`, `create_at`

            ')
            ->from('athlete_games_fees')
            ->where('ath_game_id',$ath_game_id)
            ->order_by('ath_game_fee_id','desc')
            ->get();

            return  $query->row();

       }

    public function athlete_games_fees_challans($ath_id,$ath_game_fee_id){

           $query =  $this->db->select('athlete_games.`ath_game_id`,athlete_games.`ath_game_time_preference`,athlete_games.`ath_game_status`,athlete_games.`ath_game_fee`,athlete_games.`ath_game_admission_fee`,athlete_games.`ath_id`,athlete_games.`game_id`,

            athlete_games_fees.`ath_game_fee_id`,athlete_games_fees.`ath_payment_mode`,athlete_games_fees.`ath_challan_no`,athlete_games_fees.`ath_upload_challan`,athlete_games_fees.`ath_challan_fee,athlete_games_fees.`ath_fee_status`,athlete_games_fees.`fee_monthly_end_date`,athlete_games_fees.ath_challan_admission_fee,athlete_games_fees.ath_fee_months,

            games.game_name,games.game_fee,games.game_admission_fee,

            athletes.`ath_id`,athletes.`ath_name`,athletes.`ath_father_name`,athletes.`ath_cnic`,athletes.`ath_dob`,athletes.`ath_address`,athletes.`ath_contact`,athletes.`ath_gender`,athletes.`ath_emergency_contact`,athletes.`ath_profession`,athletes.`ath_date_apply`,athletes.`ath_nic_photo`,athletes.`ath_profile_photo`,athletes.`ath_email`,athletes.`ath_password`,athletes.`district_id`,athletes.`user_role_id_fk`,districts.district_name')

            ->from('athlete_games_fees')
            ->join('athlete_games','athlete_games_fees.ath_game_id=athlete_games.ath_game_id')
            ->join('athletes','athletes.ath_id=athlete_games.ath_id')
            ->join('games','athlete_games.game_id=games.game_id')
            ->join('districts','athletes.district_id=districts.district_id','left')
            ->where('athlete_games.ath_id',$ath_id);

            if($ath_game_fee_id !=null){
            $this->db->where('athlete_games_fees.ath_game_fee_id',$ath_game_fee_id);
            }
            
            else{
              $this->db->where('athlete_games_fees.ath_fee_status',1);

            }
            
            $query = $this->db->get();              
             if ($ath_game_fee_id !=null){

            return $query->row_array();
               
             }
             else{
            return $query->result();

             }
    
         }


    

    function profile($user_role_id_fk)
    {
        return $this->db->select('a.ath_name,a.ath_father_name,a.ath_cnic,a.ath_dob,a.ath_address,a.ath_contact,a.ath_gender,a.ath_emergency_contact,a.ath_profession,a.ath_profile_photo,a.ath_email,r.user_role_name,d.district_name')
                        ->from('athletes a')
                        ->where('user_role_id_fk =',$user_role_id_fk)
                        ->join('districts d','d.district_id=a.district_id','left')
                        ->join('user_roles r','r.user_role_id=a.user_role_id_fk','left')
                        ->order_by('a.user_id','desc')
                         ->get()->result();
    }


    function update($update_array,$table_name,$talbe_column_name,$table_id)
    {
      return $this->db->where($talbe_column_name,$table_id)->update($table_name,$update_array);
    }

    function user_password($ath_id)
    {
     return $this->db->select('athletes.ath_password')
                     ->where('ath_id',$ath_id)
                     ->get('athletes')
                     ->row()->ath_password;
    }


            public function get_mx_num($type)
    {
          $this->db->select('auto_no');
          $this->db->from('set_auto_number');
          $this->db->where('set_auto_number.type_name',$type);
          $query = $this->db->get();
          return $query->row_array();
          
    }
        
        public function get_patteron($type)
        {
            $this->db->from('set_auto_number');
            $this->db->where('set_auto_number.type_name',$type);
            $query = $this->db->get();
            return $query->row_array();
        }
        
        public function set_auto_no($type_name)
    { 
        $this->db->from('set_auto_number');
        $this->db->where('type_name',$type_name);
        $query = $this->db->get();
        $result = $query->row_array();
        //view($result,1);
        $no = $result['auto_no'];
        $no++;
        $aa =array(
                    'auto_no' => $no,
                    );
        $this->db->where('type_name',$type_name)
                 ->update("set_auto_number",$aa);
        
    }

    function forgot_email_validation($user_email)
    {
        return $this->db->where('ath_email',$user_email)->get('athletes')->row();
    }

    function check_record_by_array($array,$table_name)
    { 
        return $this->db->where($array)->get($table_name)->row();
    }

    public function athlete_profile($user_role_id_fk)
    {
      return $this->db->select('*')
      ->from('athletes')
      ->where('user_role_id_fk =',$user_role_id_fk)
      ->join('user_roles r','r.user_role_id=athletes.user_role_id_fk','left')
      ->join('districts d','d.district_id=athletes.district_id','left')
      ->order_by('athletes.ath_id','desc')
      ->get()->row_array();
}

public  function facility_admins()
      {
          return $this->db->from('athletes')
                          ->where('user_role_id_fk !=',6)
                          ->where('user_role_id_fk !=',5)
                          ->join('facilities f','f.facility_id=athletes.facility_id','left')
                          ->join('user_roles r','r.user_role_id=athletes.user_role_id_fk','left')
                           ->get()->result();
      }

}

?>