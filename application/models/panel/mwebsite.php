<?php

class Mwebsite extends CI_Model
{

    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='general'){
            redirect('index/login','refresh');
        }
    }


    public function getListingJoinWebsite($page=null){
        $this->db->select('*,website.pkey as webKey,listing.pkey as pkey,listing.name as name,website.name as webName, listing.status as status, website.status as webStatus,listing.email as email, website.email as webEmail');
        $this->db->from('listing');
        $this->db->join('website', 'website.listing_pkey = listing.pkey','left');
        $this->db->limit($this->config->item('ListingsOnSinglePage'), $this->config->item('ListingsOnSinglePage')*$page);
        $this->db->having('listing.login_pkey',$this->session->userdata('key'));
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }


    public function getWebsiteByListingKey($pkey){
        $this->db->where('listing_pkey',$pkey);
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }

    public function getWebsite($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }


    public function create($data){
        $this->db->where('slug',$this->createSlug($data['slug']));
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result)){
            return false;
        }else{
            $insertArray=array(
                'listing_pkey'=>$data['listing_pkey'],
                'name'=>$data['name'],
                'favicon'=>$data['favicon'],
                'slug'=>$this->createSlug($data['slug']),
                'logo'=>$data['logo'],
                'url'=>null,
                'facebook'=>$data['facebook'],
                'twitter'=>$data['twitter'],
                'googlePlus'=>$data['googlePlus'],
                'linkedIn'=>$data['linkedIn'],
                'youtube'=>$data['youtube'],
                'email'=>$data['email'],
                'template'=>$data['template'],
                'maxPages'=>5,
                'maxEmails'=>0
            );
            if($this->db->insert('website',$insertArray)){
                $this->session->set_flashdata('notification','Website Successfully Created!');
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect('/panel/website/manage/'.$this->db->insert_id(), 'refresh');
            }else{
                $this->session->set_flashdata('notification','Some problem occured while creating Website!');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('/panel/website/manage/'.$this->db->insert_id(), 'refresh');
            }
        }
    }


    public function update($data){
        $this->db->where('slug',$this->createSlug($data['slug']));
        $this->db->where('pkey !=',$data['pkey']);
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result)){
            return false;
        }else{
            $updateArray=array(
                'listing_pkey'=>$data['listing_pkey'],
                'name'=>$data['name'],
                'slug'=>$this->createSlug($data['slug']),
                'favicon'=>$data['favicon'],
                'logo'=>$data['logo'],
                'facebook'=>$data['facebook'],
                'twitter'=>$data['twitter'],
                'googlePlus'=>$data['googlePlus'],
                'linkedIn'=>$data['linkedIn'],
                'youtube'=>$data['youtube'],
                'template'=>$data['template'],
                'email'=>$data['email']
            );
            $this->db->where('pkey',$data['pkey']);
            if($this->db->update('website',$updateArray)){
                $this->session->set_flashdata('notification',$this->config->item('editSuccess'));
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect('/panel/website/manage/'.$data['pkey'], 'refresh');
            }else{
                $this->session->set_flashdata('notification','Some problem occured while updating Website!');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('/panel/website/manage/'.$data['pkey'], 'refresh');
            }
        }
    }

    public function deleteWebsite($pkey){
        $this->db->where('pkey',$pkey);
        $this->db->delete('website');
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


    public function orderCustomDomain($data){
        $content='Name of Domain= '.$data['domain'].'</br> Message: </br>'.$data['message'];
        $insertArray=array(
            'website_pkey_requests'=>$data['websiteKey'],
            'userKey'=>$data['userKey'],
            'content'=>$content,
            'status'=>0
        );

        if($this->db->insert('requests',$insertArray)){
            $this->session->set_flashdata('notification','Order request has been send! We will contact you shortly');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/panel/website/index/', 'refresh');
        }else{
            $this->session->set_flashdata('notification','Some problem occured with order request! Try again later');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect('/panel/website/index/', 'refresh');
        }
    }

    public function orderMorePages($data){
        $content='No of Pages Required= '.$data['noOfPages'].'</br> Message: </br>'.$data['message'];
        $insertArray=array(
            'website_pkey_requests'=>$data['websiteKey'],
            'userKey'=>$data['userKey'],
            'content'=>$content,
            'status'=>0
        );

        if($this->db->insert('requests',$insertArray)){
            $this->session->set_flashdata('notification','Order request has been send! We will contact you shortly');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/panel/website/manage/'.$data['websiteKey'], 'refresh');
        }else{
            $this->session->set_flashdata('notification','Some problem occured with order request! Try again later');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect('/panel/website/manage/'.$data['websiteKey'], 'refresh');
        }
    }
}
