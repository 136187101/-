<?php require '../../include/init.php';
 		require_once("../session.php"); 
$sql = "select * from admin_user where uid = '$_GET[id]'";

$rows = $db->getOne($sql);

if($_POST[Submit] == "修改"){
 $password=md5($_POST['password']);
$sql = "select * from admin_user where uid = '$_GET[id]' and passwd ='$password'";

	$qu=$db->query($sql);
	$num = $db->fetch_nums($qu);
	if($num){

		$_SESSION[pwd] = md5($_POST[password1]);

		$sql = "update admin_user set passwd = '".$_SESSION[pwd]."' where uid =".$_SESSION["uid"];
		
		if($db->query($sql)){
		//session_destroy();
		$js ->Alert("修改成功");
		$js->Gotoxx("admin_user.php");
		}
	}else{

	
		$js->Alert("对不起密码错误");
		$js->Gotoxx("?id=$id");
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
<script language="javascript">
	function liwq(){
		var re = /^[0-9]+.?[0-9]*$/;
		if(document.form1.password.value==''){
			alert('密码不能为空');
			form1.password.focus();
			return false;
		}
		if(document.form1.password1.value==''){
			alert('新密码不能为空');
			form1.password1.focus();
			return false;
		}
		if(document.form1.password1.value != document.form1.password2.value){
			alert('您的密码不一至');
			form1.password2.focus();
			return false;
		}
		if(document.form1.password1.value.length<6 || document.form1.password1.value.length>12){
			alert("密码应在6到12位之间");
			form1.password1.focus();
			return false;
		}
	}
</script>
<link href="../wlgr/wlgr.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
<span class="action-span"><a href="admin_user.php">管理员列表</a></span>
<span class="action-span1">管理员管理</span><span id="search_id" class="action-span1"> - 编辑管理员 </span>
<div style="clear:both"></div>
</h1>
<form id="form1" name="form1" method="post" action="" onsubmit="return liwq();">
  <div class="main-div">
    <table width="100%" id="general-table">
          <tr>
            <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">管理员：<font color="#FF0000"><?=$rows['username']?></font></td>
            </tr>		  
          <tr>
            <td width="48%" height="20" class="label" bgcolor="#FFFFFF"><span class="table_title">输入旧密码：&nbsp;&nbsp;</span></td>
            <td width="52%" height="20" align="left" bgcolor="#FFFFFF"><input name="password" type="password" id="password" /></td>
          </tr>
          <tr>
            <td height="20" class="label" bgcolor="#FFFFFF"><span class="table_title">输入新密码：&nbsp;&nbsp;</span></td>
            <td height="20" align="left" bgcolor="#FFFFFF"><input name="password1" type="password" id="password1" /></td>
          </tr>
          <tr>
            <td height="20" class="label" bgcolor="#FFFFFF"><span class="table_title">确认新密码：&nbsp;&nbsp;</span></td>
            <td height="20" align="left" bgcolor="#FFFFFF"><input name="password2" type="password" id="password2" /></td>
          </tr>
    <tr>
      <td class="label">&nbsp;</td>
      <td><input type="submit" name="Submit" class="button" value="修改"/>
      <input name="Submit4" type="button" class="button" id="Submit" value="返回" onclick='javascript:history.go(-1)';/></td>
    </tr>
  </table>
</div>
</form>
</body>
</html>