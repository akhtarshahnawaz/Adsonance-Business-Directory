<?php

class Images extends CI_Controller
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='admin'){
            redirect('index/login','refresh');
        }
    }

    public function index($pkey){
        $data['title']="Listing Images";

        $data['directory']=base_url().$this->config->item('customerImageUploadDirectory').$pkey;
        session_start();
        $_SESSION['KCFINDER'] = array();
        $_SESSION['KCFINDER']['disabled'] = false;
        $_SESSION['KCFINDER']['uploadURL'] =$data['directory'];
        $_SESSION['KCFINDER']['theme'] = 'dark';

        $this->load->view('common/head',$data);
        $this->load->view('common/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/images/manager',$data);
        $this->load->view('common/footer');

    }



}
