
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
        $route='admin/order/edit';
    }else{
        $route='admin/order/add';
    }
    echo form_open($route, $attributes); ?>

    <input type="hidden"  value="<?php if(isset($pkey)){ echo $pkey;}?>" name="pkey">
    <input type="hidden"  value="<?php if(isset($userKey)){ echo $userKey;}?>" name="userKey">

    <div class="control-group">
        <label class="control-label" for="status">Status</label>
        <div class="controls">
            <select type="text" lastSelected="<?php if(!empty($data)){ echo $data['status'];}?>"  name="status" id="status" placeholder="Status">
                <option value="0">Pending</option>
                <option value="1">Confirmed</option>
            </select>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="amount">Amount</label>
        <div class="controls">
            <input type="text" value="<?php if(!empty($data)){ echo $data['amount'];}?>"  name="amount" id="amount" placeholder="Amount">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="startDate">Start Date</label>
        <div class="controls">
            <input type="text" value="<?php if(!empty($data)){ echo timestampToDate($data['startDate']);}?>"  name="startDate" id="startDate" placeholder="Start Date">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="validity">Validity</label>
        <div class="controls">
            <input type="text" value="<?php if(!empty($data)){ echo $data['validity'];}?>"  name="validity" id="validity" placeholder="Validity (Years)">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="details">Details</label>
        <div class="controls">
            <textarea  name="details" id="details" placeholder=""><?php if(!empty($data)){ echo $data['details'];}?></textarea>
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
loadAsset(array('jquery-1.7.1.min.js'=>'script','jquery-ui.css'=>'style','jquery-ui.js'=>'script'));
loadBootstrap('script.min') ;
?>


<script type="text/javascript">
    var status =$('#status').attr('lastSelected');
    var statusItems=$('#status').children('option[value="'+status+'"]');
    statusItems.attr('selected','selected');




    $('#startDate').attr('readonly', true);

    $( "#startDate" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        numberOfMonths: 1
    });




</script>


