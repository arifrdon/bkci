<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Kejadian_siswa_model extends CI_Model{
    private $_table = "kejadian_siswa";

    public $ID_KEJADIAN_SISWA;
    public $NO_INDUK;
    public $ID_DAFTAR_KEJADIAN;
    public $TANGGAL_KEJADIAN;
    public $TERKIRIM = 0;
    public $AKTIF = 1;

    public $column_order = array(null, 'a.NO_INDUK', 'b.nama_siswa', 'c.nama_kejadian', 'c.poin_kejadian', 'a.TANGGAL_KEJADIAN',null);
    public $column_search = array('a.NO_INDUK', 'b.nama_siswa', 'c.nama_kejadian', 'a.TANGGAL_KEJADIAN');
    public $order = array('a.TANGGAL_KEJADIAN' => 'desc');

    
    public $column_order_score = array(null, 'noindukdistinct', 'namasiswa', 'poin_awal', 'poin_reward', 'poin_pelanggaran','poin_akhir',null);
    public $column_search_score = array('noindukdistinct', 'namasiswa', 'poin_awal', 'poin_reward', 'poin_pelanggaran');
    public $order_score = array('poin_akhir' => 'asc');

    public function rules(){
        return [
            ['field' => 'no_induk',
            'label' => 'Nama Siswa / NIS',
            'rules' => 'required'],
          
            ['field' => 'id_daftar_kejadian',
            'label' => 'Nama Kejadian',
            'rules' => 'required'],

            ['field' => 'tanggalkejadian',
            'label' => 'Tanggal Kejadian',
            'rules' => 'required'],

            ['field' => 'jam',
            'label' => 'Jam',
            'rules' => 'required']
        ];
    }
    public function ruleschat(){
        return [
          

            ['field' => 'komentar',
            'label' => 'Komentar',
            'rules' => 'required']
        ];
    }
    public function rulesreport(){
        return [
            ['field' => 'dtpstart',
            'label' => 'Tanggal Mulai',
            'rules' => 'required'],
          
            ['field' => 'dtpend',
            'label' => 'Tanggal Akhir',
            'rules' => 'required'],

            ['field' => 'id_kelas',
            'label' => 'Kelas',
            'rules' => 'required'],

            ['field' => 'tipe_kejadian',
            'label' => 'Tipe Kejadian',
            'rules' => 'required']
        ];
    }
    function _get_datatables_query()
    {
        
        //$this->db->select('a.ID_KEJADIAN_SISWA, a.NO_INDUK, a.ID_DAFTAR_KEJADIAN, a.TANGGAL_KEJADIAN, a.TERKIRIM, a.AKTIF');
        if($this->session->userdata('fitur_reward') == 0){
            $this->db->select('a.ID_KEJADIAN_SISWA,a.NO_INDUK,b.nama_siswa,a.ID_DAFTAR_KEJADIAN,c.nama_kejadian,c.poin_kejadian,a.TANGGAL_KEJADIAN,a.TERKIRIM,c.tipe_kejadian');
        } else {
            $this->db->select('a.ID_KEJADIAN_SISWA,a.NO_INDUK,b.nama_siswa,a.ID_DAFTAR_KEJADIAN,c.nama_kejadian,c.poin_kejadian,a.TANGGAL_KEJADIAN,a.TERKIRIM');
        }

        $this->db->from($this->_table." as a");
        $this->db->join('siswa as b', 'a.NO_INDUK = b.no_induk', 'inner');
        $this->db->join('daftar_kejadian as c', 'a.ID_DAFTAR_KEJADIAN = c.ID_DAFTAR_KEJADIAN', 'inner');

        if($this->session->userdata('level') == "guru"){
            $this->db->join('wali_kelas as d', 'b.id_wali_kelas = d.id_wali_kelas', 'inner');
        }

        if($this->session->userdata('fitur_reward') == 0){
            $this->db->where("c.tipe_kejadian","pelanggaran");
        }

        if($this->session->userdata('level') == "guru"){
            $this->db->where("d.nip",$this->session->userdata('user_username'));
        }

        $this->db->where("a.AKTIF",1);

        // if($this->session->userdata('fitur_reward') == 0){
        //     $this->db->where("TIPE_KEJADIAN","pelanggaran");
        // }

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

    // public function getAll()
    // {
    //     if($this->session->userdata('fitur_reward') == 0){
    //         return $this->db->get_where($this->_table,["TIPE_KEJADIAN"=> "pelanggaran","aktif"=> 1])->row();
    //     } else {
    //         return $this->db->get_where($this->_table,["aktif"=> 1])->row();
    //     }
    // }

    public function getById($id)
    {
        return $this->db->get_where($this->_table,["ID_KEJADIAN_SISWA"=> $id])->row();
    }
    public function getByDaftarKejadian($id)
    {
        return $this->db->get_where($this->_table,["ID_DAFTAR_KEJADIAN"=> $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        // $this->product_id = uniqid();

        $this->NO_INDUK = $post["no_induk"];
        $this->ID_DAFTAR_KEJADIAN = $post["id_daftar_kejadian"];
        $this->TANGGAL_KEJADIAN = $post['tanggalkejadian']." ".$post['jam'];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->ID_KEJADIAN_SISWA = $post["id_kejadian_siswa"];
        $this->NO_INDUK = $post["no_induk"];
        $this->ID_DAFTAR_KEJADIAN = $post["id_daftar_kejadian"];
        $this->TANGGAL_KEJADIAN = $post['tanggalkejadian']." ".$post['jam'];
        $this->db->update($this->_table, $this, array('ID_KEJADIAN_SISWA' => $this->ID_KEJADIAN_SISWA));
    }

    public function delete($id)
    {
        $this->load->model('forum_kejadian_model','forum_kejadian');
        $this->load->model('notif_bk_model','notif_bk');
        $this->db->trans_start();
        $this->forum_kejadian->deleteByKejadian($id);
        $this->notif_bk->deleteByKejadian($id);
        $this->db->set('aktif', '0');
        $this->db->where('ID_KEJADIAN_SISWA', $id);
        $this->db->update($this->_table);
        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE)
        {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
    public function getByIdForChat($id)
    {
        $this->db->select('a.ID_KEJADIAN_SISWA,a.NO_INDUK,b.nama_siswa,a.ID_DAFTAR_KEJADIAN,c.nama_kejadian,c.poin_kejadian,a.TANGGAL_KEJADIAN,a.TERKIRIM');
        $this->db->from($this->_table." as a");
        $this->db->join('siswa as b', 'a.NO_INDUK = b.no_induk', 'inner');
        $this->db->join('daftar_kejadian as c', 'a.ID_DAFTAR_KEJADIAN = c.ID_DAFTAR_KEJADIAN', 'inner');
        $this->db->where("a.ID_KEJADIAN_SISWA",$id);
        return $this->db->get()->row();
    }
    public function subq(){
        // $this->db->select('ID_PENGATURAN_BK as aku');
        // $this->db->from('pengaturan_bk');
        // $this->db->where('STATUS_PENGATURAN', 1);
        // $sub1 = $this->db->get_compiled_select();
        // $this->db->select('aku');
        // $this->db->from("(".$sub1.") abcd");
       
        // return $this->db->get()->result();
        $this->db->select('COALESCE(sum( a.POIN_KEJADIAN ),0)');
        $this->db->from('daftar_kejadian as a');
        $this->db->join('kejadian_siswa as b', 'a.ID_DAFTAR_KEJADIAN = b.ID_DAFTAR_KEJADIAN', 'inner');
        $this->db->where('b.NO_INDUK = noindukdistinct');
        $this->db->where('a.TIPE_KEJADIAN', "reward");
        $this->db->where('b.AKTIF', 1);
        $subpoinreward = $this->db->get_compiled_select();

        $this->db->select('COALESCE(sum( a.POIN_KEJADIAN ),0)');
        $this->db->from('daftar_kejadian as a');
        $this->db->join('kejadian_siswa as b', 'a.ID_DAFTAR_KEJADIAN = b.ID_DAFTAR_KEJADIAN', 'inner');
        $this->db->where('b.NO_INDUK = noindukdistinct');
        $this->db->where('a.TIPE_KEJADIAN', "pelanggaran");
        $this->db->where('b.AKTIF', 1);
        $subpoinpelanggaran = $this->db->get_compiled_select();
        
        $this->db->select('distinct(a.NO_INDUK) as noindukdistinct,b.nama_siswa as namasiswa,(select NILAI_PENGATURAN from pengaturan_bk where ID_PENGATURAN_BK=1) as poin_awal,'.'('.$subpoinreward.') as poin_reward,'.'('.$subpoinpelanggaran.') as poin_pelanggaran');
        $this->db->from('kejadian_siswa as a');
        $this->db->join('siswa as b', 'a.NO_INDUK = b.no_induk', 'inner');
        $this->db->where('a.AKTIF', 1);
        $subgabungrnp = $this->db->get_compiled_select();

        $this->db->select('noindukdistinct,namasiswa,poin_awal,poin_reward ,poin_pelanggaran, (poin_awal+poin_reward-poin_pelanggaran) as poin_akhir');
        $this->db->from('('.$subgabungrnp.') abcd');
        $this->db->order_by('poin_akhir','asc');
        
        return $this->db->get()->result();

    }

    function _get_datatables_query_score()
    {
         
        if($this->session->userdata('fitur_reward') == 1){
            $this->db->select('COALESCE(sum( a.POIN_KEJADIAN ),0)');
            $this->db->from('daftar_kejadian as a');
            $this->db->join('kejadian_siswa as b', 'a.ID_DAFTAR_KEJADIAN = b.ID_DAFTAR_KEJADIAN', 'inner');
            $this->db->where('b.NO_INDUK = noindukdistinct');
            $this->db->where('a.TIPE_KEJADIAN', "reward");
            $this->db->where('b.AKTIF', 1);
            $subpoinreward = $this->db->get_compiled_select();
        }

        $this->db->select('COALESCE(sum( a.POIN_KEJADIAN ),0)');
        $this->db->from('daftar_kejadian as a');
        $this->db->join('kejadian_siswa as b', 'a.ID_DAFTAR_KEJADIAN = b.ID_DAFTAR_KEJADIAN', 'inner');
        $this->db->where('b.NO_INDUK = noindukdistinct');
        $this->db->where('a.TIPE_KEJADIAN', "pelanggaran");
        $this->db->where('b.AKTIF', 1);
        $subpoinpelanggaran = $this->db->get_compiled_select();

        if($this->session->userdata('fitur_reward') == 1){
            $this->db->select('distinct(a.NO_INDUK) as noindukdistinct,b.nama_siswa as namasiswa,(select NILAI_PENGATURAN from pengaturan_bk where ID_PENGATURAN_BK=1) as poin_awal,'.'('.$subpoinreward.') as poin_reward,'.'('.$subpoinpelanggaran.') as poin_pelanggaran');
        }
        if($this->session->userdata('fitur_reward') == 0){
            $this->db->select('distinct(a.NO_INDUK) as noindukdistinct,b.nama_siswa as namasiswa,(select NILAI_PENGATURAN from pengaturan_bk where ID_PENGATURAN_BK=1) as poin_awal,'.'('.$subpoinpelanggaran.') as poin_pelanggaran');
        }
        
        $this->db->from('kejadian_siswa as a');
        $this->db->join('siswa as b', 'a.NO_INDUK = b.no_induk', 'inner');
        if($this->session->userdata('level') == "guru"){
            $this->db->join('wali_kelas as d', 'b.id_wali_kelas = d.id_wali_kelas', 'inner');
            $this->db->where('d.nip', $this->session->userdata('user_username'));
        }
        $this->db->where('a.AKTIF', 1);
        $subgabungrnp = $this->db->get_compiled_select();
        if($this->session->userdata('fitur_reward') == 1 && $this->session->userdata('operator_bk') == "tambah"){
            $this->db->select('noindukdistinct,namasiswa,poin_awal,poin_reward ,poin_pelanggaran, (poin_awal-poin_reward+poin_pelanggaran) as poin_akhir');
        }
        if($this->session->userdata('fitur_reward') == 1 && $this->session->userdata('operator_bk') == "kurang"){
            $this->db->select('noindukdistinct,namasiswa,poin_awal,poin_reward ,poin_pelanggaran, (poin_awal+poin_reward-poin_pelanggaran) as poin_akhir');
        }
        if($this->session->userdata('fitur_reward') == 0 && $this->session->userdata('operator_bk') == "tambah"){
            $this->db->select('noindukdistinct,namasiswa,poin_awal ,poin_pelanggaran, (poin_awal+poin_pelanggaran) as poin_akhir');
        }
        if($this->session->userdata('fitur_reward') == 0 && $this->session->userdata('operator_bk') == "kurang"){
            $this->db->select('noindukdistinct,namasiswa,poin_awal ,poin_pelanggaran, (poin_awal-poin_pelanggaran) as poin_akhir');
        }
        $this->db->from('('.$subgabungrnp.') abcd');

        $i = 0;

        foreach ($this->column_search_score as $item)
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
            $this->db->order_by($this->column_order_score[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_score))
        {
            $order = $this->order_score;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables_score()
    {
        if($this->session->userdata('fitur_reward') == 0){
             $this->column_order_score = array(null, 'noindukdistinct', 'namasiswa', 'poin_awal', 'poin_pelanggaran','poin_akhir',null);
             $this->column_search_score = array('noindukdistinct', 'namasiswa', 'poin_awal', 'poin_pelanggaran');
        }  
        $this->_get_datatables_query_score();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_score()
    {
        $this->_get_datatables_query_score();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all_score()
    {
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }
    public function getScoreDetail($id)
    {
        $this->db->select('a.ID_DAFTAR_KEJADIAN,b.NAMA_KEJADIAN,a.TANGGAL_KEJADIAN,b.TIPE_KEJADIAN,b.POIN_KEJADIAN');
        $this->db->from($this->_table." as a");
        $this->db->join('daftar_kejadian as b', 'a.ID_DAFTAR_KEJADIAN=b.ID_DAFTAR_KEJADIAN', 'inner');
        $this->db->where("a.NO_INDUK",$id);
        $this->db->where("a.AKTIF",1);
        if($this->session->userdata('fitur_reward') == 0){
            $this->db->where("b.TIPE_KEJADIAN","pelanggaran");
        }
        return $this->db->get()->result();
    }
    public function getLaporanDetail($isget=false)
    {
        if($isget === TRUE){
            $post = $this->input->get();
        } else {
            $post = $this->input->post();
        }
        $post["dtpstart"] = $post["dtpstart"]." 00:00:00";
        $post["dtpend"] = $post["dtpend"]."  23:59:59";

        $this->db->select('a.ID_KEJADIAN_SISWA, a.NO_INDUK, c.nama_siswa,  b.NAMA_KEJADIAN,b.POIN_KEJADIAN,b.TIPE_KEJADIAN ,a.TANGGAL_KEJADIAN, e.nama_kelas,e.id_kelas');
        $this->db->from($this->_table." as a");
        $this->db->join('daftar_kejadian as b', 'a.ID_DAFTAR_KEJADIAN=b.ID_DAFTAR_KEJADIAN', 'inner');
        $this->db->join('siswa as c', 'c.no_induk=a.NO_INDUK', 'inner');
        $this->db->join('wali_kelas as d', 'c.id_wali_kelas = d.id_wali_kelas', 'inner');
        $this->db->join('kelas as e', 'd.id_kelas = e.id_kelas', 'inner');
        $this->db->where("a.AKTIF",1);
        if($post["tipe_kejadian"] == "pelanggaran"){
            $this->db->where("b.TIPE_KEJADIAN","pelanggaran");
        }
        if($post["tipe_kejadian"] == "reward"){
            $this->db->where("b.TIPE_KEJADIAN","reward");
        }
        if($post["id_kelas"] != "semua"){
            $this->db->where("e.id_kelas",$post["id_kelas"]);
        }
        $this->db->where("a.TANGGAL_KEJADIAN between '".$post["dtpstart"]."' and '".$post["dtpend"]."'");
        return $this->db->get()->result();
    }
}