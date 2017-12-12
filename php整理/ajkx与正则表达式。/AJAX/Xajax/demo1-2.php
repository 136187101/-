<?php
	$str=$_GET["name"];
	$str="ฤใบรฃฌ$str";
	$str=iconv("gb2312","utf-8",$str);
	echo $str;
?>