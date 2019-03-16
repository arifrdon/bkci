<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Pengaturan_bk_model extends CI_Model{
    private $_table = "pengaturan_bk";

    public $id_pengaturan_bk;
    public $nama_pengaturan;
    public $nilai_pengaturan;
    public $status_pengaturan;

    public function rules(){
        return [
            ['field' => 'poin_awal',
            'label' => 'Poin Awal',
            'rules' => 'required|numeric'],
          
            ['field' => 'fitur_reward',
            'label' => 'Fitur Reward',
            'rules' => 'required'],

            ['field' => 'operator_bk',
            'label' => 'Operator BK',
            'rules' => 'required'],

            ['field' => 'tekskop1',
            'label' => 'Teks Kop 1',
            'rules' => 'required'],

            ['field' => 'tekskop2',
            'label' => 'Teks Kop 2',
            'rules' => 'required'],

            ['field' => 'tekskop3',
            'label' => 'Teks Kop 3',
            'rules' => 'required'],

            ['field' => 'tekskop4',
            'label' => 'Teks Kop 4',
            'rules' => 'required'],

            ['field' => 'nip',
            'label' => 'Guru',
            'rules' => 'required']
        ];
    }
    public function set_session_setting(){
        $qpoin = $this->db->get_where($this->_table,["NAMA_PENGATURAN"=>"Poin Awal Siswa"])->row_array();
        $this->session->set_userdata('poin_awal', $qpoin['NILAI_PENGATURAN']);
        $qreward = $this->db->get_where($this->_table,["NAMA_PENGATURAN"=>"Fitur Reward"])->row_array();
        $this->session->set_userdata('fitur_reward', $qreward['STATUS_PENGATURAN']);
        $qoperator = $this->db->get_where($this->_table,["NAMA_PENGATURAN"=>"Operator Pelanggaran"])->row_array();
        $this->session->set_userdata('operator_bk', $qoperator['NILAI_PENGATURAN']);
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table,["id_pengaturan_bk"=> $id])->row();
    }

    public function save()
    {
        
    }

    public function update()
    {
        $post = $this->input->post();
        $poin_awal = $post["poin_awal"];
        $fitur_reward = $post["fitur_reward"];
        $operator_bk = $post["operator_bk"];
        $tekskop1 = $post['tekskop1'];
        $tekskop2 = $post['tekskop2'];
        $tekskop3 = $post['tekskop3'];
        $tekskop4 = $post['tekskop4'];
        $nip = $post['nip'];

        $this->db->trans_start();

        $this->db->set('NILAI_PENGATURAN', $poin_awal);
        $this->db->where('id_pengaturan_bk', 1);
        $this->db->update($this->_table); 

        $this->db->set('STATUS_PENGATURAN', $fitur_reward);
        $this->db->where('id_pengaturan_bk', 2);
        $this->db->update($this->_table); 

        $this->db->set('NILAI_PENGATURAN', $operator_bk);
        $this->db->where('id_pengaturan_bk', 3);
        $this->db->update($this->_table); 

        $this->db->set('NILAI_PENGATURAN', $tekskop1);
        $this->db->where('id_pengaturan_bk', 4);
        $this->db->update($this->_table); 
        
        $this->db->set('NILAI_PENGATURAN', $tekskop2);
        $this->db->where('id_pengaturan_bk', 5);
        $this->db->update($this->_table); 

        $this->db->set('NILAI_PENGATURAN', $tekskop3);
        $this->db->where('id_pengaturan_bk', 6);
        $this->db->update($this->_table); 

        $this->db->set('NILAI_PENGATURAN', $tekskop4);
        $this->db->where('id_pengaturan_bk', 7);
        $this->db->update($this->_table); 

        $this->db->set('NILAI_PENGATURAN', $nip);
        $this->db->where('id_pengaturan_bk', 8);
        $this->db->update($this->_table); 

        $this->set_session_setting();

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE)
        {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete($id)
    {
       
    }

}