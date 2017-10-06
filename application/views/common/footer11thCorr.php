
<footer>
    <p>
        &copy; BiseAdmin 2015
    </p>
</footer>


<!--Add the following script at the bottom of the web page (before </body></html>)-->


<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollUp.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wysiwyg/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<?php 
if(isset($files)){
    foreach($files as $file){
        echo '<script type="text/javascript" src="'.base_url().'assets/js/'.$file.'"></script>';
    }
}
?> 
<script type="">

    /*function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};      */


    /*function showMyImage(fileInput) {
    debugger;
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {           
    var file = files[i];
    var imageType = "jpg"// /image.*/;     
    /* if (!file.type.match(imageType)) {
    continue;
    }           
    var img=document.getElementById("corr_image");            
    img.file = file;    
    var reader = new FileReader();
    reader.onload = (function(aImg) { 
    return function(e) { 
    aImg.src = e.target.result; 
    }; 
    })(img);
    reader.readAsDataURL(file);
    }    */
    /*    }*/

    function readURL_corr(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#corr_image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    /*$("#corr_image").change(function(){
    readURL(this);
    });*/
    /*function Checkfiles_corr()
    {
    var fup = document.getElementById('corr_image');
    var fileName = fup.value;
    // alert('File Name is = '+ fileName);
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
    if(ext == "jpg" )
    {
    //$("#corr_previewImg")
    $('#corr_previewImg').attr('src', );
    return true;
    } 
    else
    {
    alert("Upload  .jpg images only");
    fup.value = null;
    fup.focus();
    return false;
    }
    }*/
    $(document).ready(function () {
        $('.mPageloader').hide();
        $('#data-table').dataTable({
            "sPaginationType": "full_numbers",
            "bAutoWidth" : false,
            "cache": false
        });
        $('#data-tablereg').dataTable({
            "sPaginationType": "full_numbers",
            "bAutoWidth" : false,
            "cache": false
        });
  
        $("#c0").click(function(){

            if($(this).is(":checked")){
                $("#corr_cand_name").show();
            } else {
                $("#corr_cand_name").hide();            
                $("#corr_cand_name").val('');            
            }
        });
        $("#c1").click(function(){

            if($(this).is(":checked")){
                $("#corr_father_name").show();
            } else {
                $("#corr_father_name").hide();            
                $("#corr_father_name").val('');            
            }
        });
        $("#c2").click(function(){
            if($(this).is(":checked")){
                $("#corr_dob").show();
            } else {
                $("#corr_dob").hide();            
                $("#corr_dob").val('');            
            }
        });
        $("#c3").click(function(){
            if($(this).is(":checked")){
                $("#corr_bay_form").show();
            } else {
                $("#corr_bay_form").hide();            
                $("#corr_bay_form").val('');            
            }
        });
        $("#c4").click(function(){
            if($(this).is(":checked")){
                $("#corr_father_cnic").show();
            } else {
                $("#corr_father_cnic").hide();            
                $("#corr_father_cnic").val('');            
            }
        });
        $("#c5").click(function(){
            if($(this).is(":checked")){
                $("#corr_std_group").show();
                $("#corr_lbl_choose_sub").show();
                $("#corr_sub1").show();
                $("#corr_sub2").show();
                $("#corr_sub3").show();
                $("#corr_sub4").show();
                $("#corr_sub5").show();
                $("#corr_sub6").show();
                $("#corr_sub7").show();
                $("#corr_sub8").show();


            } else {
                $("#corr_std_group").hide();
                $("#corr_lbl_choose_sub").hide();
                $("#corr_sub1").hide();
                $("#corr_sub2").hide();
                $("#corr_sub3").hide();
                $("#corr_sub4").hide();
                $("#corr_sub5").hide();
                $("#corr_sub6").hide();
                $("#corr_sub7").hide();
                $("#corr_sub8").hide();
            }
        });
        $("#c7").click(function(){
            if($(this).is(":checked")){
                $("#corr_image").show();
                $("#corr_previewImg").show(); 
            } else {
                document.getElementById("corr_previewImg").src = "<?php echo base_url() ?>assets/img/profile.png";
                document.getElementById("corr_image").value = "";
                $("#corr_image").hide();
                $("#corr_previewImg").hide(); 
            }
        });
        var NationalityVal = $("#hid_nat").val();


    });
    $("#btnsubmitUpdateEnrol").click(function(){

        // alert('hello');
        //alert(c1);
        var corr_cand_name = $("#corr_cand_name").val();
        var corr_father_name = $("#corr_father_name").val();
        var corr_dob = $("#corr_dob").val();
        var corr_bay_form = $("#corr_bay_form").val();
        var corr_father_cnic = $("#corr_father_cnic").val();
        var corr_std_group = $("#corr_std_group option:selected").text();
        var corr_std_group_val = $("#corr_std_group option:selected").val();
        var std_group = $("#std_group option:selected").text();
        var check_checkbox = 0;
        var corr_type = 0;
        if ($("#c0").prop('checked')==true){ 
            //    alert('at lease one checked');
            check_checkbox =1;
            corr_type = 1;
            if(corr_type == 1 && corr_cand_name=='')
        {
            alertify.error("Please write correct Name!");
            $("#corr_cand_name").focus();
            return false;
        }
        }if ($("#c1").prop('checked')==true){ 
            //    alert('at lease one checked');
            check_checkbox =1;
            corr_type = 2;
             if(corr_type == 2 && corr_father_name=='')
        {
            alertify.error("Please write correct Father's Name!");
            $("#corr_cand_name").focus();
            return false;
        }
        }if ($("#c2").prop('checked')==true){ 
            //    alert('at lease one checked');
            check_checkbox =1;
            corr_type = 3;
             if(corr_type == 3 && corr_dob=='')
        {
            alertify.error("Please write correct Date of Birth!");
            $("#corr_cand_name").focus();
            return false;
        }
        }if ($("#c3").prop('checked')==true){ 
            //    alert('at lease one checked');
            check_checkbox =1;
            corr_type = 4;
             if(corr_type == 4 && (corr_bay_form=='' || corr_bay_form=='00000-0000000-0' || corr_bay_form=='11111-1111111-1' || corr_bay_form=='22222-2222222-2' || corr_bay_form=='33333-3333333-3' || corr_bay_form=='44444-4444444-4' || corr_bay_form=='55555-5555555-5' || corr_bay_form=='66666-6666666-6' || corr_bay_form=='77777-7777777-7' || corr_bay_form=='88888-8888888-8' || corr_bay_form=='99999-9999999-9'))
        {
            alertify.error("Please write correct Bay-Form No.!");
            $("#corr_cand_name").focus();
            return false;
        }
        }if ($("#c4").prop('checked')==true){ 
            //    alert('at lease one checked');
            check_checkbox =1;
            corr_type = 5;
             if(corr_type == 5 && (corr_father_cnic=='' || corr_father_cnic=='00000-0000000-0' || corr_father_cnic=='11111-1111111-1' || corr_father_cnic=='22222-2222222-2' || corr_father_cnic=='33333-3333333-3' || corr_father_cnic=='44444-4444444-4' || corr_father_cnic=='55555-5555555-5' || corr_father_cnic=='66666-6666666-6' || corr_father_cnic=='77777-7777777-7' || corr_father_cnic=='88888-8888888-8' || corr_father_cnic=='99999-9999999-9'))
        {
            alertify.error("Please write correct Father CNIC!");
            $("#corr_cand_name").focus();
            return false;
        }
        }if ($("#c5").prop('checked')==true){ 
            //    alert('at lease one checked');
            check_checkbox =1;
            corr_type = 6;
             if(corr_type == 6 )
        {

            if(corr_std_group_val == 3 && (corr_sub4_val == 0 || corr_sub5_val==0 || corr_sub6_val == 0))
            {
                alertify.error("Please Select Subject First!");
                //$("#corr_cand_name").focus();
                return false;
            }


            //&& corr_std_group_val==0
            if((corr_std_group== std_group))
            {
                if(sub1==corr_sub1)
                {
                    sub1_match=1 
                }
                if(sub2==corr_sub2)
                {
                    sub2_match=1 
                }
                if(sub3==corr_sub3)
                {
                    sub3_match=1 
                }
                if(sub4==corr_sub4)
                {
                    sub4_match=1 
                }
                if(sub5==corr_sub5)
                {
                    sub5_match=1 
                }
                if(sub6==corr_sub6)
                {
                    sub6_match=1 
                }
                if(sub7==corr_sub7)
                {
                    sub7_match=1 
                }

                if(sub1_match==1 && sub2_match==1 && sub3_match==1 && sub4_match==1 && sub5_match==1 && sub6_match==1 && sub7_match==1  )
                {
                    alertify.error("Please select correct Group/Subject First!");
                    $("#corr_cand_name").focus();
                    return false;
                }

            }


        }
        }if ($("#c6").prop('checked')==true){ 
            //    alert('at lease one checked');
            check_checkbox =1;
            corr_type = 7;
             
        }if ($("#c7").prop('checked')==true)
        { 
       
            check_checkbox =1;
            corr_type = 8;
             var f = document.getElementById("corr_image");
            if(f.value == "") 
            {
                   alertify.error("Please select correct Image First!");
                    $("#corr_image").focus();
                    return false;
            }
               // return false;
        }

        
       
       
       
       
        if(check_checkbox ==0)
        {
            alertify.error("Please Choose Correction First!");
            return false;
        }
        var sub1 = $("#sub1 option:selected").text();
        var sub2 = $("#sub2 option:selected").text();
        var sub3 = $("#sub3 option:selected").text();
        var sub4 = $("#sub4 option:selected").text();
        var sub5 = $("#sub5 option:selected").text();
        var sub6 = $("#sub6 option:selected").text();
        var sub7 = $("#sub7 option:selected").text();
        var corr_sub1 = $("#corr_sub1 option:selected").text();
        var corr_sub2 = $("#corr_sub2 option:selected").text();
        var corr_sub3 = $("#corr_sub3 option:selected").text();
        var corr_sub4 = $("#corr_sub4 option:selected").text();
        var corr_sub5 = $("#corr_sub5 option:selected").text();
        var corr_sub6 = $("#corr_sub6 option:selected").text();
        var corr_sub7 = $("#corr_sub7 option:selected").text();
        var sub1_match =0;
        var sub2_match =0;
        var sub3_match =0;
        var sub4_match =0;
        var sub5_match =0;
        var sub6_match =0;
        var sub7_match =0;
        var corr_sub4_val = $("#corr_sub4 option:selected").val();
        var corr_sub5_val = $("#corr_sub5 option:selected").val();
        var corr_sub6_val = $("#corr_sub6 option:selected").val();
       
       
         
        //do something




        //if()
        var formno = $("#lblFormNo").text();




        var corr_pic_src = $("#corr_previewImg").attr('src');
        //  alert(corr_pic_src);
        $('#div_confirmation').html('');
        $('#div_confirmation').append(' <h3 class="welcome_note">View Your Correction Application Form</h3><br>  <div class="widget">                    <div class="widget-header" id="lblFormNo">                        <div class="title">   <h3>                      Form No.   <?php                                       echo @$data[0]['formNo'];                                       ?>                       </h3> </div>                    </div>                    <div class="widget-body"><div class="control-group">                                <h4 class="span4">Personal Information :</h4>                                <div class="controls controls-row">                                                                                                    </div>                            </div> '); 


        var chkBoxArray = [];
        $('.corr_check_box:checked').each(function() {
            chkBoxArray.push($(this).val());
            if($(this).val() == '7')
            {
                $("#div_confirmation").append(' <div class="control-group"><label class="control-label span2" >                                    Current Picture :<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="<?php  echo '../../'.IMAGE_PATH11.@$Inst_Id.'/'.@$data[0]['PicPath']; ?>" alt="Candidate Image">                                                               <label class="control-label span1" >TO</label>                                     <img  name="corr_previewImg" style="width:80px; height: 80px; margin-right: 231px;    float: right;" class="span2" src="'+corr_pic_src+'" alt="Candidate Image">                               </div>                            </div>   ')            }
            if($(this).val() == '1')
            {
                $("#div_confirmation").append(' <div class="control-group">                                <label class="control-label span2 " >                                    Candidate Name :                                </label>                          <div class="controls controls-row">                                    <input class="span2" readonly="readonly"  type="text" id="cand_name" style="text-transform: uppercase;    font-size: 10px;" name="cand_name" placeholder="Candidate Name" maxlength="60"  value="<?php  echo  @$data['0']['name']; ?>" <?php if(@$isReAdm==1) echo "readonly='readonly'";  ?>  >                                <label class="control-label span1 "> TO </label>     <input class="span2" name="corr_cand_name" style="text-transform: uppercase; " readonly="readonly" type="text" value="'+corr_cand_name+'" >                                </div>                            </div>');

            }
            if($(this).val() == '2')
            {
                $('#div_confirmation').append('    <div class="control-group">                                <label class="control-label span2" >                                    Father Name :<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly" id="father_name" name="father_name" style="text-transform: uppercase;     font-size: 10px;" type="text" placeholder="Father Name" maxlength="60" value="<?php echo @$data['0']['Fname']; ?>" <?php if(@$isReAdm==1) echo "readonly='readonly'";  ?> required="required">                                                                <label class="control-label span1" >TO</label>                                     <input readonly="readonly" class="span2"  type="text"  style="text-transform: uppercase; " name="corr_father_name" value="'+corr_father_name+'"  maxlength="60">                                </div>                            </div>  '); 
            }
            if($(this).val() == '3')
            {
                $('#div_confirmation').append('    <div class="control-group">                                <label class="control-label span2" >                                     Date of Birth:(dd-mm-yyyy)<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly" id="dob" name="dob" placeholder="DOB" style="text-transform: uppercase;     font-size: 10px;" type="text"  value="<?php  $source = @$data['0']['Dob']; @$date = new DateTime(@$source); echo @$date->format('d-m-Y'); ?>" <?php if(@$isReAdm==1) echo "readonly='readonly'";  ?> required="required">                                                                <label class="control-label span1" >TO</label>                                     <input class="span2" type="text"  style="text-transform: uppercase; " name="corr_dob" readonly="readonly" value="'+corr_dob+'"  maxlength="60">                                </div>                            </div>  '); 
            }
            if($(this).val() == '4')
            {
                $('#div_confirmation').append('    <div class="control-group">                                <label class="control-label span2" >                                     Bay Form No : <!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly" id="bay_form" name="bay_form" style="text-transform: uppercase;     font-size: 10px;" type="text"maxlength="60" value="<?php echo  @$data['0']['BForm']; ?>" <?php if(@$isReAdm==1) echo "readonly='readonly'";  ?> required="required">                                                                <label class="control-label span1" >TO</label>                                     <input readonly="readonly" class="span2" type="text"  style="text-transform: uppercase; " name="corr_father_cnic" value="'+corr_bay_form+'"  maxlength="60">                                </div>                            </div>  '); 
            }
            if($(this).val() == '5')
            {
                $('#div_confirmation').append('    <div class="control-group">                                <label class="control-label span2" >                                     Father CNIC :<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly" id="father_cnic" name="father_cnic" style="text-transform: uppercase;     font-size: 10px;" type="text" maxlength="60" value="<?php echo  @$data['0']['FNIC']; ?>" <?php if(@$isReAdm==1) echo "readonly='readonly'";  ?> required="required">                                                                <label class="control-label span1" >TO</label>                                     <input readonly="readonly" class="span2"  type="text"  style="text-transform: uppercase; " name="corr_father_name" value="'+corr_father_cnic+'"  maxlength="60">                                </div>                            </div>  '); 
            }
            if($(this).val() == '6')
            {
                $('#div_confirmation').append('<div class="control-group">                                <h4 class="span4">Exam Information :</h4>                                <div class="controls controls-row">                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">                                                                  </div>                            </div>  <div class="control-group">                                <label class="control-label span2" >                                    Current Group :<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly"  name="std_group" style="text-transform: uppercase;     font-size: 10px;" type="text" maxlength="60" value="'+std_group+'" required="required">                                                                <label class="control-label span1" >TO</label>                                     <input class="span2"  type="text"  style="text-transform: uppercase; " name="corr_std_group" value="'+corr_std_group+'" disabled="disabled"  maxlength="60">                                </div>                            </div>                                                                                                                                                                                 <div class="control-group">                                <label class="control-label span2" >                                    Subject 1 :<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly" name="std_group" style="text-transform: uppercase;     font-size: 10px;" type="text" maxlength="60" value="'+sub1+'" required="required">                                                                <label class="control-label span1" >TO</label>                                     <input class="span2"  type="text"  style="text-transform: uppercase; " name="corr_std_group" value="'+corr_sub1+'" disabled="disabled"  maxlength="60">                                </div>                            </div>                                                                                                                                                                                                    <div class="control-group">                                <label class="control-label span2" >                                    Subject 2 :<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly" id="std_group" name="std_group" style="text-transform: uppercase;     font-size: 10px;" type="text" maxlength="60" value="'+sub2+'" required="required">                                                                <label class="control-label span1" >TO</label>                                     <input class="span2"  type="text"  style="text-transform: uppercase; " name="corr_std_group" value="'+corr_sub2+'" disabled="disabled"  maxlength="60">                                </div>                            </div>                                                                                                                                                                                                   <div class="control-group">                                <label class="control-label span2" >                                    Subject 3 :<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly" id="std_group" name="std_group" style="text-transform: uppercase;     font-size: 10px;" type="text" maxlength="60" value="'+sub3+'" required="required">                                                                <label class="control-label span1" >TO</label>                                     <input class="span2" type="text"  style="text-transform: uppercase; " name="corr_std_group" value="'+corr_sub3+'" disabled="disabled"  maxlength="60">                                </div>                            </div>                                                                                                                                                                                                  <div class="control-group">                                <label class="control-label span2" >                                    Subject 4 :<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly" id="std_group" name="std_group" style="text-transform: uppercase;     font-size: 10px;" type="text" maxlength="60" value="'+sub4+'" required="required">                                                                <label class="control-label span1" >TO</label>                                     <input class="span2" type="text"  style="text-transform: uppercase; " name="corr_std_group" value="'+corr_sub4+'" disabled="disabled"  maxlength="60">                                </div>                            </div>                                                                                                                                                                                                   <div class="control-group">                                <label class="control-label span2" >                                    Subject 5 :<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly" id="std_group" name="std_group" style="text-transform: uppercase;     font-size: 10px;" type="text" maxlength="60" value="'+sub5+'" required="required">                                                                <label class="control-label span1" >TO</label>                                     <input class="span2"  type="text"  style="text-transform: uppercase; " name="corr_std_group" value="'+corr_sub5+'" disabled="disabled"  maxlength="60">                                </div>                            </div>                                                                                                                                                                                                  <div class="control-group">                                <label class="control-label span2" >                                    Subject 6 :<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly" id="std_group" name="std_group" style="text-transform: uppercase;     font-size: 10px;" type="text" maxlength="60" value="'+sub6+'" required="required">                                                                <label class="control-label span1" >TO</label>                                     <input class="span2"  type="text"  style="text-transform: uppercase; " name="corr_std_group" value="'+corr_sub6+'" disabled="disabled"  maxlength="60">                                </div>                            </div>                                                                                                                                                                                                   <div class="control-group">                                <label class="control-label span2" >                                    Subject 7 :<!-- MEDIUM:-->                 </label>                                <div class="controls controls-row">                                    <input class="span2" readonly="readonly" id="std_group" name="std_group" style="text-transform: uppercase;     font-size: 10px;" type="text" maxlength="60" value="'+sub7+'" required="required">                                                                <label class="control-label span1" >TO</label>                                     <input class="span2"  type="text"  style="text-transform: uppercase; " name="corr_std_group" value="'+corr_sub7+'" disabled="disabled"  maxlength="60">                                </div>                            </div>                                                                                                                                                                                                          </div>             ');
            }


        });
        $('#div_confirmation').append('<button type="button" id="btnsubmitConfirmation" name="btnsubmitUpdateEnrol" class="btn btn-large btn-info offset2" >                                    Apply for Correction                                </button>                                <input type="button" class="btn btn-large btn-danger" value="Edit Correction Form" id="btnCancel" name="btnCancel" onclick="return CancelAlert_confirmation_form();" >');
        $("#btnsubmitConfirmation").click(function(){
            // alert('called');
            $("#corr_form").submit();
        })
        $.fancybox("#div_confirmation");
        // alert(chkBoxArray);
        //  $.fancybox("#div_confirmation");
        // $("#div_confirmation").fancybox();
    })

