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

                                        <th style="width:15%" class="hidden-phone">
                                            Subject Group
                                        </th>
                                        <th style="width:5%" class="hidden-phone" >
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
                                            $formno = !empty($vals["formNo"])?$vals["formNo"]:"N/A";
                                            $grp_name = $vals["grp_cd"];
                                            $sub7 = $vals["sub7"];

                                            $disable = '<button type="button" class="btn btn-info" value="'.$vals["rno"].'" onclick="NewForm('.$vals["rno"].','.$vals["IntBrd_cd"].','.$vals["Iyear"].')">Save Form</button>';
                                            if(@$vals['MissingNOC']>0)
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
                                                case '7':
                                                    $grp_name = ' HOME ECONOMICS';
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
                                            ';
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

