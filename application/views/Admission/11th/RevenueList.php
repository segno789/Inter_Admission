<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Form Printing 11th Admission<a data-original-title="" id="notifications">s</a>
                        </div>
                                           </div>
                    <div class="widget-body">
                        <div class="control-group">
                            <h4 class="title">
                                Reports:
                            </h4>
                        </div>
                        <hr>
                        <div class="control-group">
                            <label class="control-label">
                                <b> Please Select the option and Provide input for Report:</b>
                            </label>
                        </div>
                        <div class="control-group">
                            <label class="control-label span1">
                                Select Option:
                            </label>
                            <div class="controls controls-row">
                                <label class="radio inline span1">
                                    <input type="radio" name="opt" checked="checked" value="1">Group Wise <br>
                                </label>
                                <label class="radio inline span2">
                                    <input type="radio" name="opt"  value="2">Form No. Wise
                                </label>
                            </div>
                        </div>
                        <div class="control-group" id="grp_selected">
                            <label class="control-label span1">
                                Select Group:
                            </label>
                            <div class="controls controls-row">
                                <select id="std_group"   class="dropdown span3"  name="std_group">
                           <?php

                                        // DebugBreak();
                                        $subgroups =  split(',',$grp_cdi);
                                        echo "<option value='0' >SELECT GROUP</option>";
                                        for($i =0 ; $i<count($subgroups); $i++)
                                        {
                                            if($subgroups[$i] == 1)
                                                {
                                                    if($grp_selected == 1)
                                                    {
                                                        echo "<option value='1' selected='selected'>Pre-Medical</option>";  
                                                    }
                                                    else 
                                                    {
                                                        echo "<option value='1' >Pre-Medical</option>";    
                                                    }
                                                }
                                                else if($subgroups[$i] == 2)
                                                {
                                                    if($grp_selected == 2)
                                                    {
                                                        echo "<option value='2' selected='selected'>Pre-Engineering</option>";
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='2'>Pre-Engineering</option>"; 
                                                    }

                                                }
                                                else if($subgroups[$i] == 3)
                                                {
                                                    if($grp_selected == 3)
                                                    {
                                                        echo "<option value='3' selected='selected'>Humanities</option>";  
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='3'>Humanities</option>";  
                                                    }

                                                }
                                                else if($subgroups[$i] == 4)
                                                {
                                                    if($grp_selected == 4)
                                                    {
                                                        echo "<option value='4' selected='selected'>General Science</option>";  
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='4'>General Science</option>";   
                                                    }

                                                }
                                                else if($subgroups[$i] == 5)
                                                {
                                                    if($grp_selected == 5)
                                                    {
                                                        echo "<option value='5' selected='selected'>Commerce</option>";  
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='5'>Commerce</option>";  
                                                    }

                                                }
                                                else if($subgroups[$i] == 6)
                                                {
                                                    if($grp_selected == 6)
                                                    {
                                                        echo "<option value='6' selected='selected'>Home Economics</option>";  
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='6'>Home Economics</option>";  
                                                    }

                                                }
                                        }
                                        /* <option value='1'>SCIENCE GROUP WITH BIOLOGY</option>
                                        <option value='7'>SCIENCE GROUP WITH COMPUTER SCIENCE</option>
                                        <option value='2'>HUMANTIES</option>
                                        <option value='5'>DEAF AND DUMB</option>*/
                                        ?> 
                                        </select>
                                    
                                    
                                    
                            </div>
                        </div>
                        <div style="display: none;" id="formnowise_selected" >
                        <div class="control-group" >
                        <div class="controls controls-row">
                        <label class="control-label span1">Starting Form No.</label>
                        <input type="text" id="strt_formNo"> 
                        </div>
                        </div>
                         <div class="control-group" >
                        <div class="controls controls-row">
                        <label class="control-label span1">Ending Form No.</label>
                        <input type="text" id="ending_formNo"> 
                        </div>
                        </div>
                        </div>
                      </div>
                        <div class="control-group">
                            <div class="controls controls-row">
                           <!-- <label class="span1"></label>-->
                               <!-- <input type="submit" name="get_report" id="get_report"class="btn btn-large btn-info" value="Final Print of Return">
                                <input type="submit" name="get_Proof" class="btn btn-large btn-info " id="get_Proof" value="Get Proof Print of Return">  -->
                                <input type="submit" name="get_revenue" id="get_revenue" class="btn btn-large btn-info span2"  value="Print Revenue List">
                                 <input type="submit" name="get_cutlist" id="get_cutlist" class="btn btn-large btn-success span2"  value="Print Cut List">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls control-group">
                                <label class="control-label label label-important" style="font-size: large;"> 
                                    Instructions: 1-Please Use A-4 Size (80 gram) Paper to Print All Documents/Reports.
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

