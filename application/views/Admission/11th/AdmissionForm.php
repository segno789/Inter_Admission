
<form  action="<?php //DebugBreak(); echo base_url(); ?>Admission_11th_pvt/NewEnrolment_insert" method="post" enctype="multipart/form-data" id='admfrmID'>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-5 col-md-5">
                <h4 class="bold">Personal Information</h4>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-3 col-md-5">
                <img src="<?php echo base_url(); ?>assets/img/upalodimage.jpg" class="img-responsive" alt="" >
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-5 col-md-5" id="output">
                <img id="previewImg" style="width:130px; height: 130px;" class="img-responsive" src="<?php echo base_url(); ?>assets/img/profile.png" alt="CandidateImage">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-5 col-md-3" id="progress-wrp">
                <div class="progress-bar"></div><div class="status">0%</div>
            </div>
            <div class="col-md-2">
                <input type="file" id="image" name="__files[]">
            </div>
        </div>
    </div>

    <?php
    @$brd_cd =  @$data[0]['SSC_brd_cd'];
    @$SSC_Year =  @$data[0]['SSC_Year'];
    ?>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="cand_name" >
                    Candidate Name:
                </label>        
                <input class="text-uppercase form-control"  type="text" id="cand_name" name="cand_name" placeholder="Candidate Name" maxlength="60" value="<?php echo @$data[0]['name'] ?>"  >
            </div>
            <div class="col-md-4">
                <label class="control-label" for="father_name">
                    Father's Name :
                </label>        
                <input class="text-uppercase form-control" id="father_name" name="father_name"  type="text" placeholder="Father's Name" maxlength="60"  value="<?php echo  @$data[0]['Fname']; ?>" > 
            </div>
        </div>
    </div>



    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="bay_form" >
                    Bay Form No:
                </label>        
                <input class="text-uppercase form-control" type="text" id="bay_form" name="bay_form"  placeholder="Bay Form No." value="<?php echo @$data[0]['BForm'];?>" required="required" >
            </div>
            <div class="col-md-4">
                <label class="control-label" for="father_cnic">
                    Father's CNIC:
                </label>        
                <input class="text-uppercase form-control" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1"  value="<?php  echo @$data[0]['FNIC'];?>" required="required" >
            </div>
        </div>
    </div>
    <!--<div class="control-group">
    <label class="control-label span1" >
    Bay Form No :
    </label>
    <div class="controls controls-row">
    <input class="span3" type="text" id="bay_form" name="bay_form"  placeholder="Bay Form No." value="<?php //echo  @$data['0']['bFormNo']; ?>" required="required" >
    <label class="control-label span2" for="father_cnic">
    Father's CNIC :
    </label> 
    <input class="span3" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1" value="<?php //echo  @$data['0']['FNIC']; ?>" <?php //if(@$data['0']['FNIC'] !='' && @$brd_cd == 1) echo "readonly='readonly'";  ?> required="required">
    </div>
    </div>   -->

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label " id="doblable" >
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

                <input class="text-uppercase form-control" type="text" id="dob" name="dob" placeholder="DOB" value="<?php echo @$date1;   ?>" readonly='readonly' required="required"  >
            </div>
            <div class="col-md-4">
                <label class="control-label" id="moblabel" >
                    Mobile Number :
                </label> 
                <input class="text-uppercase form-control" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789" value="<?php echo  @$data['0']['MobNo']; ?>" >
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="medium"> MEDIUM:</label>
                <select id="medium" class="form-control text-uppercase" name="medium">
                    <option value='0' selected='selected'>None</option>  
                    <option value='1'>Urdu</option>
                    <option value='2'>English</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="control-label" for="speciality">Speciality:</label> 
                <select id="speciality"  class="text-uppercase form-control" name="speciality">
                    <option value='0' selected='selected'>None</option>  
                    <option value='1'>Deaf and Dumb</option>
                    <option value='2'>Board Employee</option>
                    <option value='3'>Disable</option>
                </select>
            </div>
        </div>
    </div>
    <!--  <div class="control-group">
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
    </div>   -->
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="MarkOfIden">Mark of Identification :</label>
                <input class="text-uppercase form-control" type="text" id="MarkOfIden"  name="MarkOfIden" value="<?php echo  @$data[0]['markOfIden']; ?>" required="required" maxlength="60" >
            </div>
            <div class="col-md-4">
                <label class="control-label" for="nationality" >
                    Nationality :
                </label>        
                <select name="nationality" class="form-control text-uppercase" id="nationality"> 
                    <?php

                    //  DebugBreak();
                    $nat = @$data[0]['IsPakistani'];
                    $matric_sub1 = @$data[0]['sub1'];

                    if(@$brd_cd ==1 && @$SSC_Year != -1)
                    {
                        if($nat == 1 || $nat == 0)
                        {

                            echo " <option value='1' selected='selected' >Pakistani</option>";
                        }
                        else if ($nat == 2)
                        {
                            echo " <option value='2' selected='selected' >Non Pakistani</option>";
                        }
                        else
                        {
                            echo " <option value='0' selected='selected'>None</option>
                            <option value='1'  >Pakistani</option>
                            <option value='2'  >Non Pakistani</option>
                            ";
                        }
                    }
                    else
                    {
                        echo " <option value='0' selected='selected'>None</option>
                        <option value='1'  >Pakistani</option>
                        <option value='2'  >Non Pakistani</option>
                        ";
                    }

                    ?>
                </select>
              
            </div>
        </div>
    </div>
     <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="gender1">
                    Gender : 
                </label>        
                <select name="gender1" class="form-control text-uppercase" id="gender1">
                    <?php
                    //DebugBreak();
                    //$gender;

                    $gender = @$data[0]['Gender'];

                    if($gender == 1 )
                    {
                        echo "  <option value='1'  selected='selected' >MALE</option>  " ;
                    }
                    else if ($gender == 2)
                    {
                        echo " <option value='2' selected='selected'>FEMALE</option> " ;
                    }
                    else
                    {
                        echo " <option value='0' selected='selected'>None</option>
                        <option value='1'>MALE</option> 
                        <option value='2'>FEMALE</option> " ;
                    }

                    ?>

                </select>
            </div>
            <div class="col-md-4">
                <label class="control-label" for="hafiz" >
                    Hafiz-e-Quran :
                </label>        
                <select name="hafiz" class="form-control text-uppercase" id="hafiz">
                    <?php
                    if((@$data['0']['excep'] != ""))
                    {
                        if(@$data['0']['IsHafiz']==1 || @$data['0']['IsHafiz']==0)
                        {
                            echo "  <option value='1' selected='selected'>NO</option> ";
                        }
                        else if(@$data['0']['IsHafiz']==2)
                        {
                            echo "  <option value='2'>YES</option> "; 
                        }
                        else if($isReAdm == 0)
                        {
                            echo "  <option value='2'>YES</option> ";
                        }
                        else
                        {
                            echo " <option value='1' selected='selected'>NO</option>";
                        }     
                    }
                    else
                    {
                        echo " <option value='1' selected='selected'>NO</option> 
                        <option value='2'>YES</option>";
                    }
                    ?>


                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="religion">
                    Religion : 
                </label>        
                <select name="religion" class="form-control text-uppercase" id="religion"> 
                    <?php
                    $rel = @$data[0]['IsMuslim'];
                    //if((@$data['0']['excep'] != "success"))
                    //  {
                    if($brd_cd == 1)
                    {
                    if($rel == 1 || $rel == 0)
                    {
                        echo " 
                        <option value='1' selected = 'selected'>MUSLIM</option>" ;
                    }
                    else if ($rel == 2)
                    {
                        echo "  <option value='2' selected = 'selected'>NON MUSLIM</option> ";
                    }
                    }
                    else
                    {
                        echo "  <option value='0' selected = 'selected'>NONE</option>
                        <option value='1' >MUSLIM</option>
                        <option value='2' >NON MUSLIM</option>
                        " ;
                    }

                    ?>



                </select>
            </div>
            <div class="col-md-4">
                <label class="control-label" for="UrbanRural" >
                    Locality :
                </label>        
                <select name="UrbanRural" class="form-control text-uppercase" id="UrbanRural">
                    <?php
                    //DebugBreak();
                    // $isrural;
                    $resid = @$data[0]['isRural'];
                    if($brd_cd == 1)
                    {
                        if($resid == 1 ||  $resid == 0)
                        {
                            echo " <option value='1' selected='selected'>URBAN</option> ";
                        }
                        else if($resid == 2)
                        {
                            echo "<option value='2' selected='selected'>RURAL</option>";
                        }    
                    }
                    else
                    {
                        echo "  <option value='0' selected='selected'>None</option>  <option value='1'>URBAN</option> 
                        <option value='2'>RURAL</option>";
                    }


                    ?>
                </select>
            </div>
        </div>
    </div>

    <input type="hidden" name="gender" value="<?php echo $gender; ?>">
    <input type="hidden" name="nationality_hidden" id="nationality_hidden" value="<?php echo $nat; ?>">
    <input type="hidden" name="matric_sub1" id="matric_sub1" value="<?php  echo $matric_sub1; ?>">

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <label class="control-label" for="address" >
                    Address :
                </label>        
                <textarea  id="address" class="text-uppercase form-control" rows="4" name="address" required="required">
                    <?php 
                    echo @$data[0]['addr'];
                    ?>
                </textarea>       
            </div>
        </div>
    </div>
    <hr class="colorgraph">




    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-5 col-md-5">
                <h4 class="bold">Old Examination Information</h4>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4"><label class="control-label">Roll No :</label>
                <input class="text-uppercase form-control" type="text" id="old_rno_ssc" name="old_rno_ssc" readonly="readonly" value="<?php  echo  @$data[0]['SSC_RNo']; ?>" <?php if($isReAdm==0) {echo "readonly='readonly'";  } ?> required="required" >
            </div>
            <div class="col-md-4">
                <label class="control-label">Year:</label> 
                <input type="text" class="text-uppercase form-control" name="old_ssc_year" id = "old_ssc_year" readonly="readonly" value="<?php if (@$data[0]['SSC_Year'] == -1) echo  'Before 2000' ; else echo   @$data[0]['SSC_Year']; ?>"/> 
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4"><label class="control-label">Session:</label>
                <input type="text" class="text-uppercase form-control" id="old_ssc_session" name="old_ssc_session" readonly="readonly" value="<?php if(@$data[0]['SSC_Sess']== 1){echo 'ANNUAL';}else{echo 'SUPPLYMENTARY';} ?>"/> 
            </div>
            <div class="col-md-4">
                <label class="control-label">Board:</label> 
                <?php
                $brdArray = array(
                    'BISE, GUJRANWALA' => 1,
                    'BISE,  LAHORE' => 2,
                    'BISE,  RAWALPINDI' => 3,
                    'BISE,  MULTAN' => 4,
                    'BISE,  FAISALABAD' => 5,
                    'BISE, BAHAWALPUR' => 6,
                    'BISE, SARGODHA' => 7,
                    'BISE, DERA GHAZI KHAN' => 8,
                    'FBISE, ISLAMABAD' => 9,
                    'BISE, MIRPUR' => 10,
                    'BISE, ABBOTTABAD' => 11,
                    'BISE, PESHAWAR' => 12,
                    'BSE, KARACHI' => 13,
                    'BISE, QUETTA' => 14,
                    'BISE, MARDAN' => 15,
                    'CAMBRIDGE' => 17,
                    'AIOU, ISLAMABAD' => 18,
                    'BISE, KOHAT' =>19 ,
                    'KARAKURUM' => 20,
                    'MALAKAND' => 21,
                    'BISE, BANNU' =>22 ,
                    'BISE, D.I.KHAN' =>23 ,
                    'AKUEB, KARACHI' =>24 ,
                    'BISE, HYDERABAD' => 25,
                    'BISE, LARKANA' =>26 ,
                    'BISE, MIRPUR(SINDH)' => 27,
                    'BISE, SUKKUR' => 28,
                    'BISE, SWAT' => 29,
                    'SBTE KARACHI' => 30,
                    'PBTE, LAHORE' => 31,
                    'AFBHE RAWALPINDI' =>32 ,
                    'BIE, KARACHI' => 33,
                    'BISE SAHIWAL' => 34

                );
                ?>
                <input type="text" class="text-uppercase form-control" id="old_brd_cd_ssc" name="old_brd_cd_ssc" readonly="readonly" value="<?php echo array_search( @$data[0]['SSC_brd_cd'],$brdArray); ?>" />     
            </div>
        </div>
    </div>
    <hr class="colorgraph">

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-5 col-md-5">
                <h4 class="bold">Examination Proposed Center Information</h4>
            </div>
        </div>
    </div>
      <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="pvtinfo_dist" >
                    District :
                </label>        
                <select class='form-control text-uppercase' id='pvtinfo_dist' name='pvtinfo_dist' required='required'>
                    <option value='0'>SELECT DISTRICT</option>
                    <option value='1'>GUJRANWALA</option>
                    <option value='2'>GUJRAT</option>
                    <option value='3'>HAFIZABAD</option>
                    <option value='4'>MANDI BAHA-UD-DIN</option>
                    <option value='5'>NAROWAL</option>
                    <option value='6'>SIALKOT</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="control-label" for="pvtinfo_teh">
                    Tehsil :
                </label>        
                <select class='form-control  text-uppercase' id='pvtinfo_teh' name='pvtinfo_teh' required='required'>
                    <option value='0'>SELECT TEHSIL</option>
                </select>
            </div>
        </div>
    </div>
 <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <label class="control-label" for="pvtZone" >
                    Zone :
                </label>        
                <select id="pvtZone" class="form-control text-uppercase" name="pvtZone">
                    <option value='0'>SELECT ZONE</option>
                </select>
            </div>
        </div>
    </div>
      <div id="instruction" style="display:none; width:700px" style="width: 750px;" class="pull-right" >
        <img src="<?php  echo base_url().'assets/img/Instruction11th.jpg'; ?>" class="img-responsive" alt="Instruction.jpg (152,412 bytes)">
    </div>

     <hr class="colorgraph">
     <div class="form-group">
        <div class="row">
            <div class="col-md-offset-5 col-md-5">
                <h4 class="bold">Group and Subject Information:</h4>
            </div>
        </div>
    </div>
   
    <div class="form-group">
       <div class="row">
        <div class="col-md-offset-2 col-md-8">
        <label class="control-label" for="std_group">
            Study Group :
        </label>
       
            <select id="std_group" class="form-control text-uppercase"  name="std_group">
                <?php

                //  DebugBreak();
                $grp = @$data[0]['RegGrp'];
                //$subgroups =  split(',',$grp_cdi);
                echo "<option value='0' >SELECT GROUP</option>";
                if($isReAdm == 0 )
                {
                    echo " 
                    <option value='3'>Humanities</option>
                    <option value='5'>Commerce</option>
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
    </div>
    
    <div class="form-group">
    <div class="row">
     <div class="col-md-offset-4 col-md-12">
        <label class="control-label "  >
            Choose Subjects(Elective Subjects are Enabled Only)   
        </label> 

    </div>
    </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
            <select id="sub1" class="text-uppercase form-control" name="sub1">
            </select> 
            </div>
             <div class="col-md-4">
            <select id="sub2"  name="sub2" class="text-uppercase form-control">
            </select>
            </div>
        </div>
    </div>
    <div class="form-group">
     <div class="row">
            <div class="col-md-offset-2 col-md-4">
            <select id="sub3" class="text-uppercase form-control" name="sub3">
            </select> 
            </div>
             <div class="col-md-4">
            <select id="sub4"  name="sub4" class="text-uppercase form-control">
            </select>
             </div>
        </div>
    </div>    
    <div class="form-group">
             <div class="row">
            <div class="col-md-offset-2 col-md-4">
            <select id="sub5" class="text-uppercase form-control" name="sub5" >

            </select> 
            </div>
             <div class="col-md-4">
            <select id="sub6"  name="sub6" class="text-uppercase form-control" >

            </select>
            </div>
        </div>
    </div> 
       
    <div class="form-group">
         <div class="row">
            <div class="col-md-offset-2 col-md-8">
            <select id="sub7" class="text-uppercase form-control" name="sub7"  style="display: none;">

            </select> 
            <!--     <select id="sub8"  name="sub8" class="span3 dropdown">-->
            <!-- <option value="<?php  if($isReAdm != 1) { echo @$data[0]['sub8'];} else{echo "";}    ?>" selected="selected"><?php  if($isReAdm != 1) {
                // DebugBreak();
                echo array_search(@$data[0]['sub8'],$subarray);}  else {echo "";};
            ?></option>-->
            
            
        </div>
        </div>
        </div>
        <div class="hidden">
            <input type="hidden"   value=""  name="formNo">
            <input type="hidden"   value="<?php  echo $isReAdm; ?>"  name="IsReAdm">
            <input type="hidden"   value="<?php  echo @$data[0]['SSC_RNo']; ?>"  name="OldRno">
            <input type="hidden"   value="<?php  echo @$data[0]['SSC_Year']; ?>"  name="OldYear">
            <input type="hidden"   value="<?php  echo @$data[0]['SSC_Sess']; ?>"  name="OldSess">
            <input type="hidden"   value="<?php  echo @$data[0]['SSC_brd_cd']; ?>"  name="OldBrd">
            </div>
             <div class="form-group">
             <div class="row">
            <div class="col-md-offset-2 col-md-8">
            <label class="checkbox-inline">
                    <input type="checkbox" class="checkboxtext" id="terms" name="terms" value="0">I agree with the <a href="<?php echo base_url(); ?>assets/img/Instructions.jpg" target="_blank">Terms and Conditions </a> of Board of Intermediate & Secondary Education, Gujranwala  
                </label>
            </div>
        </div>
    </div>
      <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-3">
            <button type="submit" onclick="return checks()" name="btnsubmitUpdateEnrol" class="btn btn-primary btn-block">
                Save Form
            </button>
            </div>
            <div class="col-md-2">
             <a href="<?php echo base_url(); ?>assets/img/Instruction.jpg" download="FileName" class="btn btn-info btn-block" >Download Instruction</a>
            </div>
            <div class="col-md-3">
            <input type="button" class="btn btn-danger btn-block" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
           
        </div>
    </div>
    </div>

</form>


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
