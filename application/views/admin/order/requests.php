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
    <?php if($this->session->userdata('showAllOrders')):?>
    <a class="btn btn-warning btn-small pull-right" href="<?php echo site_url('admin/order/toggleShowAll');?>">Show Pending Only</a>
    <?php else:?>
    <a class="btn btn-warning btn-small pull-right" href="<?php echo site_url('admin/order/toggleShowAll');?>">Show All</a>
    <?php endif; ?>
    </br>
    </br>

    <?php if(!empty($data)): ?>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Content</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $key=>$data):?>
        <tr class="<?php if($data['status']==0){echo 'warning';}elseif($data['status']==1){ echo 'success';}?>">
            <th><?php echo ($this->config->item('orderRequestsOnSinglePage')*$page)+$key+1;; ?></th>
            <td><?php echo $data['content']; ?></td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-primary btn-mini" href="<?php echo site_url('admin/order/confirmOrderRequest').'/'.$data['pkey'];?>">Confirm</a>
                    <a class="btn btn-danger btn-mini" href="<?php echo site_url('admin/order/deleteOrderRequest').'/'.$data['pkey'];?>">Delete</a>
                    <a class="btn btn-warning btn-mini" href="<?php echo site_url('admin/website/manage').'/'.$data['website_pkey_requests'];?>">Web Panel</a>
                    <a class="btn btn-info btn-mini" href="<?php echo site_url('admin/users/view').'/'.$data['userKey'];?>">User</a>

                </div>
            </td>
        </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php
        if(isset($totalOrderRequests)){
            $totalPages=$totalOrderRequests/$this->config->item('ListingsOnSinglePage');
        }
        ?>
        <ul>
            <?php if(($page-1)>=0):?>
            <li><a href="<?php echo site_url('admin/order/ordersRequest').'/'.($page-1);?>">Prev</a></li>
            <?php endif; ?>
            <?php for($i=0;$i<$totalPages;$i++):?>
            <li <?php if($i==$page){ echo 'class="disabled"';}?> ><a href="<?php echo site_url('admin/order/ordersRequest').'/'.$i;?>"><?php echo $i+1 ?></a></li>
            <?php endfor; ?>
            <?php if(($page+1)<$totalPages):?>

            <li><a href="<?php echo site_url('admin/order/ordersRequest').'/'.($page+1);?>">Next</a></li>
            <?php endif; ?>

        </ul>
    </div>
    <?php else: ?>
    <div class="well">
        <p class="text-warning" align="center">
            You have no pending Order Requests.
        </p>
    </div>
    <?php endif; ?>
</div>
</div>