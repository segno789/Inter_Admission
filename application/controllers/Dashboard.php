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
        $this->load->helper('url');
        $data = array(
            'isselected' => '1',
        );
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];

        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('dashboard/dashboard.php');
        $this->load->view('common/footer.php');
    }
}