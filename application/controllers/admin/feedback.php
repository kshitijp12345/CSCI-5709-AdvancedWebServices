<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends Admin_Controller {
 
  function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->model('admin/feedback_model');
  }
   

  public function index() {
		$this->load->helper('form');
		$this->load->helper('security');

		$this->data['page_title'] = 'Feedback';


		$filter_data = array();
		if (isset($_GET['filter_keyword'])) {
			$filter_data["keywords"] = $_GET['filter_keyword'];
		}

		$this->data['feedbacks'] = $this->feedback_model->get_feedbacks($filter_data); 
		$this->render('admin/feedback_list');
	}
 

}
