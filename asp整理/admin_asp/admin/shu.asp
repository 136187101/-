<!--#include file="../inc/conn.asp"-->
<!--#include file="anquan.asp"-->
<!--#include file="md5.asp"-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<link href="wlgr.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
.biao{width:200px; height:17px; border:1px solid #999999;}
-->
</style>
<script language="javascript">
function wlgr()
{
	if(document.form1.zjwlgrusername.value=="" || document.form1.zjwlgrpassword.value=="" || document.form1.password2.value=="")
	{
	alert('所有字段的值不能为空');
	document.form1.zjwlgrusername.focus();
	return false;
	}
		if(document.form1.zjwlgrpassword.value != document.form1.password2.value)
	{
	alert('两次密码不一至');
	document.form1.password2.focus();
	return false;
	}
			if(document.form1.zjwlgrpassword.value.length<6)
	{
	alert('密码在6---15位间');
	document.form1.zjwlgrpassword.focus();
	return false;
	}
}
</script>




</head>

<body>
<form name="form1" method="post" action="" onSubmit="return wlgr();">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B4CBE5">
    <tr>
      <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e7e7e7">
        <tr>
          <td height="25" colspan="2" align="center" bgcolor="#B4CBE5"><strong class="bai">添加后台管理员</strong></td>
        </tr>
        <tr>
          <td width="129" height="24" align="right" bgcolor="#FFFFFF">用户名:</td>
          <td width="568" bgcolor="#FFFFFF" style="padding-left:6px;"><input name="zjwlgrusername" type="text" class="kuang" id="zjwlgrusername"></td>
        </tr>
        <tr>
          <td height="24" align="right" bgcolor="#FFFFFF">密码:</td>
          <td bgcolor="#FFFFFF" style="padding-left:6px;"><input name="zjwlgrpassword" type="password" class="kuang" id="zjwlgrpassword"></td>
        </tr>
        <tr>
          <td height="24" align="right" bgcolor="#FFFFFF">在输入密码:</td>
          <td bgcolor="#FFFFFF" style="padding-left:6px;"><input name="password2" type="password" class="kuang"></td>
        </tr>
        <tr>
          <td height="32" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit" class="input0" value="提交">&nbsp;&nbsp;
            <input name="Submit2" type="reset" class="input0" value="重置"></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
<%
if request.form("submit")="提交" then

zjwlgrusername=md5(request.form("zjwlgrusername"))
zjwlgrpassword=md5(request.form("zjwlgrpassword"))
user_name=md5(request.form("zjwlgrpassword"))&request.form("zjwlgrusername")
pass_word=md5(request.form("zjwlgrpassword"))&request.form("zjwlgrpassword")
sqll="select * from zjwlgruserpass where zjwlgrusername='"&zjwlgrusername&"'"
set rsl=conn.execute(sqll)
if rsl.eof=false then
response.Write("<script language=javascript> alert('用户名已存在，请更换'); </script>")
else
sql="insert into zjwlgruserpass(zjwlgrusername,zjwlgrpassword,user_name,pass_word) values('"&zjwlgrusername&"','"&zjwlgrpassword&"','"&user_name&"','"&pass_word&"')"
conn.execute(sql)
%>
<script language="javascript">
alert('添加成功！！！');
window.location='guan.asp';
</script>
<%end if
end if
%>