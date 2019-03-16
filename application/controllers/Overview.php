<?php

class Overview extends CI_Controller{
    function __construct(){
        parent::__construct();
        if(!$this->session->has_userdata('user_id')){
            redirect('admin/login');
        }
    }
    function index(){
        $this->load->view("admin/overview");
    }
}