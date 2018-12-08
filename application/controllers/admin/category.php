<?php

class Category extends CI_Controller
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='admin'){
            redirect('index/login','refresh');
        }
    }

    public function index($limit=null,$page=null){
        $this->load->model('admin/mcategory');
        $data['data']=$this->mcategory->getCats($limit,$page);
        $data['title']="Categories";
        $data['limit']=$limit;
        $data['page']=$page;
        $this->load->view('common/head',$data);
        $this->load->view('common/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/category/list',$data);
        $this->load->view('common/footer');

    }


    public function create(){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('admin/mcategory');
            $this->mcategory->insertCat($data);
            $this->session->set_flashdata('notification','Succesfully Inserted!');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/admin/category/index', 'refresh');
        }else{
            $data['title']="Create Category";
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/category/form');
            $this->load->view('common/footer');
        }
    }


    public function edit($pkey=null){
        $data=$this->input->post();
        $this->load->model('admin/mcategory');

        if(!empty($data)){
            $this->mcategory->updateCat($data);
            $this->session->set_flashdata('notification','Succesfully Inserted!');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/admin/category/index', 'refresh');
        }elseif(empty($data) && isset($pkey)){
            $data['update']=true;
            $data['title']="Edit Category";
            $data['data']= $this->mcategory->getCat($pkey);
            $data['pkey']= $pkey;
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/category/form',$data);
            $this->load->view('common/footer');
        }
    }

    public function deleteCat($pkey=null){
        $this->load->model('admin/mcategory');
        if(isset($pkey)){
            $this->mcategory->deleteCat($pkey);
            $this->session->set_flashdata('notification','Succesfully Deleted!');
            $this->session->set_flashdata('alertType', 'alert-success');
        }
        redirect('/admin/category/index', 'refresh');
    }


    public function uploadBanner(){
        $config['upload_path'] = './'.$this->config->item('categoryBannerUploadDirectory');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= $this->config->item('maxCatBannerSize');
        $config['max_width']  = $this->config->item('maxCatBannerWidth');
        $config['max_height']  = $this->config->item('maxCatBannerHeight');
        $config['encrypt_name']=TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('bannerSelect'))
        {
            $error = $this->upload->display_errors('<span>','</span>');
            echo $error;
        }
        else
        {
            $data = $this->upload->data();
            $file= base_url().$this->config->item('categoryBannerUploadDirectory').$data['file_name'];
            echo $file;
        }
    }

    public function uploadIcon(){
        $config['upload_path'] = './'.$this->config->item('categoryIconUploadDirectory');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= $this->config->item('maxCatIconSize');
        $config['max_width']  = $this->config->item('maxCatIconWidth');
        $config['max_height']  = $this->config->item('maxCatIconHeight');
        $config['encrypt_name']=TRUE;


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('iconSelect'))
        {
            $error = $this->upload->display_errors('<span>','</span>');
            echo $error;
        }
        else
        {
            $data = $this->upload->data();
            $file= base_url().$this->config->item('categoryIconUploadDirectory').$data['file_name'];
            echo $file;
        }
    }



}
