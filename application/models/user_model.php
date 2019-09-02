<?php

class User_Model extends CI_Model {
	
	public function get_user_by($id, $password) {
		$id = $this->db->escape($id);
		$query = $this->db->query("SELECT id, net_id, firstname, lastname, email, status, type FROM user WHERE (net_id = " . $id . " OR lower(email) = " . strtolower($id) . ") AND password = '" . md5($password) . "' ");
		return $query->row_array();
	}


}
?>
