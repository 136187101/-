<?php
class FSO{
	/**
	 * 读取文件流
	 * @var
	 * */
	var $handle;
	/**
	 * 读取文件
	 * @param string filepath 
	 * @return string readresult
	 * */
	function read($path){
		if(!file_exists($path)){
			$this->Err("Read the file does not exist!");
		}
		$this->handle = fopen($path,"r");
		return @fread($this->handle,filesize($path));
	}
	/**
	 * 写文件
	 * @param string filePath 写入文件路径
	 * @param string str	  写入内容
	 * */
	 function write( $path , $str ){
	 	/**如果文件夹不存在*/
	 	if(!is_dir(dirname($path))){
			$this->createDir(dirname($path));
		}
		$this->handle = fopen($path,"w");
		if(!fwrite($this->handle,$str)){
			$this->Err("Write file failure!");
		}
	 }
	/**
	*创建多级文件夹
	*@param str dir
	*@param int mode
	*@return bool 
	*/
	function createDir($dir, $mode = 0777)
	{
		if (is_dir($dir) || @mkdir($dir,$mode)) return TRUE;
		if (!$this->CreateDir(dirname($dir),$mode)) return FALSE;//用递归创建多层目录
		return @mkdir($dir,$mode);
	}
	/**
	 * 报错信息
	 * @param string msg
	 * */
	function Err($msg){
		die($msg);
	}

	/**
	 * 析构方法
	 * 关闭流
	 * */
	function __destruct(){
		@fclose($this->handle);
	}
}
class CreateHtml extends FSO{
	/**
	 * 模板内容
	 * @var tpltext
	 * */
	var $tplText;
	/**
	* 读取模仿方法
	* @var string path
	*/
	function readTemplate($path){
		$this->tplText = $this->read($path);
	}
	/*
	* 写入静态页面
	* @parame array array
	* @parame string path
	*/
	function createStaticHtml( $array , $path ){
		if(is_array($array)){
			foreach($array as $key=>$val){
				$this->tplText = str_replace($key,stripslashes($val),$this->tplText);
			}
			$this->write($path,$this->tplText);
		}
	}
	
	function foreachhtml($path){			
		$sql = "select * from news where ziid = 17 order by times desc limit 6";
		$query = mysql_query ($sql);
			while($rs =  mysql_fetch_array($query)){
			//echo "<pre>";
			//print_r($rs);
			//echo "</pre>";
				$titlebt .= "<li><a href=\"/news/news-".$rs['ziid']."_".$rs['id'].".html\">".$rs["title"]."</a></li>";
		}
		$this->tplText = str_replace("{-最新文章标题-}",$titlebt,$this->tplText);
		
	$sql = "select a.*,b.zititle from news a left join news_zilei b on a.ziid = b.id where a.ziid = 19 and a.zhanshi = 1 order by a.px desc limit 7";
	$query = mysql_query ($sql);
			while($jiaru =  mysql_fetch_array($query)){
			//echo "<pre>";
			//print_r($rs);
			//echo "</pre>";
				$jiarukh .= "<li><a href=\"/news/news-".$jiaru['ziid']."_".$jiaru['id'].".html\">".$jiaru["title"]."</a></li>";
			}

			$this->tplText = str_replace("{-最新加入-}",$jiarukh,$this->tplText);
			$this->write($path,$this->tplText);
	}
	
	function diqutitlehhtml($path,$ids){
		$sql = "select a.*,b.zititle from news a left join news_zilei b on a.ziid = b.id where a.ziid = $ids order by a.px desc";
		$query = mysql_query ($sql);
		
			while($fuwus =  mysql_fetch_array($query)){
			//echo "<pre>";
			//print_r($rs);
			//echo "</pre>";
				$fuwu .= "<li><a href=\"".$fuwus['htmlurl']."\">".$fuwus['zititle'].$fuwus["title"]."</a></li>";
			}
			$this->tplText = str_replace("{-400dianhuafuwu-}",$fuwu,$this->tplText);
			$this->write($path,$this->tplText);
	}
	function diquleibiehtml($path){
			$sql = "select * from news_zilei where fuid = 2 order by zileipx desc limit 35";
			$query = mysql_query ($sql);
			while($rs = mysql_fetch_array($query)){
				$sql1 = "select * from news where ziid = ".$rs['id'];
				$query1 = mysql_query ($sql1);
				$rst = mysql_fetch_array($query1);
				$diqulei .= "<a href=\"".$rst["htmlurl"]."\">".$rs['zititle']."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
			}
			$this->tplText = str_replace("{-首页地区分类-}",$diqulei,$this->tplText);
			$this->write($path,$this->tplText);	
	}
}
?>
