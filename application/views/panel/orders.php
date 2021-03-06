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
                <h2 align="center">My Orders</h2>


                <table class="table table-bordered table-condensed table-striped">
                    <?php  if(!empty($data)):  ?>
                    <thead>
                    <tr>
                        <td></td>
                        <td>Amount</td>
                        <td>Start Date</td>
                        <td>Valid Till</td>
                        <td>Details</td>


                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $key=>$data):?>
                    <tr>
                        <td><?php echo ($this->config->item('ListingsOnSinglePage')*$page)+$key+1;; ?></td>
                        <td><?php echo $data['amount']; ?></td>
                        <td><?php echo $data['startDate']; ?></td>
                        <td><?php echo $data['validity']; ?></td>
                        <td><?php echo $data['details']; ?></td>


                    </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php else:?>
                    <div class="alert alert-block">
                        <h4 align="center">No Orders Found!</h4>
                    </div>
                    <?php  endif; ?>
                </table>
                <div class="pagination">
                    <?php
                    if(isset($totalOrders)){
                        $totalPages=$totalOrders/$this->config->item('OrdersOnSinglePage');
                    }
                    ?>
                    <ul>
                        <?php if(($page-1)>=0):?>
                        <li><a href="<?php echo site_url('panel/index/orders').'/'.($page-1);?>">Prev</a></li>
                        <?php endif; ?>
                        <?php for($i=0;$i<$totalPages;$i++):?>
                        <li <?php if($i==$page){ echo 'class="disabled"';}?> ><a href="<?php echo site_url('panel/index/orders').'/'.$i;?>"><?php echo $i+1 ?></a></li>
                        <?php endfor; ?>
                        <?php if(($page+1)<$totalPages):?>

                        <li><a href="<?php echo site_url('panel/index/orders').'/'.($page+1);?>">Next</a></li>
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