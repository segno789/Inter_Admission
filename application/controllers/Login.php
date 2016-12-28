<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    * 		http://example.com/index.php/welcome
    *	- or -
    * 		http://example.com/index.php/welcome/index
    *	- or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see http://codeigniter.com/user_guide/general/urls.html
    */
    function __construct()
    {
        parent:: __construct();

        $this->clear_cache();
    }
    public function index()
    {
        $this->load->helper('url');
        $data = array(
            'user_status' => ''                     

        );

        if(@$_POST['username'] != '' && @$_POST['password'] != '')
        {   

            $this->load->model('login_model'); 
            $logedIn = $this->login_model->auth($_POST['username'],$_POST['password']);
            $this->load->model('login_model'); 
            $logedIn = $this->login_model->auth($_POST['username'],$_POST['password']);
            $isgroup = -1;
            //  DebugBreak();   
            if($logedIn != false)
            {  


                if($logedIn['flusers']['status'] == 0)
                {
                    $data = array(
                        'user_status' => 3                     
                    );
                    $this->load->view('login/login.php',$data);
                }  
                else  if($logedIn['tbl_inst']['edu_lvl']== 1)
                {
                    $data = array(
                        'user_status' => 2                     
                    );
                    $this->load->view('login/login.php',$data);
                }  
                if($logedIn['tbl_inst']['edu_lvl'] == 1)
                {
                    if($logedIn['tbl_inst']['IsGovernment'] ==2 and ($logedIn['tbl_inst']['allowed_mGrp'] == '1,2' || $logedIn['tbl_inst']['allowed_mGrp'] == '2,1' || $logedIn['tbl_inst']['allowed_mGrp'] == '1' || $logedIn['tbl_inst']['allowed_mGrp'] == '2' || $logedIn['tbl_inst']['allowed_mGrp'] == '1,7' || $logedIn['tbl_inst']['allowed_mGrp'] == '7,1'))
                    {
                        $logedIn['tbl_inst']['allowed_mGrp'] = '1,2,7';
                    }
                }
                else if($logedIn['tbl_inst']['edu_lvl'] == 2)
                {
                    if(($logedIn['tbl_inst']['allowed_iGrp'] == NULL || $logedIn['tbl_inst']['allowed_iGrp'] == 0 || $logedIn['tbl_inst']['allowed_iGrp'] == '') && $logedIn['tbl_inst']['IsGovernment'] ==2)
                    {
                        $isgroup =1;
                        $data = array(
                            'user_status' => 7                     
                        );
                        $this->load->view('login/login.php',$data);
                    }
                }
                else if($logedIn['tbl_inst']['edu_lvl'] == 3)
                {
                    if(($logedIn['tbl_inst']['allowed_iGrp'] == NULL || $logedIn['tbl_inst']['allowed_iGrp'] == 0 || $logedIn['tbl_inst']['allowed_iGrp'] == '') && $logedIn['tbl_inst']['IsGovernment'] ==2 )
                    {

                        $isgroup =1;
                        $data = array(
                            'user_status' => 7                     
                        );
                        $this->load->view('login/login.php',$data);
                    }
                    if($logedIn['tbl_inst']['IsGovernment'] ==2 and ($logedIn['tbl_inst']['allowed_mGrp'] == '1,2' || $logedIn['tbl_inst']['allowed_mGrp'] == '2,1' || $logedIn['tbl_inst']['allowed_mGrp'] == '1' || $logedIn['tbl_inst']['allowed_mGrp'] == '2' || $logedIn['tbl_inst']['allowed_mGrp'] == '1,7' || $logedIn['tbl_inst']['allowed_mGrp'] == '7,1'))
                    {
                        $logedIn['tbl_inst']['allowed_mGrp'] = '1,2,7';
                    }



                }
                if($isgroup ==-1)
                {
                    // $this->load->model('RollNoSlip_model');
                    $isdeaf = 0;
                    if($logedIn['tbl_inst']['edu_lvl'] == 1)
                    {
                        if($logedIn['tbl_inst']['IsGovernment'] ==1)
                        {
                            $logedIn['tbl_inst']['allowed_mGrp'] = '1,2,5,7,8';
                            $logedIn['tbl_inst']['allowed_iGrp'] = '';
                        }  
                    }
                    else if($logedIn['tbl_inst']['edu_lvl'] == 2)
                    {
                        if($logedIn['tbl_inst']['IsGovernment'] ==1)
                        {
                            $logedIn['tbl_inst']['allowed_mGrp'] = '';
                            $logedIn['tbl_inst']['allowed_iGrp'] = '1,2,3,4,5,6';
                        }

                    }
                    else if($logedIn['tbl_inst']['edu_lvl'] == 3)
                    {
                        if($logedIn['tbl_inst']['IsGovernment'] ==1)
                        {
                            $logedIn['tbl_inst']['allowed_mGrp'] = '1,2,5,7,8';
                            $logedIn['tbl_inst']['allowed_iGrp'] = '1,2,3,4,5,6';
                        }

                    }
                    $isfeeding = -1;
                    $isinterfeeding = -1;
                    $lastdate = SingleDateFee;
                    //  DebugBreak();



                    // DebugBreak();
                    $sess_array = array(
                        'Inst_Id' => $logedIn['flusers']['inst_cd'] ,
                        'pass' => $logedIn['flusers']['pass'] ,
                        'edu_lvl' => $logedIn['tbl_inst']['edu_lvl'],
                        'inst_Name' => $logedIn['flusers']['inst_name'],
                        'gender' => $logedIn['tbl_inst']['Gender'],
                        'isrural' => $logedIn['tbl_inst']['IsRural'],
                        'grp_cd' => $logedIn['tbl_inst']['allowed_mGrp'],
                        'grp_cdi' => $logedIn['tbl_inst']['allowed_iGrp'],
                        'isgovt' => $logedIn['tbl_inst']['IsGovernment'],
                        'email' => $logedIn['tbl_inst']['email'],
                        'phone' => $logedIn['tbl_inst']['LandLine'],
                        'cell' => $logedIn['tbl_inst']['MobNo'],
                        'dist' => $logedIn['tbl_inst']['dist_cd'],
                        'teh' => $logedIn['tbl_inst']['teh_cd'],
                        'zone' => $logedIn['tbl_inst']['iZone_cd'],
                        'emis' => $logedIn['tbl_inst']['emis_code'],
                        'isInserted' => $logedIn['isInserted'],
                        'isdeaf' => $isdeaf,
                        'isboardoperator' => 0  ,
                        'isfeedingallow' => $isfeeding   ,
                        'isinterfeeding' => $isinterfeeding ,
                        'lastdate' => $lastdate ,  
                    );
                    $this->load->library('session');
                    $this->session->set_userdata('logged_in', $sess_array); 
                    if($logedIn['tbl_inst']['edu_lvl'] == 2 || $logedIn['tbl_inst']['edu_lvl'] == 3 )
                    {
                        redirect('dashboard/');  
                    }
                }
            }
            else
            {  
                $data = array(
                    'user_status' => 1                     
                );
                $this->load->view('login/login.php',$data);
            }
        }
        else
        {
            $this->load->view('login/login.php',$data);
        }
    }

    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    function logout()
    {
        $this->load->helper('url');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $this->session->set_userdata('logged_in', ''); 
        $this->session->sess_destroy();
        redirect('login');
    }

}                          