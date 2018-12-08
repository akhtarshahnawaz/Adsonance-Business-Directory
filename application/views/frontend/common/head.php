<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php if(isset($metaDescription)){ echo $metaDescription;}?>">
    <meta name="author" content="">
    <meta name="keyword" content="<?php if(isset($keywords)){ echo $keywords;}?>">
    <meta name="google-site-verification" content="30jQFglCSKNUs32LsUaVsQaVigkCWluxCe0BkM8TNq8" />

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Le styles -->
    <link href="<?php linkAsset('bootstrap/css/bootstrap.css');?>" rel="stylesheet">
    <link href="<?php linkAsset('bootstrap/css/bootstrap-responsive.css');?>" rel="stylesheet">

    <link href="<?php linkAsset('styles/style.css');?>" rel="stylesheet">

    <link rel="shortcut icon" href="<?php linkAsset('images/favicon.png'); ?>" type="image/x-icon">
    <script language="JavaScript" src="http://j.maxmind.com/app/geoip.js"></script>
    <script type="text/javascript">
        document.cookie="country="+geoip_country_name();
        document.cookie="city="+geoip_city();
        document.cookie="region="+geoip_region_name();
        document.cookie="pin="+geoip_postal_code();

    </script>

    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
</head>


