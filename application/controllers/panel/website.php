<?php

class Website extends CI_Controller
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
        $data['title']='Your Websites';
        $data['pages']=$this->mhome->getAllPages();
        $data['page']=$page;
        $this->load->view('frontend/common/head',$data);
        $this->load->view('frontend/common/header');
        $this->load->view('panel/website/assList',$data);
        $this->load->view('frontend/common/footer');
    }

    public function manage($pkey=null){
        $this->load->model('panel/mwebsite');
        $data=$this->mwebsite->getWebsite($pkey);
        if($data){
            $data['title']="Manage Website";
            $data['listing_key']=$pkey;
            $this->load->view('frontend/common/head',$data);
            $this->load->view('frontend/common/header');
            $this->load->view('panel/website/manage',$data);
            $this->load->view('frontend/common/footer');
        }
    }

    public function unassListings($page=null){
        $this->load->model('panel/mwebsite');
        $this->load->model('panel/mlisting');
        $this->load->model('mhome');
        $data['data']=$this->mwebsite->getListingJoinWebsite($page);
        $data['totalListings']=$this->mlisting->totalListingsByThisUser();
        $data['title']='Your Websites';
        $data['pages']=$this->mhome->getAllPages();
        $data['page']=$page;
        $this->load->view('frontend/common/head',$data);
        $this->load->view('frontend/common/header');
        $this->load->view('panel/website/unassList',$data);
        $this->load->view('frontend/common/footer');
    }

    public function create($listing_pkey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('panel/mwebsite');
            if($this->mwebsite->create($data)){
            }else{
                $data['data']=$data;
                $data['title']="Create Website";
                $data['slugAlreadyBooked']='This Slug is Already Booked';
                $this->load->view('frontend/common/head',$data);
                $this->load->view('frontend/common/header');
                $this->load->view('panel/website/form',$data);
                $this->load->view('frontend/common/footer');
            }

        }elseif(isset($listing_pkey) && $listing_pkey!=null){
                $data['title']="Create Website";
                $data['listing_pkey']=$listing_pkey;
                $this->load->view('frontend/common/head',$data);
                $this->load->view('frontend/common/header');
                $this->load->view('panel/website/form',$data);
                $this->load->view('frontend/common/footer');
        }
    }



    public function edit($pkey=null){
        $data=$this->input->post();
        $this->load->model('panel/mwebsite');

        if(!empty($data)){
            if($this->mwebsite->update($data)){
            }else{
                $data['update']=true;
                $data['data']=$data;
                $data['title']="Update Website";
                $data['slugAlreadyBooked']='This Slug is Already Booked';
                $this->load->view('frontend/common/head',$data);
                $this->load->view('frontend/common/header');
                $this->load->view('panel/website/form',$data);
                $this->load->view('frontend/common/footer');
            }
        }elseif(isset($pkey)){
            $data['update']=true;
            $data['data']=$this->mwebsite->getWebsite($pkey);
            $data['pkey']=$pkey;

            $data['title']='Update Website Details';
            $this->load->view('frontend/common/head',$data);
            $this->load->view('frontend/common/header');
            $this->load->view('panel/website/form',$data);
            $this->load->view('frontend/common/footer');
        }
    }


    public function deleteWebsite($pkey=null){
        if(isset($pkey)){
            $this->load->model('panel/mwebsite');
            $this->mwebsite->deleteWebsite($pkey);
            $this->session->set_flashdata('notification',$this->config->item('deleteSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/panel/website/index/', 'refresh');
        }
    }



    public function uploadLogo(){
        $config['upload_path'] = './'.$this->config->item('LogoUploadDirectory');
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']	= $this->config->item('LogoSize');
        $config['max_width']  = $this->config->item('LogoWidth');
        $config['max_height']  = $this->config->item('LogoHeight');
        $config['encrypt_name']=TRUE;


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('logoSelect'))
        {
            $error = $this->upload->display_errors('<span>','</span>');
            echo $error;
        }
        else
        {
            $data = $this->upload->data();
            $file= base_url().$this->config->item('LogoUploadDirectory').$data['file_name'];
            echo $file;
        }
    }

    public function uploadFavicon(){
        $config['upload_path'] = './'.$this->config->item('FaviconUploadDirectory');
        $config['allowed_types'] = 'gif|ico|png|jpg|jpeg|bmp';
        $config['max_size']	= $this->config->item('FaviconSize');
        $config['max_width']  = $this->config->item('FaviconWidth');
        $config['max_height']  = $this->config->item('FaviconHeight');
        $config['encrypt_name']=TRUE;


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('faviconSelect'))
        {
            $error = $this->upload->display_errors('<span>','</span>');
            echo $error;
        }
        else
        {
            $data = $this->upload->data();
            $file= base_url().$this->config->item('FaviconUploadDirectory').$data['file_name'];
            echo $file;
        }
    }

    public function orderCustomDomain($websiteKey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('panel/mwebsite');
            $this->mwebsite->orderCustomDomain($data);
        }else{
            if(isset($websiteKey)){
                $this->load->model('mhome');
                $data['title']='Order Custom Domain';
                $data['pages']=$this->mhome->getAllPages();
                $data['webKey']=$websiteKey;
                $this->load->view('frontend/common/head',$data);
                $this->load->view('frontend/common/header');
                $this->load->view('panel/website/orderDomain',$data);
                $this->load->view('frontend/common/footer');
            }
        }
    }

    public function getMorePages($websiteKey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('panel/mwebsite');
            $this->mwebsite->orderMorePages($data);
        }else{
            if(isset($websiteKey)){
                $this->load->model('mhome');
                $data['title']='Order More Pages';
                $data['pages']=$this->mhome->getAllPages();
                $data['webKey']=$websiteKey;
                $this->load->view('frontend/common/head',$data);
                $this->load->view('frontend/common/header');
                $this->load->view('panel/website/orderMorePages',$data);
                $this->load->view('frontend/common/footer');
            }
        }
    }

}
