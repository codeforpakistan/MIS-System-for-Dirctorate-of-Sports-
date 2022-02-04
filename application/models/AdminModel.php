<?php 

if (!defined('BASEPATH'))	exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    function user_by_role($table_name,$user_role_id_fk,$user_district_id_fk=null)
    {
        if($user_district_id_fk != null )
        {
         return $this->db->where('user_role_id_fk',$user_role_id_fk)
                        ->join('districts d','d.district_id=users.user_district_id_fk','left')
                         ->get($table_name)->result();   
        }
        else
        {
            return $this->db->where('user_role_id_fk',$user_role_id_fk)->get($table_name)->result();
        }
        
    }
    function status_active_record($table_name,$table_status_column_name,$table_status_column_value)
    {
        return $this->db->where($table_status_column_name,$table_status_column_value)->get($table_name)->result();
    }
    function exist_record_row($talbe_column_name,$table_id,$table_name)
    {

        return $this->db->where($talbe_column_name,$table_id)->get($table_name)->row_array();
    }
    function update($update_array,$table_name,$talbe_column_name,$table_id)
    {
      return $this->db->where($talbe_column_name,$table_id)->update($table_name,$update_array);
    }
    function delete($talbe_column_name,$table_id,$table_name)
    {
     return $this->db->where($talbe_column_name,$table_id)->delete($table_name);
    }
    function insert($insert_array,$table_name)
    {
        return $this->db->insert($table_name,$insert_array);
    }
    function get_all_records($table_name)
    {
        if($table_name == 'districts'){
        return $this->db->get($table_name)->result();
        }
        else{
        return $this->db->where('is_active !=',0)->get($table_name)->result();

        }
    }
    function countUsersByRoleId($user_role_id_fk)
    {
      return  $this->db->where('user_role_id_fk',$user_role_id_fk)->where('user_status',1)->count_all_results('users');
    }
    
    public function get_trials()
    {

         $query  = $this->db->select('*')
                 ->from('events_trials')
                 ->join('events','events_trials.event_id=events.event_id')
                 ->join('games','events_trials.game_id=games.game_id')
                 ->where('events_trials.is_active !=',0)
                  ->order_by('events_trials.event_trial_id','DESC')
                 ->get();
                  return $query->result();
    }

     public function get_single_trials($event_trial_id)
    {

         $query  = $this->db->select('*')
                 ->from('events_trials')
                 ->join('events','events_trials.event_id=events.event_id')
                 ->join('games','events_trials.game_id=games.game_id')
                 ->where('events_trials.is_active !=',0)
                 ->where('event_trial_id',$event_trial_id)
                 ->get();
                  return $query->row_array();
    }
    

      public function get_events()
    {

         $query  = $this->db->select('*')
                 ->from('events')
                 //->join('event_games','event_games.event_id=events.event_id')
                // ->join('games','event_games.game_id=games.game_id')
                 ->where('events.is_active !=',0)
                 ->get();
                  return $query->result();
    }

     public function get_event_games($event_id)
    {

         $query  = $this->db->select('*')
                 ->from('events_games')
                 ->join('games','events_games.game_id=games.game_id')
                 ->where('event_id',$event_id)
                 ->get();
                  return $query->result();
    }

      public function get_event_trials($event_id)
    {

         $query  = $this->db->select('*')
                 ->from('events_trials')
                 ->where('event_id',$event_id)
                 ->get();
                  return $query->result();
    }
      public function get_event_trial_game($event_trial_id)
    {

         $query  = $this->db->select('*')
                 ->from('events_trials')
                 ->join('games','events_trials.game_id=games.game_id')
                 ->where('event_trial_id',$event_trial_id)
                 ->get();
                  return $query->row_array();
    }

    public function get_selected_officals_players($type)
    {



         $query  = $this->db->select('*')
                 ->from('selected_players_officials')
                 ->join('events','events.event_id=selected_players_officials.event_id','left')
                 ->join('districts','districts.district_id=selected_players_officials.district_id','left')
                 ->join('events_trials','selected_players_officials.event_trial_id=events_trials.event_trial_id','left')
                 ->join('games','events_trials.game_id=games.game_id','left');


                 if($this->session->userdata('user_role_id_fk') != 1){

                 if($type == 'player'){

                 $this->db->where('selected_players_officials.user_id',$this->session->userdata('user_id'));

                 }
                 else{
                 $this->db->where('selected_players_officials.user_id',$this->session->userdata('user_id'));
                 }
             }


                 $this->db->where('selected_players_officials.type',$type);
                 $this->db->where('selected_players_officials.is_active',1);


                 $query = $this->db->get();

                  return $query->result();
    }

    public function get_single_selected_officals_player($player_offical_id,$type)

        {


         $query  = $this->db->select('*')
                 ->from('selected_players_officials')
                 ->join('events','events.event_id=selected_players_officials.event_id','left')
                 ->join('districts','districts.district_id=selected_players_officials.district_id','left')
                 ->join('events_trials','selected_players_officials.event_trial_id=events_trials.event_trial_id','left')
                 ->join('games','events_trials.game_id=games.game_id','left');

                 if($this->session->userdata('user_role_id_fk') != 1){

                 if($type == 'player'){
                 $this->db->where('selected_players_officials.type',$type);
                 $this->db->where('selected_players_officials.user_id',$this->session->userdata('user_id'));

                 }
                 else{
                 $this->db->where('selected_players_officials.type',$type);
                 $this->db->where('selected_players_officials.user_id',$this->session->userdata('user_id'));
                 }
             }

                 $this->db->where('selected_players_officials.is_active',1);
                 $this->db->where('selected_players_officials.player_offical_id',$player_offical_id);


                 $query = $this->db->get();
                  return $query->row_array();
    }

                function check_page($page_name)
                {
                    return $this->db->where('page_name',$page_name)->get('pages')->row();
                }
                function check_role_privileges($page_id,$role_id)
                {

                    if($role_id !=1){
                    $query = $this->db->where('page_id_fk',$page_id)->where('user_role_id_fk',$role_id)->where('access','1')->get('page_privileges');
                }

                else{

                    $query = $this->db->get('pages');

                }
                    if ($query->num_rows() > 0) 
                    {

                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }

                public  function district_admins()
                {
                    return $this->db->from('users')
                                    ->where('user_role_id_fk !=',1)
                                    ->where('user_role_id_fk !=',5)
                                    ->join('districts d','d.district_id=users.user_district_id_fk','left')
                                    ->join('user_roles r','r.user_role_id=users.user_role_id_fk','left')
                                     ->get()->result();
                }


                public function profile($user_role_id_fk)
    {
                        return $this->db->select('*')
                        ->from('users')
                        ->where('user_role_id_fk =',$user_role_id_fk)
                        ->join('user_roles r','r.user_role_id=users.user_role_id_fk','left')
                        ->join('districts d','d.district_id=users.user_district_id_fk','left')
                        ->order_by('users.user_id','desc')
                        ->get()->row_array();
    }



    
    
   
				
}

?>