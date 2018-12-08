<?php
$ci=& get_instance();
$ci->load->library('session');
?>

<div class="main">
<div class="header-area">
<div class="header">
<div class="logo-area">
            <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
            <?php if(isset($logo) && $logo!=''):?>
            <a  style="max-height: 60px ;"  class="logo" href="<?php if(isset($url)){ echo $url; }?>"><img src="<?php if(isset($logo)){ echo base_url().$this->config->item('LogoUploadDirectory').$logo; }?>" style="max-height: 60px ; margin: 10px; padding: 0px; " /></a>

            <?php else: ?>
            <a  style="max-height: 60px ; color: #fff; font-size: 24px;"  class="logo" href="<?php if(isset($url)){ echo $url; }?>"><?php if(isset($websiteName)){ echo $websiteName; }?></a>
            <?php endif; ?>
</div>

<div class="menu"><ul>
                    <?php if(isset($facebook) && $facebook!=''):?>
                        <li>
                            <a href="<?php echo $facebook; ?>"><img src="<?php echo base_url('assets/webTemplate/default/images/social/facebook.png')?>" /></a>
                        </li>
                    <?php endif; ?>

                    <?php if(isset($linkedIn) && $linkedIn!=''):?>
                        <li>
                            <a href="<?php echo $linkedIn; ?>"><img src="<?php echo base_url('assets/webTemplate/default/images/social/linkedin.png')?>" /></a>
                        </li>
                    <?php endif; ?>

                    <?php if(isset($twitter) && $twitter!=''):?>
                        <li>
                            <a href="<?php echo $twitter; ?>"><img src="<?php echo base_url('assets/webTemplate/default/images/social/twitter.png')?>" /></a>
                        </li>
                    <?php endif; ?>

                    <?php if(isset($googlePlus) && $googlePlus!=''):?>
                        <li>
                            <a href="<?php echo $googlePlus; ?>"><img src="<?php echo base_url('assets/webTemplate/default/images/social/gplus2.png')?>" /></a>
                        </li>
                    <?php endif; ?>

                    <?php if(isset($youtube) && $youtube!=''):?>
                        <li>
                            <a href="<?php echo $youtube; ?>"><img src="<?php echo base_url('assets/webTemplate/default/images/social/youtube.png')?>" /></a>
                        </li>
                    <?php endif; ?>

</ul></div>




</div>
<div class="clear"></div>
</div>




<!-- SUBMENU-->
<div class="sub-menu-area">
<div class="submenu">
<div class="menu2"><ul>

<?php if(!empty($pages)):?>
    <?php foreach($pages as $page):?>
        <li>
            <?php if(isset($bySlug) && $bySlug==true): ?>
                <a href="<?php echo site_url('website').'/'.$websiteSlug.'/'.$page['pkey']; ?>">
                <span><?php if(isset($page['name'])){ echo $page['name']; }?></span>
                </a>
            <?php else: ?>
                <a href="<?php echo site_url('pid').'/'.$websiteKey.'/'.$page['pkey'];?>">
                <span><?php if(isset($page['name'])){ echo $page['name']; }?></span>
                </a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
</ul></div>
    <div class="clear"></div>
  </div>
</div>
