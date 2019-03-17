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
    public function fetch_forwali_query(){
        
        $this->db->select('a.id_notif, a.id_kejadian_siswa, a.user_id, a.level, a.waktu, a.sudah_baca, a.id_forum, b.NO_INDUK, d.nama_siswa, c.NAMA_KEJADIAN, z.user_nama');
        $this->db->from($this->_table." as a");
        $this->db->join('kejadian_siswa as b', 'a.id_kejadian_siswa = b.ID_KEJADIAN_SISWA', 'left');
        $this->db->join('daftar_kejadian as c', 'c.ID_DAFTAR_KEJADIAN = b.ID_DAFTAR_KEJADIAN', 'left');
        $this->db->join('siswa as d', 'd.no_induk = b.NO_INDUK', 'left');

        $this->db->join('userdata z', 'z.user_id = a.user_id', 'left');
        $this->db->join('orang_tua y', 'y.id_orang_tua = d.id_orang_tua', 'left');

        $this->db->where("d.id_orang_tua",$this->session->userdata('id_orang_tua'));

        $this->db->where("a.level !=","orang_tua");
        $this->db->order_by("a.id_notif",'desc');
    }
    public function fetch_forguru_query(){
        $this->db->select('a.id_notif, a.id_kejadian_siswa, a.user_id, a.level, a.waktu, a.sudah_baca, a.id_forum, b.NO_INDUK, d.nama_siswa, c.NAMA_KEJADIAN, y.user_nama');
        $this->db->from($this->_table." as a");
        $this->db->join('kejadian_siswa as b', 'a.id_kejadian_siswa = b.ID_KEJADIAN_SISWA', 'left');
        $this->db->join('daftar_kejadian as c', 'c.ID_DAFTAR_KEJADIAN = b.ID_DAFTAR_KEJADIAN', 'left');
        $this->db->join('siswa as d', 'd.no_induk = b.NO_INDUK', 'left');

        $this->db->join('wali_kelas as x', 'x.id_wali_kelas = d.id_wali_kelas', 'left');
        $this->db->join('userdata z', 'z.user_id = a.user_id', 'left');
        $this->db->join('orang_tua y', 'y.id_orang_tua = d.id_orang_tua', 'left');

        $this->db->where("a.level","orang_tua");
        $this->db->where("x.nip",$this->session->userdata('user_id'));
        $this->db->order_by("a.id_notif",'desc');
    }
    public function fetch_foradm_query(){
        $this->db->select('a.id_notif, a.id_kejadian_siswa, a.user_id, a.level, a.waktu, a.sudah_baca, a.id_forum, b.NO_INDUK, d.nama_siswa, c.NAMA_KEJADIAN, y.user_nama');
        $this->db->from($this->_table." as a");
        $this->db->join('kejadian_siswa as b', 'a.id_kejadian_siswa = b.ID_KEJADIAN_SISWA', 'left');
        $this->db->join('daftar_kejadian as c', 'c.ID_DAFTAR_KEJADIAN = b.ID_DAFTAR_KEJADIAN', 'left');
        $this->db->join('siswa as d', 'd.no_induk = b.NO_INDUK', 'left');

        $this->db->join('userdata z', 'z.user_id = a.user_id', 'left');
        $this->db->join('orang_tua y', 'y.id_orang_tua = d.id_orang_tua', 'left');

        $this->db->where("a.level","orang_tua");
        $this->db->order_by("a.id_notif",'desc');
        
    }
    public function fetch_notif_forwali()
    {
        $this->fetch_forwali_query();
        return $this->db->get()->result();
    }
    public function fetch_notif_forwali_count()
    {
        $this->db->where("a.sudah_baca","0");
        $this->fetch_forwali_query();
        return $this->db->get()->num_rows();
    }
    public function fetch_notif_forwali_clicked(){
        $this->db->select('a.ID_KEJADIAN_SISWA as id_kejadian_siswa from kejadian_siswa a');
        $this->db->from('kejadian_siswa as a');
        $this->db->join('siswa as b','a.NO_INDUK = b.no_induk ','inner');
        $this->db->join('orang_tua as c','c.id_orang_tua = b.id_orang_tua ','inner');
        $this->db->where('c.id_orang_tua',$this->session->userdata('id_orang_tua'));

        $subortu = $this->db->get_compiled_select();
        $this->db->set('sudah_baca', 1);
        $this->db->where('level !=', 'orang_tua');
        $this->db->where('id_kejadian_siswa in ('.$subortu.')');
        $this->db->update($this->_table); 
    }
    
    public function fetch_notif_nonwali()
    {
        $this->fetch_foradm_query();
        return $this->db->get()->result();
    }

    public function fetch_notif_nonwali_count()
    {
        $this->db->where("a.sudah_baca","0");
        $this->fetch_foradm_query();
        return $this->db->get()->num_rows();
    }
    public function fetch_notif_nonwali_clicked(){
        
        $this->db->set('sudah_baca', 1);
        $this->db->where('level ', 'orang_tua');
        $this->db->update($this->_table); 

    }
    public function fetch_notif_forguru()
    {
        $this->fetch_forguru_query();
        return $this->db->get()->result();
    }

    public function fetch_notif_forguru_count()
    {
        $this->db->where("a.sudah_baca","0");
        $this->fetch_forguru_query();
        return $this->db->get()->num_rows();
    }
    public function fetch_notif_forguru_clicked(){
        $this->db->select('a.ID_KEJADIAN_SISWA as id_kejadian_siswa from kejadian_siswa a');
        $this->db->from('kejadian_siswa as a');
        $this->db->join('siswa as b','a.NO_INDUK = b.no_induk ','inner');

        $this->db->join('wali_kelas as x','x.id_wali_kelas = b.id_wali_kelas','inner');

        $this->db->join('orang_tua as c','c.id_orang_tua = b.id_orang_tua ','inner');
        $this->db->where('x.nip',$this->session->userdata('user_id'));

        $subortu = $this->db->get_compiled_select();
        $this->db->set('sudah_baca', 1);
        $this->db->where('id_kejadian_siswa in ('.$subortu.')');
        $this->db->where('level ', 'orang_tua');
        $this->db->update($this->_table); 

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