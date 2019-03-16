<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Walikelas_model extends CI_Model{
    private $_table = "wali_kelas";

    public $id_wali_kelas;
    public $id_kelas;
    public $nip;
    public $id_tahun;

    public $column_order = array(null, 'a.id_wali_kelas', 'b.nama_kelas', 'c.nama_guru', 'd.tahun');
    public $column_search = array('a.id_wali_kelas', 'b.nama_kelas', 'c.nama_guru', 'd.tahun');
    public $order = array('a.id_wali_kelas' => 'asc');

    public function rules(){
       
    }

    function _get_datatables_query()
    {
        $this->db->select('a.id_wali_kelas, b.nama_kelas, c.nama_guru, d.tahun');
        $this->db->from($this->_table. " as a");
        $this->db->join('kelas as b', 'a.id_kelas = b.id_kelas', 'inner');
        $this->db->join('guru as c', 'a.nip = c.nip', 'inner');
        $this->db->join('tahun_ajaran as d', 'a.id_tahun = d.id_tahun', 'inner');

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