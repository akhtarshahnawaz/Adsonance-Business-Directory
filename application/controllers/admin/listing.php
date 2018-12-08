<?php

class Listing extends CI_Controller
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='admin'){
             redirect('index/login','refresh');
        }
    }

    public function index($page=null){
        $this->load->model('panel/mlisting');
        $data['data']=$this->mlisting->getAllListings($page);
        $data['totalListings']=$this->mlisting->totalListings();
        $data['title']='Your Listing';
        $data['page']=$page;
        $this->load->view('common/head',$data);
        $this->load->view('common/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/listing/list',$data);
        $this->load->view('common/footer');
    }


    public function create(){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('panel/mlisting');
            $this->mlisting->insertListing($data);
            $this->session->set_flashdata('notification',$this->config->item('insertSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/admin/listing/index', 'refresh');
        }else{
            $this->load->model('admin/mcategory');
            $data['categories']=$this->mcategory->getAllCat();

            $data['title']='Insert your Listing';
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/listing/form',$data);
            $this->load->view('common/footer');
        }
    }

    public function edit($pkey=null){
        $data=$this->input->post();
        $this->load->model('panel/mlisting');

        if(!empty($data)){
            $this->mlisting->updateListing($data);
            $this->session->set_flashdata('notification',$this->config->item('editSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/admin/listing/index', 'refresh');
        }elseif(isset($pkey)){
            $this->load->model('admin/mcategory');
            $this->load->model('admin/mlisting');
            $data['update']=true;
            $data['data']=$this->mlisting->getListing($pkey);
            $data['categories']=$this->mcategory->getAllCat();
            $data['pkey']=$pkey;

            $data['title']='Insert your Listing';
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/listing/form',$data);
            $this->load->view('common/footer');
        }
    }

    public function deleteListing($pkey=null){
        if(isset($pkey)){
            $this->load->model('panel/mlisting');
            $this->mlisting->deleteListing($pkey);
            $this->session->set_flashdata('notification',$this->config->item('deleteSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/admin/listing/index', 'refresh');
        }
    }

    public function uploadImage(){
        $config['upload_path'] = './'.$this->config->item('listingBannerUploadDirectory');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= $this->config->item('maxListingImageSize');
        $config['max_width']  = $this->config->item('maxListingImageWidth');
        $config['max_height']  = $this->config->item('maxListingImageHeight');
        $config['encrypt_name']=TRUE;


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('inputImage'))
        {
            $error = $this->upload->display_errors('<span>','</span>');
            echo $error;
        }
        else
        {
            $data = $this->upload->data();
            $file= base_url().$this->config->item('listingBannerUploadDirectory').$data['file_name'];
            echo $file;
        }
    }



}
