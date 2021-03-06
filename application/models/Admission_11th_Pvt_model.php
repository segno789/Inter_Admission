<?php

class Admission_11th_Pvt_model extends CI_Model 
{
    public function __construct()    
    {

        $this->load->database(); 



    }
    
    public function get_formno_data($formno){

        ////DebugBreak();
        $query = $this->db->query(formprint_sp_11th."'$formno'");
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
     public function getuser_info($User_info_data)
    {
       // DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $date = $User_info_data['date'];
        $isPratical = $User_info_data['isPratical'];

        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $query2 = $this->db->get_where('Admission_Online..RuleFeeAdm', array('class' => 12,'sess' => 1, 'Start_Date <='=>$date,'End_Date >='=>$date,'isPrSub'=>$isPratical));
            $resultarr = array("info"=>$query->result_array(),"rule_fee"=>$query2->result_array());
            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
      public function Update_AdmissionFeePvt($data)
    {
        //DebugBreak();
        $data['IsAdmission']=1;
        $data['cdate']= date('Y-m-d H:i:s');
        $this->db->where('formNo',$data['formNo']);
        $this->db->update(Regtbl,$data);
        // $this->db->update_batch('Registration..MA_P1_Reg_Adm2016',$data,'formNo');
        // DebugBreak();

        $this->db->select('regFee,AdmFee,AdmProcessFee,AdmFine,AdmTotalFee,CertFee');
        $query = $this->db->get_where(Regtbl, array('formNo'=>$data['formNo'])); 

        //$query = $this->db->get("Registration..MA_P1_Reg_Adm2016");    
        $rowcount = $query->num_rows();
        //DebugBreak();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }

    }
    public function Insert_NewEnorlement($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  
    {
       
        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['bFormNo'];
        $FNIC = $data['FNIC'];
        $Dob = $data['dob'];
        $dist = $data['dist'];
        $teh = $data['teh'];
        $zone = $data['zone'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        $Inst_Rno = strtoupper($data['Inst_Rno']);
        $MarkOfIden =strtoupper($data['markOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['IsPakistani'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['IsMuslim'];
        $addr =strtoupper($data['addr']) ;
        $sub1=  $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];

        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $UrbanRural = $data['isRural'];
        $Inst_cd = $data['Inst_cd'];
        $formno = '';
        $RegGrp = $data['RegGrp'];
        $grp_cd = $RegGrp;
        $iOldRno = @$data['old_RNo'];
        $iOldYear = @$data['old_year'];
        $iOldSess = @$data['old_sess'];
        $OldRno = $data['SSC_RNo'];
        $OldYear = $data['SSC_Year'];
        $OldSess = $data['SSC_Sess'];
        $OldBrd = $data['SSC_brd_cd'];
        $IsReAdm = $data['IsReAdm'];
        $picname = $data['picname'];
       $Inst_Rno = '';
        //    DebugBreak();
        if($iOldRno ==  false)
            $iOldRno =  0;
        if($iOldYear ==  false)
            $iOldYear =  0;
        if($iOldSess ==  false)
            $iOldSess =  0;
        //  $pic_base_65 = $data['Image'];
        //  DebugBreak();
        //  DebugBreak();
        if($OldBrd == 1 && $OldYear != -1)
        {            
            $query = $this->db->query("Registration..Prev_Get_Student_Matric_PVT $OldRno,$OldYear,$OldSess,$OldBrd");
            $rowcount = $query->num_rows();
            if($rowcount > 0)
            {
                $info =  $query->result_array();
                $name = strtoupper($info[0]['name']);
                $fname =strtoupper($info[0]['Fname']);
                $BForm = $info[0]['bFormNo'];
                $FNIC = $info[0]['FNIC'];
                $Dob = @$info[0]['dob'];
                if($Dob == '')
                {
                    $Dob = '';
                }
            }
            else
            {
                return  false;
            }
        }
      
        // $sync= $this->load->database('sync', TRUE);
        $Year = Year;
        // $this->db->trans_start();
        $query = $this->db->query(" Registration..IAP1AdmPvt_sp_insert '$formno',11,$Year,1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,'$Inst_Rno','".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,2,'$OldRno',$OldYear,$OldSess,$OldBrd,$iOldRno,$iOldYear,$iOldSess,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp,$dist,$teh,$zone,'$picname'");
     
      //  $this->db->trans_complete();

       
       

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            // $this->savepics($formno,11,2016,1,$data['Image']) ;

             return -1;
           // return $error;
        }
        // return true;


    }
     public function Insert_NewEnorlement_lang($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  
    {
       
        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['bFormNo'];
        $FNIC = $data['FNIC'];
        $Dob = $data['dob'];
        $dist = $data['dist'];
        $teh = $data['teh'];
        $zone = $data['zone'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        $Inst_Rno = strtoupper($data['Inst_Rno']);
        $MarkOfIden =strtoupper($data['markOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['IsPakistani'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['IsMuslim'];
        $addr =strtoupper($data['addr']) ;
        $sub1=  $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];

        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $UrbanRural = $data['isRural'];
        $Inst_cd = $data['Inst_cd'];
        $formno = '';
        $RegGrp = $data['RegGrp'];
        $grp_cd = $RegGrp;
        $iOldRno = @$data['old_RNo'];
        $iOldYear = @$data['old_year'];
        $iOldSess = @$data['old_sess'];
        $IsReAdm = $data['IsReAdm'];
        $IsReAdm = $data['IsReAdm'];
        $lang_cat = $data['lang_cat'];
        $lang_specialSub = $data['lang_specialSub'];
        $picname = $data['picname'];
       $Inst_Rno = '';
       $aloom_grp_final = 0;
       ///   For ADEEB Arabic and Urdu.
       if($lang_cat == 1 && $lang_specialSub ==24)
       {
       $aloom_grp_final = 5;
       }
       if($lang_cat == 1 && $lang_specialSub ==2)
       {
       $aloom_grp_final = 6;
       }
       ///   For FAZAL Arabic Urdu and Punjabi.
       if($lang_cat == 3 && $lang_specialSub ==24)
       {
        $aloom_grp_final = 1;
       }
       if($lang_cat == 3 && $lang_specialSub ==2)
       {
        $aloom_grp_final = 2;
       }
       if($lang_cat == 3 && $lang_specialSub ==32)
       {
        $aloom_grp_final = 3;
       }
         //   DebugBreak();
        if($iOldRno ==  false)
            $iOldRno =  0;
        if($iOldYear ==  false)
            $iOldYear =  0;
        if($iOldSess ==  false)
            $iOldSess =  0;
        //  $pic_base_65 = $data['Image'];
         // DebugBreak();
        //  DebugBreak();
        // $sync= $this->load->database('sync', TRUE);
 
        // $this->db->trans_start();
        $year = Year;
        $query = $this->db->query(" Registration..IAP1AdmPvt_sp_insert_lang '$formno',11,$year,1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,'$Inst_Rno','".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,2,$iOldRno,$iOldYear,$iOldSess,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp,$dist,$teh,$zone,'$picname',$IsReAdm,$aloom_grp_final");
     
      //  $this->db->trans_complete();

       
       

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            // $this->savepics($formno,11,2016,1,$data['Image']) ;

             return -1;
           // return $error;
        }
        // return true;


    }
    public function bay_form_fnic($bayformno,$fnic)
    {
        $query = $this->db->get_where(Regtbl,  array('BForm' => $bayformno,'FNIC' => $fnic,'IsDeleted'=>0));
        $rowcount = $query->num_rows();
        if ($rowcount > 0){
            return true;
        }
        else{
            return false;
        }
    }

    private function savepics($formno,$class,$iyear,$sess,$pic)
    {
        //  DebugBreak();
        $data = array(

            'formNo' => $formno ,
            'class' => $class ,
            'iyear' => $iyear,
            'sess' => $sess ,
            'img_base_64' => $pic 


        );

        $this->db->insert('ImageDB..tblIAPics', $data); 
        return true;
    }

    public function Pre_Matric_data($data)
    {


        $rno =  $data['mrollno'];
        $sess = $data['session'];
        $iyear =$data['year'];
        $brd = $data['board'];
        // DebugBreak();
        $query = $this->db->query("Registration..Prev_Get_Student_Matric_PVT $rno,$iyear,$sess,$brd");

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  -1;
        }
    }
   
    public function IsFeeded($data)
    {
        $rno =  $data['mrollno'];
        $sess = $data['session'];
        $iyear =$data['year'];
        $brd = $data['board'];
        //  DebugBreak();
        $query = $this->db->get_where(Regtbl, array('matRno' => "$rno", 'yearOfPass'=>$iyear,'sessOfPass'=>$sess,'Brd_cd'=>$brd,'IsDeleted'=>0 ));
        // DebugBreak();
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $rowcount;
        }
        else
        {
            return  false;
        }
    }
    public function InstName($instCode)
    {
        // DebugBreak();
        $this->db->select('Name');
        //$this->db->order_by("formno", "DESC");
        $name = $this->db->get_where('admission_online..tblInstitutes_all', array('Inst_cd' => $instCode));
        $rowcount = $name->num_rows();

        if($rowcount == 0 )
        {
            return false;
        }
        else
        {
            $row  = $name->result_array();
            $inst_name = $row[0]['Name'];
            return $inst_name;
        }


    }
    public function get_spl_name($splcd)
    {
        $query = $this->db->get_where('Admission_online..tblSplCase', array('spl_cd' => $splcd));
        // DebugBreak();
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
    public function GetFormNo($Inst_Id)
    {
        //DebugBreak();
        $this->db->select('formno');
        $this->db->order_by("formno", "DESC");
        $formno = $this->db->get_where(Regtbl, array('coll_cd' => $Inst_Id));
        $rowcount = $formno->num_rows();
        if($rowcount == 0 )
        {
            $formno =  ($Inst_Id.'0001' );
            return $formno;
        }
        else
        {
            $row  = $formno->result_array();

            $fromno = $row[0]['formno'];
            // $count =  substr($fromno, -4);
            $inst_cd = substr($fromno, 0, 6);
            if($inst_cd != $Inst_Id)
            {
                $row = $Inst_Id.str_pad($rowcount, 4, '0', STR_PAD_LEFT); 
                $formno = $row+2;   
            }
            else
            {
                $formno = $row[0]['formno']+1;
            }

            return $formno;
        }

    }
    public function getreulefee($ruleID)
    {
        // $ruleID = 1;
        $q2         = $this->db->get_where('Registration..RuleFee_Reg_Eleventh',array('Rule_Fee_ID'=>$ruleID));
        $resultarr = $q2->result_array();
        return $resultarr ;
    }

    public function bay_form_comp($bayformno)
    {
        $query = $this->db->get_where(Regtbl,  array('BForm' => $bayformno,'IsDeleted'=>0));
        $rowcount = $query->num_rows();
        if ($rowcount > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function bay_form_fnic_dob_comp($bayformno,$fnic,$dob)
    {
        $query = $this->db->get_where(Regtbl,  array('BForm' => $bayformno,'FNIC' => $fnic,'Dob' => $dob,'IsDeleted'=>0));
        $rowcount = $query->num_rows();
        if ($rowcount > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function get_zone()
    {

        //$this->db->select('zone_cd','zone_name');
        //$this->db->order_by("formno", "DESC"); myear = 2016 and class = 10 and sess = 1 
        $query = $this->db->get_where('matric_new..tblZones', array('myear' => '2016','class'=>12,'sess'=>1));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();

        }



    }

}
?>
