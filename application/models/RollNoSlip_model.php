<?php
class RollNoSlip_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function get12thStdData($inst_cd)
    {
       // DebugBreak();
        $mClass =  mClass1;
        $mSession =  mSession;
        $mYear =  mYear;
        //   DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $inst_cd = $inst_cd;
        $query = $this->db->query("Registration..get12thStdData $inst_cd,$mYear,$mClass,$mSession,1");
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

    public function get12thrslip($rno,$class,$iyear,$sess)
    {

        // DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfo $rno,$class,$iyear,$sess");
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $query = $this->db->query("Registration..InterSlips $rno,$class,$iyear,$sess");
          
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  false;
        }
    }



    public function get12thrslipWith_Grp_CD($class,$iyear,$sess,$group_cd,$inst_cd)
    {
        //DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfo_With_Grp_cd $class,$iyear,$sess,$group_cd,$inst_cd");
        $rowcount = $query->num_rows();
        $row = array();
        $grpwiserow = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
          //  $this->db->order_by("rno", "ASC");
         //   $this->db->order_by("Datesort", "ASC");

           /* $query1 = $this->db->query("select Count(*) as total from Registration..InterDatesheet2016 where  sch_cd ='$inst_cd' AND grp_cd = '$group_cd'");
            $rowcountslip = $query1->result_array(); 
            $limit =  '';   
            $remain = 0;    
            $start_row=  0;  
            $total = '';
            if($rowcountslip[0]['total']>8999)
            {
                $limit = 8999;
                $total = $rowcountslip[0]['total'];
                $remain = $total - $limit;
            }
            else
            {
                $limit = $rowcountslip[0]['total'];
            }
            $condition = " sch_cd = '$inst_cd' AND grp_cd =  $group_cd";

            $this->db->select('*');
            if(isset($limit)&& $limit!='')
                { $this->db->limit($limit, $start_row); }
            $this->db->from("Registration..InterDatesheet2016");
            if(isset($condition) && $condition != '')
                { $this->db->where($condition); } 
            $query = $this->db->get();
            $qry = $this->db->last_query();
            $slips[] = $query->result_array();
            //$rowcount = $query->num_rows();

            if($remain != '')
            {
                $this->db->select('*');
                if(isset($limit)&& $limit!='')
                    { $this->db->limit($total, $limit); }
                $this->db->from("Registration..InterDatesheet2016");
                if(isset($condition) && $condition != '')
                    { $this->db->where($condition); } 
                $query = $this->db->get();
                $slips[] = $query->result_array();
                //$rowcount = $query->num_rows(); 
            }

            if(count($slips)>1)
            {
                $slips = array_merge($slips[0],$slips[1]);
            }
            else
            {
                $slips = $slips[0];
            }
            // $totalslip =  count($slips);
            $row['slip'] = $slips ; */
            return $row;
        }
        else
        {
            return  false;
        }
    }
    /* public function get12thrslipWith_Grp_CD($class,$iyear,$sess,$group_cd,$inst_cd)
    {
    // DebugBreak();
    $query = $this->db->query("Registration..InterSlipInfo_With_Grp_cd $class,$iyear,$sess,$group_cd,$inst_cd");
    $rowcount = $query->num_rows();
    $row = array();
    $grpwiserow = array();
    if($rowcount > 0)
    {
    $row['info']  = $query->result_array();
    $this->db->order_by("Datesort", "ASC");

    $query1 = $this->db->get_where('Registration..InterDatesheet2016', array('sch_cd' => $inst_cd,'grp_cd'=>$group_cd)); 

    $rowcount = $query1->num_rows();
    $row['slip'] = $query1->result_array(); 
    return $row;
    }
    else
    {
    return  false;
    }
    }*/

    public function get12datesheetonly($rno,$class,$iyear,$sess)
    {

        $this->db->order_by("Datesort", "ASC");
        $query = $this->db->query("Registration..InterSlips $rno,$class,$iyear,$sess");
        $row = $query->result_array();
        return $row;
    }


    public function getPVT12thrslip($Name,$Fname,$Fnic,$rno,$formno,$class,$iyear,$sess)
    {
        $Name  = empty($Name) ? '' : $Name;
        $Fname  = empty($Fname) ? '' : $Fname;
        $Fnic  = empty($Fnic) ? '' : $Fnic;
        $formno  = empty($formno) ? '' : $formno;
        $rno  = empty($rno) ? 0 : $rno;
        $query = $this->db->query("Registration..InterSlipInfopvt '$Name','$Fname','$Fnic','$formno',$rno,$class,$iyear,$sess");
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $rno = $row['info'][0]['Rno'];
            $this->db->order_by("Datesort", "ASC");
            $query = $this->db->query("Registration..InterSlips $rno,$class,$iyear,$sess");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  $rowcount;
        }
    }

    public function get11thStdData($inst_cd)
    {
         $mClass =  mClass2;
        $mSession =  mSession1;
        $mYear =  mYear;
        //DebugBreak();
        //  $query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2016, 'regpvt'=>1,));
        $query = $this->db->query("Registration..get11thStdData $inst_cd,$mYear,$mClass,$mSession,1");
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
    public function get11thrslip($rno,$class,$iyear,$sess)
    {
        //DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfoP1 $rno,$class,$iyear,$sess");

        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            // $query = $this->db->query("select * from Registration..maP1Datesheet2016 where rno in( (select rno from Registration..maP1Datesheet2016  where rno=$rno))"); 
            $query = $this->db->query("Registration..InterSlips11th $rno,$class,$iyear,$sess,1");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  false;
        }
    }
    public function get11thrslipWith_Grp_CD($class,$iyear,$sess,$group_cd,$inst_cd)
    {
        //  DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfo_With_Grp_cd_P1 $class,$iyear,$sess,$group_cd,$inst_cd");
        $rowcount = $query->num_rows();
        $row = array();
        $grpwiserow = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");

            $query1 = $this->db->get_where('Registration..InterP1Datesheet2016', array('sch_cd' => $inst_cd,'grp_cd'=>$group_cd)); 

            $rowcount = $query1->num_rows();
            $row['slip'] = $query1->result_array(); 
            return $row;
        }
        else
        {
            return  false;
        }
    }
    public function get11datesheetonly($rno,$class,$iyear,$sess)
    {

        $this->db->order_by("Datesort", "ASC");
        $query = $this->db->query("Registration..InterSlips11th $rno,$class,$iyear,$sess,1");
        $row = $query->result_array();
        return $row;
    }
    public function getPVT11thrslip($Name,$Fname,$Fnic,$rno,$formno,$class,$iyear,$sess)
    {
        $Name  = empty($Name) ? '' : $Name;
        $Fname  = empty($Fname) ? '' : $Fname;
        $Fnic  = empty($Fnic) ? '' : $Fnic;
        $formno  = empty($formno) ? '' : $formno;
        $rno  = empty($rno) ? 0 : $rno;


        //DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfopvtP1 '$Name','$Fname','$Fnic','$formno',$rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $rno = $row['info'][0]['Rno'];
          //  $query = $this->db->query("select * from Registration..InterP1Datesheet2016pvt where rno in( (select rno from Registration..InterP1Datesheet2016pvt  where rno=$rno))"); 
            $query = $this->db->query("Registration..InterSlips11th $rno,$class,$iyear,$sess,2");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  $rowcount;
        }
    }
    
      public function getPVTLangthrslip($Name,$Fname,$Fnic,$rno,$formno,$class,$iyear,$sess)
    {
      //  DebugBreak();
        $Name  = empty($Name) ? '' : $Name;
        $Fname  = empty($Fname) ? '' : $Fname;
        $Fnic  = empty($Fnic) ? '' : $Fnic;
        $formno  = empty($formno) ? '' : $formno;
        $rno  = empty($rno) ? 0 : $rno;


        //DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfopvtlang '$Name','$Fname','$Fnic','$formno',$rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $rno = $row['info'][0]['Rno'];
          //  $query = $this->db->query("select * from Registration..InterP1Datesheet2016pvt where rno in( (select rno from Registration..InterP1Datesheet2016pvt  where rno=$rno))"); 
            $query = $this->db->query("Registration..InterSlipslang $rno,$class,$iyear,$sess,2");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  $rowcount;
        }
    }

}
?>
