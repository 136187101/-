<?php
     /**
	  * @ 数据库操作类
	  * @ author:jianghua
	  * @version:0.1
	  */
     class mysql{
	     private $hostName;  //主机名
		 private $userName;  //用户名
		 private $passwd;  //密码
		 private $dbName; //数据库名
		 
		 public function __construct($hostname,$username,$passwd,$dbname){
		     
			     $this->hostName =$hostname;
				 $this->userName =$username;
				 $this->passwd =$passwd;
				 $this->dbName =$dbname;
				 $this->connect();	 
		 }
		 public function connect(){
		    @mysql_connect($this->hostName,$this->userName,$this->passwd) or die('数据库连接失败!');
			if(!mysql_select_db($this->dbName)){
			     die('数据库选择失败!');	
			}
			mysql_query("SET NAMES 'utf8'");
		 
		 }
		 
		 public function query($sql){
		     return mysql_query($sql);		 
		 }
		 public function fetch_nums($result){

			return @mysql_num_rows($result);
			 
		  }
		  
		
	/**
	 * 设置SQL语句
	 * @param sql
	 * */
	 public	function setQuery( $sql , $start=null , $limit = null){
		if($limit){
		return  $this->query($sql . " limit $start,$limit");
		}else{
		return  $this->query($sql);
		}
		}
			  
		 
	/**
	 * 读取一条数据为对象
	 * @return object
	 * */
	 public  function fetch_object($rt){

		return @mysql_fetch_object($rt);
		 
	}
		  
		  
		 //从数据库取一条记录
		 public function getOne($sql){
			 $result = $this->query($sql);
			 
			 $info =@mysql_fetch_assoc($result);
			 if(empty($info)){
			     return false;
			 }
			 return $info;		 
		
		 }
		 //从数据库中取回全部的数据
		 public function getAll($sql){
		    $result =$this->query($sql);
			$num =$this->fetch_nums($result);
			if($num<0){
			    return 0;
			}else{
			   while($info=@mysql_fetch_assoc($result)){
			         $data[] =$info;
			   }
			}
			return $data;	
			
		 }



	/**
	* 读取一个二维数组
	* @return array
	* */
	function fetch_array($rt){
		while($item = mysql_fetch_array($rt,MYSQL_ASSOC)){
			$rs[] = $item;
		}
		if(is_array($rs)){
			return $rs;
		}else{
			return array();
		}
	}










		 /**--------------------------------
		 * @param data array
         * @param $tableName String
		 *  insert 插入数据
		 */
		  function insert($data,$tableName){
			if(empty($data)){
				return false;
			}
			foreach($data as $key=>$val){
					
                $fields .="`$key`".',';
				$fieldsValue .="'$val'".',';
			}
			 $fields      =substr($fields,0,-1);
		     $fieldsValue =substr($fieldsValue,0,-1);
			$sign =$this->query("insert into $tableName($fields)values($fieldsValue)");
			if($sign){
			   return true;
			  }else{
			    return false;
			  }
	       }

		  
            /***
			*-----------------------------------
			* @param $data array
			* @param $tableName string
			* @param $where string
			* update 数据更新
			*-----------------------------------
			*/
		    function update($data,$tableName='',$where){
		     $newValue ='';
			 $where ='where '.$where;
             if(empty($data)){
					return false;
			 }
			 foreach($data as $key=>$val){
					$newValue .= "`$key`".'='."'$val'".',';
			 }
			 $newValue =substr($newValue,0,-1);
			 $sql ="update $tableName SET $newValue $where";
             $status = $this->query($sql);
			 if(!$status){
					return false;
			 }else{
			       return true;
			 }
			 
				
	
	  } 

	 
	 }
	 
	 


?>