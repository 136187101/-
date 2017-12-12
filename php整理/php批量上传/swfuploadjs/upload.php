<?php
include_once("../include/init.php");
@header('Content-type: text/html;charset=utf-8');
//查询相册
//hdjxx改编
//2012年1月9日
$xcfid=$_GET["xcfid"];

//以下为upload
$updir="../album/";//上传目录
$upload_file=$_FILES["Filedata"];
//中文转换编码
$file_name = $upload_file['name'];
//$file_name=iconv("UTF-8","GB2312",$file_name);

//时间戳加随机数
$suijishu    = time().rand(100,999); 
$leixing     = strtolower(strrchr($file_name,".")); 
$upload_file['filename']=$updir.$suijishu.$leixing;
//取得原来图片名称并去掉类型
$imgname=substr($file_name,0,-strlen($leixing));


if(@move_uploaded_file($upload_file["tmp_name"],$upload_file["filename"])){
	//图片入库

		
		//图片为相对路径
		$db->query("INSERT INTO `album` (`uid`, `fuid`, `title`, `url`, `fengmian`, `times`) VALUES ('$_SESSION[seid_q]', '$xcfid', '$imgname', '$upload_file[filename]', '0', '$date');");
	//上传成功返回真
	echo "t";
}else{
	//上传失败返回假
	echo "f";
	return false;
}
//输出返回结果
?>