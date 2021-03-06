<?php

class Webpage extends CI_Controller
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='admin'){
            redirect('index/login','refresh');
        }
    }

    public function index($websitePkey){
        if(isset($websitePkey)){
            $this->load->model('admin/mwebpage');
            $data['data']=$this->mwebpage->getAllPages($websitePkey);
            $data['title']="Website Pages";
            $data['website_pkey']=$websitePkey;

            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/webpage/list',$data);
            $this->load->view('common/footer');

        }
    }



    public function create($website_pkey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('admin/mwebpage');
            $this->mwebpage->create($data);
        }else{
            $data['directory']=base_url().$this->config->item('websiteInContentFilesDirectory').$website_pkey;
            session_start();
            $_SESSION['KCFINDER'] = array();
            $_SESSION['KCFINDER']['disabled'] = false;
            $_SESSION['KCFINDER']['uploadURL'] =$data['directory'];
            $_SESSION['KCFINDER']['theme'] = 'dark';


            $data['title']="Create Page";
            $data['website_pkey']=$website_pkey;
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/webpage/form');
            $this->load->view('common/footer');
        }
    }


    public function edit($pkey=null){
        $data=$this->input->post();
        $this->load->model('admin/mwebpage');

        if(!empty($data)){
            $this->mwebpage->update($data);
        }elseif(isset($pkey)){
            $data['update']=true;
            $data['data']=$this->mwebpage->getWebpage($pkey);
            $data['pkey']=$pkey;

            if($data['data']){
                $data['directory']=base_url().$this->config->item('websiteInContentFilesDirectory').$data['data']['website_pkey'];
                session_start();
                $_SESSION['KCFINDER'] = array();
                $_SESSION['KCFINDER']['disabled'] = false;
                $_SESSION['KCFINDER']['uploadURL'] =$data['directory'];
                $_SESSION['KCFINDER']['theme'] = 'dark';

                $data['title']='Update Webpage';
                $this->load->view('common/head',$data);
                $this->load->view('common/header');
                $this->load->view('admin/sidebar');
                $this->load->view('admin/webpage/form',$data);
                $this->load->view('common/footer');
            }
        }
    }


    public function deleteWebpage($pkey=null,$websitePkey=null){
        if(isset($pkey)){
            $this->load->model('admin/mwebpage');
            $this->mwebpage->deleteWebpage($pkey);
            $this->session->set_flashdata('notification',$this->config->item('deleteSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/admin/webpage/index/'.$websitePkey, 'refresh');
        }
    }


    public function slideshow($website_pkey){
        if(isset($website_pkey)){
            $data['title']="SlideShow Images";
            $data['directory']=base_url().$this->config->item('SlideshowImageUploadDirectory').$website_pkey;

            session_start();
            $_SESSION['KCFINDER'] = array();
            $_SESSION['KCFINDER']['disabled'] = false;
            $_SESSION['KCFINDER']['uploadURL'] =$data['directory'];
            $_SESSION['KCFINDER']['theme'] = 'dark';

            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/webpage/slideshow',$data);
            $this->load->view('common/footer');

        }
    }



}
