<!--#include file="../inc/conn.asp"-->
<!--#include file="anquan.asp"-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
-->
</style></head>

<body>
<form id="form1" name="form1" method="post" action="" style="display:none;">
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td height="21" colspan="2" align="center" bgcolor="#FFFFFF">��ӻõ�Ƭ</td>
    </tr>
    <tr>
      <td width="140" height="21" align="right" bgcolor="#FFFFFF">���⣺</td>
      <td width="457" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="44" maxlength="55" /></td>
    </tr>
    <tr>
      <td height="21" align="right" bgcolor="#FFFFFF">���ӣ�</td>
      <td bgcolor="#FFFFFF"><input name="url" type="text" id="url" size="44" maxlength="55" /></td>
    </tr>
    <tr>
      <td height="21" align="right" bgcolor="#FFFFFF">ͼƬ��</td>
      <td bgcolor="#FFFFFF"><iframe id="editor" src="1upload.asp" frameborder=0 scrolling=no width="100%" height="24"></iframe></td>
    </tr>
    <tr>
      <td height="21" colspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="�ύ" />
      <input type="reset" name="Submit2" value="����" /></td>
    </tr>
  </table>
</form>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="21" colspan="4" align="center" bgcolor="#FFFFFF">����õ�Ƭ</td>
  </tr>
  <tr>
    <td width="35" height="21" align="center" bgcolor="#EEEEEE">���</td>
    <td width="340" align="center" bgcolor="#EEEEEE">����</td>
    <td width="130" align="center" bgcolor="#EEEEEE">ͼƬ</td>
    <td width="90" align="center" bgcolor="#EEEEEE">����</td>
  </tr>
  <%sql="select * from indexltu order by id desc"
  set rs=conn.execute(sql)
  p=1
  do while not rs.eof
  %>
  <tr>
    <td height="21" align="center" bgcolor="#FFFFFF"><%=p%></td>
    <td align="center" bgcolor="#FFFFFF"><%=rs("title")%></td>
    <td align="center" bgcolor="#FFFFFF"><img src="upload/<%=rs("ltu")%>" width="122" height="80" alt="" /></td>
    <td align="center" bgcolor="#FFFFFF"><a href="up_index_ltu.asp?id=<%=rs("id")%>">�޸�</a></td>
  </tr>
  <%
  p=p+1
  rs.movenext
  loop%>
</table>
</body>
</html>
<%
if request.Form("submit")="�ύ" then
title=request.Form("title")
url=request.Form("url")
ltu_1=session("SaveFileName1")
sqladd="insert into indexltu(title,url,ltu) values('"&title&"','"&url&"','"&ltu_1&"')"
conn.execute(sqladd)
session("SaveFileName1")=""
response.Write("<script language=javascript> alert('�����ɹ�'); </script>")
end if


%>
