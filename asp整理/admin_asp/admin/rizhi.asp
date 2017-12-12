<!--#include file="../inc/conn.asp"-->
<!--#include file="anquan.asp"-->
<!--#include file="md5.asp"-->
<%
act=request.QueryString("act")
id=request.QueryString("id")
if act="dell" then
sql="delete from userup where id="&id
conn.execute(sql)
response.Redirect("?")
end if

if act="delt" then

sql="delete from userup"
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
<%sql="select * from userup order by id desc"
set rs=conn.execute(sql)
%>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B4CBE5">
  <tr>
    <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e7e7e7">
      <tr>
        <td height="24" colspan="4" align="center" bgcolor="#B4CBE5"><strong class="bai">日志管理</strong></td>
      </tr>
      <tr>
        <td width="52" height="24" align="center" bgcolor="#F8F7EF">编号</td>
        <td width="306" height="24" align="center" bgcolor="#F8F7EF">用户名</td>
        <td width="217" height="24" align="center" bgcolor="#F8F7EF">登陆时间</td>
        <td width="120" height="24" align="center" bgcolor="#F8F7EF">操作</td>
        </tr>
      <%
	  if rs.eof then
	  response.Write("<tr><td>暂无管理员登陆信息</td></tr>")
	  else
	  zi=1
	  do while rs.eof=false%>
     <tr onMouseOver="overColor(this)" onMouseOut="outColor(this)">
        <td height="24" align="center" bgcolor="#FFFFFF"><%=zi%></td>
        <td height="24" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;<font color="#FF0000"><%
		sqlie="select * from zjwlgruserpass where id="&rs("uid")
		set rsie=conn.execute(sqlie)
		response.Write(mid(rsie("user_name"),17,100))
		'=mid(rs("user_name"),17,100)
		
		%></font></td>
        <td height="24" align="center" bgcolor="#FFFFFF"><%=rs("time_at")%></td>
        <td height="24" align="center" bgcolor="#FFFFFF"><a href="?act=delt" onClick="if(confirm('将删除所有管理员登陆日志？一旦删除将不能恢复！')){location.href='?act=dell&id=<%=rs("id")%>'}else{return false;}">清空所有</a>&nbsp;|&nbsp;<a href="#" onClick="if(confirm('确定删除？一旦删除将不能恢复！')){location.href='?act=dell&id=<%=rs("id")%>'}else{return false;}">删除</a></td>
        </tr>
      <%
	  zi=zi+1
  rs.movenext
  loop
  end if
  %>
    </table></td>
  </tr>
</table>
</body>
</html>
