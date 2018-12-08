<div class="span9">
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
    }

    if($hasNotification):

        ?>
        <div class="alert <?php echo $alertType;?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $notification?>
        </div>
        <?php endif; ?>

    <a class="btn btn-primary btn-small pull-right" href="<?php echo site_url('admin/listing/create');?>">Create Listing</a>
    </br></br>
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
            <td>Status</td>

            <td></td>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $key=>$data):?>
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
            <td><?php echo $street.$locality.$city.$pincode.$country; ?></td>
            <td>
                <p class="label label-warning"> <?php echo $data['status']; ?></p>
                <p class="label"> <?php echo $data['status2']; ?></p>
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-primary btn-mini" href="<?php echo site_url('admin/listing/edit').'/'.$data['pkey'];?>">Edit</a>
                    <a class="btn btn-success btn-mini" href="<?php echo site_url('admin/images/index').'/'.$data['pkey'];?>">Images</a>
                    <a class="btn btn-warning btn-mini" href="<?php echo site_url('admin/website/index').'/'.$data['pkey'];?>">Manage Website</a>
                    <a class="btn btn-danger btn-mini" href="<?php echo site_url('admin/listing/deleteListing').'/'.$data['pkey'];?>">Delete</a>
                </div>
            </td>
        </tr>
            <?php endforeach; ?>
        </tbody>
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
            <li><a href="<?php echo site_url('admin/listing/index').'/'.($page-1);?>">Prev</a></li>
            <?php endif; ?>
            <?php for($i=0;$i<$totalPages;$i++):?>
            <li <?php if($i==$page){ echo 'class="disabled"';}?> ><a href="<?php echo site_url('admin/listing/index').'/'.$i;?>"><?php echo $i+1 ?></a></li>
            <?php endfor; ?>
            <?php if(($page+1)<$totalPages):?>

            <li><a href="<?php echo site_url('admin/listing/index').'/'.($page+1);?>">Next</a></li>
            <?php endif; ?>

        </ul>
    </div>

</div>
</div>