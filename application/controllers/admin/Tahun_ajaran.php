<?php
defined('BASEPATH') or exit('no direct script allowed');

class Tahun_ajaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('user_id')){
            redirect('admin/login');
        } 
        $this->load->model("tahun_ajaran_model");
        $this->load->library("form_validation");
    }

    public function index()
    {
        $this->load->view("admin/tahun_ajaran/list");
    }
    public function ajax_list()
    {
        
        $list = $this->tahun_ajaran_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $information) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $information->id_tahun;
            $row[] = $information->tahun;
            $row[] = $information->keterangan_tahun_ajaran;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->tahun_ajaran_model->count_all(),
                        "recordsFiltered" => $this->tahun_ajaran_model->count_filtered(),
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