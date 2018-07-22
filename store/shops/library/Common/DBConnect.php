<?php

Class DBConnect extends PDO {
	var $num_fields;
	var $num_rows;
	var $index;
	var $result;
	var $stmt;
	var $columns;
	var $err;
	
	public function __construct($db_type="MySQL",$db_host="localhost",$db_user="",$db_pass="",$db_name="",$db_encoding="utf8") {
		try {
			if ($db_type == "MySQL") {
				parent::__construct("mysql:host=" .$db_host. "; dbname=".$db_name, $db_user, $db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names ".$db_encoding));
			}elseif ($db_type == "SQLite"){
				parent::__construct("sqlite:db/sqlite_file");
			}elseif ($db_type == "MSSQL"){
				parent::__construct("dblib:host=" .$db_host. ";dbname=".$db_name,$db_user,$db_pass);
			}elseif ($db_type == "ODBC"){
				parent::__construct("odbc:DSN=".$db_host.";DATABASE=".$db_name.";",$db_user,$db_pass);
			}
			parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function __destruct(){
		$this->stmt = null;
	}
	
	public function clear(){
		$this->stmt = null;
	}

	public function executeNonQuery($sql){
		try{
			$this->stmt = null;
			$this->exec($sql);
			return true;
		}catch (PDOException $err){
			$this->err = $err;
			$this->result = $this->printError();
			echo $this->printError();
			return false;
		}
	}

	public function execute($sql){
		try{
			$this->stmt = null;
			$this->result = null;
			$this->stmt = $this->query($sql);
			$this->num_fields = $this->stmt->columnCount();
			return true;
		}
		catch(PDOException $err)
		{
			$this->result = $this->printError();
			echo $this->printError();
			$this->stmt = null;
			$this->num_fields = 0;
			return false;
		}
	}

	public function read(){
		try{
			if(isset($this->stmt)){
				if($rows = $this->stmt->fetch(PDO::FETCH_ASSOC)){
					$this->result  = $rows;
					return true;
				}
			}
		}
		catch(Exception $e){print  $e->getMessage();}
		return false;	
	}

	function getColumnNames(){     
		$this->columns = array_keys($this->result);
		return $this->columns;	
	}
	
	function printError(){
		$err = $this->err;
		$trace = '<table border="0" >';
		foreach ($err->getTrace() as $a => $b) {
			foreach ($b as $c => $d) {
				if ($c == 'args') {
					foreach ($d as $e => $f) {
						$trace .= '<tr><td><b>' . strval($a) . '#</b></td><td align="right"><u>args:</u></td> <td><u>' . $e . '</u>:</td><td><i>' . $f . '</i></td></tr>';
					}
				} else {
					$trace .= '<tr><td><b>' . strval($a) . '#</b></td><td align="right"><u>' . $c . '</u>:</td><td></td><td><i>' . $d . '</i></td>';
				}
			}
		}
		$trace .= '</table>';
		return '<br /><br /><br /><font face="Verdana"><center><fieldset style="width: 66%; border: 4px solid white; background: grey;"><legend><b>[</b>PHP PDO Error ' . strval($err->getCode()) . '<b>]</b></legend> <table border="0"><tr><td align="right"><b><u>Message:</u></b></td><td><i>' . $err->getMessage() . '</i></td></tr><tr><td align="right"><b><u>Code:</u></b></td><td><i>' . strval($err->getCode()) . '</i></td></tr><tr><td align="right"><b><u>File:</u></b></td><td><i>' . $err->getFile() . '</i></td></tr><tr><td align="right"><b><u>Line:</u></b></td><td><i>' . strval($err->getLine()) . '</i></td></tr><tr><td align="right"><b><u>Trace:</u></b></td><td><br /><br />' . $trace . '</td></tr></table></fieldset></center></font><br /><br />';
	}
}
?>