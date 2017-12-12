<!--#include file="../inc/conn.asp"-->
<!--#include file="anquan.asp"-->
<!--#include file="md5.asp"-->
<%
act=request.QueryString("act")
id=request.QueryString("id")
if act="dell" then
sql="delete from userup where uid="&id
conn.execute(sql)
response.Redirect("?")
end if
%>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
.hback {
	BACKGROUND: #ffffff
}
.hback_1 {
	BACKGROUND: #eeeeee
}
-->
</style>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="wlgr.css" rel="stylesheet" type="text/css">
<script language="javascript">
function overColor(Obj)
{
	var elements=Obj.childNodes;
	for(var i=0;i<elements.length;i++)
	{
		elements[i].className="hback_1"
		Obj.bgColor="";//颜色要改
	}
	
}
function outColor(Obj)
{
	var elements=Obj.childNodes;
	for(var i=0;i<elements.length;i++)
	{
		elements[i].className="hback";
		Obj.bgColor="";
	}
}
</script>
</head>
<body>
<%sql="select * from zjwlgruserpass order by id desc"
set rs=conn.execute(sql)
%>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B4CBE5">
  <tr>
    <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e7e7e7">
      <tr>
        <td height="24" colspan="5" align="center" bgcolor="#B4CBE5"><strong class="bai">管理后台密码</strong></td>
      </tr>
      <tr>
        <td width="47" height="24" align="center" bgcolor="#F8F7EF">编号</td>
        <td width="194" height="24" align="center" bgcolor="#F8F7EF">用户名</td>
        <td width="75" height="24" align="center" bgcolor="#F8F7EF">登陆次数</td>
        <td width="217" height="24" align="center" bgcolor="#F8F7EF">注册时间</td>
        <td width="161" height="24" align="center" bgcolor="#F8F7EF">操作</td>
        </tr>
      <%do while rs.eof=false%>
     <tr onMouseOver="overColor(this)" onMouseOut="outColor(this)">
        <td height="24" align="center" bgcolor="#FFFFFF"><%=rs("id")%></td>
        <td height="24" align="center" bgcolor="#FFFFFF"><font color="#FF0000"><%=mid(rs("user_name"),17,100)%></font></td>
        <td height="24" align="center" bgcolor="#FFFFFF"><%
	
	sqlupe="select count(*) as zong from userup where uid="&rs("id")&""
	set rsupe=conn.execute(sqlupe)
	if rsupe.eof then
	response.Write(" ")
	else
	response.Write(rsupe("zong"))
	end if
	%>
          次</td>
        <td height="24" align="center" bgcolor="#FFFFFF"><%=rs("time_at")%></td>
        <td height="24" align="center" bgcolor="#FFFFFF"><a href="#" onClick="if(confirm('将清空此管理员的登陆时间和次数')){location.href=('?act=dell&id=<%=rs("id")%>')}else{return false;}">清空日志</a>&nbsp;|&nbsp;<a href="xiumimi.asp?id=<%=rs("id")%>">修改</a>&nbsp;|&nbsp;<a href="#" onClick="if(confirm('确认删除吗？一旦删除将不能恢复！')){location.href='dell.asp?id=<%=rs("id")%>'}else{return false;}">删除</a></td>
        </tr>
      <%
  rs.movenext
  loop
  %>
    </table></td>
  </tr>
</table>
</body>
</html>
