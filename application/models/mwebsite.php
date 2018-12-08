<?php

class Mwebsite extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function getWebsiteBySlug($slug){
        $this->db->select('*');
        $this->db->select('website.name as websiteName,website.pkey as websiteKey,website.status as websiteStatus');        $this->db->from('website');
        $this->db->join('webPages', 'webPages.website_pkey = website.pkey','left');
        $this->db->having('website.slug',strtolower($slug));
        $this->db->having('webPages.type','home');
        $query=$this->db->get();
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }

    public function getPageBySlug($slug,$page){
        $this->db->select('*');
        $this->db->select('website.name as websiteName,website.pkey as websiteKey,website.status as websiteStatus');        $this->db->from('website');
        $this->db->join('webPages', 'webPages.website_pkey = website.pkey','left');
        $this->db->having('website.slug',strtolower($slug));
        $this->db->having('webPages.pkey',$page);
        $query=$this->db->get();
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }

    public function getWebsite($url){
        $this->db->like('url',$url);
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }

    public function getWebsiteByID($website_key){
        $this->db->where('pkey',$website_key);
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }


    public function getPage($websiteID,$pageID){
        $this->db->select('*');
        $this->db->select('website.name as websiteName,website.pkey as websiteKey,website.status as websiteStatus');    
        $this->db->from('website');
        $this->db->join('webPages', 'webPages.website_pkey = website.pkey','left');
        $this->db->having('webPages.pkey',$pageID);
        $this->db->having('website_pkey',$websiteID);
        $query=$this->db->get();
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }

    public function getHomePage($websiteID){
        $this->db->select('*');
        $this->db->select('website.name as websiteName,website.pkey as websiteKey,website.status as websiteStatus');
        $this->db->from('website');
        $this->db->join('webPages', 'webPages.website_pkey = website.pkey','left');
        $this->db->having('website_pkey',$websiteID);
        $this->db->having('type','home');
        $query = $this->db->get();
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }

    }

    public function getAllPages($websiteID){
        $this->db->where('website_pkey',$websiteID);
        $this->db->order_by('order', 'asc'); 
        $query=$this->db->get('webPages');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function contactWebsiteOwner($data,$websiteData){
            $message=$this->load->view('mails/website/websiteAdminContactFormEmail',$data,true);
            $this->load->library('email');
            $this->email->from($this->config->item('sendMessageToListingOwnerFrom'), "Message from AdsonanceBusiness.com");
            $this->email->reply_to($data['email'],'Reply this message');
            $this->email->to($websiteData['email']);
            $this->email->subject('Message from '.$websiteData['name'].' ('.$websiteData['url'].')');
            $this->email->message($message);
            $result=$this->email->send();
            if($result){
                $this->session->set_flashdata('notification','Message Succesfully Send. We will contact you shortly.');
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect($this->input->server('HTTP_REFERER'), 'refresh');
            }else{
                $this->session->set_flashdata('notification','Problem while sending Message!');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect($this->input->server('HTTP_REFERER'), 'refresh');
            }
    }

}
