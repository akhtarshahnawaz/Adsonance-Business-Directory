<?php

class Mwebpage extends CI_Model
{
    function __construct(){
        parent::__construct();
    }


    public function create($data){
        $this->db->where('pkey',$data['website_pkey']);
        $query=$this->db->get('website');
        $result=$query->result_array();
        if(!empty($result)){
            $maxPages=$result[0]['maxPages'];
            $this->db->where('website_pkey',$data['website_pkey']);
            $query=$this->db->get('webPages');
            $result=$query->result_array();
            $usedQuota=count($result);
            $quota=$maxPages-$usedQuota;
            if($quota>0){
                $insertArray=array(
                    'website_pkey'=>$data['website_pkey'],
                    'name'=>$data['name'],
                    'content'=>$data['content'],
                    'title'=>$data['title'],
                    'keywords'=>$data['keywords'],
                    'description'=>$data['description'],
                    'type'=>$data['type'],
                    'status'=>'',
                    'order'=>$data['order']
                );
                if($this->db->insert('webPages',$insertArray)){
                    $this->session->set_flashdata('notification','Page Added Succesfully!');
                    $this->session->set_flashdata('alertType', 'alert-success');
                    redirect('/panel/webpage/index/'.$data['website_pkey'], 'refresh');
                }else{
                    $this->session->set_flashdata('notification','Some problem occured while adding Page!');
                    $this->session->set_flashdata('alertType', 'alert-error');
                    redirect('/panel/webpage/index/'.$data['website_pkey'], 'refresh');
                }
            }else{
                $this->session->set_flashdata('notification','You have already used Max Allowed Pages for your website. Click "Get more Pages" to order more pages for your website');
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('/panel/webpage/index/'.$data['website_pkey'], 'refresh');
            }
        }
    }

    public function update($data){
        $updateArray=array(
            'website_pkey'=>$data['website_pkey'],
            'name'=>$data['name'],
            'content'=>$data['content'],
            'title'=>$data['title'],
            'keywords'=>$data['keywords'],
            'description'=>$data['description'],
            'type'=>$data['type'],
            'status'=>'',
            'order'=>$data['order']
        );
        $this->db->where('pkey',$data['pkey']);

        if($this->db->update('webPages',$updateArray)){
            $this->session->set_flashdata('notification',$this->config->item('editSuccess'));
            $this->session->set_flashdata('alertType', 'alert-success');
            redirect('/panel/webpage/index/'.$data['website_pkey'], 'refresh');
        }else{
            $this->session->set_flashdata('notification','Some problem occured while updating Website!');
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect('/panel/webpage/index/'.$data['website_pkey'], 'refresh');
        }
    }

    public function getWebpage($pkey){
        $this->db->where('pkey',$pkey);
        $query=$this->db->get('webPages');
        $result=$query->result_array();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }

    public function getAllPages($websitePkey){
        $this->db->where('website_pkey',$websitePkey);
        $this->db->order_by("order", "asc"); 
        $query=$this->db->get('webPages');
        $result=$query->result_array();
        return $result;
    }


    public function deleteWebpage($pkey){
        $this->db->where('pkey',$pkey);
        $this->db->delete('webPages');
    }


}
