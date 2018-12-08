<?php

class Mwebsite extends CI_Model
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='admin'){
            redirect('index/login','refresh');
        }
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
        $this->db->where('slug',$data['slug']);
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
                'url'=>strtolower($data['url']),
                'facebook'=>$data['facebook'],
                'twitter'=>$data['twitter'],
                'googlePlus'=>$data['googlePlus'],
                'linkedIn'=>$data['linkedIn'],
                'youtube'=>$data['youtube'],
                'email'=>$data['email'],
                'template'=>$data['template'],
                'maxPages'=>$data['maxPages'],
                'maxEmails'=>$data['maxEmails']
            );
            if($this->db->insert('website',$insertArray)){
                $this->session->set_flashdata('notification','Website Successfully Created!');
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect('/admin/website/index', 'refresh');
            }else{
                $this->session->set_flashdata('notification','Some problem occured while creating Website!');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('/admin/website/index', 'refresh');
            }
        }
    }


    public function update($data){
        $this->db->where('slug',$data['slug']);
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
                'url'=>strtolower($data['url']),
                'logo'=>$data['logo'],
                'facebook'=>$data['facebook'],
                'twitter'=>$data['twitter'],
                'googlePlus'=>$data['googlePlus'],
                'linkedIn'=>$data['linkedIn'],
                'youtube'=>$data['youtube'],
                'email'=>$data['email'],
                'template'=>$data['template'],
                'maxPages'=>$data['maxPages'],
                'maxEmails'=>$data['maxEmails']
            );
            $this->db->where('pkey',$data['pkey']);
            if($this->db->update('website',$updateArray)){
                $this->session->set_flashdata('notification',$this->config->item('editSuccess'));
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect('/admin/website/index/'.$data['listing_pkey'], 'refresh');
            }else{
                $this->session->set_flashdata('notification','Some problem occured while updating Website!');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('/admin/website/index/'.$data['listing_pkey'], 'refresh');
            }
        }
    }

    public function deleteWebsite($pkey){
        $this->db->where('listing_pkey',$pkey);
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

}
