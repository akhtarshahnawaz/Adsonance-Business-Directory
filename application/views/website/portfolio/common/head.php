<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if(isset($title)){ echo $title;}?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php if(isset($keywords)){ echo $keywords;}?>">
    <meta name="description" content="<?php if(isset($description)){ echo $description;}?>">
    <meta name="author" content="">

    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/webTemplate/portfolio/css/bootstrap.css')?>" rel="stylesheet">
    <?php
    loadBootstrap('style.min');
    loadBootstrap('style.responsive.min')
    ?>
    <link href="<?php linkAsset('bootstrap/css/bootstrap.css');?>" rel="stylesheet">
    <link href="<?php linkAsset('bootstrap/css/bootstrap-responsive.css');?>" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="<?php echo base_url('assets/webTemplate/portfolio/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?php if(isset($favicon)){  echo base_url().$this->config->item('FaviconUploadDirectory').$favicon;}  ?>" type="image/x-icon">

</head>

