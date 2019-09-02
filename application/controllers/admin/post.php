<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends Admin_Controller {
 
  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('admin/post_model');
  }

  public function index() {
	
		$this->load->helper('form');
		$this->load->helper('security');

		$this->data['page_title'] = 'Posts';

		$filter_data = array();

		if (isset($_GET['filter_keyword'])) {
			$filter_data["keywords"] = $_GET['filter_keyword'];
		}
		if (isset($_GET['filter_date'])) {
			$filter_data["date"] = $_GET['filter_date'];
		}
		if (isset($_GET['filter_spam'])) {
			$filter_data["is_spam"]  = $_GET['filter_spam'];
		}
		if (isset($_GET['filter_author'])) {
			$filter_data["author"]  = $_GET['filter_author'];
		}

		$this->data['posts'] = $this->post_model->get_posts($filter_data); //call to post model to retrieve posts
		$this->render('admin/post/post_list');
  }

 
  	public function details($post_id=NULL) {
		$user = array();
		if(isset($post_id) && !empty($post_id)) {
			$post_data = $this->post_model->get_post($post_id);
			$this->data['post_data'] = $post_data;
			$filter_data = array("post_id" => $post_id);
			$this->data['post_comments'] = $this->post_model->get_comments($filter_data);
			$this->data['post_comments_count'] = $this->post_model->count_post_comments($post_id);
			$this->data['post_reported_abuses'] = $this->post_model->get_reports($post_id);
			$this->data['page_title'] ='Post Details';
			$this->data["breadcrumb_referral"] = (!isset($_SERVER['HTTP_REFERER'])) ? base_url() .'admin/post' : $_SERVER['HTTP_REFERER'];
			$this->load->helper('form');
		}
		$this->render('admin/post/post_details');
	}


	public function update_status() {

		header('Content-type:application/json');

		$response = array();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->helper('security');

		$this->form_validation->set_rules('post_id','Post Id','required');
		$this->form_validation->set_rules('spam_status','Spam Status', 'required');

		if($this->form_validation->run() == false) {
			http_response_code(400);
			$response = array(SUCCESS_TEXT => false, MESSAGE_TEXT => validation_errors());
		} else {
			$post_id = $this->input->post('post_id');
			$spam_status = $this->input->post('spam_status');

			if($this->post_model->set_user_status($post_id, $spam_status)) {
				$response = array(SUCCESS_TEXT => true, MESSAGE_TEXT => "Post status updated Successful");
			} else {
				http_response_code(400);
				$response = array(SUCCESS_TEXT => false, MESSAGE_TEXT => "Unable to update status, please try again later");
			}
		}
		echo json_encode($response);
	}

}
