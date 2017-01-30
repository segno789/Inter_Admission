<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); 
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b');
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('BARCODE_PATH', 'assets/pdfs/');


define('noimage','assets/img/no_image.jpg'); 

define('DIRPATH12TH','D:\xampp\htdocs\Share Images\\'); 
define('PRIVATE_IMAGE_PATH', 'uploads/private/');
define('PRIVATE_IMAGE_PATH_FRESH', 'uploads/Fresh');
define('REGULAR_IMAGE_PATH', 'uploads/regular/');

define('REGULAR_INSERT_TABLE', 'Admission_online..IAAdm');

define('Session','1');
define('Year','2017');  
define('lastdate','13-02-2017');
define('GET_REGULAR_IMAGE_PATH', 'D:/xampp/htdocs/Inter_Admission\uplaods\2016\Regular\\');
define('GET_PRIVATE_IMAGE_PATH', 'D:\xampp\htdocs\Inter_Admission\uplaods\2016\private\\');
define('GET_PRIVATE_IMAGE_PATH_COPY', '');

define('DIRPATH11th','F:/xampp/htdocs/Inter_Admission/Uploads/IS2016/regular/'); 


define('Insert_sp_Languages','Admission_online..ISAdm2016_sp_insert_LANGUAGES'); // for insertion Inter supply private
define('Insert_sp_matric_annual','Admission_online..MA_P1_Reg_Adm2016_sp_insert'); // for insertion matric Annual
define('formprint_sp','Admission_online..sp_form_data_11th');    // for selection matric supply

define('formprint_sp_12th','admission_online..sp_form_data_12th');    // for form data of 12th class
define('INSERT_TBL','Admission_online..IAAdm'); 


define('formprint_sp_Languages','Admission_online..sp_form_data_11th_Languages');    // for selection matric supply
define('formprint_sp_matric_annual','Admission_online..sp_form_data');    // for selection matric Annual
define('formnovalid','600000');
define('formnovalid_Languages','400000');
define('return_pdf_isPicture','1');
define('CURRENT_SESS','2017');
define('corr_bank_chall_class','INTER ANNUAL');
define('session_year','2017');
define('TITLEHSSC','Online HSSC Annual Admission 2017');

define('currdate','date("d-m-Y");');
define('TripleDateFeeinter', '13-10-2017');

define('SingleDateFee', '13-02-2017');
define('DoubleDateFee', '27-02-2017');
define('TripleDateFee', '07-03-2017');

define ('class_for_11th_Adm','11th');                                

define('getinfo','admission_online..sp_Admission_HSSC_Annual');

define('Insert_sp','admission_online..sp_insert_IAAdm');

define('getinfo_languages','admission_online..tblAdmissionDataLang');
define('save_dir','D:/xampp/htdocs/Inter_Admission/Uploads/IS2016/regular/');

define('corr_bank_chall_class1','12th');
define('CURRENT_SESS1','2017'); 

define('formprint_sp_11th','Registration..sp_form_data_11thAdm');
define('class_for_9th_Adm','11th');