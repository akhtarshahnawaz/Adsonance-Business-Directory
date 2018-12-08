<?php

class Index extends CI_Controller
{

    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='general'){
            redirect('index/login','refresh');
        }
    }

    public function index($page=null){
        $this->load->model('panel/mlisting');
        $this->load->model('mhome');
        $data['data']=$this->mlisting->getThisUserListings($page);
        $data['totalListings']=$this->mlisting->totalListingsByThisUser();
        $data['title']='Your Listing';
        $data['pages']=$this->mhome->getAllPages();
        $data['page']=$page;
        $this->load->view('frontend/common/head',$data);
        $this->load->view('frontend/common/header');
        $this->load->view('panel/listing/list',$data);
        $this->load->view('frontend/common/footer');
    }


    public function create(){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('panel/mlisting');
            $this->mlisting->insertListing($data);
            $this->session->set_flashdata('notification',$this->config->item('insertSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/panel/index', 'refresh');
        }else{
            $this->load->model('admin/mcategory');
            $this->load->model('mhome');
            $data['pages']=$this->mhome->getAllPages();
            $data['categories']=$this->mcategory->getAllCat();

            $data['title']='Insert your Listing';
            $this->load->view('frontend/common/head',$data);
            $this->load->view('frontend/common/header');
            $this->load->view('panel/listing/form',$data);
            $this->load->view('frontend/common/footer');
        }
    }

    public function edit($pkey=null){
        $data=$this->input->post();
        $this->load->model('panel/mlisting');

        if(!empty($data)){
            $this->mlisting->updateListing($data);
            $this->session->set_flashdata('notification',$this->config->item('editSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/panel/index', 'refresh');
        }elseif(isset($pkey)){
            $this->load->model('admin/mcategory');
            $this->load->model('admin/mlisting');
            $this->load->model('mhome');
            $data['pages']=$this->mhome->getAllPages();
            $data['update']=true;
            $data['data']=$this->mlisting->getListing($pkey);
            $data['categories']=$this->mcategory->getAllCat();
            $data['pkey']=$pkey;

            $data['title']='Insert your Listing';
            $this->load->view('frontend/common/head',$data);
            $this->load->view('frontend/common/header');
            $this->load->view('panel/listing/form',$data);
            $this->load->view('frontend/common/footer');
        }
    }

    public function deleteListing($pkey=null){
        if(isset($pkey)){
            $this->load->model('panel/mlisting');
            $this->mlisting->deleteListing($pkey);
            $this->session->set_flashdata('notification',$this->config->item('deleteSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/panel/index', 'refresh');
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

    public function orders($page=null){
        $this->load->model('panel/mindex');
        $data['data']=$this->mindex->orders($page);
        $data['totalOrders']=$this->mindex->totalOrders();
        $data['page']=$page;

        $data['title']='My Orders';
        $this->load->model('mhome');
        $data['pages']=$this->mhome->getAllPages();

        $this->load->view('frontend/common/head',$data);
        $this->load->view('frontend/common/header');
        $this->load->view('panel/orders',$data);
        $this->load->view('frontend/common/footer');
    }


}
