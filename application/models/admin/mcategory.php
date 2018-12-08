<?php

class Mcategory extends CI_Model
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('LoggedIn') || !$this->session->userdata('type')=='admin'){
           // redirect('index/login','refresh');
        }
    }



    public function insertCat($data){
        $insertArray=array(
            'name'=>$data['name'],
            'icon'=>$data['icon'],
            'banner'=>$data['banner'],
            'description'=>$data['description']
        );
        $this->db->insert('category',$insertArray);
    }

    public function deleteCat($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('category');
        $result=$query->result_array();
        if(!empty($result)){
            $this->db->where('pkey',$pkey);
            $this->db->delete('category');
            if(file_exists(FCPATH.$this->config->item('categoryIconUploadDirectory').$result[0]['icon']) && !is_dir(FCPATH.$this->config->item('categoryIconUploadDirectory').$result[0]['icon'])){
                unlink(FCPATH.$this->config->item('categoryIconUploadDirectory').$result[0]['icon']);
            }
            if(file_exists(FCPATH.$this->config->item('categoryBannerUploadDirectory').$result[0]['banner']) && !is_dir(FCPATH.$this->config->item('categoryBannerUploadDirectory').$result[0]['banner'])){
                unlink(FCPATH.$this->config->item('categoryBannerUploadDirectory').$result[0]['banner']);
            }
        }
    }

    public function updateCat($data){
        $updateArray=array(
            'name'=>$data['name'],
            'icon'=>$data['icon'],
            'banner'=>$data['banner'],
            'description'=>$data['description']
        );
        $this->db->where('pkey',$data['pkey']);
        $this->db->update('category',$updateArray);
    }

    public function getCats($limit=null,$page=null){
        if(isset($limit) && isset($page)){
            $this->db->limit($limit, $limit*$page);
        }
        $query=$this->db->get('category');
        $result=$query->result_array();
        return $result;
    }

    public function getCat($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('category');
        $result=$query->result_array();
        return $result[0];
    }

    public function getAllCat(){
        $query=$this->db->get('category');
        $result=$query->result_array();
        return $result;
    }

}
