<?Php

class Home extends CI_Controller{

    function __construct(){
        parent::__construct();
    }

    public function index(){
        $host=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $host=str_replace('http://','',$host);
        $host=str_replace('https://','',$host);
        $host=str_replace('/index.php','',$host);
        $host=str_replace('index.php/','',$host);
        $host=str_replace('index.php','',$host);

        $ourSites=explode(',',$this->config->item('websiteAddress'));
        if(in_array($host,$ourSites)){
            $this->loadDirectory();
        }else{
            $this->loadUserWebsite($host);
        }
    }


    public function loadDirectory(){
        $this->load->model('mhome');
        $data['categories']=$this->mhome->getAllCategories();
        $data['title']=$this->config->item('homepageTitle');
        $data['pages']=$this->mhome->getAllPages();
        $data['metaDescription']=$this->config->item('homepageDescription');
        $data['keywords']='';
        foreach($data['categories'] as $row){
            $data['keywords'].=$row['name'].',';
        }

        $this->load->view('frontend/common/head',$data);
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/common/belowHeader',$data);
        $this->load->view('frontend/common/searchBar',$data);
        $this->load->view('frontend/home',$data);
        $this->load->view('frontend/common/sidebar',$data);
        $this->load->view('frontend/common/footer');
    }



    public function loadUserWebsite($host){
        $this->load->model('mwebsite');
        $data=$this->mwebsite->getWebsite($host);
        $websiteKey=$data['pkey'];
        if($data){
            $data=$this->mwebsite->getHomepage($websiteKey);
            $data['pages']=$this->mwebsite->getAllPages($websiteKey);
            $this->load->view('website/'.$data['template'].'/common/head',$data);
            $this->load->view('website/'.$data['template'].'/common/header',$data);
            $this->load->view('website/'.$data['template'].'/home',$data);
            $this->load->view('website/'.$data['template'].'/common/footer',$data);
        }else{
            $this->loadDirectory();
        }
    }

    public function category($catKey,$page=null){
        $this->load->model('mhome');
        $data['listings']=$this->mhome->getListingsUnderCategory($catKey,$page);
        $data['category']=$this->mhome->getCatData($catKey);
        $data['title']=$data['category']['name'].$this->config->item('categoryTitle');
        $data['pages']=$this->mhome->getAllPages();
        $data['totalListings']=$this->mhome->totalListingsUnderCategory($catKey);
        $data['page']=$page;
        $data['catKey']=$catKey;
        $data['metaDescription']=$data['category']['description'];
        $data['keywords']='';
        foreach($data['listings'] as $row){
            $data['keywords'].=$row['name'].',';
        }

        $this->load->view('frontend/common/head',$data);
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/common/belowHeader',$data);
        $this->load->view('frontend/common/searchBar',$data);
        $this->load->view('frontend/category',$data);
        $this->load->view('frontend/common/sidebar',$data);
        $this->load->view('frontend/common/footer');
    }


