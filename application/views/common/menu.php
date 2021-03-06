<div class="container-fluid">
    <div class="dashboard-container">
        <div class="top-nav">
            <ul>
                <li>
                    <a href="<?php echo base_url(); ?>dashboard" class="<?php if($isselected == '1') {echo 'selected';}?>" >
                        <div class="fs1" aria-hidden="true" data-icon="&#xe0a0;"></div>
                        Dashboard
                    </a>
                </li>
                <?php
                if($appconfig['isreg'] == 1 ){?>

                    <li>
                        <a href="<?php echo base_url(); ?>Registration_11th" class="<?php if($isselected == '6') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            11th Registration
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>EleventhCorrection/EditForms" class="<?php if($isselected == '12') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0c4;"></div>
                            11th Correction
                        </a>
                    </li>   
                    <?php } 
                if($appconfig['isadmP1'] == 1){
                    ?>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission_11th_reg" class="<?php if($isselected == '14' ) {echo 'selected';}?>">
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            11th Admission
                        </a>
                    </li>
                    <?php }                                            
                if($appconfig['isadmP2'] == 1 || $appconfig['isadmP2S'] == 1){

                    ?>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission_inter" class="<?php if( $isselected == '11') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            12th Admission
                        </a>
                    </li>
                    <?php }                          
                if( $appconfig['isslipP1'] == 1 || $appconfig['isslipP2'] == 1 || $appconfig['isslipP2S'] == 1){?>

                    <li>
                        <a style="width: 115px;" href="<?php echo base_url(); ?>RollNoSlip" class="<?php if($isselected == '4') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
                            Roll No. Slips
                        </a>
                    </li>
                    <?php 

                }   
                if( $appconfig['isresultP2'] == 1){?>

                    <li>
                        <a style="width: 115px;" href="<?php echo base_url(); ?>Result/dashboard12th" class="<?php if($isselected == '5') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
                            Result Cards
                        </a>
                    </li>
                    <?php } ?>
            </ul>
            <div class="clearfix">
            </div>
        </div>
        <div class="sub-nav">
            <?php
            if($isselected == '1') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>dashboard"  data-original-title="" class="<?php if($isselected == '1') {echo 'heading';}?>">Dashboard</a></li>
                    <li>
                        <a href="#" onclick="return logout();">Logout</a>
                    </li>
                </ul>
                <?php
            }

            if($isselected == '12'){
                ?>
                <ul >

                    <li><a href="<?php echo base_url(); ?>EleventhCorrection/EditForms"   data-original-title="" class="<?php if($isselected == '12') {echo 'heading';}?>">11th Correction </a></li>
                    <li><a href="<?php echo base_url(); ?>EleventhCorrection/EditForms"   data-original-title="" >Apply for Correction </a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>EleventhCorrection/Applied">
                            Applications
                        </a>
                    </li>

                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>


                </ul>
                <?php
            }
            // 11th admission
            if($isselected == '14'){
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>Admission_11th_reg"   data-original-title="" >Admission</a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission_11th_reg/StudentsData">
                            Students Data
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission_11th_reg/StudentsData_cancelAdm">
                            Edit Forms
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>Admission_11th_reg/CreateBatch">
                            Create Batch
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission_11th_reg/BatchList">
                            Batch List
                        </a>
                    </li>
                    <li>
                        <a onclick="return logout();" style="cursor: pointer;">Logout</a>
                    </li>

                </ul>
                <?php
            }
            ?>
            <?php
            if($isselected == '4'){
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>RollNoSlip"   data-original-title="" >Roll No. Slips: </a></li>

                    <?php if($appconfig['isslipP1'] == 1 ) {?>
                        <li>
                            <a href="<?php echo base_url(); ?>RollNoSlip/EleventhStd">
                                11th Roll No. Slip
                            </a>
                        </li>
                        <?php } 

                    if($appconfig['isslipP2'] == 1 || $appconfig['isslipP2S'] == 1){
                        ?>
                        <li>
                            <a href="<?php echo base_url(); ?>RollNoSlip/InterStd">
                                12th Roll No. Slip
                            </a>
                        </li>
                        <?php }?>
                    <li>
                        <a href="#" onclick="return logout();">Logout</a>
                    </li>


                </ul>
                <?php
            }

            // DebugBreak();
            // Inter Registration
            if($isselected == '6') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>Registration_11th"   data-original-title="" class="<?php if($isselected == '6') {echo 'heading';}?>">Registration</a></li>

                    <?php  if($isinterfeeding == 1) {?>
                        <?php
                        if($MATRIC_SUPPLY_RESULT_ANNOUNCED == 1)
                        {
                            ?>

                            <li>
                                <a href="<?php echo base_url(); ?>Registration_11th/readmission">
                                    Re Admission 
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li>
                            <a href="<?php echo base_url(); ?>Registration_11th/Students_matricInfo">
                                Old Students 
                            </a>
                        </li>


                        <li>
                            <a href="<?php echo base_url(); ?>Registration_11th/EditForms">
                                Edit Forms
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>Registration_11th/CreateBatch">
                                Create Batch
                            </a>
                        </li>

                        <?php }?>
                    <li>
                        <a href="<?php echo base_url(); ?>Registration_11th/batchlist">
                            Batch List
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Registration_11th/FormPrinting">
                            Form Printing
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Registration_11th/Profile">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="return logout();">Logout</a>
                    </li>
                </ul>
                <?php
            }
            ?>
            <?php

            //  Inter Admission
            if($isselected == '11') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>Admission_inter"   data-original-title="" class="<?php if($isselected == '11') {echo 'heading';}?>">Admission</a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission_inter/StudentsData">
                            Old Students 
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>Admission_inter/EditForms">
                            Edit Forms
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission_inter/FormPrinting">
                            Proof Form Printing
                        </a>
                    </li> 
                    <li>
                        <a href="<?php echo base_url(); ?>Admission_inter/CreateBatch">
                            Create Batch
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission_inter/batchlist">
                            Batch List
                        </a>
                    </li>

                    <li>
                        <a href="#" onclick="return logout();">Logout</a>
                    </li>
                </ul>
                <?php }
            ?>

            <?php
            if($isselected == '5'){
                ?>
                <ul >
                    <li><a   data-original-title="" >Result Cards: </a></li>

                    <?php if($appconfig['isresultP2'] == 1 ) {?>
                        <li>
                            <a href="<?php echo base_url(); ?>Result/dashboard12th">
                                12th Result Cards
                            </a>
                        </li>
                        <?php }
                    //  DebugBreak() ;
                    if($appconfig['isresultP1'] == 1 ) {?>
                        <li>
                            <a href="<?php echo base_url(); ?>Result/dashboard11th">
                                11th Result Cards
                            </a>
                        </li>
                        <?php } ?>
                </ul >
                <?php
            } 
            ?> 
            <div class="btn-group pull-right">
                <button class="btn btn-primary">
                    Main Menu
                </button>
                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" onclick="$('.btn-group').addClass('btn-group open');">
                    <span class="caret">
                    </span>
                </button>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="<?php echo base_url(); ?>Dashboard" data-original-title="">
                            Dashboard
                        </a>
                    </li>
                    <!--  <li>
                    <a href="<?php echo base_url(); ?>Admission_11th_reg/StudentsData" data-original-title="">
                    11th Old Students
                    </a>
                    </li>
                    <li>
                    <a href="<?php echo base_url(); ?>Admission_11th_reg/EditForms" data-original-title="">
                    11th Edit Forms
                    </a>
                    </li>
                    <li>
                    <a href="<?php echo base_url(); ?>Admission_11th_reg/FormPrinting" data-original-title="">
                    11th Form Printing
                    </a>
                    </li>-->
                    <li>
                        <a href="#" onclick="return logout();">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
