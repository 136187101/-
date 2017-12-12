<?php
session_start(); 
require_once("../../include/global.php");
if($_GET["act"] == "logout"){
session_destroy();
	$js->Alert("退出成功");
	$js->Goto("../../admin/liwqbj/login.php");
}
?>
<script language=javascript> 
<!-- 
//Power by xiaotian 2002 
function checkSubmit() 
{ 
if ((document.form1.username.value)=='') 
{ 
window.alert ('管理员名称不能为空！！！'); 
document.form1.username.select(); 
document.form1.username.focus(); 
return false; 
} 
else if ((document.form1.password.value)=='') 
{ 
window.alert ('管理员密码不能为空！！！'); 
document.form1.password.select(); 
document.form1.password.focus(); 
return false; 
} 
else if ((document.form1.RandomNumber.value)=='') 
{ 
window.alert ('验证码不能为空！！！'); 
document.form1.RandomNumber.select(); 
document.form1.RandomNumber.focus(); 
return false; 
}
else 
return true; 
}
//--> 
</script>
<?php
$RandomNumber = rand(10000,99999);
$submit = trim($_POST["submit"]);
if($submit == "登录"){
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$sql = "select * from lwq_user where username='$username' and password='".md5($password)."'";
	$db->setquery($sql);
	$row = $db->loadObject();
	$count = $db->num_rows();
	$Get_Key = $_POST["Get_Key"];
	$RandomNumber = $_POST["RandomNumber"];
	if($Get_Key != $RandomNumber){
			echo "<script>alert('验证码错误，请重新输入');history.back(-1);</script>";
	}
	if($count>0){
		$_SESSION["user_id"] = $row->id;
		$_SESSION["user_name"] = $_POST["username"];
		//$_SESSION['role'] = $row['r_id'];
		$js->Alert("欢迎".$row->username."管理员");
		$js->Goto("main.php");
	}else{
		$js->alert("非管理员不得入内");
		$js->Goto("?");
/*		echo "<script>alert('非管理员不得入内');history.back(-1);</script>";
		exit(0);*/
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统_用户登录</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #016aa9;
	overflow:hidden;
}
.STYLE1 {
	color: #000000;
	font-size: 12px;
}
-->
</style></head>

<body>
<form name="form1" method="post" action="" onSubmit="return checkSubmit();" target="_top">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="235" background="images/login_03.gif">&nbsp;</td>
      </tr>
      <tr>
        <td height="53"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="394" height="53" background="images/login_05.gif">&nbsp;</td>
            <td width="206" background="images/login_06.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="16%" height="25"><div align="right"><span class="STYLE1">用户</span></div></td>
                <td width="57%" height="25"><div align="center">
                  <input name="username" type="text" id="username" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">
                </div></td>
                <td width="27%" height="25">&nbsp;</td>
              </tr>
              <tr>
                <td height="25"><div align="right"><span class="STYLE1">密码</span></div></td>
                <td height="25"><div align="center">
                  <input name="password" type="password" id="password" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff;" value="">
                </div></td>
                <td height="25"><div align="left"><a href="main.php">
                  <input type="image" src="images/dl.gif" name="Submit" value="提交"><input type = "hidden" name = "submit" class="input_liwq" value = "登录" >
                </a></div></td>
              </tr>
            </table></td>
            <td width="362" background="images/login_07.gif">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="213" background="images/login_08.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
