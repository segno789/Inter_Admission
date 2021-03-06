<!--<h1 align="center">
<?php 
$sess = '';
if(Session == '1')
    $sess =  'Annual';
else if(Session == '2')
    $sess = 'Supplementary';
    echo  '<p style="text-align:center;">Online Admission for HSSC Part-II '.$sess.''.',  ' .Year.' </p>';   
?></h1>-->

<form method="post" enctype="multipart/form-data" name="myform" id="myform">
    <?php
    if(@$data[0]['picpath'] == ''){
        ?>
        <div class="form-group">    
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/img/upalodimage.jpg" alt="" >
        </div>
        <?php 
    }
    if($data[0]['picpath'] != '')  
    {
        $type = pathinfo(@$data[0]['picpath'], PATHINFO_EXTENSION); 
        @$image_path_selected = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents(@$data[0]['picpath']));

        ?>
        <div class="form-group">
            <div class="row">
                <div class="col-md-offset-5 col-md-5">
                    <img class="img-rounded" id="image_upload_preview" name="image_upload_preview" style="width:130px; height: 130px;" src="<?php echo $image_path_selected ?>" alt="CandidateImage"/>
                    <input type="hidden" class="hidden" id="pic" name="pic" value="<?php echo @$data['0']['picpath']; ?>" />    
                </div>
            </div>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="form-group">
            <div class="row">
                <div class="col-md-offset-5 col-md-5">
                    <img id="previewImg" style="width:130px; height: 130px; " class="img-rounded" src="<?php echo base_url(); ?>assets/img/profile.png" alt="Candidate Image">
                    <input type="hidden" class="hidden" id="picname" name="picname" value="">
                </div>      
            </div>     
        </div>
        <?php 
    }
    ?>
    <?php  if(@$data[0]['picpath'] == '')  
    {?>
        <div class="form-group">
            <div class="row">
                <div class="col-md-offset-5 col-md-5">
                    <div id="progress-wrp"><div class="progress-bar"></div ><div class="status">0%</div></div>
                    <label class="control-label">
                        Image :
                    </label> 
                    <input type="file" class="form-control" id="image" name="__files[]">
                </div>
            </div>
        </div>
        <?php 
    }
    ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-5 col-md-5">
                <h4 class="bold">Personal Information</h4>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="cand_name" >
                    Candidate Name:
                </label>        
                <input class="text-uppercase form-control" type="text" id="cand_name" name="cand_name" placeholder="Candidate Name" maxlength="60" readonly="readonly"  value="<?php echo $data[0]['name']; ?>">
            </div>

            <div class="col-md-4">
                <label class="control-label" for="father_name">
                    Father's Name :
                </label>        
                <input class="text-uppercase form-control" id="father_name" name="father_name" type="text" placeholder="Father's Name" maxlength="60" readonly="readonly" value="<?php echo  $data['0']['Fname']; ?>" required="required">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="bay_form" >
                    Bay Form No :
                </label>        
                <?php
                $bform = $data['0']['BForm'];

                if($bform == ""){
                    echo '<input class="form-control" type="text" id="bay_form" name="bay_form"  placeholder="34101-1111111-1" value=""  required="required" >';
                }
                else{
                    echo'<input class="form-control" type="text" id="bay_form" name="bay_form"  placeholder="34101-1111111-1" value='.@$data[0][BForm].' required="required" >';
                }
                ?>
            </div>

            <div class="col-md-4">
                <label class="control-label" for="father_cnic">
                    Father's CNIC :
                </label>        
                <?php
                $fnic = $data['0']['FNIC'];
                if($fnic== "" || $fnic== '00000-0000000-0' || $fnic== '11111-1111111-1' || $fnic== '22222-2222222-2' || 
                    $fnic== '33333-3333333-3' || $fnic== '44444-4444444-4' || $fnic== '55555-5555555-5' || $fnic== '66666-6666666-6' || $fnic== '77777-7777777-7' || $fnic== '88888-8888888-8' || $fnic== '99999-9999999-9'){
                    echo'<input class="form-control" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1"  value=""  required="required">';        
                }
                else{
                    echo'<input class="form-control" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1"  value='.@$data[0][FNIC].' readonly="readonly"  required="required">';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="medium" >
                    MEDIUM:
                </label>        
                <select id="medium" class="form-control text-uppercase" name="medium">
                    <?php 
                    $med = $data['0']['Medium'] ;
                    if($med == 1)
                    {
                        echo  
                        "<option value='1' selected='selected'>Urdu</option>
                        <option value='2'>English</option>";
                    }
                    else
                    {
                        echo  
                        "<option value='1' >Urdu</option> 
                        <option value='2' selected='selected'>English</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="control-label" for="speciality">
                    Speciality:
                </label>        
                <select id="speciality"  class="form-control  text-uppercase" name="speciality">
                    <option value='0' selected='selected'>None</option> 
                    <option value='1'>Deaf & Dumb</option>
                    <option value='2'>Board Employee</option>;
                    <option value='3'>Disable</option>";
                </select>
            </div>
        </div>
    </div>

    <div class="hidden" id="boardEmployeeDiv">
        <div class="form-group">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <label class="control-label" for="empBrdCd" >
                        Enter Board Employee Code:
                    </label>        
                    <input class="text-uppercase form-control" type="text" id="empBrdCd" name="empBrdCd" placeholder="Board Employee Code" maxlength="4" value="">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="MarkOfIden" >
                    Mark Of Identification :
                </label>        
                <input class="form-control text-uppercase" type="text" id="MarkOfIden" name="MarkOfIden" value="<?php echo @$data['0']['markOfIden']; ?>" required="required" maxlength="60" >
            </div>

            <div class="col-md-4">
                <label class="control-label" for="mob_number">
                    Mobile Number :
                </label>        
                <input class="form-control" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789" value="" required="required">
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="nationality" >
                    Nationality :
                </label>        
                <select name="nationality" class="form-control text-uppercase" id="nationality"> 
                    <?php
                    $nat = $data[0]['nat'];
                    if($nat == 1)
                    {
                        echo  
                        "<option value='1' selected='selected'>Pakistani</option>
                        <option value='2'>Non Pakistani</option>";
                    }
                    else if ($nat == 2)
                    {
                        echo  
                        "<option value='1'>Pakistani</option> 
                        <option value='2' selected='selected'>Non Pakistani</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="control-label" for="gender">
                    Gender :
                </label>     
                <select name="gender" class="form-control text-uppercase" id="gender" disabled="disabled"> 
                    <?php
                    @$gender = $data[0]['sex'];
                    if($gender == 1)
                    {
                        echo"<option value='1' selected='selected'>MALE</option> 
                        <option value='2'>FEMALE</option>";
                    }
                    else if ($gender == 2)
                    {
                        echo"<option value='1'>MALE</option> 
                        <option value='2' selected='selected'>FEMALE</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="hafiz" >
                    Hafiz-e-Quran :
                </label>        
                <select name="hafiz" class="form-control text-uppercase" id="hafiz"> 
                    <option value='1'>NO</option> 
                    <option value='2'>YES</option> 
                </select>
            </div>

            <div class="col-md-4">
                <label class="control-label" for="religion">
                    Religion : 
                </label>        
                <select name="religion" class="form-control text-uppercase" id="religion"> 
                    <?php
                    $rel = $data[0]['rel'];
                    if($rel == 1)
                    {
                        echo"<option value='1' selected='selected'>MUSLIM</option> 
                        <option value='2'>NON MUSLIM</option>";
                    }
                    else if ($rel == 2)
                    {
                        echo"<option value='1'>MUSLIM</option> 
                        <option value='2' selected='selected'>NON MUSLIM</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <label class="control-label" for="UrbanRural" >
                    Locality : 
                </label>        
                <select name="UrbanRural" class="form-control text-uppercase" id="UrbanRural"> 
                    <?php
                    $resid = $data[0]['ruralOrurban'];
                    if($resid == 1 )
                    {
                        echo"<option value='1' selected='selected'>URBAN</option> 
                        <option value='2'>RURAL</option>";
                    }
                    else if($resid == 2)
                    {
                        echo"<option value='1'>URBAN</option> 
                        <option value='2' selected='selected'>RURAL</option>";
                    }
                    else
                    {
                        echo"<option value='1' selected='selected'>URBAN</option> 
                        <option value='2'>RURAL</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <label class="control-label" for="address" >
                    Address :
                </label>        
                <textarea  id="address" class="text-uppercase form-control" rows="4" name="address" required="required">
                    <?php echo $data[0]['addr'];  ?>
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
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="oldrno" >
                    Roll No :
                </label>        
                <input class="text-uppercase form-control" type="text" readonly="readonly" id="oldrno" name="oldrno" value="<?php  echo  $data['0']['rno']; ?>" >
            </div>

            <div class="col-md-4">
                <label class="control-label" for="oldyear">
                    Year :
                </label>        
                <input type="text" class="text-uppercase form-control" name="oldyear" id = "oldyear" readonly="readonly" value="<?php  echo $data['0']['Iyear']; ?>"/> 
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="oldsess" >
                    Session :
                </label>        
                <input type="text" class="text-uppercase form-control" id="oldsess" name="oldsess" readonly="readonly" value="<?php echo $data['0']['sess'] == 1 ? "Annual" :"Supplementary"; ?>"/> 
            </div>

            <div class="col-md-4">
                <label class="control-label" for="oldboard">
                    Board :
                </label>        
                <input type="text" class="text-uppercase form-control"  id="oldboard" name="oldboard" readonly="readonly" value="<?php echo $data[0]['brd_name'];?>"/>     
                <input type="hidden" class="hidden" id="oldClass" name="oldClass"  value="<?php echo $data[0]['class'];?>"/>     
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
                <select id="pvtZone" class="form-control  text-uppercase" name="pvtZone">
                    <option value='0'>SELECT ZONE</option>
                </select>
            </div>
        </div>
    </div>
    <div class="pull-right"  id="instruction">
        <img src="<?php echo base_url(); ?>assets/img/Instruction.jpg" class="img-responsive" alt="instructions.jpg">
    </div>
    <hr class="colorgraph">
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-5 col-md-5">
                <h4 class="bold">Examination Information</h4>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <label class="control-label" for="pvtZone" >
                    Study Group :
                </label>        
                <select id="std_group" class="form-control  text-uppercase"  name="std_group">
                    <?php
                    $grp_cd = $data[0]['grp_cd'];
                    $chance = $data[0]['chance'];
                    $exam_type = $data[0]['exam_type'];
                    $status = $data[0]['status'];
                    $class = $data[0]['class'];
                    $IsRegular = @$data[0]['regPvt'];
                    $coll_cd = $data[0]['coll_cd']; 
                    $cat11  = $data[0]['cat11'];
                    $cat12  = $data[0]['cat12'];

                    @$isParctialsub =   $data['0']['sn'];
                    @$spl_cd = $data['0']['spl_cd'];

                    if($spl_cd == 119)
                    {
                        echo "<option value='0' selected='selected'>NONE</option>";
                        echo "<option value='3'>HUMANITIES</option>";
                        echo "<option value='5'>COMMERCE</option>";   
                    }

                    else if($cat11==4 || $cat12 == 4)
                    {
                        echo "<option value='9' selected='selected'>KAHSA</option>";   
                    }

                    else if($cat11==6 || $cat12 == 6)
                    {
                        echo "<option value='3' selected='selected'>HUMANITIES</option>";
                    }

                    else if($exam_type == 3 && $class == 11 && $IsRegular == 1 && $isParctialsub == 2){

                        echo "<option value='0' selected='selected'>NONE</option>";
                        echo "<option value='3'>HUMANITIES</option>";
                        echo "<option value='5'>COMMERCE</option>";      
                    }

                    else if($exam_type == 14 || $exam_type == 15 || $exam_type == 16)
                    {
                        if($grp_cd == 1)
                        {
                            echo "<option value='1' selected='selected'>PRE-MEDICAL</option>"; 
                        }
                        else if($grp_cd == 2)
                        {
                            echo "<option value='2' selected='selected'>PRE-ENGINEERING</option>"; 
                        }
                        else if($grp_cd == 3)
                        {
                            echo "<option value='3' selected='selected'>HUMANITIES</option>"; 
                        }
                        else if($grp_cd == 4)
                        {
                            echo "<option value='4' selected='selected'>GENERAL SCIENCE</option>"; 
                        }

                        else if($grp_cd == 5)
                        {
                            echo "<option value='5' selected='selected'>COMMERCE</option>";
                        }
                    }

                    else if($exam_type == 1   || $exam_type == 3 || $exam_type == 9 || $exam_type == 11)
                    {
                        if($grp_cd == 1){
                            echo "<option value='1' selected='selected'>PRE-MEDICAL</option>"; 
                            echo "<option value='3'>HUMANITIES</option>";
                            echo "<option value='5'>COMMERCE</option>";       
                        }
                        else if ($grp_cd == 2){
                            echo "<option value='2' selected='selected'>PRE-ENGINEERING</option>";
                            echo "<option value='3'>HUMANITIES</option>";
                            echo "<option value='5'>COMMERCE</option>"; 
                        }

                        else if ($grp_cd == 3){
                            echo "<option value='3' selected='selected'>HUMANITIES</option>";
                            echo "<option value='5'>COMMERCE</option>"; 
                        }
                        else if($grp_cd == 4){
                            echo "<option value='4' selected='selected'>GENERAL SCIENCE</option>";
                            echo "<option value='3'>HUMANITIES</option>";
                            echo "<option value='5'>COMMERCE</option>"; 
                        }
                        else if($grp_cd == 5){
                            echo "<option value='5' selected='selected'>COMMERCE</option>";
                            echo "<option value='3'>HUMANITIES</option>";

                        } 
                    }

                    else
                        if($exam_type == 4 || $exam_type == 5 || $exam_type == 6 || $exam_type == 2 )
                        {

                            if($grp_cd == 1){
                                echo "<option value='1' selected='selected'>PRE-MEDICAL</option>";      
                                echo "<option value='3'>HUMANITIES</option>";
                                echo "<option value='5'>COMMERCE</option>";    
                            }
                            else if ($grp_cd == 2){
                                echo "<option value='2' selected='selected'>PRE-ENGINEERING</option>";
                                echo "<option value='3'>HUMANITIES</option>";
                                echo "<option value='5'>COMMERCE</option>";  
                            }
                            else if ($grp_cd == 3){
                                echo "<option value='3' selected='selected'>HUMANITIES</option>";
                                echo "<option value='5'>COMMERCE</option>";  
                            }
                            else if($grp_cd == 4){
                                echo "<option value='4' selected='selected'>GENERAL SCIENCE</option>";
                                echo "<option value='3'>HUMANITIES</option>";
                                echo "<option value='5'>COMMERCE</option>";  
                            }
                            else if($grp_cd == 5){
                                echo "<option value='5' selected='selected'>COMMERCE</option>";       
                                echo "<option value='3'>HUMANITIES</option>";  
                            }
                            else if($grp_cd == 7){
                                echo "<option value='7' selected='selected'>HOME ECONOMICS</option>";
                                echo "<option value='3'>HUMANITIES</option>";
                                echo "<option value='5'>COMMERCE</option>";  
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

                    $hum_sub_pr_array = array(
                        'NONE'=>'',
                        'NONE'=>'0',
                        'LIBRARY SCIENCE'=>'8',
                        'GEOGRAPHY'=>'12',
                        'PSYCHOLOGY'=>'16',
                        'STATISTICS'=>'18',
                        'OUTLINES OF HOME ECONOMICS'=>'21',
                        'FINE ARTS'=>'23',
                        'HEALTH & PHYSICAL EDUCATION'=>'42',
                        'NURSING'=>'79',
                        'COMPUTER SCIENCE'=>'83',
                        'AGRICULTURE'=>'90'
                    );

                    $hum_sub_without_pr = array(
                        'NONE'=>'',
                        'NONE'=>'0',
                        'ECONOMICS'=>'11',
                        'PHILOSOPHY'=>'14',
                        'CIVICS'=>'17',
                        'MATHEMATICS'=>'19',
                        'ISLAMIC STUDIES'=>'20',
                        'ARABIC'=>'24',
                        'ENGLISH ELECTIVE'=>'27',
                        'PUNJABI'=>'32',
                        'PERSIAN'=>'34',
                        'URDU (ADVANCE)'=>'37',
                        'EDUCATION'=>'43',
                        'SOCIOLOGY'=>'45',
                        'HISTORY OF PAKISTAN'=>'55',
                        'HISTORY OF ISLAM'=>'56',
                        'HISTORY OF INDO-PAK'=>'57',
                        'HISTORY OF MODREN WORLD'=>'58'
                    );
                    ?>
                </select>
            </div>
        </div>
    </div>
    <?php
    @$cattype = @$_POST['CatType'];
    if(($exam_type == 16 || $exam_type == 14) && $cattype == 1)
    {
        echo"
        <div class='form-group'>
        <div class='row'>
        <div class='col-md-offset-2 col-md-8'>
        <label class='control-label' for='ddlMarksImproveoptions' >
        Select Type :
        </label>        
        <select id='ddlMarksImproveoptions' class='form-control' name='ddlMarksImproveoptions'>
        <option value='0' selected='selected'>Select Any One </option>
        <option value='1'>PART-1 FULL </option>
        <option value='2'>PART-2 FULL</option>                                
        <option value='3'>BOTH PART FULL</option>
        <option value='4'>SUBJECT WISE</option>            
        </select>
        </div>
        </div>
        </div> 
        ";
    }
    if(@$exam_type == 4 || @$exam_type == 5 || @$exam_type == 6)
    {
        ?>
        <div class="isFull">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <label class="checkbox-inline">

                            <input type="checkbox" id="fullAppear" name="fullAppear"/><span style="font-size: larger; font-weight: bold; padding: 10px;">Full Appear In Both Parts?</span>  

                        </label>
                    </div> 
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" id="lblpart1cat" name="lblpart1cat" style="text-decoration: underline;">
                    <?php
                    if(($exam_type == 7 || $exam_type == 8 || $exam_type == 9 || $exam_type == 13 || $exam_type == 16 || $exam_type == 14 ) && $cattype == 1){
                        echo'Category P-1: MARKS IMPROVEMENT';
                    }
                    else if (($exam_type ==11 || $exam_type == 16 || $exam_type == 15)&& $cattype == 2){
                        echo'Category P-1: ADDITIONAL';
                    }
                    else{
                        echo'PART-I Subjects';
                    }
                    ?>
                </label>
            </div>
            <div class="col-md-4">
                <label class="control-label" id="lblpart2cat" name="lblpart2cat" style="text-decoration: underline;">
                    <?php
                    if(($exam_type == 7 || $exam_type == 8 || $exam_type == 9 || $exam_type == 13 || $exam_type == 16 || $exam_type == 14 ) && $cattype == 1){
                        echo'Category P-2: MARKS IMPROVEMENT';
                    }
                    else if (($exam_type ==11 || $exam_type == 16 || $exam_type == 15)&& $cattype == 2)
                    {
                        echo'Category P-2: ADDITIONAL';
                    }
                    else{
                        echo'PART-II Subjects';
                    }
                    ?>
                </label>
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub1" class="form-control" name="sub1"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub1p2" class="form-control" name="sub1p2"></select> 
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub2" class="form-control" name="sub2"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub2p2" class="form-control" name="sub2p2"></select> 
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub3" class="form-control" name="sub3"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub3p2" class="form-control" name="sub3p2"></select> 
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub4" class="form-control" name="sub4"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub4p2" class="form-control" name="sub4p2"></select> 
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub5" class="form-control" name="sub5"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub5p2" class="form-control" name="sub5p2"></select> 
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub6" class="form-control" name="sub6"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub6p2" class="form-control" name="sub6p2"></select> 
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub7" class="form-control" name="sub7"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub7p2" class="form-control" name="sub7p2"></select> 
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub8" class="form-control" name="sub8"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub8p2" class="form-control" name="sub8p2"></select> 
            </div>
        </div>
    </div>

    <input type="hidden" name="gend" id="gend" value="<?php echo @$gender; ?>">
    <input type="hidden" name="oldschm"   id="oldschm" value="<?php echo @$oldschm = @$data['oldschm']?>">
    <input type="hidden" name="oldclass"   id="oldclass" value="<?php  echo @$oldcls = $data[0]['class']?>">
    <input type="hidden" name="exam_type"  id="exam_type"  value="<?php echo @$exam_type = $data[0]['exam_type']; ?>">
    <input type="hidden" name="pregrp"     id="pregrp"     value="<?php echo @$pregrp = $data[0]['grp_cd']; ?>">
    <input type="hidden" name="oldboardid" id="oldboardid" value="<?php   echo @$data['board'];?>"/>
    <input type="hidden" name="matRno_hidden" id="matRno_hidden" value="<?php   echo @$data[0]['matRno'];?>"/>
    <input type="hidden" name="InterRno_hidden" id="InterRno_hidden" value="<?php   echo @$data[0]['rno'];?>"/>
    <input type="hidden" name="InterYear_hidden" id="InterYear_hidden" value="<?php   echo @$data[0]['Iyear'];?>"/>
    <input type="hidden" name="InterSess_hidden" id="InterSess_hidden" value="<?php   echo @$data['0']['sess'];?>"/>
    <input type="hidden" name="cattype_hidden" id="cattype_hidden" value="<?php   echo  @$cattype;?>"/>
    <input type="hidden" name="sub1pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub1pf1'];?>"/>
    <input type="hidden" name="sub2pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub2pf1'];?>"/>
    <input type="hidden" name="sub3pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub3pf1'];?>"/>
    <input type="hidden" name="sub4pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub4pf1'];?>"/>
    <input type="hidden" name="sub5pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub5pf1'];?>"/>
    <input type="hidden" name="sub6pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub6pf1'];?>"/>
    <input type="hidden" name="sub7pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub7pf1'];?>"/>
    <input type="hidden" name="sub1pf2_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub1pf2'];?>"/>
    <input type="hidden" name="sub2pf2_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub2pf2'];?>"/>
    <input type="hidden" name="sub8pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub8pf1'];?>"/>
    <input type="hidden" name="sub4pf2_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub4pf2'];?>"/>
    <input type="hidden" name="sub5pf2_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub5pf2'];?>"/>
    <input type="hidden" name="sub6pf2_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub6pf2'];?>"/>
    <input type="hidden" name="sub7pf2_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub7pf2'];?>"/>
    <input type="hidden" name="sub1st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub1st1'];?>"/>
    <input type="hidden" name="sub2st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub2st1'];?>"/>
    <input type="hidden" name="sub3st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub3st1'];?>"/>
    <input type="hidden" name="sub4st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub4st1'];?>"/>
    <input type="hidden" name="sub5st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub5st1'];?>"/>
    <input type="hidden" name="sub6st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub6st1'];?>"/>
    <input type="hidden" name="sub7st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub7st1'];?>"/>
    <input type="hidden" name="sub1st2_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub1st2'];?>"/>
    <input type="hidden" name="sub2st2_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub2st2'];?>"/>
    <input type="hidden" name="sub3st2_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub3st2'];?>"/>
    <input type="hidden" name="sub4st2_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub4st2'];?>"/>
    <input type="hidden" name="sub5st2_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub5st2'];?>"/>
    <input type="hidden" name="sub6st2_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub6st2'];?>"/>
    <input type="hidden" name="sub7st2_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub7st2'];?>"/>
    <input type="hidden" name="cat11_hidden" id="cat11_hidden" value="<?php echo  @$data[0]['cat11'];?>"/>
    <input type="hidden" name="cat12_hidden" id="cat12_hidden" value="<?php echo  @$data[0]['cat12'];?>"/>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-3">
                <input type="submit" value="Save Form" id="btnsubmitUpdateEnrol" name="btnsubmitUpdateEnrol" class="btn btn-primary btn-block" onclick="return checks_12th_Private()">
            </div>
            <div class="col-md-2">
                <a href="<?php echo base_url(); ?>assets/img/Instruction.jpg" download="instructions" class="btn btn-info btn-block">Download Instruction</a>
            </div>
            <div class="col-md-3">
                <input type="button" class="btn btn-danger btn-block" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
            </div>
        </div>
    </div>
</form>

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/source/jquery.fancybox.pack.js"></script>    
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/source/jquery.fancybox.js"></script>    
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>

<script type="text/javascript">
    function ValidateFileUpload() {
        var fuData = document.getElementById('inputFile');
        var FileUploadPath = fuData.value;
        if (FileUploadPath == '') {
            alert("Please upload an image");
            jQuery('#image_upload_preview').removeAttr('src');
        } 
        else {
            var Extension = FileUploadPath.substring(
                FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "jpeg" || Extension == "jpg") {
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_upload_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fuData.files[0]);
                }
            } 
            else {
                $('#inputFile').removeAttr('value');
                jQuery('#image_upload_preview').removeAttr('src');
                alert("Image only allows file types of JPEG. ");
                return false;
            }
        }
        var file_size = $('#inputFile')[0].files[0].size;
        if(file_size>20480) {                                    
            $('#inputFile').removeAttr('value');
            jQuery('#image_upload_preview').removeAttr('src');
            alert("File size can be between 20KB"); 
            return false;
        } 
    }
</script>
<script type="text/javascript">

    $(document).ready(function(){

        $.fancybox("#instruction");

        $('#address').each(function(){
            $(this).val($(this).val().trim());
        });

        function hide_sub7_sub8(){

            $('#sub7').hide();$('#sub7p2').hide();
            $('#sub8').hide(); $('#sub8p2').hide();    
        }

        function Empty_All_Dropdowns(){
            $('#sub1').empty();$('#sub1p2').empty();
            $('#sub2').empty();$('#sub2p2').empty();
            $('#sub3').empty();$('#sub3p2').empty();
            $('#sub4').empty();$('#sub4p2').empty();
            $('#sub5').empty();$('#sub5p2').empty();
            $('#sub6').empty(); $('#sub6p2').empty();
            $('#sub7').empty();$('#sub7p2').empty();
            $('#sub8').empty(); $('#sub8p2').empty();
        }

        function Empty_All_DropdownsPII(){
            $('#sub1p2').empty();
            $('#sub2p2').empty();
            $('#sub3p2').empty();
            $('#sub4p2').empty();
            $('#sub5p2').empty();
            $('#sub6p2').empty();
            $('#sub7p2').empty();
            $('#sub8p2').empty();
        }

        function ClearDropDownsP1(){

            $("#sub1").append('<option value="0">NONE</option>');
            $("#sub2").append('<option value="0">NONE</option>');
            $("#sub3").append('<option value="0">NONE</option>');
            $("#sub4").append('<option value="0">NONE</option>');
            $("#sub5").append('<option value="0">NONE</option>');
            $("#sub6").append('<option value="0">NONE</option>');
            $("#sub7").append('<option value="0">NONE</option>');
            $("#sub8").append('<option value="0">NONE</option>');
        }

        function ClearDropDownsP2(){
            $("#sub1p2").append('<option value="0">NONE</option>');
            $("#sub2p2").append('<option value="0">NONE</option>');
            $("#sub3p2").append('<option value="0">NONE</option>');
            $("#sub4p2").append('<option value="0">NONE</option>');
            $("#sub5p2").append('<option value="0">NONE</option>');
            $("#sub6p2").append('<option value="0">NONE</option>');
            $("#sub7p2").append('<option value="0">NONE</option>');
            $("#sub8p2").append('<option value="0">NONE</option>');
        }

        function ClearALLDropDowns() {

            Empty_All_Dropdowns();

            $("#sub1").append('<option value="0">NONE</option>');
            $("#sub1p2").append('<option value="0">NONE</option>');

            $("#sub2").append('<option value="0">NONE</option>');
            $("#sub2p2").append('<option value="0">NONE</option>');

            $("#sub3").append('<option value="0">NONE</option>');
            $("#sub3p2").append('<option value="0">NONE</option>');

            $("#sub4").append('<option value="0">NONE</option>');
            $("#sub4p2").append('<option value="0">NONE</option>');

            $("#sub5").append('<option value="0">NONE</option>');
            $("#sub5p2").append('<option value="0">NONE</option>');

            $("#sub6").append('<option value="0">NONE</option>');
            $("#sub6p2").append('<option value="0">NONE</option>');

            $("#sub7").append('<option value="0">NONE</option>');
            $("#sub7p2").append('<option value="0">NONE</option>');

            $("#sub8").append('<option value="0">NONE</option>');
            $("#sub8p2").append('<option value="0">NONE</option>');
        }

        function pre_medical_subjects() {
            Empty_All_Dropdowns();

            $('#sub7').hide();$('#sub7p2').hide();
            $('#sub8').hide(); $('#sub8p2').hide();


            $("#sub2").append('<option value="1">ENGLISH</option>');
            $("#sub2p2").append('<option value="1">ENGLISH</option>');

            $("#sub1").append('<option value="2">URDU</option>');
            $("#sub1p2").append('<option value="2">URDU</option>');

            $("#sub3").append('<option value="92">ISLAMIC EDUCATION</option>');
            $("#sub3p2").append('<option value="91">PAKISTAN STUDIES</option>');

            $("#sub4").append('<option value="47">PHYSICS</option>');
            $("#sub4p2").append('<option value="47">PHYSICS</option>');

            $("#sub5").append('<option value="48">CHEMISTRY</option>');
            $("#sub5p2").append('<option value="48">CHEMISTRY</option>');

            $("#sub6").append('<option value="46">BIOLOGY</option>');
            $("#sub6p2").append('<option value="46">BIOLOGY</option>');
        }

        function pre_engineering_subjects() {
            Empty_All_Dropdowns();

            $('#sub7').hide();$('#sub7p2').hide();
            $('#sub8').hide(); $('#sub8p2').hide();


            $("#sub2").append('<option value="1">ENGLISH</option>');
            $("#sub2p2").append('<option value="1">ENGLISH</option>');

            $("#sub1").append('<option value="2">URDU</option>');
            $("#sub1p2").append('<option value="2">URDU</option>');

            $("#sub3").append('<option value="92">ISLAMIC EDUCATION</option>');
            $("#sub3p2").append('<option value="91">PAKISTAN STUDIES</option>');

            $("#sub4").append('<option value="47">PHYSICS</option>');
            $("#sub4p2").append('<option value="47">PHYSICS</option>');

            $("#sub5").append('<option value="48">CHEMISTRY</option>');
            $("#sub5p2").append('<option value="48">CHEMISTRY</option>');

            $("#sub6").append('<option value="19">MATHEMATICS</option>');
            $("#sub6p2").append('<option value="19">MATHEMATICS</option>');
        }

        function general_science_subjects() {
            Empty_All_Dropdowns();

            $('#sub7').hide();$('#sub7p2').hide();
            $('#sub8').hide(); $('#sub8p2').hide();


            $("#sub2").append('<option value="1">ENGLISH</option>');
            $("#sub2p2").append('<option value="1">ENGLISH</option>');

            $("#sub1").append('<option value="2">URDU</option>');
            $("#sub1p2").append('<option value="2">URDU</option>');

            $("#sub3").append('<option value="92">ISLAMIC EDUCATION</option>');
            $("#sub3p2").append('<option value="91">PAKISTAN STUDIES</option>');

            $("#sub4").append('<option value="47">PHYSICS</option>');
            $("#sub4p2").append('<option value="47">PHYSICS</option>');

            $("#sub5").append('<option value="83">COMPUTER SCIENCE</option>');
            $("#sub5p2").append('<option value="83">COMPUTER SCIENCE</option>');

            $("#sub6").append('<option value="19">MATHEMATICS</option>');
            $("#sub6p2").append('<option value="19">MATHEMATICS</option>');
        }

        function commerce_subjects(){
            Empty_All_Dropdowns();

            $('#sub7').show();$('#sub7p2').show();
            $('#sub8').hide(); $('#sub8p2').hide();


            $("#sub2").append('<option value="1">ENGLISH</option>');
            $("#sub2p2").append('<option value="1">ENGLISH</option>');

            $("#sub1").append('<option value="2">URDU</option>');
            $("#sub1p2").append('<option value="2">URDU</option>');

            $("#sub3").append('<option value="92">ISLAMIC EDUCATION</option>');
            $("#sub3p2").append('<option value="91">PAKISTAN STUDIES</option>');

            $("#sub4").append('<option value="70">PRINCIPLES OF ACCOUNTING</option>');
            $("#sub4p2").append('<option value="70">PRINCIPLES OF ACCOUNTING</option>');

            $("#sub5").append('<option value="71">PRINCIPLES OF ECONOMICS</option>');

            $("#sub5p2").append('<option value="94">COMMERCIAL GEOGRAPHY</option>');

            $("#sub6").append('<option value="80">BUSINESS MATH</option>');

            $("#sub6p2").append('<option value="97">BUSINESS STATISTICS</option>');

            $("#sub7").append('<option value="39">PRINCIPLES OF COMMERCE</option>');

            $("#sub7p2").append('<option value="95">BANKING</option>');
        }

        var huminities_sub_practical = {
            0:'SELECT ONE',              
            8:'LIBRARY SCIENCE',
            12:'GEOGRAPHY',
            16:'PSYCHOLOGY',
            18:'STATISTICS',
            21:'OUTLINES OF HOME ECONOMICS',
            23:'FINE ARTS',
            42:'HEALTH & PHYSICAL EDUCATION',
            79:'NURSING',
            83:'COMPUTER SCIENCE',
            90:'AGRICULTURE'
        }

        var huminities_without_practical = {

            0:'SELECT ONE',
            11:'ECONOMICS',
            14:'PHILOSOPHY',
            17:'CIVICS',
            19:'MATHEMATICS',
            20:'ISLAMIC STUDIES',
            24:'ARABIC',
            27:'ENGLISH ELECTIVE',
            32:'PUNJABI',
            34:'PERSIAN',
            37:'URDU (ADVANCE)',
            43:'EDUCATION',
            45:'SOCIOLOGY',
            55:'HISTORY OF PAKISTAN',
            56:'HISTORY OF ISLAM',
            57:'HISTORY OF INDO-PAK',
            58:'HISTORY OF MODREN WORLD'
        }


        var huminities_without_practical_withoutmath = {

            0:'SELECT ONE',
            11:'ECONOMICS',
            14:'PHILOSOPHY',
            17:'CIVICS',
            20:'ISLAMIC STUDIES',
            24:'ARABIC',
            27:'ENGLISH ELECTIVE',
            32:'PUNJABI',
            34:'PERSIAN',
            37:'URDU (ADVANCE)',
            43:'EDUCATION',
            45:'SOCIOLOGY',
            55:'HISTORY OF PAKISTAN',
            56:'HISTORY OF ISLAM',
            57:'HISTORY OF INDO-PAK',
            58:'HISTORY OF MODREN WORLD'
        }

        var huminities_complete_subjects = {
            0:'SELECT ONE',
            11:'ECONOMICS',
            14:'PHILOSOPHY',
            17:'CIVICS',
            19:'MATHEMATICS',
            20:'ISLAMIC STUDIES',
            24:'ARABIC',
            27:'ENGLISH ELECTIVE',
            32:'PUNJABI',
            34:'PERSIAN',
            37:'URDU (ADVANCE)',
            43:'EDUCATION',
            45:'SOCIOLOGY',
            55:'HISTORY OF PAKISTAN',
            56:'HISTORY OF ISLAM',
            57:'HISTORY OF INDO-PAK',
            58:'HISTORY OF MODREN WORLD',
            8:'LIBRARY SCIENCE',
            12:'GEOGRAPHY',
            16:'PSYCHOLOGY',
            18:'STATISTICS',
            21:'OUTLINES OF HOME ECONOMICS',
            23:'FINE ARTS',
            42:'HEALTH & PHYSICAL EDUCATION',
            79:'NURSING',
            83:'COMPUTER SCIENCE',
            90:'AGRICULTURE'
        }

        function humanities_subjects(){

            Empty_All_Dropdowns();

            $("#sub2").append('<option value="1">ENGLISH</option>');
            $("#sub2p2").append('<option value="1">ENGLISH</option>');

            $("#sub1").append('<option value="2">URDU</option>');
            $("#sub1p2").append('<option value="2">URDU</option>');

            $("#sub3").append('<option value="92">ISLAMIC EDUCATION</option>');
            $("#sub3p2").append('<option value="91">PAKISTAN STUDIES</option>');

            $.each(huminities_without_practical,function(val,text){

                $("#sub4").append(new Option(text,val));
                $("#sub4p2").append(new Option(text,val));


                $("#sub5").append(new Option(text,val));
                $("#sub5p2").append(new Option(text,val));


                $("#sub6").append(new Option(text,val));
                $("#sub6p2").append(new Option(text,val));

            });

            $('#sub7').hide();$('#sub7p2').hide();
            $('#sub8').hide(); $('#sub8p2').hide();
        }



        function additionalsubjectswithoutmath(){

            Empty_All_Dropdowns();

            $("#sub2").append('<option value="1">ENGLISH</option>');
            $("#sub2p2").append('<option value="1">ENGLISH</option>');

            $("#sub1").append('<option value="2">URDU</option>');
            $("#sub1p2").append('<option value="2">URDU</option>');

            $("#sub3").append('<option value="92">ISLAMIC EDUCATION</option>');
            $("#sub3p2").append('<option value="91">PAKISTAN STUDIES</option>');

            $.each(huminities_without_practical_withoutmath,function(val,text){

                $("#sub4").append(new Option(text,val));
                $("#sub4p2").append(new Option(text,val));


                $("#sub5").append(new Option(text,val));
                $("#sub5p2").append(new Option(text,val));


                $("#sub6").append(new Option(text,val));
                $("#sub6p2").append(new Option(text,val));

            });

            $('#sub7').hide();$('#sub7p2').hide();
            $('#sub8').hide(); $('#sub8p2').hide();
        }

        function humanities_subjects_full(){

            Empty_All_Dropdowns();

            $("#sub2").append('<option value="1">ENGLISH</option>');
            $("#sub2p2").append('<option value="1">ENGLISH</option>');

            $("#sub1").append('<option value="2">URDU</option>');
            $("#sub1p2").append('<option value="2">URDU</option>');

            $("#sub3").append('<option value="92">ISLAMIC EDUCATION</option>');
            $("#sub3p2").append('<option value="91">PAKISTAN STUDIES</option>');

            $.each(huminities_complete_subjects,function(val,text){

                $("#sub4").append(new Option(text,val));
                $("#sub4p2").append(new Option(text,val));


                $("#sub5").append(new Option(text,val));
                $("#sub5p2").append(new Option(text,val));


                $("#sub6").append(new Option(text,val));
                $("#sub6p2").append(new Option(text,val));

            });

            $('#sub7').hide();$('#sub7p2').hide();
            $('#sub8').hide(); $('#sub8p2').hide();
        }


        function AamKhasa_subjCat6(){
            Empty_All_Dropdowns();

            $("#sub2").append('<option value="1">ENGLISH</option>');
            $("#sub2p2").append('<option value="1">ENGLISH</option>');

            $("#sub1").append('<option value="2">URDU</option>');
            $("#sub1p2").append('<option value="2">URDU</option>');

            $("#sub3").append('<option value="92">ISLAMIC EDUCATION</option>');
            $("#sub3p2").append('<option value="91">PAKISTAN STUDIES</option>');           

            $("#sub4").hide();$("#sub4p2").hide();
            $("#sub5").hide();$("#sub5p2").hide();
            $("#sub6").hide();$("#sub6p2").hide();
            $('#sub7').hide();$('#sub7p2').hide();
            $('#sub8').hide(); $('#sub8p2').hide();
        }

        function AamKhasa_subjcat4(){
            Empty_All_Dropdowns();

            $("#sub2").append('<option value="1">ENGLISH</option>');
            $("#sub2p2").append('<option value="1">ENGLISH</option>');

            $("#sub1").append('<option value="2">URDU</option>');
            $("#sub1p2").append('<option value="2">URDU</option>');

            $.each(huminities_without_practical,function(val,text){

                $("#sub4").append(new Option(text,val));
                $("#sub4p2").append(new Option(text,val));
            });
            $.each(huminities_without_practical,function(val,text){

                $("#sub5").append(new Option(text,val));
                $("#sub5p2").append(new Option(text,val));
            });

            $("#sub3").hide();$("#sub3p2").hide();
            $("#sub6").hide();$("#sub6p2").hide();
            $('#sub7').hide();$('#sub7p2').hide();
            $('#sub8').hide(); $('#sub8p2').hide();
        }

        var grp_cd ="<?php if(@$data[0]['exam_type']=="3"){ echo 0; } else{echo  @$data[0]['grp_cd'];}  ?>";
        var sub1 ="<?php echo @$data[0]['sub1']; ?>";
        var sub2 = "<?php echo @$data[0]['sub2']; ?>";
        var sub3 ="<?php echo @$data[0]['sub3']; ?>";
        var sub4 = "<?php echo @$data[0]['sub4']; ?>";

        var sub5 = "<?php echo @$data[0]['sub5']; ?>";

        var sub5A = "<?php echo @$data[0]['sub5A']; ?>";

        var sub6 = "<?php echo @$data[0]['sub6']; ?>";


        var sub6A = "<?php echo @$data[0]['sub6A']; ?>";

        var sub7A = "<?php echo @$data[0]['sub7A']; ?>";

        var sub7 = "<?php echo @$data[0]['sub7']; ?>";
        var sub8 = "<?php echo @$data[0]['sub8']; ?>";
        // Part 1 Subjects Pass fail .
        var sub1pf1 = "<?php echo @$data[0]['sub1pf1']; ?>";
        var sub2pf1 ="<?php echo @$data[0]['sub2pf1']; ?>";
        var sub3pf1 = "<?php echo @$data[0]['sub3pf1']; ?>";
        var sub4pf1 = "<?php echo @$data[0]['sub4pf1']; ?>";
        var sub5pf1 ="<?php echo @$data[0]['sub5pf1']; ?>";
        var sub6pf1 = "<?php echo @$data[0]['sub6pf1']; ?>";
        var sub7pf1 = "<?php echo @$data[0]['sub7pf1']; ?>";
        var sub8pf1 = "<?php echo @$data[0]['sub8pf1']; ?>";

        // Part 2 Subjects Pass Fail.
        var sub1pf2 = "<?php echo @$data[0]['sub1Pf2']; ?>";
        var sub2pf2 = "<?php echo @$data[0]['sub2pf2']; ?>";
        var sub3pf2 = "<?php echo @$data[0]['sub3pf2']; ?>";
        var sub4pf2 = "<?php echo @$data[0]['sub4pf2']; ?>";
        var sub5pf2 = "<?php echo @$data[0]['sub5pf2']; ?>";
        var sub6pf2 = "<?php echo @$data[0]['sub6pf2']; ?>";
        var sub7pf2 = "<?php echo @$data[0]['sub7pf2']; ?>";
        var sub8pf2 = "<?php echo @$data[0]['sub8pf2']; ?>";

        // Part 1 Subjects Present and Absent Status
        var sub1st1 = "<?php echo @$data[0]['sub1st1']; ?>";
        var sub2st1 ="<?php echo @$data[0]['sub2st1']; ?>";
        var sub3st1 = "<?php echo @$data[0]['sub3st1']; ?>";
        var sub4st1 ="<?php echo @$data[0]['sub4st1']; ?>";
        var sub5st1 ="<?php echo @$data[0]['sub5st1']; ?>";
        var sub6st1 = "<?php echo @$data[0]['sub6st1']; ?>";
        var sub7st1 = "<?php echo @$data[0]['sub7st1']; ?>";
        var sub8st1 = "<?php echo @$data[0]['sub8st1']; ?>";

        // Part 2 Subjects Present and Absent Status
        var sub1st2 = "<?php echo @$data[0]['sub1St2']; ?>";
        var sub2st2 = "<?php echo @$data[0]['sub2st2']; ?>";
        var sub3st2 ="<?php echo @$data[0]['sub3st2']; ?>";
        var sub4st2 = "<?php echo @$data[0]['sub4st2']; ?>";
        var sub5st2 = "<?php echo @$data[0]['sub5st2']; ?>";
        var sub6st2 = "<?php echo @$data[0]['sub6st2']; ?>";
        var sub7st2 ="<?php echo @$data[0]['sub7st2']; ?>";
        var sub8st2 ="<?php  echo @$data[0]['sub8st2']; ?>";   
        var exam_type = "<?php echo @$data[0]['exam_type']?>";
        var cls = "<?php echo @$data[0]['class']?>";
        var regpvt = "<?php echo @$data[0]['regPvt']?>";

        function sub_grp_load(){

            Empty_All_Dropdowns();

            $('#sub7').hide();
            $('#sub7p2').hide();

            $('#sub8').hide();
            $('#sub8p2').hide();


            if(grp_cd == 5)
            {
                $('#sub7').show();
                $('#sub7p2').show();
            }

            if((sub1pf1 == "3") || (sub1st1 == "2"))
            {
                $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                $("#sub1 option[value='" + sub1 + "']").attr("selected","selected");
            }
            else
            {   $("#sub1").empty();
                $("#sub1").append('<option value="0">NONE</option>');
            }
            if((sub1pf2 == "3") || (sub1st2 == "2"))
            {
                $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                $("#sub1p2 option[value='" + sub1 + "']").attr("selected","selected");
            }
            else
            {   $("#sub1p2").empty();
                $("#sub1p2").append('<option value="0">NONE</option>');
            }
            // Subject 2 
            if((sub2pf1 == "3") || (sub2st1 == "2"))
            {
                $("#sub2").empty();
                $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                $("#sub2 option[value='" + sub2 + "']").attr("selected","selected");
            }
            else
            {
                $("#sub2").empty();
                $("#sub2").append('<option value="0">NONE</option>');
            }
            if((sub2pf2 == "3") || (sub2st2 == "2"))
            {
                $("#sub2p2").empty();
                $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                $("#sub2p2 option[value='" + sub2 + "']").attr("selected","selected");
            }
            else
            {
                $("#sub2p2").empty();
                $("#sub2p2").append('<option value="0">NONE</option>');
            }
            //Subject 3
            if((sub3pf1 == "3") || (sub3st1 == "2"))
            {
                $("#sub3").empty();
                $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                $("#sub3 option[value='" + sub3 + "']").attr("selected","selected");
            }
            else
            {
                $("#sub3").empty();
                $("#sub3").append('<option value="0">NONE</option>');
            }
            if((sub8pf2 == "3") || (sub8st2 == "2"))
            {
                $("#sub3p2").empty();
                $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                $("#sub3p2 option[value='" + sub8 + "']").attr("selected","selected");
            }
            else
            {
                $("#sub3p2").empty();
                $("#sub3p2").append('<option value="0">NONE</option>');
            }
            //Subject 4
            if((sub4pf1 == "3") || (sub4st1 == "2"))
            {
                $("#sub4").empty();
                $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                $("#sub4 option[value='" + sub4 + "']").attr("selected","selected");

            }
            else
            {
                $("#sub4").empty();
                $("#sub4").append('<option value="0">NONE</option>');
            }
            if((sub4pf2 == "3") || (sub4st2 == "2"))
            {
                $("#sub4p2").empty();
                $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                $("#sub4p2 option[value='" + sub4 + "']").attr("selected","selected");

            }
            else
            {
                $("#sub4p2").empty();
                $("#sub4p2").append('<option value="0">NONE</option>');
            }
            //Subject 5
            if((sub5pf1 == "3") || (sub5st1 == "2"))
            {
                $("#sub5").empty();

                $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");
            }
            else
            {
                $("#sub5").empty();
                $("#sub5").append('<option value="0">NONE</option>');
            }

            if((sub5pf2 == "3") || (sub5st2 == "2"))
            {
                $("#sub5p2").empty();
                $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>', '<?php echo $data[0]['sub5']?>'));
                $("#sub5p2 option[value='" + sub5 + "']").attr("selected","selected");
            }
            else
            {
                $("#sub5p2").empty();
                $("#sub5p2").append('<option value="0">NONE</option>');
            }
            //Subject 6
            if((sub6pf1 == "3") || (sub6st1 == "2"))
            {
                $("#sub6").empty();
                $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                $("#sub6 option[value='" + sub6 + "']").attr("selected","selected");
            }
            else
            {
                $("#sub6").empty();
                $("#sub6").append('<option value="0">NONE</option>');
            }
            if((sub6pf2 == "3") || (sub6st2 == "2"))
            {
                $("#sub6p2").empty();
                $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>', '<?php echo $data[0]['sub6']?>'));
                $("#sub6p2 option[value='" + sub6 + "']").attr("selected","selected");
            }
            else
            {
                $("#sub6p2").empty();
                $("#sub6p2").append('<option value="0">NONE</option>');
            }

            if(grp_cd == 5)
            {
                if((sub5pf2 == "3") || (sub5st2 == "2"))
                {
                    $("#sub5p2").empty();
                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5A'],$subarray); ?>', '<?php echo $data[0]['sub5A']?>'));
                    $("#sub5p2 option[value='" + sub5A + "']").attr("selected","selected");
                }
                else
                {
                    $("#sub5p2").empty();
                    $("#sub5p2").append('<option value="0">NONE</option>');
                }

                if((sub6pf2 == "3") || (sub6st2 == "2"))
                {
                    $("#sub6p2").empty();
                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6A'],$subarray); ?>', '<?php echo $data[0]['sub6A']?>'));
                    $("#sub6p2 option[value='" + sub6A + "']").attr("selected","selected");
                }
                else
                {
                    $("#sub6p2").empty();
                    $("#sub6p2").append('<option value="0">NONE</option>');
                }

                if((sub7pf1 == "3") || (sub7st1 == "2"))
                {
                    $("#sub7").empty();
                    $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                    $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");
                }
                else
                {
                    $("#sub7").empty();
                    $("#sub7").append('<option value="0">NONE</option>');
                } 

                if((sub7pf2 == "3") || (sub7st2 == "2"))
                {
                    $("#sub7p2").empty();
                    $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7A'],$subarray); ?>', '<?php echo $data[0]['sub7A']?>'));
                    $("#sub7p2 option[value='" + sub7A + "']").attr("selected","selected");
                }
                else
                {
                    $("#sub7p2").empty();
                    $("#sub7p2").append('<option value="0">NONE</option>');
                }  
            }
        }

        function sub_grp_load_All_Previous(){

            Empty_All_Dropdowns();

            $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
            $("#sub1 option[value='" + sub1 + "']").attr("selected","selected");

            $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
            $("#sub1p2 option[value='" + sub1 + "']").attr("selected","selected");

            $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
            $("#sub2 option[value='" + sub2 + "']").attr("selected","selected");

            $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
            $("#sub2p2 option[value='" + sub2 + "']").attr("selected","selected");

            $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
            $("#sub3 option[value='" + sub3 + "']").attr("selected","selected");

            $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
            $("#sub3p2 option[value='" + sub8 + "']").attr("selected","selected");

            $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
            $("#sub4 option[value='" + sub4 + "']").attr("selected","selected");

            $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
            $("#sub4p2 option[value='" + sub4 + "']").attr("selected","selected");

            $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
            $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");

            $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
            $("#sub5p2 option[value='" + sub5 + "']").attr("selected","selected");

            $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
            $("#sub6 option[value='" + sub6 + "']").attr("selected","selected");

            $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
            $("#sub6p2 option[value='" + sub6 + "']").attr("selected","selected");

            if(grp_cd == 5)
            {
                $('#sub7').show();
                $('#sub7p2').show();
                $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");
                $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7A'],$subarray); ?>',sub7A));
                $("#sub7p2 option[value='" + sub7A + "']").attr("selected","selected");
            }
        }

        function sub_grp_load_exam_type1(){

            Empty_All_Dropdowns();

            $("#sub1").append('<option value="0">NONE</option>');
            $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));

            $("#sub2").append('<option value="0">NONE</option>');
            $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));

            $("#sub3").append('<option value="0">NONE</option>');
            $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));

            $("#sub4").append('<option value="0">NONE</option>');
            $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));

            if(grp_cd == 5)
            {

                $('#sub7').show();
                $('#sub7p2').show();  

                $("#sub5").append('<option value="0">NONE</option>'); 
                $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5A'],$subarray); ?>','<?php echo $data[0]['sub5A']?>'));

                $("#sub6").append('<option value="0">NONE</option>');
                $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6A'],$subarray); ?>','<?php echo $data[0]['sub6A']?>'));  
            } 
            else
            {
                $("#sub5").append('<option value="0">NONE</option>'); 
                $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));

                $("#sub6").append('<option value="0">NONE</option>');
                $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));  
                $('#sub7').empty();$('#sub7p2').empty();
                $('#sub8').empty(); $('#sub8p2').empty();
            }                 

            if(sub7 != '' || grp_cd == 5)
            {
                $("#sub7").append('<option value="0">NONE</option>');
                $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7A'],$subarray); ?>','<?php echo $data[0]['sub7A']?>'));    
            }
            else
            {
                $("#sub7").hide();
                $("#sub7p2").hide();    
                $('#sub7').empty();$('#sub7p2').empty();
                $('#sub8').empty(); $('#sub8p2').empty();
            }
            $("#sub8").hide();
            $("#sub8p2").hide();
        }

        function sub_grp_load_exam_type3(){

            Empty_All_Dropdowns();

            $('#sub7').hide();
            $('#sub7p2').hide();

            if((sub1pf1 == "2") || (sub1st1 == "2")){

                $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));      
                $("#sub1").append('<option value="0">NONE</option>');      
            }

            else{
                $("#sub1").append('<option value="0">NONE</option>');            
            }

            if((sub2pf1 == "2") || (sub2st1 == "2")){
                $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));      
                $("#sub2").append('<option value="0">NONE</option>');      
            }

            else{
                $("#sub2").append('<option value="0">NONE</option>');            
            }

            if((sub3pf1 == "2") || (sub3st1 == "2")){
                $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));      
                $("#sub3").append('<option value="0">NONE</option>');      
            }

            else{
                $("#sub3").append('<option value="0">NONE</option>');            
            }

            if((sub4pf1 == "2") || (sub4st1 == "2")){
                $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));      
                $("#sub4").append('<option value="0">NONE</option>');      
            }

            else{
                $("#sub4").append('<option value="0">NONE</option>');            
            }

            if((sub5pf1 == "2") || (sub5st1 == "2")){
                $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));      
                $("#sub5").append('<option value="0">NONE</option>');      
            }

            else{
                $("#sub5").append('<option value="0">NONE</option>');            
            }

            if((sub6pf1 == "2") || (sub6st1 == "2")){
                $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));      
                $("#sub6").append('<option value="0">NONE</option>');      
            }
            else{
                $("#sub6").append('<option value="0">NONE</option>');            
            }

            if((sub7pf1 == "2") || (sub7st1 == "2")){
                $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));      
                $("#sub7").append('<option value="0">NONE</option>');      
            }
            else{
                $("#sub7").append('<option value="0">NONE</option>');            
            }

            //debugger;
            $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
            $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
            $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
            $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
            $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
            $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));                         

            $("#sub7").hide();
            $("#sub7p2").hide();
            $("#sub8").hide();
            $("#sub8p2").hide();                                   


            grp_cd ="<?php echo  @$data[0]['grp_cd'];?>";

            if(grp_cd == '5')
            {
                Empty_All_DropdownsPII();
                $('#sub7').show();
                $('#sub7p2').show();  
                $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));

                $("#sub5p2").append(new Option('<?php echo  array_search($data[0]['sub5A'],$subarray); ?>', sub5A));
                $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6A'],$subarray); ?>',sub6A));
                $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7A'],$subarray); ?>', sub7A));
            }
        }

        function sub_grp_load_exam_type4(){

            Empty_All_Dropdowns();
            hide_sub7_sub8();
            ClearDropDownsP1();

            if((sub1pf2 == "3") || (sub1st2 == "2"))
            {
                $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
            }
            else
            {  
                $("#sub1p2").append('<option value="0">NONE</option>');
            }
            // Subject 2 

            if((sub2pf2 == "3") || (sub2st2 == "2"))
            {
                $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
            }
            else
            {
                $("#sub2p2").append('<option value="0">NONE</option>');
            }
            // Subject 3 

            if((sub8pf2 == "3") || (sub8st2 == "2"))
            {
                $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
            }
            else
            {
                $("#sub3p2").append('<option value="0">NONE</option>');
            }
            // Subject 4 

            if((sub4pf2 == "3") || (sub4st2 == "2"))
            {
                $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));

            }
            else
            {
                $("#sub4p2").append('<option value="0">NONE</option>');
            }
            // Subject 5 

            if((sub5pf2 == "3") || (sub5st2 == "2"))
            {

                $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>','<?php echo $data[0]['sub5']?>'));
            }
            else
            {
                $("#sub5p2").append('<option value="0">NONE</option>');
            }
            // Subject 6 

            if((sub6pf2 == "3") || (sub6st2 == "2"))
            {

                $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>','<?php echo $data[0]['sub6']?>'));
            }
            else
            {
                $("#sub6p2").append('<option value="0">NONE</option>');
            }
            if(grp_cd == 5)
            {
                $('#sub7').show();;$('#sub7p2').show();

                if((sub5pf2 == "3") || (sub5st2 == "2"))
                {
                    $("#sub5p2").empty();
                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5A'],$subarray); ?>', '<?php echo $data[0]['sub5A']?>'));
                    $("#sub5p2 option[value='" + sub5A + "']").attr("selected","selected");
                }
                else
                {
                    $("#sub5p2").empty();
                    $("#sub5p2").append('<option value="0">NONE</option>');
                }

                if((sub6pf2 == "3") || (sub6st2 == "2"))
                {
                    $("#sub6p2").empty();
                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6A'],$subarray); ?>', '<?php echo $data[0]['sub6A']?>'));
                    $("#sub6p2 option[value='" + sub6A + "']").attr("selected","selected");
                }
                else
                {
                    $("#sub6p2").empty();
                    $("#sub6p2").append('<option value="0">NONE</option>');
                }

                if((sub7pf1 == "3") || (sub7st1 == "2"))
                {
                    $("#sub7").empty();
                    $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                    $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");
                }
                else
                {
                    $("#sub7").empty();
                    $("#sub7").append('<option value="0">NONE</option>');
                } 

                if((sub7pf2 == "3") || (sub7st2 == "2"))
                {
                    $("#sub7p2").empty();
                    $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7A'],$subarray); ?>', '<?php echo $data[0]['sub7A']?>'));
                    $("#sub7p2 option[value='" + sub7A + "']").attr("selected","selected");
                }
                else
                {
                    $("#sub7p2").empty();
                    $("#sub7p2").append('<option value="0">NONE</option>');
                }  
            }
        }

        function sub_grp_load_exam_type5(){

            Empty_All_Dropdowns();
            hide_sub7_sub8();

            if((sub1pf1 == "3") || (sub1st1 == "2"))
            {
                $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                //$("#sub1").append('<option value="0">NONE</option>');
            }
            else
            {   
                $("#sub1").append('<option value="0">NONE</option>');
            }
            $("#sub1p2").append('<option value="0">NONE</option>');

            // Subject 2 
            if((sub2pf1 == "3") || (sub2st1 == "2"))
            {
                $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));

            }
            else
            {
                $("#sub2").append('<option value="0">NONE</option>');
            }



            $("#sub2p2").append('<option value="0">NONE</option>');

            if((sub3pf1 == "3") || (sub3st1 == "2"))
            {
                $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));

            }
            else
            {
                $("#sub3").append('<option value="0">NONE</option>');
            }

            $("#sub3p2").append('<option value="0">NONE</option>');

            if((sub4pf1 == "3") || (sub4st1 == "2"))
            {
                $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));

            }
            else
            {
                $("#sub4").append('<option value="0">NONE</option>');
            }

            $("#sub4p2").append('<option value="0">NONE</option>');

            if((sub5pf1 == "3") || (sub5st1 == "2"))
            {
                $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));

            }
            else
            {
                $("#sub5").append('<option value="0">NONE</option>');
            }

            $("#sub5p2").append('<option value="0">NONE</option>');

            if((sub6pf1 == "3") || (sub6st1 == "2"))
            {
                $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));

            }
            else
            {
                $("#sub6").append('<option value="0">NONE</option>');
            }

            $("#sub6p2").append('<option value="0">NONE</option>');


            if(sub7 != ''){
                $('#sub7').show();
                $('#sub7p2').show();
                if((sub7pf1 == "3") || (sub7st1 == "2"))
                {
                    $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));

                }
                else
                {
                    $("#sub7").append('<option value="0">NONE</option>');
                }

                $("#sub7p2").append('<option value="0">NONE</option>');

            }
        }

        function sub_grp_load_exam_type6(){

            Empty_All_Dropdowns();
            hide_sub7_sub8();

            if((sub1pf1 == "3") || (sub1st1 == "2"))
            {
                $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                // $("#sub1").append('<option value="0">NONE</option>');
            }
            else
            {   
                $("#sub1").append('<option value="0">NONE</option>');
            }
            if((sub1pf2 == "3") || (sub1st2 == "2"))
            {
                $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
            }
            else
            {  
                $("#sub1p2").append('<option value="0">NONE</option>');
            }
            // Subject 2 
            if((sub2pf1 == "3") || (sub2st1 == "2"))
            {
                $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                //  $("#sub2").append('<option value="0">NONE</option>');
            }
            else
            {
                $("#sub2").append('<option value="0">NONE</option>');
            }
            if((sub2pf2 == "3") || (sub2st2 == "2"))
            {
                $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
            }
            else
            {
                // $("#sub2p2").empty();
                $("#sub2p2").append('<option value="0">NONE</option>');
            }
            if((sub3pf1 == "3") || (sub3st1 == "2"))
            {
                $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                //  $("#sub3").append('<option value="0">NONE</option>');
            }
            else
            {
                $("#sub3").append('<option value="0">NONE</option>');
            }
            if((sub8pf2 == "3") || (sub8st2 == "2"))
            {
                $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
            }
            else
            {
                $("#sub3p2").append('<option value="0">NONE</option>');
            }
            if((sub4pf1 == "3") || (sub4st1 == "2"))
            {
                $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                // $("#sub4").append('<option value="0">NONE</option>');
            }
            else
            {
                $("#sub4").append('<option value="0">NONE</option>');
            }
            if((sub4pf2 == "3") || (sub4st2 == "2"))
            {
                $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));

            }
            else
            {
                $("#sub4p2").append('<option value="0">NONE</option>');
            }
            if((sub5pf1 == "3") || (sub5st1 == "2"))
            {
                $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                // $("#sub5").append('<option value="0">NONE</option>');
            }
            else
            {
                $("#sub5").append('<option value="0">NONE</option>');
            }
            if((sub5pf2 == "3") || (sub5st2 == "2"))
            {
                if(grp_cd == 5)
                {
                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5A'],$subarray); ?>','<?php echo $data[0]['sub5A']?>')); 
                }
                else
                {
                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));  
                }

            }
            else
            {
                $("#sub5p2").append('<option value="0">NONE</option>');
            }
            if((sub6pf1 == "3") || (sub6st1 == "2"))
            {
                $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                // $("#sub6").append('<option value="0">NONE</option>');
            }
            else
            {
                $("#sub6").append('<option value="0">NONE</option>');
            }
            if((sub6pf2 == "3") || (sub6st2 == "2"))
            {
                if(grp_cd == 5)
                {
                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6A'],$subarray); ?>','<?php echo $data[0]['sub6A']?>')); 
                }
                else
                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
            }
            else
            {
                $("#sub6p2").append('<option value="0">NONE</option>');
            }

            if(sub7 != ''){
                $('#sub7').show();
                $('#sub7p2').show();
                if((sub7pf1 == "3") || (sub7st1 == "2"))
                {
                    $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                    //$("#sub7").append('<option value="0">NONE</option>');
                }
                else
                {
                    $("#sub7").append('<option value="0">NONE</option>');
                }
                if((sub7pf2 == "3") || (sub7st2 == "2"))
                {
                    $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7A'],$subarray); ?>','<?php echo $data[0]['sub7A']?>'));
                }
                else
                {
                    $("#sub7p2").append('<option value="0">NONE</option>');
                }   
            }
        }

        function sub_grp_load_MarksImp_PI(){
            Empty_All_Dropdowns();
            hide_sub7_sub8();
            ClearDropDownsP2();
            $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
            $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
            $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
            $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
            $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
            $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));

            if(sub7 != '' || grp_cd == 5){
                $('#sub7').show();
                $('#sub7p2').show();
                $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));    
                $("#sub7p2").append('<option value="0">NONE</option>');
            }
        }

        function sub_grp_load__MarksImp_PII(){
            Empty_All_Dropdowns();
            hide_sub7_sub8();
            ClearDropDownsP1();
            $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
            $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
            $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
            $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));

            if(grp_cd == 5){
                $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5A'],$subarray); ?>','<?php echo $data[0]['sub5A']?>'));
                $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6A'],$subarray); ?>','<?php echo $data[0]['sub6A']?>'));
                $('#sub7').show();
                $('#sub7p2').show();
                $("#sub7").append('<option value="0">NONE</option>');
                $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7A'],$subarray); ?>','<?php echo $data[0]['sub7A']?>'));
            }
            else{
                $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));    
            }
        }

        function sub_grp_load_MarksImp_FULL(){
            Empty_All_Dropdowns();
            hide_sub7_sub8();

            $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
            $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
            $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
            $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
            $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
            $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
            $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
            $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
            $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
            $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));

            if(grp_cd == 5){
                $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5A'],$subarray); ?>','<?php echo $data[0]['sub5A']?>'));
                $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6A'],$subarray); ?>','<?php echo $data[0]['sub6A']?>'));    
                $('#sub7').show();$('#sub7p2').show();
                $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7A'],$subarray); ?>','<?php echo $data[0]['sub7A']?>'));   
            }
            else {
                $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));    
            }
        }

        function sub_grp_load_MarksImp_Subj_wise(){

            Empty_All_Dropdowns();
            hide_sub7_sub8();

            if((sub1pf1 == "2" || sub1pf2 == "2") )
            {
                $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
            }
            else
            {
                $("#sub1p2").append('<option value="0">NONE</option>');
                $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));

                $("#sub1").append('<option value="0">NONE</option>');
                $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
            }

            // Subject 2 
            if((sub2pf1 == "2" || sub2pf2 == "2"))
            {
                $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
            }
            else
            {
                $("#sub2p2").append('<option value="0">NONE</option>');
                $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));

                $("#sub2").append('<option value="0">NONE</option>');
                $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));  
            }

            // subject 3 
            if(sub3pf1 == "2")
            {
                $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
            }
            else
            {
                $("#sub3").append('<option value="0">NONE</option>'); 
                $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
            }

            if( sub8pf2 == "2"){
                $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
            }

            else{
                $("#sub3p2").append('<option value="0">NONE</option>'); 
                $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
            }

            if((sub4pf1 == "2" || sub4pf2 == "2"))
            {
                $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
            }
            else
            {
                $("#sub4p2").append('<option value="0">NONE</option>');
                $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));

                $("#sub4").append('<option value="0">NONE</option>');
                $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
            }


            if(grp_cd == 5)
            {
                if((sub5pf1 == "2" || sub5pf2 == "2"))
                {
                    $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5A'],$subarray); ?>','<?php echo $data[0]['sub5A']?>'));
                }
                else
                {
                    $("#sub5p2").append('<option value="0">NONE</option>');
                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5A'],$subarray); ?>','<?php echo $data[0]['sub5A']?>'));

                    $("#sub5").append('<option value="0">NONE</option>');
                    $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                }

                if((sub6pf1 == "2" || sub6pf2 == "2"))
                {
                    $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6A'],$subarray); ?>','<?php echo $data[0]['sub6A']?>'));
                }
                else
                {
                    $("#sub6p2").append('<option value="0">NONE</option>');
                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6A'],$subarray); ?>','<?php echo $data[0]['sub6A']?>'));
                    $("#sub6").append('<option value="0">NONE</option>');
                    $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                }

                $('#sub7').show();$('#sub7p2').show();

                if((sub7pf1 == "2" || sub7pf2 == "2"))
                {
                    $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                    $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7A'],$subarray); ?>','<?php echo $data[0]['sub7A']?>'));
                }
                else
                {
                    $("#sub7p2").append('<option value="0">NONE</option>');
                    $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7A'],$subarray); ?>','<?php echo $data[0]['sub7A']?>'));

                    $("#sub7").append('<option value="0">NONE</option>');
                    $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7)); 
                }

            }

            else
            {
                if((sub5pf1 == "2" || sub5pf2 == "2"))
                {
                    $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                }
                else
                {
                    $("#sub5p2").append('<option value="0">NONE</option>');
                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));

                    $("#sub5").append('<option value="0">NONE</option>');
                    $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                }

                if((sub6pf1 == "2" || sub6pf2 == "2"))
                {
                    $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                }
                else
                {
                    $("#sub6p2").append('<option value="0">NONE</option>');
                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                    $("#sub6").append('<option value="0">NONE</option>');
                    $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                }
            }
        }


        function sub_grp_load_additional_engSub(){
            additionalsubjectswithoutmath();
            $('#sub1').hide();
            $('#sub1p2').hide();
            $('#sub2').hide(); 
            $('#sub2p2').hide(); 
            $('#sub3').hide();
            $('#sub3p2').hide();
            $('#sub1').empty();
            $('#sub1p2').empty();
            $('#sub2').empty();
            $('#sub2p2').empty();
            $('#sub3').empty();
            $('#sub3p2').empty();
        }

        function sub_grp_load_additional(){

            humanities_subjects();
            $('#sub1').hide();
            $('#sub1p2').hide();
            $('#sub2').hide(); 
            $('#sub2p2').hide(); 
            $('#sub3').hide();
            $('#sub3p2').hide();
            $('#sub1').empty();
            $('#sub1p2').empty();
            $('#sub2').empty();
            $('#sub2p2').empty();
            $('#sub3').empty();
            $('#sub3p2').empty();
        }

        function Aama_Khasa()
        {
            Empty_All_Dropdowns();
            hide_sub7_sub8();
            AamKhasa_subjcat4();
        }

        <?php
        //DebugBreak();

        $practical_Sub = array(

            'LIBRARY SCIENCE'=>'8',
            'GEOGRAPHY'=>'12',
            'PSYCHOLOGY'=>'16',
            'STATISTICS'=>'18',
            'OUTLINES OF HOME ECONOMICS'=>'21',
            'FINE ARTS'=>'23',
            'COMMERCIAL PRACTICE'=>'38',
            'HEALTH & PHYSICAL EDUCATION'=>'42',
            'BIOLOGY'=>'46',
            'PHYSICS'=>'47',
            'CHEMISTRY'=>'48',
            'COMPUTER SCIENCE'=>'83',
            'NURSING'=>'79',
            'AGRICULTURE'=>'90',
            'TYPING'=>'96',
            'COMPUTER STUDIES'=>'98',
            'CLOTHING & TEXTILE (Home-Economics Group)'=>'75',
            'HOME MANAGEMNET (Home-Economics Group)'=>'76'
        );

        $isper = 0;
        if(array_search($data[0]['sub4'],$practical_Sub) || array_search($data[0]['sub5'],$practical_Sub) || array_search($data[0]['sub5A'],$practical_Sub) || array_search($data[0]['sub6'],$practical_Sub)  || array_search($data[0]['sub6A'],$practical_Sub) ||  array_search($data[0]['sub7'],$practical_Sub) || array_search($data[0]['sub7A'],$practical_Sub))
        {
            $isper = 1;
        }

        if($spl_cd == 119){
            echo'Empty_All_Dropdowns();';
            echo'ClearALLDropDowns();';
        }

        else if($cat11 == 4 || $cat12 == 4)
        {
            echo 'Aama_Khasa();';
        }

        else if($cat11 == 6 || $cat12 == 6)
        {
            echo 'AamKhasa_subjCat6();';
        }

        else
            if($exam_type == 1){ 
                echo 'sub_grp_load_exam_type1();'; 
            }
            else if($exam_type == 2){

                if($grp_cd == 3 && $isper == 0){
                    echo'humanities_subjects();';
                }

                else if($grp_cd == 3 && $isper == 1){
                    echo'humanities_subjects_full();';
                }
                else{
                    echo 'sub_grp_load_MarksImp_FULL();';     
                }
            }
            else if($exam_type == 3 && $IsRegular == 1 && $class == 11 && $isParctialsub == 2){
                echo'Empty_All_Dropdowns();';
                echo'ClearALLDropDowns();';
            }

            else if($exam_type == 3 ){
                echo'sub_grp_load_exam_type3();';
            }

            else if($exam_type == 4){
                echo'sub_grp_load_exam_type4();';
            }

            else if(($exam_type == 16 || $exam_type == 15) && $cattype == 2 && ($grp_cd == 2 || $grp_cd == 4)){
                echo'sub_grp_load_additional_engSub();';
            }

            else if(($exam_type == 16 || $exam_type == 15) && $cattype == 2 && ($grp_cd != 2 || $grp_cd != 4)){
                echo'sub_grp_load_additional();';
            }

            else if($exam_type == 6){
                echo'sub_grp_load_exam_type6();';
            }
            else{
                echo'sub_grp_load();';
        }
        ?>

        /*.CHNAGE WORKS*/

        $("#religion").change(function() {

            debugger;

            var sel_group = $('#std_group').val();    
            var rel = $('#religion option:selected').val()
            var fullAppear = ($("#fullAppear").is(':checked'));

            if(rel == 1 && (sel_group != grp_cd || exam_type == 2)) {
                $('#sub3').empty();
                $("#sub3").append('<option value="92">ISLAMIC EDUCATION</option>'); 
            }

            if(rel == 2 && (sel_group != grp_cd || exam_type == 2)) {
                $('#sub3').empty();
                $("#sub3").append('<option value="92" selected = "selected">ISLAMIC EDUCATION</option>'); 
                $("#sub3").append('<option value="93">CIVICS FOR NON MUSLIM</option>'); 
            }

            if(rel == 2 && fullAppear == true){
                $('#sub3').empty();
                $("#sub3").append('<option value="92" selected = "selected">ISLAMIC EDUCATION</option>'); 
                $("#sub3").append('<option value="93">CIVICS FOR NON MUSLIM</option>');  
            }

            else if(rel == 1 && fullAppear == true){
                $('#sub3').empty();
                $("#sub3").append('<option value="92" selected = "selected">ISLAMIC EDUCATION</option>'); 
            }

        });                

        $('#std_group').change(function(){

            //debugger;

            var rel = $('#religion option:selected').val()
            $('#fullAppear').prop('checked', false);
            $(".isFull").hide();

            var sel_group = $('#std_group').val();    

            if(sel_group == grp_cd && exam_type != 2) 
            {
                if(exam_type == 4 || exam_type == 5 || exam_type == 6)
                {
                    $(".isFull").show();   
                }

                if(grp_cd != 3 )
                {
                    var loadGroup = 'sub_grp_load_exam_type'+exam_type;   
                    eval(loadGroup)();
                }
                else if(grp_cd == 3)
                {
                    sub_grp_load();    
                }
            }
            else if(sel_group == 0)
            {
                ClearALLDropDowns();
            }

            else if (sel_group == 1)
            {
                pre_medical_subjects();
            }
            else if(sel_group == 2)
            {
                pre_engineering_subjects();
            }
            else if(sel_group == 3)
            {
                humanities_subjects();
            }
            else if(sel_group == 4)
            {
                general_science_subjects();
            }
            else if(sel_group == 5)
            {
                commerce_subjects();
            } 

            if(rel == 2 && (sel_group != grp_cd || exam_type == 2))
            {
                $('#sub3').empty();
                $("#sub3").append('<option value="92" selected = "selected">ISLAMIC EDUCATION</option>'); 
                $("#sub3").append('<option value="93">CIVICS FOR NON MUSLIM</option>'); 
            }
        });

        $('#fullAppear').click(function() {

            var sel_group = $('#std_group').val();    

            if ($(this).is(':checked')) {

                if(sel_group == grp_cd && sel_group != 3) 
                {
                    sub_grp_load_All_Previous();
                }
                else if(sel_group == grp_cd && sel_group == 3) 
                {
                    humanities_subjects();
                }

                var rel = $('#religion option:selected').val()

                if((rel == 2) && (exam_type == 4 || exam_type == 5 ||exam_type == 6)){
                    $('#sub3').empty();
                    $("#sub3").append('<option value="92" selected = "selected">ISLAMIC EDUCATION</option>'); 
                    $("#sub3").append('<option value="93">CIVICS FOR NON MUSLIM</option>'); 
                }
            }

            else if (! $(this).is(':checked')) {

                if (sel_group == grp_cd) 
                {
                    Empty_All_Dropdowns();
                    sub_grp_load();
                }
            }

        });

        $('#ddlMarksImproveoptions').change(function(){
            var sel_cat = $('#ddlMarksImproveoptions').val();    
            if(sel_cat == 0){
                ClearALLDropDowns();
            }
            else if(sel_cat == 1){
                sub_grp_load_MarksImp_PI();
            }
            else if(sel_cat == 2){
                sub_grp_load__MarksImp_PII();
            }
            else if(sel_cat == 3){
                sub_grp_load_MarksImp_FULL();
            }
            else if(sel_cat == 4){
                sub_grp_load_MarksImp_Subj_wise();
            }

        });

        // Sub1 change event
        $("#sub1").change(function (){
            var sub1_p1 = $("#sub1").val();

            var grp_cd = $('#std_group').val();
            var pr_group = '<?php echo @$data[0]['grp_cd'] ?>';

            var cat11 = '<?php echo @$data[0]['cat11'] ?>';
            var cat12 = '<?php echo @$data[0]['cat12'] ?>';

            if((exam_type != '3') && (pr_group != 3) || (cat11 == 4 && cat12 == 4)) 
            {
                $("#sub1p2").val(sub1_p1);
            }
            else if(exam_type == 3 && grp_cd == 3){
                $("#sub1p2").val(sub1_p1);
            }

            else if(exam_type != 3  && grp_cd == 3){
                $("#sub1p2").val(sub1_p1);
            }

        });
        $("#sub1p2").change(function (){
            var sub1_p1 = $("#sub1p2").val();
            $("#sub1").val(sub1_p1);
        });
        // Sub2 change event
        $("#sub2").change(function (){
            
            //debugger;
            
            var sub1_p1 = $("#sub2").val();
            var grp_cd = $('#std_group').val();
            var pr_group = '<?php echo @$data[0]['grp_cd'] ?>';
            var cat11 = '<?php echo @$data[0]['cat11'] ?>';
            var cat12 = '<?php echo @$data[0]['cat12'] ?>';

            if((exam_type != '3') && (pr_group != 3) || (cat11 == 4 && cat12 == 4)) 
            {
                $("#sub2p2").val(sub1_p1);    
            }
            /*else if(exam_type == 3  && grp_cd == 3){
                $("#sub2p2").val(sub1_p1);    
            } */

            else if(exam_type != 3  && grp_cd == 3){
                $("#sub2p2").val(sub1_p1);    
            }

        });
        $("#sub2p2").change(function (){
            var sub1_p1 = $("#sub2p2").val();
            $("#sub2").val(sub1_p1);

        });
        // sub 4 change event 
        $("#sub4").change(function(){

            //debugger;

            var id4 =$("#sub4").val();
            var id4p2 =$("#sub4p2").val();
            var id5 =$("#sub5").val();
            var id5p2 =$("#sub5p2").val();
            var id6 =$("#sub6").val();
            var id6p2 =$("#sub6p2").val();

            var grp_cd = $('#std_group').val();
            var pr_group = '<?php echo @$data[0]['grp_cd'] ?>';
            var cat11 = '<?php echo @$data[0]['cat11'] ?>';
            var cat12 = '<?php echo @$data[0]['cat12'] ?>';


            if((exam_type != '3') && (pr_group != 3) || (cat11 == 4 && cat12 == 4)) 
            {
                $("#sub4p2").val(id4);
            }
            /*else if(exam_type == 3  && grp_cd == 3){
                $("#sub4p2").val(id4);
            }*/

            else if(exam_type != 3  && grp_cd == 3){
                $("#sub4p2").val(id4);
            }

            if((id4 != 0) && (id5 == id4)){
                alertify.error('Please Choose Different Subject');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }
            else if((id4 != 0) && (id6 == id4)){
                alertify.error('Please Choose Different Subject');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }

            // Double history and language //
            else if( (id5 == '55' || id5 == '56' || id5 == '57' || id5 == '58') && (id4 == '55' || id4 == '56' || id4 == '57' || id4 == '58') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }
            else if( (id6 == '55' || id6 == '56' || id6 == '57' || id6 == '58') && (id4 == '55' || id4 == '56' || id4 == '57' || id4 == '58') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }

            else if( (id4 == '24' || id4 == '27' || id4 == '32' || id4 == '34' || id4 == '37') && (id4 == '24' || id4 == '27' || id4 == '32' || id4 == '34' || id4 == '37') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }
            else if( (id4 == '24' || id4 == '27' || id4 == '32' || id4 == '34' || id4 == '37') && (id4 == '24' || id4 == '27' || id4 == '32' || id4 == '34' || id4 == '37') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }

        });
        $("#sub4p2").change(function(){
            var id4 =$("#sub4").val();
            var id4p2 =$("#sub4p2").val();
            var id5 =$("#sub5").val();
            var id5p2 =$("#sub5p2").val();
            var id6 =$("#sub6").val();
            var id6p2 =$("#sub6p2").val();
            $("#sub4").val(id4p2);
            if((id4p2 != 0) && (id5p2 == id4p2)){
                alertify.error('Please Choose Different Subject');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }
            else if((id4p2 != 0) && (id6p2 == id4p2)){
                alertify.error('Please Choose Different Subject');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }
            // Double history and language //
            else if( (id5p2 == '55' || id5p2 == '56' || id5p2 == '57' || id5p2 == '58') && (id4p2 == '55' || id4p2 == '56' || id4p2 == '57' || id4p2 == '58') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }
            else if( (id6p2 == '55' || id6p2 == '56' || id6p2 == '57' || id6p2 == '58') && (id4p2 == '55' || id4p2 == '56' || id4p2 == '57' || id4p2 == '58') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }

            else if( (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') && (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }
            else if( (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') && (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
                $("#sub4").val('0');
                $("#sub4p2").val('0'); 
            }
        });
        // sub 5 change event 
        $("#sub5").change(function(){

            var id4 =$("#sub4").val();
            var id4p2 =$("#sub4p2").val();
            var id5 =$("#sub5").val();


            var grp_cd = $('#std_group').val();
            var pr_group = '<?php echo @$data[0]['grp_cd'] ?>';

            var cat11 = '<?php echo @$data[0]['cat11'] ?>';
            var cat12 = '<?php echo @$data[0]['cat12'] ?>';

            if((exam_type != '3') && (pr_group != 3) || (cat11 == 4 && cat12 == 4)) 
            {
                var id5p2 =$("#sub5p2").val(id5);
            }

            /*else if(exam_type == 3 && grp_cd == 3){
                var id5p2 =$("#sub5p2").val(id5);
            }  */       

            else if(exam_type != 3  && grp_cd == 3){
                var id5p2 =$("#sub5p2").val(id5);
            }

            var id6 =$("#sub6").val();
            var id6p2 =$("#sub6p2").val();


            var sel_cat = $('#ddlMarksImproveoptions').val();    

            if(sel_cat == 4 && grp_cd == 5 && id5 != 0){
                $("#sub5p2").empty();
                $("#sub5p2").append('<option value="94">COMMERCIAL GEOGRAPHY</option>'); 
                $("#sub5p2").append('<option value="0">NONE</option>'); 
            }

            else if(sel_cat == 4 && grp_cd == 5 && id5 == 0){
                $("#sub5p2").empty();
                $("#sub5p2").append('<option value="0">NONE</option>'); 
                $("#sub5p2").append('<option value="94">COMMERCIAL GEOGRAPHY</option>'); 
            }

            else if((id5 !=0) && (id4 == id5)){
                alertify.error('Please Choose Different Subject');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            }
            else if((id5 !=0) && (id6 == id5)){
                alertify.error('Please Choose Different Subject');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            } 
            // Double language //
            else if( (id4 == '24' || id4 == '27' || id4 == '32' || id4 == '34' || id4 == '37') && (id5 == '24' || id5 == '27' || id5 == '32' || id5 == '34' || id5 == '37') ){
                alertify.error('Please Choose Different Subject');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            }

            else if( (id6 == '24' || id6 == '27' || id6 == '32' || id6 == '34' || id6 == '37') && (id5 == '24' || id5 == '27' || id5 == '32' || id5 == '34' || id5 == '37') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            }

            // Double History //
            else if( (id4 == '55' || id4 == '56' || id4 == '57' || id4 == '58') && (id5 == '55' || id5 == '56' || id5 == '57' || id5 == '58') ){
                alertify.error('Please Choose Different Subject');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            }

            else if( (id6 == '55' || id6 == '56' || id6 == '57' || id6 == '58')&& (id5 == '55' || id5 == '56' || id5 == '57' || id5 == '58') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            }

        });
        $("#sub5p2").change(function(){

            //debugger;

            var id4 =$("#sub4").val();
            var id4p2 =$("#sub4p2").val();
            var id5 =$("#sub5").val(id5p2);
            var id5p2 =$("#sub5p2").val();
            var id6 =$("#sub6").val();
            var id6p2 =$("#sub6p2").val();
            $("#sub5").val(id5p2);
            var grp_cd = $('#std_group').val();
            var sel_cat = $('#ddlMarksImproveoptions').val();  

            if(sel_cat == 4 && grp_cd == 5 && id5p2 != 0){
                $("#sub5").empty();
                $("#sub5").append('<option value="71">PRINCIPLES OF ECONOMICS</option>'); 
                $("#sub5").append('<option value="0">NONE</option>'); 
            }

            else if(sel_cat == 4 && grp_cd == 5 && id5p2 == 0){
                $("#sub5").empty();
                $("#sub5").append('<option value="0">NONE</option>'); 
                $("#sub5").append('<option value="71">PRINCIPLES OF ECONOMICS</option>'); 
            }

            else if((id5p2 !=0) && (id4p2 == id5p2)){
                alertify.error('Please Choose Different Subject');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            }
            else if((id5p2 !=0) && (id6p2 == id5p2)){
                alertify.error('Please Choose Different Subject');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            }
            // Double language //
            else if( (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') && (id5p2 == '24' || id5p2 == '27' || id5p2 == '32' || id5p2 == '34' || id5p2 == '37') ){
                alertify.error('Please Choose Different Subject');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            }
            else if( (id6p2 == '24' || id6p2 == '27' || id6p2 == '32' || id6p2 == '34' || id6p2 == '37') && (id5p2 == '24' || id5p2 == '27' || id5p2 == '32' || id5p2 == '34' || id5p2 == '37') ){
                alertify.error('Please Choose Different Subject');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            }

            // Double History //
            else if( (id4p2 == '55' || id4p2 == '56' || id4p2 == '57' || id4p2 == '58') && (id5p2 == '55' || id5p2 == '56' || id5p2 == '57' || id5p2 == '58') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            }

            else if( (id6p2 == '55' || id6p2 == '56' || id6p2 == '57' || id6p2 == '58')&& (id5p2 == '55' || id5p2 == '56' || id5p2 == '57' || id5p2 == '58') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
                $("#sub5").val('0');
                $("#sub5p2").val('0');
            }

        });
        // sub 6 change event
        $("#sub6").change(function(){

            var id4 =$("#sub4").val();
            var id4p2 =$("#sub4p2").val();
            var id5 =$("#sub5").val();
            var id5p2 =$("#sub5p2").val();
            var id6 =$("#sub6").val();

            var grp_cd = $('#std_group').val();
            var pr_group = '<?php echo @$data[0]['grp_cd'] ?>';

            var cat11 = '<?php echo @$data[0]['cat11'] ?>';
            var cat12 = '<?php echo @$data[0]['cat12'] ?>';

            if((exam_type != '3') && (pr_group != 3) || (cat11 == 4 && cat12 == 4)) 
            {
                var id6p2 =$("#sub6p2").val(id6);
            }
            /*else if(exam_type == 3 && grp_cd == 3){
                var id6p2 =$("#sub6p2").val(id6);
            } */

            else if(exam_type != 3  && grp_cd == 3){
                var id6p2 =$("#sub6p2").val(id6);
            }

            var sel_cat = $('#ddlMarksImproveoptions').val();    

            if(sel_cat == 4 && grp_cd == 5 && id6 != 0){
                $("#sub6p2").empty();
                $("#sub6p2").append('<option value="97">BUSINESS STATISTICS</option>'); 
                $("#sub6p2").append('<option value="0">NONE</option>'); 
            }

            else if(sel_cat == 4 && grp_cd == 5 && id6 == 0){
                $("#sub6p2").empty();
                $("#sub6p2").append('<option value="0">NONE</option>'); 
                $("#sub6p2").append('<option value="97">BUSINESS STATISTICS</option>'); 
            }

            else if((id6 !=0) && (id4 == id6)){
                alertify.error('Please Choose Different Subject');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }
            else if((id6 !=0) && (id5 == id6)){
                alertify.error('Please Choose Different Subject');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }
            // Double language //
            else if( (id4 == '24' || id4 == '27' || id4 == '32' || id4 == '34' || id4 == '37') && (id6 == '24' || id6 == '27' || id6 == '32' || id6 == '34' || id6 == '37') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }

            else if( (id5 == '24' || id5 == '27' || id5 == '32' || id5 == '34' || id5 == '37') && (id6 == '24' || id6 == '27' || id6 == '32' || id6 == '34' || id6 == '37') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }


            // Double History //
            else if( (id4 == '55' || id4 == '56' || id4 == '57' || id4 == '58') && (id6 == '55' || id6 == '56' || id6 == '57' || id6 == '58') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }

            else if( (id5 == '55' || id5 == '56' || id5 == '57' || id5 == '58') && (id6 == '55' || id6 == '56' || id6 == '57' || id6 == '58') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }

        });
        $("#sub6p2").change(function(){

            var id4 =$("#sub4").val();
            var id4p2 =$("#sub4p2").val();
            var id5 =$("#sub5").val();
            var id5p2 =$("#sub5p2").val();
            var id6 =$("#sub6").val(id6p2);
            var id6p2 =$("#sub6p2").val();

            $("#sub6").val(id6p2);

            var grp_cd = $('#std_group').val();
            var sel_cat = $('#ddlMarksImproveoptions').val();  

            if(sel_cat == 4 && grp_cd == 5 && id6p2 != 0){
                $("#sub6").empty();
                $("#sub6").append('<option value="80">BUSINESS MATH</option>'); 
                $("#sub6").append('<option value="0">NONE</option>'); 
            }

            else if(sel_cat == 4 && grp_cd == 5 && id6p2 == 0){
                $("#sub6").empty();
                $("#sub6").append('<option value="0">NONE</option>'); 
                $("#sub6").append('<option value="80">BUSINESS MATH</option>'); 
            }

            else if((id6p2 !=0) && (id4p2 == id6p2)){
                alertify.error('Please Choose Different Subject');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }
            else if((id6p2 !=0) && (id5p2 == id6p2)){
                alertify.error('Please Choose Different Subject');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }

            // Double language //
            else if( (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') && (id6p2 == '24' || id6p2 == '27' || id6p2 == '32' || id6p2 == '34' || id6p2 == '37') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }

            else if( (id5p2 == '24' || id5p2 == '27' || id5p2 == '32' || id5p2 == '34' || id5p2 == '37') && (id6p2 == '24' || id6p2 == '27' || id6p2 == '32' || id6p2 == '34' || id6p2 == '37') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }

            // Double History //
            else if( (id4p2 == '55' || id4p2 == '56' || id4p2 == '57' || id4p2 == '58') && (id6p2 == '55' || id6p2 == '56' || id6p2 == '57' || id6p2 == '58') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }

            else if( (id5p2 == '55' || id5p2 == '56' || id5p2 == '57' || id5p2 == '58') && (id6p2 == '55' || id6p2 == '56' || id6p2 == '57' || id6p2 == '58') ){
                alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
                $("#sub6").val('0');
                $("#sub6p2").val('0');
            }
        });

        $("#sub7").change(function(){

            var id7 =$("#sub7").val();
            var grp_cd = $('#std_group').val();
            var sel_cat = $('#ddlMarksImproveoptions').val();    

            if(sel_cat == 4 && grp_cd == 5 && id7 != 0){
                $("#sub7p2").empty();
                $("#sub7p2").append('<option value="95">BANKING</option>'); 
                $("#sub7p2").append('<option value="0">NONE</option>'); 
            }

            else if(sel_cat == 4 && grp_cd == 5 && id7 == 0){
                $("#sub7p2").empty();
                $("#sub7p2").append('<option value="0">NONE</option>'); 
                $("#sub7p2").append('<option value="95">BANKING</option>'); 
            }
        });
        $("#sub7p2").change(function(){
            var id7p2 =$("#sub7p2").val();
            var grp_cd = $('#std_group').val();
            var sel_cat = $('#ddlMarksImproveoptions').val();    

            if(sel_cat == 4 && grp_cd == 5 && id7p2 != 0){
                $("#sub7").empty();
                $("#sub7").append('<option value="39">PRINCIPLES OF COMMERCE</option>'); 
                $("#sub7").append('<option value="0">NONE</option>'); 
            }
            else if(sel_cat == 4 && grp_cd == 5 && id7p2 == 0){
                $("#sub7").empty();
                $("#sub7").append('<option value="0">NONE</option>'); 
                $("#sub7").append('<option value="39">PRINCIPLES OF COMMERCE</option>'); 
            }
        });
    });

    function checks_12th_Private()
    {
        $('#btnsubmitUpdateEnrol').attr("disabled", "disabled");
        var status  =  check_NewEnrol_validation();
        if(status == 0)
        {
            $('#btnsubmitUpdateEnrol').removeAttr("disabled");
            return false;    
        }
        else
        {
            $('#btnsubmitUpdateEnrol').attr("disabled", "disabled");

            $.ajax({
                type: "POST",
                url: "<?php  echo site_url('Admission/frmvalidation'); ?>",
                data: $("#myform").serialize() ,
                datatype : 'html',

                success: function(data)
                {                    
                    var obj = JSON.parse (data);
                    if(obj.excep == 'Success')
                    {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>" + "Admission/NewEnrolment_insert/",
                            data: $("#myform").serialize() ,
                            datatype : 'html',


                            beforeSend: function() {  $('.mPageloader').show(); },
                            complete: function() { $('.mPageloader').hide();},

                            success: function(data) 
                            {
                                var obj = JSON.parse(data) ;
                                if(obj.error ==  1)
                                {
                                    window.location.href ='<?php echo base_url(); ?>Admission/formdownloaded/'+obj.formno; 
                                    alertify.success('Your admission has been submitted successfully');
                                }
                                else
                                {
                                    alertify.error(obj.error);
                                    $('#btnsubmitUpdateEnrol').removeAttr("disabled");
                                    return false; 
                                }
                            },
                            error: function(request, status, error){

                                alertify.error(request.responseText);
                                $('#btnsubmitUpdateEnrol').removeAttr("disabled");
                            }
                        });
                        return false
                    }
                    else
                    {
                        alertify.error(obj.excep);
                        $('#btnsubmitUpdateEnrol').removeAttr("disabled");
                        return false;     
                    }
                }
            });
            return false;   
        } 
    }

    function CancelAlert(){
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                window.location.href ='<?php echo base_url(); ?>Admission/index';
            } else {
            }
        });
    }

    jQuery(document).ready(function () {
        $(document.getElementById("bay_form")).mask("99999-9999999-9", { placeholder: "_" });
        $(document.getElementById("father_cnic")).mask("99999-9999999-9", { placeholder: "_" });
        $(document.getElementById("mob_number")).mask("9999-9999999", { placeholder: "_" });
    });
    var max_file_size             = 20000; //allowed file size. (1 MB = 1048576)
    var allowed_file_types         = ['image/jpeg', 'image/pjpeg']; //allowed file types
    var result_output             = '#output'; //ID of an element for response output
    var my_form_id                 = '#upload_form'; //ID of an element for response output
    var progress_bar_id         = '#progress-wrp'; //ID of an element for response output
    var total_files_allowed     = 1; //Number files allowed to upload

    $(function() {
        $("input:file").change(function (event){

            event.preventDefault();
            var proceed = true; //set proceed flag
            var error = [];    //errors
            var total_files_size = 0;

            //reset progressbar
            $(progress_bar_id +" .progress-bar").css("width", "0%");
            $(progress_bar_id + " .status").text("0%");

            if(!window.File && window.FileReader && window.FileList && window.Blob){ //if browser doesn't supports File API
                alertify.error("Your browser does not support new File API! Please upgrade."); //push error text
            }else{
                var total_selected_files = this.files.length; //number of files

                //limit number of files allowed
                if(total_selected_files > total_files_allowed){
                    alertify.error( "You have selected "+total_selected_files+" file(s), " + total_files_allowed +" is maximum!"); //push error text
                    proceed = false; //set proceed flag to false
                }
                //iterate files in file input field
                $(this.files).each(function(i, ifile){
                    if(ifile.value !== ""){ //continue only if file(s) are selected
                        if(allowed_file_types.indexOf(ifile.type) === -1){ //check unsupported file
                            alertify.error( "<b>"+ ifile.name + "</b> is unsupported file type!"); //push error text
                            proceed = false; //set proceed flag to false
                        }

                        total_files_size = total_files_size + ifile.size; //add file size to total size
                    }
                });


                //if total file size is greater than max file size
                if(total_files_size > max_file_size && proceed == true){ 
                    alertify.error( "Allowed size is 20 KB, Try smaller file!"); //push error text
                    proceed = false; //set proceed flag to false
                }

                //  var submit_btn  = $(this).find("input[type=submit]"); //form submit button    

                //if everything looks good, proceed with jQuery Ajax
                if(proceed){
                    //submit_btn.val("Please Wait...").prop( "disabled", true); //disable submit button
                    var form_data = new FormData( $('form')[0]); //Creates new FormData object
                    var post_url = '<?= base_url()?>Admission/uploadpic'; //get action URL of form

                    //jQuery Ajax to Post form data
                    $.ajax({
                        url : post_url,
                        type: "POST",
                        data : form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        xhr: function(){
                            //upload Progress
                            var xhr = $.ajaxSettings.xhr();
                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', function(event) {
                                    var percent = 0;
                                    var position = event.loaded || event.position;
                                    var total = event.total;
                                    if (event.lengthComputable) {
                                        percent = Math.ceil(position / total * 100);
                                    }
                                    //update progressbar
                                    $(progress_bar_id +" .progress-bar").css("width", + percent +"%");
                                    $(progress_bar_id + " .status").text(percent +"%");
                                    }, true);
                            }
                            return xhr;
                        },
                        mimeType:"multipart/form-data"
                    }).done(function(res){ //
                        // $(my_form_id)[0].reset(); //reset form
                        $(result_output).html(res); //output response from server
                        // submit_btn.val("Upload").prop( "disabled", false); //enable submit button once ajax is done
                    });

                }
            }

            $(result_output).html(""); //reset output 
            $(error).each(function(i){ //output any error to output element
                $(result_output).append('<div class="error">'+error[i]+"</div>");
            });
        });
    });

</script>