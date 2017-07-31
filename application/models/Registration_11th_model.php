<?php

class Registration_11th_model extends CI_Model 
{
    public function __construct()    
    {

        $this->load->database(); 



    }
    public function Incomplete_inst_info_INSERT($allinfo)
    {
       //   DebugBreak();
        $data = array(

            'Inst_cd' => $allinfo['Inst_Id'] ,
            'emis_code' => $allinfo['Info_emis'] ,
            'email' => strtoupper($allinfo['info_email']) ,
            'LandLine' => $allinfo['info_phone'] ,
            'MobNo' => $allinfo['info_cellNo'] ,
            'dist_cd' => $allinfo['info_dist'] ,
            'teh_cd' => $allinfo['info_teh'] ,
            'zone_cd' => $allinfo['info_zone'] ,

        );

        $this->db->insert('tblInstitutes_all_Info', $data); 
        return true;
    }
    
  



    
    public function Dashboard($inst_cd)
    {

        // DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $query = $this->db->query("Registration..Dashboard_reg_11th_New $inst_cd");



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
    public function Profile_info($inst_cd)
    {

        // DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $query = $this->db->query("Registration..Profile_info $inst_cd");



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
    public function Profile_UPDATE($allinputdata)
    {

        // DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $isGovt = $allinputdata['isGovt'];
        $Profile_email = $allinputdata['Profile_email'];
        $Profile_password = $allinputdata['Profile_password'];
        $Profile_phone = $allinputdata['Profile_phone'];
        $Profile_cell = $allinputdata['Profile_cell'];
        $isInserted = $allinputdata['isInserted'];
        $Inst_Id = $allinputdata['Inst_Id'];
        $emis = $allinputdata['emis'];
        $query = $this->db->query("Registration..Profile_UPDATE $Inst_Id,$isInserted,$isGovt,'$Profile_email','$Profile_password','$Profile_phone','$Profile_cell','$emis'");
        return  true;

    }
      public function forwarding_pdf_final($fetch_data)
    {
        //DebugBreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Registration..sp_Forwading_letter_final_11TH_NEW $Inst_cd,$Batch_id");
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
    public function Insert_NewEnorlement($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  
    {
        //  DebugBreak();
        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['bFormNo'];
        $FNIC = $data['FNIC'];
        $Dob = $data['dob'];
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
        $sub8 = $data['sub8'];
        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = $data['sub8ap1'];
        $UrbanRural = $data['isRural'];
        $Inst_cd = $data['Inst_cd'];
        $formno = $data['FormNo'];
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
        $pic_base_64 = $data['Image'];
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
     if($OldBrd == 1 && $IsReAdm !=1)
      {            
          $query = $this->db->query("Registration..Prev_Get_Student_Matric $OldRno,$OldYear,$OldSess,$OldBrd");
          $rowcount = $query->num_rows();
          if($rowcount > 0)
          {
              $info =  $query->result_array();
              $name = strtoupper($info[0]['name']);
              $fname =strtoupper($info[0]['Fname']);
              $BForm = $info[0]['bFormNo'];
              $FNIC = $info[0]['FNIC'];
              $Dob = $info[0]['dob'];
          }
          else
          {
              return  false;
          }
      }
        $query = $this->db->query("Registration..IA_P1_Reg_Adm2016_sp_insert_New '$formno',11,2016,1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,'$Inst_Rno','".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,1,'$OldRno',$OldYear,$OldSess,$OldBrd,$iOldRno,$iOldYear,$iOldSess,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp,$IsReAdm,'$pic_base_64'");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
        
         $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
              // $this->savepics($formno,11,2016,1,$data['Image']) ;
            
                 $error[0]['error'] =  "true";
                 return $error;
        }
       // return true;


    }
  public function bay_form_fnic($bayformno,$fnic)
    {
        $query = $this->db->get_where('Registration..tblreg11th',  array('BForm' => $bayformno,'FNIC' => $fnic,'IsDeleted'=>0));
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
    
    public function Pre_Matric_data($data){


        $rno =  $data['mrollno'];
        $sess = $data['session'];
        $iyear =$data['year'];
        $brd = $data['board'];
       // DebugBreak();
        $query = $this->db->query("Registration..Prev_Get_Student_Matric $rno,$iyear,$sess,$brd");
        
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
     public function IsFeeded($data)
     {
        $rno =  $data['mrollno'];
        $sess = $data['session'];
        $iyear =$data['year'];
        $brd = $data['board'];
      //  DebugBreak();
        $query = $this->db->get_where('Registration..tblreg11th', array('matRno' => "$rno", 'yearOfPass'=>$iyear,'sessOfPass'=>$sess,'Brd_cd'=>$brd,'IsDeleted'=>0));
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
     public function IsReFeeded($data){
        $rno =  $data['mrollno'];
        $sess = $data['session'];
        $iyear =$data['year'];
        $brd = $data['board'];
      //  DebugBreak();
        $query = $this->db->get_where('Registration..tblreg11th', array('oldRno_reg' => "$rno", 'oldYear_reg'=>$iyear,'oldSess_reg'=>$sess,'IsDeleted'=>0));
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
    public function get_spl_name($splcd){
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
    public function Update_NewEnorlement($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  IA_P1_Reg_Adm2016_sp_Update
    {
        //DebugBreak();
        $name =strtoupper($data['name']) ;
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $Dob = $data['Dob'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        $Inst_Rno = strtoupper($data['classRno']);
        $MarkOfIden =strtoupper($data['markOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['Ishafiz'];
        $rel = $data['rel'];
        $addr =strtoupper($data['addr']);
        /* if(($data['grp_cd'] == 1) or ($data['grp_cd'] == 7) or ($data['grp_cd'] == 8) )
        {
        $grp_cd = 1;    
        }
        else if($data['grp_cd'] == 2 )
        {
        $grp_cd = 2;        
        }
        else if($data['grp_cd'] == 5 )
        {
        $grp_cd = 5;        
        }*/
        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];
        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = $data['sub8ap1'];
        $UrbanRural = $data['ruralOrurban'];
        $Inst_cd = $data['Inst_cd'];
        $formno = $data['FormNo'];
        $RegGrp = $data['RegGrp'];
        $regoldrno = $data['regoldrno'];
        $regoldsess = $data['regoldsess'];
        $regoldclass = $data['regoldclass'];
        $regoldyear = $data['regoldyear'];
        $isreadm = $data['isreadm'];
        $pic_base_64 = $data['Image'];
       //  DebugBreak();
        $query = $this->db->query("Registration..IA_P1_Reg_Adm2016_sp_Update '$formno',11,2016,1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,'$Inst_Rno','$MarkOfIden',$Speciality,$nat,$rel,'$addr',$RegGrp,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$IsHafiz,$Inst_cd,$UrbanRural,'$pic_base_64'");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
        return true;
    }
    public function EditEnrolement($inst_cd)
    {

        // DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case

        $query = $this->db->query("Registration..sp_get_regInfo_11th_New $inst_cd,11,2016,1");    





        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
            // $q1 = array('stdinfo'=>$query->result_array()) ;
            //            for($i= 0; $i<$rowcount; $i++){
            //            $q1['stdinfo'][$i]['sub1'];
            //            }
            //            $q1['stdinfo']['sub1'];
            //            $q2 = $this->db->query("select SUB_ABR from tblsubject_newschm where SUB_CD in (1,2,3,4,5)");
            //            $q2 = array('stdinfo_sub'=>$q2->result_array()) ;
            //            $query = array('stdinfo_reg'=>$q1,'stdinfo_sub'=>$q2);


        }
        else
        {
            return  false;
        }
    }
    public function Print_challan_Form($fetch_data)
    {
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
      
     // DebugBreak();
        $query = $this->db->query("Registration..sp_get_registration_Batch_challan $Inst_cd,$Batch_Id");
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
        
        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            $q2         = $this->db->get_where('Registration..RuleFee_Reg_Eleventh',array('Rule_Fee_ID'=>1));
            $resultarr = array("info"=>$query->result_array(),"rule_fee"=>$q2->result_array());
            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
    public function ReleaseBatch_INSERT($allinputdata){
        // DebugBreak();
        $Inst_cd = $allinputdata['Inst_Id'];
        $batchid = $allinputdata['batchId'];
        $reason = $allinputdata['reason'];
        $branch = $allinputdata['branch'];
        $challan = $allinputdata['challan'];
        $amount = $allinputdata['amount'];
        $date = $allinputdata['date'];

        $query = $this->db->query("Registration..ReleaseBatch_INSERT_Eleventh_New $Inst_cd,$batchid,'$reason','$branch',$challan,$amount,'$date'");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
        return true;
    }
    public function EditEnrolement_data($formno,$year,$inst_cd)
    {

        //  DebugBreak();
        if($year == 2015){
            $query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' =>11, 'iyear' => 2016, 'regpvt'=>1,'formNo'=>$formno));     
        }
        else{
            $query = $this->db->get_where('Registration..tblreg11th',  array('formNo' => $formno,'class'=>11,'iyear'=>$year,'sess'=>1));     
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
    public function Delete_NewEnrolement($formno)
    {
        $data=array('isDeleted'=>1);
        $this->db->where('formNo',$formno);
        $this->db->update('Registration..tblreg11th',$data);
        return true;

    }
       public function GetFormNo($Inst_Id)
    {
         //DebugBreak();
        $this->db->select('formno');
        $this->db->order_by("formno", "DESC");
        $formno = $this->db->get_where('Registration..tblreg11th', array('coll_cd' => $Inst_Id));
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
    public function user_info($User_info_data)
    {
        // DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $RegGrp = $User_info_data['RegGrp'];
        $spl_cd = $User_info_data['spl_case'];

        // $forms_id = $User_info_data['forms_id'];
        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            if($spl_cd == "0")
            {
                $q1         = $this->db->get_where('Registration..tblreg11th',array('Coll_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0,'RegGrp'=>$RegGrp));    
            }
            else{
                $q1         = $this->db->get_where('Registration..tblreg11th',array('Coll_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0,'Spec'=>$spl_cd));    
            }

            $result_1 ;
            $nrowcount = $q1->num_rows();
            if($nrowcount > 0)
            {
                $result_1 = $q1->result_array();
            }
            else{
                return false;
            }
            $q2         = $this->db->get_where('Registration..RuleFee_Reg_Eleventh',array('Rule_Fee_ID'=>1));
            $resultarr = array("info"=>$query->result_array(),"fee"=>$result_1,"rule_fee"=>$q2->result_array());
            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
    public function readmission_check($User_info_data)
    {
        //DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $RollNo = $User_info_data['RollNo'];
        $spl_cd = $User_info_data['spl_case'];

        // $forms_id = $User_info_data['forms_id'];

        $where = ' (spl_cd =  17 OR  spl_cd = 70  OR status=4 OR status=5 OR status=2)  ';
        $this->db->where('rno', $RollNo);
        //   $query = $this->db->get_where(RE_ADMISSION_TBL,  array('rno' => $RollNo));
        $query = $this->db->where($where);
        $query = $this->db->get(RE_ADMISSION_TBL11);
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $result_1 = $query->result_array();

            return  $result_1;
        }
        else
        {
            return  false;
        }
    }
    public function user_info_Formwise($User_info_data)
    {
        // DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $forms_id = $User_info_data['forms_id'];
        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $q1         = $this->db->query("select * from Registration..tblreg11th where Coll_cd =$Inst_cd and isdeleted = 0 and  FormNo in($forms_id)");
            // $this->db->from('Registration..IA_P1_Reg_Adm2016');
            //$this->db->where(array('Sch_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0));
            // $this->db->where_in('formNo',$forms_id);


            //$q1         = $this->db->where_in('Registration..IA_P1_Reg_Adm2016',array('Sch_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0,'formno'=>$forms_id));
            //$q1 = $this->db->get();
            //$result_1 = $q1->result_array();
            $nrowcount = $q1->num_rows();
            if($nrowcount > 0)
            {
                $result_1 = $q1->result_array();
            }
            $q2         = $this->db->get_where('Registration..RuleFee_Reg_Eleventh',array('Rule_Fee_ID'=>1));
            $resultarr = array("info"=>$query->result_array(),"fee"=>$result_1,"rule_fee"=>$q2->result_array());
            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
    public function getreulefee($ruleID)
    {
       // $ruleID = 1;
        $q2         = $this->db->get_where('Registration..RuleFee_Reg_Eleventh',array('Rule_Fee_ID'=>$ruleID));
        $resultarr = $q2->result_array();
        return $resultarr ;
    }
      public function Batch_Insertion($data,$AllUser)
    {
        // DebugBreak();

        $inst_cd = $data['inst_cd'];
        $total_fee = $data['total_fee'];
        $processing_fee = $data['proces_fee'];
        $reg_fee = $data['reg_fee'];
        $fine = $data['fine'];
        $refine = $data['refine'];
        $TotalRegFee = $data['TotalRegFee'];
        $TotalLatefee = $data['TotalLatefee'];
        $Totalprocessing_fee = $data['Totalprocessing_fee'];
        $forms_id = $data['forms_id'];
        $todaydate = $data['todaydate'];
        $total_std = $data['total_std'];
        //        EXEC Batch_Create @Inst_Cd = ".$user->inst_cd.",@UserId = ".$user->get_currentUser_ID()."@Amount = ".$tot_fee.",@Total_ProcessingFee = ".$prs_fee.",@Total_RegistrationFee = ".$reg_fee.",@Total_LateRegistrationFee =".$late_fee.",@Total_LateAdmissionFee = 0,@Valid_Date = '$today',@form_ids = '$forms_id'"
        $query = $this->db->query("Registration..Batch_Create_11th_2016_New $inst_cd,$reg_fee,$fine,$refine,$processing_fee,$total_std,$total_fee,$TotalRegFee,$Totalprocessing_fee,$TotalLatefee,'$todaydate','$forms_id',".Year.",11");
    
     
        $rowcount = $query->num_rows();
         if ($rowcount > 0)
         {
            $chalno =  $query->result_array();
            $challan_no = $chalno[0]['Batch_ID'];
            if($challan_no > 0)
            {
                $this->db->update_batch('Registration..tblreg11th',$AllUser,'formNo');
                return 1;
            }
            else
            {
                return  0;
            }
         }
        else
        {
            return  0;
        }
    
    }
    public function Batch_List($data)
    {
        //DebugBreak();
        $inst_cd = $data['Inst_Id'];
        $q2         = $this->db->get_where('Registration..tblregbatch11th',array('Inst_Cd'=>$inst_cd,'Is_Delete'=>0));
        $result = $q2->result_array();
        return $result;
    }
    public function return_pdf($fetch_data)
    {
        // DebugBreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Registration..sp_get_reg_return_formInfo_11th_New $Inst_cd,$Batch_Id");
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
     public function UpdateBatchFee($Alldata)
    {
        // DebugBreak();
        $data=array('Amount'=>$Alldata['data']['Amount'],'Total_RegistrationFee'=>$Alldata['data']['Total_RegistrationFee'],'Total_ProcessingFee'=>$Alldata['data']['Total_ProcessingFee'],'Total_LateRegistrationFee'=>$Alldata['data']['Total_LateRegistrationFee'],'cdate'=>date('Y-m-d H:i:s'));
        $this->db->where('Batch_Id',$Alldata['data']['batch_info'][0]['Batch_ID']);
        $this->db->update('Registration..tblregbatch11th',$data);
        
        $data=array('RegTotalFee'=>$Alldata['data']['Amount'],'regFee'=>$Alldata['rulefee'][0]['Reg_Fee'],'RegProcessFee'=>$Alldata['rulefee'][0]['Processing_Fee'],'RegFineFee'=>$Alldata['rulefee'][0]['Fine']);
        $this->db->where('Batch_Id',$Alldata['data']['batch_info'][0]['Batch_ID']);
        $this->db->update('Registration..tblReg11th',$data);
        return true;

    }
    public function Print_Form_Groupwise($fetch_data)
    {
        $Inst_cd = $fetch_data['Inst_cd'];
        $Grp_cd = $fetch_data['grp_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Registration..sp_get_reg_Print_Form_Eleventh $Inst_cd,$Grp_cd,$Batch_Id");
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
    public function Print_Form_Formnowise($fetch_data)
    {
        //  debugbreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $start_formno = $fetch_data['start_formno'];
        $end_formno = $fetch_data['end_formno'];
        $Batch_Id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Registration..sp_get_reg_Print_Form_formnowise_Eleventh_New $Inst_cd,'$start_formno','$end_formno',$Batch_Id");
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
    public function revenue_pdf($fetch_data)
    {
        //DebugBreak();

        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];

        $this->db->select('FormNo,name, Fname, IsReAdm,regFee,RegProcessFee,RegFineFee,RegTotalFee,yearOfPass,sessOfPass');
        $this->db->from('Registration..tblreg11th');
        $this->db->order_by("FormNo", "asc");
        $this->db->where(array('Coll_cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
        $result_1 = $this->db->get()->result();
        //$query = $this->db->get_where('Registration..IA_P1_Reg_Adm2016',  array('Sch_cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
        //$rowcount = $query->num_rows();
        //if($rowcount > 0)
        //{
        //$q = $query->result_array();
        $query_1 = $this->db->get_where('Registration..tblregbatch11th',  array('Inst_Cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
        $rowcount = $query_1->num_rows();
        if($rowcount > 0){
            $query_1 = $query_1->result_array();

            return $result = array('stdinfo'=>$result_1, 'batch_info'=>$query_1);    
            //  }

        }
        else
        {
            return  false;
        }
    }
    public function Spl_case_std_list($myinfo)
    {

        //DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case
        $inst_cd = $myinfo['Inst_cd'];
        $spl_cd = $myinfo['spl_cd'];
        $grp_selected = $myinfo['grp_selected'];
        $year = Year;
        if($grp_selected == FALSE)
        {
            if($spl_cd == FALSE || ($spl_cd == "3"))
            {
                $query = $this->db->query("Registration..sp_get_regInfo_11th_New $inst_cd,11,$year,1");    
            }

            else
            {
                $query = $this->db->query("Registration..sp_get_regInfo_spl_case_11th_New $inst_cd,11,$year,1,$spl_cd");    
            }    
        }
        else
        {
            $query = $this->db->query("Registration..sp_get_regInfo_Groupwise_11th_New $inst_cd,11,$year,1,$grp_selected");    
        }




        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
            // $q1 = array('stdinfo'=>$query->result_array()) ;
            //            for($i= 0; $i<$rowcount; $i++){
            //            $q1['stdinfo'][$i]['sub1'];
            //            }
            //            $q1['stdinfo']['sub1'];
            //            $q2 = $this->db->query("select SUB_ABR from tblsubject_newschm where SUB_CD in (1,2,3,4,5)");
            //            $q2 = array('stdinfo_sub'=>$q2->result_array()) ;
            //            $query = array('stdinfo_reg'=>$q1,'stdinfo_sub'=>$q2);


        }
        else
        {
            return  false;
        }
    }
    public function bay_form_comp($bayformno)
    {
        $query = $this->db->get_where('Registration..tblreg11th',  array('BForm' => $bayformno,'IsDeleted'=>0));
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
        $query = $this->db->get_where('Registration..tblreg11th',  array('BForm' => $bayformno,'FNIC' => $fnic,'Dob' => $dob,'IsDeleted'=>0));
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
       public function generateStrNo($sex,$fromno)
    {
        $query = $this->db->query("select max(regno) as regno from Registration..regcard11th where sex=$sex ");
        $maxnumber = $query->result_array()[0]['regno'];
        $maxnumber = $maxnumber+1;
        $data2 = array(
            'regno'=>$maxnumber,
            'sex'=>$maxnumber,
            'formno'=>$fromno,
            'strRegNo'=>'2-1-'.$maxnumber.'-16',
        );
        $res = $this->db->insert("Registration..regcard11th", $data2);


        $data2 = array(
            'strRegNo'=>'2-1-'.$maxnumber.'-16',
        );
        $this->db->where('formno',$fromno);
        $res =  $this->db->update("Registration..tblreg11th", $data2);

        if ($res === FALSE) {
            return -1; // Or do whatever you gotta do here to raise an error
        } else {
            return '2-2-'.$maxnumber.'-16';
        }  

         
    }

}
?>
