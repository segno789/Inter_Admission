
<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            Personal Information<a id="redgForm" data-original-title=""></a>
                        </div>
                    </div>
                    <div class="widget-body" >
                        <form class="form-horizontal no-margin" action="<?php  echo base_url(); ?>/index.php/Admission/NewEnrolment_insert_Languages" method="post" enctype="multipart/form-data" name="myform" id="myform">
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <label class="control-label span2" >
                                    </label> 
                                    <img id="image_upload_preview" style="width:140px; height: 140px;" src="<?php echo base_url().GET_PRIVATE_IMAGE_PATH.$data[0]['picpath'];?>" alt="Candidate Image" />
                                    <input type="hidden" id="pic" name="pic"  value="<?php echo $data[0]['picpath']?>"/>    
                                </div>
                            </div>
                            <div class="controls controls-row">
                                <!--<input type='file' id="inputFile" disabled="disabled"onchange="return ValidateFileUpload(this);"/>-->
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name:
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3"  type="text" id="cand_name" style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" maxlength="60" readonly="readonly"  value="<?php echo $data[0]['name']; ?>">
                                    <label class="control-label span2" for="lblfather_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span3" id="father_name" name="father_name" style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" readonly="readonly" value="<?php echo  $data['0']['fname']; ?>" required="required">
                                </div>
                            </div>
                         
                          
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Mark Of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="MarkOfIden" style="text-transform: uppercase;" name="MarkOfIden" value="<?php  echo  $data['0']['IdentMark']; ?>" required="required" maxlength="60" >
                                    <label class="control-label span2" >
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789" value="<?php echo  $data['0']['MobNo']; ?> " required="required">
                                </div>
                            </div>
                            <div class="control-group">
                               
                                <div class="controls controls-row">  
                                    <label class="control-label span1" style="margin-left: -100px;" for="gender1">
                                        Gender :
                                    </label> 
                                    <?php

                                    $gender = $data[0]['sex'];

                                    if($gender == 1)
                                    {
                                        echo 
                                        "<label class='radio inline span1'><input type='radio' id='gender1' value='1' checked='checked'  disabled='disabled' name='gender'> Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  name='gender'  disabled='disabled'> Female </label> " ;
                                    }
                                    else if ($gender == 2)
                                    {
                                        echo 
                                        "<label class='radio inline span1'><input type='radio' id='gender1' value='1'  disabled='disabled' name='gender'> Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  checked='checked'  disabled='disabled'  name='gender'> Female </label> " ;
                                    }
                                    ?>
                                    <input type="hidden" name="gend" value="<?php echo $gender; ?>">
                                </div>
                            </div>
                          
                            <div class="control-group">
                          
                            <div class="control-group" style="margin-top: 50px;">
                                <label class="control-label span1" >
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px; text-transform: uppercase;"  id="address" class="span8" name="address" required="required"><?php
                                        echo $data[0]['address'];
                                    ?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="control-group">
                                <h4 class="span4">Old Exam Information :</h4>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Rno :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" readonly="readonly" id="oldrno" style="text-transform: uppercase;" name="oldrno" value="<?php  echo  $data['0']['rno']; ?>" required="required" maxlength="60" >
                                    <label class="control-label span2" >
                                        Year:
                                    </label> 
                                    <input type="text" class="span3" name="oldyear" id = "oldyear" readonly="readonly" value="<?php  echo $data['0']['Iyear']; ?>"/> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Session :
                                </label>
                                <div class="controls controls-row">
                                    <input type="text" class="span3" id="oldsess" name="oldsess" readonly="readonly" value="<?php echo $data['0']['Sess'] == 1 ? "Annual" :"Supplementary"; ?>"/> 
                                    <label class="control-label span2" >
                                        Board:
                                    </label> 
                                    <input type="text" class="span3" id="oldboard" name="oldboard" readonly="readonly" value="<?php echo $data[0]['brd_name'];?>"/>     
                                      
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
                            <div id="instruction" style="display:none; width:700px" >
                                  <img src="<?php  echo base_url().'assets/img/Instruction.jpg'; ?>" border="0" width="950" height="773" alt="Instruction.jpg (152,412 bytes)">
                            </div>
                            <hr>
                            <div class="control-group">
                                <h4 class="span3" style="margin-left: -73px;">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <label class="control-label span2"></label> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Study Group :
                                </label>
                                <div class="controls controls-row">
                                    <select id="std_group" class="dropdown span6"  name="std_group">
                                        <?php
                                        //DebugBreak();
                                        $grp_cd = $data[0]['grp_cd'];
                                        $chance = $data[0]['chance'];
                                        $exam_type = $data[0]['exam_type'];
                                        $status = $data[0]['status'];
                                        if($exam_type == 1  || $exam_type == 3 || $exam_type == 9 || $exam_type == 11 || $exam_type == 16 || $exam_type == 14 || $exam_type == 15){
                                            if($grp_cd == 1){
                                               echo "<option value='1' selected='selected'>FAZAL ARABIC </option>";      
                                            }
                                            else if ($grp_cd == 2){
                                                   echo "<option value='2' selected='selected'>FAZAL URDU</option>";
                                            }

                                            else if ($grp_cd == 3){
                                                  echo "<option value='3' selected='selected'>FAZAL PUNJABI</option>";   
                                            }
                                            else if($grp_cd == 5){
                                                echo "<option value='5' selected='selected'>ADEEB ARABIC</option>";  
                                            }
                                            else if($grp_cd == 6){
                                                 echo "<option value='6'  selected='selected'> ADEEB URDU</option>";             
                                            }
                                        }

                                       /* else if($exam_type == 2){
                                            echo "<option value='0'>SELECT GROUP</option>";
                                            echo "<option value='3'>HUMANITIES</option>";
                                            echo "<option value='5'>COMMERCE</option>"; 
                                            
                                            1    FAZAL ARABIC        
                                            2    FAZAL URDU          
                                            3    FAZAL PUNJABI       
                                            5    ADEEB ARABIC        
                                            6    ADEEB URDU          
                                            10    ALIM URDU           
                                            7    ADEEB PUNJABI       
                                            9    ALIM ARABIC         
                                            8    ADEEB PERSIAN       
                                            11    FAZAL PERSIAN       
                                            12    ALIM PERSIAN   
                                        } */

                                        if( ($exam_type == 2) || $exam_type == 4 ){
                                            if($grp_cd == 1){
                                                echo "<option value='1' selected='selected'>FAZAL ARABIC </option>";      
                                                echo "<option value='2'>FAZAL URDU</option>";
                                                echo "<option value='3'>FAZAL PUNJABI</option>";    
                                                echo "<option value='5'>ADEEB ARABIC</option>";    
                                                echo "<option value='6'> ADEEB URDU</option>";    
                                            }
                                            else if ($grp_cd == 2){
                                                  echo "<option value='1' >FAZAL ARABIC </option>";      
                                                echo "<option value='2' selected='selected'>FAZAL URDU</option>";
                                                echo "<option value='3'>FAZAL PUNJABI</option>";    
                                                echo "<option value='5'>ADEEB ARABIC</option>";    
                                                echo "<option value='6'> ADEEB URDU</option>";  
                                            }
                                            else if ($grp_cd == 3){
                                                echo "<option value='1' >FAZAL ARABIC </option>";      
                                                echo "<option value='2' >FAZAL URDU</option>";
                                                echo "<option value='3' selected='selected'>FAZAL PUNJABI</option>";    
                                                echo "<option value='5'>ADEEB ARABIC</option>";    
                                                echo "<option value='6'> ADEEB URDU</option>";  
                                            }
                                            else if($grp_cd == 5){
                                                echo "<option value='1' >FAZAL ARABIC </option>";      
                                                echo "<option value='2' >FAZAL URDU</option>";
                                                echo "<option value='3' >FAZAL PUNJABI</option>";    
                                                echo "<option value='5' selected='selected'>ADEEB ARABIC</option>";    
                                                echo "<option value='6'> ADEEB URDU</option>";  
                                            }
                                            else if($grp_cd == 6){
                                                  echo "<option value='1' >FAZAL ARABIC </option>";      
                                                echo "<option value='2' >FAZAL URDU</option>";
                                                echo "<option value='3' >FAZAL PUNJABI</option>";    
                                                echo "<option value='5'>ADEEB ARABIC</option>";    
                                                echo "<option value='6'  selected='selected'> ADEEB URDU</option>";    
                                            }
                                        }

                                        $subarray = array(
                                            'NONE'=>'',
                                            'PAPER-I'=>'1',
                                            'PAPER-II'=>'2',
                                            'PAPER-III'=>'3',
                                            'PAPER-IV'=>'4',
                                            'PAPER-V'=>'5',
                                            'PAPER-VI'=>'6'
                                            
                                            
                                        );
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

                           

                            <div class="control-group">
                                <div class="control row controls-row">
                                    <label class="control-label span3 " id="lblpart1cat" name="lblpart1cat" style="text-decoration: underline; font-weight: bold;" >
                                        <?php
                                        echo'Languages Subjects';
                                        ?>
                                    </label>
                                    <label class="control-label span3 " id="lblpart2cat" name="lblpart2cat" style="text-decoration: underline; font-weight: bold;" >
                                        <?php
                                      echo  '';
                                        ?>
                                    </label>
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub1" class="span3 dropdown" name="sub1">
                                        <option value="2"></option>
                                    </select> 
                                  
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                    </select>
                                         
                                  </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >
                                    </label>
                                    <select id="sub3" class="span3 dropdown" name="sub3">

                                    </select> 
                                   
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub4"  name="sub4" class="span3 dropdown">

                                    </select>
                                   
                                </div>

                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub5" class="span3 dropdown" name="sub5" selected="selected">
                                    </select> 
                                   
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub6"  name="sub6" class="span3 dropdown" selected="selected">

                                    </select>
                                    
                                </div>
                               
                            </div>
                           
                            <input type="hidden" name="exam_type"  id="exam_type"  value="<?php echo @$exam_type = $data[0]['exam_type']; ?>">
                            <input type="hidden" name="exam_type"  id="exam_type"  value="<?php echo @$isaloom = $data['isaloom']; ?>">
                            <input type="hidden" name="pregrp"     id="pregrp"     value="<?php echo @$pregrp = $data[0]['grp_cd']; ?>">
                            <input type="hidden" name="oldboardid" id="oldboardid" value="<?php   echo @$data['board'];?>"/>
                            <input type="hidden" name="matRno_hidden" id="matRno_hidden" value="<?php   echo @$data[0]['matrno'];?>"/>
                            <input type="hidden" name="InterRno_hidden" id="InterRno_hidden" value="<?php   echo @$data[0]['rno'];?>"/>
                            <input type="hidden" name="InterYear_hidden" id="InterYear_hidden" value="<?php   echo @$data[0]['Iyear'];?>"/>
                            <input type="hidden" name="InterSess_hidden" id="InterSess_hidden" value="<?php   echo @$data['0']['Sess'];?>"/>
                            <input type="hidden" name="cattype_hidden" id="cattype_hidden" value="<?php   echo  @$cattype;?>"/>
                            <input type="hidden" name="sub1pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub1pf1'];?>"/>
                            <input type="hidden" name="sub2pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub2pf1'];?>"/>
                            <input type="hidden" name="sub3pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub3pf1'];?>"/>
                            <input type="hidden" name="sub4pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub4pf1'];?>"/>
                            <input type="hidden" name="sub5pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub5pf1'];?>"/>
                            <input type="hidden" name="sub6pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub6pf1'];?>"/>
                            <input type="hidden" name="sub7pf1_hidden" id="sub1pf1_hidden" value="<?php   echo  @$data[0]['sub7pf1'];?>"/>
                           
                            <input type="hidden" name="sub1st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub1st1'];?>"/>
                            <input type="hidden" name="sub2st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub2st1'];?>"/>
                            <input type="hidden" name="sub3st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub3st1'];?>"/>
                            <input type="hidden" name="sub4st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub4st1'];?>"/>
                            <input type="hidden" name="sub5st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub5st1'];?>"/>
                            <input type="hidden" name="sub6st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub6st1'];?>"/>
                            <input type="hidden" name="sub7st1_hidden" id="sub1st1_hidden" value="<?php   echo  @$data[0]['sub7st1'];?>"/>
                           
                        

                            <div class="span6">
                                <button type="submit" onclick="return checks()" name="btnsubmitUpdateEnrol" class="btn btn-large btn-info offset2">
                                    Save Form
                                </button>
                                <a href="<?php echo base_url(); ?>assets/img/Instruction.jpg" download="FileName" class="btn btn-large btn-info" >Download Instruction</a>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
                                <div class="clearfix">   
                                </div>
                            </div> 
                        </form>
                        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

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

                            $(document).ready(function(){
                                        $.fancybox("#instruction");
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

                           

                                var grp_cd ="<?php if(@$data[0]['exam_type']=="3"){ echo 0; } else{echo  @$data[0]['grp_cd'];}  ?>";
                                var sub1 ="<?php echo @$data[0]['sub1']; ?>";
                                var sub2 = "<?php echo @$data[0]['sub2']; ?>";
                                var sub3 ="<?php echo @$data[0]['sub3']; ?>";
                                var sub4 = "<?php echo @$data[0]['sub4']; ?>";
                                var sub5 = "<?php echo @$data[0]['sub5']; ?>";
                                var sub6 = "<?php echo @$data[0]['sub6']; ?>";
                              
                                // Part 1 Subjects Pass fail .
                                var sub1pf1 = "<?php echo @$data[0]['sub1pf']; ?>";
                                var sub2pf1 ="<?php echo @$data[0]['sub2pf']; ?>";
                                var sub3pf1 = "<?php echo @$data[0]['sub3pf']; ?>";
                                var sub4pf1 = "<?php echo @$data[0]['sub4pf']; ?>";
                                var sub5pf1 ="<?php echo @$data[0]['sub5pf']; ?>";
                                var sub6pf1 = "<?php echo @$data[0]['sub6pf']; ?>";
                                var sub7pf1 = "<?php echo @$data[0]['sub7pf']; ?>";
                                var sub8pf1 = "<?php echo @$data[0]['sub8pf']; ?>";

                              

                                // Part 1 Subjects Present and Absent Status
                                var sub1st1 = "<?php echo @$data[0]['sub1st']; ?>";
                                var sub2st1 ="<?php echo @$data[0]['sub2st']; ?>";
                                var sub3st1 = "<?php echo @$data[0]['sub3st']; ?>";
                                var sub4st1 ="<?php echo @$data[0]['sub4st']; ?>";
                                var sub5st1 ="<?php echo @$data[0]['sub5st']; ?>";
                                var sub6st1 = "<?php echo @$data[0]['sub6st']; ?>";
                                var sub7st1 = "<?php echo @$data[0]['sub7st']; ?>";
                                var sub8st1 = "<?php echo @$data[0]['sub8st']; ?>";

                                

                                function sub_grp_load(){
                                
                                    if((sub1pf1 == "3") || (sub1st1 == "2"))
                                    {
                                        $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                        $("#sub1 option[value='" + sub1 + "']").attr("selected","selected");
                                    }
                                    else
                                    {   $("#sub1").empty();
                                        $("#sub1").append('<option value="0">NONE</option>');
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
                                   
                                    if((sub6pf1 == "3") || (sub6st1 == "2"))
                                    {
                                        $("#sub6").empty();
                                        $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                        $("#sub6 option[value='" + sub1 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub6").empty();
                                        $("#sub6").append('<option value="0">NONE</option>');
                                    }
                                   
                                  
                                }

                               
                                function sub_grp_load_exam_type4(){

                                    Empty_All_Dropdowns();
                                    hide_sub7_sub8();

                                   // debugger;
                                    
                                    if((sub1pf1 == "3") || (sub1st1 == "2"))
                                    {
                                        $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                        //$("#sub1").append('<option value="0">NONE</option>');
                                    }
                                    else
                                    {   
                                        $("#sub1").append('<option value="0">NONE</option>');
                                    }
                                    
                                    // Subject 2 
                                    if((sub2pf1 == "3") || (sub2st1 == "2"))
                                    {
                                        $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                        //$("#sub2").append('<option value="0">NONE</option>');
                                    }
                                    else
                                    {
                                        $("#sub2").append('<option value="0">NONE</option>');
                                    }
                                   
                                    if((sub3pf1 == "3") || (sub3st1 == "2"))
                                    {
                                        $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                       // $("#sub3").append('<option value="0">NONE</option>');
                                    }
                                    else
                                    {
                                        $("#sub3").append('<option value="0">NONE</option>');
                                    }
                                   
                                    if((sub4pf1 == "3") || (sub4st1 == "2"))
                                    {
                                        $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                        //$("#sub4").append('<option value="0">NONE</option>');
                                    }
                                    else
                                    {
                                        $("#sub4").append('<option value="0">NONE</option>');
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
                                    
                                    if((sub6pf1 == "3") || (sub6st1 == "2"))
                                    {
                                        $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                       // $("#sub6").append('<option value="0">NONE</option>');
                                    }
                                    else
                                    {
                                        $("#sub6").append('<option value="0">NONE</option>');
                                    }
                                    
                                   
                                }
                               
                                function LanguagesAloom_e_sharkia()
                                {
                                     Empty_All_Dropdowns();
                                    hide_sub7_sub8();
                                    ClearDropDownsP2();
                                    $("#sub1").append(new Option('PAPER-I','1'));
                                   //  $("#sub1").append(new Option('NONE','0'));
                                    $("#sub2").append(new Option('PAPER-II','2'));
                                   // $("#sub2").append(new Option('NONE','0'));
                                    $("#sub3").append(new Option('PAPER-III','3'));
                                  //  $("#sub3").append(new Option('NONE','0'));
                                    $("#sub4").append(new Option('PAPER-IV','4'));
                                  //  $("#sub4").append(new Option('NONE','0'));
                                    $("#sub5").append(new Option('PAPER-V','5'));
                                  //  $("#sub5").append(new Option('NONE','0'));
                                    $("#sub6").append(new Option('PAPER-IV','6'));
                                   // $("#sub6").append(new Option('NONE','0'));
                                    
                                  
                                    
                                    
                                }
                                 
                                <?php

                               // debugBreak();
                                
                                if(($exam_type == 2 || $exam_type == 4)  && $status == 4){ 
                                    echo'LanguagesAloom_e_sharkia();';
                                }
                                else if(($exam_type == 2 || $exam_type == 4) && $status == 2)
                                {
                                    echo 'sub_grp_load_exam_type4();'; 
                                }
                                else{
                                    echo'sub_grp_load();';
                                }
                                ?>

                                /*.CHNAGE WORKS*/

                               

                                $('#std_group').change(function(){
                                   //     debugger;
                                    var sel_group = $('#std_group').val();    
                                         console.log('sel grp = '+sel_group + '  subgrp == '+ grp_cd);
                                    if(sel_group == grp_cd) 
                                    {
                                        sub_grp_load();    
                                    }     

                                    else {
                                         LanguagesAloom_e_sharkia();
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
                                    $("#sub1p2").val(sub1_p1);
                                    
                                })
                                 
                                // Sub2 change event
                                $("#sub2").change(function (){
                                    var sub1_p1 = $("#sub2").val();
                                    $("#sub2p2").val(sub1_p1);
                                    
                                })
                                



                                // sub 4 change event 
                                $("#sub4").change(function(){
                                    var id4 =$("#sub4").val();
                                    var id4p2 =$("#sub4p2").val();
                                    var id5 =$("#sub5").val();
                                    var id5p2 =$("#sub5p2").val();
                                    var id6 =$("#sub6").val();
                                    var id6p2 =$("#sub6p2").val();
                                    $("#sub4p2").val(id4);

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
                               
                                // sub 5 change event 
                                $("#sub5").change(function(){
                                    debugger;
                                    var id4 =$("#sub4").val();
                                    var id4p2 =$("#sub4p2").val();
                                    var id5 =$("#sub5").val();
                                    var id5p2 =$("#sub5p2").val();
                                    var id6 =$("#sub6").val();
                                    var id6p2 =$("#sub6p2").val();
                                    $("#sub5p2").val(id5);

                                    if((id5 !=0) && (id4 == id5)){
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
                              
                                // sub 6 change event
                                $("#sub6").change(function(){
                                    var id4 =$("#sub4").val();
                                    var id4p2 =$("#sub4p2").val();
                                    var id5 =$("#sub5").val();
                                    var id5p2 =$("#sub5p2").val();
                                    var id6 =$("#sub6").val();
                                    var id6p2 =$("#sub6p2").val();
                                    $("#sub6p2").val(id6);

                                    if((id6 !=0) && (id4 == id6)){
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
                             
                            });

                            function checks(){

                                var status  =  check_NewEnrol_validation_Languages();
                                if(status == 0)
                                {
                                    return false;    
                                }
                                else
                                {
                                    return true;
                                } 
                            }

                            function CancelAlert(){
                                var msg = "Are You Sure You want to Cancel this Form ?"
                                alertify.confirm(msg, function (e) {
                                    if (e) {
                                        window.location.href ='<?php echo base_url(); ?>index.php/Admission/index';
                                    } else {
                                    }
                                });
                            }

                            jQuery(document).ready(function () {
                                $(document.getElementById("bay_form")).mask("99999-9999999-9", { placeholder: "_" });
                                $(document.getElementById("father_cnic")).mask("99999-9999999-9", { placeholder: "_" });
                                $(document.getElementById("mob_number")).mask("9999-9999999", { placeholder: "_" });
                            });

                        </script>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>