<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('security');
		$this->load->library('session');
		$this->check_login_status();
		$this->load->model('post_model');
		$this->data['categories'] = $this->post_model->get_categories();
	}

	function _remap($method) {
		if (method_exists($this, $method)) {
			$this->$method($this->uri->segment(3));
		}
		else {
			$this->index($method);
		}
	}

	public function index($category) {

		$this->load->helper('form');
		$user_id = $this->session->user_id;
		$this->data["name"] = $this->session->name;

		$this->data["selected_category"] = urldecode($category);
		$this->data["result"] = $this->post_model->get_posts(urldecode($category));
		$this->render('post/index');

	}


	//Function to create new post and add values to the database
	public function createPost(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('postTitle','Title','required');
		$this->form_validation->set_rules('categorySelect','Category','required');
		$this->form_validation->set_rules('postText','Post message','required|min_length[5]');

		if($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', validation_errors());
		} else {
			//Fetching input field values from view
			$newPostCategory=$_POST['categorySelect'];
			$newPostTitle=$_POST['postTitle'];
			$newPostText=$_POST['postText'];
			$newPostHashtag=$_POST['postHashtag'];

			//Getting all data related posts in array form to prepare for database insertion
			$data=array(
				'user_id'=> $this->session->user_id,
				'categories'=>$newPostCategory,
				'post_title'=>$newPostTitle,
				'post_content'=>$newPostText,
				'Hashtags'=>$newPostHashtag);

			//Set current date and time in date_created field
			$this->db->set('date_created', 'NOW()', FALSE);

			//To send data to model where data insertion takes place
			$this->post_model->insertData($this->security->xss_clean($data));
			$this->session->set_flashdata('msg', 'Post Successfully Created');

			//Redirecting to index controller to update post feed on homepage
		}
		redirect($this->url->index);
	}

	public function searchPost(){

		//Fetching input field values from view
		$searchKeyword=$_POST['searchKeyword'];

		$this->data["result"] = $this->post_model->searchData($searchKeyword);

		//Redirecting to index controller to update post feed on homepage
		$this->load->helper('form');
		$user_id = $this->session->user_id;
		$this->data["name"] = $this->session->name;
		$this->render('post/index');
	}

	public function editPost() {
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('postTitle','Title','required');
		$this->form_validation->set_rules('categorySelect','Category','required');
		$this->form_validation->set_rules('postText','Post message','required|min_length[5]');

		if($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', validation_errors());
		} else {
			//Fetching input field values from view
			$newPostCategory=$_POST['categorySelect'];
			$newPostTitle=$_POST['postTitle'];
			$newPostText=$_POST['postText'];
			$newPostHashtag=$_POST['postHashtag'];

			//Getting all data related posts in array form to prepare for database insertion
			$data=array(
				'user_id'=> $this->session->user_id,
				'categories'=>$newPostCategory,
				'post_title'=>$newPostTitle,
				'post_content'=>$newPostText,
				'Hashtags'=>$newPostHashtag);

			//Set current date and time in date_created field
			//$this->db->set('date_created', 'NOW()', FALSE);

			//To send data to model where data insertion takes place
			$this->post_model->updateData($_POST['postId'], $this->security->xss_clean($data));
			$this->session->set_flashdata('msg', 'Post Successfully Updated');

			//Redirecting to index controller to update post feed on homepage
		}
		redirect(base_url().'account/profile');
	}

	public function deletePost() {
		if(!isset($_POST["selected_posts"])) {
			redirect(base_url().'account/profile');
		}

		if($this->post_model->deletePost($_POST["selected_posts"])) {
			$this->session->set_flashdata('msg', 'Post Successfully Deleted');
		} else {
			$this->session->set_flashdata('msg', 'Something unexpected happened, please try again later');
		}
		redirect(base_url().'account/profile');
	}
}
