<div class="footer-area">
<div class="footer">
<div class="left-p">
Copyright &copy; <?php if(isset($websiteName)){ echo $websiteName; }?><br>
<!-- SUBMENU-->
<div class="footer-menu">
<ul>

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
</ul>
</div>
</div>


<style type="text/css">
.footer-menu{
    float: left;
}
.footer-menu ul{
    list-style-type: none;
    float: left;
    margin-left: -30px;
}
.footer-menu ul li{
    float: left;
}
</style>

<div class="right-p" style="float: right; width: 50px;">
        <a href="http://adsonancebusiness.com"> <img class="pull-right" src="<?php echo base_url('assets/images/websitebadge.png');?>" /></a>
</div>

<div class="clear"></div>
</div>
</div>
</body>
</html>



