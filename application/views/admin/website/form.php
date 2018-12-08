
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
        $route='admin/website/edit';
    }else{
        $route='admin/website/create';
    }
    echo form_open($route, $attributes); ?>
    <div class="control-group">
        <div class="controls">
            <p class="text-error"><?php if(isset($errors)){ echo $errors;}?></p>
        </div>
    </div>

    <input type="hidden"  value="<?php if(!empty($data)){ echo $data['pkey'];}?>" name="pkey">
    <input type="hidden"  value="<?php if(isset($listing_pkey)){ echo $listing_pkey;}elseif(isset($data['listing_pkey'])){ echo $data['listing_pkey']; }?>" name="listing_pkey">

    <div class="control-group">
        <label class="control-label" for="inputName">Website Name</label>
        <div class="controls">
            <input class="input-xxlarge" type="text" value="<?php if(!empty($data)){ echo $data['name'];}?>"  name="name" id="inputName" placeholder="Website Name">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputSlug">Slug</label>
        <div class="controls">
            <input class="input-xxlarge"  type="text" value="<?php if(!empty($data)){ echo $data['slug'];}?>"  name="slug" id="inputSlug" placeholder="Slug Address for Website">
            <p class="text-error"><?php if(isset($slugAlreadyBooked)){echo $slugAlreadyBooked; }?></p>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="inputUrl">Domain</label>
        <div class="controls">
            <input class="input-xxlarge"  type="text" value="<?php if(!empty($data)){ echo $data['url'];}?>"  name="url" id="inputUrl" placeholder="Domain Address of Website">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputEmail">Email</label>
        <div class="controls">
            <input class="input-xxlarge"  type="email" value="<?php if(!empty($data)){ echo $data['email'];}?>"  name="email" id="inputEmail" placeholder="Admin Email to receive messages">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="logoSelect">Logo</label>
        <div class="controls">
            <input type="hidden" id="logo" value="<?php if(!empty($data)){ echo $data['logo'];}?>" name="logo">
            <input class="input-xxlarge"  name="logoSelect" class="input-xlarge" type="file" id="logoSelect" placeholder="" action="<?php echo site_url('admin/website/uploadLogo');?>"></br>
            <span class="label label-important" id="logoUploadError"></span></br>
            <img src="<?php if(!empty($data) && isset($data['logo']) && $data['logo']!=''){ echo base_url().$this->config->item('LogoUploadDirectory').$data['logo']; }else{ assetLink(array('websiteLogoScreenshot.png'=>'image'));} ?>" id="logoImage"  height="100px" width="100px" class="img"/>

        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="faviconSelect">Favicon</label>
        <div class="controls">
            <input type="hidden" id="favicon" value="<?php if(!empty($data)){ echo $data['favicon'];}?>" name="favicon">
            <input name="faviconSelect" class="input-xlarge" type="file" id="faviconSelect" placeholder="" action="<?php echo site_url('admin/website/uploadFavicon');?>"></br>
            <span class="label label-important" id="faviconUploadError"></span></br>
            <img src="<?php if(!empty($data) && isset($data['favicon']) && $data['favicon']!=''){ echo base_url().$this->config->item('FaviconUploadDirectory').$data['favicon']; }else{ assetLink(array('websiteFaviconScreenshot.png'=>'image'));} ?>" id="faviconImage"  height="100px" width="100px" class="img"/>

        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="maxPages">Max Pages</label>
        <div class="controls">
            <input class="input-xxlarge"  type="text" value="<?php if(!empty($data)){ echo $data['maxPages'];}?>"  name="maxPages" id="maxPages" placeholder="Maximum allowed Pages">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="maxEmails">Max Emails</label>
        <div class="controls">
            <input class="input-xxlarge"  type="text" value="<?php if(!empty($data)){ echo $data['maxEmails'];}?>"  name="maxEmails" id="maxEmails" placeholder="Maximum allowed Emails">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="template">Template</label>
        <div class="controls">
            <select name="template" class="input-xlarge" id="template"  lastSelected="<?php if(!empty($data)){ echo $data['template'];}?>" >
                <option value="default">Default</option>
                <option value="portfolio">Portfolio</option>
            </select>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="inputFacebook">Facebook Page</label>
        <div class="controls">
            <input class="input-xxlarge"  type="text" value="<?php if(!empty($data)){ echo $data['facebook'];}?>"  name="facebook" id="inputFacebook" placeholder="Facebook Page URL">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputTwitter">Twitter Page</label>
        <div class="controls">
            <input class="input-xxlarge"  type="text" value="<?php if(!empty($data)){ echo $data['twitter'];}?>"  name="twitter" id="inputTwitter" placeholder="Twitter URL">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputGooglePlus">Google+ Page</label>
        <div class="controls">
            <input class="input-xxlarge"  type="text" value="<?php if(!empty($data)){ echo $data['googlePlus'];}?>"  name="googlePlus" id="inputGooglePlus" placeholder="Google+ URL">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputLinkedIn">LinkedIn Page</label>
        <div class="controls">
            <input class="input-xxlarge"  type="text" value="<?php if(!empty($data)){ echo $data['linkedIn'];}?>"  name="linkedIn" id="inputLinkedIn" placeholder="LinkedIn Page URL">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputYoutube">Youtube Page</label>
        <div class="controls">
            <input class="input-xxlarge"  type="text" value="<?php if(!empty($data)){ echo $data['youtube'];}?>"  name="youtube" id="inputYoutube" placeholder="Youtube Page URL">
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
            <div class="span9">
                <button type="submit" class="btn btn-info btn-block"><?php echo $button;?></button>
            </div>
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

    var template =$('#template').attr('lastSelected');
    var templateItems=$('#template').children('option[value="'+template+'"]');
    templateItems.attr('selected','selected');


    //Logo Upload
    $(document).ready(function(){

        new AjaxUpload('logoSelect', {
            action: $('#logoSelect').attr('action'),
            name: 'logoSelect',
            onSubmit: function(file, extension) {
                $('#logoImage').attr('src','<?php assetLink(array('loading-screenshot.gif'=>'image'));  ?>');

            },
            onComplete: function(file, response) {
                if(response.indexOf('<span>')>=0 && response.indexOf('</span>')>=0){
                    $('#logoUploadError').html(response);
                    $('#logoImage').attr('src','<?php assetLink(array('websiteLogoScreenshot.png'=>'image'));  ?>');
                }else{
                    $('#logoImage').attr('src',response);
                    var image=response.split('/');
                    image=image[image.length-1];
                    $('#logo').attr('value',image);
                }
            }
        });

    });


    //Favicon Upload
    $(document).ready(function(){

    new AjaxUpload('faviconSelect', {
        action: $('#faviconSelect').attr('action'),
        name: 'faviconSelect',
        onSubmit: function(file, extension) {
            $('#faviconImage').attr('src','<?php assetLink(array('loading-screenshot.gif'=>'image'));  ?>');

        },
        onComplete: function(file, response) {
            if(response.indexOf('<span>')>=0 && response.indexOf('</span>')>=0){
                $('#faviconUploadError').html(response);
                $('#faviconImage').attr('src','<?php assetLink(array('websiteFaviconScreenshot.png'=>'image'));  ?>');
            }else{
                $('#faviconImage').attr('src',response);
                var image=response.split('/');
                image=image[image.length-1];
                $('#favicon').attr('value',image);
            }
        }
    });
    });

</script>


