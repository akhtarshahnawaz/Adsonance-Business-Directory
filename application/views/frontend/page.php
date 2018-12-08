
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



<div class="container-fluid">
    <div class="span8 offset1">

        <?php if($hasNotification): ?>
        <div class="alert <?php echo $alertType;?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $notification?>
        </div>
        <?php endif; ?>


        <?php if(!empty($page)):?>
        <div class="span12 thumbnails">
            <h1 class="lead" align="center"><?php echo $page['name'];?></h1>
            <div class="content">
                <?php echo $page['content'];?>
            </div>
        </div>

        <?php endif;?>
    </div>
