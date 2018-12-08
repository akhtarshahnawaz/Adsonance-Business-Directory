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





    <?php
    if(isset($listing_key)){
        $listing_key=$listing_key;
    }else{
        $listing_key='';
    }
    ?>


    <?php if(isset($website) && $website['url']!=null):?>
    <div class="btn-group">
        <?php if(isset($_SERVER['HTTP_REFERER'])): ?>
        <a class="btn btn-inverse btn-small" href="<?php echo $_SERVER['HTTP_REFERER'];?>">Go Back</a>
        <?php endif; ?>
        <a class="btn btn-warning btn-small" href="<?php echo site_url('panel/emails/order').'/'.$webKey;?>">Order more Emails</a>

    </div>
    <div class="btn-group pull-right">
        <a class="btn btn-success btn-small" href="<?php echo site_url('panel/emails/create').'/'.$webKey;?>">Add Email</a>
    </div>

    </br></br>
    <?php if(isset($data) && !empty($data)):?>

        <div class="well">
            <table class="table table-bordered table-condensed table-striped">
                <thead>
                <th></th>
                <th>Email ID</th>
                <th>Status</th>
                <th></th>
                </thead>
                <tbody>
                    <?php foreach($data as $key=>$row):?>

                    <tr class="<?php if($row['status']==0){ echo 'warning';}elseif($row['status']==1){ echo 'success';} ?>">
                        <th><?php echo $key+1; ?></th>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php if($row['status']==0){ echo 'Pending '.$row['type'];}elseif($row['status']==1){ echo 'Running OK';} ?></td>
                        <td>
                            <div class="btn-group ">
                                <?php if($row['status']==1):?>
                                <a target="_blank" class="btn btn-mini btn-success" href="<?php echo $this->config->item('webmailAddress');?>">Access Mail</a>
                                <?php endif; ?>
                                <a class="btn btn-mini btn-primary" href="<?php echo site_url('panel/emails/update/').'/'.$row['pkey'];?>">Edit</a>
                                <a class="btn btn-mini btn-danger" href="<?php echo site_url('panel/emails/deleteEmail/').'/'.$row['pkey'].'/'.$webKey;?>">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php else: ?>

        <div class="well">
            </br></br>
            <p class="text-warning" align="center">
                You haven't created any email till now.
            </p>
            <p align="center">
                <a class="btn btn-success btn-small" href="<?php echo site_url('panel/emails/create').'/'.$webKey;?>">Create an Email Now</a>
            </p>
            </br></br>
        </div>
        <?php endif; ?>
    <?php else: ?>
    <div class="well">
        <p class="text-center text-warning" align="center">You need to buy custom domain to create an email.</p>
        <p align="center"> <a class="btn btn-success btn-small" href="<?php echo site_url('panel/website/orderCustomDomain').'/'.$webKey;?>">Order a custom Domain</a></p>

    </div>
    <?php endif; ?>



</div>
</div>