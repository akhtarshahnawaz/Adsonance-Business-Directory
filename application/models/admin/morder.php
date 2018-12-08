<?php

class Morder extends CI_Model
{
    function __construct(){
        parent::__construct();
    }


    public function getOrderRequests($page){
        if(!$this->session->userdata('showAllOrders')){
            $this->db->where('status',0);
        }
        $this->db->limit($this->config->item('orderRequestsOnSinglePage'),$this->config->item('orderRequestsOnSinglePage')*$page);
        $query=$this->db->get('requests');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }


    public function totalOrderRequests(){
        $this->db->select('*');
        $this->db->from('requests');
        if(!$this->session->userdata('showAllOrders')){
            $this->db->where('status',0);
        }
        $result=$this->db->count_all_results();
        return $result;
    }


    public function confirmOrderRequest($requestKey){
        $this->db->set('status',1);
        $this->db->where('pkey',$requestKey);
        if($this->db->update('requests')){
            $this->session->set_flashdata('notification','Success!');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }else{
            $this->session->set_flashdata('notification','Problem Occered!');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
    }

    public function deleteOrderRequest($requestKey){
        $this->db->where('pkey',$requestKey);
        if($this->db->delete('requests')){
            $this->session->set_flashdata('notification','Success!');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }else{
            $this->session->set_flashdata('notification','Problem Occered!');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
    }

    public function toggleShowAll(){
        if($this->session->userdata('showAllOrders')){
            $this->session->set_userdata('showAllOrders', false);
        }else{
            $this->session->set_userdata('showAllOrders', true);
        }
        $this->session->set_flashdata('notification','Success!');
        $this->session->set_flashdata('alertType', 'alert-success');
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

    public function deleteOrder($pkey){
        $this->db->where('pkey',$pkey);
        if($this->db->delete('orders')){
            $this->session->set_flashdata('notification','Successfully Deleted!');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }else{
            $this->session->set_flashdata('notification','Problem while Deleting!');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
    }

    public function getOrder($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('orders');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }

    public  function addOrder($data){
        $insertArray=array(
            'amount'=>$data['amount'],
            'details'=>$data['details'],
            'status'=>$data['status'],
            'startDate'=>createTimeStamp($data['startDate']),
            'validity'=>$data['validity'],
            'login_pkey_orders'=>$data['userKey']
        );
        if($this->db->insert('orders',$insertArray)){
            $this->session->set_flashdata('notification','Successfully Deleted!');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('admin/users/view/'.$data['userKey'], 'refresh');
        }else{
            $this->session->set_flashdata('notification','Problem while Deleting!');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect('admin/users/view/'.$data['userKey'], 'refresh');
        }
    }

    public  function editOrder($data){
        $updateArray=array(
            'amount'=>$data['amount'],
            'details'=>$data['details'],
            'status'=>$data['status'],
            'startDate'=>createTimeStamp($data['startDate']),
            'validity'=>$data['validity'],
            'login_pkey_orders'=>$data['userKey']
        );
        $this->db->where('pkey',$data['pkey']);
        if($this->db->update('orders',$updateArray)){
            $this->session->set_flashdata('notification','Successfully Deleted!');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('admin/users/view/'.$data['userKey'], 'refresh');
        }else{
            $this->session->set_flashdata('notification','Problem while Deleting!');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect('admin/users/view/'.$data['userKey'], 'refresh');
        }
    }
}
