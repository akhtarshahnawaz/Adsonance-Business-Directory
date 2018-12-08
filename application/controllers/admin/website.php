<?php

class Website extends CI_Controller
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='admin'){
            redirect('index/login','refresh');
        }
    }

    public function index($pkey=null){
        $this->load->model('admin/mwebsite');
        $data=$this->mwebsite->getWebsiteByListingKey($pkey);
        if($data){
            $data['title']="Manage Website";
            $data['listing_key']=$pkey;
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/website/manage',$data);
            $this->load->view('common/footer');
        }else{
            $data['title']="Setup Website";
            $data['listing_key']=$pkey;
            $data['noWebsite']=true;
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/website/manage',$data);
            $this->load->view('common/footer');
        }
    }


    public function manage($pkey=null){
        $this->load->model('admin/mwebsite');
        $data=$this->mwebsite->getWebsite($pkey);
        if($data){
            $data['title']="Manage Website";
            $data['listing_key']=$pkey;
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/website/manage',$data);
            $this->load->view('common/footer');
        }else{
            $data['title']="Setup Website";
            $data['listing_key']=$pkey;
            $data['noWebsite']=true;
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/website/manage',$data);
            $this->load->view('common/footer');
        }
    }

    public function create($listing_pkey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('admin/mwebsite');
            if($this->mwebsite->create($data)){
            }else{
                $data['data']=$data;
                $data['title']="Create Website";
                $data['slugAlreadyBooked']='This Username is Already Booked';
                $this->load->view('common/head',$data);
                $this->load->view('common/header');
                $this->load->view('admin/sidebar');
                $this->load->view('admin/website/form',$data);
                $this->load->view('common/footer');
            }

        }else{
            $data['title']="Create Website";
            $data['listing_pkey']=$listing_pkey;
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/website/form',$data);
            $this->load->view('common/footer');
        }
    }


    public function edit($pkey=null){
        $data=$this->input->post();
        $this->load->model('admin/mwebsite');

        if(!empty($data)){
            if($this->mwebsite->update($data)){
            }else{
                $data['update']=true;
                $data['data']=$data;
                $data['title']="Update Website";
                $data['slugAlreadyBooked']='This Username is Already Booked';
                $this->load->view('common/head',$data);
                $this->load->view('common/header');
                $this->load->view('admin/sidebar');
                $this->load->view('admin/website/form',$data);
                $this->load->view('common/footer');
            }
        }elseif(isset($pkey)){
            $data['update']=true;
            $data['data']=$this->mwebsite->getWebsite($pkey);
            $data['pkey']=$pkey;

            $data['title']='Update Website Details';
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/website/form',$data);
            $this->load->view('common/footer');
        }
    }


    public function deleteWebsite($listing_pkey=null){
        if(isset($listing_pkey)){
            $this->load->model('admin/mwebsite');
            $this->mwebsite->deleteWebsite($listing_pkey);
            $this->session->set_flashdata('notification',$this->config->item('deleteSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/admin/website/index/'.$listing_pkey, 'refresh');
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


}
