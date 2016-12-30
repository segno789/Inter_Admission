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
define('BARCODE_PATH', 'assets/pdfs/');


define('DIRPATH12TH','D:\xampp\htdocs\Share Images\\'); 
define('PRIVATE_IMAGE_PATH', 'uploads/private/');
define('PRIVATE_IMAGE_PATH_FRESH', 'uploads/Fresh');
define('REGULAR_IMAGE_PATH', 'uploads/regular/');
define('Session','1');  // 1 for Annual and 2 for Supply
define('Year','2017');  
define('lastdate','30-01-2017');
define('GET_PRIVATE_IMAGE_PATH', 'D:\xampp\htdocs\Inter_Admission\Uploads\2016\private\\');
define('GET_PRIVATE_IMAGE_PATH_COPY', '');
define('DIRPATH11th','D:/xampp/htdocs/Inter_Admission/Uploads/IS2016/regular/2510010001.jpg');
define('DIRPATH11th','D:/xampp/htdocs/Inter_Admission/Uploads/IS2016/regular/'); 
define('DIRPATH11th','D:/xampp/htdocs/Inter_Admission/Uploads/IS2016/regular/2510010001.jpg'); 

define('Insert_sp_Languages','Admission_online..ISAdm2016_sp_insert_LANGUAGES'); // for insertion Inter supply private
define('Insert_sp_matric_annual','Admission_online..MA_P1_Reg_Adm2016_sp_insert'); // for insertion matric Annual
define('formprint_sp','Admission_online..sp_form_data_11th');    // for selection matric supply

define('formprint_sp_12th','admission_online..sp_form_data_12th');    // for form data of 12th class

define('formprint_sp_Languages','Admission_online..sp_form_data_11th_Languages');    // for selection matric supply
define('formprint_sp_matric_annual','Admission_online..sp_form_data');    // for selection matric Annual
define('formnovalid','600000');
define('formnovalid_Languages','400000');
define('return_pdf_isPicture','1');
define('CURRENT_SESS','2017-2019');
define('corr_bank_chall_class','INTER SUPPLY');
define('session_year','2017-2019');
define('TITLEHSSC','Online HSSC Annual Admission 2017');
//define('SingleDateFee11th','03-10-2016');
define('currdate','date("d-m-Y");');
define('TripleDateFeeinter', '13-10-2016');define ('class_for_11th_Adm','11th');                                
define('getinfo','admission_online..tblAdmissionDataForHSSC');
define('getinfo_languages','admission_online..tblAdmissionDataLang');


define('CURRENT_SESS1','2016'); 
define('corr_bank_chall_class1','12th');
define('CURRENT_SESS1','2017'); 

define('formprint_sp_11th','Registration..sp_form_data_11thAdm');    // for selection 9th Annual
define('class_for_9th_Adm','11th');

//===============10TH Regular Admission Matric challan varaible
define('corr_bank_chall_class1','12th');
define('CURRENT_SESS1','2016'); 