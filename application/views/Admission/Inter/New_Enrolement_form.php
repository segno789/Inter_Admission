<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            Admission form<a id="redgForm" data-original-title=""></a>
                        </div>

                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" name="myform" id="myform" action="<?php  echo base_url(); ?>/index.php/Admission_inter/NewEnrolment_INSERT_inter" method="post" enctype="multipart/form-data">

                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">

                                    <label class="control-label span2" >

                                    </label> 
                                    <!--echo '/'.IMAGE_PATH.$Inst_Id.'/'.$data[0]['PicPath'];-->
                                    <img id="previewImg" style="width:140px; height: 140px;" src="<?php echo base_url() .$data[0]['picpath'];?>" alt="Candidate Image" />
                                    <input type="hidden" value="<?php echo  $data['0']['picpath']?>" name="pic">
                                </div>
                            </div>
                            <div class="control-group">

                                <label id="ErrMsg" class="control-label span2" style=" text-align: left;"><?php ?></label>
                                <div class="controls controls-row">
                                    <input class="span3 hidden"  type="text" placeholder="" >  


                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name :
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3"  type="text" id="cand_name" readonly="readonly" style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" maxlength="60"  value="<?php   echo  $data['0']['name']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?>  >
                                    <label class="control-label span2" for="lblfather_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span3" id="father_name" name="father_name" readonly="readonly" style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" value="<?php echo  $data['0']['Fname']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?> required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" name="bay_form" placeholder="Bay Form No." value="<?php echo  $data['0']['BForm']; ?>" required="required"  <?php //if( $data['0']['BForm']>=10) echo "readonly='readonly'";  ?>>
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1" value="<?php echo  $data['0']['FNIC']; ?>" readonly <?php //if($data['0']['FNIC']>=10) echo "readonly='readonly'";  ?> required="required">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label span1" >
                                    Mobile Number :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789" value=<?php  echo  $data['0']['MobNo']; ?> required="required">

                                    <label class="control-label span2" >
                                        Class Roll No :
                                    </label> 
                                    <input class="span3" id="Inst_Rno" type="text"  style="text-transform: uppercase;" name="Inst_Rno" placeholder="" value="<?php echo  $data['0']['classRno']; ?>" required="required" maxlength="8">
                                </div>
                            </div>
                            <!--  <div class="control-group">
                            <label class="control-label span1" >
                            Date of Birth:(dd-mm-yyyy)
                            </label>

                            <div class="controls controls-row">
                            <input class="span3" type="text" id="dob" name="dob" style="text-align: left;" placeholder="DOB" value="
                            <?php
                            /* $source = $data['0']['Dob'];
                            $date = new DateTime($source);
                            $trim =  trim($date->format('d-m-Y')," "); 
                            echo $trim;*/
                            ?>" required="required" readonly="readonly" disabled="disabled"  >

                            <label class="control-label span2" >
                            Mobile Number :
                            </label> 
                            <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789" value=<?php  echo  $data['0']['MobNo']; ?> required="required">
                            </div>
                            </div>-->
                            <div class="control-group">
                                <label class="control-label span1" >
                                    MEDIUM:
                                </label>
                                <div class="controls controls-row">
                                    <select id="medium" class="dropdown span3" name="medium">
                                        <?php // //DebugBreak();
                                        $med = $data['0']['med'] ;
                                        // $med = 2; 
                                        if($med == 1)
                                        {
                                            echo  "<option value='1' selected='selected'>Urdu</option> <option value='1'>English</option>";
                                        }
                                        else
                                        {
                                            echo  "<option value='2' >Urdu</option> <option value='2' selected='selected'>English</option>";
                                        }
                                        ?>

                                    </select>



                                    <label class="control-label span2" >
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                        <?php // //DebugBreak();
                                        $spec = $data['0']['Spec'] ;
                                        // $med = 2; 
                                        if($spec == 0)
                                        {
                                            echo  "<option value='0' selected='selected'>None</option>  <option value='1'>Deaf &amp; Dumb</option> <option value='2'>Board Employee</option>";
                                        }
                                        else if($spec == 1)
                                        {
                                            echo  "<option value='0' >None</option>  <option value='1' selected='selected'>Deaf &amp; Dumb</option> <option value='2'>Board Employee</option>";
                                        }
                                        else if($spec == 2){
                                            echo  "<option value='0' >None</option>  <option value='1' >Deaf &amp; Dumb</option> <option value='2' selected='selected'>Board Employee</option>";                                           
                                        }
                                        ?>



                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label span1" >
                                    Mark Of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="MarkOfIden" style="text-transform: uppercase;" name="MarkOfIden" value="<?php echo  $data['0']['markOfIden']; ?>" required="required" maxlength="60" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Nationality :
                                </label>
                                <div class="controls controls-row">  
                                    <?php
                                    $nat = $data[0]['nat'];
                                    if($nat == 1)
                                    {
                                        echo  " <label class='radio inline span1'><input type='radio' value='1' id='nationality' checked='checked' name='nationality'> Pakistani
                                        </label><label class='radio inline span2'><input type='radio'  id='nationality1' value='2' name='nationality'>  Non Pakistani</label>" ;
                                    }
                                    else if ($nat == 2)
                                    {
                                        echo  "<label class='radio inline span1'><input type='radio' value='1' id='nationality'  name='nationality'> Pakistani
                                        </label><label class='radio inline span2'><input type='radio'  id='nationality1' checked='checked' value='2' name='nationality'>  Non Pakistani</label>" ;
                                    }
                                    ?>

                                    <label class="control-label span2" for="gender1">
                                        Gender :
                                    </label> 
                                    <?php
                                    $gender = $data[0]['sex'];
                                    if($gender == 1)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1' checked='checked'  disabled='disabled' name='gender'> Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  name='gender'  disabled='disabled'> Female </label> " ;
                                    }
                                    else if ($gender == 2)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1'  disabled='disabled' name='gender'> Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  checked='checked'  disabled='disabled'  name='gender'> Female </label> " ;
                                    }
                                    ?>
                                    <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                                    <input type="hidden" name="gend" value="<?php echo $gender; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Hafiz-e-Quran :
                                </label>
                                <div class="controls controls-row">
                                    <?php
                                    // //DebugBreak();
                                    if($isReAdm == 1)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1'  name='hafiz'> No</label>
                                        <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' checked='checked' name='hafiz'> Yes</label>";
                                    }
                                    else
                                    {
                                        // $hafiz = $data[0]['Ishafiz'];
                                        //if ($hafiz == 1)
                                        //{
                                        echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1' checked='checked' name='hafiz'> No</label>
                                        <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' name='hafiz'> Yes</label>";
                                        //}
                                        /*else if(!isset($hafiz))
                                        {
                                        echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1'  name='hafiz'> No</label>
                                        <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' checked='checked' name='hafiz'> Yes</label>";
                                        }*/
                                    }    
                                    ?>

                                    <label class="control-label span3" >
                                        Religion :
                                    </label> 
                                    <?php
                                    $rel = $data[0]['rel'];
                                    if($rel == 1)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion'> Muslim
                                        </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' name='religion'> Non Muslim</label>" ;
                                    }
                                    else if ($rel == 2)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1'  name='religion'> Muslim
                                        </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' checked='checked' name='religion'> Non Muslim</label>" ;
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label span1" >
                                Residency :
                            </label>
                            <div class="controls controls-row">  
                                <?php
                                $resid = $data[0]['ruralOrurban'];
                                if($resid == 0  || $rel == 1 )
                                {
                                    echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                    </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural </label>";
                                }
                                else if($resid == 2)
                                {
                                    echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' name='UrbanRural'> Urban
                                    </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2'  checked='checked'  name='UrbanRural'>  Rural </label>";
                                }

                                ?>

                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px; text-transform: uppercase;"  id="address" class="span8" name="address" required="required"><?php
                                        echo $data[0]['addr'];
                                    ?></textarea>
                                </div>
                            </div>

                            <hr>

                            <div class="control-group">
                                <h4 class="span3">Exam Proposed Center Information :</h4>
                                <div class="controls controls-row">
                                    <label class="control-label span2">
                                    </label> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    District :
                                </label>
                                <div class="controls controls-row">
                                    <select class='span3' id='pvtinfo_dist' name='pvtinfo_dist' required='required'>
                                        <option value='0'>SELECT DISTRICT</option>
                                        <option value="<?php echo $dist; ?>">
                                            <?php
                                            // DebugBreak();
                                            // $dist;
                                            switch($dist)
                                            {
                                                case 1:
                                                    echo "GUJRANWALA";
                                                    break;

                                                case 2:
                                                    echo "GUJRAT";
                                                    break;

                                                case 3:
                                                    echo "HAFIZABAD";
                                                    break;

                                                case 4:
                                                    echo "MANDI BAHA-UD-DIN";
                                                    break;

                                                case 5:
                                                    echo "NAROWAL";
                                                    break;

                                                case 6:
                                                    echo "SIALKOT";
                                                    break;

                                                default:
                                                    echo "NO DISTRICT SELECTED";
                                                    break;
                                            }

                                        ?>    </option>

                                    </select>
                                    <label class="control-label span2" >
                                        Tehsil:
                                    </label> 
                                    <select class='span3' id='pvtinfo_teh' name='pvtinfo_teh' required='required'>
                                        <option value='0'>SELECT TEHSIL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label span1" >
                                Zone :
                            </label>

                            <div class="controls controls-row">
                                <select id="pvtZone"  class="span3" name="pvtZone">
                                    <option value='0'>SELECT ZONE</option>
                                </select>
                            </div>
                            <div id="instruction" style="display:none; width:700px" ></div>
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
                                    <select id="std_group" class="dropdown span6"  name="std_group" disabled="disabled">
                                        <?php
                                        // DebugBreak();
                                        $grp = $data[0]['grp_cd'];
                                        //  $grp_name = $vals["grp_cd"];
                                        $sub7 = $data[0]["sub7"];
                                        /*     if($grp==1 && $sub7==78)
                                        {
                                        $grp = 7;
                                        }
                                        if($grp == 1 && $sub7 == 43){
                                        $grp = 8;
                                        }
                                        if($grp == 1 && $sub7 == 8){
                                        $grp = 1;
                                        }*/
                                        $subgroups =  split(',',$grp_cdi);
                                        echo "<option value='0' >SELECT GROUP</option>";
                                        if($isReAdm == 1 )
                                        {
                                            echo "<option value='1' >PRE-MEDICAL</option>
                                            <option value='2'>PRE-ENGINEERING</option>
                                            <option value='3' >HUMANITIES</option>
                                            <option value='4'>GENERAL SCIENCE</option>
                                            <option value='5'>COMMERCE</option>
                                            ";  
                                        }
                                        if($isReAdm != 1)
                                        {
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
                                        }
                                        $subarray = array(
                                            'NONE'=>'',
                                            'NONE'=>'0',
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
                                            'ADEEB ARBIC' => '52',
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
                                        $result =  array_search($data[0]['sub4'],$subarray);
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
                                <div class="control row controls-row">
                                    <label class="control-label span3 " id="lblpart1cat" name="lblpart1cat" style="text-decoration: underline; font-weight: bold;" >
                                        PART-I Subjects
                                    </label>
                                    <label class="control-label span3 " id="lblpart2cat" name="lblpart2cat" style="text-decoration: underline; font-weight: bold;" >
                                        PART-II Subjects
                                    </label>
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub1" class="span3 dropdown" name="sub1">
                                        <?php if($data[0]['sub1pf1']==2){ ?>
                                            <option value="<?php  echo $data[0]['sub1'];?>"><?php
                                                echo array_search($data[0]['sub1'],$subarray);
                                            ?></option>
                                            <?php } ?>
                                        <option value="0"  <?php if($data[0]['sub1pf1']==1) echo "selected='selected'"; ?> >NONE</option>
                                    </select> 

                                    <select id="sub1p2" class="span3 dropdown" name="sub1p2">
                                        <option value="<?php echo $data[0]['sub1'];?>"><?php
                                            echo array_search($data[0]['sub1'],$subarray);
                                        ?></option>
                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                        <?php if($data[0]['sub2pf1']==2){ ?>
                                            <option value="<?php echo $data[0]['sub2'];?>"><?php
                                                echo array_search($data[0]['sub2'],$subarray);
                                            ?></option>
                                            <?php } ?>
                                        <option value="0"  <?php if($data[0]['sub2pf1']==1) echo "selected='selected'"; ?> >NONE</option>
                                    </select>
                                    <select id="sub2p2" class="span3 dropdown" name="sub2p2">
                                        <option value="<?php echo $data[0]['sub2'];?>"><?php
                                            echo array_search($data[0]['sub2'],$subarray);
                                        ?></option>
                                    </select> 
                                </div>



                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub3" class="span3 dropdown" name="sub3">
                                        <?php if($data[0]['sub3pf1']==2){ ?>
                                            <option value="<?php echo $data[0]['sub3'];?>"><?php
                                                echo array_search($data[0]['sub3'],$subarray);
                                            ?></option>
                                            <?php } ?>
                                        <option value="0"  <?php if($data[0]['sub3pf1']==1) echo "selected='selected'"; ?> >NONE</option>
                                    </select> 
                                    <select id="sub3p2" class="span3 dropdown" name="sub3p2">
                                         <option value="<?php echo $data[0]['sub8'];?>"><?php
                                            echo array_search($data[0]['sub8'],$subarray);
                                        ?></option>
                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub4"  name="sub4" class="span3 dropdown">
                                        <?php if($data[0]['sub4pf1']==2){ ?>
                                            <option value="<?php echo $data[0]['sub4'];?>"><?php
                                                echo array_search($data[0]['sub4'],$subarray);
                                            ?></option>
                                            <?php } ?>
                                        <option value="0"  <?php if($data[0]['sub4pf1']==1) echo "selected='selected'"; ?> >NONE</option>
                                    </select>
                                    <select id="sub4p2" class="span3 dropdown" name="sub4p2">
                                        <option value="<?php echo $data[0]['sub4'];?>"><?php
                                            echo array_search($data[0]['sub4'],$subarray);
                                        ?></option>
                                    </select> 
                                </div>

                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub5" class="span3 dropdown" name="sub5" selected="selected">
                                        <?php if($data[0]['sub5pf1']==2){ ?>
                                            <option value="<?php echo $data[0]['sub5'];?>"><?php
                                                echo array_search($data[0]['sub5'],$subarray);
                                            ?></option>
                                            <?php } ?>
                                        <option value="0"  <?php if($data[0]['sub5pf1']==1) echo "selected='selected'"; ?> >NONE</option>


                                    </select> 
                                    <select id="sub5p2" class="span3 dropdown" name="sub5p2" selected="selected">
                                        <option value="<?php if($grp==5){ echo '94';} else echo $data[0]['sub5'];?>"><?php

                                            if($grp==5)
                                            { 
                                                echo array_search(94,$subarray);
                                            }
                                            else
                                            {
                                                echo array_search($data[0]['sub5'],$subarray);
                                            }


                                        ?></option>
                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub6"  name="sub6" class="span3 dropdown" selected="selected">
                                        <?php if($data[0]['sub6pf1']==2){ ?>
                                            <option value="<?php echo $data[0]['sub6'];?>"><?php
                                                echo array_search($data[0]['sub6'],$subarray);
                                            ?></option>
                                            <?php } ?>
                                        <option value="0"  <?php if($data[0]['sub6pf1']==1) echo "selected='selected'"; ?> >NONE</option>
                                    </select>
                                    <select id="sub6p2"  name="sub6p2" class="span3 dropdown" selected="selected">
                                        <option value="<?php if($grp==5){ echo '97';} else echo $data[0]['sub6'];?>"><?php

                                            if($grp==5)
                                            { 
                                                echo array_search(97,$subarray);
                                            }
                                            else
                                            {
                                                echo array_search($data[0]['sub6'],$subarray);
                                            }
                                        ?></option>
                                    </select>
                                </div>
                                <?php 
                                // echo  'test-------'.$grp;
                                if($grp==5)
                                { ?>
                                    <div class="control row controls-row">
                                        <label class="control-label span1" >

                                        </label>
                                        <select id="sub7" class="span3 dropdown" name="sub7" selected="selected">
                                            <?php 




                                            if($data[0]['sub7pf1']==2){ ?>
                                                <option value="<?php echo $data[0]['sub7'];?>"><?php
                                                    echo array_search($data[0]['sub7'],$subarray);
                                                ?></option>
                                                <?php } ?>
                                            <option value="0"  <?php if($data[0]['sub7pf1']==1) echo "selected='selected'"; ?> >NONE</option>
                                        </select> 
                                        <select id="sub7p2" class="span3 dropdown" name="sub7p2" selected="selected">

                                            <option value="<?php echo '95';?>"><?php
                                                echo array_search(95,$subarray);
                                            ?></option>
                                            <?php }?>
                                    </select> 
                                </div> 
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>

                                </div>

                            </div>
                            <div class="form-actions no-margin">
                                <input type="hidden"   value="<?php  echo  $data[0]['FormNo']; ?>"  name="formNo">
                                <input type="hidden"   value="<?php  echo  $isReAdm; ?>"  name="IsReAdm">
                                <input type="hidden"   value="<?php  echo $data[0]['rno']; ?>"  name="OldRno"> <!--$data[0]['rno']; -->

                                <input type="hidden"   value="<?php echo   $data[0]['Iyear'];  ?>"  name="Oldyear">
                                <input type="hidden"   value="<?php echo   $data[0]['sess'];  ?>"  name="Oldsess">
                                <input type="hidden"   value="<?php echo   $data[0]['Brd_cd'];  ?>"  name="Oldbrd">
                                <input type="hidden"   value="<?php echo   $gender;  ?>"  name="sex">
                                <input type="hidden"   value="<?php  echo  $data['0']['name']; ?>"  name="cand_name_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['Fname']; ?>"  name="father_name_hidden">
                                <!--  <input type="hidden"   value="<?php  //echo  $date->format('d-m-Y');  ?>"  name="dob_hidden">-->
                                <input type="hidden"   value="<?php  echo  $grp; ?>"  name="std_group_hidden">
                                <input type="hidden"   value="<?php  echo  $data[0]['sub1']; ?>"  name="sub1_hidden">
                                <input type="hidden"   value="<?php  echo  $data[0]['sub2']; ?>"  name="sub2_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub3']; ?>"  name="sub3_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub4']; ?>"  name="sub4_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub5']; ?>"  name="sub5_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub6']; ?>"  name="sub6_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub7']; ?>"  name="sub7_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub8']; ?>"  name="sub8_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub1pf1']; ?>"  name="sub1pf1_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub2pf1']; ?>"  name="sub2pf1_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub3pf1']; ?>"  name="sub3pf1_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub4pf1']; ?>"  name="sub4pf1_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub5pf1']; ?>"  name="sub5pf1_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub6pf1']; ?>"  name="sub6pf1_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['sub7pf1']; ?>"  name="sub7pf1_hidden">

                                <button type="submit" onclick="return checks()" name="btnsubmitUpdateEnrol" class="btn btn-large btn-info offset2">
                                    Save Form
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
                                <div class="clearfix">
                                </div>
                            </div>


                        </form>
                        <script type="text/javascript">



                            function checks(){

                                var status  =  check_NewEnrol_validation_regular();
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
                                        window.location.href ='<?php echo base_url(); ?>index.php/Admission_inter/StudentsData';
                                    } else {
                                        // user clicked "cancel"

                                    }
                                });
                            }
                            function readURL(input) {
                                var res_field = input.value;   
                                var extension = res_field.substr(res_field.lastIndexOf('.') + 1).toLowerCase();
                                var allowedExtensions = ['jpg','jpeg'];
                                if (res_field.length > 0)
                                {
                                    if (allowedExtensions.indexOf(extension) === -1) 
                                    {
                                        alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
                                        return false;
                                    }
                                }

                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    var fileName = $(input).val().toLowerCase();

                                    reader.onload = function (e) {
                                        $('#previewImg').attr('src', e.target.result);
                                    }

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                            function hasExtension(input, exts) {
                                var fileName = document.getElementById(inputID).value;
                                return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
                            } 
                        </script>

                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
