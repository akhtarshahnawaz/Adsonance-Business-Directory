<div class="span9">
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

    <?php if(!isset($noWebsite) || $noWebsite!=true):?>

    <div class="btn-group">
        <a class="btn btn-primary btn-small" href="<?php echo site_url('admin/website/edit').'/'.$pkey;?>">Edit Website</a>
        <a class="btn btn-danger btn-small" href="<?php echo site_url('admin/website/deleteWebsite').'/'.$listing_pkey;?>">Delete Website</a>
    </div>

    <div class="btn-group">
        <a class="btn btn-success btn-small" href="<?php echo site_url('admin/emails/create').'/'.$pkey;?>">Create Email</a>
        <a class="btn btn-warning btn-small" href="<?php echo site_url('admin/emails/manage').'/'.$pkey;?>">Manage Emails</a>
    </div>

    <div class="btn-group pull-right">
        <a class="btn btn-success btn-small" href="<?php echo site_url('admin/webpage/create').'/'.$pkey;?>">Add Page</a>
        <a class="btn btn-warning btn-small" href="<?php echo site_url('admin/webpage/index').'/'.$pkey;?>">Manage Pages</a>
        <a class="btn btn-primary btn-small" href="<?php echo site_url('admin/webpage/slideshow').'/'.$pkey;?>">Slideshow</a>

    </div>

    </br></br>
    <table class="table table-bordered table-condensed table-striped">
        <tr>
            <th>Website Name</th>
            <td><?php if(isset($name)){ echo $name;}?></td>
        </tr>
        <tr>
            <th>Slug</th>
            <td><a target="_blank" class="btn btn-mini btn-primary" href="<?php if(isset($slug)){ echo site_url('website').'/'.$slug;}?>">Visit Website</a></td>
        </tr>
        <tr>
            <th>Domain Name</th>
            <td><?php if(isset($url)){ echo $url;}?></td>
        </tr>
        <tr>
            <th>Max Pages</th>
            <td><?php if(isset($maxPages)){ echo $maxPages;}?></td>
        </tr>
        <tr>
            <th>Max Emails</th>
            <td><?php if(isset($maxEmails)){ echo $maxEmails;}?> </td>
        </tr>
        <tr>
            <th>Admin Email</th>
            <td><?php if(isset($email)){ echo $email;}?></td>
        </tr>
        <tr>
            <th>Logo</th>
            <td><img src="<?php if(isset($logo)){  echo base_url().$this->config->item('LogoUploadDirectory').$logo;}  ?>" /></td>
        </tr>
        <tr>
            <th>Favicon</th>
            <td><img src="<?php if(isset($favicon)){  echo base_url().$this->config->item('FaviconUploadDirectory').$favicon;}  ?>" /></td>
        </tr>
        <tr>
        <th>Template</th>
        <td><?php if(isset($template)){ echo $template;}?></td>
        </tr>
        <tr>
            <th>Facebook URL</th>
            <td><?php if(isset($facebook)){ echo $facebook;}?></td>
        </tr>
        <tr>
            <th>Twitter URL</th>
            <td><?php if(isset($twitter)){ echo $twitter;}?></td>
        </tr>
        <tr>
            <th>Google+ URL</th>
            <td><?php if(isset($googlePlus)){ echo $googlePlus;}?></td>
        </tr>
        <tr>
            <th>LinkedIn URL</th>
            <td><?php if(isset($linkedIn)){ echo $linkedIn;}?></td>
        </tr>
        <tr>
            <th>Youtube URL</th>
            <td><?php if(isset($youtube)){ echo $youtube;}?></td>
        </tr>
    </table>

    <?php else: ?>

    <div class="well">
        </br></br>
        <p class="text-warning" align="center">
            You haven't added a Website for this listing yet.
        </p>
        <p align="center">
            <a class="btn btn-success btn-small" href="<?php echo site_url('admin/website/create').'/'.$listing_key;?>">Setup a Website Now</a>
        </p>
        </br></br>
    </div>
    <?php endif; ?>


</div>
</div>