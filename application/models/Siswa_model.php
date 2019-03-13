<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Siswa_model extends CI_Model{
    private $_table = "siswa";

    public $no_induk;
    public $id_wali_kelas;
    public $id_orang_tua;
    public $nama_siswa;
    public $panggilan;
    public $tempat;
    public $tanggal_lahir;
    public $jenis_kelamin_siswa;
    public $username;
    public $password;

    public function rules(){
       
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getAllSiswaDropdownBK()
    {
        $this->db->select('a.no_induk, a.nama_siswa, a.panggilan, a.tempat, a.tanggal_lahir, a.jenis_kelamin_siswa');
        $this->db->from($this->_table." as a");
        if($this->session->userdata('level') == "guru"){
            $this->db->join("wali_kelas b","a.id_wali_kelas = b.id_wali_kelas","inner");
            $this->db->where("b.nip",$this->session->userdata('user_username'));
        }
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table,["no_induk"=> $id])->row();
    }
    public function getSiswaOrtuById($id)
    {
        $this->db->select('a.no_induk, a.nama_siswa, b.user_nama');
        $this->db->from($this->_table." as a");
        $this->db->join("orang_tua as b","a.id_orang_tua = b.id_orang_tua","inner");
        $this->db->where("a.no_induk ",$id);
        return $this->db->get()->row();
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