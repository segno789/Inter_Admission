<?php
class Admission_model extends CI_Model 
{
    public function __construct()
    {

        $this->load->database(); 
    }

       public function Pre_Inter_Data($data)
    {
      //  DebugBreak();
        
        if( ($data['isaloom']==1))
        {
        $query = $this->db->get_where(getinfo_languages, array('rno' => $data['hsscrno'], 'Iyear' => $data['iYear'], 'Sess'=>$data['session']));
        }
        else
        {
        $query = $this->db->get_where(getinfo, array('matRno'=>$data['sscrno'],'rno' => $data['hsscrno'], 'class' => $data['hsscclass'], 'Iyear' => $data['iYear'], 'sess'=>$data['session'],'IntBrd_cd'=>$data['board']));
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
        $this->db->update('Admission_Online..ISAdm2016',$data);  
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
        $this->db->select('FormNo');
       // $this->db->select_max('formNo');
       
        //$this->db->where('regPvt',2);
        $this->db->order_by("FormNo", "DESC");
        $formno = $this->db->get('admission_online..ISAdm2016',array('regPvt'=>2));
        //$formno =$this->db->get_where('',array('regPvt'=>2));
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

    public function Insert_NewEnorlement($data)
    {    
        //DebugBreak();  
        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        //$Dob = $data['Dob'];
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
        $RegGrp = $data['grp_cd'];
        $sub1ap2 =  $data['sub1ap2'];
        $sub2ap2 =  $data['sub2ap2'];
        $sub3ap2 =  $data['sub3ap2'];
        $sub4ap2 =  $data['sub4ap2'];
        $sub5ap2 =  $data['sub5ap2'];
        $sub6ap2 =  $data['sub6ap2'];
        $sub7ap2 =  $data['sub7ap2'];
        $sub8ap2 =  $data['sub8ap2'];
        // $exam_type = $data['examtype'];
        //$cattype = $data['cattype'];                                 
        $cat09 = $data['cat11'];     
        $cat10 = $data['cat12'];     

        //-------Marks Improve CAT --------\\
        $dist_cd =  $data['dist'];
        $teh_cd =  $data['teh'];
        $zone_cd =  $data['zone'];
        $oldrno =  $data['rno'];
        $oldyear =  $data['Iyear'];
        $oldsess =  $data['sess'];
        $AdmFine =  $data['AdmFine'];
        //  DebugBreak();



        $Brd_cd =  $data['Brd_cd'];

        /* if($Brd_cd == 'Gujranwala'){
        $Brd_cd =  1;    
        }
        else if($oldsess == 'Other Board'){
        $Brd_cd =  2;
        }*/
        $old_class =  $data['class'];

        $AdmProcFee =  $data['AdmProcessFee'];

        $AdmFee = $data['AdmFee'];

       // $TotalAdmFee =  $AdmFee + $AdmProcFee;
       $TotalAdmFee =  $AdmFee + $AdmProcFee+$AdmFine;

       // DebugBreak();

        $query = $this->db->query(Insert_sp." '$formno',12,2016,2,'$name','$fname','$BForm','$FNIC','$CellNo',$medium,'".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,1,$oldrno,$oldyear,$oldsess,$old_class,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp,$cat09,$cat10,$sub1ap2,$sub2ap2,$sub4ap2,$sub5ap2,$sub6ap2,$sub7ap2,$sub8ap2,$dist_cd,$teh_cd,$zone_cd,$Brd_cd,$AdmProcFee,$AdmFee,$TotalAdmFee,$sub5a,$sub6a,$sub7a,$AdmFine");
        return true;
    }
      public function Insert_NewEnorlement_Languages($data)
    {    
        //DebugBreak();  
        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
      
        $CellNo = $data['MobNo'];
      
        $MarkOfIden =strtoupper(@$data['markOfIden']);
      
        $sex = $data['sex'];
          
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
        $RegGrp = $data['grp_cd'];
        
        //-------Marks Improve CAT --------\\
        $dist_cd =  $data['dist'];
        $teh_cd =  $data['teh'];
        $zone_cd =  $data['zone'];
        $oldrno =  $data['rno'];
        $oldyear =  $data['Iyear'];
        $oldsess =  $data['sess'];
        //  DebugBreak();
        
        $Brd_cd =  $data['Brd_cd'];
        
       

        $AdmProcFee =  $data['AdmProcessFee'];

        $AdmFee = $data['AdmFee'];

        $TotalAdmFee =  $AdmFee + $AdmProcFee;

       // DebugBreak();

        $query = $this->db->query(Insert_sp_Languages." '$formno',2016,2,'$name','$fname','$CellNo','".$MarkOfIden."',$sex,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,1,$oldrno,$oldyear,$oldsess,$dist_cd,$teh_cd,$zone_cd,$Brd_cd,$AdmProcFee,$AdmFee,$TotalAdmFee");
        return true;
    }
    public function get_formno_data($formno)
    {

        ////DebugBreak();
        if($formno <600000)
        {
        $query = $this->db->query(formprint_sp_Languages."'$formno'");
        }
        else
        {
        $query = $this->db->query(formprint_sp."'$formno'");
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
    public function getzone($tehcd)
    {

        $query = $this->db->get_where('matric_new..tblZones_new', array('mYear' => 2016,'Class' => 12,'Sess'=>2, 'teh_cd' => $tehcd));

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
        $zone = $data['zoneCode'];
        $gend = $data['gen'];
          // DebugBreak();
        $where = " mYear = 2016  AND class = 12 AND  sess = 2 AND Zone_cd =  $zone  AND  (cent_Gen = $gend OR cent_Gen = 3) ";      
        $query = $this->db->query("SELECT * FROM matric_new..tblcentre_new WHERE $where");

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
        $query = $this->db->get_where('admission_Online..RuleFeeAdm', array('class' => 12,'sess' => 2, 'isPrSub' => $isPrSub,'Start_Date <='=>$date,'End_Date >='=>$date));
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