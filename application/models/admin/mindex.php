<?php

class Mindex extends CI_Model
{

    function __construct(){
        parent::__construct();
    }


    public function getAllListings(){
        $query=$this->db->get('listing');
        $result=$query->result_array();
        return $result;
    }

    public function getAllCategories(){
        $query=$this->db->get('category');
        $result=$query->result_array();
        return $result;
    }

    public function getAllWebsitesAndPages(){
        $this->db->select('*');
        $this->db->select('website.name as websiteName,website.pkey as websiteKey,website.status as websiteStatus');        $this->db->from('website');
        $this->db->join('webPages', 'webPages.website_pkey = website.pkey','left');
        $query=$this->db->get();
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function getAllWebsites(){
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function countAllTables(){
        $result=array(
            'totalUsers'=>$this->db->count_all('login'),
            'totalListings'=>$this->db->count_all('listing'),
            'totalCategories'=>$this->db->count_all('category'),
            'totalPages'=>$this->db->count_all('pages'),
        );
        return $result;
    }






}
