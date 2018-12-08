<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php echo site_url('');?>"><img src="<?php linkAsset('images/logo.png'); ?>"  width="120px" height="50px"/></a>
            <div class="nav-collapse collapse">
                <?php   $this->load->helper('form');
                $attributes = array('class' => 'navbar-search offset3','method'=>'GET');
                echo form_open('admin/users/search', $attributes); ?>
                       <input type="text" name='search' class="search-query input-xxlarge" placeholder="Search Users">
                </form>
                <a href="<?php echo site_url('index/logout'); ?>" class="btn btn-mini btn-danger pull-right">Logout</a>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
