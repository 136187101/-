<?php
	$name=$_GET["name"];
	mysql_connect("localhost","root","");
	mysql_query("set names 'gb2312'");
	mysql_select_db("data");
	$sql="select * from users where username='$name'";
	$rs=mysql_query($sql);
	if(mysql_num_rows($rs)==0)
		echo 0;
	else
		echo 1;
?>