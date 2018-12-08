<?php
$totalListingsWithNoWebsite=0;
?>
<div class="row-fluid" xmlns="http://www.w3.org/1999/html">
    <div class="span12">
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



        <div class="row-fluid">
            <div class="span1"></div>
            <div class="span3"> </div>
            <div class="span3"><a href="<?php echo site_url();?>"> <img src="<?php linkAsset('images/logoBlack.png'); ?>"  width="500px" height="100px"/></a></div>
            <div class="span3"></div>
            <div class="span1"></div>
        </div>
        </br></br>

        <div class="row-fluid">
            <div class="well">
                <?php   $this->load->helper('form');
                $attributes = array('class' => 'form-horizontal','method'=>'get');
                $route='home/search';
                echo form_open($route, $attributes); ?>
                <div class="span1"><input type="hidden" name="page" value="0"></div>
                <div class="span6"><input type="text" name="term" value="<?php if(isset($term)){ echo $term; }?>" class="input-block-level" placeholder="Search anything"> </div>
                <div class="span2">
                    <input type="text" name="locality" value="<?php if(isset($locality)){ echo $locality; }?>" class="input-block-level" placeholder="Locality">
                </div>
                <div class="span1">
                    <input type="text" name="city" value="<?php if(isset($city)){ echo $city; }?>"  class="input-block-level" placeholder="City">
                </div>
                <div class="span1"><button type="submit" class="btn btn-block btn-primary">Search</button></div>
                <div class="span1"></div>
                </form>
            </div>
        </div>
        <div class="container-fluid">
            <div class="span8 offset1 well">

                <?php if($hasNotification): ?>
                <div class="alert <?php echo $alertType;?>">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $notification?>
                </div>
                <?php endif; ?>
                <p class="lead" align="center">Select a listing to create website</p>


                <table class="table table-bordered table-condensed table-striped">
                    <?php  if(!empty($data)):  ?>
                    <thead>
                    <tr>
                        <td></td>
                        <td>Name</td>
                        <td>Phone</td>
                        <td>Email</td>
                        <td>Website</td>
                        <td>Address</td>
                        <td>Short Description</td>

                        <td></td>
                    </tr>
                    </thead>
                    <tbody>

                        <?php foreach($data as $key=>$data):?>
                        <?php if(isset($data['webKey']) && $data['webKey']!=null):?>
                            <?php else: ?>
                            <?php $totalListingsWithNoWebsite+=1; ?>
                        <tr>
                            <td><?php echo ($this->config->item('ListingsOnSinglePage')*$page)+$key+1;; ?></td>
                            <td><?php echo $data['name']; ?></td>
                            <td><?php echo $data['phone']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['website']; ?></td>
                            <?php
                            $street='';
                            $locality='';
                            $city='';
                            $pincode='';
                            $country='';
                            if($data['street']!=''){
                                $street=$data['street'].' , ';
                            }

                            if($data['locality']!=''){
                                $locality=$data['locality'].' , ';
                            }

                            if($data['city']!=''){
                                $city=$data['city'];
                            }

                            if($data['pincode']!=''){
                                $pincode='-'.$data['pincode'];
                            }
                            if($data['country']!=''){
                                $country='</br>'.$data['country'];
                            }

                            ?>
                            <td><?php echo $locality.$city.$pincode; ?></td>
                            <td><?php echo substr($data['excerpt'],0,30); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-success btn-mini" href="<?php echo site_url('panel/website/create').'/'.$data['pkey'];?>">Create Website</a>
                                </div>
                            </td>
                        </tr>
                            <?php endif; ?>

                        <?php endforeach; ?>

                        <?php if($totalListingsWithNoWebsite==0):?>
                    <table  class="table table-bordered table-condensed table-striped">
                        <tr>
                            <td>
                                <p align="center" class="text-warning">All your listings are associated with websites.</p>
                                <p align="center"> <a href="<?php echo site_url('panel/website/index');?>" class="btn btn-warning">Manage Websites</a></p>
                                <p align="center"> <a href="<?php echo site_url('panel/index/create');?>" class="btn btn-success">Create a new business listing to create website</a></p>


                            </td>
                        </tr>
                    </table>
                        <?php endif; ?>

                    </tbody>
                    <?php else:?>
                    <div class="alert alert-block">
                        <h4 align="center">Hello!</h4>
                        <p align="center">You need to create a Business Listing before creating a Website. Click below to create a business listing.</p>
                        <p align="center"> <a href="<?php echo site_url('panel/index/create');?>" class="btn btn-success">Create a Listing Now</a></p>
                    </div>
                    <?php  endif; ?>
                </table>
                <div class="pagination">
                    <?php
                    if(isset($totalListings)){
                        $totalPages=$totalListings/$this->config->item('ListingsOnSinglePage');
                    }
                    ?>
                    <ul>
                        <?php if(($page-1)>=0):?>
                        <li><a href="<?php echo site_url('panel/index/index').'/'.($page-1);?>">Prev</a></li>
                        <?php endif; ?>
                        <?php for($i=0;$i<$totalPages;$i++):?>
                        <li <?php if($i==$page){ echo 'class="disabled"';}?> ><a href="<?php echo site_url('panel/index/index').'/'.$i;?>"><?php echo $i+1 ?></a></li>
                        <?php endfor; ?>
                        <?php if(($page+1)<$totalPages):?>

                        <li><a href="<?php echo site_url('panel/index/index').'/'.($page+1);?>">Next</a></li>
                        <?php endif; ?>

                    </ul>
                </div>


            </div>

            <div class="span3 well">
                <a class="btn btn-block btn-success" href="<?php echo site_url('panel/index/create');?>">Add your Business</a>
                <a class="btn btn-block btn-inverse" href="<?php echo site_url('panel/website/unassListings');?>">Get a Website</a>

                <?php if(!empty($pages)):?>
                </br>
                <ul class="nav nav-tabs nav-stacked">                    <?php foreach($pages as $page):?>
                    <li><a href="<?php echo site_url('home/page').'/'.$page['pkey'];?>"><?php echo $page['name'];?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>


    </div>
</div>