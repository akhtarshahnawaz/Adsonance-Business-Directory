<?php

class Emails extends CI_Controller
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='general'){
            redirect('index/login','refresh');
        }
    }

    public function index($page=null){
        $this->load->model('panel/mwebsite');
        $this->load->model('panel/mlisting');
        $this->load->model('mhome');
        $data['data']=$this->mwebsite->getListingJoinWebsite($page);
        $data['totalListings']=$this->mlisting->totalListingsByThisUser();
        $data['title']='Select a website to get Email';
        $data['pages']=$this->mhome->getAllPages();
        $data['page']=$page;
        $this->load->view('frontend/common/head',$data);
        $this->load->view('frontend/common/header');
        $this->load->view('panel/emails/list',$data);
        $this->load->view('frontend/common/footer');
    }

    public function order($websiteKey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('panel/memails');
            $this->memails->order($data);
        }else{
            if(isset($websiteKey)){
                $this->load->model('mhome');
                $data['title']='Order Emails';
                $data['pages']=$this->mhome->getAllPages();
                $data['webKey']=$websiteKey;
                $this->load->view('frontend/common/head',$data);
                $this->load->view('frontend/common/header');
                $this->load->view('panel/emails/order',$data);
                $this->load->view('frontend/common/footer');
            }
        }
    }


    public function manage($websiteKey=null){
        $this->load->model('panel/memails');
        $data['data']=$this->memails->getEmails($websiteKey);
        if($data){
            $data['website']=$this->memails->websiteDetails($websiteKey);
            $data['title']="Manage Emails";
            $data['webKey']=$websiteKey;
            $this->load->view('frontend/common/head',$data);
            $this->load->view('frontend/common/header');
            $this->load->view('panel/emails/manage',$data);
            $this->load->view('frontend/common/footer');
        }
    }

    public function create($websiteKey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('panel/memails');
            $this->memails->create($data);
        }else{
            if(isset($websiteKey)){
                $this->load->model('mhome');
                $data['pages']=$this->mhome->getAllPages();

                $this->load->model('panel/memails');
                $data['quota']=$this->memails->checkQuota($websiteKey);
                $data['website']=$this->memails->websiteDetails($websiteKey);

                $data['title']='Create Email';
                $data['webKey']=$websiteKey;
                $this->load->view('frontend/common/head',$data);
                $this->load->view('frontend/common/header');
                $this->load->view('panel/emails/form',$data);
                $this->load->view('frontend/common/footer');
            }
        }
    }

    public function update($pkey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('panel/memails');
            $this->memails->update($data);
        }else{
            if(isset($pkey)){
                $this->load->model('mhome');
                $data['pages']=$this->mhome->getAllPages();

                $this->load->model('panel/memails');
                $data['data']=$this->memails->getEmail($pkey);
                $data['website']=$this->memails->websiteDetails($data['data']['website_pkey_emails']);

                $data['title']='Update Email';
                $data['update']=true;
                $data['webKey']=$data['data']['website_pkey_emails'];
                $this->load->view('frontend/common/head',$data);
                $this->load->view('frontend/common/header');
                $this->load->view('panel/emails/form',$data);
                $this->load->view('frontend/common/footer');
            }
        }
    }


    public function deleteEmail($pkey=null,$websiteKey){
        if(isset($pkey)){
            $this->load->model('panel/memails');
            $this->memails->deleteEmail($pkey,$websiteKey);
        }
    }
}
