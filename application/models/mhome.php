<?php

class Mhome extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function getAllCategories(){
        $query=$this->db->get('category');
        $result=$query->result_array();
        return $result;
    }

    public function getListingsUnderCategory($catKey,$page){
        $city=$this->input->cookie('city',true);
        $region=$this->input->cookie('region',true);
        $pin=$this->input->cookie('pin',true);

        if($city!=''){
            $this->db->like('city',$city);
        }
        if($region!=''){
            $this->db->or_like('locality',$region);
        }
        if($pin!=''){
            $this->db->or_like('pincode',$pin);
        }
        $this->db->having('category_pkey',$catKey);
        $this->db->limit($this->config->item('ListingsOnSinglePage'));
        $this->db->offset($this->config->item('ListingsOnSinglePage')*$page);
        $this->db->order_by('status', 'desc'); 
        $query=$this->db->get('listing');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            $this->db->where('category_pkey',$catKey);
            $this->db->limit($this->config->item('ListingsOnSinglePage'));
            $this->db->offset($this->config->item('ListingsOnSinglePage')*$page);
            $this->db->order_by('status', 'desc'); 
            $query=$this->db->get('listing');
            $result=$query->result_array();
            return $result;
        }
    }

    public function totalListingsUnderCategory($catKey){
        $city=$this->input->cookie('city',true);
        $region=$this->input->cookie('region',true);
        $pin=$this->input->cookie('pin',true);

        if($city!=''){
            $this->db->like('city',$city);
        }
        if($region!=''){
            $this->db->or_like('locality',$region);
        }
        if($pin!=''){
            $this->db->or_like('pincode',$pin);
        }
        $this->db->select('*');
        $this->db->from('listing');
        $this->db->where('category_pkey',$catKey);
        $totalResults=$this->db->count_all_results();

        if(!empty($totalResults)){
            return $totalResults;
        }else{
            $this->db->select('*');
            $this->db->from('listing');
            $this->db->where('category_pkey',$catKey);
            $totalResults=$this->db->count_all_results();
            return $totalResults;
        }
    }

    public function search($data){
        if($data['term']!=''){
            $string= preg_replace("/[[:blank:]]+/"," ",$data['term']);
            $searchString=explode(' ',trim($string));
            $searchfields=array('category.name','category.description','listing.name','listing.description','tags','excerpt','phone','email','website','location_pointer','street','locality','city','pincode','country');

            $search=array();
            foreach($searchString as $string){
                foreach($searchfields as $fields){
                    $search[$fields]=$string;
                }
            }
        }

        $this->db->select('*');
        $this->db->from('category');
        $this->db->join('listing', 'listing.category_pkey = category.pkey');
        if($data['term']!=''){
            $this->db->or_like($search);
        }
        if($data['locality']!=''){
            $this->db->like('locality',$data['locality']);
        }
        if($data['city']!=''){
            $this->db->like('city',$data['city']);
        }

        $this->db->limit($this->config->item('ListingsOnSinglePage'));
        $this->db->offset($this->config->item('ListingsOnSinglePage')*$data['page']);
        $this->db->order_by('status', 'desc'); 
        $query = $this->db->get();
        $result=$query->result_array();
        return $result;

    }

    public function totalSearchResults($data){
        if($data['term']!=''){
            $string= preg_replace("/[[:blank:]]+/"," ",$data['term']);
            $searchString=explode(' ',trim($string));
            $searchfields=array('category.name','category.description','listing.name','listing.description','tags','excerpt','phone','email','website','location_pointer','street','locality','city','pincode','country');

            $search=array();
            foreach($searchString as $string){
                foreach($searchfields as $fields){
                    $search[$fields]=$string;
                }
            }
        }

        $this->db->select('*');
        $this->db->from('category');
        $this->db->join('listing', 'listing.category_pkey = category.pkey');

        if($data['term']!=''){
            $this->db->or_like($search);
        }
        if($data['locality']!=''){
            $this->db->like('locality',$data['locality']);
        }
        if($data['city']!=''){
            $this->db->like('city',$data['city']);
        }
        
        $totalResults=$this->db->count_all_results();
        return $totalResults;
    }

    public function getAllPages(){
        $query=$this->db->get('pages');
        $result=$query->result_array();
        return $result;
    }

    public function getListing($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('listing');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }    }


    public function sendEmailMessage($data){
        $this->db->where('pkey',$data['pkey']);
        $query=$this->db->get('listing');
        $result=$query->result_array();
        if(!empty($result) && isset($result[0]['email'])){
            $message=$this->load->view('mails/sendMessageToListingOwner',$data,true);
            $this->load->library('email');
            $this->email->from($this->config->item('sendMessageToListingOwnerFrom'), $this->config->item('sendMessageToListingOwnerHeader'));
            $this->email->reply_to($this->config->item('sendMessageToListingOwnerReplyTo'), $this->config->item('sendMessageToListingOwnerReplyToHeader'));
            $this->email->to($result[0]['email']);
            $this->email->subject($data['name'].' | '.$this->config->item('sendMessageToListingOwner'));
            $this->email->message($message);
            $result=$this->email->send();
            if($result){
                return true;
            }else{
                $this->session->set_flashdata('notification','Problem while sending Message!');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect($this->input->server('HTTP_REFERER'), 'refresh');
            }
        }else{
            $this->session->set_flashdata('notification','Problem while sending Message!');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect($this->input->server('HTTP_REFERER'), 'refresh');
        }
    }

    public  function getCatData($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('category');
        $result=$query->result_array();
        return $result[0];
    }

    public function getPage($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('pages');
        $result=$query->result_array();
        return $result[0];
    }


    public function getListingBySlug($slug){
        $this->db->where('slug',$slug);
        $query=$this->db->get('listing');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }


}
