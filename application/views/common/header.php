<html>
<head>
    <title>
        BISE Gujranwala
    </title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/headericon.png" type="image/png">        
    <link href="<?php echo base_url(); ?>assets/css/icomoon/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/alertify.core.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.fancybox.css">    

    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.scrollUp.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/wysiwyg/bootstrap-wysihtml5.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mask.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.mPageloader').hide();
        });
    </script>
</head>
<body>

<div class="mPageloader">
    <div class="CSSspinner2 large">
        <div class="spinner-container container1">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
        <div class="spinner-container container2">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
        <div class="spinner-container container3">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
    </div>
</div>

<header>
    <a href="#" >
        <img style="height: 60px; width: 60px; margin-top: 5px; " class="img-responsive" src="<?php echo base_url(); ?>assets/img/BISEGRW_Icon.png" alt="logo"/>
    </a>
    <div class="btn-group">
        <button class="btn btn-primary" style="    height: 30px;">
            <?php
            echo $Inst_Id.' - '.$inst_Name;  
            ?>
        </button>
        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" onclick="$('.btn-group').addClass('btn-group open');" style="    height: 30px;">
            <span class="caret">
            </span>
        </button>
        <ul class="dropdown-menu pull-right">
            <li>
                <a onclick="return logout();">
                    Logout
                </a>
            </li>
        </ul>
    </div>
</header>