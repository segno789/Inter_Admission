
<div class="form-group">
    <div class="col-md-12">
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
            <strong>Last Date of Online Admissions and Submission of Hard Copy for Inter Supply Examination with <br> Single fee </strong>

            <?php  
            $SingleDateFee = date("d-m-Y", strtotime(SingleDateFee)); 
            $DoubleDateFee = date("d-m-Y", strtotime(DoubleDateFee)); 
            $TripleDateFee = date("d-m-Y", strtotime(TripleDateFee)); 
            ?>

            <b style="color: green;"> <?php echo $SingleDateFee ?> </b>
            <br>
            <strong>Double fee</strong>
            <b style="color: red;"> <?php echo $DoubleDateFee ?> </b>
            <br>
            <strong>Tripple fee</strong>
            <b style="color: blue;"> <?php echo $TripleDateFee ?> </b>
        </div>
    </div>
</div>
<div class="form-group">    
    <div class="row">
        <div class="col-md-12">
            <h3 align="center" class="bold">
                <?php 
                $sess = '';
                if(Session == '1')
                    $sess =  'Annual';
                else if(Session == '2')
                    $sess = 'Supplementary';
                    echo  'Online Admission for HSSC Part-II '.$sess.''.',  ' .Year.'';   
                ?>
            </h3>
        </div>
    </div>
</div>
<form enctype="multipart/form-data" id="options" name="options" method="post" action="" >
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-6">
                <label class="radio-inline">
                    <input type="radio" class="nationality_class"  id="candidate1" value="1" checked="checked" name="candidate">Private Candidate 
                </label>
                <label class="radio-inline" id="can3">
                    <input type="radio" class="nationality_class" id="candidate3" value="2" name="candidate">Regular Candidate
                </label>
            </div>
        </div>
    </div>
    <div class="form-group"><div class="row"></div></div>
    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <input type="button" value="Proceed to Next Step" id="proceedDefault" name="proceedDefault" class="btn btn-primary btn-block">
            </div>
        </div>
    </div>
    <div class="form-group">    
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <img src="<?php echo base_url(); ?>assets/img/inqurey.jpg" class="img-responsive" alt="Terms & Conditions">
                </div>
            </div>
        </div>
    </div>
</form>
<hr class="colorgraph">
<div class="form-group">    
    <div class="row">
        <div class="col-md-12">
            <h3 align="center" class="bold">Download Your Already Feeded Form</h3>
        </div>
    </div>
</div>
<form method="post" action="<?php base_url(); ?>Admission/checkFormNo_then_download">
    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <input type="text" class="form-control" id="formid" name="formid" placeholder="Enter Form No" maxlength="6" required="required">  
            </div>         
        </div>
    </div>
    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <input type="button" value="Download" name="btndwnForm" id="btndwnForm12"  class="btn btn-primary btn-block">
            </div>
        </div>
    </div>
</form>
<hr class="colorgraph">
<label class="control-label">In case of any problem regarding Admissions, please send us email on</label>
<a href="mailto:complaint4bisegrw@gmail.com" class="control-label">complaint4bisegrw@gmail.com</a>
<script type="text/javascript">

    $(window).on('resize', function(){
        if($(window).width() < 400) {
            $('#can3').css("margin-left: 0px");      
        }
        else{
            $('#can3').css("margin-left: 10px");      
        }
    });
</script>