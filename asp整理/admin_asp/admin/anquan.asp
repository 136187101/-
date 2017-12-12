<%
if session("zjwlgrusername")="" then
response.write("<script language=javascript>")
response.write("alert('您没有权限执行此操作！');")
response.write("window.top.location=('managej.asp');")
response.write("</script>")
end if
%><!---->