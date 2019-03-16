<?php
class Pengaturan_bk extends CI_Controller{
    function __construct(){
        parent::__construct();
        if(!$this->session->has_userdata('user_id')){
            redirect('admin/login');
        } 
        $this->load->model('pengaturan_bk_model');
        $this->load->library('form_validation');
    }

    function index(){
        $this->load->view('admin/overview');
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
        $pengaturan = $this->pengaturan_bk_model;
        $this->load->model('guru_model','guru');
        $validation = $this->form_validation;
        $validation->set_rules($pengaturan->rules());
        if($validation->run()){
            if($pengaturan->update()){
                $this->session->set_flashdata('update_success','Update Pengaturan Sukses.');
            } else {
                $this->session->set_flashdata('update_fail','Update Pengaturan Gagal, hubungi Admin Anda.');
            }
        }
        $data["poin_awal"] = $pengaturan->getById(1);
        $data["fitur_reward"] = $pengaturan->getById(2);
        $data["operator_bk"] = $pengaturan->getById(3);
        $data["tekskop1"] = $pengaturan->getById(4);
        $data["tekskop2"] = $pengaturan->getById(5);
        $data["tekskop3"] = $pengaturan->getById(6);
        $data["tekskop4"] = $pengaturan->getById(7);
        $data["nip"] = $pengaturan->getById(8);
        $data["guru"] = $this->guru->getAll();
        $this->load->view('admin/pengaturan_bk/pengaturan_bk',$data);
    }
}