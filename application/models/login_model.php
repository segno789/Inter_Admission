<?php
class Login_model extends CI_Model {
    public function __construct() {
        $this->load->database(); 
    }
   /* public function auth($username,$password) 
    {
      
        $remarks = '';
     
        $query = $this->db->get_where('Admission_online..fl_users', array('inst_cd' => $username,'pass' => $password));
        $rowcount = $query->num_rows();
        if($rowcount >0)
        {
            $query_1 = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username));


            $tblInstitutes_all_Info  = $this->db->get_where('Registration..tblInstitutes_all_Info', array('inst_cd' => $username));
            $isInserted = 0;
            if ($tblInstitutes_all_Info->num_rows() > 0)
            {
                $isInserted = 1;
            }
            $allinfo = array('flusers'=>$query->row_array(), 'tbl_inst'=>$query_1->row_array(),'isInserted'=>$isInserted);
            return $allinfo;
        }
        else
        {
            return  false;; 
        }
    } */
     public function auth($username,$password) 
    {
       // DebugBreak();
        
        $query = $this->db->get_where('Admission_online..fl_users', array('inst_cd' => $username,'pass' => $password));
        $rowcount = $query->num_rows();
        if($rowcount >0)
        {
            $query_1 = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username));
            
            
            $tblInstitutes_all_Info  = $this->db->get_where('Registration..tblInstitutes_all_Info', array('inst_cd' => $username));
            $specialPermission = $this->db->get_where('Registration..inst_Special_Permission_11th',array('inst_cd'=>$username));
            if($specialPermission->num_rows()>0)
            {
                
                $isSpecial=1;
                $isSpecial_Info= $specialPermission->row_array();
            }
            else{
                $isSpecial=0;
                $isSpecial_Info = false;
            }
            $isInserted = 0;
            if ($tblInstitutes_all_Info->num_rows() > 0)
            {
                $isInserted = 1;
            }
               $allinfo = array('flusers'=>$query->row_array(), 'tbl_inst'=>$query_1->row_array(),'isInserted'=>$isInserted,'SpecPermission'=>$isSpecial,'spec_info'=>$isSpecial_Info);
             return $allinfo;
        }
        else
        {
           return  false;; 
        }
    }
    public function chekdefultar($username)
    {
        $query = $this->db->get_where('Admission_online..tblInstitutes_Deactivated', array('inst_cd' => $username,'isactive' => 0 ,'class'=>12,'sess'=>1,'myear'=>2017));
        $rowcount = $query->num_rows();

        if($rowcount>=1)
        {
            return  $query->row_array();
        }

        return -1;
    }
    public function biseauth($username,$password) 
    {

        $query = $this->db->get_where('matric_new..tblEmployee', array('Emp_cd' => $username,'pass' => $password));
        $rowcount = $query->num_rows();
        if($rowcount >0)
        {

            return $query->row_array();
        }
        else
        {
            return  false;; 
        }
    }
    public function getappconfig() 
    {

        $query = $this->db->get_where('online_BAK..tblAppConfig', array('iyear' => Year,'class' => 11));
        $rowcount = $query->num_rows();
        if($rowcount >0)
        {

            return $query->row_array();
        }
        else
        {
            return  false;; 
        }
    }
}
?>
