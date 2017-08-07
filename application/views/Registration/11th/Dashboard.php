<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            11th Registration
                        </div>
                    </div>
                    <div class="shortcutHome">
                        <img class="img-responsive pull-right" style="width: 350px; height: 400px;" src="<?php echo base_url(); ?>assets/img/image_guideline.jpg">
                    </div>
                    <div class="widget-body">
                        <h4>Welcome to Board of Intermediate &amp; Secondary Education, GUJRANWALA</h4>
                        <h1><font color="#000000" size="+1" >Note: Last Date of Online Registration for 11th  with late fee is <b class="blink_text"><?php  echo date("d F, Y", strtotime(lastdate)); ?></b></font></h1>
                        <?php  if($isinterfeeding == 1) {?>
                            <div class="shortcutHome">
                                <a href="<?php echo base_url(); ?>Registration_11th/Students_matricInfo"><img src="<?php echo base_url();?>assets/img/enrolment.png"><br>New-Registration</a>
                            </div>
                            <div class="shortcutHome">
                                <a href="<?php echo base_url(); ?>Registration_11th/EditForms"><img src="<?php echo base_url();?>assets/img/edit_form.png"><br>Edit Form</a>
                            </div>
                            <div class="shortcutHome">
                                <a href="<?php echo base_url(); ?>Registration_11th/CreateBatch"><img src="<?php echo base_url();?>assets/img/batch_list.png"><br>Create Batch</a> 
                            </div>
                            <?php }?>
                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>Registration_11th/FormPrinting"><img src="<?php echo base_url();?>assets/img/reports.png"><br>Printing </a>
                        </div>
                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>Registration_11th/batchlist"><img src="<?php echo base_url();?>assets/img/lists.png"><br>Batch List</a>
                        </div>

                        <div class="shortcutHome">
                            <a  onclick="return logout();" style="cursor: pointer;"><img src="<?php echo base_url();?>assets/img/logout_icon.png"><br>Logout</a>
                        </div>

                        <div>
                            <div id="smallRight" class="span6">
                                <h4>Information</h4>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Logged ID : <b> <?php  echo $Inst_id ?> </b></td>
                                        </tr>
                                        <tr>
                                            <td>Name : <?php echo $Inst_name ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h4>Current Report</h4>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Total Entries: <?php echo $count[0]['Total_Entries'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Batched: <?php echo $count[0]['Total_Batched'];?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div>
                            <br/>
                            <a href="<?php echo base_url(); ?>Registration_11th/forwarding_pdf" target="_blank" class="guidlines blink_text" style="font-size: 18px;">Download Forwarding letter. </a> <br/>
                            <br />
                            <strong>NOTE:</strong> <br/>
                            <ol class="list-group">
                                <li class="list-group-item">Please upload photo of student carefully and with good quality as this picture will be used in his/her INTER Roll Number Slip/Result Card/certificate. <br></li>
                                <li class="list-group-item">Fill correct Address of candiate as now governmet often demand addresses of regular candidates also from Board, for various purposes. i.e, Laptop Distribution, Soler Panel distribution, scholership etc. <br></li>
                                <li class="list-group-item">In case of any problem regarding registration, please send us email on <span style="font-weight:bold; font-family:Verdana, Geneva, sans-serif; font-style:italic; color:#00F" > complaint4bisegrw@gmail.com </span>with your <span style="font-weight:bolder; "> User Id, Password,  Contact No.</span>  and description of problem.</li>
                                <li class="list-group-item">Please <span style="font-weight:bold; font-family:Verdana, Geneva, sans-serif;  color:#F24F00" > Ensure Mobile Number of student/Gaurdian must be correct.</span> As now Board Send Roll Number Slips information, result information and any other information regarding student's exam through SMS, and in case of
                                    any problem of student's data , Board also contact to student on his mobile number.  <br/></li>
                                <li class="list-group-item">Picture size must be less than  20 kb, and use only Passport size with small letter ".jpg" extension image.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


