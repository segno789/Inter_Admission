<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            View All Admitted Candidates   <a data-original-title="" id="notifications"></a>
                        </div>

                    </div>
                    <form action="<?=base_url()?>index.php/Admission_11th_reg/NewEnrolment_update/" method="post" id="form_make_adm">
                        <div class="widget-body">
                            <div class='control-group'>
                                <div class='controls controls-row'>
                                    <hr>
                                    <div id="dt_example" class="example_alt_pagination">
                                        <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 4%;">
                                                        Sr.No.
                                                    </th>
                                                    <th style="width: 6%;">
                                                        Form No.
                                                    </th>
                                                    <th style="width:20%">
                                                        Name
                                                    </th>
                                                    <th style="width:20%">
                                                        Father's Name
                                                    </th>
                                                    <th style="width:5%" class="hidden-phone">
                                                        DOB
                                                    </th>
                                                    <th style="width:15%" class="hidden-phone">
                                                        Subject Group
                                                    </th>
                                                    <th style="width:15%" class="hidden-phone">
                                                        Selected Subjects
                                                    </th>
                                                   
                                                    <th scope="col" align="center"><a href="javascript:void(0);" style="color:red;" class="check">Check All</a></th>
                                                    <!--<th style="width:10%" class="hidden-phone" >
                                                    Download
                                                    </th>   -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // DebugBreak();
                                                if($data != false)
                                                {
                                                    $n=0;  
                                                    $grp_name='';                             
                                                    foreach($data as $key=>$vals):
                                                        $n++;
                                                        $formno = !empty($vals["FormNo"])?$vals["FormNo"]:"N/A";
                                                        $grp_name = $vals["grp_cd"];
                                                      //  $sub7 = $vals["sub8"];
                                                       
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
                                                        default:
                                                            $grp_name = "No GROUP SELECTED.";
                                                            }

                                                           /* $picpath =  DIRPATH11th.'/'.$Inst_Id.'/'.$vals["PicPath"];
                                                            // echo $picpath;
                                                            $type = pathinfo($picpath, PATHINFO_EXTENSION);
                                                            $vals["PicPath"] = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($picpath));*/
                                                              $vals["PicPath"] =  '../OldPics/colleges'.'/'.$Inst_Id.'/'.$vals["PicPath"]."?".rand(10000,1000000);
                                                        //  DebugBreak();
                                                        echo '<tr  >
                                                        <td>'.$n.'</td>
                                                        <td>'.$vals["FormNo"].'</td>
                                                        <td>'.$vals["name"].'</td>
                                                        <td>'.$vals["Fname"].'</td>
                                                        <td>'.date("d-m-Y", strtotime($vals["Dob"])).'</td>
                                                        <td>'.$grp_name.'</td>
                                                        <td>'.$vals["sub1_abr"].','.$vals["sub2_abr"].','.$vals["sub3_abr"].','.$vals["sub4_abr"].','.$vals["sub5_abr"].','.$vals["sub6_abr"].','.$vals["sub7_abr"].'</td>
                                                        
                                                        <td><input style="width: 24px; height: 24px;" type="checkbox" name="chk[]" value="'.$formno.'" /></td> </tr>';
                                                        /*<td><img id="previewImg" style="width:40px; height: 40px;" src="/'.IMAGE_PATH.$Inst_Id.'/'.$vals['PicPath'].'" alt="Candidate Image"></td>';*/
                                                        /* echo'<td>
                                                        <button type="button" class="btn btn-info" value="'.$formno.'" onclick="NewForm('.$formno.')">Save Form</button>

                                                        </td>
                                                        <td><img id="previewImg" style="width:40px; height: 40px;" src="'.$vals["PicPath"].'" alt="Candidate Image"></td>
                                                        </tr>';  */
                                                        endforeach;
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <input type="hidden" id="isformwise" name="isformwise" value="3"> 
                                        <div class="clearfix"></div>
                                    </div>
                                    <br>
                                    <div class="row">

                                        <div class="col-lg-12" style="float: right;">
                                        <button type="submit" class="btn btn-large btn-info" name="make_adm_all" id="make_adm_sel" value="3" onclick="return issubmit_sel_cancel();" >Cancel Admissions Of Selected Students</button>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="controls controls-row">
                                           <!-- <label class="label label-important" style="font-size: large;">
                                                Note: Please write "No Image" in the above search to check if any image of candidate is missing or not.
                                            </label>     -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div> 
</div>

