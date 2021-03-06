<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{   
    function __construct()
    {        
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login');
        }
    }
    public function index()
    {
        //DebugBreak();

        $this->load->helper('url');
        $data = array(
            'isselected' => '11',
        );
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];

        

        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('dashboard/dashboard.php');
        $this->load->view('common/footer.php');
    }
    public function getstats()
    {

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->model('Dashboard_model');
        $data = $this->Dashboard_model->getInstInfo($userinfo['Inst_Id']);
        $grading_data = $this->Dashboard_model->getInstgrading($userinfo['Inst_Id']);
        $stats =  array();
        $crntyear = date('Y')-1; 
        $stats['iyear'][]  = $crntyear;
        $stats['iyear'][]  = $crntyear-1;
        $stats['iyear'][]  = $crntyear-2;
        $stats['iyear'][]  = $crntyear-3;
        $stats['iyear'][]  = $crntyear-4;
        $regs = '';
        $readm = '';
        $adm2 = '';
        $adm1 = '';
        $supplyadm = '';
        $grading = array();
        $isexist = 0;
         
        $isgradingexist = 0;
        //DebugBreak();
        $crntyear = date('Y')-5;
        for($i = 0 ; $i<2;  $i++)
        {
            $isexist = 0;
            for($j =0 ; $j<count( $data) ;  $j++)
            {

                if( $stats['iyear'][$i] == $data[$j]['iyear'])
                {
                    $regs[]   =  $data[$j]['RegCount'];
                    $readm[]  =  $data[$j]['ReAdm'];
                    $adm2[]   =  $data[$j]['Adm2'];
                    $adm1[]   =  $data[$j]['Adm1'];
                    $supplyadm[] =  $data[$j]['Adms2'];
                    $isexist =  1;
                } 
            }
            if($isexist ==  0)
            {
                $regs[]   =  0;
                $readm[]  =  0;
                $adm2[]   =  0;
                $adm1[]   =  0;
                $supplyadm[] =  0; 
            }
          
        }
        
        for($i = 0 ; $i<count($stats['iyear']);  $i++)
        {
            $isgradingexist = 0;
            
            for($j =0 ; $j<count( $grading_data) ;  $j++)
            {
                if($crntyear == $grading_data[$j]['iyear'])
                {
                   
                    $stats['grading'][] =  floatval($grading_data[$j]['Ranking_Score']);
                    $isgradingexist =  1;
                } 
            }
            if($isgradingexist ==  0)
            {
                $stats['grading'][] =  floatval(0); 
            }
             $crntyear++;
        }
        
        
        $stats['states'][] = array('name'=>'Regsitration', "data"=> $regs);
        $stats['states'][] = array('name'=>'Re-Admission', "data"=> $readm);
        $stats['states'][] = array('name'=>'11th Admission', "data"=> $adm1);
        $stats['states'][] = array('name'=>'12th Admission', "data"=> $adm2);
        $stats['states'][] = array('name'=>'Supply Admission', "data"=>$supplyadm);
       // $stats['grading'] = $grading;
      
       // DebugBreak();
        
        
        echo json_encode($stats) ;
    }
}