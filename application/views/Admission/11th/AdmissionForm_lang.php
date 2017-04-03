<style type="">


    .form-wrap #output{
        margin: 10px 0;
    }

    .form-wrap .images {
        width: 100%;
        display: block;
        border: 1px solid #e8e8e8;
        padding: 5px;
        margin: 5px 0;
    }/* progress bar */
    #progress-wrp {
        border: 1px solid #0099CC;
        padding: 1px;
        position: relative;
        border-radius: 3px;
        margin-left: 650px;
        margin-bottom: 16px;
        text-align: left;
        background: #fff;
        width:250px;
        box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
    }
    #progress-wrp .progress-bar{
        height: 20px;
        border-radius: 3px;
        background-color: #f39ac7;
        width: 0;
        box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
    }
    #progress-wrp .status{
        top:3px;
        left:50%;
        position:absolute;
        display:inline-block;
        color: #000000;
    }

</style>
<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            Private HSSC Part-I Amission Form<a id="redgForm" data-original-title=""></a>
                        </div>

                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" action="<?php  echo base_url(); ?>Admission_11th_pvt/NewEnrolment_insert" method="post" enctype="multipart/form-data" id='admfrmID'>

                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                <label class="control-label span2" style="width: 411px;margin-left: -199px;">

                                    <img src="<?php echo base_url(); ?>assets/img/upalodimage.jpg" alt="" >
                                </label>
                                <div class="controls controls-row" id="output">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <input type="hidden" class="span2 hidden" id="picname" name="picname" value="">
                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="<?php echo base_url(); ?>assets/img/profile.png" alt="Candidate Image">


                                </div>
                            </div>
                            <div class="control-group">

                                <label id="ErrMsg" class="control-label span2" style=" text-align: left;"><?php ?></label>

                                <div class="controls controls-row">
                                    <div id="progress-wrp"><div class="progress-bar"></div ><div class="status">0%</div></div>
                                    <input class="span3 hidden"  type="text" placeholder="" >  
                                    <label class="control-label span2">
                                        Image :  
                                    </label> 
                                    <input type="file" class="span4" id="image" name="__files[]">

                                </div>
                            </div>
                            <?php
                            @$brd_cd =  @$data[0]['SSC_brd_cd'];
                            ?>
                            <div class="control-group">
                                <label class="control-label span1" >Candidate Name:</label>
                                <div class="controls controls-row">
                                    <input class="span3"  type="text" id="cand_name"  style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" maxlength="60"  value="<?php  echo  @$data['0']['name']; ?>"  >
                                    <label class="control-label span2" for="lblfather_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span3" id="father_name" name="father_name"  style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" value="<?php echo  @$data['0']['Fname']; ?>"  required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" name="bay_form"  placeholder="Bay Form No." value="<?php echo  @$data['0']['bFormNo']; ?>" required="required" >
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1" value="<?php echo  @$data['0']['FNIC']; ?>"  required="required">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label span1" >
                                    Date of Birth:(dd-mm-yyyy)
                                </label>
                                <?php
                                $source = @$data['0']['dob'];
                                if($source !=''){
                                    $date = new DateTime($source);
                                    $date1 = $date->format('d-m-Y');    
                                }
                                else{
                                    $date1 ='';
                                }

                                ?>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="dob" name="dob" placeholder="DOB" value="<?php echo @$date1;   ?>" required="required" readonly="readonly"  >

                                    <label class="control-label span2" >
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789"  required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    MEDIUM:
                                </label>
                                <div class="controls controls-row">
                                    <select id="medium" class="dropdown span3" name="medium">
                                        <option value='1' selected='selected'>Urdu</option> <option value='2'>English</option>

                                    </select>
                                    <label class="control-label span2" >
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                        <option value='0' selected='selected'>None</option>  <option value='1'>Deaf &amp; Dumb</option><option value='3'>Blind</option> <option value='2'>Board Employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Mark Of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="MarkOfIden" style="text-transform: uppercase;" name="MarkOfIden" value="" required="required" maxlength="60" >

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Nationality :
                                </label>
                                <div class="controls controls-row">  
                                    <?php

                                    // DebugBreak();
                                    $nat = @$data[0]['IsPakistani'];
                                    $matric_sub1 = @$data[0]['sub1'];

                                    if(@$brd_cd ==1 )
                                    {
                                        if($nat == 1 || $nat == 0)
                                        {
                                            echo  " <label class='radio inline span1'><input  disabled='disabled' type='radio' value='1' id='nationality' checked='checked' name='nationality' readonly='readonly'> Pakistani
                                            </label><label  class='radio inline span2'><input disabled='disabled' type='radio'  id='nationality1' value='2' name='nationality' readonly='readonly'>  Non Pakistani</label>" ;
                                        }
                                        else if ($nat == 2)
                                        {
                                            echo  "<label class='radio inline span1'><input  disabled='disabled' type='radio' value='1' id='nationality'  name='nationality' readonly='readonly'> Pakistani
                                            </label><label  class='radio inline span2'><input disabled='disabled' type='radio'  id='nationality1' checked='checked' value='2' name='nationality' readonly='readonly'>  Non Pakistani</label>" ;
                                        }
                                        else{
                                            echo  " <label  class='radio inline span1'><input disabled='disabled' type='radio' value='1' id='nationality' checked='checked' name='nationality' readonly='readonly'> Pakistani
                                            </label><label  class='radio inline span2'><input disabled='disabled' type='radio'  id='nationality1' value='2'  name='nationality' readonly='readonly'>  Non Pakistani</label>" ;
                                        }
                                    }
                                    else
                                    {
                                        echo  " <label  class='radio inline span1'><input type='radio' value='1' id='nationality' checked='checked' name='nationality'> Pakistani
                                        </label><label  class='radio inline span2'><input type='radio'  id='nationality1' value='2' name='nationality'>  Non Pakistani</label>" ;
                                        $nat = 1;
                                    }  



                                    ?>

                                    <label class="control-label span2" for="gender1">
                                        Gender :
                                    </label> 
                                    <?php
                                    //DebugBreak();
                                    //$gender;

                                    $gender = @$data[0]['Gender'];

                                    if($gender == 1 )
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1' checked='checked'  disabled='disabled' name='gender'> Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  name='gender'  disabled='disabled'> Female </label> " ;
                                    }
                                    else if ($gender == 2)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1'  disabled='disabled' name='gender'> Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  checked='checked'  disabled='disabled'  name='gender'> Female </label> " ;
                                    }
                                    else
                                    {
                                         echo " <label class='radio inline span1' style='    color: red;'><input type='radio' id='gender1'  name='ogender' value='1'> Male</label> 
                                        <label class='radio inline span1'  style='    color: red;'><input type='radio' id='gender2' value='2'   name='ogender'> Female </label> " ;
                                    }

                                    ?>
                                    <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                                    <input type="hidden" name="nationality_hidden" id="nationality_hidden" value="<?php echo $nat; ?>">
                                    <input type="hidden" name="matric_sub1" id="matric_sub1" value="<?php  echo $matric_sub1; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Hafiz-e-Quran :
                                </label>
                                <div class="controls controls-row">
                                    <?php
                                    //DebugBreak();

                                    if((@$data['0']['excep'] != ""))
                                    {
                                        if(@$data['0']['IsHafiz']==1 || @$data['0']['IsHafiz']==0)
                                        {
                                            echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1' checked='checked' name='hafiz'> No</label>
                                            <label class='radio inline span1'><input type='radio' id='hafiz2' value='2'  name='hafiz'> Yes</label>";
                                        }
                                        else if(@$data['0']['IsHafiz']==2)
                                        {
                                            echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1'  name='hafiz'> No</label>
                                            <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' checked='checked' name='hafiz'> Yes</label>"; 
                                        }
                                        else if($isReAdm == 0)
                                        {
                                            echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1'  name='hafiz'> No</label>
                                            <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' checked='checked' name='hafiz'> Yes</label>";
                                        }
                                        else
                                        {
                                            echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1' checked='checked' name='hafiz'> No</label>
                                            <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' name='hafiz'> Yes</label>";
                                        }     
                                    }
                                    else
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1' checked='checked' name='hafiz'> No</label>
                                        <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' name='hafiz'> Yes</label>";
                                    }

                                    ?>

                                    <label class="control-label span3" >
                                        Religion :
                                    </label> 
                                    <?php
                                    $rel = @$data[0]['IsMuslim'];
                                    //if((@$data['0']['excep'] != "success"))
                                    //  {
                                    if($brd_cd == 1)
                                    {
                                        if($rel == 1 || $rel == 0)
                                        {
                                            echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion'> Muslim
                                            </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' name='religion'> Non Muslim</label>" ;
                                        }
                                        else if ($rel == 2)
                                        {
                                            echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1'  name='religion'> Muslim
                                            </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' checked='checked' name='religion'> Non Muslim</label>" ;
                                        } 
                                    }
                                    else
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion'> Muslim
                                        </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' name='religion'> Non Muslim</label>" ;
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
                                //DebugBreak();
                                // $isrural;
                                $resid = @$data[0]['isRural'];
                                if($brd_cd == 1)
                                {
                                    if($resid == 1 ||  $resid == 0)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                        </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural </label>";
                                    }
                                    else if($resid == 2)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' name='UrbanRural'> Urban
                                        </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2'  checked='checked'  name='UrbanRural'>  Rural </label>";
                                    }    
                                }
                                else
                                {
                                    echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                    </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural </label>";
                                }


                                ?>

                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px; text-transform: uppercase;"  id="address" class="span8" name="address" required="required"><?php 
                                        echo @$data[0]['addr'];
                                    ?></textarea>
                                </div>
                            </div>



                            <hr>
                            <div class="control-group">
                                <h4 class="span3">SSC Exam Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2">

                                    </label> 

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
                                        <option value='1'>GUJRANWALA</option>
                                        <option value='2'>GUJRAT</option>
                                        <option value='3'>HAFIZABAD</option>
                                        <option value='4'>MANDI BAHA-UD-DIN</option>
                                        <option value='5'>NAROWAL</option>
                                        <option value='6'>SIALKOT</option>
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
                            </div>


                            <hr>
                            <div class="control-group">
                                <h4 class="span4">Group and Subject Information :</h4>
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

                                        //  DebugBreak();
                                        $grp = @$data[0]['RegGrp'];
                                        //$subgroups =  split(',',$grp_cdi);
                                       // echo "<option value='0' >SELECT GROUP</option>";
                                        if($isReAdm == 0 )
                                        {
                                            echo " 
                                            <option value='9'>Aloom-e-Sharkia</option>
                                            ";  
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
                                        //$result =  array_search(@$data[0]['sub4'],$subarray);



                                        ?>

                                    </select>                                            
                                     
                                   
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label span1" >
                                    Category :
                                </label>
                                <div class="controls controls-row">
                                     <select id="lang_cat" name="lang_cat" class='span2'>
                                    <option value="1">ADEEB</option>
                                    <option value="3">FAZAL</option>
                                    </select>
                                    <label class="control-label span2" >
                                        Subject :
                                    </label> 
                                    <select class='span2' id="lang_specialSub" name="lang_specialSub">
                                    <option value="2">URDU</option>
                                    <option value="24">ARABIC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                              
                             <div class="controls controls-row" style="width: 342px;">
                              <input type="checkbox" id="isAlreadyApplied" name="isAlreadyApplied" class="span1"  > <label class="control-label span11" style="font-weight: bold;" >Already Appeared in Aloom-e-Sharkia Exam.</label> 
                            </div>
                            </div>
                          
                            
                            <div id="oldExamInfo_lang">
                             <div class="control-group">
                                <label class="control-label span1" >
                                    Old Roll No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3"  type="text" id="old_rno_lang"  style="text-transform: uppercase;" name="old_rno_lang" placeholder="" maxlength="60"  value=""  >
                                    <label class="control-label span2" for="lblfather_name">
                                        Year :
                                    </label> 
                                    <select class="span3" id="old_year_lang" name="old_year_lang" required="required" >
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    </select>
                                   
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Session :
                                </label>
                                <div class="controls controls-row">
                                <select class="span3" id="old_sess_lang" name="old_sess_lang" required="required">
                                <option value="1">ANNUAL</option>
                                <option value="2">SUPPLEMENTARY</option>
                                </select>
                                    
                                    <label class="control-label span2" for="father_cnic">
                                        Board :
                                    </label> 
                                   

                                    <input class="span3" id="old_brd_cd_lang" name="old_brd_cd_lang" readonly="readonly" type="text" placeholder="" value="BISE,GUJRANWALA"required="required">
                                </div>
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
                                    <select id="sub1" class="span3 dropdown" name="sub1">
                                            <option value="1">Paper-I</option>
                                            <option value="0">NONE</option>

                                    </select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                              <option value="2">Paper-II</option>
                                            <option value="0">NONE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub3" class="span3 dropdown" name="sub3">
                                    <option value="3">Paper-III</option>
                                    <option value="0">NONE</option>
                                    </select> 
                                    <select id="sub4"  name="sub4" class="span3 dropdown">
                                            <option value="4">Paper-IV</option>
                                    <option value="0">NONE</option>
                                    </select>
                                </div>
                            </div>    <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub5" class="span3 dropdown" name="sub5" selected="selected">
                                                 <option value="5">Paper-V</option>
                                    <option value="0">NONE</option>
                                    </select> 
                                    <select id="sub6"  name="sub6" class="span3 dropdown" selected="selected">
                                                      <option value="6">Paper-VI</option>
                                    <option value="0">NONE</option>
                                    </select>
                                </div>
                            </div>    <div class="control-group">
                            <label class="control-label span1" >

                            </label>
                            <div class="controls controls-row">
                                <select id="sub7" class="span3 dropdown" name="sub7" selected="selected" style="display: none;">

                                </select> 
                             
                            </div>
                            <div id="instruction" style="display:none; width:700px" >
                                <img src="<?php  echo base_url().'assets/img/Instruction_alooma.jpg'; ?>" border="0" width="950" height="773" alt="Instruction_alooma.jpg (152,412 bytes)">
                            </div>
                            <div class="form-actions no-margin">
                                <input type="hidden"   value=""  name="formNo">
                                <input type="hidden"   value="<?php  echo @$isReAdm; ?>"  name="IsReAdm">
                                <input type="hidden"   value="<?php  echo @$data[0]['SSC_RNo']; ?>"  name="OldRno">
                                <input type="hidden"   value="<?php  echo @$data[0]['SSC_Year']; ?>"  name="OldYear">
                                <input type="hidden"   value="<?php  echo @$data[0]['SSC_Sess']; ?>"  name="OldSess">
                                <input type="hidden"   value="<?php  echo @$data[0]['SSC_brd_cd']; ?>"  name="OldBrd">
                                <button type="submit" onclick="return checks()" name="btnsubmitUpdateEnrol" class="btn btn-large btn-info offset2">
                                    Save Form
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
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




    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>Admission_11th_pvt';
            } else {
                // user clicked "cancel"

            }
        });
    }

     
    
</script>
