<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Orang_tua_model extends CI_Model{
    private $_table = "orang_tua";

    public $id_orang_tua;
    public $user_id;
    public $user_nama;
    public $pekerjaan;
    public $alamat;
    public $no_telepon;
    public $password;
    public $level;

    public function rules(){
       
    }

    public function loginortu($user_username,$user_password){
        $this->db->select('*');
        $this->db->from('orang_tua');
        $this->db->join('siswa', 'siswa.id_orang_tua = orang_tua.id_orang_tua', 'inner');
        $this->db->where('siswa.no_induk',$user_username);
        $this->db->where('orang_tua.password',$user_password);
        $query=$this->db->get();
        $data= $query->row_array();
        return $data;
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