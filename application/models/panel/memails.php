<?php

class Memails extends CI_Controller
{

    function __construct(){
        parent::__construct();
    }


    public function order($data){
        $content='No of Emails Required= '.$data['noOfEmails'].'</br> Message: </br>'.$data['message'];
        $insertArray=array(
            'website_pkey_requests'=>$data['websiteKey'],
            'userKey'=>$data['userKey'],
            'content'=>$content,
            'status'=>0
        );

        if($this->db->insert('requests',$insertArray)){
            $this->session->set_flashdata('notification','Order request has been send! We will contact you shortly');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/panel/emails/index/', 'refresh');
        }else{
            $this->session->set_flashdata('notification','Some problem occured with order request! Try again later');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect('/panel/emails/index/', 'refresh');
        }
    }

    public function checkQuota($websiteKey){
        $this->db->where('pkey',$websiteKey);
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result) && $result[0]['url']!=null){
            $quota=$result[0]['maxEmails'];
            $this->db->where('website_pkey_emails',$websiteKey);
            $query=$this->db->get('emails');
            $result=$query->result_array();
            $userQuota=count($result);
            if(($quota-$userQuota)>0){
                return 'true';
            }else{
                return 'quotaFull';
            }
        }else{
            return 'noCustomDomain';
        }
    }

    public function websiteDetails($websiteKey){
        $this->db->where('pkey',$websiteKey);
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }


    public function getEmails($websiteKey){
        $this->db->where('website_pkey_emails',$websiteKey);
        $query=$this->db->get('emails');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
   }

    public function getEmail($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('emails');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }

    public function create($data){
        if($this->checkQuota($data['websiteKey'])=='true'){
            $insertArray=array(
                'email'=>$data['email'].'@'.$data['domain'],
                'password'=>$data['password'],
                'website_pkey_emails'=>$data['websiteKey'],
                'type'=>'create',
                'status'=>0,
                'userKey'=>$this->session->userdata('key')
            );
            if($this->db->insert('emails',$insertArray)){
                $this->session->set_flashdata('notification','Succesfully created. It will take upto 48 hours to take effect');
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect('/panel/emails/manage/'.$data['websiteKey'], 'refresh');
            }else{
                $this->session->set_flashdata('notification','Problem while creating email. Try again later');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('/panel/emails/manage/'.$data['websiteKey'], 'refresh');
            }
        }else{
            $this->session->set_flashdata('notification','Problem while creating email. Try again later');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect('/panel/emails/manage/'.$data['websiteKey'], 'refresh');
        }
    }

    public function update($data){
        $this->db->where('pkey',$data['pkey']);
        $query=$this->db->get('emails');
        $result=$query->result_array();
        if(!empty($result)){
            if($result[0]['status']==0 && $result[0]['type']=='update'){
                $prevEmail=$result[0]['prevEmail'];
            }else{
                $prevEmail=$result[0]['email'];
            }
            $updateArray=array(
                'email'=>$data['email'].'@'.$data['domain'],
                'prevEmail'=>$prevEmail,
                'password'=>$data['password'],
                'website_pkey_emails'=>$data['websiteKey'],
                'type'=>'update',
                'status'=>0,
                'userKey'=>$this->session->userdata('key')
            );

            $this->db->where('pkey',$data['pkey']);
            if($this->db->update('emails',$updateArray)){
                $this->session->set_flashdata('notification','Succesfully updated. It will take upto 48 hours to take effect');
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect('/panel/emails/manage/'.$data['websiteKey'], 'refresh');
            }else{
                $this->session->set_flashdata('notification','Problem while updating email. Try again later');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('/panel/emails/manage/'.$data['websiteKey'], 'refresh');
            }
        }
    }

    public function deleteEmail($pkey,$websiteKey){
        $updateArray=array(
            'type'=>'delete',
            'status'=>0
        );

        $this->db->where('pkey',$pkey);
        if($this->db->update('emails',$updateArray)){
            $this->session->set_flashdata('notification','Succesfully deleted. It will take upto 48 hours to take effect');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/panel/emails/manage/'.$websiteKey, 'refresh');
        }else{
            $this->session->set_flashdata('notification','Problem while deleting email. Try again later');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect('/panel/emails/manage/'.$websiteKey, 'refresh');
        }
    }
}
