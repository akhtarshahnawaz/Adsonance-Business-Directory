<div class="span10 offset1">
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

    <h2 align="center">Manage Pages</h2>

    <div class="btn-group pull-right">
        <?php if(isset($_SERVER['HTTP_REFERER'])): ?>
        <a class="btn btn-inverse btn-small" href="<?php echo $_SERVER['HTTP_REFERER'];?>">Go Back</a>
        <?php endif; ?>
        <a class="btn btn-primary btn-small" href="<?php echo site_url('panel/webpage/create').'/'.$website_pkey;?>">Add Webpage</a>
        <a class="btn btn-warning btn-small" href="<?php echo site_url('panel/website/getMorePages').'/'.$website_pkey;?>">Get more pages</a>

    </div>

    </br></br>
    <table class="table table-bordered table-condensed table-striped">
        <?php  if(!empty($data)):  ?>
        <thead>
        <tr>
            <td></td>
            <td>Name</td>
            <td>Order</td>
            <td>Type</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $key=>$data):?>
        <tr>
            <td><?php echo $key+1;; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $data['order']; ?></td>
            <td><?php echo $data['type']; ?></td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-primary btn-mini" href="<?php echo site_url('panel/webpage/edit').'/'.$data['pkey'];?>">Edit</a>
                    <a class="btn btn-danger btn-mini" href="<?php echo site_url('panel/webpage/deleteWebpage').'/'.$data['pkey'].'/'.$website_pkey;?>">Delete</a>
                </div>
            </td>
        </tr>
            <?php endforeach; ?>
        </tbody>
        <?php  endif; ?>
    </table>



</div>
</div>