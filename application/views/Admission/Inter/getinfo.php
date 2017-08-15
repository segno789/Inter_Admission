<div class="form-group">    
    <div class="row">
        <div class="col-md-12">
            <h3 align="center" class="bold">1- Please Provide Your Previous Exam Information</h3>
        </div>
    </div>
</div>
<!--FORM START-->
<form enctype="multipart/form-data" id="ReturnStatus" name="ReturnStatus" onsubmit="return validateForm(this);" method="post" action="<?php echo base_url(); ?>Admission/Pre_Inter_data">
    <?php   
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
    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-3">
                <label class="control-label" for="txtMatRno" >Matric Roll No</label>
                <input type="text" class="form-control" onKeyPress="validatenumber(event);" maxlength="10" id="txtMatRno" required="required" name="txtMatRno" value="<?php  echo @$spl_cd['data']['txtMatRno'];  ?>" autofocus> 
            </div>
            <div class="col-md-3">
                <label class="control-label" for="oldRno" >Last Appear Inter Roll No.</label>
                <input type="text" class="form-control" onKeyPress="validatenumber(event);" maxlength="6" id="oldRno" required="required" name="oldRno"  maxlength="6" value="<?php echo @$spl_cd['data']['oldRno']; ?>" />
            </div>
        </div>
    </div>

    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-3">
                <label class="control-label" for="oldClass">Last Appearing Class</label>
                <select id="oldClass" class="form-control" name="oldClass">
                    <option value="11" >11th</option>
                    <option selected="selected" value="12">12th</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="control-label" for="oldYear">Last Appearing Year</label>
                <select id="oldYear" class="form-control" name="oldYear">
                    <?php
                    if(Session == 1){
                        echo'
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014" >2014</option>
                        <option value="2013">2013</option>
                        <option value="2012" >2012</option>
                        <option value="2011">2011</option>
                        <option value="2010" >2010</option>
                        <option value="2009">2009</option>
                        <option value="2008" >2008</option>
                        <option value="2007">2007</option>
                        <option value="2006" >2006</option>
                        <option value="2005">2005</option>
                        <option value="2004" >2004</option>
                        <option value="2003">2003</option>
                        <option value="2002" >2002</option>
                        <option value="2001">2001</option>
                        <option value="2000" >2000</option>
                        <option value="100" >Before 2000</option>';
                    }
                    else if(Session == 2){
                        echo'
                        <option value="2016" selected >2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
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
                <input type="submit" value="Proceed" id="proceed" name="proceed" class="btn btn-primary btn-block">
            </div>
            <div class="col-md-3">
                <input type="button" value="Cancel" onclick="return CancelAlert();"  class="btn btn-danger btn-block">
            </div>
        </div>
    </div>
</form>

<?php if(Session ==  1) {?>

    <hr class="colorgraph">

    <div class="form-group">    
        <div class="row">
            <div class="col-md-12">
                <h3 align="center" class="bold">2- Please Provide Your Matric Exam Information.(For Fresh in Both Part Appearing Students)</h3>
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
                            echo'
                            <option value="2015">2015</option>
                            <option value="2014" >2014</option>
                            <option value="2013">2013</option>
                            <option value="2012" >2012</option>
                            <option value="2011">2011</option>
                            <option value="2010" >2010</option>
                            <option value="2009">2009</option>
                            <option value="2008" >2008</option>
                            <option value="2007">2007</option>
                            <option value="2006" >2006</option>
                            <option value="2005">2005</option>
                            <option value="2004" >2004</option>
                            <option value="2003">2003</option>
                            <option value="2002" >2002</option>
                            <option value="2001">2001</option>
                            <option value="2000" >2000</option>
                            <option value="100" >Before 2000</option>';
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
                    </select>
                </div>
            </div>
        </div>


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
        ?>
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



<script type="text/javascript">

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

    function validateForm() {
        var x = document.forms["ReturnStatus"]["txtMatRno"].value;
        var y = document.forms["ReturnStatus"]["oldRno"].value;
        if (x == null || x == "") {
            alert("Matric Roll No Must be filled out");
            return false;
        }
        if (y == null || y == "") {
            alert("Last Appear Intermediate Roll No Must be filled out");
            return false;
        }
    } 
</script>

