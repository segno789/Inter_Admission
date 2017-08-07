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
            //DebugBreak();
             $this->load->model('login_model'); 
             $isdefualter = $this->login_model->chekdefultar($_POST['username']);
            if( $isdefualter != -1)
            {
               // echo '<pre>'; print_r($isdefualter);
             //   exit();
                $data = array(
                    'user_status' => 4,                     
                    'remarks' => $isdefualter['Remarks']                     
                );


                $this->load->view('login/login.php',$data);
                return ;
            }
            
            

          
            $logedIn = $this->login_model->auth($_POST['username'],$_POST['password']);
            $isgroup = -1;
            $appConfig = $this->login_model->getappconfig();
                      
               if($logedIn['tbl_inst']['feedingDate'] != null || $logedIn['SpecPermission']==1)
            {
                $lastdate  = date('Y-m-d',strtotime($logedIn['tbl_inst']['feedingDate'])) ;
                $spec_lastdate = date('Y-m-d',strtotime($logedIn['spec_info']['FeedingDate']));

                if(date('Y-m-d')<=$lastdate || date('Y-m-d')<=$spec_lastdate)
                {

                    $appConfig['isadmP1'] = 1;
                }

            }         
           // DebugBreak();   
           // $appConfig['isreg']=1;
          //  $appConfig['isreg']=1;
            
            if($logedIn != false)
            {  



                if( @$logedIn['isactive'] == 1)
                {
                    $data = array(
                        'user_status' => 4,                     
                        'remarks' => $logedIn['flusers']['Remarks']                     
                    );


                    if(( ($logedIn['tbl_inst']['edu_lvl'] == 2 || $logedIn['tbl_inst']['edu_lvl'] == 3)&& $logedIn['flusers']['class'] ==11))
                    {
                        $this->load->view('login/login.php',$data);
                        return ;
                    }

                    //  echo '<pre>'; print_r($logedIn);die;       
                }


                else  if($logedIn['flusers']['status'] == 0)
                {
                    $data = array(
                        'user_status' => 3                     
                    );
                    $this->load->view('login/login.php',$data);
                    return ;
                }  
                else  if($logedIn['tbl_inst']['edu_lvl']== 1)
                {
                    $data = array(
                        'user_status' => 2                     
                    );
                    $this->load->view('login/login.php',$data);
                    return ;
                }  
                if($logedIn['tbl_inst']['edu_lvl'] == 2)
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


                }
                if($isgroup ==-1)
                {
                    // $this->load->model('RollNoSlip_model');
                    $isdeaf = 0;
                    if($logedIn['tbl_inst']['edu_lvl'] == 2)
                    {
                        if($logedIn['tbl_inst']['IsGovernment'] ==1)
                        {
                            $logedIn['tbl_inst']['allowed_iGrp'] = '1,2,3,4,5,6';
                        }
                    }
                    else if($logedIn['tbl_inst']['edu_lvl'] == 3)
                    {
                        if($logedIn['tbl_inst']['IsGovernment'] ==1)
                        {
                            $logedIn['tbl_inst']['allowed_iGrp'] = '1,2,3,4,5,6';
                        }

                    }
                     //DebugBreak();
                    $isfeeding = 1;
                    $isinterfeeding = 1;
                    $lastdate = SingleDateFee;
                     if($logedIn['SpecPermission']==1)
                    {
                        $lastdate=  $logedIn['spec_info']['FeedingDate'];
                        if(date('Y-m-d',strtotime($lastdate))>=date('Y-m-d'))
                        {
                            $isfeeding = 1;
                        }
                        else {
                            if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d') || date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>=date('Y-m-d'))
                            {
                                $isfeeding = 1    ;
                                $lastdate = SINGLE_LAST_DATE;
                                $logedIn['SpecPermission'] = 0;
                            }
                            else
                            {
                                $isfeeding = 0;   
                            }

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
                    if($_POST['username'] == 399901 || $_POST['username'] == 399903 )
                    {
                        //$appConfig['isadmP1'] = 1;
                        $appConfig['isreg'] = 1;
                        $isfeeding = 1; 
                    }
                    //  DebugBreak();



                     //DebugBreak();
                    $sess_array = array(
                        'Inst_Id' => $logedIn['tbl_inst']['Inst_cd'] ,
                        'pass' => $logedIn['flusers']['pass'] ,
                        'edu_lvl' => $logedIn['tbl_inst']['edu_lvl'],
                        'inst_Name' => $logedIn['tbl_inst']['Name'],
                        'gender' => $logedIn['tbl_inst']['Gender'],
                        'isrural' => $logedIn['tbl_inst']['IsRural'],
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
                        'isSpecial' => $logedIn['SpecPermission'],   
                        'isSpecial_Fee' => $logedIn['spec_info'],
                        'isdeaf' => $isdeaf,
                        'isboardoperator' => 0  ,
                        'isfeedingallow' => $isfeeding   ,
                        'isinterfeeding' => $isinterfeeding ,
                        'lastdate' => $lastdate ,  
                        'appconfig' => $appConfig,
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
        $this->clear_cache();
        $this->session->sess_destroy();
        redirect('login');
    }

}                          