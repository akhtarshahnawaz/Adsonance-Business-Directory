<?php
$ci=& get_instance();
$ci->load->library('session');
$type=$ci->session->userdata('type');
?>
    <div class="row-fluid">
    <div class="span3">
        <ul class="nav nav-tabs nav-stacked">
            <li><a href="<?php echo site_url('admin/index/index'); ?>"><i class="icon-chevron-right"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/category/index'); ?>"><i class="icon-chevron-right"></i> Categories</a></li>
            <li><a href="<?php echo site_url('admin/listing/index'); ?>"><i class="icon-chevron-right"></i> Listings</a></li>
            <li><a href="<?php echo site_url('admin/users/index'); ?>"><i class="icon-chevron-right"></i> Users</a></li>
            <li><a href="<?php echo site_url('admin/page/index'); ?>"><i class="icon-chevron-right"></i> Pages</a></li>
            <li><a href="<?php echo site_url('admin/emails/index'); ?>"><i class="icon-chevron-right"></i>Emails</a></li>
            <li><a href="<?php echo site_url('admin/order/ordersRequest'); ?>"><i class="icon-chevron-right"></i>Requests</a></li>


        </ul>
    </div>