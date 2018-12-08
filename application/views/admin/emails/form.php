
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
        $route='admin/emails/update';
    }else{
        $route='admin/emails/create';
    }
    echo form_open($route, $attributes); ?>

    <input type="hidden"  value="<?php if(isset($webKey)){ echo $webKey;}?>" name="websiteKey">
    <input type="hidden"  value="<?php if(!empty($data)){ echo $data['pkey'];}?>" name="pkey">



    <div class="control-group">
        <label class="control-label" for="email">Email</label>
        <div class="controls">
            <?php
            $email='';
            if(!empty($data)){
                $email=explode('@',$data['email']);
                if(!empty($email)){
                    $email=$email[0];
                }
            }
            ?>
            <input class="input-xlarge" type="text" value="<?php echo $email; ?>"  name="email" id="email" placeholder="Email">
            <?php
            $url='';
            if(isset($domain) && $domain!=null){
                $url=str_replace('http://','',$domain);
                $url=str_replace('https://','',$url);
                $url=str_replace('//','',$url);
                $url=str_replace('/','',$url);
                $url=str_replace('www.','',$url);
                $url=str_replace('index.php','',$url);
                echo '@'.$url;
            }
            ?>
        </div>
    </div>

    <input type="hidden"  value="<?php if(isset($url)){ echo $url;}?>" name="domain">


    <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
            <input class="input-xxlarge" type="password" value="<?php if(!empty($data)){ echo $data['password'];}?>"  name="password" id="password" placeholder="Password">
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


