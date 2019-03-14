<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Kelas_model extends CI_Model{
    private $_table = "kelas";

    public $id_kelas;
    public $nama_kelas;

    public function rules(){
       
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table,["id_kelas"=> $id])->row();
    }

    public function getDropdownLaporan(){
        if($this->session->userdata('level') == "guru"){
            $this->db->select('a.id_kelas,a.nama_kelas');
            $this->db->from($this_table." as a");
            $this->db->join("wali_kelas as b","a.id_kelas = b.id_kelas", "inner");
            $this->db->where("b.nip",$this->session->userdata('user_username'));
            return $this->db->get()->result();
        } else {
            return $this->getAll();
        }
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