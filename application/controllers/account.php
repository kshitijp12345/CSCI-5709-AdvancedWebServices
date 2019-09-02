<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('post_model');
		$this->load->model('commentPost');
		$this->load->helper('form');
		
	}

	public function index() {
		redirect(base_url().'account/profile');
	}

	public function login() {
		$this->data['page_title'] = 'Dalhousie Forum - Login';
		if ($this->session->userdata('user_id')) {
			redirect(base_url().'post');
		}


		$this->load->helper('form');

		if(isset($_POST)) {

			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('id','Net Id or Email address','required');
			$this->form_validation->set_rules('password','Password','required|min_length[5]');

			if($this->form_validation->run() == false) {
				$this->session->set_flashdata('error', validation_errors());
			} else {
				$id = $this->input->post("id");
				$password = $this->input->post("password");

				if($user = $this->user_model->get_user_by($id, $password)) {

					if((int)($user["status"]) == 1) {
						$this->session->set_userdata('email', $user["email"]);
						$this->session->set_userdata('name', $user["firstname"] . ' '.  $user["lastname"]);
						$this->session->set_userdata('net_id', $user["net_id"]);
						$this->session->set_userdata('user_id', $user["id"]);
						if((int)($user["type"]) != 4) {
							redirect(base_url().'post', 'refresh');
						} else {
							$this->session->set_userdata('user_type', "admin");
							redirect(base_url().'admin', 'refresh');
						}
					} else {
						$this->session->set_flashdata('error', "User has been disable by admin, please contact admin.");
					}
				} else {
					$this->session->set_flashdata('error', "No match for Net ID and/or Password.");
				}
			}
		}

		$data["error"] = $this->session->flashdata('error');
		$this->load->view('account/login', $data);
	}

	public function profile() {
		$this->check_login_status();

		$this->data['page_title'] = 'Dalhousie Forum - Profile';
		$this->load->helper('form');
		$user_id = $this->session->user_id;
		$this->data["name"] = $this->session->name;

		$this->data["result"] = $this->post_model->get_profile_posts($user_id);
		$this->data["comment_count"] = $this->commentPost->getCounts($user_id);
		$this->data["user_comments"] = $this->commentPost->get_user_comments($user_id);
		$this->data["activities"] = $this->commentPost->fetch_comment_activites($user_id);
		$this->data['categories'] = $this->post_model->get_categories();
		$this->render('account/profile');
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url().'/account/login');
	}
}
