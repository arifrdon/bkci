<?php
class Pengaturan_bk extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('pengaturan_bk_model');
        $this->load->library('form_validation');
    }

    function index(){
        $this->load->view('admin/daftar_kejadian/list');
    }
    function add(){
        $kejadian = $this->daftar_kejadian_model;
        $validation = $this->form_validation;
        $validation->set_rules($kejadian->rules());
        if($validation->run())
        {
            $kejadian->save();
            $this->session->set_flashdata('success','Berhasil Disimpan');
        }
        $this->load->view('admin/daftar_kejadian/new_form');
    }
    function edit($id = null){
        if(!isset($id)) redirect('admin/daftar_kejadian'); 
        $kejadian = $this->daftar_kejadian_model;
        $validation = $this->form_validation;
        $validation->set_rules($kejadian->rules());
        if($validation->run()){
            $kejadian->update();
        }
        $data["kejadian"] = $kejadian->getById($id);
        $this->load->view('admin/daftar_kejadian/edit_form',$data);
    }

    

}