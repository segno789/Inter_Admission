 <style type="text/css">
   
.corr_check_box{
        width: 20px;    height: 20px;
}

    </style>
<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header" id="lblFormNo">
                        <div class="title">
                         Form No.   <?php
                                       echo $data[0]['FormNo'];  
                                     ?>
                        </div>

                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" id="corr_form" action="<?php  echo base_url(); ?>EleventhCorrection/NewEnrolment_update" method="post" enctype="multipart/form-data">

                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                 </br>
                            <img src="../../assets/img/OnlineCorrectoin.jpg" alt="" style="width: 530px;">
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                   
                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="<?php  echo '../../'.IMAGE_PATH11.$Inst_Id.'/'.$data[0]['PicPath']; ?>" alt="Candidate Image">
                                   
                                    <img id="corr_previewImg" name="corr_previewImg" style="width:80px; height: 80px; margin-right: 322px;    float: right; display: none;" class="span2" src="<?php echo base_url() ?>assets/img/profile.png" alt="Candidate Image">
                                </div>
                            </div>

                            <div class="control-group">

                                <label id="ErrMsg" class="control-label span2" style=" text-align: left;"><?php ?></label>
                                <div class="controls controls-row">
                                   
                                    <label class="control-label span3">
                                      Current Image :  
                                    </label> 
                                   
                                  <!--  <input type="file" class="span2" id="image" name="image" onchange="Checkfiles()">-->
                                     <label class="control-label span2" style="width: 411px;" >
                                        <img src="<?=base_url()?>assets/img/upalodimage.jpg" alt="" >
                                    </label> 
                                    <label class="control-label span2">
                                         Correction Image :  <input type="checkbox" class="corr_check_box " style="width: 20px;    height: 20px;" id="c7" name="c[]" value="7">
                                    </label> 
                                    <input type="file" class="span2" id="corr_image" style="display: none;" name="corr_image"  style="">
                                </div>
                            </div>
                            <div id="div_confirmation">
                           
                            </div>
                            
                            
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" readonly="readonly"  type="text" id="cand_name" style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" maxlength="60"  value="<?php  echo  $data['0']['name']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?>  >
                                      <?php
                                     // DebugBreak();
                                          if($data['0']['Brd_cd']!=1)
                                          {
                                          
                                          
                                      ?>
                                    <label class="control-label span2" for="lblfather_name" >
                                        Correction  Candidate Name :  <input type="checkbox" class="corr_check_box" style="width: 20px;    height: 20px;" id="c0" name="c[]" value="1">
                                    </label> 
                                    <input class="span3" id="corr_cand_name" name="corr_cand_name" style="text-transform: uppercase; display:none;" type="text" placeholder="Candidate Name" maxlength="60" >
                                    <?php
                                          }
                                    ?>
                                </div>

                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Father's Name :<!-- MEDIUM:-->
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" readonly="readonly" id="father_name" name="father_name" style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" value="<?php echo  $data['0']['Fname']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?> required="required">
                                    <!-- <select id="medium" class="dropdown span3" name="medium">
                                    <?php // DebugBreak();
                                    // $med = $data['0']['med'] ;
                                    // $med = 2; 
                                    //    if($med == 1)
                                    //   {
                                    //       echo  "<option value='1' selected='selected'>Urdu</option> <option value='2'>English</option>";
                                    //    }
                                    //    else
                                    //    {
                                    //        echo  "<option value='1' >Urdu</option> <option value='2' selected='selected'>English</option>";
                                    //    }
                                    ?>

                                    </select>-->
                                    <?php
                                 
                                          if($data['0']['Brd_cd']!=1)
                                          {
                                          
                                          
                                      ?>
                                  <label class="control-label span2" >
                                        Correction  Father's Name :  <input type="checkbox" class="corr_check_box" id="c1" name="c[]" value="2" style="width: 20px;    height: 20px;"> 
                                    </label> 
                                    <input class="span3" id="corr_father_name" type="text"  style="text-transform: uppercase; display:none;" name="corr_father_name" placeholder="Father's Name"  maxlength="60">
                                      <?php
                                          }
                                    ?>
                                    
                                </div>
                            </div>
                            <?php if(isset($data['0']['Intr_Brd']) && (@$data['0']['Intr_Brd'] != 1) )
                            {
                              ?>
                            <div class="control-group">
                            <label class="control-label span1" >
                                    Date of Birth:(dd-mm-yyyy)
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3" type="text"  name="dob" placeholder="DOB" value="<?php $source = $data['0']['Dob']; $date = new DateTime($source); echo $date->format('d-m-Y'); ?>" required="required" readonly="readonly"  <?php if($isReAdm==1) echo "readonly='readonly'"; ?> >

                                    <label class="control-label span2" >
                                        Correction Date of Birth : <input type="checkbox" class="corr_check_box" id="c2" name="c[]" value="3" style="width: 20px;    height: 20px;"> 
                                    </label> 
                                    <input class="span3" id="corr_dob" name="corr_dob" readonly="readonly" style="display: none;"  type="text" placeholder="dd-mm-yyyy">
                                </div>
                            </div>

                             <?php } ?>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input type="hidden" name="oldbform" value="<?php echo   $data['0']['BForm']; ?>">
                                    <input type="hidden" name="oldfform" value="<?php echo  $data['0']['FNIC']; ?>">
                                    <input class="span3" readonly="readonly" type="text" id="bay_form" name="bay_form" placeholder="Bay Form No." value="<?php echo  $data['0']['BForm']; ?>" required="required" <?php if($isReAdm==1) echo "readonly='readonly'";  ?>>
                                    <label class="control-label span2" for="father_cnic">
                                        Correction  Bay Form No  : <input type="checkbox" class="corr_check_box" id="c3" name="c[]" value="4" style="width: 20px;    height: 20px;">
                                    </label> 
                                    <input class="span3" id="corr_bay_form" name="corr_bay_form" style="display: none;"  type="text" placeholder="34101-1111111-1" value="" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Father's CNIC :<!-- Mark Of Identification :-->
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" readonly="readonly" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1" value="<?php echo  $data['0']['FNIC']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?> required="required">
                                    <!-- <input class="span3" type="text" id="MarkOfIden" style="text-transform: uppercase;" name="MarkOfIden" value="<?php //echo  $data['0']['markOfIden']; ?>" required="required" maxlength="60" >-->
                                    <label class="control-label span2" >
                                        Correction  Father's CNIC : <input type="checkbox" class="corr_check_box" id="c4" name="c[]" value="5" style="width: 20px;    height: 20px;">
                                    </label> 
                                    <input class="span3" id="corr_father_cnic" type="text"  style="text-transform: uppercase; display:none;" name="corr_father_cnic" placeholder="34101-1111111-1"  >
                                </div>
                            </div>  

                                <label class="control-label span3" style='display:none;' >
                                        Religion :
                                    </label> 
                                    <?php
                                        $rel = $data[0]['rel'];
                                        if($rel == 1)
                                        {
                                           echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion' style='display:none;'>
                                    </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' name='religion' style='display:none;'></label>" ;
                                        }
                                        else if ($rel == 2)
                                        {
                                             echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1'  name='religion' style='display:none;'>
                                    </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' checked='checked' name='religion' style='display:none;'> </label>" ;
                                        }
                                    ?>
                                     <?php
                                    $nat = $data[0]['nat'];
                                    if($nat == 1)
                                    {
                                       echo  " <label class='radio inline span1'><input type='radio' value='1' id='nationality' checked='checked' name='nationality' style='display:none;'> 
                                    </label><label class='radio inline span2'><input type='radio'  id='nationality1' value='2' name='nationality' style='display:none;'> </label>" ;
                                    }
                                    else if ($nat == 2)
                                    {
                                         echo  "<label class='radio inline span1'><input type='radio' value='1' id='nationality'  name='nationality' style='display:none;'> 
                                    </label><label class='radio inline span2'><input type='radio'  id='nationality1' checked='checked' value='2' name='nationality' style='display:none;'>  </label>" ;
                                    }
                                ?>


                            <hr>
                            <div class="control-group">
                                <h4 class="span4">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span5">
                                        Correction Study Group: <input type="checkbox" class="corr_check_box" id="c5" name="c[]" value="6" style="width: 20px;    height: 20px;">
                                    </label> 

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Study Group :
                                </label>
                                <div class="controls controls-row">
                                    <select id="std_group" class="dropdown span6"  name="std_group" disabled="disabled" >
                                        <?php
                                        // DebugBreak();
                                    //    $grp_cdi = '1,2,3,4,5';
                                        $grp = $data[0]['grp_cd'];
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
                                                    if (($grp == 1) )
                                                    {
                                                        echo "<option value='1' selected='selected' >Pre-Medical</option>";  
                                                    }
                                                    else
                                                    {
                                                    echo "<option value='1' >Pre-Medical</option>";        
                                                    }

                                                    

                                                }
                                                else if($subgroups[$i] == 2)
                                                {
                                                    if (($grp == 2))
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

                                                     if (($grp == 3) )
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
                                                    if (($grp == 4))
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
                                                    if (($grp == 5))
                                                    {
                                                        echo "<option value='5'  selected='selected'>Commerce</option>";   
                                                    }
                                                    else
                                                    {
                                                     echo "<option value='5'>Commerce</option>";          
                                                    }

                                                   


                                                }
                                                else if($subgroups[$i] == 6)
                                                {
                                                     if (($grp == 6 ))
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
                                        $result =  array_search($data[0]['sub4'],$subarray);



                                        ?>

                                    </select>                                            
   <select id="corr_std_group" class="dropdown span6"  name="corr_std_group" style="display: none;">
                                        <?php
                                      //   DebugBreak();
                                        $grp = $data[0]['grp_cd'];
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
                                                    if (($grp == 1) )
                                                    {
                                                        echo "<option value='1' selected='selected' >Pre-Medical</option>";  
                                                    }
                                                    else
                                                    {
                                                    echo "<option value='1' >Pre-Medical</option>";        
                                                    }

                                                    

                                                }
                                                else if($subgroups[$i] == 2)
                                                {
                                                    if (($grp == 2))
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

                                                     if (($grp == 3) )
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
                                                    if (($grp == 4))
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
                                                    if (($grp == 5))
                                                    {
                                                        echo "<option value='5'  selected='selected'>Commerce</option>";   
                                                    }
                                                    else
                                                    {
                                                     echo "<option value='5'>Commerce</option>";          
                                                    }

                                                   


                                                }
                                                else if($subgroups[$i] == 6)
                                                {
                                                     if (($grp == 6 ))
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
                                       
                                      //  $result =  array_search($data[0]['sub4'],$subarray);



                                        ?>

                                    </select> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span6" style="font-weight: bold;     text-align: center;" >
                                    Choose Subjects(Elective Subjects are Enabled Only)   
                                </label> 
<label class="control-label span6" id="corr_lbl_choose_sub" style="font-weight: bold;     text-align: center; display:none;" >
                                    Choose Subjects(Elective Subjects are Enabled Only)   
                                </label> 
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub1" class="span3 dropdown" name="sub1" disabled="disabled">
                                        <option value="<?php  echo $data[0]['sub1'] ?>" ><?php echo array_search($data[0]['sub1'],$subarray); ?></option>
                                    </select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown" disabled="disabled">
                                        <option value="<?php echo $data[0]['sub2'] ?>"><?php echo array_search($data[0]['sub2'],$subarray);?></option>
                                    </select>
                                    
                                    <select id="corr_sub1" class="span3 dropdown" name="corr_sub1" style="display: none;">
                                        <option value="<?php echo $data[0]['sub1'] ?>" ><?php echo array_search($data[0]['sub1'],$subarray); ?></option>
                                    </select> 
                                    <select id="corr_sub2"  name="corr_sub2" class="span3 dropdown" style="display: none;">
                                        <option value="<?php echo $data[0]['sub2'] ?>"><?php echo array_search($data[0]['sub2'],$subarray);?></option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub3" class="span3 dropdown" name="sub3" disabled="disabled">

                                        <option value="<?php echo $data[0]['sub3'] ?>" selected='selected'><?php
                                            echo array_search($data[0]['sub3'],$subarray);
                                        ?></option>
                                        
                                        </select> 
                                    <select id="sub4"  name="sub4" class="span3 dropdown" disabled="disabled">
                                        <option value="<?php if($isReAdm != 1) { echo $data[0]['sub4'];} else echo'4'; ?>" selected="selected"><?php
                                            if($isReAdm != 1) {echo array_search($data[0]['sub4'],$subarray);} else echo"Pakistan Studies";      
                                        ?></option></select>
                                        
                                        <select id="corr_sub3" class="span3 dropdown" name="corr_sub3" style="display: none;">

                                        <option value="<?php echo $data[0]['sub3'] ?>" selected='selected'><?php
                                            echo array_search($data[0]['sub3'],$subarray);
                                        ?></option>
                                        
                                        </select> 
                                    <select id="corr_sub4"  name="corr_sub4" class="span3 dropdown" style="display: none;">
                                        <option value="<?php if($isReAdm != 1) { echo $data[0]['sub4'];} else echo'4'; ?>" selected="selected"><?php
                                            if($isReAdm != 1) {echo array_search($data[0]['sub4'],$subarray);} else echo"Pakistan Studies";      
                                        ?></option></select>
                                </div>
                            </div>    
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub5" class="span3 dropdown" name="sub5" selected="selected" disabled="disabled">
                                        <?php  if($isReAdm != 1)
                                            { echo "";} ?>
                                        <option value="<?php if($isReAdm != 1) {echo $data[0]['sub5'];} else{ echo "";} ?>"><?php  if($isReAdm != 1) {echo array_search($data[0]['sub5'],$subarray);} else {echo "";}

                                        ?></option>
                                    </select> 
                                    <select id="sub6"  name="sub6" class="span3 dropdown" selected="selected" disabled="disabled">
                                        <option value="<?php  if($isReAdm != 1) {echo $data[0]['sub6'];} else{echo "";}  ?>"><?php  if($isReAdm != 1) {
                                            echo array_search($data[0]['sub6'],$subarray);} else {echo "";};
                                        ?></option>
                                    </select>
                                    
                                     <select id="corr_sub5" class="span3 dropdown" name="corr_sub5" selected="selected" style="display: none;">
                                        <?php  if($isReAdm != 1)
                                            { echo "";} ?>
                                        <option value="<?php if($isReAdm != 1) {echo $data[0]['sub5'];} else{ echo "";} ?>"><?php  if($isReAdm != 1) {echo array_search($data[0]['sub5'],$subarray);} else {echo "";}

                                        ?></option>
                                    </select> 
                                    <select id="corr_sub6"  name="corr_sub6" class="span3 dropdown" selected="selected" style="display: none;">
                                        <option value="<?php  if($isReAdm != 1) {echo $data[0]['sub6'];} else{echo "";}  ?>"><?php  if($isReAdm != 1) {
                                            echo array_search($data[0]['sub6'],$subarray);} else {echo "";};
                                        ?></option>
                                    </select>
                                </div>
                            </div>   
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub7" class="span3 dropdown" name="sub7" selected="selected" disabled="disabled">
                                        <option value="<?php  if($isReAdm != 1) {if(!isset($data[0]['sub7'])){echo "0";} }  else{echo "0";}   ?>"><?php if($isReAdm != 1) {
                                             //DebugBreak();
                                          if(!isset($data[0]['sub7'])){echo "NONE";} else{ echo array_search($data[0]['sub7'],$subarray);}};
                                        ?></option>
                                    </select> 
                                    <div class="span3"></div>
                                   <!-- <select id="sub8"  name="sub8" class="span3 dropdown" disabled="disabled">
                                        <option value="<?php // if($isReAdm != 1) { echo $data[0]['sub8'];} else{echo "";}    ?>" selected="selected"><?php  //if($isReAdm != 1) {
                                            // DebugBreak();
                                           // echo array_search($data[0]['sub8'],$subarray);}  else {echo "";};
                                        ?></option>
                                    </select>   -->
                                     <select id="corr_sub7" class="span3 dropdown" name="corr_sub7" selected="selected" style="display: none;">
                                        <option value="<?php  if($isReAdm != 1) {if(!isset($data[0]['sub7'])){echo "0";} }  else{echo "0";}   ?>"><?php if($isReAdm != 1) {
                                            // DebugBreak();
                                            if(!isset($data[0]['sub7'])){echo "NONE";} else{ echo array_search($data[0]['sub7'],$subarray);}};
                                        ?></option>
                                    </select> 
                                   <!-- <select id="corr_sub8"  name="corr_sub8" class="span3 dropdown" style="display: none;">
                                        <option value="<?php // if($isReAdm != 1) { echo $data[0]['sub8'];} else{echo "";}    ?>" selected="selected"><?php  //if($isReAdm != 1) {
                                            // DebugBreak();
                                           // echo array_search($data[0]['sub8'],$subarray);}  else {echo "";};
                                        ?></option>
                                    </select>  -->
                                </div>
                            </div>

                            <div class="form-actions no-margin">
                                <input type="hidden"   value="<?php  echo $data[0]['FormNo']; ?>"  name="formNo">
                                <input type="hidden"   value="<?php  echo $isReAdm; ?>"  name="IsReAdm">
                                <input type="hidden"   value="<?php  echo $Oldrno; ?>"  name="OldRno">
                                <input type="hidden"   value="<?php  echo $data[0]['nat']; ?>" id="hid_nat" name="hid_nat">
                                <input type="hidden"   value="<?php  echo $data[0]['sex']; ?>" id="hid_sex"  name="hid_sex">
                                <input type="hidden"   value="<?php  echo $data[0]['rel']; ?>" id="hid_rel" name="hid_rel">
                                <button type="button" id="btnsubmitUpdateEnrol" name="btnsubmitUpdateEnrol" class="btn btn-large btn-info offset2" >
                                    Apply for Correction
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
                                <div class="clearfix">
                                </div>
                            </div>

<!--                            onclick="return checks()"-->

                        </form>
                        <script type="text/javascript">



   document.getElementById("corr_image").onchange = function () {
    debugger;
    var reader = new FileReader();
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     if (extn == "jpg" || extn == "jpeg") {
    reader.onload = function (e) {
        
        // get loaded data and render thumbnail.
        document.getElementById("corr_previewImg").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
     }
     else{
         alert("Please upload only Jpeg files");
     }
};

                            function checks(){
                                debugger;
                                var msg = "Are You Sure You want to Cancel this Form ?"
                                alertify.confirm(msg, function (e) {
                                    if (e) {
                                          return true;
                                        // user clicked "ok"
                                       // window.location.href ='<?php echo base_url(); ?>index.php/Registration/EditForms';
                                    } else {
                                        return false; 
                                        // user clicked "cancel"

                                    }
                                });
                               /* var status  =  //check_NewEnrol_validation();
                                if(status == 0)
                                {

                                    return false;    
                                }
                                else
                                {

                                    return true;
                                } */


                            }
                            function CancelAlert()
                            {
                                var msg = "Are You Sure You want to Cancel this Form ?"
                                alertify.confirm(msg, function (e) {
                                    if (e) {
                                        // user clicked "ok"
                                        window.location.href ='<?php echo base_url(); ?>index.php/NinthCorrection/EditForms';
                                    } else {
                                        // user clicked "cancel"

                                    }
                                });
                            }
                            
                        </script>

                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
