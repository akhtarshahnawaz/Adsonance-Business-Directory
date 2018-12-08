
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
        } ?>


        <div class="container-fluid">
            <div class="span8 offset1">

                <?php if($hasNotification): ?>
                <div class="alert <?php echo $alertType;?>">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $notification?>
                </div>
                <?php endif; ?>


                <div class="listing-container">
                    <?php if(!empty($listings)):?>
                    <?php foreach($listings as $row): ?>
                        <div class="ilisting well">
                            <div class="imageContainer span4 pull-left">
                                <img alt="" src="<?php echo base_url().'uploads/'.$row['image'];?>" class="img-polaroid" width="200px">
                            </div>
                            <div class="contentContainer span8 pull-right">


                                <?php if($row['status']>0 && $row['status']<=500): ?>
                                <img class="pull-right" src="<?php echo base_url().'assets/images/badges/verified.png';?>" />
                                <?php elseif($row['status']>500 && $row['status']<=1000): ?>
                                <img class="pull-right" src="<?php echo base_url().'assets/images/badges/trustable.png';?>" />
                                <?php elseif($row['status']>1000 && $row['status']<=2000): ?>
                                <img class="pull-right" src="<?php echo base_url().'assets/images/badges/sponsored.png';?>" />
                                <?php elseif($row['status']>2000): ?>
                                <img class="pull-right" src="<?php echo base_url().'assets/images/badges/premium.png';?>" />
                                <?php endif; ?>

                                <a href="<?php echo site_url('home/single').'/'.$row['pkey'];?>"><h3><?php echo $row['name'];?></h3></a>
                                <p><?php echo $row['excerpt'];?></p>
                                <ul class="muted" style="list-style-type: none;">
                                    <?php
                                    $street='';
                                    $locality='';
                                    $city='';
                                    $pincode='';
                                    $country='';
                                    if($row['street']!=''){
                                        $street=$row['street'].' , ';
                                    }

                                    if($row['locality']!=''){
                                        $locality=$row['locality'].' , ';
                                    }

                                    if($row['city']!=''){
                                        $city=$row['city'];
                                    }

                                    if($row['pincode']!=''){
                                        $pincode='-'.$row['pincode'];
                                    }
                                    if($row['country']!=''){
                                        $country='</br>'.$row['country'];
                                    }

                                    ?>
                                    <li><i class="icon-home"></i> <?php echo $street.$locality.$city.$pincode.$country;?></li>
                                    <?php if($row['phone'] !=''):?><li><i class="icon-book"></i> <?php echo $row['phone'];?></li><?php endif; ?>
                                    <?php if($row['website'] !=''):?><li><i class="icon-globe"></i> <?php echo $row['website'];?></li><?php endif; ?>
                                </ul>
                                <p>
                                    <a data-target="#sendMessage" href="<?php echo site_url('home/sendmessage').'/'.$row['pkey'];?>" role="button" data-toggle="modal" class="btn btn-mini btn-info" href=""><i class="icon-edit"></i>  Email me</a>

                                    <?php if($this->session->userdata('type')=='admin'):?>
                                    <a href="<?php echo site_url('admin/users/view').'/'.$row['login_pkey'];?>" class="btn btn-mini btn-warning"><i class="icon-list-alt"></i> View User </a>
                                    <a href="<?php echo site_url('admin/listing/edit').'/'.$row['pkey'];?>" class="btn btn-mini btn-primary"><i class="icon-list-alt"></i> Edit </a>
                                    <a href="<?php echo site_url('admin/listing/deleteListing').'/'.$row['pkey'];?>" class="btn btn-mini btn-danger"><i class="icon-trash"></i> Delete </a>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>

                        </div>
                        <?php endforeach; ?>
                    <?php endif;?>



                    <div class="pagination">
                        <?php
                        if(isset($totalListings)){
                            $totalPages=$totalListings/$this->config->item('ListingsOnSinglePage');
                        }
                        ?>
                        <?php
                        if($term!=''){
                            $term=urlencode($term).'/';
                        }
                        if($city!=''){
                            $city=urlencode($city).'/';
                        }if($locality!=''){
                        $locality=urlencode($locality).'/';
                    }
                        ?>
                        <ul>
                            <?php if(($page-1)>=0):?>
                            <li><a href="<?php echo site_url('home/search').'/'.($page-1).'/'.$term.$city.$locality;?>">Prev</a></li>
                            <?php endif; ?>
                            <?php for($i=0;$i<$totalPages;$i++):?>
                            <li <?php if($i==$page){ echo 'class="disabled"';}?> ><a href="<?php echo site_url('home/search').'/'.$i.'/'.$term.$city.$locality;?>"><?php echo $i+1 ?></a></li>
                            <?php endfor; ?>
                            <?php if(($page+1)<$totalPages):?>

                            <li><a href="<?php echo site_url('home/search').'/'.($page+1).'/'.$term.$city.$locality;?>">Next</a></li>
                            <?php endif; ?>

                        </ul>
                    </div>
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
loadBootstrap('script.min') ;
?>