
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
        $route='admin/category/edit';
    }else{
        $route='admin/category/create';
    }
    echo form_open($route, $attributes); ?>

    <input type="hidden"  value="<?php if(isset($pkey)){ echo $pkey;}?>" name="pkey">

    <div class="control-group">
        <label class="control-label" for="inputName">Category Name</label>
        <div class="controls">
            <input type="text" value="<?php if(!empty($data)){ echo $data['name'];}?>"  name="name" id="inputName" placeholder="Category Name">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="iconSelect">Category Icon</label>
        <div class="controls">
            <input type="hidden" id="icon" value="<?php if(!empty($data)){ echo $data['icon'];}?>" name="icon">
            <input name="iconSelect" class="input-xlarge" type="file" id="iconSelect" placeholder="" action="<?php echo site_url('admin/category/uploadIcon');?>"></br>
            <span class="label label-important" id="iconUploadError"></span></br>
            <img src="<?php if(!empty($data)){ echo base_url().$this->config->item('categoryIconUploadDirectory').$data['icon']; }else{ assetLink(array('categoryIconScreenshot.png'=>'image'));} ?>" id="iconImage"  height="100px" width="100px" class="img"/>

        </div>
    </div>



    <div class="control-group">
        <label class="control-label" for="bannerSelect">Category Banner</label>
        <div class="controls">
            <input type="hidden" id="banner" value="<?php if(!empty($data)){ echo $data['banner'];}?>" name="banner">
            <input name="bannerSelect" class="input-xlarge" type="file" id="bannerSelect" placeholder="" action="<?php echo site_url('admin/category/uploadBanner');?>"></br>
            <span class="label label-important" id="bannerUploadError"></span></br>
            <img src="<?php if(!empty($data)){ echo base_url().$this->config->item('categoryBannerUploadDirectory').$data['banner']; }else{ assetLink(array('categoryBannerScreenshot.png'=>'image')); } ?>" id="bannerImage"  height="120px" width="1000px" class="img" />
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="inputDescription">Category Description</label>
        <div class="controls">
            <textarea  name="description" id="inputDescription" placeholder="Category Description"><?php if(!empty($data)){ echo $data['description'];}?></textarea>
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
loadAsset(array('jquery-1.7.1.min.js'=>'script','ajaxupload.js'=>'script'));
loadBootstrap('script.min') ;
?>


<script type="text/javascript">

    //Ajax Icon Image Upload
    $(document).ready(function(){

        new AjaxUpload('iconSelect', {
            action: $('#iconSelect').attr('action'),
            name: 'iconSelect',
            onSubmit: function(file, extension) {
                $('#iconImage').attr('src','<?php assetLink(array('loading-screenshot.gif'=>'image'));  ?>');

            },
            onComplete: function(file, response) {
                if(response.indexOf('<span>')>=0 && response.indexOf('</span>')>=0){
                    $('#iconUploadError').html(response);
                    $('#iconImage').attr('src','<?php assetLink(array('categoryIconScreenshot.png'=>'image'));  ?>');
                }else{
                $('#iconImage').attr('src',response);
                var image=response.split('/');
                image=image[image.length-1];
                $('#icon').attr('value',image);
                }
            }
        });
    });


    //Ajax Banner Image Upload
    $(document).ready(function(){

        new AjaxUpload('bannerSelect', {
            action: $('#bannerSelect').attr('action'),
            name: 'bannerSelect',
            onSubmit: function(file, extension) {
                $('#bannerImage').attr('src','<?php assetLink(array('loading-screenshot.gif'=>'image'));  ?>');

            },
            onComplete: function(file, response) {
                if(response.indexOf('<span>')>=0 && response.indexOf('</span>')>=0){
                    $('#bannerUploadError').html(response);
                    $('#bannerImage').attr('src','<?php assetLink(array('categoryBannerScreenshot.png'=>'image'));  ?>');
                }else{
                $('#bannerImage').attr('src',response);
                var image=response.split('/');
                image=image[image.length-1];
                $('#banner').attr('value',image);
                }
            }
        });
    });

</script>


