
<div class="container" >

    <hr>

    <footer style="margin: 3px; padding: 0px;">
        <div style="margin: 0px; padding: 0px;" class="row">
            <div style="margin: 0px; padding: 0px;" class="col-lg-12">
                <ul style="margin: 0px; padding: 0px;" class="list-unstyled list-inline list-social-icons pull-left">
                    <?php if(isset($facebook) && $facebook!=''):?>
                    <li class="tooltip-social facebook-link"><a title="" data-placement="top" data-toggle="tooltip" href="<?php echo $facebook; ?>" data-original-title="Facebook"><i class="fa fa-facebook-square fa-2x"></i></a></li>
                    <?php endif; ?>

                    <?php if(isset($linkedIn) && $linkedIn!=''):?>
                    <li class="tooltip-social linkedin-link"><a title="" data-placement="top" data-toggle="tooltip" href="<?php echo $linkedIn; ?>" data-original-title="LinkedIn"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
                    <?php endif; ?>

                    <?php if(isset($twitter) && $twitter!=''):?>
                    <li class="tooltip-social twitter-link"><a title="" data-placement="top" data-toggle="tooltip" href="<?php echo $twitter; ?>" data-original-title="Twitter"><i class="fa fa-twitter-square fa-2x"></i></a></li>
                    <?php endif; ?>

                    <?php if(isset($googlePlus) && $googlePlus!=''):?>
                    <li class="tooltip-social google-plus-link"><a title="" data-placement="top" data-toggle="tooltip" href="<?php echo $googlePlus; ?>" data-original-title="Google+"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
                    <?php endif; ?>

                    <?php if(isset($youtube) && $youtube!=''):?>
                    <li class="tooltip-social youtube-link"><a title="" data-placement="top" data-toggle="tooltip" href="<?php echo $youtube; ?>" data-original-title="Youtube"><i class="fa fa-youtube-square fa-2x"></i></a></li>
                    <?php endif; ?>
                </ul>

                <p style="margin: 0px; padding: 0px;" align="center" class="pull-right">Copyright &copy; <?php if(isset($websiteName)){ echo $websiteName; }?></p>

            </div>
        </div>
        <p style="margin: 0px; padding: 0px;" class="clearfix">
            <a href="http://adsonancebusiness.com"> <img class="pull-right" src="<?php echo base_url('assets/images/websitebadge.png');?>" /></a>
        </p>
    </footer>

</div><!-- /.container -->


<!-- JavaScript -->
<?php loadAsset(array('jquery-1.7.1.min.js'=>'script')); ?>
<?php loadBootstrap('script.min')?>

</body>
</html>
