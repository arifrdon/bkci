<?php
defined('BASEPATH') or exit('no direct script allowed');

class Wali_kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('user_id')){
            redirect('admin/login');
        }
        $this->load->model("walikelas_model");
        $this->load->library("form_validation");
    }

    public function index()
    {
        $this->load->view("admin/wali_kelas/list");
    }
    public function ajax_list()
    {
        
        $list = $this->walikelas_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $information) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $information->id_wali_kelas;
            $row[] = $information->nama_kelas;
            $row[] = $information->nama_guru;
            $row[] = $information->tahun;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->walikelas_model->count_all(),
                        "recordsFiltered" => $this->walikelas_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function add()
    {

    }
    public function edit($id = null)
    {
    
    }
    public function delete($id=null){
       
    }

    
}