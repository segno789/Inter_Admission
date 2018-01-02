
<div class = "container">
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
                <input type="text" class="form-control"  onKeyPress="validatenumber(event);" maxlength="7" id="oldRno" required="required" name="oldRno" value="" autofocus> 
            </div>
            <div class="col-md-3">
                <label class="control-label" for="oldYear" >SSC YEAR</label>
                <select id="oldYear" class="form-control"  name="oldYear">
                    <?php
                    // DebugBreak();



                    $current_year = date("Y");
                    $prev_year = date("Y",strtotime("-1 year"));

                    if($gender== 1){ ?>

                        <option value="<?php echo $prev_year; ?>" ><?php echo $prev_year; ?></option>  
                        <option value="<?php echo date("Y",strtotime("-2 year")); ?>" ><?php echo date("Y",strtotime("-2 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-3 year")); ?>" ><?php echo date("Y",strtotime("-3 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-4 year")); ?>" ><?php echo date("Y",strtotime("-4 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-5 year")); ?>" ><?php echo date("Y",strtotime("-5 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-6 year")); ?>" ><?php echo date("Y",strtotime("-6 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-7 year")); ?>" ><?php echo date("Y",strtotime("-7 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-8 year")); ?>" ><?php echo date("Y",strtotime("-8 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-9 year")); ?>" ><?php echo date("Y",strtotime("-9 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-10 year")); ?>" ><?php echo date("Y",strtotime("-10 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-11 year")); ?>" ><?php echo date("Y",strtotime("-11 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-12 year")); ?>" ><?php echo date("Y",strtotime("-12 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-13 year")); ?>" ><?php echo date("Y",strtotime("-13 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-14 year")); ?>" ><?php echo date("Y",strtotime("-14 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-15 year")); ?>" ><?php echo date("Y",strtotime("-15 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-16 year")); ?>" ><?php echo date("Y",strtotime("-16 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-17 year")); ?>" ><?php echo date("Y",strtotime("-17 year")); ?></option>  
                        <option value="-1" >Before 2000</option>  
                        <?php }
                    else{?>
                        <option value="<?php echo $prev_year; ?>" ><?php echo $prev_year; ?></option>  
                        <option value="<?php echo date("Y",strtotime("-2 year")); ?>" ><?php echo date("Y",strtotime("-2 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-3 year")); ?>" ><?php echo date("Y",strtotime("-3 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-4 year")); ?>" ><?php echo date("Y",strtotime("-4 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-5 year")); ?>" ><?php echo date("Y",strtotime("-5 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-6 year")); ?>" ><?php echo date("Y",strtotime("-6 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-7 year")); ?>" ><?php echo date("Y",strtotime("-7 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-8 year")); ?>" ><?php echo date("Y",strtotime("-8 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-9 year")); ?>" ><?php echo date("Y",strtotime("-9 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-10 year")); ?>" ><?php echo date("Y",strtotime("-10 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-11 year")); ?>" ><?php echo date("Y",strtotime("-11 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-12 year")); ?>" ><?php echo date("Y",strtotime("-12 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-13 year")); ?>" ><?php echo date("Y",strtotime("-13 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-14 year")); ?>" ><?php echo date("Y",strtotime("-14 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-15 year")); ?>" ><?php echo date("Y",strtotime("-15 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-16 year")); ?>" ><?php echo date("Y",strtotime("-16 year")); ?></option>  
                        <option value="<?php echo date("Y",strtotime("-17 year")); ?>" ><?php echo date("Y",strtotime("-17 year")); ?></option>  
                        <option value="-1" >Before 2000</option>  
                        <?php }    
                    ?>


                </select>
            </div>

        </div>
    </div>
    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-3">
                <label class="control-label">
                    SSC Session :
                </label>
                <select id="oldSess" class="form-control" name="oldSess">
                    <option value="1" >Annual</option>
                    <option value="2">Supplementary</option>
                </select>

            </div>
            <div class="col-md-3">
                <label class="control-label">
                    SSC Board
                </label>
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
    </div>
    <div class="form-group">    
        <div class="row">


            <div class="col-md-offset-3 col-md-3">
                <input type="submit" value="Next" id="proceedbtn" name="proceedbtn" onclick="return proceed11th();"  class="btn btn-primary btn-block">
            </div>
            <div class="col-md-3">
                <input type="button" value="Cancel" onclick="return CancelAlert();"  class="btn btn-danger btn-block">
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-4 col-md-3">

            </div>
        </div>
    </div>
    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <input type="button" value="Apply for ADEEB & ALAM Languages Examination" id="proceedbtn_lang" name="proceedbtn_lang" onclick="return proceed11th_lang();" class="btn btn-success btn-block">

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


        if( $('#oldRno').val() == '')
        {
            alertify.error("Please enter the SSC Roll No.");
            return false;
        }
        else if( (($('#oldRno').val() <400000 && $('#oldYear').val() >=2014 && $('#oldSess').val() == 1) ) && $('#sec_board').val() == 1 )
        {
            alertify.error("Please enter only 10th Roll No.");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "Admission_11th_pvt/Get_students_record/",
            dataType: 'html',
            data: $( '#ReturnStatus' ).serialize(),
            beforeSend: function() {  $('.mPageloader').show(); },
            complete: function() { $('.mPageloader').hide();},
            success: function(data)
            {
            //alert(data);
                var obj = JSON.parse(data) ;
                      //  alert(obj.excep);
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