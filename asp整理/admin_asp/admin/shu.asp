<!--#include file="../inc/conn.asp"-->
<!--#include file="anquan.asp"-->
<!--#include file="md5.asp"-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
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
	alert('�����ֶε�ֵ����Ϊ��');
	document.form1.zjwlgrusername.focus();
	return false;
	}
		if(document.form1.zjwlgrpassword.value != document.form1.password2.value)
	{
	alert('�������벻һ��');
	document.form1.password2.focus();
	return false;
	}
			if(document.form1.zjwlgrpassword.value.length<6)
	{
	alert('������6---15λ��');
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
          <td height="25" colspan="2" align="center" bgcolor="#B4CBE5"><strong class="bai">��Ӻ�̨����Ա</strong></td>
        </tr>
        <tr>
          <td width="129" height="24" align="right" bgcolor="#FFFFFF">�û���:</td>
          <td width="568" bgcolor="#FFFFFF" style="padding-left:6px;"><input name="zjwlgrusername" type="text" class="kuang" id="zjwlgrusername"></td>
        </tr>
        <tr>
          <td height="24" align="right" bgcolor="#FFFFFF">����:</td>
          <td bgcolor="#FFFFFF" style="padding-left:6px;"><input name="zjwlgrpassword" type="password" class="kuang" id="zjwlgrpassword"></td>
        </tr>
        <tr>
          <td height="24" align="right" bgcolor="#FFFFFF">����������:</td>
          <td bgcolor="#FFFFFF" style="padding-left:6px;"><input name="password2" type="password" class="kuang"></td>
        </tr>
        <tr>
          <td height="32" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit" class="input0" value="�ύ">&nbsp;&nbsp;
            <input name="Submit2" type="reset" class="input0" value="����"></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
<%
if request.form("submit")="�ύ" then

zjwlgrusername=md5(request.form("zjwlgrusername"))
zjwlgrpassword=md5(request.form("zjwlgrpassword"))
user_name=md5(request.form("zjwlgrpassword"))&request.form("zjwlgrusername")
pass_word=md5(request.form("zjwlgrpassword"))&request.form("zjwlgrpassword")
sqll="select * from zjwlgruserpass where zjwlgrusername='"&zjwlgrusername&"'"
set rsl=conn.execute(sqll)
if rsl.eof=false then
response.Write("<script language=javascript> alert('�û����Ѵ��ڣ������'); </script>")
else
sql="insert into zjwlgruserpass(zjwlgrusername,zjwlgrpassword,user_name,pass_word) values('"&zjwlgrusername&"','"&zjwlgrpassword&"','"&user_name&"','"&pass_word&"')"
conn.execute(sql)
%>
<script language="javascript">
alert('��ӳɹ�������');
window.location='guan.asp';
</script>
<%end if
end if
%>