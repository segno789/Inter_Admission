


<form method="post" enctype="multipart/form-data" name="myform" id="myform">
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

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="cand_name" >
                    Candidate Name:
                </label>        
                <input class="text-uppercase form-control"  type="text" id="cand_name" name="cand_name" placeholder="Candidate Name" maxlength="60" value="<?php echo @$data['name'] ?>" >
            </div>
            <div class="col-md-4">
                <label class="control-label" for="father_name">
                    Father's Name :
                </label>        
                <input class="text-uppercase form-control" id="father_name" name="father_name"  type="text" placeholder="Father's Name" maxlength="60"  value="<?php echo  @$data['Fname']; ?>" > 
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="bay_form" >
                    Bay Form No:
                </label>        
                <input class="text-uppercase form-control" type="text" id="bay_form" name="bay_form" maxlength="15" placeholder="Bay Form No." value="<?php echo @$data['BForm'];?>" required="required" >
            </div>
            <div class="col-md-4">
                <label class="control-label" for="father_cnic">
                    Father's CNIC:
                </label>        
                <input class="text-uppercase form-control" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1"  value="<?php  echo @$data['FNIC'];?>" required="required" >
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


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" for="MarkOfIden">Mark of Identification :</label>
                <input class="text-uppercase form-control" type="text" id="MarkOfIden"  name="MarkOfIden" value="<?php echo  @$data['markOfIden']; ?>" required="required" maxlength="60" >
            </div>
            <div class="col-md-4">
                <label class="control-label" for="mob_number">Mobile Number:</label>
                <input class="text-uppercase form-control" id="mob_number" name="mob_number" type="text" value="" required="required">
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
                    <option value='0' selected='selected'>None</option>
                    <option value='1'>Pakistani</option> 
                    <option value='2'>Non Pakistani</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="control-label" for="gend">
                    Gender :
                </label>     
                <select name="gender" class="form-control text-uppercase" id="gend">
                    <option value='0' selected='selected'>None</option>
                    <option value='1'>MALE</option> 
                    <option value='2'>FEMALE</option>
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
                    <option value='0'>NONE</option> 
                    <option value='1'>MUSLIM</option> 
                    <option value='2'>NON MUSLIM</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="control-label" for="hafiz" >
                    Hafiz-e-Quran :
                </label>        
                <select name="hafiz" class="form-control text-uppercase" id="hafiz">
                    <option value='1' selected='selected'>NO</option> 
                    <option value='2'>YES</option> 
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
                    <option value='0' selected='selected'>None</option>
                    <option value='1'>URBAN</option> 
                    <option value='2'>RURAL</option>
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
                <textarea  id="address" class="text-uppercase form-control" rows="4" name="address" required="required"></textarea>       
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
                <input class="text-uppercase form-control" type="text" id="oldrno" name="oldrno" readonly="readonly" value="<?php echo  $data['0']['RNO']; ?>" required="required" maxlength="10">
            </div>
            <div class="col-md-4">
                <label class="control-label">Year:</label> 
                <input type="text" class="text-uppercase form-control" name="oldyear" id = "oldyear" readonly="readonly" value="<?php  echo $data['0']['Year']; ?>"/> 
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4"><label class="control-label">Session:</label>
                <input type="text" class="text-uppercase form-control" id="oldsess" name="oldsess" readonly="readonly" value="<?php echo $data['0']['Session'] == 1 ? "Annual" :"Supplementary"; ?>"/> 
            </div>
            <div class="col-md-4">
                <label class="control-label">Board:</label> 
                <input type="text" class="text-uppercase form-control" id="oldboard" name="oldboard" readonly="readonly" value="<?php echo $data[0]['brd_name'];?>"/>     
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
        <img src="<?php  echo base_url().'assets/img/Instruction.jpg'; ?>" class="img-responsive" alt="Instruction.jpg (152,412 bytes)">
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
                <label class="control-label" for="std_group" >
                    Study Group :
                </label>
                <select id="std_group" class="form-control text-uppercase" name="std_group">
                    <option value="0" selected="selected">NONE</option>
                    <option value="3">HUMANITIES</option>
                    <option value="5">COMMERCE</option>
                </select>  
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <label class="control-label" id="lblpart1cat" name="lblpart1cat" style="text-decoration: underline;">
                    PART-I Subjects
                </label>
            </div>
            <div class="col-md-4">
                <label class="control-label" id="lblpart2cat" name="lblpart2cat" style="text-decoration: underline;">
                    PART-II Subjects
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub1" class="text-uppercase form-control" name="sub1"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub1p2" class="text-uppercase form-control" name="sub1p2"></select> 
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub2" class="text-uppercase form-control" name="sub2"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub2p2" class="text-uppercase form-control" name="sub2p2"></select> 
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub3" class="text-uppercase form-control" name="sub3"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub3p2" class="text-uppercase form-control" name="sub3p2"></select> 
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub4" class="text-uppercase form-control" name="sub4"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub4p2" class="text-uppercase form-control" name="sub4p2"></select> 
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub5" class="text-uppercase form-control" name="sub5"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub5p2" class="text-uppercase form-control" name="sub5p2"></select> 
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub6" class="text-uppercase form-control" name="sub6"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub6p2" class="text-uppercase form-control" name="sub6p2"></select> 
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub7" class="text-uppercase form-control" name="sub7"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub7p2" class="text-uppercase form-control" name="sub7p2"></select> 
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <select id="sub8" class="text-uppercase form-control" name="sub8"></select> 
            </div>
            <div class="col-md-4">
                <select id="sub8p2" class="text-uppercase form-control" name="sub8p2"></select> 
            </div>
        </div>
    </div>

    <div class="hidden">
        <input type="hidden" name="oldHSSC_Rno" id="oldHSSC_Rno" value="<?php  echo @$data[0]['RNO'];?>"/>
        <input type="hidden" name="oldSSC_Rno" id="oldSSC_Rno" value="<?php  echo @$data[0]['SSC_RNO'];?>"/>
        <input type="hidden" name="Class" id="Class" value="<?php  echo @$data[0]['Class'];?>"/>
        <input type="hidden" name="oldSSC_Board" id="oldSSC_Board" value="<?php  echo @$data[0]['Board'];?>"/>
        <input type="hidden" name="oldHSSC_Year" id="oldHSSC_Year" value="<?php  echo @$data[0]['Year'];?>"/>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <label class="checkbox-inline">
                    <input type="checkbox" class="checkboxtext" id="terms" name="terms" value="yes">I agree with the <a href="<?php echo base_url(); ?>assets/img/Instructions.jpg" target="_blank">Terms and Conditions </a> of Board of Intermediate & Secondary Education, Gujranwala  
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-3">
                <input type="submit" value="Save Form" id="btnSaveFresh" name="btnsubmitUpdateEnrol" id="btnsubmitUpdateEnrol" class="btn btn-primary btn-block"  onclick="return checks_otherBoard_Pre_11th(this)" >
            </div>
            <div class="col-md-2">
                <a href="<?php echo base_url(); ?>assets/img/Instruction.jpg" download="FileName" class="btn btn-info btn-block" >Download Instruction</a>
            </div>
            <div class="col-md-3">
                <input type="button" class="btn btn-danger btn-block" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();">
            </div>
        </div>
    </div>
