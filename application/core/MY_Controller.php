<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class MY_Controller extends CI_Controller {
 
    protected $data = array();
    function __construct() {
      parent::__construct();
      $this->data['page_title'] = 'Dalhousie Forum';
      $this->load->helper('url');
      $this->load->library('session');
      $this->data["name"] = $this->session->name;
    }

    protected function render($the_view = NULL, $section = 'main') {
      $this->data['view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);
      $this->load->view('common/'.$section, $this->data);
    }

    public function check_login_status() {
      if (!$this->session->userdata('user_id')) { 
        redirect(base_url().'account/login');
      }
    }
}
 
class Admin_Controller extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->data['page_title'] = 'Dalhousie Forum - Admin';
    $this->load->helper('url');
    $this->data["name"] = $this->session->name;

    if (!$this->session->userdata('user_type')) { 
      redirect(base_url().'account/login');
    }
    
  }

  protected function render($the_view = NULL, $section = 'main') {

    /** 
     * Creates rendering system for admin 
     * https://avenir.ro/create-cms-using-codeigniter-3/create-template-for-admin-area/
     * */
    $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);
    $this->load->view('admin/common/'.$section, $this->data);

  }
}
