<?php require '../../include/init.php';
 		require_once("../session.php"); 
$sql = "select * from admin_user where uid = '$_GET[id]'";

$rows = $db->getOne($sql);

if($_POST[Submit] == "修改"){
 $password=md5($_POST['password']);
$sql = "select * from admin_user where passwd ='$password'";

	$qu=$db->query($sql);
	$num = $db->fetch_nums($qu);
	if($num){

		$_SESSION[pwd] = md5($_POST[password1]);

		$sql = "update admin_user set passwd = '".$_SESSION[pwd]."' where uid =".$_SESSION["uid"];
		
		if($db->query($sql)){
		//session_destroy();
		$js ->Alert("修改成功");
		$js->Goto("admin_user.php");
		}
	}else{

	
		$js->Alert("对不起密码错误");
		$js->Goto("?id=$id");
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/skin.css" rel="stylesheet" type="text/css">
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
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
 <form id="form1" name="form1" method="post" action="" onsubmit="return liwq();">
 <tr>
    <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="Navitable">
      <tr>
        <td width="12" height="30">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%"><span class="STYLE3">你当前的位置</span>：[系统管理]-[管理员管理]</td>
              </tr>
            </table></td>
            <td width="54%">&nbsp;</td>
          </tr>
        </table></td>
        <td width="16">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" background="../images/tab_12.gif">&nbsp;</td>
        <td align="center"><table width="60%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
          <tr>
            <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">当前管理员：<font color="#FF0000"><?php echo $_SESSION["user_name"];?></font></td>
            </tr>		  
          <tr>
            <td width="48%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">输入旧密码：&nbsp;&nbsp;</span></td>
            <td width="52%" height="20" align="left" bgcolor="#FFFFFF"><input name="password" type="password" id="password" /></td>
          </tr>
          <tr>
            <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">输入新密码：&nbsp;&nbsp;</span></td>
            <td height="20" align="left" bgcolor="#FFFFFF"><input name="password1" type="password" id="password1" /></td>
          </tr>
          <tr>
            <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">确认新密码：&nbsp;&nbsp;</span></td>
            <td height="20" align="left" bgcolor="#FFFFFF"><input name="password2" type="password" id="password2" /></td>
          </tr>
          <tr>
            <td height="20" colspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="Submit" class="anniu" value="修改"/>
              &nbsp;&nbsp;
              <input name="Submit2" type="button" class="anniu" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
            </tr> 
        </table></td>
        <td width="8" background="../images/tab_15.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="35">&nbsp;</td>
        <td>&nbsp;</td>
        <td width="16">&nbsp;</td>
      </tr>
    </table></td>
  </tr></form>
</table>
</body>
</html>