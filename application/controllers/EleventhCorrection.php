<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class EleventhCorrection extends CI_Controller {
   /* * Index Page for this controller.
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
   
    public function EditForms()
    {
        //  DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '12',

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
        // $this->load->model('Registration_model');
        $this->load->model('EleventhCorrection_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->EleventhCorrection_model->EditEnrolement($user['Inst_Id']),'grp_cd'=>$user['grp_cdi']);
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('EleventhCorrection/ApplyforCorrection.php',$RegStdData);
        $this->load->view('common/footer11thCorr.php');



    } 
    public function Applied()
    {
        //  DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '12',

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
        // $this->load->model('Registration_model');
        $this->load->model('EleventhCorrection_model');
        //  $error['grp_cd'] = $user['grp_cd'];
       // DebugBreak();
        $RegStdData = array('data'=>$this->EleventhCorrection_model->EditEnrolement_Applied($user['Inst_Id']),'grp_cd'=>$user['grp_cdi']);
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('EleventhCorrection/Applied.php',$RegStdData);
        $this->load->view('common/footer11thCorr.php');



    }
    public function Branch_Applied()
    {
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '12',

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
        // $this->load->model('Registration_model');
        $this->load->model('EleventhCorrection_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->EleventhCorrection_model->EditEnrolement_Branch());
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('EleventhCorrection/Branch_corr.php',$RegStdData);
        $this->load->view('common/footer11thCorr.php');



    }
    public function Print_challan_Form()
    {


        $formno = $this->uri->segment(3);

        $this->load->library('session');
        $this->load->library('NumbertoWord');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('EleventhCorrection_model');




         //  DebugBreak();

        //$grp_cd = $this->uri->segment(3);
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'formno'=>$formno);
        //  DebugBreak();
        $result = $this->EleventhCorrection_model->Print_challan_Form($fetch_data);
        //   $result = array('data'=>$this->EleventhCorrection_model->Print_challan_Form($fetch_data));




        $this->load->library('PDF_rotateWithOutPage');


        // $pdf = new PDF_Rotate('P','in',"A4");
        //for each type of correction total 7 types of corrections are now
        $ctid=1;  //correction type of id starts from one and multiples by 2 for next type of correction id
        //   $displayfeetitle=array(1=>'Name Correction', 2=>'Father Name Correction', 3=>'DOB Correction', 4=>'FNIC Correction', 5=>'B-Form Correction', 6=>'Picture Change', 7=>'Group Change', 8=>'Subject Change');
        // $feestructure = array();
        //  for($i=1;$i<=8;$i++){
        //$feetitle =  $result = array('data'=>$this->EleventhCorrection_model->Print_challan_Form($fetch_data));
        // DebugBreak();
        if($result[0]['NameFee'] > 0)
        {
            $feestructure[]    =  $result[0]['NameFee'];    
            $displayfeetitle[] =  'Name Correction';    
        }
        if($result[0]['FnameFee'] > 0 ){
            $feestructure[]     = $result[0]['FnameFee'];   
            $displayfeetitle[] =  'Father Name Correction';   
        }
        if($result[0]['DobFee'] > 0)
        {
            $feestructure[]=$result[0]['DobFee']; 
            $displayfeetitle[] =  'DOB Correction';   
        }
        if($result[0]['FnicFee']>0)
        {
            $feestructure[]=$result[0]['FnicFee'];    
            $displayfeetitle[] =  'FNIC Correction';
        }
        if($result[0]['BFormFee']>0)
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
        }
        /*$feestructure[16]=$result[0]['BFormFee'];
        $feestructure[32]=$result[0]['PicFee'];
        $feestructure[64]=$result[0]['GroupFee'];
        $feestructure[128]=$result[0]['SubjectFee'];*/
        //  $ctid *= 2;
        // }
        //$totalfee
        $turn=1;     
        $pdf=new PDF_rotateWithOutPage("P","in","A4");
        $pdf->AliasNbPages();
        $pdf->SetTitle("Challan Form | Application Correction Form");
        $pdf->SetMargins(0.5,0.5,0.5);
        $pdf->AddPage();
        $generatingpdf=false;
        $challanCopy=array(1=>"Depositor Copy",  2=>"Registration Branch Copy",3=>"Bank Copy", 4=>"Board Copy",);
        $challanMSG=array(1=>"(May be deposited in any HBL Branch)",2=>"(To be sent to the Online Registration Branch Via BISE One Window)", 3=>"(To be retained with HBL)", 4=>"(To be sent to the Board via HBL Branch aloongwith scroll)"  );
        $challanNo = $result[0]['challanNo']; 
        
        if(date('Y-m-d',strtotime(Correction_Last_Date11))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->EleventhCorrection_model->getreulefee(1); 
            $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
            $rule_fee   =  $this->EleventhCorrection_model->getreulefee(2); 
            $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }

        $obj    = new NumbertoWord();
        $obj->toWords($result[0]['TotalFee'],"Only.","");
        // $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');
        $feeInWords = ucwords($obj->words);//strtoupper(cNum2Words($totalfee)); 

        //-------------------- PRINT BARCODE
        //  $pdf->SetDrawColor(0,0,0);
        $temp = $challanNo.'@'.$result[0]['AppNo'].'@'.$result[0]['class'].'@'.$result[0]['Iyear'].'@'.$result[0]['sess'];
        //  $image =  $this->set_barcode($temp);
        //DebugBreak();
        $temp =  $this->set_barcode($temp);

        $yy = 0.05;
        $dyy = 0.1;
        $corcnt = 0;
        for ($j=1;$j<=4;$j++) 
        {

            
            
            
            $yy = 0.04;
            if($turn==1){$dyy=0.1;} 
            else {
                if($turn==2){$dyy=2.65;} else  if($turn==3) {$dyy=5.2; } else {$dyy=7.75 ; $turn=0;}
            }
            $corcnt = 0;
            $pdf->SetFont('Arial','BI',11);
            $pdf->SetXY(1.0,$yy+$dyy);
            //   DebugBreak();
            $pdf->Cell(2.45, 0.4, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "L");
            $pdf->Image(base_url()."assets/img/logo2.png",0.30,$yy+$dyy, 0.50,0.50, "PNG", "http://www.bisegrw.com");
            //  $pdf->Image(BARCODE_PATH.$Barcode,3.2, 1.15+$yy ,1.8,0.20,"PNG");
            $pdf->Image(BARCODE_PATH.$temp,5.8, $yy+$dyy+0.30 ,2.1,0.22,"PNG");
            $challanTitle = $challanCopy[$j];
            $generatingpdf=true;


            if($turn==1){$dy=0.4;} else {
                if($turn==2){$dy=2.9;} else  if($turn==3) {$dy=5.5; }else {$dy=8.1 ; $turn=0;}
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
            $pdf->SetFont('Arial','I',9);
            $pdf->Cell(0, $y, corr_bank_chall_class11.' '.'Registration Session '.session_year, 0.25, "L");

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

            //  DebugBreak();
            //--------------------------- Challan Depositor Information
            $pdf->SetXY(4,$y+0.1+$dy);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.3,"Bank Challan No:".$challanNo."           Application No.".$result[0]['AppNo'],0,2,'L');
            $pdf->SetFont('Arial','U',9);
            $pdf->Cell(0.5,0.25, "Particulars Of Depositor",0,2,'L');
            $pdf->SetX(4.0);
            $pdf->SetFont('Arial','B',8);

            if(intval($result[0]['sex'])==1){$sodo="S/O ";}else{$sodo="D/O ";}
            $pdf->Cell(0.5,0.25,$result[0]['Pre_Name'].'    '.$sodo.$result[0]['Pre_FName'],0,2,'L');
            // $pdf->Cell(0.5,0.25,,0,2,'L');
            $pdf->SetX(4);
            $pdf->SetFont('Arial','I',6.5);
            // DebugBreak();
            //$pdf->Cell(0.5,0.3,"Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            $pdf->MultiCell(4, .1, "Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0);
            $pdf->SetXY(4,$y+1.15+$dy);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(0.5,0.3,"Amount in Words: ".$feeInWords,0,2,'L');

            $x = 0.55;
            $y += 0.2;

            //------------- Fee Statement
            //  DebugBreak();
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
            // DebugBreak();
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
            $pdf->Cell(0.8,0.5,$result[0]['TotalFee'],0,'C');

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
    public function Correction_EditForm($formno)
    {    
         // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $isReAdm = 0;
        $year = 0;
        $data = array(
            'isselected' => '12',
        );
        $this->load->model('Registration_11th_model');
        if($this->session->flashdata('NewEnrolment_error')){
            //DebugBreak();

            
            $year = Year;
            $RegStdData = array('data'=>$this->Registration_11th_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0);
            $isReAdm = 0;//$RegStdData['data'][0]['isreadm'];
            $RegStdData['isReAdm']=$isReAdm;
           // DebugBreak();
            $excep= $this->session->flashdata('NewEnrolment_error');   
            $RegStdData['data'][0]['excep']= $excep['excep'];   
            
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
             // DebugBreak();
            $RegStdData = array('data'=>$this->Registration_11th_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0);
        }


        $this->load->view('common/menu.php',$data);
        $this->load->view('EleventhCorrection/Correction_form.php',$RegStdData);   
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 

    }
    public function commonheader($data)
    {
        $this->load->view('common/header.php',$data);
        $this->load->view('common/menu.php',$data);
    } 
    public function NewEnrolment_update()
    {
     //  DebugBreak();

        $this->load->model('EleventhCorrection_model');

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 12;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        $error = array();
        // DebugBreak();
        $formno =  $_POST['formNo'];  //$this->Registration_model->GetFormNo($Inst_Id);//, $fname);//$_POST['username'],$_POST['password']);


        /*
        'name' =>$this->input->post('cand_name'),
        'Fname' =>$this->input->post('father_name'),
        'BForm' =>$this->input->post('bay_form'),
        'FNIC' =>$this->input->post('father_cnic'),
        'Dob' =>$this->input->post('dob'),
        'grp_cd' =>$this->input->post('std_group'),*/
        if(date('Y-m-d',strtotime(Correction_Last_Date11))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->EleventhCorrection_model->getreulefee(1); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
            $rule_fee   =  $this->EleventhCorrection_model->getreulefee(2); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }

        $corr_name ='';
        $corr_Fname = '';
        $corr_BForm = '';
        $corr_FNIC = '';
        $corr_Dob = '';
        $corr_grp_cd  = 0;
        $corr_pic  = '';
        $corr_sub1 = 0;
        $corr_sub2 = 0;
        $corr_sub3 = 0;
        $corr_sub4 = 0;
        $corr_sub5 = 0;
        $corr_sub6 = 0;
        $corr_sub7 = 0;
        $corr_sub8 = 0;
        $NameFee =0;
        $FnameFee =0;
        $DobFee =0;
        $FNICFee =0;
        $BFormFee =0;
        $grpFee =0;
        $subFee =0;
        $PicFee =0;
        $corr_totalFee = 0;

         $isPic = 0;
        // ======================= Name checkbox ======================
        if (isset($_POST['c'])){

            foreach($_POST['c'] as $value){

                if ($value == '1') {

                    $corr_name = $_POST['corr_cand_name'];
                    $NameFee = $rule_fee[0]['NameFee'];
                    // Name Checkbox is selected
                } 
                /*else {
                $corr_name = '';
                $NameFee = 0;
                //Name Checkbox Not Selected
                }*/

                // =============== FName Checkbox ==================
                if ($value== '2') {

                    $corr_Fname = $_POST['corr_father_name'];
                    $FnameFee = $rule_fee[0]['FNameFee'];
                    // FName Checkbox is selected
                } 
                /*else {

                $corr_Fname = '';
                $FnameFee = 0;
                //FName Checkbox Not Selected
                }*/

                // =============== DOB Checkbox ==================
                if ($value== '3') {

                    $corr_Dob = $_POST['corr_dob'];
                    $DobFee = $rule_fee[0]['FNameFee'];
                    // FName Checkbox is selected
                } 
                /*else {

                $corr_Dob = '';
                $DobFee =0;
                //FName Checkbox Not Selected
                }*/

                // =============== BForm Checkbox ==================
                if ($value== '4') {

                    $corr_BForm = $_POST['corr_bay_form'];
                    $BFormFee = $rule_fee[0]['BFormFee'];
                    // BForm Checkbox is selected
                }
                /* else {

                $corr_BForm = '';
                $BFormFee = 0;
                //BForm Checkbox Not Selected
                }*/
                // =============== FNIC Checkbox ==================
                if ($value== '5') {

                    $corr_FNIC = $_POST['corr_father_cnic'];
                    $FNICFee = $rule_fee[0]['FNICFee'];
                    // FNIC Checkbox is selected
                } 
                /*else {

                $corr_FNIC = '';
                $FNICFee = 0;
                //FNIC Checkbox Not Selected
                }*/
                // =============== Group and Subject Checkbox ==================
                if ($value== '6') {

                    // DebugBreak();
                    $this->load->model('Registration_11th_model');
                    $year = Year;
                    $RegStdData = $this->Registration_11th_model->EditEnrolement_data($formno,$year,$Inst_Id);
                    $corr_grp_cd = $_POST['corr_std_group'];
                    $pre_grp_cd = $RegStdData[0]['grp_cd'];
                    if($corr_grp_cd != $pre_grp_cd)
                    {
                        $grpFee = $rule_fee[0]['GroupFee']; 
                        $corr_sub1 =  $_POST['corr_sub1'];
                        $corr_sub2 =  $_POST['corr_sub2'];
                        $corr_sub3 =  $_POST['corr_sub3']; 
                        $corr_sub4 =  $_POST['corr_sub4'];
                        $corr_sub5 =  $_POST['corr_sub5'];
                        $corr_sub6 =  $_POST['corr_sub6']; 
                        $corr_sub7 =  $_POST['corr_sub7'];
                        $corr_sub8 =  $_POST['corr_sub8'];

                    }
                    else
                    {
                        //=============== Subject Comparison===================
                        if($RegStdData[0]['sub1'] != $_POST['corr_sub1'])
                        {
                            $subFee = $rule_fee[0]['SubFee'];
                            $corr_sub1 =  $_POST['corr_sub1'];
                        }
                        else
                        {
                            $corr_sub1 =  0;
                        }
                        if($RegStdData[0]['sub2'] != $_POST['corr_sub2'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee']; 
                            $corr_sub2 =  $_POST['corr_sub2'];
                        }
                        else{
                            $corr_sub2 =  0;
                        }
                        if($RegStdData[0]['sub3'] != $_POST['corr_sub3'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee'];
                            $corr_sub3 =  $_POST['corr_sub3']; 
                        }
                        else{
                            $corr_sub3 =  0;
                        }
                        if($RegStdData[0]['sub4'] != $_POST['corr_sub4'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee']; 
                            $corr_sub4 =  $_POST['corr_sub4'];
                        }
                        else{
                            $corr_sub4 =  0;
                        }
                        if($RegStdData[0]['sub5'] != $_POST['corr_sub5'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee']; 
                            $corr_sub5 =  $_POST['corr_sub5'];
                        }
                        else{
                            $corr_sub5 =  0;
                        }
                        if($RegStdData[0]['sub6'] != $_POST['corr_sub6'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee'];
                            $corr_sub6 =  $_POST['corr_sub6']; 
                        }
                        else{
                            $corr_sub6 =  0;
                        }
                        if($pre_grp_cd == 5 || $corr_grp_cd ==5)
                        {
                          if(isset($RegStdData[0]['sub7']) != $_POST['corr_sub7'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee']; 
                            $corr_sub7 =  $_POST['corr_sub7'];
                        }
                        else{
                            $corr_sub7 =  0;
                        }
                        }
                        
                        
                        
                    }



                    // Group Checkbox is selected
                } /*else {

                $corr_grp_cd = '';
                $grpFee=0;
                //Group Checkbox Not Selected
                }*/
                // =============== Pic Checkbox ==================
               
                if ($value== '7') {

                    $PicFee = $rule_fee[0]['PicFee'];
                    $isPic = 1;
                } 

            }          // =================== loop Ending
        }   //===============Array isset Ending
        $target_path = CORR_IMAGE_PATH11.$Inst_Id.'/';
        DebugBreak();  
        // $target_path = '../uploads2/'.$Inst_Id.'/';
        if($isPic ==1)
        {

            if (!file_exists($target_path)){

                mkdir($target_path);
            }

            $config['upload_path']   = $target_path;
            $config['allowed_types'] = 'jpg';
            $config['max_size']      = '20';
            // $config['max_width']     = '260';
            // $config['max_height']    = '290';
            $config['max_width']     = '260';
            $config['max_height']    = '290';
            $config['overwrite']     = TRUE;
            $config['file_name']     = $formno.'.jpg';

            $filepath = $target_path. $config['file_name']  ;    
            
           
            
            $filename =    $config['file_name']  ;    
            $this->load->library('upload', $config);
            $check = getimagesize($_FILES["corr_image"]["tmp_name"]);
            $this->upload->initialize($config);
            
            
            // echo $filepath ;exit();
            //DebugBreak();
            if($check !== false) {
                $file_size = round($_FILES['corr_image']['size']/1024, 2);
                
                
                if($file_size<=20)
                {

                    if ( !$this->upload->do_upload('corr_image',True))
                    {
                       // echo $this->upload->error_msg[0]; exit();
                        if($this->upload->error_msg[0] != "")
                        {
                            $error['excep']= $this->upload->error_msg[0];
                            $allinputdata['excep'] = $this->upload->error_msg[0];
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('EleventhCorrection/Correction_EditForm/'.$formno);
                            return;

                        }

                    }
                }
                else
                {
                    $allinputdata['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                    redirect('EleventhCorrection/Correction_EditForm/'.$formno);

                }
            }
            else{
                //$check = getimagesize($filepath);
                //  if($check === false)
                // {
                $allinputdata['excep'] = 'Please Upload Your Picture';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('EleventhCorrection/Correction_EditForm/'.$formno);
                return;
                //}
            }

        }
        /*
        $NameFee ='';
        $FnameFee ='';
        $DobFee ='';
        $FNICFee ='';
        $BFormFee ='';
        $grpFee ='';
        $subFee ='';
        $PicFee ='';*/

        $allinputdata = array('name'=>$corr_name,'Fname'=>$corr_Fname,
            'BForm'=>$corr_BForm,'FNIC'=>$corr_FNIC,
            'Dob'=>$corr_Dob,'RegGrp'=>$corr_grp_cd,
            'NameFee'=>$NameFee,
            'FnameFee'=>$FnameFee,
            'DobFee'=>$DobFee,
            'FNICFee'=>$FNICFee,
            'BFormFee'=>$BFormFee,
            'grpFee'=>$grpFee,
            'subFee'=>$subFee,
            'picFee'=>$PicFee,
            'rel'=>@$_POST['hid_rel'],
            'sex'=>@$_POST['hid_sex'],
            'nat'=>@$_POST['hid_nat'],
            'sub1'=>$corr_sub1,'sub2'=>$corr_sub2,'sub3'=>$corr_sub3,
            'sub4'=>$corr_sub4,'sub5'=>$corr_sub5,
            'sub6'=>$corr_sub6,'sub7'=>$corr_sub7,
            'PicPath'=>$filename ,'formNo'=>@$_POST['formNo'],

        );

        //$config['new_image']    = $formno.'.JPEG';

        /* else
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
        $corr_totalFee = $NameFee+$FnameFee+$DobFee+$FNICFee+$BFormFee+$grpFee+$subFee+$PicFee;
        //DebugBreak();
        $AppNo = $this->EleventhCorrection_model->GetAppNo();
        $data = array(
            'name'=>$corr_name,
            'Fname'=>$corr_Fname,
            'BForm'=>$corr_BForm,
            'FNIC'=>$corr_FNIC,
            'Dob'=>$corr_Dob,
            'RegGrp'=>$corr_grp_cd,
            'NameFee'=>$NameFee,
            'FnameFee'=>$FnameFee,
            'DobFee'=>$DobFee,
            'FNICFee'=>$FNICFee,
            'BFormFee'=>$BFormFee,
            'grpFee'=>$grpFee,
            'subFee'=>$subFee,
            'picFee'=>$PicFee,
            'totalFee'=>$corr_totalFee,
            'sub1'=>$corr_sub1,'sub2'=>$corr_sub2,'sub3'=>$corr_sub3,
            'sub4'=>$corr_sub4,'sub5'=>$corr_sub5,
            'sub6'=>$corr_sub6,'sub7'=>$corr_sub7,
            'PicPath'=>$filename,'formNo'=>@$_POST['formNo'],
            'AppNo'=>$AppNo,
            'Pic'=>$isPic,
            'Inst_cd'=>$Inst_Id,
            'FormNo'=>$formno,

        );
        $logedIn = $this->EleventhCorrection_model->Update_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        if($logedIn[0]['error'] != 'false')
        {  

            $this->session->set_flashdata('error', 'success');
            redirect('EleventhCorrection/Applied');
            return;

            echo 'Data Saved Successfully !';

        }
        else
        {     
            $allinputdata['excep'] = 'An error has occoured. Please try again later. ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('EleventhCorrection/Correction_EditForm/'.$formno);
            return;
            echo 'Data NOT Saved Successfully !';

        } 



        $this->load->view('common/footer11thCorr.php');
    }
    public function commonfooter($data)
    {
        $this->load->view('common/footer11thCorr.php',$data);
    }
    private function set_barcode($code)
    {
        //  DebugBreak()  ;
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');


        $file = Zend_Barcode::draw('code128','image', array('text' => $code,'drawText'=>false), array());
        //$code = $code;
        $store_image = imagepng($file,BARCODE_PATH."{$code}.png");
        return $code.'.png';

    }
    public function Print_correction_Form_Final()
    {

         // DebugBreak();
        $AppNo = $this->uri->segment(3);

        $this->load->library('session');

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('EleventhCorrection_model');

        // $start_formno = $this->uri->segment(3);
        //   $end_formno = $this->uri->segment(5);
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'AppNo'=>$AppNo);
        $result = array('data'=>$this->EleventhCorrection_model->Print_corr_Form_Final($fetch_data));
        //Print_Form_Formnowise


        if(empty($result['data'])){
            $this->session->set_flashdata('error', $Condition);
            redirect('Registration/FormPrinting');
            return;

        }


        $this->load->library('PDF_rotateWithOutPage');


        $pdf = new PDF_rotateWithOutPage('P','in',"A4");
        //      $this->load->library('PDFF');
        //        $pdf=new PDFF('P','in',"A4");  
        $pdf->AliasNbPages();
        $pdf->SetMargins(0.5,0.5,0.5);
        //$grp_cd = $this->uri->segment(3);

        $pdf->SetTitle('Print Registration Correction From');

        $fontSize = 10;
        $marge    = .4;   // between barcode and hri in pixel
        $x        = 7.5;  // barcode center
        $y        = 1.2;  // barcode center
        $height   = 0.35;   // barcode height in 1D ; module size in 2D
        $width    = .013;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $type     = 'code128';
        $black    = '000000'; // color in hex
        //DebugBreak();
        $result = $result['data'];
        //if(!empty($result)):
        foreach ($result as $key=>$data) 
        {

            //First Page ---class instantiation    
            //$pdf = new FPDF_BARCODE("P","in","A4");
            $pdf->AddPage();
            $Y = 0.5;
            $pdf->SetFillColor(0,0,0);
            $pdf->SetDrawColor(0,0,0); 
            $year_ = Year;
            $temp = $data['AppNo'].'@11@'.$year_.'@1';
            $image =  $this->set_barcode($temp);
            $pdf->Image(BARCODE_PATH.$image,6.0, 1.2  ,1.8,0.20,"PNG");
            $pdf->SetFont('Arial','U',16);
            $pdf->SetXY( 1.2,0.2);
            $pdf->Cell(0, 0.2, "Board Of Intermediate and Secondary Education,Gujranwala", 0.25, "C");
            $pdf->Image(base_url()."assets/img/logo2.PNG",0.35,0.2, 0.75,0.75, "PNG", "http://www.bisegrw.com");


            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(1.7,0.4);
            $pdf->Cell(0, 0.25, " CORRECTION FORM FOR CLASS ".corr_bank_chall_class11." SESSION ".sessReg, 0.25, "C");
            //$pdf->Image(base_url(). 'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG"); 
            //--------------- Proof Read
            $ProofReed = "Application No. ".$data['AppNo'];
            $pdf->SetXY(3,0.8);
            $pdf->SetFont("Arial",'B',12);
            $pdf->Cell(0, 0.25, $ProofReed  ,0,'C');

            //--------------------------- Form No & Rno
            $pdf->SetXY(0.2,0.5+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Form No: _______________",0,'L');

            $pdf->SetXY(0.8,0.5+$Y);
            $pdf->SetFont('Arial','IB',12);
            $pdf->Cell( 0.5,0.5,$data['formno'],0,'L');

            //--------------------------- Institution Code and Name   $user['Inst_Id']. "-". $user['inst_Name']
            $pdf->SetXY(0.2,0.75+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Institution Code/Name:",0,'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.75,0.92+$Y);
            // $pdf->MultiCell(20, .5, $user['Inst_Id']."-".$user['inst_Name'], 0);
            $pdf->MultiCell(6,0.2,  $user['Inst_Id']. "-". $user['inst_Name'],0,'L');    

            //------ Picture Box on Centre      
            $Y = $Y+0.1;
            $x = 1.05;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.2,1.28+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'NATURE OF CORRECTION ',1,0,'L',1);
            //------------- Personal Infor Box
            //====================================================================================================================

            if($data['Picfee']>0)
            {

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(1.8,1.45+$Y);
                $pdf->Cell( 0.5,0.5,"Previous Picture:",0,'L');

                $pdf->SetXY(1.8, $Y +1.79);
                $pdf->Cell(1.25,1.4,'',1,0,'C',0);

                $pdf->Image(IMAGE_PATH11.$user['Inst_Id'].'/'.$data["PicPath"],1.8, 1.79+ $Y, 1.25, 1.4, "JPG"); 
                $pdf->SetFont('Arial','',10);

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(4.8,1.45+$Y);
                $pdf->Cell( 0.5,0.5,"New Picture:",0,'L');

                $pdf->SetXY(4.8, $Y +1.79);
                $pdf->Cell(1.25,1.4,'',1,0,'C',0);
                // DebugBreak();
                $pdf->Image(CORR_IMAGE_PATH11.$user['Inst_Id'].'/'.$data["PicPath"],4.8, 1.79+ $Y, 1.25, 1.4, "JPG"); 
                $pdf->SetFont('Arial','',10);
                $Y = 2.0; 
            }
            //  $Y = $Y+0.1;



            //--------------------------- 1st line 
            if($data['NameFee']> 0)
            {
                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(0.5,1.65+$Y);
                $pdf->Cell( 0.5,0.5,"Previous Name:",0,'L');
                $pdf->SetFont('Arial','B',9);
                $pdf->SetXY(1.5,1.65+$Y);
                $pdf->Cell(0.5,0.5,  strtoupper($data["name"]),0,'L');

                $pdf->SetXY(3.5+$x,1.65+$Y);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell( 0.5,0.5,"New Name:",0,'L');
                $pdf->SetFont('Arial','B',9);
                $pdf->SetXY(4.3+$x,1.65+$Y);
                $pdf->Cell(0.5,0.5, strtoupper(@$data["N_name"]),0,'L');

            }


            // //--------------------------- FATHER NAME 
            if($data['FnameFee']>0)
            {
                $pdf->SetXY(0.5,$Y+2);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell( 0.5,0.5,"Previous Father's Name:",0,'L');
                $pdf->SetFont('Arial','B',9);
                $pdf->SetXY(2.1,$Y+2);
                $pdf->Cell(0.5,0.5,@$data["Fname"],0,'L');            

                $pdf->SetXY(3.5+$x,$Y+2);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell( 0.5,0.5,"New Father's Name:",0,'L');
                $pdf->SetFont('Arial','B',9);
                $pdf->SetXY(4.8+$x,$Y+2);
                $pdf->Cell(0.5,0.5,@$data["N_Fname"],0,'L');    
            }    
            //--------------------------- 3rd line 
            if($data['DobFee']>0)
            {
                $pdf->SetXY(0.5,$Y+ 2.35);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell( 0.5,0.5,"Previous Date Of Birth:",0,'L');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(2.1,2.35+$Y);

                $pdf->Cell(0.5,0.5,date('d-m-Y', strtotime($data['Dob'])),0,'L');     
                //    $pdf->Cell(0.5,0.5,$data["Rel"]==1?"Muslim":"Non-Muslim",0,'L');

                $pdf->SetXY(3.5+$x,2.35+$Y);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell( 0.5,0.5,"New Date of Birth:",0,'L');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(4.8+$x,2.35+$Y);
                $pdf->Cell(0.5,0.5,date('d-m-Y', strtotime(@$data['N_Dob'])),0,'L');            
            }
            //--------------------------- BAY FORM NO line 
            if($data['Bformfee']>0)
            {
                $pdf->SetXY(0.5,$Y+2.70);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell( 0.5,0.5,"Previous Bay Form No:",0,'L');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(2.1,$Y+2.70);
                $pdf->Cell(0.5,0.5,$data["BForm"],0,'L');


                $pdf->SetXY(3.5+$x,$Y+2.70);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(0.5,0.5,"New Bay Form No",0,'R');
                // $pdf->Cell(0.5,0.5,"Father CNIC:",0,'R');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(4.8+$x,$Y+2.70);
                $pdf->Cell(0.5,0.5,@$data["N_BForm"],0,'L');
                // $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');
            }
            //---------------------------  
            if($data['FnicFee']>0)
            {
                $pdf->SetXY(0.5,$Y+3.05);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell( 0.5,0.5,"Previous Father CNIC:",0,'L');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(2.1,$Y+3.05);
                $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');

                $pdf->SetXY(3.5+$x,$Y+3.05);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(0.5,0.5,"New Father CNIC:",0,'R');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(4.8+$x,$Y+3.05);
                $pdf->Cell(0.5,0.5,@$data["N_FNIC"],0,'L');
                //$pdf->Cell(0.5,0.5,@$data["N_FNIC"],0,'L');
            }
            //--------------------------- Gender Nationality 

            //--------------------------- id mark and Medium 
            /* $pdf->SetXY(0.5,$Y+3.40);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Ident Mark:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+3.40);
            $pdf->Cell(0.5,0.5,$data["markOfIden"],0,'L');

            $pdf->SetXY(3.5+$x,$Y+3.40);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Religion:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+3.40);
            $pdf->Cell(0.5,0.5,$data["rel"]==1?"Muslim":"Non-Muslim",0,'L');            
            //             $pdf->Cell(0.5,0.5, $data["MobNo"],0,'L');
            //----- Contact No.    
            $pdf->SetXY(0.5,$Y+3.75);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Mobile No:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+3.75);
            $pdf->Cell(0.5,0.5, $data["CellNo"],0,'L');


            $pdf->SetXY(0.5,$Y+4.1);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Address:",0,'L');
            $pdf->SetFont('Arial','b',10);
            $pdf->SetXY(1.5,$Y + 4.1);
            $pdf->Cell(0.5,0.5, strtoupper($data["addr"]),0,'L');*/
            //========================================  Exam Info ===============================================================================            
            $sY = -0.3;//0.5;
            $pdf->SetXY(0.2,6.1+$sY);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'SUBJECT INFORMATION',1,0,'L',1);
          //  DebugBreak();
            //--------------------------- Subject Group
            $grp_name = $data["Reggrp"];
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
                default:
                $grp_name = "NO GROUP SELECTED";
            }
            $N_grp_name = $data["N_Reggrp"];
            switch ($N_grp_name) {
                case '1':
                    $N_grp_name = 'PRE-MEDICAL';
                    break;
                case '2':
                    $N_grp_name = 'PRE-ENGINEERING';
                    break;
                case '3':
                    $N_grp_name = 'HUMANITIES';
                    break;
                case '4':
                    $N_grp_name = 'GENERAL SCIENCE';
                    break;
                case '5':
                    $N_grp_name = 'COMMERCE';
                    break;
                 case '6':
                    $N_grp_name = 'HOME ECONOMICS';
                    break;
                default:
                    $N_grp_name = "NO GROUP SELECTED";
            }
            $y = $sY - 0.2;
            if($data['groupFee'] > 0)
            {


                $pdf->SetXY(0.5,6.45+$sY);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell( 0.5,0.5,"Previous Subjects with Group:",0,'L');
                $pdf->SetFont('Arial','B',9);
                $pdf->SetXY(2.0,6.45+$sY);
                $pdf->Cell(0.5,0.5, ($grp_name),0,'L');


                $pdf->SetXY(4.5,6.45+$sY);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell( 0.5,0.5,"New Subjects with Group:",0,'L');
                $pdf->SetFont('Arial','B',9);
                $pdf->SetXY(5.78,6.45+$sY);
                $pdf->Cell(0.5,0.5, ($N_grp_name),0,'L');
            }
            if($data['SubjectFee'] > 0)
            {
                $x = 1.5;
                //--------------------------- Subjects
                if( $data['groupFee'] == 0)
                {
                    $pdf->SetXY(0.5,6.40+$sY);
                    $pdf->SetFont('Arial','B',12);
                    $pdf->Cell( 0.5,0.5,"Previous Subjects:",0,'L');
                    $pdf->SetFont('Arial','',10);

                    $pdf->SetXY(4.5,6.40+$sY);
                    $pdf->SetFont('Arial','B',12);
                    $pdf->Cell( 0.5,0.5,"New Subjects:",0,'L');
                    $pdf->SetFont('Arial','B',9);  
                }


                //DebugBreak();
                //------------- sub 1 & 5
                $pdf->SetFont('Arial','',8);
                $pdf->SetXY(0.5,7.05+$y);
                $pdf->Cell(0.5,0.5, '1. '.($data['sub1_NAME']),0,'L');

                $pdf->SetXY(3+$x,7.05+$y);
                $pdf->Cell(0.5,0.5, '1. '.(@$data['N_sub1_NAME']),0,'L');

                /*$pdf->SetXY(3+$x,7.05+$y);
                $pdf->Cell(0.5,0.5, '5. '.($data['sub5_NAME']),0,'L');*/
                //------------- sub 2 & 6
                $pdf->SetXY(0.5,7.35+$y);
                $pdf->Cell(0.5,0.5, '2. '.($data['sub2_NAME']),0,'L');
                $pdf->SetXY(3+$x,7.35+$y);
                $pdf->Cell(0.5,0.5, '2. '.(@$data['N_sub2_NAME']),0,'R');
                /*$pdf->SetXY(3+$x,7.35+$y);
                $pdf->Cell(0.5,0.5, '6. '.($data['sub6_NAME']),0,'R');*/
                //------------- sub 3 & 7
                $pdf->SetXY(0.5,7.70+$y);
                $pdf->Cell(0.5,0.5,  '3. '.($data['sub3_NAME']),0,'L');
                $pdf->SetXY(3+$x,7.70+$y);
                $pdf->Cell(0.5,0.5, '3. '.($data['N_sub3_NAME']),0,'R'); 
                /*$pdf->SetXY(3+$x,7.70+$y);
                $pdf->Cell(0.5,0.5, '7. '.($data['sub7_NAME']),0,'R');*/
                //------------- sub 4 & 8
                $pdf->SetXY(0.5,8.05+$y);
                $pdf->Cell(0.5,0.5, '4. '.($data['sub4_NAME']),0,'L');
                $pdf->SetXY(3+$x,8.05+$y);
                $pdf->Cell(0.5,0.5, '3. '.($data['N_sub4_NAME']),0,'L');
                //-----------------

                $pdf->SetXY(0.5,8.40+$y);
                $pdf->Cell(0.5,0.5, '5. '.($data['sub5_NAME']),0,'L');

                $pdf->SetXY(3+$x,8.40+$y);
                $pdf->Cell(0.5,0.5, '5. '.($data['N_sub5_NAME']),0,'L');

                //-------------------------
                $pdf->SetXY(0.5,8.75+$y);
                $pdf->Cell(0.5,0.5, '6. '.($data['sub6_NAME']),0,'R');

                $pdf->SetXY(3+$x,8.75+$y);
                $pdf->Cell(0.5,0.5, '6. '.($data['N_sub6_NAME']),0,'R');

                //------------------------

                $pdf->SetXY(0.5,9.10+$y);
                $pdf->Cell(0.5,0.5, '7. '.($data['sub7_NAME']),0,'R');

                $pdf->SetXY(3+$x,9.10+$y);
                $pdf->Cell(0.5,0.5, '7. '.($data['N_sub7_NAME']),0,'R');

                //------------------------------

              
            }
            if(  $data['groupFee'] > 0)
            {

                $x = 1.5;
                //--------------------------- Subjects
                if( $data['groupFee'] == 0)
                {
                    $pdf->SetXY(0.5,6.40+$sY);
                    $pdf->SetFont('Arial','B',12);
                    $pdf->Cell( 0.5,0.5,"Previous Subjects:",0,'L');
                    $pdf->SetFont('Arial','',10);

                    $pdf->SetXY(4.5,6.40+$sY);
                    $pdf->SetFont('Arial','B',12);
                    $pdf->Cell( 0.5,0.5,"New Subjects:",0,'L');
                    $pdf->SetFont('Arial','B',9);  
                }


                // DebugBreak();
                //------------- sub 1 & 5
                $pdf->SetFont('Arial','B',9);  
                $pdf->SetFont('Arial','',8);
                $pdf->SetXY(0.5,7.05+$y);
                $pdf->Cell(0.5,0.5, '1. '.($data['sub1_NAME']),0,'L');

                $pdf->SetXY(3+$x,7.05+$y);
                $pdf->Cell(0.5,0.5, '1. '.(@$data['N_sub1_NAME']),0,'L');

                /*$pdf->SetXY(3+$x,7.05+$y);
                $pdf->Cell(0.5,0.5, '5. '.($data['sub5_NAME']),0,'L');*/
                //------------- sub 2 & 6
                $pdf->SetXY(0.5,7.35+$y);
                $pdf->Cell(0.5,0.5, '2. '.($data['sub2_NAME']),0,'L');
                $pdf->SetXY(3+$x,7.35+$y);
                $pdf->Cell(0.5,0.5, '2. '.(@$data['N_sub2_NAME']),0,'R');
                /*$pdf->SetXY(3+$x,7.35+$y);
                $pdf->Cell(0.5,0.5, '6. '.($data['sub6_NAME']),0,'R');*/
                //------------- sub 3 & 7
                $pdf->SetXY(0.5,7.70+$y);
                $pdf->Cell(0.5,0.5,  '3. '.($data['sub3_NAME']),0,'L');
                $pdf->SetXY(3+$x,7.70+$y);
                $pdf->Cell(0.5,0.5, '3. '.($data['N_sub3_NAME']),0,'R'); 
                /*$pdf->SetXY(3+$x,7.70+$y);
                $pdf->Cell(0.5,0.5, '7. '.($data['sub7_NAME']),0,'R');*/
                //------------- sub 4 & 8
                $pdf->SetXY(0.5,8.05+$y);
                $pdf->Cell(0.5,0.5, '4. '.($data['sub4_NAME']),0,'L');
                $pdf->SetXY(3+$x,8.05+$y);
                $pdf->Cell(0.5,0.5, '3. '.($data['N_sub4_NAME']),0,'L');
                //-----------------

                $pdf->SetXY(0.5,8.40+$y);
                $pdf->Cell(0.5,0.5, '5. '.($data['sub5_NAME']),0,'L');

                $pdf->SetXY(3+$x,8.40+$y);
                $pdf->Cell(0.5,0.5, '5. '.($data['N_sub5_NAME']),0,'L');

                //-------------------------
                $pdf->SetXY(0.5,8.75+$y);
                $pdf->Cell(0.5,0.5, '6. '.($data['sub6_NAME']),0,'R');

                $pdf->SetXY(3+$x,8.75+$y);
                $pdf->Cell(0.5,0.5, '6. '.($data['N_sub6_NAME']),0,'R');

                //------------------------

                $pdf->SetXY(0.5,9.10+$y);
                $pdf->Cell(0.5,0.5, '7. '.($data['sub7_NAME']),0,'R');

                $pdf->SetXY(3+$x,9.10+$y);
                $pdf->Cell(0.5,0.5, '7. '.($data['N_sub7_NAME']),0,'R');

                //------------------------------

         
            } 

            $pdf->SetFont('Arial','UI',10);  
            $pdf->SetXY(0.5,  10.2+$y);
            $date = strtotime($data['edate']); 
            $pdf->Cell(8,0.24,'Feeding Date: '. date('d-m-Y h:i:s a', $date) ,0,'L','');

            $pdf->SetXY(4.6,  10.2+$y);
            $pdf->Cell(8,0.24,'Signature & Official stamp of the Head of the Institute: ' ,0,'L','');
            //date_format($$data['EDate'], 'd/m/Y H:i:s');

            $pdf->SetXY(0.5,  10.5+$y);
            $pdf->Cell(8,0.24,'Print Date: '. date('d-m-Y h:i:s a'),0,'L','');

            //======================================================================================
        }

        $pdf->Output($data["Sch_cd"].'.pdf', 'I');
    }
    public function Corr_App_Delete($AppNo)
    {
        // DebugBreak();
        $this->load->model('EleventhCorrection_model');
        $RegStdData = array('data'=>$this->EleventhCorrection_model->Delete_Corr_App($AppNo));
        $this->load->library('session');
        $this->session->set_flashdata('error', '2');
        redirect('EleventhCorrection/Applied');
        return;
    }
}
?>

