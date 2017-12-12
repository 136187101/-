<?php 
ob_start();
session_start();
require_once("../inc/conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>驴小二后台管理工作平台</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<script type="text/javascript" src="js/js.js"></script>
<?php
session_start();
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
$num_awt=$_SESSION['authcode'];//验证码

if($_POST["tj"]){
	$num_dcg=$_POST["num_dcg"];
	$users=$_POST["users"];
	$pwd=$_POST["pwd"];
	


	$sql="select * from admin_users where admin_users='$users' and admin_pwd='$pwd'";
	$rs=mysql_query($sql);
	if(mysql_num_rows($rs)==0)
	{
		echo "<script language='javascript'>alert('用户名或密码错误');window.location.href='index.php'</script>";
	}
	else if($num_dcg!=$num_awt){
		echo "<script language='javascript'>alert('验证码输入错误');window.location.href='index.php'</script>";
		
	}
	else
	{	
	
			$ip=$_SERVER['REMOTE_ADDR'];
			$sj=date('Y-m-d H:i:s');
			$sql_rz="insert into rizhi(adminlogin_name,adminlogin_ip,adminlogin_sj) values ('$users','$ip','$sj')";
			mysql_query($sql_rz);
		/*以上是日志*/
		$_SESSION["name"]=$users;
		$_SESSION["id"]=session_id();
		header("location:main.php");	
	}

}
?>
</head>
<body>
<div id="top"> </div>
<form id="login" name="login"  method="post" action="">
  <div id="center">
    <div id="center_left"></div>
    <div id="center_middle">
      <div class="user">
        <label>用户名：
        <input type="text" name="users" id="user" />
        </label>
      </div>
      <div class="user">
        <label>密　码：
        <input type="password" name="pwd" id="pwd" />
        </label>
      </div>
      <div class="chknumber">
        <label>验证码：
        <input type="text" maxlength="6" name="num_dcg" class="chknumber_input" id="num_dcg"><img src="yzm/coedos_one.php" width="60" height="20" alt="" style="position:relative; top:4px; cursor:hand;" onClick="uiy.src='yzm/coedos_one.php?'+Math.random();" id="uiy" />   
        <input name="tj" type="hidden" value="ok" />
        </label>
        
      </div>
    </div>
    <div id="center_middle_right"></div>
    <div id="center_submit">
      <div class="button"><input name="Submit" type="image" src="images/dl.gif"  style="width:57px;"/>
      </div>
      <div class="button"> <img src="images/cz.gif" width="57" height="20" onclick="form_reset()"> </div>
    </div>
    <div id="center_right"></div>
  </div>
</form>
<div id="footer"></div>
</body>
</html>
