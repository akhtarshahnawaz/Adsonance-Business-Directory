
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


        <?php if(!empty($categories)):?>
        <ul class="span12 thumbnails">

            <?php foreach($categories as $row): ?>

            <li class="span2" style="margin-left: 0px; margin-right: 10px;">
                <a class="thumbnail" href="<?php echo site_url('home/category').'/'.$row['pkey'];?>">
                    <img src="<?php echo base_url().$this->config->item('categoryIconUploadDirectory').$row['icon']; ?>"  data-src="holder.js/300x200" alt="">
                    <h5 align="center"><b><?php echo $row['name']; ?></b></h5>
                </a>
            </li>

            <?php endforeach; ?>
        </ul>

        <?php endif;?>
    </div>
