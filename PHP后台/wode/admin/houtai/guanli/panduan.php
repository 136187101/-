<?php
	sleep(1);
	require_once("../../inc/conn.php");
	$name=$_GET["name"];
	$sql="select * from admin_users where admin_users='$name';";
	$rs=mysql_query($sql);
	if(mysql_num_rows($rs))
	{
			echo 1;
	}
	else
	{
			echo 0;	
	}
?>