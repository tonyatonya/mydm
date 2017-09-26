<?
error_reporting(E_WARNING);

class DBModule {
//--------------------------------------------------------------------------------------------------------
// Configuration
//--------------------------------------------------------------------------------------------------------
	var $objConnect;
	var $objDB;
	var $dbquery;
	var $num_rows;
	var $num_fields;
	var $index;
	var $result;
	var $columns;
	var $column_types;
//--------------------------------------------------------------------------------------------------------
// Functions
//--------------------------------------------------------------------------------------------------------

	function __construct($db_host="localhost",$db_user="",$db_pass="",$db_name="",$db_encoding="TIS620") {
		$this->objConnect = mysql_connect($db_host,$db_user,$db_pass) or die("Error Connect to Database");
		$this->objDB = mysql_select_db($db_name);
		mysql_query("SET NAMES ".$db_encoding);
	}

//	function __destruct() {
//			mysql_close($this->objConnect);
//	}

	function execute($sql){
		try{
			$this->index = 0;
			$this->result = null;
			$this->dbquery = mysql_query($sql,$this->objConnect); 
			if(!$this->dbquery)
				throw new Exception("SQL Syntax Error");
			$this->num_rows = mysql_num_rows($this->dbquery);
			$this->num_fields = mysql_num_fields($this->dbquery);
			$i = 0;
			$this->columns = array();
			$this->column_types = array();
			while ($i < $this->num_fields) {
				$meta = mysql_fetch_field($this->dbquery, $i);
				$this->columns[] = $meta->name;
				$this->column_types[] = $meta->type;
				$i++;
			}

			if(!$this->num_rows or !$this->num_fields)
				throw new Exception("Record not found");
		}
		catch(Exception $e)
		{
			$this->num_rows = 0;
			$this->num_fields = 0;
		}
	}

	function getTableColumns($table){		
		$result = mysql_query("SHOW FIELDS FROM ".$table,$this->objConnect);
		$columns = array();
		while ($row= mysql_fetch_array($result )) {
			$cols = array();
			$cols["Field"] = $row[Field];
			$cols["Type"] = $row[Type];
			$columns[] = $cols;
		}
		return $columns;
	}
	
	function eof(){
		if($this->index < $this->num_rows)
			return false;
		else
			return true;
	}

	function read(){
		if($this->eof() == false){
			$this->index++;
			$this->result = mysql_fetch_array($this->dbquery);
			return true;
		}
		else
			return false;
	}

	function get_data($field){
		if($this->eof() == false){
			$rs = mysql_fetch_array($this->dbquery);
			return $rs[$field];
		}
		else
			return null;
	}

	function executeData($sql){
		$this->execute($sql);
		if($this->eof() == false){
			$rs = mysql_fetch_array($this->dbquery);
			return $rs[0];
		}
		else
			return "";
	}

	function executeNonQuery($sql,$ForceAffected=False){
		try{
			$result = mysql_query($sql,$this->objConnect); 
			if(!$result) return false;
			if($ForceAffected and mysql_affected_rows($this->objConnect) <= 0) return false;
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	function beginTrans(){
		mysql_query("START TRANSACTION",$this->objConnect);
	}
	
	function commitTrans(){
		mysql_query("COMMIT",$this->objConnect);
	}
	
	function rollbackTrans(){
		mysql_query("ROLLBACK",$this->objConnect);
	}
 }
?>