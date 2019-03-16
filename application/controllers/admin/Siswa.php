<?php
defined('BASEPATH') or exit('no direct script allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('user_id')){
            redirect('admin/login');
        } 
        $this->load->model("siswa_model");
        $this->load->library("form_validation");
    }

    public function index()
    {
        $data["siswa"] = $this->siswa_model->getAll();
        $this->load->view("admin/siswa/list", $data);
    }
    public function ajax_list()
    {
        
        $list = $this->siswa_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $information) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $information->no_induk;
            $row[] = $information->nama_siswa;
            $row[] = $information->nama_kelas;
            $row[] = $information->tempat." ".$information->tanggal_lahir;
            $row[] = $information->no_telepon;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->siswa_model->count_all(),
                        "recordsFiltered" => $this->siswa_model->count_filtered(),
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