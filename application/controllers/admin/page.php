<?php

class Page extends CI_Controller
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='admin'){
            redirect('index/login','refresh');
        }
    }

    public function index(){
        $this->load->model('admin/mpage');
        $data['data']=$this->mpage->getPages();
        $data['title']="Index";
        $this->load->view('common/head',$data);
        $this->load->view('common/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/pages/list');
        $this->load->view('common/footer');
    }


    public function create(){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('admin/mpage');
            $this->mpage->insertPage($data);
            $this->session->set_flashdata('notification',$this->config->item('insertSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/admin/page/index', 'refresh');
        }else{
            $data['directory']=base_url().$this->config->item('pageImageUploadDirectory');
            session_start();
            $_SESSION['KCFINDER'] = array();
            $_SESSION['KCFINDER']['disabled'] = false;
            $_SESSION['KCFINDER']['uploadURL'] =$data['directory'];
            $_SESSION['KCFINDER']['theme'] = 'dark';

            $data['title']="Create Page";
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/pages/form');
            $this->load->view('common/footer');;
        }
    }

    public function edit($pkey=null){
        $data=$this->input->post();
        $this->load->model('admin/mpage');

        if(!empty($data)){
            $this->mpage->updatePage($data);
            $this->session->set_flashdata('notification',$this->config->item('editSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/admin/page/index', 'refresh');
        }elseif(empty($data) && isset($pkey)){
            $data['directory']=base_url().$this->config->item('pageImageUploadDirectory');
            session_start();
            $_SESSION['KCFINDER'] = array();
            $_SESSION['KCFINDER']['disabled'] = false;
            $_SESSION['KCFINDER']['uploadURL'] =$data['directory'];
            $_SESSION['KCFINDER']['theme'] = 'dark';

            $data['update']=true;
            $data['title']="Edit Page";
            $data['data']= $this->mpage->getPage($pkey);
            $data['pkey']= $pkey;
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/pages/form',$data);
            $this->load->view('common/footer');
        }
    }

    public function deletePage($pkey){
        $this->load->model('admin/mpage');
        $this->mpage->deletePage($pkey);
        $this->session->set_flashdata('notification',$this->config->item('deleteSuccess'));
        $this->session->set_flashdata('alertType', 'alert-success');
        redirect('/admin/page/index', 'refresh');
    }


}
