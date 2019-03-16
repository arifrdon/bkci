<?php
class Daftar_kejadian extends CI_Controller{
    function __construct(){
        parent::__construct();
        if(!$this->session->has_userdata('user_id')){
            redirect('admin/login');
        } 
        $this->load->model('daftar_kejadian_model');
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
    function delete($id=null){
        if(!isset($id)) show_404();
        if($this->daftar_kejadian_model->delete($id)){
            $this->session->set_flashdata('delete_success','Hapus Sukses.');
            redirect(site_url('admin/daftar_kejadian'));
        } else {
            // echo "<script>alert('Hapus Gagal, kejadian telah dipakai di kejadian siswa.');</script>";
            // $this->load->view('admin/daftar_kejadian/list');

            // echo "<script>
            // alert('Hapus Gagal, kejadian telah dipakai di kejadian siswa.');
            // window.location.href='".site_url('admin/daftar_kejadian')."';
            // </script>";

            $this->session->set_flashdata('delete_fail','Hapus Gagal, kejadian telah dipakai di kejadian siswa.');
            redirect(site_url('admin/daftar_kejadian'));
        }
        
    }
    public function ajax_list()
    {
        
        $list = $this->daftar_kejadian_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $information) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $information->NAMA_KEJADIAN;
            $row[] = $information->POIN_KEJADIAN;
            $row[] = $information->TIPE_KEJADIAN;
            if($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "guru_bk"){
                $row[] = "
                <a href='".  site_url('admin/daftar_kejadian/edit/'.$information->ID_DAFTAR_KEJADIAN) ."' class='btn btn-small'><i class='fas fa-edit'></i>Edit</a>
                "."
                <a onclick='deleteConfirm(\"". (string)site_url('admin/daftar_kejadian/delete/'.$information->ID_DAFTAR_KEJADIAN) ."\")' href='#!'  class='btn btn-small text-danger'><i class='fas fa-trash'></i>Delete</a>
                ";
                
            }
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->daftar_kejadian_model->count_all(),
                        "recordsFiltered" => $this->daftar_kejadian_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}