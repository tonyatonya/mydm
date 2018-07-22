<?php

session_start();
require_once "initapp.php";
//require_once "sendmail.php";

Class User
{
	//--------------------------------------------------------------------------------------------------------
// Configuration
//--------------------------------------------------------------------------------------------------------
	private $app_name;
	var $db;
	var $err;
	var $data;
//--------------------------------------------------------------------------------------------------------
// Functions
//--------------------------------------------------------------------------------------------------------
	public function __construct()
	{
		$this->app_name = $GLOBALS["APP_NAME"];
		$this->db = $GLOBALS["db"];
	}

	public function __destruct()
	{
	}

	public function load()
	{
		$db = $this->db;
		$sql = "select *
						from m_user where username = '" . $_SESSION[$this->app_name . "_username"] . "' ";
		if (!$db->execute($sql))
			return false;
		if ($db->read()) {
			$this->data = $db->result;
			return true;
		} else
			return false;
	}

	public function keep_login($u_id,$u_login, $u_name, $u_email, $usertype)
	{
		$_SESSION["u_id"] = $u_id;
		$_SESSION["u_login"] = $u_login;
//		$_SESSION["u_password"] = $u_password;
		$_SESSION["u_name"] = $u_name;
		$_SESSION["u_email"] = $u_email;
		$_SESSION["usertype"] = $usertype;
	}

	public function checkUser()
	{
		$db = $this->db;
		$result = "";
		if ($this->is_set()) {
			$db->execute("select * from m_user  where username = '" . $this->getUser() . "' and password = '" . $this->getPassword() . "' and status='Active' ");
			if ($db->read()) {
				if ($db->result[user_type] == $this->getUserType())
					$result = $db->result[user_type];
			}
		}
		return $result;
	}


	public function edit(&$param)
	{
		$db = $this->db;

		if ($param[name] == "")
			$this->err = "Please fill in a name";
		else if ($param[surname] == "")
			$this->err = "Please fill in a surname";
		else if ($param[email] == "")
			$this->err = "Please fill in an email";
		else if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $param[email]))
			$this->err = "Invalid email address";

		if ($this->err != "")
			return false;

		$sql = "update m_user set
						name = '" . trim($param['name']) . "',
						surname = '" . trim($param['surname']) . "',
						email = '" . trim($param['email']) . "',
						updated_time = NOW()
						where username = '" . $this->getUser() . "' ";
		$result = $db->executeNonQuery($sql);
		return $result;
	}


	public function changePassword(&$param)
	{
		$db = $this->db;

		if (md5($param[old_password]) != $this->getPassword()) {
			$this->err = "รหัสผ่านเก่าไม่ถูกต้อง";
			return false;
		} else if ($param[new_password] != $param[confirm_password]) {
			$this->err = "รหัสผ่านใหม่ที่กรอก ไม่ตรงกัน";
			return false;
		}

		$sql = "update m_user set
						password = '" . md5($param['new_password']) . "',
						updated_time = NOW()
						where username = '" . $this->getUser() . "' ";
		if (!$db->executeNonQuery($sql)) {
			$this->err = $sql;
			return false;
		}

		$this->setData("password", md5($param['new_password']));
		return true;
	}

	public function login(&$param, $user_type)
	{
		$db = $this->db;

		$sql = "select * from sto_user  where u_login = '" . $param['u_login'] . "' and u_password = '" . md5($param['u_password']) . "' ";
		$db->execute($sql);
		if (!$db->read()) {
			$this->err = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
			return false;
		} else {

			if ($db->result['status'] != "Active") {
				$this->err = "Username นี้ไม่เปิดให้ใช้งาน กรุณาติดต่อเรา";
				return false;
			}

//			if ($user_type != "" and $user_type != $db->result['usertype']) {
//				$this->err = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
//				return false;
//			}

			$this->keep_login($db->result['u_id'],$db->result['u_login'] ,$db->result['u_name'], $db->result['u_email'], $db->result['usertype']);

			$sql = "update sto_user set last_access_time = NOW() where u_login = '" . $param['u_login'] . "' ";
			if (!$db->execute($sql))
				return false;

			$result = true;
		}
		return $result;
	}

	public function resetPassword(&$param)
	{
		$db = $this->db;
		if ($param["username"] == "") {
			$this->err = "กรุณาระบุ Username";
			return false;
		}

		$sql = "select * from m_user where username ='" . $param["username"] . "' ";
		$db->execute($sql);
		if (!$db->read()) {
			$this->err = "ไม่พบ Username นี้ในระบบ";
			return false;
		}

		$pass = Encryption::random_gen(8);
		$name = $db->result[name] . " " . $db->result[surname];
		$email = $db->result[email];

		$sql = "update m_user set password='" . md5($pass) . "' where username ='" . $param["username"] . "' ";
		if (!$db->execute($sql)) {
			return false;
		}

		sendMailForgotPassword($email, $name, $pass);

		return true;
	}

	public function getUser()
	{
		return $_SESSION[$this->app_name . "_username"];
	}

	public function getUserType()
	{
		return $_SESSION[$this->app_name . "_usertype"];
	}

	public function getEmail()
	{
		return $_SESSION[$this->app_name . "_email"];
	}

	public function getPassword()
	{
		return $_SESSION[$this->app_name . "_password"];
	}

	public function getCompanyID()
	{
		return $_SESSION[$this->app_name . "_company_id"];
	}

	public function getName()
	{
		return $_SESSION[$this->app_name . "_name"];
	}

	public function getData($ref_name)
	{
		return $_SESSION[$this->app_name . "_" . $ref_name];
	}

	public function setData($ref_name, $value)
	{
		$_SESSION[$this->app_name . "_" . $ref_name] = $value;
	}

	public function is_set()
	{
		if (!isset($_SESSION[$this->app_name . "_username"]) or !isset($_SESSION[$this->app_name . "_password"]))
			return false;
		else
			return true;
	}
}