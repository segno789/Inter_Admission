<html>
    <head>
        <title>LOGIN | BISEGRW</title>
        <link rel="icon" href="<?php echo base_url(); ?>assets/img/headericon.png" type="image/png">        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <form class="form-horizontal" method="POST">
            <div class="container">
                <h2 class="jumbotron" style="background:#003a6a !important; color: wheat; text-align: center;">
                    <img src="<?php echo base_url(); ?>assets/img/BISEGRW_Icon.png" class="img-circle" width="100px" height="100px" alt="Logo">        
                    Board of Intermediate & Secondary Education, Gujranwala
                    <?php 
                    $sess = '';
                    if(Session =='1')
                        $sess =  'Annual';
                    else if(Session =='2')
                        $sess = 'Supply';
                        echo  '<p style="text-align:center;">Online HSSC '.$sess.' Registration '.Year.'</p>';   
                    ?>
                </h2>
                <?php 
                @$msg = "";
                if($user_status == 1)
                {
                    $msg = "Your UserId or Password is not correct.Please use correct information";
                }
                else if($user_status == 2)
                {
                    $msg = "Only Colleges/Higher Schools are allowed to login.";
                }
                else if($user_status == 3)
                {
                    $msg = "Currently your account is inActive.";
                }
                else if($user_status == 4)
                {
                    $msg = @$remarks;
                }

                else if($user_status == 5)
                {
                    $msg = "Plaese wait some maintaince.";
                }
                else if($user_status == 6)
                {
                    $msg = "Your Institution Students are not Enrolled in Matric Annual 2016.";
                }
                else if($user_status == 7)
                {
                    $msg = "Your subject Groups are not filled.Please Contact to Affiliations Branch at B.I.S.E Gujranwala.";
                }

                if($msg != '')
                {
                    ?>
                    <div class="alert alert-danger fade in alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong><?php echo $msg; ?></strong>
                    </div>
                    <?php
                }
                ?>
                
                <br class="break"><br class="break"><br class="break"><br class="break"><br class="break"><br class="break"><br class="break">

                <div class="form-group">
                    <label class="control-label col-md-4" for="username">Institute Code:</label>
                    <div class="col-md-5">
                        <input class="form-control" id="username" name="username" placeholder="Enter Institute Code" required="required" maxlength="6" type="text" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4" for="password">Password:</label>
                    <div class="col-md-5"> 
                        <input class="form-control" id="password" name="password" placeholder="Enter Password" required="required" type="password">
                    </div>
                </div>
                <div class="form-group"> 
                    <div class="col-md-offset-4 col-md-5">
                        <button type="submit" name="btnLogin" type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="navbar-fixed-bottom row-fluid">
            <div class="navbar-inner">
                <div class="container" style="text-align: center; background:#003a6a; color: wheat; border-radius:5px; margin-bottom: 6px; height: 40px;">
                    &copy; 2017 BISE Gujranwala, All Rights Reserved. 
                </div>
            </div>
        </div>
    </body>
</html>