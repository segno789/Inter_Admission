<div class="dashboard-wrapper class wysihtml5-supported">
<div class="left-sidebar">
<div class="row-fluid">
    <div class="span12">
        <div class="widget no-margin">
            <div class="widget-header">
                <div class="title">
                    Create batch for Admission<a data-original-title="" id="notifications">s</a>
                </div>

            </div>
            <div class="widget-body">
                <div class="control-group">
                    <h4 class="title">
                        Create Batch:
                    </h4>
                </div>
                <hr>
                <div class="control-group" style="text-align: center;">
                    <!-- <img src="<?=base_url()?>/assets/img/note_for_batch.jpg" align="middle" style="height: 69px;" alt="">-->
                </div> 
                <div class="control-group">
                    <label class="control-label span1">
                        Select Option:
                    </label>
                    <div class="controls controls-row">
                        <label class="radio inline span1">
                        <?php
                        $grp = $grp_selected;

                        if(@$spl_cd == "1")
                        {
                            echo "<input type='radio' name='batch_opt'  value='3'>Group Wise <br>
                            </label>
                            <label class='radio inline span2'>
                            <input type='radio' name='batch_opt' value='2'>Special Case(Board Employee) <br>
                            </label>
                            <label class='radio inline span2'>
                            <input type='radio' name='batch_opt' checked='checked' value='1'>Special Case(Disable) 
                            </label>
                            <label class='control-label span1'>

                            </label>
                            <div class='controls controls-row'>

                            </div>
                            </div>
                            <div class='control-group'>";
                            if($data == FALSE)
                            {
                                echo " <div class='controls controls-row'>
                                <input type='submit' id='create_batch' name='create_batch' class='btn btn-large btn-info' value='Create Batch of Complete Group' disabled='disabled' onclick='return  makebatch_groupwise();' >  </div>
                                </div>";
                            }
                            else
                            {
                                echo " <div class='controls controls-row'>
                                <input type='submit' id='create_batch' name='create_batch' class='btn btn-large btn-info' value='Create Batch of Complete Group' onclick='return  makebatch_groupwise();' >  </div>
                                </div>";
                            }
                        }
                        else if(@$spl_cd == "2"){
                            echo "<input type='radio' name='batch_opt' value='3'>Group Wise <br>
                            </label>
                            <label class='radio inline span2'>
                            <input type='radio' name='batch_opt'  checked='checked' value='2'>Special Case(Board Employee) <br>
                            </label>
                            <label class='radio inline span2'>
                            <input type='radio' name='batch_opt' value='1'>Special Case(Disable) 
                            </label>

                            <label class='control-label span1'>

                            </label>
                            <div class='controls controls-row'>

                            </div>
                            </div>
                            <div class='control-group'>";
                            if($data == FALSE)
                            {
                                echo " <div class='controls controls-row'>
                                <input type='submit' id='create_batch' name='create_batch' class='btn btn-large btn-info' value='Create Batch of Complete Group' disabled='disabled' onclick='return  makebatch_groupwise();' >  </div>
                                </div>";
                            }
                            else
                            {
                                echo " <div class='controls controls-row'>
                                <input type='submit' id='create_batch' name='create_batch' class='btn btn-large btn-info' value='Create Batch of Complete Group' onclick='return  makebatch_groupwise();' >  </div>
                                </div>";
                            }
                        }
                        else if(@$spl_cd == "3"){
                            echo "<input type='radio' name='batch_opt' checked='checked' value='3'>Group Wise <br>
                            </label>
                            <label class='radio inline span2'>
                            <input type='radio' name='batch_opt' value='2'>Special Case(Board Employee) <br>
                            </label>
                            <label class='radio inline span2'>
                            <input type='radio' name='batch_opt' value='1'>Special Case(Disable) 
                            </label>
                            </div>
                            </div>
                            <div class='control-group'>
                            <label class='control-label span1'>
                            Select Group:
                            </label>
                            <div class='controls controls-row'>
                            <select id='std_groups' name='std_group'>
                            ";

                            $subgroups =  split(',',$grp_cdi);
                            echo "<option value='0' >SELECT GROUP</option>";
                            for($i =0 ; $i<count($subgroups); $i++)
                            {

                                if($subgroups[$i] == 1)
                                {
                                    if($grp == 1)
                                    {
                                        echo "<option value='1' selected='selected'>PRE-MEDICAL</option>";  
                                    }
                                    else 
                                    {
                                        echo "<option value='1' >PRE-MEDICAL</option>";    
                                    }
                                }
                                else if($subgroups[$i] == 2)
                                {
                                    if($grp == 2)
                                    {
                                        echo "<option value='2' selected='selected'>PRE-ENGINEERING</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='2'>PRE-ENGINEERING</option>"; 
                                    }

                                }
                                else if($subgroups[$i] == 3)
                                {
                                    if($grp == 3)
                                    {
                                        echo "<option value='3' selected='selected'>HUMANITIES</option>";  
                                    }
                                    else
                                    {
                                        echo "<option value='3'>HUMANITIES</option>";  
                                    }

                                }
                                else if($subgroups[$i] == 4)
                                {
                                    if($grp == 4)
                                    {
                                        echo "<option value='4' selected='selected'>GENERAL SCIENCE</option>";  
                                    }
                                    else
                                    {
                                        echo "<option value='4'>GENERAL SCIENCE</option>";   
                                    }

                                }
                                else if($subgroups[$i] == 5)
                                {
                                    if($grp == 5)
                                    {
                                        echo "<option value='5' selected='selected'>COMMERCE</option>";  
                                    }
                                    else
                                    {
                                        echo "<option value='5'>COMMERCE</option>";  
                                    }

                                }
                            } 
                            /* <option value='1'>SCIENCE GROUP WITH BIOLOGY</option>
                            <option value='7'>SCIENCE GROUP WITH COMPUTER SCIENCE</option>
                            <option value='2'>HUMANTIES</option>
                            <option value='5'>DEAF AND DUMB</option>*/
                            echo "</select>
                            </div>
                            </div>
                            <div class='control-group'>
                            <div class='controls controls-row'>";
                            if($data == false){
                                echo " <input type='submit' id='create_batch' name='create_batch' class='btn btn-large btn-info' value='Create Batch of Complete Group' disabled='disabled' onclick='return  makebatch_groupwise();' >
                                <input type='submit' id='create_batch2' name='create_batch2' class='btn btn-large btn-info' value='Create Batch Of Selected Forms' onclick='return  disabled='disabled' makebatch_formnowise();'  > </div>
                                </div>";
                            }
                            else {
                                echo " <input type='submit' id='create_batch' name='create_batch' class='btn btn-large btn-info' value='Create Batch of Complete Group' onclick='return  makebatch_groupwise();' >
                                <input type='submit' id='create_batch2' name='create_batch2' class='btn btn-large btn-info' value='Create Batch Of Selected Forms' onclick='return  makebatch_formnowise();'  > </div>
                                </div>";
                            }
                        }
                        else if(@$spl_cd == FALSE){
                            echo "<input type='radio' name='batch_opt' checked='checked' value='3'>Group Wise <br>
                            </label>
                            <label class='radio inline span2'>
                            <input type='radio' name='batch_opt' value='2'>Special Case(Board Employee) <br>
                            </label>
                            <label class='radio inline span2'>
                            <input type='radio' name='batch_opt' value='1'>Special Case(Disable) 
                            </label>
                            </div>
                            </div>
                            <div class='control-group'>
                            <label class='control-label span1'>
                            Select Group:
                            </label>
                            <div class='controls controls-row'>
                            <select id='std_groups' name='std_group'>
                            ";

                            @$subgroups =  split(',',@$grp_cdi);
                            echo "<option value='0' >SELECT GROUP</option>";
                            for($i =0 ; $i<count($subgroups); $i++)
                            {

                                if($subgroups[$i] == 1)
                                {
                                    if($grp == 1)
                                    {
                                        echo "<option value='1' selected='selected'>PRE-MEDICAL</option>";  
                                    }
                                    else 
                                    {
                                        echo "<option value='1' >PRE-MEDICAL</option>";    
                                    }
                                }
                                else if($subgroups[$i] == 2)
                                {
                                    if($grp == 2)
                                    {
                                        echo "<option value='2' selected='selected'>PRE-ENGINEERING</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='2'>PRE-ENGINEERING</option>"; 
                                    }

                                }
                                else if($subgroups[$i] == 3)
                                {
                                    if($grp == 3)
                                    {
                                        echo "<option value='3' selected='selected'>HUMANITIES</option>";  
                                    }
                                    else
                                    {
                                        echo "<option value='3'>HUMANITIES</option>";  
                                    }

                                }
                                else if($subgroups[$i] == 4)
                                {
                                    if($grp == 4)
                                    {
                                        echo "<option value='4' selected='selected'>GENERAL SCIENCE</option>";  
                                    }
                                    else
                                    {
                                        echo "<option value='4'>GENERAL SCIENCE</option>";   
                                    }

                                }
                                else if($subgroups[$i] == 5)
                                {
                                    if($grp == 5)
                                    {
                                        echo "<option value='5' selected='selected'>COMMERCE</option>";  
                                    }
                                    else
                                    {
                                        echo "<option value='5'>COMMERCE</option>";  
                                    }

                                }
                            } 
                            echo "</select>
                            </div>
                            </div>
                            <div class='control-group'>
                            <div class='controls controls-row'>";
                            if($data == false){
                                echo " <input type='submit' id='create_batch' name='create_batch' class='btn btn-large btn-info' value='Create Batch of Complete Group' disabled='disabled' onclick='return  makebatch_groupwise();' >
                                <input type='submit' id='create_batch2' name='create_batch2' class='btn btn-large btn-info' value='Create Batch Of Selected Forms' onclick='return  disabled='disabled' makebatch_formnowise();'  > </div>
                                </div>";
                            }
                            else {
                                echo " <input type='submit' id='create_batch' name='create_batch' class='btn btn-large btn-info' value='Create Batch of Complete Group' onclick='return  makebatch_groupwise();' >
                                <input type='submit' id='create_batch2' name='create_batch2' class='btn btn-large btn-info' value='Create Batch Of Selected Forms' onclick='return  makebatch_formnowise();'  > </div>
                                </div>";
                            }
                        }
                        ?>
                        <div id="dt_example" class="example_alt_pagination">
                            <form method="POST" id="frmchk" action="<?=base_url()?>/index.php/Admission_inter/Make_Batch_Formwise">
                                <table class="table table-condensed table-striped table-hover table-bordered pull-left"  id="data-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">
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
                                            <!-- <th style="width:6%" class="hidden-phone">
                                            DOB
                                            </th>-->
                                            <th style="width:20%" class="hidden-phone">
                                                Subject Group
                                            </th>
                                            <th style="width:10%" class="hidden-phone">
                                                Selected Subjects
                                            </th>
                                            <th style="width:5%" class="hidden-phone">
                                                Picture
                                            </th>
                                            <?php
                                            if($spl_cd ==FALSE || $spl_cd =="3" )
                                            {
                                                echo '<th style="width:4%" class="hidden-phone">
                                                Select
                                                </th>';
                                            }
                                            ?>

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
                                                default:
                                                    $grp_name = "No Group Selected.";
                                            }

                                            echo '<tr  >
                                            <td>'.$n.'</td>
                                            <td>'.$formno.'</td>
                                            <td>'.$vals["name"].'</td>
                                            <td>'.$vals["Fname"].'</td>

                                            <td>'.$grp_name.'</td>
                                            <td>'.$vals["sub1_abr"].','.$vals["sub2_abr"].','.$vals["sub8_abr"].','.$vals["sub4_abr"].','.$vals["sub5_abr"].','.$vals["sub6_abr"].','.$vals["sub7_abr"].'</td>
                                            <td><img id="previewImg" style="width:40px; height: 40px;" src="'.base_url().$vals['picpath'].'?'.rand(10000,1000000).'" alt="Candidate Image"></td>';

                                            if($spl_cd ==FALSE || $spl_cd =="3" )
                                                echo'<td>
                                                <input type="checkbox" name="chk[]" value="'.$formno.'" style="width: 25px;    height: 28px;"/></td></tr>';
                                            endforeach;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </form>
                            <div class="clearfix"></div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>