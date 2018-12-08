<?php

class Mindex extends CI_Model
{
    function __construct(){
        parent::__construct();
    }


    public function orders($page=null){
        $this->db->where('login_pkey_orders',$this->session->userdata('key'));
        $this->db->limit($this->config->item('OrdersOnSinglePage'), $this->config->item('OrdersOnSinglePage')*$page);
        $query=$this->db->get('orders');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function totalOrders(){
        $this->db->where('login_pkey_orders',$this->session->userdata('key'));
        $result=$result=$this->db->count_all_results('orders');
        return $result;
    }
}
