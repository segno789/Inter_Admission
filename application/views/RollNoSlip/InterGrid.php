<div class="dashboard-wrapper">
    <div class="left-sidebar">


        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            12th Roll No. Slips:
                        </div>

                    </div>
                    <div class="widget-body">
                    
                    
                    
                    
                        <div id="dt_example" class="example_alt_pagination">

                           <!-- <div class="wrapper donwlaodingbar">
                                <ul class="progress-statistics">
                                    <li>
                                        <div class="details">
                                            <span>
                                                Roll Number Slips
                                            </span>
                                            <span class="pull-right" id="bartxt">
                                                0%
                                            </span>
                                        </div>
                                        <div class="progress progress-success progress-striped active">
                                            <div class="bar" style="width: 0%;" id="myBar">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>      -->
                            <table width="100%">
                                <tr>
                                    <?php  if($isdeaf ==0) {?>
                                        <td width="50%">  
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="reports_gen">

                                                <tr class="groups">
                                                    <th scope="row">Select Group:</th>
                                                    <td>
                                                        <select id="std_group" style="width:200px;" class="custom" name="std_group" onchange="std_group(this.value)">
                                                            <option value="-1">-- Show All Groups --</option>
                                                            <option value="1">PRE-MEDICAL</option>
                                                            <option value="2">PRE-ENGINEERING</option>
                                                            <option value="3">HUMANITIES</option>
                                                            <option value="4">GENERAL SCIENCE</option>
                                                            <option value="5">COMMERCE</option>
                                                            <option value="6">ISLAMIC STUDIES</option>
                                                            <option value="7">HOME ECONOMICS</option>

                                                        </select>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <th scope="row"></th>

                                                    <td>

                                                        <button type="button" class="btn btn-info"  onclick="downloadgroupwise12(1)" disabled="disabled" id="downbtn">Download Group Wise Roll No. Slip.</button>
                                                        <button type="button" class="btn btn-info"  onclick="downloadgroupwise12(2)" disabled="disabled" id="viewbtn">View Group Wise Roll No. Slip.</button>
                                                    </td>

                                                </tr>

                                            </table>
                                        </td>
                                        <?php }?>
                                    <td width="50%">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="reports_gen">

                                            <tr class="groups">
                                                <td scope="row"><img src="<?= base_url();?>assets/img/backside.jpg" style="width: 760px !important;"></td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="<?= base_url();?>assets/img/slip_back_page.pdf" target="_blank"><button type="button" class="btn btn-info"  id="downbtn">Download Roll No Slip Back Instructions.</button></a></td>

                                            </tr>

                                        </table>
                                    </td>
                                </tr>
                            </table>



                            <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">

                                <thead>
                                    <tr>
                                        <th style="width: 5%;">
                                            Sr.No.
                                        </th>
                                        <th style="width:10%" class="hidden-phone">
                                            FormNo
                                        </th>
                                        <th style="width:5%">
                                            Roll No.
                                        </th>
                                        <th style="width:20%">
                                            Name
                                        </th>
                                        <th style="width:20%">
                                            Father's Name
                                        </th>

                                        <!--  <th style="width:10%" class="hidden-phone">
                                        DOB
                                        </th>-->
                                        <th style="width:5%" class="hidden-phone">
                                            Subject Group
                                        </th>
                                        <th style="width:25%" class="hidden-phone">
                                            Download
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //DebugBreak();
                                    if($data != false)
                                    {
                                        $n=0;  
                                        $grp_name='';                             
                                        foreach($data as $key=>$vals):
                                        $n++;
                                        $roll_no = !empty($vals["rno"])?$vals["rno"]:"N/A";
                                        $grp_name = $vals["grp_cd"];
                                        switch ($grp_name) {
                                            case '1':
                                                $grp_name = 'PRE-MEDICAL';
                                                break;
                                            case '2':
                                                $grp_name = 'PRE-ENGINEERING';
                                                break;
                                            case '3':
                                                $grp_name = 'HUMANITIES';
                                                break;
                                            case '4':
                                                $grp_name = 'GENERAL SCIENCE';
                                                break;
                                            case '5':
                                                $grp_name = 'COMMERCE';
                                                break;
                                            case '6':
                                                $grp_name = 'ISLAMIC STUDIES';
                                                break;
                                            case '7':
                                                $grp_name = 'HOME ECONOMICS';
                                                break;

                                            default:
                                                $grp_name = "No Group Selected.";
                                        }
                                        echo '<tr>
                                        <td>'.$n.'</td>
                                        <td>'.$vals["FormNo"].'</td>
                                        <td>'.$roll_no.'</td>
                                        <td>'.$vals["name"].'</td>
                                        <td>'.$vals["Fname"].'</td>
                                        <td>'.$grp_name.'</td>
                                        ';  //<td>'.$vals["Dob"].'</td>

                                        echo'<td>
                                        <button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip_Inter('.$roll_no.',1)">Download Roll No. Slip</button>
                                        <button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip_Inter('.$roll_no.',2)">View Roll No. Slip</button>
                                        </td>
                                        </tr>';
                                        endforeach;
                                       
                                    }
                                    ?>



                                </tbody>
                            </table>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>

</div>
</div>
</div>
<script type="">
    function std_group(val)
    {
        if(val>0)
        {
            document.getElementById("downbtn").disabled=false; 
            document.getElementById("viewbtn").disabled=false; 
        }
        else
        {
            document.getElementById("downbtn").disabled=true;
            document.getElementById("viewbtn").disabled=true;
        }

    }
</script>
