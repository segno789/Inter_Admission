<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            New Registration Form<a id="redgForm" data-original-title=""></a>
                        </div>

                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" action="<?php echo base_url(); ?>Registration/NewEnrolment_insert" method="post" enctype="multipart/form-data">

                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">

                                    <label class="control-label span2" >

                                    </label> 

                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="<?php echo base_url(); ?>assets/img/profile.png" alt="Candidate Image">
                                </div>
                            </div>
                            <div class="control-group">

                                <label id="ErrMsg" class="control-label span2" style=" text-align: left;"><?php  // if (($excep != "") && ($excep['excep'] != "success")){echo $excep['excep'];}  ?></label>
                                <div class="controls controls-row">
                                    <input class="span3 hidden"  type="text" placeholder="" >  
                                    <label class="control-label span2">
                                        Image :  
                                    </label> 
                                    <input type="file" class="span4" id="image" name="image" onchange="Checkfiles()">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="cand_name" style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" value = "<?php  if(($excep != "")&& ($excep['excep'] != "success")){echo strtoupper($excep['cand_name']) ;} else {echo '';}?>" maxlength="60">
                                    <label class="control-label span2" for="lblfather_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span3" id="father_name" name="father_name" style="text-transform: uppercase;" type="text" placeholder="Father's Name" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo strtoupper($excep['father_name']) ;} else {echo '';} ?>" required="required" maxlength="60">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" name="bay_form" placeholder="Bay Form No." value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['bay_form'];} else {echo '';} ?>" required="required">
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['father_cnic'];} else {echo '';} ?>" required="required">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label span1" >
                                    Date of Birth:(dd-mm-yyyy)
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="dob" name="dob" placeholder="DOB" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['dob'];} else {echo '';} ?>" required="required" readonly="readonly" >

                                    <label class="control-label span2" >
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-1234567" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['mob_number'];} else {echo '';} ?>" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    MEDIUM:
                                </label>
                                <div class="controls controls-row">
                                    <select id="medium" class="dropdown span3" name="medium">
                                        <?php if (($excep != "") && ($excep['excep'] != "success")){

                                            if($excep['medium'] == "1"){
                                                echo "<option value='1' selected='selected'>Urdu</option>
                                                <option value='2'>English</option>";
                                            }
                                            else if($excep['medium'] == "2"){
                                                echo "<option value='1' >Urdu</option>
                                                <option value='2' selected='selected'>English</option>";    
                                            }
                                        } else {echo "<option value='1' selected='selected'>Urdu</option>
                                            <option value='2'>English</option>";} ?>

                                    </select>
                                    <label class="control-label span2" >
                                        Class Roll No :
                                    </label> 
                                    <input class="span3" id="Inst_Rno" type="text" style="text-transform: uppercase;"  name="Inst_Rno" placeholder="" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['Inst_Rno'];} else {echo '';} ?>" required="required" maxlength="8">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Mark Of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="MarkOfIden" style="text-transform: uppercase;" name="MarkOfIden" maxlength="60" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['MarkOfIden'];} else {echo '';} ?>" required="required" >
                                    <label class="control-label span2" >
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                        <?php if (($excep != "") && ($excep['excep'] != "success")){

                                            if($excep['speciality'] == "0"){
                                                echo " <option value='0' selected='selected'>None</option>
                                                <option value='1'>Deaf &amp; Dumb</option>
                                                <option value='2'>Board Employee</option>";
                                            }
                                            else if($excep['speciality'] == "1"){
                                                echo "<option value='0' >None</option>
                                                <option value='1' selected='selected'>Deaf &amp; Dumb</option>
                                                <option value='2'>Board Employee</option>";    
                                            }
                                            else if($excep['speciality'] == "2"){
                                                echo "<option value='0' >None</option>
                                                <option value='1' selected='selected'>Deaf &amp; Dumb</option>
                                                <option value='2'  selected='selected' >Board Employee</option>";    
                                            }

                                        } else {echo " <option value='0' selected='selected'>None</option>
                                            <option value='1'>Deaf &amp; Dumb</option>
                                            <option value='2'>Board Employee</option>";} ?>

                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Nationality :
                                </label>
                                <div class="controls controls-row">  
                                    <?php if (($excep != "") && ($excep['excep'] != "success")){

                                      
                                        if($excep['nationality'] == "1"){
                                            echo "  <label class='radio inline span1'>
                                            <input type='radio' value='1' id='nationality' checked='checked' name='nationality'> Pakistani
                                            </label>
                                            <label class='radio inline span2'>
                                            <input type='radio'  id='nationality1' value='2' name='nationality'>  Non Pakistani 
                                            </label>";
                                        }
                                        else if($excep['nationality'] == "2"){
                                            echo "<label class='radio inline span1'>
                                            <input type='radio' value='1' id='nationality'  name='nationality'> Pakistani
                                            </label>
                                            <label class='radio inline span2'>
                                            <input type='radio'  id='nationality1' value='2' checked='checked' name='nationality'>  Non Pakistani 
                                            </label>";    
                                        }


                                    } else {echo "  <label class='radio inline span1'>
                                        <input type='radio' value='1' id='nationality' checked='checked' name='nationality'> Pakistani
                                        </label>
                                        <label class='radio inline span2'>
                                        <input type='radio'  id='nationality1' value='2' name='nationality'>  Non Pakistani 
                                        </label>";} ?>

                                    <label class="control-label span2" for="gender1">
                                        Gender :
                                    </label> 
                                    <?php
                                    // DebugBreak();
                                    // $gen = 0;
                                    // echo $gender;
                                    if($gender == 1){
                                        echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1' checked='checked' name='gender' disabled='disabled' > Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'   name='gender'  disabled='disabled' > Female </label> 
                                        ";
                                    }
                                    else if ($gender == 2){
                                        echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1'  name='gender' disabled='disabled' > Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  checked='checked'  name='gender' disabled='disabled'> Female </label> ";
                                    }
                                    ?>
                                    <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Hafiz-e-Quran :
                                </label>

                                <div class="controls controls-row">
                                    <?php if (($excep != "") && ($excep['excep'] != "success")){

                                        if($excep['hafiz'] == "1"){
                                            echo "   <label class='radio inline span1'>
                                            <input type='radio' id='hafiz1' value='1' checked='checked'   name='hafiz'> No
                                            </label>
                                            <label class='radio inline span1'>
                                            <input type='radio' id='hafiz2'  value='2' name='hafiz'> Yes
                                            </label>";
                                        }
                                        else if($excep['hafiz'] == "2"){
                                            echo " <label class='radio inline span1'>
                                            <input type='radio' id='hafiz1' value='1'    name='hafiz'> No
                                            </label>
                                            <label class='radio inline span1'>
                                            <input type='radio' id='hafiz2'  value='2' checked='checked' name='hafiz'> Yes
                                            </label>";    
                                        }


                                    } else {echo "   <label class='radio inline span1'>
                                        <input type='radio' id='hafiz1' value='1' checked='checked'   name='hafiz'> No
                                        </label>
                                        <label class='radio inline span1'>
                                        <input type='radio' id='hafiz2'  value='2' name='hafiz'> Yes
                                        </label>";} ?>

                                    <label class="control-label span3" >
                                        Religion :
                                    </label> 
                                    <?php if (($excep != "") && ($excep['excep'] != "success")){

                                        if($excep['religion'] == "1"){
                                            echo "   <label class='radio inline span1'>
                                            <input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion'> Muslim
                                            </label>
                                            <label class='radio inline span1'>
                                            <input type='radio' id='religion1' class='rel_class' value='2' name='religion'> Non Muslim
                                            </label>";
                                        }
                                        else if($excep['religion'] == "2"){
                                            echo " <label class='radio inline span1'>
                                            <input type='radio' id='religion' class='rel_class' value='1' name='religion'> Muslim
                                            </label>
                                            <label class='radio inline span1'>
                                            <input type='radio' id='religion1' class='rel_class' value='2'  checked='checked' name='religion'> Non Muslim
                                            </label>";    
                                        }


                                    } else {echo "  <label class='radio inline span1'>
                                        <input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion'> Muslim
                                        </label>
                                        <label class='radio inline span1'>
                                        <input type='radio' id='religion1' class='rel_class' value='2' name='religion'> Non Muslim
                                        </label>";} 

                                    ?>

                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label span1" >
                                Residency :
                            </label>
                            <div class="controls controls-row">  
                                <?php if (($excep != "") && ($excep['excep'] != "success")){

                                    if($excep['UrbanRural'] == "1"){
                                        echo "    <label class='radio inline span1'>
                                        <input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                        </label>
                                        <label class='radio inline span2'>
                                        <input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural 
                                        </label>";
                                    }
                                    else if($excep['UrbanRural'] == "2"){
                                        echo "<label class='radio inline span1'>
                                        <input type='radio' value='1' id='UrbanRural'  name='UrbanRural'> Urban
                                        </label>
                                        <label class='radio inline span2'>
                                        <input type='radio'  id='UrbanRural' value='2' checked='checked' name='UrbanRural'>  Rural 
                                        </label>";    
                                    }


                                } else {echo "  <label class='radio inline span1'>
                                    <input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                    </label>
                                    <label class='radio inline span2'>
                                    <input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural 
                                    </label>";} ?>

                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px;text-transform: uppercase;" id="address" class="span8" name="address" required="required"><?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['address'];} else {echo '';} ?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="control-group">
                                <h4 class="span4">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2">

                                    </label> 

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Study Group :
                                </label>
                                <div class="controls controls-row">
                                    <select id="std_group" class="dropdown span6"  name="std_group">
                                       <?php
                                        // DebugBreak();
                                        $grp = $excep['std_group'];
                                        $subgroups =  split(',',$grp_cdi);
                                        echo "<option value='0' >SELECT GROUP</option>";
                                        if(@$isReAdm == 1 )
                                        {
                                            echo " <option value='1'>Pre-Medical</option>
                                            <option value='2'>Pre-Engineering</option>
                                            <option value='3'>Humanities</option>
                                            <option value='4'>General Science</option>
                                            <option value='5'>Commerce</option>
                                            <option value='6'>Home Economics</option>
                                            ";  
                                        }
                                        if(@$isReAdm != 1)
                                        {
                                            for($i =0 ; $i<count($subgroups); $i++)
                                            {
                                                if($subgroups[$i] == 1)
                                                {
                                                    if($grp == 1)
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
                                                    if($grp == 2)
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
                                                    if($grp == 3)
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
                                                    if($grp == 4)
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
                                                    if($grp == 5)
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
                                                    if($grp == 6)
                                                    {
                                                        echo "<option value='6' selected='selected'>Home Economics</option>";  
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='6'>Home Economics</option>";  
                                                    }

                                                }
                                            } 
                                        }
                                        $subarray = array(
                                            'ENGLISH' => '1',
                                            'URDU' => '2',
                                            'BANGALI' => '3',
                                            'URDU(ALTERNATIVE EASY COURSE)' => '4',
                                            'BENGALI(ALTERNATE EASY COURSE)' => '5',
                                            'PAKISTANI CULTURE' => '6',
                                            'HISTORY' => '7',
                                            'LIBRARY SCIENCE' => '8',
                                            'ISLAMIC HISTORY & CULTURE' => '9',
                                            'FAZAL ARABIC' => '10',
                                            'ECONOMICS' => '11',
                                            'GEOGRAPHY' => '12',
                                            'MILITARY SCIENCE' => '13',
                                            'PHILOSOPHY' => '14',
                                            'ISLAMIC STUDIES(ISL-ST. GROUP)' => '15',
                                            'PSYCHOLOGY' => '16',
                                            'CIVICS' => '17',
                                            'STATISTICS' => '18',
                                            'MATHEMATICS' => '19',
                                            'ISLAMIC STUDIES' => '20',
                                            'OUTLINES OF HOME ECONOMICS' => '21',
                                            'MUSIC' => '22',
                                            'FINE ARTS' => '23',
                                            'ARABIC' => '24',
                                            'BENGALI' => '25',
                                            'BENGALI(ADVANCE)' => '26',
                                            'ENGLISH ELECTIVE' => '27',
                                            'FRENCH' => '28',
                                            'GERMAN' => '29',
                                            'LATIN' => '30',
                                            'PUNJABI' => '32',
                                            'PASHTO' => '33',
                                            'PERSIAN' => '34',
                                            'SANSKRIT' => '35',
                                            'SINDHI' => '36',
                                            'URDU (ADVANCE)' => '37',
                                            'COMMERCIAL PRACTICE' => '38',
                                            'PRINCIPLES OF COMMERCE' => '39',
                                            'HEALTH & PHYSICAL EDUCATION' => '42',
                                            'EDUCATION' => '43',
                                            'GEOLOGY' => '44',
                                            'SOCIOLOGY' => '45',
                                            'BIOLOGY' => '46',
                                            'PHYSICS' => '47',
                                            'CHEMISTRY' => '48',
                                            'ETHICS FOR NON MUSLIM' => '51',
                                            'ADEEB ARBI' => '52',
                                            'ADEEB URDU' => '53',
                                            'FAZAL URDU' => '54',
                                            'HISTORY OF PAKISTAN' => '55',
                                            'HISTORY OF ISLAM' => '56',
                                            'HISTORY OF INDO-PAK' => '57',
                                            'HISTORY OF MODREN WORLD' => '58',
                                            'APPLIED ART  (H-Eco Group)' => '59',
                                            'FOOD & NUTRITION (H-Eco Group)' => '60',
                                            'CHILD DEVELOPMENT AND FAMILY LIVING (H-Eco Group)' => '61',
                                            'PRINCIPLES OF ACCOUNTING' => '70',
                                            'PRINCIPLES OF ECONOMICS' => '71',
                                            'BIOLOGY (H-Eco Group)' => '72',
                                            'CHEMISTRY (H-Eco Group)' => '73',
                                            'CLOTHING & TEXTILE (H-Eco Group)' => '75',
                                            'HOME MANAGEMNET  (H-Eco Group)' => '76',
                                            'NURSING' => '79',
                                            'BUSINESS MATH' => '80',
                                            'COMPUTER SCIENCE' => '83',
                                            'AGRICULTURE' => '90',
                                            'PAKISTAN STUDIES' => '91',
                                            'ISLAMIC EDUCATION' => '92',
                                            'CIVICS FOR NON MUSLIM' => '93',
                                            'COMMERCIAL GEOGRAPHY' => '94',
                                            'BANKING' => '95',
                                            'TYPING' => '96',
                                            'BUSINESS STATISTICS' => '97',
                                            'COMPUTER STUDIES' => '98',
                                            'BOOK KEEPING & ACCOUNTANCY' => '99'

                                        );
                                        //$result =  array_search($data[0]['sub4'],$subarray);



                                        ?>

                                    </select>                                            

                                </div>
                            </div>
                            <div class="control-group">
                               <label class="control-label span12" style="width: 366px; font-weight: bold;" >
                                     Choose Subjects(Elective Subjects are Enabled Only)   
                                    </label> 
                              
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub1" class="span3 dropdown" name="sub1"><option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub1'];} else {echo "1";} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub1'],$subarray);} else{echo "Urdu";} ?></option></select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                        <option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub2'];} else {echo "2";} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub2'],$subarray);} else{echo "English";} ?></option></select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub3" class="span3 dropdown" name="sub3"><option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub3'];} else{ echo "3";} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub3'],$subarray);} else{echo "Islamyat Compulsory";} ?></option></select> 
                                    <select id="sub4"  name="sub4" class="span3 dropdown"><option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub4'];} else {echo "4";} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub4'],$subarray);} else{echo "Pakistan Studies";} ?></option></select>
                                </div>
                            </div>   
                             <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub5" class="span3 dropdown" name="sub5" >
                                        <option value="<?php  if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub5'];} ?>" ><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub5'],$subarray);} ?></option>
                                    </select> 
                                    <select id="sub6"  name="sub6" class="span3 dropdown">
                                        <option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub6'];} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub6'],$subarray);} ?></option>
                                    </select>
                                </div>
                            </div>   
                             <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <?php if(($grp == 5) ||($grp == 6))
                                {
                                   
                                    ?> 
                                
                                <div class="controls controls-row">
                                    <select id="sub7" class="span3 dropdown" name="sub7">
                                        <option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ if (($excep['sub7']==-1) || ($excep['sub7']==0) ) echo ""; else  echo $excep['sub7'];} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){  if (($excep['sub7']==-1) || ($excep['sub7']==0) ) echo ""; else echo array_search($excep['sub7'],$subarray);} ?></option></select> 
                                    <select id="sub8"  name="sub8" class="span3 dropdown">
                                        <option value="<?php if (($excep != "") && ($excep['excep'] != "success")){  if (($excep['sub7']==-1) || ($excep['sub7']==0) ) echo ""; else echo $excep['sub8'];} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){  if (($excep['sub7']==-1) || ($excep['sub7']==0) ) echo ""; else echo array_search($excep['sub8'],$subarray);} ?></option>
                                    </select>
                                </div>
                            </div> <?php 
                            } ?>
                            <div class="form-actions no-margin">

                                <button type="submit" onclick="return checks()" name="btnsubmitNewEnrol" class="btn btn-large btn-info offset2">
                                    Save Form
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" onclick="return CancelAlert()" >
                                <div class="clearfix">
                                </div>
                            </div>


                        </form>


                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">



    function checks(){

    var status  =  check_NewEnrol_validation();
    if(status == 0)
    {

        return false;    
    }
    else
    {
        return true;
    } 
    }

    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>index.php/Registration_11th/';
            } else {
                // user clicked "cancel"

            }
        });
    }

</script>