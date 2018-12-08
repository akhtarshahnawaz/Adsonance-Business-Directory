<?php

class Mindex extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function generateVCode($email,$pkey){
        $vcode=sha1($email.rand(1,1000));
        $updateArray=array(
            'vcode'=>$vcode
        );
        $this->db->where('pkey',$pkey);
        $this->db->update('login',$updateArray);
        return $vcode;
    }

    public function verifyVCode($vcode){
        $this->db->where('vcode',$vcode);
        $query=$this->db->get('login');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function verifyAccount($vcode){
        $this->db->where('vcode',$vcode);
        $this->db->set('type','verified');
        $this->db->update('login');
    }

    public function verifyEmail($email){
        $this->db->where('email',$email);
        $query=$this->db->get('login');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function sendEmail($data){
        $this->load->library('email');
        $this->email->from($data['from'], $data['header']);
        $this->email->reply_to($data['replyTo'], $data['replyToHeader']);
        $this->email->to($data['to']);
        $this->email->subject($data['subject']);
        $this->email->message($data['message']);
        $result=$this->email->send();
        if($result){
            return true;
        }else{
            return false;
        }
    }


    public function editPassword($data,$pkey){
        if($this->passwordCheck($data)){
            $updateArray=array(
                'password'=>sha1($data['password'])
            );
            $this->db->where('pkey',$pkey);
            $this->db->update('login',$updateArray);
        }
    }


    public function passwordCheck($data){
        $error= $this->config->item('someErrors');
        $status=false;

        if($data['password']==''){
            $error=$this->config->item('someErrors');
            $status=true;
        }elseif(mb_strlen($data['password'])<8){
            $error=$this->config->item('smallPassword');
            $status=true;
        }elseif($data['password']!= $data['verifyPassword']){
            $error=$this->config->item('passwordsNotMaching');
            $status=true;
        }

        return array(
            'status'=>$status,
            'error'=>$error
        );
    }



    public function checkLogin($data){
        $this->db->where('email',$data['email']);
        $this->db->where('password',sha1($data['password']));
        $query=$this->db->get('login');
        $result=$query->result_array();

        if(!empty($result)){
            $sessiondata = array(
                'key' => $result[0]['pkey'],
                'username' => $result[0]['email'],
                'type' => $result[0]['type'],
                'loggedIn' => true
            );
            if($result[0]['type']=='admin' || $result[0]['type']=='superAdmin'){
                $this->session->set_userdata($sessiondata);
                redirect('/admin/index/', 'refresh');
            }else{
                $this->session->set_userdata($sessiondata);
                redirect('/panel/index/index', 'refresh');
            }
        }else{
            $this->session->set_flashdata('notification', $this->config->item('wrongEmailPassword'));
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect('/index/login/', 'refresh');
        }
    }



    public function insertUser($data){
        $data['error']=$this->generateSignupErrors($data);
        if(!$data['error']['status']){
            $insertArray=array(
                'email'=>$data['email'],
                'password'=>sha1($data['password']),
                'type'=>$data['type'],
                'vcode'=>$data['vcode'],
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

    public function contactUs($data){
        $message=$this->load->view('mails/contactFormMessage',$data,true);
        $this->load->library('email');
        $this->email->from($this->config->item('sendMessageToListingOwnerFrom'), $this->config->item('sendMessageToListingOwnerHeader'));
        $this->email->reply_to($data['email'],'Reply to this Email');
        $this->email->to($this->config->item('adminEmail'));
        $this->email->subject($data['name'].' contacted from Adsonancebusiness.com');
        $this->email->message($message);
        $result=$this->email->send();
        if($result){
            $this->session->set_flashdata('notification','Message successfully send! We will contact you shortly');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect($this->input->server('HTTP_REFERER'), 'refresh');
        }else{
            $this->session->set_flashdata('notification','Problem while sending Message!');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect($this->input->server('HTTP_REFERER'), 'refresh');
        }
    }
}
