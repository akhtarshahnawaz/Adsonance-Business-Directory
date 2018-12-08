<?php

class Memails extends CI_Model
{
    function __construct(){
        parent::__construct();

    }


    public function create($data){
        if($this->checkQuota($data['websiteKey'])=='true'){
            $insertArray=array(
                'email'=>$data['email'].'@'.$data['domain'],
                'password'=>$data['password'],
                'website_pkey_emails'=>$data['websiteKey'],
                'type'=>'create',
                'status'=>1,
            );
            if($this->db->insert('emails',$insertArray)){
                $this->session->set_flashdata('notification','Succesfully created.');
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect('/admin/emails/manage/'.$data['websiteKey'], 'refresh');
            }else{
                $this->session->set_flashdata('notification','Problem while creating email. Try again later');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('/admin/emails/manage/'.$data['websiteKey'], 'refresh');
            }
        }else{
            $this->session->set_flashdata('notification','You are not allowed to create Email. Max Emails Limit is full.');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect('/admin/emails/manage/'.$data['websiteKey'], 'refresh');
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
                'status'=>1
            );

            $this->db->where('pkey',$data['pkey']);
            if($this->db->update('emails',$updateArray)){
                $this->session->set_flashdata('notification','Succesfully updated.');
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect('/admin/emails/manage/'.$data['websiteKey'], 'refresh');
            }else{
                $this->session->set_flashdata('notification','Problem while updating email. Try again later');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('/admin/emails/manage/'.$data['websiteKey'], 'refresh');
            }
        }
    }

    public function deleteEmail($pkey){
        $this->db->where('pkey',$pkey);
        if($this->db->delete('emails')){
            $this->session->set_flashdata('notification','Success!');
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }else{
            $this->session->set_flashdata('notification','Problem Occured!');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
    }

    public function thisWebsiteEmails($websiteKey){
        $this->db->where('website_pkey_emails',$websiteKey);
        $query=$this->db->get('emails');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function getNewRequests($page){
        if(!$this->session->userdata('showAllEmails')){
            $this->db->where('status',0);
        }
        $this->db->limit($this->config->item('emailRequestsOnSinglePage'),$this->config->item('emailRequestsOnSinglePage')*$page);
        $query=$this->db->get('emails');
        $result=$query->result_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }


    public function totalNewRequests(){
        $this->db->select('*');
        $this->db->from('emails');
        if(!$this->session->userdata('showAllEmails')){
            $this->db->where('status',0);
        }
        $result=$this->db->count_all_results();
        return $result;
    }

    public function confirm($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('emails');
        $result=$query->result_array();
        if(!empty($result)){
            $type=$result[0]['type'];
            if($type=='delete'){
                $this->db->where('pkey',$pkey);
                if($this->db->delete('emails')){
                    $this->session->set_flashdata('notification','Success!');
                    $this->session->set_flashdata('alertType', 'alert-success');
                    redirect($_SERVER['HTTP_REFERER'], 'refresh');
                }else{
                    $this->session->set_flashdata('notification','Problem Occured!');
                    $this->session->set_flashdata('alertType', 'alert-error');
                    redirect($_SERVER['HTTP_REFERER'], 'refresh');
                }
            }else{
                $updateArray=array(
                    'status'=>1
                );
                $this->db->where('pkey',$pkey);
                if($this->db->update('emails',$updateArray)){
                    $this->session->set_flashdata('notification','Success!');
                    $this->session->set_flashdata('alertType', 'alert-success');
                    redirect($_SERVER['HTTP_REFERER'], 'refresh');
                }else{
                    $this->session->set_flashdata('notification','Problem Occured!');
                    $this->session->set_flashdata('alertType', 'alert-error');
                    redirect($_SERVER['HTTP_REFERER'], 'refresh');
                }
            }
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

    public function getDomainByWebKey($webKey){
        $this->db->where('pkey',$webKey);
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0]['url'];
        }else{
            return false;
        }
    }

    public function getWebsiteByWebKey($webKey){
        $this->db->where('pkey',$webKey);
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
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


    public function toggleShowAll(){
        if($this->session->userdata('showAllEmails')){
            $this->session->set_userdata('showAllEmails', false);
        }else{
            $this->session->set_userdata('showAllEmails', true);
        }
        $this->session->set_flashdata('notification','Success!');
        $this->session->set_flashdata('alertType', 'alert-success');
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }


}
