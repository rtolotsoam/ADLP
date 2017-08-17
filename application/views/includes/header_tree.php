<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo img_url('fav-adlp.png'); ?>" rel="shortcut icon" sizes="32x32" type="image/png" />
    <title><?php echo $titre; ?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo css_url('bootstrap.min'); ?>" rel="stylesheet">
    <link href="<?php echo css_url('bootstrap-reset'); ?>" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo css_url('font-awesome/css/font-awesome'); ?>" rel="stylesheet"/>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo css_url('tree-style'); ?>" /> -->
    <!--right slidebar-->
    <link href="<?php echo css_url('slidebars'); ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo css_url('style'); ?>" rel="stylesheet">
    <link href="<?php echo css_url('style-responsive'); ?>" rel="stylesheet" />
    <!-- Summernote remonter -->
    <link href="<?php echo css_url('summernote'); ?>" rel="stylesheet" />
  
    

    <?php
    /**
    *  injection dynamique des fichiers css
    */
    if(isset($css)){
    foreach ($css as $val_css) {
    ?>
    
    <link rel="stylesheet" href="<?php echo css_url($val_css); ?>" />
    <?php
    }
    }
    ?>
    <?php
    /**
    * injection dynamique des fichiers javascript
    */
    if(isset($js)){
    foreach ($js as $val_js) {
    ?>
    <script type="text/javascript" src="<?php echo js_url($val_js); ?>"></script>
    
    <?php
    }
    }
    ?>
    <script type="text/javascript">
    <?php
    /**
    * injection dynamique variable javascript
    */
    if(isset($js_info)){
    foreach ($js_info as $val_js_info) {
    echo $val_js_info;
    }
    }
    ?>
    </script>
    
    <script src="<?php echo js_url('js/jquery.js'); ?>"></script>

    <script src="<?php echo js_url('js/dist/jstree.js'); ?>"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo js_url('js/html5shiv.js'); ?>js/html5shiv.js"></script>
    <script src="<?php echo js_url('js/respond.min.js'); ?>"></script>
    <![endif]-->
  </head>
  <body>
    