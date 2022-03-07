<?php 

if (!defined('BASEPATH'))	exit('No direct script access allowed');

class AthletesModel extends CI_Model
{

    public function athlete_profile($ath_id)
    
    {


        $query = $this->db->select('athletes.`ath_id`,athletes.`ath_name`,athletes.`ath_father_name`,athletes.`ath_cnic`,athletes.`ath_dob`,athletes.`ath_address`,athletes.`ath_contact`,athletes.`ath_gender`,athletes.`ath_emergency_contact`,athletes.`ath_profession`,athletes.`ath_date_apply`,athletes.`ath_nic_photo`,athletes.`ath_profile_photo`,athletes.`ath_email`,athletes.`ath_password`,athletes.`district_id`,athletes.`user_id`,athletes.`user_role_id_fk`,athletes.`is_active`,districts.district_name')
        ->from('athletes')
        ->join('districts','athletes.district_id=districts.district_id','left')
        ->where('athletes.ath_id =',$ath_id)
        ->get();

        return $query->row_array();
    }

     public function get_athlete_games($ath_id)
    
    {

         $this->db->select('athlete_games.`ath_game_id`,athlete_games.`ath_game_time_preference`,athlete_games.`ath_game_status`,athlete_games.`ath_game_fee`,athlete_games.`ath_game_admission_fee`,athlete_games.`ath_id`,athlete_games.`game_id`,

            athlete_games_fees.`ath_game_fee_id`,athlete_games_fees.`ath_payment_mode`,athlete_games_fees.`ath_challan_no`,athlete_games_fees.`ath_upload_challan`,athlete_games_fees.`ath_fee_status`,

            games.game_name,games.game_fee,
            athletes.ath_name,athletes.ath_father_name,athletes.ath_cnic,athletes.ath_address,athletes.`user_role_id_fk`
        ');
        
        if($this->session->userdata('user_role_id_fk')  == 6){
        
        $this->db->from('athlete_games');
        $this->db->join('athletes','athletes.ath_id=athlete_games.ath_id','left');
        $this->db->join('athlete_games_fees','athlete_games_fees.ath_id=athlete_games.ath_id','left');
        $this->db->join('games','athlete_games.game_id=games.game_id','left');
        }
        else{

        $this->db->from('athlete_games');
        $this->db->join('athlete_games_fees','athlete_games_fees.ath_id=athlete_games.ath_id','left');
        $this->db->join('athletes','athletes.ath_id=athlete_games.ath_id','left');
        $this->db->join('games','athlete_games.game_id=games.game_id','left');
        $this->db->where('athlete_games.ath_id',$ath_id);
        }
        
        $query = $this->db->get();
        return $query->result();
    }
   // :::::::::::::::::::  user profile 

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

}

?>