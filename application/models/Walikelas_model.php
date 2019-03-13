<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Walikelas_model extends CI_Model{
    private $_table = "wali_kelas";

    public $id_wali_kelas;
    public $id_kelas;
    public $nip;
    public $id_tahun;

    public function rules(){
       
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table,["id_wali_kelas"=> $id])->row();
    }
    public function getByNip($id)
    {
        return $this->db->get_where($this->_table,["nip"=> $id])->row();
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