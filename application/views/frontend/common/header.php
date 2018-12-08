<?php
$ci=& get_instance();
$ci->load->library('session');
?>

<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">

        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <?php if($ci->session->userdata('type')=='general'):?>
            <a class="brand" href="<?php echo site_url('');?>"><img src="<?php linkAsset('images/logo.png'); ?>"  width="120px" height="50px"/></a>
            <?php endif; ?>

            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php if($ci->session->userdata('type')=='general'):?>
                    <li class="active"><a href="<?php echo site_url('home/index');?>">Home</a></li>
                    <li class="active"><a href="<?php echo site_url('panel/index/create');?>">Add Listing</a></li>
                    <li class="active"><a href="<?php echo site_url('panel/index');?>">Your Listings</a></li>
                    <li class="active"><a href="<?php echo site_url('panel/website/unassListings');?>">Create a Website</a></li>
                    <li class="active"><a href="<?php echo site_url('panel/website/index');?>">Manage Website</a></li>
                    <li class="active"><a href="<?php echo site_url('panel/emails/index');?>">Emails</a></li>
                    <li class="active"><a href="<?php echo site_url('panel/index/orders');?>">My Orders</a></li>

                    <?php endif; ?>
                </ul>
                <div class="btn-group pull-right">
                    <?php if(!$ci->session->userdata('loggedIn')):?>
                    <a href="<?php echo site_url('index/register'); ?>" class="btn btn-mini btn-primary">Register</a>
                    <a href="<?php echo site_url('index/login'); ?>" class="btn btn-mini btn-primary">Login</a>
                    <?php else:?>
                    <?php if($ci->session->userdata('type')!='general'):?>
                        <a href="<?php echo site_url('admin/index'); ?>" class="btn btn-mini btn-primary">Dashboard</a>
                        <?php endif; ?>
                    <a href="<?php echo site_url('index/logout'); ?>" class="btn btn-mini btn-danger">Logout</a>
                    <?php endif; ?>
                </div>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="row-fluid" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

