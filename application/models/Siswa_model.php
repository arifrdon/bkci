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

    public $column_order = array(null, 'a.no_induk', 'a.nama_siswa', 'd.nama_kelas', 'a.tempat', 'b.no_telepon');
    public $column_search = array('a.no_induk', 'a.nama_siswa', 'd.nama_kelas', 'a.tempat', 'b.no_telepon');
    public $order = array('a.no_induk' => 'asc');

    public function rules(){
       
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    function _get_datatables_query()
    {
        $this->db->select('a.no_induk, a.nama_siswa, a.tempat, a.tanggal_lahir, b.no_telepon, d.nama_kelas');
        $this->db->from($this->_table." as a");
        $this->db->join('orang_tua as b', 'a.id_orang_tua = b.id_orang_tua', 'inner');
        $this->db->join('wali_kelas as c', 'a.id_wali_kelas = c.id_wali_kelas', 'inner');
        $this->db->join('kelas as d', 'c.id_kelas = d.id_kelas', 'inner');
       

        $i = 0;

        foreach ($this->column_search as $item)
        {
            if($_POST['search']['value'])
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->_table);
        return $this->db->count_all_results();
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

    public function getSiswaByOrtuId($id)
    {
        $this->db->select('a.no_induk, a.nama_siswa');
        $this->db->from($this->_table." as a");
        $this->db->join("orang_tua as b","a.id_orang_tua = b.id_orang_tua","inner");
        $this->db->where("a.id_orang_tua",$id);
        return $this->db->get()->result();
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