<div class="dashboard-wrapper">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title" style="float: none !important;">
                            <label class="welcome_note myEngheading" style="float: left;">Please Provide Your Previous Exam Information</label>
                            <label class="myUrduheading" style="float: right;"> براۓ مہربانی سابقہ امتحان کی معلومات فراہم کریں </label>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div id="dt_example" class="example_alt_pagination">
                            <div class="info"  style="position:relative;margin:0;padding:0;overflow:hidden;">
                                <!--FORM START-->
                                <form enctype="multipart/form-data" id="ReturnStatus" name="ReturnStatus" onsubmit="return validateForm(this);" method="post" action="<?php echo base_url(); ?>Admission/Pre_Inter_data">
                                    <table width="99%" class="tbl_form fresh_cand" >
                                        <tbody>
                                            <tr>
                                                <td><label class=mytblmargin style="margin-right: 62px;"><b>Matric Roll No.</b><br /></label></td>
                                                <td><input type="text" class="panjang required custom" onKeyPress="validatenumber(event);" maxlength="10" id="txtMatRno" required="required" name="txtMatRno" value="<?php  echo @$spl_cd['data']['txtMatRno'];  ?>"></td> 
                                                <td><label class=mytblmargin style="margin-right: 51px;"><b>Last Appear Inter Roll No.</b><br /></label></td>
                                                <td><input type="text" class="panjang custom required" onKeyPress="validatenumber(event);" maxlength="6" id="oldRno" required="required" name="oldRno"  maxlength="6" value="<?php echo @$spl_cd['data']['oldRno']; ?>" /></td>
                                            </tr>
                                            <tr>
                                                <td><label class=mytblmargin style="margin-right: 17px;"><b>Last Appearing Class</b><br /></label></td>
                                                <td><select id="oldClass" class="custom" name="oldClass">
                                                        <option value="11" >11th</option>
                                                        <option selected="selected" value="12">12th</option>
                                                    </select></td>
                                                <td><label class=mytblmargin style="margin-right: 86px;"><b>Last Appearing Year</b><br /></label></td>
                                                <td><select id="oldYear" class="custom" name="oldYear">
                                                        <?php
                                                        if(Session == 1){
                                                            echo'
                                                            <option value="2016" selected>2016</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2014" >2014</option>
                                                            <option value="2013">2013</option>
                                                            <option value="2012" >2012</option>
                                                            <option value="2011">2011</option>
                                                            <option value="2010" >2010</option>
                                                            <option value="2009">2009</option>
                                                            <option value="2008" >2008</option>
                                                            <option value="2007">2007</option>
                                                            <option value="100" >Before 2007</option>';
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
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class=mytblmargin><b>Last Appearing Session</b><br /></label></td>
                                                <td><select id="oldSess" class="custom" name="oldSess">
                                                        <option value="1" >ANNUAL</option>
                                                        <option value="2">SUPPLEMENTARY</option>
                                                    </select>
                                                </td>
                                                <td><label class=mytblmargin style="margin-right: 74px;" ><b>Last Appearing Board</b><br /></label></td>
                                                <td>
                                                    <select id="sec_board" class="custom" name="oldBrd_cd">
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
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <label style="font-size: 23px;"> <input type="checkbox" name="isaloom" id="isaloom" style="width: 24px; height: 24px;">  <u>Aloom-e-Sharkia Examination</u> </label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php
                                    // DebugBreak();
                                    if( @$spl_cd['exam_type']==14 ||@$spl_cd['exam_type']==15 || @$spl_cd['exam_type']==16 )
                                    { 
                                        ?>
                                        <div align="center" id="option"  >
                                            <input type="radio" class="nationality_class" id="CatType1" value="1" checked="checked" name="CatType" style="width: 24px;height: 24px;">
                                            Marks Improvement 
                                            <input type="radio" class="nationality_class" id="CatType2" value="2" name="CatType" style="width: 24px;height: 24px;">
                                            Additional</br>
                                            <input type="hidden" value="" name="h_exam_type" id="h_exam_type" />
                                            <input type="hidden" value="" name="exam_type" id="exam_type" />      
                                        </div>
                                        <?php     }
                                    ?>


                                    <div>
                                        <?php echo @$spl_cd['error_msg']; ?>
                                    </div>
                                    <div style="vertical-align:bottom;margin-top: 20px;">
                                        <input type="submit" value="Proceed" id="proceed" name="proceed" class="jbtn jmedium jblack">
                                        <input type="button" value="Cancel" onclick="return CancelAlert();"  class="jbtn jmedium jblack">
                                    </div>
                                    <?php $labelvalue = "INVALID INFORMATION PLEASE PROVIDE CORRECT INFORMATION";?>
                                    <div>
                                        <label name="lblerror" id="lblerror" class="hidden" style="color:red; font-weight: bolder; margin-top:30px;" ><?php echo $labelvalue; ?></label>
                                        <?php
                                        // echo @$spl_cd;
                                        ?>
                                    </div>
                                </form>













                                <?php if(Session ==  1) {?>


                                    <div class="left-sidebar">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div class="widget-header">
                                                    <div class="title" style="float: none !important;">
                                                        <label class="welcome_note myEngheading" style="float: left;">Please Provide Your Matric Exam Information.(For Fresh in Both Part Appearing Students)</label>
                                                        <label class="myUrduheading" style="float: right;"> براۓ مہربانی سابقہ امتحان کی معلومات فراہم کریں </label>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>

                                    <form enctype="multipart/form-data" id="getPervRec" name="getPervRec" method="post" action="<?php echo base_url(); ?>Admission/Pre_Matric_data">
                                        <table width="99%" class="tbl_form fresh_cand" >
                                            <tbody>
                                                <tr>

                                                     <td><label class=mytblmargin style="margin-right: 62px;"><b>Date of Birth</b><br /></label></td>
                                                    <td><input type="text" class="panjang required custom" onKeyPress="validatenumber(event);" maxlength="10" id="txtDob" onclick="return maskdob(this);" required="required" name="txtDob" value=""></td> 

                                                    <td><label class=mytblmargin><b>Matric Roll No.</b><br /></label></td>
                                                    <td><input type="text" class="panjang required custom" onKeyPress="validatenumber(event);" maxlength="10" id="txtMatRno" required="required" name="txtMatRno" value=""></td> 

                                                   



                                                </tr>
                                                <tr>

                                                 <td><label class=mytblmargin style="margin-right: 80px;"><b>SSC Year</b><br /></label></td>
                                                    <td><select id="oldYear" class="custom" name="oldYear">
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
                                                                echo'
                                                                <option value="2016" selected >2016</option>
                                                                <option value="2015">2015</option>
                                                                <option value="2014">2014</option>

                                                                ';
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td><label class=mytblmargin><b>SSC Session</b><br /></label></td>
                                                    <td><select id="oldSess" class="custom" name="oldSess">
                                                            <option value="1" >ANNUAL</option>
                                                            <option value="2">SUPPLEMENTARY</option>
                                                        </select>
                                                    </td>
                                                   

                                                </tr>
                                                <tr>
                                                 <td><label class=mytblmargin style="margin-right: 74px;" ><b>SSC Board</b><br /></label></td>
                                                    <td>
                                                        <select id="sec_board" class="custom" name="oldBrd_cd">
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
                                                    </td>


                                                </tr>

                                            </tbody>
                                        </table>

                                        <div style="vertical-align:bottom;margin-top: 20px;">
                                            <input type="submit" value="Proceed" id="proceed" name="proceed" class="jbtn jmedium jblack" onclick="return proceed12th()">
                                            <input type="button" value="Cancel" onclick="return CancelAlert();"  class="jbtn jmedium jblack">
                                        </div>
                                    </form>
                                    <?php }?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<p><strong style=" font-size: 24px;"> Please follow this fee structure </strong></p>
<img src="<?php echo base_url(); ?>assets/img/fee.jpg"  alt="Fee Structure"/>
<p><strong> Result will be RL-FEE if any student submit less fee than above criteria.</strong></p>




<script type="text/javascript">

    function proceed12th()
    {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "Admission/Get_students_record/",
            dataType: 'html',
            data: $( '#getPervRec' ).serialize(),
            beforeSend: function() {  $('.mPageloader').show(); },
            complete: function() { $('.mPageloader').hide();},
            success: function(data)
            {
                var obj = JSON.parse(data) ;
                if(obj.excep == 'success')
                {
                    $('#getPervRec').submit();
                }
                else
                {
                    alertify.error(obj.excep);
                }

            },
            error: function(request, status, error){
                $('.mPageloader').hide();
                alertify.error(request.responseText);
            }
        });

        return false;

    }


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
            if(theEvent.preventDefault) theEvent.preventDefault();

        }
    }


    function maskdob(){

        $(document.getElementById("txtDob")).mask("99-99-9999", { placeholder: "DD-MM-YYYY" });
    }

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

