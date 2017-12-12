<?php
	require_once("../admin/inc/conn.php");
	$product=$_REQUEST["product"];
	$sql="select * from admin_users where admin_users like '$product%'";
	$rs=mysql_query($sql);
	$str="";
	while($rows=mysql_fetch_assoc($rs))
	{
		if($str=="")
			$str=$rows["admin_users"];
		else
			$str=$str.",".$rows["admin_users"];
	}	
	echo $str;  //php中数据的传输用utf-8编码来传输
?>