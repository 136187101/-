<%
if session("zjwlgrusername")="" then
response.write("<script language=javascript>")
response.write("alert('��û��Ȩ��ִ�д˲�����');")
response.write("window.top.location=('managej.asp');")
response.write("</script>")
end if
%><!---->