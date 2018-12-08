
<div class="span9 well">
    <?php
    $ci=& get_instance();
    $ci->load->library('session');

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


    <?php   $this->load->helper('form');
    $attributes = array('class' => 'form-horizontal ');
    if(isset($update) && $update==true){
        $route='admin/users/edit';
    }else{
        $route='admin/users/create';
    }
    echo form_open($route, $attributes); ?>
    <div class="control-group">
        <div class="controls">
            <p class="text-error"><?php if(isset($errors)){ echo $errors;}?></p>
        </div>
    </div>

    <input type="hidden"  value="<?php if(!empty($data)){ echo $data['pkey'];}?>" name="pkey">

    <div class="control-group">
        <label class="control-label" for="inputUserType">Type</label>
        <div class="controls">
            <select lastSelected="<?php if(!empty($data)){ echo $data['type'];}?>"  name="type" id="inputUserType">
                <option value="general">General</option>
                <option value="admin">Admin</option>
                <option value="superAdmin">Super Admin</option>

            </select>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputName">Name</label>
        <div class="controls">
            <input type="text" value="<?php if(!empty($data)){ echo $data['name'];}?>"  name="name" id="inputName" placeholder="Name">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputEmail">Email</label>
        <div class="controls">
            <input type="email" value="<?php if(!empty($data)){ echo $data['email'];}?>"  name="email" id="inputEmail" placeholder="Email Address">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputPassword">Password</label>
        <div class="controls">
            <input type="password" value=""  name="password" id="inputPassword" placeholder="Password">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputRePassword">Verify Password</label>
        <div class="controls">
            <input type="password" value=""  name="verifyPassword" id="inputRePassword" placeholder="Verify Password">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputPhone">Phone</label>
        <div class="controls">
            <input type="text" value="<?php if(!empty($data)){ echo $data['phone'];}?>"  name="phone" id="inputPhone" placeholder="Phone">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputCompany">Company</label>
        <div class="controls">
            <input type="text" value="<?php if(!empty($data)){ echo $data['company'];}?>"  name="company" id="inputCompany" placeholder="Company">
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="inputAddress">Address</label>
        <div class="controls">
            <textarea  name="address" id="inputAddress" placeholder="Address"><?php if(!empty($data)){ echo $data['address'];}?></textarea>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <?php
            if(isset($update) && $update==true){
                $button="Update";
            }else{
                $button="Create";
            }
            ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><?php echo $button;?></button>
        </div>
    </div>
    </form>

</div>
</div>


<?php
loadAsset(array('jquery-1.7.1.min.js'=>'script'));
loadBootstrap('script.min') ;
?>


<script type="text/javascript">
    var userType =$('#inputUserType').attr('lastSelected');
    var userTypeItems=$('#inputUserType').children('option[value="'+userType+'"]');
    userTypeItems.attr('selected','selected');

</script>