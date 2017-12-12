<!--#include file="../inc/conn.asp"-->
<!--#include file="anquan.asp"-->
<!--#include file="md5.asp"-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
.biao{width:200px; height:17px; border:1px solid #999999}
-->
</style>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="wlgr.css" rel="stylesheet" type="text/css">



<script language="javascript">
function wlgr()
{
	if(document.form1.password.value=="")
	{
	alert('请输入新密码');
	document.form1.password.focus();
	return false;
	}
	
	if(document.form1.password.value.length<6)
	{
	alert('密码应在6--15位之间');
	document.form1.password.focus();
	return false;
	}
	
		if(document.form1.password1.value=="")
	{
	alert('请确认新密码');
	document.form1.password1.focus();
	return false;
	}
	
	
		if(document.form1.password.value != document.form1.password1.value)
	{
	alert('两次密码不一至,请重新输入');
	document.form1.password.focus();
	return false;
	}
	
	
	if(document.form1.jpassword.value=="")
	{
	alert('请输入旧密码');
	document.form1.jpassword.focus();
	return false;
	}
	
	
	
}
</script>
</head>
<body>
<%
id=request.QueryString("id")
sql="select * from zjwlgruserpass where id="&id
set rs=conn.execute(sql)
%>
<form name="form1" method="post" action="" onSubmit="return wlgr();">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td height="24" colspan="2" align="center" bgcolor="#B4CBE5"><strong class="bai">修改后台密码</strong></td>
        </tr>
        <tr>
          <td width="121" height="24" align="right" bgcolor="#FFFFFF">当前用户名：</td>
          <td width="576" height="24" bgcolor="#FFFFFF" style="padding-left:5px;"><font color="#FF0000"><%=mid(rs("user_name"),17,100)%></font></td>
        </tr>
        <tr>
          <td height="24" align="right" bgcolor="#FFFFFF">新密码：</td>
          <td height="24" bgcolor="#FFFFFF" style="padding-left:5px;"><input name="password" type="password" class="kuang" id="password"></td>
        </tr>
        <tr>
          <td height="24" align="right" bgcolor="#FFFFFF">确认新密码：</td>
          <td height="24" align="left" bgcolor="#FFFFFF" style="padding-left:5px;"><input name="password1" type="password" class="kuang" id="password1"></td>
        </tr>
        <tr>
          <td height="24" align="right" bgcolor="#FFFFFF">输入旧密码：</td>
          <td height="24" align="left" bgcolor="#FFFFFF" style="padding-left:5px;"><input name="jpassword" type="password" class="kuang" id="jpassword"></td>
        </tr>
        
        <tr>
          <td height="24" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit" class="input0" value="修改">&nbsp;&nbsp;
               <input name="Submit2" type="reset" class="input0" onClick="location.href='guan.asp'" value="返回"></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
<%
if request.form("submit")="修改" then
jpassword=request.form("jpassword")
sql2="select * from zjwlgruserpass where mid(pass_word,17,100)='"&jpassword&"'"
set rs2=conn.execute(sql2)
if rs2.eof=true then
response.Write("<script language=javascript>")
response.write("alert('旧密码输入与数据库中不匹配，无法修改');")
response.write("window.location=('guan.asp');")
response.write("</script>")
else
zjwlgrusername=md5(request.form("username"))
zjwlgrpassword=md5(request.form("password"))

user_name=md5(request.form("username"))&request.form("username")
pass_word=md5(request.form("password"))&request.form("password")
sql="update zjwlgruserpass set pass_word='"&pass_word&"',zjwlgrpassword='"&zjwlgrpassword&"' where id="&id
conn.execute(sql)
%>
<script language="javascript">
alert('修改成功！！！');
window.location=('guan.asp');
</script>
<%
end if

end if%>
