<?php
//!function_exists('readover') && exit('Forbidden');
class DB {
	var $query_num = 0;

	function DB($hostName, $userName, $passwd, $dbName, $pconnect = 0) {
		$this->connect($hostName, $userName, $passwd, $dbName, $pconnect);
	}
	function connect($hostName, $userName, $passwd, $dbName, $pconnect = 0) {
		$pconnect==0 ? @mysql_connect($hostName, $userName, $passwd) : @mysql_pconnect($dbhost, $dbuser, $dbpw);
		//mysql_errno()!=0 && $this->halt("Connect($pconnect) to MySQL ($dbhost,$dbuser) failed");
		if($this->server_info() > '4.1' && $GLOBALS['charset']){
			mysql_query("SET NAMES '".$GLOBALS['charset']."'");
		}
		if($this->server_info() > '5.0'){
			mysql_query("SET sql_mode=''");
		}
		if($dbname) {
			if (!@mysql_select_db($dbname)){
				//$this->halt('Cannot use database '.$dbname);
			}
		}
	}
	function close() {
		return mysql_close();
	}
	function select_db($dbname){
		if (!@mysql_select_db($dbname)){
			//$this->halt('Cannot use database '.$dbname);
		}
	}
	function server_info(){
		return mysql_get_server_info();
	}
	function query($SQL,$method='') {
		$GLOBALS['PW']=='pw_' or $SQL=str_replace('pw_',$GLOBALS['PW'],$SQL);
		if($method=='U_B' && function_exists('mysql_unbuffered_query')){
			$query = mysql_unbuffered_query($SQL);
		}else{
			$query = mysql_query($SQL);
		}
		$this->query_num++;
		
		//echo $SQL.'<br>'.$this->query_num.'<br>';
		//if (!$query)  $this->halt('Query Error: ' . $SQL);
		return $query;
	}

	function get_one($SQL){

		$query=$this->query($SQL,'U_B');
		
		$rs =& mysql_fetch_array($query, MYSQL_ASSOC);

		return $rs;
	}

	function pw_update($SQL_1,$SQL_2,$SQL_3){
		$rt=$this->get_one($SQL_1);
		if($rt){
			$this->update($SQL_2);
		} else{
			$this->update($SQL_3);
		}
	}

	function update($SQL) {
		$query = mysql_query($SQL);
		$this->query_num++;
		return $query;
	}

	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($query, $result_type);
	}

	function affected_rows() {
		return mysql_affected_rows();
	}

	function num_rows($query) {
		$rows = mysql_num_rows($query);
		return $rows;
	}

	function free_result($query) {
		return mysql_free_result($query);
	}

	function insert_id() {
		$id = mysql_insert_id();
		return $id;
	}

	}
	/*function halt($msg='') {
		require_once(R_P.'include/db_mysql_error.php');
		new DB_ERROR($msg);
	}*/

?>