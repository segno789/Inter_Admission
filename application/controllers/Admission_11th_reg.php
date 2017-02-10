<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission_11th_reg extends CI_Controller {
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
         $this->clear_cache(); 
        //this condition checks the existence of session if user is not accessing  
        //login method as it can be accessed without user session
        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login');
        }
    }
    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
    public function index()
    {
      // DebugBreak(); 

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_name = $userinfo['inst_Name'];
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->model('Admission_11th_reg_model');

        $inst_cd = '';
        //$isset = $this->Admission_11th_reg_model->iszoneset($Inst_Id);
        //DebugBreak();
       if($Inst_Id == $inst_cd)
        {
            $this->load->view('Admission/Matric/errorPage.php',$userinfo);
            $this->load->view('common/footer.php'); 
        }
        else{
            $userinfo['isselected'] = 14;
            $userinfo['isdashbord'] = 1;
          //  $userinfo['zone'] = $isset[0]['zone_cd'];
            $count = $this->Admission_11th_reg_model->Dashboard($Inst_Id);
            $this->load->view('common/menu.php',$userinfo);
            $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name);
            $this->load->view('Admission/11th/Admission.php',$info);
            $this->load->view('common/footer.php');    

        } 


    }
    function updatezone()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->model('Admission_11th_reg_model');
        $Inst_Id = $userinfo['Inst_Id'];
        $isres = $this->Admission_11th_reg_model->Incomplete_inst($_POST,$Inst_Id);

        if($isres == 1)
        {
         redirect('Admission_9th_reg');
        }


    }
    public function forwarding_pdf()
    {

        //  DebugBreak();

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Admission_11th_reg_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id']);
        $result = array('data'=>$this->Admission_11th_reg_model->forwarding_pdf_final($fetch_data),'inst_Name'=>$user['inst_Name']);  
        // DebugBreak();  
        if(empty($result['data'])){

            return; }
        $temp = $user['Inst_Id'].'@11@'.CURRENT_SESS1;
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
        $pdf->SetTitle('Forwarding Letter');
        $pdf->SetMargins(0.5,0.5,0.5);
        $lmargin =0.5;
        $rmargin =7.5;
        $topMargin = 0.5;
        $countofrecords=14;
        $title=1.0;
        $cnt=0; $ln[0]=1.5;
        $SR=1;

        $pdf->AddPage();

        $pdf->Image("assets/img/logo2.png",0.4, 0.25, 0.55, 0.55, "PNG");

        $pdf->SetFont('Arial','U',14);
        $pdf->SetXY( 1.0,0.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(1.0,0.4);
        $pdf->Cell(0, 0.25, "FORWARDING LETTER SHOWING DETAILS OF ".class_for_11th_Adm." ADMISSION FORMS FOR ANNUAL EXAMINATION ".CURRENT_SESS1, 0.25, "C");

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(2.6,2.4);
        $pdf->Image(BARCODE_PATH.$image,6.3,0.65, 1.8, 0.20, "PNG"); 
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(0.4,1.15);
        $pdf->MultiCell(7, 0.18,$user['Inst_Id']. "-". $user['inst_Name'].'','',"L",0);


        $x = 0;
        $y = 0.2;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(0.4+$x,0.7+$y);
        $pdf->Cell(0, 0.25, "FROM ", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,0.7+$y);
        $pdf->Cell(0, 0.25, "PRINCIPAL", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,0.7+$y);
        $pdf->Cell(0, 0.25, "__________", 0.25, "C");


         $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.4+$x,1.6+$y);

        $pdf->Cell(0, 0.25, "Dated:______________________", 0.25, "C");



        /*$pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.4+$x,1.3+$y);
        $pdf->Cell(0, 0.25, "TEH:__________________", 0.25, "C");

         $pdf->SetFont('Arial','',10);
        $pdf->SetXY(2.1+$x,1.3+$y);
        $pdf->Cell(0, 0.25, " DISTT:_____________________", 0.25, "C");     */


        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.4+$x,1.2+$y);
        $pdf->Cell(0, 0.25, "NO:_________________________", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(4.9+$x,1.2+$y);            
        $pdf->Cell(0, 0.25, "Institute Landline No:___________________", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(4.9+$x,1.6+$y);

        $pdf->Cell(0, 0.25, "Mobile No:____________________________", 0.25, "C");



        $y = $y-0.8;
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,2.95+$y);
        $pdf->Cell(0, 0.25, "TO", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.2+$x,3.1+$y);
        $pdf->Cell(0, 0.25, "The Controller of Examinations", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.2+$x,3.3+$y);
        $pdf->Cell(0, 0.25, "Board of Intermediate & Secondary Education,", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.2+$x,3.5+$y);
        $pdf->Cell(0, 0.25, "Gujranwala", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.4+$x,3.8+$y);
        $pdf->Cell(0, 0.25, "Sir,", 0.25, "C");


        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.9+$x,4.0+$y);

        $pdf->MultiCell(6.5, 0.2, "  I am forwarding admission forms along with the relevent enclosures of Candidates Group appearing from my Institute in the ensuring ".class_for_11th_Adm." ANNUAL EXAMINATION, ".CURRENT_SESS1." are
            ", 0,"J",0);



        // $y += 0.2;
        //$y += 0.2;
        $x = 1; 
        $dy = 4.4; 
        $pdf->SetXY(0.5,$y+$dy);
        $pdf->SetFont('Arial','',10);
        //$pdf->Cell( 0.5,0.5,"Group:",0,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.7,$y+$dy);
        $grp_name = 1;
        switch ($grp_name) {
            case '1':
                $grp_name = 'PRE-MEDICAL';
                break;
            case '7':
                $grp_name = 'PRE-ENGINEERING';
                break;
            case '8':
                $grp_name = 'HUMANITIES';
                break;
            case '2':
                $grp_name = 'GENERAL SCIENCE';
                break;
            case '5':
                $grp_name = 'COMMERCE';
                break;
            default:
                $grp_name = "No Group Selected.";
        }

        $xx= 1.5;
        $y = $y - 1.4;                
        $yy = 2.05+$y;

        // DebugBreak();

        $boxWidth = 2.6;
        $pdf->SetFont('Arial','B',7);
        $pdf->SetXY($xx,3.8+$yy);
        $pdf->SetFillColor(240,240,240);
        $pdf->Cell($boxWidth-2.2,0.2,'Sr#',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,0.2,'Group Name',1,0,'L',1);

        /* $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth-1.8,0.2,'With Late Fee',1,0,'L',1);
        $pdf->Cell($boxWidth-1.7,0.2,'Without Late fee',1,0,'L',1);*/

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth-1.5,0.2,'No. of Students.',1,0,'C',1);
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.0+$yy);
        $pdf->Cell($boxWidth-2.2,0.2,'1',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,0.2,'PRE-MEDICAL',1,0,'L',1);
        $pdf->SetFont('Arial','',10);

        /*$pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['lateFee1'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlateFee1'],1,0,'C',1);
        */$pdf->Cell($boxWidth-1.5,0.2,$result['data'][0]['grpFee1'],1,0,'C',1);

        $pdf->SetXY($xx,4.2+$yy);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell($boxWidth-2.2,0.2,'2',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,0.2,'PRE-ENGINEERING',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        /* $pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['lateFee2'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlateFee2'],1,0,'C',1);  */
        $pdf->Cell($boxWidth-1.5,0.2,$result['data'][0]['grpFee2'],1,0,'C',1);

        $pdf->SetXY($xx,4.4+$yy);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell($boxWidth-2.2,0.2,'3',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,0.2,'HUMANITIES',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        /* $pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['lateFee3'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlateFee3'],1,0,'C',1);  */
        $pdf->Cell($boxWidth-1.5,0.2,$result['data'][0]['grpFee3'],1,0,'C',1);

        $pdf->SetXY($xx,4.6+$yy);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell($boxWidth-2.2,0.2,'4',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,0.2,'GENERAL SCIENCE',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        /*$pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['lateFee4'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlateFee4'],1,0,'C',1);   */
        $pdf->Cell($boxWidth-1.5,0.2,$result['data'][0]['grpFee4'],1,0,'C',1);

        $pdf->SetXY($xx,4.8+$yy);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell($boxWidth-2.2,0.2,'5',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,0.2,'COMMERCE',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        /* $pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['lateFee5'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlateFee5'],1,0,'C',1); */
        $pdf->Cell($boxWidth-1.5,0.2,$result['data'][0]['grpFee5'],1,0,'C',1);

       /* $pdf->SetXY($xx,5+$yy);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell($boxWidth-2.2,0.2,'6',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,0.2,'ETICHS FOR NON MUSLIMS',1,0,'L',1);
        $pdf->SetFont('Arial','',10);  */
        /* $pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['lateFee5'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlateFee5'],1,0,'C',1); */
        //$pdf->Cell($boxWidth-1.5,0.2,$result['data'][0]['grpFee5'],1,0,'C',1);

        $pdf->SetXY($xx,5+$yy);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell($boxWidth-2.2,0.2,'',1,0,'C',1);

        $pdf->Cell($boxWidth-0.7    ,0.2,'Total:',1,0,'L',1);
        /*$pdf->Cell($boxWidth-1.8,0.2,$result['data'][0]['latetotalFee'],1,0,'C',1);
        $pdf->Cell($boxWidth-1.7,0.2,$result['data'][0]['wlatetotalFee'],1,0,'C',1);  */
        $pdf->Cell($boxWidth-1.5,0.2,$result['data'][0]['totalFee'],1,0,'C',1);

        $y = $y+1.2;
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.9,6.3+$y);    
        $pdf->MultiCell(6.5,0.2," Name of the candidates who have not completed the required number of attendances up to the date of the submission of their forms are being submitted provisionally and are mentioned overleaf. Final report regarding their eligibility will be sent to you in due course as instructed in the book of instructions and information.
            ",0,"J",0)    ;

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.9,7.2+$y);    
        $pdf->MultiCell(6.5,0.2," I certify that the forms have been filled in strictly according to the instructions and the certificate printed on the admission forms have been signed by me. I also certify that I have initialled all corrections made in the admission forms.

            ",0,"J",0)    ;

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.0+$y);    
        $pdf->MultiCell(8.5,0.2,"Proposed Exam. Centre:______________________________________________________________________",0,"L",0)    ;



        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.35+$y); 
        $pdf->MultiCell(8.5,0.2,"___________________________________________________________________________________________",0,"L",0)    ;   


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.7+$y);    
        $pdf->MultiCell(8.5,0.2,"Zone Code:_________________________________________________________________________________",0,"L",0)    ;   


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


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(5.4,9.95+$y);    
        $pdf->MultiCell(8.5,0.2,"NAME.____________________________",0,"L",0)    ; 

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(5.4,10.25+$y);    
        $pdf->MultiCell(8.5,0.2,"CNIC NO.__________________________",0,"L",0)    ; 

        $pdf->SetFont('Arial','UB',10);
        $pdf->SetXY(5.4,11.05+$y);    
        $pdf->MultiCell(8.5,0.2,"Signature & Stamp of Principal",0,"L",0)    ; 

        $pdf->SetFont('Arial','B',8);
         $pdf->SetXY(0.9,11.45+$y);     
        $pdf->MultiCell(8.5,0.2,'Print Date: '. date('d-m-Y H:i:s a'),0,"L",0)    ;  

        $pdf->Output('123'.'.pdf', 'I');
    }

    public function StudentsData()
    {    
        //DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '14',

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
        $this->load->model('Admission_11th_reg_model');
        $myinfo = array('Inst_cd'=>$user['Inst_Id'],'spl_cd'=>$spl_cd,'grp_cd'=>$user['grp_cd'],'grp_selected'=>$grp_selected);
        $data = array(
            'data' => $this->Admission_11th_reg_model->Make_adm($myinfo),
            'isselected' => '14',
            'grp_selected'=>$grp_selected
        );
        $data['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Admission/11th/OldStudentsData.php',$data);
        $this->load->view('common/footer11th.php');

    }
    public function StudentsData_cancelAdm()
    {    
        //DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '14',

        );

        $this->load->library('session');
        if($this->session->flashdata('error')){

            $error_msg = $this->session->flashdata('error');    

        }
        else{
            $error_msg = 0;
        }

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Admission_11th_reg_model');
        $myinfo = array('Inst_cd'=>$user['Inst_Id']);
        $data = array(
            'data' => $this->Admission_11th_reg_model->Cancel_adm($myinfo),
            'isselected' => '14',

        );
        $data['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Admission/11th/CancelAdm.php',$data);
        $this->load->view('common/footer11th.php');

    }




    public function NewEnrolment_EditForm()
    {    

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $isReAdm = 0;
        $year = 0;
        $data = array(
            'isselected' => '14',
        );
        $formno = $this->uri->segment(3);
        $this->load->model('Admission_11th_reg_model');
        if($this->session->flashdata('NewEnrolment_error')){
            //DebugBreak();

            $RegStdData['data'][0] = $this->session->flashdata('NewEnrolment_error');   
            $isReAdm = $RegStdData['data'][0]['isreadm'];
            $RegStdData['isReAdm']=$isReAdm;
            $RegStdData['Oldrno']=0;

        }
        else{
            $error['excep'] = '';

            if($this->session->flashdata('IsReAdm')){
                $isReAdm = 1;
                $year = date("Y",strtotime("-1 year"));
            }
            else{
                $isReAdm = 0;
                $year = date("Y");    
            }

            $RegStdData = array('data'=>$this->Admission_11th_reg_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0);
        }


        $this->load->view('common/menu.php',$data);
        $this->load->view('Admission/11th/Edit_Enrolement_form.php',$RegStdData);   
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 

    }
    public function NewEnrolment_update()
    {
         ///DebugBreak();

        $this->load->model('Admission_11th_reg_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 14;
        $Inst_Id = $userinfo['Inst_Id'];
        $zone = $userinfo['zone'];
        $this->commonheader($userinfo);
        if (!isset($Inst_Id))
        {   $this->load->view('login/login.php');
        }
        $error = array();

        $forms_id = "'" . implode("','", $_POST["chk"]) . "'"; // implode(",",$_POST["chk"]);

        $seltedOption = @$_POST['isformwise']; // if it is one then submit of selected forms, if it is 2 then submit group wise, if it is 3 then it is cancel selected admissions.
        $_POST['Inst_Id'] = $Inst_Id;
        $_POST['zone_cd'] = $zone;
       // $isset = $this->Admission_11th_reg_model->iszoneset($Inst_Id);
        //$_POST['zone_cd'] = $isset[0]['zone_cd'];
        $logedIn = $this->Admission_11th_reg_model->Update_NewEnorlement($_POST);
        $this->session->set_flashdata('error', 'success');
        if($seltedOption == 1 || $seltedOption == 2)
        {
            redirect('Admission_11th_reg/StudentsData_cancelAdm');
        }
        else if($seltedOption == 3)
        {
            redirect('Admission_11th_reg/StudentsData');
        }

        $this->load->view('common/footer11th.php');
    }
public function NewEnrolment_Delete($formno)
    {
        // DebugBreak();
        $this->load->model('Admission_11th_reg_model');
        $RegStdData = array('data'=>$this->Admission_11th_reg_model->Delete_NewEnrolement($formno));
        $this->load->library('session');
        $this->session->set_flashdata('error', '2');
        redirect('Admission_11th_reg/EditForms');
        return;
    }
     public function financeReoprt()
    {
        //DebugBreak();
    $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Admission_11th_reg_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id']);
        $result = array('data'=>$this->Admission_11th_reg_model->forwarding_pdf_Finance_final($fetch_data),'inst_Name'=>$user['inst_Name']);    
        if(empty($result['data']))
        {
     //   return; 
        }
        $temp = $user['Inst_Id'].'@'.Year.'@'.Session;
        //$image =  $this->set_barcode($temp);

        $this->load->library('PDFFWithOutPage');
        $pdf=new PDFFWithOutPage();   
        $pdf->SetAutoPageBreak(true,2);

        $pdf->AddPage('P',"A4");

        $fontSize = 10; 
        $marge    = .95;   // between barcode and hri in pixel
        $bx        = 175.6;  // barcode center
        $by        = 34.75;  // barcode center
        $height   = 5.7;   // barcode height in 1D ; module size in 2D
        $width    = .26;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = '222020';     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex

        $data['iyear'] = Year;
        $data['sess'] = Session;

        $Barcode = $temp;

        $result[0] = $result['data'][0];
         // DebugBreak();
        $pdf->Image("assets/img/forwardingletter11th_branch.JPG",5,6, 200,280, "JPG");
       // $pdf->Image("assets/img/M2.jpg",100, 2.8, 10, 10, "jpg");
        $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(150.6, 40);
        $pdf->Cell(0,0,'Print Date: '. date('d-m-Y H:i:s a'),0,0,'L',0);//MultiCell(8.5,0.2,'Print Date: '. date('d-m-Y H:i:s a'),0,"L",0)    ;  
        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);

        $pdf->SetFont('Arial','B',11.5);
        $pdf->SetXY(85.5, 44);
        $pdf->Cell(0,0,$data['iyear'],0,0,'L',0);



      //  DebugBreak();
        //Finance Page
        $Y = 72;
        $font = 12;
        $x = 13; 
        for($i =0 ; $i<7 ; $i++)
        {

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-2, $Y-7.5);
            //$result[0]['Total_sci']
            if($i == 6)
            {
                $pdf->SetXY($x-10, $Y-7.5);
            $pdf->Cell(0,0,$result[0]['Total_sci'],0,0,'L',0);
            }
            else if($i == 5)
            {
            $pdf->Cell(0,0,$result[0]['Total_Arts'],0,0,'L',0);
            }
            else if($i == 4)
            {      $pdf->SetXY($x-10, $Y-7.5);
            $pdf->Cell(0,0,$result[0]['Total_ArtsPr'],0,0,'L',0);
            }
            else if($i == 3)
            {        $pdf->SetXY($x-10, $Y-7.5);
            $pdf->Cell(0,0,$result[0]['Total_ReApSc'],0,0,'L',0);
            }
            else if($i == 2)
            {           $pdf->SetXY($x-5, $Y-7.5);
            $pdf->Cell(0,0,$result[0]['Total_ReApArts'],0,0,'L',0);
            }
             else if($i == 1)
            {
            $pdf->Cell(0,0,$result[0]['Total_ReApArtsPr'],0,0,'L',0);
            }
            else if($i == 0)
            {
                $pdf->SetFont('Arial','B',$font-3);
                $pdf->SetXY($x-4, $Y-7);
            $pdf->Cell(0,0,$result[0]['Total_Fee'].'/-',0,0,'L',0);
            }
             if($i==1)
            {
            $x= $x+26; 
            }
            else if($i<6)
            {
                $x= $x+22; 

                if($i==4)
                {
                $x= $x-5; 
                }
            }



        }

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-115, $Y+41);
            $pdf->Cell(0,0,$result[0]['Total_Fee'].'/-',0,0,'L',0);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-59, $Y+42);
            $pdf->Cell(0,0,$result[0]['Total_SpeCandidate'],0,0,'L',0);

       // DebugBreak();
            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-30, $Y+172);
            $pdf->Cell(0,0,$user['Inst_Id'],0,0,'L',0);
            $font = 9;
            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-68, $Y+178);
            $pdf->MultiCell(80,2.9,$user['inst_Name'],0,"L");
            $font = 12;
            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-30, $Y+198);
            $pdf->Cell(0,0,$user['phone'],0,0,'L',0);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-30, $Y+206);
            $pdf->Cell(0,0,$user['cell'],0,0,'L',0);
        /////Matric Branch Copy


        $Y = 64;
        $font = 12;
        $x = 10; 
         $pdf->AddPage('P',"A4");
        
          $pdf->Image("assets/img/forwardingletter_finance.JPG",5,6, 200,280, "JPG");
          for($i =0 ; $i<7 ; $i++)
        {
            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-1.5, $Y-2);
             if($i == 6)
            {
                $pdf->SetXY($x-8, $Y-2);
            $pdf->Cell(0,0,$result[0]['Total_sci'],0,0,'L',0);
            }
            else if($i == 5)
            {
            $pdf->Cell(0,0,$result[0]['Total_Arts'],0,0,'L',0);
            }
            else if($i == 4)
            {
            $pdf->Cell(0,0,$result[0]['Total_ArtsPr'],0,0,'L',0);
            }
            else if($i == 3)
            {

            $pdf->Cell(0,0,$result[0]['Total_ReApSc'],0,0,'L',0);
            }
            else if($i == 2)
            {

            $pdf->Cell(0,0,$result[0]['Total_ReApArts'],0,0,'L',0);
            }
             else if($i == 1)
            {

            $pdf->Cell(0,0,$result[0]['Total_ReApArtsPr'],0,0,'L',0);
            }
            else if($i == 0)
            {
                $pdf->SetFont('Arial','B',$font-3);
                $pdf->SetXY($x-4, $Y-2);
            $pdf->Cell(0,0,$result[0]['Total_Fee'].'/-',0,0,'L',0);
            }
            if($i==1)
            {
            $x= $x+26; 
            }
            else if($i<6)
            {
            if($i == 3)
            {
                $x= $x+24; 
            }

            else
            {

                $x= $x+20; 


            }

            }
        }
         $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(150.6, 45);
        $pdf->Cell(0,0,'Print Date: '. date('d-m-Y H:i:s a'),0,0,'L',0);
            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-115, $Y+47);
            $pdf->Cell(0,0,$result[0]['Total_Fee'].'/-',0,0,'L',0);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-59, $Y+47);
            $pdf->Cell(0,0,$result[0]['Total_SpeCandidate'],0,0,'L',0);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-20, $Y+185);
            $pdf->Cell(0,0,$user['Inst_Id'],0,0,'L',0);

            $font = 9;
            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-58, $Y+190);
            $pdf->MultiCell(80,2.9,$user['inst_Name'],0,"L");

            $font = 12;
            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-30, $Y+210);
            $pdf->Cell(0,0,$user['phone'],0,0,'L',0);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY($x-30, $Y+218);
            $pdf->Cell(0,0,$user['cell'],0,0,'L',0);


        //$pdf->Image("assets/img/M3.jpg",100, 2.8, 10, 10, "jpg");
        $bardata = Barcode::fpdf($pdf, $black, $bx+2, $by+5, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);

        $pdf->SetFont('Arial','B',11.5);
        $pdf->SetXY(85.5, 40);
        $pdf->Cell(0,0,$data['iyear'],0,0,'L',0);



        $pdf->Output('financeReoprt.pdf', 'I'); 
    }
    public function EditForms()
    {
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '14',

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
        $this->load->model('Admission_11th_reg_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->Admission_11th_reg_model->EditEnrolement($user['Inst_Id']),'grp_cd'=>$user['grp_cd']);
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Admission/11th/EditForms.php',$RegStdData);
        $this->load->view('common/footer11th.php');



    }

    public function ProofReading()
    {
        $data = array(
            'isselected' => '14',

        );
        $this->commonheader($data);
        $this->load->view('Admission/11th/ProofReading.php');
        $this->commonfooter();
    }

    public function Make_Batch_Group_wise()
    {
        ///DebugBreak();
        $RegGrp = $this->uri->segment(3);
        $Spl_case = $this->uri->segment(4);

        $this->load->model('Admission_11th_reg_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 14;
        $Inst_Id = $userinfo['Inst_Id'];
        $page_name  = "Create Batch";
        $User_info_data = array('Inst_Id'=>$Inst_Id,'RegGrp'=>$RegGrp,'spl_case'=>$Spl_case);
        $user_info  =  $this->Admission_11th_reg_model->user_info($User_info_data); 
        if($user_info == false)
        {
            $this->session->set_flashdata('error', '3');
            redirect('Admission_9th_reg/CreateBatch');
            return;
        }
        $is_gov            =  $user_info['info'][0]['IsGovernment'];  
        /*====================  Counting Fee  ==============================*/
        $processing_fee = 100;
        $reg_fee           = 1000;
        $Lreg_fee          = 0;
        $TotalRegFee = 0;
        $TotalLatefee = 0;
        $Totalprocessing_fee = 0;
        $netTotal = 0;
        /*====================  Counting Fee  ==============================*/    
        if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->Admission_11th_reg_model->getreulefee(1); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else if($user_info['info'][0]['feedingDate'] != null)
        {
            $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
            if(date('Y-m-d')<=$lastdate)
            {
                $rule_fee  =  $this->Admission_11th_reg_model->getreulefee(1); 
            }
        }
        else if(date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->Admission_11th_reg_model->getreulefee(2); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }

        if($is_gov == 1 && $rule_fee[0]['Rule_Fee_ID'] ==1)
        {
            $reg_fee = 0;
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
        }
        else
        {
            $reg_fee = $rule_fee[0]['Reg_Fee'];
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

        }
        // DebugBreak();
        $q1 = $user_info['fee'];
        $total_std = 0;
        foreach($q1 as $k=>$v) 
        {
            $ids[] = $v["formNo"];
            $total_std++;



            if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
            {

                if($is_gov == 1 && $rule_fee[0]['Rule_Fee_ID'] ==1)
                {
                    $reg_fee = 0;
                    $Lreg_fee = $rule_fee[0]['Fine'];
                    $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
                }
                else
                {
                    $reg_fee = $rule_fee[0]['Reg_Fee'];
                    $Lreg_fee = $rule_fee[0]['Fine'];
                    $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

                }

                if($v["Spec"] == 1 || $v["Spec"] ==  2)
                {
                    $reg_fee = 0;
                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                }
                else 
                {

                    $TotalRegFee = $TotalRegFee + $reg_fee;
                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                } 
            } 
            else
            {
                $reg_fee = $rule_fee[0]['Reg_Fee'];
                $TotalRegFee = $TotalRegFee + $reg_fee;
                $TotalLatefee = $TotalLatefee + $Lreg_fee;
                $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
            } // end of Else

            $netTotal = (int)$netTotal +$reg_fee + $Lreg_fee+$processing_fee;
        }


        $forms_id   = implode(",",$ids);        
        $tot_fee     = $Totalprocessing_fee+$TotalRegFee+$TotalLatefee;
        // $challan_No = 0;
        $today = date("Y-m-d H:i:s");
        $data = array('inst_cd'=>$Inst_Id,'total_fee'=>$tot_fee,'proces_fee'=>$processing_fee,'reg_fee'=>$reg_fee,'fine'=>$Lreg_fee,'TotalRegFee'=>$TotalRegFee,'TotalLatefee'=>$TotalLatefee,'Totalprocessing_fee'=>$Totalprocessing_fee,'forms_id'=>$forms_id,'todaydate'=>$today,'total_std'=>$total_std);
        $this->Admission_11th_reg_model->Batch_Insertion($data); 
        redirect('Admission_9th_reg/BatchList');
        return;

    }

    public function FormPrinting()
    {

        $this->load->library('session');
        //DebugBreak();
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
            'isselected' => '14',
        );
        //  DebugBreak();
        $error = array();
        $error['excep'] = '';
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['error_msg'] = $error_msg;
        $this->commonheader($data);
        $this->load->view('Admission/11th/FormPrinting.php',$error);
        $this->load->view('common/footer11th.php');
        //$this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));

        //$this->load->model('Admission_11th_reg_model');
    }
    public function RevenueList()
    {

        $this->load->library('session');
        //DebugBreak();
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
            'isselected' => '14',
        );
        //  DebugBreak();
        $error = array();
        $error['excep'] = '';
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['error_msg'] = $error_msg;
        $this->commonheader($data);
        $this->load->view('Admission/11th/RevenueList.php',$error);
        $this->load->view('common/footer11th.php');
        //$this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));

        //$this->load->model('Admission_11th_reg_model');
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
        $this->load->model('Admission_11th_reg_model');
        if($Condition == "1")
        {
            $Batch_Id = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Admission_11th_reg_model->return_pdf($fetch_data),'inst_Name'=>$user['inst_Name']);    
        }
        else if($Condition == "2")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>0);
            $result = array('data'=>$this->Admission_11th_reg_model->Print_Form_Groupwise($fetch_data));

        }

        else if($Condition == "3")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);


            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>0);
            $result = array('data'=>$this->Admission_11th_reg_model->Print_Form_Formnowise($fetch_data));
        }
        else if($Condition == "4")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Admission_11th_reg_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }
        else if($Condition == "5")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Admission_11th_reg_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }

        // DebugBreak();
        if(empty($result['data'])){
            $this->session->set_flashdata('error', $Condition);
            redirect('Admission_9th_reg/FormPrinting');
            return;

        }
        $temp = $user['Inst_Id'].'@11@'.CURRENT_SESS1;
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
        /*if($Condition==4 or $Condition == 5)
        {
            $pdf->SetTitle('Proof Print of Return');   
        }
        else
        {
            $pdf->SetTitle('Final Print of Return');
        }     */


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
        // DebugBreak();
        foreach ($result as $key=>$data) 
        {
            //DebugBreak();
            //DebugBreak();
            $i++;
            $countofrecords=$countofrecords+1;
            if($countofrecords==15) {
                $countofrecords=0;

                $pdf->AddPage();

                //     $pdf->SetFont('Arial','B',50);
                //                 $pdf->SetTextColor(255,192,203);
                //                 $pdf->Rotate(35,190,'W a t e r m a r k   d e m o',45);


               /* if($Condition==4 or $Condition == 5)
                {
                    $pdf->Image( base_url().'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG");     
                }   */

                $pdf->SetFont('Arial','U',14);
                $pdf->SetXY( 0.4,0.2);
                $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

                $pdf->SetFont('Arial','b',10);
                $pdf->SetXY(1.0,0.4);
                $pdf->Cell(0, 0.2, "STUDENT LIST OF INTERMEDIATE (PART-I) ANNUAL ".CURRENT_SESS1." ADMISSION FORMS", 0.25, "L");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(2.6,0.4);
                $pdf->Image(BARCODE_PATH.$image,6.3,0.43, 1.8, 0.20, "PNG"); 
                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(1.4,0.6);
                $pdf->Cell(0, 0.25,$user['Inst_Id']. "-". $user['inst_Name'], 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(6.9,0.8);
                $pdf->Cell(0, 0.25,  'Gender: '. ($data['sex']==1?"MALE":"FEMALE" ), 0.25, "C");
                $grp_name = $data["RegGrp"];
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
                                                        default:
                                                            $grp_name = "No GROUP SELECTED.";
                                                            }
                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(2.5,0.8);
                $pdf->Cell(0, 0.25,  'Group: '.$grp_name, 0.25, "C");


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
                $col5=$col4+1.0;    
                $col6=$col5+1.8;

                $pdf->Line($col1,$title,$col1,$ln[15]);
                $pdf->Line($col2,$title,$col2,$ln[15]);
                $pdf->Line($col3,$title,$col3,$ln[15]);
                $pdf->Line($col4,$title,$col4,$ln[15]);
                $pdf->Line($col5,$title,$col5,$ln[15]);
                $pdf->Line($col6,$title,$col6,$ln[15]);

                $pdf->SetFont('Arial','B',9);
                $pdf->Text($lmargin+.03,$title+.3,"Sr#");    //$pdf->Text(3,3,"TEXT TO DISPLAY");
                $pdf->Text($col1+.2,$title+.3,"FormNo.");

                $pdf->Text($col2+.1,$title+.2,"Name / Father`s Name");
                $pdf->Text($col2+.1,$title+.4,"Mobile No");

                $pdf->Text($col3+.1,$title+.2,"Bay Form No"); 
                $pdf->Text($col3+.1,$title+.4,"Father CNIC");

               // $pdf->Text($col4+.1,$title+.2,"Date Of Birth");
                $pdf->Text($col4+.1,$title+.31,"Relegion");
                $pdf->Text($col4+.1,$title+.45,"Old RNo-Year");

                $pdf->Text($col5+.1,$title+.3,"Subjects");

                $pdf->Text($col6+.1,$title+.3,"Picture");
            }
            $dob = date("d-m-Y", strtotime($data["Dob"]));
            $adm = date("d-m-Y", strtotime($data["edate"]));

            //============================ Values ==========================================            
            $pdf->SetFont('Arial','',10);    
            $pdf->Text($lmargin+.03  , $ln[$countofrecords]+0.3 , $SR);                 // Sr No
            $pdf->Text($col1+.05    , $ln[$countofrecords]+0.3,$data["FormNo"]);       // Form No

            $pdf->SetFont('Arial','B',8);    
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.2,strtoupper($data["name"]));
            $pdf->SetFont('Arial','',8);                
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.4,strtoupper($data["Fname"]));
            $pdf->SetFont('Arial','',7.5);                
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.55,$data["MobNo"]);
            $pdf->SetFont('Arial','',8);
            $pdf->Text($col3+.1,$ln[$countofrecords]+0.2,$data["BForm"]);
            $pdf->Text($col3+.1,$ln[$countofrecords]+0.4,$data["FNIC"]);

          //  $pdf->Text($col4+.1,$ln[$countofrecords]+0.2,$dob);
            $pdf->Text($col4+.1,$ln[$countofrecords]+0.4,$data["rel"]==1?"Muslim":"Non-Muslim");

            if($data["IsReAdm"] == '1' )
                $pdf->Text($col4+.1,$ln[$countofrecords]+0.55,strtoupper($data["oldRno_reg"]).'-'.$data["oldYear_reg"]);
            //$pdf->Text($col4+.1,$ln[$countofrecords]+0.55,'(Re-Admission)');
            else
                $pdf->Text($col4+.1,$ln[$countofrecords]+0.55,'(NEW)');

            $pdf->SetFont('Arial','B',7);    
            //            $pdf->Text($col5+.05,$ln[$countofrecords]+0.2,GroupName($data["Grp_Cd"]));
            $pdf->Text($col5+.05,$ln[$countofrecords]+0.2,  $data["sub1_abr"].','.$data["sub2_abr"].','.$data["sub3_abr"].','.$data["sub4_abr"]);
            $pdf->SetFont('Arial','',7);    
            $pdf->Text($col5+.05,$ln[$countofrecords]+0.4,$data["sub5_abr"].','.$data["sub6_abr"].','.$data["sub7_abr"]);
           // DebugBreak();

            $pdf->Image(DIRPATH11th.'/'.$data["coll_cd"].'/'.$data["PicPath"],$col6+0.05,$ln[$countofrecords]+0.05 , 0.50, 0.50, "JPG"); 

            ++$SR;


            //Certified that I have checked all the relevant record of the students and the particulars as mentioned above are correct.
            $pdf->SetFont('Arial','',8);
            $pdf->Text($lmargin+.5,10.8,"Certified that I have checked all the relevant record of the students and the particulars as mentioned above are correct.");
            //$pdf->Text($lmargin+.5,11,"Signature _____________________");
            $pdf->SetFont('Arial','',10);
            $pdf->Text($rmargin-2.5,11.2,"_____________________________________");
            $pdf->Text($rmargin-2.5,11.4,"Signature of Head of Institution with Stamp");
            $pdf->Text($lmargin+0.5,11.4,'Print Date: '. date('d-m-Y H:i:s a'));    

        }
        $pdf->Output($data["coll_cd"].'.pdf', 'I');
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
    public function GetTehName($id)
    {
       $retVal = "";
        if($id == 1) $retVal = "KAMOKE";
        else if($id == 2)  $retVal = "GUJRANWALA";
            else if($id == 3)  $retVal = "WAZIRABAD";
                else if($id == 4)  $retVal = "NOWSHERA VIRKAN";
                    else if($id == 9)  $retVal = "PINDI BHATTIAN";
                        else if($id == 10)  $retVal = "MANDI BAHA-UD-DIN";
                        else if($id == 11)  $retVal = "PHALIA";
                        else if($id == 8)  $retVal = "HAFIZABAD";
                        else if($id == 12)  $retVal = "MALAKWAL";
                        else if($id == 13)  $retVal = "NAROWAL";
                        else if($id == 14)  $retVal = "SHAKARGARH";
                        else if($id == 5)  $retVal = "GUJRAT";
                        else if($id == 6)  $retVal = "KHARIAN";
                        else if($id == 7)  $retVal = "SARAI ALAMGIR";
                        else if($id == 15)  $retVal = "SIALKOT";
                        else if($id == 16)  $retVal = "PASRUR";
                        else if($id == 17)  $retVal = "DASKA";
                        else if($id == 18)  $retVal = "SAMBRIAL";
                        else if($id == 19)  $retVal = "ZAFARWAL";
                        else if($id == 20)  $retVal = "GUJAR KHAN";
                        else if($id == 21)  $retVal = "JHANG";
                        else if($id == 22)  $retVal = "BURNALA";
                        else if($id == 23)  $retVal = "GUJAR KHAN";
                        else if($id == 24)  $retVal = "JEHLUM";

                            return $retVal; 
    }
    public function GetZoneName($zone_cd)
    {
        global $db, $user;
        $subData = $db->first("Select top 1 zone_name from matric_new..tblZones where zone_cd ='".$zone_cd."'");

        return     $subData['zone_name'];


    }

    public function revenue_pdf()
    {
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Admission_11th_reg_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id']);


        $option = $this->uri->segment(4);
        $fetch_data['option'] = $option;
        $grp_cd = 0;
        $startformno = '';
        $endformno = '';
        if($option == 4)
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data['grp_cd'] = $grp_cd;
        }
        else if($option == 5)
        {

            $startformno = $this->uri->segment(3);
            $endformno = $this->uri->segment(5);
            $fetch_data['startformno'] = $startformno;
            $fetch_data['endformno'] = $endformno;
        }


        $temp = $user['Inst_Id'].'@11@'.Session;
        $image =  $this->set_barcode($temp);
        // --------------------------------------- Fee Calculation Section ------------------------------------------------
       // DebugBreak();
        $User_info_data = array('Inst_Id'=>$user['Inst_Id'], 'date' => date('Y-m-d'));
        $user_info  =  $this->Admission_11th_reg_model->getuser_info($User_info_data); 
        $isfine = 0;
        $Total_fine = 0;
        // Declare Science & Arts Fee's According to Fee Table .  Note: this will assign to Triple date fee. After triple date it will not asign fees.
        if(!empty($user_info['rule_fee'])) 
        {
            if($user_info['rule_fee'][0]['isPrSub']==1)
            {
                $SciAdmFee = $user_info['rule_fee'][0]['Amount'];
                $SciProcFee = $user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

            } else if( $user_info['rule_fee'][1]['isPrSub']== 1 )
            {
                $SciAdmFee = $user_info['rule_fee'][1]['Amount'];
                $SciProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

            }
            if($user_info['rule_fee'][0]['isPrSub']==0)
            {
                $ArtsAdmFee = $user_info['rule_fee'][0]['Amount'];
                $ArtsProcFee =$user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                //$ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];
            }
            else if($user_info['rule_fee'][1]['isPrSub']== 0 )
            {
                $ArtsAdmFee = $user_info['rule_fee'][1]['Amount'];
                $ArtsProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                //$ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];
            }
        }
        else
        {
            $date = new DateTime(SingleDateFee);
            $singleDate =  $date->format('Y-m-d');                                                                     
            $User_info_data = array('Inst_Id'=>$user['Inst_Id'], 'date' => $singleDate);
            $user_info  =  $this->Admission_11th_reg_model->getuser_info($User_info_data);
            if($user_info['rule_fee'][0]['isPrSub']==1)
            {
                $SciAdmFee = $user_info['rule_fee'][0]['Amount'];
                $SciProcFee = $user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

            } else if( $user_info['rule_fee'][1]['isPrSub']== 1 )
            {
                $SciAdmFee = $user_info['rule_fee'][1]['Amount'];
                $SciProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

            }
            if($user_info['rule_fee'][0]['isPrSub']==0)
            {
                $ArtsAdmFee = $user_info['rule_fee'][0]['Amount'];
                $ArtsProcFee =$user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
               // $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];
            }
            else if($user_info['rule_fee'][1]['isPrSub']== 0 )
            {
                $ArtsAdmFee = $user_info['rule_fee'][1]['Amount'];
                $ArtsProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                //$ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];
            }

            $TripleDate = date('Y-m-d',strtotime(TripleDateFee9th)); 
            $now = date('Y-m-d'); // or your date as well
            $days = (strtotime($TripleDate) - strtotime($now)) / (60 * 60 * 24);
            $fine = 500;
            $days = abs($days);

            $SciAdmFee =  ($SciAdmFee*3); 
            $ArtsAdmFee = ($ArtsAdmFee*3); 
            $Total_fine = $days*$fine;
            // For ReAdmission 
            $SciAdmFee_ReAdm =  ($SciAdmFee_ReAdm*3); 
            $ArtsAdmFee_ReAdm = ($ArtsAdmFee_ReAdm*3);



        }

        // Newly Affiliated Admission Fee   Deals Private and Govt. institutes 
        $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
        if($user_info['info'][0]['feedingDate'] != null && (date('Y-m-d')<=$lastdate) )
        {
            if($user_info['info'][0]['IsGovernment'] == 2)
            {
                $date = new DateTime(SingleDateFee);
                $singleDate =  $date->format('Y-m-d'); 
                $User_info_data = array('Inst_Id'=>$user['Inst_Id'], 'date' => $singleDate);
                $user_info  =  $this->Admission_11th_reg_model->getuser_info($User_info_data); 
                if($user_info['rule_fee'][0]['isPrSub']==1)
                {
                    $SciAdmFee = $user_info['rule_fee'][0]['Amount'];
                    $SciProcFee = $user_info['rule_fee'][0]['Processing_Fee'];
                    // For ReAdmission Fee
                    $SciAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                    $SciProcFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

                } else if( $user_info['rule_fee'][1]['isPrSub']== 1 )
                {
                    $SciAdmFee = $user_info['rule_fee'][1]['Amount'];
                    $SciProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                    // For ReAdmission Fee
                    $SciAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                    $SciProcFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

                }
                if($user_info['rule_fee'][0]['isPrSub']==0)
                {
                    $ArtsAdmFee = $user_info['rule_fee'][0]['Amount'];
                    $ArtsProcFee =$user_info['rule_fee'][0]['Processing_Fee'];
                    // For ReAdmission Fee
                    $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                    //$ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];
                }
                else if($user_info['rule_fee'][1]['isPrSub']== 0 )
                {
                    $ArtsAdmFee = $user_info['rule_fee'][1]['Amount'];
                    $ArtsProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                    // For ReAdmission Fee
                    $ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                    //$ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];
                }
            }
           /* else
            {

                if($user_info['rule_fee'][0]['isPrSub']==1)
                {
                    $SciAdmFee = 0;
                    $SciProcFee = $user_info['rule_fee'][0]['Processing_Fee'];
                    // For ReAdmission Fee
                    $SciAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                    $SciProcFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

                } else if( $user_info['rule_fee'][1]['isPrSub']== 1 )
                {
                    $SciAdmFee = 0;
                    $SciProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                    // For ReAdmission Fee
                    $SciAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                    $SciProcFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

                }
                if($user_info['rule_fee'][0]['isPrSub']==0)
                {
                    $ArtsAdmFee = 0;
                    $ArtsProcFee =$user_info['rule_fee'][0]['Processing_Fee'];
                    // For ReAdmission Fee
                    $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                    //$ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];
                }
                else if($user_info['rule_fee'][1]['isPrSub']== 0 )
                {
                    $ArtsAdmFee = 0;
                    $ArtsProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                    // For ReAdmission Fee
                    $ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                    //$ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];
                }
            } */



        }  

        //DebugBreak();
        // Govt. Institutes no Adm Fee for Single Date.
        $date = new DateTime(SingleDateFee);
        $singleDate =  $date->format('Y-m-d'); 
       /* if(date('Y-m-d') <= $singleDate && $user_info['info'][0]['IsGovernment'] == 1)
        {    
            if($user_info['rule_fee'][0]['isPrSub']==1)
            {
                $SciAdmFee = 0;
                $SciProcFee = $user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

            } else if( $user_info['rule_fee'][1]['isPrSub']== 1 )
            {
                $SciAdmFee = 0;
                $SciProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

            }
            if($user_info['rule_fee'][0]['isPrSub']==0)
            {
                $ArtsAdmFee = 0;
                $ArtsProcFee =$user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
               // $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];
            }
            else if($user_info['rule_fee'][1]['isPrSub']== 0 )
            {
                $ArtsAdmFee = 0;
                $ArtsProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
               // $ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];
            } 

        }   */

        // --------------------------------------- Fee Calculation Section END------------------------------------------------


        // DebugBreak();
        $data = array('data'=>$this->Admission_11th_reg_model->revenue_pdf($fetch_data),'inst_Name'=>$user['inst_Name'],'inst_cd'=>$user['Inst_Id'],'barcode'=>@$image,"SciAdmFee"=>@$SciAdmFee,"ArtsAdmFee"=>@$ArtsAdmFee,"SciProcFee"=>@$SciProcFee,"ArtsProcFee"=>@$ArtsProcFee);
        //
        // ------------------------------------- Assign Each Candidate Fee According to Special case, Re-Admission ,Government Candidate and Newly Affiliated Institutes.
        if(empty($data['data']['stdinfo']))
        {
            $this->session->set_flashdata('error','No any student exists agiants this keyword!');
            redirect('Admission_11th_reg/RevenueList');
        }
        $n=0;
        $AllStdFee = array();
        $SciProcFee = 195;
        $ArtsProcFee = 195;
        
        $practical_Sub = array(
            'LibSC'=>'8',
            'GEO'=>'12',
            'PSY'=>'16',
            'ST'=>'18',
            'H-ECO'=>'21',
            'F/ART'=>'23',
            'CP'=>'38',
            'HPD'=>'42',
            'BIO'=>'46',
            'PHY'=>'47',
            'CH'=>'48',
            'Cl/T'=>'75',
            'HM'=>'76',
            'NUR'=>'79',
            'CSc'=>'83',
            'AGRI'=>'90',
            'TYP'=>'96',
            'CST'=>'98',

        );
        
 
        foreach($data['data']['stdinfo'] as $key=>$vals)
        { $n++;
        
       // echo '<pre>'; print_r($vals);
           //    die;
        
       // DebugBreak();
            // Check sub6 , sub7 and sub8 practical subj or not.
            //if( $this->practicalsubjects($vals->sub6)|| $this->practicalsubjects($vals->sub7)|| $this->practicalsubjects($vals->sub8))
          
       
          
            if( $vals->grp_cd == 1 || $vals->grp_cd == 2 || $vals->grp_cd == 4 || (array_search($vals->sub4,$practical_Sub) || array_search($vals->sub5,$practical_Sub) || array_search($vals->sub6,$practical_Sub) ||  array_search($vals->sub7,$practical_Sub)))
            {
                if($vals->IsReAdm==1)
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>$SciAdmFee_ReAdm,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$SciProcFee,'AdmTotalFee'=>$SciAdmFee_ReAdm+$SciProcFee+$Total_fine);
                }
                else if($vals->Spec>0 && (date('Y-m-d') <= $singleDate || $user_info['info'][0]['feedingDate'] != null && (date('Y-m-d')<=$lastdate)) )
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>0,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$SciProcFee,'AdmTotalFee'=>$SciProcFee+$Total_fine);
                }
                else
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>$SciAdmFee,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$SciProcFee,'AdmTotalFee'=>$SciAdmFee+$SciProcFee+$Total_fine);
                }
            }
            else
            {
                if($vals->IsReAdm==1)
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>$ArtsAdmFee_ReAdm,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$ArtsProcFee,'AdmTotalFee'=>$ArtsAdmFee_ReAdm+$ArtsProcFee+$Total_fine);
                }
                else if($vals->Spec>0 && (date('Y-m-d') <= $singleDate || $user_info['info'][0]['feedingDate'] != null && (date('Y-m-d')<=$lastdate)) )
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>0,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$ArtsProcFee,'AdmTotalFee'=>$ArtsProcFee+$Total_fine);
                }
                else
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>$ArtsAdmFee,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$ArtsProcFee,'AdmTotalFee'=>$ArtsAdmFee+$ArtsProcFee+$Total_fine);
                }
            }
        }

        $mydata_final = array( 'data'=>$this->Admission_11th_reg_model->Update_AdmissionFee($AllStdFee,$user['Inst_Id'],$grp_cd,$option,$startformno,$endformno),'AllFeeData'=>$AllStdFee,'Inst_cd'=>$user['Inst_Id'],'Inst_Name'=>$user['inst_Name'],'barcode'=>$image);

        $this->load->view('Admission/11th/RevenueForm.php',$mydata_final);
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
    public function commonheader($data)
    {
        $this->load->view('common/header.php',$data);
        $this->load->view('common/menu.php',$data);
    } 
    public function commonfooter($data)
    {
        $this->load->view('common/footer11th.php',$data);
    }
    public function Print_Admission_Form_Groupwise()
    {

        //  DebugBreak();
        $Condition = $this->uri->segment(4);

        $this->load->library('session');

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Admission_11th_reg_model');

        if($Condition == "1")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Admission_11th_reg_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);
        }
        else if($Condition == "2")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Admission_11th_reg_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);
            //Print_Form_Formnowise
        }


        if(empty($result['data'])){
            $this->session->set_flashdata('error', 'No Found');
            redirect('Admission_11th_reg/FormPrinting');
            return;

        }


        $this->load->library('PDF_Rotate');


        $pdf = new PDF_Rotate('P','in',"A4");
        //      $this->load->library('PDFF');
        //        $pdf=new PDFF('P','in',"A4");  
        //$pdf->AliasNbPages();
        //$pdf->SetMargins(0.5,0.5,0.5);
        $grp_cd = $this->uri->segment(3);

        // $pdf->SetTitle('Proof Print Registration From');

        $fontSize = 10;
        $marge    = .4;   // between barcode and hri in pixel
        $x        = 7.5;  // barcode center
        $y        = 1.2;  // barcode center
        $height   = 0.35;   // barcode height in 1D ; module size in 2D
        $width    = .013;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $type     = 'code128';
        $black    = '000000'; // color in hex
        //         DebugBreak();
        $result = $result['data'] ;
        //if(!empty($result)):
        foreach ($result as $key=>$data) 
        {

            //First Page ---class instantiation    
            //$pdf = new FPDF_BARCODE("P","in","A4");      
               $pdf->SetAutoPageBreak(true )      ;
            $pdf->AddPage();
            $Y = 0.4;

            //--------------------------- Subject Group
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
                                                        default:
                                                            $grp_name = "No GROUP SELECTED.";
                                                            }

            $pdf->SetFillColor(0,0,0);
            $pdf->SetDrawColor(0,0,0); 

            $temp = $data['FormNo'].'@11@'.Session.'@'.Year; 
            $image =  $this->set_barcode($temp);
            $pdf->Image(BARCODE_PATH.$image,3.0, 0.7  ,2.2,0.30,"PNG");
            $pdf->Image(BARCODE_PATH.$image,3.0, 11.34  ,2.2,0.30,"PNG");

            //DebugBreak(); 
            $x=0;
            $pdf->SetFont('Arial','U',14);
            $pdf->SetXY( 1,0.2);
            $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

            $pdf->Image("assets/img/logo2.png",0.5,0.2, 0.75,0.75, "PNG");
            $pdf->SetXY( 1,0.5);
            $pdf->Image("assets/img/11th.png",7.5,0.5, 0.50,0.50, "PNG");        

            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(2.3,0.4);
            if(Session == 1)
            {
                $ses = "ANNUAL";
            }
            else{
                $ses = "SUPPLYMENTARY";
            }
            $pdf->Cell(0, 0.25,@$data["regPvt"]==1?"ADMISSION FORM FOR INTERMEDIATE (PART-I) ".$ses." EXAMINATION, ".Year :" ADMISSION FORM FOR INTERMEDIATE (PART-I) ".$ses." EXAMINATION, ".Year, 0.25, "C");


            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.4,1.0);
            $pdf->Cell(0, 0.25,@$data["regPvt"]==1?"(FOR REGULAR CANDIDATE)":"(FOR PRIVATE CANDIDATE)",0,'L',"C");

            //--------------------------- Form No & Rno

            $pdf->SetXY(0.5,0.89+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Form No: _________________",0,'L');

            $pdf->SetXY(1,0.85+$Y);
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell( 0.5,0.5,@$data['FormNo'],0,'L');

            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(4.99,0.85+$Y);
            $pdf->Cell(0.5,0.5, "Roll No: _______________",0,'L');    
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(5.88,0.99+$Y);
            $pdf->Cell(0.5,0.5, "(For office use only)",0,'L');




            if(@$data["regPvt"]==1)
            {
                $pdf->SetXY(0.5,1.2+$Y);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell( 0.5,0.5,'('.$user['Inst_Id'].')'.'-'.$user['inst_Name'],0,'R');
            }

            //------------- Personal Infor Box
            //====================================================================================================================

            $x = 0.55;
            $pdf->SetXY(0.5,1.6+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(7.6,0.2,'PERSONAL INFORMATION',1,0,'L',1);

            $Y = 0.2;
            $pdf->Image(DIRPATH11th.'/'.$user['Inst_Id'].'/'.$data["PicPath"],6.0+$x,2.4+$Y , 1.30, 1.30, "JPG");
            //$pdf->Image(DIRPATH11th.'/'.$data["Sch_cd"].'/'.$data["PicPath"],6.0+$x,2.4+$Y , 1.30, 1.30, "JPG");
            //DebugBreak();
           /* if($user['gender']==1)
            {
            $pdf->Image(DIRPATH11th.'2510010001.jpg',6.0+$x,2.4+$Y , 1.30, 1.30, "JPG");
            }
            else
            {
            $pdf->Image(DIRPATH11th.'130659.jpg',6.0+$x,2.4+$Y , 1.30, 1.30, "JPG");
            }*/
             $pdf->SetFont('Arial','B',23);
            $pdf->TextWithRotation($x-0.2,2.8+$Y, $data['FormNo'],90,0);
            //--------------------------- 1st line 
            $pdf->SetXY(0.5, 2+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Name:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.6,2+$Y); 
            $pdf->Cell(0.5,0.5,strtoupper(@$data["name"]),0,'L');
            //--------------------------- FATHER Name 
            $pdf->SetXY(3.1+$x,2+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Father's Name:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.4+$x,2+$Y);
            $pdf->Cell(0.5,0.5,strtoupper(@$data["Fname"]),0,'L');




            //--------------------------- BAY FORM NO line 
            $pdf->SetXY(0.5, 2.3+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Bay Form:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.6,2.3+$Y);
            $pdf->Cell(0.5,0.5,@$data["BForm"],0,'L');


            $pdf->SetXY(3.1+$x,2.3+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0.5,0.5,"Father/Guardian's CNIC:",0,'R');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.4+$x,2.3+$Y);
            $pdf->Cell(0.5,0.5,@$data["FNIC"],0,'L');


            //--------------------------- Gender Nationality 
            $locality = "";
            if(@$data['ruralOrurban']==1)
            {
            $locality = "URBAN";
            }
            else
            {
            $locality = "RURAL";
            }
            $pdf->SetXY(0.5,2.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Locality:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.6,2.6+$Y);
            $pdf->Cell(0.5,0.5,$locality,0,'L');

            $pdf->SetXY(3.1+$x,2.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"College Roll No:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.4+$x,2.6+$Y);
            $pdf->Cell(0.5,0.5,@$data["classRno"],0,'R');         

            // DebugBreak();
            $pdf->SetXY(3.1+$x,2.9+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Registration No:",0,'L');  
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.4+$x,2.9+$Y);
            $pdf->Cell(0.5,0.5,@$data["strRegNo"],0,'L');

            //--------------------------- RELEGION line 
            $pdf->SetXY(0.5,2.9+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Religion:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.6,2.9+$Y);
            $pdf->Cell(0.5,0.5,@$data["rel"]==1?"MUSLIM":"NON-MUSLIM",0,'L');

           /* if(@$data["RegPvt"]==1)
            {
                $pdf->SetXY(3.1+$x,2.9+$Y);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(0.5,0.5,"Locality:",0,'R');
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(4.4+$x,2.9+$Y);
                $pdf->Cell(0.5,0.5,@$data["RuralORUrban"]==1?"RURAL":"URBAN",0,'L');
            }      */


            //--------------------------- id mark and Medium 
            $pdf->SetXY(0.5,3.2+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Speciality:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.6,3.2+$Y);
            $pdf->Cell(0.5,0.5,$this->GetSpeciality(@$data["Spec"]),0,'L');


            $pdf->SetXY(3.1+$x,3.2+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Medium:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.4+$x,3.2+$Y);
            $pdf->Cell(0.5,0.5,@$data["med"]==1?"URDU":"ENGLISH",0,'L');            
            //--------------------------- Speciality and Internal Grade 
            $pdf->SetXY(0.5,3.5+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Cell No:",0,'L');
            $pdf->SetXY(0.49,3.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"(Candidate/Guardian's)",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.6,3.5+$Y);
            $pdf->Cell(0.5,0.5,strtoupper(@$data["MobNo"]),0,'L');



            //--------------------------- Speciality and Internal Grade 
            $pdf->SetXY(0.5,3.8+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Nationality:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.6,3.8+$Y);
            $pdf->Cell(0.5,0.5,@$data["nat"]==1?"PAKISTANI":"NON-PAKISTANI",0,'L');




            $pdf->SetXY(3.1+$x,3.8+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Identification Mark:",0,'L');
            $pdf->SetFont('Arial','b',8);
            $pdf->SetXY(4.4+$x,3.8+$Y);
            $pdf->Cell(0.5,0.5,@$data["markOfIden"],0,'R');

            //DebugBreak();

            /*$pdf->SetXY(5.5+$x,3.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Locality:",0,'L');*/
            $pdf->SetFont('Arial','b',8);
            $pdf->SetXY(6.4+$x,3.6+$Y);
            $pdf->Cell(0.5,0.5,@$data["sex"]==1?"MALE":"FEMALE",0,'R');

            $pdf->SetXY(3.1+$x,3.5+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Admission:",0,'L');
            $pdf->SetFont('Arial','b',8);
            $pdf->SetXY(4.4+$x,3.5+$Y);
            $pdf->Cell(0.5,0.5,@$data["IsReAdm"]==1?"RE-ADMISSION":"FRESH",0,'R');

            //--------------------------- Speciality and Internal Grade 

            //DebugBreak();
            //===================================
            //------------- Contact Info Box
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.5,4.2+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(7.6,0.2,'CONTACT INFORMATION',1,0,'L',1);
            //--------------------------- 8th line 



           //  DebugBreak();

                //    //__TEHSIL
                $pdf->SetXY(0.5,4.3+$Y);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(0.5,0.5,"District:",0,'R');
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(0.90,4.3+$Y);
                $pdf->Cell( 0.5,0.5, $this->GetDistName($user["dist"]),0,'L'); 


             ////----- DISTRICT   


                $pdf->SetXY(2.1,4.3+$Y);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(0.5,0.5,"Tehsil:",0,'L');
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(2.5,4.3+$Y);
                $pdf->Cell( 0.5,0.5,$this->GetTehName($user['teh']),0,'L');


            //    //__ Head of Institution Cell No.

            $pdf->SetXY(3.7,4.3+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0.5,0.5,"Institute Contact No:",0,'R');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.8,4.3+$Y);
            $pdf->Cell( 0.5,0.5,$user["cell"],0,'L');

           // DebugBreak();
            $pdf->SetXY(5.7,4.3+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0.5,0.5,"Zone:",0,'R');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(6.0,4.3+$Y);
            $pdf->Cell( 0.5,0.5,@$data["zone_cd"]."-".strtoupper(@$data["zone_name"]),0,'L');


            //__Address
            $pdf->SetXY(0.5,4.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Home Address in English:",0,'L');
            $pdf->SetFont('Arial','b',8);
            $pdf->SetXY(1.8,4.6+$Y);
            $pdf->Cell(0.5,0.5,strtoupper(@$data["addr"]),0,'L');
            //__Address in urdu
            $pdf->SetXY(0.5,4.9+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Home Address in Urdu:  _____________________________________________________________________________________________________",0,'L');

            if(@$data["RegPvt"]==2)
            {
                $pdf->SetXY(0.5,5.3+$Y);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(0.5,0.5,"Proposed Exam Centre In Urdu:",0,'L');
                $pdf->SetXY(2.10,5.4+$Y);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(0.7,0.5+$Y,"_________________________________________________________________________________________",0,'L');
            }

                  $Y = $Y + 0.3  ;
            //--------------------------- 7th line 
            //if(@$data["IsReAdm"]==1)
           // {

                //------------- Old Exam Infor if any Box
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(0.5,5+$Y);
                $pdf->SetFillColor(240,240,240);
                $pdf->Cell(7.6,0.2,'SSC EXAMINATION INFORMATION  ',1,0,'L',1);         

                $pdf->SetXY(0.5,5.1+$Y);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell( 0.5,0.5,"Roll No:",0,'L');

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(0.95,5.1+$Y);
                $pdf->Cell(0.5,0.5,@$data["matRno"],0,'L');

                $pdf->SetXY(1.5,5.1+$Y);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell( 0.5,0.5,"Year:",0,'L');
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(1.95,5.1+$Y);
                $pdf->Cell(0.5,0.5,@$data["yearOfPass"],0,'L');

                 $pdf->SetXY(2.8,5.1+$Y);
                 $pdf->SetFont('Arial','',8);
                 $pdf->Cell( 0.5,0.5,"Session:",0,'L');
                 $pdf->SetFont('Arial','B',8);
                 $pdf->SetXY(3.3,5.1+$Y);
                 $pdf->Cell(0.5,0.5,@$data["sessOfPass"]==1?"Annual":"Supplementary",0,'R');

               // DebugBreak();
                $pdf->SetXY(4.5,5.1+$Y);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell( 0.5,0.5,"Board:",0,'L');
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(4.95,5.1+$Y);
                $pdf->Cell(0.5,0.5,@$data["matBrd_name"],0,'L');
                     $Y = $Y + 0.5  ;

                //------------- Old Exam Infor if any Box
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(0.5,5+$Y);
                $pdf->SetFillColor(240,240,240);
                $pdf->Cell(7.6,0.2,'PREVIOUS INTERMEDIATE (PART-I/II) EXAMINATION INFORMATION  ',1,0,'L',1);         

                $pdf->SetXY(0.5,5.1+$Y);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell( 0.5,0.5,"Roll No:",0,'L');
                 //DebugBreak();
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(0.95,5.1+$Y);
                if(isset($data["oldRno_reg"]) && $data["oldRno_reg"] != 0)
                {
                $pdf->Cell(0.5,0.5,@$data["oldRno_reg"],0,'L');
                }
                else
                {
                $pdf->Cell(0.5,0.5,'',0,'L');
                }


                $pdf->SetXY(1.5,5.1+$Y);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell( 0.5,0.5,"Year:",0,'L');
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(1.95,5.1+$Y);
                 if(isset($data["oldYear_reg"]) && $data["oldYear_reg"] != 0)
                {
                $pdf->Cell(0.5,0.5,@$data["oldYear_reg"],0,'L');
                }
                else
                {
                $pdf->Cell(0.5,0.5,'',0,'L');
                }


                 $pdf->SetXY(2.8,5.1+$Y);
                 $pdf->SetFont('Arial','',8);
                 $pdf->Cell( 0.5,0.5,"Session:",0,'L');
                 $pdf->SetFont('Arial','B',8);
                 $pdf->SetXY(3.3,5.1+$Y);
                 if(isset($data["oldSess_reg"]) && $data["oldSess_reg"] != 0)
                {
                $pdf->Cell(0.5,0.5,@$data["oldSess_reg"]==1?"Annual":"Supplementary",0,'R');
                }
                else
                {
                $pdf->Cell(0.5,0.5,'',0,'R');
                }



                /* $pdf->SetXY(4.5,5.1+$Y);
                 $pdf->SetFont('Arial','',8);
                 $pdf->Cell( 0.5,0.5,"Board:",0,'L');
                 $pdf->SetFont('Arial','B',8);
                 $pdf->SetXY(4.9,5.1+$Y);
                 $pdf->Cell(0.5,0.5,@$data["InterBrd_name"],0,'R');   */


           // }



            //------------- Exam Info Box
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.5,5.7+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(7.6,0.2,'EXAMINATION INFORMATION',1,0,'L',1);
            //---------------------- Feeding DATE      
            $pdf->SetFont('Arial','U',7);
            $pdf->SetXY(4.0,5.6+$Y);
            $pdf->Cell(0.3,0.4,"FEEDING DATE:",0,'L');        
            $pdf->SetXY(4.8,5.6+$Y);
            $pdf->SetFont('Arial','IB',7);
            $fedDate = @$data['cDate'];
            $newDate = date("d-M-Y h:i A", strtotime($fedDate));
            $pdf->Cell(0.5,0.4,$newDate,0,'L');
            //---------------------- Printing DATE                      
            $pdf->SetFont('Arial','UI',7);
            $pdf->SetXY(5.95,5.6+$Y);
            $pdf->Cell(0.3,0.4,"DOWNLOAD ON:",0,'L');        
            $pdf->SetXY(6.8,5.54+$Y);
            $pdf->SetFont('Arial','IB',7);

            $date = date('d-M-Y h:i A');
            $newdate = strtotime ( '+5 hour' , strtotime ( $date ) ) ;
            $newdate = date ( 'd-M-Y h:i A' , $newdate );
            //echo $newdate;

            $pdf->Cell(0.5,0.5,$newdate,0,'L');
            //__ Exam info

            //--------------------------- Subject Group
            $pdf->SetXY(0.8,5.9+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Group:",0,'L');

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.3,5.9+$Y);
            $pdf->Cell(0.5,0.5,"_______________________________",0,'L');    
            $pdf->SetXY(1.3,5.9+$Y);
            $pdf->Cell(0.5,0.5,$grp_name,0,'L');             

            $bx = 6.8; 
            $by = 6.0;

            //$bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);
            //$len = $pdf->GetStringWidth($bardata['hri']);
            //Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);



            //====================================subjects
            $x = 1;     

             $pdf->SetFont('Arial','',6);
            $pdf->SetXY(6.5,6.25+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(1.3,1.4,'Paste Recent Photograph',1,0,'C',1);

            $pdf->SetFont('Arial','B',6);
            $pdf->SetXY(6.48,7.49+$Y);
            //$pdf->SetFillColor(260,260,260);
            $pdf->Cell(0.5,0.5,'Photo must be cross attested',0,'C');   


            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(0.5,6.25+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(4.6,0.2,'Subjects: Part-I',1,0,'C',1); 

            $Y = $Y+0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,6.25+$Y);
            $pdf->SetFillColor(260,260,260);
            $pdf->Cell(4.6,0.2,@$data['sub1Ap1'] != 1 ? '':   '1. '. (@$data['sub1_NAME']),1,0,'L',1); 

            $Y = $Y+0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,6.25+$Y);
            $pdf->SetFillColor(260,260,260);
            $pdf->Cell(4.6,0.2,@$data['sub2Ap1'] != 1 ? '':   '2. '. (@$data['sub2_NAME']),1,0,'L',1); 

            $Y = $Y+0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,6.25+$Y);
            $pdf->SetFillColor(260,260,260);
            $pdf->Cell(4.6,0.2,@$data['sub3Ap1'] != 1 ? '':   '3. '. (@$data['sub3_NAME']),1,0,'L',1);

            $Y = $Y+0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,6.25+$Y);
            $pdf->SetFillColor(260,260,260);
            $pdf->Cell(4.6,0.2,@$data['sub4Ap1'] != 1 ? '':   '4. '. (@$data['sub4_NAME']),1,0,'L',1);

            $Y = $Y+0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,6.25+$Y);
            $pdf->SetFillColor(260,260,260);
            $pdf->Cell(4.6,0.2,@$data['sub5Ap1'] != 1 ? '':   '5. '. (@$data['sub5_NAME']),1,0,'L',1);

            $Y = $Y+0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,6.25+$Y);
            $pdf->SetFillColor(260,260,260);
            $pdf->Cell(4.6,0.2,@$data['sub6Ap1'] != 1 ? '':   '6. '. (@$data['sub6_NAME']),1,0,'L',1);
              //DebugBreak();
            if(@$data['sub7Ap1']!=0)
            {
              $Y = $Y+0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,6.25+$Y);
            $pdf->SetFillColor(260,260,260);
            $pdf->Cell(4.6,0.2,@$data['sub7Ap1'] != 1 ? '':   '7. '. (@$data['sub7_NAME']),1,0,'L',1);
            }





            //------ Picture Box on right side with subjects list    
            if(@$data["regPvt"]==2)
            {
                $pdf->SetXY(4.9+$x,6.2+$Y);
                $pdf->Cell(2,1.1,'',1,0,'C',0); 
                $pdf->SetXY(4.5+$x,6.6+$Y);
                $pdf->SetFont('Arial','B',14);
                $pdf->MultiCell(2.5,0.2,"OWO Stamp",0,'C');   
            }

            $Y = $Y -1.4;
            //*********************************** Affidavit ***************************** 
            $pdf->SetXY(0.5,7.95+$Y);
            $pdf->SetFont('Arial','UIB',8);
            $pdf->Cell( 0,0,'Affidavit:',0,'L');

            $pdf->SetXY(0.5,8+$Y);
            $pdf->SetFont('Arial','',9);
            $pdf->MultiCell( 7,0.2,"    I have read this admission form. The data/information on this form and in online system is same as last entered/modified/provided by me and its correctness is only my responsbility. I understand that only the information/data provided in the online system alongwith photograph and some other handwritten details on this form will be used for further processing. I accept all the terms and conditions in this  regard.",0);
            //------ Thumb Box on Centre      

            $pdf->SetFont('Arial','',6);
            $pdf->SetXY(0.5,8.76+$Y);
            $pdf->Cell(2,0.45,'',1,0,'C',0); 
            $pdf->SetXY(0.5,9.15+$Y);
            $pdf->Cell(0,0,"Candidate's signature in Urdu",'',0,'L',0); 

            $pdf->SetFont('Arial','',6);
            $pdf->SetXY(2.9,8.76+$Y);
            $pdf->Cell(4.8,1.550,'',1,0,'C',0); 
            $pdf->SetXY(2.9,9.0+$Y); 
            $pdf->Cell(0,0,"Name Head of Institute:_____________________________________________________________________",'',0,'L',0); 
            $pdf->SetXY(2.9,9.1+$Y);
            $pdf->Cell(4,0.45,"CNIC No:_____________________________",'',0,'L',0); 
            $pdf->SetXY(2.9,9.6+$Y);
            $pdf->Cell(0,0,"Mobile No:____________________________",'',0,'L',0); 
            $pdf->SetXY(2.9,9.65+$Y);
            $pdf->Cell(4,0.45,"Landline No:___________________________",'',0,'L',0);                      
            $pdf->SetXY(2.9,9.9+$Y);
            $pdf->Cell(4,0.45,"EMIS Code(If Government Institute):_________________________                      ________________________________",'',0,'L',0); 
            $pdf->SetXY(2.9,10.0+$Y);
            $pdf->Cell(4,0.45,"                                                                                                                                                         Stamp/Signature",'',0,'L',0); 

            $pdf->SetXY(0.5,9.2+$Y);
            $pdf->Cell(2,0.45,'',1,0,'C',0); 
            $pdf->SetXY(0.5,9.6+$Y);
            $pdf->Cell(0,0,"Candidate's signature in English",'',0,'L',0); 

            $pdf->SetXY(0.5,9.65+$Y);            
            $pdf->Cell(2,0.65,'',1,0,'C',0); 
            $pdf->SetXY(0.5,10.2+$Y);
            $pdf->Cell(0,0,"Thumb Impression",'',0,'L',0); 


            //---------------------------------------------------------------------------
           /* $pdf->SetXY(2.6,8.9+$Y);
            $pdf->Cell(1.8,0.8,'',1,0,'C',0); 

            $pdf->SetXY(2.6,9.2+$Y);
            $pdf->Cell(1.5,0.75,'Thumb Impression','',0,'L',0); 
            //---------------------------------------------------------------------------
            $pdf->SetFont('Arial','',6);
            $pdf->SetXY(2.6,9.8+$Y);
            $pdf->Cell(3.7,0.8,'',1,0,'C',0); 
            $pdf->SetXY(2.6,10.3+$Y);
            $pdf->MultiCell(4.5,0.3,@$data["regPvt"]==1?"Attestation of Head/Deputy Head of Institution":"Attestation of Principal/V.Prinicipal/ Headmaster/Headmistress/ Dy.Headmaster/ Dy. Headmistress",0,'L'); 






            //---------------------------------------------------------------------------

            $pdf->SetXY(0.5,9.8+$Y);
            $pdf->Cell(2,0.8,'',1,0,'C',0); 
            $pdf->SetXY(0.5,10.1+$Y);
            $pdf->Cell(4,0.45,"Candidate's Signature in English",'',0,'L',0); 

            //------ Picture Box on right side on Top    
            $pdf->SetFont('Arial','B',6);  
            $pdf->SetXY(6.4,9.1+$Y);
            $pdf->Cell(1.4,1.5,'',1,0,'C',0); 
            $pdf->SetXY(6.3,9.1+$Y);
            $pdf->MultiCell(1.6,0.2,@$data["regPvt"]==1?"Paste Recent Photograph. Must Be cross Attested by the Head/Deputy Head of Institution":"Paste Recent Photograph. Must Be cross Attested by the Principal/V.Prinicipal/ Headmaster/Headmistress/ Dy.Headmaster/ Dy. Headmistress",0,'C'); 

            $pdf->SetXY(6.2,10.4+$Y);
            $pdf->Image(base_url()."assets/img/crossed.JPG",6.5,10.7, 1.28,0.25, "JPG");  */





            //--------------------------------------------------





        }
        //else:
        //    echo "No Record Found For Processing...";
        //endif;    

        //echo 'Some thing is not  ok    '; die();


        //$fileName="Admission_Forms_". $inst_cd."_".GetInterGroup($grp).'_'. ($sex== 1?'MALE': 'FEMALE') .  ".pdf";    

        //$fileName="Reg_Forms_". ".pdf";
        //$pdf->Output($fileName,'D');
        //$pdf->Output();



        //======================================================================================


        $pdf->Output($data["coll_cd"].'.pdf', 'I');
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

  public function ChallanForm_Adm11hth_Regular()
    { 

//    DebugBreak();
     $Grp_cd = $this->uri->segment(3);
     $this->load->library('session');
        $this->load->library('NumbertoWord');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
         $this->load->model('Admission_11th_reg_model');
          $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Grp_cd'=>$Grp_cd,'option'=>6);
           // --------------------------------------- Fee Calculation Section ------------------------------------------------
      //  DebugBreak();
        $challanDueDate = date('Y-m-d'); 
        $User_info_data = array('Inst_Id'=>$user['Inst_Id'], 'date' => date('Y-m-d'));
        if($Grp_cd == 9)
        {
        // Check and Generate Challan No. Overall 
        $user_info  =  $this->Admission_11th_reg_model->challan_all($User_info_data); 
           $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Grp_cd'=>$Grp_cd,'option'=>9);
        }
        $user_info  =  $this->Admission_11th_reg_model->getuser_info($User_info_data); 
        $isfine = 0;
        $Total_fine = 0;
        // Declare Science & Arts Fee's According to Fee Table .  Note: this will assign to Triple date fee. After triple date it will not asign fees.
        if(!empty($user_info['rule_fee'])) 
        {
            if($user_info['rule_fee'][0]['isPrSub']==1)
            {
                $SciAdmFee = $user_info['rule_fee'][0]['Amount'];
                $SciProcFee = $user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

                // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][0]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;


            } else if( $user_info['rule_fee'][1]['isPrSub']== 1 )
            {
                $SciAdmFee = $user_info['rule_fee'][1]['Amount'];
                $SciProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

                 // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][1]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;

            }
            if($user_info['rule_fee'][0]['isPrSub']==0)
            {
                $ArtsAdmFee = $user_info['rule_fee'][0]['Amount'];
                $ArtsProcFee =$user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
               // $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

                 // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][0]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;
            }
            else if($user_info['rule_fee'][1]['isPrSub']== 0 )
            {
                $ArtsAdmFee = $user_info['rule_fee'][1]['Amount'];
                $ArtsProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                //$ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

                 // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][1]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;
            }
        }
        else
        {
            $date = new DateTime(SingleDateFee);
            $singleDate =  $date->format('Y-m-d');                                                                     
            $User_info_data = array('Inst_Id'=>$user['Inst_Id'], 'date' => $singleDate);
            $user_info  =  $this->Admission_11th_reg_model->getuser_info($User_info_data);
            if($user_info['rule_fee'][0]['isPrSub']==1)
            {
                $SciAdmFee = $user_info['rule_fee'][0]['Amount'];
                $SciProcFee = $user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

                 // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][0]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;

            } else if( $user_info['rule_fee'][1]['isPrSub']== 1 )
            {
                $SciAdmFee = $user_info['rule_fee'][1]['Amount'];
                $SciProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

                 // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][1]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;

            }
            if($user_info['rule_fee'][0]['isPrSub']==0)
            {
                $ArtsAdmFee = $user_info['rule_fee'][0]['Amount'];
                $ArtsProcFee =$user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
               // $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

                 // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][0]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;
            }
            else if($user_info['rule_fee'][1]['isPrSub']== 0 )
            {
                $ArtsAdmFee = $user_info['rule_fee'][1]['Amount'];
                $ArtsProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                //$ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

                 // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][1]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;
            }

            $TripleDate = date('Y-m-d',strtotime(TripleDateFee)); 
            $now = date('Y-m-d'); // or your date as well
            $days = (strtotime($TripleDate) - strtotime($now)) / (60 * 60 * 24);
            $fine = 500;
            $days = abs($days);

            $SciAdmFee =  ($SciAdmFee*3); 
            $ArtsAdmFee = ($ArtsAdmFee*3); 
            $Total_fine = $days*$fine;
            // For ReAdmission 
            $SciAdmFee_ReAdm =  ($SciAdmFee_ReAdm*3); 
            $ArtsAdmFee_ReAdm = ($ArtsAdmFee_ReAdm*3);

             // Set Challan DATE
                // $date_temp = new DateTime($user_info['rule_fee'][0]['End_Date']);
              //   $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = date('d-m-Y');



        }

        // Newly Affiliated Admission Fee   Deals Private and Govt. institutes 
        $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
        if($user_info['info'][0]['feedingDate'] != null && (date('Y-m-d')<=$lastdate) )
        {
            if($user_info['info'][0]['IsGovernment'] == 2 || $user_info['info'][0]['IsGovernment'] == 1 )
            {
                $date = new DateTime(SingleDateFee);
                $singleDate =  $date->format('Y-m-d'); 
                $User_info_data = array('Inst_Id'=>$user['Inst_Id'], 'date' => $singleDate);
                $user_info  =  $this->Admission_11th_reg_model->getuser_info($User_info_data); 
                if($user_info['rule_fee'][0]['isPrSub']==1)
                {
                    $SciAdmFee = $user_info['rule_fee'][0]['Amount'];
                    $SciProcFee = $user_info['rule_fee'][0]['Processing_Fee'];
                    // For ReAdmission Fee
                    $SciAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                    $SciProcFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

                     // Set Challan DATE
                 $date_temp = new DateTime($user_info['info'][0]['feedingDate']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = SingleDateFee;

                } 
                else if( $user_info['rule_fee'][1]['isPrSub']== 1 )
                {
                    $SciAdmFee = $user_info['rule_fee'][1]['Amount'];
                    $SciProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                    // For ReAdmission Fee
                    $SciAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                    $SciProcFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

                       // Set Challan DATE
                 $date_temp = new DateTime($user_info['info'][0]['feedingDate']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = SingleDateFee;

                }
                if($user_info['rule_fee'][0]['isPrSub']==0)
                {
                    $ArtsAdmFee = $user_info['rule_fee'][0]['Amount'];
                    $ArtsProcFee =$user_info['rule_fee'][0]['Processing_Fee'];
                    // For ReAdmission Fee
                    $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                    //$ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

                       // Set Challan DATE
                 $date_temp = new DateTime($user_info['info'][0]['feedingDate']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = SingleDateFee;
                }
                else if($user_info['rule_fee'][1]['isPrSub']== 0 )
                {
                    $ArtsAdmFee = $user_info['rule_fee'][1]['Amount'];
                    $ArtsProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                    // For ReAdmission Fee
                    $ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                    //$ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

                       // Set Challan DATE
                 $date_temp = new DateTime($user_info['info'][0]['feedingDate']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = SingleDateFee;
                }
            }




        }  

        //DebugBreak();
        // Govt. Institutes no Adm Fee for Single Date.
        $date = new DateTime(SingleDateFee);
        $singleDate =  $date->format('Y-m-d'); 
       /* if(date('Y-m-d') <= $singleDate && $user_info['info'][0]['IsGovernment'] == 1)
        {    
            if($user_info['rule_fee'][0]['isPrSub']==1)
            {
                $SciAdmFee = 0;
                $SciProcFee = $user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

                // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][0]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;

            } else if( $user_info['rule_fee'][1]['isPrSub']== 1 )
            {
                $SciAdmFee = 0;
                $SciProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $SciAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
                $SciProcFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

                // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][1]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;

            }
            if($user_info['rule_fee'][0]['isPrSub']==0)
            {
                $ArtsAdmFee = 0;
                $ArtsProcFee =$user_info['rule_fee'][0]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Amount'];
               // $ArtsAdmFee_ReAdm = $user_info['rule_fee'][0]['Processing_Fee'];

                // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][0]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;
            }
            else if($user_info['rule_fee'][1]['isPrSub']== 0 )
            {
                $ArtsAdmFee = 0;
                $ArtsProcFee = $user_info['rule_fee'][1]['Processing_Fee'];
                // For ReAdmission Fee
                $ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Amount'];
               // $ArtsAdmFee_ReAdm = $user_info['rule_fee'][1]['Processing_Fee'];

                // Set Challan DATE
                 $date_temp = new DateTime($user_info['rule_fee'][1]['End_Date']);
                 $singleDate_temp =  $date_temp->format('d-m-Y'); 
                $challanDueDate = $singleDate_temp;
            } 

        }   */

        // --------------------------------------- Fee Calculation Section END------------------------------------------------

$ArtsProcFee =  195;
$SciProcFee =  195;
    $practical_Sub = array(
            'LibSC'=>'8',
            'GEO'=>'12',
            'PSY'=>'16',
            'ST'=>'18',
            'H-ECO'=>'21',
            'F/ART'=>'23',
            'CP'=>'38',
            'HPD'=>'42',
            'BIO'=>'46',
            'PHY'=>'47',
            'CH'=>'48',
            'Cl/T'=>'75',
            'HM'=>'76',
            'NUR'=>'79',
            'CSc'=>'83',
            'AGRI'=>'90',
            'TYP'=>'96',
            'CST'=>'98',

        );
        // DebugBreak();
        $data = array('data'=>$this->Admission_11th_reg_model->revenue_pdf($fetch_data),'inst_Name'=>$user['inst_Name'],'inst_cd'=>$user['Inst_Id'],"SciAdmFee"=>@$SciAdmFee,"ArtsAdmFee"=>@$ArtsAdmFee,"SciProcFee"=>@$SciProcFee,"ArtsProcFee"=>@$ArtsProcFee);
        //
        // ------------------------------------- Assign Each Candidate Fee According to Special case, Re-Admission ,Government Candidate and Newly Affiliated Institutes.
        $n=0;
        ///  echo  '<pre>';print_r($data['data']['stdinfo']);exit();
        $AllStdFee = array();
        foreach($data['data']['stdinfo'] as $key=>$vals)
        { $n++;
            // Check sub6 , sub7 and sub8 practical subj or not.
          //  if( $this->practicalsubjects($vals->sub6)|| $this->practicalsubjects($vals->sub7)|| $this->practicalsubjects($vals->sub8))
            if( $vals->grp_cd==1 || $vals->grp_cd == 2 || $vals->grp_cd == 4 ||  (array_search($vals->sub4,$practical_Sub) || array_search($vals->sub5,$practical_Sub) || array_search($vals->sub6,$practical_Sub) ||  array_search($vals->sub7,$practical_Sub)))
            {
                if($vals->IsReAdm==1)
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>$SciAdmFee_ReAdm,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$SciProcFee,'AdmTotalFee'=>$SciAdmFee_ReAdm+$SciProcFee+$Total_fine);
                }
                else if($vals->Spec>0 && (date('Y-m-d') <= $singleDate || $user_info['info'][0]['feedingDate'] != null && (date('Y-m-d')<=$lastdate)) )
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>0,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$SciProcFee,'AdmTotalFee'=>$SciProcFee+$Total_fine);
                }
                else
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>$SciAdmFee,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$SciProcFee,'AdmTotalFee'=>$SciAdmFee+$SciProcFee+$Total_fine);
                }
            }
            else
            {
                if($vals->IsReAdm==1)
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>$ArtsAdmFee_ReAdm,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$ArtsProcFee,'AdmTotalFee'=>$ArtsAdmFee_ReAdm+$ArtsProcFee+$Total_fine);
                }
                else if($vals->Spec>0 && (date('Y-m-d') <= $singleDate || $user_info['info'][0]['feedingDate'] != null && (date('Y-m-d')<=$lastdate)) )
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>0,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$ArtsProcFee,'AdmTotalFee'=>$ArtsProcFee+$Total_fine);
                }
                else
                {
                    $AllStdFee[$n] = array('formNo'=> $vals->formNo,'AdmFee'=>$ArtsAdmFee,'AdmFine'=>$Total_fine,'AdmProcessFee'=>$ArtsProcFee,'AdmTotalFee'=>$ArtsAdmFee+$ArtsProcFee+$Total_fine);
                }
            }
        }
      //  DebugBreak();
        $mydata_final = array( 'data'=>$this->Admission_11th_reg_model->Update_AdmissionFee($AllStdFee,$user['Inst_Id'],0,$fetch_data['option'],0,0),'AllFeeData'=>$AllStdFee,'Inst_cd'=>$user['Inst_Id'],'Inst_Name'=>$user['inst_Name']);

         //$grp_cd = $this->uri->segment(3);
       // $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'formno'=>$formno);
        //  DebugBreak();
        //$result = $this->Admission_matric_model->Print_challan_Form($fetch_data);
        $this->load->library('PDF_Rotate');

        $ctid=1;  //correction type of id starts from one and multiples by 2 for next type of correction id
         //  DebugBreak();
           $mydata_final = $mydata_final['data'][0];
           if($Grp_cd == 9)
           {
           $data_challanNo = @$data['data']['stdinfo'][0]->challan_overall_1;
           }
           else
           {
           $data_challanNo = @$data['data']['stdinfo'][0]->challan_overall_1;
           }
           $challanDueDate;

            $feestructure[]    =  $mydata_final['sum_procFee'];    
            $displayfeetitle[] =  'Total Processing Fee';    

            $feestructure[]     = $mydata_final['sum_AdmFee'];    
            $displayfeetitle[] =  'Total Admission Fee';   

            /*$feestructure[]=$result[0]['TotalCertFee']; 
            $displayfeetitle[] =  'Total Certificate Fee'; */  

            $feestructure[]=@$mydata_final['sum_lateFee'];
            $displayfeetitle[] =  'Total Late Admission Fee'; 

        $turn=1;     
        $pdf=new PDF_Rotate("P","in","A4");
        $pdf->AliasNbPages();
        if(Session == 1)
        {
            $ses = "Annual";
        }
        else
        {
           $ses = "Supplemantry";
        }
        $pdf->SetTitle("Challan Form | Admission 11th ".Year." ".$ses." Challan Form");
        $pdf->SetMargins(0.5,0.5,0.5);
        $pdf->AddPage();
        $generatingpdf=false;
        $challanCopy=array(1=>"Depositor Copy",  2=>"Finance Income Section Copy",3=>"Bank Copy", 4=>"Board Copy",);
        $challanMSG=array(1=>"(May be deposited only authorized HBL Branch)",2=>"(To be sent to the Admission Branch)", 3=>"(To be retained with HBL)", 4=>"(Along with Scroll)"  );
        $challanNo = $data_challanNo; 

       // DebugBreak();
       /* if(date('Y-m-d',strtotime(SINGLE_LAST_DATE11))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->Admission_matric_model->getrulefee(); 
            $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
            $rule_fee   =  $this->Admission_matric_model->getrulefee(); 
            $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }              */

        $obj    = new NumbertoWord();
        $obj->toWords($mydata_final['sum_TotalFee'],"Only.","");
        // $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');
        $feeInWords = ucwords($obj->words);//strtoupper(cNum2Words($totalfee)); 

        //-------------------- PRINT BARCODE
        //  $pdf->SetDrawColor(0,0,0);
        // $temp = $user['Inst_Id'].'11-2017-19';
        //$image =  $this->set_barcode($temp);

        $temp = $challanNo.'@11@'.Year.'@'.Session;
        //  $image =  $this->set_barcode($temp);
        //DebugBreak();
        $temp =  $this->set_barcode($temp);
       //  $pdf->Image("assets/img/M6.jpg",7.5, .2, .3, .3, "jpg");
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
            //   DebugBreak();
            $pdf->Cell(2.45, 0.4, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "L");
            $pdf->Image(base_url()."assets/img/icon2.png",0.30,$yy+$dyy, 0.65,0.60, "PNG", "http://www.bisegrw.com");
             $pdf->Image("assets/img/11th.png",7.5,$yy+$dyy+.58, 0.40,0.40, "PNG");   
            //  $pdf->Image(BARCODE_PATH.$Barcode,3.2, 1.15+$yy ,1.8,0.20,"PNG");
            $pdf->Image(base_url().BARCODE_PATH.$temp,5.8, $yy+$dyy+0.30 ,1.9,0.22,"PNG");
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
            $pdf->SetFont('Arial','BI',9);
            $pdf->Cell(0, $y, $challanMSG[$j], 0.25, "L");

            $pdf->SetXY($w+1.4,$y+$dy+0.15);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, 'Admission  '.Year.' 11th', 0.25, "L");

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
            $pdf->Cell( 0.5,0.3,"Bank Challan No:".$challanNo."           ",0,2,'L');
            $pdf->SetFont('Arial','U',9);
            $pdf->Cell(0.5,0.25, "Particulars Of Depositor",0,2,'L');
            $pdf->SetX(4.0);
            $pdf->SetFont('Arial','B',8);

            //if(intval($result[0]['sex'])==1){$sodo="S/O ";}else{$sodo="D/O ";}
           // $pdf->Cell(0.5,0.25,$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            // $pdf->Cell(0.5,0.25,,0,2,'L');
            $pdf->SetX(4);
            $pdf->SetFont('Arial','I',6.5);
            // DebugBreak();
            //$pdf->Cell(0.5,0.3,"Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            $pdf->MultiCell(4, .1, "Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0);
            
            $pdf->SetXY(4,$y+.9+$dy);
            $pdf->SetFont('Arial','B',8);
            $pdf->MultiCell(4,0.1,"District: ".$this->GetDistName($user['dist']),0,2,'L');

            $pdf->SetXY(4,$y+1.15+$dy);
            $pdf->SetFont('Arial','B',8);
            $pdf->MultiCell(4,0.12,"Amount in Words: ".$feeInWords,0,2,'L');

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
            $pdf->Cell(0.8,0.5,$mydata_final['sum_TotalFee'],0,'C');

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

}
