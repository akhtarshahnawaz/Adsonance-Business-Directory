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


    <a class="btn btn-primary btn-small pull-right" href="<?php echo site_url('admin/users/create');?>">Add User</a>
    </br></br>
    <?php  if(!empty($data)):  ?>

    <table class="table table-bordered table-condensed table-striped">
        <thead>
        <tr>
            <td></td>
            <td>Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Address</td>
            <td>Company</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $key=>$data):?>
        <tr>
            <td><?php echo ($this->config->item('UsersOnSinglePage')*$page)+$key+1;; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $data['email']; ?></td>
            <td><?php echo $data['phone']; ?></td>
            <td><?php echo $data['address']; ?></td>
            <td><?php echo $data['company']; ?></td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-success btn-mini" href="<?php echo site_url('admin/users/view').'/'.$data['pkey'];?>">View</a>
                    <a class="btn btn-primary btn-mini" href="<?php echo site_url('admin/users/edit').'/'.$data['pkey'];?>">Edit</a>
                    <a class="btn btn-warning btn-mini" href="<?php echo site_url('admin/order/add').'/'.$data['pkey'];?>">Add Order</a>
                    <a class="btn btn-danger btn-mini" href="<?php echo site_url('admin/users/deleteUser').'/'.$data['pkey'];?>">Delete</a>
                </div>
            </td>
        </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <?php else: ?>
    <div class="well">
        <p align="center" class="lead text-warning">
            Sorry! </br> No result found
        </p>
        </div>

    <?php  endif; ?>


    <?php
    if(isset($totalUsers)){
        $totalPages=$totalUsers/$this->config->item('UsersOnSinglePage');
    }
    ?>

    <?php if(isset($search) && $search==true):?>
    <div class="pagination">

        <ul>
            <?php if(($page-1)>=0):?>
            <li><a href="<?php echo site_url('admin/users/search').'/'.($page-1).'?search='.$searchString;?>">Prev</a></li>
            <?php endif; ?>
            <?php for($i=0;$i<$totalPages;$i++):?>
            <li <?php if($i==$page){ echo 'class="disabled"';}?> ><a href="<?php echo site_url('admin/users/search').'/'.$i.'?search='.$searchString;?>"><?php echo $i+1 ?></a></li>
            <?php endfor; ?>
            <?php if(($page+1)<$totalPages):?>

            <li><a href="<?php echo site_url('admin/users/search').'/'.($page+1).'?search='.$searchString;?>">Next</a></li>
            <?php endif; ?>

        </ul>
    </div>
    <?php else: ?>

    <div class="pagination">

        <ul>
            <?php if(($page-1)>=0):?>
            <li><a href="<?php echo site_url('admin/users/index').'/'.($page-1);?>">Prev</a></li>
            <?php endif; ?>
            <?php for($i=0;$i<$totalPages;$i++):?>
            <li <?php if($i==$page){ echo 'class="disabled"';}?> ><a href="<?php echo site_url('admin/users/index').'/'.$i;?>"><?php echo $i+1 ?></a></li>
            <?php endfor; ?>
            <?php if(($page+1)<$totalPages):?>

            <li><a href="<?php echo site_url('admin/users/index').'/'.($page+1);?>">Next</a></li>
            <?php endif; ?>

        </ul>
    </div>
    <?php endif; ?>

</div>
</div>