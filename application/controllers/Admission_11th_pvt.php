<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission_11th_pvt extends CI_Controller {
    /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    *         http://example.com/index.php/welcome
    *    - or -
    *         http://example.com/index.php/welcome/index
    *    - or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see http://codeigniter.com/user_guide/general/urls.html
    */
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('Browsercache');
        $this->browsercache->dontCache();
        $this->clear_cache();
        $this->clear_all_cache();
        //this condition checks the existence of session if user is not accessing  
        //login method as it can be accessed without user session
        /* $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
        redirect('login');
        }  */
    }
    public function index()
    {

        $data = array(
            'isselected' => '3',
        );
        $this->load->model('Admission_model');
        $this->load->library('session');

        $error ="";

        if($this->session->flashdata('downerror'))
        {
            $error = $this->session->flashdata('downerror');
        }
        else{
            $error = "";
        }

        $this->load->view('common/commonheader11th.php');
        $mydata = array('error'=>$error);

        $this->load->view('Admission/11th/Default.php',$mydata);

        $this->load->view('common/homepagefooter.php');
    }
    public function Students_matricInfo(){
        // DebugBreak();   //Students_matricInfo matric_error
        $this->load->view('common/commonheader11th.php');

        $this->load->view('Admission/11th/Students_MatricInfo.php');
        $this->load->view('common/commonfooter.php');

    }

    public function NewEnrolmentPVT()
    {

        $mrollno = $_POST["oldRno"];

        $board   =  $_POST["oldBrd_cd"];

        $year    =  $_POST["oldYear"];

        $session =$_POST["oldSess"];
        $this->load->model('Admission_11th_Pvt_model');
        $data = array('mrollno'=>"$mrollno",'board'=>$board,'year'=>$year,'session'=>$session);
        if($board == 1)
        {
            if(!ctype_digit($mrollno))
            {
                $error['excep'] = 'SSC ROLL NO. IS INCORRECT';

            }
            $RegStdData = array('data'=>$this->Admission_11th_Pvt_model->Pre_Matric_data($data),'isReAdm'=>0,'Oldrno'=>0,'Inst_Rno'=>'','excep'=>'','isHafiz'=>'');  
        }
        else
        {
            $RegStdData['data'][0]['SSC_RNo'] = $_POST["oldRno"];
            $RegStdData['data'][0]['SSC_Year'] = $_POST["oldYear"];
            $RegStdData['data'][0]['SSC_Sess'] = $_POST["oldSess"];
            $RegStdData['data'][0]['SSC_brd_cd'] = $_POST["oldBrd_cd"];
            $RegStdData['isReAdm']=0;
            $RegStdData['Oldrno']=0;
            $RegStdData['Inst_Rno']=0;
            $RegStdData['excep']=0;
            $RegStdData['isHafiz']=0;
            $RegStdData['data'][0]['sub1']=1;
        }
        $this->load->view('common/commonheader11th.php');

        $this->load->view('Admission/11th/AdmissionForm.php',$RegStdData);
        $this->load->view('common/footer11threg.php');
    }

    public function NewEnrolmentPVT_Lang()
    {

        $this->load->view('common/commonheader11th.php');
        $this->load->view('Admission/11th/AdmissionForm_lang.php');
        $this->load->view('common/footer11threg_lang.php');
    }
    public function Get_students_record()
    {

        $mrollno = $_POST["oldRno"];

        $board   =  $_POST["oldBrd_cd"];

        $year    =  $_POST["oldYear"];

        $session =$_POST["oldSess"];

        $data = array('mrollno'=>"$mrollno",'board'=>$board,'year'=>$year,'session'=>$session);
        $this->load->model('Admission_11th_Pvt_model');

        $error['excep'] = '';

        $isfeed =  $this->Admission_11th_Pvt_model->IsFeeded($data);

        if($isfeed >0)
        {
            $error['excep'] = 'You have already send regular admission';
        }
        else
        {
            if($board == 1)
            {
                if(!ctype_digit($mrollno))
                {
                    $error['excep'] = 'SSC ROLL NO. IS INCORRECT';

                }
                $RegStdData = array('data'=>$this->Admission_11th_Pvt_model->Pre_Matric_data($data),'isReAdm'=>0,'Oldrno'=>0,'Inst_Rno'=>'','excep'=>'','isHafiz'=>'');  

                $spl_cd = $RegStdData['data'][0]['spl_cd'];
                $msg = $RegStdData['data'][0]['Mesg'];
                $SpacialCase = $RegStdData['data'][0]['SpacialCase'];
                $status = $RegStdData['data'][0]['status'];

                if($RegStdData['data'] == -1)
                {
                    $error['excep'] = 'NO DATA FOUND AGAINST YOUR RECORD';

                }
                else if($RegStdData['data'][0]['SSC_RNo'] == '' || $RegStdData['data'][0]['SSC_RNo'] == 0 )
                {
                    $error['excep'] =  'SSC ROLL NO. IS INCORRECT';

                }
                else if($msg != '')
                {
                    if($RegStdData['data'][0]['class'] ==  11 && $RegStdData['data'][0]['status'] != 1)
                    {
                        $error['excep'] = '';
                    }
                    else
                    {
                         $error['excep'] =  $msg;
                    }
                   

                }
                else if($status != 1)
                {
                    $error['excep'] =  'You are FAILED in matric ';

                }
                else if($spl_cd != null && $spl_cd != 34)
                {
                    $error['excep'] = 'You can not appear due to '.$SpacialCase;

                }


            }
            else if(@$RegStdData['data'] == False and $board != 1)
            {
                $error['excep'] = '';
                $RegStdData['data'][0]['SSC_RNo'] = $_POST["oldRno"];
                $RegStdData['data'][0]['SSC_Year'] = $_POST["oldYear"];
                $RegStdData['data'][0]['SSC_Sess'] = $_POST["oldSess"];
                $RegStdData['data'][0]['SSC_brd_cd'] = $_POST["oldBrd_cd"];
                $RegStdData['data'][0]['sub1']=1;
                $RegStdData['isReAdm']=0;
                // DebugBreak();
                $mylen = strlen(trim($RegStdData['data'][0]['SSC_RNo']));
                if(trim($RegStdData['data'][0]['SSC_RNo']," ") == '' ||  trim($RegStdData['data'][0]['SSC_RNo']) == '0' || $mylen < 4 )
                {
                    $error['excep'] = 'SSC ROLL NO. IS INCORRECT';

                }

            }  
        }
        if($error['excep'] == '')
        {
            $error['excep'] =  'success'; 
        }  
        echo   json_encode($error)  ;

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


    public  function GetDistName($id) 
    {
        $retVal = "";
        if($id == 1) $retVal = "GUJRANWALA";
        else if($id == 2)  $retVal = "GUJRAT";
            else if($id == 3)  $retVal = "HAFIZ ABAD";
                else if($id == 4)  $retVal = "MANDI BAHA UD DIN";
                    else if($id == 5)  $retVal = "NAROWAL";
                        else if($id == 6)  $retVal = "SIALKOT";
                            return $retVal;             
    }

    public function NewEnrolment_insert()
    {
        $this->load->model('Admission_11th_Pvt_model');
        $this->load->library('session');
        $error = array();


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

        if((@$_POST['std_group'] == 5))
        {
            $sub7 = @$_POST['sub7'];
            $sub7ap1 = 1;
        }
        else
        {
            $sub7 = 0;   
            $sub7ap1 = 0; 
        }

        // DebugBreak();
        if(@$_POST['OldBrd'] == 1)
        {
            $nationality_hidden = @$_POST['nationality_hidden'];
            $gender = $this->input->post('gender');
        }
        else
        {
            $nationality_hidden =@$_POST['nationality'];
            $gender = $this->input->post('ogender');
        }
        //nationality_hidden
        $addre =  str_replace("'", "", $this->input->post('address'));
        $addre = preg_replace('/[^\x20-\x7E]/','', $addre);
        $MarkOfIden =  str_replace("'", "", $this->input->post('MarkOfIden'));
        $MarkOfIden = preg_replace('/[^\x20-\x7E]/','', $MarkOfIden);
        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'bFormNo' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'dob' =>$this->input->post('dob'),
            'dist' =>$this->input->post('pvtinfo_dist'),
            'teh' =>$this->input->post('pvtinfo_teh'),
            'zone' =>$this->input->post('pvtZone'),
            'MobNo' =>$this->input->post('mob_number'),
            'medium' =>$this->input->post('medium'),
            'Inst_Rno' =>$this->input->post('Inst_Rno'),
            'markOfIden' =>$MarkOfIden,
            'Speciality' =>$this->input->post('speciality'),
            'IsPakistani' =>$nationality_hidden,
            'sex' =>$gender,
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
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
            'isRural' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>(999999),
            'FormNo' =>(''),
            'old_RNo'=>$this->input->post('iOldRno'),
            'old_year'=>$this->input->post('iOldYear'),
            'old_sess'=>$this->input->post('iOldSess'),
            'SSC_RNo'=>$this->input->post('OldRno'),
            'SSC_Year'=>$this->input->post('OldYear'),
            'SSC_Sess'=>$this->input->post('OldSess'),
            'SSC_brd_cd'=>$this->input->post('OldBrd'),
            'picname'=>$this->input->post('picname'),
            'IsReAdm'=>0  ,
        );

        $logedIn = $this->Admission_11th_Pvt_model->Insert_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        //$error = $logedIn[0]['error'];


        $info =  '';
        foreach($logedIn[0] as $key=>$val)
        {
            if($key == 'formno')
            {
                $oldpath =  GET_PRIVATE_IMAGE_PATH.'\11th\\'.$logedIn[0]['tempath'];
                $newpath =  GET_PRIVATE_IMAGE_PATH.'\11th\\'.$val.'.jpg';
                $err = rename($oldpath,$newpath);
                $info['error'] = 1;
                $info['formno'] = $val;
            }
            else if($key == 'error')
            {
                $info['error'] = $val;
                $info['formno'] = '';
            }
        }

        echo  json_encode($info);
    }
    public function NewEnrolment_insert_lang()
    {
        $this->load->model('Admission_11th_Pvt_model');
        $this->load->library('session');
        $error = array();


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


        $sub7 = 0;   
        $sub7ap1 = 0; 
        $nationality_hidden =@$_POST['nationality'];
        $gender = $this->input->post('ogender');
        //  DebugBreak();
        if(@$_POST['isAlreadyApplied']==true)
        {
            $oldrno = @$_POST['old_rno_lang'];
            $oldyear = @$_POST['old_year_lang'];
            $oldsess = @$_POST['old_sess_lang'];
            $oldbrd = 1;
            $isAlreadyapplied = 1;


        }
        else
        {
            $oldrno = false;
            $oldyear = false;
            $oldsess = false;
            $oldbrd = 0;
            $isAlreadyapplied = 0;
        }
        //nationality_hidden
        $addre =  str_replace("'", "", $this->input->post('address'));
        $addre = preg_replace('/[^\x20-\x7E]/','', $addre);
        $MarkOfIden =  str_replace("'", "", $this->input->post('MarkOfIden'));
        $MarkOfIden = preg_replace('/[^\x20-\x7E]/','', $MarkOfIden);
        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'bFormNo' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'dob' =>$this->input->post('dob'),
            'dist' =>$this->input->post('pvtinfo_dist'),
            'teh' =>$this->input->post('pvtinfo_teh'),
            'zone' =>$this->input->post('pvtZone'),
            'MobNo' =>$this->input->post('mob_number'),
            'medium' =>$this->input->post('medium'),
            'Inst_Rno' =>$this->input->post('Inst_Rno'),
            'markOfIden' =>$MarkOfIden,
            'Speciality' =>$this->input->post('speciality'),
            'IsPakistani' =>$nationality_hidden,
            'sex' =>$gender,
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
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
            'isRural' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>(999999),
            'FormNo' =>(''),
            'old_RNo'=>$oldrno,
            'old_year'=>$oldyear,
            'old_sess'=>$oldsess,
            'picname'=>$this->input->post('picname'),
            'IsReAdm'=>$isAlreadyapplied,
            'lang_cat' =>$this->input->post('lang_cat'),
            'lang_specialSub' =>$this->input->post('lang_specialSub'),

        );

        $logedIn = $this->Admission_11th_Pvt_model->Insert_NewEnorlement_lang($data);//, $fname);//$_POST['username'],$_POST['password']);
        //$error = $logedIn[0]['error'];

        $info =  '';
        foreach($logedIn[0] as $key=>$val)
        {
            if($key == 'formno')
            {
                $oldpath =  GET_PRIVATE_IMAGE_PATH.'\11th\\'.$logedIn[0]['tempath'];
                $newpath =  GET_PRIVATE_IMAGE_PATH.'\11th\\'.$val.'.jpg';
                $err = rename($oldpath,$newpath);
                $info['error'] = 1;
                $info['formno'] = $val;
            }
            else if($key == 'error')
            {
                $info['error'] = $val;
                $info['formno'] = '';
            }
        }

        echo  json_encode($info);
    }
    public  function GetSpeciality($spclty)
    {
        if ($spclty == 0 )
            return('NONE');
        else if ($spclty == 2 )
            return('BOARD EMPLOYEE CHILD');
            else if ($spclty == 3 )
                return('BLIND');
                else if ($spclty == 1 )
                    return('DEAF AND DUMB');


    }
      function GetDueDate()
    {
      //  DebugBreak();

        $dueDate='';
        $single_date= SingleDateFee;  $double_date= DoubleDateFee;  $tripple_date= TripleDateFee;
        //$today = date("d-M-Y");

        $today = date("d-m-Y");

        if(strtotime($today) <= strtotime($single_date)) 
        {
            $dueDate = $single_date;
        }
        elseif(strtotime($today) > strtotime($single_date) && strtotime($today) <= strtotime($double_date) )
        {
            $dueDate = $double_date;
        }
        elseif(strtotime($today) > strtotime($double_date) && strtotime($today) <= strtotime($tripple_date) )
        {
            $dueDate = $tripple_date;
        }
        elseif(strtotime($today) > strtotime($tripple_date) )
        {
            $dueDate = $today;
        }
        return $dueDate;

    }
    public function checkFormNo_then_download()
    {
        $formno_seg = $this->uri->segment(3);
        // $dob_seg = $this->uri->segment(4);
        if($formno_seg !=0 ){ //&& $dob_seg != ''
            $formno = $formno_seg;     
            //$dob = $dob_seg;
        }
        else{
            return true;
        }
        $this->load->model('Admission_11th_Pvt_model');
        $this->load->library('session');
        // DebugBreak();
        $data = $this->Admission_11th_Pvt_model->get_formno_data($formno);
        if($data == false)
        {
            $error = 'No Data Exist againt '.$formno.' Form No. Please check it again.';
            $this->session->set_flashdata('downerror',$error);
            redirect('Admission_11th_pvt');
            return;
        }

        // --------------------------------------- Fee Calculation Section ------------------------------------------------
        //  DebugBreak();


        $data = $data[0];



        // --------------------------------------- Fee Calculation Section END------------------------------------------------
         //DebugBreak();

        $mydata_final = $this->feecalculate($data);
        $mydata_final = $mydata_final[0];

        $this->load->library('NumbertoWord');
        $this->load->library('PDF_Rotate');
        $pdf = new PDF_Rotate('P','in',"A4");

        $fee =      "1500";      
        $AfterDueDatefee = "0";
        $AdmFee=         "800";  

        
        
        $endDate =date('d-m-Y', strtotime($this->GetDueDate())); 

        $lmargin =1.5;
        $rmargin =7.3;
        $pdf->SetAutoPageBreak(true);
        //$pdf ->SetRightMargin(5);
        $pdf->AddPage();
        $Y = 0;

        $fontSize = 8; 
        $marge    = .4;   // between barcode and hri in pixel
        $bx        = 3.97;  // barcode center
        $by        = .75;  // barcode center
        $height   = 0.35;   // barcode height in 1D ; module size in 2D
        $width    = .0135;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = $data['coll_cd'];     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex

        //$pdf->Open();
        // $pdf->SetMargins(25.4,25.4,25.4,25.4);
        //$pdf ->SetMargins($lmargin,1.5,5.5);





        if(@$data["Spec"] >0)
        {
            $RegFee = 0; 
        }

        // DebugBreak();


        $pdf->SetFillColor(0,0,0);
        $pdf->SetDrawColor(0,0,0); 

        $temp = $data['FormNo'].'@11@'.Session.'@'.Year; 
        $image =  $this->set_barcode($temp);
        $pdf->Image(BARCODE_PATH.$image,3.3, 0.6  ,2,0.25,"PNG");
        //$pdf->Image(BARCODE_PATH.$image,5.7, 6.0  ,2,0.25,"PNG");
        $pdf->Image(BARCODE_PATH.$image,5.7, 7.44  ,2,0.25,"PNG");
        $pdf->Image(BARCODE_PATH.$image,5.7, 8.83  ,2,0.25,"PNG");
        $pdf->Image(BARCODE_PATH.$image,5.7, 10.43 ,2,0.25,"PNG");

        //$pdf->PrintBarcode(3.75,0.6,(int)$Barcode,.3,.0199);
        if(Session == 1)
        {
            $ses = "ANNUAL";
        }
        else{
            $ses = "SUPPLYMENTARY";
        }

        if($data["grp_cd"] == 9)
        {
            $heading = 'BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA ( LANGUAGES EXAMINATION, '.Year.')';
        }
        else
        {
            $heading = 'BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA (INTERMEDIATE PART-I '.$ses.' EXAMINATION, '.Year.')';
        }

        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(1.2,0.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
        $pdf->Image("assets/img/logo2.png",.60,0.3, 0.65,0.65, "PNG");
        // $pdf->Image("assets/img/ExamCenter.jpg",4.5,2.90, 2.78,0.15, "jpeg");  
        if($data["grp_cd"] != 9)
        {      
            $pdf->Image("assets/img/11th.png",7.6,0.19,  0.40,0.40, "PNG");
            $pdf->Image("assets/img/11th.png",7.7,7.40,  0.30,0.30, "PNG");      
            $pdf->Image("assets/img/11th.png",7.7,8.80,  0.30,0.30, "PNG");   
            $pdf->Image("assets/img/11th.png",7.7,10.42,  0.30,0.30, "PNG");   
        }
        else
        {
            $pdf->Image("assets/img/aloom.JPG",7.55,0.2,  0.50,0.40, "JPG");
            $pdf->Image("assets/img/aloom.JPG",7.7,7.28,  0.50,0.40, "JPG");      
            $pdf->Image("assets/img/aloom.JPG",7.7,8.89,  0.50,0.40, "JPG");   
            $pdf->Image("assets/img/aloom.JPG",7.7,10.28,  0.50,0.40, "JPG");
        }
        //$this->Image("logo.jpg",0.05,0.3, 0.75,0.75, "JPG", "http://www.biseGujranwala.edu.pk");

        $pdf->SetFont('Arial','',9);

        if($data["grp_cd"] == 9)
        {
            $pdf->SetXY(2.0,0.4);
            $pdf->Cell(0, 0.2, "ADMISSION & REVENUE FORM FOR LANGUAGES EXAMINATION , ".Year, 0.25, "C");
        }
        else
        {
            $pdf->SetXY(1.4,0.4);
            $pdf->Cell(0, 0.2, "ADMISSION & REVENUE FORM FOR THE INTERMEDIATE (PART I) ".$ses." EXAMINATION , ".Year, 0.25, "C");
        }

        //--------------- Proof Read    
        /*if($data['batch_id'] == 0 and $data['RegPvt']==1)
        {
        $pdf->Image( 'images/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG");     
        $ProofReed = "(PROOF READ) (Not for Board) ";
        $pdf->SetXY(3.3,0.8);
        $pdf->SetFont("Arial",'',8);
        $pdf->Cell(0, 0.25, $ProofReed   ,0,'C');
        } */




        /*$pdf->SetFont('Arial','B',10);
        $pdf->SetXY(3.5,0.6);
        $pdf->Cell(0, 0.25, $data['RegPvt']==1?"(Regular Admission Form)":"(Private Admission Form)", 0.25, "C");*/

        //--------------------------- Form No & Rno



        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(5.8,0.80+$Y);
        $pdf->Cell(0,0.1, "Roll No: _______________",0,'L');    
        $pdf->SetFont('Arial','B',7);
        $pdf->SetXY(6.6,.95+$Y);
        $pdf->Cell(0.0,0.1, "(For office use only)",0,'L');



        $pdf->Image(GET_PRIVATE_IMAGE_PATH.'11th\\'. @$data["PicPath"],6.5, 1.10+$Y, 0.95, 1.0, "JPG");
        $pdf->SetFont('Arial','',10);




        //------------- Personal Infor Box
        //====================================================================================================================


        $Y = -0.6;
        $FontSize=8;
        $HeightLine1= 1.75;
        $HeightLine2=2.0;

        $grp_name = $data["grp_cd"];
        switch ($grp_name) {
            case '1':
                $grp_name = 'PRE-MEDICAL';
                break;
            case '2':
                $grp_name = 'PRE-ENGINEERING';
                break;
            case '3':
                $grp_name = 'HUMANITIES';
                break;
            case '4':
                $grp_name = 'GENERAL SCIENCE';
                break;
            case '5':
                $grp_name = 'COMMERCE';
                break;
            case '6':
                $grp_name = 'HOME ECONOMICS';
                break;
            case '9':
                $grp_name = 'ALOOM-E-SHARKIA';
                break; 
            case '7':
                $grp_name = 'HOME ECONOMICS';
                break; 

            default:
                $grp_name = "NO GROUP SELECTED.";
        }

        $pdf->SetXY(3.33,1.60+$Y);
        $pdf->SetFont('Arial','b',12);
        if($data["grp_cd"] == 9)
        {
            $pdf->Cell( 0.0,0.0,"(ALOOM-E-SHARQIA)",0,'C');
            $pdf->Image("assets/img/aloom.JPG",3.73,1.07,  1.0,0.350, "JPG");
        }
        else
        {
            $pdf->Cell( 0.0,0.0,"(PRIVATE CANDIDATE)",0,'C');
        }



        $myx = 0.7;

        //--------------------------- 1st line 
        $pdf->SetXY($myx+.8,1.4+$Y);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell( 0,0,"Form No: ".$data['FormNo'],0,'L');



        $col2 =  1.6;

        $pdf->SetXY($myx,1.75+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.1,0,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY($col2,1.75+$Y);
        $pdf->Cell(0.1,0,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY($myx, 1.92+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.1,0,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY($col2,1.92+$Y);
        $pdf->Cell(0.1,0,$data["Fname"],0,'L');

        //--------------------------- 3rd line 
        //__Mobile    
        /* $pdf->SetXY(3.5+$x,2.65+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Mobile No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.65+$Y);
        $pdf->Cell(0.5,0.5,$data["mobNo"],0,'L');   */


        $x = 0;
        $pdf->SetXY($myx,2.1+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell(0.1,0,"Father CNIC:",0,'R');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY($col2,2.1+$Y);
        $pdf->Cell(0.1,0,$data["FNIC"],0,'L');

        $pdf->SetXY(3.5+$x,2.1+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.1,0,"Speciality:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.1+$Y);
        $pdf->Cell(0.1,0,$this->GetSpeciality($data["Spec"]),0,'L');



        $pdf->SetXY($myx,2.27+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.1,0,"Religion:",0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY($col2,2.27+$Y);
        $pdf->Cell(0.1,0,$data["rel"]==1?"MUSLIM":"NON-MUSLIM",0,'L');  


        $pdf->SetXY(3.5+$x,2.27+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.1,0,"Registration No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.27+$Y);
        $pdf->Cell(0.1,0,'',0,'L');

        //debugbreak();
        //--------------------------- Dob line 
        /* $pdf->SetXY($myx,2.05+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Date Of Birth:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,2.05+$Y);
        $pdf->Cell(0.5,0.5,date('d-m-Y',strtotime(@$data["Dob"])),0,'L');*/

        $pdf->SetXY($myx,2.36+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell( 0,0.1,"Nationality:",0,'R');
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($col2,2.36+$Y);
        $pdf->Cell(0,0.1,$data["nat"]==1?"PAKISTANI":"NON-PAKISTANI",0,'R');

        $pdf->SetXY(3.5,2.36+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0.1,"Cell No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.36+$Y);
        $pdf->Cell(0,0.1,@$data["MobNo"],0,'L');

        // DebugBreak();
        $data["sessOfPass"]==1? $sess = "ANNUAL":$sess = "SUPPLY";
        $data['oldSess_reg'] ==1? $sess_lang = "ANNUAL":$sess_lang = "SUPPLY";
        $ssc_info  = $data["matRno"].' ('.$sess.', '.$data['yearOfPass'].', '.$data['Brd_Abbr'].' )';
        if($data['IsReAdm']==1 && $data['IsLangexam']==1)
        {
            $lang_info = $data['oldRno_reg'].' ('.$sess_lang.', '.$data['oldYear_reg'].', BISE, Gujranwala )';
            $ssc_info  = "";
        }
        else
        {
            $lang_info = "";
        }

        if($data['IsLangexam']==1)
        {
            $ssc_info  = "";
        }


        $pdf->SetXY($myx,2.53+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell( 0,0.1,"SSC Exam Info:",0,'L');
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($col2,2.53+$Y);
        $pdf->Cell(0,0.1,$ssc_info,0,'L');


        $pdf->SetXY($myx,2.82+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell( 0.0,0.1,"Address:",0,'L');
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($col2,2.82+$Y);
        $pdf->Cell(0.0,0.1,$data["addr"],0,'L');

        $pdf->SetXY($myx,2.98+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell( 0,0.1,"Perv. Exam Info:",0,'L');
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($col2,2.98+$Y);
        $pdf->Cell(0,0.1,$lang_info,0,'R');

        $pdf->SetXY(0.7,3.12+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,0.1,"Proposed Exam Area:",0,'L');
        $pdf->SetFont('Arial','B',7);
        $pdf->SetXY(1.8,3.12+$Y);
        $pdf->Cell( 0,0.1,$data['zone_cd']." - ".$data['zone_name']."",0,'L');

        if($data["grp_cd"] == 9)
        {
            if($data['Lang_cat']==5)
            {
                $catname_lang = "ADEEB  ARABIC";
            }
            else if($data['Lang_cat']==6)
            {
                $catname_lang = "ADEEB  URDU";
            }

            else if($data['Lang_cat']==1)
            {
                $catname_lang = "FAZAL  ARABIC";
            }
            else if($data['Lang_cat']==2)
            {
                $catname_lang = "FAZAL  URDU";
            }
            else if($data['Lang_cat']==3)
            {
                $catname_lang = "FAZAL PUNJABI";
            }

        }





        // Adeeb urdu
        if($data["grp_cd"] == 9 && $data['Lang_cat']==5 )
        {
            $pdf->Image("assets/img/examaloomsharkia.JPG",3.83,2.75,  2.0,0.40, "JPG");
            $pdf->Image("assets/img/adeeburdu.JPG",2.73,2.75,  1.0,0.40, "JPG");
        }
        // Adeeb Arabic
        else if ($data["grp_cd"] == 9 && $data['Lang_cat']==6 )
        {
            $pdf->Image("assets/img/examaloomsharkia.JPG",3.83,2.75,  2.0,0.40, "JPG");
            $pdf->Image("assets/img/adeebarbic.JPG",2.73,2.75,  1.0,0.40, "JPG");
        }
        // Fazal Arabic
        else if ($data["grp_cd"] == 9 && $data['Lang_cat']==1 )
        {
            $pdf->Image("assets/img/examaloomsharkia.JPG",3.83,2.75,  2.0,0.40, "JPG");
            $pdf->Image("assets/img/fazilarabic.JPG",2.73,2.75,  1.0,0.40, "JPG");
        }
        // Fazal Urdu
        else if($data["grp_cd"] == 9 && $data['Lang_cat']==2 )
        {
            $pdf->Image("assets/img/examaloomsharkia.JPG",3.83,2.75,  2.0,0.40, "JPG");
            $pdf->Image("assets/img/fazilurdu.JPG",2.73,2.75,  1.0,0.40, "JPG");
        }
        // Fazal Punjabi
        else if($data["grp_cd"] == 9 && $data['Lang_cat']==3 )
        {
            $pdf->Image("assets/img/examaloomsharkia.JPG",3.83,2.75,  2.0,0.40, "JPG");
            $pdf->Image("assets/img/fazilpunjabi.JPG",2.73,2.75,  1.0,0.40, "JPG");
        }


        $pdf->SetXY($myx,3.58+$Y);
        $pdf->SetFont('Arial','b',10);
        if($data["grp_cd"] == 9)
        {
            $pdf->Cell( 0,0.1,"Group:".$catname_lang,0,'L');
        }
        else
        {
            $pdf->Cell( 0,0.1,"Group:".$grp_name."",0,'L');
        }






        $pdf->SetFont('Arial','B',$FontSize-.5);
        $pdf->SetXY(6.8,2.74+$Y);                                               
        $pdf->Cell(0,0.1,$data["sex"]==1?"MALE":"FEMALE",0,'L');

        $pdf->SetFont('Arial','B',$FontSize+15);
        $pdf->TextWithRotation($x+.55,2.8+$Y, $data['FormNo'],90,0); 





        //--------------------------- Speciality and Internal Grade 

        /*$pdf->SetXY(3.5+$x,2.5+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Scheme:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.5+$Y);
        $pdf->Cell(0.5,0.5, ($data["schm"]==1? "NEW": "OLD"),0,'L');    */        

        // DebugBreak();
        //DebugBreak();
        $xx= 0.8;
        $boxWidth = 3.0;
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($xx,3.8+$Y);
        $pdf->SetFillColor(240,240,240);


        if($data["grp_cd"] == 9)
        {

            $pdf->Cell($boxWidth,0.2,"PAPER'S: ",1,0,'C',1);
        }
        else
        {
            $pdf->Cell($boxWidth,0.2,'Subjects:Part - I ',1,0,'C',1);
        }

        $pdf->SetFillColor(255,255,255);

        //$pdf->Cell($boxWidth,0.2, $data['sub1Ap1'] != 1 ? '':   '    '. GetSubNameHere($data['sub1']) ,0,'L',1);
        // DebugBreak();
        $pdf->Image("assets/img/crossed.jpg",4.8,4.73, 1.3,0.15, "jpeg");  

        $pdf->SetXY(4.8,3.8+$Y);
        $pdf->Cell(1.4,1.5,'',1,0,'C',0); 
        $pdf->SetXY(5,3.8+$Y);
        $pdf->MultiCell(1.1,0.2, 'Paste Recent Photograph',0,'C'); 

        $pdf->SetXY(6.78,3.8+$Y);
        $pdf->Cell(1.1,1.3,'',1,0,'C',0); 
        $pdf->SetXY(6.78,4.90+$Y);
        $pdf->MultiCell(1.1,0.2, 'Thumb Impression',0,'C'); 





        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.0+$Y);
        if($data["grp_cd"] == 9)
        {
            $pdf->Cell($boxWidth,0.2,$data['sub1Ap1'] != 1 ? '':   '    '.'1. PAPER-I',1,0,'L',1);
        }
        else
        {
            $pdf->Cell($boxWidth,0.2,$data['sub1Ap1'] != 1 ? '':   '    '.'1. '.$data['sub1_name'],1,0,'L',1);
        }


        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.2+$Y);
        if($data["grp_cd"] == 9)
        {
            $pdf->Cell($boxWidth,0.2,$data['sub2Ap1'] != 1 ? '':   '    '.'2. PAPER-II',1,0,'L',1);
        }
        else
        {
            $pdf->Cell($boxWidth,0.2,$data['sub2Ap1'] != 1 ? '':   '    '.'2. '. $data['sub2_name'],1,0,'L',1);
        }


        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.4+$Y);
        if($data["grp_cd"] == 9)
        {
            $pdf->Cell($boxWidth,0.2,$data['sub3Ap1'] != 1 ? '':   '    '.'3. PAPER-III',1,0,'L',1);
        }
        else
        {
            $pdf->Cell($boxWidth,0.2,$data['sub3Ap1'] != 1 ? '':   '    '.'3. '. $data['sub3_name'],1,0,'L',1);
        }


        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.6+$Y);
        if($data["grp_cd"] == 9)
        {
            $pdf->Cell($boxWidth,0.2,$data['sub4Ap1'] != 1 ? '':   '    '.'4. PAPER-IV',1,0,'L',1);
        }
        else
        {
            $pdf->Cell($boxWidth,0.2,$data['sub4Ap1'] != 1 ? '':   '    '.'4. '. $data['sub4_name'],1,0,'L',1);
        }


        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.8+$Y);
        if($data["grp_cd"] == 9)
        {
            $pdf->Cell($boxWidth,0.2,$data['sub5Ap1'] != 1 ? '':   '    '.'5. PAPER-V',1,0,'L',1);
        }
        else
        {
            $pdf->Cell($boxWidth,0.2,$data['sub5Ap1'] != 1 ? '':   '    '.'5. '. $data['sub5_name'],1,0,'L',1);
        }


        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,5.0+$Y);
        if($data["grp_cd"] == 9)
        {
            $pdf->Cell($boxWidth,0.2,$data['sub6Ap1'] != 1 ? '':   '    '.'6. PAPER-VI',1,0,'L',1);
        }
        else
        {
            $pdf->Cell($boxWidth,0.2,$data['sub6Ap1'] != 1 ? '':   '    '.'6. '. $data['sub6_name'],1,0,'L',1);
        }


        $pdf->SetFont('Arial','',7);                                                                     
        $pdf->SetXY($xx,5.2+$Y);
        if($data["grp_cd"] == 5)
        {
            $pdf->Cell($boxWidth,0.2,$data['sub7Ap1'] != 1 ? '':   '    '.'7. '. $data['sub7_name'],1,0,'L',1);
        }





        $pdf->SetXY(0.7,5.49+$Y);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,0.1,"Affidavit:-",0,'L');
        $pdf->SetXY(0.7,5.6+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->MultiCell(7.3,0.15, "I have read this admission form/instructions. The data/information on this form and in online system is same as last entered/modified/provided by me and it's correctness is only my responsibility. I understand that only the information/data provided in the online system along with the photograph and some other handwritten details on this form will be used for further processing. I accept all the terms and conditions in this regard.",0,'L'); 



        // DebugBreak();
        $stampx = 3.4;
        $stampy = 5.2;

        $pdf->Image("assets/img/admission_form.jpg",4.07,2.33, 3.98,0.40, "jpeg");                

        $candidatex = 0.7;

        $pdf->SetXY($candidatex,6.2+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0,0,"Candidate's Signature in Urdu______________________",0,'R');
        $pdf->SetXY($candidatex,6.45+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0,0,"Candidate's Signature in English____________________",0,'R');

        $Y =  $Y +.28;

        $pdf->SetXY($stampx,5.80+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell(0,0.1,"Stamp/Signature",0,'R');
        $pdf->SetXY($stampx,6.0+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,0.1,"Headmaster/Headmistress/Principal",0,'R');
        $pdf->SetXY($stampx,6.15+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,0.1,"Name Head Of Institute",0,'R');
        $pdf->SetXY($stampx,6.3+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,0.1,"School/College Code",0,'R');
        $pdf->SetXY($stampx,6.45+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,0.1,"CNIC",0,'R');

        $pdf->SetXY(6.5,5.82+$Y);
        $pdf->Cell(1.5,.8,'',1,0,'C',0); 

        $pdf->SetFont('Arial','B',16);
        $pdf->SetXY(6.6,6.4+$Y);
        $pdf->MultiCell(0,0.2, 'O.W.O',0,'C'); 


        $boxWidth = 2.0;
        $Y =  $Y -.28;
        $Y  = $Y +.33;


        $pdf->SetXY($myx,6.6+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$endDate,1,0,'C',1); 
        /*
        $pdf->SetXY(3.2,6.45+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(0.5,0.5,"(To be sent to the Board via HBL Branch)",0,'L');   */
        $bx = 6.82;
        $by = 6.1;
        //$Barcode =  @$data['FormNo']."@".$data['class']."@".$data["sess"]."@".$data['Iyear'];
        //$data['formid']."@".$data['Class'].$data['Sess'].$data["Iyear"];

        /*$bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);    */

        //$pdf->PrintBarcode(5.75,5.9,(int)$Barcode,.3,.0199);



        $pdf->SetXY($myx+2,6.70+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0,0,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(4.6, 6.70+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(6.7, 6.70+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Bank Challan No. ".$data['FormNo'],0,'L');


        $pdf->SetXY($myx,6.85+$Y);
        $pdf->SetTextColor(0,0,0);

        $Y  = $Y -0.20;
        $pdf->SetXY($myx, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Admission Fee ",0,'L');


        $pdf->SetXY(1.8, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$mydata_final['AdmFee'].'/-',0,'L');


        $pdf->SetXY(2.4, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Late Fee ",0,'L');


        $pdf->SetXY(3.1, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        //$pdf->Cell( 0.5,0.5,$AfterDueDatefee.'/-',0,'L');
        $pdf->Cell( 0,0,$mydata_final['AdmFine'].'/-',0,'L');


        $pdf->SetXY(3.8, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Processing Fee ",0,'L');
        $pdf->SetXY(4.9, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$mydata_final['AdmProcessFee'].'/-',0,'L');


        $pdf->SetXY(5.4, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Registration Fee ",0,'L');
        $pdf->SetXY(6.3, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$mydata_final['regFee'].'/-',0,'L');
        // DebugBreak();
        if($data['grp_cd']==9)
        {
            $pdf->SetXY(6.8, 7.09+$Y);
            $pdf->SetFont('Arial','',$FontSize);
            $pdf->Cell( 0,0,"Cert Fee ",0,'L');
            $pdf->SetXY(7.4, 7.09+$Y); 
            $pdf->SetFont('Arial','b',$FontSize);
            $pdf->Cell( 0,0,@$mydata_final['CertFee'].'/-',0,'L');
        }


        $pdf->SetXY($myx, 7.25+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Total Amount Rs.",0,'L');
        //DebugBreak();
        $total = @$mydata_final['AdmTotalFee'] ;
        $pdf->SetXY(1.8, 7.25+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0,0,$total.'/-',0,'L');



        $pdf->SetXY(2.4, 7.25+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Amount in Words:",0,'L');

        //DebugBreak();

        $obj    = new NumbertoWord();
        $obj->toWords($total,"Only.","");
        $feeInWords = ucwords($obj->words);

        $pdf->SetXY(3.38, 7.25+$Y);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell( 0,0,$feeInWords,"",0,'L');

        $pdf->SetXY(5.92, 7.38+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Manager/Cashier:____________________ ",0,'L');

        //$pdf->SetXY(0,5.0+3.0+$Y);
        // $pdf->SetFont('Arial','',10);

        $pdf->Image("assets/img/cutter.jpg",0.14,7.1, 8.02,0.09, "jpeg");  

        //$pdf->Cell(0,0.5,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,'L');

        $Y= 8.65;
        //

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(.2,$Y);
        $pdf->Cell(0, 0.2, $heading, 0.25, "C");

        $pdf->SetFont('Arial','B',8.8);
        $pdf->SetXY($myx-.01,.3+$Y);
        $pdf->Cell(0,0,'Board Copy (Along with Scroll) ',0,0,'L',0); 

        $pdf->SetXY($myx,.43+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$endDate,1,0,'C',1); 
        $pdf->SetXY($myx+2,.53+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0,0,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(4.6, .53+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(6.7, .53+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Bank Challan No. ".$data['FormNo'],0,'L');




        $pdf->SetXY($myx, .73+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Form No. ",0,'L');


        $pdf->SetXY(1.8, .73+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$data["FormNo"],0,'L');


        $pdf->SetXY(2.4, .73+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Name: ",0,'L');


        $pdf->SetXY(2.8, .73+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        //$pdf->Cell( 0.5,0.5,$AfterDueDatefee.'/-',0,'L');
        $pdf->Cell( 0,0,$data["name"],0,'L');


        $pdf->SetXY(4.9, .73+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Father Name: ",0,'L');
        $pdf->SetXY(5.6, .73+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$data["Fname"],0,'L');



        $pdf->SetXY($myx, .93+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Admission Fee ",0,'L');


        $pdf->SetXY(1.8, .93+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$mydata_final['AdmFee'].'/-',0,'L');


        $pdf->SetXY(2.4, .93+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Late Fee ",0,'L');


        $pdf->SetXY(3.1, .93+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        //$pdf->Cell( 0.5,0.5,$AfterDueDatefee.'/-',0,'L');
        $pdf->Cell( 0,0,$mydata_final['AdmFine'].'/-',0,'L');


        $pdf->SetXY(3.8, .93+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Processing Fee ",0,'L');
        $pdf->SetXY(4.9, .93+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$mydata_final['AdmProcessFee'].'/-',0,'L');


        $pdf->SetXY(5.4, .93+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Registration Fee ",0,'L');
        $pdf->SetXY(6.3, .93+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$mydata_final['regFee'].'/-',0,'L');

        if($data['grp_cd']==9)
        {
            $pdf->SetXY(6.8, .93+$Y);
            $pdf->SetFont('Arial','',$FontSize);
            $pdf->Cell( 0,0,"Cert Fee ",0,'L');
            $pdf->SetXY(7.4,.93+$Y); 
            $pdf->SetFont('Arial','b',$FontSize);
            $pdf->Cell( 0,0,@$mydata_final['CertFee'].'/-',0,'L');
        }


        $pdf->SetXY($myx, 1.2+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Total Amount Rs.",0,'L');
        $pdf->SetXY(1.8, 1.2+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0,0,$total.'/-',0,'L');



        $pdf->SetXY(2.4, 1.2+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Amount in Words:",0,'L');
        $pdf->SetXY(3.38, 1.2+$Y);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell( 0,0,$feeInWords,"",0,'L');

        $pdf->SetXY(5.92, 1.3+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Manager/Cashier:____________________ ",0,'L');



        $pdf->Image("assets/img/cutter.jpg",0.14,8.5, 8.02,0.09, "jpeg");  

           $Y= 5.65;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(.2,1.58+$Y);
        $pdf->Cell(0, 0.2, $heading, 0.25, "C");

        $pdf->SetFont('Arial','B',8.8);
        $pdf->SetXY($myx-.01,1.89+$Y);
        $pdf->Cell(0,0,'Bank Copy ',0,0,'L',0); 

        $pdf->SetXY($myx,1.99+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$endDate,1,0,'C',1); 

        $pdf->SetXY($myx+2,2.1+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0,0,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(4.6, 2.1+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(6.7, 2.1+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Bank Challan No. ".$data['FormNo'],0,'L');

        $pdf->SetXY($myx, 2.3+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Form No. ",0,'L');
        $pdf->SetXY(1.8, 2.3+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$data["FormNo"],0,'L');


        $pdf->SetXY(2.4, 2.3+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Name: ",0,'L');
        $pdf->SetXY(2.8, 2.3+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$data["name"],0,'L');


        $pdf->SetXY(4.9, 2.3+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Father Name: ",0,'L');
        $pdf->SetXY(5.6, 2.3+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$data["Fname"],0,'L');

        $pdf->SetXY($myx, 2.5+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Total Amount Rs.",0,'L');
        $pdf->SetXY(1.8, 2.5+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0,0,$total.'/-',0,'L');



        $pdf->SetXY(2.4, 2.5+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Amount in Words:",0,'L');
        $pdf->SetXY(3.38, 2.5+$Y);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell( 0,0,$feeInWords,"",0,'L');

        $pdf->SetXY(5.92, 2.7+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Manager/Cashier:____________________ ",0,'L');
        $pdf->Image('assets/img/BankCopy.jpg',.80,8.23, 4.95,0.25, "jpeg");  

        $pdf->Image("assets/img/cutter.jpg",0.14,10.1, 8.02,0.09, "jpeg"); 

    $Y= 7.27;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(.2,3+$Y);
        $pdf->Cell(0, 0.2, $heading, 0.25, "C");

        $pdf->SetFont('Arial','B',8.8);
        $pdf->SetXY($myx-.01,3.28+$Y);
        $pdf->Cell(0,0,'Candidate Copy ',0,0,'L',0); 

        $pdf->SetXY($myx,3.38+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$endDate,1,0,'C',1); 

        $pdf->SetXY($myx+2,3.50+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0,0,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(4.6, 3.50+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(6.7, 3.50+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Bank Challan No. ".$data['FormNo'],0,'L');

        $pdf->SetXY($myx, 3.65+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Form No. ",0,'L');
        $pdf->SetXY(1.8, 3.65+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$data["FormNo"],0,'L');


        $pdf->SetXY(2.4, 3.65+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Name: ",0,'L');
        $pdf->SetXY(2.8, 3.65+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$data["name"],0,'L');


        $pdf->SetXY(4.9, 3.65+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Father Name: ",0,'L');
        $pdf->SetXY(5.6, 3.65+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$data["Fname"],0,'L');

        $pdf->SetXY($myx, 3.75+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Total Amount Rs.",0,'L');
        $pdf->SetXY(1.8, 3.75+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0,0,$total.'/-',0,'L');

        $pdf->SetXY(2.4, 3.75+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Amount in Words:",0,'L');
        $pdf->SetXY(3.38, 3.75+$Y);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell( 0,0,$feeInWords,"",0,'L');

        $pdf->SetXY(5.92,4.1+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Manager/Cashier:____________________ ",0,'L');

        $pdf->Image('assets/img/CandidateCopy.jpg',0.27,11.07, 5.6,0.43, "jpeg");  


        //$filename="Admission_Forms_". $form_No."_"   .  ".pdf";    
        $pdf->Output();
        //$pdf->Output($filename,'D');

    }
    function feecalculate($data)
    {
       // DebugBreak();
        $isper = 0;

        $practical_Sub = array(
            'LIBRARY SCIENCE'=>'8',
            'GEOGRAPHY'=>'12',
            'PSYCHOLOGY'=>'16',
            'STATISTICS'=>'18',
            'OUTLINES OF HOME ECONOMICS'=>'21',
            'FINE ARTS'=>'23',
            'COMMERCIAL PRACTICE'=>'38',
            'HEALTH & PHYSICAL EDUCATION'=>'42',
            'BIOLOGY'=>'46',
            'PHYSICS'=>'47',
            'CHEMISTRY'=>'48',
            'COMPUTER SCIENCE'=>'83',
            'NURSING'=>'79',
            'AGRICULTURE'=>'90',
            'TYPING'=>'96',
            'COMPUTER STUDIES'=>'98',
            'CLOTHING & TEXTILE (Home-Economics Group)'=>'75',
            'HOME MANAGEMNET (Home-Economics Group)'=>'76'
        );
        $isper = 0;
    if( $data['grp_cd'] == 1 || $data['grp_cd'] == 2 || $data['grp_cd'] == 4 ||   array_search($data['sub4'],$practical_Sub) || array_search($data['sub5'],$practical_Sub) || array_search($data['sub6'],$practical_Sub) ||  array_search($data['sub7'],$practical_Sub))
    {
         $isper = 1;
    }
       
        
        
        $User_info_data = array('Inst_Id'=>999999, 'date' => date('Y-m-d'),'isPratical'=>$isper);
        $user_info  =  $this->Admission_11th_Pvt_model->getuser_info($User_info_data); 
        $isfine = 0;
        $Total_fine = 0;
        $processFee = 295;
        $admfee = 800;
        $admfeecmp = 1500;
        // Declare Science & Arts Fee's According to Fee Table .  Note: this will assign to Triple date fee. After triple date it will not asign fees.
        if(!empty($user_info['rule_fee'])) 
        {    $endDate =date('Y-m-d', strtotime($user_info['rule_fee'][0]['End_Date'])); 
            $singleDate = $endDate;
            if($user_info['rule_fee'][0]['isPrSub']==1)
            {
                $admfee = $user_info['rule_fee'][0]['PVT_Amount'];
                $processFee = $user_info['rule_fee'][0]['Processing_Fee'];;
                $admfeecmp = $user_info['rule_fee'][0]['Comp_Pvt_Amount'];
            } 
            else if($user_info['rule_fee'][0]['isPrSub']== 0 )
            {
                $admfee = $user_info['rule_fee'][0]['PVT_Amount'];
                $processFee = $user_info['rule_fee'][0]['Processing_Fee'];;
                $admfeecmp = $user_info['rule_fee'][0]['Comp_Pvt_Amount'];
            }
            
             if($data['IsLangexam'] == 1)
            {
                $admfee = 900;
                $admfeecmp = 1700;
            }
            
        }
        else
        {
            $date = new DateTime(TripleDateFee);
            $singleDate =  $date->format('Y-m-d');                                                                     
            $User_info_data = array('Inst_Id'=>999999, 'date' => $singleDate,'isPratical'=>$isper);
            $user_info  =  $this->Admission_11th_Pvt_model->getuser_info($User_info_data);
            if($user_info['rule_fee'][0]['isPrSub'] == 1)
            {
                $admfee = $user_info['rule_fee'][0]['PVT_Amount'];
                $processFee = $user_info['rule_fee'][0]['Processing_Fee'];;
                $admfeecmp = $user_info['rule_fee'][0]['Comp_Pvt_Amount'];

            } 
            else if( $user_info['rule_fee'][0]['isPrSub'] == 0 )
            {
                $admfee = $user_info['rule_fee'][0]['PVT_Amount'];
                $processFee = $user_info['rule_fee'][0]['Processing_Fee'];;
                $admfeecmp = $user_info['rule_fee'][0]['Comp_Pvt_Amount'];

            }

            if($data['IsLangexam'] == 1)
            {
                $admfee = 900;
                $admfeecmp = 1700;
            }
            
            $TripleDate = date('Y-m-d',strtotime(TripleDateFee)); 
            $now = date('Y-m-d'); // or your date as well
            $days = (strtotime($TripleDate) - strtotime($now)) / (60 * 60 * 24);
            $fine = 500;
            $days = abs($days);
            $endDate = date('d-m-Y');
            $admfee =  ($admfee*3); 
            $admfeecmp =  ($admfeecmp*3); 
            $Total_fine = $days*$fine;

        }  // DebugBreak();
        $finalFee = '';
        if($data['cat11'] !=  NULL && $data['cat12'] != NULL)
        {
            $finalFee = $admfeecmp;
        }
        else
        {
            $finalFee = $admfee;
        }
        $cert_fee = 0;
        if($data['IsLangexam'] == 1)
        {
            $cert_fee = 550;
        }
         $regfee =  1000;
        
        if($data['Spec']>0 && (strtotime(date('Y-m-d')) <= strtotime(SingleDateFee)) )
        {
            $regfee = 0; 
            $data['regFee'] = 0;
            $data['AdmFee'] = 0;
            $data['AdmTotalFee'] = $processFee+$Total_fine+$data['regFee']+$cert_fee;
            $AllStdFee = array('formNo'=>$data['FormNo'],'regFee'=>0,'AdmProcessFee'=>$processFee,'AdmFee'=>$data['AdmFee'],'AdmFine'=>$Total_fine,'AdmTotalFee'=>$data['AdmTotalFee'],'CertFee'=>$cert_fee);
        }
        else
        {
            if($data['oldRno_reg'] != '' && $data['IsLangexam'] == 1)
            {
                $cert_fee = 0;
                $regfee = 0;
            }
            $data['AdmFee'] = $finalFee;
            $data['AdmTotalFee'] = $processFee+$Total_fine+$regfee+$finalFee+$cert_fee;
            $AllStdFee = array('formNo'=>$data['FormNo'],'regFee'=>$regfee,'AdmProcessFee'=>$processFee,'AdmFee'=>$finalFee,'AdmFine'=>$Total_fine,'AdmTotalFee'=>$data['AdmTotalFee'],'CertFee'=>$cert_fee);
        }

        $info =   $this->Admission_11th_Pvt_model->Update_AdmissionFeePvt($AllStdFee);
        return $info;
    }
    public function formdownloaded(){

        //DebugBreak();

        $msg = $this->uri->segment(3);
        $dob = $this->uri->segment(4);
        $this->load->library('session');
        $myarray = array('msg'=>$msg,'dob'=>$dob);
        $this->load->view('common/commonheader11th.php');
        $this->load->view('Admission/11th/FormDownloaded.php',$myarray);
        $this->load->view('common/commonfooter.php');
    }

    private function set_barcode($code)
    {
        //DebugBreak()  ;
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');


        $file = Zend_Barcode::draw('code128','image', array('text' => $code,'drawText'=>false), array());
        //$code = $code;
        $store_image = imagepng($file,BARCODE_PATH."{$code}.png");
        return $code.'.png';

    }

    public function getzone(){
        // DebugBreak();
        $data = array(
            'tehCode' => $this->input->post('tehCode'),
        );

        $tehCode = $data['tehCode'];
        $this->load->model('Admission_11th_pvt_model');
        $value = array('teh'=> $this->Admission_11th_pvt_model->getzone($tehCode)) ;
        echo json_encode($value);

    }
    public function uploadpic()
    {

        ############ Configuration ##############
        $config["generate_image_file"]            = true;
        $config["generate_thumbnails"]            = false;
        $config["image_max_size"]                 = 150; //Maximum image size (height and width)
        $config["thumbnail_size"]                  = 200; //Thumbnails will be cropped to 200x200 pixels
        $config["image_prefix"]                 = "temp_"; //Normal thumb Prefix
        $config["thumbnail_prefix"]                = "thumb_"; //Normal thumb Prefix
        $config["destination_folder"]            = GET_PRIVATE_IMAGE_PATH.'11th\\'; //upload directory ends with / (slash)
        $config["thumbnail_destination_folder"]    = ''; //upload directory ends with / (slash)
        $config["upload_url"]                     = "../uplaods/2016/private/11th/"; 
        $config["quality"]                         = 90; //jpeg quality
        $config["random_file_name"]                = true; //randomize each file name


        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            exit;  //try detect AJAX request, simply exist if no Ajax
        }


        //specify uploaded file variable
        $config["file_data"] = $_FILES["__files"]; 

        $this->load->library('ImageResize');

        //create class instance 
        $im = new ImageResize(); 

        try{
            $responses = $im->resize($config); //initiate image resize

            //output images
            foreach($responses["images"] as $response){
                echo ' <input type="hidden" class="span2 hidden" id="picname" name="picname" value="'.$response.'">
                <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="'.$config["upload_url"].$response.'"  alt="Candidate Image">';
            }

        }catch(Exception $e){
            echo '<div class="error">';
            echo $e->getMessage();
            echo '</div>';
        }
    }
    public function getcenter(){
        //  DebugBreak();

        $data = array(
            'zoneCode' => $this->input->post('pvtZone'),
            'gen' => $this->input->post('gend'),
        );

        $this->load->model('Admission_11th_pvt_model');
        $value = array('center'=> $this->Admission_11th_pvt_model->getcenter($data)) ;
        echo json_encode($value);

    } 
    public function commonheader($data)
    {
        $this->load->view('common/header.php',$data);
        $this->load->view('common/menu.php',$data);
    }
    public function commonfooter($data)
    {
        $this->load->view('common/footer9th.php',$data);
    }

    function convertImage($originalImage, $outputImage, $quality,$ext)
    {

        if (preg_match('/jpg|jpeg/i',$ext))
            $imageTmp=imagecreatefromjpeg($originalImage);
        else if (preg_match('/png/i',$ext))
            $imageTmp=imagecreatefrompng($originalImage);
            else if (preg_match('/gif/i',$ext))
                $imageTmp=imagecreatefromgif($originalImage);
                else if (preg_match('/bmp/i',$ext))
                    $imageTmp=imagecreatefrombmp($originalImage);
                    else
                        return 0;

        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        return 1;
    }





}
