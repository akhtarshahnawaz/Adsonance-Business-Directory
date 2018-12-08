<div class="span3 well">
<?php 
if($this->session->userdata('loggedIn')){
	if($this->session->userdata('type')=='general'){
		$addBusinessLink='panel/index/create';
        $addWebsiteLink='panel/website/unassListings';
    }else{
        $addBusinessLink='admin/listing/create';
        $addWebsiteLink='admin/listing/index';
    }
}else{
    $addBusinessLink='index/register';
    $addWebsiteLink='index/register';
}
?>
    <a class="btn btn-block btn-success" href="<?php echo site_url($addBusinessLink);?>">Add your Business</a>
    <a class="btn btn-block btn-inverse" href="<?php echo site_url($addWebsiteLink);?>">Get a Website</a>


    </br>
    <?php if(!empty($pages)):?>
    <ul class="nav nav-tabs nav-stacked">
        <?php foreach($pages as $page):?>
        <li><a href="<?php echo site_url('home/page').'/'.$page['pkey'];?>"><?php echo $page['name'];?></a></li>
        <?php endforeach; ?>
                <li><a href="<?php echo site_url('index/contactUs'); ?>">Contact Us</a></li>
    </ul>
    <?php endif; ?>
</div>
</div>


</div>
</div>

