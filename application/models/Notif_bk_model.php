<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Notif_bk_model extends CI_Model{
    private $_table = "notif_bk";

    public $id_notif;
    public $id_kejadian_siswa;
    public $user_id;
    public $level;
    public $waktu;
    public $sudah_baca = 0;
    public $id_forum;

    public function rules(){
       
    }


    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table,["id_forum"=> $id])->row();
    }

    public function save($id_kejadian_siswa, $user_id, $level, $tanggal_chat, $id_forum)
    {
        $this->id_kejadian_siswa = $id_kejadian_siswa;
        $this->user_id = $user_id;
        $this->level = $level;
        $this->waktu = $tanggal_chat;
        $this->id_forum = $id_forum;
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
     
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table,["id_forum"=>$id]);
    }

    public function deleteByKejadian($id)
    {
        return $this->db->delete($this->_table,["id_kejadian_siswa"=>$id]);
    }

}