
<style type="text/css">
    h4{
        text-decoration: underline;
    }
</style>
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
                        <form class="form-horizontal no-margin" method="post" enctype="multipart/form-data" name="newfrom" id="newfrom">
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <?php
                                    if($data[0]["IntBrd_cd"] == 1)
                                    {
                                        @$image_path_selected = $data[0]['picpath']; 
                                        @$type = pathinfo(@$image_path_selected, PATHINFO_EXTENSION);
                                    }
                                    else
                                    {
                                        @$image_path_selected =  DIRPATHOTHER.'/'.$data[0]["coll_cd"].'/'.$data[0]["picpath"]; 
                                        @$type = pathinfo($image_path_selected, PATHINFO_EXTENSION); 
                                    }
                                    @$image_path_selected = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($image_path_selected));      
                                    ?>
                                    <img id="previewImg" class="offset4" style="height: 130px; width: 130px;" src="<?php echo @$image_path_selected;?>" alt="Candidate Image" />
                                    <input type="hidden" value="<?php echo  $data['0']['picpath']?>" name="pic">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <h4 class="span4 offset4">Personal Information</h4>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <label class="control-label span2" for="cand_name">
                                        Candidate Name :
                                    </label>
                                    <input class="span2" type="text" id="cand_name" readonly="readonly" name="cand_name" placeholder="Candidate Name" maxlength="60"  value="<?php   echo  $data['0']['name']; ?>" >
                                    <label class="control-label span2" for="father_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span2" id="father_name" name="father_name" readonly="readonly" style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" value="<?php echo  $data['0']['Fname']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?> required="required">
                                </div>
                            </div>       
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <label class="control-label span2" for="bay_form">
                                        Bay Form No :
                                    </label>
                                    <input class="span2" type="text" id="bay_form" name="bay_form" placeholder="Bay Form No." value="<?php echo  $data['0']['BForm']; ?>" required="required" >
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span2" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1" value="<?php echo  $data['0']['FNIC']; ?>" readonly  required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <label class="control-label span2" for="mob_number">
                                        Mobile Number :
                                    </label>
                                    <input class="span2" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789" value="<?php  echo  $data['0']['MobNo']; ?>" required="required">
                                    <label class="control-label span2" for="Inst_Rno">
                                        Class Roll No :
                                    </label> 
                                    <input class="span2" id="Inst_Rno" type="text" name="Inst_Rno" value="<?php echo  $data['0']['classRno']; ?>" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <label class="control-label span2" for="medium">
                                        MEDIUM:
                                    </label>
                                    <select id="medium" class="dropdown span2" name="medium">
                                        <?php 
                                        $med = $data['0']['med'] ;

                                        if($med == 1)
                                        {
                                            echo  "<option value='1' selected='selected'>Urdu</option> 
                                            <option value='2'>English</option>";
                                        }
                                        else
                                        {
                                            echo  "<option value='1'>Urdu</option>
                                            <option value='2' selected='selected'>English</option>";
                                        }
                                        ?>
                                    </select>
                                    <label class="control-label span2" for="speciality">
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span2 text-uppercase" name="speciality">
                                        <?php 
                                        $spec = $data['0']['Spec'] ;

                                        if($spec == 0)
                                        {
                                            echo  "<option value='0' selected='selected'>None</option><option value='1'>Disabled</option>";
                                            if(Session == 1){
                                                echo"<option value='2'>Board Employee</option>";
                                            }
                                        }
                                        else if($spec == 1)
                                        {
                                            echo  "<option value='0' >None</option>  <option value='1' selected='selected'>Disabled</option>";
                                            if(Session == 1){
                                                echo"<option value='2'>Board Employee</option>";
                                            }
                                        }
                                        else if($spec == 2){
                                            echo  "<option value='0' >None</option>  <option value='1' >Disabled</option>";                                           
                                            if(Session == 1){
                                                echo"<option value='2'>Board Employee</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <label class="control-label span2" for="MarkOfIden">
                                        Identification Mark:
                                    </label>
                                    <input class="span2 text-uppercase" type="text" id="MarkOfIden" name="MarkOfIden" value="<?php echo  $data['0']['markOfIden']; ?>" required="required" maxlength="60" >
                                    <label class="control-label span2" for="CollGrade">
                                        College Grade:
                                    </label>
                                    <input class="span2 text-uppercase" type="text" id="CollGrade" name="CollGrade" value="" required="required" maxlength="2">
                                </div>
                            </div> 

                            <div class="control-group">
                                <div class="controls controls-row">  
                                    <label class="control-label span2" for="nationality">
                                        Nationality :
                                    </label>
                                    <select name="nationality" class="span2 text-uppercase" id="nationality"> 
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
                                    <label class="control-label span2" for="gender1">
                                        Gender :
                                    </label> 
                                    <select name="gender" class="span2 text-uppercase" id="gender" disabled="disabled"> 
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
                                    <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                                    <input type="hidden" name="gend" value="<?php echo $gender; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls controls-row"> 
                                    <label class="control-label span2" >
                                        Hafiz-e-Quran :
                                    </label>
                                    <select name="hafiz" class="span2 text-uppercase" id="hafiz"> 
                                        <option value='1'>NO</option> 
                                        <option value='2'>YES</option> 
                                    </select>

                                    <label class="control-label span2" >
                                        Religion :
                                    </label> 
                                    <select name="religion" class="span2 text-uppercase" id="religion"> 
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
                            <div class="control-group">
                                <div class="controls controls-row">  
                                    <label class="control-label span2" >
                                        Locality :
                                    </label>

                                    <select name="UrbanRural" class="span6 text-uppercase" id="UrbanRural"> 
                                        <?php
                                        $resid = $data[0]['ruralOrurban'];
                                        if($resid == 1)
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
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <label class="control-label span2" >
                                        Address :
                                    </label>
                                    <textarea rows="5"  id="address" class="span6 text-uppercase" name="address" required="required"><?php
                                        echo $data[0]['addr'];
                                    ?></textarea>
                                </div>
                            </div>
                            <div class="pull-right"  id="instruction">
                                <img src="<?php echo base_url(); ?>assets/img/Instruction.jpg" class="img-responsive" alt="instructions.jpg">
                            </div>
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <h4 class="span4 offset4">Examination Information</h4>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <label class="control-label span2 " >
                                        Study Group :
                                    </label>
                                    <select id="std_group" class="dropdown span6 text-uppercase"  name="std_group" disabled="disabled">
                                        <?php
                                        $grp = $data[0]['grp_cd'];
                                        $sub7 = $data[0]["sub7"];
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

                                                else if($subgroups[$i] == 7)
                                                {
                                                    if($grp == 7)
                                                    {
                                                        echo "<option value='7' selected='selected'>HOME ECONOMICS</option>";  
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='7'>HOME ECONOMICS</option>";  
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
                                <div class="control row controls-row">
                                    <label class="control-label span2 offset3" id="lblpart1cat" name="lblpart1cat" >
                                        PART-I Subjects
                                    </label>
                                    <label class="control-label span2 " id="lblpart2cat" name="lblpart2cat" >
                                        PART-II Subjects
                                    </label>
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1 offset3"></label>
                                    <select id="sub1" class="span2 dropdown text-uppercase" name="sub1">
                                        <?php if($data[0]['sub1pf1']==2){ ?>
                                            <option value="<?php  echo $data[0]['sub1'];?>"><?php
                                                echo array_search($data[0]['sub1'],$subarray);
                                            ?></option>
                                            <?php }
                                        if($data[0]['status']!=4){
                                            ?>
                                            <option value="0">NONE</option>
                                            <?php
                                        }
                                        ?>
                                    </select> 
                                    <select id="sub1p2" class="span2 dropdown text-uppercase" name="sub1p2">
                                        <option value="<?php echo $data[0]['sub1'];?>"><?php
                                            echo array_search($data[0]['sub1'],$subarray);
                                        ?></option>
                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1 offset3"></label>
                                    <select id="sub2"  name="sub2" class="span2 dropdown text-uppercase">
                                        <?php if($data[0]['sub2pf1']==2){ ?>
                                            <option value="<?php echo $data[0]['sub2'];?>"><?php
                                                echo array_search($data[0]['sub2'],$subarray);
                                            ?></option>
                                            <?php }
                                        if($data[0]['status']!=4){
                                            ?>
                                            <option value="0">NONE</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <select id="sub2p2" class="span2 dropdown" name="sub2p2">
                                        <option value="<?php echo $data[0]['sub2'];?>"><?php
                                            echo array_search($data[0]['sub2'],$subarray);
                                        ?></option>
                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1 offset3"></label>
                                    <select id="sub3" class="span2 dropdown text-uppercase" name="sub3">
                                        <?php if($data[0]['sub3pf1']==2){ ?>
                                            <option value="<?php echo $data[0]['sub3'];?>"><?php
                                                echo array_search($data[0]['sub3'],$subarray);
                                            ?></option>
                                            <?php }
                                        else{
                                            ?>
                                            <option value="0">NONE</option>
                                            <?php
                                        }
                                        ?>
                                    </select> 
                                    <select id="sub3p2" class="span2 dropdown text-uppercase" name="sub3p2">
                                        <option value="<?php echo $data[0]['sub8'];?>"><?php
                                            echo array_search($data[0]['sub8'],$subarray);
                                        ?></option>
                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1 offset3"></label>
                                    <select id="sub4"  name="sub4" class="span2 dropdown text-uppercase">
                                        <?php if($data[0]['sub4pf1']==2){ ?>
                                            <option value="<?php echo $data[0]['sub4'];?>"><?php
                                                echo array_search($data[0]['sub4'],$subarray);
                                            ?></option>
                                            <?php }
                                        if($data[0]['status']!=4){
                                            ?>
                                            <option value="0">NONE</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <select id="sub4p2" class="span2 dropdown text-uppercase" name="sub4p2">
                                        <option value="<?php echo $data[0]['sub4'];?>"><?php
                                            echo array_search($data[0]['sub4'],$subarray);
                                        ?></option>
                                    </select> 
                                </div>

                                <div class="control row controls-row">
                                    <label class="control-label span1 offset3"></label>
                                    <select id="sub5" class="span2 dropdown text-uppercase" name="sub5" selected="selected">
                                        <?php if($data[0]['sub5pf1']==2){ ?>
                                            <option value="<?php echo $data[0]['sub5'];?>"><?php
                                                echo array_search($data[0]['sub5'],$subarray);
                                            ?></option>
                                            <?php }
                                        if($data[0]['status']!=4){
                                            ?>
                                            <option value="0">NONE</option>
                                            <?php
                                        }
                                        ?>
                                    </select> 
                                    <select id="sub5p2" class="span2 dropdown text-uppercase" name="sub5p2" selected="selected">
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
                                    <label class="control-label span1 offset3"></label>
                                    <select id="sub6"  name="sub6" class="span2 dropdown text-uppercase" selected="selected">
                                        <?php if($data[0]['sub6pf1']==2){ ?>
                                            <option value="<?php echo $data[0]['sub6'];?>"><?php
                                                echo array_search($data[0]['sub6'],$subarray);
                                            ?></option>
                                            <?php } 
                                        if($data[0]['status']!=4){
                                            ?>
                                            <option value="0">NONE</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <select id="sub6p2"  name="sub6p2" class="span2 dropdown text-uppercase" selected="selected">
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

                                if($grp==5)
                                { ?>
                                    <div class="control row controls-row">
                                        <label class="control-label span1 offset3"></label>
                                        <select id="sub7" class="span2 dropdown text-uppercase" name="sub7" selected="selected">
                                            <?php 
                                            if($data[0]['sub7pf1']==2){ ?>
                                                <option value="<?php echo $data[0]['sub7'];?>"><?php
                                                    echo array_search($data[0]['sub7'],$subarray);
                                                ?></option>
                                                <?php } 
                                            if($data[0]['status']!=4){
                                                ?>
                                                <option value="0">NONE</option>
                                                <?php
                                            }
                                            ?>
                                        </select> 
                                        <select id="sub7p2" class="span2 dropdown text-uppercase" name="sub7p2" selected="selected">

                                            <option value="<?php echo '0';?>"><?php
                                                echo array_search(0,$subarray);
                                            ?></option>

                                            <option value="<?php echo '95';?>"><?php
                                                echo array_search(95,$subarray);
                                            ?></option>
                                            <option value="<?php echo '98';?>"><?php
                                                echo array_search(98,$subarray);
                                            ?></option>
                                            <?php }?>
                                    </select> 
                                </div> 
                            </div>
                            <div class="form-actions no-margin">
                                <input type="hidden"   value="<?php  echo  $data[0]['FormNo']; ?>"  name="formNo">
                                <input type="hidden"   value="<?php  echo  $isReAdm; ?>"  name="IsReAdm">
                                <input type="hidden"   value="<?php  echo $data[0]['rno']; ?>"  name="OldRno">
                                <input type="hidden"   value="<?php echo   $data[0]['Iyear'];  ?>"  name="Oldyear">
                                <input type="hidden"   value="<?php echo   $data[0]['sess'];  ?>"  name="Oldsess">
                                <input type="hidden"   value="<?php echo   $data[0]['Brd_cd'];  ?>"  name="Oldbrd">
                                <input type="hidden"   value="<?php echo   $data[0]['IntBrd_cd'];  ?>"  name="IntBrd_cd">
                                <input type="hidden"   value="<?php echo   $gender;  ?>"  name="sex">
                                <input type="hidden"   value="<?php  echo  $data['0']['name']; ?>"  name="cand_name_hidden">
                                <input type="hidden"   value="<?php  echo  $data['0']['Fname']; ?>"  name="father_name_hidden">
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
                                <input type="hidden"   value="<?php  echo $data['0']['schm']; ?>"  name="oldschm" id="oldschm">
                            </div>
                            <div class="control-group">
                                <div class="control row controls-row">
                                    <button type="submit" onclick="return checks_12th_Regular()" name="btnsubmitUpdateEnrol" id="btnsubmitUpdateEnrol" class="btn btn-large btn-info span3 offset3">Save Form</button>
                                    <input type="button" class="btn btn-large btn-danger span3" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
                                </div>
                            </div>
                        </form>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $.fancybox("#instruction");
                            });
                            function checks_12th_Regular(){

                                $('#btnsubmitUpdateEnrol').attr("disabled", "disabled");
                                var status  =  check_NewEnrol_validation_regular();

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
                                        url: "<?php  echo site_url('Admission_inter/frmvalidation'); ?>",
                                        data: $("#newfrom").serialize() ,
                                        datatype : 'html',
                                        cache:false,

                                        beforeSend: function() {  $('.mPageloader').show(); },
                                        complete: function() { $('.mPageloader').hide();},

                                        success: function(data)
                                        {              
                                            var obj = JSON.parse (data);

                                            if(obj.excep == 'Success')
                                            {
                                                $.ajax({

                                                    type: "POST",
                                                    url: "<?php echo base_url(); ?>" + "Admission_inter/NewEnrolment_INSERT_inter/",
                                                    data: $("#newfrom").serialize() ,
                                                    datatype : 'html',
                                                    cache:false,

                                                    beforeSend: function() {  $('.mPageloader').show(); },
                                                    complete: function() { $('.mPageloader').hide();},

                                                    success: function(data){
                                                        var obj = JSON.parse(data);
                                                        if(obj.error ==  "1")
                                                        {
                                                            window.location.href ='<?php echo base_url(); ?>Admission_inter/EditForms'
                                                            alertify.success("Data Saved Successfully");
                                                            return true;
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

                                                return false;

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
                            function CancelAlert()
                            {
                                var msg = "Are You Sure You want to Cancel this Form ?"
                                alertify.confirm(msg, function (e) {
                                    if (e) {
                                        // user clicked "ok"
                                        window.location.href ='<?php echo base_url(); ?>Admission_inter/StudentsData';
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