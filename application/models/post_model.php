<?php

class Post_Model extends CI_Model {

	public function get_categories() {
		$query = $this->db->query("SELECT * FROM category ORDER BY name ASC");
		$result = $query->result_array();
		foreach($result as $key => $result_item) {
			$result[$key]["count"] = $this->get_category_count($result_item["name"]);
		}
		return $result;
	}


	public function get_category_count($category) {
		$query = $this->db->query("SELECT COUNT(categories) as count FROM post WHERE categories = '$category' ");
		$result = $query->row_array();
		$result = (int)$result["count"];
		return $result;
	}

	public function get_posts($category) {

		$sql = "SELECT * FROM post JOIN user ON post.user_id = user.id WHERE post.is_spam = 0"; 
		if(isset($category) && !empty($category)) {
			$sql .= " AND post.categories = '$category'"; 
		}
		$sql .= " ORDER BY date_created desc";

		// if table exists it fetches all posts from the database by running query
		$query = $this->db->query($sql);

		//Stores result data in result variable
		return $query->result();
	}

	public function get_profile_posts($user_id) {

		// if table exists it fetches all posts from the database by running query
		$query = $this->db->query("SELECT * FROM post WHERE post.is_spam = 0 AND post.user_id = $user_id ORDER BY date_created desc;");

		//Stores result data in result variable
		return $query->result();
	}
	
	public function insertData($data){
		if ($this->db->table_exists('post')) {
			$this->db->insert('post', $data);
		} else {
			//creating new posts table for data insertion on the first time
			$this->db->query('CREATE TABLE post (post_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, user_id INT(10) NOT NULL, categories VARCHAR(50) NOT NULL,post_title VARCHAR(255) NOT NULL,post_content VARCHAR(255) NOT NULL, hashtags VARCHAR(255), spam BOOLEAN NOT NULL default 0,date_created TIMESTAMP NOT NULL)');
			$this->db->insert('post', $data);
		}
	}


		public function searchData($searchKeyword){

			$query = $this->db->query("SELECT * FROM post JOIN user ON post.user_id = user.id WHERE post.is_spam = 0 AND (post_title Like '%".$searchKeyword."%' OR post_content Like '%".$searchKeyword."%') ORDER BY date_created desc;");

			return $query->result();
		}



	public function updateData($postId, $data){
		$this->db->where('post_id', $postId);
		$this->db->update('post', $data);
	}

	function deletePost($data)
	{
		if (!empty($data)) {
			$this->db->where_in('post_id', $data);
			return $this->db->delete('post');
		}
	}
}
?>
