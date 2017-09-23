<div class="dashboard-wrapper class wysihtml5-supported">    
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Inter Admission
                        </div>
                    </div>
                    <div class="widget-body">
                        <h4>Welcome to Board of Intermediate & Secondary Education, GUJRANWALA</h4>
                        <h4><b>NOTE :</b> Last Date of Online Admission for 12th is <b class="blink_text"><?php echo SingleDateFee; ?></b></h4>

                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>Admission_inter/StudentsData"><img src="<?php echo base_url();?>assets/img/enrolment.png"><br>Old Students</a>
                        </div>
                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>Admission_inter/FormPrinting"><img src="<?php echo base_url();?>assets/img/reports.png"><br>Reports </a>
                        </div>
                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>Admission_inter/EditForms"><img src="<?php echo base_url();?>assets/img/edit_form.png"><br>Edit Form</a>
                        </div>
                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>Admission_inter/CreateBatch"><img src="<?php echo base_url();?>assets/img/batch_list.png"><br>Create Batch</a> 
                        </div>
                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>Admission_inter/batchlist"><img src="<?php echo base_url();?>assets/img/lists.png"><br>Batch List</a>
                        </div>
                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>/login/logout"><img src="<?php echo base_url();?>assets/img/logout_icon.png"><br>Logout</a>
                        </div>
                        <div class="clear"></div>
                        <div class="clear"></div>
                        <div id="smallRight">
                            <h4>Information</h4>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Logged ID : <b><?php  echo $Inst_id ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Name : <b><?php echo $Inst_name ?></b></td>
                                    </tr>
                                    <tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="smallRight">
                            <h4>Current Report</h4>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Total Entries: <b><?php echo  $count[0]['Total_Entries'];?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Total Batched:  <b><?php echo $count[0]['Total_Batched']; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="clear"></div>
                        <div>
                            <a href="<?php echo base_url(); ?>Admission_Inter/forwarding_pdf/" target="_blank" class="guidlines blink_text">Download Forwarding letter.</a>
                            <br />
                            <a href="<?php echo base_url(); ?>Admission_Inter/financeReoprt/" target="_blank" class="guidlines blink_text">Download Finance Forwarding letter.</a>
                            <br /><br/>
                            <strong>NOTE:</strong>
                            <ol>
                                <li>
                                    Fill correct Address of candiate as now governmet often demand addresses of regular candidates also from Board, for various purposes. i.e, Laptop Distribution, Solar Panel distribution, scholership etc.
                                </li>
                                <li>In case of any problem regarding Admission, please send us email on <a href="mailto: complaint4bisegrw@gmail.com">complaint4bisegrw@gmail.com</a> 
                                    with your <span style="font-weight:bolder; "> User Id, Contact No. </span>  and description of problem. <br /></li>
                                <li>Please <span style="font-weight:bold; font-family:Verdana, Geneva, sans-serif;  color:#F24F00" > Ensure Mobile Number of student/Gaurdian must be correct.</span> As now Board Send Roll Number Slips information, result information and any other information regarding student's exam through SMS, and in case of
                                    any problem of student's data , Board also contact to student on his mobile number.</li>
                            </ol>
                        </div>
                    </div>      
                    <div class="clear"></div>  
                </div>
            </div>
        </div>
    </div>
</div>