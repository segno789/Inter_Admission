<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admission extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');   
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

        $this->load->view('common/commonheader.php');
        $mydata = array('error'=>$error);

        $this->load->view('Admission/Inter/Default.php',$mydata);

        $this->load->view('common/homepagefooter.php');
    }

    function GetSpeciality($spclty)
    {
        if ($spclty == 0 )
            return('NONE');
        else if ($spclty == 2 )
            return('BOARD EMPLOYEE CHILD');
            else if ($spclty == 1 )
                return('DISABLE');


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

    public function checkFormNo_then_download()
    {
        //DebugBreak();

        $formno_seg = $this->uri->segment(3);
        $dob_seg = $this->uri->segment(4);
        if($formno_seg !=0){
            $formno = $formno_seg;     
            //$dob = $dob_seg;
        }
        else{
            return true;
        }


        $this->load->model('Admission_model');
        $this->load->library('session');
        // DebugBreak();
        $data = $this->Admission_model->get_formno_data($formno);
        if($data == false)
        {
            $error = 'No Data Exist againt '.$formno.' Form No. Please check it again.';
            $this->session->set_flashdata('downerror',$error);
            redirect('Admission');
            return;
        }
        $data = $data[0];
        $this->load->library('pdf_rotate');
        $pdf = new pdf_rotate('P','in',"A4");
        $lmargin =1.5;
        $rmargin =7.3;
        $pdf ->SetRightMargin(80);
        $pdf->AddPage();
        $x = 0.55;
        $Y = -0.20;
        $session = Session == "1" ? "Annual" : "Supplymentry";
        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(1.2,0.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
        $pdf->Image(base_url()."assets/img/ExamCenter.jpg",4.5,2.995+$Y, 2.78,0.15, "jpeg");        
        $pdf->Image(base_url()."assets/img/12.jpg",7.40,0.22, 0.23,0.23, "JPG");    

        $pdf->SetFont('Arial','U',7);
        $pdf->SetXY(1.2,0.4);
        $pdf->Cell(0, 0.2, "ADMISSION /REVENUE FORM ", 0.25, "C");
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY(2.68,0.4);
        $pdf->Cell(0, 0.2, strtoupper("(Private Candidate) for Intermediate (PART-II & COMPOSITE) " .$session."  Examination , ".Year), 0.25, "C");

        //--------------------------- Form No & Rno
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(1.2,0.65+$Y);
        $pdf->Cell( 0.5,0.5,"Form No:".$data['formNo'],0,'L');
        $pdf->SetXY(5.8,0.65+$Y);
        $pdf->Cell(0.5,0.5, "Roll No: _______________",0,'L');    
        $pdf->SetFont('Arial','B',7);
        $pdf->SetXY(6.6,.80+$Y);
        $pdf->Cell(0.5,0.5, "(For office use only)",0,'L');
        //------ Picture Box on Centre      

        //        DebugBreak();
        $Barcode = $data['formNo']."@".$data['class'].'@'.$data['sess'].'@'.$data["Iyear"];
        $image =  $this->set_barcode($Barcode);
         



        $pdf->Image(BARCODE_PATH.$image,2.9, 0.61  ,2.4,0.24,"PNG");
        //$data['PicPath']
        

        $pdf->Image(base_url().PRIVATE_IMAGE_PATH.$data['PicPath'],6.5, 1.15+$Y, 0.95, 1.0, "JPG");
        $pdf->Image(base_url()."assets/img/logo2.png",0.4, 0.2, 0.65, 0.65, "PNG");
        $pdf->SetFont('Arial','',8);

        //------------- Personal Infor Box
        //====================================================================================================================

        $FontSize=7;
        $HeightLine1= 1.75;
        $HeightLine2=2.0;
        $Y = -0.7;
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
            case '6':
                $grp_name = 'HOME ECONOMICS';
                break;
            default:
                $grp_name = "NO GROUP SELECTED.";
        }

        //--------------------------- 1st line 
        /* $pdf->SetXY(0.5,1.55+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Form No:",0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,1.55+$Y);
        $pdf->Cell( 0.5,0.5,$data['formNo'],0,'L');*/


        $chkcat09 = ($data['mi_type']!= 2?$this->getCatName($data['cat11']):'Aditional') ;

        $chkcat10 = ($data['mi_type']!= 2?$this->getCatName($data['cat12']):'Aditional');

        $pdf->SetXY(1.8,1.38+$Y);
        $pdf->SetFont('Arial','BU',9);
        if($chkcat09 != -1 && $chkcat10 != -1)
        {

            $pdf->Cell( 0.5,0.7,strtoupper($grp_name." GROUP  (11th: ".$chkcat09."  12th:".$chkcat10.")"),0,'L');
            //$pdf->SetFont('Arial','B',10);
            // $pdf->SetXY(2.5,1.55+$Y);
            //$pdf->Cell( 0.5,0.5,"(11th: ",0,'L');
            // $pdf->SetXY(3.0,1.55+$Y);
            // $pdf->SetFont('Arial','B',10);
            //$pdf->Cell( 0.5,0.5, ,0,'L'); 
            //  $pdf->SetXY(4.0,1.55+$Y);
            //  $pdf->SetFont('Arial','B',10);
            //$pdf->Cell( 0.5,0.5,"",0,'L');
            //  $pdf->SetXY(4.4,1.55+$Y);
            //  $pdf->SetFont('Arial','B',10);
            //$pdf->Cell( 0.5,0.5,$chkcat10.")",0,'L');

        }
        else if($chkcat09 != -1)
        {

            $pdf->Cell( 0.5,0.7,strtoupper($grp_name." GROUP  (11th: ".$chkcat09.")"),0,'L');
            //  $pdf->SetFont('Arial','B',10);
            //  $pdf->SetXY(2.5,1.55+$Y);
            //   $pdf->Cell( 0.5,0.5,"(11th: ",0,'L');
            //  $pdf->SetXY(3.0,1.55+$Y);
            //  $pdf->SetFont('Arial','B',10);
            // $pdf->Cell(0.5,0.5, $chkcat09.')',0,'L');
        }
        else if($chkcat10 != -1)
        {

            $pdf->Cell( 0.5,0.7,strtoupper($grp_name." GROUP  (12th: ".$chkcat10.")"),0,'L');
            // $pdf->SetFont('Arial','B',10);
            // $pdf->SetXY(2.5,1.55+$Y);
            //  $pdf->Cell( 0.5,0.5,"(12th: ",0,'L');
            // $pdf->SetXY(3.0,1.55+$Y);
            // $pdf->SetFont('Arial','B',10);
            // $pdf->Cell(0.5,0.5,$chkcat10.')',0,'L');  
        }
        $LastSess = 0 ;
        //  //DebugBreak();
        if($data["SessOfLastAp"] == 1 or $data["SessOfLastAp"] == 2  )
        {
            $LastSess =  $data["SessOfLastAp"]==1?"A":"S";
        }     
        $MLastSess='';
        if($data["sessOfPass"] == 1 or $data["sessOfPass"] == 2  )
        {
            $MLastSess =  $data["sessOfPass"]==1?"A":"S";
        } 



        $yearOfLastAp = $data['YearOfLastAp'];
        $cand_chance = $data['chance'];
        $cand_Notif = $data['Prev_result2'];
        $cand_Nofif_part1 =$data['Prev_result1'];
        $str = '';
        /*     if($data['cat11']==2 || $data['cat12']==2)
        {

        if($data['Prev_chance']==1)
        {
        if($data['cat11']==2 && $data['cat12']==2)
        {

        $str = "S-17 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
        }
        else if($data['cat11']==2 && $data['cat12'] !=2)
        {
        $str = "S-17 [P-I $cand_Nofif_part1]";        
        }
        else if($data['cat11'] !=2 && $data['cat12']==2)
        {
        $str = "S-17 [P-II $cand_Notif]";        
        }

        }
        else
        if($data['Prev_chance']==2)
        {
        if($data['cat11']==2 && $data['cat12']==2)
        {

        $str = "A-17 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
        }
        else if($data['cat11']==2 && $data['cat12'] !=2)
        {
        $str = "A-17 [P-I $cand_Nofif_part1]";        
        }
        else if($data['cat11'] !=2 && $data['cat12']==2)
        {
        $str = "A-17 [P-II $cand_Notif]";        
        }
        }
        else
        if($data['Prev_chance']==3)
        {
        if($data['cat11']==2 && $data['cat12']==2)
        {

        $str = " S-16 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
        }
        else if($data['cat11']==2 && $data['cat12'] !=2)
        {
        $str = "S-16 [P-I $cand_Nofif_part1]";        
        }
        else if($data['cat11'] !=2 && $data['cat12']==2)
        {
        $str = "S-16 [P-II $cand_Notif]";        
        }
        }
        if($data['Prev_chance']==4)
        {
        $str ="";
        }    
        }*/
        //if()

        // 

        $pdf->SetXY(0.5,1.7+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,1.7+$Y);
        $pdf->Cell(0.5,0.5,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(0.5, 1.85+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,1.85+$Y);
        $pdf->Cell(0.5,0.5,$data["Fname"],0,'L');

        //--------------------------- 3rd line 
        //__Mobile    
        //        debugBreak();
        $pdf->SetXY(0.5, 2.0+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Inter Info:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,2.0+$Y);
        $pdf->Cell(0.5,0.5,$data["oldRno"]." ( $LastSess,  $yearOfLastAp, ".$data['IBrd_Abbr']." )",0,'L');

        $pdf->SetXY(0.5, 2.15+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"SSC Info:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,2.15+$Y);
        $pdf->Cell(0.5,0.5,$data["matRno"]." ( $MLastSess, ".$data['yearOfPass'].', '.$data['MBrd_Abbr']." )",0,'L');


        $pdf->SetXY(3.5+$x,1.85+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell(0.5,0.5,"Father CNIC:",0,'R');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,1.85+$Y);
        $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');
        // //DebugBreak();
        //--------------------------- BAY FORM NO line 
        $pdf->SetXY(3.5+$x, 1.70+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Bay Form No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,1.70+$Y);
        $pdf->Cell(0.5,0.5,$data["BForm"],0,'L');
        $pdf->SetXY(3.5+$x,2.0+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Mobile No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.0+$Y);
        $pdf->Cell(0.5,0.5,$data["MobNo"],0,'L');
        //--------------------------- Dob line 
        /*$pdf->SetXY(0.5,2.15+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Date Of Birth:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,2.15+$Y);
        $pdf->Cell(0.5,0.5,date("d-m-Y", strtotime($data["Dob"])),0,'L');*/

        //--------------------------- Gender Nationality Dob

        //  DebugBreak();
        $pdf->SetXY(0.5,2.30+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Registration No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,2.30+$Y);
        $pdf->Cell(0.5,0.5,$data["strRegNo"],0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(6.8,2.53+$Y);                                               
        $pdf->Cell(0.5,0.5,$data["sex"]==1?"MALE":"FEMALE",0,'L');

        //--------------------------- id mark and Medium 
        //DebugBreak();
        $pdf->SetXY(0.5,2.50+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Speciality:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.50,2.50+$Y);
        $pdf->Cell(0.5,0.5,$this->GetSpeciality($data["Spec"]),0,'L');

        //DebugBreak();
        //--------------------------- Speciality and Internal Grade 
        $pdf->SetXY(3.5+$x,2.15+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Nationality:",0,'L');
        if($data["nat"] !=  null && $data["nat"] ==1)
        {
            $nat = 'PAKISTANI';
        }
        else
        {
            $nat = 'NON-PAKISTANI';  
        }

        /*if($data["Brd_cd"] !=  null && $data["Brd_cd"] >0)
        {
        $OldBoard = ($data["Brd_Abbr"]);
        }
        else
        {
        $OldBoard = 'Nil';  
        }*/

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.15+$Y);
        $pdf->Cell(0.5,0.5,$nat,0,'L');

        $pdf->SetXY(3.5+$x,2.30+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Religion:",0,'L');
        if($data["rel"] !=  null && $data["rel"] ==1)
        {
            $Religion = "MUSLIM";
        }
        else
        {
            $Religion = "NON-MUSLIM";
        }

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.30+$Y);
        $pdf->Cell(0.5,0.5,$Religion,0,'L');
        $xx= 0.5;
        $yy = $Y-0.05;
        $boxWidth = 2.6;
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($xx,3.8+$yy);
        $pdf->SetFillColor(240,240,240);
        $pdf->Cell($boxWidth,0.2,'Part I Subjects',1,0,'C',1);
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub1Ap1'] != 1 ? '':   '    '.'1. '. $this->GetSubNameHere($data['sub1']),1,0,'L',1);

        $pdf->Image(base_url().'assets/img/crossed.jpg',6.2,5.35+$yy, 1.3,0.15, "jpeg");  
        $pdf->SetXY(6.1,3.8+$yy);
        $pdf->Cell(1.4,1.5,'',1,0,'C',0); 
        $pdf->SetXY(6.3,3.8+$yy);
        $pdf->MultiCell(1.1,0.2, 'Paste Recent Photograph & Must Be Cross Attested by the Head/Deputy Head of Institution',0,'C'); 

        $pdf->SetXY(6.1,6.0+$yy);
        $pdf->Cell(1.4,0.65,'',1,0,'C',0); 
        $pdf->SetXY(6.2,6.48+$yy);
        $pdf->MultiCell(1.1,0.2, 'Thumb Impression',0,'C'); 

        //   DebugBreak();

        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub2Ap1'] != 1 ? '':   '    '.'2. '. $this->GetSubNameHere($data['sub2']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub3Ap1'] != 1 ? '':   '    '.'3. '. $this->GetSubNameHere($data['sub3']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.6+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub4Ap1'] != 1 ? '':   '    '.'4. '. $this->GetSubNameHere($data['sub4']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.8+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub5Ap1'] != 1 ? '':   '    '.'5. '. $this->GetSubNameHere($data['sub5']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,5.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub6Ap1'] != 1 ? '':   '    '.'6. '. $this->GetSubNameHere($data['sub6']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);                                                                     
        $pdf->SetXY($xx,5.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub7Ap1'] != 1 ? '':   '    '.'7. '. $this->GetSubNameHere($data['sub7']),1,0,'L',1);

        /*$pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,5.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub8Ap2'] != 1 ? '':   '    '.'8. '. $this->GetSubNameHere($data['sub8']),1,0,'L',1);
        */
        $xangle = 3.0;

        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($xangle,3.8+$yy);
        $pdf->SetFillColor(240,240,240);
        $pdf->Cell($boxWidth,0.2,'Part II Subjects',1,0,'C',1);    
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub1Ap2'] != 1 ? '':  '    '.'1. '.  $this->GetSubNameHere($data['sub1']),1,0,'L',1);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub2Ap2'] != 1 ? '':  '    '.'2. '.  $this->GetSubNameHere($data['sub2']),1,0,'L',1);

        /* $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub3Ap1'] != 1 ? '':  '    '.'3. '.  $this->GetSubNameHere($data['sub3']),1,0,'L',1);*/

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub8Ap2'] != 1 ? '':  '    '.'3. '.  $this->GetSubNameHere($data['sub8']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.6+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub4Ap2'] != 1 ? '':  '    '.'4. '.  $this->GetSubNameHere($data['sub4']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.8+$yy);
        
        if($data["grp_cd"] != 5)
        {
          $data['sub5A'] =  $data['sub5']; 
          $data['sub6A'] =  $data['sub6']; 
          $data['sub7A'] =  $data['sub7']; 
        }
        
        $pdf->Cell($boxWidth,0.2,$data['sub5Ap2'] != 1 ? '':  '    '.'5. '.  $this->GetSubNameHere($data['sub5A']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub6Ap2'] != 1 ? '':  '    '.'6. '.  $this->GetSubNameHere($data['sub6A']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub7Ap2'] != 1 ? '':  '    '.'7. '.  $this->GetSubNameHere($data['sub7A']),1,0,'L',1);

        //DebugBreak();
        $pdf->SetXY(0.5,2.65+$Y);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell( 0.5,0.5,"Address:",0,'L');

        $pdf->SetFont('Arial','B',7);
        $pdf->SetXY(1.5,2.65+$Y);
        $pdf->Cell(0.5,0.5,$data["addr"],0,'L');

        $pdf->SetXY(0.5,2.85+$Y);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell( 0.5,0.5,"Address(in Urdu):___________________________________________________________________________________________________________________",0,'L');

        $pdf->SetXY(0.5,3.15+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.5,0.5,"Zone Code:",0,'R');
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(1.5,3.15+$Y);
        $pdf->Cell( 0.5,0.5,$data['Zone_cd']."-".$data['zone_name']."",0,'L');

        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(3.5,3.2+$Y);
        $pdf->Cell(4,0.50,'',1,0,'C',0); 

        $pdf->Image(base_url().'assets/img/admission_form.jpg',4.07,1.9, 2.38,0.20, "jpeg");

        $pdf->SetXY(3.2,5.75+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell(0.2,0.5,"Stamp/Signature",0,'R');
        $pdf->SetXY(3.2,5.9+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"Headmaster/Headmistress/Principal",0,'R');
        $pdf->SetXY(3.2,6.05+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"Head Of Institution Name",0,'R');
        $pdf->SetXY(3.2,6.2+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"School/College Code",0,'R');
        $pdf->SetXY(3.2,6.35+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"CNIC",0,'R');

        $pdf->SetXY(0.2,5.25+$Y);
        $pdf->SetFont('Arial','b',9);
        $pdf->Cell(0.5,0.5,"Affidavit:-",0,'R');
        $pdf->SetXY(0.8,5.25+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0.5,0.5,"I have read this form. The data/information on this form and in online system is same as last entered/modified/provided by me and it's correctness",0,'R');
        $pdf->SetXY(0.2,5.37+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0.5,0.5,"is only my responsibility.I understand that only the information/data provided in the online system along with the photograph and some other handwritten ",0,'R');
        $pdf->SetXY(0.2,5.49+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0.5,0.5,"details on this form will be used for further processing. I accept all the terms and conditions in this regard.",0,'R');

        $pdf->SetXY(0.2,5.75+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0.5,0.5,"Candidate's Signature in Urdu______________________",0,'R');
        $pdf->SetXY(0.2,6.05+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0.5,0.5,"Candidate's Signature in English____________________",0,'R');


        $Updated_AdmFee = $this->GetFeeWithdue($data['AdmFee']);

        $pdf->SetXY(0.2,6.4+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $bx = 6.8;
        $by = 6.1;
        $Barcode = $data['formNo']."@".$data['class'].'@'.$data['sess'].'@'.$data["Iyear"];

        $pdf->SetXY(0.2,6.46+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(3.2,6.46+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(5.2,6.46+$Y);
        $pdf->SetFont('Arial','B',$FontSize+1.3);
        $pdf->Cell( 0.5,0.5,"Bank Challan No.  ".$data['chalanno'],0,'L');

        $Y = $Y - 0.5;
        $pdf->SetXY(0.2, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Admission Fee ",0,'L');


        $pdf->SetXY(1.2, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,$Updated_AdmFee.'/-',0,'L');


        $pdf->SetXY(1.8, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Late Fee ",0,'L');


        $pdf->SetXY(2.59, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,'0/-',0,'L');

        $pdf->SetXY(3.2, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Processing + Form Fee ",0,'L');
        $pdf->SetXY(4.6, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,$data['AdmProcessFee'].' /-',0,'L');

        $pdf->SetXY(5.42, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Certificate Fee ",0,'L');
        $pdf->SetXY(6.3, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,'0 /-',0,'L');

        $pdf->SetXY(6.8, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Registration Fee ",0,'L');
        $pdf->SetXY(7.59, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,'0/-',0,'L');

        $pdf->SetXY(0.2, 7.19+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.",0,'L');

        $pdf->SetXY(1.2, 7.19+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,$Updated_AdmFee+$data['AdmProcessFee'].' /-',0,'L');

        $pdf->SetXY(1.8, 7.19+$Y);
        $pdf->SetFont('Arial','',$FontSize-0.5);
        $pdf->Cell( 0.5,0.5,"Amount in Words:",0,'L');

        $this->load->library('NumbertoWord');
        $obj    = new NumbertoWord();
        $obj->toWords($data['AdmTotalFee'],"Only.",""); 

        $pdf->SetXY(2.6, 7.19+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');

        $pdf->SetXY(5.3, 7.29+$Y);
        $pdf->SetFont('Arial','b',$FontSize+0.5);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');

        $pdf->SetXY(3.2, 7.3+$Y);
        $pdf->SetFont('Arial','b',$FontSize+0.9);
        $pdf->Cell( 0.5,0.5,"Form No:".$data['formNo'],0,'L');

        $pdf->SetXY(0,5.0+3.0+$Y);
        $pdf->SetFont('Arial','',10);

        $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,6.50, 9.2,0.09, "jpeg"); 

        $Y = $Y + 1.68;

        $pdf->SetXY(0.2,6.1+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Board Copy: (Along with Scroll)",0,'L');

        $pdf->SetXY(0.2,6.0+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,strtoupper("BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA , INTERMEDIATE (PART-II & COMPOSITE) ".$session." Examination ,".Year.""),0,'C');

        $pdf->SetXY(0.2,6.4+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $bx = 6.8;
        $by = 6.1;
        $pdf->Image(base_url()."assets/img/12.jpg",7.58,6.2+$Y, 0.30,0.30, "JPG");  

        $pdf->Image(BARCODE_PATH.$image,5.15, 6.8  ,2.4,0.24,"PNG");

        $pdf->SetXY(2.8,6.16+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(2.8,6.26+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(0.2,6.46+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(0.5,6.46+$Y);
        $pdf->Cell(0.5,0.5,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(2.8,6.46+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(3.5,6.46+$Y);
        $pdf->Cell(0.5,0.5,$data["Fname"],0,'L');

        $pdf->SetXY(6.2,6.46+$Y);
        $pdf->SetFont('Arial','b',$FontSize+1.3);
        $pdf->Cell( 0.5,0.5,"Bank Challan No.  ".$data['chalanno'],0,'L');

        $Y = $Y - 0.5;
        $pdf->SetXY(0.2, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Admission Fee ",0,'L');


        $pdf->SetXY(1.2, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5, $data['AdmFee'].'/-',0,'L');


        $pdf->SetXY(1.8, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Late Fee ",0,'L');


        $pdf->SetXY(2.59, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,'0/-',0,'L');

        $pdf->SetXY(3.2, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Processing + Form Fee ",0,'L');
        $pdf->SetXY(4.6, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,$data['AdmProcessFee'].'/-',0,'L');

        $pdf->SetXY(5.42, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Certificate Fee ",0,'L');
        $pdf->SetXY(6.3, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,'0/-',0,'L');

        $pdf->SetXY(6.8, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Registration Fee ",0,'L');
        $pdf->SetXY(7.59, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,'0/-',0,'L');

        $pdf->SetXY(0.2, 7.19+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.",0,'L');

        $pdf->SetXY(1.2, 7.19+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,$data['AdmTotalFee'].'/-',0,'L');


        $pdf->SetXY(1.8, 7.19+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Amount in Words:",0,'L');


        $pdf->SetXY(2.6, 7.19+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');


        $pdf->SetXY(5.3, 7.29+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');

        $pdf->SetXY(3.2, 7.3+$Y);
        $pdf->SetFont('Arial','b',$FontSize+0.5);
        $pdf->Cell( 0.5,0.5,"Form No:".$data['formNo'],0,'L');

        $pdf->SetXY(0,5.0+3.0+$Y);
        $pdf->SetFont('Arial','',10);

        $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,7.70, 9.2,0.09, "jpeg");  

        $Y = $Y - 0.39;

        $pdf->SetXY(0.2,8.1+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,strtoupper("BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA , INTERMEDIATE (PART-II & COMPOSITE) ".$session." Examination ,".Year.""),0,'C');


        $bx = 6.8;
        $by = 8.1;

        $pdf->SetXY(3.2,8.3+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(0.2,8.20+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Bank Copy:  (To be retained with HBL) ",0,'L');


        $pdf->SetXY(0.2,8.5+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $pdf->Image(BARCODE_PATH.$image,5.15, 8.5+$Y  ,2.4,0.24,"PNG");

        $pdf->Image(base_url()."assets/img/12.jpg",7.58,8.3+$Y, 0.30,0.30, "jpg");  

        $pdf->SetXY(0.5,8.65+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.0,8.65+$Y);
        $pdf->Cell(0.5,0.5,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(3.2, 8.65+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.2,8.65+$Y);
        $pdf->Cell(0.5,0.5,$data["Fname"],0,'L');


        $pdf->SetXY(0.5, 8.79+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.",0,'L');

        $pdf->SetXY(1.35, 8.79+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,$data['AdmTotalFee'].'/-',0,'L');


        $pdf->SetXY(1.85, 8.79+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Amount in Words:",0,'L');

        $pdf->SetXY(2.68, 8.79+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');

        $pdf->Image(base_url().'assets/img/BankCopy.jpg',0.25,8.80, 7.4,0.25, "jpeg");   

        $pdf->SetXY(0.5, 8.55+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');


        $pdf->SetXY(3.2, 8.55+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','b',9.3);
        $pdf->Cell( 0.5,0.5,"Bank Challan No.  ".$data['chalanno'],0,'L');

        $pdf->SetXY(3.2, 8.9+$Y);
        $pdf->SetFont('Arial','b',$FontSize+0.5);
        $pdf->Cell( 0.5,0.5,"Form No:".$data['formNo'],0,'L');

        $pdf->SetXY(5.3, 8.9+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');


        $pdf->SetXY(0,5.0+3.0+$Y);
        $pdf->SetFont('Arial','',10);
        // //DebugBreak();
        $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,9.1, 8.3,0.09, "jpeg");  

        $Y = $Y - 0.09;
        //


        $pdf->SetXY(0.2,9.6+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,strtoupper("BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA , INTERMEDIATE (PART-II & COMPOSITE) ".$session." Examination ,".Year." "),0,'C');

        $bx = 6.8;
        $by = 9.5;


        $pdf->SetXY(3.2,9.8+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(0.2,9.69+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Candidate Copy",0,'L');


        $pdf->SetXY(0.2,10.0+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $pdf->Image(BARCODE_PATH.$image,5.15, 10.0+$Y  ,2.4,0.24,"PNG");

        $pdf->Image(base_url()."assets/img/12.jpg",7.58,9.8+$Y, 0.30,0.30, "JPG");  

        $pdf->SetXY(0.5,10.2+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Form No:",0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.0,10.2+$Y);
        $pdf->Cell( 0.5,0.5,$data['formNo'],0,'L');



        

        //  $pdf->Image(base_url().PRIVATE_IMAGE_PATH.'download.jpg',6.5, 10.3+$Y, 0.95, 1.0, "JPG");
               $pdf->Image(base_url().PRIVATE_IMAGE_PATH.$data['PicPath'],6.5, 10.3+$Y, 0.95, 1.0, "JPG");
        $pdf->SetFont('Arial','',8);


        $pdf->SetXY(0.5,10.35+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.0,10.35+$Y);
        $pdf->Cell(0.5,0.5,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(3.2, 10.35+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.0,10.35+$Y);
        $pdf->Cell(0.5,0.5,$data["Fname"],0,'L');


        $pdf->SetXY(0.5, 10.49+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.",0,'L');

        $pdf->SetXY(1.35, 10.49+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,$data['AdmTotalFee'].'/-',0,'L');


        $pdf->SetXY(0.5, 10.59+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Zone Code:",0,'L');

        $pdf->SetXY(1.48, 10.59+$Y);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell( 0.5,0.5,$data['Zone_cd']."-".$data['zone_name'],0,'L');

        $pdf->Image(base_url().'assets/img/CandidateCopy.jpg',0.27,10.86, 7.58,0.60, "jpeg");  


        $pdf->SetXY(0.5, 10.05+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');


        $pdf->SetXY(3.5, 10.05+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','b',9.3);
        $pdf->Cell( 0.5,0.5,"Bank Challan No.  ".$data['chalanno'],0,'L');


        $pdf->SetXY(3.4, 10.7+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');


        $filename="Admission_Forms_".$data['formNo']."_"   .  ".pdf";
        $pdf->Output($filename, 'I');

    }

    function GetDueDate()
    {

        $dueDate='';
        $single_date= SingleDateFee;  $double_date= DoubleDateFee;  $tripple_date= TripleDateFee;
        $today = date("d-M-Y");

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

    function  GetSubNameHere($_sub_cd)
    {
        $ret_val = "";
        if($_sub_cd == 1)  $ret_val = "ENGLISH";
        else if($_sub_cd == 2)  $ret_val = "URDU";
            else if($_sub_cd == 3)  $ret_val = "BANGALI";
                else if($_sub_cd == 4)  $ret_val = "URDU(ALTERNATIVE EASY COURSE)";
                    else if($_sub_cd == 5)  $ret_val = "BENGALI(ALTERNATE EASY COURSE)";
                        else if($_sub_cd == 6)  $ret_val = "PAKISTANI CULTURE";
                            else if($_sub_cd == 7)  $ret_val = "HISTORY";
                                else if($_sub_cd == 8)  $ret_val = "LIBRARY SCIENCE";
                                    else if($_sub_cd == 9)  $ret_val = "ISLAMIC HISTORY & CULTURE";
                                        else if($_sub_cd == 10)  $ret_val = "FAZAL ARABIC";
                                            else if($_sub_cd == 11)  $ret_val = "ECONOMICS";
                                                else if($_sub_cd == 12)  $ret_val = "GEOGRAPHY";
                                                    else if($_sub_cd == 13)  $ret_val = "MILITARY SCIENCE";
                                                        else if($_sub_cd == 14)  $ret_val = "PHILOSOPHY";
                                                            else if($_sub_cd == 15)  $ret_val = "ISLAMIC STUDIES(ISL-ST. GROUP)";
                                                                else if($_sub_cd == 16)  $ret_val = "PSYCHOLOGY";
                                                                    else if($_sub_cd == 17)  $ret_val = "CIVICS";

                                                                        else if($_sub_cd == 18)  $ret_val = "STATISTICS";
                                                                            else if($_sub_cd == 19)  $ret_val = "MATHEMATICS";
                                                                                else if($_sub_cd == 20)  $ret_val = "ISLAMIC STUDIES";
                                                                                    else if($_sub_cd == 21)  $ret_val = "OUTLINES OF HOME ECONOMICS";
                                                                                        else if($_sub_cd == 22)  $ret_val = "MUSIC";
                                                                                            else if($_sub_cd == 23)  $ret_val = "FINE ARTS";
                                                                                                else if($_sub_cd == 24)  $ret_val = "ARABIC";
                                                                                                    else if($_sub_cd == 25)  $ret_val = "BENGALI";
                                                                                                        else if($_sub_cd == 26)  $ret_val = "BENGALI(ADVANCE)";
                                                                                                            else if($_sub_cd == 27)  $ret_val = "ENGLISH ELECTIVE";
                                                                                                                else if($_sub_cd == 28)  $ret_val = "FRENCH";
                                                                                                                    else if($_sub_cd == 29)  $ret_val = "GERMAN";
                                                                                                                        else if($_sub_cd == 30)  $ret_val = "LATIN";
                                                                                                                            else if($_sub_cd == 31)  $ret_val = "";
                                                                                                                                else if($_sub_cd == 32)  $ret_val = "PUNJABI";
                                                                                                                                    else if($_sub_cd == 33)  $ret_val = "PASHTO";
                                                                                                                                        else if($_sub_cd == 34)  $ret_val = "PERSIAN";
                                                                                                                                            else if($_sub_cd == 35)  $ret_val = "SANSKRIT";
                                                                                                                                                else if($_sub_cd == 36)  $ret_val = "SINDHI";
                                                                                                                                                    else if($_sub_cd == 37)  $ret_val = "URDU (ADVANCE)";
                                                                                                                                                        else if($_sub_cd == 38)  $ret_val = "COMMERCIAL PRACTICE";
                                                                                                                                                            else if($_sub_cd == 39)  $ret_val = "PRINCIPLES OF COMMERCE";
                                                                                                                                                                else if($_sub_cd == 42)  $ret_val = "HEALTH & PHYSICAL EDUCATION";
                                                                                                                                                                    else if($_sub_cd == 43)  $ret_val = "EDUCATION";
                                                                                                                                                                        else if($_sub_cd == 44)  $ret_val = "GEOLOGY";
                                                                                                                                                                            else if($_sub_cd == 45)  $ret_val = "SOCIOLOGY";
                                                                                                                                                                                else if($_sub_cd == 46)  $ret_val = "BIOLOGY";
                                                                                                                                                                                    else if($_sub_cd == 47)  $ret_val = "PHYSICS";
                                                                                                                                                                                        else if($_sub_cd == 48)  $ret_val = "CHEMISTRY";
                                                                                                                                                                                            else if($_sub_cd == 51)  $ret_val = "ETHICS";
                                                                                                                                                                                                else if($_sub_cd == 52)  $ret_val = "ADEEB ARBI";
                                                                                                                                                                                                    else if($_sub_cd == 53)  $ret_val = "ADEEB URDU";
                                                                                                                                                                                                        else if($_sub_cd == 54)  $ret_val = "FAZAL URDU";
                                                                                                                                                                                                            else if($_sub_cd == 55)  $ret_val = "HISTORY OF PAKISTAN";
                                                                                                                                                                                                                else if($_sub_cd == 56)  $ret_val = "HISTORY OF ISLAM";
                                                                                                                                                                                                                    else if($_sub_cd == 57)  $ret_val = "HISTORY OF INDO-PAK";
                                                                                                                                                                                                                        else if($_sub_cd == 58)  $ret_val = "HISTORY OF MODREN WORLD";
                                                                                                                                                                                                                            else if($_sub_cd == 59)  $ret_val = "APPLIED ART  (Home-Economics Group)";
                                                                                                                                                                                                                                else if($_sub_cd == 60)  $ret_val = "FOOD & NUTRITION (Home-Economics Group)";
                                                                                                                                                                                                                                    else if($_sub_cd == 61)  $ret_val = "CHILD DEVELOPMENT AND FAMILY LIVING (H-Eco Group)";
                                                                                                                                                                                                                                        else if($_sub_cd == 70)  $ret_val = "PRINCIPLES OF ACCOUNTING";
                                                                                                                                                                                                                                            else if($_sub_cd == 71)  $ret_val = "PRINCIPLES OF ECONOMICS";
                                                                                                                                                                                                                                                else if($_sub_cd == 72)  $ret_val = "BIOLOGY (Home-Economics Group)";
                                                                                                                                                                                                                                                    else if($_sub_cd == 73)  $ret_val = "CHEMISTRY (Home-Economics Group)";
                                                                                                                                                                                                                                                        else if($_sub_cd == 75)  $ret_val = "CLOTHING & TEXTILE (Home-Economics Group)";
                                                                                                                                                                                                                                                            else if($_sub_cd == 76)  $ret_val = "HOME MANAGEMNET (Home-Economics Group)";
                                                                                                                                                                                                                                                                else if($_sub_cd == 79)  $ret_val = "NURSING";
                                                                                                                                                                                                                                                                    else if($_sub_cd == 80)  $ret_val = "BUSINESS MATH";
                                                                                                                                                                                                                                                                        else if($_sub_cd == 83)  $ret_val = "COMPUTER SCIENCE";
                                                                                                                                                                                                                                                                            else if($_sub_cd == 90)  $ret_val = "AGRICULTURE";
                                                                                                                                                                                                                                                                                else if($_sub_cd == 91)  $ret_val = "PAKISTAN STUDIES";
                                                                                                                                                                                                                                                                                    else if($_sub_cd == 92)  $ret_val = "ISLAMIC EDUCATION";
                                                                                                                                                                                                                                                                                        else if($_sub_cd == 93)  $ret_val = "CIVICS FOR NON MUSLIM";
                                                                                                                                                                                                                                                                                            else if($_sub_cd == 94)  $ret_val = "COMMERCIAL GEOGRAPHY";
                                                                                                                                                                                                                                                                                                else if($_sub_cd == 95)  $ret_val = "BANKING";
                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 96)  $ret_val = "TYPING";
                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 97)  $ret_val = "BUSINESS STATISTICS";
                                                                                                                                                                                                                                                                                                            else if($_sub_cd == 98)  $ret_val = "COMPUTER STUDIES";
                                                                                                                                                                                                                                                                                                                else if($_sub_cd == 99)  $ret_val = "BOOK KEEPING & ACCOUNTANCY";                                                                                                                                                                                                                                                                                                                                                                               return $ret_val ;             
    }

    function getCatName($cat)
    {
        if ($cat==1) return "Full Appear";
        else if ($cat ==2) return "Re-Appear";
            else if ($cat ==3 or $cat == 7) return "Marks Improve";
                else if ($cat ==5 ) return "Additional";
                    else return -1;
    }

    private function makecat($cattype,$exam_type,$marksImp,$is11th)
    {
        // debugBreak();
        $cate =  array();

        if($exam_type == 2)

        {
            $cate['cat11'] = 1;
            $cate['cat12'] = 1;
        }
        else  if($exam_type == 1)

        {
            $cate['cat11'] = 0;
            $cate['cat12'] = 1;
        }
        else
            if($exam_type == 3)
            {
                if($is11th==1)
                {
                    $cate['cat11'] = 2;     
                }
                else{
                    $cate['cat11'] = 0;          
                }
                $cate['cat12'] = 1;
            }
            else if($exam_type == 4){
                $cate['cat11'] = 0;
                $cate['cat12'] = 2;
            }
            else if($exam_type == 5){
                $cate['cat11'] = 2;
                $cate['cat12'] = 0;
            }
            else if($exam_type == 6){
                $cate['cat11'] = 2;
                $cate['cat12'] = 2;
            }
          
             else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1)) && $marksImp == 2)
            {
                $cate['cat11'] = 0;
                $cate['cat12'] = 3;
            }
          
            else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1))  && $marksImp == 1)
            {
                $cate['cat11'] = 3;
                $cate['cat12'] = 0;
            }
         
            else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1))  && $marksImp == 3)
            {
                $cate['cat11'] = 3;
                $cate['cat12'] = 3;
            }
            
            else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1))  && $marksImp ==4)
            {
                $cate['cat11'] = 7;
                $cate['cat12'] = 7;
            }
             else if($exam_type == 15 || ($exam_type == 16 && $cattype == 2)){
            
                $cate['cat11'] =  5;
                $cate['cat12'] = 5;
            }        
            return $cate;
    }
    function GetFeeWithdue($fee){
        //DebugBreak();
        $dueDate='';
         $single_date= SingleDateFee;  $double_date= DoubleDateFee;  $tripple_date= TripleDateFee;
        $today = date("d-m-Y");

        if(strtotime($today) <= strtotime($single_date)) 
        {
            $dueDate = $fee;
        }
        else if( $today <= $double_date )
        {
            $dueDate = $fee*2;
        }
        else if( $today <= $tripple_date )
        {
            $fee = $fee/2;
            $dueDate = $fee*3;
        }
        else if($today > $tripple_date )
        {
            $now = time(); // or your date as well
            $your_date = strtotime($tripple_date);
            $datediff = $now - $your_date;
            $days = floor($datediff/(60*60*24));

            $fine = $days*500;
            $fee = $fee/3;
            $dueDate = $fee*3 + $fine;
        }
        return $dueDate;

    }



    public function Pre_Inter_Data()
    {       

       //  DebugBreak();     
         $this->load->library('session');
         $mrollno='';
         $hsscrno='';
         $oldClass='';
         $iyear='';
         $session='';
         $board='';
         $CatType='';
         $Insert_server_error='';
        if($this->session->flashdata('NewEnrolment_error'))
        {
            $data = array('data'=>$this->session->flashdata('NewEnrolment_error'));  
        $mrollno =@$data['data']['matRno_hidden'];// $_POST["txtMatRno"];
        $hsscrno = @$data['data']['oldrno'];
        $oldClass= @$data['data']['oldClass'];
        $iyear    = @$data['data']['InterYear_hidden'];
        $session = @$data['data']['InterSess_hidden'];
        $board   = @$data['data']['oldboardid'];
        $CatType = @$data['data']['cattype_hidden'];
        $Insert_server_error=@$data['data']['excep'];
        
        }
        else
        {
            $data = array('data'=>"");
        $mrollno = $_POST["txtMatRno"];
        $hsscrno = $_POST["oldRno"];
        $oldClass= $_POST["oldClass"];
        $iyear    = $_POST["oldYear"];
        $session = $_POST["oldSess"];
        $board   = $_POST["oldBrd_cd"];
        $CatType = @$_POST["CatType"];
        }
        

        $data['sscrno']=$mrollno;
        $data['hsscrno']=$hsscrno;
        $data['hsscclass']=$oldClass;
        $data['iYear']=$iyear;
        $data['session']=$session;
        $data['board']=$board;
        $this->load->model('Admission_model');
        $data = $this->Admission_model->Pre_Inter_data($data);

        $error_msg = '';

        if(!$data){
            $error_msg.='<span style="font-size: 16pt; color:red;">' . 'No Any Student Found Against Your Criteria</span>';
        }

        $specialcase = $data['0']['Spl_Name'];
        $specialcode = $data['0']['spl_cd'];
        $exam_type =   $data['0']['exam_type'];
        if($specialcode != ''){

            $error_msg.='<span style="font-size: 16pt; color:red;">' . '   Your Admission cannot be procceed due to     ' . '</span>';
            $error_msg.='<span style="font-size: 16pt; color:red;">' . $specialcase . '</span>';
        }

        $nxtrnosess = $data['0']['NextRno_Sess_Year'];
        $matric_rno = $data['0']['matRno'];
        $inter_rno = $data['0']['rno'];

        if ($nxtrnosess != '') {

            $error_msg.= '<div style="color:red;"><h2>You have already appeared in</h2></div>';
            $parts = explode(",", $nxtrnosess);
            $nxtrno = $parts[0];
            $nxtsess = $parts[1];
            $nxtyear = $parts[2];

            if($nxtsess == '1')
            {
                $nxtsess = 'Inter Annual';
            }
            else{
                $nxtsess = 'Inter Supplementary';
            }
            $error_msg.='<span style="font-size: 16pt; color:red;">' . $nxtsess . '</span>';
            $error_msg.='<span style="font-size: 16pt; color:red;">' . ',    ' . '</span>';
            $error_msg.='<span style="font-size: 16pt; color:red;">' . $nxtyear . '</span>';
            $error_msg.='<span style="font-size: 16pt; color:red;">' . '   Against Roll No  = ' . '</span>';
            $error_msg.='<span style="font-size: 16pt; color:red;">' . $nxtrno . '</span>';
        }
        
        
           // DebugBreak();

        if($error_msg !='')
        {
            // DebugBreak();
            $this->load->library('session');
            $mydata = array('data'=>$_POST,'error_msg'=>$error_msg,'exam_type'=>$exam_type);
            $this->session->set_flashdata('matric_error',$mydata);
            redirect('Admission/matric_default');

        }
        else if(($exam_type == 16) && !isset($CatType))
        {

            $this->load->library('session');
            $mydata = array('data'=>$_POST,'error_msg'=>$error_msg,'exam_type'=>$exam_type);
            $this->session->set_flashdata('matric_error',$mydata );
            redirect('Admission/matric_default');
        }
       else if(($exam_type == 17))
        {
               $error_msg.='<span style="font-size: 16pt; color:red;">' . 'You can not Marks Improve.</span>';
            $this->load->library('session');
            $mydata = array('data'=>$_POST,'error_msg'=>$error_msg,'exam_type'=>$exam_type);
            $this->session->set_flashdata('matric_error',$mydata );
            redirect('Admission/matric_default');
        }
         else if(($exam_type == 18))
        {
               $error_msg.='<span style="font-size: 16pt; color:red;">' . 'Your Result is not cleared.</span>';
            $this->load->library('session');
            $mydata = array('data'=>$_POST,'error_msg'=>$error_msg,'exam_type'=>$exam_type);
            $this->session->set_flashdata('matric_error',$mydata );
            redirect('Admission/matric_default');
        } 
        else if(($exam_type == 1 &&($data[0]['regPvt']==1 )) )
        {
          
            $error_msg.='<span style="font-size: 16pt; color:red;">' . 'You can not appear as a Private Candidate. Please send Addmission from Your Institute.</span>';
            $this->load->library('session');
            $mydata = array('data'=>$_POST,'error_msg'=>$error_msg,'exam_type'=>$exam_type);
            $this->session->set_flashdata('matric_error',$mydata );
            redirect('Admission/matric_default');
        }
         /*   else if($exam_type == 2 &&($data[0]['regPvt']==1))
        {
          
            $error_msg.='<span style="font-size: 16pt; color:red;">' . 'You can not appear as a Private Candidate. Please send Addmission from Your Institute.</span>';
            $this->load->library('session');
            $mydata = array('data'=>$_POST,'error_msg'=>$error_msg,'exam_type'=>$exam_type);
            $this->session->set_flashdata('matric_error',$mydata );
            redirect('Admission/matric_default');
        }    */

        else
        {
            if($exam_type == 14)
            {
              @$_POST["CatType"]= 1;  
            }
            if($exam_type == 15)
            {
              @$_POST["CatType"]= 2;  
            }
            $brd_name=$this->Admission_model->Brd_Name($board);
            $data[0]['brd_name']=$brd_name[0]['Brd_Abr'] ;
            $data['sscrno']=$mrollno;
            $data['old_class_']=$oldClass;
            $data['hsscrno']=$hsscrno;
            $data['iYear']=$iyear;
            $data['session']=$session;
            $data['board']=$board;
            $data['Insert_server_error']=$Insert_server_error;
            $this->load->view('common/commonheader.php');        
            $this->load->view('Admission/Inter/AdmissionForm.php',  array('data'=>$data));
            $this->load->view('common/commonfooter.php');
        }

    }

    public function NewEnrolment_insert()
    {
        $this->load->model('Admission_model');
        $this->load->library('session');
        $Inst_Id = 999999;
        // DebugBreak();
        $formno = $this->Admission_model->GetFormNo();
        $allinputdata = array('cand_name'=>@$_POST['cand_name'],
            'father_name'=>@$_POST['father_name'],
            'bay_form'=>@$_POST['bay_form'],
            'father_cnic'=>@$_POST['father_cnic'],

            'mob_number'=>@$_POST['mob_number'],
            'medium'=>@$_POST['medium'],
            'speciality'=>@$_POST['speciality'],
            'MarkOfIden'=>@$_POST['MarkOfIden'],
            'medium'=>@$_POST['medium'],
            'nationality'=>@$_POST['nationality'],
            'gender'=>@$_POST['gend'],
            'hafiz'=>@$_POST['hafiz'],
            'religion'=>@$_POST['religion'],
            'std_group'=>@$_POST['std_group'],
            'address'=>@$_POST['address'],
            'UrbanRural'=>@$_POST['UrbanRural'],
            'dist'=>@$_POST['pvtinfo_dist'],
            'teh'=>@$_POST['pvtinfo_teh'],
            'zone'=>@$_POST['pvtZone'],
            'oldrno'=>@$_POST['oldrno'],
            'oldsess'=>@$_POST['oldsess'],
            'oldyear'=>@$_POST['oldyear'],
            'oldboard'=>@$_POST['oldboard'],
            'oldClass'=>@$_POST['oldClass'],

            'sub1'=>@$_POST['sub1'],
            'sub2'=>@$_POST['sub2'],
            'sub3'=>@$_POST['sub3'],
            'sub4'=>@$_POST['sub4'],
            'sub5'=>@$_POST['sub5'],
            'sub6'=>@$_POST['sub6'],
            'sub7'=>@$_POST['sub7'],

            'sub1p2'=>@$_POST['sub1p2'],
            'sub2p2'=>@$_POST['sub2p2'],
            'sub3p2'=>@$_POST['sub3p2'],
            'sub4p2'=>@$_POST['sub4p2'],
            'sub5p2'=>@$_POST['sub5p2'],
            'sub6p2'=>@$_POST['sub6p2'],
            'sub7p2'=>@$_POST['sub7p2'],

        );

        $sub1 = 0;        $sub2 = 0;        $sub3 = 0;        $sub4 = 0;        $sub5 = 0;        $sub6 = 0;        $sub7 = 0;  $sub8=0; $sub4a=0; $sub5a =0; $sub6a = 0; $sub7a = 0;     
        $sub1ap1 = 0;        $sub2ap1 = 0;        $sub3ap1 = 0;        $sub4ap1 = 0;        $sub5ap1 = 0;        $sub6ap1 = 0;        $sub7ap1 = 0;     
        $sub1ap2 = 0;        $sub2ap2 = 0;        $sub3ap2 = 0;        $sub4ap2 = 0;        $sub5ap2 = 0;        $sub6ap2 = 0;        $sub7ap2 = 0;     $sub8ap2 = 0;

          $grp_cd = $this->input->post('std_group');
        $is11th = 0;

        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1; 
            $sub1 =  $_POST['sub1'];   
            $is11th = 1;
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
            $sub2 =  $_POST['sub2'];
            $is11th = 1;
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;   
            $sub3 =  $_POST['sub3'];
            $is11th = 1;
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
            $sub4 =  $_POST['sub4'];
            $is11th = 1;
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
            $sub5 =  $_POST['sub5'];
            $is11th = 1;
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
            $sub6 =  $_POST['sub6'];
            $is11th = 1;
        }
        if(@$_POST['sub7'] != 0)
        {
            $sub7ap1 = 1;    
            $sub7 =  $_POST['sub7'];
            $is11th = 1;
        }
        if(@$_POST['sub3p2'] != 0)
        {
            $sub8ap2 = 1;    
            $sub8 =  @$_POST['sub3p2'];

        }

        if(@$_POST['sub4p2'] != 0)
        {
            $sub4ap2 = 1;    
            $sub4 =  @$_POST['sub4p2'];

        }
        //DebugBreak();
        if(@$_POST['sub5p2'] != 0 && $grp_cd == 5)
        {
            $sub5ap2 = 1;    
            $sub5a =  @$_POST['sub5p2'];

        }
        else if(@$_POST['sub5p2'] != 0 && $grp_cd != 5)
        {
           $sub5ap2 = 1;    
            $sub5 =  @$_POST['sub5p2']; 
        }
        if(@$_POST['sub6p2'] != 0 && $grp_cd == 5)
        {
            $sub6ap2 = 1;    
            $sub6a =  @$_POST['sub6p2'];

        }
        else   if(@$_POST['sub6p2'] != 0 && $grp_cd != 5)
        {
            $sub6ap2 = 1;    
            $sub6 =  @$_POST['sub6p2'];
        }
        if(@$_POST['sub7p2'] != 0  && $grp_cd == 5)
        {
            $sub7ap2 = 1;    
            $sub7a =  @$_POST['sub7p2'];

        }
        else  if(@$_POST['sub7p2'] != 0  && $grp_cd != 5)
         {
            $sub7ap2 = 1;    
            $sub7 =  @$_POST['sub7p2'];

        }

        if(@$_POST['sub1p2'] != 0)
        {
            $sub1ap2 = 1; 
            $sub1 =  $_POST['sub1p2'];  
        }
        if(@$_POST['sub2p2'] != 0)
        {
            $sub2ap2 = 1; 
            $sub2 =  $_POST['sub2p2'];    
        }
       

          $cattype = @$_POST['cattype_hidden'];
        $examtype = @$_POST['exam_type'];
        $marksImp = @$_POST['ddlMarksImproveoptions'];
         //debugBreak();

        $cat = $this->makecat($cattype,$examtype,$marksImp,$is11th);
        $cat11 = @$cat['cat11'];
        $cat12 = @$cat['cat12'];
        $Speciality = $this->input->post('speciality');
        

        $per_grp = @$_POST['pregrp'];

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

        $ispractical = 0;
        if($per_grp == 1 || $pre_grp == 2 || $pre_grp == 4  || $grp_cd == 1 || $grp_cd == 2 || $grp_cd == 4)
        {
            $ispractical =1;
        }
        if(array_search(@$_POST['sub4'],$practical_Sub) || array_search(@$_POST['sub5'],$practical_Sub) || array_search(@$_POST['sub6'],$practical_Sub) || array_search(@$_POST['sub7'],$practical_Sub) || array_search(@$_POST['sub7p2'],$practical_Sub) || array_search(@$_POST['sub4p2'],$practical_Sub) || array_search(@$_POST['sub5p2'],$practical_Sub) || array_search(@$_POST['sub6p2'],$practical_Sub))
        {
            $ispractical =1;
        }
      

        $AdmFee = $this->Admission_model->getrulefee($ispractical);
         //debugBreak();

        $AdmFeeCatWise = '1700';
        if($cat11 != 0 && $cat12 != 0)
        {
            $AdmFeeCatWise = $AdmFee[0]['Comp_Pvt_Amount'];
        }
        else if(($cat11 == 0 && $cat12 != 0) || ($cat11 != 0 && $cat12 == 0))
        {
            $AdmFeeCatWise = $AdmFee[0]['PVT_Amount'];
        }
        else if($cat11 == 0 && $cat12 == 0)
        {
            return;
        }
        if($Speciality>0)
        {
             if($Speciality ==2 && Session ==2 )
            {
                $AdmFeeCatWise = $AdmFeeCatWise;    
            }
            else
            {
                $AdmFeeCatWise = 0;    
            }
        
        }
        else
        {
            $AdmFeeCatWise = $AdmFeeCatWise;
           // $AdmFeeCatWise  =0;
        }
$TotalAdmFee = $AdmFee[0]['Processing_Fee'] +$AdmFeeCatWise;  
        

        $oldsess = @$_POST['oldsess'];

        if($oldsess == 'Annual'){
            $oldsess =  1;    
        }
        else if($oldsess == 'Supplementary'){
            $oldsess =  2;    
        }
          //DebugBreak();

        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'BForm' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'MobNo' =>$this->input->post('mob_number'),
            'medium' =>$this->input->post('medium'),
            'Inst_Rno' =>$this->input->post('Inst_Rno'),
            'markOfIden' =>$this->input->post('MarkOfIden'),
            'Speciality' => ($Speciality),
            'nat' =>$this->input->post('nationality'),
            'sex' =>$this->input->post('gend'),
            'IsHafiz' =>$this->input->post('hafiz'),
            'rel' =>$this->input->post('religion'),
            'addr' =>$this->input->post('address'),
            'grp_cd' => $grp_cd,
            'sub1' =>$sub1,
            'sub2' =>$sub2,
            'sub3' =>$sub3,
            'sub4' =>$sub4,
            'sub5' =>$sub5,
            'sub6' =>$sub6,
            'sub7' => $sub7,
            'sub8' =>$sub8,
            'sub5a'=>$sub5a,
            'sub6a'=>$sub6a,
            'sub7a'=>$sub7a,
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
            'sub1ap2' => ($sub1ap2),
            'sub2ap2' => ($sub2ap2),
            'sub3ap2' => ($sub3ap2),
            'sub4ap2' => ($sub4ap2),
            'sub5ap2' => ($sub5ap2),
            'sub6ap2' => ($sub6ap2),
            'sub7ap2' => ($sub7ap2),
            'sub8ap2' => ($sub8ap2),
            'RuralORUrban' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>($Inst_Id),
            'FormNo' =>($formno),
            'cat11' =>$cat11,
            'cat12' =>$cat12,
            'dist'=>@$_POST['pvtinfo_dist'],
            'teh'=>@$_POST['pvtinfo_teh'],
            'zone'=>@$_POST['pvtZone'],
            'Reggrp'=>"2",
            'rno'=>@$_POST['oldrno'],
            'sess'=>$oldsess,
            'Iyear'=>@$_POST['oldyear'],
            'Brd_cd'=>@$_POST['oldboardid'],
            'class'=>@$_POST['oldclass'],
            'schm'=>1,
            'AdmProcessFee'=>$AdmFee[0]['Processing_Fee'],
            'AdmFee'=>$AdmFeeCatWise,
            'AdmTotalFee'=>$TotalAdmFee,
            'exam_type'=>$_POST['exam_type'],
            'picpath'=>@$_POST['pic'],
            'brd_name'=>@$_POST['oldboard']
        );
       //   DebugBreak();
        $data_error = array(
        'matRno_hidden'=>$this->input->post('matRno_hidden'),
        'oldrno'=>$this->input->post('InterRno_hidden'),
        'InterYear_hidden'=>$this->input->post('InterYear_hidden'),
        'InterSess_hidden'=>$this->input->post('InterSess_hidden'),
        'oldboardid'=>$this->input->post('oldboardid'),
        'cattype_hidden'=>$this->input->post('cattype_hidden'),
        'oldClass'=>$this->input->post('oldClass'),
        );
  
        
        
        
        
        
        $temp_file_name = @$_POST['pic']; //'OldPics/Pic16-MA/MA11th16/123456.jpg';
        $whatIWant = substr($temp_file_name, strpos($temp_file_name, ".") - 6);    
      
        $temp_db_rno = @$_POST['InterRno_hidden'];
        $spreate_filename = explode(".",$whatIWant);
        $temp_file_rno= $spreate_filename[0];
        if($temp_file_rno != $temp_db_rno)
        {
            $allinputdata = "";
            $data_error['excep'] = 'Your Pictures is not matched. ';
            $this->session->set_flashdata('NewEnrolment_error',$data_error);
            redirect('Admission/Pre_Inter_Data/');

            return;
        }
       
        
        $target_path = PRIVATE_IMAGE_PATH;
        $base_path = GET_PRIVATE_IMAGE_PATH_COPY.@$_POST['pic'];
        if (!file_exists($target_path)){

            mkdir($target_path);
        }
        $copyimg = $target_path.$formno.'.jpg';
        if (!(copy($base_path, $copyimg))) 
        {
            $data_error['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
            $this->session->set_flashdata('NewEnrolment_error',$data_error);

            redirect('Admission/Pre_Inter_Data/');

        }
             
      //  DebugBreak();
        $this->frmvalidation('Pre_Inter_Data',$data_error,0);
        $logedIn = $this->Admission_model->Insert_NewEnorlement($data);
        if($logedIn != false)
        {
            $allinputdata = "";
            $allinputdata['excep'] = 'success';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            $msg = $formno;                                           
            redirect('Admission/formdownloaded/'.$formno);
        }
        else
        {     
            $allinputdata = "";
            $data_error['excep'] = 'An error has occoured. Please try again later. ';
            $this->session->set_flashdata('NewEnrolment_error',$data_error);
            redirect('Admission/Pre_Inter_Data/');
           // redirect('Admission');
            return;
            echo 'Data NOT Saved Successfully !';
        } 

    }

    public function formdownloaded(){

        //DebugBreak();

        $msg = $this->uri->segment(3);
        $dob = $this->uri->segment(4);
        $this->load->model('Admission_model');
        $this->load->library('session');
        $myarray = array('msg'=>$msg,'dob'=>$dob);
        $this->load->view('common/commonheader.php');
        $this->load->view('Admission/Inter/FormDownloaded.php',$myarray);
        $this->load->view('common/footer.php');
        // $this->load->view('common/commonfooter.php');
    }
    public function matric_default()
    {
        // DebugBreak();
        $data = array(
            'isselected' => '3',
        );
        $this->load->library('session');
        if($this->session->flashdata('matric_error'))
        {
            $spl_cd = array('spl_cd'=>$this->session->flashdata('matric_error'));  
        }
        else
        {
            $spl_cd = array('spl_cd'=>"");
        }

        $this->load->view('common/commonheader.php');
        $this->load->view('Admission/Inter/getinfo.php',$spl_cd);
        $this->load->view('common/footer.php');
    }

    public function getzone()
    {
        $data = array(
            'tehCode' => $this->input->post('tehCode'),
        );

        $tehCode = $data['tehCode'];
        $this->load->model('Admission_model');
        $value = array('teh'=> $this->Admission_model->getzone($tehCode)) ;
        echo json_encode($value);

    }

    public function getcenter()
    {
        //DebugBreak();
        $data = array(
            'zoneCode' => $this->input->post('pvtZone'),
            'gen' => $this->input->post('gend'),
        );

        $this->load->model('Admission_model');
        $value = array('center'=> $this->Admission_model->getcenter($data)) ;
        echo json_encode($value);

    }

    function frmvalidation($viewName,$allinputdata,$isupdate)
    {

        //  DebugBreak();
        $_POST['address']  = str_replace("'", "", $_POST['address'] );
        $language_sub_cd = array(

            //'ISLAMIC STUDIES'
            1,
            //'ARABIC'=>
            24,
            //'ENGLISH ELECTIVE'=>
            27,
            //'PUNJABI'=>
            32,
            //'PERSIAN'=>
            34,
            //'URDU (ADVANCE)'=>
            37
        );
        $history_sub_cd = array(

            //'HISTORY OF PAKISTAN'=>
            55,
            //'HISTORY OF ISLAM'=>
            56,
            //'HISTORY OF INDO-PAK'=>
            57,
            //'HISTORY OF MODREN WORLD'=>
            58
        );

        

        if(@$_POST['cand_name'] == '' )
        {
            $allinputdata['excep'] = 'Please Enter Your Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return; //"NewEnrolment_EditForm_matric"

        }
        //(strpos($a, 'are') !== false)


        else if (@$_POST['father_name'] == '')
        {
            $allinputdata['excep'] = 'Please Enter Your Father Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }

        else if(@$_POST['bay_form'] == '' || @$_POST['bay_form'] == '00000-0000000-0')
        {
            $allinputdata['excep'] = 'Please Enter Your Bay Form No.';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            $this->$viewName($allinputdata['formNo']);
            return;


        }

        else if(@$_POST['father_cnic'] == '' || @$_POST['father_cnic'] == '00000-0000000-0' )
        {
            $allinputdata['excep'] = 'Please Enter Your Father CNIC';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;


        }

       
        else if(@$_POST['mob_number'] == '')
        {
            $allinputdata['excep'] = 'Please Enter Your Mobile Number';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if(@$_POST['medium'] == 0)
        {
            $allinputdata['excep'] = 'Please Select Your Medium';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }

        else if(@$_POST['MarkOfIden']== ''  )
        {
            $allinputdata['excep'] = 'Please Enter Your Mark of Identification';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }

        else if((@$_POST['medium'] != '1') and (@$_POST['medium'] != '2') )
        {
            $allinputdata['excep'] = 'Please Select Your medium';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if((@$_POST['nationality'] != '1') and (@$_POST['nationality'] != '2') )
        {
            $allinputdata['excep'] = 'Please Select Your Nationality';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if((@$_POST['gend'] != '1') and (@$_POST['gend'] != '2'))
        {
            $allinputdata['excep'] = 'Please Select Your Gender';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if((@$_POST['hafiz']!= '1') and (@$_POST['hafiz']!= '2'))
        {
            $allinputdata['excep'] = 'Please Select Your Hafiz-e-Quran option';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if((@$_POST['religion'] != '1') and (@$_POST['religion'] != '2'))
        {
            $allinputdata['excep'] = 'Please Select Your religion';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if((@$_POST['UrbanRural'] != '1') and (@$_POST['UrbanRural'] != '2'))
        {
            $allinputdata['excep'] = 'Please Select Your Residency';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if(@$_POST['address'] =='')
        {
            $allinputdata['excep'] = 'Please Enter Your Address';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if(@$_POST['pvtinfo_dist'] =='')
        {
            $allinputdata['excep'] = 'Please Select Your District First!';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if(@$_POST['pvtinfo_teh'] =='')
        {
            $allinputdata['excep'] = 'Please Select Your Tehsil First! ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if(@$_POST['pvtZone'] =='')
        {
            $allinputdata['excep'] = 'Please Select Your Zone First! ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        
        else if(@$_POST['std_group'] == 0)
        {
            $allinputdata['excep'] = 'Please Select Your Study Group';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else
            if(
                (in_array(@$_POST['sub4'],$language_sub_cd)&&(in_array(@$_POST['sub5'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub5'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub6'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub5'],$language_sub_cd))) 
            )
            {
                $allinputdata['excep'] = 'Please Select One Subject from Languages Subjects.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(
                (in_array(@$_POST['sub4'],$history_sub_cd)&&(in_array(@$_POST['sub5'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                (in_array(@$_POST['sub5'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                (in_array(@$_POST['sub6'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub5'],$history_sub_cd))) 
                )
                {
                    $allinputdata['excep'] = 'Please Select One Subject from History Subjects.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Admission/'.$viewName);
                    return;

                }

                else if(@$_POST['exam_type'] == 1)
                {
                    if(@$_POST['sub1p2']==0)
                    {
                        $allinputdata['excep'] = 'Please Select Part-II Subject 1';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;
                    }
                    else
                        if(@$_POST['sub2p2']==0)
                        {
                            $allinputdata['excep'] = 'Please Select Part-II Subject 2';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission/'.$viewName);
                            return;
                        }
                        else
                            if(@$_POST['sub3p2']==0)
                            {
                                $allinputdata['excep'] = 'Please Select Part-II Subject 3';
                                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                redirect('Admission/'.$viewName);
                                return;
                            }
                            else
                                if(@$_POST['sub4p2']==0)
                                {
                                    $allinputdata['excep'] = 'Please Select Part-II Subject 4';
                                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                    redirect('Admission/'.$viewName);
                                    return;
                                }
                                else
                                    if(@$_POST['sub5p2']==0)
                                    {
                                        $allinputdata['excep'] = 'Please Select Part-II Subject 5';
                                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                        redirect('Admission/'.$viewName);
                                        return;
                                    }
                                    else
                                        if(@$_POST['sub6p2']==0)
                                        {
                                            $allinputdata['excep'] = 'Please Select Part-II Subject 6';
                                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                            redirect('Admission/'.$viewName);
                                            return;
                                        }
                                        else
                                            if(@$_POST['std_group']==5 && @$_POST['sub7p2']==0)
                                            {
                                                $allinputdata['excep'] = 'Please Select Part-II Subject 7';
                                                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                                redirect('Admission/'.$viewName);
                                                return;
                                            }
                                            else if(
                                                (in_array(@$_POST['sub4'],$language_sub_cd)&&(in_array(@$_POST['sub5'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                                                (in_array(@$_POST['sub5'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                                                (in_array(@$_POST['sub6'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub5'],$language_sub_cd))) 
                                                )
                                                {
                                                    $allinputdata['excep'] = 'Please Select One Subject from Languages Subjects.';
                                                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                                    redirect('Admission/'.$viewName);
                                                    return;

                                                }
                                                else if(
                                                    (in_array(@$_POST['sub4'],$history_sub_cd)&&(in_array(@$_POST['sub5'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                                                    (in_array(@$_POST['sub5'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                                                    (in_array(@$_POST['sub6'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub5'],$history_sub_cd))) 
                                                    )
                                                    {
                                                        $allinputdata['excep'] = 'Please Select One Subject from History Subjects.';
                                                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                                        redirect('Admission/'.$viewName);
                                                        return;

                                                    }

                }
                else if(@$_POST['exam_type'] == 2)
                { //DebugBreak();
                    if(@$_POST['sub1p2'] == 0)
                    {
                        $allinputdata['excep'] = 'Please Select Part-II Subject 1';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }
                    else if(@$_POST['sub2p2'] == 0)
                    {
                        $allinputdata['excep'] = 'Please Select Part-II Subject 2';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;
                    }

                    else if(@$_POST['sub3p2'] == 0)
                    {
                        $allinputdata['excep'] = 'Please Select Part-II Subject 3';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }
                    else if(@$_POST['sub4p2'] == 0 && @$_POST['std_group'] != 4)
                    {
                        $allinputdata['excep'] = 'Please Select Part-II Subject 4';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }
                    else if(@$_POST['sub5p2'] == 0 && @$_POST['std_group'] != 4)
                    {
                        $allinputdata['excep'] = 'Please Select Part-II Subject 5';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }
                    else if(@$_POST['sub6p2'] == 0 && @$_POST['std_group'] != 4)
                    {
                        $allinputdata['excep'] = 'Please Select Part-II Subject 6';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }
                    else if(@$_POST['sub7p2'] == 0 && @$_POST['std_group'] == 5)
                    {
                        $allinputdata['excep'] = 'Please Select Part-II Subject 7';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }
                    /*else if(@$_POST['sub8p2'] == 0 && @$_POST['std_group'] != 4)
                    {
                    $allinputdata['excep'] = 'Please Select Part-II Subject 8';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Admission/'.$viewName);
                    return;

                    }*/
                    else if(
                        (in_array(@$_POST['sub4'],$language_sub_cd)&&(in_array(@$_POST['sub5'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                        (in_array(@$_POST['sub5'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                        (in_array(@$_POST['sub6'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub5'],$language_sub_cd))) 
                        )
                        {
                            $allinputdata['excep'] = 'Please Select One Subject from Languages Subjects.';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission/'.$viewName);
                            return;

                        }
                        else if(
                            (in_array(@$_POST['sub4'],$history_sub_cd)&&(in_array(@$_POST['sub5'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                            (in_array(@$_POST['sub5'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                            (in_array(@$_POST['sub6'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub5'],$history_sub_cd))) 
                            )
                            {
                                $allinputdata['excep'] = 'Please Select One Subject from History Subjects.';
                                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                redirect('Admission/'.$viewName);
                                return;

                            }

                }
                else if(@$_POST['exam_type']==3)
                {
                    $sel_sub_p1_count = 0;
                    if(@$_POST['sub1'] != 0)
                    {
                        $sel_sub_p1_count = 1;    
                    }
                    if(@$_POST['sub2'] != 0)
                    {
                        $sel_sub_p1_count = 1;    
                    }
                    if(@$_POST['sub3'] != 0)
                {
                    $sel_sub_p1_count = 1;    
                }
                if(@$_POST['sub4'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub5'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub6'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['std_group']==5 && @$_POST['sub7'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if($sel_sub_p1_count == 0)
            {
                $allinputdata['excep'] = 'Please Select at least one Part-I Subject.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            if(@$_POST['sub1p2'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 1';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub2p2'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 2';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;
            }

            else if(@$_POST['sub3p2'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 3';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub4p2'] == 0 && @$_POST['std_group'] != 4)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 4';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub5p2'] == 0 && @$_POST['std_group'] != 4)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 5';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub6p2'] == 0 && @$_POST['std_group'] != 4)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 6';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub7p2'] == 0 && @$_POST['std_group'] == 5)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 7';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(
                (in_array(@$_POST['sub4'],$language_sub_cd)&&(in_array(@$_POST['sub5'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub5'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub6'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub5'],$language_sub_cd))) 
                )
                {
                    $allinputdata['excep'] = 'Please Select One Subject from Languages Subjects.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Admission/'.$viewName);
                    return;

                }
                else if(
                    (in_array(@$_POST['sub4'],$history_sub_cd)&&(in_array(@$_POST['sub5'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub5'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub6'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub5'],$history_sub_cd))) 
                    )
                    {
                        $allinputdata['excep'] = 'Please Select One Subject from History Subjects.';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }



        }
        else if(@$_POST['exam_type']==4)
        {
            $sel_sub_p2_count = 0;

            if(@$_POST['sub1p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub2p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub3p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub4p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub5p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub6p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['std_group']==5 && @$_POST['sub7p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if($sel_sub_p2_count == 0)
            {
                $allinputdata['excep'] = 'Please Select at least one Part-II Subject.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(
                (in_array(@$_POST['sub4'],$language_sub_cd)&&(in_array(@$_POST['sub5'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub5'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub6'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub5'],$language_sub_cd))) 
                )
                {
                    $allinputdata['excep'] = 'Please Select One Subject from Languages Subjects.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Admission/'.$viewName);
                    return;

                }
                else if(
                    (in_array(@$_POST['sub4'],$history_sub_cd)&&(in_array(@$_POST['sub5'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub5'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub6'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub5'],$history_sub_cd))) 
                    )
                    {
                        $allinputdata['excep'] = 'Please Select One Subject from History Subjects.';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }




        }
        else if(@$_POST['exam_type']==5)
        {
            $sel_sub_p1_count = 0;

            if(@$_POST['sub1'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub2'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub3'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub4'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub5'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub6'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['std_group']==5 && @$_POST['sub7'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if($sel_sub_p1_count == 0)
            {
                $allinputdata['excep'] = 'Please Select at least one Part-II Subject.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(
                (in_array(@$_POST['sub4'],$language_sub_cd)&&(in_array(@$_POST['sub5'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub5'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub6'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub5'],$language_sub_cd))) 
                )
                {
                    $allinputdata['excep'] = 'Please Select One Subject from Languages Subjects.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Admission/'.$viewName);
                    return;

                }
                else if(
                    (in_array(@$_POST['sub4'],$history_sub_cd)&&(in_array(@$_POST['sub5'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub5'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub6'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub5'],$history_sub_cd))) 
                    )
                    {
                        $allinputdata['excep'] = 'Please Select One Subject from History Subjects.';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }  



        }
        else if(@$_POST['exam_type']==6)
        {
            $sel_sub_p1_count = 0;
            $sel_sub_p2_count = 0;
            if(@$_POST['sub1'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub2'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub3'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub4'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub5'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub6'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['std_group']==5 && @$_POST['sub7'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if($sel_sub_p1_count == 0)
            {
                $allinputdata['excep'] = 'Please Select at least one Part-I Subject.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            if(@$_POST['sub1p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub2p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub3p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub4p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub5p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub6p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['std_group']==5 && @$_POST['sub7p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if($sel_sub_p2_count == 0)
            {
                $allinputdata['excep'] = 'Please Select at least one Part-II Subject.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(
                (in_array(@$_POST['sub4'],$language_sub_cd)&&(in_array(@$_POST['sub5'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub5'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub6'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub5'],$language_sub_cd))) 
                )
                {
                    $allinputdata['excep'] = 'Please Select One Subject from Languages Subjects.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Admission/'.$viewName);
                    return;

                }
                else if(
                    (in_array(@$_POST['sub4'],$history_sub_cd)&&(in_array(@$_POST['sub5'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub5'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub6'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub5'],$history_sub_cd))) 
                    )
                    {
                        $allinputdata['excep'] = 'Please Select One Subject from History Subjects.';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }




        }
        // Additional Subjects.
        else if(@$_POST['exam_type']==16 && @$_POST['category']==2)
        {
            if(@$_POST['sub6'] == 0 ||@$_POST['sub6p2'] == 0 )
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 6';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub7'] == 0 || @$_POST['sub7p2'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 7';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub8'] == 0 || @$_POST['sub8p2'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 8';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(
                (in_array(@$_POST['sub4'],$language_sub_cd)&&(in_array(@$_POST['sub5'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub5'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub6'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub5'],$language_sub_cd))) 
                )
                {
                    $allinputdata['excep'] = 'Please Select One Subject from Languages Subjects.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Admission/'.$viewName);
                    return;

                }
                else if(
                    (in_array(@$_POST['sub4'],$history_sub_cd)&&(in_array(@$_POST['sub5'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub5'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub6'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub5'],$history_sub_cd))) 
                    )
                    {
                        $allinputdata['excep'] = 'Please Select One Subject from History Subjects.';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }
        }
        // Marks Improvements
        else if (@$_POST['exam_type']==16 && @$_POST['category']==1 && @$_POST['ddlMarksImproveoptions']==1)
        {
            if(@$_POST['sub1']==0)
            {
                $allinputdata['excep'] = 'Please Select Part-I Subject 1';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;
            }
            else
                if(@$_POST['sub2']==0)
                {
                    $allinputdata['excep'] = 'Please Select Part-I Subject 2';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Admission/'.$viewName);
                    return;
                }
                else
                    if(@$_POST['sub3']==0)
                    {
                        $allinputdata['excep'] = 'Please Select Part-I Subject 3';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;
                    }
                    else
                        if(@$_POST['sub4']==0)
                        {
                            $allinputdata['excep'] = 'Please Select Part-I Subject 4';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission/'.$viewName);
                            return;
                        }
                        else
                            if(@$_POST['sub5']==0)
                            {
                                $allinputdata['excep'] = 'Please Select Part-I Subject 5';
                                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                redirect('Admission/'.$viewName);
                                return;
                            }
                            else
                                if(@$_POST['sub6']==0)
                                {
                                    $allinputdata['excep'] = 'Please Select Part-I Subject 6';
                                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                    redirect('Admission/'.$viewName);
                                    return;
                                }
                                else
                                    if(@$_POST['std_group']==5 && @$_POST['sub7']==0)
                                    {
                                        $allinputdata['excep'] = 'Please Select Part-I Subject 7';
                                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                        redirect('Admission/'.$viewName);
                                        return;
                                    }
                                    else if(
                                        (in_array(@$_POST['sub4'],$language_sub_cd)&&(in_array(@$_POST['sub5'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                                        (in_array(@$_POST['sub5'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                                        (in_array(@$_POST['sub6'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub5'],$language_sub_cd))) 
                                        )
                                        {
                                            $allinputdata['excep'] = 'Please Select One Subject from Languages Subjects.';
                                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                            redirect('Admission/'.$viewName);
                                            return;

                                        }
                                        else if(
                                            (in_array(@$_POST['sub4'],$history_sub_cd)&&(in_array(@$_POST['sub5'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                                            (in_array(@$_POST['sub5'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                                            (in_array(@$_POST['sub6'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub5'],$history_sub_cd))) 
                                            )
                                            {
                                                $allinputdata['excep'] = 'Please Select One Subject from History Subjects.';
                                                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                                redirect('Admission/'.$viewName);
                                                return;

                                            }
        }
        else if (@$_POST['exam_type']==16 && @$_POST['category']==1 && @$_POST['ddlMarksImproveoptions']==2)
        {
            if(@$_POST['sub1p2']==0)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 1';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;
            }
            else
                if(@$_POST['sub2p2']==0)
                {
                    $allinputdata['excep'] = 'Please Select Part-II Subject 2';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Admission/'.$viewName);
                    return;
                }
                else
                    if(@$_POST['sub3p2']==0)
                    {
                        $allinputdata['excep'] = 'Please Select Part-II Subject 3';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;
                    }
                    else
                        if(@$_POST['sub4p2']==0)
                        {
                            $allinputdata['excep'] = 'Please Select Part-II Subject 4';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission/'.$viewName);
                            return;
                        }
                        else
                            if(@$_POST['sub5p2']==0)
                            {
                                $allinputdata['excep'] = 'Please Select Part-II Subject 5';
                                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                redirect('Admission/'.$viewName);
                                return;
                            }
                            else
                                if(@$_POST['sub6p2']==0)
                                {
                                    $allinputdata['excep'] = 'Please Select Part-II Subject 6';
                                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                    redirect('Admission/'.$viewName);
                                    return;
                                }
                                else
                                    if(@$_POST['std_group']==5 && @$_POST['sub7p2']==0)
                                    {
                                        $allinputdata['excep'] = 'Please Select Part-II Subject 7';
                                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                        redirect('Admission/'.$viewName);
                                        return;
                                    }
                                    else if(
                                        (in_array(@$_POST['sub4'],$language_sub_cd)&&(in_array(@$_POST['sub5'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                                        (in_array(@$_POST['sub5'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                                        (in_array(@$_POST['sub6'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub5'],$language_sub_cd))) 
                                        )
                                        {
                                            $allinputdata['excep'] = 'Please Select One Subject from Languages Subjects.';
                                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                            redirect('Admission/'.$viewName);
                                            return;

                                        }
                                        else if(
                                            (in_array(@$_POST['sub4'],$history_sub_cd)&&(in_array(@$_POST['sub5'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                                            (in_array(@$_POST['sub5'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                                            (in_array(@$_POST['sub6'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub5'],$history_sub_cd))) 
                                            )
                                            {
                                                $allinputdata['excep'] = 'Please Select One Subject from History Subjects.';
                                                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                                                redirect('Admission/'.$viewName);
                                                return;

                                            }
        }
        else if (@$_POST['exam_type']==16 && @$_POST['category']==1 && @$_POST['ddlMarksImproveoptions']==3)
        {
            $sel_sub_p1_count = 0;
            $sel_sub_p2_count = 0;
            if(@$_POST['sub1'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub2'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub3'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub4'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub5'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['sub6'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if(@$_POST['std_group']==5 && @$_POST['sub7'] != 0)
            {
                $sel_sub_p1_count = 1;    
            }
            if($sel_sub_p1_count == 0)
            {
                $allinputdata['excep'] = 'Please Select at least one Part-I Subject.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            if(@$_POST['sub1p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub2p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub3p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub4p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub5p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['sub6p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if(@$_POST['std_group']==5 && @$_POST['sub7p2'] != 0)
            {
                $sel_sub_p2_count = 1;    
            }
            if($sel_sub_p2_count == 0)
            {
                $allinputdata['excep'] = 'Please Select at least one Part-II Subject.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(
                (in_array(@$_POST['sub4'],$language_sub_cd)&&(in_array(@$_POST['sub5'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub5'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub6'],$language_sub_cd))) ||
                (in_array(@$_POST['sub6'],$language_sub_cd)&&(in_array(@$_POST['sub4'],$language_sub_cd)|| in_array(@$_POST['sub5'],$language_sub_cd))) 
                )
                {
                    $allinputdata['excep'] = 'Please Select One Subject from Languages Subjects.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Admission/'.$viewName);
                    return;

                }
                else if(
                    (in_array(@$_POST['sub4'],$history_sub_cd)&&(in_array(@$_POST['sub5'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub5'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub6'],$history_sub_cd))) ||
                    (in_array(@$_POST['sub6'],$history_sub_cd)&&(in_array(@$_POST['sub4'],$history_sub_cd)|| in_array(@$_POST['sub5'],$history_sub_cd))) 
                    )
                    {
                        $allinputdata['excep'] = 'Please Select One Subject from History Subjects.';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission/'.$viewName);
                        return;

                    }

        }

    }



}