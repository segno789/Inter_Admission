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

        $formno_seg = $this->uri->segment(3);
        $dob_seg = $this->uri->segment(4);
        if($formno_seg !=0 && $dob_seg != ''){
            $formno = $formno_seg;     
            $dob = $dob_seg;
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
        $pdf ->SetRightMargin(5);
        $pdf->AddPage();
        $x = 0.55;
        $Y = -0.2;


        $session = Session == "1" ? "Annual" : "Supplymentry";
        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(1.2,0.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
        $pdf->Image(base_url()."assets/img/ExamCenter.jpg",4.5,2.85+$Y, 2.78,0.15, "jpeg");        
        $pdf->Image(base_url()."assets/img/10th.png",7.30,0.25, 0.30,0.30, "PNG");    

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.8,0.4);
        $pdf->Cell(0, 0.2, "ADMISSION /REVENUE FORM ", 0.25, "C");
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(3.85,0.4);
        $pdf->Cell(0, 0.2,  "(Private Candidate) for SSC " .$session."  Examination , ".Year, 0.25, "C");

        //--------------------------- Form No & Rno
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(5.8,0.65+$Y);
        $pdf->Cell(0.5,0.5, "Roll No: _______________",0,'L');    
        $pdf->SetFont('Arial','B',7);
        $pdf->SetXY(6.6,.80+$Y);
        $pdf->Cell(0.5,0.5, "(For office use only)",0,'L');
        //------ Picture Box on Centre      

        //DebugBreak();
        $Barcode = $data['formNo']."@".$data['class'].'@'.$data['sess'].'@'.$data["Iyear"];
        $image =  $this->set_barcode($Barcode);




        $pdf->Image(BARCODE_PATH.$image,3.2, 0.61  ,1.8,0.20,"PNG");
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
                $grp_name = 'SCIENCE';
                break;
            case '7':
                $grp_name = 'SCIENCE';
                break;
            case '8':
                $grp_name = 'SCIENCE';
                break;
            case '2':
                $grp_name = 'GENERAL';
                break;
            case '5':
                $grp_name = 'Deaf and Dumb';
                break;
            default:
                $grp_name = "No Group Selected.";
        }
        $pdf->SetXY(1.8,1.28+$Y);
        $pdf->SetFont('Arial','bU',10);
        $pdf->Cell( 0.5,0.7,$grp_name." GROUP",0,'L');
        //--------------------------- 1st line 
        $pdf->SetXY(0.5,1.55+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Form No:",0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,1.55+$Y);
        $pdf->Cell( 0.5,0.5,$data['formNo'],0,'L');


        $chkcat09 = ($data['mi_type']!= 2?$this->getCatName($data['cat09']):'Aditional') ;

        $chkcat10 = ($data['mi_type']!= 2?$this->getCatName($data['cat10']):'Aditional');

        if($chkcat09 != -1 && $chkcat10 != -1)
        {
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(2.5,1.55+$Y);
            $pdf->Cell( 0.5,0.5,"(9th: ",0,'L');
            $pdf->SetXY(3.0,1.55+$Y);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.5, $chkcat09,0,'L'); 
            $pdf->SetXY(4.0,1.55+$Y);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.5,"10th: ",0,'L');
            $pdf->SetXY(4.4,1.55+$Y);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.5,$chkcat10.")",0,'L');

        }
        else if($chkcat09 != -1)
        {
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(2.5,1.55+$Y);
            $pdf->Cell( 0.5,0.5,"(9th: ",0,'L');
            $pdf->SetXY(3.0,1.55+$Y);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0.5,0.5, $chkcat09.')',0,'L');
        }
        else if($chkcat10 != -1)
        {
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(2.5,1.55+$Y);
            $pdf->Cell( 0.5,0.5,"(10th: ",0,'L');
            $pdf->SetXY(3.0,1.55+$Y);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0.5,0.5,$chkcat10.')',0,'L');  
        }
        $LastSess = 0 ;
        //  //DebugBreak();
        if($data["SessOfLastAp"] == 1 or $data["SessOfLastAp"] == 2  )
        {
            $LastSess =  $data["SessOfLastAp"]==1?"A":"S";
        }     
        $pdf->SetXY(0.5, 1.7+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Prev Roll No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,1.7+$Y);

        // DebugBreak();
        $yearOfLastAp = $data['YearOfLastAp'];
        $cand_chance = $data['chance'];
        $cand_Notif = $data['Prev_result2'];
        $cand_Nofif_part1 =$data['Prev_result1'];
        $str = '';
        if($data['cat09']==2 || $data['cat10']==2)
        {

            if($data['Prev_chance']==1)
            {
                if($data['cat09']==2 && $data['cat10']==2)
                {

                    $str = "S-17 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
                }
                else if($data['cat09']==2 && $data['cat10'] !=2)
                {
                    $str = "S-17 [P-I $cand_Nofif_part1]";        
                }
                else if($data['cat09'] !=2 && $data['cat10']==2)
                {
                    $str = "S-17 [P-II $cand_Notif]";        
                }

            }
            else
                if($data['Prev_chance']==2)
                {
                    if($data['cat09']==2 && $data['cat10']==2)
                    {

                        $str = "A-17 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
                    }
                    else if($data['cat09']==2 && $data['cat10'] !=2)
                    {
                        $str = "A-17 [P-I $cand_Nofif_part1]";        
                    }
                    else if($data['cat09'] !=2 && $data['cat10']==2)
                    {
                        $str = "A-17 [P-II $cand_Notif]";        
                    }
            }
            else
                if($data['Prev_chance']==3)
                {
                    if($data['cat09']==2 && $data['cat10']==2)
                    {

                        $str = " S-16 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
                    }
                    else if($data['cat09']==2 && $data['cat10'] !=2)
                    {
                        $str = "S-16 [P-I $cand_Nofif_part1]";        
                    }
                    else if($data['cat09'] !=2 && $data['cat10']==2)
                    {
                        $str = "S-16 [P-II $cand_Notif]";        
                    }
            }
            if($data['Prev_chance']==4)
            {
                $str ="";
            }    
        }
        //if()

        $pdf->Cell(0.5,0.5,$data["oldRno"]." ( $LastSess,  $yearOfLastAp )  $str",0,'L');

        $pdf->SetXY(0.5,1.85+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,1.85+$Y);
        $pdf->Cell(0.5,0.5,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(0.5, 2.0+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,2.0+$Y);
        $pdf->Cell(0.5,0.5,$data["Fname"],0,'L');

        //--------------------------- 3rd line 
        //__Mobile    

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
        $pdf->SetXY(0.5,2.15+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Date Of Birth:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,2.15+$Y);
        $pdf->Cell(0.5,0.5,date("d-m-Y", strtotime($data["Dob"])),0,'L');

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
        $pdf->SetXY(0.5,2.45+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Speciality:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.50,2.45+$Y);
        $pdf->Cell(0.5,0.5,$this->GetSpeciality($data["Spec"]),0,'L');

        //DebugBreak();
        //--------------------------- Speciality and Internal Grade 
        $pdf->SetXY(3.5+$x,2.15+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Board Name:",0,'L');
        if($data["Brd_cd"] !=  null && $data["Brd_cd"] >0)
        {
            $OldBoard = ($data["Brd_Abbr"]);
        }
        else
        {
            $OldBoard = 'Nil';  
        }

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.15+$Y);
        $pdf->Cell(0.5,0.5,$OldBoard,0,'L');

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
        $yy = $Y-0.2;
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

        $pdf->SetXY(6.1,6.18+$yy);
        $pdf->Cell(1.4,0.65,'',1,0,'C',0); 
        $pdf->SetXY(6.2,6.58+$yy);
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
        $pdf->Cell($boxWidth,0.2,$data['sub8ap1'] != 1 ? '':   '    '.'4. '. $this->GetSubNameHere($data['sub8']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.8+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub4Ap1'] != 1 ? '':   '    '.'5. '. $this->GetSubNameHere($data['sub4']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,5.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub5Ap1'] != 1 ? '':   '    '.'6. '. $this->GetSubNameHere($data['sub5']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);                                                                     
        $pdf->SetXY($xx,5.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub6Ap1'] != 1 ? '':   '    '.'7. '. $this->GetSubNameHere($data['sub6']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,5.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub7Ap1'] != 1 ? '':   '    '.'8. '. $this->GetSubNameHere($data['sub7']),1,0,'L',1);

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

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub3ap2'] != 1 ? '':  '    '.'3. '.  $this->GetSubNameHere($data['sub3']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.6+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub8Ap2'] != 1 ? '':  '    '.'4. '.  $this->GetSubNameHere($data['sub8']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.8+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub4Ap2'] != 1 ? '':  '    '.'5. '.  $this->GetSubNameHere($data['sub4']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub5Ap2'] != 1 ? '':  '    '.'6. '.  $this->GetSubNameHere($data['sub5']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub6Ap2'] != 1 ? '':  '    '.'7. '.  $this->GetSubNameHere($data['sub6']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub7Ap2'] != 1 ? '':  '    '.'8. '.  $this->GetSubNameHere($data['sub7']),1,0,'L',1);

        //DebugBreak();
        $pdf->SetXY(0.5,2.65+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell( 0.5,0.5,"Address:",0,'L');

        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(1.5,2.65+$Y);
        $pdf->Cell(0.5,0.5,$data["addr"],0,'L');

        $pdf->SetXY(0.5,2.95+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.5,0.5,"Proposed Exam Area:",0,'R');
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(1.7,2.95+$Y);
        $pdf->Cell( 0.5,0.5,$data['Zone_cd']." - ".$data['zone_name']."",0,'L');

        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(3.5,3.05+$Y);
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
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Bank Challan No. ".$data['chalanno'],0,'L');

        $Y = $Y - 0.5;
        $pdf->SetXY(0.2, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Admission Fee ",0,'L');


        $pdf->SetXY(1.2, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,$data['AdmFee'].'/-',0,'L');


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
        $pdf->Cell( 0.5,0.5,$data['AdmTotalFee'].' /-',0,'L');

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

        $pdf->SetXY(0,5.0+3.0+$Y);
        $pdf->SetFont('Arial','',10);

        $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,6.50, 9.2,0.09, "jpeg"); 

        $Y = $Y + 1.68;

        $pdf->SetXY(0.2,6.1+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Board Copy: (Along with Scroll)",0,'L');

        $pdf->SetXY(1.2,6.0+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA (SSC ".$session." Examination ,".Year." )",0,'C');

        $pdf->SetXY(0.2,6.4+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $bx = 6.8;
        $by = 6.1;
        $pdf->Image(base_url()."assets/img/10th.png",7.58,6.2+$Y, 0.30,0.30, "PNG");  

        $pdf->Image(BARCODE_PATH.$image,5.75, 6.8  ,1.8,0.20,"PNG");

        $pdf->SetXY(0.2,6.46+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(3.2,6.46+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(5.2,6.46+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Bank Challan No. ".$data['chalanno'],0,'L');

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

        $pdf->SetXY(0,5.0+3.0+$Y);
        $pdf->SetFont('Arial','',10);

        $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,7.70, 9.2,0.09, "jpeg");  

        $Y = $Y - 0.39;

        $pdf->SetXY(1.2,8.1+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA (SSC ".$session." Examination ,".Year." )",0,'C');


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

        $pdf->Image(BARCODE_PATH.$image,5.75, 8.5+$Y  ,1.8,0.20,"PNG");

        $pdf->Image(base_url()."assets/img/10th.png",7.58,8.3+$Y, 0.30,0.30, "PNG");  

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
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,"Bank Challan No. ".$data['chalanno'],0,'L');


        $pdf->SetXY(5.3, 8.9+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');

        $pdf->SetXY(0,5.0+3.0+$Y);
        $pdf->SetFont('Arial','',10);
        // //DebugBreak();
        $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,9.1, 8.3,0.09, "jpeg");  

        $Y = $Y - 0.09;
        //


        $pdf->SetXY(1.2,9.6+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA (SSC ".$session." Examination ,".Year." )",0,'C');

        $bx = 6.8;
        $by = 9.5;


        $pdf->SetXY(3.2,9.8+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(0.2,9.65+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Candidate Copy",0,'L');


        $pdf->SetXY(0.2,10.0+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $pdf->Image(BARCODE_PATH.$image,5.75, 10.0+$Y  ,1.8,0.20,"PNG");

        $pdf->Image(base_url()."assets/img/10th.png",7.58,9.8+$Y, 0.30,0.30, "PNG");  

        $pdf->SetXY(0.5,10.2+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Form No:",0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.0,10.2+$Y);
        $pdf->Cell( 0.5,0.5,$data['formNo'],0,'L');




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
        $pdf->Cell( 0.5,0.5,"Proposed Exam Area:",0,'L');

        $pdf->SetXY(1.48, 10.59+$Y);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell( 0.5,0.5,$data['Zone_cd']." - ".$data['zone_name'],0,'L');

        $pdf->Image(base_url().'assets/img/CandidateCopy.jpg',0.27,10.86, 7.58,0.60, "jpeg");  


        $pdf->SetXY(0.5, 10.05+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');


        $pdf->SetXY(3.5, 10.05+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,"Bank Challan No. ".$data['chalanno'],0,'L');


        $pdf->SetXY(3.4, 10.7+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');


        $filename="Admission_Forms_".$data['formNo']."_"   .  ".pdf";
        $pdf->Output($filename, 'I');

    }

    function GetDueDate()
    {

        $dueDate='';
        $single_date= '08-08-2016';  $double_date= '15-08-20156';  $tripple_date= '22-08-2016';
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
        if($_sub_cd == 1)  $ret_val = "URDU";
        else if($_sub_cd == 2)  $ret_val = "ENGLISH";
            else if($_sub_cd == 3)  $ret_val = "ISLAMIYAT (COMPULSORY)";
                else if($_sub_cd == 4)  $ret_val = "PAKISTAN STUDIES";
                    else if($_sub_cd == 5)  $ret_val = "MATHEMATICS";
                        else if($_sub_cd == 6)  $ret_val = "PHYSICS";
                            else if($_sub_cd == 7)  $ret_val = "CHEMISTRY";
                                else if($_sub_cd == 8)  $ret_val = "BIOLOGY";
                                    else if($_sub_cd == 9)  $ret_val = "GENERAL SCIENCE";
                                        else if($_sub_cd == 11)  $ret_val = "GEOGRAPHY OF PAKISTAN";
                                            else if($_sub_cd == 18)  $ret_val = "ART/ART & MODEL DRAWING";
                                                else if($_sub_cd == 22)  $ret_val = "ARABIC";
                                                    else if($_sub_cd == 23)  $ret_val = "PERSIAN";
                                                        else if($_sub_cd == 36)  $ret_val = "PUNJABI";
                                                            else if($_sub_cd == 20)  $ret_val = "ISLAMIC HISTORY";
                                                                else if($_sub_cd == 21)  $ret_val = "HISTORY OF PAKISTAN/ HISTORY OF INDO PAK";
                                                                    else if($_sub_cd == 78)  $ret_val = "COMPUTER SCIENCE";
                                                                        else if($_sub_cd == 12)  $ret_val = "HOUSE HOLD ACCOUNTS & ITS RELATED PROBLEMS";
                                                                            else if($_sub_cd == 13)  $ret_val = "ELEMENTS OF HOME ECONOMICS";
                                                                                else if($_sub_cd == 14)  $ret_val = "PHYSIOLOGY & HYGIENE";
                                                                                    else if($_sub_cd == 15)  $ret_val = "GEOMETRICAL & TECHNICAL DRAWING";
                                                                                        else if($_sub_cd == 16)  $ret_val = "GEOLOGY";
                                                                                            else if($_sub_cd == 17)  $ret_val = "ASTRONOMY & SPACE SCIENCE";
                                                                                                else if($_sub_cd == 19)  $ret_val = "ISLAMIC STUDIES";
                                                                                                    else if($_sub_cd == 27)  $ret_val = "FOOD AND NUTRITION";
                                                                                                        else if($_sub_cd == 28)  $ret_val = "ART IN HOME ECONOMICS";
                                                                                                            else if($_sub_cd == 29)  $ret_val = "MANAGEMENT FOR BETTER HOME";
                                                                                                                else if($_sub_cd == 30)  $ret_val = "CLOTHING & TEXTILES";
                                                                                                                    else if($_sub_cd == 31)  $ret_val = "CHILD DEVELOPMENT AND FAMILY LIVING";
                                                                                                                        else if($_sub_cd == 32)  $ret_val = "MILITARY SCIENCE";
                                                                                                                            else if($_sub_cd == 33)  $ret_val = "COMMERCIAL GEOGRAPHY";
                                                                                                                                else if($_sub_cd == 34)  $ret_val = "URDU LITERATURE";
                                                                                                                                    else if($_sub_cd == 35)  $ret_val = "ENGLISH LITERATURE";
                                                                                                                                        else if($_sub_cd == 37)  $ret_val = "EDUCATION";
                                                                                                                                            else if($_sub_cd == 38)  $ret_val = "ELEMENTARY NURSING & FIRST AID";
                                                                                                                                                else if($_sub_cd == 39)  $ret_val = "PHOTOGRAPHY";
                                                                                                                                                    else if($_sub_cd == 40)  $ret_val = "HEALTH & PHYSICAL EDUCATION";
                                                                                                                                                        else if($_sub_cd == 41)  $ret_val = "CALIGRAPHY";
                                                                                                                                                            else if($_sub_cd == 42)  $ret_val = "LOCAL (COMMUNITY) CRAFTS";
                                                                                                                                                                else if($_sub_cd == 43)  $ret_val = "ELECTRICAL WIRING";
                                                                                                                                                                    else if($_sub_cd == 44)  $ret_val = "RADIO ELECTRONICS";
                                                                                                                                                                        else if($_sub_cd == 45)  $ret_val = "COMMERCE";
                                                                                                                                                                            else if($_sub_cd == 46)  $ret_val = "AGRICULTURE";
                                                                                                                                                                                else if($_sub_cd == 53)  $ret_val = "ANIMAL PRODUCTION";
                                                                                                                                                                                    else if($_sub_cd == 54)  $ret_val = "PRODUCTIVE INSECTS AND FISH CULTURE";
                                                                                                                                                                                        else if($_sub_cd == 55)  $ret_val = "HORTICULTURE";
                                                                                                                                                                                            else if($_sub_cd == 56)  $ret_val = "PRINCIPLES OF HOME ECONOMICS";
                                                                                                                                                                                                else if($_sub_cd == 57)  $ret_val = "RELATED ACT";
                                                                                                                                                                                                    else if($_sub_cd == 58)  $ret_val = "HAND AND MACHINE EMBROIDERY";
                                                                                                                                                                                                        else if($_sub_cd == 59)  $ret_val = "DRAFTING AND GARMENT MAKING";
                                                                                                                                                                                                            else if($_sub_cd == 60)  $ret_val = "HAND & MACHINE KNITTING & CROCHEING";
                                                                                                                                                                                                                else if($_sub_cd == 61)  $ret_val = "STUFFED TOYS AND DOLL MAKING";
                                                                                                                                                                                                                    else if($_sub_cd == 62)  $ret_val = "CONFECTIONERY AND BAKERY";
                                                                                                                                                                                                                        else if($_sub_cd == 63)  $ret_val = "PRESERVATION OF FRUITS,VEGETABLES & OTHER FOODS";
                                                                                                                                                                                                                            else if($_sub_cd == 64)  $ret_val = "CARE AND GUIDENCE OF CHILDREN";
                                                                                                                                                                                                                                else if($_sub_cd == 65)  $ret_val = "FARM HOUSE HOLD MANAGEMENT";
                                                                                                                                                                                                                                    else if($_sub_cd == 66)  $ret_val = "ARITHEMATIC";
                                                                                                                                                                                                                                        else if($_sub_cd == 67)  $ret_val = "BAKERY";
                                                                                                                                                                                                                                            else if($_sub_cd == 68)  $ret_val = "CARPET MAKING";
                                                                                                                                                                                                                                                else if($_sub_cd == 69)  $ret_val = "DRAWING";
                                                                                                                                                                                                                                                    else if($_sub_cd == 70)  $ret_val = "EMBORIDERY";
                                                                                                                                                                                                                                                        else if($_sub_cd == 71)  $ret_val = "HISTORY";
                                                                                                                                                                                                                                                            else if($_sub_cd == 72)  $ret_val = "TAILORING";
                                                                                                                                                                                                                                                                else if($_sub_cd == 24)  $ret_val = "GEOGRAPHY";
                                                                                                                                                                                                                                                                    else if($_sub_cd == 25)  $ret_val = "ECONOMICS";
                                                                                                                                                                                                                                                                        else if($_sub_cd == 26)  $ret_val = "CIVICS";
                                                                                                                                                                                                                                                                            else if($_sub_cd == 47)  $ret_val = "BOOK KEEPING & ACCOUNTANCY";
                                                                                                                                                                                                                                                                                else if($_sub_cd == 48)  $ret_val = "WOOD WORK (FURNITURE MAKING)";
                                                                                                                                                                                                                                                                                    else if($_sub_cd == 49)  $ret_val = "GENERAL AGRICULTURE";
                                                                                                                                                                                                                                                                                        else if($_sub_cd == 50)  $ret_val = "FARM ECONOMICS";
                                                                                                                                                                                                                                                                                            else if($_sub_cd == 52)  $ret_val = "LIVE STOCK FARMING";
                                                                                                                                                                                                                                                                                                else if($_sub_cd == 73)  $ret_val = "TYPE WRITING";
                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 74)  $ret_val = "WEAVING";
                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 75)  $ret_val = "SECRETARIAL PRACTICE";
                                                                                                                                                                                                                                                                                                            else if($_sub_cd == 76)  $ret_val = "CANDLE MAKING";
                                                                                                                                                                                                                                                                                                                else if($_sub_cd == 77)  $ret_val = "SECRETARIAL PRACTICE AND CORRESPONDANCE";
                                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 10)  $ret_val = "FOUNDATION OF EDUCATION";
                                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 51)  $ret_val = "ETHICS";
                                                                                                                                                                                                                                                                                                                            else if($_sub_cd == 79)  $ret_val = "WOOD WORK (BOAT MAKING)";
                                                                                                                                                                                                                                                                                                                                else if($_sub_cd == 80)  $ret_val = "PRINCIPLES OF ARITHMATIC";
                                                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 81)  $ret_val = "SEERAT-E-RASOOL";
                                                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 82)  $ret_val = "AL-QURAAN";
                                                                                                                                                                                                                                                                                                                                            else if($_sub_cd == 83)  $ret_val = "POULTRY FARMING";
                                                                                                                                                                                                                                                                                                                                                else if($_sub_cd == 84)  $ret_val = "ART & MODEL DRAWING";
                                                                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 85)  $ret_val = "BUSINESS STUDIES";
                                                                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 86)  $ret_val = "HADEES & FIQAH";
                                                                                                                                                                                                                                                                                                                                                            else if($_sub_cd == 87)  $ret_val = "ENVIRONMENTAL STUDIES";
                                                                                                                                                                                                                                                                                                                                                                else if($_sub_cd == 88)  $ret_val = "REFRIGERATION AND AIR CONDITIONING";
                                                                                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 89)  $ret_val = "FISH FARMING";
                                                                                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 90)  $ret_val = "COMPUTER HARDWARE";
                                                                                                                                                                                                                                                                                                                                                                            else if($_sub_cd == 91)  $ret_val = "BEAUTICIAN";
                                                                                                                                                                                                                                                                                                                                                                                else if($_sub_cd == 92)  $ret_val = "General Math"; 
                                                                                                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 93)  $ret_val = "COMPUTER SCIENCES_DFD";    
                                                                                                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 94)  $ret_val = "HEALTH & PHYSICAL EDUCATION_DFD";   
                                                                                                                                                                                                                                                                                                                                                                                            return $ret_val ;             
    }

    function getCatName($cat)
    {
        if ($cat==1) return "Full Appear";
        else if ($cat ==2) return "Re-Appear";
            else if ($cat ==3 or $cat == 7) return "Marks Improve";
                else if ($cat ==5 ) return "Additional";
                    else return -1;
    }

    private function makecat($exam_type,$marksImp,$is11th)
    {
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
            else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1)) && $marksImp == 2){
                $cate['cat11'] = 0;
                $cate['cat12'] = 3;
            }
            else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1))  && $marksImp == 1){
                $cate['cat11'] = 3;
                $cate['cat12'] = 0;
            }
            else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1))  && $marksImp == 3){
                $cate['cat11'] = 3;
                $cate['cat12'] = 3;
            }
            else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1))  && $marksImp ==4){
                $cate['cat11'] = 7;
                $cate['cat12'] = 7;
            }

            else if($exam_type == 15 || ($exam_type == 16 && $cattype == 2)){
                $cate['cat11'] =  5;
                $cate['cat12'] = 5;
            }        
            return $cate;
    }

    public function Pre_Inter_Data()
    {           
        $mrollno = $_POST["txtMatRno"];
        $hsscrno = $_POST["oldRno"];
        $oldClass= $_POST["oldClass"];
        $iyear    = $_POST["oldYear"];
        $session = $_POST["oldSess"];
        $board   = $_POST["oldBrd_cd"];

        $data = array('sscrno'=>$mrollno,'hsscrno'=>$hsscrno,'hsscclass'=>$oldClass,'iYear'=>$iyear,'session'=>$session,'board'=>$board);
        $this->load->model('Admission_model');
        $data = $this->Admission_model->Pre_Inter_data($data);

        $error_msg = '';

        if(!$data){
            $error_msg.='<span style="font-size: 16pt; color:red;">' . 'No Any Student Found Against Your Criteria</span>';
        }

        $specialcase = $data['0']['SpacialCase'];
        $specialcode = $data['0']['spl_cd'];
        if($specialcode != ''){

            $error_msg.='<span style="font-size: 16pt; color:red;">' . '   Your Admission cannot be procceed due to     ' . '</span>';
            $error_msg.='<span style="font-size: 16pt; color:red;">' . $specialcase . '</span>';
        }

        $nxtrnosess = $data['0']['Nextrno_Sess_Year'];
        $matric_rno = $data['0']['Ssc_Rno'];
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

        if($error_msg !='')
        {  
            $data['error'] = $error_msg;
            $data['nxtrnosess'] = $nxtrnosess;
            $this->load->view('common/commonheader.php');        
            $this->load->view('Admission/Inter/getinfo.php', $data);
            $this->load->view('common/commonfooter.php');    
        }
        else
        {
            $brd_name=$this->Admission_model->Brd_Name($board);
            $data[0]['brd_name']=$brd_name[0]['Brd_Abr'] ;
            $this->load->view('common/commonheader.php');        
            $this->load->view('Admission/Inter/AdmissionForm.php',  array('data'=>$data));
            $this->load->view('common/commonfooter.php');
        }
    }

    public function NewEnrolment_insert()
    {

        DebugBreak();
        $this->load->model('Admission_model');
        $Inst_Id = 999999;
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

        $sub1 = 0;
        $sub2 = 0;
        $sub3 = 0;
        $sub4 = 0;
        $sub5 = 0;
        $sub6 = 0;
        $sub7 = 0;
        $sub8 = 0;
        $sub1ap1 = 0;
        $sub2ap1 = 0;
        $sub3ap1 = 0;
        $sub4ap1 = 0;
        $sub5ap1 = 0;
        $sub6ap1 = 0;
        $sub7ap1 = 0;
        $sub8ap1 = 0;
        $sub1ap2 = 0;
        $sub2ap2 = 0;
        $sub3ap2 = 0;
        $sub4ap2 = 0;
        $sub5ap2 = 0;
        $sub6ap2 = 0;
        $sub7ap2 = 0;
        $sub8ap2 = 0;

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
        if(@$_POST['sub3p2'] != 0)
        {
            $sub3ap2 = 1;  
            $sub3 =  $_POST['sub3p2'];    
        }
        if(@$_POST['sub4p2'] != 0)
        {
            $sub4ap2 = 1; 
            $sub4 =  $_POST['sub4p2'];     
        }
        if(@$_POST['sub5p2'] != 0)
        {
            $sub5ap2 = 1;    
            $sub5 =  $_POST['sub5p2'];  
        }
        if(@$_POST['sub6p2'] != 0)
        {
            $sub6ap2 = 1;    
            $sub6 =  $_POST['sub6p2'];  
        }
        if(@$_POST['sub7p2'] != 0)
        {
            $sub7ap2 = 1;    
            $sub7 =  $_POST['sub7p2'];  
        }
       

        $examtype = @$_POST['exam_type'];
        $marksImp = 2;//@$_POST['ddlMarksImproveoptions'];

        $cat = $this->makecat($examtype,$marksImp,$is11th);
        $cat11 = @$cat['cat11'];
        $cat12 = @$cat['cat12'];

        $Speciality = $this->input->post('speciality');
        $grp_cd = $this->input->post('std_group');

        $practical_Sub = array(
            'PHY'=>'6',
            'CHM'=>'7',
            'BIO'=>'8',
            'ART&MD'=>'18',
            'F&N'=>'27',
            'AHE'=>'28',
            'C&T'=>'30',
            'HPD'=>'40',
            'EW'=>'43',
            'COM'=>'45',
            'AGR'=>'46',
            'WW(FM)'=>'48',
            'CM'=>'68',
            'DRAW'=>'69',
            'EMB'=>'70',
            'TAIL'=>'72',
            'TYPE'=>'73',
            'CSC'=>'78',
            'WW(BM)'=>'79',
            'POUL'=>'83',
            'R/AC'=>'88',
            'F/FRM'=>'89',
            'CHW'=>'90',
            'CSC/D'=>'93',
            'HPD/D'=>'94'
        );

        $ispractical = 0;
        if($per_grp == 1)
        {
            $ispractical =1;
        }
        if(array_search(@$_POST['sub5'],$practical_Sub) || array_search(@$_POST['sub6'],$practical_Sub) || array_search(@$_POST['sub7'],$practical_Sub) ||
            array_search(@$_POST['sub5p2'],$practical_Sub) || array_search(@$_POST['sub6p2'],$practical_Sub) || array_search(@$_POST['sub7p2'],$practical_Sub))
        {
            $ispractical =1;
        }

        $AdmFee = $this->Admission_model->getrulefee($ispractical);

        $AdmFeeCatWise = '1300';
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

        $TotalAdmFee = $AdmFee[0]['Processing_Fee'] +$AdmFeeCatWise;

        $oldsess = @$_POST['oldsess'];

        if($oldsess == 'Annual'){
            $oldsess =  1;    
        }
        else if($oldsess == 'Supplementary'){
            $oldsess =  2;    
        }
        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'BForm' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'Dob' =>$this->input->post('dob'),
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
            'sub8' => $sub8,
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
            'sub8ap1' => ($sub8ap1),
            'sub1ap2' => ($sub1ap2),
            'sub2ap2' => ($sub2ap2),
            'sub3ap2' => ($sub3ap2),
            'sub4ap2' => ($sub4ap2),
            'sub5ap2' => ($sub5ap2),
            'sub6ap2' => ($sub6ap2),
            'sub7ap2' => ($sub7ap2),
            'sub8ap2' => ($sub8ap2),
            /*'sub1pf1' => @$_POST['sub1pf1'],
            'sub2pf1' => @$_POST['sub2pf1'],
            'sub3pf1' => @$_POST['sub3pf1'],
            'sub4pf1' => @$_POST['sub4pf1'],
            'sub5pf1' => @$_POST['sub5pf1'],
            'sub6pf1' => @$_POST['sub6pf1'],
            'sub7pf1' => @$_POST['sub7pf1'],
            'sub8pf1' => @$_POST['sub8pf1'],
            'sub1Pf2' => @$_POST['sub1Pf2'],
            'sub2pf2' => @$_POST['sub2pf2'],
            'sub3pf2' => @$_POST['sub3pf2'],
            'sub4pf2' => @$_POST['sub4pf2'],
            'sub5pf2' => @$_POST['sub5pf2'],
            'sub6pf2' => @$_POST['sub6pf2'],
            'sub7pf2' => @$_POST['sub7pf2'],
            'sub8pf2' => @$_POST['sub8pf2'],
            'sub1st1' => @$_POST['sub1st1'],
            'sub2st1' => @$_POST['sub2st1'],
            'sub3st1' => @$_POST['sub3st1'],
            'sub4st1' => @$_POST['sub4st1'],
            'sub5st1' => @$_POST['sub5st1'],
            'sub6st1' => @$_POST['sub6st1'],
            'sub7st1' => @$_POST['sub7st1'],
            'sub8st1' => @$_POST['sub8st1'],
            'sub1St2' => @$_POST['sub1St2'],
            'sub2st2' => @$_POST['sub2st2'],
            'sub3st2' => @$_POST['sub3st2'],
            'sub4st2' => @$_POST['sub4st2'],
            'sub5st2' => @$_POST['sub5st2'],
            'sub6st2' => @$_POST['sub6st2'],
            'sub7st2' => @$_POST['sub7st2'],
            'sub8st2' => @$_POST['sub8st2'],*/
            'RuralORUrban' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>($Inst_Id),
            'FormNo' =>($formno),
            'cat09' =>$cat09,
            'cat10' =>$cat10,
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
            'category'=>@$_POST['category'],
            'exam_type'=>$_POST['exam_type'],
            'spl_cd'=>$data[0]['spl_cd'],
            'result2'=>$data[0]['result2'],
            'NextRno_Sess_Year'=>$data[0]['NextRno_Sess_Year'],
            'picpath'=>@$_POST['pic'],
            'brd_name'=>@$_POST['oldboard']

        );     

        $target_path = PRIVATE_IMAGE_PATH;
        if (!file_exists($target_path)){

            mkdir($target_path);
        }

        $base_path = GET_PRIVATE_IMAGE_PATH_COPY.@$_POST['pic'];
        $copyimg = $target_path.$formno.'.jpg';

        if (!(copy($base_path, $copyimg))) 
        {
            $data['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
            $this->session->set_flashdata('NewEnrolment_error',$data);
            redirect('Admission/Pre_Matric_data/');
        }

        if (!(copy($base_path, $copyimg))) 
        {
            $data['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
            $this->session->set_flashdata('NewEnrolment_error',$data);

            redirect('Admission/Pre_Matric_data/');
            $this->frmvalidation('Pre_Matric_data',$data,0);       

            $logedIn = $this->Admission_model->Insert_NewEnorlement($data);



            if($logedIn != false)
            {
                $allinputdata = "";
                $allinputdata['excep'] = 'success';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                $msg = $formno;                                           
                redirect('Admission/'.'formdownloaded/'.$formno.'/'.$dob);
            }
            else
            {     
                $allinputdata = "";
                $allinputdata['excep'] = 'An error has occoured. Please try again later. ';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect(checkFormNo_then_download);
                redirect('Admission');
                return;
                echo 'Data NOT Saved Successfully !';
            } 
            $this->load->view('common/footer.php');
        }

    }

    public function matric_default()
    {
        $data = array(
            'isselected' => '3',
        );
        $this->load->library('session');
        if($this->session->flashdata('matric_error'))
        {
            $spl_cd = array('spl_cd'=>$this->session->flashdata('matric_error'));  
        }
        else{
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
        $data = array(
            'zoneCode' => $this->input->post('pvtZone'),
            'gen' => $this->input->post('gend'),
        );

        $this->load->model('Admission_model');
        $value = array('center'=> $this->Admission_model->getcenter($data)) ;
        echo json_encode($value);

    }



}