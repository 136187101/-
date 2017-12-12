<?php
class Database{	
	/**
	 * 数据库的地址
	 * @param dbhost
	 **/
	var $dbhost;
	/**
	 * 数据库的用户名
	 * @param dbuser
	 * */						
	var $dbuser;	
	/**
	 * 数据库的密码
	 * @param dbpwd
	 * */					
	var $dbpwd;
	/**
	 * 数据库的名称
	 * @param dbname
	 * */
	var $dbname;
	/**
	 * 连接方式
	 * @param pconnect
	 * */
	var $pconnect = 0;
	/**
	 * 执行的编码
	 * @param dbcharset
	 * */
	var $dbcharset = 'utf8';
	/**
	 * 数据库的连接
	 * @param link
	 * */
	var $link;
	/**
	 * 执行的SQL语句
	 * @param dbcharset
	 * */
	var $sql;
	/**
	 * 构造方法
	 * @param dbhost
	 * @param dbuser
	 * @param dbpwd
	 * @param dbname
	 * @return void
	 * */
	function Database($dbhost,$dbuser,$dbpwd,$dbname){
		$this->dbhost = $dbhost;
		$this->dbuser = $dbuser;
		$this->dbpwd = $dbpwd;
		$this->dbname =$dbname;
		$this->connect();
	}
	/**
	 * 连接数据库的方法
	 * @return void
	 * */
	function connect(){
		if($this->pconnect){
			$this->link = @mysql_pconnect($this->dbhost,$this->dbuser,$this->dbpwd);
		}else{
			$this->link = @mysql_connect($this->dbhost,$this->dbuser,$this->dbpwd);
		}
		if(mysql_errno()){
			$this->Err(mysql_errno().":".mysql_error());
		}
		
		if($this->server_info() > '4.1' && $this->dbcharset){
			mysql_query("set names $this->dbcharset");	
		}
		if(!mysql_select_db($this->dbname)){
			$this->Err(mysql_errno().":".mysql_error());
		}
	}
	/**
	 * 执行方法
	 * @return string
	 * */
	function query(){
	$result = mysql_query($this->sql);
		//return $result;
	if(!$result){
			$this->Err("ERROR&nbsp;:$this->sql;&nbsp;信息有误，请谅解！");//$this->sql
		}else{
			return $result;
		}
	}
	 /**
	 * 设置SQL语句
	 * @param sql
	 * */
	function setQuery( $sql , $start=null , $limit = null){
		if($limit){
			$this->sql = $sql . " limit $start,$limit";
		}else{
			$this->sql = $sql;
		}
	}
	 /**
	 * 直接读取结果
	 * @return string
	 * */
	function loadResult(){
		$rt = $this->query();
		$rs = mysql_fetch_row($rt);
		return $rs[0];
	}
	 /**
	 * 读取一条数据
	 * @return object
	 * */
	function loadobject(){
		$rt = $this->query();
		$rs = mysql_fetch_object($rt);
		return $rs;
	}
	 /**
	 * 读取一组数据
	 * @return array
	 * */
	function loadobjectlist(){
		$rt = $this->query();
		while($rs = mysql_fetch_object($rt)){
			$row[] = $rs;
		}
		if(@is_array($row)) return $row;
		return array();
	}
	/**
	* 读取一个二维数组
	* @return array
	* */
	function loadarraylist(){
		$rt = $this->query();
		while($item = mysql_fetch_array($rt,MYSQL_ASSOC)){
			$rs[] = $item;
		}
		if(is_array($rs)){
			return $rs;
		}else{
			return array();
		}
	}	
	/**
	 * 获取数据行数
	 * @return string
	 * */
	function num_rows(){
		return mysql_num_rows($this->query());
	}
	function liwqid($id){
	$rt = $this->query();
	$id = "=$id";
	while($rs = mysql_fetch_object($rt,$id)){
			$row[] = $rs;
		}
		if(is_array($row)) return $row;
		return array();
	}
	/**
	 * 获取刚入库的ID
	 * @return string
	 * */
	function insert_id() {
		$id = mysql_insert_id();
		return $id;
	}
	 /**
	 * 测试数据库版本
	 * @return string
	 * */
	function server_info(){
		return mysql_get_server_info();
	}	
	/**
	 * 容错信息
	 * @param msg
	 * @return obj
	 * */
	function Err( $msg ){
		new DB_Error( $msg );
		exit;
	}
	/**
	 * 析构方法
	 * */
	function __destruct(){
		@mysql_close($this->link);
	}
}
class DB_Error{
function DB_Error( $msg ){
		echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<table width='500' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#999900'>
			  <tr>
				<td align='center' valign='middle' height='80'><p><font color='#FF0000'>{$msg}</font></p></td>
			  </tr>
			</table>";
	}
}
?>
