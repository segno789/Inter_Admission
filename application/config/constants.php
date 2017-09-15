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
define('assets', 'assets/img/');

define('noimage','assets/img/no_image.jpg'); 
define('IMAGE_PATH11', 'uploads/2016/');
define('DIRPATH12TH','D:\xampp\htdocs\Share Images\\'); 
define('PRIVATE_IMAGE_PATH', 'uploads/private/');
define('PRIVATE_IMAGE_PATH_FRESH', 'uploads/Fresh');
define('REGULAR_IMAGE_PATH', 'uploads/regular/');

define('REGULAR_INSERT_TABLE', 'admission_online..ISAdm');


//---------------- REGISTRATION 11TH ------------------------------
define ('sessReg','2017-2019');
define('Session','2');
define('Year','2017');
define('Regtbl','Registration..tblreg11th');
define('Feetbl','Registration..RuleFee_Reg_Eleventh');
define('Batchtbl','Registration..tblregbatch11th');
define('lastdate','15-09-2017');
define('SINGLE_LAST_DATE', '2017-09-15');
define('DOUBLE_LAST_DATE', '2017-10-05');
define('GET_REGULAR_IMAGE_PATH', 'F:/xampp/htdocs/Inter_Admission\uplaods\2016\Regular\\');
define('GET_PRIVATE_IMAGE_PATH', 'F:\xampp\htdocs\Inter_Admission\uplaods\2016\private\\');
define('GET_PRIVATE_IMAGE_PATH_COPY', '');
define('SINGLE_LAST_DATE11', '2016-05-15');
define('DIRPATH11th','F:/xampp/htdocs/Inter_Admission/Uploads/IS2016/regular/'); 


define('Insert_sp_Languages','Admission_online..ISAdm2016_sp_insert_LANGUAGES'); // for insertion Inter supply private
define('Insert_sp_matric_annual','Admission_online..MA_P1_Reg_Adm2016_sp_insert'); // for insertion matric Annual
define('formprint_sp','Admission_online..sp_form_data_11th');    // for selection matric supply

define('formprint_sp_Languages','Admission_online..sp_form_data_11th_Languages');    // for selection matric supply
define('formprint_sp_matric_annual','Admission_online..sp_form_data');    // for selection matric Annual
define('formnovalid','600000');
define('formnovalid_Languages','400000');
define('return_pdf_isPicture','1');
define('CURRENT_SESS','2017');
define('corr_bank_chall_class','INTER ANNUAL');
define('session_year','2017');
define('TITLEHSSC','Online HSSC Annual Admission 2017');

//----------------INTER ADMISSIONS 12TH ------------------------------
define('currdate','date("d-m-Y");');
define('TripleDateFeeinter', '13-10-2017');
define('RE_ADMISSION_TBL11', 'matric_new..vwIA1P16');

define('SingleDateFee', '2017-09-27');
define('DoubleDateFee', '2017-10-03');
define('TripleDateFee', '2017-10-06');

define('getinfo','admission_online..sp_Admission_HSSC');
define('Insert_sp','admission_online..sp_insert_ISAdm');
define('INSERT_TBL','admission_online..ISAdm'); 
define ('class_for_11th_Adm','11th');             
define('formprint_sp_12th','admission_online..sp_form_data_12th');      
define('getinfo_languages','admission_online..tblAdmissionDataLang');
define('save_dir','D:/xampp/htdocs/Inter_Admission/Uploads/IS2016/regular/');

define('corr_bank_chall_class1','12th');
define('CURRENT_SESS1','2017'); 

define('formprint_sp_11th','Registration..sp_form_data_11thAdm');
define('class_for_9th_Adm','11th');


//================ RollNumber Slips variables ========================
define('mClass1','12'); 
define('mSession','1'); 
define('mSession1','1'); 
define('mClass2','11'); 
define('mYear','2017'); 
define('PVT_TITLE_INTER','Download Roll Number Slip For H.S.S.C Annual 2017'); 