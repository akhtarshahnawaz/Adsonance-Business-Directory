<?php
if(isset($update) && $update==true){
    echo '<h2 align="center">Edit Page</h2>';
}else{
    echo '<h2 align="center">Add a Page</h2>';
}
?>


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
        $route='admin/webpage/edit';
    }else{
        $route='admin/webpage/create';
    }
    echo form_open($route, $attributes); ?>

    <input type="hidden"  value="<?php if(!empty($data)){ echo $data['pkey'];}?>" name="pkey">

    <input type="hidden"  value="<?php if(isset($website_pkey)){ echo $website_pkey;}elseif(isset($data['website_pkey'])){ echo $data['website_pkey']; }?>" name="website_pkey">


    <div class="well">
        <div class="control-group">
            <label class="control-label" for="inputTemplate">Template</label>
            <div class="controls">
                <select class="input-block-level"  lastSelected="<?php if(!empty($data)){ echo $data['type'];}?>"  name="type" id="inputTemplate">
                    <option value="home">Homepage</option>
                    <option value="contact">Contact Page</option>
                    <option value="general">General Page</option>

                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputOrder">Order</label>
            <div class="controls">
                <input class="input-block-level" type="text" value="<?php if(!empty($data)){ echo $data['order'];}?>"  name="order" id="inputOrder" placeholder="Page Order in Menu">
            </div>
        </div>

    </div>

    <div class="well">
        <p class="lead badge-info">&nbsp; SEO Details</p>

        <div class="control-group">
            <label class="control-label" for="inputTitle">Title</label>
            <div class="controls">
                <input class="input-block-level" type="text" value="<?php if(!empty($data)){ echo $data['title'];}?>"  name="title" id="inputTitle" placeholder="SEO Page Title">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputKeywords">Keywords</label>
            <div class="controls">
                <input class="input-block-level"  type="text" value="<?php if(!empty($data)){ echo $data['keywords'];}?>"  name="keywords" id="inputKeywords" placeholder="SEO Page Keywords">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputDescription">Description</label>
            <div class="controls">
                <input class="input-block-level"  type="text" value="<?php if(!empty($data)){ echo $data['description'];}?>"  name="description" id="inputDescription" placeholder="SEO Page Description">
            </div>
        </div>

    </div>



    <div class="well">
        <p class="lead badge-info">&nbsp; Page Content</p>

        <div class="control-group">
            <label class="control-label" for="name">Page Name</label>
            <div class="controls">
                <input class="input-block-level"  type="text" value="<?php if(!empty($data)){ echo $data['name'];}?>"  name="name" id="name" placeholder="Webpage Name">
            </div>
        </div>

     <!--   <div class="control-group">
            <label class="control-label" for="inputSlug">Slug</label>
            <div class="controls">
                <input class="input-block-level"  type="text" value="<?php if(!empty($data)){ echo $data['slug'];}?>"  name="slug" id="inputSlug" placeholder="Slug for Website">
            </div>
        </div>  -->

        <textarea  name="content" id="inputPageContent" placeholder="Content of your page"><?php if(!empty($data)){ echo $data['content'];}?></textarea>




    </div>


            <?php
            if(isset($update) && $update==true){
                $button="Update";
            }else{
                $button="Create";
            }
            ?>
            <button type="submit" class="btn btn-block btn-info"><?php echo $button;?></button>

    </form>

</div>
</div>


<?php
loadAsset(array('jquery-1.7.1.min.js'=>'script','ckeditor/ckeditor.js'=>'script'));
loadBootstrap('script.min') ;
?>


<script type="text/javascript">
    var Template =$('#inputTemplate').attr('lastSelected');
    var savedTemplate=$('#inputTemplate').children('option[value="'+Template+'"]');
    savedTemplate.attr('selected','selected');



    CKEDITOR.replace( 'inputPageContent',{
        toolbar : [
            { name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
            { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
            { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',
                'HiddenField' ] },
            '/',
            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
                '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
            { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
            { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
            '/',
            { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
            { name: 'colors', items : [ 'TextColor','BGColor' ] },
            { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
        ],
        filebrowserBrowseUrl : '<?php echo base_url('assets/scripts/kcfinder');?>/browse.php?type=files',
        filebrowserImageBrowseUrl : '<?php echo base_url('assets/scripts/kcfinder');?>/browse.php?type=images',
        filebrowserFlashBrowseUrl : '<?php echo base_url('assets/scripts/kcfinder');?>/browse.php?type=flash',
        filebrowserUploadUrl : '<?php echo base_url('assets/scripts/kcfinder');?>/upload.php?type=files',
        filebrowserImageUploadUrl : '<?php echo base_url('assets/scripts/kcfinder');?>/upload.php?type=images',
        filebrowserFlashUploadUrl : '<?php echo base_url('assets/scripts/kcfinder');?>/upload.php?type=flash'
    });

</script>

