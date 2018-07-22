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
	
	if ($_POST){
		
		header("content-type: application/x-javascript; charset=utf-8");
		
		$success = false;
		if($user->checkUser() != "" or 
			$_POST["cmd"]  == "loginUser"){				
			try{
				$db->beginTransaction();
		
				call_user_func("MB_".$_POST["cmd"], Encryption::SQLInjection($_POST));

				$success = true;
				$db->commit();
			}catch(Exception $ex){
				$db->rollback();
				$success = false;
				$msg = $ex->getMessage();
			}
		}else{
			$msg = $msg_err_session;
		}
		
		if($success)
			echo "true".chr(31).$msg.chr(31).$id;
		else
			echo "false".chr(31).$msg;
	}
	
	function MB_loginUser($param){
		$obj = new User();
		if(!$obj->login($param))
			throw new Exception(($obj->err != "" ? $obj->err : $GLOBALS["msg_err"]));
		$GLOBALS["msg"] = $obj->getUserType();
	}
	
	function MB_resetPassword($param){
		$obj = new User();
		if(!$obj->resetPassword($param))
			throw new Exception(($obj->err != "" ? $obj->err : $GLOBALS["msg_err"]));
		$GLOBALS["msg"] = $GLOBALS["msg_reset_password"];
	}
	
	function MB_updateUserAccountInfo($param){
		$obj = new User();
		if(!$obj->changePassword($param))
			throw new Exception(($obj->err != "" ? $obj->err : $GLOBALS["msg_err"]));
		$GLOBALS["msg"] = $GLOBALS["msg_save"];
	}
	
?>