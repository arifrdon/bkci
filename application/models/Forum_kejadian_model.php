<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Forum_kejadian_model extends CI_Model{
    private $_table = "forum_kejadian";

    public $id_forum;
    public $id_kejadian_siswa;
    public $user_id;
    public $level;
    public $komentar;
    public $tanggal_chat;

    public function rules(){
       
    }


    public function getAll($id)
    {
        $this->db->select('a.id_forum, a.id_kejadian_siswa, b.user_nama as admname, c.user_nama as ortname, a.user_id, a.level, a.komentar, a.tanggal_chat');
        $this->db->from($this->_table." as a");
        $this->db->join("userdata as b","a.user_id = b.user_id","left");
        $this->db->join("orang_tua as c","a.user_id = c.user_id","left");
        $this->db->where("a.id_kejadian_siswa",$id);
        $this->db->order_by("a.id_forum", "desc");
        return $this->db->get()->result();
       
    }
    public function count_all()
    {
        $this->db->from($this->_table);
        $this->db->where('level',"orang_tua");
        return $this->db->count_all_results();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table,["id_forum"=> $id])->row();
    }

    public function save()
    {
        
    }

    public function update()
    {
     
    }

    public function delete($id)
    {
        $this->load->model('notif_bk_model','notif_bk');

        $this->db->trans_start();
        $this->db->delete($this->_table,["id_forum"=>$id]);
        $this->notif_bk->delete($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE)
        {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteByKejadian($id)
    {
        return $this->db->delete($this->_table,["id_kejadian_siswa"=>$id]);
    }
    public function chatsave()
    {
        $this->load->model('notif_bk_model','notif_bk');
        $post = $this->input->post();
        $this->id_kejadian_siswa = $post["id_kejadian_siswa"];
        $this->user_id = $post["user_id"];
        $this->level = $post["level"];
        $this->komentar = $post['komentar'];
        $this->tanggal_chat = date('Y-m-d H:i:s');
       
        $this->db->trans_start();
        $this->db->insert($this->_table, $this);
        $id_forum = $this->db->insert_id();
        $this->notif_bk->save($this->id_kejadian_siswa, $this->user_id, $this->level, $this->tanggal_chat, $id_forum);
        $this->db->trans_complete();
    }

}