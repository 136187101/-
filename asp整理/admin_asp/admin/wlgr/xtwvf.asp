<!--#include file="../../inc/conn.asp"-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" height="51" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="62%" background="../../pic/top_r2_c2.jpg"><span style="padding-left:20px; font-size:18px; font-family:'黑体'; font-weight:300;">网站后台管理系统</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      &nbsp;&nbsp;&nbsp;&nbsp;<a href="../../index.asp" target="_blank" style="color:#000099">返回首页</a></td>
    <td width="38%" background="../../pic/top_r2_c2.jpg">当前管理员：<%
	username=session("zjwlgrusername")
	sql="select * from zjwlgruserpass where zjwlgrusername='"&username&"'"
set rs=conn.execute(sql)
response.Write(mid(rs("user_name"),17,100))
	%>    &nbsp;&nbsp;&nbsp;<a href="../tui.asp" target="_top" style="color:#000099">安全退出</a></td>
  </tr>
</table>
</body>
</html>
