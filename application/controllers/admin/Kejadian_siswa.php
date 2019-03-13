<?php
class Kejadian_siswa extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('kejadian_siswa_model');
        $this->load->library('form_validation');
    }

    function index(){
        $this->load->view('admin/kejadian_siswa/list');
    }
    function add(){
        $this->load->model('daftar_kejadian_model','daftar_kejadian');
        $this->load->model('siswa_model','siswa');
        $data["daftar_kejadian"] = $this->daftar_kejadian->getAllKejadianDropdownBK();
        $data["siswa"] = $this->siswa->getAllSiswaDropdownBK();
        $kejadiansw = $this->kejadian_siswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($kejadiansw->rules());
        if($validation->run())
        {
            $kejadiansw->save();
            $this->session->set_flashdata('success','Berhasil Disimpan');
        }
        $this->load->view('admin/kejadian_siswa/new_form',$data);
    }
    function edit($id = null){
        $this->load->model('daftar_kejadian_model','daftar_kejadian');
        $this->load->model('siswa_model','siswa');
        if(!isset($id)) redirect('admin/kejadian_siswa'); 
        $kejadiansw = $this->kejadian_siswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($kejadiansw->rules());
        if($validation->run()){
            $kejadiansw->update();
            $this->session->set_flashdata('success','Berhasil Diubah');
        }
        $data["daftar_kejadian"] = $this->daftar_kejadian->getAllKejadianDropdownBK();
        $data["siswa"] = $this->siswa->getAllSiswaDropdownBK();
        $data["kejadiansw"] = $kejadiansw->getById($id);
        $this->load->view('admin/kejadian_siswa/edit_form',$data);
    }
    function delete($id=null){
        if(!isset($id)) show_404();
        if($this->kejadian_siswa_model->delete($id)){
            $this->session->set_flashdata('delete_success','Hapus Sukses.');
            redirect(site_url('admin/kejadian_siswa'));
        } else {
            $this->session->set_flashdata('delete_fail','Hapus Gagal, kontak Admin Anda.');
            redirect(site_url('admin/kejadian_siswa'));
        }
    }
    function chat_bk($id = null){
        $this->load->model('forum_kejadian_model','forum_kejadian');
        if(!isset($id)) redirect('admin/kejadian_siswa'); 
        $kejadiansw = $this->kejadian_siswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($kejadiansw->ruleschat());
        if($validation->run()){
            $this->forum_kejadian->chatsave();
            $this->session->set_flashdata('success','Berhasil Ditambahkan');
        }

        $data["kejadiansw"] = $kejadiansw->getByIdForChat($id);
        $data["forum_kejadian"] = $this->forum_kejadian->getAll($id);
        foreach($data["forum_kejadian"] as $fk){
            $fk->tanggal_chat = $this->convertdate($fk->tanggal_chat);
        }
        $data["kejadiansw"]->TANGGAL_KEJADIAN = $this->convertdate($data["kejadiansw"]->TANGGAL_KEJADIAN);
        $data["idchatbk"] = $id;
        $this->load->view('admin/kejadian_siswa/chat_bk',$data);
    }
    function deletechat($id=null,$redirid=null){
        if(!isset($id)) show_404();
        $this->load->model('forum_kejadian_model','forum_kejadian');
        if($this->forum_kejadian->delete($id)){
            echo "aa";
            $this->session->set_flashdata('delete_success','Hapus Sukses.');
            redirect(site_url('admin/kejadian_siswa/chat_bk/'.$redirid));
        } else {
            echo "bb";
            $this->session->set_flashdata('delete_fail','Hapus Gagal, kontak Admin Anda.');
            redirect(site_url('admin/kejadian_siswa/chat_bk/'.$redirid));
        }
    }
    function score_list($secondparam=null,$id=null, $na=null){
        if($secondparam==null && $id==null && $na == null){
            $this->load->view('admin/kejadian_siswa/score_list');
        } else {
            if(!isset($id)) redirect('admin/kejadian_siswa/score_list'); 
            $this->load->model('siswa_model','siswa');
            $data["siswa"] = $this->siswa->getById($id);
            $data["score_det"] = $this->kejadian_siswa_model->getScoreDetail($id);
            foreach($data["score_det"] as $sd){
                $sd->TANGGAL_KEJADIAN = $this->convertdate($sd->TANGGAL_KEJADIAN);
            }
            $data["na"] = $na;
            $this->load->view('admin/kejadian_siswa/score_detail',$data);
        }
    }
    function expsub(){
        $mysub = $this->kejadian_siswa_model->subq();
        foreach ($mysub as $my){
            echo $my->poin_akhir."<br>";
        }
        print_r($this->db->last_query());
    }
    public function ajax_list()
    {
        
        $list = $this->kejadian_siswa_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $information) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $information->NO_INDUK;
            $row[] = $information->nama_siswa;
            $row[] = $information->nama_kejadian;
            $row[] = $information->poin_kejadian;
            $row[] = $this->convertdate($information->TANGGAL_KEJADIAN);
            if($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "guru" || $this->session->userdata('level') == "guru_bk" || $this->session->userdata('level') == "orang_tua"){
                $row[] = "
                <a href='".  site_url('admin/kejadian_siswa/chat_bk/'.$information->ID_KEJADIAN_SISWA) ."' class='btn btn-small'><i class='fas fa-comments'></i>&nbsp;Comment</a>
                "."
                <a href='".  site_url('admin/kejadian_siswa/edit/'.$information->ID_KEJADIAN_SISWA) ."' class='btn btn-small'><i class='fas fa-edit'></i>Edit</a>
                "."
                <a onclick='deleteConfirm(\"". (string)site_url('admin/kejadian_siswa/delete/'.$information->ID_KEJADIAN_SISWA) ."\")' href='#!'  class='btn btn-small text-danger'><i class='fas fa-trash'></i>Delete</a>
                ";
            }
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->kejadian_siswa_model->count_all(),
                        "recordsFiltered" => $this->kejadian_siswa_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_list_score()
    {
        
        $list = $this->kejadian_siswa_model->get_datatables_score();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $information) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $information->noindukdistinct;
            $row[] = $information->namasiswa;
            $row[] = $information->poin_awal;
            if($this->session->userdata('fitur_reward') == 1){
                $row[] = $information->poin_reward;
            }
            $row[] = $information->poin_pelanggaran;
            $row[] = $information->poin_akhir;
            
                $row[] = "
                <a href='".  site_url('admin/kejadian_siswa/score_list/score_detail/'.$information->noindukdistinct.'/'.$information->poin_akhir) ."' class='btn btn-small'><i class='fas fa-list-ol'></i>&nbsp;Detail</a>
                "."
                <a href='' class='btn btn-small'><i class='fas fa-file-pdf'></i>&nbsp;Cetak</a>
                ";
           
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->kejadian_siswa_model->count_all_score(),
                        "recordsFiltered" => $this->kejadian_siswa_model->count_filtered_score(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    function printpdf(){
        $pdf = new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!');
        $pdf->Output();
    }
    public function convertdate($tanggal){
        $namatanggal=date("d",strtotime($tanggal)); 
        $bulan = date("n",strtotime($tanggal));
        $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
        $namabulan = $array_bln[$bulan];
        $namatahun = date("Y",strtotime($tanggal));
        $namajam = date("H",strtotime($tanggal));
        $namamenit = date("i",strtotime($tanggal));
		return $namatanggal." ".$namabulan." ".$namatahun." ".$namajam.":".$namamenit;
    }

}