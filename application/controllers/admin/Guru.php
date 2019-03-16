<?php
defined('BASEPATH') or exit('no direct script allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('user_id')){
            redirect('admin/login');
        } 
        $this->load->model("guru_model");
        $this->load->library("form_validation");
    }

    public function index()
    {
        $data["guru"] = $this->guru_model->getAll();
        $this->load->view("admin/guru/list", $data);
    }
    public function ajax_list()
    {
        
        $list = $this->guru_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $information) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $information->nip;
            $row[] = $information->nama_guru;
            $row[] = $information->jenis_kelamin;
            $row[] = $information->alamat;
            $row[] = $information->no_telepon;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->guru_model->count_all(),
                        "recordsFiltered" => $this->guru_model->count_filtered(),
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