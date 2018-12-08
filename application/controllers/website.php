<?php

class Website extends CI_Controller
{
    function __construct(){
        parent::__construct();
    }


    public function byName($websiteSlug=null,$page=null){
        $this->load->model('mwebsite');

        if(isset($websiteSlug) && isset($page) && $page!=''){
            $data=$this->mwebsite->getPageBySlug($websiteSlug,$page);
            if($data){
            $data['pages']=$this->mwebsite->getAllPages($data['websiteKey']);
            $data['bySlug']=true;
            $data['websiteSlug']=$websiteSlug;
            $this->load->view('website/'.$data['template'].'/common/head',$data);
            $this->load->view('website/'.$data['template'].'/common/header',$data);
            $this->load->view('website/'.$data['template'].'/'.$data['type'],$data);
            $this->load->view('website/'.$data['template'].'/common/footer',$data);
            }
        }elseif(isset($websiteSlug)){
            $data=$this->mwebsite->getWebsiteBySlug($websiteSlug);
            if($data){
            $data['pages']=$this->mwebsite->getAllPages($data['websiteKey']);
            $data['bySlug']=true;
            $data['websiteSlug']=$websiteSlug;
            $this->load->view('website/'.$data['template'].'/common/head',$data);
            $this->load->view('website/'.$data['template'].'/common/header',$data);
            $this->load->view('website/'.$data['template'].'/'.$data['type'],$data);
            $this->load->view('website/'.$data['template'].'/common/footer',$data);
            }

        }
    }


    public function getPage($websiteID,$pageID){
        $this->load->model('mwebsite');
        $data=$this->mwebsite->getPage($websiteID,$pageID);
        if($data){
            $data['pages']=$this->mwebsite->getAllPages($data['websiteKey']);
            $this->load->view('website/'.$data['template'].'/common/head',$data);
            $this->load->view('website/'.$data['template'].'/common/header',$data);
            $this->load->view('website/'.$data['template'].'/'.$data['type'],$data);
            $this->load->view('website/'.$data['template'].'/common/footer',$data);
        }else{
            redirect('http://adsonancebusiness.com','refresh');
        }
    }

    public function contactForm(){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('mwebsite');
            $websiteDetails=$this->mwebsite->getWebsiteByID($data['website_key']);
            if($websiteDetails && $websiteDetails['email']!=''){
                $this->mwebsite->contactWebsiteOwner($data,$websiteDetails);
            }else{
                $this->session->set_flashdata('notification','Problem while sending Message!');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect($this->input->server('HTTP_REFERER'), 'refresh');
            }
        }
    }

}
