<?php

class Mpage extends CI_Model
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || !$this->session->userdata('type')=='admin'){
            redirect('index/login','refresh');
        }
    }

    public function getPages(){
        $query=$this->db->get('pages');
        $result=$query->result_array();
        return $result;
    }

    public function insertPage($data){
        $insertArray=array(
            'name'=>$data['name'],
            'content'=>$data['content']
        );
        $this->db->insert('pages',$insertArray);
    }


    public function getPage($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('pages');
        $result=$query->result_array();
        return $result[0];
    }

    public function updatePage($data){
        $updateArray=array(
            'name'=>$data['name'],
            'content'=>$data['content']
        );
        $this->db->where('pkey',$data['pkey']);
        $this->db->update('pages',$updateArray);
    }

    public function deletePage($pkey){
        $this->db->where('pkey',$pkey);
        $this->db->delete('pages');
    }
}
