<?php
	$str=$_GET["name"];
	$str="��ã�$str";
	$str=iconv("gb2312","utf-8",$str);
	echo $str;
?>