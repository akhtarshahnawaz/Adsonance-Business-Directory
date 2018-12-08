<?Php

class Index extends CI_Controller{

    function __construct(){
        parent::__construct();
    }

    public function index($page=null){
        if(isset($page)){
            $this->load->view('static/'.$page);
        }else{
            $this->load->view('static/index');
        }
    }

    public function login(){
        if($this->session->userdata('loggedIn') && ($this->session->userdata('type')=='admin' || $this->session->userdata('type')=='superAdmin')){
            redirect('/admin/index/', 'refresh');
        }elseif($this->session->userdata('loggedIn') && $this->session->userdata('type')=='general'){
            redirect('/panel/index/', 'refresh');
        }else{
            $data=$this->input->post();
            if(!empty($data)){
                $this->load->model('mindex');
                $this->mindex->checkLogin($data);

            }else{
                $data['title']="Login";
                $this->load->view('common/head',$data);
                $this->load->view('common/login');
                $this->load->view('common/footer');
            }
        }
    }

    public function logout(){
        if($this->session->userdata('loggedIn')){
            $this->session->sess_destroy();
            redirect('/index/login/', 'refresh');
        }else{
            echo "Page not Found";
        }
    }


    public function register(){
        if($this->session->userdata('loggedIn')){
            redirect('/panel/index/', 'refresh');
        }else{
            $data=$this->input->post();
            if(!empty($data)){
                $this->load->model('mindex');
                $data['vcode']=sha1($data['email'].rand(1,1000));
                $data['type']='general';
                $insert=$this->mindex->insertUser($data);

                if(!$insert['error']['status']){
                    $sendSettings['to']=$data['email'];
                    $sendSettings['from']=$this->config->item('registrationVerificationEmailFrom');
                    $sendSettings['replyTo']=$this->config->item('registrationVerificationEmailReplyTo');
                    $sendSettings['replyToHeader']=$this->config->item('registrationVerificationEmailReplyToHeader');
                    $sendSettings['subject']=$this->config->item('registrationVerificationEmail');
                    $sendSettings['header']=$this->config->item('registrationVerificationEmailHeader');
                    $sendSettings['message']=$this->load->view('mails/registrationSuccessVerification',$data,true);
                    $this->mindex->sendEmail($sendSettings);

                    $this->session->set_flashdata('notification',$this->config->item('successfullyRegistered'));
                    $this->session->set_flashdata('alertType', 'alert-success');
                    redirect('/index/login/', 'refresh');
                }else{
                    $data['data']=$insert;
                    $data['errors']=$insert['error']['error'];
                    $data['title']="Register";

                    $this->load->view('common/head',$data);
                    $this->load->view('common/register',$data);
                    $this->load->view('common/footer');
                }
            }else{
                $data['title']="Register";
                $this->load->view('common/head',$data);
                $this->load->view('common/register');
                $this->load->view('common/footer');
            }
        }
    }


    //Password Reset Main Function
    public function resetPassword($vcode=null){
        $data=$this->input->post();
        $this->load->model('mindex');
        if(isset($vcode)){
            $this->hasResetCode($vcode,$data);
        }else{
            $this->noResetCode($data);
        }
    }


    //Password Reset will call this if no reset Node
    private function noResetCode($data=null){
        if(!empty($data)){
            $data['userInfo']=$this->mindex->verifyEmail($data['email']);
            if($data['userInfo']){
                $data['generatedVCode'] = $this->mindex->generateVCode($data['email']);
                $sendSettings['to']=$data['email'];
                $sendSettings['from']=$this->config->item('passwordResetVerificationFrom');
                $sendSettings['replyTo']=$this->config->item('sendMessageToListingOwnerReplyTo');
                $sendSettings['replyToHeader']=$this->config->item('sendMessageToListingOwnerReplyToHeader');
                $sendSettings['subject']=$this->config->item('passwordResetVerification');
                $sendSettings['header']=$this->config->item('passwordResetVerificationHeader');
                $sendSettings['message']=$this->load->view('mails/resetPassword/resetEmail',$data,true);;
                $this->mindex->sendEmail($sendSettings);

                $this->session->set_flashdata('notification',$this->config->item('resetEmailSend'));
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('/index/login/', 'refresh');
            }else{
                $this->session->set_flashdata('notification',$this->config->item('emailNotRegistered'));
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('/index/resetPassword/', 'refresh');
            }
        }else{
            $data['title']="Reset Password";
            $this->load->view('common/head',$data);
            $this->load->view('common/resetPassword/enterResetEmail');
            $this->load->view('common/footer');
        }
    }


    //Password Reset will call this if has reset Node

    private function hasResetCode($vcode,$data=null){
        $verified=$this->mindex->verifyVCode($vcode);
        if($verified){
            if(!empty($data)){
                $passError= $this->mindex->passwordCheck($data);
                if(!$passError['status']){
                    $data['pkey']=$verified[0]['pkey'];
                    $this->mindex->editPassword($data);
                    $sendSettings['to']=$verified[0]['email'];
                    $sendSettings['from']=$this->config->item('passwordResetSucccessFrom');
                    $sendSettings['replyTo']=$this->config->item('passwordResetSucccessReplyTo');
                    $sendSettings['replyToHeader']=$this->config->item('passwordResetSucccessReplyToHeader');
                    $sendSettings['subject']=$this->config->item('passwordResetSucccess');
                    $sendSettings['header']=$this->config->item('passwordResetSucccessHeader');
                    $sendSettings['message']=$this->load->view('mails/resetPassword/passwordResetSuccessEmail',$verified,true);;
                    $this->mindex->sendEmail($sendSettings);

                    $this->session->set_flashdata('notification',$this->config->item('passwordChanged'));
                    $this->session->set_flashdata('alertType', 'alert-success');
                    redirect('/index/login/'.$vcode, 'refresh');
                }else{
                    $this->session->set_flashdata('notification',$passError['errors']);
                    $this->session->set_flashdata('alertType', 'alert-error');
                    redirect('/index/resetPassword/'.$vcode, 'refresh');
                }
            }else{
                $data['title']="Reset Password";
                $data['resetCode']=$vcode;
                $this->load->view('head',$data);
                $this->load->view('common/resetPassword/enterResetPassword',$data);
                $this->load->view('footer');
            }
        }else{
            $this->session->set_flashdata('notification',$this->config->item('wrongOrExpiredVcode'));
            $this->session->set_flashdata('alertType', 'alert-error');
            redirect('/index/login/', 'refresh');
        }
    }

    public function verifyAccount($vcode=null){
        if(isset($vcode)){
            $this->load->model('mindex');
            $verification=$this->mindex->verifyVCode($vcode);
            if($verification){
                $this->mindex->verifyAccount($vcode);
                $this->session->set_flashdata('notification',$this->config->item('emailSuccessfullyVerified'));
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect('/index/login/', 'refresh');
            }else{
                redirect(404);
            }
        }else{
                redirect(404);
        }
    }

    public function contactUs(){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('mindex');
            $this->mindex->contactUs($data);
        }
        $data['title']='Contact Us';
        $this->load->view('frontend/common/head',$data);
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/contactUs',$data);
        $this->load->view('frontend/common/footer');
    }

}


