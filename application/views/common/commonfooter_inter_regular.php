

<div class="container-fluid ">
    <div style="text-align: center; background:#3187bf; color: white;  margin-bottom: 5px; height: 40px;">
        &copy; 2017 BISE Gujranwala, All Rights Reserved. 
    </div>
</div>

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

<script type="text/javascript">

    $(document).ready(function(){
        $('#data-table').dataTable({
            "sPaginationType": "full_numbers",
            "cache": true
        });

        $("#bay_form,#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
        $("#dob,#dateofadmission").mask("99-99-9999",{placeholder:"_"});
        $("#mob_number").mask("9999-9999999",{placeholder:"_"});
        $( "#batch_real_PaidDate" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, startDate:new Date() }).val();

        $( "#dob" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, maxDate: new Date(2003, 7,1),yearRange: '1970:2003'}).val();

        var spl_cd = "<?php   echo @$spl_cd; ?>";
        var err ='<?php echo @$error; ?>';
        if(err != ""){
            alertify.error("Dear Student! No data found against your submitted record! Please check you informaiton again.");
        }
        if(spl_cd != "")
        {
            if(spl_cd == "chance")
            {
                alertify.error("Dear Student! You are not eligible due to NO chance in this exam!");
            }
            else if(spl_cd == "exam_type3")
            {
                alertify.error("Dear Student! You are not eligible due to FULL FAIL!");
            } 
            else if(spl_cd != "3")
            {
                alertify.error("Dear Student! Please  rectify  "+spl_cd+" before proceeding further from MATRIC BRANCH !"); 
            }   

        } 
        var error_New_Enrolement ='<?php   if(@$excep != ""){echo @$excep['excep'];}  ?>';
        var  error_New_Enrolement_update ='<?php   if(@$data != ""){echo @$data[0]['excep'];}  ?>';
        var error_on_editing = '<?php echo @$error_msg;  ?>' ;
        if(error_on_editing !='')
        {
            alertify.error(error_on_editing);   
        }
        if(error_New_Enrolement.length > 1)
        {
            if(error_New_Enrolement == "success" )
            {
                alertify.success('Form Submitted Successfully');   
            }
            else
            {
                alertify.error(error_New_Enrolement);   
            }

        }
        if(error_New_Enrolement_update.length > 1)
        {
            if(error_New_Enrolement == "success" )
            {
                alertify.success('Form Updated Successfully');   
            }
            else
            {
                alertify.error(error_New_Enrolement_update);   
            }

        }

        var sub1_Pak_options = {
            1 : 'Urdu'
        }
        var sub1_NonPak_options = 
        {
            11 : 'Geogrophy Of Pakistan',
            1 : 'Urdu'
        }
        var sub3_Muslim = 
        {
            3 :'Islamyat Compulsory'
        }
        var sub3_Non_Muslim = 
        {
            51 : 'ETHICS',
            3  :'Islamyat Compulsory'
        }
        var sub5_Hum = 
        {
            92 : 'GENERAL MATHEMATICS' 
        }
        var sub6_Hum = 
        {
            9 : 'GENERAL SCIENCE'  
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
        var sub5_Deaf = 
        {
            66: 'ARITHMETIC'

        }
        var sub6_Deaf = 
        {
            0: 'NOT SELECTED',
            72 : 'TAILORING',
            67 : 'BAKERY',
            68 : 'CARPET MAKING',
            93 : 'COMPUTER SCIENCES',
            69 : 'DRAWING',
            70 : 'EMBORIDERY',
            94 : 'HEALTH & PHYSICAL EDUCATION',
            73 : 'TYPE WRITING',
            74 : 'WEAVING'
        }
        var sub7_Deaf = 
        {
            0: 'NOT SELECTED',
            72 : 'TAILORING',
            67 : 'BAKERY',
            68 : 'CARPET MAKING',
            93 : 'COMPUTER SCIENCES',
            69 : 'DRAWING',
            70 : 'EMBORIDERY',
            94 : 'HEALTH & PHYSICAL EDUCATION',
            73 : 'TYPE WRITING',
            74 : 'WEAVING'
        }
        var sub8_Deaf = 
        {
            0: 'NOT SELECTED',
            72 : 'TAILORING',
            67 : 'BAKERY',
            68 : 'CARPET MAKING',
            93 : 'COMPUTER SCIENCES',
            69 : 'DRAWING',
            70 : 'EMBORIDERY',
            94 : 'HEALTH & PHYSICAL EDUCATION',
            73 : 'TYPE WRITING',
            74 : 'WEAVING'
        }

        $('.mPageloader').hide();
        $("#formid").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }

            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        $("#proceed").click(function(){
            var isreg =  $('input[name=candidate]:checked', '#options').val();
            if(isreg==1){
                window.location.href='<?php  echo base_url(); ?>index.php/Admission/matric_default';
            }
            else{
                window.location.href='<?php  echo base_url(); ?>index.php/login'  
            }
        })

        $("#btndwnForm").click(function(){
            var formno = $("#formid").val();
            var dob = $("#dob").val();


            if(formno == "")
            {
                alertify.error("Please write Form No.");
                return false;    
            }
            else if(formno.length != 6)
            {
                alertify.error("Please write Valid Form No.");
                return false;    
            }
            else if(dob == "")
            {
                alertify.error("Please write Date of Birth.");
                return false;        
            }
            else
            {
                alertify.log("Please wait while your form is downloading....")    
                downloadform();    
            }
        })
        function downloadform(){

            var formno = $("#formid").val();
            var dob = $("#dob").val();
            if(formno == ""){
                return false;
            }
            if(dob == ""){
                return false;
            }
            window.location.href='<?php  echo base_url(); ?>index.php/Admission/checkFormNo_then_download/'+formno+'/'+dob;  
        }

        function validateForm() {

            var x = document.forms["registration"]["matrno"].value;
            var y = document.forms["registration"]["formid"].value;
            if (x == null || x == "") {
                $("#matrno").css('border', '1px solid red');
                return false;
            }
            if (y == null || y == "") {
                $("#formid").css('border', '1px solid red');
                return false;
            }
        }
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
        var dist_cd = '<?php echo @$data[0]['dist_cd'];  ?>';
        var teh_cd = '<?php  echo @$data[0]['teh_cd']; ?>';
        var zone_cd = '<?php echo @$data[0]['zone_cd']; ?>';
        var gender_d = '<?php echo  @$data[0]['sex']; ?>';

        var distId = dist_cd;
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
        $("#pvtinfo_teh").change(function()
            {
                var tehId =  $("#pvtinfo_teh").val();

                if(tehId == 0){
                    alert("Select Tehsil First");
                }
                else{

                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/Admission/getzone/",
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
            }
            else{
                jQuery.ajax({

                    type: "POST",
                    url: "<?php echo base_url(); ?>Admission_inter/getcenter/",
                    dataType: 'json',
                    data: $("#myform").serialize(),
                    beforeSend: function() {  $('.mPageloader').show(); },
                    complete: function() { $('.mPageloader').hide();},
                    success: function(json) {
                        var listitems='';

                        $.each(json.center, function (key, data) {
                            listitems +='<label>'+data.CENT_CD + '-' + data.CENT_NAME+'</label><br>';
                        })
                        $('#instruction').html('<h1>Selected Zone Centre List </h1>'+listitems); 
                        $.fancybox("#instruction");
                    },
                    error: function(request, status, error){
                        alert(request.responseText);
                    }
                });

            }

        })
        var tehId = zone_cd ;
        var gend = gender_d ;

        $("#pvtinfo_dist").val(dist_cd);

        $("#pvtinfo_teh").val(teh_cd);
        $("#pvtZone").val(zone_cd);

        $('input[type=radio][name=batch_opt]').change(function() {

            if (this.value == '1') {
                window.location.href = '<?=base_url()?>index.php/Admission_inter/CreateBatch/'+'96/1/';
            }
            else  if (this.value == '2') {
                window.location.href = '<?=base_url()?>index.php/Admission_inter/CreateBatch/'+'97/2/';
            }
            else  if(this.value == 3){
                window.location.href = '<?=base_url()?>index.php/Admission_inter/CreateBatch/'+'98/3';
            }

        });
        $( "#std_groups" ).change(function () {

            if (this.value == '0') {
                // 1 biology   2 humanities   5 deaf and dumb  7 computer science  8 electrical wiring 
                window.location.href = '<?=base_url()?>index.php/Admission_inter/CreateBatch/'+'96/3/0/';
            }

            else if (this.value == '1') {
                // 1 biology   2 humanities   5 deaf and dumb  7 computer science  8 electrical wiring 
                window.location.href = '<?=base_url()?>index.php/Admission_inter/CreateBatch/'+'96/3/1/';
            }
            else  if (this.value == '2') {
                window.location.href = '<?=base_url()?>index.php/Admission_inter/CreateBatch/'+'97/3/2/';
            }

            else  if (this.value == '3') {
                window.location.href = '<?=base_url()?>index.php/Admission_inter/CreateBatch/'+'97/3/3/';
            }

            else  if (this.value == '4') {
                window.location.href = '<?=base_url()?>index.php/Admission_inter/CreateBatch/'+'97/3/4/';
            }

            else  if(this.value == '5'){

                window.location.href = '<?=base_url()?>index.php/Admission_inter/CreateBatch/'+'98/3/5/';
            }
            else  if(this.value == '7'){
                window.location.href = '<?=base_url()?>index.php/Admission_inter/CreateBatch/'+'98/3/7/';
            }
            else  if(this.value == '8'){
                window.location.href = '<?=base_url()?>index.php/Admission_inter/CreateBatch/'+'98/3/8/';
            }

        })

    })
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
                var msg = "Are You Sure you want to make Batch ?";

                alertify.confirm(msg, function (e) {

                    if (e) {
                        window.location.href = '<?=base_url()?>index.php/Admission_inter/Make_Batch_Group_wise/'+$("#std_groups").val()+'/0';
                    } 
                });
            }
        }
        else if(option == "1" || option == "2")
        {
            window.location.href = '<?=base_url()?>index.php/Admission_inter/Make_Batch_Group_wise/'+'0/'+option+'/';
        }
        return false;



    }
    function makebatch_formnowise(){

        if( $('input[name="chk[]"]:checked').length > 0 )
        {
            var msg = "Are you sure you want to make Batch ?";

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
                window.location.href ='<?php echo base_url(); ?>index.php/login/logout';
            } 
        });
    }
    function EditForm(formrno)
    {
        // //debugger;
        $('#sub1').empty();
        $('#sub2').empty();
        $('#sub3').empty();
        $('#sub4').empty();
        $('#sub5').empty();
        $('#sub6').empty();
        $('#sub7').empty();
        $('#sub8').empty();
        window.location.href = '<?=base_url()?>index.php/Admission_inter/NewEnrolment_EditForm_inter/'+formrno
    }

    function NewForm(formrno,IntBrd_cd,year)
    {
        $('#sub1').empty();
        $('#sub2').empty();
        $('#sub3').empty();
        $('#sub4').empty();
        $('#sub5').empty();
        $('#sub6').empty();
        $('#sub7').empty();
        $('#sub8').empty();
        window.location.href = '<?=base_url()?>index.php/Admission_inter/NewEnrolment_NewForm_inter/'+formrno+'/'+IntBrd_cd+'/'+year
    }
    function DeleteForm(formrno)
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>index.php/Admission_inter/NewEnrolment_Delete/'+formrno;
            } else {
                // user clicked "cancel"

            }
        });
    }

    function CutList(Batch_ID)
    {
        window.location.href = '<?=base_url()?>index.php/Admission_inter/CutList/'+Batch_ID + '/'
    }

    function ReturnForm(Batch_ID)
    {
        window.location.href = '<?=base_url()?>index.php/Admission_inter/Print_Admission_inter_Form_Proofreading_Groupwise/'+Batch_ID + '/3'
    }
    function RevenueForm(Batch_ID)
    {
        window.location.href = '<?=base_url()?>index.php/Admission_inter/revenue_pdf/'+Batch_ID
    }
    function ReleaseForm(Batch_ID)
    {
        window.location.href = '<?=base_url()?>index.php/Admission_inter/BatchRelease/'+Batch_ID

    }
    $('#get_report').click( function(){
        var option =  $('input[type=radio][name=opt]:checked').val(); 

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
    $('input[type=radio][name=opt]').change(function() {
        if (this.value == '1') {
            // alert("Allot Thai Gayo Bhai");
            $('#formnowise_selected').css('display','none');
            $('#grp_selected').css('display','block');
        }
        else if (this.value == '2') {
            $('#grp_selected').css('display','none');
            $('#formnowise_selected').css('display','block');
        }
    });

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

        window.location.href = '<?=base_url()?>index.php/Admission_inter/Batchlist_INSERT/';
    }
    function ReturnForm_Final_groupwise(grp_cd){
        window.location.href = '<?=base_url()?>index.php/Admission_inter/return_pdf/'+grp_cd + '/2'
    }
    function ReturnForm_Final_Formnowise(startformno,endformno){
        window.location.href = '<?=base_url()?>index.php/Admission_inter/return_pdf/'+startformno + '/3' +'/'+endformno +'/';
    }
    function ChallanForm_Adm10th_Regular(Batch_ID)
    {
        window.location.href = '<?=base_url()?>/index.php/Admission_inter/ChallanForm_Adm10th_Regular/'+Batch_ID
    }
    function ReturnForm_ProofReading_groupwise(grp_cd){
        window.location.href =  '<?=base_url()?>index.php/Admission_inter/return_pdf/'+grp_cd + '/4'
    }
    function ReturnForm_ProofReading_Formnowise(startformno,endformno){
        window.location.href = '<?=base_url()?>index.php/Admission_inter/return_pdf/'+startformno + '/5' +'/'+endformno+'/';
    }
    function Print_Registration_Form_Proofreading_Groupwise(grp_cd){
        window.location.href =  '<?=base_url()?>index.php/Admission_inter/Print_Admission_inter_Form_Proofreading_Groupwise/'+grp_cd + '/1'
    }
    function Print_Registration_Form_Proofreading_Formnowise(startformno,endformno){
        window.location.href =  '<?=base_url()?>index.php/Admission_inter/Print_Admission_inter_Form_Proofreading_Groupwise/'+startformno + '/2' +'/'+endformno+'/';
    }
    function  check_NewEnrol_validation()
    {
        // debugger;
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
            alertify.error("Please upload your Picture First.")
            $img.focus(); 
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

        else if(bFormNo == "" || bFormNo == 0 || bFormNo == undefined)
        {
            alertify.error("Please Enter your bay-Form") 
            $('#bay_form').focus();  
            return status; 
        }
        else if(FNic == "" || FNic.length == undefined )
        {
            alertify.error("Please Enter your Father's CNIC") 
            $('#father_cnic').focus();  
            return status; 
        }

        else if(mobNo == "" || mobNo == 0 || mobNo == undefined)
        {
            alertify.error("Please Enter your Mobile No.") 
            $('#mob_number').focus();   
            return status;  
        }

        else if(MarkOfIdent == "" || MarkOfIdent == 0 || MarkOfIdent == undefined)
        {
            alertify.error("Please Enter your Mark of Indentification") 
            $('#MarkOfIden').focus();   
            return status;  
        }
        else if(address == "" || address == 0 || address.length ==undefined )
        {
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

        else if (teh_cd < 1) 
        {
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
            alertify.error('Please Select your Study Group '); 
            $("#std_group").focus();
            return status;  
        }
        else if ((sub6p1 == 19 || sub6p2 == 19) && (sub7p1 == 20 || sub7p2== 20))
        {
            alertify.error('Please select One Subject from ADVANCED ISLAMIC STUDIES / ISLAMIC HISTORY / MUSLIM HISTORY ');                   
            $("#sub6").focus();
            return status;  
        }
        else if (selected_group_conversion != grppre || exam_type == 2) 
        {
            var ddlMarksImproveoptions = $("#ddlMarksImproveoptions").val();
            if(ddlMarksImproveoptions == 1)
            {
                if (sub6p1 == 0 )
                {
                    alertify.error('Please select Subject ');                   
                    $("#sub6").focus();
                    return status;  
                }  
                else if (sub7p1 == 0)
                {
                    alertify.error('Please select Subject ');
                    $("#sub7").focus();
                    return status;  
                }
                else if (sub8p1 == 0 )
                {
                    alertify.error('Please select Subject '); 
                    $("#sub8").focus();
                    return status;  
                }
            }
            else if(ddlMarksImproveoptions == 2)
            {
                if (sub6p2 == 0)
                {
                    alertify.error('Please select Subject ');                          
                    $("#sub6p2").focus();
                    return status;  
                }
                else   if (sub7p2 == 0)
                {
                    alertify.error('Please select Subject ');
                    $("#sub7p2").focus();
                    return status;  
                }
                else if (sub8p2== 0 )
                {
                    alertify.error('Please select Subject '); 
                    $("#sub8p2").focus();
                    return status;  
                }
            }
            else if (ddlMarksImproveoptions != 4 && exam_type == 2)
            {
                if (sub6p1 == 0 )
                {
                    alertify.error('Please select Subject ');                   
                    $("#sub6").focus();
                    return status;  
                }

                else if (sub6p2 == 0)
                {
                    alertify.error('Please select Subject ');                          
                    $("#sub6p2").focus();
                    return status;  
                }

                else   if (sub7p1 == 0)
                {
                    alertify.error('Please select Subject ');
                    $("#sub7").focus();
                    return status;  
                }
                else   if (sub7p2 == 0)
                {
                    alertify.error('Please select Subject ');
                    $("#sub7p2").focus();
                    return status;  
                }
                else if (sub8p1 == 0 )
                {
                    alertify.error('Please select Subject '); 
                    $("#sub8").focus();
                    return status;  
                }
                else if (sub8p2== 0 )
                {
                    alertify.error('Please select Subject '); 
                    $("#sub8p2").focus();
                    return status;  
                }
            }
        }
        else if(exam_type==15 || exam_type == 16)
        {
            var cattype = "<?php echo @$cattype ?>";

            if(cattype == 2) 
            {
                if (sub6p1 == 0 )
                {
                    alertify.error('Please select Subject ');                   
                    $("#sub6").focus();
                    return status;  
                }

                else if (sub6p2 == 0)
                {
                    alertify.error('Please select Subject ');                          
                    $("#sub6p2").focus();
                    return status;  
                }

                else   if (sub7p1 == 0)
                {
                    alertify.error('Please select Subject ');
                    $("#sub7").focus();
                    return status;  
                }
                else   if (sub7p2 == 0)
                {
                    alertify.error('Please select Subject ');
                    $("#sub7p2").focus();
                    return status;  
                }
                else if (sub8p1 == 0 )
                {
                    alertify.error('Please select Subject '); 
                    $("#sub8").focus();
                    return status;  
                }
                else if (sub8p2== 0 )
                {
                    alertify.error('Please select Subject '); 
                    $("#sub8p2").focus();
                    return status;  
                }
            }

        }
        status = 1;
        return status;
    }
    function  check_NewEnrol_validation_regular()
    {

        $("#previewImg").error(function() {
            alertify.error("Please Put the Image") 
            $('#previewImg').focus();  
            return status; 
        });

        // debugger;
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

        if(name == "" ||  name == undefined){
            alertify.error("Please Enter your  Name")
            $('#cand_name').focus(); 
            return status;
        }
        else if(fName == "" || fName == undefined){
            alertify.error("Please Enter your Father's Name  ") 
            $('#father_name').focus(); 
            return status;
        }   

        else if(bFormNo == "" || bFormNo == 0 || bFormNo == undefined)
        {
            alertify.error("Please Enter your bay-Form") 
            $('#bay_form').focus();  
            return status; 
        }
        else if(FNic == "" || FNic.length == undefined )
        {
            alertify.error("Please Enter your Father's CNIC") 
            $('#father_cnic').focus();  
            return status; 
        }

        else if(mobNo == "" || mobNo == 0 || mobNo == undefined)
        {
            alertify.error("Please Enter your Mobile No.") 
            $('#mob_number').focus();   
            return status;  
        }

        else if(MarkOfIdent == "" || MarkOfIdent == 0 || MarkOfIdent == undefined)
        {
            alertify.error("Please Enter your Mark of Indentification") 
            $('#MarkOfIden').focus();   
            return status;  
        }
        else if(address == "" || address == 0 || address.length ==undefined )
        {
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
            alertify.error('Please Select your Study Group '); 
            $("#std_group").focus();
            return status;  
        }

        else if(grp_cd == 5)
        {
            if($("#sub7p2").val() == 0){
                alertify.error('Please Select Part II, Subject 7 '); 
                $("#sub7p2").focus();
                return status;  
            }
        }

        status = 1;
        return status;
    }

    function gotodefaultpage(){
        var msg = "Are you sure you want to cancel ?"
        alertify.confirm(msg, function (e) 
            {
                if (e) {
                    window.parent.location=<?php base_url() ?>'index.php/Admission';
                }
        });
    }
</script>
</body>
</html>