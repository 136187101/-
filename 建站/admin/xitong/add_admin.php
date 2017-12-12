<?php 	
	require '../../include/init.php';
 	require_once("../session.php"); 
	if($_POST["Submit"])
	{
		foreach($_POST as $key => $val)
		{
			$$key=$val;	
		}	
		$pwd=md5($pwd);
		$sql="insert into admin_user (username,passwd,quanxian) values('$name','$pwd','1')";
		if($db->query($sql))
		{
			$js->Alert("添加成功");	
			$js->Goto("admin_user.php");
		}
		else
		{
			$js->Alert("添加失败");	
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/skin.css" rel="stylesheet" type="text/css">
<link href="../wlgr/wlgr.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="../css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script src="../js/jquery-1.4.min.js" type="text/javascript"></script>
		<script src="../js/jquery_reg.js" type="text/javascript"></script>
		<script src="../js/jquery.validationEngine.js" type="text/javascript"></script>
		<script>	
		$(document).ready(function() {
			$("#formID").validationEngine()
		});
	</script>	

</head>
<body>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
 <form id="formID" name="form1" method="post" action="">
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
            <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">添加子管理员</td>
            </tr>		  
          <tr>
            <td width="48%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">用户名：&nbsp;&nbsp;</span></td>
            <td width="52%" height="20" align="left" bgcolor="#FFFFFF"><input name="name" type="password" id="password" class="validate[required,ajax[ajaxName]]" /></td>
          </tr>
          <tr>
            <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">密码：&nbsp;&nbsp;</span></td>
            <td height="20" align="left" bgcolor="#FFFFFF"><input name="pwd" type="password" id="password1" class="validate[required,length[6,18]]"/></td>
          </tr>
          <tr>
            <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">重复密码：&nbsp;&nbsp;</span></td>
            <td height="20" align="left" bgcolor="#FFFFFF"><input name="cfpwd" type="password" id="password2" class="validate[required,length[6,18],confirm[password1]]" /></td>
          </tr>

          <tr>
            <td height="20" colspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="Submit" class="anniu" value="添加"/>
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