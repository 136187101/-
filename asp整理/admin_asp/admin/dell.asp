<!--#include file="../inc/conn.asp"-->
<!--#include file="anquan.asp"-->
<%
id=request.QueryString("id")
sqli="select count(*) as zong from zjwlgruserpass"
set rsi=conn.execute(sqli)
lilede=rsi("zong")
if lilede=1 then
response.Write("<script language=javascript> alert('����Ҫ��һ������Ա'); window.location=('guan.asp'); </script>")
else
sql="delete from zjwlgruserpass where id="&id
set rs=conn.execute(sql)

sqlff="delete from userup where uid="&id
conn.execute(sqlff)
response.Write("<script language=javascript> alert('ɾ���ɹ�'); window.location=('guan.asp'); </script>")
end if

%>
