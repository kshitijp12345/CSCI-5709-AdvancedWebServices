<?php

class User_Model extends CI_Model {

	public function get_users($filter_data) {

		$this->db->select('*');
		$this->db->from('user');
		if(isset($filter_data["status"])) {
			$this->db->where('status', $filter_data["status"]);
		}
		if(isset($filter_data["net_id"])) {
			$this->db->where('lower(net_id)', $filter_data["net_id"]);
		}
		if(isset($filter_data["name"])) {
			$this->db->like('lower(firstname)', strtolower($filter_data["name"]));
			$this->db->or_like('lower(lastname)', strtolower($filter_data["name"])); 
		}
		
		$query = $this->db->get();
		return $query->result_array();

	}
	
	public function get_user($user_id) {

		$query = $this->db->get_where('user', array("id" => $user_id));		
		return $query->row_array();

	}

	public function set_user_status($user_id, $status) {
		$this->db->set('status', $status);
		$this->db->where('id', $user_id);
		$this->db->update('user');
		//echo $this->db->last_query();
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	

	 public function save_message($receiver_id, $subject, $message) {
		$data = array('receiver_id' => $receiver_id,
			  'subject' => $subject, 
			  'message' => $message);
		
		$insert_id = $this->db->insert('messages', $data);
		return ($this->db->affected_rows() != 1) ? false : $insert_id;
	 }


	 public function update_passoword($new_passowrd, $user_id) {
	 	$this->db->set('password', md5($new_passowrd));
		$this->db->where('id', $user_id);
		$this->db->update('user');
		return ($this->db->affected_rows() != 1) ? false : true;
	 }


	 public function update_profile_picture($path, $user_id) {
	 	$this->db->set('profile_picture', $path);
		$this->db->where('id', $user_id);
		$this->db->update('user');
		return ($this->db->affected_rows() != 1) ? false : true;
	 }

}
?>