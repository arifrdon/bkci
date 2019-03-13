<?php
class Logout extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('userdata_model');
        $this->load->library('form_validation');
    }

    function index(){
        $this->session->sess_destroy();
        redirect('admin/login');
    }

}