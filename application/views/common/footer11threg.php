<footer>
    <p>
        &copy; BiseAdmin 2016
    </p>
</footer>

<!--Add the following script at the bottom of the web page (before </body></html>)-->
<!--<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=93646887"></script>-->

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollUp.js"></script>

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

 function checks(){

        var status  =  check_NewEnrol_validation_11th(); 

        if(status == 0)
        {

            return false;    
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "Admission_11th_pvt/NewEnrolment_insert/",
                dataType: 'html',
                data: $( '#admfrmID' ).serialize(),
                beforeSend: function() {  $('.mPageloader').show(); },
                complete: function() { $('.mPageloader').hide();},
                success: function(data) {
                    debugger;
                     var obj = JSON.parse(data) ;
                     if(obj.error ==  1)
                     {
                        window.location.href ='<?php echo base_url(); ?>Admission_11th_pvt/formdownloaded/'+obj.formno; 
                     }
                     else
                     {
                         $('.mPageloader').hide();
                        alertify.error(obj.error);
                          return false; 
                     }

                },
                error: function(request, status, error){
                    alertify.error(request.responseText);
                }
            });


            return false;
        } 
    }


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
                    var post_url = '<?= base_url()?>Admission_11th_pvt/uploadpic'; //get action URL of form

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



    $(document).ready(function () {
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
        $("#pvtinfo_teh").change(function()
        {
            var tehId =  $("#pvtinfo_teh").val();
            
            var gender = '';

            if(isotherboard != 1)
            {
                gender = $("input[name=ogender]:checked").val();
            }
            else
            {
                gender =  $("input[name=gender]").val() ;
            }
            
             if(gender == "" || gender == 0 || gender == undefined  || gender.length == undefined)
            {
                 alertify.error("Select Gender First");
            }
          else  if(tehId == 0){
                alertify.error("Select Tehsil First");
            }
            
            else{

                jQuery.ajax({

                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "Admission/getzone/",
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

            debugger;
            var tehId =  $("#pvtZone").val();
             var gender = '';

            if(isotherboard != 1)
            {
                gender = $("input[name=ogender]:checked").val();
            }
            else
            {
                gender =  $("input[name=gender]").val() ;
            }
            
             if(gender == "" || gender == 0 || gender == undefined  || gender.length == undefined)
            {
                 alertify.error("Select Gender First");
            }

            else if(tehId == 0){
                alert("Select Zone First");
            }
            else{
                jQuery.ajax({

                    type: "POST",
                    url: "<?php echo base_url(); ?>Admission/getcenter/",
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
        //data_table
        var data_excep = "<?php echo @$excep_halt; ?>";
        if(data_excep != '')
        {

            alertify.error(data_excep);
            // $('#Info_emis').focus();
            return false;


        }
    });

</script>


<script type="">

    var isotherboard = '<?php echo @$data[0]['SSC_brd_cd']; ?>';
    //
    if(isotherboard != 1)
    {
        $( "#dob" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, maxDate:new Date(2002, 8, 1),minDate:new Date(1980, 0, 1)}).val();

    }
    // $( "#dob" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true }).val();
    $( "#batch_real_PaidDate" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, 'setDate': new Date() }).val(); //, startDate:new Date()
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
        51 : 'ETHICS',
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
    //debugger;



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


    function  check_NewEnrol_validation_11th()
    {
        // 
       
       
        var name =  $('#cand_name').val();
        var fName = $('#father_name').val();
        var picname = $('#picname').val();
        var FNic = $('#father_cnic').val();
        var bFormNo = $('#bay_form').val();
        var pvtinfo_dist = $('#pvtinfo_dist').val();
        var pvtinfo_teh = $('#pvtinfo_teh').val();
        var pvtZone = $('#pvtZone').val();
        var dob = $('#dob').val();
        var sub4 = $('#sub4').val();
        var sub5 = $('#sub5').val();
        var sub6 = $('#sub6').val();           
        var sub7 = $('#sub7').val();
        var mobNo = $('#mob_number').val();

        var grp_cd = $('#std_group').val();
        var brd_cd = $('#brd_cd').val();
        var gender = '';
        debugger
        if(isotherboard != 1)
        {
           gender = $("input[name=ogender]:checked").val();
        }
        else
        {
            gender =  $("input[name=gender]").val() ;
        }
        var address = $('#address').val();
        var image = $('#image').val();
        var MarkOfIdent = $('#MarkOfIden').val();
        var Inst_Rno = $('#Inst_Rno').val();
        var status = 0;
        var mat_Year = $('#old_ssc_year').val();
        debugger;
        var NationalityVal = $("input[name=nationality]:checked").val();
        if(NationalityVal==2)
        {
            $("#nationality").val(2);
            //$("#sub1").prepend("<option selected='selected' value='6'>PAKISTANI CULTURE</option>");

            //$("#sub1").append(new Option('Urdu',2));    
        }
        else 
        {
            $("#nationality").val(1);
            //$("#sub1").prepend("<option  value='2'> URDU </option>");
        }

        //var ispic
        // alert('sub6 '+sub6p1+ ' and '+ sub6p2);
        if(picname == "" ||  picname == undefined){

            alertify.error("Please Uplaod Picture")
            $('#picname').focus(); 
            return status;
        }
        if(name == "" ||  name == undefined){
            $('#ErrMsg').show();  
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            // $('#ErrMsg').html("<b>Please Enter your  Name </b>");    
            alertify.error("Please Enter your  Name")
            $('#cand_name').focus(); 
            return status;
        }
        else if(fName == "" || fName == undefined){
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            // $('#ErrMsg').html("<b>Please Enter your Father's Name  </b>");   
            alertify.error("Please Enter your Father's Name  ") 
            $('#father_name').focus(); 
            return status;
        }   

        else if((bFormNo == "" || bFormNo == 0 || bFormNo == undefined))
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            // $('#ErrMsg').html("<b>Please Enter your bay-Form</b>"); 
            alertify.error("Please Enter your bay-Form.") 
            $('#bay_form').focus();  
            return status; 
        }
        else if(FNic == "" ||  FNic == 0  || FNic.length == undefined )
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            // $('#ErrMsg').html("<b>Please Enter your Father's CNIC</b>"); 
            alertify.error("Please Enter your Father's CNIC") 
            $('#father_cnic').focus();  
            return status; 
        }
         else if(dob == "" || dob.length == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            //$('#ErrMsg').html("<b>Please Enter your Date of Birth</b>"); 
            alertify.error("Please Enter your Date of Birth") 
            $('#dob').focus(); 
            return status;  
        }       
        else if(mobNo == "" || mobNo == 0 || mobNo.length == undefined || mobNo == '-')
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            // $('#ErrMsg').html("<b>Please Enter your Mobile No.</b>"); 
            alertify.error("Please Enter your Mobile No.") 
            $('#mob_number').focus();   
            return status;  
        }

        else if(MarkOfIdent == "" || MarkOfIdent == 0 || MarkOfIdent.length == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            //$('#ErrMsg').html("<b>Please Enter your Mark of Indentification</b>"); 
            alertify.error("Please Enter your Mark of Indentification") 
            $('#MarkOfIden').focus();   
            return status;  
        }
         else if(gender == "" || gender == 0 || gender == undefined  || gender.length == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            //$('#ErrMsg').html("<b>Please Enter your Mark of Indentification</b>"); 
            alertify.error("Please Select Gender") 
           // $('#MarkOfIden').focus();   
            return status;  
        }
        else if(address == "" || address == 0 || address.length ==undefined )
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
           // $('#ErrMsg').html("<b>Please Enter your Address</b>"); 
            alertify.error("Please Enter your Address")
            $('#address').focus(); 
            return status;    
        }
           
        else if(pvtinfo_dist == "" || pvtinfo_dist == 0  || pvtinfo_dist == undefined){

            alertify.error("Please Select First District  ") 
            $('#pvtinfo_dist').focus(); 
            return status;
        }   

        else if(pvtinfo_teh == "" || pvtinfo_teh == 0 || pvtinfo_teh == undefined){
            alertify.error("Please Select First Tehsil  ") 
            $('#pvtinfo_teh').focus(); 
            return status;
        }   

        else if(pvtZone == "" || pvtZone == 0 || pvtZone == undefined){
            alertify.error("Please Select First Zone  ") 
            $('#pvtZone').focus(); 
            return status;
        }   


        else   if ($("#std_group").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            //  $('#ErrMsg').html("<b>Please Enter your Study Group</b>"); 
            alertify.error('Please select your Study Group '); 
            // alert('Study Group not selected ');                          
            $("#std_group").focus();
            return status;  
        }
        else   if ($("#sub3").find('option:selected').val() < 1) 
        {
            // $('#ErrMsg').show(); 
            alertify.error('Please select your Study Group '); 
            alert('Plesae select  Subject');                          
            $("#sub3").focus();

            return status;  
        }
        else   if ($("#sub4").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            alertify.error('Please select Subject '); 
            // alert('Plesae select Subject');                          
            $("#sub4").focus();

            return status;  
        }

        else   if ($("#sub5").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            alertify.error('Please select Subject '); 
            //  $('#ErrMsg').html("<b>Plesae select 6th Subject  </b>"); 
            // alert('Plesae select 6th Subject  ');                          
            $("#sub5").focus();
            return status;  
        }

        else   if ($("#sub6").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            alertify.error('Please select Subject '); 
            // $('#ErrMsg').html("<b>Plesae select 7th Subject  </b>"); 
            //alert('Plesae select 7th Subject ');                          
            $("#sub6").focus();
            return status;  
        }

        else   if ($("#sub7").find('option:selected').val() < 1 && ($("#std_group").find('option:selected').val() == 6 || $("#std_group").find('option:selected').val() == 5)) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            alertify.error('Please select Subject '); 
            //$('#ErrMsg').html("<b>Plesae select 8th Subject  </b>"); 
            //alert('Plesae select 8th Subject ');                          
            $("#sub7").focus();
            return status;  
        }


        

      
        status = 1;
        return status;




    }
    $("#sec_board").change(function(){
        if(this.value == 17)
        {
            // alert('hello angrez :) ');

            $("#oldSess").empty().append('<option selected="selected"  value="1">JUNE 2016</option>');
            $("#oldSess").append('<option  value="2">JANUARY 2016</option>');

        }
        else
        {
            $("#oldSess").empty().append('<option selected="selected" value="1">ANNUAL</option>');
            $("#oldSess").append('<option  value="2">SUPPLYMENTARY</option>');
        }

    })

    function load_Commerce()
    {
        $("#sub1").empty();
        $("#sub2").empty();
        $("#sub3").empty();
        $("#sub4").empty();
        $("#sub5").empty();
        $("#sub6").empty();
        $("#sub7").empty();
        $("#sub8").empty().append('<option selected="selected" value="0">NONE</option>');

        if(NationalityVal==2)
        {
            $("#sub1").prepend("<option selected='selected' value='6'>PAKISTANI CULTURE</option>");

            $("#sub1").append(new Option('Urdu',2));    
        }
        else{
            $("#sub1").prepend("<option  value='2'> URDU </option>");
        }
        //$("#sub1").append(new Option('Urdu',2));
        $("#sub1 option[value='2']").attr("selected","selected");
        $("#sub2").append(new Option('English',1));
        $("#sub2 option[value='1']").attr("selected","selected");
        $("#sub3").append(new Option('Islamic Education',92));
        $("#sub3 option[value='92']").attr("selected","selected");


        $("#sub4").append(new Option('Principles Of Accounting',70));
        $("#sub4 option[value='70']").attr("selected","selected");

        $("#sub5").append(new Option('Principles Of Economics',71));
        $("#sub5 option[value='71']").attr("selected","selected");

        $("#sub6").append(new Option('Business Math',80));
        $("#sub6 option[value='80']").attr("selected","selected");

        $("#sub7").show();
        $("#sub7").append(new Option('Principles Of Commerce',39));
        $("#sub7 option[value='39']").attr("selected","selected");
    }


    function load_Hum(){

        $("#sub1").empty();
        $("#sub2").empty();
        $("#sub3").empty();
        $("#sub4").empty();
        $("#sub5").empty();
        $("#sub6").empty();
        $("#sub7").empty();
        $("#sub7").empty().append('<option selected="selected" value="0">NONE</option>');
        $("#sub8").empty().append('<option selected="selected" value="0">NONE</option>');
        if(NationalityVal==2)
        {
            $("#sub1").prepend("<option selected='selected' value='6'>PAKISTANI CULTURE</option>");

            $("#sub1").append(new Option('Urdu',2));    
        }
        else{
            $("#sub1").prepend("<option  value='2'> URDU </option>");
        }
        // $("#sub1").append(new Option('Urdu',2));
        $("#sub1 option[value='2']").attr("selected","selected");
        $("#sub2").append(new Option('English',1));
        $("#sub2 option[value='1']").attr("selected","selected");
        $("#sub3").append(new Option('Islamic Education',92));
        $("#sub3 option[value='92']").attr("selected","selected");
        $.each(sub6_Hum, function(val, text) {
            $('#sub4').append( new Option(text,val) );
        });

        $.each(sub6_Hum, function(val, text) {
            $('#sub5').append( new Option(text,val) );
        }); 

        $.each(sub6_Hum, function(val, text) {
            $('#sub6').append( new Option(text,val) );
        }); 
        $("#sub4 option[value='<?php echo @$data[0]['sub4']   ?>']").attr("selected","selected"); 
        $("#sub5 option[value='<?php echo @$data[0]['sub5']   ?>']").attr("selected","selected"); 
        $("#sub6 option[value='<?php echo @$data[0]['sub6']   ?>']").attr("selected","selected"); 
        // $("#sub6 option[value='" + sub1 + "']").attr("selected","selected");

    }
    var langascd = ['24','34','32','27','37'];
    var doubleHistory = ['55','56','57','58'];
    $("#sub4").change(function(){
        console.log('Hi i am sub7 dropdown :) ');

        var sub4 = $("#sub4").val();
        var sub5 = $("#sub5").val();
        var sub6 = $("#sub6").val();


        if((sub5 != 0 || sub6 != 0) && sub4 != 0)
        {
            if((sub4 == sub5)|| (sub4 == sub6) || (sub5 == sub6))    
            {
                alertify.error("Please choose Different Subjects" );
                $("#sub4").val('0');
                return;    
            }

        }
        var valtext = 0;
        var valhistory = 0;
        var islang = 0;


        for(var i =0 ; i<langascd.length; i++)
        {
            if(sub4 == langascd[i])
            {
                islang=1;
            }
            if(sub5 == langascd[i])
            {
                valtext = parseInt(valtext) + 1;
            }
            if(sub6 == langascd[i])
            {
                valtext = parseInt(valtext) + 1;
            }

        }
        if(islang==1 && valtext >= 1)
        {
            alertify.error("Please choose Different Subjects as Double Language is not allowed" );
            $("#sub4").val('0');  
            return;
        }
        var ishist = 0;
        for(var i=0; i<doubleHistory.length; i++)
        {
            if(sub6 == doubleHistory[i]) 
            {
                valhistory =parseInt(valhistory) + 1;
            }
            if(sub5 == doubleHistory[i])
            {
                valhistory =parseInt(valhistory) + 1;
            }
            if(sub4 == doubleHistory[i])
            {
                ishist = 1;
            }
        }
        if(ishist==1 &&  valhistory >= 1)
        {
            alertify.error("Please choose Different Subjects as Double History is not allowed" );
            $("#sub4").val('0');  
            return;
        }
        
    })
    $("#sub5").change(function(){
        console.log('Hi i am sub7 dropdown :) ');
        var sub4 = $("#sub4").val();
        var sub5 = $("#sub5").val();
        var sub6 = $("#sub6").val();


        if( (sub4 != 0 || sub6 != 0) && sub5 != 0)
        {
            if((sub5 == sub6)|| (sub5 == sub4) || (sub4 == sub6))
            {
                alertify.error("Please choose Different Subjects" );
                $("#sub5").val('0');
                return;    
            }

        }
        var valtext = 0;
        var valhistory = 0;
        var islang = 0;
        for(var i =0 ; i<langascd.length; i++)
        {
            if(sub4 == langascd[i]) 
            {
                valtext =parseInt(valtext) + 1;
            }
            if(sub5 == langascd[i]) 
            {
                islang=1;
            }

            if(sub6 == langascd[i])
            {
                valtext = parseInt(valtext) + 1;
            }

        }
        if(islang == 1 && valtext >= 1)
        {
            alertify.error("Please choose Different Subjects as Double Language is not allowed" );
            $("#sub5").val('0');  
            return;
        }
        var ishist = 0;
        for(var i=0; i<doubleHistory.length; i++)
        {
            if(sub4 == doubleHistory[i])
            {
                valhistory =parseInt(valhistory) + 1;
            }
            if(sub5 == doubleHistory[i])
            {
                ishist = 1;
            }
            if(sub6 == doubleHistory[i])
            {
                valhistory =parseInt(valhistory) + 1;
            }
        }
        if(ishist ==1 && valhistory >= 1)
        {
            alertify.error("Please choose Different Subjects as Double History is not allowed" );
            $("#sub5").val('0');  
            return;
        }
       
    })
    $("#sub6").change(function(){

        console.log('Hi i am sub7 dropdown :) ');
        var sub4 = $("#sub4").val();
        var sub5 = $("#sub5").val();
        var sub6 = $("#sub6").val();


        if((sub4 != 0 || sub5 != 0) && sub6 !=0)
        {
            if((sub6 == sub5)|| (sub6 == sub4) ||(sub5 == sub4))   
            {
                alertify.error("Please choose Different Subjects" );
                $("#sub6").val('0');
                return;    
            }

        }
        var valtext = 0;
        var valhistory = 0;
        var islang = 0;
        for(var i =0 ; i<langascd.length; i++)
        {

            if(sub4 == langascd[i]) 
            {
                valtext =parseInt(valtext) + 1;
            }
            if(sub5 == langascd[i])
            {
                valtext = parseInt(valtext) + 1;
            }
            if(sub6 == langascd[i])
            {
                islang = 1;
            }


        }
        if(islang==1 && valtext>=1)
        {
            alertify.error("Please choose Different Subjects as Double Language is not allowed" );
            $("#sub6").val('0');  
            return;
        }
        var ishist =0;
        for(var i=0; i<doubleHistory.length; i++)
        {
            if(sub4 == doubleHistory[i]) 
            {
                valhistory =parseInt(valhistory) + 1;
            }
            if(sub5 == doubleHistory[i])
            {
                valhistory = parseInt(valhistory) + 1;
            }
            if(sub6 == doubleHistory[i])
            {
                ishist = 1;
            }

        }
        if( ishist==1 && valhistory >=1)
        {
            alertify.error("Please choose Different Subjects as Double History is not allowed" );
            $("#sub6").val('0');  
            return;
        }
     
    })

    var NationalityVal = $("input[name=nationality]:checked").val();

    function Hum_Deaf_Subjects_NewEnrolement(sub6,sub7,sub8)
    {


        var a = ['volvo','random data'];
        var b = ['random data'];
        $.each(a,function(i,val){
            var result=$.inArray(val,b);
            if(result!=-1)
                alert(result); 
        })
        var Elecgrp ="<?php echo @$grp_cd; ?>";
        //var isGovt ="<?php  echo @$field_status['emis']; ?>";
        //var isElect = "<?php  echo @$field_status['emis']; ?>";
        var NationalityVal = $("input[name=nationality]:checked").val();


        console.log(NationalityVal);


        $("#sub6").empty();
        $("#sub6 option[value='" + sub6 + "']").attr("selected","selected");
        $("#sub6").empty();
        $("#sub6 option[value='" + sub6 + "']").attr("selected","selected");
        $("#sub7").empty();
        $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");
        $("#sub8").empty();
        $("#sub8 option[value='" + sub8 + "']").attr("selected","selected");


    }
    $(document).ready(function() {


        var error_BatchRelease = "<?php  echo @$BatchRelease_excep; ?>";
        var success_BatchRelease = "<?php  echo @$errors['BatchRelease_excep']; ?>";
        var BatchRelease_Op = "<?php  echo @$errors_RB_update; ?>";
        var BatchRestore_Op = "<?php  echo @$errors_RB_restore; ?>";
        var grp_cd = $("#std_group").val();

        if(document.getElementById("matric_sub1")!= undefined)
        {
            var matric_sub1 = document.getElementById("matric_sub1").value; //$("#matric_sub1.value").val();    
        }
        else
        {
            var matric_sub1 = 1;    
        }


        //alert(grp_cd);

        // If Science with Biology group selected then 
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
                    if (!((key == 8) || (key == 32) || (key == 46) || (key >= 36 && key <= 40) || (key >= 65 && key <= 90))) {
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
                    if (!((key == 8) || (key == 32) || (key == 46) || (key >= 36 && key <= 40) || (key >= 65 && key <= 90))) {
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
                    if (!((key == 8) || (key == 32) || (key == 46) || (key >= 36 && key <= 40) || (key >= 65 && key <= 90))) {
                        e.preventDefault();
                    }
                }
            });
        });
        //MarkOfIden
        $('#cand_name').focusout(function() 
            {
                // 
                //   alertify.log('hello funciton call');
                var  name =  $('#cand_name').val();
                //(['MOHAMMAD', 'MOHAMAD', 'MHOAMAD', 'MOOHAMMAD']) 
                /* if ((name.toUpperCase().indexOf("MOHAMMAD") >= 0) || (name.toUpperCase().indexOf("MOHAMAD") >= 0) || (name.toUpperCase().indexOf("MUHAMAD") >= 0) || (name.toUpperCase().indexOf("MOOHAMMAD") >= 0) || (name.toUpperCase().indexOf("MOOHAMAD") >= 0) || (name.toUpperCase().indexOf("MOHD") >= 0) ) 
                {
                alertify.error("Incorrect Speccling of MUHAMMAD");
                $('#cand_name').focus();                                   
                }    */
        })
        $('#father_name').focusout(function() 
            {
                //  
                //   alertify.log('hello funciton call');
                var  name =  $('#father_name').val();
                //(['MOHAMMAD', 'MOHAMAD', 'MHOAMAD', 'MOOHAMMAD']) 
                /*if ((name.toUpperCase().indexOf("MOHAMMAD") >= 0) || (name.toUpperCase().indexOf("MOHAMAD") >= 0) || (name.toUpperCase().indexOf("MUHAMAD") >= 0) || (name.toUpperCase().indexOf("MOOHAMMAD") >= 0) || (name.toUpperCase().indexOf("MOOHAMAD") >= 0) || (name.toUpperCase().indexOf("MOHD") >= 0)  ) {
                alertify.error("Incorrect Speccling of MUHAMMAD");
                $('#father_name').focus();
                }   */
        })
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
        var error_New_Enrolement ='<?php   if(@$excep != ""){echo @$excep['excep'];}  ?>';
        var  error_New_Enrolement_update ='<?php   if(@$data != ""){echo @$data[0]['excep'];}  ?>';
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



    });


    var Religion = $("input[name=religion]:checked").val();




    function Hum_Deaf_Subjects()
    {

        //alert(isElec);
        var NationalityVal = $("input[name=nationality]:checked").val();
        console.log(NationalityVal);
        $('#sub1').empty();
        if(NationalityVal == "1")
        {
            console.log("Hi Pakistani ");
            $.each(sub1_Pak_options, function(val, text) {
                $('#sub1').append( new Option(text,val) );
            }); 

        }
        else if (NationalityVal == "2")
        {
            console.log("Hi Foreigner Welcom to Pakistan :) ");
            $.each(sub1_NonPak_options, function(val, text) {
                $('#sub1').append( new Option(text,val) );
            }); 
        }

        // Check Religion and select sub........
        $("#sub3").empty();
        var Religion = $("input[name=religion]:checked").val();
        //console.log(Religion);
        console.log(Religion);
        if(Religion == "1")
        {
            console.log("Hi Muslim :)");
            $.each(sub3_Muslim,function(val,text){
                $("#sub3").empty();
                $("#sub3").append(new Option(text,val));
            });

        }
        else if(Religion == "2")
        {
            console.log("Hi Non-Muslim :)");
            $.each(sub3_Non_Muslim,function(val,text){
                $("#sub3").append(new Option(text,val));
                //$("#sub3").prop('selectedIndex', 2);
            });
        }

        $("#sub6").empty();
        $("#sub6").empty();
        $("#sub7").empty();
        $("#sub8").empty();




    }
    $("#sub6").change(function(){
        var sub6 = $("#sub6").val();
        var sub7 = $("#sub7").val();
        var sub8 = $("#sub8").val();
        if((sub6 == sub7)|| (sub6 == sub8))
        {
            alertify.error("Please choose Different Subjects" );
            $("#sub6").val('0');
            return;
        }
        console.log('Hi i am sub6 dropdown :) ');
    })

    $("#sub7").change(function(){
        console.log('Hi i am sub7 dropdown :) ');
        var sub6 = $("#sub6").val();
        var sub7 = $("#sub7").val();
        var sub8 = $("#sub8").val();

        console.log("sub7 = "+ sub7 + "  sub8 = "+ sub8);
        if((sub7 == sub8)|| (sub7 == sub6))
        {
            alertify.error("Please choose Different Subjects" );
            $("#sub7").val('0');
            return;
        }
        if((sub7 == 20 && sub8 == 21) || (sub7 == 21 && sub8 == 20)){
            alertify.error("Please choose Different Subjects as Double History is not allowed" );
            $("#sub7").val('0');
            return;
        }
    })

    $("#sub8").change(function(){
        var sub6 = $("#sub6").val();
        var sub7 = $("#sub7").val();
        var sub8 = $("#sub8").val();
        console.log("sub7 = "+ sub7 + "  sub8 = "+ sub8);
        if((sub7 == sub8)|| (sub8 == sub6))
        {
            alertify.error("Please choose Different Subjects" );
            $("#sub8").val('0');
            //$('sub8').trigger('change');
            // $("sub8")[0].selectedIndex = 0;
            return;
        }
        if((sub7 == 20 && sub8 == 21) || (sub7 == 21 && sub8 == 20)){
            alertify.error("Please choose Different Subjects as Double History is not allowed" );
            $("#sub8").val('0');
            // $('sub8 option:first-child').attr("selected", "selected");

            //$('sub8').trigger('change');
            // $("sub8")[0].selectedIndex = 0;
            return;
        }
        console.log('Hi i am sub8 dropdown :) ');
    })
    function remove_subjects()
    {
        $("#sub1").empty();
        $("#sub2").empty();
        $("#sub3").empty();
        $("#sub4").empty();
        $("#sub5").empty();
        $("#sub6").empty();
        $("#sub7").empty();
        $("#sub7").hide();
    }
    $("#std_group").change(function(){



        var grp_cd = $("#std_group").val();
        //alert(grp_cd);

        // If Science with Biology group selected then 
        if (grp_cd == "3")
        {
            load_Hum();
            //    load_Bio_CS_Sub();
            //    $("#sub8").append(new Option('ELECTRICAL WIRING (OPT)',43));
            //ELECTRICAL WIRING (OPT)
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


    });

    //   $("#registration").validate();
    //$("#cand_name").focus();
    /*
    ===========================================
    MASKINGS Settings
    ===========================================
    */
    var phone = "<?php echo @$field_status['phone']; ?>";
    var cell = "<?php echo @$field_status['cell']; ?>";
    var emis = "<?php echo @$field_status['emis']; ?>";
    $("#bay_form,#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
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


    /*
    ===========================================
    Validations
    ===========================================
    */
    // var nationality = $('input:radio[name="nationality"]:checked').val();
    if(NationalityVal == 1) {
        $("#bay_form","#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
    }else{
        $("#bay_form","#father_cnic").mask("****************************",{placeholder:""});
    }


    $('input:radio[name="nationality"]').change(function(){
        if($(this).val() == 1) {
            $("#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
            $("#bay_form").mask("99999-9999999-9",{placeholder:"_"});

            //$("#ddlList").prepend('<option selected="selected" value="0"> Select </option>');
        }else{
            //$("#father_cnic").mask("****************************",{placeholder:""});
            $("#father_cnic").unmask();
            $("#bay_form").unmask();
            $("#sub1").empty(); 
            $("#sub1").prepend("<option selected='selected' value='6'>PAKISTANI CULTURE</option>");
            $("#sub1").prepend("<option  value='1'> URDU </option>");
        }
    });

    $('input:radio[name="religion"]').change(function(){
        if($(this).val() == 1) {

            $("#sub3").empty(); 
            $("#sub3").prepend('<option selected="selected" value="3"> ISLAMIYAT (COMPULSORY) </option>');
            //$("#ddlList").prepend('<option selected="selected" value="0"> Select </option>');
        }else{
            //$("#father_cnic").mask("****************************",{placeholder:""});

            $("#sub3").empty(); 
            $("#sub3").prepend("<option selected='selected' value='93'> CIVICS FOR NON MUSLIM </option>");
            $("#sub3").prepend("<option selected='selected' value='51'> ETHICS </option>");
            $("#sub3").prepend("<option  value='3'> ISLAMIYAT (COMPULSORY) </option>");
        }
    });

    var is_muslim    = $('input:radio[name="religion"]:checked').val();  
    var is_pakistani = $('input:radio[name="nationality"]:checked').val(); 
    var gender = $('input:radio[name="gender"]:checked').val(); 
    var id           = $('#std_group').val();

</script>

<script type="">

    function logout(){
        var msg = "Are you Sure You want to LOGOUT?"

        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>index.php/login/logout';
            } 
        });
    }

</script>
</body>
</html>