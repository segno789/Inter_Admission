<form enctype="multipart/form-data" id="ReturnStatus" name="ReturnStatus" method="post" action="<?php echo base_url(); ?>/index.php/Registration_11th/Get_students_record" >
    <div class="dashboard-wrapper class wysihtml5-supported">
        <div class="left-sidebar">
            <div class="widget no-margin">
                <div class="widget-header">
                    <div class="title">
                        Please Provide Information
                    </div>
                </div>
                <div class="widget-body">
                 
                        <div class="row-fluid">
                            <div class="span4"></div>
                            <div class="span2">
                                <label class="control-label">
                                    SSC Roll No
                                </label>
                                <input style="height: 30px; width:220px;" type="text" class="form-control" id="oldRno" name="oldRno" maxlength="7" required="required" >
                            </div>
                            <div class="span2">
                                <label class="control-label">
                                    SSC Year
                                </label>
                                <select id="oldYear" name="oldYear" class="form-control">
                                    <?php
                                    $current_year = Year;
                                    $prev_year = Year;

                                    if($gender== 1){ ?>
                                        <option value="<?php echo $current_year;  ?>"><?php echo $current_year;  ?></option>
                                        <option value="<?php echo $current_year-1; ?>" ><?php echo $current_year-1; ?></option>  
                                        <option value="<?php echo  $current_year-2; ?>" ><?php echo  $current_year-2; ?></option>  
                                        <option value="<?php echo $current_year-3; ?>" ><?php echo $current_year-3; ?></option>  
                                        <option value="<?php echo $current_year-4; ?>" ><?php echo $current_year-4; ?></option>  
                                        <option value="<?php echo $current_year-5; ?>" ><?php echo $current_year-5; ?></option>  
                                        <?php }
                                    else{?>
                                        <option value="<?php echo $current_year;  ?>"><?php echo $current_year;  ?></option>
                                        <option value="<?php echo $current_year-1; ?>" ><?php echo $current_year-1; ?></option>  
                                        <option value="<?php echo  $current_year-2; ?>" ><?php echo  $current_year-2; ?></option>  
                                        <option value="<?php echo $current_year-3; ?>" ><?php echo $current_year-3; ?></option>  
                                        <option value="<?php echo $current_year-4; ?>" ><?php echo $current_year-4; ?></option>  
                                        <option value="<?php echo $current_year-5; ?>" ><?php echo $current_year-5; ?></option>   
                                        <?php }    
                                    ?>
                                </select>
                            </div>
                            <div class="span4"></div>
                        </div>
                 
                        <div class="row-fluid">
                            <div class="span4"></div>
                            <div class="span2">
                                <label class="control-label">
                                    SSC Session
                                </label>
                                <select id="oldSess" class="control-label" name="oldSess">
                                    <option value="1" >Annual</option>
                                    <option value="2">Supplementary</option>
                                </select>
                            </div>
                            <div class="span2">
                                <label class="control-label">
                                    SSC Board
                                </label>
                                <select id="sec_board" class="control-label" name="oldBrd_cd">
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
                            <div class="span4"></div>
                        </div>
                    <hr>
                        <div class="row-fluid">
                            <div class="span5"></div>
                            <div class="span3">
                                <input type="submit" value="Proceed" id="proceed" name="proceed" class="btn btn-large btn-info">
                                <input type="button" value="Cancel" onclick="return Dashboard();" class="btn btn-large btn-danger">
                            </div>
                            <div class="span4"></div>
                        </div>
                    
                </div>
            </div> 
        </div>
    </div>
</form>
