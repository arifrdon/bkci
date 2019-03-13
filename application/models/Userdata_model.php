<?php
class Userdata_model extends CI_Model{
    private $_table = "userdata";
    public $user_id;
    public $user_username;
    public $user_password;

    public $column_order = array(null, 'user_id', 'user_username', 'user_password');
    public $column_search = array('user_id', 'user_username', 'user_password');
    public $order = array('user_id' => 'asc');

    function rules(){
        return [
            ['field'=>'user_username',
            'label'=> 'Username',
            'rules'=> 'required'],
            [
             'field'=>'user_password',
             'label'=>'Password',
             'rules'=>'required'   
            ]
        ];
    }

    function autho(){
        $post = $this->input->post();
         $user_username = $post["user_username"];
         $user_password = md5($post["user_password"]);
        // $this->db->where("user_username",$user_username);
        // $this->db->where("user_password",$user_password);
        // $query = $this->db->get($this->_table);
        //  return $query->row_array();
        $query = $this->db->get_where($this->_table,["user_username"=>$user_username,"user_password"=>$user_password]);
        $rowcatch = $query->row_array();
        //print_r($this->db->last_query());    
        //echo "step0";
        if (isset($rowcatch))
        {
            //echo "step1";
            if($rowcatch['level']=="guru"){
                $this->load->model('Walikelas_model','walikelas');
                $checkwali = $this->walikelas->getByNip($rowcatch['user_username']);
                if(!empty($checkwali)){
                    return $rowcatch;
                } else {
                    return "gurubukanwali";
                }
            } else {
                return $rowcatch;
            }
        } else {
            $this->load->model('Orang_tua_model','orang_tua');
            $queryortu = $this->orang_tua->loginortu($user_username,$user_password);
            return $queryortu;
        }
        

    }

    function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function save(){
        $post = $this->input->post();
        $this->user_username = $post['user_username'];
        $this->user_password = base64_encode($post['user_password']);
        $this->db->insert($this->_table,$this);
    }

    function getById($user_id){
        $query = $this->db->get_where($this->_table,["user_id"=>$user_id]);
        return $query->row();
    }

    function update(){
        $post = $this->input->post();
        $this->user_id = $post['user_id'];
        $this->user_username = $post['user_username'];
        $this->user_password = $post['user_password'];
        $this->db->update($this->_table,$this,["user_id"=>$this->user_id]);
    }
    function delete($id){
       return $this->db->delete($this->_table,["user_id"=>$id]);
    }
    function _get_datatables_query()
    {
        $this->db->from($this->_table);

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
}