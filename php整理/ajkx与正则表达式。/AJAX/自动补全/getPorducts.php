<?php
	$conn=@mysql_connect("localhost","root","");
	if($conn==null)
		die("���ݿ�����ʧ��");
	mysql_query("set names 'gb2312'");
	mysql_select_db("data");
	$product=$_REQUEST["product"];
	$sql="select * from product where productname like '$product%'";
	$rs=mysql_query($sql);
	$str="";
	while($rows=mysql_fetch_assoc($rs))
	{
		if($str=="")
			$str=$rows["productname"];
		else
			$str=$str.",".$rows["productname"];
	}	
	echo iconv("gb2312","utf-8",$str);  //php�����ݵĴ�����utf-8����������
?>