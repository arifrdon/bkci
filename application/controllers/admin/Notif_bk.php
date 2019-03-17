<?php
class Notif_bk extends CI_Controller{
    function __construct(){
        parent::__construct();
        if(!$this->session->has_userdata('user_id')){
            redirect('admin/login');
        } 
        $this->load->model('notif_bk_model');
        $this->load->library('form_validation');
    }

    function index(){
        $this->load->view('admin/daftar_kejadian/list');
    }
    function add(){
        
    }
    function edit($id = null){
       
    }
    function delete($id=null){
        
    }
    function fetch(){
        $post = $this->input->post();
        $this->load->helper('tanggal');
        if(isset($post['view'])){
            if($post['view'] !=""){
                if($this->session->userdata('level') == 'orang_tua'){
                    $this->notif_bk_model->fetch_notif_forwali_clicked();
                } elseif($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'kepala_sekolah' || $this->session->userdata('level') == 'guru_bk'){
                    $this->notif_bk_model->fetch_notif_nonwali_clicked();
                } elseif($this->session->userdata('level') == 'guru'){
                    $this->notif_bk_model->fetch_notif_forguru_clicked();
                }
            }
            if($this->session->userdata('level') == 'orang_tua'){
                $listnotif = $this->notif_bk_model->fetch_notif_forwali();
                $jmllistnotif = $this->notif_bk_model->fetch_notif_forwali_count();
            } elseif($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'kepala_sekolah' || $this->session->userdata('level') == 'guru_bk'){
                $listnotif = $this->notif_bk_model->fetch_notif_nonwali();
                $jmllistnotif = $this->notif_bk_model->fetch_notif_nonwali_count();
            } elseif($this->session->userdata('level') == 'guru'){
                $listnotif = $this->notif_bk_model->fetch_notif_forguru();
                $jmllistnotif = $this->notif_bk_model->fetch_notif_forguru_count();
            }
            $output = '';
            if(!empty($listnotif)){
                foreach($listnotif as $ln){
                    if($this->session->userdata('level') == 'orang_tua'){
                        if($ln->id_forum == 0){
                            $output .="<div class='dropdown-divider '></div>
                            <a class='dropdown-item alert-warning' href='".site_url('wali/list_siswa/detail/'.$ln->NO_INDUK)."'><strong> Siswa: ".ucwords($ln->nama_siswa)."</strong><br><small><strong>Telah Melakukan Kejadian </strong></small><br><small><strong><u>".$ln->NAMA_KEJADIAN."</u></strong></small><br><small>".convertdate($ln->waktu)."</small></a><div class='dropdown-divider'></div>";
                        }
                        $output .="<div class='dropdown-divider'></div>
                        <a class='dropdown-item' href='".site_url('wali/list_siswa/detail/'.$ln->NO_INDUK.'/komentar/'.$ln->id_kejadian_siswa)."'><strong>".ucwords(str_replace('_', ' ', $ln->level)).": ".ucwords($ln->user_nama)."</strong><br><small><strong>Mengomentari kejadian ".ucwords($ln->nama_siswa)."</strong></small><br><small><strong><u>".$ln->NAMA_KEJADIAN."</u></strong></small><br><small>".convertdate($ln->waktu)."</small></a><div class='dropdown-divider'></div>";
                    } else {
                        $output .="<div class='dropdown-divider'></div>
                        <a class='dropdown-item' href='".site_url('admin/kejadian_siswa/chat_bk/'.$ln->id_kejadian_siswa)."'><strong>".ucwords(str_replace('_', ' ', $ln->level)).": ".ucwords($ln->user_nama)."</strong><br><small><strong>Mengomentari kejadian ".ucwords($ln->nama_siswa)."</strong></small><br><small><strong><u>".$ln->NAMA_KEJADIAN."</u></strong></small><br><small>".convertdate($ln->waktu)."</small></a><div class='dropdown-divider'></div>";    
                    }
                }
            } else {
                $output .= "<a class='dropdown-item' href='#'>No Notification</a>";
            }
            $data = array(
                'notification' => $output,
                'unseen_notification'  => $jmllistnotif
            );
        echo json_encode($data);
        }
    }
    function fetch2(){
        // $this->load->model('notif_bk_model','notif_bk');
        // $id_kejadian_siswa = 39;
        // $TANGGAL_KEJADIAN = '2019-03-17 15:30';
        // $this->notif_bk->save($id_kejadian_siswa, $this->session->userdata('user_id'), $this->session->userdata('level'), $TANGGAL_KEJADIAN, 0);
    }

}