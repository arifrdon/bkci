<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Guru_model extends CI_Model{
    private $_table = "guru";

    public $nip;
    public $nama_guru;
    public $jenis_kelamin;
    public $alamat;
    public $no_telepon;
    public $password_guru;
    public $username_guru;
    public $foto;

    public function rules(){
       
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
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