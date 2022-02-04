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
        ->order_by('athletes.ath_id','desc')
        ->get();
        return $query->row_array();
    }

     public function get_athlete_games($ath_id)
    
    {

        $query = $this->db->select('athlete_games.`ath_game_id`,athlete_games.`ath_game_time_preference`,athlete_games.`ath_game_payment_mode`,athlete_games.`ath_game_total_fee`,athlete_games`.ath_game_status`,athlete_games.`ath_id`,athlete_games.`game_id`,games.game_name,games.game_fee')
        ->from('athlete_games')
        ->join('games','athlete_games.game_id=games.game_id','left')
        ->where('athlete_games.ath_id =',$ath_id)
        ->get();
        return $query->result();
    }



}

?>