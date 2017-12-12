<?php
class Filest{
	var $allowType = array('.doc','.txt','.rar','.pdf');  //允许上传的类型
	var $allowSize = 9000000000;				//允许上传的最大值
	var $files = null;	//文件属性
	var $uploadPath;	//上传地址
	var $filesType;		//上传文件的类型
	var $filesName;		//文件名称
	var $root = null;	//站点跟路径
	
	function Filest( $input , $uploadPath){
		global $_SERVER,$_FILES;
		$this->files = $_FILES[$input];			//获取本地上传的信息
		$this->root = $_SERVER['DOCUMENT_ROOT'];
		$this->uploadPath = $uploadPath;		//要存入的文件夹地址
		$this->filesType = strtolower(strrchr($this->files[name],".")); //上传文件的类型
		$this->filesName =rand(100000,999999).$this->filesType;		//上传文件的名字
	}
	
	function upload(){
		if(!$this->files[name]) return false; //判断是否有上传内容
		if(!in_array($this->filesType,$this->allowType))  $this->Err("您的类型不正确，请上穿'".implode(",",$this->allowType)."'");
		if($this->files[size] > $this->allowSize) 		$this->Err("上传的大小不应该超过500k");
		if(!is_dir($this->root."/".$this->uploadPath))	$this->CreateDir($this->root."/".$this->uploadPath );	//创建文件夹
		if( move_uploaded_file( $this->files[tmp_name] , $this->root."/".$this->uploadPath ."/".$this->filesName) ){
			return true;
		}else{
			$this->Err("上传失败请重试");
		}
	}
	function getfilesPath(){
		//返回根其文件路径
		return "/".$this->uploadPath."/".$this->filesName;
	}
	function CreateDir($dir, $mode = 0777)
	{
		if (is_dir($dir) || mkdir($dir,$mode)) return TRUE;
		if (!$this->CreateDir(dirname($dir),$mode)) return FALSE;//用递归创建多层目录
		return mkdir($dir,$mode);
	}
	function Err( $msg ){
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb3212\" />";
		echo "<script language='javascript'>"
			."\n alert(\"".$msg."\");"
			."\n window.history.go(-1);"
			."\n </script>";
		exit;	
	}
}
?>