</script>
<script type="">
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };
    function Incomplete_inst_info_INSERT()
    {
        var emis ="<?php  echo @$field_status['emis']; ?>";
        var email = "<?php  echo @$field_status['email']; ?>";
        var phone = "<?php echo @$field_status['phone']; ?>";
        var cell = "<?php echo @$field_status['cell']; ?>";
        var dist = "<?php echo @$field_status['dist']; ?>";
        var teh = "<?php echo @$field_status['teh']; ?>";
        var zone = "<?php echo @$field_status['zone']; ?>";



        if(emis == 0)
        {
            if($('#Info_emis').val() < 4)
            {
                alertify.error("Please write Your Institute EMIS Code.");
                $('#Info_emis').focus();
                return false;
            }

        }
        if(email == 0){

            if($('#Info_email').val() < 2)
            {
                alertify.error("Please write Your Institute Email.");
                $('#Info_email').focus();
                return false;    
            }
            if( !isValidEmailAddress($('#Info_email').val()) ) 
            { 
                alertify.error("Please write Your VALID Institute Email.");
                $('#Info_email').focus();
                return false;
            }

        }

        if(phone == 0){
            if($('#info_phone').val() <3)
            {
                alertify.error("Please write Your Institute Phone.");
                $('#info_phone').focus();
                return false;    
            }

        }
        if(cell == 0){
            if($('#info_cellNo').val()<3)
            {
                alertify.error("Please write Your Institute Mobile No.");
                $('#info_cellNo').focus();
                return false;    
            }

        }
        if(dist == 0){
            if($('#info_dist').val() == 0)
            {
                alertify.error("Please Select Your Institute District.");
                $('#info_dist').focus();
                return false;    
            }

        }
        if(teh == 0){
            if($('#info_teh').val() == 0)
            {
                alertify.error("Please Select Your Institute Tehsil.");
                $('#info_teh').focus();
                return false;    
            }

        }
        if(zone == 0){
            if($('#info_zone').val() == 0)
            {
                alertify.error("Please Select Your Institute Zone.");
                $('#info_zone').focus();
                return false;    
            }

        }

        window.location.href = '<?=base_url()?>Registration/Incomplete_inst_info_INSERT/';
    }

    function SpecPermission_INSERT()
    {
        var inst_cd  = $("#inst_cd").val();
        var feeding_date = $("#txt_FeedingDate").val();
        var regfee   = $("#Reg_fee").val();
        var Proc_fee = $("#Proc_Fee").val();
        var spec_fee = $("#Spec_Fee").val();
        if(inst_cd == 0 )
        {
            alertify.error("Please Select Institute.");
            $('#inst_cd').focus();
            return false; 
        }
        if(feeding_date == "")
        {
            alertify.error("Please write Feeding Date.");
            $('#txt_FeedingDate').focus();
            return false; 
        }
        if(regfee == 0 || regfee == "")
        {
            alertify.error("Please write Registration Fee.");
            $('#Reg_fee').focus();
            return false; 
        }
        if(Proc_fee == 0 || Proc_fee == "")
        {
            alertify.error("Please Processing Fee.");
            $('#Proc_Fee').focus();
            return false; 
        }
        if(spec_fee == 0 || spec_fee == "")
        {
            alertify.error("Please Write Special Fee.");
            $('#Spec_Fee').focus();
            return false; 
        }

    }
    function BatchRelease_INSERT()
    {

        var Batch_Id = $('#batch_real_Id').val();
        var reason  = $('#batch_real_reason').val();;
        var bank_branch  = $('#batch_real_bankbranch').val();;
        var bank_challan  = $('#batch_real_challanno').val();;
        var paidAmount  = $('#batch_real_PaidAmount').val();;
        var paidDate  = $('#batch_real_PaidDate').val();;


        if(Batch_Id == 0)
        {

            alertify.error("Please Select Batch Again From Batch List.");
            $('#batch_real_Id').focus();
            return false;


        }
        if(reason.length < 5)
        {

            alertify.error("Please Give Strong Reason.(More than 5 words..)");
            $('#batch_real_reason').focus();
            return false;


        }
        if(bank_branch == 0)
        {

            alertify.error("Please Select Bank Branch.");
            $('#batch_real_bankbranch').focus();
            return false;


        }
        if(bank_challan == 0)
        {

            alertify.error("Please Give Bank Challan.");
            $('#batch_real_challanno').focus();
            return false;


        }
        if(paidAmount == 0)
        {

            alertify.error("Please Give Bank Paid Amount.");
            $('#batch_real_PaidAmount').focus();
            return false;


        }
        if(paidDate == '')
        {

            alertify.error("Please Give Bank Paid Amount.");
            $('#batch_real_PaidDate').focus();
            return false;


        }


        //  window.location.href = '<?=base_url()?>Registration/Batchlist_INSERT/';
    }
    function downloadslip(rno,isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNo/'+rno+'/'+isdownload

        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadslip9th(rno,isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>RollNoSlip/NinthRollNo/'+rno+'/'+isdownload
        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadgroupwise(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNoGroupwise/'+$("#std_group").val()+'/'+isdownload

        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadgroupwise12(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>RollNoSlip/InterRollNoGroupwise/'+$("#std_group").val()+'/'+isdownload

        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadgroupwise9th(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>RollNoSlip/NinthRollNoGroupwise/'+$("#std_group").val()+'/'+isdownload
        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function CancelAlert_confirmation_form()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                parent.$.fancybox.close();
                // window.location.href ='<?php echo base_url(); ?>Registration/EditForms';
            } else {
                // user clicked "cancel"

            }
        });
    }
</script>

<script type="">

    var isReadm = "<?php  echo @$isReAdm; ?>";

    if(isReadm == 0)
    {
        $( "#dob" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, maxDate:new Date(2004, 7, 1),minDate:new Date(1983, 0, 1)}).val();    
    }



    //var date2 = $('.pickupDate').datepicker('getDate', '+1d'); 
    $( "#txt_FeedingDate" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, maxDate:"+10D",minDate:-0}).val();
    $( "#corr_dob" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, maxDate:new Date(2004, 7, 1),minDate:new Date(1983, 0, 1)}).val();
    $( "#batch_real_PaidDate" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, startDate:new Date(),maxDate:new Date(),minDate: -60 }).val();
    var myOptions = {
        val1 : 'text1',
        val2 : 'text2'
    };
    var sub1_Pak_options = {
        2 : 'Urdu'
    }
    var sub1_NonPak_options = 
    {
        6 : 'Pakistan Culture',
        2 : 'Urdu'
    }
    var sub3_Muslim = 
    {
        92 :'Islamic Education'
    }
    var sub3_Non_Muslim = 
    {
        93 : 'CIVICS FOR NON MUSLIM',
        92  :'Islamic Education'
    }
    var sub5_Hum = 
    {
        92 : 'GENERAL MATHEMATICS' 
    }
    var sub6_Hum = 
    {
        0: 'SELECT SUBJECT',
        56: 'History Of Islam',  
        58: 'History of Modern World',  
        57 : 'History Of Muslim India',  
        55 : 'History Of Pakistan',  
        11: 'Economics',  
        12 : 'Geography',  
        14: 'Philosophy',  
        16 : 'Psychology',  
        32: 'Punjabi',  
        37 : 'Urdu Advance',  
        24: 'Arabic',  
        27 : 'English Literature',  
        34: 'Persian',  
        17: 'Civics',  
        18: 'Statistics',  
        19: 'Mathematics',  
        20 : 'Islamic Studies',  
        21: 'Outlines Of Home Economics',  
        23: 'Fine Arts',  
        42: 'Health And Physical Education',  
        43: 'Education',  
        45 : 'Sociology',  
        8: 'Library Science',  
        83 : 'Computer Science',  
        44: 'Geology',  
        90 : 'Agriculture',  
        79 : 'Nursing' 

    }
    var sub7_Hum = 
    {
        0 : 'NOT SELECTED',
        37: 'EDUCATION',
        26: 'CIVICS',
        25: 'ECONOMICS',
        14: 'PHYSIOLOGY & HYGIENE',
        24: 'GEOGRAPHY',
        21: 'HISTORY OF PAKISTAN',
        35: 'ENGLISH LITERATURE',
        34: 'URDU LITERATURE',
        19: 'ADVANCED ISLAMIC STUDIES',
        87: 'ENVIRONMENTAL STUDIES',
        33: 'COMMERCIAL GEOGRAPHY',
        22: 'ARABIC',
        23: 'PERSIAN',
        36: 'PUNJABI',
        20: 'ISLAMIC HISTORY / MUSLIM HISTORY',
        83: 'POULTRY FARMING',
        40: 'HEALTH & PHYSICAL EDUCATION',
        78: 'COMPUTER SCIENCE',
        15 : 'GEOMETRICAL & TECHNICAL DRAWING',
        43 : 'ELECTRICAL WIRING',
        48 : 'WOOD WORK (FURNITURE MAKING)',
        90 : 'COMPUTER HARDWARE',
        83 : 'POULTRY FARMING',
        89 : 'FISH FARMING',
        91 : 'BEAUTICIAN',
        74 : 'WEAVING'
    }
    var sub8_Hum = 
    {
        0 : 'NOT SELECTED',
        37: 'EDUCATION',
        26: 'CIVICS',
        25: 'ECONOMICS',
        14: 'PHYSIOLOGY & HYGIENE',
        24: 'GEOGRAPHY',
        21: 'HISTORY OF PAKISTAN',
        35: 'ENGLISH LITERATURE',
        34: 'URDU LITERATURE',
        19: 'ADVANCED ISLAMIC STUDIES',
        87: 'ENVIRONMENTAL STUDIES',
        33: 'COMMERCIAL GEOGRAPHY',
        22: 'ARABIC',
        23: 'PERSIAN',
        36: 'PUNJABI',
        20: 'ISLAMIC HISTORY / MUSLIM HISTORY ',
        83: 'POULTRY FARMING',
        40: 'HEALTH & PHYSICAL EDUCATION',
        78: 'COMPUTER SCIENCE',
        15 : 'GEOMETRICAL & TECHNICAL DRAWING',
        43 : 'ELECTRICAL WIRING',
        48 : 'WOOD WORK (FURNITURE MAKING)',
        90 : 'COMPUTER HARDWARE',
        83 : 'POULTRY FARMING',
        89 : 'FISH FARMING',
        91 : 'BEAUTICIAN',
        74 : 'WEAVING'
    }

    var langascd = ['22','23','36','34','35'];

    function downloadslip(rno)
    {
        window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNo/'+rno
    }
    function downloadslip_Inter(rno)
    {
        window.location.href = '<?=base_url()?>RollNoSlip/InterRollNo/'+rno+'/2'
    }
    function EditForm(formrno)
    {
        $('#sub1').empty();
        $('#sub2').empty();
        $('#sub3').empty();
        $('#sub4').empty();
        $('#sub5').empty();
        $('#sub6').empty();
        $('#sub7').empty();
        $('#sub8').empty();
        window.location.href = '<?=base_url()?>Registration/NewEnrolment_EditForm/'+formrno
    }
    function releaseForm(formrno)
    {

        window.location.href = '<?=base_url()?>migration/release_stdForm/'+formrno
    }



    function ReturnForm(Batch_ID)
    {
        window.location.href = '<?=base_url()?>Registration/return_pdf/'+Batch_ID + '/1'
    }
    function ReturnForm_Final_groupwise(grp_cd){
        window.location.href = '<?=base_url()?>Registration/return_pdf/'+grp_cd + '/2'
    }
    function ReturnForm_Final_Formnowise(startformno,endformno){
        window.location.href = '<?=base_url()?>Registration/return_pdf/'+startformno + '/3' +'/'+endformno +'/';
    }
    function ReturnForm_ProofReading_groupwise(grp_cd){
        window.location.href =  '<?=base_url()?>Registration/return_pdf/'+grp_cd + '/4'
    }
    function ReturnForm_ProofReading_Formnowise(startformno,endformno){
        window.location.href = '<?=base_url()?>Registration/return_pdf/'+startformno + '/5' +'/'+endformno+'/';
    }
    function Print_RegCards_groupwise(grp_cd){
        window.location.href = '<?=base_url()?>Registration/Reg_Cards_Printing_9th_PDF/'+grp_cd + '/2'
    }
    function Print_RegCards_Formnowise(startformno,endformno){
        window.location.href = '<?=base_url()?>Registration/Reg_Cards_Printing_9th_PDF/'+startformno + '/3' +'/'+endformno +'/';
    }
    function ChallanForm_Reg9th_Regular(Batch_ID)
    {
        window.location.href = '<?=base_url()?>Registration/ChallanForm_Reg9th_Regular/'+Batch_ID
    }
    function Print_Registration_Form_Proofreading_Groupwise(grp_cd){
        window.location.href =  '<?=base_url()?>Registration/Print_Registration_Form_Proofreading_Groupwise/'+grp_cd + '/1'
    }
    function Print_Registration_Form_Proofreading_Formnowise(startformno,endformno){
        window.location.href =  '<?=base_url()?>Registration/Print_Registration_Form_Proofreading_Groupwise/'+startformno + '/2' +'/'+endformno+'/';
    }
    $('#print_regCards').click( function(){
        var option =  $('input[type=radio][name=opt]:checked').val(); 
        //alert(option);
        //  return;
        if(option == "1")
        {
            var std_group = $('#std_group').val();
            if(std_group == "0"){
                alertify.error("Please Select a Group First !");
                return;
            }
            Print_RegCards_groupwise(std_group);
        }
        else if(option =="2")
        {
            var startformno = $('#strt_formNo').val();
            var endformno = $('#ending_formNo').val();
            if((startformno.length < 10 ||  startformno.length > 10) && (endformno.length < 10 ||  endformno.length > 10))
            {
                alertify.error("Invalid Form No.");
                return;
            }
            Print_RegCards_Formnowise(startformno,endformno);
        }
        else{
            return;
        }
    })
    $('#get_report').click( function(){
        var option =  $('input[type=radio][name=opt]:checked').val(); 
        // alert(option);
        // return;
        if(option == "1")
        {
            var std_group = $('#std_group').val();
            if(std_group == "0"){
                alertify.error("Please Select a Group First !");
                return;
            }
            ReturnForm_Final_groupwise(std_group);
        }
        else if(option =="2")
        {
            var startformno = $('#strt_formNo').val();
            var endformno = $('#ending_formNo').val();
            if((startformno.length < 10 ||  startformno.length > 10) && (endformno.length < 10 ||  endformno.length > 10))
            {
                alertify.error("Invalid Form No.");
                return;
            }
            ReturnForm_Final_Formnowise(startformno,endformno);
        }
        else{
            return;
        }
    })
    $('#get_Proof').click( function(){
        var option =  $('input[type=radio][name=opt]:checked').val(); 
        // alert(option);
        // return;
        if(option == "1")
        {
            var std_group = $('#std_group').val();
            if(std_group == "0"){
                alertify.error("Please Select a Group First !");
                return;
            }
            ReturnForm_ProofReading_groupwise(std_group);
        }
        else if(option =="2")
        {
            var startformno = $('#strt_formNo').val();
            var endformno = $('#ending_formNo').val();
            if((startformno.length < 10 ||  startformno.length > 10) && (endformno.length < 10 ||  endformno.length > 10))
            {
                alertify.error("Invalid Form No.");
                return;
            }
            ReturnForm_ProofReading_Formnowise(startformno,endformno);
        }
        else{
            return;
        }
    })
    $('#get_Proof_reg').click( function(){
        var option =  $('input[type=radio][name=opt]:checked').val(); 
        // alert(option);
        // return;
        if(option == "1")
        {
            var std_group = $('#std_group').val();
            if(std_group == "0"){
                alertify.error("Please Select a Group First !");
                return;
            }
            Print_Registration_Form_Proofreading_Groupwise(std_group);
        }
        else if(option =="2")
        {
            var startformno = $('#strt_formNo').val();
            var endformno = $('#ending_formNo').val();
            if((startformno.length < 10 ||  startformno.length > 10) && (endformno.length < 10 ||  endformno.length > 10))
            {
                alertify.error("Invalid Form No.");
                return;
            }
            Print_Registration_Form_Proofreading_Formnowise(startformno,endformno);
        }
        else{
            return;
        }
    })
    //    

    function valid_profile()
    {
        var msg = "Are You Sure You want to SKIP this Form ?"
        // alertify.error("Please write Your Institute EMIS Code.");
        var emis = $('#Profile_emis').val();
        var password = $('#Profile_password').val();
        var con_password = $('#Profile_conf_password').val();
        var phone = $('#Profile_phone').val();
        var cell = $('#Profile_cell').val();
        var email = $('#Profile_email').val();


        // alert(emis);

        // console.log(emis);
        if(emis == ""){
            alertify.error("Please write Your Institute EMIS Code.");
            $('#Profile_emis').focus();
            return false;
        }
        if(email == ""){
            alertify.error("Please write Your Institute Email Address.");
            $('#Profile_email').focus();
            return false;
        }
        if(!isValidEmailAddress(email)){
            alertify.error("Please write Your VALID Institute Email Address.");
            $('#Profile_email').focus();
            return false;
        }
        if(password == ""){
            alertify.error("Please write Your Institute Password.");
            $('#Profile_password').focus();
            return false;
        }
        if(con_password == ""){
            alertify.error("Please write Confirm Password.");
            $('#Profile_conf_password').focus();
            return false;
        }
        if(password.length < 7){
            alertify.error("Please write Your Institute Password AT LEAST 7 CHARACTERS LONG.");
            $('#Profile_password').focus();
            return false;
        }
        if((password != con_password) || (con_password != password) ){
            alertify.error("Please write SAME PASSWORDS.");
            $('#Profile_password').focus();
            return false;
        }
        if(phone == ""){
            alertify.error("Please write Your Institute Phone No.");
            $('#Profile_phone').focus();
            return false;
        }
        if(cell == ""){
            alertify.error("Please write Your Institute Mobile No.");
            $('#Profile_cell').focus();
            return false;
        }



    }

    function valid_delete_form()
    {
        var formno = $('#txtformNo_search').val();

        if(formno == "" || formno.length < 4 || formno.length > 10){
            alertify.error("Please write Valid Form No.");
            $('#txtformNo_search').focus();
            return false;
        }
    }
    function RevenueForm(Batch_ID)
    {
        window.location.href = '<?=base_url()?>Registration/revenue_pdf/'+Batch_ID+'/1'
    }
    function downForwarding()
    {
        window.location.href = '<?=base_url()?>Registration/revenue_pdf/'+Batch_ID+'/2'
    }
    function ReleaseForm(Batch_ID)
    {
        window.location.href = '<?=base_url()?>Registration/BatchRelease/'+Batch_ID

    }
    function ReleaseForm_UPDATE(Batch_ID,Inst_Cd)
    {
        var msg = "Are You Sure You want to Delete this Batch ?"
        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href = '<?=base_url()?>BiseCorrection/BatchRelease_update/'+Batch_ID +'/'+Inst_Cd+'/'
            } else {
                // user clicked "cancel"

            }
        });

    }

    function Verified_Update(Batch_ID)
    {
        var msg = "Are You Sure You want to update ?"
        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href = '<?=base_url()?>BiseCorrection/correction_update/'+Batch_ID
            } else {
                // user clicked "cancel"

            }
        });

    }

    function RestoreBatch(Batch_ID)
    {
        window.location.href = '<?=base_url()?>Registration/BatchRelease/'+Batch_ID

    }
    function RestoreBatch_UPDATE(Batch_ID,Inst_Cd)
    {
        var msg = "Are You Sure You want to Restore this Batch ?"
        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href = '<?=base_url()?>BiseCorrection/BatchRestore_update/'+Batch_ID +'/'+Inst_Cd+'/'
            } else {
                // user clicked "cancel"

            }
        });

    }


    $(document).ready(function() {


        $("#deleteForm").submit(function (e){
            e.preventDefault(); 
            var msg = "Are You Sure You want to DELETE this Form ?"
            alertify.confirm(msg, function (e) 
                {

                    if (e) {
                        // user clicked "ok"
                        window.location.href ='<?php echo base_url(); ?>BiseCorrection/Delete_Form';
                        $("#deleteForm")[0].submit();
                    } else {

                        // user clicked "cancel"

                    }

            });  
        })

        var error = "<?php echo @$error; ?>";
        if(error != ""){
            alertify.error(error);
        }
        //  console.log("Jquery working....");
        var msg = "<?php echo @$msg;?>";
        //alert(msg);
        if(msg == 'success')
        {
            alertify.success('Profile Updated Successfully!');
        }
        else if(msg == 'error')
        {
            alertify.error('Profile Not Updated. Please try again latter.');
        }
        $(function () {
            $('#cand_name').keydown(function (e) {
                if (e.shiftKey || e.ctrlKey || e.altKey) {
                    e.preventDefault();
                } else {
                    var key = e.keyCode;
                    if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                        e.preventDefault();
                    }
                }
            });
        });
        $(function () {
            $('#father_name').keydown(function (e) {
                if (e.shiftKey || e.ctrlKey || e.altKey) {
                    e.preventDefault();
                } else {
                    var key = e.keyCode;
                    if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                        e.preventDefault();
                    }
                }
            });
        });
        $(function () {
            $('#MarkOfIden').keydown(function (e) {
                if (e.shiftKey || e.ctrlKey || e.altKey) {
                    e.preventDefault();
                } else {
                    var key = e.keyCode;
                    if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                        e.preventDefault();
                    }
                }
            });
        });
        //MarkOfIden
        /* $('#cand_name').focusout(function() 
        {

        //   alertify.log('hello funciton call');
        var  name =  $('#cand_name').val();
        //(['MOHAMMAD', 'MOHAMAD', 'MHOAMAD', 'MOOHAMMAD']) 
        if ((name.toUpperCase().indexOf("MOHAMMAD") >= 0) || (name.toUpperCase().indexOf("MOHAMAD") >= 0) || (name.toUpperCase().indexOf("MUHAMAD") >= 0) || (name.toUpperCase().indexOf("MOOHAMMAD") >= 0) || (name.toUpperCase().indexOf("MOOHAMAD") >= 0) || (name.toUpperCase().indexOf("MOHD") >= 0) ) {
        alertify.error("Incorrect Speccling of MUHAMMAD");
        $('#cand_name').focus();                                    }
        })
        $('#father_name').focusout(function() 
        {
        //  debugger;
        //   alertify.log('hello funciton call');
        var  name =  $('#father_name').val();
        //(['MOHAMMAD', 'MOHAMAD', 'MHOAMAD', 'MOOHAMMAD']) 
        if ((name.toUpperCase().indexOf("MOHAMMAD") >= 0) || (name.toUpperCase().indexOf("MOHAMAD") >= 0) || (name.toUpperCase().indexOf("MUHAMAD") >= 0) || (name.toUpperCase().indexOf("MOOHAMMAD") >= 0) || (name.toUpperCase().indexOf("MOOHAMAD") >= 0) || (name.toUpperCase().indexOf("MOHD") >= 0)  ) {
        alertify.error("Incorrect Speccling of MUHAMMAD");
        $('#father_name').focus();
        }
        })*/
        $('input[type=radio][name=opt]').change(function() {
            if (this.value == '1') {
                // alert("Allot Thai Gayo Bhai");
                $('#formnowise_selected').css('display','none');
                $('#grp_selected').css('display','block');
            }
            else if (this.value == '2') {
                $('#grp_selected').css('display','none');
                $('#formnowise_selected').css('display','block');
                // $('.news').css('display','block');
                //  alert("Transfer Thai Gayo");
            }
        });

        if(grp_cd == "1")
        {

            load_PreMedical();

        }
        else if(grp_cd == "2")
        {
            load_PreEngg();

        }
        else if (grp_cd == "3")
        {
            load_Hum();

        }

        else if(grp_cd == "4")
        {

            load_GenSci();


        }
        else if(grp_cd == "5")
        {
            load_Commerce();
        }
        else if(grp_cd == "6")
        {
            load_HomeEco();
        }
        else if (grp_cd == "0")
        {
            remove_subjects();
        }

        var error_New_Enrolement ='<?php    if(@$excep != ""){echo @$excep['excep'];}  ?>';
        var  error_New_Enrolement_update ='<?php   if(@$data != ""){echo @$data[0]['excep'];}  ?>';
        console.log(error_New_Enrolement_update);
        if(error_New_Enrolement.length > 1)
        {
            if(error_New_Enrolement == "success" )
            {
                // alert('Form Submitted Successfully');
                alertify.success('Form Submitted Successfully');   
            }
            else
            {
                // alert('ehll');
                alertify.error(error_New_Enrolement);   
            }

        }
        if(error_New_Enrolement_update.length > 1)
        {
            if(error_New_Enrolement == "success" )
            {
                //alert('Form Updated Successfully');
                alertify.success('Form Updated Successfully');   
            }
            else
            {
                //  alert('ehll');
                alertify.error(error_New_Enrolement_update);   
            }

        }

        //   else if($("#std_group").val() == "2"){
        //       
        //     
        //        Hum_Deaf_Subjects();
        //            $.each(sub5_Hum,function(val,text){
        //                $("#sub5").append(new Option(text,val));
        //            });
        //             $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");
        //            $.each(sub6_Hum,function(val,text){
        //                $("#sub6").append(new Option(text,val));
        //            });
        //             $("#sub6 option[value='" + sub6 + "']").attr("selected","selected");
        //            $.each(sub7_Hum,function(val,text){
        //                $("#sub7").append(new Option(text,val));
        //            });
        //             $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");
        //            $.each(sub8_Hum,function(val,text){
        //                $("#sub8").append(new Option(text,val));
        //            });
        //             $("#sub8 option[value='" + sub8 + "']").attr("selected","selected");
        //            var Gender = $("input[name=gender]:checked").val();
        //            //console.log(Religion);
        //            console.log(Gender);
        //            if(Gender == "2")
        //            {
        //                console.log("Hi Miss :)");
        //
        //                $("#sub8").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
        //            }
        //            else
        //            {
        //                // alert('i am removed');
        //                dropdownElement.find('sub8[value=13]').remove();
        //
        //
        //            }
        //   }
        //   else  if($("#std_group").val() == "5")
        //   {
        //        Hum_Deaf_Subjects();
        //            $.each(sub5_Deaf,function(val,text){
        //                $("#sub5").append(new Option(text,val));
        //                
        //            });
        //             $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");
        //            $.each(sub6_Deaf,function(val,text){
        //                $("#sub6").append(new Option(text,val));
        //            });
        //             $("#sub6 option[value='" + sub6 + "']").attr("selected","selected");
        //            $.each(sub7_Deaf,function(val,text){
        //                $("#sub7").append(new Option(text,val));
        //            });
        //             $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");
        //            $.each(sub8_Deaf,function(val,text){
        //                $("#sub8").append(new Option(text,val));
        //            });
        //             $("#sub8 option[value='" + sub8 + "']").attr("selected","selected");
        //   }

    });

    function DeleteForm(formrno)
    {
        // var msg = "<img src='<?php echo base_url(); ?>assets/img/note_for_batch.jpg' alt='logo' style='width:800px; height: auto;' />"
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>Registration/NewEnrolment_Delete/'+formrno;
            } else {
                // user clicked "cancel"

            }
        });
        // window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNo/'+formrno
    }
    function Restore_Deleted_Form_BiseAdmin(formrno)
    {
        // var msg = "<img src='<?php echo base_url(); ?>assets/img/note_for_batch.jpg' alt='logo' style='width:800px; height: auto;' />"
        var msg = "Are You Sure You want to Restore this Form ?"
        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>BiseCorrection/Restore_form_UPDATE/'+formrno;
            } else {
                // user clicked "cancel"

            }
        });
        // window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNo/'+formrno
    }
    function Correction_form(formrno)
    {
        // var msg = "<img src='<?php echo base_url(); ?>assets/img/note_for_batch.jpg' alt='logo' style='width:800px; height: auto;' />"
        var msg = "Are You Sure You want to Apply for Correction to this Form ?"
        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>EleventhCorrection/Correction_EditForm/'+formrno;
            } else {
                // user clicked "cancel"

            }
        });
        // window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNo/'+formrno
    }
    function Correction_form_11th(formrno)
    {
        // var msg = "<img src='<?php echo base_url(); ?>assets/img/note_for_batch.jpg' alt='logo' style='width:800px; height: auto;' />"
        var msg = "Are You Sure You want to Apply for Correction to this Form ?"
        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>EleventhCorrection/Correction_EditForm/'+formrno;
            } else {
                // user clicked "cancel"

            }
        });
        // window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNo/'+formrno
    }
    function download_corr_form(formrno)
    {
        // var msg = "<img src='<?php echo base_url(); ?>assets/img/note_for_batch.jpg' alt='logo' style='width:800px; height: auto;' />"
        // var msg = "Are You Sure You want to Apply for Correction to this Form ?"
        //alertify.confirm(msg, function (e) {

        //   if (e) {
        // user clicked "ok"
        window.location.href ='<?php echo base_url(); ?>EleventhCorrection/Print_correction_Form_Final/'+formrno;
        //    } else {
        // user clicked "cancel"

        //    }
        //  });
        // window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNo/'+formrno
    }
    function download_challan_form(formrno)
    {
        // var msg = "<img src='<?php echo base_url(); ?>assets/img/note_for_batch.jpg' alt='logo' style='width:800px; height: auto;' />"
        // var msg = "Are You Sure You want to Apply for Correction to this Form ?"
        //  alertify.confirm(msg, function (e) {

        //     if (e) {
        // user clicked "ok"
        window.location.href ='<?php echo base_url(); ?>EleventhCorrection/Print_challan_Form/'+formrno;
        //    } else {
        // user clicked "cancel"

        //  }
        // });
        // window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNo/'+formrno
    }
    function download_Branch_corr_form(formrno)
    {
        // var msg = "<img src='<?php echo base_url(); ?>assets/img/note_for_batch.jpg' alt='logo' style='width:800px; height: auto;' />"
        var msg = "Are You Sure You want to Apply for Correction to this Form ?"
        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>EleventhCorrection/Print_challan_Form/'+formrno;
            } else {
                // user clicked "cancel"

            }
        });
        // window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNo/'+formrno
    }
    function Corr_App_Delete(Appno)
    {
        // var msg = "<img src='<?php echo base_url(); ?>assets/img/note_for_batch.jpg' alt='logo' style='width:800px; height: auto;' />"
        // var msg = "Are You Sure You want to Apply for Correction to this Form ?"
        //  alertify.confirm(msg, function (e) {

        //     if (e) {
        // user clicked "ok"
        window.location.href ='<?php echo base_url(); ?>EleventhCorrection/Corr_App_Delete/'+Appno;
        //    } else {
        // user clicked "cancel"

        //  }
        // });
        // window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNo/'+formrno
    }
    function downloadslip9th(rno)
    {
        window.location.href = '<?=base_url()?>RollNoSlip/NinthRollNo/'+rno
    }
    function downloadgroupwise()
    {
        window.location.href = '<?=base_url()?>RollNoSlip/MatricRollNoGroupwise/'+$("#std_group").val()
    }





    var langascd = ['24','34','32','27','37'];
    var doubleHistory = ['55','56','57','58'];
    $("#corr_sub4").change(function(){
        console.log('Hi i am corr_sub7 dropdown :) ');

        var corr_sub4 = $("#corr_sub4").val();
        var corr_sub5 = $("#corr_sub5").val();
        var corr_sub6 = $("#corr_sub6").val();


        if((corr_sub5 != 0 || corr_sub6 != 0) && corr_sub4 != 0)
        {
            if((corr_sub4 == corr_sub5)|| (corr_sub4 == corr_sub6) || (corr_sub5 == corr_sub6))    
            {
                alertify.error("Please choose Different corr_subjects" );
                $("#corr_sub4").val('0');
                return;    
            }

        }
        var valtext = 0;
        var valhistory = 0;
        var islang = 0;


        for(var i =0 ; i<langascd.length; i++)
        {
            if(corr_sub4 == langascd[i])
            {
                islang=1;
            }
            if(corr_sub5 == langascd[i])
            {
                valtext = parseInt(valtext) + 1;
            }
            if(corr_sub6 == langascd[i])
            {
                valtext = parseInt(valtext) + 1;
            }

        }
        if(islang==1 && valtext >= 1)
        {
            alertify.error("Please choose Different corr_subjects as Double Language is not allowed" );
            $("#corr_sub4").val('0');  
            return;
        }
        var ishist = 0;
        for(var i=0; i<doubleHistory.length; i++)
        {
            if(corr_sub6 == doubleHistory[i]) 
            {
                valhistory =parseInt(valhistory) + 1;
            }
            if(corr_sub5 == doubleHistory[i])
            {
                valhistory =parseInt(valhistory) + 1;
            }
            if(corr_sub4 == doubleHistory[i])
            {
                ishist = 1;
            }
        }
        if(ishist==1 &&  valhistory >= 1)
        {
            alertify.error("Please choose Different corr_subjects as Double History is not allowed" );
            $("#corr_sub4").val('0');  
            return;
        }
        /* if((corr_sub4 == 55 && corr_sub5 == 56) || (corr_sub4 == 55 && corr_sub6 == 57)  || (corr_sub4 == 56 && corr_sub6 == 55) || (corr_sub5 == 19 && corr_sub6 == 21) || (corr_sub5 == 20 && corr_sub6 == 19) || (corr_sub5 == 21 && corr_sub6 == 19)){
        alertify.error("Please choose Different corr_subjects as Double History is not allowed" );
        $("#corr_sub5").val('0');
        return;
        }*/
    })
    $("#corr_sub5").change(function(){
        console.log('Hi i am corr_sub7 dropdown :) ');
        var corr_sub4 = $("#corr_sub4").val();
        var corr_sub5 = $("#corr_sub5").val();
        var corr_sub6 = $("#corr_sub6").val();


        if( (corr_sub4 != 0 || corr_sub6 != 0) && corr_sub5 != 0)
        {
            if((corr_sub5 == corr_sub6)|| (corr_sub5 == corr_sub4) || (corr_sub4 == corr_sub6))
            {
                alertify.error("Please choose Different corr_subjects" );
                $("#corr_sub5").val('0');
                return;    
            }

        }
        var valtext = 0;
        var valhistory = 0;
        var islang = 0;
        for(var i =0 ; i<langascd.length; i++)
        {
            if(corr_sub4 == langascd[i]) 
            {
                valtext =parseInt(valtext) + 1;
            }
            if(corr_sub5 == langascd[i]) 
            {
                islang=1;
            }

            if(corr_sub6 == langascd[i])
            {
                valtext = parseInt(valtext) + 1;
            }

        }
        if(islang == 1 && valtext >= 1)
        {
            alertify.error("Please choose Different corr_subjects as Double Language is not allowed" );
            $("#corr_sub5").val('0');  
            return;
        }
        var ishist = 0;
        for(var i=0; i<doubleHistory.length; i++)
        {
            if(corr_sub4 == doubleHistory[i])
            {
                valhistory =parseInt(valhistory) + 1;
            }
            if(corr_sub5 == doubleHistory[i])
            {
                ishist = 1;
            }
            if(corr_sub6 == doubleHistory[i])
            {
                valhistory =parseInt(valhistory) + 1;
            }
        }
        if(ishist ==1 && valhistory >= 1)
        {
            alertify.error("Please choose Different corr_subjects as Double History is not allowed" );
            $("#corr_sub5").val('0');  
            return;
        }
        /* if((corr_sub4 == 55 && corr_sub5 == 56) || (corr_sub4 == 55 && corr_sub6 == 57)  || (corr_sub4 == 56 && corr_sub6 == 55) || (corr_sub5 == 19 && corr_sub6 == 21) || (corr_sub5 == 20 && corr_sub6 == 19) || (corr_sub5 == 21 && corr_sub6 == 19)){
        alertify.error("Please choose Different corr_subjects as Double History is not allowed" );
        $("#corr_sub5").val('0');
        return;
        }*/
    })
    $("#corr_sub6").change(function(){

        console.log('Hi i am corr_sub7 dropdown :) ');
        var corr_sub4 = $("#corr_sub4").val();
        var corr_sub5 = $("#corr_sub5").val();
        var corr_sub6 = $("#corr_sub6").val();


        if((corr_sub4 != 0 || corr_sub5 != 0) && corr_sub6 !=0)
        {
            if((corr_sub6 == corr_sub5)|| (corr_sub6 == corr_sub4) ||(corr_sub5 == corr_sub4))   
            {
                alertify.error("Please choose Different corr_subjects" );
                $("#corr_sub6").val('0');
                return;    
            }

        }
        var valtext = 0;
        var valhistory = 0;
        var islang = 0;
        for(var i =0 ; i<langascd.length; i++)
        {

            if(corr_sub4 == langascd[i]) 
            {
                valtext =parseInt(valtext) + 1;
            }
            if(corr_sub5 == langascd[i])
            {
                valtext = parseInt(valtext) + 1;
            }
            if(corr_sub6 == langascd[i])
            {
                islang = 1;
            }


        }
        if(islang==1 && valtext>=1)
        {
            alertify.error("Please choose Different corr_subjects as Double Language is not allowed" );
            $("#corr_sub6").val('0');  
            return;
        }
        var ishist =0;
        for(var i=0; i<doubleHistory.length; i++)
        {
            if(corr_sub4 == doubleHistory[i]) 
            {
                valhistory =parseInt(valhistory) + 1;
            }
            if(corr_sub5 == doubleHistory[i])
            {
                valhistory = parseInt(valhistory) + 1;
            }
            if(corr_sub6 == doubleHistory[i])
            {
                ishist = 1;
            }

        }
        if( ishist==1 && valhistory >=1)
        {
            alertify.error("Please choose Different corr_subjects as Double History is not allowed" );
            $("#corr_sub6").val('0');  
            return;
        }
        /* if((corr_sub4 == 55 && corr_sub5 == 56) || (corr_sub4 == 55 && corr_sub6 == 57)  || (corr_sub4 == 56 && corr_sub6 == 55) || (corr_sub5 == 19 && corr_sub6 == 21) || (corr_sub5 == 20 && corr_sub6 == 19) || (corr_sub5 == 21 && corr_sub6 == 19)){
        alertify.error("Please choose Different corr_subjects as Double History is not allowed" );
        $("#corr_sub5").val('0');
        return;
        }*/
    })
    function remove_subjects()
    {
        $("#sub5").empty();
        $("#sub5p2").empty();
        $("#sub6").empty();
        $("#sub6p2").empty();
        $("#sub7").empty();
        $("#sub7p2").empty();
        $("#sub8").empty();
        $("#sub8p2").empty();
    }
    function corr_remove_subjects()
    {
        $("#corr_sub5").empty();
        $("#corr_sub6").empty();
        $("#corr_sub7").empty();
        $("#sub8p2").empty();
    }
    $("#std_group").change(function(){


        var grp_cd = $("#std_group").val();
        //alert(grp_cd);

        // If Science with Biology group selected then 
        if(grp_cd == "1")
        {

            // Check Nationality and select appropriate Subject1 against candidate Nationality :)
            load_Bio_CS_Sub();
            $("#sub8").append(new Option('BIOLOGY',8));

        }
        else if(grp_cd == "7")
        {
            load_Bio_CS_Sub();
            $("#sub8").append(new Option('COMPUTER SCIENCE',78));
            //    alert('hello  Sweet Heart ! I love You UMMMMAH :) ') 
        }
        else if (grp_cd == "8")
        {
            load_Bio_CS_Sub();
            $("#sub8").append(new Option('ELECTRICAL WIRING (OPT)',43));
            //ELECTRICAL WIRING (OPT)
        }

        else if(grp_cd == "2")
        {

            Hum_Deaf_Subjects();
            $.each(sub5_Hum,function(val,text){
                $("#sub5").append(new Option(text,val));
            });
            $.each(sub6_Hum,function(val,text){
                $("#sub6").append(new Option(text,val));
            });

            $.each(sub7_Hum,function(val,text){

                $("#sub7").append(new Option(text,val));
            });
            $.each(sub8_Hum,function(val,text){

                $("#sub8").append(new Option(text,val));
            });
            var Elecgrp ="<?php echo @$grp_cd; ?>";
            var isgovt ="<?php echo @$isgovt; ?>";
            var b = ['8'];
            var isElec = '0';
            $.each(Elecgrp,function(i,val){
                var result=$.inArray(val,b);

                if(result!=-1)
                {
                    isElec = 1;
                }
            })

            if(isgovt == 2)
            {
                if(isElec != 1)
                {
                    // $("#sub7")
                    //$("#sub7 option[value='43']").remove();
                    //$("#sub8 option[value='43']").remove();
                    $("#sub7 option[value='43']").remove();
                    $("#sub8 option[value='43']").remove();

                    // $("#sub7").find('option[value=43]').remove();
                    // alert("removed");
                }  
            }


            var Gender = $("input[name=gender]:checked").val();
            //console.log(Religion);
            if(Gender == "2")
            {

                $("#sub8").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                $("#sub7").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
            }
            else if(Gender == "1")
            {
                // alert('i am removed');

                // dropdownElement.find('sub8[value=13]').remove();


            }


        }
        else if(grp_cd == "5")
        {
            Hum_Deaf_Subjects();
            $.each(sub5_Deaf,function(val,text){
                $("#sub5").append(new Option(text,val));
            });
            $.each(sub6_Deaf,function(val,text){
                $("#sub6").append(new Option(text,val));
            });
            $.each(sub7_Deaf,function(val,text){
                $("#sub7").append(new Option(text,val));
            });
            $.each(sub8_Deaf,function(val,text){
                $("#sub8").append(new Option(text,val));
            });
        }
        else if (grp_cd == "0")
        {
            remove_subjects();
        }


    });

    function load_PreMedical()
    {
        $("#corr_sub1").empty();
        $("#corr_sub2").empty();
        $("#corr_sub3").empty();
        $("#corr_sub4").empty();
        $("#corr_sub5").empty();
        $("#corr_sub6").empty();
        $("#corr_sub7").empty();
        $("#corr_sub7").empty().append('<option selected="selected" value="0">NONE</option>');
        $("#corr_sub8").empty().append('<option selected="selected" value="0">NONE</option>');
        var NationalityVal = $("#hid_nat").val();
        //alert('nat ' + NationalityVal);
        //debugger;
        //console.log('matric_corr_sub1.value = ' +matric_corr_sub1.value + '  and Nationaliy = '+ NationalityVal);

        if(NationalityVal==2)
        {
            $("#corr_sub1").prepend("<option selected='selected' value='6'>PAKISTANI CULTURE</option>");

            $("#corr_sub1").append(new Option('Urdu',2));    
        }
        else{
            $("#corr_sub1").prepend("<option  value='2'> URDU </option>");
        }  

        $("#corr_sub1 option[value='2']").attr("selected","selected");
        $("#corr_sub2").append(new Option('English',1));
        $("#corr_sub2 option[value='1']").attr("selected","selected");
         //$("#corr_sub3").prepend("<option  value='93'> CIVICS FOR NON MUSLIM </option>");
       // $("#corr_sub3").append(new Option('ETHICS',51));
        $("#corr_sub3").append(new Option('CIVICS FOR NON MUSLIM',93));
       
        $("#corr_sub3").append(new Option('Islamic Education',92));
        $("#corr_sub3 option[value='92']").attr("selected","selected");
        $("#corr_sub4").append(new Option('Physics',47));
        $("#corr_sub4 option[value='47']").attr("selected","selected");
        $("#corr_sub5").append(new Option('Chemistry',48));
        $("#corr_sub5 option[value='48']").attr("selected","selected");
        $("#corr_sub6").append(new Option('Biology',46));
        $("#corr_sub6 option[value='46']").attr("selected","selected");
    }
    function load_PreEngg()
    {
        $("#corr_sub1").empty();
        $("#corr_sub2").empty();
        $("#corr_sub3").empty();
        $("#corr_sub4").empty();
        $("#corr_sub5").empty();
        $("#corr_sub6").empty();
        $("#corr_sub7").empty();
        $("#corr_sub7").empty().append('<option selected="selected" value="0">NONE</option>');
        $("#corr_sub8").empty().append('<option selected="selected" value="0">NONE</option>');
        var NationalityVal = $("#hid_nat").val();
        if(NationalityVal==2)
        {
            $("#corr_sub1").prepend("<option selected='selected' value='6'>PAKISTANI CULTURE</option>");

            $("#corr_sub1").append(new Option('Urdu',2));    
        }
        else{
            $("#corr_sub1").prepend("<option  value='2'> URDU </option>");
        } 
        // $("#corr_sub1").append(new Option('Urdu',2));
        $("#corr_sub1 option[value='2']").attr("selected","selected");
        $("#corr_sub2").append(new Option('English',1));
        $("#corr_sub2 option[value='1']").attr("selected","selected");
        $("#corr_sub3").append(new Option('Islamic Education',92));
        $("#corr_sub3 option[value='92']").attr("selected","selected");
        $("#corr_sub4").append(new Option('Physics',47));
        $("#corr_sub4 option[value='47']").attr("selected","selected");
        $("#corr_sub5").append(new Option('Chemistry',48));
        $("#corr_sub5 option[value='48']").attr("selected","selected");
        $("#corr_sub6").append(new Option('Mathematics',19));
        $("#corr_sub6 option[value='19']").attr("selected","selected");
    }
    function load_GenSci()
    {
        $("#corr_sub1").empty();
        $("#corr_sub2").empty();
        $("#corr_sub3").empty();
        $("#corr_sub4").empty();
        $("#corr_sub5").empty();
        $("#corr_sub6").empty();
        $("#corr_sub7").empty().append('<option selected="selected" value="0">NONE</option>');
        $("#corr_sub8").empty().append('<option selected="selected" value="0">NONE</option>');

        var NationalityVal = $("#hid_nat").val();

        if(NationalityVal==2)
        {
            $("#corr_sub1").prepend("<option selected='selected' value='6'>PAKISTANI CULTURE</option>");

            $("#corr_sub1").append(new Option('Urdu',2));    
        }
        else{
            $("#corr_sub1").prepend("<option  value='2'> URDU </option>");
        }  
        // $("#corr_sub1").append(new Option('Urdu',2));
        $("#corr_sub1 option[value='2']").attr("selected","selected");
        $("#corr_sub2").append(new Option('English',1));
        $("#corr_sub2 option[value='1']").attr("selected","selected");
        $("#corr_sub3").append(new Option('Islamic Education',92));
        $("#corr_sub3 option[value='92']").attr("selected","selected");
        $("#corr_sub4").append(new Option('Mathematics',19));
        $("#corr_sub4 option[value='19']").attr("selected","selected");

        $("#corr_sub5").append(new Option('Physics',47));
        $("#corr_sub5").append(new Option('Economics',11));
        $("#corr_sub5").append(new Option('Statistics',18));
        $("#corr_sub5 option[value='47']").attr("selected","selected");

        $("#corr_sub6").append(new Option('Computer Science',83));
        $("#corr_sub6").append(new Option('Economics',11));
        $("#corr_sub6").append(new Option('Statistics',18));
        $("#corr_sub6 option[value='83']").attr("selected","selected");
    }
    function load_Commerce()
    {
        $("#corr_sub1").empty();
        $("#corr_sub2").empty();
        $("#corr_sub3").empty();
        $("#corr_sub4").empty();
        $("#corr_sub5").empty();
        $("#corr_sub6").empty();
        $("#corr_sub7").empty();
        $("#corr_sub8").empty().append('<option selected="selected" value="0">NONE</option>');
        var NationalityVal = $("#hid_nat").val();
        if(NationalityVal==2)
        {
            $("#corr_sub1").prepend("<option selected='selected' value='6'>PAKISTANI CULTURE</option>");

            $("#corr_sub1").append(new Option('Urdu',2));    
        }
        else{
            $("#corr_sub1").prepend("<option  value='2'> URDU </option>");
        }   
        //$("#corr_sub1").append(new Option('Urdu',2));
        $("#corr_sub1 option[value='2']").attr("selected","selected");
        $("#corr_sub2").append(new Option('English',1));
        $("#corr_sub2 option[value='1']").attr("selected","selected");
        $("#corr_sub3").append(new Option('Islamic Education',92));
        $("#corr_sub3 option[value='92']").attr("selected","selected");


        $("#corr_sub4").append(new Option('Principles Of Accounting',70));
        $("#corr_sub4 option[value='70']").attr("selected","selected");

        $("#corr_sub5").append(new Option('Principles Of Economics',71));
        $("#corr_sub5 option[value='71']").attr("selected","selected");

        $("#corr_sub6").append(new Option('Business Math',80));
        $("#corr_sub6 option[value='80']").attr("selected","selected");

        $("#corr_sub7").show();
        $("#corr_sub7").append(new Option('Principles Of Commerce',39));
        $("#corr_sub7 option[value='39']").attr("selected","selected");
    }

    function load_HomeEco()
    {
        $("#corr_sub1").empty();
        $("#corr_sub2").empty();
        $("#corr_sub3").empty();
        $("#corr_sub4").empty();
        $("#corr_sub5").empty();
        $("#corr_sub6").empty();
        $("#corr_sub7").empty();
        $("#corr_sub8").empty();
        var NationalityVal = $("#hid_nat").val();
        if(NationalityVal==2)
        {
            $("#corr_sub1").prepend("<option selected='selected' value='6'>PAKISTANI CULTURE</option>");

            $("#corr_sub1").append(new Option('Urdu',2));    
        }
        else{
            $("#corr_sub1").prepend("<option  value='2'> URDU </option>");
        }   
        // $("#corr_sub1").append(new Option('Urdu',2));
        $("#corr_sub1 option[value='2']").attr("selected","selected");
        $("#corr_sub2").append(new Option('English',1));
        $("#corr_sub2 option[value='1']").attr("selected","selected");
        $("#corr_sub3").append(new Option('Islamic Education',92));
        $("#corr_sub3 option[value='92']").attr("selected","selected");


        $("#corr_sub4").append(new Option('CHEMISTRY (Home-Economics Group)',73));
        $("#corr_sub4 option[value='48']").attr("selected","selected");

        $("#corr_sub5").append(new Option('BIOLOGY (Home-Economics Group)',72));
        $("#corr_sub5 option[value='46']").attr("selected","selected");

        $("#corr_sub6").append(new Option('Clothing and Textile',75));
        $("#corr_sub6 option[value='75']").attr("selected","selected");

        $("#corr_sub7").show();
        $("#corr_sub7").append(new Option('Home Management',76));
        $("#corr_sub7 option[value='76']").attr("selected","selected");
    }

    function load_Hum(){

        $("#corr_sub1").empty();
        $("#corr_sub2").empty();
        $("#corr_sub3").empty();
        $("#corr_sub4").empty();
        $("#corr_sub5").empty();
        $("#corr_sub6").empty();
        $("#corr_sub7").empty();
        $("#corr_sub7").empty().append('<option selected="selected" value="0">NONE</option>');
        $("#corr_sub8").empty().append('<option selected="selected" value="0">NONE</option>');
        var NationalityVal = $("#hid_nat").val();
        var gender_ = $("#hid_sex").val();
        if(NationalityVal==2)
        {
            $("#corr_sub1").prepend("<option selected='selected' value='6'>PAKISTANI CULTURE</option>");

            $("#corr_sub1").append(new Option('Urdu',2));    
        }
        else{
            $("#corr_sub1").prepend("<option  value='2'> URDU </option>");
        }  
        // $("#corr_sub1").append(new Option('Urdu',2));
        $("#corr_sub1 option[value='2']").attr("selected","selected");
        $("#corr_sub2").append(new Option('English',1));
        $("#corr_sub2 option[value='1']").attr("selected","selected");
        $("#corr_sub3").append(new Option('Islamic Education',92));
        $("#corr_sub3").append(new Option('CIVICS FOR NON MUSLIM',93));
        $("#corr_sub3 option[value='92']").attr("selected","selected");
        $.each(sub6_Hum, function(val, text) {
        
             if(gender_ == 1 && val == 21)
             {
            
             }
             else
             {
             $('#corr_sub4').append( new Option(text,val) ); 
             }
             
            
        }); 
        $.each(sub6_Hum, function(val, text) {
        if(gender_ == 1 && val == 21)
             {
            
             }
             else
             {
            $('#corr_sub5').append( new Option(text,val) );
             }
            
        }); 
        $.each(sub6_Hum, function(val, text) {
        if(gender_ == 1 && val == 21)
             {
            
             }
             else
             {
            $('#corr_sub6').append( new Option(text,val) );
             }
           
        }); 
        // $("#sub6 option[value='" + sub1 + "']").attr("selected","selected");

    }
    function remove_subjects()
    {
        $("#corr_sub1").empty();
        $("#corr_sub2").empty();
        $("#corr_sub3").empty();
        $("#corr_sub4").empty();
        $("#corr_sub5").empty();
        $("#corr_sub6").empty();
        $("#corr_sub7").empty();
        $("#corr_sub7").hide();
    }
    $("#corr_std_group").change(function(){


        var grp_cd = $("#corr_std_group").val();
        //alert(grp_cd);

        // If Science with Biology group selected then 
        if(grp_cd == "1")
        {


            // Check Nationality and select appropriate Subject1 against candidate Nationality :)
            // load_Bio_CS_Sub();
            //  $("#sub8").append(new Option('Biology',8));
            load_PreMedical();

        }
        else if(grp_cd == "2")
        {
            load_PreEngg();
            // load_Bio_CS_Sub();
            //   $("#sub8").append(new Option('COMPUTER SCIENCE',78));
            //    alert('hello  Sweet Heart ! I love You UMMMMAH :) ') 
        }
        else if (grp_cd == "3")
        {
            load_Hum();
            //    load_Bio_CS_Sub();
            //    $("#sub8").append(new Option('ELECTRICAL WIRING (OPT)',43));
            //ELECTRICAL WIRING (OPT)
        }

        else if(grp_cd == "4")
        {

            load_GenSci();


        }
        else if(grp_cd == "5")
        {
            load_Commerce();
        }
        else if(grp_cd == "6")
        {
            load_HomeEco();
        }
        else if (grp_cd == "0")
        {
            remove_subjects();
        }



        else if(grp_cd == "5")
        {
            corr_Hum_Deaf_Subjects();
            $.each(sub5_Deaf,function(val,text){
                $("#corr_sub5").append(new Option(text,val));
            });
            $.each(sub6_Deaf,function(val,text){
                $("#corr_sub6").append(new Option(text,val));
            });
            $.each(sub7_Deaf,function(val,text){
                $("#corr_sub7").append(new Option(text,val));
            });
            $.each(sub8_Deaf,function(val,text){
                $("#corr_sub8").append(new Option(text,val));
            });
        }
        else if (grp_cd == "0")
        {
            corr_remove_subjects();
        }


    });

    //   $("#registration").validate();
    //$("#cand_name").focus();
    /*
    ===========================================
    MASKINGS Settings
    ===========================================
    */
    var grp_cd = $("#std_group").val();
    if(grp_cd == "1")
    {

        load_PreMedical();

    }
    else if(grp_cd == "2")
    {
        load_PreEngg();

    }
    else if (grp_cd == "3")
    {
        load_Hum();

    }

    else if(grp_cd == "4")
    {

        load_GenSci();


    }
    else if(grp_cd == "5")
    {
        load_Commerce();
    }
    else if(grp_cd == "6")
    {
        load_HomeEco();
    }
    else if (grp_cd == "0")
    {
        remove_subjects();
    }
    var phone = "<?php echo @$field_status['phone']; ?>";
    var cell = "<?php echo @$field_status['cell']; ?>";
    var emis = "<?php echo @$field_status['emis']; ?>";
    $("#bay_form,#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
    $("#corr_bay_form,#corr_father_cnic").mask("99999-9999999-9",{placeholder:"_"});
    $("#dob,#dateofadmission").mask("99-99-9999",{placeholder:"_"});
    $("#mob_number").mask("9999-9999999",{placeholder:"_"});
    $("#Profile_cell").mask("9999-9999999",{placeholder:"_"});
    $("#Profile_phone").mask("999-9999999",{placeholder:"_"});

    if(phone =='0'){
        $("#info_phone").mask("999-9999999",{placeholder:"_"});
    }
    if(cell == '0'){
        $("#info_cellNo").mask("9999-9999999",{placeholder:"_"});
    }
    if(cell == '0'){
        $("#Info_emis").mask("99999990",{placeholder:""});
    }

    // $("#registration").validate();
    //  $("#cand_name").focus();

    function  check_migration_validation(){

        var grp_cd = $('#migrateto').val();

        var status = 0;




        if ($("#migrateto").find('option:selected').val() < 1) 
        {
            alertify.error("Please Select Migrate To Inst.") ;
            // alert('Study Group not selected ');                          
            $("#migrateto").focus();
            return status;  
        }

        status = 1;
        return status;




    }


    function  check_NewEnrol_validation(){
        var name =  $('#cand_name').val();
        var dist_cd= $('#dist option:selected').val();
        var teh_cd= $('#teh').val();
        var zone_cd= $('#zone').val();
        var pp_cent= $('#pp_cent').val();           
        var sub6p1 = $('#sub5').val();
        var sub6p2 = $('#sub6').val();           
        var sub7p1 = $('#sub7').val();
        var sub7p2 = $('#sub8').val();                      
        var ex_type = $('#exam_type').val();
        var mobNo = $('#mob_number').val();
        var bFormNo = $('#bay_form').val();
        var grp_cd = $('#std_group').val();
        var brd_cd = $('#brd_cd').val();
        var fName = $('#father_name').val();
        var FNic = $('#father_cnic').val();
        var dob = $('#dob').val();
        var address = $('#address').val();
        var image = $('#image').val();
        var MarkOfIdent = $('#MarkOfIden').val();
        var Inst_Rno = $('#Inst_Rno').val();
        var status = 0;
        // alert('sub6 '+sub6p1+ ' and '+ sub6p2);
        if(name == "" ||  name == undefined){
            $('#ErrMsg').show();  
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your  Name </b>");    

            $('#cand_name').focus(); 
            return status;
        }
        else if(fName == "" || fName == undefined){
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Father's Name  </b>");    
            $('#father_name').focus(); 
            return status;
        }   

        else if(bFormNo == "" || bFormNo == 0 || bFormNo == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your bay-Form</b>"); 
            $('#bay_form').focus();  
            return status; 
        }
        else if(FNic == "" || FNic.length == undefined )
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Father's CNIC</b>"); 
            $('#father_cnic').focus();  
            return status; 
        }

        else if(dob == "" || dob.length == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Date of Birth</b>"); 
            $('#dob').focus(); 
            return status;  
        }

        else if(mobNo == "" || mobNo == 0 || mobNo == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Mobile No.</b>"); 
            $('#mob_number').focus();   
            return status;  
        }
        else if(Inst_Rno == "" || Inst_Rno == 0 || Inst_Rno== undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Institute Roll No.</b>"); 
            $('#Inst_Rno').focus();   
            return status;  
        }
        else if(MarkOfIdent == "" || MarkOfIdent == 0 || MarkOfIdent == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Mark of Indentification</b>"); 
            $('#MarkOfIden').focus();   
            return status;  
        }
        else if(address == "" || address == 0 || address.length ==undefined )
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Address</b>"); 
            $('#address').focus(); 
            return status;    
        }

        /*                  else  if ($("#dist").find('option:selected').val() < 1) 
        {

        alert('Please select District '); 
        $("#dist").focus();

        return status;  
        }

        else   if ($("#teh").find('option:selected').val() < 1) {

        alert('Please select Tehsil');                          
        $("#teh").focus();
        return status;  
        }
        else  if ($("#zone").find('option:selected').val() < 1) {

        alert('Please select Zone. ');                          
        $("#zone").focus();
        return status;  
        }
        */

        else   if ($("#std_group").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Study Group</b>"); 
            // alert('Study Group not selected ');                          
            $("#std_group").focus();
            return status;  
        }
        else   if ($("#sub3").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            alert('Plesae select  Subject');                          
            $("#sub3").focus();

            return status;  
        }
        else   if ($("#sub5").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            alert('Plesae select Subject');                          
            $("#sub5").focus();

            return status;  
        }

        else   if ($("#sub6").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Plesae select 6th Subject  </b>"); 
            // alert('Plesae select 6th Subject  ');                          
            $("#sub6").focus();
            return status;  
        }

        else   if ($("#sub7").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Plesae select 7th Subject  </b>"); 
            //alert('Plesae select 7th Subject ');                          
            $("#sub7").focus();
            return status;  
        }

        else   if ($("#sub8").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Plesae select 8th Subject  </b>"); 
            //alert('Plesae select 8th Subject ');                          
            $("#sub8").focus();
            return status;  
        }

        status = 1;
        return status;




    }
    /*
    ===========================================
    Validations
    ===========================================
    */
    var nationality = $('input:radio[name="nationality"]:checked').val();
    if(nationality == 1) {
        $("#bay_form","#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
    }else{
        $("#bay_form","#father_cnic").mask("****************************",{placeholder:""});
    }

    $('input:radio[name="nationality"]').change(function(){
        if($(this).val() == 1) {
            $("#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
            $("#bay_form").mask("99999-9999999-9",{placeholder:"_"});
            $("#sub1").empty(); 
            $("#sub1").prepend('<option selected="selected" value="1"> URDU </option>');
            //$("#ddlList").prepend('<option selected="selected" value="0"> Select </option>');
        }else{
            //$("#father_cnic").mask("****************************",{placeholder:""});
            $("#father_cnic").unmask();
            $("#bay_form").unmask();
            $("#sub1").empty(); 
            $("#sub1").prepend("<option selected='selected' value='11'> GEOGRAPHY OF PAKISTAN </option>");
            $("#sub1").prepend("<option  value='1'> URDU </option>");
        }
    });

    $('input:radio[name="religion"]').change(function(){
        if($(this).val() == 1) {

            $("#sub3").empty(); 
            $("#sub3").prepend('<option selected="selected" value="3">ISLAMIYAT (COMPULSORY)</option>');
            //$("#ddlList").prepend('<option selected="selected" value="0"> Select </option>');
        }else{
            //$("#father_cnic").mask("****************************",{placeholder:""});

            $("#sub3").empty(); 
            $("#sub3").prepend("<option  value='93'> CIVICS FOR NON MUSLIM </option>");
            $("#sub3").prepend("<option  value='3'>ISLAMIYAT (COMPULSORY)</option>");
        }
    });

    var is_muslim    = $('input:radio[name="religion"]:checked').val();  
    var is_pakistani = $('input:radio[name="nationality"]:checked').val(); 
    var gender = $('input:radio[name="gender"]:checked').val(); 
    var id           = $('#std_group').val();

    $('input[type=radio][name=batch_opt]').change(function() {
        // debugger;
        // alert(this.value + "  Transfer Thai Gayo");
        if (this.value == '1') {
            window.location.href = '<?=base_url()?>Registration/CreateBatch/'+'96/1/';
            // alert("Allot Thai Gayo Bhai");
        }
        else  if (this.value == '2') {
            window.location.href = '<?=base_url()?>Registration/CreateBatch/'+'97/2/';
            //  alert("Transfer Thai Gayo");
        }
        else  if(this.value == 3){
            window.location.href = '<?=base_url()?>Registration/CreateBatch/'+'98/3';
            //alert("Transfer Thai Gayo");
        }

    });

    $( "#std_groups" ).change(function () {
        if (this.value == '1') {
            // 1 biology   2 humanities   5 deaf and dumb  7 computer science  8 electrical wiring 
            window.location.href = '<?=base_url()?>Registration/CreateBatch/'+'96/3/1/';
            //  alert("Allot Thai Gayo Bhai");
        }
        else  if (this.value == '2') {
            window.location.href = '<?=base_url()?>Registration/CreateBatch/'+'97/3/2/';
            // alert("Transfer Thai Gayo");
        }
        else  if(this.value == '5'){
            window.location.href = '<?=base_url()?>Registration/CreateBatch/'+'98/3/5/';
            // alert("Transfer Thai Gayo");
        }
        else  if(this.value == '7'){
            window.location.href = '<?=base_url()?>Registration/CreateBatch/'+'98/3/7/';
            //  alert("Transfer Thai Gayo");
        }
        else  if(this.value == '8'){
            window.location.href = '<?=base_url()?>Registration/CreateBatch/'+'98/3/8/';
            //  alert("Transfer Thai Gayo");
        }

    })
    /*     }
    $( "select option:selected" ).each(function() {
    str += $( this ).text() + " ";
    });
    $( "div" ).text( str );*/





</script>

<script type="">
    var msg_cd = "<?php  echo @$msg_status;  ?>";
    if(msg_cd == "0")
    {
        //  alert("alertify.success(Hello )"); success
    }
    else if(msg_cd == "success")
    {
        alertify.success('Form Updated Successfully! ');
    }
    else if(msg_cd == "3")
    {
        alertify.error("No Students in this Group!");
    }
    function makebatch_groupwise(){

        // user clicked "ok"
        var option =  $('input[type=radio][name=batch_opt]:checked').val(); 
        if(option == "3")
        {
            if($("#std_groups").val() == ""  || $("#std_groups").val() == 0)
            {
                alertify.error("Please Select Group First!") ;
            }
            else{
                var msg = "<img src='<?php echo base_url(); ?>assets/img/note_for_batch.jpg' alt='logo' style='width:800px; height: auto;' />"
                //var msg = "Are You Sure You want to Cancel this Form ? <img src='<?php echo base_url(); ?>assets/img/note_for_batch.jpg' alt='logo' style='width:30px; height: 50px;' />"
                alertify.confirm(msg, function (e) {

                    if (e) {
                        window.location.href = '<?=base_url()?>Registration/Make_Batch_Group_wise/'+$("#std_groups").val()+'/0';
                    } 


                });
            }
        }
        else if(option == "1" || option == "2")
        {
            window.location.href = '<?=base_url()?>Registration/Make_Batch_Group_wise/'+'0/'+option+'/';
        }
        return false;



    }
    function makebatch_formnowise(){

        if( $('input[name="chk[]"]:checked').length > 0 )
        {
            var msg = "<img src='<?php echo base_url(); ?>assets/img/note_for_batch.jpg' alt='logo' style='width:800px; height: auto;' />"

            alertify.confirm(msg, function (e) {

                if (e) {
                    // user clicked "ok"
                    $( "#frmchk" ).submit();
                }
                else {
                    // user clicked "cancel"

                }
            });

        }
        else
        {
            alertify.error("Please Select Forms First!") ;
            return false;
        }
    }
    function logout(){
        var msg = "Are you Sure You want to LOGOUT?"

        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>login/logout';
            } 
        });
    }
    $(function() {
        // gather all inputs of selected types
        var inputs = $('input, textarea, select, button'), inputTo;

        // bind on keydown
        inputs.on('keydown', function(e) {

            // if we pressed the tab
            if (e.keyCode == 9 || e.which == 9) {
                // prevent default tab action
                e.preventDefault();

                if (e.shiftKey) {
                    // get previous input based on the current input
                    inputTo = inputs.get(inputs.index(this) - 1);
                } else {
                    // get next input based on the current input
                    inputTo = inputs.get(inputs.index(this) + 1);
                }

                // move focus to inputTo, otherwise focus first input
                if (inputTo) {
                    inputTo.focus();
                } else {
                    inputs[0].focus();
                }
            }
        });
    });   
    function uplaodpics()
    {
        $( "#uplodpics" ).submit();
    }
    var error_BatchRelease = "<?php  echo @$BatchRelease_excep; ?>";
    var success_BatchRelease = "<?php  echo @$errors['BatchRelease_excep']; ?>";
    var BatchRelease_Op = "<?php  echo @$errors_RB_update; ?>";
    var BatchRestore_Op = "<?php  echo @$errors_RB_restore; ?>";
    var spec_case_inst = "<?php   echo @$msg; ?>"
    var excep_Invalid_formno = "<?php  echo @$excep; ?>"
    var restore_msg = "<?php   echo  @$restore_msg; ?>"

    if (excep_Invalid_formno == "success")
    {
        alertify.success("Updated Successfully");
    }
    else  if (excep_Invalid_formno != "")
    {
        alertify.error("Invalid Form No. Please write Valid Form No.");
    }
    else  if(restore_msg!="")
    {
        alertify.success(restore_msg);
    }

    if(restore_msg!="")
    {
        alertify.success(restore_msg);
    }

    if(spec_case_inst == "Saved")
    {
        alertify.success("Saved Successfully");
    }
    else if (spec_case_inst == "'Not Saved")
    {
        alertify.error("NOT SAVED due to some Problem, Please Try Again later.");
    }
    if(BatchRelease_Op != "")
    {
        if(BatchRelease_Op == "success")
        {
            alertify.success("Batch Release Successfully");    
        }
        else if(BatchRelease_Op == "Fail")
        {
            alertify.error("A Problem occur, Please Try Again later.");
        }

    } 
    if(BatchRestore_Op != "")
    {
        if(BatchRelease_Op == "success")
        {
            alertify.success("Batch Restored Successfully");    
        }
        else if(BatchRelease_Op == "Fail")
        {
            alertify.error("A Problem occur, Please Try Again later.");
        }

    } 
    if(success_BatchRelease != "")
    {
        alertify.success(success_BatchRelease);
    } 
    if(error_BatchRelease != "")
    {
        alertify.error(error_BatchRelease);
    }  



</script>
<script type="">
    var error = '<?php echo @$error_msg; ?>';
    if(error > 0){
        alertify.error("Currently there is not student against this subject group.!") ;
    }



</script>

</body>
</html>