<?php

function loadAsset($nameTypeArray){
    $ci=& get_instance();
    $ci->load->helper('url');
    foreach($nameTypeArray as $name => $type){
        switch($type){
            case 'script':
                echo '<script src="'.base_url().'assets/scripts/'.$name.'"></script>';
                break;
            case 'style':
                echo '<link href="'.base_url().'assets/styles/'.$name.'"  rel="stylesheet" type="text/css" media="screen">';
                break;
            case 'image':
                echo '<img src="'.base_url().'assets/images/'.$name.'"/>';
                break;
        }

    }
}


function assetLink($nameTypeArray){
    $ci=& get_instance();
    $ci->load->helper('url');

    foreach($nameTypeArray as $name => $type){
        switch($type){
            case 'script':
                echo base_url().'assets/scripts/'.$name;
                break;
            case 'style':
                echo base_url().'assets/styles/'.$name;
                break;
            case 'image':
                echo base_url().'assets/images/'.$name;
                break;
        }

    }
}


function loadBootstrap($name){
    $ci=& get_instance();
    $ci->load->helper('url');

    switch($name){
        case 'style':
            echo '<link href="'.base_url().'assets/bootstrap/css/bootstrap.css"  rel="stylesheet" type="text/css" media="screen">';
            break;
        case 'style.min':
            echo '<link href="'.base_url().'assets/bootstrap/css/bootstrap.min.css"  rel="stylesheet" type="text/css" media="screen">';
            break;
        case 'style.responsive':
            echo '<link href="'.base_url().'assets/bootstrap/css/bootstrap-responsive.css"  rel="stylesheet" type="text/css" media="screen">';
            break;
        case 'style.responsive.min':
            echo '<link href="'.base_url().'assets/bootstrap/css/bootstrap-responsive.min.css"  rel="stylesheet" type="text/css" media="screen">';
            break;
        case 'script':
            echo '<script src="'.base_url().'assets/bootstrap/js/bootstrap.js"></script>';
            break;
        case 'script.min':
            echo '<script src="'.base_url().'assets/bootstrap/js/bootstrap.min.js"></script>';
            break;
    }
}


function linkAsset($address){
    echo base_url().'assets/'.$address;
}