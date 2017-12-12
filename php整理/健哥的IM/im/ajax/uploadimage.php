<?php header('Content-type: text/html;charset=utf-8');
require_once("../../include/global.php");
require_once("../include/function.php");

$impic_upload = $_POST["impic_upload"];
	
	if($_FILES["impic_upload"]["name"]==""){
		$fileimg="";
	}else{
		$fileimg=IM_Upload("impic_upload","/im/uploadimages/",array(".gif",".jpg",".jpeg",".png"),"200000");
		if(strlen($fileimg) == 34){
			IM_fileimage($fileimg);
			IM_file_group($fileimg,100,100);  //  \im\uploadimages\1336619145633.jpg
		}
	}
	echo $fileimg;
?>