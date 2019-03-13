<?php
defined('BASEPATH') or exit('no direct script allowed');
class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("userdata_model");
        $this->load->library("form_validation");
    }
    function index(){
        $data["users"] = $this->userdata_model->getAll();
        $this->load->view('admin/users/list',$data);
    }
    function add(){
        $user = $this->userdata_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());
        if($validation->run())
        {
            $user->save();
            $this->session->set_flashdata('success','Berhasil Disimpan');
        }
        $this->load->view('admin/users/new_form');
    }
    function edit($id = null){
        if(!isset($id)) redirect('admin/users'); 
        $user = $this->userdata_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());
        if($validation->run()){
            $user->update();
        }
        $data["user"] = $user->getById($id);
        $this->load->view('admin/users/edit_form',$data);
    }
    function delete($id=null){
        if(!isset($id)) show_404();
        if($this->userdata_model->delete($id)){
            echo "hay1";
            redirect(site_url('admin/users'));
           echo "hay2";
        }
        
    }
    public function ajax_list()
    {
        $list = $this->userdata_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->user_id;
            $row[] = $customers->user_username;
            $row[] = $customers->user_password;

 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->userdata_model->count_all(),
                        "recordsFiltered" => $this->userdata_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}