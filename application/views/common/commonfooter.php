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


        $("#pvtinfo_teh").change(function(){
            var tehId =  $("#pvtinfo_teh").val();

            gender =  $("input[name=gender]").val() ;
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
            var gender = $("input[name=gender]").val() ;
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

    function check_NewEnrol_validation_Fresh(){

        var inputimage = $("#inputFile").val();  
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
            $("#inputFile").focus();
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

        else if(sub1 == 0 ){
            alertify.error('Please Select Part I, Subjects 1.  '); 
            $("#sub1").focus();
            return status;  
        }


        else if(sub2 == 0 ){
            alertify.error('Please Select Part I, Subjects 2.  '); 
            $("#sub2").focus();
            return status;  
        }

        else if(sub3 == 0 ){
            alertify.error('Please Select Part I, Subjects 3.  '); 
            $("#sub3").focus();
            return status;  
        }


        else if(sub4 == 0 ){
            alertify.error('Please Select Part I, Subjects 4.  '); 
            $("#sub4").focus();
            return status;  
        }


        else if(sub5 == 0 ){
            alertify.error('Please Select Part I, Subjects 5.  '); 
            $("#sub5").focus();
            return status;  
        }

        else if(sub6 == 0 ){
            alertify.error('Please Select Part I, Subjects 6.  '); 
            $("#sub6").focus();
            return status;  
        }

        else if(sub7 == 0 && grp_cd == 5 ){
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

    function check_NewEnrol_validation(){

        var name =  $('#cand_name').val();
        var dist_cd= $('#pvtinfo_dist option:selected').val();
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
        var status = 0;
        var $img = $("#previewImg");
        var src = $img.attr("src");
        var grppre = $("#grppre").val();
        var selected_group_conversion ;
        var exam_type = $("#exam_type").val();
        if(grp_cd ==1 || grp_cd == 5 || grp_cd ==7)
        {
            selected_group_conversion =1;
        }
        else
        {
            selected_group_conversion =grp_cd;
        }


        if(src == '') {
            $img.addClass("highlight");
            $img.css("border", "3px solid yellow");
            $('#ErrMsg').show();  
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            alertify.error("Please upload your Picture First.")
            $img.focus(); 
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
        else if(FNic == ""  ){
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            alertify.error("Please Enter your Father's CNIC") 
            $('#father_cnic').focus();  
            return status; 
        }
        else if(mobNo == "" || mobNo == 0 || mobNo == undefined){
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });

            alertify.error("Please Enter your Mobile No.") 
            $('#mob_number').focus();   
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

    function  check_NewEnrol_validation_Languages(){

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