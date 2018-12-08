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





    <h2 class="text-info"><?php if(isset($name)){ echo $name;}?></h2>
    <div class="btn-group pull-right ">
        <a class="btn btn-small btn-primary" href="<?php echo site_url('admin/order/add').'/'.$pkey;?>">Add Order</a>
    </div>

    </br></br>
    <table class="table table-bordered table-condensed table-striped">
        <tr>
            <th>Email</th>
            <td><?php if(isset($email)){ echo $email;}?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td><?php if(isset($phone)){ echo $phone;}?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php if(isset($address)){ echo $address;}?></td>
        </tr>
        <tr>
            <th>Company</th>
            <td><?php if(isset($company)){ echo $company;}?></td>
        </tr>
    </table>

    <?php if(!empty($listings)): ?>
    <p class="lead">Listings</p>
    <table class="table table-bordered table-condensed table-striped">
        <tr>
            <th></th>
            <th>Listing Name</th>
            <th>Person Name</th>
            <th>Email</th>
            <th>Website</th>
            <th></th>


        </tr>
        <?php foreach($listings as $key=>$row):?>
        <tr>
            <th><?php echo $key+1;?></th>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['contact_person'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['website'];?></td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-mini btn-primary" href="<?php echo site_url('admin/website/index').'/'.$row['pkey'];?>">View Website</a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php endif; ?>


    <?php if(!empty($orders)): ?>
    <p class="lead">Orders</p>

    <table class="table table-bordered table-condensed table-striped">
        <tr>
            <th></th>
            <th>Amount</th>
            <th>Start date</th>
            <th>validity</th>
            <th>details</th>
            <th>Status</th>
            <th></th>


        </tr>
        <?php foreach($orders as $key=>$row):?>
        <tr>
            <th><?php echo $key+1;?></th>
            <td><?php echo $row['amount'];?></td>
            <td><?php echo dateToString(timestampToDate($row['startDate']));?></td>
            <td><?php echo $row['validity'];?></td>
            <td><?php echo $row['details'];?></td>
            <td><?php if($row['status']==0){ echo 'Pending';} else{echo 'Confirmed';} ;?></td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-mini btn-warning" href="<?php echo site_url('admin/order/edit').'/'.$row['pkey'];?>">Edit</a>
                    <a class="btn btn-mini btn-danger" href="<?php echo site_url('admin/order/deleteOrder').'/'.$row['pkey'];?>">Delete</a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php endif; ?>



</div>
</div>