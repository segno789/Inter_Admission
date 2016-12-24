
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
                        <form class="form-horizontal no-margin" action="<?php  echo base_url(); ?>/index.php/Admission/NewEnrolment_insert_Fresh" method="post" enctype="multipart/form-data" name="myform" id="myform">
                            <div class="control-group">
                                <div class="controls controls-row">
                                    <label class="control-label span2" >
                                    </label> 
                                    <img id="image_upload_preview" style="width:140px; height: 140px;" src="" alt="Candidate Image" />
                                    <input type="hidden" id="pic" name="pic" value="<?php echo  $data['0']['picpath']; ?>" />    
                                </div>
                            </div>
                            <div class="controls controls-row">
                                <input type='file' id="inputFile" onchange="return ValidateFileUpload(this);"/>
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
                                    <input class="span3" id="father_name" name="father_name" style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" readonly="readonly" value="<?php echo  $data['0']['Fname']; ?>" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" name="bay_form"  placeholder="34101-1111111-1" value="<?php echo  @$data['0']['bformNo'];?>" readonly="readonly" required="required" >
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1"  value="<?php echo  @$data['0']['FNIC'];?>" readonly="readonly" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    MEDIUM:
                                </label>
                                <div class="controls controls-row">
                                    <select id="medium" class="dropdown span3" name="medium">   
                                        <option value='1' selected='selected'>Urdu</option>
                                        <option value='1'>English</option>;
                                    </select>
                                    <label class="control-label span2" >
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                        "<option value='0' selected='selected'>None</option> 
                                        <option value='1'>Deaf &amp; Dumb</option>;
                                        <option value='2'>Board Employee</option>;    
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Mark Of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="MarkOfIden" style="text-transform: uppercase;" name="MarkOfIden" value="<?php echo  $data['0']['markOfIden']; ?>" required="required" maxlength="60" >
                                    <label class="control-label span2" >
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789" value="<?php echo  $data['0']['MobNo']; ?> " required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Nationality :
                                </label>
                                <div class="controls controls-row">  
                                    <?php
                                    $nat = $data[0]['IsPakistani'];
                                    if($nat == 1)
                                    {
                                        echo 
                                        "<label class='radio inline span1'><input type='radio' value='1' id='nationality' checked='checked' name='nationality'> Pakistani</label>
                                        <label class='radio inline span2'><input type='radio'  id='nationality1' value='2' name='nationality'> Non Pakistani</label>";
                                    }
                                    else if ($nat == 2)
                                    {
                                        echo  "<label class='radio inline span1'><input type='radio' value='1' id='nationality'  name='nationality'> Pakistani
                                        </label><label class='radio inline span2'><input type='radio'  id='nationality1' checked='checked' value='2' name='nationality'>  Non Pakistani</label>" ;
                                    }
                                    ?>
                                    <label class="control-label span3" style="margin-left: -100px;" for="gender1">
                                        Gender :
                                    </label> 
                                    <?php

                                    $gender = $data[0]['Gender'];

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
                                <label class="control-label span1" >
                                    Hafiz-e-Quran :
                                </label>
                                <div class="controls controls-row">
                                    <label class='radio inline span1'><input type='radio' id='hafiz1' value='1' checked  name='hafiz'> No</label>
                                    <label class='radio inline span1'><input type='radio' id='hafiz2' value='2'  name='hafiz'> Yes</label>    
                                    <label class="control-label span3" >
                                        Religion :
                                    </label> 
                                    <?php
                                    $rel = $data[0]['IsMuslim'];
                                    if($rel == 1)
                                    {
                                        echo
                                        "<label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion'> Muslim
                                        </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class'  value='2' name='religion'> Non Muslim</label>" ;
                                    }
                                    else if ($rel == 2)
                                    {
                                        echo
                                        "<label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' name='religion'> Muslim
                                        </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' checked='checked' name='religion'> Non Muslim</label>" ;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label span1" >
                                Locality :
                            </label>
                            <div class="controls controls-row">  
                                <?php
                                $resid = $data[0]['isRural'];
                                if($resid == 1 )
                                {
                                    echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                    </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural </label>";
                                }
                                else if($resid == 2)
                                {
                                    echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' name='UrbanRural'> Urban
                                    </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2'  checked='checked'  name='UrbanRural'>  Rural </label>";
                                }
                                else
                                {
                                    echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                    </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural </label>";
                                }
                                ?>
                            </div>
                            <div class="control-group" style="margin-top: 50px;">
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
                                <h4 class="span4">Old Exam Information :</h4>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    SSC Roll No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" readonly="readonly" id="oldrno" style="text-transform: uppercase;" name="oldrno" value="<?php  echo  $data['0']['SSC_RNO']; ?>" required="required" maxlength="60" >
                                    <label class="control-label span2" >
                                        SSC Year:
                                    </label> 
                                    <input type="text" class="span3" name="oldyear" id = "oldyear" readonly="readonly" value="<?php  echo $data['0']['SSC_Year']; ?>"/> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Session :
                                </label>
                                <div class="controls controls-row">
                                    <input type="text" class="span3" id="oldsess" name="oldsess" readonly="readonly" value="<?php echo $data['0']['SSC_Session'] == 1 ? "Annual" :"Supplementary"; ?>"/> 
                                    <label class="control-label span2" >
                                        Board:
                                    </label> 
                                    <input type="text" class="span3" id="oldboard" name="oldboard" readonly="readonly" value="<?php echo $data[0]['SSC_Board'];?>"/>     
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
                                    <select id="std_group" class="dropdown span6" name="std_group">
                                        <option value="0" selected="selected">NONE</option>
                                        <option value="3">HUMANITIES</option>
                                        <option value="5">COMMERCE</option>
                                    </select>                                            
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="control row controls-row">
                                    <label class="control-label span3 " id="lblpart1cat" name="lblpart1cat" style="text-decoration: underline; font-weight: bold;" >
                                        <?php
                                        echo'PART-I Subjects';
                                        ?>
                                    </label>
                                    <label class="control-label span3 " id="lblpart2cat" name="lblpart2cat" style="text-decoration: underline; font-weight: bold;" >
                                        <?php
                                        echo'PART-II Subjects';
                                        ?>
                                    </label>
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub1" class="span3 dropdown" name="sub1">
                                        <option value="2"></option>
                                    </select> 
                                    <select id="sub1p2" class="span3 dropdown" name="sub1p2">
                                        <option value="2"></option>
                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                    </select>
                                    <select id="sub2p2" class="span3 dropdown" name="sub2p2">
                                    </select> 
                                </div>                 

                                <div class="control row controls-row">
                                    <label class="control-label span1" >
                                    </label>
                                    <select id="sub3" class="span3 dropdown" name="sub3">

                                    </select> 
                                    <select id="sub3p2" class="span3 dropdown" name="sub3p2">

                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub4"  name="sub4" class="span3 dropdown">

                                    </select>
                                    <select id="sub4p2" class="span3 dropdown" name="sub4p2">

                                    </select> 
                                </div>

                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub5" class="span3 dropdown" name="sub5" selected="selected">
                                    </select> 
                                    <select id="sub5p2" class="span3 dropdown" name="sub5p2" selected="selected">

                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub6"  name="sub6" class="span3 dropdown" selected="selected">

                                    </select>
                                    <select id="sub6p2"  name="sub6p2" class="span3 dropdown" selected="selected">

                                    </select>
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >
                                    </label>
                                    <select id="sub7" class="span3 dropdown" name="sub7" selected="selected">

                                    </select> 
                                    <select id="sub7p2" class="span3 dropdown" name="sub7p2" selected="selected">

                                    </select> 
                                </div> 
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub8" class="span3 dropdown" name="sub8" selected="selected">

                                    </select> 
                                    <select id="sub8p2" class="span3 dropdown" name="sub8p2" selected="selected">

                                    </select> 
                                </div> 
                            </div>



                            <div class="span6">
                                <button type="submit" name="btnsubmitUpdateEnrol" id="btnSaveFresh" class="btn btn-large btn-info offset2">
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
                            });


                            function ClearAllDropDowns() {

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

                            function LoadHumanitiesSubjects(){

                                Empty_All_Dropdowns();

                                $("#sub1").append('<option value="1">ENGLISH</option>');
                                $("#sub1p2").append('<option value="1">ENGLISH</option>');

                                $("#sub2").append('<option value="2">URDU</option>');
                                $("#sub2p2").append('<option value="2">URDU</option>');

                                $("#sub3").append('<option value="92">ISLAMIC EDUCATION</option>');
                                $("#sub3p2").append('<option value="91">PAKISTAN STUDIES</option>');

                                $.each(huminities_without_practical,function(val,text){

                                    $("#sub4").append(new Option(text,val));
                                    $("#sub4p2").append(new Option(text,val));
                                });

                                $.each(huminities_without_practical,function(val,text){

                                    $("#sub5").append(new Option(text,val));
                                    $("#sub5p2").append(new Option(text,val));
                                });

                                $.each(huminities_without_practical,function(val,text){

                                    $("#sub6").append(new Option(text,val));
                                    $("#sub6p2").append(new Option(text,val));
                                });

                                $('#sub7').hide();$('#sub7p2').hide();
                                $('#sub8').hide(); $('#sub8p2').hide();
                            }

                            function LoadCommerceSubjects(){
                                Empty_All_Dropdowns();

                                $('#sub7').show();$('#sub7p2').show();
                                $('#sub8').hide(); $('#sub8p2').hide();

                                $("#sub1").append('<option value="1">ENGLISH</option>');
                                $("#sub1p2").append('<option value="1">ENGLISH</option>');

                                $("#sub2").append('<option value="2">URDU</option>');
                                $("#sub2p2").append('<option value="2">URDU</option>');

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

                            $('#std_group').change(function(){

                                var sel_group = $('#std_group').val();    

                                if(sel_group == 0) 
                                {
                                    Empty_All_Dropdowns();
                                    ClearAllDropDowns();
                                }     

                                else if(sel_group == 3){
                                    LoadHumanitiesSubjects();
                                }

                                else if (sel_group == 5){
                                    LoadCommerceSubjects();
                                }
                            });

                        </script>



                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>