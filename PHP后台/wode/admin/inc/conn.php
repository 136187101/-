<?php

	header('Content-type: text/html;charset=utf-8');
	mysql_connect("localhost","root","123456")or die("数据库登陆失败");
	mysql_query("set names utf8");
	mysql_select_db("luxiao");
	
	date_default_timezone_set('北京');
	date_default_timezone_set('PRC');
	require_once("js.class.php");
	$js =new JS()
?>