<%
set conn=server.CreateObject("adodb.connection")
conn.open "dbq="&server.MapPath("/datawlgr/da#tawl#gr.mdb")&";driver={microsoft access driver (*.mdb)}"
%>