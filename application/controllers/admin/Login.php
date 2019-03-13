<?php
class Login extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('userdata_model');
        $this->load->library('form_validation');
    }

    function index(){
        if($this->session->has_userdata('user_name')){
            redirect('admin');
        } else {
            $this->load->view('admin/login');
        }
    }

    function autho(){
        $userdata = $this->userdata_model;
        $validation = $this->form_validation;
        $validation->set_rules($userdata->rules());

        if($validation->run()){
           // echo "masuk";
           // $userdata->autho();
           $login = $userdata->autho();
            if(!empty($login) && $login != "gurubukanwali"){
               //echo "berhasil";
               //echo "aa";
               $this->session->set_userdata($login);
               //echo $login['level'];
               $this->load->model('Pengaturan_bk_model','pengaturan_bk');
               $this->pengaturan_bk->set_session_setting();
               $this->load->view('admin/overview');
               //echo $this->session->userdata("poin_awal");
               //echo $this->session->userdata("fitur_reward");
               //echo $this->session->userdata("operator_bk");
               //redirect('admin');
            } elseif (!empty($login) && $login == "gurubukanwali"){
                $this->load->view('admin/login');
                echo "<script>alert('Login gagal. Maaf anda bukan wali kelas.');</script>";
                echo $this->session->set_userdata('login','gagal');
            } else {
                echo "gagal";
                echo $login;
                echo $userdata->autho();
                echo $this->session->set_userdata('login','gagal');
            }
        }
    }
}