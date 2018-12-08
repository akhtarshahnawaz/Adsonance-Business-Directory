<div class="row-fluid" xmlns="http://www.w3.org/1999/html">
<div class="span12">
<?php
$ci=& get_instance();
$ci->load->library('session');
$type=$ci->session->userdata('type');

if($ci->session->flashdata('notification')){
    $alertType = $ci->session->flashdata('alertType');
    $notification = $ci->session->flashdata('notification');
    $hasNotification=true;
}else{
    $hasNotification=false;
} ?>

<div class="row-fluid">
    <div class="span1"></div>
    <div class="span3"> </div>
    <div class="span3"><a href="<?php echo site_url();?>"> <img src="<?php linkAsset('images/logoBlack.png'); ?>"  width="500px" height="100px"/></a></div>
    <div class="span3"></div>
    <div class="span1"></div>
</div>
</br></br>

<div class="row-fluid">
    <div class="well">
        <?php   $this->load->helper('form');
        $attributes = array('class' => 'form-horizontal','method'=>'get');
        $route='home/search';
        echo form_open($route, $attributes); ?>
        <div class="span1"><input type="hidden" name="page" value="0"></div>
        <div class="span6"><input type="text" name="term" value="<?php if(isset($term)){ echo $term; }?>" class="input-block-level" placeholder="Search anything"> </div>
        <div class="span2">
            <input type="text" name="locality" value="<?php if(isset($locality)){ echo $locality; }?>" class="input-block-level" placeholder="Locality">
        </div>
        <div class="span1">
            <input type="text" name="city" value="<?php if(isset($city)){ echo $city; }?>"  class="input-block-level" placeholder="City">
        </div>
        <div class="span1"><button type="submit" class="btn btn-block btn-primary">Search</button></div>
        <div class="span1"></div>
        </form>
    </div>
</div>
<div class="container-fluid">
    <div class="span9 well">


        <?php
        if(isset($update) && $update==true){
            echo '<p class="lead" align="center">Edit Email</p>';
        }else{
            echo '<p class="lead" align="center">Create Email</p>';
        }
        ?>


        <?php if($hasNotification): ?>
        <div class="alert <?php echo $alertType;?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $notification?>
        </div>
        <?php endif; ?>


        <?php if((isset($quota) && $quota=='true') || (isset($update) && $update==true)):?>

        <?php   $this->load->helper('form');
        $attributes = array('class' => 'form-horizontal ');
        if(isset($update) && $update==true){
            $route='panel/emails/update';
        }else{
            $route='panel/emails/create';
        }
        echo form_open($route, $attributes); ?>
        <div class="control-group">
            <div class="controls">
                <p class="text-error"><?php if(isset($errors)){ echo $errors;}?></p>
            </div>
        </div>

        <input type="hidden"  value="<?php  echo $webKey; ?>" name="websiteKey">
        <input type="hidden"  value="<?php if(!empty($data)){ echo $data['pkey'];}?>" name="pkey">



        <div class="control-group">
            <label class="control-label" for="email">Email</label>
            <div class="controls">
                <?php
                $email='';
                if(!empty($data)){
                    $email=explode('@',$data['email']);
                    if(!empty($email)){
                        $email=$email[0];
                    }
                }
                ?>
                <input class="input-xlarge"  type="text" value="<?php echo $email; ?>"  name="email" id="email" placeholder="Desired Email Address">
                <?php
                $url='';
                if(isset($website) && $website['url']!=null){
                    $url=str_replace('http://','',$website['url']);
                    $url=str_replace('https://','',$url);
                    $url=str_replace('//','',$url);
                    $url=str_replace('/','',$url);
                    $url=str_replace('www.','',$url);
                    $url=str_replace('index.php','',$url);
                    echo '@'.$url;
                }
                ?>
            </div>
        </div>
            <input type="hidden" name="domain" value="<?php echo $url; ?>">

        <div class="control-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input class="input-xxlarge"  type="password" value="<?php if(!empty($data)){ echo $data['password'];}?>"  name="password" id="password">
            </div>
        </div>


        <div class="control-group">
            <div class="controls">
                <?php
                if(isset($update) && $update==true){
                    $button="Update";
                }else{
                    $button="Create";
                }
                ?>

                <div class="span9">
                    <button type="submit" class="btn btn-info btn-block"><?php echo $button;?></button>
                </div>
            </div>
        </div>
        </form>
    <?php elseif(isset($quota) && $quota=='quotaFull'):?>

<div class="well">
    <p class="text-center text-warning" align="center">Your email quota is full. Buy more emails.</p>
    <p align="center"> <a class="btn btn-success btn-small" href="<?php echo site_url('panel/emails/order').'/'.$webKey;?>">Buy more Emails</a></p>

</div>
    <?php elseif(isset($quota) && $quota=='noCustomDomain'):?>

        <div class="well">
            <p class="text-center text-warning" align="center">You need to buy custom domain to create an email.</p>
            <p align="center"> <a class="btn btn-success btn-small" href="<?php echo site_url('panel/website/orderCustomDomain').'/'.$webKey;?>">Order a custom Domain</a></p>

        </div>
    <?php endif; ?>

    </div>


    <div class="span3 well">
        <a class="btn btn-block btn-success" href="<?php echo site_url('panel/index/create');?>">Add your Business</a>
        <a class="btn btn-block btn-inverse" href="<?php echo site_url('panel/website/unassListings');?>">Get a Website</a>

        <?php if(!empty($pages)):?>
        </br>
        <ul class="nav nav-tabs nav-stacked">            <?php foreach($pages as $page):?>
            <li><a href="<?php echo site_url('home/page').'/'.$page['pkey'];?>"><?php echo $page['name'];?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>


</div>
</div>



<?php
loadAsset(array('jquery-1.7.1.min.js'=>'script'));
loadBootstrap('script.min') ;
?>


