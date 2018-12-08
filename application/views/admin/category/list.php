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


    <a class="btn btn-primary btn-small pull-right" href="<?php echo site_url('admin/category/create');?>">Create Category</a>
    </br></br>
    <table class="table table-bordered table-condensed table-striped">
        <?php  if(!empty($data)):  ?>
        <thead>
            <tr>
                <td></td>
                <td>Name</td>
                <td>Icon</td>
                <td>Banner</td>
                <td>Description</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $key=>$data):?>
            <tr>
                <td><?php echo ($limit*$page)+$key+1;; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><img src="<?php echo base_url().$this->config->item('categoryIconUploadDirectory').$data['icon']; ?>" width="100px" height="100px" class="img"/></td>
                <td><img src="<?php echo base_url().$this->config->item('categoryBannerUploadDirectory').$data['banner']; ?>" width="200px" class="img"/></td>
                <td><?php echo $data['description']; ?></td>
                <td>
                    <div class="btn-group">
                        <a class="btn btn-primary btn-mini" href="<?php echo site_url('admin/category/edit').'/'.$data['pkey'];?>">Edit</a>
                        <a class="btn btn-danger btn-mini" href="<?php echo site_url('admin/category/deleteCat').'/'.$data['pkey'];?>">Delete</a>
                    </div>
            </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <?php  endif; ?>
    </table>
    <!--
    <table class="table table-bordered table-condensed table-striped">
        <thead>
        <tr>
            <td><a class="btn btn-danger btn-small pull-left" href="<?php echo site_url('admin/category/index').'/'.$limit.'/'.($page-1);?>"><i class="icon-arrow-left"></i> </a>
                <a class="btn btn-danger btn-small pull-right" href="<?php echo site_url('admin/category/index').'/'.$limit.'/'.($page+1);?>">  <i class="icon-arrow-right"></i></a> </td>
        </tr>
        </thead>

    </table>
    -->
</div>
    </div>