</form>


<script src="<?php echo base_url(); ?>assets/js_matric/jquery-1.8.3.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $.fancybox("#instruction");
        $(document.getElementById("bay_form")).mask("99999-9999999-9", { placeholder: "_" });
        $(document.getElementById("father_cnic")).mask("99999-9999999-9", { placeholder: "_" });
        $(document.getElementById("mob_number")).mask("9999-9999999", { placeholder: "_" });

        Empty_All_Dropdowns();
        ClearAllDropDowns();
    });

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

        ClearDropDownsP1();

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

        ClearDropDownsP1();

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

    $("#sub4p2").change(function(){

        var id4 =$("#sub4").val();
        var id4p2 =$("#sub4p2").val();
        var id5 =$("#sub5").val();
        var id5p2 =$("#sub5p2").val();
        var id6 =$("#sub6").val();
        var id6p2 =$("#sub6p2").val();


        if(id4p2 == id5p2 || id4p2 == id6p2){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose Same Subject');
            $("#sub4p2").val('0'); 
        }

        // Double history and language
        else if( (id5p2 == '55' || id5p2 == '56' || id5p2 == '57' || id5p2 == '58') && (id4p2 == '55' || id4p2 == '56' || id4p2 == '57' || id4p2 == '58') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');

            $("#sub4p2").val('0'); 
        }
        else if( (id6p2 == '55' || id6p2 == '56' || id6p2 == '57' || id6p2 == '58') && (id4p2 == '55' || id4p2 == '56' || id4p2 == '57' || id4p2 == '58') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');

            $("#sub4p2").val('0'); 
        }

        else if( (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') && (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');

            $("#sub4p2").val('0'); 
        }
        else if( (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') && (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');

            $("#sub4p2").val('0'); 
        }
    });

    $("#sub5").change(function(){

        //debugger;

        var id4 =$("#sub4").val();
        var id4p2 =$("#sub4p2").val();
        var id5 =$("#sub5").val();
        var id5p2 =$("#sub5p2").val(id5);
        var id6 =$("#sub6").val();
        var id6p2 =$("#sub6p2").val();
        var grp_cd = $('#std_group').val();


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

    $("#sub5p2").change(function(){

        var id4 =$("#sub4").val();
        var id4p2 =$("#sub4p2").val();
        var id5 =$("#sub5").val(id5p2);
        var id5p2 =$("#sub5p2").val();
        var id6 =$("#sub6").val();
        var id6p2 =$("#sub6p2").val();
        var grp_cd = $('#std_group').val();

        if(id5p2 == id4p2 || id5p2 == id6p2){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose Same Subject');
            $("#sub5p2").val('0');
        }
        // Double language 
        else if( (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') && (id5p2 == '24' || id5p2 == '27' || id5p2 == '32' || id5p2 == '34' || id5p2 == '37') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
            $("#sub5p2").val('0');
        }
        else if( (id6p2 == '24' || id6p2 == '27' || id6p2 == '32' || id6p2 == '34' || id6p2 == '37') && (id5p2 == '24' || id5p2 == '27' || id5p2 == '32' || id5p2 == '34' || id5p2 == '37') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
            $("#sub5p2").val('0');
        }

        // Double History 
        else if( (id4p2 == '55' || id4p2 == '56' || id4p2 == '57' || id4p2 == '58') && (id5p2 == '55' || id5p2 == '56' || id5p2 == '57' || id5p2 == '58') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
            $("#sub5p2").val('0');
        }

        else if( (id6p2 == '55' || id6p2 == '56' || id6p2 == '57' || id6p2 == '58')&& (id5p2 == '55' || id5p2 == '56' || id5p2 == '57' || id5p2 == '58') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
            $("#sub5p2").val('0');
        }

    });

    $("#sub6").change(function(){

        var id4 =$("#sub4").val();
        var id4p2 =$("#sub4p2").val();
        var id5 =$("#sub5").val();
        var id5p2 =$("#sub5p2").val();
        var id6 =$("#sub6").val();
        var id6p2 =$("#sub6p2").val(id6);
        var grp_cd = $('#std_group').val();

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

    $("#sub6p2").change(function(){

        var id4 =$("#sub4").val();
        var id4p2 =$("#sub4p2").val();
        var id5 =$("#sub5").val();
        var id5p2 =$("#sub5p2").val();
        var id6 =$("#sub6").val(id6p2);
        var id6p2 =$("#sub6p2").val();
        var grp_cd = $('#std_group').val();

        if(id6p2 == id4p2 || id6p2 == id5p2){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose Same Subject');
            $("#sub6p2").val('0');
        }

        // Double language 
        else if( (id4p2 == '24' || id4p2 == '27' || id4p2 == '32' || id4p2 == '34' || id4p2 == '37') && (id6p2 == '24' || id6p2 == '27' || id6p2 == '32' || id6p2 == '34' || id6p2 == '37') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
            $("#sub6p2").val('0');
        }

        else if( (id5p2 == '24' || id5p2 == '27' || id5p2 == '32' || id5p2 == '34' || id5p2 == '37') && (id6p2 == '24' || id6p2 == '27' || id6p2 == '32' || id6p2 == '34' || id6p2 == '37') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double Language');
            $("#sub6p2").val('0');
        }

        // Double History //
        else if( (id4p2 == '55' || id4p2 == '56' || id4p2 == '57' || id4p2 == '58') && (id6p2 == '55' || id6p2 == '56' || id6p2 == '57' || id6p2 == '58') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
            $("#sub6p2").val('0');
        }

        else if( (id5p2 == '55' || id5p2 == '56' || id5p2 == '57' || id5p2 == '58') && (id6p2 == '55' || id6p2 == '56' || id6p2 == '57' || id6p2 == '58') ){
            alertify.error('Please Choose Different Subject. You Are NOT Allowed to Choose the Double History');
            $("#sub6p2").val('0');
        }
    });

    function CancelAlert(){
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                window.location.href ='<?php echo base_url(); ?>Admission';
            } else {
            }
        });
    }

    function checks_otherBoard_Pre_11th()
    {

        $('#btnsubmitUpdateEnrol').attr("disabled", "disabled");
        var status  =  check_NewEnrol_validation_Fresh();

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
                url: "<?php  echo site_url('Admission/frmvalidation_Fresh'); ?>",
                data: $("#myform").serialize() ,
                datatype : 'html',
                success: function(data)
                {
                    var obj = JSON.parse (data);
                    if(obj.excep == 'Success')
                    {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>" + "Admission/NewEnrolment_insert_Fresh_11thOtherBoard/",
                            data: $("#myform").serialize() ,
                            datatype : 'html',
                            beforeSend: function() {  $('.mPageloader').show(); },
                            complete: function() { $('.mPageloader').hide();},
                            success: function(data) {

                                var obj = JSON.parse(data) ;
                                if(obj.error ==  1)
                                {
                                    window.location.href ='<?php echo base_url(); ?>Admission/formdownloaded/'+obj.formno; 
                                    alertify.success('Your admission has been submitted successfully');
                                }
                                else
                                {
                                    $('.mPageloader').hide();
                                    $('#btnsubmitUpdateEnrol').removeAttr("disabled");
                                    alertify.error(obj.error);
                                    return false; 
                                }

                            },
                            error: function(request, status, error){
                                $('.mPageloader').hide();
                                $('#btnsubmitUpdateEnrol').removeAttr("disabled");
                                alertify.error(request.responseText);
                            }
                        });

                        return false
                    }

                    else
                    {
                        $('.mPageloader').hide();
                        $('#btnsubmitUpdateEnrol').removeAttr("disabled");
                        alertify.error(obj.excep);
                        return false;     
                    }
                }
            });

            return false;     
        } 
    }

</script>