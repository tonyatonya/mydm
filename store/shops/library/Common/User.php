<?php

	Class User{
//--------------------------------------------------------------------------------------------------------
// Configuration
//--------------------------------------------------------------------------------------------------------
		private $app_name;
//--------------------------------------------------------------------------------------------------------
// Functions
//--------------------------------------------------------------------------------------------------------
		public function __construct($AppName) {
			$this->app_name = $AppName;
		}

		public function __destruct() {}

		public function keep_login($username,$pass,$name,$usertype="",$company_id){
			$_SESSION[$this->app_name."_username"] = $username;
			$_SESSION[$this->app_name."_password"] = $pass;
			$_SESSION[$this->app_name."_name"] = $name;
			$_SESSION[$this->app_name."_usertype"] = $usertype;
			$_SESSION[$this->app_name."_company_id"] = $company_id;
		}

		public function getUser(){
			return $_SESSION[$this->app_name."_username"];
		}
		
		public function getUserType(){
			return $_SESSION[$this->app_name."_usertype"];
		}

		public function getPassword(){
			return $_SESSION[$this->app_name."_password"];
		}
		
		public function getCompanyID(){
			return $_SESSION[$this->app_name."_company_id"];
		}
		
		public function getName(){
			return $_SESSION[$this->app_name."_name"];
		}
		
		public function getData($ref_name){
			return $_SESSION[$this->app_name."_".$ref_name];
		}
		
		public function setPassword($pass){
			$_SESSION[$this->app_name."_password"] = $pass;
		}
		
		public function setData($ref_name,$value){
			$_SESSION[$this->app_name."_".$ref_name] = $value;
		}

		public function is_set(){
			if(!isset($_SESSION[$this->app_name."_username"]) or !isset($_SESSION[$this->app_name."_password"]))
				return false;
			else
				return true;
		}
	}
?>