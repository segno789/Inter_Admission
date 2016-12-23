<html>
<head>

<link href="<?php echo base_url(); ?>assets/css_matric/main.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css_matric/jquery-1.8.2-custom.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/alertify.core.css">



<title>
    BISE GRW - BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA
</title>

<div id="header">
    <div class="inHeaderLogin">
        <a href="" title="BISE Gujranwala" rel="home"><img style="margin-top: 9px;text-align:left;width:150px;float: left;margin-left: 22%; " src="<?php echo base_url(); ?>assets/img/logo.jpg" alt="Logo BISE GRW"></a>
        <p style="color: wheat;text-align: center;font-size: 28px;margin-left: 28px;float: left;     margin-top: 40px;">Board of Intermediate & Secondary Education, Gujranwala </br></br> Admission Inter      <?php if(Session=='1')
                echo 'Annual';
            else if(Session =='2')
                echo 'Supply';?> 
        <?php  echo Year; ?></p>
    </div>
</div>
