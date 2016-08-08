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
            if(tehId == 0){
                alert("Select Tehsil First");
            }
            else{

                jQuery.ajax({

                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "Admission/getzone/",
                    dataType: 'json',
                    data: {tehCode: tehId},
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
            var gend = $("#gen").val();

            if(tehId == 0){
                alert("Select Zone First");
            }
            else{
                jQuery.ajax({

                    type: "POST",
                    url: "<?php echo base_url(); ?>Admission/getcenter/",
                    dataType: 'json',
                    data: $("#myform").serialize(),
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
    });

    function  check_NewEnrol_validation(){

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
        if(grp_cd==1 || grp_cd == 5 || grp_cd ==7)
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

        else if(bFormNo == "" || bFormNo == 0 || bFormNo == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });

            alertify.error("Please Enter your bay-Form") 
            $('#bay_form').focus();  
            return status; 
        }
        else if(FNic == "" || FNic.length == undefined )
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            alertify.error("Please Enter your Father's CNIC") 
            $('#father_cnic').focus();  
            return status; 
        }

        else if(mobNo == "" || mobNo == 0 || mobNo == undefined)
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