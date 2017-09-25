
<form class="form-horizontal no-margin" action="<?php  echo base_url(); ?>/index.php/Admission/NewEnrolment_insert_Languages" method="post" enctype="multipart/form-data" name="myform" id="myform">

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
                    <input type="hidden" class="hidden" id="picpath" name="picpath" value="<?php echo @$data['0']['picpath']; ?>" />    
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
                <input class="text-uppercase form-control" id="father_name" name="father_name" type="text" placeholder="Father's Name" maxlength="60" readonly="readonly" value="<?php echo  $data['0']['fname']; ?>" required="required">
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="bay_form" >
                    Bay Form No :
                </label>        
                <input class="form-control" type="text" id="bay_form" name="bay_form"  placeholder="34101-1111111-1" value=""  required="required">
            </div>

            <div class="col-md-4">
                <label class="control-label" for="father_cnic">
                    Father's CNIC :
                </label>        
                <input class="form-control" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1"  value=""  required="required">
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
                    <option value='1' selected='selected'>URDU</option>
                    <option value='2'>ENGLISH</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="control-label" for="speciality">
                    Speciality:
                </label>        
                <select id="speciality"  class="form-control  text-uppercase" name="speciality">
                    <option value='0'>NONE</option>
                </select>
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="MarkOfIden" >
                    Mark Of Identification :
                </label>        
                <input class="form-control text-uppercase" type="text" id="MarkOfIden" name="MarkOfIden" value="<?php echo @$data['0']['IdentMark']; ?>" required="required" maxlength="60" >
            </div>

            <div class="col-md-4">
                <label class="control-label" for="mob_number">
                    Mobile Number :
                </label>        
                <input class="form-control" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789" value="<?php  echo @$data['0']['MobNo']; ?>" required="required">
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
                    <option value='1' selected='selected'>Pakistani</option>
                    <option value='2'>Non Pakistani</option>
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

    <input type="hidden" name="gend" value="<?php echo $gender; ?>">

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
                    <option value='1' selected='selected'>MUSLIM</option> 
                    <option value='2'>NON MUSLIM</option>
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
                    <?php echo $data[0]['address'];  ?>
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
                <input class="text-uppercase form-control" type="text" readonly="readonly" id="oldrno" name="oldrno" value="<?php  echo  @$preDataAloom['oldRnoAloom']; ?>" >
            </div>

            <div class="col-md-4">
                <label class="control-label" for="oldyear">
                    Year :
                </label>        
                <input type="text" class="text-uppercase form-control" name="oldyear" id = "oldyear" readonly="readonly" value="<?php  echo @$preDataAloom['oldYearAloom'] ?>"/> 
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="cand_name" >
                    Session :
                </label>        
                <input type="text" class="text-uppercase form-control" id="oldsess" name="oldsess" readonly="readonly" value="<?php echo @$preDataAloom['sessAloom'] == 1 ? "Annual" :"Supplementary"; ?>"/> 
            </div>

            <div class="col-md-4">
                <label class="control-label" for="father_name">
                    Board :
                </label>        
                <input type="text" class="text-uppercase form-control"  id="oldboard" name="oldboard" readonly="readonly" value="<?php echo $data[0]['brd_name'];?>"/>     
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
                <select id="std_group" class="form-control"  name="std_group">
                    <?php
                    $grp_cd = $data[0]['grp_cd'];
                    $chance = $data[0]['chance'];
                    $exam_type = $data[0]['exam_type'];
                    $status = $data[0]['status'];
                    
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
                    

                   /* 
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
                        }*/


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
    </div>



    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" id="lblpart1cat" name="lblpart1cat">Languages Subjects:</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <select id="sub1" class="form-control" name="sub1"></select> 
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <select id="sub2" class="form-control" name="sub2"></select> 
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <select id="sub3" class="form-control" name="sub3"></select> 
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <select id="sub4" class="form-control" name="sub4"></select> 
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <select id="sub5" class="form-control" name="sub5"></select> 
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <select id="sub6" class="form-control" name="sub6"></select> 
            </div>
        </div>
    </div>

    <input type="hidden" name="aloomCat" id="aloomCat"  value="<?php echo @$preDataAloom['aloomCat']; ?>">
    <input type="hidden" name="txtMatRnoAloom" id="txtMatRnoAloom"  value="<?php echo @$preDataAloom['txtMatRnoAloom']; ?>">
    <input type="hidden" name="oldRnoAloom" id="oldRnoAloom"  value="<?php echo @$preDataAloom['oldRnoAloom']; ?>">
    <input type="hidden" name="sessAloom" id="sessAloom"  value="<?php echo @$preDataAloom['sessAloom']; ?>">
    <input type="hidden" name="oldYearAloom" id="oldYearAloom"  value="<?php echo @$preDataAloom['oldYearAloom']; ?>">
    <input type="hidden" name="boardAloom" id="boardAloom"  value="<?php echo @$preDataAloom['boardAloom']; ?>">
    <input type="hidden" name="matyear" id="matyear"  value="<?php echo @$data[0]['matyear']; ?>">
    <input type="hidden" name="matsess" id="matsess"  value="<?php echo @$data[0]['matsess']; ?>">
    <input type="hidden" name="matrno" id="matrno"  value="<?php echo @$data[0]['matrno']; ?>">


    <input type="hidden" name="exam_type"  id="exam_type"  value="<?php echo @$exam_type = $data[0]['exam_type']; ?>">
    <input type="hidden" name="isaloom"  id="isaloom"  value="<?php echo @$isaloom = $data['isaloom']; ?>">
    <input type="hidden" name="pregrp"     id="pregrp"     value="<?php echo @$pregrp = $data[0]['grp_cd']; ?>">
    <input type="hidden" name="oldboardid" id="oldboardid" value="<?php   echo @$data[0]['Brd_cd'];?>"/>
    <input type="hidden" name="matRno_hidden" id="matRno_hidden" value="<?php echo @$data[0]['matrno'];?>"/>
    <input type="hidden" name="InterRno_hidden" id="InterRno_hidden" value="<?php  echo @$data[0]['rno'];?>"/>
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

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-3">
                <input type="submit" value="Save Form" id="btnsubmitUpdateEnrol" name="btnsubmitUpdateEnrol" class="btn btn-primary btn-block" onclick="return checksLanguages()">
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



        var grp_cd ="<?php if(@@$data[0]['exam_type']=="3"){ echo 0; } else{echo  @@$data[0]['grp_cd'];}  ?>";
        var sub1 ="<?php echo @@$data[0]['sub1']; ?>";
        var sub2 = "<?php echo @@$data[0]['sub2']; ?>";
        var sub3 ="<?php echo @@$data[0]['sub3']; ?>";
        var sub4 = "<?php echo @@$data[0]['sub4']; ?>";
        var sub5 = "<?php echo @@$data[0]['sub5']; ?>";
        var sub6 = "<?php echo @@$data[0]['sub6']; ?>";

        // Part 1 Subjects Pass fail .
        var sub1pf1 = "<?php echo @@$data[0]['sub1pf']; ?>";
        var sub2pf1 ="<?php echo @@$data[0]['sub2pf']; ?>";
        var sub3pf1 = "<?php echo @@$data[0]['sub3pf']; ?>";
        var sub4pf1 = "<?php echo @@$data[0]['sub4pf']; ?>";
        var sub5pf1 ="<?php echo @@$data[0]['sub5pf']; ?>";
        var sub6pf1 = "<?php echo @@$data[0]['sub6pf']; ?>";
        var sub7pf1 = "<?php echo @@$data[0]['sub7pf']; ?>";
        var sub8pf1 = "<?php echo @@$data[0]['sub8pf']; ?>";



        // Part 1 Subjects Present and Absent Status
        var sub1st1 = "<?php echo @@$data[0]['sub1st']; ?>";
        var sub2st1 ="<?php echo @@$data[0]['sub2st']; ?>";
        var sub3st1 = "<?php echo @@$data[0]['sub3st']; ?>";
        var sub4st1 ="<?php echo @@$data[0]['sub4st']; ?>";
        var sub5st1 ="<?php echo @@$data[0]['sub5st']; ?>";
        var sub6st1 = "<?php echo @@$data[0]['sub6st']; ?>";
        var sub7st1 = "<?php echo @@$data[0]['sub7st']; ?>";
        var sub8st1 = "<?php echo @@$data[0]['sub8st']; ?>";



        function sub_grp_load(){

            if((sub1pf1 == "3") || (sub1st1 == "2"))
            {
                $("#sub1").append(new Option('<?php  echo  array_search(@$data[0]['sub1'],$subarray); ?>',sub1));
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
                $("#sub2").append(new Option('<?php  echo  array_search(@$data[0]['sub2'],$subarray); ?>',sub2));
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
                $("#sub3").append(new Option('<?php  echo  array_search(@$data[0]['sub3'],$subarray); ?>',sub3));
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
                $("#sub4").append(new Option('<?php  echo  array_search(@$data[0]['sub4'],$subarray); ?>',sub4));
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

                $("#sub5").append(new Option('<?php  echo  array_search(@$data[0]['sub5'],$subarray); ?>',sub5));
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
                $("#sub6").append(new Option('<?php  echo  array_search(@$data[0]['sub6'],$subarray); ?>',sub6));
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
                $("#sub1").append(new Option('<?php  echo  array_search(@$data[0]['sub1'],$subarray); ?>',sub1));
                //$("#sub1").append('<option value="0">NONE</option>');
            }
            else
            {   
                $("#sub1").append('<option value="0">NONE</option>');
            }

            // Subject 2 
            if((sub2pf1 == "3") || (sub2st1 == "2"))
            {
                $("#sub2").append(new Option('<?php  echo  array_search(@$data[0]['sub2'],$subarray); ?>',sub2));
                //$("#sub2").append('<option value="0">NONE</option>');
            }
            else
            {
                $("#sub2").append('<option value="0">NONE</option>');
            }

            if((sub3pf1 == "3") || (sub3st1 == "2"))
            {
                $("#sub3").append(new Option('<?php  echo  array_search(@$data[0]['sub3'],$subarray); ?>',sub3));
                // $("#sub3").append('<option value="0">NONE</option>');
            }
            else
            {
                $("#sub3").append('<option value="0">NONE</option>');
            }

            if((sub4pf1 == "3") || (sub4st1 == "2"))
            {
                $("#sub4").append(new Option('<?php  echo  array_search(@$data[0]['sub4'],$subarray); ?>',sub4));
                //$("#sub4").append('<option value="0">NONE</option>');
            }
            else
            {
                $("#sub4").append('<option value="0">NONE</option>');
            }

            if((sub5pf1 == "3") || (sub5st1 == "2"))
            {
                $("#sub5").append(new Option('<?php  echo  array_search(@$data[0]['sub5'],$subarray); ?>',sub5));
                // $("#sub5").append('<option value="0">NONE</option>');
            }
            else
            {
                $("#sub5").append('<option value="0">NONE</option>');
            }

            if((sub6pf1 == "3") || (sub6st1 == "2"))
            {
                $("#sub6").append(new Option('<?php  echo  array_search(@$data[0]['sub6'],$subarray); ?>',sub6));
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

    function checksLanguages(){

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
