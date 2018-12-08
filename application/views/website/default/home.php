<?php
$directory=$this->config->item('SlideshowImageUploadDirectory').$websiteKey;
$images = glob($directory.'/images/'."*.{png,jpg,jpeg,gif,PNG,JPG,JPEG,GIF}", GLOB_BRACE);
?>


<?php if(!empty($images)):?>
<div class="slideshow-area">
<div class="slideshow">
<div id="s3slider">
   <ul id="s3sliderContent">
        <?php foreach($images as $key=>$image): ?>
            <li class="s3sliderImage">
                <?php $image=str_replace($directory.'/images/','',$image);?>
                <img src="<?php echo base_url().$directory.'/images/'.$image; ?>" />
                <span></span>
            </li>
        <?php endforeach; ?>
      
      <div class="clear s3sliderImage"></div>
   </ul>
</div> 
</div>
</div>
<?php endif; ?>


<div class="clientlist-area">
<div class="clientlist"></div>
</div>
<div class="body-area">
<div class="body-con-area">
<div class="homepage-con">


    <?php if(isset($content)){ echo $content; }?>
</div>
</div>
</div>
</div>