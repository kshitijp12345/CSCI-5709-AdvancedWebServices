<?php
class contactform extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
        $this->load->helper('captcha');
    }

    function index()
    {
        //validation rules to validate the values entered in the field
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Emaid ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');


        if ($this->form_validation->run() == FALSE)
        {
            $this->render('contact_form_view');
            //$this->load->view('contact_form_view');
        }
        else
        {
            //insert the values into the database
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message')
            );

            if ($this->db->insert('contacts', $data))
            {
                // success message
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">We received your message! Will get back to you shortly!!!</div>');
                redirect('contactform/index');
            }
            else
            {
                // failure message
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Some Error.  Please try again later!!!</div>');
                redirect('contactform/index');
            }
        }
    }

}
?>
