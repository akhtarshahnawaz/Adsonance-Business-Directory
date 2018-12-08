<style type="text/css">

    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
    }


</style>

<body>

<div class="container">
    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-signin');
    echo form_open('index/login', $attributes); ?>
    <p align="center" style="margin: 10px; padding: 10px;"><a href="<?php echo site_url('');?>"><img src="<?php assetLink(array('logoBlack.png'=>'image')); ?>"/></a></p>

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



        <input type="text" name="email" class="input-block-level" placeholder="Email address">
        <input type="password" name="password" class="input-block-level" placeholder="Password">

        <button class="btn btn-block btn-large btn-info" type="submit"> <i class="icon-lock"></i> Login</button>
    <p class="pull-right"><a href="<?php echo site_url('index/resetPassword')?>" class="text-warning">Forgot Password ?</a></p>

    </form>

</div> <!-- /container -->
