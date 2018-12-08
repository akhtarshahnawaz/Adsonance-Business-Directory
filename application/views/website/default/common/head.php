<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($title)){ echo $title;}?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="<?php if(isset($keywords)){ echo $keywords;}?>">
<meta name="description" content="<?php if(isset($description)){ echo $description;}?>">
<meta name="author" content="">


<link href="<?php echo base_url('assets/webTemplate/default/style/style.css')?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('assets/webTemplate/default/script/jquery-1.7.2.min.js')?>"></script>
<script src="<?php echo base_url('assets/webTemplate/default/script/slider.js')?>" type="text/javascript"></script> 

<script type="text/javascript">
    $(document).ready(function() {
        $('#s3slider').s3Slider({
            timeOut: 3000
        });
    });
</script>
<link rel="shortcut icon" href="<?php if(isset($favicon)){  echo base_url().$this->config->item('FaviconUploadDirectory').$favicon;}  ?>" type="image/x-icon">
</head>
<body>
