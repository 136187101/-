<?php
	session_start();
	if($_GET[t]=="1")
	{
		session_destroy(); //清空以创建的所有SESSION
	 header("location:index.php");
	}
	if($_SESSION["qq_name"]){
 	 echo "名称：".$_SESSION["qq_name"];
	 echo "<img src='".$_SESSION["qq_touxiang"]."'>";
	 echo "性别：".$_SESSION["qq_gender"];
	 echo "是否为vip:".$_SESSION["qq_vip"]=='0'?'不是':'是';
	 echo "&nbsp&nbsp&nbsp&nbsp <a href='?t=1'>退出</a>";
	 exit;
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta property="qc:admins" content="1721206131633" />
<title>无标题文档</title>
</head>

<body>
<a href="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=101250577&redirect_uri=http://1zi.cc/users.php&scope=get_user_info,list_album,upload_pic,do_like"><img src="Connect_logo_5.png" width="230" height="48" alt=""/></a>
</body>
</html>