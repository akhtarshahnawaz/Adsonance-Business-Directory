<?php

class Emails extends CI_Controller
{

    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='admin'){
            redirect('index/login','refresh');
        }
    }

    public function index($page=null){
        $this->load->model('admin/memails');
        $data['data']=$this->memails->getNewRequests($page);
        $data['totalRequests']=$this->memails->totalNewRequests();
        $data['title']="Email Requests";
        $data['page']=$page;
        $this->load->view('common/head',$data);
        $this->load->view('common/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/emails/requests',$data);
        $this->load->view('common/footer');
    }

    public function manage($websiteKey=null){
        if(isset($websiteKey)){
            $this->load->model('admin/memails');
            $data['data']=$this->memails->thisWebsiteEmails($websiteKey);
            $data['website']=$this->memails->getWebsiteByWebKey($websiteKey);
            $data['title']="Manage Email";
            $data['webKey']=$websiteKey;
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/emails/manage',$data);
            $this->load->view('common/footer');
        }
    }

    public function create($websiteKey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('admin/memails');
            $this->memails->create($data);
        }else{
            if(isset($websiteKey)){
                $this->load->model('admin/memails');
                $data['domain']=$this->memails->getDomainByWebKey($websiteKey);
                $data['title']="Create Email";
                $data['webKey']=$websiteKey;
                $this->load->view('common/head',$data);
                $this->load->view('common/header');
                $this->load->view('admin/sidebar');
                $this->load->view('admin/emails/form',$data);
                $this->load->view('common/footer');
            }
        }
    }

    public function update($pkey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('admin/memails');
            $this->memails->update($data);
        }else{
            if(isset($pkey)){
                $data['title']="Update Email";
                $this->load->model('admin/memails');
                $data['data']=$this->memails->getEmail($pkey);
                $data['domain']=$this->memails->getDomainByWebKey($data['data']['website_pkey_emails']);
                $data['webKey']=$data['data']['website_pkey_emails'];
                $data['update']=true;
                $this->load->view('common/head',$data);
                $this->load->view('common/header');
                $this->load->view('admin/sidebar');
                $this->load->view('admin/emails/form',$data);
                $this->load->view('common/footer');
            }
        }
    }

    public function deleteEmail($pkey=null){
        if(isset($pkey)){
            $this->load->model('admin/memails');
            $this->memails->deleteEmail($pkey);
        }
    }

    public function confirm($pkey=null){
        if(isset($pkey)){
            $this->load->model('admin/memails');
            $this->memails->confirm($pkey);
        }else{
            $this->session->set_flashdata('notification','Problem Occured!');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
    }

    public function deleteRequest($pkey=null){
        if(isset($pkey)){
            $this->load->model('admin/memails');
            $this->memails->deleteEmail($pkey);
        }else{
            $this->session->set_flashdata('notification','Problem Occured!');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
    }

    public function requestingUser($emailRequestKey){
        $this->load->model('admin/memails');
        $data= $this->memails->getUserByEmailRequestKey($emailRequestKey);

        $data['title']="View User";
        $this->load->view('common/head',$data);
        $this->load->view('common/header',$data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/users/view',$data);
        $this->load->view('common/footer');
    }

    public function toggleShowAll(){
        $this->load->model('admin/memails');
        $this->memails->toggleShowAll();
    }

}
