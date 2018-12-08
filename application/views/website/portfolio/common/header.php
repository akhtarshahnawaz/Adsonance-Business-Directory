<?php
$ci=& get_instance();
$ci->load->library('session');
?>



<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
            <?php if(isset($logo) && $logo!=''):?>
            <a  style="max-height: 40px ; margin: 0px; padding: 0px;"  class="navbar-brand" href="<?php if(isset($url)){ echo $url; }?>"><img src="<?php if(isset($logo)){ echo base_url().$this->config->item('LogoUploadDirectory').$logo; }?>" style="max-height: 36px ; margin: 2px; padding: 0px; " /></a>

            <?php else: ?>
            <a  style="max-height: 40px ; margin: 0px; padding: 0px;"  class="navbar-brand" href="<?php if(isset($url)){ echo $url; }?>"><?php if(isset($websiteName)){ echo $websiteName; }?></a>
            <?php endif; ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <?php if(!empty($pages)):?>
            <ul class="nav navbar-nav navbar-right">
                <?php foreach($pages as $page):?>
                <?php if(isset($bySlug) && $bySlug==true): ?>
                    <li><a href="<?php echo site_url('website').'/'.$websiteSlug.'/'.$page['pkey'];?>"><?php if(isset($page['name'])){ echo $page['name']; }?></a></li>
                    <?php else: ?>
                    <li><a href="<?php echo site_url('pid').'/'.$websiteKey.'/'.$page['pkey'];?>"><?php if(isset($page['name'])){ echo $page['name']; }?></a></li>
                    <?php endif; ?>

                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>