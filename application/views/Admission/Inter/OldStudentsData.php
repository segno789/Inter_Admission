<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            View All Old Students Records   <a data-original-title="" id="notifications"></a>
                        </div>

                    </div>
                    <div class="widget-body">

                        <hr>
                        <div id="dt_example" class="example_alt_pagination">
                            <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 4%;">
                                            Sr.No.
                                        </th>
                                        <th style="width: 5%;">
                                            Previous Roll.No.
                                        </th>
                                        <th style="width: 5%;">
                                            Matric Roll.No.
                                        </th>

                                        <th style="width:20%">
                                            Name
                                        </th>
                                        <th style="width:20%">
                                            Father's Name
                                        </th>
                                        <!--  <th style="width:5%" class="hidden-phone">
                                        DOB
                                        </th>-->
                                        <th style="width:15%" class="hidden-phone">
                                            Subject Group
                                        </th>

                                        <th style="width:5%" class="hidden-phone">
                                            Picture
                                        </th>
                                        <th style="width:10%" class="hidden-phone" >
                                            Download
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $image_path_selected = '';
                                    //   DebugBreak();
                                    if($data != false)
                                    {
                                        $n=0;  
                                        $grp_name='';                             
                                        foreach($data as $key=>$vals):
                                            $n++;
                                            $formno = !empty($vals["formNo"])?$vals["formNo"]:"N/A";
                                            $grp_name = $vals["grp_cd"];
                                            $sub7 = $vals["sub7"];

                                            if($vals["IntBrd_cd"] ==  1)
                                            {
                                                $image_path_selected = DIRPATH12TH.$vals['picpath']; 
                                              //  $image_path_selected = '../'.$vals['picpath']."?".rand(10000,1000000); 
                                                $type = pathinfo($image_path_selected, PATHINFO_EXTENSION);
                                              //  $image_path_selected 

                                            }
                                            else 
                                            {
                                                @$image_path_selected =  DIRPATHOTHER.'/'.$vals["coll_cd"].'/'.$vals["picpath"]; 
                                                @$type = pathinfo($image_path_selected, PATHINFO_EXTENSION); 
                                               //  @$image_path_selected = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($image_path_selected)); 
                                            }
$image_path_selected = 'file://F:\xampp\htdocs\Share Images\OldPics\Pic15-MS\100004.jpg';
                                           
                                            $disable = '<button type="button" class="btn btn-info" value="'.$vals["rno"].'" onclick="NewForm('.$vals["rno"].','.$vals["IntBrd_cd"].')">Save Form</button>';
                                            if($vals['MissingNOC']>0)
                                            {
                                                $disable = '<p style="color:red">Your NOC is missing. Please contact to Online Registration Branch at B.I.S.E</p>'; 
                                            }

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

                                            echo '<tr  >
                                            <td>'.$n.'</td>
                                            <td>'.$vals["rno"].'</td>
                                            <td>'.$vals["matRno"].'</td>

                                            <td>'.$vals["name"].'</td>
                                            <td>'.$vals["Fname"].'</td>
                                            <td>'.$grp_name.'</td>
                                            <td><img id="previewImg" style="width:40px; height: 40px;" style="-webkit-user-select: none" src="'.$image_path_selected.'" alt="Candidate Image"></td>';
                                            echo'<td>'.$disable.'</td>
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

