
<div class = "container">
    <?php   
    if(@$spl_cd['norec'] != ''){
        ?>
        <div class="form-group">
            <div class="col-md-12">
                <div class="alert alert-danger" align="center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>
                    <strong><?php echo @$spl_cd['norec']; ?></strong>
                </div>
            </div>
        </div>
        <?php
    }
    if(@$spl_cd['error_msg'] != ''){

        ?>
        <div class="form-group">
            <div class="col-md-12">
                <div class="alert alert-danger" align="center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>
                    <strong><?php echo @$spl_cd['error_msg']; ?></strong>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        1- Please Provide Your Previous Exam Information
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <form enctype="multipart/form-data" id="ReturnStatus" name="ReturnStatus"  method="post" action="<?php echo base_url(); ?>Admission_11th_pvt/NewEnrolmentPVT">

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 align="center" class="bold">1- Please Provide Your Previous Exam Information</h3>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-offset-3 col-md-3">
                                    <label class="control-label" for="txtMatRno" >Matric Roll No</label>
                                    <input type="text" class="form-control"  onKeyPress="validatenumber(event);" maxlength="7" id="txtMatRno" required="required" name="txtMatRno" value="<?php  echo @$spl_cd['data']['txtMatRno'];  ?>" autofocus> 
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label" for="oldRno" >Last Appeared Inter Roll No.</label>
                                    <input type="text" class="form-control" onKeyPress="validatenumber(event);" maxlength="6" id="oldRno" required="required" name="oldRno"  maxlength="6" value="<?php echo @$spl_cd['data']['oldRno']; ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-offset-3 col-md-3">
                                    <label class="control-label" for="oldClass">Last Appearing Class</label>
                                    <select id="oldClass" class="form-control" name="oldClass">
                                        <?php
                                        if(Session == 1){
                                            ?>
                                            <option value="11" <?php if(@$_POST['oldClass'] == "11") echo 'selected' ?>>11th</option>
                                            <option value="12" <?php if(@$_POST['oldClass'] == "12") echo 'selected' ?>>12th</option>
                                            <?php
                                        }
                                        else if(Session == 2){
                                            echo'
                                            <option selected="selected" value="12">12th</option>
                                            ';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label" for="oldYear">Last Appearing Year</label>
                                    <select id="oldYear" class="form-control" name="oldYear">
                                        <?php

                                        if(Session == 1){

                                            $yearForLastAp = date('Y')-1;

                                            for($i = $yearForLastAp; $i >= 2000 ; $i--)
                                            {
                                                echo $i;
                                                ?>
                                                <option value="<?php echo $i ?>"><?php echo $i;?></option>
                                                <?php
                                            }
                                            echo'
                                            <option value="100">Before 2000</option>';
                                        }
                                        else if(Session == 2){
                                            @$curr_Year = Year;
                                            @$prev_year = Year - 1;

                                            echo'
                                            <option value="'.$curr_Year.'" selected>'.$curr_Year.'</option>
                                            <option value="'.$prev_year.'">'.$prev_year.'</option>
                                            ';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-offset-3 col-md-3">
                                    <label class="control-label" for="oldSess" >Last Appearing Session</label>
                                    <select id="oldSess" class="form-control" name="oldSess">
                                        <option value="1" >ANNUAL</option>
                                        <option value="2">SUPPLEMENTARY</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label" for="sec_board" >Last Appearing Board</label>
                                    <select id="sec_board" class="form-control" name="oldBrd_cd">
                                        <option value="1">BISE, GUJRANWALA</option>
                                        <?php
                                        if(Session == 1){
                                            ?>
                                            <option value="2">BISE,  LAHORE</option>
                                            <option value="3">BISE,  RAWALPINDI</option>
                                            <option value="4">BISE,  MULTAN</option>
                                            <option value="5">BISE,  FAISALABAD</option>
                                            <option value="6">BISE,  BAHAWALPUR</option>
                                            <option value="7">BISE,  SARGODHA</option>
                                            <option value="8">BISE,  DERA GHAZI KHAN</option>
                                            <option value="9">FBISE, ISLAMABAD</option>
                                            <option value="10">BISE, MIRPUR</option>
                                            <option value="11">BISE, ABBOTTABAD</option>
                                            <option value="12">BISE, PESHAWAR</option>
                                            <option value="13">BISE, KARACHI</option>
                                            <option value="14">BISE, QUETTA</option>
                                            <option value="15">BISE, MARDAN</option>
                                            <option value="17">CAMBRIDGE</option>
                                            <option value="18">AIOU, ISLAMABAD</option>
                                            <option value="19">BISE, KOHAT</option>
                                            <option value="20">KARAKURUM</option>
                                            <option value="21">MALAKAN</option>
                                            <option value="22">BISE, BANNU</option>
                                            <option value="23">BISE, D.I.KHAN</option>
                                            <option value="24">AKUEB, KARACHI</option>
                                            <option value="25">BISE, HYDERABAD</option>
                                            <option value="26">BISE, LARKANA</option>
                                            <option value="27">BISE, MIRPUR(SINDH)</option>
                                            <option value="28">BISE, SUKKUR</option>
                                            <option value="29">BISE, SWAT</option>
                                            <option value="30">SBTE KARACHI</option>
                                            <option value="31">PBTE, LAHORE</option>
                                            <option value="32">AFBHE RAWALPINDI</option>
                                            <option value="33">BIE, KARACHI</option>
                                            <option value="34">BISE SAHIWAL</option>
                                            <option value="35">ISLAMIC UNIVERSITY</option>                 
                                            <?php
                                        }
                                        ?>               
                                    </select>
                                </div>
                            </div>
                        </div>

                        <?php
                        if( @$spl_cd['exam_type']==14 ||@$spl_cd['exam_type']==15 || @$spl_cd['exam_type']==16 )
                        { 
                            ?>
                            <div class="form-group" id="option">
                                <div class="row">
                                    <div class="col-md-offset-5 col-md-5">
                                        <label class="radio-inline" for="CatType1">
                                            <input type="radio" class="nationality_class" id="CatType1" value="1" checked="checked" name="CatType">Marks Improvement
                                        </label>
                                        <label class="radio-inline" for="CatType2">
                                            <input type="radio" class="nationality_class" id="CatType2" value="2" name="CatType">Additional
                                        </label>
                                        <input type="hidden" value="" name="h_exam_type" id="h_exam_type" />
                                        <input type="hidden" value="" name="exam_type" id="exam_type" />      
                                    </div>
                                </div>
                            </div>
                            <?php   
                        }
                        ?>
                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-offset-3 col-md-3">
                                    <input type="submit" value="Proceed" id="proceed" onclick="return validateFormInterAdm(this);" name="proceed" class="btn btn-primary btn-block">
                                </div>
                                <div class="col-md-3">
                                    <input type="button" value="Cancel" onclick="return CancelAlert();"  class="btn btn-danger btn-block">
                                </div>
                            </div>
                        </div>
                        <hr class="colorgraph">
                    </form>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        2- FOR ALOOM-E-SHARKIA CANDIDATES
                    </a>
                </h4>
            </div>
            <form enctype="multipart/form-data" id="frmAlloom" name="frmAloom"  method="post" action="<?php echo base_url(); ?>Admission/preAloomData">
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 align="center" class="bold">2- FOR ALOOM-E-SHARKIA CANDIDATES</h3>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <label class="control-label" for="aloomCat">Select Category</label>
                                    <select id="aloomCat" class="form-control" name="aloomCat">
                                        <option value="1" selected="selected">FAZAL</option>
                                        <option value="2">ADEEB</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">   
                            <div class="row">
                                <div class="col-md-offset-3 col-md-3" id="changeCssAfter">
                                    <div id="hideDivForAdeeb"> 
                                        <label class="control-label" for="txtMatRnoAloom" >Matric Roll No</label>
                                        <input type="text" class="form-control"  onKeyPress="validatenumber(event);" maxlength="7" id="txtMatRnoAloom" name="txtMatRnoAloom" value="<?php  echo @$spl_cd['data']['txtMatRnoAloom'];  ?>" > 
                                    </div>
                                </div>
                                <div class="col-md-3" id="changeCssAfterHide">
                                    <label class="control-label" for="oldRnoAloom" >Last Appeared Roll No.</label>
                                    <input type="text" class="form-control" onKeyPress="validatenumber(event);" maxlength="6" id="oldRnoAloom" name="oldRnoAloom"  maxlength="6" value="<?php echo @$spl_cd['data']['oldRnoAloom']; ?>" />
                                </div>
                            </div>
                        </div> 


                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-offset-3 col-md-3">
                                    <label class="control-label" for="sessAloom">Last Appearing Session</label>
                                    <select id="sessAloom" class="form-control" name="sessAloom">
                                        <option value="1" <?php if(@$spl_cd['data']['oldRnoAloom'] == 1) echo 'selected' ?> >ANNUAL</option>
                                        <option value="2" <?php if(@$spl_cd['data']['oldRnoAloom'] == 2) echo 'selected' ?>>SUPPLEMENTARY</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label" for="oldYearAloom">Last Appearing Year</label>
                                    <select id="oldYearAloom" class="form-control" name="oldYearAloom">
                                        <?php
                                        @$curr_Year = Year - 1;
                                        @$prev_year = Year - 2;
                                        echo'
                                        <option value="'.$curr_Year.'" selected>'.$curr_Year.'</option>
                                        <option value="'.$prev_year.'">'.$prev_year.'</option>';
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <label class="control-label" for="boardAloom" >Last Appearing Board</label>
                                    <select id="boardAloom" class="form-control" name="boardAloom">
                                        <option value="1">BISE, GUJRANWALA</option>
                                        <?php
                                        if(Session == 1){
                                            ?>
                                            <option value="2">BISE,  LAHORE</option>
                                            <option value="3">BISE,  RAWALPINDI</option>
                                            <option value="4">BISE,  MULTAN</option>
                                            <option value="5">BISE,  FAISALABAD</option>
                                            <option value="6">BISE,  BAHAWALPUR</option>
                                            <option value="7">BISE,  SARGODHA</option>
                                            <option value="8">BISE,  DERA GHAZI KHAN</option>
                                            <option value="9">FBISE, ISLAMABAD</option>
                                            <option value="10">BISE, MIRPUR</option>
                                            <option value="11">BISE, ABBOTTABAD</option>
                                            <option value="12">BISE, PESHAWAR</option>
                                            <option value="13">BISE, KARACHI</option>
                                            <option value="14">BISE, QUETTA</option>
                                            <option value="15">BISE, MARDAN</option>
                                            <option value="16">FBISE, ISLAMABAD</option>
                                            <option value="17">CAMBRIDGE</option>
                                            <option value="18">AIOU, ISLAMABAD</option>
                                            <option value="19">BISE, KOHAT</option>
                                            <option value="20">KARAKURUM</option>
                                            <option value="21">MALAKAN</option>
                                            <option value="22">BISE, BANNU</option>
                                            <option value="23">BISE, D.I.KHAN</option>
                                            <option value="24">AKUEB, KARACHI</option>
                                            <option value="25">BISE, HYDERABAD</option>
                                            <option value="26">BISE, LARKANA</option>
                                            <option value="27">BISE, MIRPUR(SINDH)</option>
                                            <option value="28">BISE, SUKKUR</option>
                                            <option value="29">BISE, SWAT</option>
                                            <option value="30">SBTE KARACHI</option>
                                            <option value="31">PBTE, LAHORE</option>
                                            <option value="32">AFBHE RAWALPINDI</option>
                                            <option value="33">BIE, KARACHI</option>
                                            <option value="34">BISE SAHIWAL</option>
                                            <option value="35">ISLAMIC UNIVERSITY</option>                 
                                            <?php
                                        }
                                        ?>               
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-offset-3 col-md-3">
                                    <input type="submit" value="Proceed" id="proceed" onclick="return validateFormInterAdmAloom(this);" name="proceed" class="btn btn-primary btn-block">
                                </div>
                                <div class="col-md-3">
                                    <input type="button" value="Cancel" onclick="return CancelAlert();"  class="btn btn-danger btn-block">
                                </div>
                            </div>
                        </div>
                        <hr class="colorgraph">
                    </div>
                </div>
            </form>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        3- Please Provide Your Matric Exam Information.(For Fresh in Both Part Appearing Students)
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php if(Session ==  1) {?>
                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 align="center" class="bold">3- Please Provide Your Matric Exam Information.(For Fresh in Both Part Appearing Students)</h3>
                                </div>
                            </div>
                        </div>

                        <form enctype="multipart/form-data" id="getPervRec" name="getPervRec" method="post" action="<?php echo base_url(); ?>Admission/Pre_Matric_data">

                            <div class="form-group">    
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-3">
                                        <label class="control-label" for="txtDob">Date of Birth</label>
                                        <input type="text" class="form-control" maxlength="10" id="txtDob" readonly="readonly" required="required" name="txtDob"> 
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label" for="txtMatRno">Matric Roll No</label>
                                        <input type="text" class="form-control" onKeyPress="validatenumber(event);" maxlength="6" id="txtMatRno" required="required" name="txtMatRno"> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">    
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-3">
                                        <label class="control-label" for="oldYear">SSC Year</label>
                                        <select id="oldYear" class="form-control" name="oldYear">
                                            <?php

                                            if(Session == 1){

                                                $yearForLastAp = date('Y')-2;

                                                for($i = $yearForLastAp; $i >= 2000 ; $i--)
                                                {
                                                    echo $i;
                                                    ?>
                                                    <option value="<?php echo $i ?>"><?php echo $i;?></option>
                                                    <?php
                                                }
                                                echo'
                                                <option value="100">Before 2000</option>';
                                            }
                                            else if(Session == 2){
                                                @$curr_Year = Year - 2;
                                                @$prev_year = Year - 3;

                                                echo'
                                                <option value="'.$curr_Year.'" selected>'.$curr_Year.'</option>
                                                <option value="'.$prev_year.'">'.$prev_year.'</option>
                                                ';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label" for="oldSess">SSC Session</label>
                                        <select id="oldSess" class="form-control" name="oldSess">
                                            <option value="1" >ANNUAL</option>
                                            <option value="2">SUPPLEMENTARY</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">    
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-6">
                                        <label class="control-label" for="oldBrd_cd">SSC Board</label>
                                        <select id="sec_board" class="form-control" name="oldBrd_cd">
                                            <option value="1">BISE, GUJRANWALA</option>
                                            <option value="2">BISE,  LAHORE</option>
                                            <option value="3">BISE,  RAWALPINDI</option>
                                            <option value="4">BISE,  MULTAN</option>
                                            <option value="5">BISE,  FAISALABAD</option>
                                            <option value="6">BISE,  BAHAWALPUR</option>
                                            <option value="7">BISE,  SARGODHA</option>
                                            <option value="8">BISE,  DERA GHAZI KHAN</option>
                                            <option value="9">FBISE, ISLAMABAD</option>
                                            <option value="10">BISE, MIRPUR</option>
                                            <option value="11">BISE, ABBOTTABAD</option>
                                            <option value="12">BISE, PESHAWAR</option>
                                            <option value="13">BISE, KARACHI</option>
                                            <option value="14">BISE, QUETTA</option>
                                            <option value="15">BISE, MARDAN</option>
                                            <option value="17">CAMBRIDGE</option>
                                            <option value="18">AIOU, ISLAMABAD</option>
                                            <option value="19">BISE, KOHAT</option>
                                            <option value="20">KARAKURUM</option>
                                            <option value="21">MALAKAN</option>
                                            <option value="22">BISE, BANNU</option>
                                            <option value="23">BISE, D.I.KHAN</option>
                                            <option value="24">AKUEB, KARACHI</option>
                                            <option value="25">BISE, HYDERABAD</option>
                                            <option value="26">BISE, LARKANA</option>
                                            <option value="27">BISE, MIRPUR(SINDH)</option>
                                            <option value="28">BISE, SUKKUR</option>
                                            <option value="29">BISE, SWAT</option>
                                            <option value="30">SBTE KARACHI</option>
                                            <option value="31">PBTE, LAHORE</option>
                                            <option value="32">AFBHE RAWALPINDI</option>
                                            <option value="33">BIE, KARACHI</option>
                                            <option value="34">BISE SAHIWAL</option>
                                            <option value="35">ISLAMIC UNIVERSITY</option>                                
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">    
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-3">
                                        <input type="submit" value="Proceed" id="proceed" name="proceed" class="btn btn-primary btn-block">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="button" value="Cancel" onclick="return CancelAlert();"  class="btn btn-danger btn-block">
                                    </div>
                                </div>
                            </div>

                        </form>
                        <?php }?>

                    <hr class="colorgraph">
                </div>
            </div>
        </div>

    </div>

    <div class="form-group">    
        <div class="row">
            <div class="col-md-12">
                <h3 align="center" class="bold">Please follow this fee structure</h3>
            </div>
        </div>
    </div>

    <div class="form-group">    
        <div class="row">
            <div class="col-md-10">
                <img class="pull-right img-responsive" src="<?php echo base_url(); ?>assets/img/fee.jpg"  alt="Fee Structure"/>
            </div>
        </div>
    </div>

    <div class="form-group">    
        <div class="row">
            <div class="col-md-12">
                <h4 align="center" class="bold">Result will be RL-FEE if any student submit less fee than above criteria.</h4>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script> 
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/source/jquery.fancybox.pack.js"></script>    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/source/jquery.fancybox.js"></script>    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
    <script type="text/javascript">


        $(document).ready(function(){
            var oldYear = $('#oldYear option:selected').val()
            var sess = '<?php echo Session ?>';

            if(oldYear == '<?php echo $curr_Year ?>' && sess == '2'){
                $('#oldSess').empty();
                $("#oldSess").append('<option value="1">ANNUAL</option>'); 
            }
            else{
                $('#oldSess').empty();
                $("#oldSess").append('<option value="1">ANNUAL</option>'); 
                $("#oldSess").append('<option value="2">SUPPLEMENTARY</option>'); 
            }
        });

        $('#oldYear').change(function(){

            var oldYear = $('#oldYear option:selected').val()
            var sess = '<?php echo Session ?>';

            if(oldYear == '<?php echo $curr_Year ?>' && sess == '2'){
                $('#oldSess').empty();
                $("#oldSess").append('<option value="1">ANNUAL</option>'); 
            }
            else{
                $('#oldSess').empty();
                $("#oldSess").append('<option value="1">ANNUAL</option>'); 
                $("#oldSess").append('<option value="2">SUPPLEMENTARY</option>'); 
            }
        });

        function CancelAlert()
        {
            var msg = "Are You Sure You want to Cancel this Form ?"
            alertify.confirm(msg, function (e) {
                if (e) {
                    window.location.href ='<?php echo base_url(); ?>Admission';
                } else {
                }
            });
        }

        function validatenumber(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode( key );
            var regex = /^[0-9\b]+$/;    // allow only numbers [0-9]
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                alertify.error('Use Numeric Words Only');
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }

        $( "#txtDob" ).datepicker(
            {
                dateFormat: 'dd-mm-yy'
                ,changeMonth: true,changeYear:true
                , yearRange: '-50:'
                ,maxDate: '12-07-2004'
        }).val();

        function validateFormInterAdm() {

            var x = document.forms["ReturnStatus"]["txtMatRno"].value;
            var y = document.forms["ReturnStatus"]["oldRno"].value;
            if (x == null || x == "") {
                alertify.error("Matric Roll No Must be filled out");
                $('#txtMatRno').focus();
                return false;
            }
            if (y == null || y == "") {
                alertify.error("Last Appear Intermediate Roll No Must be filled out");
                $('#oldRno').focus();
                return false;
            }
            return true;
        } 


        $('#aloomCat').change(function(){

            var aloomCat =  $('#aloomCat').val();
            if(aloomCat == 2){
                $('#hideDivForAdeeb').hide();
                $("#changeCssAfter").removeClass("col-md-offset-3 col-md-3");
                $("#changeCssAfterHide").removeClass("col-md-3");
                $("#changeCssAfterHide").addClass("col-md-offset-3 col-md-6");
            }
            else{
                $('#hideDivForAdeeb').show();
                $("#changeCssAfterHide").removeClass("col-md-offset-3 col-md-3");
                $("#changeCssAfterHide").addClass("col-md-3");
                $("#changeCssAfter").addClass("col-md-offset-3 col-md-3");
            }

        });

        function validateFormInterAdmAloom()
        {   
            var aloomCat = $('#aloomCat').val();
            var txtMatRnoAloom = $('#txtMatRnoAloom').val();
            var oldRnoAloom = $('#oldRnoAloom').val();

            if(aloomCat == 1 && txtMatRnoAloom == '' )
            {
                alertify.error("Aloom Matric Roll No Must be filled out");
                $('#txtMatRnoAloom').focus();
                return false;   
            }

            else if(aloomCat == 1 && oldRnoAloom == '' )
            {
                alertify.error("Aloom Last Appear Intermediate Roll No Must be filled out");
                $('#oldRnoAloom').focus();
                return false;   
            }

            else if(aloomCat == 2 && oldRnoAloom == '' )
            {
                alertify.error("Aloom Last Appear Intermediate Roll No Must be filled out");
                $('#oldRnoAloom').focus();
                return false;   
            }
        }

    </script>
</div>