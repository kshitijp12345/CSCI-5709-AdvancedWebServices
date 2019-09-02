<?php

class Post_Model extends CI_Model {

	public function get_posts($filter_data) {
		$this->db->select('post.*, user.firstname, user.lastname, user.id');
		$this->db->from('post');
		$this->db->join('user', 'post.user_id = user.id', 'left inner'); 

		if(isset($filter_data["keywords"])) {
			$this->db->like('post_title', $filter_data["keywords"]);
		}

		if(isset($filter_data["date"])) {
			$this->db->like('date_created', $filter_data["date"], 'after');
		}

		if(isset($filter_data["is_spam"])) {
			$this->db->where('is_spam', $filter_data["is_spam"]);
		}

		if(isset($filter_data["author"])) {
			$this->db->like('lower(user.firstname)', strtolower($filter_data["author"]));
			$this->db->or_like('lower(user.lastname)', strtolower($filter_data["author"])); 
		}

		if(isset($filter_data["user_id"])) {
			$this->db->where('user.id', $filter_data["user_id"]);
		}

		$this->db->order_by('date_created', 'DESC');

		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_post($post_id) {

		$this->db->select('post.*, user.firstname, user.lastname, user.id');
		$this->db->from('post');
		$this->db->join('user', 'post.user_id = user.id', 'left inner'); 
		$this->db->where('post.post_id', $post_id);
		$query = $this->db->get();
		return $query->row_array();

	}

	public function get_comments($filter_data) {

		$this->db->select('comment.*, user.firstname, user.lastname, user.id');
		$this->db->from('comment');
		$this->db->join('user', 'comment.user_id = user.id', 'left inner'); 

		if(isset($filter_data["user_id"])) {
			$this->db->where('comment.user_id', $filter_data["user_id"]);
		}

		if(isset($filter_data["post_id"])) {
			$this->db->where('comment.post_id', $filter_data["post_id"]);
		}

		$this->db->order_by('date_added', 'DESC');

		$query = $this->db->get();
		return $query->result_array();

	}


	public function count_post_comments($post_id) {

		$query = $this->db->get_where('post', array("post_id" => $post_id));
		$this->db->where('post_id', $post_id);
		$this->db->from('comment');
		$this->db->count_all_results();
		return $this->db->count_all_results();
	}

	public function get_post_comments($filter_data) {
		$this->db->select('*');
		$this->db->from('user');
		if(isset($filter_data["email"])) {
			$this->db->where('lower(email)', $filter_data["email"]);
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


	public function set_user_status($post_id, $status) {
		$this->db->set('is_spam', $status);
		$this->db->where('post_id', $post_id);
		$this->db->update('post');
		return ($this->db->affected_rows() != 1) ? false : true;
	}



	public function get_reports() {

		$this->db->select('report.*, user.id, user.firstname, user.lastname');
		$this->db->from('report');
		$this->db->join('user', 'report.user_id = user.id', 'left inner'); 
		$this->db->order_by('date', 'DESC');

		$query = $this->db->get();
		return $query->result_array();

	}


}
?>
