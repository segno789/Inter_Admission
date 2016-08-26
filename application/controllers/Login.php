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
         // DebugBreak();   
        if($logedIn != false)
            {  


                if($logedIn['flusers']['status'] == 0)
                {
                    $data = array(
                        'user_status' => 3                     
                    );
                    $this->load->view('login/login.php',$data);
                }  

                if($logedIn['tbl_inst']['edu_lvl'] == 1)
                {
                    /* if(($logedIn['tbl_inst']['allowed_mGrp'] == NULL || $logedIn['tbl_inst']['allowed_mGrp'] == 0 || $logedIn['tbl_inst']['allowed_mGrp'] == '') && $logedIn['tbl_inst']['IsGovernment'] ==2)
                    {
                    $isgroup =1;
                    $data = array(
                    'user_status' => 7                     
                    );
                    $this->load->view('login/login.php',$data);
                    }          */

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
                    $lastdate = SINGLE_LAST_DATE;
                  //  DebugBreak();
                     
                    if($logedIn['tbl_inst']['edu_lvl'] == 1 ||  $logedIn['tbl_inst']['edu_lvl'] == 3)
                    {
                          if($logedIn['SpecPermission']==1)
                        {
                          $lastdate=  $logedIn['spec_info']['FeedingDate'];
                            if(date('Y-m-d',strtotime($lastdate))>=date('Y-m-d'))
                            {
                                 $isfeeding = 1;
                            }
                           else {
                                 $isfeeding = 0;
                            }
                            
                        }
                        else
                        {
                            
                        
                        if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d') || date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>=date('Y-m-d'))
                        {
                            $isfeeding = 1    ;
                        }
                        else if($logedIn['tbl_inst']['feedingDate'] != null)
                        {
                            $lastdate  = date('Y-m-d',strtotime($logedIn['tbl_inst']['feedingDate'])) ;
                            if(date('Y-m-d')<=$lastdate)
                            {

                                $isfeeding = 1; 
                            }
                            else 
                            {    $lastdate = SINGLE_LAST_DATE;
                                $isfeeding = -1;
                            }
                        }
                        }
                        
                     

                    }  
                    if($logedIn['tbl_inst']['edu_lvl'] == 2 || $logedIn['tbl_inst']['edu_lvl'] == 3 )
                    {
                        if(date('Y-m-d',strtotime(SINGLE_LAST_DATE11))>=date('Y-m-d') || date('Y-m-d',strtotime(DOUBLE_LAST_DATE11))>=date('Y-m-d'))
                        {
                            $isinterfeeding = 1    ;
                        }
                        else if($logedIn['tbl_inst']['feedingDate'] != null)
                        {
                            $lastdate  = date('Y-m-d',strtotime($logedIn['tbl_inst']['feedingDate'])) ;
                            if(date('Y-m-d')<=$lastdate)
                            {

                                $isinterfeeding = 1; 
                            }
                            else 
                            {
                                $isinterfeeding = -1;
                            }
                        }
                    }


                   // DebugBreak();
                    $sess_array = array(
                        'Inst_Id' => $logedIn['flusers']['inst_cd'] ,
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
                        'isSpecial' => $logedIn['SpecPermission'],   
                        'isSpecial_Fee' => $logedIn['spec_info']   
                    );
                    $this->load->library('session');
                    $this->session->set_userdata('logged_in', $sess_array); 
                    // redirect('Registration/','refresh');
                    // redirect('Admission_matric/','refresh');
                    if($logedIn['tbl_inst']['edu_lvl'] == 1 ||  $logedIn['tbl_inst']['edu_lvl'] == 3)
                    {
                        redirect('Admission_inter/','refresh');
                    }
                    else  if($logedIn['tbl_inst']['edu_lvl'] == 2 || $logedIn['tbl_inst']['edu_lvl'] == 3 )
                    {
                        redirect('Admission_inter/','refresh');  
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
    public function biselogin()
    {
        // DebugBreak();
        $this->load->helper('url');
        $data = array(
            'user_status' => ''                     

        );


        if(@$_POST['username'] != '' && @$_POST['password'] != '')
        {   
            if(@$_POST['username'] == 2222 || @$_POST['username'] == 2303 || @$_POST['username'] == 2229)
            {



                $this->load->model('login_model'); 
                $logedIn = $this->login_model->biseauth($_POST['username'],$_POST['password']);
                if($logedIn != false)
                {  
                    $sess_array = array(
                        'Inst_Id' => $logedIn['Emp_cd'] ,
                        'edu_lvl' => $logedIn['BS'],
                        'inst_Name' => $logedIn['Name'],
                        'isdeaf' => 0,
                        'isboardoperator' => 1,
                    );
                    $this->load->library('session');
                    $this->session->set_userdata('logged_in', $sess_array); 
                    redirect('BiseCorrection/reg9thcorrections', 'refresh'); 
                }
                else
                {  
                    $data = array(
                        'user_status' => 1                     
                    );
                    $this->load->view('login/biselogin.php',$data);

                }
            }
            else
            {
                $data = array(
                    'user_status' => '7'                     

                );
                $this->load->view('login/biselogin.php',$data);
            }

        }
        else
        {

            $this->load->view('login/biselogin.php',$data);
        }

    }

    function logout()
    {
        $this->load->helper('url');

        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = @$Logged_In_Array['logged_in'];
        if($userinfo['isboardoperator']==1){
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('logged_in_front');
            $this->session->unset_userdata('user_id_front');
            $this->session->unset_userdata('username_front');

            $this->session->sess_destroy();    
            redirect('login/biselogin','refresh');
        }
        else{
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('logged_in_front');
            $this->session->unset_userdata('user_id_front');
            $this->session->unset_userdata('username_front');

            $this->session->sess_destroy();
            redirect('login','refresh');
        }



    }

}
/*'Inst_Id' => $logedIn->Inst_cd,
'edu_lvl' => $logedIn->edu_lvl,
'Name' => $logedIn->name,*/