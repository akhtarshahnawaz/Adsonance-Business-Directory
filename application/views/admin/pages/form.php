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
        $route='admin/page/edit';
    }else{
        $route='admin/page/create';
    }
    echo form_open($route, $attributes); ?>

    <input type="hidden" name="pkey" value="<?php if(isset($pkey)){ echo $pkey;}?>">



            <input type="text" class="input-block-level" value="<?php if(!empty($data)){ echo $data['name'];}?>"  name="name" id="inputName" placeholder="Name of Page">
</br></br>


  
            <textarea  name="content" id="inputContent" placeholder=""><?php if(!empty($data)){ echo $data['content'];}?></textarea>
</br></br>


            <?php
            if(isset($update) && $update==true){
                $button="Update";
            }else{
                $button="Create";
            }
            ?>
            <button type="submit" class="btn btn-info btn-block"><?php echo $button;?></button>

    </form>

</div>
</div>


<?php
loadAsset(array('jquery-1.7.1.min.js'=>'script','ckeditor/ckeditor.js'=>'script'));
loadBootstrap('script.min') ;

?>


<script type="text/javascript">


    CKEDITOR.replace( 'inputContent',{
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