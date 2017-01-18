<footer>
    <p>
        &copy; <?php echo Year; ?> BISE Gujranwala All Rights Reserved.
    </p>
</footer>

<!--Add the following script at the bottom of the web page (before </body></html>)-->
<!--<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=93646887"></script>-->

<script src="<?php echo base_url(); ?>assets/js_matric/jquery-1.8.3.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js_matric/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js_matric/jquery.maskedinput.js"></script>
<script src="<?php echo base_url(); ?>assets/js_matric/noty/jquery.noty.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wysiwyg/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js_matric/noty/layouts/bottom.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js_matric/noty/themes/default.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js_matric/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>    


</body>
</html>

<script type="text/javascript">

    $(document).ready(function(){


        $('.mPageloader').hide();
        $("#pvtinfo_dist").change(function(){
            var distId =  $("#pvtinfo_dist").val();
            $('#pvtinfo_teh').empty();
            $('#pvtinfo_teh').append('<option value="0">SELECT TEHSIL</option>');
            $('#pvtZone').empty();
            $('#pvtZone').append('<option value="0">SELECT ZONE</option>');
            if(distId == 1){
                $("#pvtinfo_teh").append('<option value="1">KAMOKE</option>');
                $("#pvtinfo_teh").append('<option value="2">GUJRANWALA</option>');
                $("#pvtinfo_teh").append('<option value="3">WAZIRABAD</option>');
                $("#pvtinfo_teh").append('<option value="4">NOWSHERA VIRKAN</option>'); 
            }
            else if(distId == 2){
                $("#pvtinfo_teh").append('<option value="5">GUJRAT</option>');
                $("#pvtinfo_teh").append('<option value="6">KHARIAN</option>');
                $("#pvtinfo_teh").append('<option value="7">SARAI ALAMGIR</option>');
            }
            else if(distId == 3){
                $("#pvtinfo_teh").append('<option value="8">HAFIZABAD</option>');
                $("#pvtinfo_teh").append('<option value="9">PINDI BHATTIAN</option>');
            }
            else if(distId == 4){
                $("#pvtinfo_teh").append('<option value="10">MANDI BAHA-UD-DIN</option>');
                $("#pvtinfo_teh").append('<option value="11">PHALIA</option>');
                $("#pvtinfo_teh").append('<option value="12">MALAKWAL</option>');
            }
            else if(distId == 5){
                $("#pvtinfo_teh").append('<option value="13">NAROWAL</option>');
                $("#pvtinfo_teh").append('<option value="14">SHAKARGARH</option>');
                $("#pvtinfo_teh").append('<option value="19">ZAFARWAL</option>');
            }
            else if(distId == 6){
                $("#pvtinfo_teh").append('<option value="15">SIALKOT</option>');
                $("#pvtinfo_teh").append('<option value="16">PASRUR</option>');
                $("#pvtinfo_teh").append('<option value="17">DASKA</option>');
                $("#pvtinfo_teh").append('<option value="18">SAMBRIAL</option>');
            }


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


        $("#pvtinfo_teh").change(function(){
            var tehId =  $("#pvtinfo_teh").val();

            //  debugger;
            gender =  $("input[name=gender]:checked").val();
            if( gender == undefined )
            {
                gender = $("#gend").val();
            }
            if(gender == "" || gender == 0 || gender == undefined  || gender.length == undefined)
            {
                alertify.error("Select Gender First");
            }

            else if(tehId == 0){
                alertify.error("Select Zone First");
            }
            else{

                jQuery.ajax({

                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/Admission/getzone/",
                    dataType: 'json',
                    data: {tehCode: tehId,'gend':gender},
                    beforeSend: function() {  $('.mPageloader').show(); },
                    complete: function() { $('.mPageloader').hide();},
                    success: function(json) {
                        var listitems;

                        $('#pvtZone').empty();
                        $('#pvtZone').append('<option value="0">SELECT ZONE</option>');
                        $.each(json, function (key, data) {

                            $.each(data, function (index, data) {

                                listitems +='<option value=' + data.zone_cd + '>' + data.zone_name + '</option>';
                            })
                        })
                        $('#pvtZone').append(listitems)
                    },
                    error: function(request, status, error){
                        alert(request.responseText);
                    }
                });
            }

        })

        $("#pvtZone").change(function(){


            var tehId =  $("#pvtZone").val();
            var  gender =  $("input[name=gender]:checked").val();
            if( gender == undefined )
            {
                gender = $("#gend").val();
            }
            if(gender == "" || gender == 0 || gender == undefined  || gender.length == undefined)
            {
                alertify.error("Select Gender First");
            }

            else if(tehId == 0){
                alertify.error("Select Zone First");
            }

            else{
                jQuery.ajax({

                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/Admission/getcenter/",
                    dataType: 'json',
                    data: {pvtZone: tehId,'gend':gender},
                    beforeSend: function() {  $('.mPageloader').show(); },
                    complete: function() { $('.mPageloader').hide();},
                    success: function(json) {
                        var listitems='';
                        $.each(json.center, function (key, data) {
                            listitems +='<label style="text-align: left; margin-top: -23px;">'+data.CENT_CD + '-' + data.CENT_NAME+'</label><br>';
                        })
                        $('#instruction').html('<h1 style="    margin-bottom: 28px;">Selected Zone Centre List </h1>'+listitems); 
                        $.fancybox("#instruction");
                    },
                    error: function(request, status, error){
                        alert(request.responseText);
                    }
                });

            }

        })

        var Insert_server_error= "<?php  echo @$data['Insert_server_error']; ?>";
        if(Insert_server_error !='')
        {
            alertify.error(Insert_server_error);
        }
    });

    function check_NewEnrol_validation_Fresh()
    {

        var inputimage = $("#picname").val();  
        var name =  $('#cand_name').val();
        var fName = $('#father_name').val();
        var bFormNo = $('#bay_form').val();
        var FNic = $('#father_cnic').val();
        var dist_cd= $('#pvtinfo_dist option:selected').val();
        var teh_cd= $('#pvtinfo_teh').val();
        var zone_cd= $('#pvtZone').val();
        var mobNo = $('#mob_number').val();
        var grp_cd = $('#std_group').val();
        var address = $('#address').val();
        var MarkOfIdent = $('#MarkOfIden').val();
        var medium= $('#medium option:selected').val();
        var gend = $("input[name=gender]:checked").val();
        
        var oldClass11thother = $('#Class').val();

        //part I and part II subjects
        var sub1 = 0;var sub2 = 0;var sub3 = 0;var sub4= 0;var sub5 = 0;var sub6 = 0;var sub7 = 0;var sub8 = 0;
        var sub1p2 = 0;var sub2p2 = 0;var sub3p2 = 0;var sub4p2= 0;var sub5p2 = 0;var sub6p2 = 0;var sub7p2 = 0;var sub8p2 = 0;

        sub1 = $("#sub1").val(); sub1p2 = $("#sub1p2").val();
        sub2 = $("#sub2").val(); sub2p2 = $("#sub2p2").val();
        sub3 = $("#sub3").val(); sub3p2 = $("#sub3p2").val();
        sub4 = $("#sub4").val(); sub4p2 = $("#sub4p2").val();
        sub5 = $("#sub5").val(); sub5p2 = $("#sub5p2").val();
        sub6 = $("#sub6").val(); sub6p2 = $("#sub6p2").val();
        sub7 = $("#sub7").val(); sub7p2 = $("#sub7p2").val();

        var status = 0;

        if(inputimage == ''){
            alertify.error("Please upload your Image First.")
            $("#image").focus();
            return status;
        }
        else if(name == "" ||  name == undefined){
            alertify.error("Please Enter your  Name")
            $('#cand_name').focus(); 
            return status;
        }
        else if(fName == "" || fName == undefined){
            alertify.error("Please Enter your Father's Name  ") 
            $('#father_name').focus(); 
            return status;
        }   

        else if(FNic == ""  ){
            alertify.error("Please Enter your Father's CNIC") 
            $('#father_cnic').focus();  
            return status; 
        }
        else if(FNic == bFormNo  )
        {

            alertify.error("B-form Number and Father CNIC cannot be same.") 
            $('#bay_form').focus();   
            return status; 
        }
        else if(medium == "" || medium < 1 ){
            alertify.error("Please Select Medium") 
            $('#medium').focus();  
            return status; 
        }

        else if(mobNo == "" || mobNo == 0 || mobNo == undefined){
            alertify.error("Please Enter your Mobile No.") 
            $('#mob_number').focus();   
            return status;  
        }

        else if (!$('input[name=nationality]:checked').val() ) {   
            alertify.error("Please Check Nationality") 
            $('#nationality').focus();   
            return status;        
        }

        else if (!$('input[name=gender]:checked').val() ) {   
            alertify.error("Please Check Gender") 
            $('#gender1').focus();   
            return status;        
        }


        else if (!$('input[name=hafiz]:checked').val() ) {   
            alertify.error("Please Check Hafiz-e-Quran") 
            $('#hafiz1').focus();   
            return status;        
        }

        else if (!$('input[name=religion]:checked').val() ) {   
            alertify.error("Please Check Religion") 
            $('#religion').focus();   
            return status;        
        }



        else if (!$('input[name=UrbanRural]:checked').val() ) {   
            alertify.error("Please Check Locality ") 
            $('#UrbanRural1').focus();   
            return status;        
        }


        else if(MarkOfIdent == "" || MarkOfIdent == 0 || MarkOfIdent == undefined){
            alertify.error("Please Enter your Mark of Indentification") 
            $('#MarkOfIden').focus();   
            return status;  
        }

        else if(address == "" || address == 0 || address.length ==undefined ){
            alertify.error("Please Enter your Address")
            $('#address').focus(); 
            return status;    
        }

        /* else if (! $('#oldResult11th').val() && oldClass11thother == 11){
        alertify.error("Please Fill Your Old Result ") 
        $('#oldResult11th').focus();   
        return status;        
        }*/

        else  if (dist_cd < 1){
            alertify.error('Please select District '); 
            $("#pvtinfo_dist").focus();
            return status;  
        }
        else if (teh_cd < 1) {

            alertify.error('Please select Tehsil');                          
            $("#pvtinfo_teh").focus();
            return status;  
        }
        else if (zone_cd < 1){
            alertify.error('Please select Zone. ');                          
            $("#pvtZone").focus();
            return status;  
        }
        else if (grp_cd == 0){
            alertify.error('Please Select your Study Group '); 
            $("#std_group").focus();
            return status;  
        }

        else if(sub1 == 0 && oldClass11thother != 11){
            alertify.error('Please Select Part I, Subjects 1.  '); 
            $("#sub1").focus();
            return status;  
        }

        else if(sub2 == 0 && oldClass11thother != 11){
            alertify.error('Please Select Part I, Subjects 2.  '); 
            $("#sub2").focus();
            return status;  
        }

        else if(sub3 == 0 && oldClass11thother != 11){
            alertify.error('Please Select Part I, Subjects 3.  '); 
            $("#sub3").focus();
            return status;  
        }

        else if(sub4 == 0 && oldClass11thother != 11){
            alertify.error('Please Select Part I, Subjects 4.  '); 
            $("#sub4").focus();
            return status;  
        }


        else if(sub5 == 0 && oldClass11thother != 11){
            alertify.error('Please Select Part I, Subjects 5.  '); 
            $("#sub5").focus();
            return status;  
        }

        else if(sub6 == 0 && oldClass11thother != 11){
            alertify.error('Please Select Part I, Subjects 6.  '); 
            $("#sub6").focus();
            return status;  
        }

        else if(sub7 == 0 && grp_cd == 5 && oldClass11thother != 11){
            alertify.error('Please Select Part I, Subjects 7.  '); 
            $("#sub7").focus();
            return status;  
        }

        else if(sub1p2 == 0 ){
            alertify.error('Please Select Part II, Subjects 1.  '); 
            $("#sub1p2").focus();
            return status;  
        }

        else if(sub2p2 == 0 ){
            alertify.error('Please Select Part II, Subjects 2.  '); 
            $("#sub2p2").focus();
            return status;  
        }

        else if(sub3p2 == 0 ){
            alertify.error('Please Select Part II, Subjects 3.  '); 
            $("#sub3p2").focus();
            return status;  
        }

        else if(sub4p2 == 0 ){
            alertify.error('Please Select Part II, Subjects 4.  '); 
            $("#sub4p2").focus();
            return status;  
        }

        else if(sub5p2 == 0 ){
            alertify.error('Please Select Part II, Subjects 5.  '); 
            $("#sub5p2").focus();
            return status;  
        }

        else if(sub6p2 == 0 ){
            alertify.error('Please Select Part II, Subjects 6.  '); 
            $("#sub6p2").focus();
            return status;  
        }

        else if(sub7p2 == 0 && grp_cd == 5 ){
            alertify.error('Please Select Part II, Subjects 7.  '); 
            $("#sub7p2").focus();
            return status;  
        }

        status = 1;
        return status;
    }

    function check_NewEnrol_validation()
    {

        var name =  $('#cand_name').val();
        var dist_cd= $('#pvtinfo_dist option:selected').val();
        var gend = $("#gend").val();
        var teh_cd= $('#pvtinfo_teh').val();
        var zone_cd= $('#pvtZone').val();
        var pp_cent= $('#pp_cent').val();           
        var sub6p1 = $('#sub6').val();
        var sub6p2 = $('#sub6p2').val();           
        var sub7p1 = $('#sub7').val();
        var sub7p2 = $('#sub7p2').val();  
        var sub8p1 = $('#sub8').val();                      
        var sub8p2 = $('#sub8p2').val();                      
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
        var picname = $('#picname').val();
        var status = 0;
        var $img = $("#previewImg");
        var src = $img.attr("src");
        var grppre = $("#grppre").val();
        var selected_group_conversion ;
        var exam_type = $("#exam_type").val();
        var exam_type = $("#exam_type").val();


        var gend = $("input[name=gender]:checked").val();

        if(grp_cd ==1 || grp_cd == 5 || grp_cd ==7)
        {
            selected_group_conversion =1;
        }
        else
        {
            selected_group_conversion =grp_cd;
        }


        if(picname == '') {
            alertify.error("Please upload your Picture First.")
            $('#image').focus(); 
            return status;
        }
        else if(name == "" ||  name == undefined){
            $('#ErrMsg').show();  
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            alertify.error("Please Enter your  Name")
            $('#cand_name').focus(); 
            return status;
        }
        else if(fName == "" || fName == undefined){
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            alertify.error("Please Enter your Father's Name  ") 
            $('#father_name').focus(); 
            return status;
        }   

        else if(bFormNo == "" || bFormNo == '00000-0000000-0' || bFormNo == '11111-1111111-1' || bFormNo == '22222-2222222-2' || bFormNo == '33333-3333333-3' ||             bFormNo == '44444-4444444-4' || bFormNo == '55555-5555555-5' || bFormNo == '66666-6666666-6' || bFormNo == '77777-7777777-7' ||
            bFormNo == '88888-8888888-8' || bFormNo == '99999-9999999-9'){
                $('#ErrMsg').show(); 
                $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                alertify.error("Please Enter Valid B-form") 
                $('#bay_form').focus();  
                return status; 
            }

            else if(FNic== "" || FNic== '00000-0000000-0' || FNic== '11111-1111111-1' || FNic== '22222-2222222-2' || FNic== '33333-3333333-3' ||                                 FNic== '44444-4444444-4' || FNic== '55555-5555555-5' || FNic== '66666-6666666-6' || FNic== '77777-7777777-7' ||
                FNic== '88888-8888888-8' || FNic== '99999-9999999-9'){
                    $('#ErrMsg').show(); 
                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                    alertify.error("Please Enter Valid Father's-CNIC") 
                    $('#bay_form').focus();  
                    return status; 
                }

                else if(FNic == bFormNo  )
                {
                    alertify.error("B-form Number and Father CNIC cannot be same.") 
                    $('#bay_form').focus();   
                    return status; 
                }
                else if(mobNo == "" || mobNo == 0 || mobNo == undefined){
                    $('#ErrMsg').show(); 
                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
      
                    alertify.error("Please Enter your Mobile No.") 
                    $('#mob_number').focus();   
                    return status;  
                }

                else if (!$('input[name=gender]:checked').val() ) {   
                    alertify.error("Please Check Gender") 
                    $('#gender1').focus();   
                    return status;        
                }

                else if(MarkOfIdent == "" || MarkOfIdent == 0 || MarkOfIdent == undefined){
                    $('#ErrMsg').show(); 
                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });

                    alertify.error("Please Enter your Mark of Indentification") 
                    $('#MarkOfIden').focus();   
                    return status;  
                }
                else if(address == "" || address == 0 || address.length ==undefined ){
                    $('#ErrMsg').show(); 
                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                    $('#ErrMsg').html("<b>Please Enter your Address</b>"); 
                    alertify.error("Please Enter your Address")
                    $('#address').focus(); 
                    return status;    
                }
                else  if (dist_cd < 1){
                    alertify.error('Please select District '); 
                    $("#pvtinfo_dist").focus();
                    return status;  
                }
                else if (teh_cd < 1) {

                    alertify.error('Please select Tehsil');                          
                    $("#pvtinfo_teh").focus();
                    return status;  
                }
                else if (zone_cd < 1){
                    alertify.error('Please select Zone. ');                          
                    $("#pvtZone").focus();
                    return status;  
                }
                else if (grp_cd == 0){
                    $('#ErrMsg').show(); 
                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                    alertify.error('Please Select your Study Group '); 
                    $("#std_group").focus();
                    return status;  
                }

        status = 1;
        return status;
    }

    function  check_NewEnrol_validation_Languages()
    {

        var name =  $('#cand_name').val();
        var dist_cd= $('#pvtinfo_dist option:selected').val();
        var teh_cd= $('#pvtinfo_teh').val();
        var zone_cd= $('#pvtZone').val();
        var MarkOfIdent = $('#MarkOfIden').val();
        var address = $('#address').val();
        // var pp_cent= $('#pp_cent').val();           
        var status = 0;
        var mobNo = $('#mob_number').val();

        if(mobNo == "" || mobNo == 0 || mobNo == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });

            alertify.error("Please Enter your Mobile No.") 
            $('#mob_number').focus();   
            return status;  
        }

        else if(MarkOfIdent == "" || MarkOfIdent == 0 || MarkOfIdent == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });

            alertify.error("Please Enter your Mark of Indentification") 
            $('#MarkOfIden').focus();   
            return status;  
        }
        else if(address == "" || address == 0 || address.length ==undefined )
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Address</b>"); 
            alertify.error("Please Enter your Address")
            $('#address').focus(); 
            return status;    
        }

        else  if (dist_cd < 1) 
        {
            alertify.error('Please select District '); 
            $("#pvtinfo_dist").focus();
            return status;  
        }

        else if (teh_cd < 1) {

            alertify.error('Please select Tehsil');                          
            $("#pvtinfo_teh").focus();
            return status;  
        }
        else if (zone_cd < 1) 
        {
            alertify.error('Please select Zone. ');                          
            $("#pvtZone").focus();
            return status;  
        }

        else if (grp_cd == 0) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            alertify.error('Please Select your Study Group '); 
            $("#std_group").focus();
            return status;  
        }

        status = 1;
        return status;
    }

    function gotodefaultpage(){
        var msg = "Are you sure you want to cancel ?"
        alertify.confirm(msg, function (e) {

            if (e) {
                window.parent.location=<?php base_url() ?>'Admission';
            } 
        });
    }
</script>