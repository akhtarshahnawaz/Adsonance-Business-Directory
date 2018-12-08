<?php

class Mlisting extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function insertListing($data){
        if(isset($data['status'])){
            $status=$data['status'];
        }else{
            $status='0';
        }

        if(isset($data['status2'])){
            $status2=$data['status2'];
        }else{
            $status2='Free User';
        }

        $insertArray=array(
            'name'=>$data['name'],
            'image'=>$data['image'],
            'tags'=>$data['tags'],
            'excerpt'=>$data['excerpt'],
            'description'=>$data['description'],
            'phone'=>$data['phone'],
            'email'=>$data['email'],
            'website'=>$data['website'],
            'status'=>$status,
            'street'=>$data['street'],
            'locality'=>$data['locality'],
            'city'=>$data['city'],
            'pincode'=>$data['pincode'],
            'country'=>$data['country'],
            'location_pointer'=>$data['location_pointer'],
            'category_pkey'=>$data['category_pkey'],
            'slug'=>$this->createSlug($data['name']),
            'login_pkey'=>$this->session->userdata('key'),
            'status2'=>$status2
        );
        $this->db->insert('listing',$insertArray);
    }

    public function deleteListing($pkey){
        $this->db->where('pkey',$pkey);
        if($this->session->userdata('type')=='general'){
            $this->db->where('login_pkey',$this->session->userdata('key'));
        }
        $query=$this->db->get('listing');
        $result=$query->result_array();
        if(!empty($result)){
            $this->db->where('pkey',$pkey);
            if($this->session->userdata('type')=='general'){
                $this->db->where('login_pkey',$this->session->userdata('key'));
            }
            $this->db->delete('listing');
            if(file_exists(FCPATH.$this->config->item('listingBannerUploadDirectory').$result[0]['image']) && !is_dir(FCPATH.$this->config->item('listingBannerUploadDirectory').$result[0]['image'])){
                unlink(FCPATH.$this->config->item('listingBannerUploadDirectory').$result[0]['image']);
            }
        }
    }

    public function updateListing($data){
        if(isset($data['status'])){
            $status=$data['status'];
        }else{
            $status='0';
        }

        if(isset($data['status2'])){
            $status2=$data['status2'];
        }else{
            $status2='Free User';
        }

        $updateArray=array(
            'name'=>$data['name'],
            'image'=>$data['image'],
            'tags'=>$data['tags'],
            'excerpt'=>$data['excerpt'],
            'description'=>$data['description'],
            'phone'=>$data['phone'],
            'email'=>$data['email'],
            'website'=>$data['website'],
            'status'=>$status,
            'street'=>$data['street'],
            'locality'=>$data['locality'],
            'city'=>$data['city'],
            'pincode'=>$data['pincode'],
            'country'=>$data['country'],
            'location_pointer'=>$data['location_pointer'],
            'category_pkey'=>$data['category_pkey'],
            'status2'=>$status2
        );

        if($this->session->userdata('type')=='general'){
            $this->db->where('login_pkey',$this->session->userdata('key'));
        }
        $this->db->where('pkey',$data['pkey']);
        $this->db->update('listing',$updateArray);
    }

    public function getAllListings($page=null){
        $this->db->limit($this->config->item('ListingsOnSinglePage'), $this->config->item('ListingsOnSinglePage')*$page);
        $query=$this->db->get('listing');
        $result=$query->result_array();
        return $result;
    }

    public function getThisUserListings($page=null){
        $this->db->limit($this->config->item('ListingsOnSinglePage'), $this->config->item('ListingsOnSinglePage')*$page);
        $this->db->where('login_pkey',$this->session->userdata('key'));
        $query=$this->db->get('listing');
        $result=$query->result_array();
        return $result;
    }

    public function totalListings(){
        $this->db->select('*');
        $this->db->from('listing');
        $result=$this->db->count_all_results();
        return $result;
    }

    public function totalListingsByThisUser(){
        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('login_pkey',$this->session->userdata('key'));
        $result=$this->db->count_all_results();
        return $result;
    }

    public function getListing($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('listing');
        $result=$query->result_array();
        return $result[0];
    }

    function createSlug($string){
        $string = strtolower($string);
        $string = html_entity_decode($string);
        $string = str_replace(array('ä','ü','ö','ß'),array('ae','ue','oe','ss'),$string);
        $string = preg_replace('#[^\w\säüöß]#',null,$string);
        $string = preg_replace('#[\s]{2,}#',' ',$string);
        $string = str_replace(array(' '),array('-'),$string);
        return $string;
    }
}
