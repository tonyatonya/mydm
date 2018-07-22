<?php

session_start();
require_once "initapp.php";

Class Company {
	
	var $db;
	var $id;
	var $user;
	var $data;
	var $err;
	
	public function __construct() {
		$this->db = $GLOBALS["db"];
		$this->id = $GLOBALS["user"]->getCompanyID();
		$this->user = $GLOBALS["user"]->getUser();
	}

	public function __destruct(){}
	
	public function load(){
		$db = $this->db;
		$sql = "select *,left(NOW(),10) date_today, NOW() as time_now, 20 as per_page 
					from m_companies where id = '".$this->id."' ";
		if(!$db->execute($sql))
			return false;
		if($db->read()){
			$this->data = $db->result;
			return true;
		}else
			return false;
	}
	
	public function update($param){
		$db = $this->db;
			
		$sql = "update m_companies set 
					name = '".$param['name']."',
					address_no = '".$param['address_no']."',
					district = '".$param['district']."',
					city = '".$param['city']."',
					province = '".$param['province']."',
					postcode = '".$param['postcode']."',
					phone_no = '".$param['phone_no']."',
					fax_no = '".$param['fax_no']."',
					mobile_no = '".$param['mobile_no']."',
					email = '".$param['email']."',
					remark = '".$param['remark']."',
					company_type = '".$param['company_type']."'
					where id = '".$this->id."' ";
		if(!$db->executeNonQuery($sql)){
			return false;
		}
		
		return true;
	}
}
?>