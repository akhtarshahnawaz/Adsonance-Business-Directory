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
    }

    if($hasNotification):

        ?>
        <div class="alert <?php echo $alertType;?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $notification?>
        </div>
        <?php endif; ?>
    <h2 align="center">Add Slideshow Images</h2>
    <p class="text-warning" align="center">
        Images must be of same size and in png or jpg format. Also make sure that images are close to size: 1200 X 350 pixels
    </p>

    <div id="kcfinder"></div>
    <iframe  class="well span11" height="500px" src="<?php echo linkAsset('scripts/kcfinder/browse.php');?>"></iframe>

</div>
</div>

