<div class="span8">
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

    <a class="btn btn-primary btn-small pull-right" href="<?php echo site_url('admin/index/regenerateSitemap');?>">Regenerate Sitemap</a>

<p class="lead text-center">Statistics</p>
    <table class="table table-bordered table-condensed table-striped">
        <?php  if(!empty($counts)):  ?>

        <tbody>
        <tr>
            <th>Total Users</th>
            <td><?php echo $counts['totalUsers']; ?></td>
        </tr>
        <tr>
            <th>Total Listings</th>
            <td><?php echo $counts['totalListings']; ?></td>
        </tr>
        <tr>
            <th>Total Categories</th>
            <td><?php echo $counts['totalCategories']; ?></td>
        </tr>
        <tr>
            <th>Total Pages</th>
            <td><?php echo $counts['totalPages']; ?></td>
        </tr>
        </tbody>
        <?php  endif; ?>
    </table>

</div>
</div>