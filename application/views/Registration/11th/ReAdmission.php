<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <form name="std_fth_dob_frm" id="std_fth_dob_frm" action="<?=base_url()?>/index.php/Registration_11th/ReAdmission_check" method="post">
            <div class="row-fluid">
            <div class="span12">
            <div class="widget no-margin">
            <div class="widget-header">
                <div class="title">
                    Re-Admission<a data-original-title="" id="notifications">s</a>
                </div>
               
            </div>
            <div class="widget-body">
            <h4>
                Please Provide Below Information: 
            </h4>
            <hr>
            <div class="control-group">
                <label class="control-label span1">
                    Roll No. :
                </label>
                <div class="controls controls-row">
                    <input type="text"  id="oldRno" class="span3" name="oldRno" maxlength="6" required="required">

                    <label class="control-label span1" style="margin-left:11%;">
                        Year :
                    </label>
                    <select id="sec_year"  class="span3" name="oldYear">
                        <!--<option value="2014">2014</option> -->                           
                        <option value="2016" selected="selected">2016</option>                            
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label span1">
                    Session :
                </label>
                <div class="controls controls-row">
                    <select id="sec_session" class="span3" name="oldSess">
                        <option value="1" selected="selected">Annual</option>
                        <!--<option value="2">Supplementary</option>      -->
                    </select>

                    <label class="control-label span1" style="margin-left:11%;">
                        Board:
                    </label>
                    <select id="sec_board" class="span3" name="oldBrd_cd">
                         <option value="1">BISE, GUJRANWALA</option><option value="2">BISE,  LAHORE</option><option value="3">BISE,  RAWALPINDI</option><option value="4">BISE,  MULTAN</option><option value="5">BISE,  FAISALABAD</option><option value="6">BISE,  BAHAWALPUR</option><option value="7">BISE,  SARGODHA</option><option value="8">BISE,  DERA GHAZI KHAN</option><option value="9">FBISE, ISLAMABAD</option><option value="10">BISE, MIRPUR</option><option value="11">BISE, ABBOTTABAD</option><option value="12">BISE, PESHAWAR</option><option value="13">BSE, KARACHI</option><option value="14">BISE, QUETTA</option><option value="15">BISE, MARDAN</option><option value="17">CAMBRIDGE</option><option value="18">AIOU, ISLAMABAD</option><option value="19">BISE, KOHAT</option><option value="20">KARAKURUM</option><option value="21">MALAKAN</option><option value="22">BISE, BANNU</option><option value="23">BISE, D.I.KHAN</option><option value="24">AKUEB, KARACHI</option><option value="25">BISE, HYDERABAD</option><option value="26">BISE, LARKANA</option><option value="27">BISE, MIRPUR(SINDH)</option><option value="28">BISE, SUKKUR</option><option value="29">BISE, SWAT</option><option value="30">SBTE KARACHI</option><option value="31">PBTE, LAHORE</option><option value="32">AFBHE RAWALPINDI</option><option value="33">BIE, KARACHI</option><option value="34">BISE SAHIWAL</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="control-group"> 
                <div class="controls controls-row">
                    <input type="button" value="Proceed" id="proceed" name="proceed" onclick="return readmission();" class="btn btn-large btn-info offset4">
                    <input type="button" value="Cancel" onclick="return CancelAlert();" class="btn btn-large btn-danger ">
                </div>
            </div>
        
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        var error_readmission = "<?php echo @$error; ?>";
        if(error_readmission != "")
        {
            alertify.error(error);
        }  
    });
    function readmission()
    {

        var oldrno =  $('#oldRno').val();
        if(oldrno == 0 || oldrno == "")
        {
            alertify.error("Please Enter Old Roll No.");
            return false;
        }
        else if(oldrno.length != 6){
            alertify.error("Please Enter Correct Old Roll No.");
            return false;
        }
        else
        {
            $( "#std_fth_dob_frm" ).submit();
            //window.location.href = '//base_url() /index.php/Registration_11th/ReAdmission_check/'+oldrno+'/';
        }


    }

    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>index.php/Registration_11th/NewEnrolment';
            } else {
                // user clicked "cancel"

            }
        });
    }
</script>

