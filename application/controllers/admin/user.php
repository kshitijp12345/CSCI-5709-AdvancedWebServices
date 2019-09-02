<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {
 
  function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->model('admin/user_model');
  }
   

  public function index() {
		$this->load->helper('form');
		$this->load->helper('security');

		$this->data['page_title'] = 'Users';

		$filter_data = array();

		if (isset($_GET['filter_status'])) {
			$filter_data["status"] = $_GET['filter_status'];
		}
		if (isset($_GET['filter_name'])) {
			$filter_data["name"] = $_GET['filter_name'];
		}
		if (isset($_GET['filter_net_id'])) {
			$filter_data["net_id"]  = $_GET['filter_net_id'];
		}

		$this->data['users'] = $this->user_model->get_users($filter_data); //call to user model to retrieve users
		$this->render('admin/user/user_list');
	}
	
	public function details($user_id=NULL) {
		$user = array();
		if(isset($user_id) && !empty($user_id)) {
			$this->load->helper('form');

			$user = $this->user_model->get_user($user_id);
			$this->data['page_title'] = $user["firstname"] .' Details';
			$this->data['user_data'] = $user;

			$this->load->model('admin/post_model');
			$filter_data = array("user_id" => $user["id"]);
			$this->data['user_posts'] = $this->post_model->get_posts($filter_data);

			$filter_data = array("user_id" => $user["id"]);
			$this->data['user_comments'] = $this->post_model->get_comments($filter_data);

			/** Creates breadcrumb to show and easily access previous pages  */
			$this->data["breadcrumb_referral"] = (!isset($_SERVER['HTTP_REFERER'])) ? base_url() .'admin/user' : $_SERVER['HTTP_REFERER'];

		}
		$this->render('admin/user/user_details');
	}

 
	public function update_status() {

		header('Content-type:application/json');
		$response = array();
		$this->load->helper(array('form', 'url'));

		/** form_validation used to validate requests on server side */
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules('user_id','User Id','required');
		$this->form_validation->set_rules('status','Status', 'required');

		if($this->form_validation->run() == false) {
			http_response_code(400);
			$response = array(SUCCESS_TEXT => false, MESSAGE_TEXT => validation_errors());
		} else {
			$user_id = $this->input->post('user_id');
			$status = $this->input->post('status');

			if($this->user_model->set_user_status($user_id, $status)) {
				$response = array(SUCCESS_TEXT => true, MESSAGE_TEXT => "User status updated Successful");
			} else {
				http_response_code(400);
				$response = array(SUCCESS_TEXT => false, MESSAGE_TEXT => "Unable to update status, please try again later");
			}
		}
		echo json_encode($response);
	}
 
  public function contact() {
		header('Content-type:application/json');
		$response = array();
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	
		$this->load->helper('security');
		$this->form_validation->set_rules('receiver_id','Receiver Id','required');
		$this->form_validation->set_rules('subject','Subject','trim|required');
		$this->form_validation->set_rules('message','message','required|min_length[10]');
	
		if($this->form_validation->run() == false) {
			http_response_code(400);
			$response = array(SUCCESS_TEXT => false, MESSAGE_TEXT => validation_errors());
		} else {
			$receiver_id = $this->input->post('receiver_id');
			$subject = $this->input->post('subject');
			$message = $this->input->post('message');
			
			$message = $this->security->xss_clean(htmlspecialchars($message)); //xss_clean provides Cross Site Script Hack filtering.
			if($this->user_model->save_message($receiver_id, $subject, $message)) { 
				
				$response = array(SUCCESS_TEXT => true, MESSAGE_TEXT => 'Messagee sent Successful');
			} else {
				http_response_code(400);
				$response = array(SUCCESS_TEXT => false, MESSAGE_TEXT => "Unable to update status, please try again later");
			}
		}
		echo json_encode($response);
  }

}
