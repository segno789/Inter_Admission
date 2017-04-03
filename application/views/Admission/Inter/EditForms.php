<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            View All Submited Forms
                        </div>

                    </div>
                    <div class="widget-body">
                        <h4>

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
                                        <!-- <th style="width:5%" class="hidden-phone">
                                        DOB
                                        </th>-->
                                        <th style="width:20%" class="hidden-phone">
                                            Subject Group
                                        </th>
                                        <th style="width:11%" class="hidden-phone">
                                            Selected Subjects
                                        </th>
                                        <th style="width:4%" class="hidden-phone">
                                            Picture
                                        </th>
                                        <th style="width:18%" class="hidden-phone" >
                                            Download
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if($data != false)
                                    {
                                        $n=0;  
                                        $grp_name='';                             
                                        foreach($data as $key=>$vals):
                                        $n++;
                                        $formno = !empty($vals["FormNo"])?$vals["FormNo"]:"N/A";
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
                                            case '7':
                                                $grp_name = ' HOME ECONOMICS';
                                                break;
                                            default:
                                                $grp_name = "No Group Selected.";
                                        }
                                        // $image_path_selected = DIRPATH12TH.$vals['picpath']; 
                                        //   $type = pathinfo($image_path_selected, PATHINFO_EXTENSION);
                                        if($vals["IntBrd_cd"] ==  1)
                                        {
                                            /* $image_path_selected = DIRPATH12TH.$vals['picpath']; 
                                            $type = pathinfo($image_path_selected, PATHINFO_EXTENSION);*/  
                                            $image_path_selected = '../'.$vals['picpath']."?".rand(10000,1000000); 

                                        }
                                        else 
                                        {
                                            $image_path_selected =  DIRPATHOTHER.'/'.$vals["coll_cd"].'/'.$vals["picpath"]; 

                                            $type = pathinfo($image_path_selected, PATHINFO_EXTENSION); 
                                            @$image_path_selected = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($image_path_selected));
                                        }



                                        echo '<tr  >
                                        <td>'.$n.'</td>
                                        <td>'.$formno.'</td>
                                        <td>'.$vals["name"].'</td>
                                        <td>'.$vals["Fname"].'</td>

                                        <td>'.$grp_name.'</td>
                                        <td>'.$vals["sub1_abr"].','.$vals["sub2_abr"].','.$vals["sub8_abr"].','.$vals["sub4_abr"].','.$vals["sub5_abr"].','.$vals["sub6_abr"].','.$vals["sub7_abr"].'</td>
                                        <td><img id="previewImg" style="width:40px; height: 40px;" src="'.$image_path_selected.'" alt="Candidate Image"></td>';

                                        echo'<td>
                                        <button type="button" class="btn btn-info" value="'.$formno.'" onclick="EditForm('.$formno.')">Edit Form</button>
                                        <button type="button" class="btn btn-danger" value="'.$formno.'" onclick="DeleteForm('.$formno.')">Delete Form</button>
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

