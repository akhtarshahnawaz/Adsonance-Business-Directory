            <?php
            $ci=& get_instance();
            $ci->load->library('session');

            if($ci->session->flashdata('notification')){
                $alertType = $ci->session->flashdata('alertType');
                $notification = $ci->session->flashdata('notification');
                $hasNotification=true;
            }else{
                $hasNotification=false;
            }?>
<div class="image-banner"><div class="banner-image"><img src="<?php echo base_url('assets/webTemplate/default/images/contact-us.jpg')?>" width="960" height="150" alt="contact us banner" /></div></div>
<div class="body-area">
<div class="body-con-area">

<div class="contact-header">
  <h3>

<span>Please fill in the following details and we'll be in touch shortly</span>
</h3>
</div>
<div class="contact-form">

<?php if($hasNotification){
    if($alertType=='alert-success'){
        echo "<h1 style='color: #66cc33' align='center'>".$notification."</h1>";
    }elseif($alertType=='alert-error'){
        echo "<h1 style='color: #66cc33' align='center'>".$notification."</h1>";
    }
} ?>


            <?php   $this->load->helper('form');
            $attributes = array('id' => 'contactform');
            $route='website/contactForm';
            echo form_open($route, $attributes); ?>

            <input name="website_key" value="<?php if(isset($websiteKey)){ echo $websiteKey; } ?>" type="hidden">

          <ol>
            <li>
              <label for="name">Full Name <span class="red">*</span></label>
              <input class="text" name="name" id="name" value="<?php if(!empty($data)){ echo $data['name'];}?>" >
            </li>
            <li>
              <label for="phone">Phone <span class="red">*</span></label>
              <input class="text" name="phone" id="phone" value="<?php if(!empty($data)){ echo $data['phone'];}?>">
            </li>
            <li>
              <label for="email">Your email <span class="red">*</span></label>
              <input class="text" name="email" id="email" value="<?php if(!empty($data)){ echo $data['email'];}?>">
            </li>
            <li>
              <label for="address">Address&nbsp;&nbsp;&nbsp;</label>
              <input class="text" name="address" id="company" value="<?php if(!empty($data)){ echo $data['address'];}?>">
            </li>

            <li>
              <label for="message">Message <span class="red">*</span></label>
              <textarea name="message" id="message" style="width: 371px; height: 95px;"><?php if(!empty($data)){ echo $data['message'];}?></textarea>
            </li>
            <li class="buttons">
             <input id="cf-button" name="submit" type="submit" value="Send " />
             <input id="cf-button" name="Reset" type="reset" value="Clear " />
              <div class="clear"></div>
            </li>
          </ol>
        </form>
</div>
<div class="contact-details">
  <h2>Contact Details<br>
    <?php if(isset($content)){ echo $content; }?>
</div>
<div class="clear"></div>


</div>
</div>
</div>
