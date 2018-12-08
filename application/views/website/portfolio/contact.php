<div class="container">
    <div class="row">
        </br>
        <div class="span8 well">
            <p align="center" class="lead">Contact Form</p>
            <?php
            $ci=& get_instance();
            $ci->load->library('session');

            if($ci->session->flashdata('notification')){
                $alertType = $ci->session->flashdata('alertType');
                $notification = $ci->session->flashdata('notification');
                $hasNotification=true;
            }else{
                $hasNotification=false;
            }

            if($hasNotification):

                ?>
                <div class="alert <?php echo $alertType;?>">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $notification?>
                </div>
                <?php endif; ?>


            <?php   $this->load->helper('form');
            $attributes = array('class' => 'form-horizontal');
            $route='website/contactForm';
            echo form_open($route, $attributes); ?>

            <input name="website_key" value="<?php if(isset($websiteKey)){ echo $websiteKey; } ?>" type="hidden">

            <div class="control-group">
                <label class="control-label" for="name">Full Name</label>
                <div class="controls">
                    <input class="input-block-level" type="text" value="<?php if(!empty($data)){ echo $data['twitter'];}?>"  name="name" id="name" placeholder="Full Name">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="phone">Phone</label>
                <div class="controls">
                    <input class="input-block-level" type="text" value="<?php if(!empty($data)){ echo $data['twitter'];}?>"  name="phone" id="phone" placeholder="Phone">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="email">Email</label>
                <div class="controls">
                    <input class="input-block-level" type="email" value="<?php if(!empty($data)){ echo $data['email'];}?>"  name="email" id="email" placeholder="Email Address">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="address">Address</label>
                <div class="controls">
                    <input class="input-block-level" type="text" value="<?php if(!empty($data)){ echo $data['address'];}?>"  name="address" id="address" placeholder="Address">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="message">Message</label>
                <div class="controls">
                    <textarea class="input-block-level" type="text" value="<?php if(!empty($data)){ echo $data['message'];}?>"  name="message" id="message" placeholder=""></textarea>
                </div>
            </div>


            <div class="control-group">
                <div class="controls">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info btn-block">Submit</button>
                </div>
            </div>
            </form>


        </div>
        <div class="span3 well">
            <?php if(isset($content)){ echo $content; }?>
        </div>
    </div>
</div><!-- /.container -->








<?php
loadAsset(array('jquery-1.7.1.min.js'=>'script'));
loadBootstrap('script.min') ;

?>
