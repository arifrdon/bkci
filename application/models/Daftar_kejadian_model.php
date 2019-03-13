<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Daftar_kejadian_model extends CI_Model{
    private $_table = "daftar_kejadian";

    public $ID_DAFTAR_KEJADIAN;
    public $NAMA_KEJADIAN;
    public $POIN_KEJADIAN;
    public $TIPE_KEJADIAN;
    public $aktif = 1;

    public $column_order = array(null, 'NAMA_KEJADIAN', 'POIN_KEJADIAN', 'TIPE_KEJADIAN', 'TIPE_KEJADIAN');
    public $column_search = array('ID_DAFTAR_KEJADIAN', 'NAMA_KEJADIAN', 'POIN_KEJADIAN', 'TIPE_KEJADIAN');
    public $order = array('NAMA_KEJADIAN' => 'asc');

    public function rules(){
        return [
            ['field' => 'nama_kejadian',
            'label' => 'Nama Kejadian',
            'rules' => 'required'],
          
            ['field' => 'poin_kejadian',
            'label' => 'Poin Kejadian',
            'rules' => 'numeric'],

            ['field' => 'tipe_kejadian',
            'label' => 'Tipe Kejadian',
            'rules' => 'required']
        ];
    }

    function _get_datatables_query()
    {
        $this->db->from($this->_table);
        $this->db->where("aktif",1);

        if($this->session->userdata('fitur_reward') == 0){
            $this->db->where("TIPE_KEJADIAN","pelanggaran");
        }

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
        if($this->session->userdata('fitur_reward') == 0){
            return $this->db->get_where($this->_table,["TIPE_KEJADIAN"=> "pelanggaran","aktif"=> 1])->row();
        } else {
            return $this->db->get_where($this->_table,["aktif"=> 1])->row();
        }
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table,["ID_DAFTAR_KEJADIAN"=> $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        // $this->product_id = uniqid();
        $this->NAMA_KEJADIAN = $post["nama_kejadian"];
        $this->POIN_KEJADIAN = $post["poin_kejadian"];
        $this->TIPE_KEJADIAN = $post["tipe_kejadian"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->ID_DAFTAR_KEJADIAN = $post["id_daftar_kejadian"];
        $this->NAMA_KEJADIAN = $post["nama_kejadian"];
        $this->POIN_KEJADIAN = $post["poin_kejadian"];
        $this->TIPE_KEJADIAN = $post["tipe_kejadian"];

        $this->db->update($this->_table, $this, array('ID_DAFTAR_KEJADIAN' => $this->ID_DAFTAR_KEJADIAN));
    
    }

    public function delete($id)
    {
        $this->load->model('kejadian_siswa_model','kejadian_siswa');
        if($this->kejadian_siswa->getByDaftarKejadian($id)){
            return false;
        } else {
            $this->db->set('aktif', '0');
            $this->db->where('ID_DAFTAR_KEJADIAN', $id);
            return $this->db->update($this->_table); 
            //return $this->db->update($this->_table,  array("ID_DAFTAR_KEJADIAN"=>$id));
        }
        
    }

    public function getAllKejadianDropdownBK()
    {
        $this->db->select('ID_DAFTAR_KEJADIAN,NAMA_KEJADIAN,POIN_KEJADIAN,TIPE_KEJADIAN');
        $this->db->from($this->_table);
        if($this->session->userdata('fitur_reward') == 0){
            $this->db->where("TIPE_KEJADIAN","pelanggaran");
        }
        $this->db->where("aktif",1);
        return $this->db->get()->result();
    }

    // private function _uploadImage()
    // {
    //     $config['upload_path']      = './upload/product/';
    //     $config['allowed_types']    = 'gif|jpg|png';
    //     $config['file_name']        = $this->product_id;
    //     $config['overwrite']        = true;
    //     $config['max_size']         = 1024;

    //     $this->load->library('upload', $config);

    //     if($this->upload->do_upload('image')){
    //         return $this->upload->data("file_name");
    //     }

    //     return "default.jpg";
    // }

    // private function _deleteImage($id)
    // {
    //     $product = $this->getById($id);
    //     if($product->image != "default.jpg"){
    //         $filename = explode(".", $product->image)[0];
    //         return array_map('unlink', glob(FCPATH."upload/product/$filename.*"));
    //     }
    // }
}