<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Registration_11th extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login');
        }
        $this->load->library('Browsercache');
        $this->browsercache->dontCache();
        $this->clear_cache();
        $this->clear_all_cache();
    }
    public function clear_all_cache()
    {
        $CI =& get_instance();
        $path = $CI->config->item('cache_path');

        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

        $handle = opendir($cache_path);
        while (($file = readdir($handle))!== FALSE) 
        {
            //Leave the directory protection alone
            if ($file != '.htaccess' && $file != 'index.html')
            {
                @unlink($cache_path.'/'.$file);
            }
        }
        closedir($handle);
    }
    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
    public function index()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        $Inst_name = $userinfo['inst_Name'];

        $isInserted = $userinfo['isInserted'];

        $Inst_name = $userinfo['inst_Name'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$userinfo);
        $this->load->model('Registration_11th_model');
        $count = $this->Registration_11th_model->Dashboard($Inst_Id);
        $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name);
        $this->load->view('Registration/11th/Dashboard.php',$info);
        $this->load->view('common/common_reg/footer.php');  
    }
    public function ReAdmission()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];

        $data = array(
            'isselected' => '6',
        );
        $this->load->view('common/header.php',$userinfo);
        $this->commonheader($data);
        if(!( $this->session->flashdata('error'))){

            $error_msg_readmission = "";    
        }
        else{
            $error_msg_readmission = $this->session->flashdata('error');
        }
        $myinfo = array('error'=>$error_msg_readmission);
        $this->load->view('Registration/11th/ReAdmission.php',$myinfo);
        $this->load->view('common/common_reg/footer.php');

    }  

    public function ReAdmission_check()
    {
        $this->load->model('Registration_11th_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Insgender = $userinfo['gender'];
        $data = array(
            'isselected' => '6',
        );
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $User_info_data = array('Inst_Id'=>$Inst_Id,'RollNo'=>$RollNo,'spl_case'=>17);

        $data = array('mrollno'=>"$RollNo",'board'=>$oldBrd_cd,'year'=>$oldYear,'session'=>$oldSess);
        $feedingcheck=$this->Registration_11th_model->IsReFeeded($data);
        $feeding_inst_cd =$feedingcheck[0]['coll_cd'];
        if($feedingcheck != false)
        {
            $instName=$this->Registration_11th_model->InstName($feeding_inst_cd);
            $this->session->set_flashdata('error', 'This Candidate is already registered in '.$feeding_inst_cd.'-'.$instName.'.');
            redirect('Registration_11th/ReAdmission');
            return;
        }    

        else if($oldBrd_cd ==  1)
        {
            $user_info  =  $this->Registration_11th_model->readmission_check($User_info_data);

            if($user_info == false)
            {
                $this->session->set_flashdata('error', 'This Roll No. Result is not cancelled. Please Cancel result from INTER PART-I Branch Before proceeding!');
                redirect('Registration_11th/ReAdmission');
                return;
            }
            else if($Insgender != $user_info[0]['sex'])
            {
                if($Insgender ==  2)
                {  
                    $this->session->set_flashdata('error', 'GENDER CONTRADICTION! YOUR INSTITUTE CAN NOT SAVE MALE CANDIDATE RECORD!');

                }

                else
                {
                    $this->session->set_flashdata('error', 'GENDER CONTRADICTION! YOUR INSTITUTE CAN NOT SAVE FEMALE CANDIDATE RECORD!');
                }
                redirect('Registration_11th/ReAdmission');
                return;

            }
            else
            {
                $formno = $user_info[0]['FormNo'];
                $OldRno = $user_info[0]['rno'];
                $year = Year;

                $RegStdData = array('isReAdm'=>'1','Oldrno'=>$OldRno);
                $RegStdData['data'][0]=$user_info[0];
                $RegStdData['data'][0]['CellNo'] = $RegStdData['data'][0]['MobNo'];
                $RegStdData['data'][0]['oldbr'] = 1;
                $filledinfo['error'] = "";
                $this->load->view('common/menu.php',$data);
                $this->load->view('Registration/11th/ReAdm_Form.php',$RegStdData);   
                $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 
            }  
        }
        else  if($oldBrd_cd >  1)
        {    $formno = '';
            $OldRno = $RollNo;
            $year = Year;

            $RegStdData = array('isReAdm'=>'1','Oldrno'=>$OldRno);
            $RegStdData['data'][0]  =  '';
            $RegStdData['data'][0]['CellNo'] = '';
            $RegStdData['data'][0]['rno'] = $RollNo;
            $RegStdData['data'][0]['Iyear'] = $oldYear;
            $RegStdData['data'][0]['sess'] = $oldSess;
            $RegStdData['data'][0]['oldbr'] = $oldBrd_cd;
            $RegStdData['data'][0]['sex'] = $Insgender;

            $filledinfo['error'] = "";
            $this->load->view('common/menu.php',$data);
            $this->load->view('Registration/11th/ReAdm_Form.php',$RegStdData);   
            $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 
        }
        else
        {
            redirect('Registration_11th/ReAdmission');
        }

    }
    public function Incomplete_inst_info_INSERT()
    {
        @$_POST['Info_email'];
        @$_POST['info_phone'];
        @$_POST['info_cellNo'];
        @$_POST['info_dist'];
        @$_POST['info_teh'];
        @$_POST['info_zone'];
        $this->load->model('Registration_11th_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];

        $allinfo['Inst_Id'] =$userinfo['Inst_Id'];

        if (!array_key_exists("Info_emis",$_POST))
        {
            $allinfo['Info_emis'] =$userinfo['emis'];
        }
        else
        {
            $allinfo['Info_emis'] =$_POST['Info_emis'];
        }
        if (!array_key_exists("Info_email",$_POST))
        {
            $allinfo['info_email']= $userinfo['email'];
        }
        else
        {
            $allinfo['info_email'] =$_POST['Info_email'];
        }
        if (!array_key_exists("info_phone",$_POST))
        {
            $allinfo['info_phone']= $userinfo['phone'];
        }
        else
        {
            $allinfo['info_phone'] =$_POST['info_phone'];
        }
        if (!array_key_exists("info_cellNo",$_POST))
        {
            $allinfo['info_cellNo']= $userinfo['cell'];
        }
        else
        {
            $allinfo['info_cellNo'] =$_POST['info_cellNo'];
        }
        if (!array_key_exists("info_dist",$_POST))
        {
            $allinfo['info_dist']= $userinfo['dist'];
        }
        else
        {
            $allinfo['info_dist'] =$_POST['info_dist'];
        }
        if (!array_key_exists("info_teh",$_POST))
        {
            $allinfo['info_teh']= $userinfo['teh'];
        }
        else
        {
            $allinfo['info_teh'] =$_POST['info_teh'];
        }
        if (!array_key_exists("info_zone",$_POST))
        {
            $allinfo['info_zone']= $userinfo['zone'];
        }
        else
        {
            $allinfo['info_zone'] =$_POST['info_zone'];
        }

        $filledinfo = array('emis'=>$_POST['Info_emis'],'email'=>$_POST['Info_email'],'phone'=>$_POST['info_phone'],'cell'=>$_POST['info_cellNo'],'dist'=>$_POST['info_dist'],'teh'=>$_POST['info_teh'],'zone'=>$_POST['info_zone']);

        if(trim(empty($allinfo['info_email'])) )
        {
            $filledinfo['error'] = "Please Provide Institute Email Address";
            $this->session->set_flashdata('incomplete',$filledinfo);

            redirect('Registration_11th/index/');
            return;

        }
        if(trim($allinfo['info_phone']=="0") || trim($allinfo['info_phone']=="") || trim($allinfo['info_phone']=="-"))
        {
            $filledinfo['error'] = "Please Provide Institute Phone Number";
            $this->session->set_flashdata('incomplete',$filledinfo);

            redirect('Registration_11th/index/');
            return;

        }
        if(trim($allinfo['info_cellNo']=="0") || trim($allinfo['info_cellNo']=="") || trim($allinfo['info_cellNo']=="-"))
        {
            $filledinfo['error'] = "Please Provide Institute Mobile Number";
            $this->session->set_flashdata('incomplete',$filledinfo);

            redirect('Registration_11th/index/');
            return;

        }
        if(trim($allinfo['info_dist']=="0") || trim($allinfo['info_dist']=="") )
        {

            $filledinfo['error'] = "Please Provide Institute District";
            $this->session->set_flashdata('incomplete',$filledinfo);

            redirect('Registration_11th/index/');
            return;
        }
        if(trim($allinfo['info_teh']=="0") || trim($allinfo['info_teh']=="") )
        {

            $filledinfo['error'] = "Please Provide Institute Tehsil";
            $this->session->set_flashdata('incomplete',$filledinfo);

            redirect('Registration_11th/index/');
            return;
        }
        if(trim($allinfo['info_zone']=="0") || trim($allinfo['info_zone']==""))
        {

            $filledinfo['error'] = "Please Provide Institute Zone";
            $this->session->set_flashdata('incomplete',$filledinfo);
            //$this->load->view('Registration/9th/Incomplete_inst_info.php',$error);
            redirect('Registration_11th/index/');
            return;
        }
        $status = $this->Registration_11th_model->Incomplete_inst_info_INSERT($allinfo);

        if($status == true)
        {
            $this->session->set_flashdata('status',true);
            redirect('Registration_11th/index/');
            return;

        }



    }
    public function Profile_Update(){
    
        $this->load->model('Registration_11th_model');
        // // DebugBreak();();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        $error = array();

        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        if(@$_POST['isGovt']== 1){
            $emis = @$_POST['Profile_emis'];
        }
        else{
            $emis = '';
        }
        $allinputdata = array('Dist_cd'=>$userinfo['dist'],'Teh_cd'=>$userinfo['teh'],'Zone'=>$userinfo['zone'], 'isGovt'=>@$_POST['isGovt'],'Profile_email'=>@$_POST['Profile_email'],'Profile_password'=>@$_POST['Profile_password'],'Profile_phone'=>@$_POST['Profile_phone'],'Profile_cell'=>@$_POST['Profile_cell'],'isInserted'=>@$_POST['isInserted'],'Inst_Id'=>$Inst_Id,'Inst_Id'=>$Inst_Id,'emis'=>$emis
        );

        $result =  $this->Registration_11th_model->Profile_UPDATE($allinputdata); 
        if($result == true){
            $msg = 'success';
            $this->session->set_flashdata('msg',$msg);
            redirect('Registration_11th/Profile');
            return;
        }   
        else{
            $msg = 'error';
            $this->session->set_flashdata('msg',$msg);
            redirect('Registration_11th/Profile');
            return;

        }


    }
    public function Students_matricInfo(){
        //// DebugBreak();();   //Students_matricInfo matric_error
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$userinfo);
        if($this->session->flashdata('matric_error') ){

            $string = $this->session->flashdata('matric_error'); 
            $string = trim(preg_replace('/\s\s+/', ' ', $string));
            $data['excep_halt'] = $string;    
        }
        else{
            $data['excep_halt'] = '';

        }

        $this->load->view('Registration/11th/Students_MatricInfo.php',$data);
        $this->load->view('common/common_reg/footer11threg.php');    

    }
    public function Get_students_record()
    {


        //// DebugBreak();();

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$userinfo);

        if($this->session->flashdata('NewEnrolment_error'))
        {
            // // DebugBreak();();


            $RegStdData['data'][0] = $this->session->flashdata('NewEnrolment_error');
            $RegStdData['isReAdm'] = 0;
            $RegStdData['Oldrno'] = 0;


            $this->load->view('Registration/11th/AdmissionForm.php',$RegStdData);
            $this->load->view('common/common_reg/footer11threg.php');  
            return;


        }
        else{
            $mrollno = $_POST["oldRno"];

            $board   =  $_POST["oldBrd_cd"];

            $year    =  $_POST["oldYear"];

            // $dob     =  $_POST["dob"];

            $session =$_POST["oldSess"];
            
            //echo date("Y",strtotime("-1 year"));  //last year "2013"
          //  echo date("Y"); 
           //  if($year )
            // $oldClass= $_POST["oldClass"];
            $data = array('mrollno'=>"$mrollno",'board'=>$board,'year'=>$year,'session'=>$session);
            $this->load->model('Registration_11th_model');
            $this->load->library('session');
            // $RegStdData = array('data'=>$this->Registration_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0);

            $error['excep'] = '';

            if($this->session->flashdata('IsReAdm')){
                $isReAdm = 1;
                $year = Year;
            }
            else{
                $isReAdm = 0;
                // $year = 2016;    
            }

            //             // DebugBreak();();
             
        
         $year_range = range( date("Y") , date("Y",strtotime("-5 year")) );
           if(!in_array($year,$year_range))
           {
                    $this->session->set_flashdata('matric_error', 'THIS SSC YEAR IS NOT ALLOWED.');
                    redirect('Registration_11th/Students_matricInfo');
                    return;
           }
           
            $feedingcheck=$this->Registration_11th_model->IsFeeded($data);
            $feeding_inst_cd =$feedingcheck[0]['coll_cd'];
            
            if($feedingcheck != false)
            {
                $instName=$this->Registration_11th_model->InstName($feeding_inst_cd);
                $this->session->set_flashdata('matric_error', 'This Candidate is already registered in '.$feeding_inst_cd.'-'.$instName.'.');
                redirect('Registration_11th/Students_matricInfo');
                return; 
            }    
            if($board == 1)
            {
                if(!ctype_digit($mrollno))
                {
                    $this->session->set_flashdata('matric_error', 'SSC ROLL NO. IS INCORRECT');
                    redirect('Registration_11th/Students_matricInfo');
                    return;
                }
                $RegStdData = array('data'=>$this->Registration_11th_model->Pre_Matric_data($data),'isReAdm'=>$isReAdm,'Oldrno'=>0,'Inst_Rno'=>'','excep'=>'','isHafiz'=>'');  

                $RegStdData['data'][0]['excep']='';
                $RegStdData['data'][0]['isHafiz']=0;
                $RegStdData['data'][0]['markOfIden']='';
                $RegStdData['data'][0]['SSC_brd_cd'] = $board;

                $spl_cd = $RegStdData['data'][0]['spl_cd'];
                $msg = $RegStdData['data'][0]['Mesg'];
                $SpacialCase = $RegStdData['data'][0]['SpacialCase'];
                $status = $RegStdData['data'][0]['status'];
                $cand_gender = $RegStdData['data'][0]['Gender'];
                $inst_userinfo_gender = $userinfo['gender'];
            }
            else{

                $RegStdData = array('data'=>'','isReAdm'=>$isReAdm,'Oldrno'=>0,'Inst_Rno'=>'','excep'=>'');
                $RegStdData = array('data'=>$this->Registration_11th_model->Pre_Matric_data($data),'isReAdm'=>$isReAdm,'Oldrno'=>0,'Inst_Rno'=>'','excep'=>'','isHafiz'=>'');  
                if($RegStdData['data']!=False)
                {
                    $RegStdData['data'][0]['excep']='';
                    $RegStdData['data'][0]['isHafiz']=0;
                    $RegStdData['data'][0]['markOfIden']='';
                    if($RegStdData['data'][0]['SSC_brd_cd'] != $board)
                    {
                     $RegStdData['data'] = False;
                    }
                    else
                    {
                    $RegStdData['data'][0]['SSC_brd_cd'] = $board;
                    $spl_cd = $RegStdData['data'][0]['spl_cd'];
                    $msg = $RegStdData['data'][0]['Mesg'];
                    $SpacialCase = $RegStdData['data'][0]['SpacialCase'];
                    $status = $RegStdData['data'][0]['status'];
                    $cand_gender = $RegStdData['data'][0]['Gender'];
                    $inst_userinfo_gender = $userinfo['gender'];  
                    }
                    

                    
                }


            }


        }

        if($RegStdData['data'] == False and $board != 1)
        {
            $error['excep'] = '';
            $RegStdData['data'][0]['SSC_RNo'] = $_POST["oldRno"];
            $RegStdData['data'][0]['SSC_Year'] = $_POST["oldYear"];
            $RegStdData['data'][0]['SSC_Sess'] = $_POST["oldSess"];
            $RegStdData['data'][0]['SSC_brd_cd'] = $_POST["oldBrd_cd"];
            $RegStdData['data'][0]['sub1']=1;
            $mylen = strlen(trim($RegStdData['data'][0]['SSC_RNo']));
            if(trim($RegStdData['data'][0]['SSC_RNo']," ") == '' ||  trim($RegStdData['data'][0]['SSC_RNo']) == '0' || $mylen < 4 )
            {
                $this->session->set_flashdata('matric_error', 'SSC ROLL NO. IS INCORRECT');
                redirect('Registration_11th/Students_matricInfo');
                return;
            }


        }

        else  if($RegStdData['data'][0]['SSC_RNo'] == '' || $RegStdData['data'][0]['SSC_RNo'] == 0 || strlen ($RegStdData['data'][0]['SSC_RNo']) != 6)
        {
            $this->session->set_flashdata('matric_error', 'SSC ROLL NO. IS INCORRECT');
            redirect('Registration_11th/Students_matricInfo');
            return;
        }
        else if($msg != '')
        {
            $this->session->set_flashdata('matric_error', $msg);
            redirect('Registration_11th/Students_matricInfo');
            return;

        }
        else  if($cand_gender != $inst_userinfo_gender)
        {
            if($cand_gender==1 && $inst_userinfo_gender == 2)
            {
                $this->session->set_flashdata('matric_error', 'GENDER CONTRADICTION! YOUR INSTITUTE CAN NOT SAVE MALE CANDIDATE RECORD');
                redirect('Registration_11th/Students_matricInfo');
                return;
            }
            if($cand_gender==2 && $inst_userinfo_gender == 1)
            {
                $this->session->set_flashdata('matric_error', 'GENDER CONTRADICTION! YOUR INSTITUTE CAN NOT SAVE FEMALE CANDIDATE RECORD');
                redirect('Registration_11th/Students_matricInfo');
                return;    
            }

        }


        else  if($msg == -1)
        {
            $this->session->set_flashdata('matric_error', 'NO DATA FOUND AGAINST YOUR RECORD');
            redirect('Registration_11th/Students_matricInfo');
            return;
        }
        else
            if($msg != '')
            {
                $this->session->set_flashdata('matric_error', $msg);
                redirect('Registration_11th/Students_matricInfo');
                return;

            }
            else if($spl_cd != null && $spl_cd != 34)
            {
                $this->session->set_flashdata('matric_error', 'You can not appear due to '.$SpacialCase);
                redirect('Registration_11th/Students_matricInfo');
                return;
            }
            else if($status != 1)
            {
                $this->session->set_flashdata('matric_error', 'You are FAILED in matric ');
                redirect('Registration_11th/Students_matricInfo');
                return;
            }

            $error['excep'] = '';

        $this->load->view('Registration/11th/AdmissionForm.php',$RegStdData);
        $this->load->view('common/common_reg/footer11threg.php');   

    }
    public function NewEnrolment()
    {    
        // // DebugBreak();();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '6',
        );
        //  // DebugBreak();();
        if($this->session->flashdata('NewEnrolment_error')){

            $error['excep'] = $this->session->flashdata('NewEnrolment_error');    
        }
        else{
            $error['excep'] = '';
        }
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['grp_cd'] = $userinfo['grp_cd'];
        $error['isgovt'] = $userinfo['isgovt'];

        $this->commonheader($data);
        $this->load->view('Registration/11th/NewEnrolment.php',$error);
        $this->load->view('common/common_reg/footer11threg.php');
        //$this->load->view('common/common_reg/footer.php');
        //$this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));
        // if(@$_POST['cand_name'] != '' )//&& @$_POST['father_name'] != '' && @$_POST['bay_form'] != '' && @$_POST['father_cnic'] != '' && @$_POST['dob'] != '' && @$_POST['mob_number'] != '') //{   



        //}



    }
    public function NewEnrolment_insert()
    {

        $this->load->model('Registration_11th_model');

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        $error = array();

        //  // DebugBreak();();
        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        // $this->Registration_model->Insert_NewEnorlement($data);    
        $formno = $this->Registration_11th_model->GetFormNo($Inst_Id);//, $fname);//$_POST['username'],$_POST['password']);

        $allinputdata = array('cand_name'=>@$_POST['cand_name'],'father_name'=>@$_POST['father_name'],
            'bay_form'=>@$_POST['bay_form'],'father_cnic'=>@$_POST['father_cnic'],
            'dob'=>@$_POST['dob'],'mob_number'=>@$_POST['mob_number'],
            'medium'=>@$_POST['medium'],'Inst_Rno'=>@$_POST['Inst_Rno'],
            'speciality'=>@$_POST['speciality'],'MarkOfIden'=>@$_POST['MarkOfIden'],
            'medium'=>@$_POST['medium'],'nationality'=>@$_POST['nationality'],
            'gender'=>@$_POST['gender'],'hafiz'=>@$_POST['hafiz'],
            'religion'=>@$_POST['religion'],'std_group'=>@$_POST['std_group'],
            'address'=>@$_POST['address'],
            'UrbanRural'=>@$_POST['UrbanRural'],'sub1'=>@$_POST['sub1'],
            'sub2'=>@$_POST['sub2'],'sub3'=>@$_POST['sub3'],
            'sub4'=>@$_POST['sub4'],'sub5'=>@$_POST['sub5'],
            'sub6'=>@$_POST['sub6'],'sub7'=>@$_POST['sub7'],
            'sub8'=>@$_POST['sub8']
        );

        if((@$_POST['std_group'] != 5) && (@$_POST['std_group'] != 6))
        {
            $allinputdata['sub7']=-1;

        }
        $allinputdata['sub8']=0;



        //$db_img = addslashes($db_img);
        //$db_img = base64_decode($db_img);


        // 

        $sub1ap1 = 0;
        $sub2ap1 = 0;
        $sub3ap1 = 0;
        $sub4ap1 = 0;
        $sub5ap1 = 0;
        $sub6ap1 = 0;
        $sub7ap1 = 0;
        $sub8ap1 = 0;
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1;    
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;    
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
        }
        if(@$_POST['sub7'] != -1)
        {
            $sub7ap1 = 1;    
        }
        if(@$_POST['sub8'] != 0)
        {
            $sub8ap1 = 1;    
        }

        if(@$_POST['sub7'] == -1)
        {
            $sub7 = 0;    
        }
        else{
            $sub7 = @$_POST['sub7'];
        }
        // // DebugBreak();();
        if(@$_POST['OldBrd'] == 1)
        {
            $nationality_hidden = @$_POST['nationality_hidden'];
        }
        else
        {
            $nationality_hidden =@$_POST['nationality'];
        }
        //nationality_hidden
        $addre =  str_replace("'", "", $this->input->post('address'));
        $addre = preg_replace('/[^\x20-\x7E]/','', $addre);

        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'bFormNo' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'dob' =>$this->input->post('dob'),
            'MobNo' =>$this->input->post('mob_number'),
            'medium' =>$this->input->post('medium'),
            'Inst_Rno' =>$this->input->post('Inst_Rno'),
            'markOfIden' =>$this->input->post('MarkOfIden'),
            'Speciality' =>$this->input->post('speciality'),
            'IsPakistani' =>$nationality_hidden,
            'sex' =>$this->input->post('gender'),
            'IsHafiz' =>$this->input->post('hafiz'),
            'IsMuslim' =>$this->input->post('religion'),
            'addr' =>$addre,
            'RegGrp' =>$this->input->post('std_group'),
            'sub1' =>$this->input->post('sub1'),
            'sub2' =>$this->input->post('sub2'),
            'sub3' =>$this->input->post('sub3'),
            'sub4' =>$this->input->post('sub4'),
            'sub5' =>$this->input->post('sub5'),
            'sub6' =>$this->input->post('sub6'),
            'sub7' =>($sub7),
            'sub8' =>$this->input->post('sub8'),
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
            'sub8ap1' => ($sub8ap1),
            'isRural' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>($Inst_Id),
            'FormNo' =>($formno),
            'old_RNo'=>$this->input->post('iOldRno'),
            'old_year'=>$this->input->post('iOldYear'),
            'old_sess'=>$this->input->post('iOldSess'),
            'SSC_RNo'=>$this->input->post('OldRno'),
            'SSC_Year'=>$this->input->post('OldYear'),
            'SSC_Sess'=>$this->input->post('OldSess'),
            'SSC_brd_cd'=>$this->input->post('OldBrd'),
            'IsReAdm'=>$this->input->post('IsReAdm')   ,
            //'Image'=>$encoded_image  
            // 'spl_cd'=>$this->input->post('IsReAdm'),





        );

        /* $allinputdata['excep'] = 'Please Enter Your Name';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;*/
        $target_path = IMAGE_PATH11;
        // $target_path = '../uploads2/'.$Inst_Id.'/';
        if (!file_exists($target_path)){

            mkdir($target_path);
        }
        $target_path = IMAGE_PATH11.$Inst_Id.'/';
        if (!file_exists($target_path)){

            mkdir($target_path);
        } 
        // // DebugBreak();();
        $config['upload_path']   = $target_path;
        $config['allowed_types'] = 'jpg|jpeg';
        $config['max_size']      = '20';
        $config['max_width']     = '260';
        $config['max_height']    = '290';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $formno.'.jpg';

        $filepath = $target_path. $config['file_name']  ;
        $this->load->library('upload', $config);
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        $this->upload->initialize($config);

        if($check !== false) {

            $file_size = round($_FILES['image']['size']/1024, 2);
            if($file_size<=20)
            {
                if ( !$this->upload->do_upload('image',true))
                {
                    if($this->upload->error_msg[0] != "")
                    {
                        $error['excep']= $this->upload->error_msg[0];
                        $data['excep'] = $this->upload->error_msg[0];
                        $this->session->set_flashdata('NewEnrolment_error',$data);
                        //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                        redirect('Registration_11th/Get_students_record');
                        return;

                    }


                }
            }
            else
            {
                $data['excep'] = 'The file you are attempting to upload is larger than the permitted size.';
                $this->session->set_flashdata('NewEnrolment_error',$data);
                //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                redirect('Registration_11th/Get_students_record/');

            }
        }
        else
        {
            // $check = getimagesize($filepath);
            if($check === false)
            {
                $data['excep'] = 'Please Upload Your Picture';
                $this->session->set_flashdata('NewEnrolment_error',$data);
                redirect('Registration_11th/Get_students_record/');
                return;
            }
        }
        $a = getimagesize($filepath);



        if($a[2]!=2)
        {
            $this->convertImage($filepath,$filepath,100,$a['mime']);
        }

        //  // DebugBreak();();

        /*$path = base_url().'Uploads/2016/Private/GridImageTemplate.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $this->load->model('Admission_model');
        $this->load->library('session');
        // // DebugBreak();();
        $data = $this->Admission_model->Insert_Image($base64);
        $myimg = $data[0][Image_string];
        echo "<img src='$myimg'>";

        return;*/
        /* $data_pic = fopen ($filepath, 'rb');

        $size=filesize ($filepath);

        $contents= fread ($fd, $size);

        fclose ($fd);  

        $encoded_data = base64_encode($contents);*/

        $this->frmvalidation('Get_students_record',$data,0);

        // // DebugBreak();();
        $type = pathinfo($filepath, PATHINFO_EXTENSION);
        $pic_data = file_get_contents($filepath);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($pic_data);
        $data['Image']=$base64;

        $logedIn = $this->Registration_11th_model->Insert_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        $error = $logedIn[0]['error'];
        // // DebugBreak();();
        if($error == 'true' || $logedIn == "true")
        {  
            $allinputdata = "";
            $error = $logedIn[0]['error'];
            $allinputdata['excep'] = 'success';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/EditForms');
            return;


        }
        else
        {     

            // // DebugBreak();();
            // $allinputdata = $data;  Students_matricInfo matric_error
            //$allinputdata['excep'] = $error;
            $this->session->set_flashdata('matric_error',$error);
            redirect('Registration_11th/Students_matricInfo');
            return;
            echo 'Data NOT Saved Successfully !';

        } 



        $this->load->view('common/common_reg/footer11threg.php');
    }
    public function commonheader($data)
    {
        $this->load->view('common/header.php',$data);
        $this->load->view('common/menu.php',$data);
    } 
    public function commonfooter($data)
    {
        $this->load->view('common/common_reg/footer11threg.php',$data);
    }
    public function EditForms()
    {
        // // DebugBreak();();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '6',

        );
        $msg = $this->uri->segment(3);



        if($msg == FALSE){

            $error_msg = $this->session->flashdata('error');    
        }
        else{
            $error_msg = $msg;
        }

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_11th_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        // // DebugBreak();();
        $RegStdData = array('data'=>$this->Registration_11th_model->EditEnrolement($user['Inst_Id']),'grp_cd'=>$user['grp_cdi']);
        $total = count($RegStdData)+1;
        //// DebugBreak();();
        $data['editformcount']=$total;
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Registration/11th/EditForms.php',$RegStdData);
        $this->load->view('common/common_reg/footer11threg.php');



    }
    public function NewEnrolment_Delete($formno)
    {
        // // DebugBreak();();
        $this->load->model('Registration_11th_model');
        $RegStdData = array('data'=>$this->Registration_11th_model->Delete_NewEnrolement($formno));
        $this->load->library('session');
        $this->session->set_flashdata('error', '2');
        redirect('Registration_11th/EditForms');
        return;
    }
    public function NewEnrolment_EditForm()
    {    
        //  // DebugBreak();();
        $formno = $this->uri->segment(3);
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $isReAdm = 0;
        $year = 0;
        $data = array(
            'isselected' => '6',
        );
        $this->load->model('Registration_11th_model');
        if($this->session->flashdata('NewEnrolment_error')){
            //// DebugBreak();();

            $RegStdData['data'][0] = $this->session->flashdata('NewEnrolment_error');   
            $isReAdm = 0;//$RegStdData['data'][0]['isReAdm'];
            $RegStdData['isReAdm']=$isReAdm;
            $RegStdData['Oldrno']=0;

        }
        else{
            $error['excep'] = '';

            if($this->session->flashdata('IsReAdm')){
                $isReAdm = 1;
                $year = Year-1;
            }
            else{
                $isReAdm = 0;
                $year = Year;    
            }

            $RegStdData = array('data'=>$this->Registration_11th_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0);
        }


        $this->load->view('common/menu.php',$data);
        $this->load->view('Registration/11th/Edit_Enrolement_form.php',$RegStdData);   
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 

    }
    public function NewEnrolment_update()
    {
        // // DebugBreak();();

        $this->load->model('Registration_11th_model');

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        $error = array();
        // // DebugBreak();();
        $formno =  $_POST['formNo'];  //$this->Registration_model->GetFormNo($Inst_Id);//, $fname);//$_POST['username'],$_POST['password']);
        $sub1ap1 = 0;
        $sub2ap1 = 0;
        $sub3ap1 = 0;
        $sub4ap1 = 0;
        $sub5ap1 = 0;
        $sub6ap1 = 0;
        $sub7ap1 = 0;
        $sub8ap1 = 0;
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1;    
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;    
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
        }
        if(@$_POST['sub7'] == -1 || @$_POST['sub7'] == 0 )
        {
            $sub7 = 0;    
        }
        else
        {
            $sub7 = @$_POST['sub7'];
            $sub7ap1 = 1;   
        }
        /* if(@$_POST['sub7'] != -1)
        {
        $sub7ap1 = 1;    
        }*/
        if(@$_POST['sub8'] != -1)
        {
            $sub8ap1 = 1;    
        }

        // // DebugBreak();();
        if(@$_POST['IsReAdm'] == '1')
        {


            $User_info_data = array('Inst_Id'=>$Inst_Id,'RollNo'=>@$_POST['OldRno'],'spl_case'=>17);
            $user_info  =  $this->Registration_11th_model->readmission_check($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);

            if($user_info == false)
            {
                $this->session->set_flashdata('error', 'This Roll No. Result is not cancelled. Please Cancel result from 9th Branch Before proceeding!');
                redirect('Registration/ReAdmission');
                return;
            }
            // // DebugBreak();();
            $addre =  str_replace("'", "", @$_POST['address']);
            $allinputdata = array('CellNo'=>@$_POST['mob_number'],
                'med'=>@$_POST['medium'],'classRno'=>@$_POST['Inst_Rno'],
                'speciality'=>@$_POST['speciality'],'markOfIden'=>@$_POST['MarkOfIden'],
                'med'=>@$_POST['medium'],'nat'=>@$_POST['nationality'],
                'sex'=>@$_POST['gender'],'Ishafiz'=>@$_POST['hafiz'],
                'rel'=>@$_POST['religion'],'RegGrp'=>@$_POST['std_group'],
                'addr'=>$addre,
                'RuralORUrban'=>@$_POST['UrbanRural'],'sub1'=>@$_POST['sub1'],
                'sub2'=>@$_POST['sub2'],'sub3'=>@$_POST['sub3'],
                'sub4'=>@$_POST['sub4'],'sub5'=>@$_POST['sub5'],
                'sub6'=>@$_POST['sub6'],'sub7'=>@$_POST['sub7'],
                'sub8'=>@$_POST['sub8'],'PicPath'=>$config['file_name'],'formNo'=>$formno,
                'sub1ap1' => ($sub1ap1),
                'sub2ap1' => ($sub2ap1),
                'sub3ap1' => ($sub3ap1),
                'sub4ap1' => ($sub4ap1),
                'sub5ap1' => ($sub5ap1),
                'sub6ap1' => ($sub6ap1),
                'sub7ap1' => ($sub7ap1),
                'sub8ap1' => ($sub8ap1),

            );
            $allinputdata['name']= $user_info[0]['name'];
            $allinputdata['Fname']= $user_info[0]['Fname'];
            $allinputdata['BForm']= $user_info[0]['BForm'];
            $allinputdata['FNIC']= $user_info[0]['FNIC'];
            $allinputdata['Dob']= $user_info[0]['Dob'];
            $allinputdata['regoldrno']= $user_info[0]['rno'];
            $allinputdata['regoldsess']= $user_info[0]['sess'];
            $allinputdata['regoldclass']= $user_info[0]['class'];
            $allinputdata['regoldyear']= $user_info[0]['Iyear'];
            $allinputdata['isreadm']= 1;
            $formno = $this->Registration_11th_model->GetFormNo($Inst_Id);
            $allinputdata['formNo']= $formno;
            //// DebugBreak();();

        }
        else{
            $addre =  str_replace("'", "", @$_POST['address']);
            $allinputdata = array('name'=>@$_POST['cand_name'],'Fname'=>@$_POST['father_name'],
                'BForm'=>@$_POST['bay_form'],'FNIC'=>@$_POST['father_cnic'],
                'Dob'=>@$_POST['dob'],'CellNo'=>@$_POST['mob_number'],
                'med'=>@$_POST['medium'],'classRno'=>@$_POST['Inst_Rno'],
                'speciality'=>@$_POST['speciality'],'markOfIden'=>@$_POST['MarkOfIden'],
                'med'=>@$_POST['medium'],'nat'=>@$_POST['nationality'],
                'sex'=>@$_POST['gender'],'Ishafiz'=>@$_POST['hafiz'],
                'rel'=>@$_POST['religion'],'RegGrp'=>@$_POST['std_group'],
                'addr'=>$addre,
                'RuralORUrban'=>@$_POST['UrbanRural'],'sub1'=>@$_POST['sub1'],
                'sub2'=>@$_POST['sub2'],'sub3'=>@$_POST['sub3'],
                'sub4'=>@$_POST['sub4'],'sub5'=>@$_POST['sub5'],
                'sub6'=>@$_POST['sub6'],'sub7'=>@$_POST['sub7'],
                'sub8'=>@$_POST['sub8'],'PicPath'=>$config['file_name'],'formNo'=>@$_POST['formNo'],
                'sub1ap1' => ($sub1ap1),
                'sub2ap1' => ($sub2ap1),
                'sub3ap1' => ($sub3ap1),
                'sub4ap1' => ($sub4ap1),
                'sub5ap1' => ($sub5ap1),
                'sub6ap1' => ($sub6ap1),
                'sub7ap1' => ($sub7ap1),
                'sub8ap1' => ($sub8ap1),
            );
            $allinputdata['regoldrno']= 0;
            $allinputdata['regoldsess']= 0;
            $allinputdata['regoldclass']=0;
            $allinputdata['regoldyear']= 0;
            $allinputdata['isreadm']= 0;
        }


        /*  $this->upload->initialize($config);

        if($check !== false) {

        $file_size = round($_FILES['image']['size']/1024, 2);
        if($file_size<=20)
        {

        if ( !$this->upload->do_upload('image',True))
        {
        if($this->upload->error_msg[0] != "")
        {
        $error['excep']= $this->upload->error_msg[0];
        $allinputdata['excep'] = $this->upload->error_msg[0];
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration/NewEnrolment_EditForm/'.$formno);
        return;

        }

        }
        }
        else
        {
        $allinputdata['excep'] = 'The file you are attempting to upload is larger than the permitted size.';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        //  echo '<pre>'; print_r($allinputdata['excep']);exit();
        redirect('Registration/NewEnrolment_EditForm/'.$formno);

        }


        }
        else
        {
        $check = getimagesize($filepath);
        if($check === false)
        {
        $allinputdata['excep'] = 'Please Upload Your Picture';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration/NewEnrolment_EditForm/'.$formno);
        return;
        }
        }*/


        //// DebugBreak();();
        // $this->frmvalidation('NewEnrolment_EditForm/'.$formno,$allinputdata,1);

        /*  $a = getimagesize($filepath);
        if($a[2]!=2)
        {
        $this->convertImage($filepath,$filepath,100,$a['mime']);
        }*/

        // $name = 'Waseem Saleem'; Edit_Enrolement_form
        // $fname = 'Muhammad Saleem'; 
        $sub1ap1 = 0;
        $sub2ap1 = 0;
        $sub3ap1 = 0;
        $sub4ap1 = 0;
        $sub5ap1 = 0;
        $sub6ap1 = 0;
        $sub7ap1 = 0;
        $sub8ap1 = 0;
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1;    
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;    
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
        }
        if(@$_POST['sub7'] != 0)
        {
            $sub7ap1 = 1;  

        }
        if(@$_POST['sub8'] != 0)
        {
            $sub8ap1 = 1;    

        }
        // // DebugBreak();();   
        $addre =  str_replace("'", "", $this->input->post('address'));
        $addre = preg_replace('/[[:^print:]]/', '', $addre);
        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'BForm' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'Dob' =>$this->input->post('dob'),
            'MobNo' =>$this->input->post('mob_number'),
            'medium' =>$this->input->post('medium'),
            'classRno' =>$this->input->post('Inst_Rno'),
            'markOfIden' =>$this->input->post('MarkOfIden'),
            'Speciality' =>$this->input->post('speciality'),
            'nat' =>$this->input->post('nationality'),
            'sex' =>$this->input->post('gender'),
            'Ishafiz' =>$this->input->post('hafiz'),
            'rel' =>$this->input->post('religion'),
            'addr' =>$addre,
            'RegGrp' =>$this->input->post('std_group'),
            'sub1' =>$this->input->post('sub1'),
            'sub2' =>$this->input->post('sub2'),
            'sub3' =>$this->input->post('sub3'),
            'sub4' =>$this->input->post('sub4'),
            'sub5' =>$this->input->post('sub5'),
            'sub6' =>$this->input->post('sub6'),
            'sub7' =>($sub7),
            'sub8' =>$this->input->post('sub8'),
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
            'sub8ap1' => ($sub8ap1),
            'ruralOrurban' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>($Inst_Id),
            'FormNo' =>($formno),

            'SSC_RNo'=>$this->input->post('OldRno'),
            'SSC_Year'=>$this->input->post('OldYear'),
            'SSC_Sess'=>$this->input->post('OldSess'),
            'SSC_brd_cd'=>$this->input->post('OldBrd'),
            'IsReAdm'=>$this->input->post('IsReAdm')   ,
            'Brd_cd'=>$this->input->post('Brd_cd'),
            // 'Image'=>$encoded_image  ,
            'PicPath'=>$formno.".jpg"
            // 'spl_cd'=>$this->input->post('IsReAdm'),





        );

        // // DebugBreak();();

        $check = getimagesize($_FILES["image"]["tmp_name"]);


        if($check !== false)
        {

            $target_path = IMAGE_PATH11.$Inst_Id.'/';
            // $target_path = '../uploads2/'.$Inst_Id.'/';
            if (!file_exists($target_path)){

                mkdir($target_path);
            }
            $target_path = IMAGE_PATH11.$Inst_Id.'/';
            $config['upload_path']   = $target_path;
            $config['allowed_types'] = 'jpg';
            $config['max_size']      = '20';
            $config['max_width']     = '260';
            $config['max_height']    = '290';
            $config['overwrite']     = TRUE;
            $config['file_name']     = $formno.'.jpg';

            $filepath = $target_path. $config['file_name']  ;
            $this->load->library('upload', $config);

            $file_size = round($_FILES['image']['size']/1024, 2);
            $this->upload->initialize($config);
            if($file_size<=20)
            {
                if ( !$this->upload->do_upload('image',true))
                {
                    if($this->upload->error_msg[0] != "")
                    {
                        $error['excep']= $this->upload->error_msg[0];
                        $data['excep'] = $this->upload->error_msg[0];
                        $this->session->set_flashdata('NewEnrolment_error',$data);
                        //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                        redirect('Registration_11th/NewEnrolment_EditForm/');
                        return;

                    }


                }
            }
            else
            {
                $data['excep'] = 'The file you are attempting to upload is larger than the permitted size.';
                $this->session->set_flashdata('NewEnrolment_error',$data);
                //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                redirect('Registration_11th/NewEnrolment_EditForm/');

            }
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            $a = getimagesize($filepath);
            if($a[2]!=2)
            {
                $this->convertImage($filepath,$filepath,100,$a['mime']);
            }
            $type = pathinfo($filepath, PATHINFO_EXTENSION);
            $pic_data = file_get_contents($filepath);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($pic_data);
            $data['Image']=$base64;

        }
        else
        {
            $data['Image']='';    
        }

        $data['isReAdm']=$isReAdm;
        $data['Oldrno']=0;
        //$data['Image'] = '';
        $this->frmvalidation('NewEnrolment_EditForm',$data,1);        
        $logedIn = $this->Registration_11th_model->Update_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        if($logedIn != false)
        {  

            $this->session->set_flashdata('error', 'success');
            redirect('Registration_11th/EditForms');
            return;

            echo 'Data Saved Successfully !';

        }
        else
        {     
            echo 'Data NOT Saved Successfully !';

        } 



        $this->load->view('common/common_reg/footer.php');
    }
    public function CreateBatch()
    {
        //  // DebugBreak();();
        $data = array(
            'isselected' => '6',

        );
        $msg = $this->uri->segment(3);
        $spl_cd = $this->uri->segment(4);
        $grp_selected = $this->uri->segment(5);

        $this->load->library('session');
        if($this->session->flashdata('error')){

            $error_msg = $this->session->flashdata('error');    

        }
        else{
            $error_msg = 0;
        }


        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_11th_model');
        $myinfo = array('Inst_cd'=>$user['Inst_Id'],'spl_cd'=>$spl_cd,'grp_cd'=>$user['grp_cdi'],'grp_selected'=>$grp_selected);
        $RegStdData = array('data'=>$this->Registration_11th_model->Spl_case_std_list($myinfo),'spl_cd'=>$spl_cd,'grp_selected'=>$grp_selected);
        $RegStdData['msg_status'] = $error_msg;
        $RegStdData['spl_cd'] =  $spl_cd;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);

        $this->load->view('Registration/11th/CreateBatch.php',$RegStdData);
        $this->load->view('common/common_reg/footer11threg.php');



    }
    public function forwarding_pdf()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_11th_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id']);
        $Batch_Id = $this->uri->segment(3);
        if($Batch_Id > 0)
        {
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Registration_11th_model->forwarding_pdf_final($fetch_data),'inst_Name'=>$user['inst_Name']);
        }
        else
        {
            $Batch_Id = 0;
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Registration_11th_model->forwarding_pdf_final($fetch_data),'inst_Name'=>$user['inst_Name']);
        }
        // $result = array('data'=>$this->Registration_11th_model->forwarding_pdf_final($fetch_data),'inst_Name'=>$user['inst_Name']);    
        if(empty($result['data']))
        {
            $this->session->set_flashdata('error', $Condition);
            redirect('Registration/FormPrinting');
            return; 
        }
        $temp = $user['Inst_Id'].'@11@'.sessReg;
        $image =  $this->set_barcode($temp);
        $this->load->library('PDF_RotateWithOutPage');
        $pdf = new PDF_RotateWithOutPage('P','in',"A4");
        $pdf->Rotate(0,-1,-1);
        $pdf->AliasNbPages();
        $pdf->SetTitle('Forwarding Letter');
        $pdf->SetMargins(0.5,0.5,0.5);
        $lmargin =0.5;
        $rmargin =7.5;
        $topMargin = 0.5;
        $countofrecords=14;
        $title=1.0;
        $cnt=0; $ln[0]=1.5;
        $SR=1;

        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();

        $pdf->Image("assets/img/logo2.png",0.4, 0.25, 0.55, 0.55, "PNG");

        $pdf->SetFont('Arial','U',14);
        $pdf->SetXY( 1.0,0.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(1.5,0.4);
        $pdf->Cell(0, 0.25, "FORWARDING LETTER SHOWING DETAILS OF INTER PART-I REGISTRATION, ".sessReg, 0.25, "C");

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(2.6,2.4);
        $pdf->Image(BARCODE_PATH.$image,6.3,0.65, 1.8, 0.20, "PNG"); 
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(0.8,0.94);
        $pdf->MultiCell(7, 0.18,$user['Inst_Id']. "-". $user['inst_Name'],'',"L",0);


        $x = 0;
        $y = 0.2;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(0.4+$x,0.7+$y);
        $pdf->Cell(0, 0.25, "FROM", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,1.+$y);
        $pdf->Cell(0, 0.25, "PRINCIPAL", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,1.+$y);
        $pdf->Cell(0, 0.25, "______________________________________", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,1.4+$y);
        $pdf->Cell(0, 0.25, "______________________________________", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,1.8+$y);
        $pdf->Cell(0, 0.25, "Institute Diary No:_______________________", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,2.2+$y);
        $pdf->Cell(0, 0.25, "Dated:_________________________________", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(4.9+$x,1.8+$y);
        $pdf->Cell(0, 0.25, "Landline No:_________________________", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(4.9+$x,2.2+$y);
        $pdf->Cell(0, 0.25, "Mobile No:___________________________", 0.25, "C");



        //$y = $y+0.8;
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,2.95+$y);
        $pdf->Cell(0, 0.25, "TO", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.2+$x,3.1+$y);
        $pdf->Cell(0, 0.25, "The Secretary", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.2+$x,3.3+$y);
        $pdf->Cell(0, 0.25, "Board of Intermediate & Secondary Education,", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.2+$x,3.5+$y);
        $pdf->Cell(0, 0.25, "Gujranwala", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.4+$x,4.0+$y);
        $pdf->Cell(0, 0.25, "Sir,", 0.25, "C");


        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.9+$x,4.2+$y);

        $pdf->MultiCell(6.5, 0.2, "  I am forwarding registration forms along with the relevent enclosures of Candidates Group appearing from my Institute in the ensuring Inter Part-I Registration, ".sessReg." are ", 0,"J",0);

        $x = 1; 
        $dy = 4.6; 
        $pdf->SetXY(0.5,$y+$dy);
        $pdf->SetFont('Arial','',10);

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.7,$y+$dy);

        $xx= 2.0;
        $y = $y - 1.1;                
        $yy = 1.95+$y;

        $fontsize = 8;
        $boxWidth = 2.9;
        $boxhieght =  .26;
        $pdf->SetFont('Arial','B',$fontsize);

        $yy =  3.75+$yy;

        $pdf->SetXY($xx,$yy);
        $pdf->SetFillColor(240,240,240);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'Sr#',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'Group Name',1,0,'L',1);
        $pdf->SetFont('Arial','B',$fontsize);
        $pdf->Cell($boxWidth-1.5,$boxhieght,'No. of Students.',1,0,'C',1);
        /*$pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth-1.8,0.2,'With Late Fee',1,0,'L',1);
        $pdf->Cell($boxWidth-1.7,0.2,'Without Late fee',1,0,'L',1);*/
        $yy = $boxhieght+$yy;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',$fontsize);

        $pdf->SetXY($xx,$yy);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'1',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'PRE-MEDICAL',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        // $pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['lateFee1'],1,0,'C',1);
        // $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlateFee1'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee1'],1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','',$fontsize);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'2',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'PRE-ENGINEERING',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        //$pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['lateFee2'],1,0,'C',1);
        //$pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlateFee2'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee2'],1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','',$fontsize);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'3',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'HUMANITIES',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        // $pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['lateFee3'],1,0,'C',1);
        //  $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlateFee3'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee3'],1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','',$fontsize);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'4',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'GENERAL SCIENCE',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        // $pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['lateFee4'],1,0,'C',1);
        // $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlateFee4'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee4'],1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','',$fontsize);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'5',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'COMMERCE',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        // $pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['lateFee5'],1,0,'C',1);
        // $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlateFee5'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee5'],1,0,'C',1);
        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);

        /*  $pdf->SetFont('Arial','',$fontsize);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'5',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'DEAF & DUMB',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee6'],1,0,'C',1);

        $yy = $boxhieght+$yy;                                                            */
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','',$fontsize);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'5',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,"BOARD EMPLOYEE's CHILD (IF ANY)",1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee7'],1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7    ,$boxhieght,'Total:',1,0,'L',1);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['totalFee'],1,0,'C',1);

        $y = $y+0.5;
        /*$pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.9,6.7+$y);    
        $pdf->MultiCell(6.5,0.2,"Name of the candidates who have not completed the required number of attendances up to the date of the submission of their forms are being submitted provisionally and are mentioned overleaf. Final report regarding their eligibility will be sent to you in due course as instructed in the book of instructions and information.
        ",0,"J",0)    ; */

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.87,7.6+$y);    
        $pdf->MultiCell(6.5,0.2,"I certify that the forwarding letter has been filled in strictly according to the instructions and the certificate printed on the registration returns has been signed by me.",0,"J",0); //// I also certify that I have initialled all corrections made in the registration forms.

        /*  $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.0+$y);    
        $pdf->MultiCell(8.5,0.2," All my candidates will appear at ________________________________________________________ ",0,"L",0)    ;*/

        $pdf->SetFont('Arial','BU',10);
        $pdf->SetXY(0.9,8.05+$y);    
        $pdf->MultiCell(1.5,0.2,"Amount: ".$result['data'][0]['Amount'],0,"L",0); 

        $pdf->SetFont('Arial','BU',10);
        $pdf->SetXY(0.9,8.35+$y);    
        $pdf->MultiCell(7,0.2,"Challan No(s): ".$result['data'][0]['Challan_No'],0,"L",0); 

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.85+$y);    
        $pdf->MultiCell(10,0.2,"Paid Date:____________________________",0,"L",0); 

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.25+$y);    
        $pdf->MultiCell(10,0.2,"Bank Branch Name:__________________________________________________________________",0,"L",0); 

        /*  $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.49+$y);    
        $pdf->Cell(1.6,0.2,"(Other remarks if any)",0,"R",0);

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.55+$y); 
        $pdf->MultiCell(8.5,0.2,"____________________________________________________________________________________",0,"L",0)    ;   


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.85+$y);    
        $pdf->MultiCell(8.5,0.2,"____________________________________________________________________________________",0,"L",0)    ;   

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10.15+$y);    
        $pdf->MultiCell(8.5,0.2,"____________________________________________________________________________________",0,"L",0)    ;   
        */


        // // DebugBreak();();

        //
        /*$pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10+$y);    
        $pdf->MultiCell(10,0.2,"",0,"L",0); */

        //  $y = $y+0.9;

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.65+$y);    
        $pdf->MultiCell(8.5,0.2,"Enclosures:",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.95+$y);    
        $pdf->MultiCell(8.5,0.2,"1.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10.25+$y);    
        $pdf->MultiCell(8.5,0.2,"2.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10.55+$y);    
        $pdf->MultiCell(8.5,0.2,"3.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10.85+$y);    
        $pdf->MultiCell(8.5,0.2,"4.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,11.15+$y);    
        $pdf->MultiCell(8.5,0.2,"5.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','UB',10);
        $pdf->SetXY(5.4,11.05+$y);    
        $pdf->MultiCell(8.5,0.2,"Signature & Stamp of Principal",0,"L",0)    ; 
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(5.4,11.35+$y);    
        $pdf->MultiCell(8.5,0.2,"CNIC NO.___________________",0,"L",0)    ; 

        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(1.0,11.69+$y); 
        $pdf->Cell(0,0,'Print Date: '. date('d-m-Y H:i:s a'),0,0,'L',0);

        /*$yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'',1,0,'C',1);

        $pdf->Cell($boxWidth-0.7    ,$boxhieght,'Total:',1,0,'L',1);
        // $pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['latetotalFee'],1,0,'C',1);
        // $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlatetotalFee'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['totalFee'],1,0,'C',1);

        $y = $y+1.1;
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.9,6.6+$y);    
        $pdf->MultiCell(6.5,0.2," Name of the candidates who have not completed the required number of attendances up to the date of the submission of their forms are being submitted provisionally and are mentioned overleaf. Final report regarding their eligibility will be sent to you in due course as instructed in the book of instructions and information.
        ",0,"J",0)    ;

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.85,7.4+$y);    
        $pdf->MultiCell(6.5,0.2," I certify that the forms have been filled in strictly according to the instructions and the certificate printed on the registration forms have been signed by me. I also certify that I have initialled all corrections made in the registration forms.

        ",0,"J",0)    ;

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.0+$y);    
        $pdf->MultiCell(8.5,0.2," All my candidates will appear at ________________________________________________________ ",0,"L",0)    ;

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.25+$y);    
        $pdf->Cell(1.6,0.2,"(Other remarks if any)",0,"R",0);

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.55+$y); 
        $pdf->MultiCell(8.5,0.2,"____________________________________________________________________________________",0,"L",0)    ;   


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.85+$y);    
        $pdf->MultiCell(8.5,0.2,"____________________________________________________________________________________",0,"L",0)    ;   

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.15+$y);    
        $pdf->MultiCell(8.5,0.2,"____________________________________________________________________________________",0,"L",0)    ;   

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.4+$y);    
        $pdf->MultiCell(6.6,0.2,"Yours Obediently,",0,"R",0)    ;   

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.65+$y);    
        $pdf->MultiCell(8.5,0.2,"Enclosures:",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.95+$y);    
        $pdf->MultiCell(8.5,0.2,"1.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10.25+$y);    
        $pdf->MultiCell(8.5,0.2,"2.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10.55+$y);    
        $pdf->MultiCell(8.5,0.2,"3.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10.85+$y);    
        $pdf->MultiCell(8.5,0.2,"4.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,11.15+$y);    
        $pdf->MultiCell(8.5,0.2,"5.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','UB',10);
        $pdf->SetXY(5.4,11.05+$y);    
        $pdf->MultiCell(8.5,0.2,"Signature & Stamp of Principal",0,"L",0)    ; 

        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(5.4,11.25+$y);    
        $pdf->MultiCell(8.5,0.2,'Print Date: '. date('d-m-Y H:i:s a'),0,"L",0)    ;   */
        $pdf->Output('123'.'.pdf', 'I');
    }
    public function BatchList()
    {
        // // DebugBreak();();
        $data = array(
            'isselected' => '6',

        );
        // $this->commonheader($data);
        $this->load->model('Registration_11th_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        //$page_name  = "Create Batch";
        if($this->session->flashdata('BatchList_error')){

            $error_msg = $this->session->flashdata('BatchList_error');    

        }
        else{
            $error_msg = '';
        }
        $data1 = array('Inst_Id'=>$Inst_Id);
        $user_info  =  $this->Registration_11th_model->Batch_List($data1);
        $user_info_arr = array('info'=>$user_info,'errors'=>$error_msg);
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);

        $this->load->view('Registration/11th/BatchList.php',$user_info_arr);


        $this->load->view('common/common_reg/footer11threg.php');
        //$this->commonheader($data);
        //  $this->load->view('Registration/9th/BatchList.php');
        //$this->commonfooter();
    }
    public function FormPrinting()
    {

        $this->load->library('session');
        //// DebugBreak();();
        if(!( $this->session->flashdata('error'))){

            $error_msg = "0";    
        }
        else{
            $error_msg = $this->session->flashdata('error');
        }
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '6',
        );
        //  // DebugBreak();();
        $error = array();
        $error['excep'] = '';
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['error_msg'] = $error_msg;
        $this->commonheader($data);
        $this->load->view('Registration/11th/FormPrinting.php',$error);
        $this->load->view('common/common_reg/footer11threg.php');
        //$this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));

        //$this->load->model('Registration_model');
    }
    public function Reg_Cards_Printing_11th()
    {

        $this->load->library('session');
        // // DebugBreak();();
        if(!( $this->session->flashdata('error'))){

            $error_msg = "0";    
        }
        else{
            $error_msg = $this->session->flashdata('error');
        }
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '6',
        );
        //  // DebugBreak();();
        $error = array();
        $error['excep'] = '';
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['error_msg'] = $error_msg;
        $this->commonheader($data);
        $this->load->view('Registration/11th/RegCards.php',$error);
        $this->load->view('common/common_reg/footer11threg.php');
        // $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));

        //$this->load->model('Registration_model');
    }
    public function Reg_Cards_Printing_11th_PDF()
    {

        // // DebugBreak();();
        $Condition = $this->uri->segment(4);
        /*
        $Condition  1 == Batch Id wise printing.
        2 == Final Group wise prining.
        3 == Final Formno wise Printing.
        4 == Proof reading Group wise Printing.
        5 == Proof reading Formno wise Printing.
        */
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_11th_model');
        if($Condition == "1")
        {
            $Batch_Id = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Registration_11th_model->return_pdf($fetch_data),'inst_Name'=>$user['inst_Name']);    
        }
        else if($Condition == "2")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>0);
            $result = array('data'=>$this->Registration_11th_model->Print_Form_Groupwise($fetch_data));

        }

        else if($Condition == "3")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);


            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>0);
            $result = array('data'=>$this->Registration_11th_model->Print_Form_Formnowise($fetch_data));
        }
        else if($Condition == "4")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_11th_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }
        else if($Condition == "5")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_11th_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }

        // // DebugBreak();();
        if(empty($result['data'])){
            $this->session->set_flashdata('error', $Condition);
            redirect('Registration_11th/Reg_Cards_Printing_11th');
            return;

        }
        $temp = $user['Inst_Id'].'@11@'.sessReg;
        $image =  $this->set_barcode($temp);
        // $pdf->Image(base_url().'assets/pdfs/'.'/'.$image,6.3,0.5, 1.8, 0.20, "PNG");
        //$studeninfo['data']['info'][0]['barcode'] = $image;
        $this->load->library('PDF_Rotate');

        $turn=1;     
        $pdf = new PDF_Rotate('P','in',"A4");
        //$pdf=new FPDF_BARCODE("P","in","A4");
        $pdf->SetMargins(0.5,1.2,0.5);
        $pdf->AliasNbPages();

        $generatingpdf=false;
        $result = $result['data'] ;
        $inc=0 ;
        foreach ($result as $key=>$data) 
        {

            if($data['strRegNo'] == NULL)
            {
                $data['strRegNo'] = $this->Registration_11th_model->generateStrNo($data['sex'],$data['formNo']) ;
            }

            $temp = str_replace("-","",$data['strRegNo']).'@11@'.sessReg;
            $image =  $this->set_barcode($temp);

            $generatingpdf=true;
            if($turn==1){$pdf->AddPage(); $dy=0.1;} else {
                if($turn==2){$dy=3.8;} else {$dy=7.5; $turn=0;}
            }
            $inc++;
            $turn++;
            $y = 0.05;
            $pdf->SetFont('Arial','U',16);
            $pdf->SetXY(1.2,$y+$dy+0.17);
            $pdf->Cell(0, $y, "Board of Intermediate and Secondary Education,Gujranwala", 0.25, "C");

            $pdf->Image(base_url()."assets/img/logo.jpg",0.3,$y+$dy+0.1, 0.60,0.60, "JPG", "http://www.bisegrw.com");
            $pdf->SetFont('Arial','',10);
            $y += 0.25;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(1.4,$y+$dy-0.00);
            $pdf->Cell(0, 0.25, "".Reg_Cards_11th_Heading." REGULAR STUDENT REGISTRATION CARD SESSION (".CURRENT_SESS.")", 0.25, "C");

            $pdf->SetDrawColor(0,0,0);
            //$pdf->PrintBarcode(6.2,0.25+$dy,trim(str_replace("-","",$data['StrRegNo'])),0.25,0.013);    

            //--------------------------- Form No & Rno
            $pdf->SetXY(6,$y+$dy+0.1);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Form No: _______________",0,'L');

            $pdf->SetXY(6.7,$y+$dy+0.08);
            $pdf->SetFont('Arial','IB',12);
            $pdf->Cell( 0.5,0.5,$data['FormNo'],0,'L');

            //--------------------------- Registration Number  
            $pdf->SetXY(1.5,$y+0.1+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Registration No: ________________",0,'L');

            $pdf->SetFont('Arial','IB',12);
            $pdf->SetXY(2.6,$y+0.08+$dy);
            $pdf->Cell(0.5,0.5, $data['strRegNo'],0,'L');    
            //$pdf->Cell(0.5,0.5, $data['StrRegNo'],0,'L');    

            $pdf->Image(BARCODE_PATH.$image,4.1,$y+0.23+$dy, 1.8, 0.20, "PNG"); 


            //--------------------------- Institution Code and Name  
            $pdf->SetXY(0.2,$y+0.3+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Institution Code & Name:",0,'L');

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(1.78,$y+0.48+$dy);
            $pdf->MultiCell(6.0,0.13,$data["coll_cd"]."-". $user['inst_Name']."",0,'L',0);
            //$pdf->Cell(0.5,0.5, $data["Sch_cd"]."-". $user['inst_Name'],0,'L');    

            //------ Picture Box on Centre      .$data["Inst_Cd"].'/'. $data["PicPath"]
            $pdf->SetXY(6.5, $y+1+$dy);
            $pdf->Cell(1.25,1.4,'',1,0,'C',0);
            $pdf->Image( IMAGE_PATH11.$data["coll_cd"].'/'. $data["PicPath"],6.5, 1+ $y+$dy, 1.25, 1.4, "JPG");
            $pdf->SetFont('Arial','',10);

            //------------- Personal Infor Box    
            $x = 0.55;
            $y += 0.65;
            //--------------------------- 1st line 
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell( 0.5,0.5,"Name:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$y+$dy);
            $pdf->Cell(0.5,0.5,$data["name"],0,'L');
            //--------------------------- FATHER NAME 
            $pdf->SetXY(3.5+$x,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Father Name:.",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$y+$dy);
            $pdf->Cell(0.5,0.5,$data["Fname"],0,'L');

            $y += 0.2;
            //--------------------------- 3rd line 
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Bay Form No:",0,'L');// $pdf->Cell(0.5,0.5,"Date Of Birth:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$y+$dy);
            $pdf->Cell(0.5,0.5,$data["BForm"],0,'L'); // $pdf->Cell(0.5,0.5,$data["Dob"],0,'L');     
            //    $pdf->Cell(0.5,0.5,$data["Rel"]==1?"Muslim":"Non-Muslim",0,'L');

            $pdf->SetXY(3.5+$x,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Gender:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$y+$dy);
            $pdf->Cell(0.5,0.5,$data["sex"]==1?"MALE":"FEMALE",0,'L');            

            //--------------------------- 4th line 
            //// DebugBreak();();
            $y += 0.2;
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Father's CNIC:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$y+$dy);
            $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');     
            //    $pdf->Cell(0.5,0.5,$data["Rel"]==1?"Muslim":"Non-Muslim",0,'L');

            /* $pdf->SetXY(3.5+$x,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Father's CNIC:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$y+$dy);
            $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');   */  
            //========================================  Identification Mark
            $y += 0.2;
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Identification Mark:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.7,$y+$dy);
            $pdf->Cell(0.5,0.5, $data['markOfIden'],0,'L');

            //========================================  Exam Info 
            $y += 0.2;
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Group:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.7,$y+$dy);
            $grp_name = $data["RegGrp"];
            switch ($grp_name) {
                case '1':
                    $grp_name = 'Pre-Medical';
                    break;
                case '2':
                    $grp_name = 'Pre-Engineering';
                    break;
                case '3':
                    $grp_name = 'Humanities';
                    break;
                case '4':
                    $grp_name = 'General Science';
                    break;
                case '5':
                    $grp_name = 'Commerce';
                    break;
                case '7':
                    $grp_name = 'Home Economics';
                    break;
                default:
                    $grp_name = "No Group Selected.";
            }
            $pdf->Cell(0.5,0.5, $grp_name,0,'L');

            $y += 0.2;
            $x = 1;                 
            //--------------------------- Subjects
            //  $y += 0.2;
            $pdf->SetFont('Arial','',10);
            //------------- sub 1 & 5
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell(0.5,0.5, '1. '.($data['sub1_NAME']),0,'L');
            $pdf->SetXY(3+$x,$y+$dy);
            $pdf->Cell(0.5,0.5, '5. '.($data['sub5_NAME']),0,'L');
            //------------- sub 2 & 6
            $pdf->SetXY(0.5,0.2+$y+$dy);
            $pdf->Cell(0.5,0.5, '2. '.($data['sub2_NAME']),0,'L');
            $pdf->SetXY(3+$x,0.2+$y+$dy);
            $pdf->Cell(0.5,0.5, '6. '.($data['sub6_NAME']),0,'R');
            //------------- sub 3 & 7
            $pdf->SetXY(0.5,0.4+$y+$dy);
            $pdf->Cell(0.5,0.5,  '3. '.($data['sub3_NAME']),0,'L');
            $pdf->SetXY(3+$x,0.4+$y+$dy);
            if(isset($data['sub7_NAME']))
            {
                $pdf->Cell(0.5,0.5, '7. '.($data['sub7_NAME']),0,'R');
            }
            else{
                $pdf->Cell(0.5,0.5, ' ',0,'R');
            }


            //------------- sub 4 & 8
            $pdf->SetXY(0.5,0.6+$y+$dy);
            $pdf->Cell(0.5,0.5, '4. '.($data['sub4_NAME']),0,'L');
            //$pdf->SetXY(3+$x,0.6+$y+$dy);
            //$pdf->Cell(0.5,0.5, '8. '.($data['sub8_NAME']),0,'L');
            $y += 0.95;
            //------------- Signature
            $pdf->SetXY(0.2,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Head of the Institution: ___________________',0,'L');
            $pdf->SetXY(5.8,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Secretary: _________________',0,'L');    
            $pdf->Image('assets/img/sec_sign.png',6.5,$y+$dy-.2, .96, .6, "png");
            if ($turn>1){
                $y += 0.5;
                $pdf->Image(base_url()."assets/img/cut_line.png",0.3,$y+$dy, 7.5,0.15, "PNG");
            }
            if ($inc >4)
            {
                //  break;
            }

        }    

        if ($generatingpdf==true)
        {
            $pdf->Output('Registration Cards.pdf','I');
        } else {
            $containsError=true;
            $errorMessage = "<br />Your Institute does not have any student registration card(s) in accordance your selected group or form no. range.";
        }

    }
    public function Profile()
    {

        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        $isgovt = $userinfo['isgovt'];
        $emis = $userinfo['emis'];
        $email = $userinfo['email'];
        $phone = $userinfo['phone'];
        $cell = $userinfo['cell'];
        $dist = $userinfo['dist'];
        $teh = $userinfo['teh'];
        $zone = $userinfo['zone'];
        $isInserted = $userinfo['isInserted'];
        $this->load->model('Registration_11th_model');
        if($isInserted == 1)
        {
            $newinfo = $this->Registration_11th_model->Profile_info($Inst_Id);  
            $emis = $newinfo[0]['emis_code']; 
            $email =  $newinfo[0]['email']; 
            $phone = $newinfo[0]['LandLine'];
            $cell =  $newinfo[0]['MobNo']; 
        }
        if($this->session->flashdata('msg'))
        {

            $msg = $this->session->flashdata('msg');    
        }
        else
        {
            $msg = '';
        }

        $info = array('isgovt'=>$isgovt,'emis'=>$emis,'email'=>$email,'phone'=>$phone, 'cell'=>$cell,'isInserted'=>$isInserted,'msg'=>$msg)  ;
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$userinfo);

        $this->load->view('Registration/11th/Profile.php',$info);
        $this->load->view('common/common_reg/footer11threg.php');


    }
    public function Make_Batch_Group_wise()
    {
        $RegGrp = $this->uri->segment(3);
        $Spl_case = $this->uri->segment(4);
        // // DebugBreak();();
        $this->load->model('Registration_11th_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        $page_name  = "Create Batch";
        $Spl_case = $this->uri->segment(4);
        if($Spl_case != false)
        {
            $RegGrp = FALSE;
        }
        if($RegGrp != FALSE || ($Spl_case !=false && $RegGrp == FALSE))
        {
            $Spl_case = $this->uri->segment(4);
            $User_info_data = array('Inst_Id'=>$Inst_Id,'RegGrp'=>$RegGrp,'spl_case'=>$Spl_case);
            $user_info  =  $this->Registration_11th_model->user_info($User_info_data); 
        }
        else
        {
            if(!empty($_POST["chk"]))
            {

                $forms_id =   "'".implode("','",$_POST["chk"])."'";    
            }
            else{
                return;
            }
            $User_info_data = array('Inst_Id'=>$Inst_Id,'forms_id'=>$forms_id);
            $user_info  =  $this->Registration_11th_model->user_info_Formwise($User_info_data); //$db->first("SELECT * 
        }

        /* $User_info_data = array('Inst_Id'=>$Inst_Id,'RegGrp'=>$RegGrp,'spl_case'=>$Spl_case);
        $user_info  =  $this->Registration_11th_model->user_info($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);   */
        if($user_info == false)
        {
            $this->session->set_flashdata('error', '3');
            redirect('Registration_11th/CreateBatch');
            return;
        }
        $is_gov            =  $user_info['info'][0]['IsGovernment'];  //getValue("IsGovernment", " Admission_online..tblinstitutes_all", "Inst_cd =".$user->inst_cd);
        /*====================  Counting Fee  ==============================*/
        $processing_fee = 100;
        $reg_fee           = 1000;
        $reLreg_fee          = 1000;
        $TotalRegFee = 0;
        $TotalLatefee = 0;
        $Totalprocessing_fee = 0;
        $netTotal = 0;
        /*====================  Counting Fee  ==============================*/    
        //// DebugBreak();();
        $rule_fee = $user_info['rule_fee'];
        $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date']));
        if($user_info['info'][0]['affiliation_date'] != null && date('Y-m-d',strtotime($user_info['info'][0]['feedingDate']))>$lastdate)
        {
            $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
            if(date('Y-m-d')<=$lastdate)
            {
                $rule_fee  =  $this->Registration_11th_model->getreulefee(1); 
            }
            else
            {
                $rule_fee  =  $this->Registration_11th_model->getreulefee(2); 
            }
        }
        else 
        {
            $rule_fee  =  $this->Registration_11th_model->getreulefee(1); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;


        }
        if($is_gov == 1)
        {
            $reg_fee = $rule_fee[0]['Reg_Fee'];
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
        }
        else
        {
            $reg_fee = $rule_fee[0]['Reg_Fee'];
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

        }
        //// DebugBreak();();
        $q1 = $user_info['fee'];
        $total_std = 0;
        $total_record=0;
        $AllUser = array();
        foreach($q1 as $k=>$v) 
        {
            $ids[] = $v["FormNo"];
            $total_std++;
            if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
            {
                if($v["Spec"] > 0)
                {
                    $reg_fee = 0;//$rule_fee[0]['Reg_Fee'];
                    if($v['IsReAdm']==1)
                    {
                        $TotalLatefee = $TotalLatefee + $reLreg_fee;
                    }
                    else
                    {        $Lreg_fee = $rule_fee[0]['Fine'];
                        $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    }
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                }
                else 
                {
                    if($is_gov == 1)
                    {
                        $reg_fee = $rule_fee[0]['Reg_Fee'];
                        $Lreg_fee = $rule_fee[0]['Fine'];
                        $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
                    }
                    else
                    {
                        $reg_fee = $rule_fee[0]['Reg_Fee'];
                        $Lreg_fee = $rule_fee[0]['Fine'];
                        $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

                    }


                    $TotalRegFee = $TotalRegFee + $reg_fee;
                    if($v['IsReAdm']==1)
                    {    
                        $TotalLatefee = $TotalLatefee + $reLreg_fee;
                    }
                    else
                    {
                        if($v["yearOfPass"] == Year && $v["sessOfPass"] ==2)
                        {
                            if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
                            {
                                $Lreg_fee = $rule_fee[0]['Fine'];
                            }
                            else
                            {
                                $Lreg_fee = $rule_fee[0]['Fine'];
                            }

                        }
                        else

                            $TotalLatefee = $TotalLatefee + $Lreg_fee; 
                    }
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                } 
            } 
            else
            {
                $reg_fee = $rule_fee[0]['Reg_Fee'];
                $TotalRegFee = $TotalRegFee + $reg_fee;
                if($v['IsReAdm']==1)     
                {     
                    $TotalLatefee = $TotalLatefee + $reLreg_fee;
                }
                else
                {
                    if($v["yearOfPass"] == Year && $v["sessOfPass"] ==2)
                    {
                        if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
                        {
                            $Lreg_fee = $rule_fee[0]['Fine']; 
                        }
                        else
                        {
                            $Lreg_fee = $rule_fee[0]['Fine'];  
                        }
                    }


                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                }
                $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
            } // end of Else
            if(date('Y-m-d')<=$lastdate)
            {
                $Lreg_fee = 0;
                $TotalLatefee=0;
                $reLreg_fee=0;
            }
            $netTotal = (int)$netTotal +$reg_fee + $Lreg_fee+$processing_fee;
            $netTotal = (int)$netTotal +$reg_fee + $Lreg_fee+$processing_fee;
            $AllUser[$total_record]['regFee'] = $reg_fee;
            $AllUser[$total_record]['RegFineFee'] = $Lreg_fee;
            $AllUser[$total_record]['RegProcessFee'] = $processing_fee;
            $AllUser[$total_record]['RegTotalFee'] = $reg_fee+$Lreg_fee+$processing_fee;
            //// DebugBreak();();
            $AllUser[$total_record]['formNo'] = $v["FormNo"];
            $total_record++;
            /* if($total_std > 360)
            {
            break;
            }        */

        }


        $forms_id   = implode(",",$ids);        
        $tot_fee     = $Totalprocessing_fee+$TotalRegFee+$TotalLatefee;
        // $challan_No = 0;
        $today = date("Y-m-d H:i:s");
        $data = array('inst_cd'=>$Inst_Id,'total_fee'=>$tot_fee,'proces_fee'=>$processing_fee,'reg_fee'=>$reg_fee,'fine'=>$Lreg_fee,'refine'=>$reLreg_fee,'TotalRegFee'=>$TotalRegFee,'TotalLatefee'=>$TotalLatefee,'Totalprocessing_fee'=>$Totalprocessing_fee,'forms_id'=>$forms_id,'todaydate'=>$today,'total_std'=>$total_std);
        $this->Registration_11th_model->Batch_Insertion($data,$AllUser); 
        redirect('Registration_11th/BatchList');
        return;

    }
    public function Make_Batch_Formwise()
    {
        //  // DebugBreak();();
        if(!empty($_POST["chk"]))
        {

            $forms_id =   "'".implode("','",$_POST["chk"])."'";    
        }
        else{
            return;
        }

        $RegGrp = $this->uri->segment(3);
        $this->load->model('Registration_11th_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        $page_name  = "Create Batch";

        $User_info_data = array('Inst_Id'=>$Inst_Id,'forms_id'=>$forms_id);
        $user_info  =  $this->Registration_11th_model->user_info_Formwise($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);
        $is_gov            =  $user_info['info'][0]['IsGovernment'];  //getValue("IsGovernment", " Admission_online..tblinstitutes_all", "Inst_cd =".$user->inst_cd);
        /*====================  Counting Fee  ==============================*/
        $processing_fee = 0;
        $reg_fee           = 1000;
        $reLreg_fee          = 1000;
        $TotalRegFee = 0;
        $TotalLatefee = 0;
        $Totalprocessing_fee = 0;
        $netTotal = 0;
        /*====================  Counting Fee  ==============================*/    
        //// DebugBreak();();

        /*if($userinfo['isSpecial']==1  )
        {
        if($userinfo['isSpecial_Fee'][''])
        $reg_fee = $rule_fee[0]['Reg_Fee'];
        $Lreg_fee = $rule_fee[0]['Fine'];
        $processing_fee = $rule_fee[0]['Reg_Processing_Fee']; 
        }
        else
        {*/
        $rule_fee = $user_info['rule_fee'];
        if($user_info['info'][0]['affiliation_date'] != null)
        {
            $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
            if(date('Y-m-d')<=$lastdate)
            {
                $rule_fee  =  $this->Registration_11th_model->getreulefee(1); 
            }
            else
            {
                $rule_fee  =  $this->Registration_11th_model->getreulefee(2); 
            }
        }
        else 
        {
            $rule_fee  =  $this->Registration_11th_model->getreulefee(1); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;


        }
        if($is_gov == 1)
        {
            $reg_fee = $rule_fee[0]['Reg_Fee'];
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
        }
        else
        {
            $reg_fee = $rule_fee[0]['Reg_Fee'];
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

        }  
        // }
        // if($)

        // // DebugBreak();();
        $q1 = $user_info['fee'];
        $total_std = 0;
        foreach($q1 as $k=>$v) 
        {
            $ids[] = $v["FormNo"];
            $total_std++;
            if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
            {
                if($v["Spec"] == 1 || $v["Spec"] ==  2)
                {
                    $TotalRegFee = $TotalRegFee + $reg_fee;
                    $reg_fee = $rule_fee[0]['Reg_Fee'];;
                    if($v['IsReAdm']==1)
                    {
                        $TotalLatefee = $TotalLatefee + $reLreg_fee;
                    }
                    else
                    {         $Lreg_fee = $rule_fee[0]['Fine'];
                        $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    }
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                }
                else 
                {
                    $TotalRegFee = $TotalRegFee + $reg_fee;
                    if($v['IsReAdm']==1)
                    {    
                        $TotalLatefee = $TotalLatefee + $reLreg_fee;
                    }
                    else
                    {     
                        if($v["yearOfPass"] == Year && $v["sessOfPass"] ==2)
                        {
                            if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
                            {
                                $Lreg_fee = 3000; 
                            }
                            else
                            {
                                $Lreg_fee = 3000;  
                            }
                        }
                        else
                        {

                            $Lreg_fee = $rule_fee[0]['Fine'];
                        }

                        $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    }
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                } 
            } 
            else
            {
                $reg_fee = $rule_fee[0]['Reg_Fee'];
                $TotalRegFee = $TotalRegFee + $reg_fee;
                if($v['IsReAdm']==1)
                {   
                    $TotalLatefee = $TotalLatefee + $reLreg_fee;
                }
                else
                {     
                    if($v["yearOfPass"] == Year && $v["sessOfPass"] ==2)
                    {
                        if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
                        {
                            $Lreg_fee = 3000; 
                        }
                        else
                        {
                            $Lreg_fee = 3000;  
                        }
                    }
                    else
                    {   
                        $Lreg_fee = $rule_fee[0]['Fine'];
                    }


                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                }
                $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
            } // end of Else

            if(date('Y-m-d')<=$lastdate)
            {
                $Lreg_fee = 0;
                $TotalLatefee=0;
                $reLreg_fee=0;
            }
            $netTotal = (int)$netTotal +$reg_fee + $Lreg_fee+$processing_fee;
            if($total_std > 360)
            {
                break;
            }

        }

        $forms_id   = implode(",",$ids); 
        /* if(date('Y-m-d')<=$lastdate)
        {
        $Lreg_fee = 0;
        $TotalLatefee=0;
        $reLreg_fee=0;
        }  */

        $tot_fee     = $Totalprocessing_fee+$TotalRegFee+$TotalLatefee;
        // $challan_No = 0;
        $today = date("Y-m-d H:i:s");
        $data = array('inst_cd'=>$Inst_Id,'total_fee'=>$tot_fee,'proces_fee'=>$processing_fee,'reg_fee'=>$reg_fee,'fine'=>$Lreg_fee,'refine'=>$reLreg_fee,'TotalRegFee'=>$TotalRegFee,'TotalLatefee'=>$TotalLatefee,'Totalprocessing_fee'=>$Totalprocessing_fee,'forms_id'=>$forms_id,'todaydate'=>$today,'total_std'=>$total_std);
        $this->Registration_11th_model->Batch_Insertion($data); 
        redirect('Registration_11th/BatchList');
        return;
    }
    public function return_pdf()
    {

         //DebugBreak();

        $Condition = $this->uri->segment(4);
        /*
        $Condition  1 == Batch Id wise printing.
        2 == Final Group wise prining.
        3 == Final Formno wise Printing.
        4 == Proof reading Group wise Printing.
        5 == Proof reading Formno wise Printing.
        */
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_11th_model');
        if($Condition == "1")
        {
            $Batch_Id = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Registration_11th_model->return_pdf($fetch_data),'inst_Name'=>$user['inst_Name']);    
        }
        else if($Condition == "2")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>0);
            $result = array('data'=>$this->Registration_11th_model->Print_Form_Groupwise($fetch_data));

        }

        else if($Condition == "3")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);


            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>0);
            $result = array('data'=>$this->Registration_11th_model->Print_Form_Formnowise($fetch_data));
        }
        else if($Condition == "4")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_11th_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }
        else if($Condition == "5")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_11th_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }

        // // DebugBreak();();
        if(empty($result['data'])){
            $this->session->set_flashdata('error', $Condition);
            redirect('Registration_11th/FormPrinting');
            return;

        }
        $temp = $user['Inst_Id'].'@11@'.sessReg;
        $image =  $this->set_barcode($temp);
        // $pdf->Image(base_url().'assets/pdfs/'.'/'.$image,6.3,0.5, 1.8, 0.20, "PNG");
        //$studeninfo['data']['info'][0]['barcode'] = $image;
        $this->load->library('PDF_Rotate');


        $pdf = new PDF_Rotate('P','in',"A4");
        $pdf->Rotate(0,-1,-1);
        //   $pdf->SetFont('Arial','B',50);
        //             $pdf->SetTextColor(255,192,203);
        //             $pdf->Rotate(35,190,'W a t e r m a r k   d e m o',45);
        $pdf->AliasNbPages();
        if($Condition==4 or $Condition == 5)
        {
            $pdf->SetTitle('Proof Print of Return');   
        }
        else
        {
            $pdf->SetTitle('Final Print of Return');
        }


        $pdf->SetMargins(0.5,0.5,0.5);
        $lmargin =0.5;
        $rmargin =7.5;
        $topMargin = 0.5;
        $countofrecords=14;
        $title=1.0;
        $cnt=0; $ln[0]=1.5;
        $SR=1;
        while($cnt<15) 
        {
            $cnt++;
            $ln[$cnt]=$ln[$cnt-1]+ 0.6;  //0.5;
        }

        $i = 4;
        $result = $result['data'] ;
        // // DebugBreak();();
        foreach ($result as $key=>$data) 
        {
//            DebugBreak();
            //// DebugBreak();();
            $i++;
            $countofrecords=$countofrecords+1;
            if($countofrecords==15) {
                $countofrecords=0;

                $pdf->AddPage();

                //     $pdf->SetFont('Arial','B',50);
                //                 $pdf->SetTextColor(255,192,203);
                //                 $pdf->Rotate(35,190,'W a t e r m a r k   d e m o',45);


                if($Condition==4 or $Condition == 5)
                {
                    $pdf->Image( base_url().'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG");     
                }

                $pdf->SetFont('Arial','U',14);
                $pdf->SetXY( 0.4,0.2);
                $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(1.7,0.4);
                $pdf->Cell(0, 0.25, "INTER PART-I ENROLMENT RETURN SESSION (".sessReg.")", 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(2.6,0.4);
                $pdf->Image(BARCODE_PATH.$image,6.3,0.43, 1.8, 0.20, "PNG"); 
                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(0.4,0.7);
                $pdf->MultiCell(7.65,0.15, $user['Inst_Id']. "-". $user['inst_Name'],0,'L');
                //$pdf->Cell(0, 0.25,, 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(6.9,0.8);
                $pdf->Cell(0, 0.25,  'Gender: '. ($data['sex']==1?"MALE":"FEMALE" ), 0.25, "C");
                //$grp_name = $data["RegGrp"];
               
                /*$pdf->SetFont('Arial','',10);
                $pdf->SetXY(2.5,0.8);
                $pdf->Cell(0, 0.25,  'Group: '.$grp_name, 0.25, "C"); */


                $pdf->rect($lmargin,1,$rmargin,10.5);                //the main rectangle box
                $cnt=-1;

                while($cnt<15) 
                { 
                    $cnt++;
                    $pdf->Line($lmargin, $ln[$cnt],$rmargin+.5,$ln[$cnt]);    
                }


                $col1=$lmargin+.3;    
                $col2=$col1+0.9;    
                $col3=$col2+1.8;
                $col4=$col3+1.1;    
                $col5=$col4+1.6;    
                $col6=$col5+1.2;

                $pdf->Line($col1,$title,$col1,$ln[15]);
                $pdf->Line($col2,$title,$col2,$ln[15]);
                $pdf->Line($col3,$title,$col3,$ln[15]);
                $pdf->Line($col4,$title,$col4,$ln[15]);
                $pdf->Line($col5,$title,$col5,$ln[15]);
                $pdf->Line($col6,$title,$col6,$ln[15]);
                 
                $pdf->SetFont('Arial','B',9);
                $pdf->Text($lmargin+.03,$title+.3,"Sr#");    //$pdf->Text(3,3,"TEXT TO DISPLAY");
                $pdf->Text($col1+.2,$title+.3,"Form No.");



                $pdf->Text($col2+.1,$title+.2,"Student Name  /");
                $pdf->Text($col2+.1,$title+.4,"Bay-Form");

                $pdf->Text($col3+.1,$title+.2,"Father Name /"); 
                $pdf->Text($col3+.1,$title+.4,"Father CNIC");

                // $pdf->Text($col4+.1,$title+.2,"Date Of Birth");
                $pdf->Text($col4+.1,$title+.2,"Matric Rno / Sess / Year");
                $pdf->Text($col4+.1,$title+.4," / Board");

                if(return_pdf_isPicture==1)
                {
                    $pdf->Text($col5+.1,$title+.3,"Elective Subjects");


                    $pdf->Text($col6+.1,$title+.3,"Image");    
                }
                else if(return_pdf_isPicture==2)
                {
                    $pdf->Text($col5+.1,$title+.3,"Elective Subjects");
                    //$pdf->Text($col6+.1,$title+.3,"Picture");
                }


            }
            switch ($data["RegGrp"]) {
                    case '1':
                        $grp_name = 'Pre-Medical';
                        break;
                    case '2':
                        $grp_name = 'Pre-Engineering';
                        break;
                    case '3':
                        $grp_name = 'Humanities';
                        break;
                    case '4':
                        $grp_name = 'General Science';
                        break;
                    case '5':
                        $grp_name = 'Commerce';
                        break;
                    case '7':
                        $grp_name = 'Home Economics';
                        break;
                    default:
                        $grp_name = "No Group Selected.";
                }
            //$dob = date("d-m-Y", strtotime($data["Dob"]));
            $adm = date("d-m-Y", strtotime($data["edate"]));

            //============================ Values ==========================================            
            $pdf->SetFont('Arial','',10);    
            $pdf->Text($lmargin+.1  , $ln[$countofrecords]+0.3 , $SR);                 // Sr No
            $pdf->Text($col1+.05    , $ln[$countofrecords]+0.3,$data["FormNo"]);       // Form No

            $pdf->SetXY($col2+.1,$ln[$countofrecords]+0.05);
            $pdf->SetFont('Arial','B',8);    
            $pdf->MultiCell(1.5,0.12,strtoupper($data["name"]));
            $pdf->SetFont('Arial','',8);                
            // // DebugBreak();();

            //$pdf->Text($col2+.1,$ln[$countofrecords]+0.4,strtoupper($data["Dob"]));
            $pdf->SetFont('Arial','',7.5);                
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.55,$data["BForm"]);
            $pdf->SetFont('Arial','',8);

            $pdf->SetXY($col3+.08,$ln[$countofrecords]+0.05);
            $pdf->SetFont('Arial','B',8);
            $pdf->MultiCell(0.9,0.12,strtoupper($data["Fname"]), 0);
            $pdf->SetFont('Arial','',8);
            // $pdf->Text($col3+.1,$ln[$countofrecords]+0.2,$data["Fname"]);
            $pdf->Text($col3+.1,$ln[$countofrecords]+0.5,$data["FNIC"]);

            // $pdf->Text($col4+.1,$ln[$countofrecords]+0.2,$dob);
            // $pdf->Text($col4+.1,$ln[$countofrecords]+0.4,$data["rel"]==1?"Muslim":"Non-Muslim");

            // if($data["IsReAdm"] == '1' )
            $pdf->Text($col4+.1,$ln[$countofrecords]+0.2,strtoupper($data["matRno"]).'-'.$data["SessOfPassed"].'-'.$data["yearOfPass"].'-');
            $pdf->Text($col4+.1,$ln[$countofrecords]+0.4,$data["Board_name"]);
            // else
            //   $pdf->Text($col4+.1,$ln[$countofrecords]+0.55,'(NEW)');

            $pdf->SetFont('Arial','B',7);    
            //            $pdf->Text($col5+.05,$ln[$countofrecords]+0.2,GroupName($data["Grp_Cd"]));
            if(return_pdf_isPicture == 1)
            {
                $pdf->Text($col5+.05,$ln[$countofrecords]+0.15,  $grp_name);
                $pdf->Text($col5+.05,$ln[$countofrecords]+0.35,  $data["sub1_abr"].','.$data["sub2_abr"].','.$data["sub3_abr"]);
                $pdf->SetFont('Arial','',7);    
                $pdf->Text($col5+.05,$ln[$countofrecords]+0.55,$data["sub4_abr"].','.$data["sub5_abr"].','.$data["sub6_abr"].','.$data["sub7_abr"]); //.','.$data["sub8_abr"]

                //$pdf->Image(IMAGE_PATH11.$data["coll_cd"].'/'.$data["PicPath"],$col6+0.05,$ln[$countofrecords]+0.05 , 0.50, 0.50, "JPG");    
                $pdf->Image(base_url().IMAGE_PATH11.$data["coll_cd"].'/'.$data["PicPath"],$col6+0.05,$ln[$countofrecords]+0.05 , 0.50, 0.50, "JPG");    
            }
            else
            {
                $pdf->Text($col5+.05,$ln[$countofrecords]+0.15,  $grp_name);
                $pdf->Text($col5+.05,$ln[$countofrecords]+0.35,  $data["sub1_abr"].','.$data["sub2_abr"].','.$data["sub3_abr"]);
                $pdf->SetFont('Arial','',7);    
                $pdf->Text($col5+.05,$ln[$countofrecords]+0.55,$data["sub4_abr"].','.$data["sub5_abr"].','.$data["sub6_abr"].','.$data["sub7_abr"]); //.','.$data["sub8_abr"]
                 $pdf->Image(base_url().IMAGE_PATH11.$data["coll_cd"].'/'.$data["PicPath"],$col6+0.05,$ln[$countofrecords]+0.05 , 0.50, 0.50, "JPG"); 
                //$pdf->Image(base_url().IMAGE_PATH11.$data["coll_cd"].'/'.$data["PicPath"],$col6+0.05,$ln[$countofrecords]+0.05 , 0.50, 0.50, "JPG");
                //$pdf->Image(IMAGE_PATH11.$data["Sch_cd"].'/'.$data["PicPath"],$col6+0.05,$ln[$countofrecords]+0.05 , 0.50, 0.50, "JPG");    
            }


            ++$SR;

            //// DebugBreak();();
            //Certified that I have checked all the relevant record of the students and the particulars as mentioned above are correct.
            $pdf->SetFont('Arial','',8);
            $pdf->Text($lmargin+.5,10.8,"Certified that I have checked all the relevant record of the students and the particulars as mentioned above are correct.");
            //$pdf->Text($lmargin+.5,11,"Signature _____________________");
            $pdf->SetFont('Arial','',10);
            $pdf->Text($rmargin-2.5,11.2,"_____________________________________");
            $pdf->Text($rmargin-2.5,11.4,"Signature of Head of Institution with Stamp");
            $pdf->Text($lmargin+0.5,11.4,'Print Date: '. date('d-m-Y H:i:s a'));    

        }
        //  // DebugBreak();();
        $pdf->Output($data["coll_cd"].'.pdf', 'I'); //$data["Sch_cd"].'.pdf', 'I'
    }
    public function revenue_pdf()
    {
        // // DebugBreak();();
        $Batch_Id = $this->uri->segment(3);
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_11th_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
        $temp = $user['Inst_Id'].'@11@'.sessReg;
        $image =  $this->set_barcode($temp);
        //$data = array('data'=>$this->Registration_11th_model->revenue_pdf($fetch_data),'inst_Name'=>$user['inst_Name'],'inst_cd'=>$user['Inst_Id'],'barcode'=>$image);

        $User_info_data = array('Inst_Id'=>$user['Inst_Id'],'RegGrp'=>@$RegGrp,'spl_case'=>@$Spl_case);
        $user_info  =  $this->Registration_11th_model->getuser_info($User_info_data); 



        $isfine = 0;


        if($user['isSpecial']==1 && date('Y-m-d',strtotime($user['isSpecial_Fee']['FeedingDate']))>=date('Y-m-d')  )
        {
            $rule_fee[0]['Fine']   =  $user['isSpecial_Fee']['SpecialFee']; 
            $rule_fee[0]['Reg_Processing_Fee']   =  $user['isSpecial_Fee']['ProcessingFee']; 
            $rule_fee[0]['Reg_Fee']   =  $user['isSpecial_Fee']['RegFee']; 
            $rule_fee[0]['Rule_Fee_ID']   = 0; 
            $rule_fee[0]['isfine'] = 1; 
            $lastdate  = date('Y-m-d',strtotime($user['isSpecial_Fee']['FeedingDate'])) ;

            $data = array('data'=>$this->Registration_11th_model->revenue_pdf($fetch_data),'inst_Name'=>$user['inst_Name'],'inst_cd'=>$user['Inst_Id'],'barcode'=>$image,"rulefee"=>$rule_fee);
        }
        else

        {
            if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d'))
            {
                $rule_fee[0]['isfine'] = 0; 
            }
            else if($user_info['info'][0]['feedingDate'] != null)
            {
                $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
                if(date('Y-m-d')<=$lastdate)
                {

                    $rule_fee  =  $this->Registration_11th_model->getreulefee(1);
                    $rule_fee[0]['isfine'] = 0; 
                }
                else 
                {
                    $rule_fee   =  $this->Registration_11th_model->getreulefee(2);
                    $rule_fee[0]['isfine'] = 1;
                }
            }
            else   if(date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>date('Y-m-d'))
            {
                $isfine = 1;
                $rule_fee   =  $this->Registration_11th_model->getreulefee(2);
                $rule_fee[0]['isfine'] = 1; 
                $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
            }
            //  // DebugBreak();();
            /* if(ISREADMISSION == 1)
            {
            $rule_fee  =  $this->Registration_model->getreulefee(1);
            $rule_fee[0]['isfine'] = 1; 
            $isfine = 1;
            }   */

            $data = array('data'=>$this->Registration_11th_model->revenue_pdf($fetch_data),'inst_Name'=>$user['inst_Name'],'inst_cd'=>$user['Inst_Id'],'barcode'=>$image,"rulefee"=>$rule_fee);
            if($rule_fee[0]['isfine'] == 1)
            {
                //// DebugBreak();();
                $count = $data['data']['batch_info'][0]["COUNT"];
                $data['data']["Total_RegistrationFee"] =  $count*$rule_fee[0]['Reg_Fee'] ;
                $data['data']["Total_ProcessingFee"] =  $count*$rule_fee[0]['Reg_Processing_Fee'] ;
                $data['data']["Total_LateRegistrationFee"] =  $count*$rule_fee[0]['Fine'] ;
                $data['data']["Amount"] = $data['data']["Total_RegistrationFee"]+ $data['data']["Total_ProcessingFee"]+$data['data']["Total_LateRegistrationFee"] ;

                array('myd'=>$this->Registration_11th_model->UpdateBatchFee($data));
            } 


        }


        $this->load->view('Registration/11th/RevenueForm.php',$data);
    }
    public function BatchRelease()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        //// DebugBreak();();
        $data = array(
            'isselected' => '6',
        );
        $Batch_ID = $this->uri->segment(3);
        $this->load->view('common/header.php',$userinfo);
        $this->commonheader($data);
        if(!( $this->session->flashdata('BatchList_error'))){

            $error['batchId']= $Batch_ID;    
        }
        else{
            $error = $this->session->flashdata('BatchList_error');
        }
        // echo $error['batchId'];
        // $myinfo = array('error'=>$error_msg_readmission);
        $this->load->view('Registration/11th/BatchRelease.php',$error);//,$myinfo);
        $this->load->view('common/common_reg/footer11threg.php');
    }
    public function Batchlist_INSERT()
    {
        $this->load->model('Registration_11th_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $data = array(
            'isselected' => '6',
        );
        $userinfo['isselected'] = 6;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $batchId = @$_POST['batch_real_Id'];
        $reason = @$_POST['batch_real_reason'];
        $branch = @$_POST['batch_real_bankbranch'];
        $challan = @$_POST['batch_real_challanno'];
        $amount = @$_POST['batch_real_PaidAmount'];
        $date = @$_POST['batch_real_PaidDate'];
        $allinputdata['batchId'] = $batchId;
        $allinputdata['reason'] = $reason;
        $allinputdata['branch'] = $branch;
        $allinputdata['challan'] = $challan;
        $allinputdata['amount'] = $amount;
        $allinputdata['date'] = $date;
        // // DebugBreak();();
        if($batchId == 0 || $batchId == ''){
            $allinputdata['BatchRelease_excep'] = 'Please Select Batch From Batch List Section';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration_11th/BatchRelease');
            return;
        }
        else if($reason == ''){
            $allinputdata['BatchRelease_excep'] = 'Please Give Reason';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration_11th/BatchRelease');
            return;
        }
        else if($branch =='' ){
            $allinputdata['BatchRelease_excep'] = 'Please Select Bank Branch';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration_11th/BatchRelease');
            return;
        }
        else if ($challan == '' || $challan == 0){
            $allinputdata['BatchRelease_excep'] = 'Please Give Challan No.';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration_11th/BatchRelease');
            return;
        }
        else if ($amount == '' || $amount == 0){
            $allinputdata['BatchRelease_excep'] = 'Please Give Amount';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration_11th/BatchRelease');
            return;
        }
        else if($date == '' || $date == 0){
            $allinputdata['BatchRelease_excep'] = 'Please Select Paid Date';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration_11th/BatchRelease');
            return;
        }

        $allinputdata['Inst_Id'] = $Inst_Id;
        $user_info  =  $this->Registration_11th_model->ReleaseBatch_INSERT($allinputdata); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);
        if($user_info == true){
            $allinputdata['BatchRelease_excep'] = 'Applied Successfully.';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration_11th/BatchList');
            return;
        }
        else{
            $allinputdata['BatchRelease_excep'] = 'Not Applied Successfully! An Error occoured, Please Try Again Latter.';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration_11th/BatchRelease');
            return;
        }

    }
    public function Print_Registration_Form_Proofreading_Groupwise()
    {

        // // DebugBreak();();
        $Condition = $this->uri->segment(4);

        $this->load->library('session');

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_11th_model');

        if($Condition == "1")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_11th_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);
        }
        else if($Condition == "2")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_11th_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);
            //Print_Form_Formnowise
        }


        if(empty($result['data'])){
            $this->session->set_flashdata('error', $Condition);
            redirect('Registration_11th/FormPrinting');
            return;

        }


        $this->load->library('PDF_Rotate');


        $pdf = new PDF_Rotate('P','in',"A4");
        //      $this->load->library('PDFF');
        //        $pdf=new PDFF('P','in',"A4");  
        $pdf->AliasNbPages();
        $pdf->SetMargins(0.5,0.5,0.5);
        $grp_cd = $this->uri->segment(3);

        $pdf->SetTitle('Proof Print Registration From');

        $fontSize = 10;
        $marge    = .4;   // between barcode and hri in pixel
        $x        = 7.5;  // barcode center
        $y        = 1.2;  // barcode center
        $height   = 0.35;   // barcode height in 1D ; module size in 2D
        $width    = .013;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $type     = 'code128';
        $black    = '000000'; // color in hex
        // // DebugBreak();();
        $result = $result['data'] ;
        //if(!empty($result)):
        foreach ($result as $key=>$data) 
        {

            //First Page ---class instantiation    
            //$pdf = new FPDF_BARCODE("P","in","A4");
            $pdf->AddPage();
            $Y = 0.5;


            $pdf->SetFillColor(0,0,0);
            $pdf->SetDrawColor(0,0,0); 

            $temp = $data['FormNo'].'@11@'.Year.'@1';
            $image =  $this->set_barcode($temp);
            $pdf->Image(BARCODE_PATH.$image,6.0, 1.2  ,1.8,0.20,"PNG");
            $pdf->SetFont('Arial','U',16);
            $pdf->SetXY( 1.2,0.2);
            $pdf->Cell(0, 0.2, "Board Of Intermediate and Secondary Education,Gujranwala", 0.25, "C");
            $pdf->Image(base_url()."assets/img/logo2.png",0.05,0.2, 0.75,0.75, "png", "http://www.bisegrw.com");


            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(1.7,0.4);
            $pdf->Cell(0, 0.25, " REGISTRATION FORM FOR INTER PART-I SESSION ".sessReg , 0.25, "C");
            $pdf->Image(base_url(). 'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG");     
            //--------------- Proof Read
            $ProofReed = "(PROOF READ) (Not for Board) ";
            $pdf->SetXY(3,0.8);
            $pdf->SetFont("Arial",'',12);
            $pdf->Cell(0, 0.25, $ProofReed  ,0,'C');

            //--------------------------- Form No & Rno
            $pdf->SetXY(0.2,0.5+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Form No: _______________",0,'L');

            $pdf->SetXY(0.8,0.5+$Y);
            $pdf->SetFont('Arial','IB',12);
            $pdf->Cell( 0.5,0.5,$data['FormNo'],0,'L');

            //--------------------------- Institution Code and Name   $user['Inst_Id']. "-". $user['inst_Name']
            $pdf->SetXY(0.2,0.73+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Institution Code/Name:",0,'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.75,0.89+$Y);
            $pdf->MultiCell(6, .2, $user['Inst_Id']."-".$user['inst_Name'], 0);
            //$pdf->Cell(0.5,0.5,  $user['Inst_Id']. "-". $user['inst_Name'],0,'L');    

            //------ Picture Box on Centre      
            $pdf->SetXY(6.8, $Y +1.75);
            $pdf->Cell(1.25,1.4,'',1,0,'C',0);

            $pdf->Image(IMAGE_PATH11.$data["coll_cd"].'/'.$data["PicPath"],6.8, 1.75+ $Y, 1.25, 1.4, "JPG"); 
            $pdf->SetFont('Arial','',10);

            //------------- Personal Infor Box
            //====================================================================================================================

            $x = 0.55;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.2,1.28+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'PERSONAL INFORMATION',1,0,'L',1);
            $Y = 0.3;
            //--------------------------- 1st line 
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,1.65+$Y);
            $pdf->Cell( 0.5,0.5,"Name:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,1.65+$Y);
            $pdf->Cell(0.5,0.5,  strtoupper($data["name"]),0,'L');
            //--------------------------- FATHER NAME 
            $pdf->SetXY(3.5+$x,1.65+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Father Name:.",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,1.65+$Y);
            $pdf->Cell(0.5,0.5, strtoupper($data["Fname"]),0,'L');


            //--------------------------- 3rd line 
            /* $pdf->SetXY(0.5,$Y+ 2);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Date Of Birth:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,2+$Y);*/

            // $pdf->Cell(0.5,0.5,date('d-m-Y', strtotime($data['Dob'])),0,'L');     
            //    $pdf->Cell(0.5,0.5,$data["Rel"]==1?"Muslim":"Non-Muslim",0,'L');

            $pdf->SetXY(0.5,$Y+2.0);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Religion:",0,'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+2.0);
            $pdf->Cell(0.5,0.5,$data["rel"]==1?"Muslim":"Non-Muslim",0,'L');   

            $pdf->SetXY(3.5+$x,2+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Gender:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,2+$Y);
            $pdf->Cell(0.5,0.5,$data["sex"]==1?"MALE":"FEMALE",0,'L');            
            //--------------------------- BAY FORM NO line 
            $pdf->SetXY(0.5,$Y+2.35);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Bay Form No:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+2.35);
            $pdf->Cell(0.5,0.5,$data["BForm"],0,'L');


            $pdf->SetXY(3.5+$x,$Y+2.35);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Guardian CNIC:",0,'R');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+2.35);
            $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');
            //---------------------------  
            $spl_casename = 'NONE';
            if($data["Spec"] == 0)
            {
                $spl_casename = 'NONE';
            }
            else  if($data["Spec"] == 1)
            {
                $spl_casename = 'Deaf & Dumb';  
            }
            else  if($data["Spec"] == 2)
            {
                $spl_casename = 'Board Employee';
            }
            else  if($data["Spec"] == 3)
            {
                $spl_casename = 'Blind';
            }

            $pdf->SetXY(0.5,$Y+2.7);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Speciality:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+2.7);
            $pdf->Cell(0.5,0.5, ($spl_casename),0,'L');

            $pdf->SetXY(3.5+$x,$Y+2.7);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Nationality:",0,'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+2.7);
            $pdf->Cell(0.5,0.5,$data["nat"]==1?"PAKISTANI":"NON-PAKISTANI",0,'R');   

            //--------------------------- Gender Nationality 
            $pdf->SetXY(0.5,$Y+3.05);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Hafiz-e-Quran:",0,'L');
            //$pdf->Cell( 0.5,0.5,"Medium:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+3.05);
            $pdf->Cell(0.5,0.5,$data["Ishafiz"]==1?"No":"Yes",0,'L');            
            // $pdf->Cell(0.5,0.5,$data["med"]==1?"Urdu":"English",0,'L');            

            //====================================SSC INFO =======================================
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.2,3.48+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'SSC INFORMATION',1,0,'L',1);

            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,3.65+$Y);
            $pdf->Cell( 0.5,0.5,"Roll No:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,3.65+$Y);
            $pdf->Cell(0.5,0.5,  ($data["matRno"]),0,'L');
            //--------------------------- Year of Matric  
            $pdf->SetXY(3.5+$x,3.65+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Year:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,3.65+$Y);
            $pdf->Cell(0.5,0.5, ($data["yearOfPass"]),0,'L');

            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,3.95+$Y);
            $pdf->Cell( 0.5,0.5,"Session:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,3.95+$Y);
            $pdf->Cell(0.5,0.5,  ($data["SessOfPassed"]),0,'L');
            //--------------------------- Year of Matric  
            $pdf->SetXY(3.5+$x,3.95+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Board:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,3.95+$Y);
            $pdf->Cell(0.5,0.5, ($data["Board_name"]),0,'L');

            //===================================== Institute Information==================
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.2,4.38+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'INSTITUTE INFORMATION',1,0,'L',1);

            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,4.65+$Y);
            $pdf->Cell( 0.5,0.5,"Class Rno:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,4.65+$Y);
            $pdf->Cell(0.5,0.5,  ($data["classRno"]),0,'L');
            //--------------------------- Year of Matric  
            $pdf->SetXY(3.5+$x,4.65+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Medium:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,4.65+$Y);
            $pdf->Cell(0.5,0.5,$data["med"]==1?"Urdu":"English",0,'L'); 

            //===================================== CONTACT Information==================
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.2,5.08+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'CONTACT INFORMATION',1,0,'L',1);

            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,5.35+$Y);
            $pdf->Cell( 0.5,0.5,"Postal Address:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,5.35+$Y);
            $pdf->Cell(0.5,0.5,  ($data["addr"]),0,'L');
            //--------------------------- Year of Matric  
            $pdf->SetXY($x,5.65+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Mobile:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.0+$x,5.65+$Y);
            $pdf->Cell(0.5,0.5, $data["MobNo"],0,'L');
            // $pdf->Cell(0.5,0.5, ($data["yearOfPass"]),0,'L');
            /* $pdf->SetXY(3.5+$x,$Y+3.05);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Locality:",0,'R');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+3.05);
            $pdf->Cell(0.5,0.5,$data["ruralOrurban"]==1?"Urban":"Rural",0,'L');     */
            //--------------------------- id mark and Medium 
            /* $pdf->SetXY(0.5,$Y+3.40);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Ident Mark:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+3.40);
            $pdf->Cell(0.5,0.5,$data["markOfIden"],0,'L');*/

            /* $pdf->SetXY(3.5+$x,$Y+3.40);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Religion:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+3.40);
            $pdf->Cell(0.5,0.5,$data["rel"]==1?"Muslim":"Non-Muslim",0,'L');   */         
            //             $pdf->Cell(0.5,0.5, $data["MobNo"],0,'L');
            //----- Contact No.    
            /* $pdf->SetXY(0.5,$Y+3.75);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Mobile No:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+3.75);
            $pdf->Cell(0.5,0.5, $data["MobNo"],0,'L');


            $pdf->SetXY(0.5,$Y+4.1);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Address:",0,'L');
            $pdf->SetFont('Arial','b',10);
            $pdf->SetXY(1.5,$Y + 4.1);
            $pdf->Cell(0.5,0.5, strtoupper($data["addr"]),0,'L');*/
            //========================================  Exam Info ===============================================================================            
            $sY = 0.3;//0.5;
            $pdf->SetXY(0.2,6.1+$sY);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'SUBJECT INFORMATION',1,0,'L',1);

            //--------------------------- Subject Group
            $grp_name = $data["RegGrp"];
            switch ($grp_name) {
                case '1':
                    $grp_name = 'Pre-Medical';
                    break;
                case '2':
                    $grp_name = 'Pre-Engineering';
                    break;
                case '3':
                    $grp_name = 'Humanities';
                    break;
                case '4':
                    $grp_name = 'General Science';
                    break;
                case '5':
                    $grp_name = 'Commerce';
                    break;
                case '7':
                    $grp_name = 'Home Economics';
                    break;
                default:
                    $grp_name = "No Group Selected.";
            }
            $pdf->SetXY(0.5,6.45+$sY);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Subject Group:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,6.45+$sY);
            $pdf->Cell(0.5,0.5, ($grp_name),0,'L');

            $pdf->SetXY(3.5,6.45+$sY);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Admission/Re-Admission:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(5.5,6.45+$sY);
            $pdf->Cell(0.5,0.5, ($data['IsReAdm']==0?"FRESH REGISTRATION":"RE-ADMISSION"),0,'L');

            $y = $sY - 0.3;
            $x = 1;
            //--------------------------- Subjects
            $pdf->SetFont('Arial','',10);
            //// DebugBreak();();
            //------------- sub 1 & 5
            $pdf->SetXY(0.5,7.05+$y);
            $pdf->Cell(0.5,0.5, '1. '.($data['sub1_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.05+$y);
            $pdf->Cell(0.5,0.5, '5. '.($data['sub5_NAME']),0,'L');
            //------------- sub 2 & 6
            $pdf->SetXY(0.5,7.35+$y);
            $pdf->Cell(0.5,0.5, '2. '.($data['sub2_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.35+$y);
            $pdf->Cell(0.5,0.5, '6. '.($data['sub6_NAME']),0,'R');
            //------------- sub 3 & 7
            $pdf->SetXY(0.5,7.70+$y);
            $pdf->Cell(0.5,0.5,  '3. '.($data['sub3_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.70+$y);
            $pdf->Cell(0.5,0.5, '7. '.($data['sub7_NAME']),0,'R');
            //------------- sub 4 & 8
            $pdf->SetXY(0.5,8.05+$y);
            $pdf->Cell(0.5,0.5, '4. '.($data['sub4_NAME']),0,'L');
            /* $pdf->SetXY(3+$x,8.05+$y);
            $pdf->Cell(0.5,0.5, '8. '.($data['sub8_NAME']),0,'L');*/


            $pdf->SetFont('Arial','UI',10);  
            $pdf->SetXY(5.6,  8.9+$y);
            $date = strtotime($data['edate']); 
            $pdf->Cell(8,0.24,'Feeding Date: '. date('d-m-Y h:i:s a', $date) ,0,'L','');

            //date_format($$data['EDate'], 'd/m/Y H:i:s');

            $pdf->SetXY(5.6,  9.2+$y);
            $pdf->Cell(8,0.24,'Print Date: '. date('d-m-Y h:i:s a'),0,'L','');

            $pdf->SetXY(0.6,  9.2);
            $pdf->Cell(8,0.24,'Candidate\'s Signature ',0,'L','');
            //======================================================================================
        }

        $pdf->Output($data["coll_cd"].'.pdf', 'I');
    }
    public function Print_challan_Form()
    {


        // // DebugBreak();();



        $Batch_Id = $this->uri->segment(3);

        $this->load->library('session');
        $this->load->library('NumbertoWord');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_11th_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
        //$grp_cd = $this->uri->segment(3);
        // $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'formno'=>$formno);
        //  // DebugBreak();();
        $result = $this->Registration_11th_model->Print_challan_Form($fetch_data);

        //   $result = array('data'=>$this->NinthCorrection_model->Print_challan_Form($fetch_data));




        $this->load->library('PDF_Rotate');


        // $pdf = new PDF_Rotate('P','in',"A4");
        //for each type of correction total 7 types of corrections are now
        $ctid=1;  //correction type of id starts from one and multiples by 2 for next type of correction id
        //   $displayfeetitle=array(1=>'Name Correction', 2=>'Father Name Correction', 3=>'DOB Correction', 4=>'FNIC Correction', 5=>'B-Form Correction', 6=>'Picture Change', 7=>'Group Change', 8=>'Subject Change');
        // $feestructure = array();
        //  for($i=1;$i<=8;$i++){
        //$feetitle =  $result = array('data'=>$this->NinthCorrection_model->Print_challan_Form($fetch_data));
        // // DebugBreak();();

        $feestructure[]    =  $result[0]['Total_ProcessingFee'];    
        $displayfeetitle[] =  'Total Processing Fee';    

        $feestructure[]     = $result[0]['Total_RegistrationFee'];   
        $displayfeetitle[] =  'Total Registration Fee';   

        $feestructure[]=$result[0]['Total_LateRegistrationFee']; 
        $displayfeetitle[] =  'Total Late Registration Fee';   


        // $feestructure[]='0';// $result[0]['FnicFee'];    
        //$displayfeetitle[] =  'Misc Fee';
        //  }
        /*    if($result[0]['BFormFee']>0)
        {
        $feestructure[]=$result[0]['BFormFee'];   
        $displayfeetitle[] =  'B-Form Correction'; 
        }
        if($result[0]['PicFee']>0)
        {
        $feestructure[]=$result[0]['PicFee'];   
        $displayfeetitle[] =  'Picture Change'; 
        }
        if($result[0]['GroupFee']>0)
        {
        $feestructure[]=$result[0]['GroupFee'];  
        $displayfeetitle[] =  'Group Change';  
        }
        if($result[0]['SubjectFee']>0)
        {
        $feestructure[]=$result[0]['SubjectFee'];    
        $displayfeetitle[] =  'Subject Change';
        }*/
        /*$feestructure[16]=$result[0]['BFormFee'];
        $feestructure[32]=$result[0]['PicFee'];
        $feestructure[64]=$result[0]['GroupFee'];
        $feestructure[128]=$result[0]['SubjectFee'];*/
        //  $ctid *= 2;
        // }
        //$totalfee
        $turn=1;     
        $pdf=new PDF_Rotate("P","in","A4");
        $pdf->AliasNbPages();
        $pdf->SetTitle("Challan Form | Application Correction Form");
        $pdf->SetMargins(0.5,0.5,0.5);
        $pdf->AddPage();
        $generatingpdf=false;
        $challanCopy=array(1=>"Depositor Copy",  2=>"Registration Branch Copy",3=>"Bank Copy", 4=>"Board Copy",);
        $challanMSG=array(1=>"(May be deposited in any HBL Branch)",2=>"(To be sent to the Online Registration Branch Via BISE One Window)", 3=>"(To be retained with HBL)", 4=>"(To be sent to the Board via HBL Branch aloongwith scroll)"  );
        $challanNo = $result[0]['Challan_No']; 

        //  // DebugBreak();();
        if(date('Y-m-d',strtotime(SINGLE_LAST_DATE11))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->Registration_11th_model->getreulefee(1); 
            $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
            $rule_fee   =  $this->Registration_11th_model->getreulefee(2); 
            $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        if($rule_fee[0]['isfine'] == 1)
        {
            // // DebugBreak();();
            $count = $result[0]["COUNT"];
            $data['data']["Total_RegistrationFee"] =  $count*$rule_fee[0]['Reg_Fee'] ;
            $data['data']["Total_ProcessingFee"] =  $count*$rule_fee[0]['Reg_Processing_Fee'] ;
            $data['data']["Total_LateRegistrationFee"] =  $count*$rule_fee[0]['Fine'] ;
            $data['data']["Amount"] = $data['data']["Total_RegistrationFee"]+ $data['data']["Total_ProcessingFee"]+$data['data']["Total_LateRegistrationFee"] ;
            $data['data']['batch_info'][0]['Batch_ID'] = $result[0]['Batch_ID'];
            array('myd'=>$this->Registration_model->UpdateBatchFee($data));
        } 
        $obj    = new NumbertoWord();
        $obj->toWords($result[0]['Amount'],"Only.","");
        // $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');
        $feeInWords = ucwords($obj->words);//strtoupper(cNum2Words($totalfee)); 

        //-------------------- PRINT BARCODE
        //  $pdf->SetDrawColor(0,0,0);
        // $temp = $user['Inst_Id'].'11-2017-19';
        //$image =  $this->set_barcode($temp);

        $temp = $challanNo.'@'.$user['Inst_Id'].'@'.$Batch_Id.'@11@'.Year.'@1';
        //  $image =  $this->set_barcode($temp);
        //// DebugBreak();();
        $temp =  $this->set_barcode($temp);

        $yy = 0.05;
        $dyy = 0.1;
        $corcnt = 0;
        for ($j=1;$j<=4;$j++) 
        {




            $yy = 0.04;
            if($turn==1){$dyy=0.2;} 
            else {
                if($turn==2){$dyy=2.65;} else  if($turn==3) {$dyy=5.2; } else {$dyy=7.75 ; $turn=0;}
            }
            $corcnt = 0;
            $pdf->SetFont('Arial','BI',11);
            $pdf->SetXY(1.0,$yy+$dyy);
            //   // DebugBreak();();
            $pdf->Cell(2.45, 0.4, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "L");
            $pdf->Image(base_url()."assets/img/logo.jpg",0.30,$yy+$dyy, 0.50,0.50, "JPG", "http://www.bisegrw.com");
            //  $pdf->Image(BARCODE_PATH.$Barcode,3.2, 1.15+$yy ,1.8,0.20,"PNG");
            $pdf->Image(BARCODE_PATH.$temp,5.8, $yy+$dyy+0.30 ,1.9,0.22,"PNG");
            $challanTitle = $challanCopy[$j];
            $generatingpdf=true;


            if($turn==1){$dy=0.5;} else {
                if($turn==2){$dy=3.0;} else  if($turn==3) {$dy=5.5; }else {$dy=8.1 ; $turn=0;}
            }
            $turn++;
            $y = 0.08;

            //$pdf->SetFont('Arial','BI',14);
            //$pdf->SetXY(5.5,$y+$dy);
            //$pdf->Image(BARCODE_PATH.$image,3.2, 0.61  ,1.8,0.20,"PNG");
            //$pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");

            $pdf->SetFont('Arial','BI',9);
            $pdf->SetXY(1.0,$y+$dy);
            $pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");
            $w = $pdf->GetStringWidth($challanCopy[$j]);
            $pdf->SetXY($w+1.2,$y+$dy);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, $challanMSG[$j], 0.25, "L");

            $pdf->SetXY($w+1.4,$y+$dy+0.15);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, 'Registration Session '.CURRENT_SESS1.' '.corr_bank_chall_class1, 0.25, "L");

            $y += 0.25;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->SetFillColor(0,0,0);
            $pdf->Cell(1.5,0.2,'',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->Cell(0, 0.25, "Due Date: ".$challanDueDate, 0.25, "C");
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','BI',8);
            $pdf->SetXY(2.0,$y+$dy-0.04);
            $pdf->Cell(0, 0.25, "Printing Date: ".date("d/m/y",time())."  Account Title: BISE, GUJRANWALA   CMD Account No. 00427900072103", 0.25, "C");
            //CMD Account No. 00427900072103
            //--------------------------- Fee Description
            $pdf->SetXY(2.8,$y+$dy);
            $pdf->SetFont('Arial','U',8);
            $pdf->Cell(0.5,0.5,"Fee Description",0,'L');

            //  // DebugBreak();();
            //--------------------------- Challan Depositor Information
            $pdf->SetXY(4,$y+0.1+$dy);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.3,"Bank Challan No:".$challanNo."           Batch No.".$result[0]['Batch_ID'],0,2,'L');
            $pdf->SetFont('Arial','U',9);
            $pdf->Cell(0.5,0.25, "Particulars Of Depositor",0,2,'L');
            $pdf->SetX(4.0);
            $pdf->SetFont('Arial','B',8);

            //if(intval($result[0]['sex'])==1){$sodo="S/O ";}else{$sodo="D/O ";}
            // $pdf->Cell(0.5,0.25,$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            // $pdf->Cell(0.5,0.25,,0,2,'L');
            $pdf->SetX(4);
            $pdf->SetFont('Arial','I',6.5);
            // // DebugBreak();();
            //$pdf->Cell(0.5,0.3,"Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            $pdf->MultiCell(4, .1, "Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0);
            $pdf->SetXY(4,$y+1.15+$dy);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(0.5,0.3,"Amount in Words: ".$feeInWords,0,2,'L');

            $x = 0.55;
            $y += 0.2;

            //------------- Fee Statement
            //  // DebugBreak();();
            $ctid=1;
            $multiply=1;

            /*    foreach ($feestructure as $value) {
            //  $value = $value * 2;

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell( 0.5,0.5,$displayfeetitle[$ctid],0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(3,$y+$dy);
            $pdf->Cell(0.8,0.5,$feestructure[$ctid],0,'C');
            $ctid *= 2;
            $y += 0.18;
            }*/
            // // DebugBreak();();
            $total =  count($feestructure);
            for ($k = 0; $k<count($feestructure); $k++){


                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(0.5,$y+$dy);

                //$feestructure = array(1=>0, 2=>0, 4=>0, 8=>0, 16=>0, 32=>0, 64=>0, 128=>0);
                $pdf->Cell( 0.5,0.5,$displayfeetitle[$k],0,'L');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(3,$y+$dy);
                $pdf->Cell(0.8,0.5,$feestructure[$k],0,'C');
                $y += 0.18;
                $corcnt = $k;




            }

            //------------- Total Amount


            if($corcnt ==0){
                $y += 1.0;
            }
            else if($corcnt ==1){
                $y += .7;
            }
            else if($corcnt ==2){
                $y += .6;
            }
            else if($corcnt ==3){
                $y += .4;
            }
            else if($corcnt ==4){
                $y += .3;
            }
            else if($corcnt ==5){
                $y += .2;
            }

            else if($corcnt ==6){
                $y += .16;
            }
            $y += -0.2;
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(0.5,($y)+$dy);
            $pdf->Cell( 0.5,0.5,"Total Amount: ",0,'L');
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(3,$y+$dy);
            $pdf->Cell(0.8,0.5,$result[0]['Amount'],0,'C');

            //------------- Signature
            $y += 0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Cashier: ___________________',0,'L');
            $pdf->SetXY(5.6,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Manager: _________________',0,'L');    

            if ($turn>1){
                $y += 0.4;
                $pdf->Image( base_url().'assets/img/cut_line.png' ,0.3,$y+$dy, 7.5,0.15, "PNG");   
                // $pdf->Image("images/cut_line.png",0.3,$y+$dy, 7.5,0.15, "PNG");
            }            
        }  
        if ($generatingpdf==true)
        {
            $pdf->Output('challanform.pdf','I');
        } else {
            $containsError=true;
            $errorMessage = "<br />Your Institute does not have any student registration card in accordance with selected group or form no. range.";
        }  

        //======================================================================================
        //  }

        //  $pdf->Output($data["Sch_cd"].'.pdf', 'I');
    }
    public function ChallanForm_Reg11th_Regular()
    {
        // // DebugBreak();();
        $Batch_Id = $this->uri->segment(3);
        $this->load->library('session');
        $this->load->library('NumbertoWord');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_11th_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
        //$grp_cd = $this->uri->segment(3);
        // $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'formno'=>$formno);
        //  // DebugBreak();();
        $result = $this->Registration_11th_model->Print_challan_Form($fetch_data);
        $this->load->library('PDF_RotateWithOutPage');

        $ctid=1;  //correction type of id starts from one and multiples by 2 for next type of correction id

        $feestructure[]    =  $result[0]['Total_ProcessingFee'];    
        $displayfeetitle[] =  'Total Processing Fee';    

        $feestructure[]    =  $result[0]['Total_RegistrationFee'];   
        $displayfeetitle[] =  'Total Registration Fee';   

        $feestructure[]    =  $result[0]['Total_LateRegistrationFee']; 
        $displayfeetitle[] =  'Total Late Registration Fee'; 

        $feestructure[]    =  $result[0]['COUNT']; 
        $displayfeetitle[] =  'Total Candidate(s)'; 

        /* $feestructure[]    =  $result[0]['TotalCertificateFee']; 
        $displayfeetitle[] =  'Total Certificate Fee';  */  

        $turn=1;     
        $pdf=new PDF_RotateWithOutPage("P","in","A4");
        $pdf->AliasNbPages();
        $pdf->SetTitle("Challan Form | Registration 11th ".sessReg." Batch Form Fee");
        $pdf->SetMargins(0.5,0.5,0.5);
        $pdf->AddPage();
        $generatingpdf=false;
        $challanCopy=array(1=>"Depositor Copy",  2=>"Registration Branch Copy",3=>"Bank Copy", 4=>"Board Copy",);
        $challanMSG=array(1=>"(May be deposited in any HBL Branch)",2=>"(To be sent to the Registration Branch Via BISE One Window)", 3=>"(To be retained with HBL)", 4=>"(Along with scroll)"  );
        $challanNo = $result[0]['Challan_No']; 

        //  // DebugBreak();();

        $User_info_data = array('Inst_Id'=>$user['Inst_Id'],'RegGrp'=>@$RegGrp,'spl_case'=>@$Spl_case);
        $user_info  =  $this->Registration_11th_model->getuser_info($User_info_data); 



        $isfine = 0;


        if($user['isSpecial']==1 && date('Y-m-d',strtotime($user['isSpecial_Fee']['FeedingDate']))>=date('Y-m-d')  )
        {
            $rule_fee[0]['Fine']   =  $user['isSpecial_Fee']['SpecialFee']; 
            $rule_fee[0]['Reg_Processing_Fee']   =  $user['isSpecial_Fee']['ProcessingFee']; 
            $rule_fee[0]['Reg_Fee']   =  $user['isSpecial_Fee']['RegFee']; 
            $rule_fee[0]['Rule_Fee_ID']   = 0; 
            $rule_fee[0]['isfine'] = 1; 
            $lastdate  = date('Y-m-d',strtotime($user['isSpecial_Fee']['FeedingDate'])) ;
        }
        else

        {
            if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d'))
            {
                $rule_fee[0]['isfine'] = 0; 
                $lastdate  = date('Y-m-d',strtotime($user_info['rule_fee'][0]['End_Date'])) ;
            }
            else if($user_info['info'][0]['feedingDate'] != null)
            {
                $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
                if(date('Y-m-d')<=$lastdate)
                {

                    $rule_fee  =  $this->Registration_11th_model->getreulefee(1);
                    $rule_fee[0]['isfine'] = 0; 
                }
                else 
                {
                    $rule_fee   =  $this->Registration_11th_model->getreulefee(2);
                    $rule_fee[0]['isfine'] = 1;
                }
            }
            else   if(date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>date('Y-m-d'))
            {
                $isfine = 1;
                $rule_fee   =  $this->Registration_11th_model->getreulefee(2);
                $rule_fee[0]['isfine'] = 1; 
                $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
            }
            //  // DebugBreak();();
            /* if(ISREADMISSION == 1)
            {
            $rule_fee  =  $this->Registration_11th_model->getreulefee(1);
            $rule_fee[0]['isfine'] = 1; 
            $isfine = 1;
            }   */
            //  $data = array('data'=>$this->Registration_model->revenue_pdf($fetch_data),'inst_Name'=>$user['inst_Name'],'inst_cd'=>$user['Inst_Id'],'barcode'=>$image,"rulefee"=>$rule_fee);
            if($rule_fee[0]['isfine'] == 1)
            {
                //  // DebugBreak();();
                $count = $result[0]["COUNT"];
                $data['data']["Total_RegistrationFee"] =  $count*$rule_fee[0]['Reg_Fee'] ;
                $data['data']["Total_ProcessingFee"] =  $count*$rule_fee[0]['Reg_Processing_Fee'] ;
                $data['data']["Total_LateRegistrationFee"] =  $count*$rule_fee[0]['Fine'] ;
                $data['data']["Amount"] = $data['data']["Total_RegistrationFee"]+ $data['data']["Total_ProcessingFee"]+$data['data']["Total_LateRegistrationFee"] ;
                $data['data']['batch_info'][0]['Batch_ID'] = $result[0]['Batch_ID'];
                $data['rulefee'][0]['Reg_Fee']  =  $rule_fee[0]['Reg_Fee'];
                $data['rulefee'][0]['Processing_Fee']  =  $rule_fee[0]['Processing_Fee'];
                $data['rulefee'][0]['Fine']  =  $rule_fee[0]['Fine'];
                $data['rulefee'][0]['Amount']  =  $rule_fee[0]['Amount'];
                array('myd'=>$this->Registration_11th_model->UpdateBatchFee($data));
            } 



        } 
        /*if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d'))
        {
        $rule_fee   =  $this->Registration_model->getreulefee(); 
        $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
        $rule_fee   =  $this->Registration_model->getreulefee(); 
        $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }  */

        $obj    = new NumbertoWord();
        $obj->toWords($result[0]['Amount'],"Only.","");
        // $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');
        $feeInWords = ucwords($obj->words);//strtoupper(cNum2Words($totalfee)); 

        //-------------------- PRINT BARCODE
        //  $pdf->SetDrawColor(0,0,0);
        // $temp = $user['Inst_Id'].'11-2017-19';
        //$image =  $this->set_barcode($temp);
        //  // DebugBreak();();
        $temp = $challanNo.'@'.$user['Inst_Id'].'@'.$Batch_Id;
        //  $image =  $this->set_barcode($temp);
        //// DebugBreak();();
        $temp =  $this->set_barcode($temp);

        $yy = 0.05;
        $dyy = 0.1;
        $corcnt = 0;
        $lastdate = date("d-m-Y", strtotime($lastdate));
        for ($j=1;$j<=4;$j++) 
        {




            $yy = 0.04;
            if($turn==1){$dyy=0.2;} 
            else {
                if($turn==2){$dyy=2.65;} else  if($turn==3) {$dyy=5.2; } else {$dyy=7.75 ; $turn=0;}
            }
            $corcnt = 0;
            $pdf->SetFont('Arial','B',11);
            $pdf->SetXY(1.0,$yy+$dyy);
            //   // DebugBreak();();
            $pdf->Cell(2.45, 0.4, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "L");
            $pdf->Image("assets/img/icon2.png",0.30,$yy+$dyy, 0.50,0.50, "PNG", "http://www.bisegrw.com");
            //  $pdf->Image(BARCODE_PATH.$Barcode,3.2, 1.15+$yy ,1.8,0.20,"PNG");
            $pdf->Image(BARCODE_PATH.$temp,5.8, $yy+$dyy+0.30 ,1.9,0.22,"PNG");

            //$pdf->SetXY(2.6,$y+0.08+$dy);
            $pdf->Image(assets.'11th.PNG',7.6, $yy+$dyy+0.05 ,0.20,0.22,"PNG");
            //$pdf->Image(assets.'/9th.PNG',4.5,$y+0.23+$dy, 1, 2.0, "PNG"); 

            $challanTitle = $challanCopy[$j];
            $generatingpdf=true;


            if($turn==1){$dy=0.5;} else {
                if($turn==2){$dy=3.0;} else  if($turn==3) {$dy=5.5; }else {$dy=8.1 ; $turn=0;}
            }
            $turn++;
            $y = 0.08;

            //$pdf->SetFont('Arial','BI',14);
            //$pdf->SetXY(5.5,$y+$dy);
            //$pdf->Image(BARCODE_PATH.$image,3.2, 0.61  ,1.8,0.20,"PNG");
            //$pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(1.0,$y+$dy);
            $pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");
            $w = $pdf->GetStringWidth($challanCopy[$j]);
            $pdf->SetXY($w+1.2,$y+$dy);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(0, $y, $challanMSG[$j], 0.25, "L");

            $pdf->SetXY($w+1.4,$y+$dy+0.15);
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(0, $y, 'Registration Session '.sessReg.' ('.corr_bank_chall_class.')', 0.25, "L");

            $y += 0.25;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->SetFillColor(0,0,0);
            $pdf->Cell(1.5,0.2,'',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->Cell(0, 0.25, "Due Date: ".$lastdate, 0.25, "C");
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(2.0,$y+$dy-0.04);                                                                                                
            $pdf->Cell(0, 0.25, "Printing Date: ".date("d/m/y",time())."         Account Title: BISE, GUJRANWALA             CMD Account No. 00427900072103", 0.25, "C");
            //CMD Account No. 00427900072103
            //--------------------------- Fee Description
            $pdf->SetXY(2.8,$y+$dy);
            $pdf->SetFont('Arial','U',8);
            $pdf->Cell(0.5,0.5,"Fee Description",0,'L');

            //  // DebugBreak();();
            //--------------------------- Challan Depositor Information
            $pdf->SetXY(4,$y+0.1+$dy);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.3,"Bank Challan No:".$result[0]['Challan_No']."           Batch No.".$result[0]['Batch_ID'],0,2,'L');
            $pdf->SetFont('Arial','U',9);
            $pdf->Cell(0.5,0.25, "Particulars of Depositor",0,2,'L');
            $pdf->SetX(4.0);
            $pdf->SetFont('Arial','B',8);

            //if(intval($result[0]['sex'])==1){$sodo="S/O ";}else{$sodo="D/O ";}
            // $pdf->Cell(0.5,0.25,$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            // $pdf->Cell(0.5,0.25,,0,2,'L');
            $pdf->SetX(4);
            $pdf->SetFont('Arial','B',6.5);
            // // DebugBreak();();
            //$pdf->Cell(0.5,0.3,"Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            $pdf->MultiCell(4, .1, "Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0);
            $pdf->SetXY(4,$y+1.15+$dy);
            $pdf->SetFont('Arial','B',9);
            $pdf->MultiCell(4, .15, "Amount in Words: ".$feeInWords,0);
            //$pdf->Cell(0.5,0.3,"Amount in Words: ".$feeInWords,0,2,'L');

            $x = 0.55;
            $y += 0.2;

            //------------- Fee Statement
            //  // DebugBreak();();
            $ctid=1;
            $multiply=1;

            /*    foreach ($feestructure as $value) {
            //  $value = $value * 2;

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell( 0.5,0.5,$displayfeetitle[$ctid],0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(3,$y+$dy);
            $pdf->Cell(0.8,0.5,$feestructure[$ctid],0,'C');
            $ctid *= 2;
            $y += 0.18;
            }*/
            // // DebugBreak();();
            $total =  count($feestructure);
            for ($k = 0; $k<count($feestructure); $k++){


                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(0.5,$y+$dy);

                //$feestructure = array(1=>0, 2=>0, 4=>0, 8=>0, 16=>0, 32=>0, 64=>0, 128=>0);
                $pdf->Cell( 0.5,0.5,$displayfeetitle[$k],0,'L');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(3,$y+$dy);
                $pdf->Cell(0.8,0.5,$feestructure[$k],0,'C');
                $y += 0.18;
                $corcnt = $k;




            }

            //------------- Total Amount


            if($corcnt ==0){
                $y += 1.0;
            }
            else if($corcnt ==1){
                $y += .7;
            }
            else if($corcnt ==2){
                $y += .6;
            }
            else if($corcnt ==3){
                $y += .4;
            }
            else if($corcnt ==4){
                $y += .3;
            }
            else if($corcnt ==5){
                $y += .2;
            }

            else if($corcnt ==6){
                $y += .16;
            }
            $y += -0.2;
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(0.5,($y)+$dy-.15);
            $pdf->Cell( 0.5,0.5,"Total Amount(Rs.): ",0,'L');
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(3,$y+$dy-.15);
            $pdf->Cell(0.8,0.5,$result[0]['Amount'].'/-',0,'C');

            //------------- Signature
            $y += 0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Cashier: ___________________',0,'L');
            $pdf->SetXY(5.6,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Manager: _________________',0,'L');    

            if ($turn>1){
                $y += 0.4;
                $pdf->Image( base_url().'assets/img/cut_line.png' ,0.3,$y+$dy, 7.5,0.15, "PNG");   
                // $pdf->Image("images/cut_line.png",0.3,$y+$dy, 7.5,0.15, "PNG");
            }            
        }  
        if ($generatingpdf==true)
        {
            $pdf->Output('challanform.pdf','I');
        } else {
            $containsError=true;
            $errorMessage = "<br />Your Institute does not have any student registration card in accordance with selected group or form no. range.";
        }  

        //======================================================================================
        //  }

        //  $pdf->Output($data["Sch_cd"].'.pdf', 'I');
    }
    private function set_barcode($code)
    {
        //// DebugBreak();()  ;
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');


        $file = Zend_Barcode::draw('code128','image', array('text' => $code,'drawText'=>false), array());
        //$code = $code;
        $store_image = imagepng($file,BARCODE_PATH."{$code}.png");
        return $code.'.png';

    }
    function frmvalidation($viewName,$allinputdata,$isupdate)
    {
        // // DebugBreak();();
        $_POST['address']  = str_replace("'", "", $_POST['address'] );
        $subjectslang = array('22','23','36','34','35');
        $subjectshis = array('20','21','19');
        $subjectGenSci = array('19','47','11','18','83');
        $cntzero = substr_count(@$_POST['bay_form'],"0");
        $cntone = substr_count(@$_POST['bay_form'],"1");
        $cnttwo = substr_count(@$_POST['bay_form'],"2");
        $cntthr = substr_count(@$_POST['bay_form'],"3");
        $cntfour = substr_count(@$_POST['bay_form'],"4");
        $cntfive = substr_count(@$_POST['bay_form'],"5");
        $cntsix = substr_count(@$_POST['bay_form'],"6");
        $cntseven = substr_count(@$_POST['bay_form'],"7");
        $cnteight = substr_count(@$_POST['bay_form'],"8");
        $cntnine = substr_count(@$_POST['bay_form'],"9");


        if(@$_POST['dob'] != null || $allinputdata['Dob'] != null)
        {
            $date = new DateTime(@$_POST['dob']);
            $convert_dob = $date->format('Y-m-d');     
        }

        if(@$_POST['cand_name'] == ''  || ($allinputdata['name'] == '' && $isupdate ==1)  )
        {
            $allinputdata['excep'] = 'Please Enter Your Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
       /* if(strlen(@$_POST['cand_name'] < 3)  || (strlen($allinputdata['name'] < 3) && $isupdate ==1)  )
        {
            $allinputdata['excep'] = 'Please Enter Your Correct Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }  */
        //(strpos($a, 'are') !== false)
        /* if ((strpos(@$_POST['cand_name'], 'MOHAMMAD') !== false)|| (strpos(@$_POST['cand_name'], 'MOHAMAD') !== false) || (strpos(@$_POST['cand_name'], 'MOHD') !== false) || (strpos(@$_POST['cand_name'], 'MUHAMAD') !== false) || (strpos(@$_POST['cand_name'], 'MOOHAMMAD') !== false)|| (strpos(@$_POST['cand_name'], 'MOOHAMAD') !== false))
        {
        $allinputdata['excep'] = 'MUHAMMAD Spelling is not Correct in Name';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration/'.$viewName);
        return;

        }

        else*/
         if (@$_POST['father_name'] == ''  || ($allinputdata['Fname'] == '' && $isupdate ==1) )
        {
            $allinputdata['excep'] = 'Please Enter Your Father Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        /* if (strlen(@$_POST['father_name'] < 3)  || (strlen($allinputdata['Fname'] < 3) && $isupdate ==1) )
        {
            $allinputdata['excep'] = 'Please Enter Your Father Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }  */
       /* if ((@$_POST['cand_name'] == @$_POST['father_name'] )  || (($allinputdata['name'] == $allinputdata['Fname'] ) && $isupdate ==1))
        {
            $allinputdata['excep'] = 'Please Enter Your Father Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }   */
        /*  if ((strpos(@$_POST['father_name'], 'MOHAMMAD') !== false)|| (strpos(@$_POST['father_name'], 'MOHAMAD') !== false) || (strpos(@$_POST['father_name'], 'MUHAMAD') !== false) || (strpos(@$_POST['father_name'], 'MOOHAMMAD') !== false)|| (strpos(@$_POST['father_name'], 'MOOHAMAD') !== false))
        {
        $allinputdata['excep'] = 'MUHAMMAD Spelling is not Correct in Fathers Name';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;

        }*/

        else if((@$_POST['bay_form'] == '' ||  (@$allinputdata['BForm'] == '' && $isupdate ==1))  && @$allinputdata['iyear']>=2014 )
        {
            $allinputdata['excep'] = 'Please Enter Your Bay Form No fh.';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;


        }
        /*   else if( (@$_POST['bay_form'] == '00000-0000000-0') || (@$_POST['bay_form'] == '11111-1111111-1') || (@$_POST['bay_form'] == '22222-2222222-2') || (@$_POST['bay_form'] == '33333-3333333-3') || (@$_POST['bay_form'] == '44444-4444444-4')
        || (@$_POST['bay_form'] == '55555-5555555-5') || (@$_POST['bay_form'] == '66666-6666666-6') || (@$_POST['bay_form'] == '77777-7777777-7') || (@$_POST['bay_form'] == '88888-8888888-8') || (@$_POST['bay_form'] == '99999-9999999-9') ||
        (@$_POST['bay_form'] == '00000-1111111-0') || (@$_POST['bay_form'] == '00000-1111111-1') || (@$_POST['bay_form'] == '00000-0000000-1' || $cntzero >7 || $cntone >7 || $cnttwo >7 || $cntfour >7 || $cntthr >7 || $cntfive >7 || $cntsix >7 || $cntseven >7 || $cnteight >7 || $cntnine >7)
        )
        {
        $allinputdata['excep'] = 'Please Enter Your Correct Bay Form No.';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;

        }        */
        /*    else if( (@$_POST['bay_form'] == '00000-0000000-0') || (@$_POST['bay_form'] == '11111-1111111-1') || (@$_POST['bay_form'] == '22222-2222222-2') || (@$_POST['bay_form'] == '33333-3333333-3') || (@$_POST['bay_form'] == '44444-4444444-4')
        || (@$_POST['bay_form'] == '55555-5555555-5') || (@$_POST['bay_form'] == '66666-6666666-6') || (@$_POST['bay_form'] == '77777-7777777-7') || (@$_POST['bay_form'] == '88888-8888888-8') || (@$_POST['bay_form'] == '99999-9999999-9') ||
        (@$_POST['bay_form'] == '00000-1111111-0') || (@$_POST['bay_form'] == '00000-1111111-1') || (@$_POST['bay_form'] == '00000-0000000-1' || $cntzero >7 || $cntone >7 || $cnttwo >7 || $cntfour >7 || $cntthr >7 || $cntfive >7 || $cntsix >7 || $cntseven >7 || $cnteight >7 || $cntnine >7)
        )
        {
        $allinputdata['excep'] = 'Please Enter Your Correct Bay Form No.';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;

        }*/
        /* else if($this->Registration_model->bay_form_comp(@$_POST['bay_form']) == true && $isupdate ==0 )
        {
        // // DebugBreak();();
        $allinputdata['excep'] = 'This Bay Form is already Feeded.';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;



        }*/
        //   else if(@$_POST['oldbform'] !=  @$_POST['bay_form'] && $isupdate ==1 )
        //  {
        // // DebugBreak();();
        /*  if($this->Registration_11th_model->bay_form_comp(@$_POST['bay_form']) == true )
        {
        // // DebugBreak();();
        $allinputdata['excep'] = 'This Bay Form is already Feeded.';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;
        }
        else if($this->Registration_11th_model->bay_form_fnic(@$_POST['bay_form'],@$_POST['father_cnic']) == true  )
        {
        // // DebugBreak();();
        $allinputdata['excep'] = 'This Form is already Feeded.';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;
        }*/
        //   }
        /*  else if($this->Registration_11th_model->bay_form_fnic(@$_POST['bay_form'],@$_POST['father_cnic']) == true && $isupdate ==0 && $allinputdata['SSC_brd_cd'] != 1 )
        {
        // // DebugBreak();();
        $allinputdata['excep'] = 'This Form is already Feeded.';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;
        }
        else if($this->Registration_11th_model->bay_form_fnic_dob_comp(@$_POST['bay_form'],@$_POST['father_cnic'],$convert_dob) == true && $isupdate == 0  && $allinputdata['SSC_brd_cd'] != 1 )
        {
        // // DebugBreak();();
        $allinputdata['excep'] = 'This Form is already Feeded.';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;
        }         */

        else if((@$_POST['father_cnic'] == '' || ($allinputdata['FNIC'] == ''  && $isupdate ==1))  && @$allinputdata['iyear']>=2014   )
        {
            $allinputdata['excep'] = 'Please Enter Your Father CNIC';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;


        }
        /* else if((@$_POST['bay_form'] == @$_POST['father_cnic']) || (@$_POST['father_cnic'] == @$_POST['bay_form']) )
        {
        $allinputdata['excep'] = 'Your Bay Form and FNIC No. are not same';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;


        }*/
        /*else if (@$_POST['dob'] == ''  || (@$allinputdata['Dob'] == ''   && $isupdate ==1) )
        {
        $allinputdata['excep'] = 'Please Enter Your  Date of Birth';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;

        }*/
        else if(@$_POST['mob_number'] == '')
        {
            $allinputdata['excep'] = 'Please Enter Your Mobile Number';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if(@$_POST['medium'] == 0)
        {
            $allinputdata['excep'] = 'Please Select Your Medium';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if(@$_POST['Inst_Rno']== '')
        { 
            $allinputdata['excep'] = 'Please Enter Your Roll Number';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if(@$_POST['MarkOfIden']== '')
        {
            $allinputdata['excep'] = 'Please Enter Your Mark of Identification';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }

        /* else if((@$_POST['speciality'] != '0')or (@$_POST['speciality'] != '1') or (@$_POST['speciality'] != '2'))
        {
        $error['excep'] = 'Please Enter Your Speciality';
        $this->load->view('Registration/9th/NewEnrolment.php',$error);
        }*/
        else if((@$_POST['medium'] != '1') and (@$_POST['medium'] != '2') )
        {
            $allinputdata['excep'] = 'Please Select Your medium';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        /*else if(((@$_POST['nationality'] != '1') || (@$_POST['nationality'] != '2')) && ((@$_POST['OldBrd']!=1) && ($isupdate ==0)) || (@$_POST['nationality_hidden'] != '1') and (@$_POST['nationality_hidden'] != '2') )
        {
        $allinputdata['excep'] = 'Please Select Your Nationality';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration_11th/'.$viewName);
        return;

        }*/
        else if((@$_POST['gender'] != '1') and (@$_POST['gender'] != '2'))
        {
            $allinputdata['excep'] = 'Please Select Your Gender';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if((@$_POST['hafiz']!= '1') and (@$_POST['hafiz']!= '2'))
        {
            $allinputdata['excep'] = 'Please Select Your Hafiz-e-Quran option';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if((@$_POST['religion'] != '1') and (@$_POST['religion'] != '2'))
        {
            $allinputdata['excep'] = 'Please Select Your religion';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if((@$_POST['UrbanRural'] != '1') and (@$_POST['UrbanRural'] != '2'))
        {
            $allinputdata['excep'] = 'Please Select Your Residency';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if(@$_POST['address'] =='')
        {
            $allinputdata['excep'] = 'Please Enter Your Address';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if(@$_POST['std_group'] == 0)
        {
            $allinputdata['excep'] = 'Please Select Your Study Group';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if((@$_POST['std_group'] == 1) && ((@$_POST['sub4']!=47) || (@$_POST['sub5']!=48)||(@$_POST['sub6']!=46)))
        {

            $allinputdata['excep'] = 'Subjects not according to Group';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if((@$_POST['std_group'] == 2)&& ((@$_POST['sub4']!=47) || (@$_POST['sub5']!=48)||(@$_POST['sub6']!=19)))
        {

            $allinputdata['excep'] = 'Subjects not according to Group';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if((@$_POST['std_group'] == 3)&& ((@$_POST['sub4']==19 || @$_POST['sub5']==19 || @$_POST['sub6']==19 )&&(in_array(@$_POST['sub4'],$subjectGenSci) && in_array(@$_POST['sub5'],$subjectGenSci) && in_array(@$_POST['sub6'],$subjectGenSci)) || (@$_POST['sub7']!=0)))
        {

            $allinputdata['excep'] = 'Subjects not according to Group';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }
        else if((@$_POST['std_group'] == 4) && ((@$_POST['sub4'] ==0) || ((@$_POST['sub5'] ==0)|| (@$_POST['sub6'] ==0))))
        {
            //// DebugBreak();();
            $allinputdata['excep'] = 'Subjects not according to Group';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }

        else if((@$_POST['std_group'] == 5)&& ((@$_POST['sub4'] != 70) || (@$_POST['sub5']!=71)||(@$_POST['sub6']!=80)|| (@$_POST['sub7']!=39)))
        {
            $allinputdata['excep'] = 'Subjects not according to Group';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration_11th/'.$viewName);
            return;

        }

        else if((@$_POST['sub1'] == @$_POST['sub2']) ||(@$_POST['sub1'] == @$_POST['sub3'])||(@$_POST['sub1'] == @$_POST['sub4'])||(@$_POST['sub1'] == @$_POST['sub5'])||(@$_POST['sub1'] == @$_POST['sub6'])||(@$_POST['sub1'] == @$_POST['sub7'])||
            (@$_POST['sub1'] == @$_POST['sub8']))
            {
                $allinputdata['excep'] = 'Please Select Different Subjects';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration_11th/'.$viewName);
                return;

            }
            else if((@$_POST['sub2'] == @$_POST['sub1']) ||(@$_POST['sub2'] == @$_POST['sub3'])||(@$_POST['sub2'] == @$_POST['sub4'])||(@$_POST['sub2'] == @$_POST['sub5'])||(@$_POST['sub2'] == @$_POST['sub6'])||(@$_POST['sub2'] == @$_POST['sub7'])                         ||(@$_POST['sub2'] == @$_POST['sub8'])
                )
                {
                    $allinputdata['excep'] = 'Please Select Different Subjects';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Registration_11th/'.$viewName);
                    return;

                }
                else if((@$_POST['sub3'] == @$_POST['sub1']) ||(@$_POST['sub3'] == @$_POST['sub2'])||(@$_POST['sub3'] == @$_POST['sub4'])||(@$_POST['sub3'] == @$_POST['sub5'])||(@$_POST['sub3'] == @$_POST['sub6'])||(@$_POST['sub3'] == @$_POST['sub7'])||(@$_POST['sub3'] == @$_POST['sub8'])
                    )
                    {
                        $allinputdata['excep'] = 'Please Select Different Subjects';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }
                    else if((@$_POST['sub4'] == @$_POST['sub1']) ||(@$_POST['sub4'] == @$_POST['sub3'])||(@$_POST['sub4'] == @$_POST['sub2'])||(@$_POST['sub4'] == @$_POST['sub5'])||(@$_POST['sub4'] == @$_POST['sub6'])||(@$_POST['sub4'] == @$_POST[                                 'sub7'])||(@$_POST['sub4'] == @$_POST['sub8']))
                    {
                        $allinputdata['excep'] = 'Please Select Different Subjects';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }
                    else if((@$_POST['sub5'] == @$_POST['sub1']) ||(@$_POST['sub5'] == @$_POST['sub3'])||(@$_POST['sub5'] == @$_POST['sub4'])||(@$_POST['sub5'] == @$_POST['sub2'])||(@$_POST['sub5'] == @$_POST['sub6'])||(@$_POST['sub5'] == @$_POST['sub7'])||(@$_POST['sub5'] == @$_POST['sub8']))
                    {
                        $allinputdata['excep'] = 'Please Select Different Subjects';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }
                    else if((@$_POST['sub6'] == @$_POST['sub1']) ||(@$_POST['sub6'] == @$_POST['sub3'])||(@$_POST['sub6'] == @$_POST['sub4'])||(@$_POST['sub6'] == @$_POST['sub5'])||(@$_POST['sub6'] == @$_POST['sub2'])||(@$_POST['sub6'] ==                                          @$_POST['sub7'])||(@$_POST['sub6'] == @$_POST['sub8']))
                    {
                        $allinputdata['excep'] = 'Please Select Different Subjects';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }
                    else if((@$_POST['sub7'] == @$_POST['sub1']) ||(@$_POST['sub7'] == @$_POST['sub3'])||(@$_POST['sub7'] == @$_POST['sub4'])||(@$_POST['sub7'] == @$_POST['sub5'])||(@$_POST['sub7'] == @$_POST['sub6'])||(@$_POST['sub7'] == @$_POST['sub2']))
                    {
                        $allinputdata['excep'] = 'Please Select Different Subjects';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }
                    /* else if((@$_POST['sub8'] == @$_POST['sub1']) ||(@$_POST['sub8'] == @$_POST['sub3'])||(@$_POST['sub8'] == @$_POST['sub4'])||(@$_POST['sub8'] == @$_POST['sub5'])||(@$_POST['sub8'] == @$_POST['sub6'])||(@$_POST['                                                   sub8'] == @$_POST['sub7'])||(@$_POST['sub8'] == @$_POST['sub2']))
                    {
                    $allinputdata['excep'] = 'Please Select Different Subjects';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Registration_11th/'.$viewName);
                    return;

                    }*/
                    else if (in_array($_POST['sub4'], $subjectslang) && in_array($_POST['sub5'], $subjectslang)&& in_array($_POST['sub6'], $subjectslang))
                    {
                        $allinputdata['excep'] = 'Double Language is not Allowed Please choose a different Subject';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;
                    }
                    else if (in_array($_POST['sub4'], $subjectshis) && in_array($_POST['sub5'], $subjectshis)&& in_array($_POST['sub6'], $subjectshis))
                    {
                        $allinputdata['excep'] = 'Double History is not Allowed Please choose a different Subject';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;
                    }
                    else if(@$_POST['sub4'] == @$_POST['sub5'])
                    {
                        $allinputdata['excep'] = 'Please Select Different Subjects';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }
                    else if(@$_POST['sub4'] == @$_POST['sub6'])
                    {
                        $allinputdata['excep'] = 'Please Select Different Subjects';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }

                    else if(@$_POST['sub1'] == 0)
                    {
                        $allinputdata['excep'] = 'Please Select Subject 1';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }
                    else if(@$_POST['sub2'] == 0)
                    {
                        $allinputdata['excep'] = 'Please Select Subject 2';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;
                    }
                    else if(@$_POST['sub3'] == 0)
                    {
                        $allinputdata['excep'] = 'Please Select Subject 3';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }
                    else if(@$_POST['sub4'] == 0)
                    {
                        $allinputdata['excep'] = 'Please Select Subject 4';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }

                    else if(@$_POST['sub5'] == 0)
                    {
                        $allinputdata['excep'] = 'Please Select Subject 5';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }
                    else if(@$_POST['sub6'] == 0)
                    {
                        $allinputdata['excep'] = 'Please Select Subject 6';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }
                    else if(@$_POST['sub7'] == 0 && ((@$_POST['std_group'] == 6) || (@$_POST['std_group'] == 5)))
                    {
                        $allinputdata['excep'] = 'Please Select Subject 7';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration_11th/'.$viewName);
                        return;

                    }
    }  
}