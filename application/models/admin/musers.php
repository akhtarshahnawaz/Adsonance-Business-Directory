<?php

class Musers extends CI_Model
{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('LoggedIn') || !$this->session->userdata('type')=='admin'){
            //redirect('index/login','refresh');
        }
    }

    public function getUsers($page){
        $this->db->limit($this->config->item('UsersOnSinglePage'));
        $this->db->offset($this->config->item('UsersOnSinglePage')*$page);
        $query=$this->db->get('login');
        $result=$query->result_array();
        return $result;
    }

    public function getUser($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('login');
        $result=$query->result_array();
        return $result[0];
    }

    public function totalUsers(){
        $this->db->select('*');
        $this->db->from('login');
        $result=$this->db->count_all_results();
        return $result;
    }


    public function updateUser($data){
        $data['error']=$this->generateUpdateErrors($data);
        if(!$data['error']['status']){
            $updateArray=array(
                'email'=>$data['email'],
                'password'=>sha1($data['password']),
                'type'=>$data['type'],
                'vcode'=>'null',
                'name'=>$data['name'],
                'phone'=>$data['phone'],
                'address'=>$data['address'],
                'company'=>$data['company'],
            );
            $this->db->where('pkey',$data['pkey']);
            $this->db->update('login',$updateArray);
        }else{
            return $data;
        }
    }

    public function insertUser($data){
        $data['error']=$this->generateSignupErrors($data);
        if(!$data['error']['status']){
            $insertArray=array(
                'email'=>$data['email'],
                'password'=>sha1($data['password']),
                'type'=>$data['type'],
                'vcode'=>'null',
                'name'=>$data['name'],
                'phone'=>$data['phone'],
                'address'=>$data['address'],
                'company'=>$data['company'],
            );
            $this->db->insert('login',$insertArray);
        }else{
            return $data;
        }
    }

    public function generateUpdateErrors($data){
        /* Generating errors based on Input Data*/
        $error=$this->config->item('someErrorsWhileRegistration');
        $status=false;


        //Validating Email Address
        if($data['email']==''){
            $error.=$this->config->item('missingEmail');
            $status=true;
        }else{
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $error.=$this->config->item('invalidEmail');
                $status=true;
            }
        }
        //Validating Password
        if($data['password']==''){
            $error.=$this->config->item('missingPassword');
            $status=true;
        }elseif(mb_strlen($data['password'])<8){
            $error.=$this->config->item('tooSmallPassword');
            $status=true;
        }else{
            if($data['password']!= $data['verifyPassword']){
                $error.=$this->config->item('passwordNotMaching');
                $status=true;
            }
        }

        //Validating First Name
        if($data['name']==''){
            $error.=$this->config->item('missingName');
            $status=true;
        }
        //Validating Phone
        if($data['phone']==''){
            $error.=$this->config->item('missingPhone');
            $status=true;
        }

        return array(
            'status'=>$status,
            'error'=>$error
        );
    }


    public function generateSignupErrors($data){
        /* Generating errors based on Input Data*/
        $error=$this->config->item('someErrorsWhileRegistration');
        $status=false;

        //Validating duplicate Email
        $this->db->where('email',$data['email']);
        $query=$this->db->get('login');
        $result=$query->result_array();
        if(!empty($result)){
            $error.=$this->config->item('emailAlreadyRegistered');
            $status=true;
        }

        //Validating Email Address
        if($data['email']==''){
            $error.=$this->config->item('missingEmail');
            $status=true;
        }else{
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $error.=$this->config->item('invalidEmail');
                $status=true;
            }
        }
        //Validating Password
        if($data['password']==''){
            $error.=$this->config->item('missingPassword');
            $status=true;
        }elseif(mb_strlen($data['password'])<8){
            $error.=$this->config->item('tooSmallPassword');
            $status=true;
        }else{
            if($data['password']!= $data['verifyPassword']){
                $error.=$this->config->item('passwordNotMaching');
                $status=true;
            }
        }

        //Validating First Name
        if($data['name']==''){
            $error.=$this->config->item('missingName');
            $status=true;
        }
        //Validating Phone
        if($data['phone']==''){
            $error.=$this->config->item('missingPhone');
            $status=true;
        }

        return array(
            'status'=>$status,
            'error'=>$error
        );
    }


    public function deleteUser($pkey){
        $this->db->where('pkey',$pkey);
        $this->db->delete('login');
    }

    public function getUserListing($pkey){
        $this->db->where('login_pkey',$pkey);
        $query=$this->db->get('listing');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function getUserOrders($pkey){
        $this->db->where('login_pkey_orders',$pkey);
        $query=$this->db->get('orders');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function search($string,$page){
        $string= preg_replace("/[[:blank:]]+/"," ",$string);
        $searchString=explode(' ',trim($string));
        $searchfields=array('login.name','login.email','login.address','login.company','login.phone');

        $search=array();
        foreach($searchString as $string){
            foreach($searchfields as $fields){
                $search[$fields]=$string;
            }
        }

        $this->db->select('*');
        $this->db->from('login');
        $this->db->or_like($search);
        $this->db->limit($this->config->item('UsersOnSinglePage'),$this->config->item('UsersOnSinglePage')*$page);
        $query = $this->db->get();
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }
    }

    public function totalSearchUsers($string){
        $string= preg_replace("/[[:blank:]]+/"," ",$string);
        $searchString=explode(' ',trim($string));
        $searchfields=array('login.name','login.email','login.address','login.company','login.phone');

        $search=array();
        foreach($searchString as $string){
            foreach($searchfields as $fields){
                $search[$fields]=$string;
            }
        }

        $this->db->select('*');
        $this->db->from('login');
        $this->db->or_like($search);
        $result=$this->db->count_all_results();
        return $result;
    }
}
