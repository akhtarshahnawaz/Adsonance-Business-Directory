<?php

class Order extends CI_Controller
{

    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('loggedIn') || $this->session->userdata('type')!='admin'){
            redirect('index/login','refresh');
        }
    }


    public function ordersRequest($page=null){
        $this->load->model('admin/morder');
        $data['data']=$this->morder->getOrderRequests($page);
        $data['totalOrderRequests']=$this->morder->totalOrderRequests();
        $data['page']=$page;
        $data['title']="Order Requests";
        $this->load->view('common/head',$data);
        $this->load->view('common/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/order/requests',$data);
        $this->load->view('common/footer');
    }


    public function confirmOrderRequest($requestKey=null){
        if(isset($requestKey)){
            $this->load->model('admin/morder');
            $this->morder->confirmOrderRequest($requestKey);
        }
    }


    public function deleteOrderRequest($requestKey=null){
        if(isset($requestKey)){
            $this->load->model('admin/morder');
            $this->morder->deleteOrderRequest($requestKey);
        }
    }

    public function toggleShowAll(){
        $this->load->model('admin/morder');
        $this->morder->toggleShowAll();
    }

    public function add($webKey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('admin/morder');
            $this->morder->addOrder($data);
        }else{
            if(isset($webKey)){
                $data['userKey']=$webKey;
                $data['title']="Add Order";
                $this->load->view('common/head',$data);
                $this->load->view('common/header');
                $this->load->view('admin/sidebar');
                $this->load->view('admin/order/form',$data);
                $this->load->view('common/footer');
            }
        }
    }

    public function edit($pkey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('admin/morder');
            $this->morder->editOrder($data);
        }else{
            if(isset($pkey)){
                $this->load->model('admin/morder');
                $data['data']=$this->morder->getOrder($pkey);
                $data['pkey']=$pkey;
                $data['title']="Edit Order";
                $data['userKey']=$data['data']['login_pkey_orders'];
                $data['update']=true;
                $this->load->view('common/head',$data);
                $this->load->view('common/header');
                $this->load->view('admin/sidebar');
                $this->load->view('admin/order/form',$data);
                $this->load->view('common/footer');
            }
        }
    }

    public function deleteOrder($pkey=null){
        if(isset($pkey)){
            $this->load->model('admin/morder');
            $this->morder->deleteOrder($pkey);
        }
    }
}
