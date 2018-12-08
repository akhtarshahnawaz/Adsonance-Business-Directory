<style>
    body {
        padding-top: 40px;
    }
</style>

<?php
$directory=$this->config->item('SlideshowImageUploadDirectory').$websiteKey;
$images = glob($directory.'/images/'."*.{png,jpg,jpeg,gif,PNG,JPG,JPEG,GIF}", GLOB_BRACE);
?>
<?php if(!empty($images)):?>
<div id="myCarousel" class="carousel slide">
    <!-- Carousel items -->
    <div class="carousel-inner">
        <?php foreach($images as $key=>$image): ?>
        <div class="<?php if($key==0){echo 'active';}?> item">
            <?php $image=str_replace($directory.'/images/','',$image);?>

            <img src="<?php echo base_url().$directory.'/images/'.$image; ?>" class="img"/>
        </div>
        <?php endforeach; ?>


    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>
<?php endif; ?>



<div class="container">
    <hr>

    <div class="row">
        <?php if(isset($content)){ echo $content; }?>
    </div><!-- /.row -->

</div><!-- /.container -->
