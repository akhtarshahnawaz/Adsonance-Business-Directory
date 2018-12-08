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
    <?php if($this->session->userdata('showAllEmails')):?>
    <a class="btn btn-warning btn-small pull-right" href="<?php echo site_url('admin/emails/toggleShowAll');?>">Show Pending Only</a>
    <?php else:?>
    <a class="btn btn-warning btn-small pull-right" href="<?php echo site_url('admin/emails/toggleShowAll');?>">Show All</a>
    <?php endif; ?>
</br>    </br>

    <?php if(!empty($data)): ?>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Email</th>
            <th>Prev. Email</th>
            <th>Password</th>
            <th>Type</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $key=>$data):?>
        <tr class="<?php if($data['status']==0){echo 'warning';}elseif($data['status']==1){ echo 'success';}?>">
        <th><?php echo ($this->config->item('emailRequestsOnSinglePage')*$page)+$key+1;; ?></th>
            <td><?php echo $data['email']; ?></td>
            <td><?php echo $data['prevEmail']; ?></td>
            <td><?php echo $data['password']; ?></td>
            <td><?php echo $data['type']; ?></td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-primary btn-mini" href="<?php echo site_url('admin/emails/confirm').'/'.$data['pkey'];?>">Confirm</a>
                    <a class="btn btn-danger btn-mini" href="<?php echo site_url('admin/emails/deleteRequest').'/'.$data['pkey'];?>">Delete</a>
                    <a class="btn btn-warning btn-mini" href="<?php echo site_url('admin/website/manage').'/'.$data['website_pkey_emails'];?>">Web Panel</a>
                    <a class="btn btn-info btn-mini" href="<?php echo site_url('admin/users/view').'/'.$data['userKey'];?>">User</a>


                </div>
            </td>
        </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php
        if(isset($totalRequests)){
            $totalPages=$totalRequests/$this->config->item('ListingsOnSinglePage');
        }
        ?>
        <ul>
            <?php if(($page-1)>=0):?>
            <li><a href="<?php echo site_url('admin/emails/index').'/'.($page-1);?>">Prev</a></li>
            <?php endif; ?>
            <?php for($i=0;$i<$totalPages;$i++):?>
            <li <?php if($i==$page){ echo 'class="disabled"';}?> ><a href="<?php echo site_url('admin/emails/index').'/'.$i;?>"><?php echo $i+1 ?></a></li>
            <?php endfor; ?>
            <?php if(($page+1)<$totalPages):?>

            <li><a href="<?php echo site_url('admin/emails/index').'/'.($page+1);?>">Next</a></li>
            <?php endif; ?>

        </ul>
    </div>
    <?php else: ?>
    <div class="well">
        <p class="text-warning" align="center">
            You have no pending Email Requests.
        </p>
    </div>
    <?php endif; ?>
</div>
</div>