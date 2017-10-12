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


//define('REGULAR_INSERT_TABLE', 'Admission_online..IAAdm');
define('REGULAR_INSERT_TABLE', 'Admission_online..ISAdm');
define('DIRPATH12TH','F:\xampp\htdocs\Share Images\\'); 
define('PRIVATE_IMAGE_PATH', 'uploads/private/');
define('PRIVATE_IMAGE_PATH_FRESH', 'uploads/Fresh');
define('REGULAR_IMAGE_PATH', 'uploads/regular/');
define('Session','2');  // 1 for Annual and 2 for Supply
define('Year','2017');  

define ('sessReg','2017-2019');
define('Regtbl','Registration..tblreg11th');
define('Feetbl','Registration..RuleFee_Reg_Eleventh');
define('Batchtbl','Registration..tblregbatch11th');

define('lastdate','15-09-2017');
define('GET_PRIVATE_IMAGE_PATH', 'C:\inetpub\vhosts\bisegrw.com\hssc.bisegrw.com\uplaods\2016\private\\');
define('GET_PRIVATE_IMAGE_PATH_COPY', '');
//define('DIRPATH11th','D:/xampp/htdocs/Inter_Admission/Uploads/IS2016/regular/2510010001.jpg');
define('DIRPATH11th','C:\inetpub\vhosts\bisegrw.com\registration.bisegrw.com\uploads\2016\colleges\\'); 
//define('DIRPATH11th','D:/xampp/htdocs/Inter_Admission/Uploads/IS2016/regular/2510010001.jpg'); 

define('DIRPATHOTHER','C:\inetpub\vhosts\bisegrw.com\registration.bisegrw.com\uploads\other12'); 


define('Insert_sp_Languages','Admission_online..ISAdm2016_sp_insert_LANGUAGES'); // for insertion Inter supply private
define('Insert_sp_matric_annual','Admission_online..MA_P1_Reg_Adm2016_sp_insert'); // for insertion matric Annual
define('formprint_sp','Admission_online..sp_form_data_11th');    // for selection matric supply



define('formprint_sp_Languages','Admission_online..sp_form_data_11th_Languages');    // for selection matric supply
define('formprint_sp_matric_annual','Admission_online..sp_form_data');    // for selection matric Annual
define('formnovalid','600000');
define('formnovalid_Languages','400000');
define('return_pdf_isPicture','1');
define('CURRENT_SESS','2017-2019');
define('corr_bank_chall_class','INTER ANNUAL');
define('session_year','2017-2019');
define('TITLEHSSC','Online HSSC Annual Admission 2017');
define('corr_bank_chall_class11','11th');

//----------------INTER ADMISSIONS 12TH ------------------------------
define('currdate','date("d-m-Y");');
define('TripleDateFeeinter', '13-10-2017');
define('RE_ADMISSION_TBL11', 'matric_new..vwIA1P17');

define('SingleDateFee', '2017-09-27');
define('DoubleDateFee', '2017-10-03');
define('TripleDateFee', '2017-10-06');
define('getinfo','admission_online..sp_Admission_HSSC');
define('Insert_sp','admission_online..sp_insert_ISAdm');
define('INSERT_TBL','Admission_online..ISAdm'); 
define ('class_for_11th_Adm','11th');             
define('formprint_sp_12th','admission_online..sp_form_data_12th');      
define('getinfo_languages','admission_online..tblAdmissionDataLang');
define('save_dir','D:/xampp/htdocs/Inter_Admission/Uploads/IS2016/regular/');

define('corr_bank_chall_class1','12th');
define('CURRENT_SESS1','2017'); 

define('formprint_sp_11th','Registration..sp_form_data_11thAdm');
define('class_for_9th_Adm','11th');



//========================11th Registration===================================
define('IMAGE_PATH11', 'uplaods/2017/reg/');
define('IMAGE_PATH211', 'uplaods/2016_backup/');
define('BARCODE_PATH11', 'uplaods/pdfs/');
define('SINGLE_LAST_DATE11', '2017-08-14');
define('DOUBLE_LAST_DATE11', '2017-06-12');
define('SINGLE_LAST_DATE', '2017-09-15');
define('DOUBLE_LAST_DATE', '2017-10-05');
define('assets', 'assets/img/');
define('CORR_IMAGE_PATH11', 'uploads/correction/colleges/');
define('Correction_Last_Date11','2017-12-30');
//================ RollNumber Slips variables ========================
define('mClass1','12'); 
define('mSession','1'); 
define('mSession1','1'); 
define('mClass2','11'); 
define('mYear','2017'); 
define('PVT_TITLE_INTER','Download Roll Number Slip For H.S.S.C Annual 2017'); 


//================ Result Cards ========================

define('SESS', '1');
define('SESSION', '1');
define('MCLASS', '12');
define('MYEAR', '2017');



