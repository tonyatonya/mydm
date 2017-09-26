<?php
	
	session_start();
	require_once "initapp.php";
	
	$id="";
	$msg = "";
	$msg_err_session = "Your session has been terminated. Please login again !!!";
	$msg_err = "ไม่สามารถทำรายการได้&nbsp;กรุณาตรวจสอบข้อมูล";
	$msg_save = "บันทึกข้อมูลเรียบร้อย";
	$msg_del = "ลบข้อมูลเรียบร้อย";
	$msg_login_success= "เข้าสู่ระบบเรียบร้อย";
	$msg_reset_password= "ดำเนินการตั้งค่ารหัสผ่านใหม่เรียบร้อย กรุณาตรวจสอบอีเมลล์ของคุณ";
	
	$result = array();
	
	if ($_POST){
		
		header("content-type: application/x-javascript; charset=utf-8");
		
		$success = false;
		try{
	
			call_user_func("MB_".$_POST["cmd"], Encryption::SQLInjection($_POST));

			$success = true;
			$result['msgStatus'] = "ok";
			print json_encode($result);
		}catch(Exception $ex){
			$result['msgStatus'] = "error";
			$result['message'] = $ex->getMessage();
			print json_encode($result);
		}
		
	}
	
	function MB_sendEmailContact($param){
		
		$GLOBALS["result"]["msgStatus"] = "Already got your message, we will contact you within 24 hours";
	}

?>