    public function search($page=null,$term=null,$city=null,$locality=null){
        $data=$this->input->post();
        if(!isset($page)){
            $page=0;
        }
        if(!empty($data)){
            $this->load->model('mhome');
            $data['page']=$page;

            $data['listings']=$this->mhome->search($data);
            $data['totalListings']=$this->mhome->totalSearchResults($data);
            $data['title']=$data['term'].' | '.$this->config->item('SearchTitle');
            $data['pages']=$this->mhome->getAllPages();
            $data['metaDescription']=$data['term'].','.$data['locality'].','.$data['city'];
            $data['keyword']='';
            foreach($data['listings'] as $row){
                $data['keyword'].=$row['name'];
            }

            $this->load->view('frontend/common/head',$data);
            $this->load->view('frontend/common/header');
            $this->load->view('frontend/common/belowHeader',$data);
            $this->load->view('frontend/common/searchBar',$data);
            $this->load->view('frontend/search',$data);
            $this->load->view('frontend/common/sidebar',$data);
            $this->load->view('frontend/common/footer');

        }elseif(isset($term)){
            $data['term']=urldecode($term);
            $data['locality']=urldecode($locality);
            $data['city']=urldecode($city);
            $data['page']=$page;


            $this->load->model('mhome');
            $data['listings']=$this->mhome->search($data);
            $data['totalListings']=$this->mhome->totalSearchResults($data);
            $data['title']=$data['term'].' | '.$this->config->item('SearchTitle');
            $data['pages']=$this->mhome->getAllPages();
            $data['metaDescription']=$data['term'].','.$data['locality'].','.$data['city'];
            $data['keyword']='';
            foreach($data['listings'] as $row){
                $data['keyword'].=$row['name'];
            }

            $this->load->view('frontend/common/head',$data);
            $this->load->view('frontend/common/header');
            $this->load->view('frontend/common/belowHeader',$data);
            $this->load->view('frontend/common/searchBar',$data);
            $this->load->view('frontend/search',$data);
            $this->load->view('frontend/common/sidebar',$data);
            $this->load->view('frontend/common/footer');

        }elseif(!empty($_GET) && isset($_GET['page']) && isset($_GET['term']) && isset($_GET['locality']) && isset($_GET['city'])){
            $data['term']=urldecode($_GET['term']);
            $data['locality']=urldecode($_GET['locality']);
            $data['city']=urldecode($_GET['city']);
            $data['page']=$_GET['page'];
            $this->load->model('mhome');
            $data['listings']=$this->mhome->search($data);
            $data['totalListings']=$this->mhome->totalSearchResults($data);
            $data['title']=$data['term'].' | '.$this->config->item('SearchTitle');
            $data['pages']=$this->mhome->getAllPages();
            $data['metaDescription']=$data['term'].','.$data['locality'].','.$data['city'];
            $data['keyword']='';
            foreach($data['listings'] as $row){
                $data['keyword'].=$row['name'];
            }

            $this->load->view('frontend/common/head',$data);
            $this->load->view('frontend/common/header');
            $this->load->view('frontend/common/belowHeader',$data);
            $this->load->view('frontend/common/searchBar',$data);
            $this->load->view('frontend/search',$data);
            $this->load->view('frontend/common/sidebar',$data);
            $this->load->view('frontend/common/footer');
        }
    }


    public function single($pkey){
        $this->load->model('mhome');
        $data['listing']=$this->mhome->getListing($pkey);
        $data['title']=$data['listing']['name'].$this->config->item('singleListingTitle').' '.$data['listing']['tags'];
        $data['pages']=$this->mhome->getAllPages();
        $data['keywords']=$data['listing']['tags'];
        $data['metaDescription']=$data['listing']['excerpt'];

        $this->load->view('frontend/common/head',$data);
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/common/belowHeader',$data);
        $this->load->view('frontend/common/searchBar',$data);
        $this->load->view('frontend/single',$data);
        $this->load->view('frontend/common/sidebar',$data);
        $this->load->view('frontend/common/footer');
    }


    public function page($pkey){
        $this->load->model('mhome');
        $data['page']=$this->mhome->getPage($pkey);
        $data['title']=$data['page']['name'].$this->config->item('PageTitle');
        $data['pages']=$this->mhome->getAllPages();

        $this->load->view('frontend/common/head',$data);
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/common/belowHeader',$data);
        $this->load->view('frontend/common/searchBar',$data);
        $this->load->view('frontend/page',$data);
        $this->load->view('frontend/common/sidebar',$data);
        $this->load->view('frontend/common/footer');
    }

    public function sendMessage($pkey=null){
        $data=$this->input->post();
        if(!empty($data)){
            $this->load->model('mhome');
            $result=$this->mhome->sendEmailMessage($data);
            if($result){
                $this->session->set_flashdata('notification','Message Succesfully Send!');
                $this->session->set_flashdata('alertType', 'alert-success');
                redirect($this->input->server('HTTP_REFERER'), 'refresh');
            }

        }else{
            $this->load->model('mhome');
            $data['pkey']=$pkey;
            $this->load->view('frontend/sendMessage',$data);
        }
    }

    public function business($slug){
        $this->load->model('mhome');
        $data['listing']=$this->mhome->getListingBySlug($slug);
        if($data['listing']){
        $data['title']=$data['listing']['name'].$this->config->item('singleListingTitle').' '.$data['listing']['tags'];
        $data['pages']=$this->mhome->getAllPages();
        $data['keywords']=$data['listing']['tags'];
        $data['metaDescription']=$data['listing']['excerpt'];
        $data['friendlyUrl']=true;

        $this->load->view('frontend/common/head',$data);
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/common/belowHeader',$data);
        $this->load->view('frontend/common/searchBar',$data);
        $this->load->view('frontend/single',$data);
        $this->load->view('frontend/common/sidebar',$data);
        $this->load->view('frontend/common/footer');
        }
 
    }

}


