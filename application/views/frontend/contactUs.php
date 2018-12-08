<div class="row-fluid" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
     xmlns="http://www.w3.org/1999/html">
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
                    <input type="text" name="city" value="<?php if(isset($city)){ echo $city; }else{ echo $this->input->cookie('city');}?>"  class="input-block-level" placeholder="City">
                </div>
                <div class="span1"><button type="submit" class="btn btn-block btn-primary">Search</button></div>
                <div class="span1"></div>
                </form>
            </div>
        </div>
        <div class="container-fluid">
            <div class="span8 offset1">

                <?php if($hasNotification): ?>
                <div class="alert <?php echo $alertType;?>">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $notification?>
                </div>
                <?php endif; ?>


                <?php   $this->load->helper('form');
                $attributes = array('class' => 'form-horizontal well');

                echo form_open('index/contactUs', $attributes); ?>
                <p class="lead" align="center">Contact Form</p>


                <div class="control-group">
                    <label class="control-label" for="inputName">Name</label>
                    <div class="controls">
                        <input type="text" class="input-block-level"  name="name" id="inputName" placeholder="Full Name">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                        <input type="email" class="input-block-level"  name="email" id="email" placeholder="Email Address">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="phone">Phone</label>
                    <div class="controls">
                        <input type="text" class="input-block-level"  name="phone" id="phone" placeholder="Phone Number">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="phone">Address</label>
                    <div class="controls">
                        <input type="text" class="input-block-level"  name="address" id="address" placeholder="Address">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="message">Message</label>
                    <div class="controls">
                        <textarea class="input-block-level" name="message" id="message"></textarea>
                    </div>
                </div>



                <div class="control-group">
                    <div class="controls">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info btn-block">Send Message</button>
                    </div>
                </div>
                </form>


            </div>

            <div class="span3 well">
                <p><?php echo $this->config->item('contactFormMessage');?></p>
            </div>
        </div>


    </div>
</div>


<?php
loadAsset(array('jquery-1.7.1.min.js'=>'script'));
loadBootstrap('script.min') ;
?>