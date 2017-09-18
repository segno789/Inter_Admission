<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Form Printing Matric Admission Form<a data-original-title="" id="notifications">s</a>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="control-group">
                            <h4 class="title">
                                Reports:
                            </h4>
                            <label class="control-label label label-important" style="font-size: large;"> 
                                Instructions: 1-Please Use A-4 Size (80 gram) Paper to Print All Documents/Reports.
                            </label>
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
                                <select id="std_group"   class="dropdown span3 text-uppercase"  name="std_group">
                                <?php        
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

                                    else if($subgroups[$i] == 7)
                                    {
                                        if($grp == 5)
                                        {
                                            echo "<option value='7' selected='selected'> HOME ECONOMICS</option>";  
                                        }
                                        else
                                        {
                                            echo "<option value='7'> HOME ECONOMICS</option>";  
                                        }

                                    }
                                } 
                                echo "</select>" ?>
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
                            </br>
                            <input style="margin-left: 6.2%; width: 23%; "  type="submit" name="get_Proof_reg" id="get_Proof_reg" class="btn btn-large btn-info "  value="Get Proof Print Admission Forms">

                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls control-group">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

