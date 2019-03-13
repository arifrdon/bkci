<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Pengaturan_bk_model extends CI_Model{
    private $_table = "pengaturan_bk";

    public $id_pengaturan_bk;
    public $nama_pengaturan;
    public $nilai_pengaturan;
    public $status_pengaturan;

    public function rules(){
       
    }
    public function set_session_setting(){
        $qpoin = $this->db->get_where($this->_table,["NAMA_PENGATURAN"=>"Poin Awal Siswa"])->row_array();
        $this->session->set_userdata('poin_awal', $qpoin['NILAI_PENGATURAN']);
        $qreward = $this->db->get_where($this->_table,["NAMA_PENGATURAN"=>"Fitur Reward"])->row_array();
        $this->session->set_userdata('fitur_reward', $qreward['STATUS_PENGATURAN']);
        $qoperator = $this->db->get_where($this->_table,["NAMA_PENGATURAN"=>"Operator Pelanggaran"])->row_array();
        $this->session->set_userdata('operator_bk', $qoperator['NILAI_PENGATURAN']);
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table,["id_orang_tua"=> $id])->row();
    }

    public function save()
    {
        
    }

    public function update()
    {
     
    }

    public function delete($id)
    {
       
    }

}