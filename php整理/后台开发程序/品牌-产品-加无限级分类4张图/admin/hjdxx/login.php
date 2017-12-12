<?php
@header('Content-type: text/html;charset=utf-8');
if($_GET["act"] == "logout"){
   @session_start(); 
   session_destroy(); 

  echo "<script>alert('退出成功');location.href ='../xcty.html'</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>登陆后台管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/css.css"/>
<style type="text/css">
body {
  color: 333333;
}
</style>
<script language="javascript">

//验证登录
	function login_chick(){
		var username=document.login_for.username.value;
		var password=document.login_for.passwd.value;
		if(username=="")
		{
			alert("用户名不能为空!");
			document.login_for.username.focus();
			return false;
		}
		if(password=="")
		{
			alert("密码不能为空!");
			document.login_for.password.focus();
			return false;
		}
		}
</script>
</head>
<body style=" background:url(images/login_bj_02.jpg) #268801 no-repeat center top">
<form method="post" action="admin.php?act=login" id="form1" name='login_for' onsubmit="return login_chick()">
  <table cellspacing="0" cellpadding="0" style="margin-top: 280px" align="center">
  <tr>
   
    <td style="padding-left: 0px">
      <table width="100%">
      <tr>
        <td height="25">用户名：</td>
        <td><input type="text" name="username" id="textfield"  style="width:140px"/></td>
      </tr>
      <tr>
        <td height="25">密&nbsp;&nbsp;码：</td>
        <td><input type="password" name="passwd" id="textfield2"  style="width:140px"/></td>
      </tr>
            <tr>
        <td height="25">验证码：</td>
        <td><input type="text" name="codename" style="width:40px" id="textfield3" />&nbsp;&nbsp;<img src="verifyCode.php" onClick="this.src='verifyCode.php?'+new Date().getTime()" title="点击刷新" style="position:relative; top:4px;"></td>
      </tr>
      
            <tr><td colspan="2" height="25"><label for="remember">验证码看不清楚，点击换一张</label></td></tr>
      <tr><td colspan="2" height="25"><input type="submit" value="1" src="" name="submit" style="background:url(images/login_an_03.jpg); background-repeat:no-repeat; height:30px; width:84px; border:0px; font-size:0px; color:#00FF66; position:relative; top:-14px; *top:-4px;"/>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><img src="images/login_an_05.jpg" width="84" height="30" onclick="resetBtn(login_for)" border="0" /></a></td></tr>
      
      </table>
    </td> 
	<td width="20%"></td>
  </tr>
  </table>
  <input type="hidden" name="act" value="signin" />
</form>
</body>
</html>