

 <div class="dashboard-wrapper class wysihtml5-supported">
<div class="left-sidebar">
    <form enctype="multipart/form-data" id="ReturnStatus" name="ReturnStatus" method="post" action="<?php echo base_url(); ?>Admission_11th_pvt/NewEnrolmentPVT" >
        <div class="row-fluid">
        <div class="span12">
        <div class="widget no-margin">
        <div class="widget-header">
            <div class="title">
                Please Provide Below Information<a data-original-title="" id="notifications"></a>
            </div>
           
        </div>
        <div class="widget-body">


        <div class="control-group">
            <label class="control-label span1">
                 SSC Roll No. :
            </label>
            <div class="controls controls-row">
                <input type="text"  id="oldRno" class="span3" name="oldRno" maxlength="6" required="required"  value="" maxlength="10">
                <label class="control-label span1" style="margin-left:11%;">
                    SSC Year :
                </label>
                <select id="oldYear" class="span3" name="oldYear">
                    <?php
                    // DebugBreak();



                    $current_year = date("Y");
                    $prev_year = date("Y",strtotime("-1 year"));

                    if($gender== 1){ ?>
                        <option value="<?php echo $current_year;  ?>"><?php echo $current_year;  ?></option>
                        <option value="<?php echo $prev_year; ?>" ><?php echo $prev_year; ?></option>  
                        <option value="<?php echo date("Y",strtotime("-2 year")); ?>" ><?php echo date("Y",strtotime("-2 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-3 year")); ?>" ><?php echo date("Y",strtotime("-3 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-4 year")); ?>" ><?php echo date("Y",strtotime("-4 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-5 year")); ?>" ><?php echo date("Y",strtotime("-5 year")); ?></option>  
                        <?php }
                    else{?>
                        <option value="<?php echo $current_year;  ?>"><?php echo $current_year;  ?></option>
                        <option value="<?php echo $prev_year; ?>" ><?php echo $prev_year; ?></option>  
                        <option value="<?php echo date("Y",strtotime("-2 year")); ?>" ><?php echo date("Y",strtotime("-2 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-3 year")); ?>" ><?php echo date("Y",strtotime("-3 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-4 year")); ?>" ><?php echo date("Y",strtotime("-4 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-5 year")); ?>" ><?php echo date("Y",strtotime("-5 year")); ?></option>  
                        <?php }    
                    ?>


                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label span1">
                SSC Session :
            </label>
            <div class="controls controls-row">
                <select id="oldSess" class="span3" name="oldSess">
                    <option value="1" >Annual</option>
                    <option value="2">Supplementary</option>
                </select>

                <label class="control-label span1" style="margin-left:11%;">
                    SSC Board:
                </label>
                <select id="sec_board" class="span3" name="oldBrd_cd">
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
                    <option value="13">BSE, KARACHI</option>
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
                </select>
            </div>
        </div>
        <hr>
        <div class="control-group" style="width: 50%;"> 
         <label class="control-label span1">
               
            </label>
            
                <input type="submit" value="Next" id="proceedbtn" name="proceedbtn" onclick="return proceed11th();" class="btn btn-large btn-info offset4" style="width: 150px;">
                <input type="button" value="Cancel" onclick="return CancelAlert();" class="btn btn-large btn-danger">
                <br/>
                <br/>
                <br/>
                <input type="submit" value="Apply for ADEEB & ALAM Languages Examination" id="proceedbtn_lang" name="proceedbtn_lang" onclick="return proceed11th_lang();" class="btn btn-large btn-success offset4">
           
        </div>

    
    </form>
</div>



</div>




<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">    </link>
<script type="">
function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                window.location.href ='<?php echo base_url(); ?>Admission_11th_pvt';
            } else {
            }
        });
    }
 function proceed11th()
{
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "Admission_11th_pvt/Get_students_record/",
            dataType: 'html',
            data: $( '#ReturnStatus' ).serialize(),
            beforeSend: function() {  $('.mPageloader').show(); },
            complete: function() { $('.mPageloader').hide();},
            success: function(data)
            {
                var obj = JSON.parse(data) ;
                console.log(obj)
                if(obj.excep == 'success')
                {
                   $('#ReturnStatus').submit();
                }
                else
                {
                    alertify.error(obj.excep);
                }

            },
            error: function(request, status, error){
                alertify.error(request.responseText);
            }
        });

        return false;

}
function proceed11th_lang()
{
         var msg = "Are You Sure You want to Apply for Languages Examination?"
        alertify.confirm(msg, function (e) {
            if (e) {
                window.location.href ='<?php echo base_url(); ?>Admission_11th_pvt/NewEnrolmentPVT_Lang';
            } else {
            }
        });

       

}
    
</script>