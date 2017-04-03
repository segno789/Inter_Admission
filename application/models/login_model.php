<?php
class Login_model extends CI_Model {
    public function __construct() {
        $this->load->database(); 
    }
    public function auth($username,$password) 
    {
        $query = $this->db->get_where('Admission_online..tblInstitutes_Deactivated', array('inst_cd' => $username,'isactive' => 0));
        $rowcount = $query->num_rows();
        $remarks = '';
        if($rowcount>0)
        {
            $query_1 = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username)); 
            $allinfo = array('flusers'=>$query->row_array(),'isactive'=>1,'tbl_inst'=>$query_1->row_array());
            return $allinfo;
        }


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
