<html>
    <body>
        <div class="container-fluid">
        <div class="dashboard-container">
        <div class="top-nav">
            <ul>

                <?php if($isselected == '1'){?>
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard" class="<?php if($isselected == '1') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0a0;"> </div>
                            Dashboard
                        </a>
                    </li>

                    <?php } 

                else if($isselected == '5'){?>

                    <li>
                        <a style="width: 115px;" href="<?php echo base_url(); ?>Complaints" class="<?php if($isselected == '5') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
                            Complaints
                        </a>
                    </li>

                    <?php } if($isselected == '7'){?>

                    <li>
                        <a style="width: 115px;" href="<?php echo base_url(); ?>Admission_matric" class="<?php if($isselected == '7') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
                            Matric Admission
                        </a>
                    </li>
                    <?php }
                if($isselected == '4'){?>

                    <li>
                        <a style="width: 115px;" href="<?php echo base_url(); ?>RollNoSlip" class="<?php if($isselected == '4') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
                            Roll No. Slips
                        </a>
                    </li>
                    <?php } 
                else  if(($isselected == '6' || $isselected == '2') && $edu_lvl == 3){?>

                    <li>
                        <a href="<?php echo base_url(); ?>Registration" class="<?php if($isselected == '2') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>  
                            9th Registration
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>NinthCorrection/EditForms" class="<?php if($isselected == '7') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0c4;"></div>
                            9th Correction
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Registration_11th" class="<?php if($isselected == '6') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            11th Registration
                        </a>
                    </li>
                    <?php }

                else if($isselected == '2'){?>

                    <li>
                        <a href="<?php echo base_url(); ?>Registration" class="<?php if($isselected == '2') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            Registration
                        </a>
                    </li>

                    <?php } 

                else if($isselected == '0'){?>

                    <li>
                        <a href="<?php echo base_url(); ?>Registration" class="<?php if($isselected == '0') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            9th Registration
                        </a>
                    </li>

                    <?php }
                else if($isselected == '6'){?>

                    <li>
                        <a href="<?php echo base_url(); ?>Registration_11th" class="<?php if($isselected == '6') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            Registration
                        </a>
                    </li>
                    <?php }

                else if($isselected == '9' ){?>

                    <li>
                        <a href="<?php echo base_url(); ?>Admission_matric" class="<?php if($isselected == '9' ) {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            Admission
                        </a>
                    </li>
                    <?php }

                else if($isselected == '14' || $isselected == '11'){
                    
                    
                    ?>
                    <li>
                      <a href="<?php echo base_url(); ?>Admission_11th_reg" class="<?php if($isselected == '14' ) {echo 'selected';}?>">
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            11th Admission
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission_inter" class="<?php if( $isselected == '11') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            12th Admission
                        </a>
                    </li>
                    <?php }?>
                  

            </ul>
            <div class="clearfix">
            </div>
        </div>
        <div class="sub-nav">
            <?php
            if($isselected == '5') { 
                ?>
                <ul >

                    <li>
                        <a href="<?php echo base_url(); ?>complaints">
                            Pending Complaints
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>complaints/completeCMP">
                            Completed
                        </a>
                    </li>
                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>

                </ul>
                <?php
            }




            if($isselected == '0') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>BiseCorrection/reg9thcorrections"   data-original-title="" class="<?php if($isselected == '2') {echo 'heading';}?>">9th Registration</a></li>

                    <li>
                        <a href="<?php echo base_url(); ?>BiseCorrection/BatchRelease">
                            Online Batch Release
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>BiseCorrection/BatchRestoreManual">
                            Manual Batch Release
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>BiseCorrection/BatchRestore">
                            Batch Restore
                        </a>
                    </li>
                    <!--   <li>
                    <a href="<?php echo base_url(); ?>BiseCorrection/NewEnrolment">
                    9th New Enrolment
                    </a>
                    </li>
                    <li>
                    <a href="<?php echo base_url(); ?>BiseCorrection/tracebyfromno">
                    Trace by FormNo
                    </a>
                    </li>
                    <li>
                    <a href="<?php echo base_url(); ?>BiseCorrection/tracebyinstcode">
                    Trace by Institute Code
                    </a>
                    </li>
                    <li>
                    <a href="<?php echo base_url(); ?>BiseCorrection/migration">
                    9th Migration
                    </a>
                    </li>-->
                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>
                    <!--  <li>
                    <a href="<?php echo base_url(); ?>Registration/ProofReading">
                    Proof Reading
                    </a>
                    </li>-->
                </ul>
                <?php
            }
            if($isselected == '1') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>dashboard"  data-original-title="" class="<?php if($isselected == '1') {echo 'heading';}?>">Dashboard</a></li>
                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>
                    <!-- <li>
                    <a href="#notifications">
                    Notifications
                    </a>
                    </li>         -->
                </ul>
                <?php
            }
            if($isselected == '2') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>Registration"   data-original-title="" class="<?php if($isselected == '2') {echo 'heading';}?>">Registration</a></li>
                    <?php if($isfeedingallow == 1) {?>
                        <li>
                            <a href="<?php echo base_url(); ?>Registration/NewEnrolment">
                                New Enrolement
                            </a>
                        </li>
                        <!--<li>
                        <a href="<?php echo base_url(); ?>Registration/ReAdmission">
                        Re-Admissions
                        </a>
                        </li>-->
                        <li>
                            <a href="<?php echo base_url(); ?>Registration/EditForms">
                                Edit Forms
                            </a>
                        </li> 
                        <li>
                            <a href="<?php echo base_url(); ?>Registration/CreateBatch">
                                Create Batch
                            </a>
                        </li>
                        <?php }?>

                    <li>
                        <a href="<?php echo base_url(); ?>Registration/EditPicForms">
                            Edit Pictures Forms
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Registration/batchlist">
                            Batch List
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Registration/FormPrinting">
                            Form Printing
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>/Registration/Profile">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a style="cursor: pointer" onclick="return logout();">Logout</a>
                    </li>
                    <!--  <li>
                    <a href="<?php echo base_url(); ?>Registration/ProofReading">
                    Proof Reading
                    </a>
                    </li>-->
                </ul>
                <?php
            }
            ?>
            
            <?php   // 11th admission
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
                        <a href="<?php echo base_url(); ?>Admission_11th_reg/EditForms">
                            Edit Forms
                        </a>
                    </li>
                   <!--<li>
                        <a href="<?php //echo base_url(); ?>Admission_11th_reg/EditPicForms">
                            Edit Pictures Forms
                        </a>
                    </li>   -->
                    <li>
                        <a href="<?php echo base_url(); ?>Admission_11th_reg/FormPrinting">
                            Form Printing
                        </a>
                    </li>
                     <li>
                        <a href="<?php echo base_url(); ?>Admission_11th_reg/RevenueList">
                            Revenue List Printing
                        </a>
                    </li>
                    <li>
                        <a onclick="return logout();">Logout</a>
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
                    <!-- <li>
                    <a href="<?php echo base_url(); ?>RollNoSlip/NinthStd">
                    9th Roll No. Slip
                    </a>
                    </li>-->
                    <li>
                        <a href="<?php echo base_url(); ?>RollNoSlip/TenthStd">
                            10th Roll No. Slip
                        </a>
                    </li>
                    <!-- <li>
                    <a href="<?php echo base_url(); ?>RollNoSlip/EleventhStd">
                    11th Roll No. Slip
                    </a>
                    </li>-->
                    <li>
                        <a href="<?php echo base_url(); ?>RollNoSlip/InterStd">
                            12th Roll No. Slip
                        </a>
                    </li>
                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>


                </ul>
                <?php
            }

            if($isselected == '7'){
                ?>
                <ul >

                    <li><a href="<?php echo base_url(); ?>NinthCorrection"   data-original-title="" class="<?php if($isselected == '7') {echo 'heading';}?>">9th Correction </a></li>
                    <li><a href="<?php echo base_url(); ?>NinthCorrection/EditForms"   data-original-title="" >Apply for Correction </a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>NinthCorrection/Applied">
                            Applications
                        </a>
                    </li>

                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>


                </ul>
                <?php
            }

            // Inter Registration
            if($isselected == '6') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>Registration_11th"   data-original-title="" class="<?php if($isselected == '6') {echo 'heading';}?>">Registration</a></li>

                    <?php  if($isinterfeeding == 1) {?>


                        <li>
                            <a href="<?php echo base_url(); ?>Registration_11th/Students_matricInfo">
                                Old Students 
                            </a>
                        </li>
                        <!-- <li>
                        <a href="<?php echo base_url(); ?>Registration_11th/ReAdmission">
                        Re-Admissions
                        </a>
                        </li>-->

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
                        <a href="<?php echo base_url(); ?>/Registration_11th/Profile">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a style="cursor: default" onclick="return logout();">Logout</a>
                    </li>
                    <!--  <li>
                    <a href="<?php echo base_url(); ?>Registration/ProofReading">
                    Proof Reading
                    </a>
                    </li>-->
                </ul>
                <?php
            }
            ?>


            <?php
            // Matric Admission
            if($isselected == '9') { 
                ?>
                <ul >
                <li><a href="<?php echo base_url(); ?>Admission_matric"   data-original-title="" class="<?php if($isselected == '9') {echo 'heading';}?>">Admission</a></li>




                <li>
                    <a href="<?php echo base_url(); ?>Admission_matric/StudentsData">
                        Old Students 
                    </a>
                </li>
                <!-- <li>
                <a href="<?php echo base_url(); ?>Admission_matric/ReAdmission">
                Re-Admissions
                </a>
                </li>-->

                <li>
                    <a href="<?php echo base_url(); ?>Admission_matric/EditForms">
                        Edit Forms
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>Admission_matric/CreateBatch">
                        Create Batch
                    </a>
                </li>

                <?php }

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
                    <!-- <li>
                    <a href="<?php echo base_url(); ?>Admission_matric/ReAdmission">
                    Re-Admissions
                    </a>
                    </li>-->

                    <li>
                        <a href="<?php echo base_url(); ?>Admission_inter/EditForms">
                            Edit Forms
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
                        <a href="<?php echo base_url(); ?>Admission_inter/FormPrinting">
                            Proof Form Printing
                        </a>
                    </li>   
                    <li>
                        <a style="cursor: pointer" onclick="return logout();">Logout</a>
                    </li>
                </ul>
                <?php }
            ?>


            <!-- <li>
            <a href="<?php //echo base_url(); ?>/Admission_matric/Profile">
            Profile
            </a>
            </li>-->

            <!--  <li>
            <a href="<?php echo base_url(); ?>Registration/ProofReading">
            Proof Reading
            </a>
            </li>-->


            <div class="btn-group pull-right">
                <button class="btn btn-primary">
                    Main Menu
                </button>
                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                    <span class="caret">
                    </span>
                </button>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="<?php echo base_url(); ?>Dashboard" data-original-title="">
                            Dashboard
                        </a>
                    </li>
                    <li>
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
                    </li>
                    <li>
                        <a onclick="return logout();" data-original-title="">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>
