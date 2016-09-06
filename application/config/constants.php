<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('PRIVATE_IMAGE_PATH', 'uploads/2016/private/');
define('REGULAR_IMAGE_PATH', 'uploads/2016/regular/');
define('Session','2');  // 1 for Annual and 2 for Supply
define('Year','2016');  
define('lastdate','20-08-2016');
define('GET_PRIVATE_IMAGE_PATH', '');
define('GET_PRIVATE_IMAGE_PATH_COPY', '');


define('Insert_sp','Admission_online..ISAdm2016_sp_insert'); // for insertion Inter supply private
define('Insert_sp_matric_annual','Admission_online..MA_P1_Reg_Adm2016_sp_insert'); // for insertion matric Annual
define('formprint_sp','Admission_online..sp_form_data_11th');    // for selection matric supply
define('formprint_sp_matric_annual','Admission_online..sp_form_data');    // for selection matric Annual
define('formnovalid','600000');
define('return_pdf_isPicture','1');
define('CURRENT_SESS','2016-2018');



define('currdate','date("d-m-Y");');
define ('SingleDateFee','03-07-2016');
define('DoubleDateFee', '20-07-2016');
define('TripleDateFee', '30-07-2016');
                                
define('getinfo','admission_online..tblAdmissionDataForHSSC');


//===============10TH Regular Admission Matric challan varaible
define('corr_bank_chall_class1','10th');
define('CURRENT_SESS1','2016-2018'); 



