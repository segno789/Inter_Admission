<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Edit Forms 11th Registration<a data-original-title="" id="notifications">s</a>
                        </div>
                        
                    </div>
                    <div class="widget-body">
                        <h4>
                            View All Submited Forms:
                        </h4>
                        <hr>
                        <div id="dt_example" class="example_alt_pagination">
                            <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;">
                                            Sr.No.
                                        </th>
                                        <th style="width:5%">
                                            Form No.
                                        </th>
                                        <th style="width:20%">
                                            Name
                                        </th>
                                        <th style="width:20%">
                                            Father's Name
                                        </th>
                                        <th style="width:8%" class="hidden-phone">
                                            Bay Form
                                        </th>
                                        <th style="width:17%" class="hidden-phone">
                                            Subject Group
                                        </th>
                                        <th style="width:11%" class="hidden-phone">
                                            Selected Subjects
                                        </th>
                                         <!--<th style="width:4%" class="hidden-phone">
                                            Picture
                                        </th>  -->
                                        <th style="width:18%" class="hidden-phone" >
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
                                    $formno = !empty($vals["FormNo"])?$vals["FormNo"]:"N/A";
                                    $grp_name = $vals["RegGrp"];
                                    switch ($grp_name) {
                                        case '1':
                                            $grp_name = 'Pre-Medical';
                                            break;
                                        case '2':
                                            $grp_name = 'Pre-Engineering';
                                            break;
                                       case '3':
                                            $grp_name = 'Humanities';
                                            break;
                                        case '4':
                                            $grp_name = 'General Science';
                                            break;
                                            case '5':
                                            $grp_name = 'Commerce';
                                            break;
                                              case '6':
                                            $grp_name = 'Home Economics';
                                            break;
                                        default:
                                            $grp_name = "No Group Selected.";
                                    }

                                    echo '<tr  >
                                    <td>'.$n.'</td>
                                    <td>'.$formno.'</td>
                                    <td>'.$vals["name"].'</td>
                                    <td>'.$vals["Fname"].'</td>
                                    <td>'.$vals["BForm"].'</td>
                                    <td>'.$grp_name.'</td>
                                    <td>'.$vals["sub1_abr"].','.$vals["sub2_abr"].','.$vals["sub3_abr"].','.$vals["sub4_abr"].','.$vals["sub5_abr"].','.$vals["sub6_abr"].','.$vals["sub7_abr"].'</td>';
                                    /*<td><img id="previewImg" style="width:40px; height: 40px;" src="/'.IMAGE_PATH11.$Inst_Id.'/'.$vals['PicPath'].'?'.rand(10000,1000000).'" alt="Candidate Image">*/
                                    
                                    echo'<td>
                                    <button type="button" class="btn btn-info" value="'.$formno.'" onclick="EditForm('.$formno.')">Edit Form</button>
                                    <button type="button" class="btn btn-info" value="'.$formno.'" onclick="DeleteForm('.$formno.')">Delete Form</button>
                                    </td>
                                    </tr>';
                                    endforeach;
                                    }
                                    ?>
 </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="control-group">
                            <div class="controls controls-row">
                                <label class="label label-important" style="font-size: large;">
                                    Note: Please write "No Image" in the above search to check if any image of candidate is missing or not.
                                </label>
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

