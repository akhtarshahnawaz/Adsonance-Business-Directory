
<?php
$ci=& get_instance();
$ci->load->library('session');
$type=$ci->session->userdata('type');

if($ci->session->flashdata('notification')){
    $alertType = $ci->session->flashdata('alertType');
    $notification = $ci->session->flashdata('notification');
    $hasNotification=true;
}else{
    $hasNotification=false;
}?>



        <div class="container-fluid">
            <div class="span8 offset1">
                <div class="listing-container">

                    <?php if($hasNotification): ?>
                    <div class="alert <?php echo $alertType;?>">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $notification?>
                    </div>
                    <?php endif; ?>


                    <?php if(!empty($listing)):?>
                    <div class="well">
                        <div class="imageContainer span4 pull-left">
                            <img alt="" src="<?php echo base_url().'uploads/'.$listing['image'];?>" class="img-polaroid" width="200px">
                        </div>
                        <div class="contentContainer span8 pull-right">

                            <?php if($listing['status']>0 && $listing['status']<=500): ?>
                            <img class="pull-right" src="<?php echo base_url().'assets/images/badges/verified.png';?>" />
                            <?php elseif($listing['status']>500 && $listing['status']<=1000): ?>
                            <img class="pull-right" src="<?php echo base_url().'assets/images/badges/trustable.png';?>" />
                            <?php elseif($listing['status']>1000 && $listing['status']<=2000): ?>
                            <img class="pull-right" src="<?php echo base_url().'assets/images/badges/sponsored.png';?>" />
                            <?php elseif($listing['status']>2000): ?>
                            <img class="pull-right" src="<?php echo base_url().'assets/images/badges/premium.png';?>" />
                            <?php endif; ?>

                            <?php if(isset($friendlyUrl)):?>
                            <a href="<?php echo site_url('home/single').'/'.$listing['pkey'];?>"><h3><?php echo $listing['name'];?></h3></a
                            <?php else: ?>
                            <a href="<?php echo site_url('business').'/'.$listing['slug'];?>"><h3><?php echo $listing['name'];?></h3></a
                            <?php endif; ?>

                            <p><?php echo $listing['excerpt'];?></p>
                            <ul class="muted" style="list-style-type: none;">
                                <?php
                                $street='';
                                $locality='';
                                $city='';
                                $pincode='';
                                $country='';
                                if($listing['street']!=''){
                                    $street=$listing['street'].' , ';
                                }

                                if($listing['locality']!=''){
                                    $locality=$listing['locality'].' , ';
                                }

                                if($listing['city']!=''){
                                    $city=$listing['city'];
                                }

                                if($listing['pincode']!=''){
                                    $pincode='-'.$listing['pincode'];
                                }
                                if($listing['country']!=''){
                                    $country='</br>'.$listing['country'];
                                }

                                ?>
                                <li><i class="icon-home"></i> <?php echo $street.$locality.$city.$pincode.$country;?></li>
                                <?php if($listing['phone'] !=''):?><li><i class="icon-book"></i> <?php echo $listing['phone'];?></li><?php endif; ?>
                                <?php if($listing['website'] !=''):?><li><i class="icon-globe"></i> <?php echo $listing['website'];?></li><?php endif; ?>
                            </ul>
                            <p>
                                <a data-target="#sendMessage" href="<?php echo site_url('home/sendmessage').'/'.$listing['pkey'];?>" role="button" data-toggle="modal" class="btn btn-mini btn-info" href=""><i class="icon-edit"></i>  Email me</a>

                                <?php if($this->session->userdata('type')=='admin'):?>
                                <a href="<?php echo site_url('admin/users/view').'/'.$listing['login_pkey'];?>" class="btn btn-mini btn-warning"><i class="icon-list-alt"></i> View User </a>
                                <a href="<?php echo site_url('admin/listing/edit').'/'.$listing['pkey'];?>" class="btn btn-mini btn-primary"><i class="icon-list-alt"></i> Edit </a>
                                <a href="<?php echo site_url('admin/listing/deleteListing').'/'.$listing['pkey'];?>" class="btn btn-mini btn-danger"><i class="icon-trash"></i> Delete </a>
                                <?php endif; ?>
                            </p>

                        </div>
                        <div class="clearfix"></div>
                        <p>
                            <?php echo $listing['description'];?>
                        </p>


                        <?php
                        $directory=$this->config->item('customerImageUploadDirectory').$listing['pkey'];
                        $images = glob($directory.'/images/'."*.{png,jpg,jpeg,gif,PNG,JPG,JPEG,GIF}", GLOB_BRACE);
                        ?>


                        <ul class="thumbnails">
                            <?php foreach($images as $image): ?>

                            <li class="span4">
                                <div class="thumbnail">
                                    <?php $image=str_replace($directory.'/images/','',$image);?>
                                    <a href="<?php echo base_url().$directory.'/images/'.$image; ?>" data-lightbox="lightbox">
                                        <img   src="<?php echo base_url().$directory.'/.thumbs/images/'.$image; ?>" data-src="holder.js/260x180" alt="" />
                                    </a>
                                </div>
                            </li>
                            <?php endforeach; ?>


                        </ul>


                    </div>
                    <?php endif;?>

                </div>
            </div>

            <!-- Modal Start -->
            <div id="sendMessage" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Send Message</h3>
                </div>
                <div class="modal-body">

                </div>
            </div>
            <!-- Modal End -->


            <?php
            loadAsset(array('jquery-1.7.1.min.js'=>'script'));
            loadBootstrap('script.min');
            ?>
            <script type="text/javascript" src="<?php echo linkAsset('scripts/lightbox/js/lightbox-2.6.min.js')?>"></script>
            <link href="<?php echo linkAsset('scripts/lightbox/css/lightbox.css')?>"  rel="stylesheet" type="text/css" media="screen">


