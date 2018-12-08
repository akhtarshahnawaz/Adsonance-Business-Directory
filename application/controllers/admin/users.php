<?php

class Users extends CI_Controller
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='admin'){
            redirect('index/login','refresh');
        }
    }

    public function index($page=null){
        $this->load->model('admin/musers');
        $data['data']=$this->musers->getUsers($page);
        $data['totalUsers']=$this->musers->totalUsers();
        $data['title']="Users";
        $data['page']=$page;
        $this->load->view('common/head',$data);
        $this->load->view('common/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/users/list',$data);
        $this->load->view('common/footer');
    }


    public function create(){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('admin/musers');
            $insert=$this->musers->insertUser($data);
            if(!$insert['error']['status']){
                $this->session->set_flashdata('notification',$this->config->item('insertSuccess'));
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect('/admin/users/', 'refresh');
            }else{
                $data['data']=$insert;
                $data['errors']=$insert['error']['error'];

                $data['title']="Create User";

                $this->load->view('common/head',$data);
                $this->load->view('common/header');
                $this->load->view('admin/sidebar');
                $this->load->view('admin/users/form',$data);
                $this->load->view('common/footer');
            }
        }else{
            $data['title']="Create User";
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/users/form');
            $this->load->view('common/footer');
        }
    }


    public function edit($pkey=null){
        $data=$this->input->post();
        $this->load->model('admin/musers');

        if(!empty($data)){
            $update=$this->musers->updateUser($data);
            if(!$update['error']['status']){
                $this->session->set_flashdata('notification',$this->config->item('editSuccess'));
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect('/admin/users/', 'refresh');
            }else{
                $data['data']=$update;
                $data['errors']=$update['error']['error'];
                $data['update']=true;
                $data['title']="Edit User";

                $this->load->view('common/head',$data);
                $this->load->view('common/header');
                $this->load->view('admin/sidebar');
                $this->load->view('admin/users/form',$data);
                $this->load->view('common/footer');
            }
        }elseif(empty($data) && isset($pkey)){
            $data['title']="Edit User";
            $data['data']= $this->musers->getUser($pkey);
            $data['update']=true;
            $this->load->view('common/head',$data);
            $this->load->view('common/header');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/users/form',$data);
            $this->load->view('common/footer');
        }
    }

    public function view($pkey=null){
        $this->load->model('admin/musers');
        $data= $this->musers->getUser($pkey);
        $data['listings']= $this->musers->getUserListing($pkey);
        $data['orders']= $this->musers->getUserOrders($pkey);

        $data['title']="View User";

        $this->load->view('common/head',$data);
        $this->load->view('common/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/users/view',$data);
        $this->load->view('common/footer');
    }

    public function deleteUser($pkey=null){
        $this->load->model('admin/musers');
        if(isset($pkey)){
            $this->musers->deleteUser($pkey);
            $this->session->set_flashdata('notification',$this->config->item('deleteSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
        }
        redirect('/admin/users/index', 'refresh');
    }

    public function search($page=null){
        $string='';
        if(isset($_GET['search'])){
            $string=htmlspecialchars_decode($_GET['search']);
        }

        $this->load->model('admin/musers');

        $data['data']= $this->musers->search($string,$page);
        $data['totalUsers']=$this->musers->totalSearchUsers($string);
        $data['title']="Search Result";
        $data['page']=$page;
        $data['searchString']=$_GET['search'];
        $data['search']=true;
        $this->load->view('common/head',$data);
        $this->load->view('common/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/users/list',$data);
        $this->load->view('common/footer');
    }


}
