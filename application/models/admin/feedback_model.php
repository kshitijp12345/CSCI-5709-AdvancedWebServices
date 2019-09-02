<?php

class Feedback_Model extends CI_Model {

	public function get_feedbacks($filter_data) {

		$this->db->select('*');
		$this->db->from('contacts');

		if(isset($filter_data["keywords"])) {
			$this->db->or_like('name', $filter_data["keywords"]);
		}

		if(isset($filter_data["keywords"])) {
			$this->db->or_like('subject', $filter_data["keywords"]);
		}

		if(isset($filter_data["keywords"])) {
			$this->db->or_like('message', $filter_data["keywords"]);
		}

		$query = $this->db->get();
		return $query->result_array();
	}


}
?>
