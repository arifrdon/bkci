<?php
class List_siswa extends CI_Controller{
    function __construct(){
        parent::__construct();
        if(!$this->session->has_userdata('user_id')){
            redirect('admin/login');
        } 
        $this->load->model('orang_tua_model');
        $this->load->library('form_validation');
    }

    function index(){
        $this->load->model('siswa_model','siswa');
        $data["siswa"] = $this->siswa->getSiswaByOrtuId($this->session->userdata('id_orang_tua'));
        $this->load->view('wali/list_siswa',$data);
    }
    function detail($id=null,$komentar=null,$id_kejadian_siswa=null){
        if(!isset($id)) redirect('wali'); 
        $this->load->model('kejadian_siswa_model');
        $this->load->model('forum_kejadian_model','forum_kejadian');
        $this->load->helper('tanggal');
        if($komentar==null && $id_kejadian_siswa==null){
            $this->load->model('siswa_model','siswa');
            $data['no_induk'] = $id;
            $data["siswa"] = $this->siswa->getById($id);
            
            $data["siswa"]->tanggal_lahir = convertdateonly($data["siswa"]->tanggal_lahir);
            $data["singlescore"] = $this->kejadian_siswa_model->getsinglescore($id);
            
            $this->load->view('wali/list_siswa_detail', $data);
        } else {
            $kejadiansw = $this->kejadian_siswa_model;
            $validation = $this->form_validation;
            $validation->set_rules($kejadiansw->ruleschat());
            if($validation->run()){
                $this->forum_kejadian->chatsave();
                $this->session->set_flashdata('success','Berhasil Ditambahkan');
            }
    
            $data["kejadiansw"] = $kejadiansw->getByIdForChat($id_kejadian_siswa);
            $data["forum_kejadian"] = $this->forum_kejadian->getAll($id_kejadian_siswa);
            foreach($data["forum_kejadian"] as $fk){
                $fk->tanggal_chat = convertdate($fk->tanggal_chat);
            }
            $data["kejadiansw"]->TANGGAL_KEJADIAN = convertdate($data["kejadiansw"]->TANGGAL_KEJADIAN);
            $data["idchatbk"] = $id_kejadian_siswa;
            $this->load->view('admin/kejadian_siswa/chat_bk',$data);
        }
    }
    function add(){
       
    }
    function edit($id = null){
       
    }
    function delete($id=null){
       
        
    }
    public function ajax_list($id)
    {
        $this->load->model('kejadian_siswa_model');
        
        $list = $this->kejadian_siswa_model->get_datatables_listsiswadet($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $information) {
            $no++;
            $row = array();
            $row[] = $information->NAMA_KEJADIAN;
            $row[] = $information->TANGGAL_KEJADIAN;
            $row[] = $information->TIPE_KEJADIAN;
            $row[] = $information->POIN_KEJADIAN;
            
                $row[] = "
                <a href='".  site_url('wali/list_siswa/detail/'.$id.'/komentar/'.$information->ID_KEJADIAN_SISWA) ."' class='btn btn-small'><i class='fas fa-comments'></i>&nbsp;Comment</a>
                ";
                
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->kejadian_siswa_model->count_all_listsiswadet($id),
                        "recordsFiltered" => $this->kejadian_siswa_model->count_filtered_listsiswadet($id),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}