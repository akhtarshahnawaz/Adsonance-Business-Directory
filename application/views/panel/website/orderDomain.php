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
                <p class="lead" align="center">Order Custom Domain</p>

                <?php if($hasNotification): ?>
                <div class="alert <?php echo $alertType;?>">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $notification?>
                </div>
                <?php endif; ?>



                <?php   $this->load->helper('form');
                $attributes = array('class' => 'form-horizontal ');

                echo form_open('panel/website/orderCustomDomain', $attributes); ?>
                <div class="control-group">
                    <div class="controls">
                        <p class="text-error"><?php if(isset($errors)){ echo $errors;}?></p>
                    </div>
                </div>

                <input type="hidden"  value="<?php echo $this->session->userdata('key');?>" name="userKey">
                <input type="hidden"  value="<?php echo $webKey;?>" name="websiteKey">


                <div class="control-group">
                    <label class="control-label" for="domain">Domain Name</label>
                    <div class="controls">
                        <input class="input-xxlarge"  type="text" value=""  name="domain" id="domain" placeholder="Name of Domain">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="message">Message</label>
                    <div class="controls">
                        <textarea class="input-xxlarge"  value=""  name="message" id="message"></textarea>
                    </div>
                </div>


                <div class="control-group">
                    <div class="controls">

                        <div class="span9">
                            <button type="submit" class="btn btn-info btn-block">Send Request</button>
                        </div>
                    </div>
                </div>
                </form>



            </div>


            <div class="span3 well">
                <a class="btn btn-block btn-success" href="<?php echo site_url('panel/index/create');?>">Add your Business</a>
                <a class="btn btn-block btn-inverse" href="<?php echo site_url('panel/website/unassListings');?>">Get a Website</a>

                <?php if(!empty($pages)):?>
                </br>
                <ul class="nav nav-tabs nav-stacked">                    <?php foreach($pages as $page):?>
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


