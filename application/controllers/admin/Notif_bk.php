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
                $this->notif_bk_model->fetch_notif_forwali_clicked();
            }
            $listnotif = $this->notif_bk_model->fetch_notif_forwali();
            $jmllistnotif = $this->notif_bk_model->fetch_notif_forwali_count();
            $output = '';
            if(!empty($listnotif)){
                foreach($listnotif as $ln){
                    $output .="<div class='dropdown-divider'></div>
                    <a class='dropdown-item' href=''><strong>".ucwords(str_replace('_', ' ', $ln->level)).": ".ucwords($ln->user_nama)."</strong><br><small><strong>Mengomentari kejadian ".ucwords($ln->nama_siswa)."</strong></small><br><small><strong><u>".$ln->NAMA_KEJADIAN."</u></strong></small><br><small>".convertdate($ln->waktu)."</small></a><div class='dropdown-divider'></div>";
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
        $this->notif_bk_model->fetch_notif_forwali_clicked();
    }

}