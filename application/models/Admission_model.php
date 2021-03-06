<?php
class Admission_model extends CI_Model 
{
    public function __construct()
    {

        $this->load->database(); 
    }


    public function Pre_Matric_data($data){

        $SSC_RNO =  $data['SSC_RNO'];
        $dob =  $data['Dob'];
        $SSC_Year =  $data['SSC_Year'];
        $SSC_Session =  $data['SSC_Session'];
        $ssc_Board =  $data['SSC_Board'];

        $query = $this->db->query("admission_online..Prev_Get_Student_Matric  $SSC_RNO, '".$dob."', $SSC_Year, $SSC_Session, $ssc_Board");

        $rowcount = $query->num_rows();

        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function Pre_Aloom_data($data){

        //DebugBreak();

        $aloomCat = $data['aloomCat'];
        $txtMatRnoAloom = $data['txtMatRnoAloom'];
        $oldRnoAloom = $data['oldRnoAloom'];
        $sessAloom = $data['sessAloom'];
        $oldYearAloom = $data['oldYearAloom'];
        $boardAloom = $data['boardAloom'];


        if($aloomCat == 1){
            $query = $this->db->query("SELECT top 1 * FROM ".getinfo_languages. " where matrno = $txtMatRnoAloom and rno = $oldRnoAloom and Sess = $sessAloom and Iyear = $oldYearAloom and Brd_cd = $boardAloom and grp_cd in (1,2,3,5,6) and status <> 1");    
        }

        else if($aloomCat == 2){
            $query = $this->db->query("SELECT top 1 * FROM ".getinfo_languages. " where rno = $oldRnoAloom and Sess = $sessAloom and Iyear = $oldYearAloom and Brd_cd = $boardAloom and grp_cd in (1,2,3,5,6) and status <> 1");    
        }


        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function checkDuplicateForm_Model($data){

        $data = array(
            'rno'   => $data['hsscrno'],
            'class' => $data['hsscclass'],
            'Iyear' => $data['iYear'],
            'sess'  =>$data['session'],
            'brd_cd'=>$data['board'],
            'matRno'=>$data['sscrno']
        );

        $rno    = $data['rno'];
        $class  = $data['class'];
        $Iyear  = $data['Iyear'];
        $sess   = $data['sess'];
        $board  = $data['brd_cd'];
        $matRno = $data['matRno'];

        $query = $this->db->query("exec admission_online..Admission_CheckDuplicateForm_HSSC 1,$rno,$Iyear,$sess,$board,'','','','' ");

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function checkDuplicateFormotherboard_Model($data){

        $data = array(
            'cand_name'   => $data['cand_name'],
            'father_name' => $data['father_name'],
            'bay_form' => $data['bay_form'],
            'father_cnic'  =>$data['father_cnic'],
            'oldSSC_Board' =>  $data['oldSSC_Board']
        );

        $cand_name    = $data['cand_name'];
        $father_name  = $data['father_name'];
        $bay_form  = $data['bay_form'];
        $father_cnic   = $data['father_cnic'];
        $board   = $data['oldSSC_Board'];

        $query = $this->db->query("exec admission_online..Admission_CheckDuplicateForm_HSSC 2,0,0,0,$board,'".$cand_name."','".$father_name."','".$bay_form."','".$father_cnic."' ");        

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function Pre_Inter_Data($data)
    {
        //DebugBreak();

        $data = array(
            'rno'   => $data['hsscrno'],
            'class' => $data['hsscclass'],
            'Iyear' => $data['iYear'],
            'sess'  =>$data['session'],
            'brd_cd'=>$data['board'],
            'matRno'=>$data['sscrno']
        );

        $rno    = $data['rno'];
        $class  = $data['class'];
        $Iyear  = $data['Iyear'];
        $sess   = $data['sess'];
        $board  = $data['brd_cd'];
        $matRno = $data['matRno'];

        $query = $this->db->query("".getinfo." $rno, $class, $Iyear, $sess, $board, $matRno, 999999");

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function updatefee($formno,$adminfee,$totalfee,$fine,$isalooma)
    {
        if($isalooma == 0)
        {
            $data = array(
                'AdmFee' =>$adminfee,
                'AdmTotalFee' =>$totalfee,
                'AdmFine' =>$fine,
                'cDate'=> date('Y-m-d H:i:s')
            );
            $this->db->where('formNo',$formno);
            $this->db->update('Admission_Online..ISAdm',$data);  
        }
        else if($isalooma == 1)
        {
            $data = array(
                'AdmFee' =>$adminfee,
                'AdmTotalFee' =>$totalfee,
                'Fine' =>$fine,
                'cDate'=> date('Y-m-d H:i:s')
            );
            $this->db->where('formNo',$formno);
            $this->db->update('Admission_Online..IStbllanguagesinter',$data);  
        }

        return true;
    }
    public function GetFormNo_Languages()
    {
        //DebugBreak();
        $this->db->select('formno');
        $this->db->order_by("formno", "DESC");
        $formno = $this->db->get('admission_online..IStbllanguagesinter');
        //$formno =$this->db->get_where('',array('regPvt'=>2));
        $rowcount = $formno->num_rows();

        if($rowcount == 0 )
        {
            $formno = formnovalid_Languages+1;
            return $formno;
        }
        else
        {
            $row  = $formno->result_array();
            $formno = $row[0]['formno']+1;
            return $formno;
        }

    }
    public function Brd_Name($brd_cd)
    {
        $brd_name = $this->db->get_where("matric..tblboard", array('Brd_cd'=>$brd_cd));
        $rowcount = $brd_name->num_rows();
        if($rowcount>0)
        {
            return $brd_name->result_array();    
        }
    }

    public function GetFormNo()
    {

        //DebugBreak();

        $this->db->select('FormNo');

        $this->db->order_by("FormNo", "DESC");
        $formno = $this->db->get('admission_online..IAAdm',array('regPvt'=>2));

        $rowcount = $formno->num_rows();

        if($rowcount == 0 )
        {
            $formno = formnovalid+1;
            return $formno;
        }
        else
        {
            $row  = $formno->result_array();
            $formno = $row[0]['FormNo']+1;
            return $formno;
        }
    }

    public function NewEnrolment_insert_Fresh_OtherBoard($data){ 

        //DebugBreak();

        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        $Inst_Rno = strtoupper($data['Inst_Rno']);
        $MarkOfIden =strtoupper(@$data['markOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['rel'];        
        $addr =strtoupper($data['addr']) ;

        $grp_cd = $data['grp_cd'];

        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];
        $sub5a = $data['sub5a'];
        $sub6a = $data['sub6a'];
        $sub7a = $data['sub7a'];

        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = @$data['sub8ap2'];

        $UrbanRural = $data['RuralORUrban'];
        $Inst_cd = "999999";
        $formno = $data['FormNo'];
        $sub1ap2 =  $data['sub1ap2'];
        $sub2ap2 =  $data['sub2ap2'];
        $sub3ap2 =  $data['sub3ap2'];
        $sub4ap2 =  $data['sub4ap2'];
        $sub5ap2 =  $data['sub5ap2'];
        $sub6ap2 =  $data['sub6ap2'];
        $sub7ap2 =  $data['sub7ap2'];
        $sub8ap2 =  $data['sub8ap2'];

        $cat11 = $data['cat11'];     
        $cat12 = $data['cat12'];     


        if(@$_POST['pic'] == ''){
            $picpath = $data['picpath']['upload_data']['full_path'];
        }
        else{
            $picpath = $data['picpath'];     
        }

        $dist_cd =  $data['dist'];
        $teh_cd =  $data['teh'];
        $zone_cd =  $data['zone'];

        $oldrno =  $data['rno'];
        $oldyear =  $data['Iyear'];
        $oldsess =  $data['sess'];
        $Brd_cd =  $data['Brd_cd'];  
        $old_class =  $data['oldClass'];

        $schm = $data['schm'];

        $AdmFine =  $data['AdmFine']; 
        $AdmProcFee =  $data['AdmProcessFee'];
        $AdmFee =  $data['AdmFee'];
        $certFee =  $data['certfee'];
        $regfee =  $data['regfee'];

        $picpath = $data['picpath'];

        if($picpath == '')
        {
            $IsNewPic = 1;
            $temppath = $data['picname'];
        }
        else{
            $IsNewPic = 0; 
            $temppath = '';
        }

        $TotalAdmFee =  $AdmFee + $AdmProcFee+$AdmFine;

        //DebugBreak();

        $query = $this->db->query(Insert_sp." '$formno',12,2018,1,'$name','$fname','$BForm','$FNIC','$CellNo',$medium,'".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,1,'".$picpath."',$oldrno,$oldyear,$oldsess,$old_class,$IsHafiz,$Inst_cd,$UrbanRural,$cat11,$cat12,$sub1ap2,$sub2ap2,$sub4ap2,$sub5ap2,$sub6ap2,$sub7ap2,$sub8ap2,$dist_cd,$teh_cd,$zone_cd,$Brd_cd,$AdmProcFee,$AdmFee,$TotalAdmFee,$sub5a,$sub6a,$sub7a,$AdmFine,$IsNewPic,$certFee,'$temppath',$schm,$regfee");

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return -1;
        }
    }
    public function getuser_info($User_info_data)
    {
        //DebugBreak();

        $Inst_cd = $User_info_data['Inst_Id'];
        $date = $User_info_data['date'];
        $isPratical = $User_info_data['isPratical'];

        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $query2 = $this->db->get_where(RuleFeeAdm, array('class' => 12,'sess' =>Session, 'Start_Date <='=>$date,'End_Date >='=>$date,'isPrSub'=>$isPratical));
            $resultarr = array("info"=>$query->result_array(),"rule_fee"=>$query2->result_array());
            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }

    public function Update_AdmissionFeePvt_Languages($data)
    {

        //DebugBreak();

        $data['cdate']= date('Y-m-d H:i:s');
        $this->db->where('formno',$data['formno']);
        $this->db->update("admission_online..IStbllanguagesinter",$data);
        $this->db->select('AdmFee,AdmProcessFee,Fine,AdmTotalFee');
        $query = $this->db->get_where("admission_online..IStbllanguagesinter", array('formno'=>$data['formno'])); 
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }

    }


    public function Update_AdmissionFeePvt($data)
    {
        //DebugBreak();
        $date = new DateTime(EXAMINATIONDATEINTER_P2);
        $date->modify("-4 day");
        $threeDayBeforeExam = $date->format("Y-m-d");

        if(strtotime(date('Y-m-d')) < strtotime($threeDayBeforeExam)){
            $data['cdate']= date('Y-m-d H:i:s');
            $this->db->where('formNo',$data['formNo']);
            $this->db->update(INSERT_TBL,$data);
            $this->db->select('regFee,AdmFee,AdmProcessFee,AdmFine,AdmTotalFee');
            $query = $this->db->get_where(INSERT_TBL, array('formNo'=>$data['formNo'])); 
        }

        else{
            $data['cdate']= date('Y-m-d H:i:s');
            $this->db->select('regFee,AdmFee,AdmProcessFee,AdmFine,AdmTotalFee');
            $query = $this->db->get_where(INSERT_TBL, array('formNo'=>$data['formNo'])); 
        }

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }

    }
    public function NewEnrolment_insert_Fresh_11thOtherBoard($data){ 

        //DebugBreak();

        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        $Inst_Rno = strtoupper($data['Inst_Rno']);
        $MarkOfIden =strtoupper(@$data['markOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['rel'];        
        $addr =strtoupper($data['addr']) ;

        $grp_cd = $data['grp_cd'];

        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];
        $sub5a = $data['sub5a'];
        $sub6a = $data['sub6a'];
        $sub7a = $data['sub7a'];

        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = @$data['sub8ap2'];

        $UrbanRural = $data['RuralORUrban'];
        $Inst_cd = "999999";
        $formno = $data['FormNo'];
        $sub1ap2 =  $data['sub1ap2'];
        $sub2ap2 =  $data['sub2ap2'];
        $sub3ap2 =  $data['sub3ap2'];
        $sub4ap2 =  $data['sub4ap2'];
        $sub5ap2 =  $data['sub5ap2'];
        $sub6ap2 =  $data['sub6ap2'];
        $sub7ap2 =  $data['sub7ap2'];
        $sub8ap2 =  $data['sub8ap2'];

        $cat11 = $data['cat11'];     
        $cat12 = $data['cat12'];     


        if(@$_POST['pic'] == ''){
            $picpath = $data['picpath']['upload_data']['full_path'];
        }
        else{
            $picpath = $data['picpath'];     
        }

        $dist_cd =  $data['dist'];
        $teh_cd =  $data['teh'];
        $zone_cd =  $data['zone'];
        $oldrno =  $data['rno'];
        $oldyear =  $data['Iyear'];
        $oldsess =  $data['sess'];
        $AdmFine =  $data['AdmFine']; 

        //$oldResult11th = $data['oldResult11th'];

        $Brd_cd =  $data['Brd_cd'];  

        $old_class =  $data['oldClass'];

        $schm = $data['schm'];

        $AdmProcFee =  $data['AdmProcessFee'];
        $AdmFee =  $data['AdmFee'];
        $certFee =  $data['certfee'];

        $picpath = $data['picpath'];
        $regfee =  $data['regfee'];
        if($picpath == '')
        {
            $IsNewPic = 1;
            $temppath = $data['picname'];
        }
        else{
            $IsNewPic = 0; 
            $temppath = '';
        }

        $TotalAdmFee =  $AdmFee + $AdmProcFee+$AdmFine;



        $query = $this->db->query(Insert_sp." '$formno',12,2018,1,'$name','$fname','$BForm','$FNIC','$CellNo',$medium,'".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,1,'".$picpath."',$oldrno,$oldyear,$oldsess,$old_class,$IsHafiz,$Inst_cd,$UrbanRural,$cat11,$cat12,$sub1ap2,$sub2ap2,$sub4ap2,$sub5ap2,$sub6ap2,$sub7ap2,$sub8ap2,$dist_cd,$teh_cd,$zone_cd,$Brd_cd,$AdmProcFee,$AdmFee,$TotalAdmFee,$sub5a,$sub6a,$sub7a,$AdmFine,$IsNewPic,$certFee,'$temppath',$schm,$regfee");

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return -1;
        }
    }

    public function NewEnrolment_insert_Fresh($data){ 

        //DebugBreak();

        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        $Inst_Rno = strtoupper($data['Inst_Rno']);
        $MarkOfIden =strtoupper(@$data['markOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['rel'];        
        $addr =strtoupper($data['addr']) ;

        $grp_cd = $data['grp_cd'];

        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];
        $sub5a = $data['sub5a'];
        $sub6a = $data['sub6a'];
        $sub7a = $data['sub7a'];

        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = @$data['sub8ap2'];

        $UrbanRural = $data['RuralORUrban'];
        $Inst_cd = "999999";
        $formno = $data['FormNo'];
        $sub1ap2 =  $data['sub1ap2'];
        $sub2ap2 =  $data['sub2ap2'];
        $sub3ap2 =  $data['sub3ap2'];
        $sub4ap2 =  $data['sub4ap2'];
        $sub5ap2 =  $data['sub5ap2'];
        $sub6ap2 =  $data['sub6ap2'];
        $sub7ap2 =  $data['sub7ap2'];
        $sub8ap2 =  $data['sub8ap2'];

        $cat11 = $data['cat11'];     
        $cat12 = $data['cat12'];     


        if(@$_POST['pic'] == ''){
            $picpath = $data['picpath']['upload_data']['full_path'];
        }
        else{
            $picpath = $data['picpath'];     
        }


        $dist_cd =  $data['dist'];
        $teh_cd =  $data['teh'];
        $zone_cd =  $data['zone'];
        $oldrno =  $data['rno'];
        $oldyear =  $data['Iyear'];
        $oldsess =  $data['sess'];
        $schm = $data['schm'];
        $AdmFine =  $data['AdmFine'];
        $Brd_cd =  $data['Brd_cd'];
        $old_class =  $data['oldclass'];


        $AdmProcFee =  $data['AdmProcessFee'];
        $AdmFee =  $data['AdmFee'];
        $certFee =  $data['certfee'];
        $regfee =  $data['regfee'];
        $picpath = $data['picpath'];

        if($picpath == '')
        {
            $IsNewPic = 1;
            $temppath = $data['picname'];
        }
        else{
            $IsNewPic = 0; 
            $temppath = '';
        }

        $TotalAdmFee =  $AdmFee + $AdmProcFee+$AdmFine;

        if($sex == '')
        {
            $sex =  $data['gender'];
        }
        $query = $this->db->query(Insert_sp." '$formno',12,2018,1,'$name','$fname','$BForm','$FNIC','$CellNo',$medium,'".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,1,'".$picpath."',$oldrno,$oldyear,$oldsess,$old_class,$IsHafiz,$Inst_cd,$UrbanRural,$cat11,$cat12,$sub1ap2,$sub2ap2,$sub4ap2,$sub5ap2,$sub6ap2,$sub7ap2,$sub8ap2,$dist_cd,$teh_cd,$zone_cd,$Brd_cd,$AdmProcFee,$AdmFee,$TotalAdmFee,$sub5a,$sub6a,$sub7a,$AdmFine,$IsNewPic,$certFee,'$temppath',$schm,$regfee");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return -1;
        }
    }

    public function Insert_NewEnorlement($data) 
    {    
        //DebugBreak();

        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        $Inst_Rno = strtoupper($data['Inst_Rno']);
        $MarkOfIden =strtoupper(@$data['markOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['rel'];        
        $addr =strtoupper($data['addr']) ;

        $grp_cd = $data['grp_cd'];

        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];
        $sub5a = $data['sub5a'];
        $sub6a = $data['sub6a'];
        $sub7a = $data['sub7a'];

        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = @$data['sub8ap2'];

        $UrbanRural = $data['RuralORUrban'];
        $Inst_cd = "999999";
        $formno = $data['FormNo'];

        $sub1ap2 =  $data['sub1ap2'];
        $sub2ap2 =  $data['sub2ap2'];
        $sub3ap2 =  $data['sub3ap2'];
        $sub4ap2 =  $data['sub4ap2'];
        $sub5ap2 =  $data['sub5ap2'];
        $sub6ap2 =  $data['sub6ap2'];
        $sub7ap2 =  $data['sub7ap2'];
        $sub8ap2 =  $data['sub8ap2'];

        $cat11 = $data['cat11'];     
        $cat12 = $data['cat12'];     

        $picpath = $data['picpath'];

        if($picpath == '')
        {
            $IsNewPic = 1;
            $temppath = $data['picname'];
        }

        else{
            $IsNewPic = 0; 
            $temppath = '';
        }


        $dist_cd =  $data['dist'];
        $teh_cd =  $data['teh'];
        $zone_cd =  $data['zone'];
        $oldrno =  $data['rno'];
        $oldyear =  $data['Iyear'];
        $oldsess =  $data['sess'];


        if($cat11 == 1 && $cat12 == 1){
            $schm = 4;
        }
        else{
            $schm = @$_POST['oldschm'];    
        }



        $AdmFine =  $data['AdmFine'];
        $Brd_cd =  $data['Brd_cd'];
        $old_class = $data['class'];
        $AdmProcFee =  $data['AdmProcessFee'];
        $AdmFee =  $data['AdmFee'];    
        $certFee =  $data['certfee'];
        $regfee = 0;
        $TotalAdmFee =  $data['AdmTotalFee'];


        @$sess = Session;

        //DebugBreak();

        $query = $this->db->query(Insert_sp." '$formno',12,".Year.",$sess,'$name','$fname','$BForm','$FNIC','$CellNo',$medium,'".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,1,'".$picpath."',$oldrno,$oldyear,$oldsess,$old_class,$IsHafiz,$Inst_cd,$UrbanRural,$cat11,$cat12,$sub1ap2,$sub2ap2,$sub4ap2,$sub5ap2,$sub6ap2,$sub7ap2,$sub8ap2,$dist_cd,$teh_cd,$zone_cd,$Brd_cd,$AdmProcFee,$AdmFee,$TotalAdmFee,$sub5a,$sub6a,$sub7a,$AdmFine,$IsNewPic,$certFee,'$temppath',$schm,$regfee");

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return -1;
        }
    }

    public function chkPrevStatus($Rno,$Year,$Sess,$Board){

        $query = $this->db->query(" select status from admission_online..tbladmissiondataforhssc where rno = $Rno and  Iyear = $Year and sess = $Sess and IntBrd_cd = $Board");

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }

    }

    public function Insert_NewEnorlement_Languages($data)
    {    
        //DebugBreak();  
        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);


        $bay_form =$data['bay_form'];
        $father_cnic = $data['father_cnic'];
        $medium = $data['medium'];
        $speciality = $data['speciality'];
        $nationality = $data['nationality'];
        $isaloom = $data['isaloom'];

        $CellNo = $data['MobNo'];

        $MarkOfIden =strtoupper(@$data['markOfIden']);

        $sex = $data['sex'];

        $hafiz = $data['hafiz'];
        $religion = $data['religion'];

        $addr =strtoupper($data['addr']) ;

        $grp_cd = $data['grp_cd'];

        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];

        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];

        $formno = $data['FormNo'];


        //-------Marks Improve CAT --------\\
        $dist_cd =  $data['dist'];
        $teh_cd =  $data['teh'];
        $zone_cd =  $data['zone'];
        $oldrno =  $data['rno'];
        $oldyear =  $data['Iyear'];
        $oldsess =  $data['sess'];

        $Brd_cd =  $data['Brd_cd'];
        $AdmProcFee =  $data['AdmProcessFee'];

        $AdmFee = $data['AdmFee'];

        $TotalAdmFee =  $AdmFee + $AdmProcFee;

        //DebugBreak();

        $query = $this->db->query(Insert_sp_Languages." '$formno',".Year.",".Session.",'$name','$fname','".$bay_form."','".$father_cnic."',$medium,$speciality,$nationality,'$CellNo','".$MarkOfIden."',$sex,$hafiz,$religion,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,1,$oldrno,$oldyear,$oldsess,$dist_cd,$teh_cd,$zone_cd,$Brd_cd,$AdmProcFee,$AdmFee,$TotalAdmFee");

        $rowcount = $query->num_rows();

        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function get_formno_data($formno)
    {
        //DebugBreak();

        if($formno < 900001)
        {
            $query = $this->db->query("select * from admission_online..IStbllanguagesinter where formno = '$formno'");    
        }

        else if($formno > 900000)
        {
            $query = $this->db->query("exec admission_online..formprint_sp_12th '$formno'");    
        }
        /*else if(Session == 2 && $formno > 900000)
        {
        $query = $this->db->query("exec admission_online..sp_form_data_12th_SUPPLY '$formno'");        
        }*/



        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }


    public function getEmpCd_Model($employeeCode){

        $query = $this->db->query("select Name from MiscDb..tblemployee where emp_cd = $employeeCode and isActive = 1 and emp_cd < 3000");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    public function getzone($data)
    {
        //DebugBreak();

        $tehcd = $data['tehCode'];
        $gend = $data['gend'];
        $where = " mYear = ".Year."  AND class = 12 AND sess = ".Session." AND teh_cd =  $tehcd  AND  (Gender = $gend OR Gender = 3) and Flag= 1";      
        $query = $this->db->query("SELECT * FROM matric_new..tblZones WHERE $where");

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function getcenter($data)
    {
        //DebugBreak();

        $zone = $data['zoneCode'];
        $gend = $data['gen'];
        $where = " mYear = ".Year." AND class = 12 AND  sess = ".Session." AND Zone_cd =  $zone  AND  (cent_Gen = $gend OR cent_Gen = 3)";
        $query = $this->db->query("SELECT CENT_CD,CENT_NAME FROM matric_new..tblcentre WHERE $where");

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function getrulefee($isPrSub){
        $date =  date('Y-m-d') ;
        $query = $this->db->get_where(RuleFeeAdm, array('class' => 12,'sess' =>Session, 'isPrSub' => $isPrSub,'Start_Date <='=>$date,'End_Date >='=>$date));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
}
?>