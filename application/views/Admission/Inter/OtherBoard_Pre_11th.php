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
                        <form class="form-horizontal no-margin" action="<?php  echo base_url(); ?>Admission/NewEnrolment_insert_Fresh_11thOtherBoard" method="post" enctype="multipart/form-data" name="myform" id="myform" onsubmit="return checks(this);">
                            <div class="control-group">
                                <h4 class="span4"></h4>
                                <label class="control-label span2" style="width: 411px;margin-left: -199px;">
                                    <img src="<?php echo base_url(); ?>assets/img/upalodimage.jpg" alt="" >
                                </label>
                                <div class="controls controls-row" id="output">
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
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name:
                                </label>
                                <div class="controls controls-row">

                                    <input class="span3"  type="text" id="cand_name" style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" maxlength="60">
                                    <label class="control-label span2" for="lblfather_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span3" id="father_name" name="father_name" style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" name="bay_form"  placeholder="34101-1111111-1"   required="required" >
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1"  required="required">
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
                                    <input class="span3" type="text" id="MarkOfIden" style="text-transform: uppercase;" name="MarkOfIden"  required="required" maxlength="60" >
                                    <label class="control-label span2" >
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Nationality :
                                </label>
                                <div class="controls controls-row">  
                                    <label class='radio inline span1'><input type='radio' value='1' id='nationality' checked='checked' name='nationality'>Pakistani</label>
                                    <label class='radio inline span2'><input type='radio'  id='nationality1' value='2' name='nationality'>Non Pakistani</label>

                                    <label class="control-label span3" style="margin-left: -100px;" for="gender1">
                                        Gender :
                                    </label> 
                                    <label class='radio inline span1' style="color: red;"><input type='radio' id='gender1' value='1'   name='gender'> Male</label> 
                                    <label class='radio inline span1' style="color: red;"><input type='radio' id='gender2' value='2'  name='gender'> Female </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Hafiz-e-Quran :
                                </label>
                                <div class="controls controls-row">
                                    <label class='radio inline span1'><input type='radio' id='hafiz1' value='1' checked="checked"  name='hafiz'> No</label>
                                    <label class='radio inline span1'><input type='radio' id='hafiz2' value='2'  name='hafiz'> Yes</label>    
                                    <label class="control-label span3" >
                                        Religion :
                                    </label> 

                                    <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' checked="checked" name='religion'> Muslim
                                    </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class'  value='2' name='religion'> Non Muslim</label>

                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label span1" >
                                Locality :
                            </label>
                            <div class="controls controls-row">  

                                <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural1' checked="checked" name='UrbanRural'>Urban</label>
                                <label class='radio inline span2'><input type='radio'  id='UrbanRural2' value='2' name='UrbanRural'>Rural</label>

                            </div>
                            <div class="control-group" style="margin-top: 50px;">
                                <label class="control-label span1" >
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px; text-transform: uppercase;"  id="address" class="span8" name="address" required="required"></textarea>
                                </div>
                            </div>
                            <hr>

                            <div class="control-group">
                                <h4 class="span4">Old Exam Information :</h4>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Roll No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" readonly="readonly" id="oldrno" style="text-transform: uppercase;" name="oldrno" value="<?php  echo  $data['0']['RNO']; ?>" required="required" maxlength="60" >
                                    <label class="control-label span2" >
                                        Year:
                                    </label> 
                                    <input type="text" class="span3" name="oldyear" id = "oldyear" readonly="readonly" value="<?php  echo $data['0']['Year']; ?>"/> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Session:
                                </label>
                                <div class="controls controls-row">
                                    <input type="text" class="span3" id="oldsess" name="oldsess" readonly="readonly" value="<?php echo $data['0']['Session'] == 1 ? "Annual" :"Supplementary"; ?>"/> 
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
                                <select id="pvtZone" class="span3" name="pvtZone">
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

                        <input type="hidden" name="oldHSSC_Rno" id="oldHSSC_Rno" value="<?php  echo @$data[0]['RNO'];?>"/>
                        <input type="hidden" name="oldSSC_Rno" id="oldSSC_Rno" value="<?php  echo @$data[0]['SSC_RNO'];?>"/>
                        <input type="hidden" name="Class" id="Class" value="<?php  echo @$data[0]['Class'];?>"/>
                        <input type="hidden" name="oldSSC_Board" id="oldSSC_Board" value="<?php  echo @$data[0]['Board'];?>"/>

                        <input type="hidden" name="oldHSSC_Year" id="oldHSSC_Year" value="<?php  echo @$data[0]['Year'];?>"/>


                        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
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
                                        window.location.href ='<?php echo base_url(); ?>index.php/Admission/index';
                                    } else {
                                    }
                                });
                            }

                            function checks()
                            {

                                var status  =  check_NewEnrol_validation();
                                if(status == 0)
                                {
                                    return false;    
                                }
                                else
                                {
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
                                                        }
                                                        else
                                                        {
                                                            $('.mPageloader').hide();
                                                            alertify.error(obj.error);
                                                            return false; 
                                                        }

                                                    },
                                                    error: function(request, status, error){
                                                        $('.mPageloader').hide();
                                                        alertify.error(request.responseText);
                                                    }
                                                });

                                                return false
                                            }

                                            else
                                            {
                                                $('.mPageloader').hide();
                                                alertify.error(obj.excep);
                                                return false;     
                                            }
                                        }
                                    });

                                    return false;     
                                } 
                            }

                        </script>

                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>