<?php

class Index extends CI_Controller
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='admin'){
            redirect('index/login','refresh');
        }
    }

    public function index(){
        $this->load->model('admin/mindex');
        $data['counts']=$this->mindex->countAllTables();
        $data['title']="Index";
        $this->load->view('common/head',$data);
        $this->load->view('common/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/index',$data);
        $this->load->view('common/footer');
    }

    public function regenerateSitemap(){
        $this->load->model('admin/mindex');
        $data['listings']=$this->mindex->getAllListings();
        $data['categories']=$this->mindex->getAllCategories();
        $data['websitePages']=$this->mindex->getAllWebsitesAndPages();
        $data['websites']=$this->mindex->getAllWebsites();


        $sitemapData=$this->load->view('admin/sitemapFormat',$data,true);

        $this->load->helper('file');
        $sitemapPath = $this->config->item('sitemapLocation');
        write_file($sitemapPath, $sitemapData);

        redirect('admin/index','refresh');
    }

}
