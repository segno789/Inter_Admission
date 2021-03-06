
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
                    <form enctype="multipart/form-data" id="ReturnStatus" name="ReturnStatus"  method="post" action="<?php echo base_url(); ?>Admission/Pre_Inter_data">

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
                                            <option value="11" <?php if(@$spl_cd['data']['oldClass'] == 11) echo 'selected' ?>>11th</option>
                                            <option value="12" <?php if(@$spl_cd['data']['oldClass'] == 12) echo 'selected' ?>>12th</option>
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
                                                ?>
                                                <option value="<?php echo $i ?>" <?php if(@$spl_cd['data']['oldYear'] == $i) echo 'selected' ?> ><?php echo $i;?></option>
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
                                        <option value="1" <?php if(@$spl_cd['data']['oldSess'] == "1") echo 'selected'?>>ANNUAL</option>
                                        <option value="2" <?php if(@$spl_cd['data']['oldSess'] == "2") echo 'selected'?>>SUPPLEMENTARY</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label" for="sec_board" >Last Appearing Board</label>
                                    <select id="sec_board" class="form-control" name="oldBrd_cd">
                                        <option value="1" <?php if(@$spl_cd['data']['oldBrd_cd'] == 1) echo 'selected'?>>BISE, GUJRANWALA</option>
                                        <option value="2" <?php if(@$spl_cd['data']['oldBrd_cd'] == 2) echo 'selected'?>>BISE,  LAHORE</option>
                                        <option value="3" <?php if(@$spl_cd['data']['oldBrd_cd'] == 3) echo 'selected'?>>BISE,  RAWALPINDI</option>
                                        <option value="4" <?php if(@$spl_cd['data']['oldBrd_cd'] == 4) echo 'selected'?>>BISE,  MULTAN</option>
                                        <option value="5" <?php if(@$spl_cd['data']['oldBrd_cd'] == 5) echo 'selected'?>>BISE,  FAISALABAD</option>
                                        <option value="6" <?php if(@$spl_cd['data']['oldBrd_cd'] == 6) echo 'selected'?>>BISE,  BAHAWALPUR</option>
                                        <option value="7" <?php if(@$spl_cd['data']['oldBrd_cd'] == 7) echo 'selected'?>>BISE,  SARGODHA</option>
                                        <option value="8" <?php if(@$spl_cd['data']['oldBrd_cd'] == 8) echo 'selected'?>>BISE,  DERA GHAZI KHAN</option>
                                        <option value="9" <?php if(@$spl_cd['data']['oldBrd_cd'] == 9) echo 'selected'?>>FBISE, ISLAMABAD</option>
                                        <option value="10" <?php if(@$spl_cd['data']['oldBrd_cd'] == 10) echo 'selected'?>>BISE, MIRPUR</option>
                                        <option value="11" <?php if(@$spl_cd['data']['oldBrd_cd'] == 11) echo 'selected'?>>BISE, ABBOTTABAD</option>
                                        <option value="12" <?php if(@$spl_cd['data']['oldBrd_cd'] == 12) echo 'selected'?>>BISE, PESHAWAR</option>
                                        <option value="13" <?php if(@$spl_cd['data']['oldBrd_cd'] == 13) echo 'selected'?>>BISE, KARACHI</option>
                                        <option value="14" <?php if(@$spl_cd['data']['oldBrd_cd'] == 14) echo 'selected'?>>BISE, QUETTA</option>
                                        <option value="15" <?php if(@$spl_cd['data']['oldBrd_cd'] == 15) echo 'selected'?>>BISE, MARDAN</option>
                                        <option value="17" <?php if(@$spl_cd['data']['oldBrd_cd'] == 17) echo 'selected'?>>CAMBRIDGE</option>
                                        <option value="18" <?php if(@$spl_cd['data']['oldBrd_cd'] == 18) echo 'selected'?>>AIOU, ISLAMABAD</option>
                                        <option value="19" <?php if(@$spl_cd['data']['oldBrd_cd'] == 19) echo 'selected'?>>BISE, KOHAT</option>
                                        <option value="20" <?php if(@$spl_cd['data']['oldBrd_cd'] == 20) echo 'selected'?>>KARAKURUM</option>
                                        <option value="21" <?php if(@$spl_cd['data']['oldBrd_cd'] == 21) echo 'selected'?>>MALAKAN</option>
                                        <option value="22" <?php if(@$spl_cd['data']['oldBrd_cd'] == 22) echo 'selected'?>>BISE, BANNU</option>
                                        <option value="23" <?php if(@$spl_cd['data']['oldBrd_cd'] == 23) echo 'selected'?>>BISE, D.I.KHAN</option>
                                        <option value="24" <?php if(@$spl_cd['data']['oldBrd_cd'] == 24) echo 'selected'?>>AKUEB, KARACHI</option>
                                        <option value="25" <?php if(@$spl_cd['data']['oldBrd_cd'] == 25) echo 'selected'?>>BISE, HYDERABAD</option>
                                        <option value="26" <?php if(@$spl_cd['data']['oldBrd_cd'] == 26) echo 'selected'?>>BISE, LARKANA</option>
                                        <option value="27" <?php if(@$spl_cd['data']['oldBrd_cd'] == 27) echo 'selected'?>>BISE, MIRPUR(SINDH)</option>
                                        <option value="28" <?php if(@$spl_cd['data']['oldBrd_cd'] == 28) echo 'selected'?>>BISE, SUKKUR</option>
                                        <option value="29" <?php if(@$spl_cd['data']['oldBrd_cd'] == 29) echo 'selected'?>>BISE, SWAT</option>
                                        <option value="30" <?php if(@$spl_cd['data']['oldBrd_cd'] == 30) echo 'selected'?>>SBTE KARACHI</option>
                                        <option value="31" <?php if(@$spl_cd['data']['oldBrd_cd'] == 31) echo 'selected'?>>PBTE, LAHORE</option>
                                        <option value="32" <?php if(@$spl_cd['data']['oldBrd_cd'] == 32) echo 'selected'?>>AFBHE RAWALPINDI</option>
                                        <option value="33" <?php if(@$spl_cd['data']['oldBrd_cd'] == 33) echo 'selected'?>>BIE, KARACHI</option>
                                        <option value="34" <?php if(@$spl_cd['data']['oldBrd_cd'] == 34) echo 'selected'?>>BISE SAHIWAL</option>
                                        <option value="35" <?php if(@$spl_cd['data']['oldBrd_cd'] == 35) echo 'selected'?>>ISLAMIC UNIVERSITY</option>                                
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
                                        <option value="1" <?php if(@$spl_cd['data']['boardAloom'] == 1) echo 'selected'?>>BISE, GUJRANWALA</option>
                                        <?php
                                        if(Session == 1){
                                            ?>
                                            <option value="2" <?php if(@$spl_cd['data']['boardAloom'] == 2) echo 'selected'?>>BISE,  LAHORE</option>
                                            <option value="3" <?php if(@$spl_cd['data']['boardAloom'] == 3) echo 'selected'?>>BISE,  RAWALPINDI</option>
                                            <option value="4" <?php if(@$spl_cd['data']['boardAloom'] == 4) echo 'selected'?>>BISE,  MULTAN</option>
                                            <option value="5" <?php if(@$spl_cd['data']['boardAloom'] == 5) echo 'selected'?>>BISE,  FAISALABAD</option>
                                            <option value="6" <?php if(@$spl_cd['data']['boardAloom'] == 6) echo 'selected'?>>BISE,  BAHAWALPUR</option>
                                            <option value="7" <?php if(@$spl_cd['data']['boardAloom'] == 7) echo 'selected'?>>BISE,  SARGODHA</option>
                                            <option value="8" <?php if(@$spl_cd['data']['boardAloom'] == 8) echo 'selected'?>>BISE,  DERA GHAZI KHAN</option>
                                            <option value="9" <?php if(@$spl_cd['data']['boardAloom'] == 9) echo 'selected'?>>FBISE, ISLAMABAD</option>
                                            <option value="10" <?php if(@$spl_cd['data']['boardAloom'] == 10) echo 'selected'?>>BISE, MIRPUR</option>
                                            <option value="11" <?php if(@$spl_cd['data']['boardAloom'] == 11) echo 'selected'?>>BISE, ABBOTTABAD</option>
                                            <option value="12" <?php if(@$spl_cd['data']['boardAloom'] == 12) echo 'selected'?>>BISE, PESHAWAR</option>
                                            <option value="13" <?php if(@$spl_cd['data']['boardAloom'] == 13) echo 'selected'?>>BISE, KARACHI</option>
                                            <option value="14" <?php if(@$spl_cd['data']['boardAloom'] == 14) echo 'selected'?>>BISE, QUETTA</option>
                                            <option value="15" <?php if(@$spl_cd['data']['boardAloom'] == 15) echo 'selected'?>>BISE, MARDAN</option>
                                            <option value="17" <?php if(@$spl_cd['data']['boardAloom'] == 17) echo 'selected'?>>CAMBRIDGE</option>
                                            <option value="18" <?php if(@$spl_cd['data']['boardAloom'] == 18) echo 'selected'?>>AIOU, ISLAMABAD</option>
                                            <option value="19" <?php if(@$spl_cd['data']['boardAloom'] == 19) echo 'selected'?>>BISE, KOHAT</option>
                                            <option value="20" <?php if(@$spl_cd['data']['boardAloom'] == 20) echo 'selected'?>>KARAKURUM</option>
                                            <option value="21" <?php if(@$spl_cd['data']['boardAloom'] == 21) echo 'selected'?>>MALAKAN</option>
                                            <option value="22" <?php if(@$spl_cd['data']['boardAloom'] == 22) echo 'selected'?>>BISE, BANNU</option>
                                            <option value="23" <?php if(@$spl_cd['data']['boardAloom'] == 23) echo 'selected'?>>BISE, D.I.KHAN</option>
                                            <option value="24" <?php if(@$spl_cd['data']['boardAloom'] == 24) echo 'selected'?>>AKUEB, KARACHI</option>
                                            <option value="25" <?php if(@$spl_cd['data']['boardAloom'] == 25) echo 'selected'?>>BISE, HYDERABAD</option>
                                            <option value="26" <?php if(@$spl_cd['data']['boardAloom'] == 26) echo 'selected'?>>BISE, LARKANA</option>
                                            <option value="27" <?php if(@$spl_cd['data']['boardAloom'] == 27) echo 'selected'?>>BISE, MIRPUR(SINDH)</option>
                                            <option value="28" <?php if(@$spl_cd['data']['boardAloom'] == 28) echo 'selected'?>>BISE, SUKKUR</option>
                                            <option value="29" <?php if(@$spl_cd['data']['boardAloom'] == 29) echo 'selected'?>>BISE, SWAT</option>
                                            <option value="30" <?php if(@$spl_cd['data']['boardAloom'] == 30) echo 'selected'?>>SBTE KARACHI</option>
                                            <option value="31" <?php if(@$spl_cd['data']['boardAloom'] == 31) echo 'selected'?>>PBTE, LAHORE</option>
                                            <option value="32" <?php if(@$spl_cd['data']['boardAloom'] == 32) echo 'selected'?>>AFBHE RAWALPINDI</option>
                                            <option value="33" <?php if(@$spl_cd['data']['boardAloom'] == 33) echo 'selected'?>>BIE, KARACHI</option>
                                            <option value="34" <?php if(@$spl_cd['data']['boardAloom'] == 34) echo 'selected'?>>BISE SAHIWAL</option>
                                            <option value="35" <?php if(@$spl_cd['data']['boardAloom'] == 35) echo 'selected'?>>ISLAMIC UNIVERSITY</option>                                
                                        </select>
                                        <?php } ?>
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
                                            <option value="1" <?php if(@$spl_cd['data']['oldSess'] == 1) echo 'selected'?>>ANNUAL</option>
                                            <option value="2" <?php if(@$spl_cd['data']['oldSess'] == 2) echo 'selected'?>>SUPPLEMENTARY</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">    
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-6">
                                        <label class="control-label" for="sec_board">SSC Board</label>
                                        <select id="sec_board" class="form-control" name="oldBrd_cd">
                                            <option value="1" <?php if(@$spl_cd['data']['oldBrd_cd'] == 1) echo 'selected'?>>BISE, GUJRANWALA</option>
                                            <option value="2" <?php if(@$spl_cd['data']['oldBrd_cd'] == 2) echo 'selected'?>>BISE,  LAHORE</option>
                                            <option value="3" <?php if(@$spl_cd['data']['oldBrd_cd'] == 3) echo 'selected'?>>BISE,  RAWALPINDI</option>
                                            <option value="4" <?php if(@$spl_cd['data']['oldBrd_cd'] == 4) echo 'selected'?>>BISE,  MULTAN</option>
                                            <option value="5" <?php if(@$spl_cd['data']['oldBrd_cd'] == 5) echo 'selected'?>>BISE,  FAISALABAD</option>
                                            <option value="6" <?php if(@$spl_cd['data']['oldBrd_cd'] == 6) echo 'selected'?>>BISE,  BAHAWALPUR</option>
                                            <option value="7" <?php if(@$spl_cd['data']['oldBrd_cd'] == 7) echo 'selected'?>>BISE,  SARGODHA</option>
                                            <option value="8" <?php if(@$spl_cd['data']['oldBrd_cd'] == 8) echo 'selected'?>>BISE,  DERA GHAZI KHAN</option>
                                            <option value="9" <?php if(@$spl_cd['data']['oldBrd_cd'] == 9) echo 'selected'?>>FBISE, ISLAMABAD</option>
                                            <option value="10" <?php if(@$spl_cd['data']['oldBrd_cd'] == 10) echo 'selected'?>>BISE, MIRPUR</option>
                                            <option value="11" <?php if(@$spl_cd['data']['oldBrd_cd'] == 11) echo 'selected'?>>BISE, ABBOTTABAD</option>
                                            <option value="12" <?php if(@$spl_cd['data']['oldBrd_cd'] == 12) echo 'selected'?>>BISE, PESHAWAR</option>
                                            <option value="13" <?php if(@$spl_cd['data']['oldBrd_cd'] == 13) echo 'selected'?>>BISE, KARACHI</option>
                                            <option value="14" <?php if(@$spl_cd['data']['oldBrd_cd'] == 14) echo 'selected'?>>BISE, QUETTA</option>
                                            <option value="15" <?php if(@$spl_cd['data']['oldBrd_cd'] == 15) echo 'selected'?>>BISE, MARDAN</option>
                                            <option value="17" <?php if(@$spl_cd['data']['oldBrd_cd'] == 17) echo 'selected'?>>CAMBRIDGE</option>
                                            <option value="18" <?php if(@$spl_cd['data']['oldBrd_cd'] == 18) echo 'selected'?>>AIOU, ISLAMABAD</option>
                                            <option value="19" <?php if(@$spl_cd['data']['oldBrd_cd'] == 19) echo 'selected'?>>BISE, KOHAT</option>
                                            <option value="20" <?php if(@$spl_cd['data']['oldBrd_cd'] == 20) echo 'selected'?>>KARAKURUM</option>
                                            <option value="21" <?php if(@$spl_cd['data']['oldBrd_cd'] == 21) echo 'selected'?>>MALAKAN</option>
                                            <option value="22" <?php if(@$spl_cd['data']['oldBrd_cd'] == 22) echo 'selected'?>>BISE, BANNU</option>
                                            <option value="23" <?php if(@$spl_cd['data']['oldBrd_cd'] == 23) echo 'selected'?>>BISE, D.I.KHAN</option>
                                            <option value="24" <?php if(@$spl_cd['data']['oldBrd_cd'] == 24) echo 'selected'?>>AKUEB, KARACHI</option>
                                            <option value="25" <?php if(@$spl_cd['data']['oldBrd_cd'] == 25) echo 'selected'?>>BISE, HYDERABAD</option>
                                            <option value="26" <?php if(@$spl_cd['data']['oldBrd_cd'] == 26) echo 'selected'?>>BISE, LARKANA</option>
                                            <option value="27" <?php if(@$spl_cd['data']['oldBrd_cd'] == 27) echo 'selected'?>>BISE, MIRPUR(SINDH)</option>
                                            <option value="28" <?php if(@$spl_cd['data']['oldBrd_cd'] == 28) echo 'selected'?>>BISE, SUKKUR</option>
                                            <option value="29" <?php if(@$spl_cd['data']['oldBrd_cd'] == 29) echo 'selected'?>>BISE, SWAT</option>
                                            <option value="30" <?php if(@$spl_cd['data']['oldBrd_cd'] == 30) echo 'selected'?>>SBTE KARACHI</option>
                                            <option value="31" <?php if(@$spl_cd['data']['oldBrd_cd'] == 31) echo 'selected'?>>PBTE, LAHORE</option>
                                            <option value="32" <?php if(@$spl_cd['data']['oldBrd_cd'] == 32) echo 'selected'?>>AFBHE RAWALPINDI</option>
                                            <option value="33" <?php if(@$spl_cd['data']['oldBrd_cd'] == 33) echo 'selected'?>>BIE, KARACHI</option>
                                            <option value="34" <?php if(@$spl_cd['data']['oldBrd_cd'] == 34) echo 'selected'?>>BISE SAHIWAL</option>
                                            <option value="35" <?php if(@$spl_cd['data']['oldBrd_cd'] == 35) echo 'selected'?>>ISLAMIC UNIVERSITY</option>                                
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