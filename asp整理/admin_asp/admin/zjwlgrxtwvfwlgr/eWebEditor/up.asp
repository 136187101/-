<%@LANGUAGE="VBSCRIPT" CODEPAGE="936"%>
<!--#include file="../conn.asp"-->
<!--#include file="../Admin_ChkPurview.asp"-->
<!--#Include file="../inc/function.asp"-->
<%
	dim tmp_nid
	tmp_nid=ReqStr("NID")
	sql = "select * from News_Info where NID="&tmp_nid
	rs.open sql,scn,1,1
	tmp_title = rs("title")
	tmp_subtitle = rs("subtitle")
	tmp_PID = cint(rs("PID"))
	tmp_channel = rs("channel")
	tmp_author = rs("author")
	tmp_sourcelink =rs("sourcelink")
	tmp_editor = rs("editor")
	tmp_IfImg =rs("IfImg")
	tmp_IfMember =rs("IsMember")
	tmp_iftop =rs("iftop")
	tmp_imgPath = rs("ImgPath")
	tmp_Content = rs("Content")
	tmp_key = rs("key")
	tmp_ifurl = rs("ifurl")
	tmp_urlpath = rs("urlpath")
	tmp_num = rs("ReplyNum")
	rs.close

function listnav(cid)
dim navrs,childBox,i
set navrs=conn.execute("select * from news_channel where type=1 or type=4")
if not navrs.eof then
	do while not navrs.eof
		childBox=""
		for i=1 to navrs("depth")
			childBox=childBox&"-"
		next
		if navrs("id") = cid then
		response.write("<option value="&navrs("id")&" selected>"&childBox&navrs("channel")&"</option>")
		else
		response.write("<option value="&navrs("id")&">"&childBox&navrs("channel")&"</option>")
		end if
		'call listnav(cid)
		navrs.movenext
	loop
end if
navrs.close()
set navrs=nothing
end function
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>���Ź���</title>
<script type="text/javascript">
<!--
function isNull(elm){
	if (elm.value==""||elm.value==null){
		return false;	
	}
	else{
		return true;
	}
}
function isReady(form){
	if (isNull(form.title)==false){
		alert("����д���ű���!");
		form.title.focus();
		return false;
	}
	if (isNull(form.channel)==false){
		alert("��ѡ��������!");
		form.channel.focus();
		return false;
	}
	return true;
}
-->
</script>
<link href="../css/basic.css" rel="stylesheet" type="text/css" />
<style media="all" type="text/css">
<!--
table#navstyle {
	height:21px;
	line-height:21px;
	border:#09F 1px solid;
	background-color:#F6F6F6;
	margin-bottom:5px;
}
form {padding:0px; margin:0px;}
-->
</style>
</head>
<body>
<form action="" method="post" name="news" onsubmit="return isReady(this);">
<button type="submit" class="button_style" onmouseout="this.className='button_style'" onmouseover="this.className='button_style_on'">��&nbsp; &nbsp; ��</button>&nbsp;
<button class="button_style" onmouseout="this.className='button_style'" onmouseover="this.className='button_style_on'" onclick="window.history.go(-1);">��&nbsp; &nbsp; ��</button>&nbsp;
<input name="action" type="hidden" id="action" value="edit">
<table border="0" cellspacing="0" cellpadding="0" id="main">
  <tr>
    <td>��&nbsp;&nbsp;��</td>
    <td colspan="3" style="text-align:left;"><input name="title" type="text" id="title" style="width:98%;" value="<%=tmp_title%>" />
	</td>
  </tr>
  <tr>
    <td>������</td>
    <td colspan="3" style="text-align:left;"><input name="subtitle" type="text" id="subtitle" style="width:98%;" value="<%=tmp_subtitle%>" />
	</td>
  </tr>
  <tr>
    <td>��&nbsp;&nbsp;��</td>
    <td style="text-align:left;">
	<select name="channel" id="channel" style=" width:98%;">
				<option value="">��ѡ��...</option>
				<%call listnav(tmp_pid)%>
	</select>	</td>
    <td >��Դ/����</td>
    <td style="text-align:left;"><input name="sourceLink" type="text" id="sourceLink" style="width:96%;" value="<%=tmp_sourcelink%>" /></td>
  </tr>
  <!--
  <tr>
    <td width="20%">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</td>
    <td width="30%" style="text-align:left;"><input name="author" type="text" id="author" style="width:96%;" value="<%=tmp_author%>" /></td>
    <td width="20%">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</td>
    <td width="30%" style="text-align:left;"><input name="editor" type="text" id="editor" style="width:96%;" value="<%=tmp_editor%>" /></td>
  </tr>
  -->
  <tr>
    <td width="20%">�ؼ���</td>
    <td width="30%" style="text-align:left;"><input name="key" type="text" id="key" style="width:96%;" value="<%=tmp_key%>" /></td>
    <td width="20%">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</td>
    <td width="30%" style="text-align:left;"><input name="num" type="text" id="num" style="width:30%;" value="<%=tmp_num%>" size="10"/>
����Խ��Խǰ</td>
  </tr>
  <tr>
    <td>��������</td>
    <td colspan="3" style="text-align:left;">
	  
	  ͼƬ����

	  <input onClick="document.all.strdiv.style.display=(this.checked?'':'none')" type="checkbox" name="img" id="img" value="1" <%if tmp_Ifimg = 1 then response.write("checked") end if%>/>
	  &nbsp;&nbsp;�Ƽ�����
	  <input name="hot" type="checkbox" id="hot" value="1" <%if tmp_Iftop = 1 then response.write("checked") end if%>/> 
	  &nbsp; &nbsp; 
	  ��������

	  <input onClick="document.all.strurl.style.display=(this.checked?'':'none')" type="checkbox" name="ifurl" id="ifurl" value="1" <%if tmp_Ifurl = 1 then response.write("checked") end if%>/> &nbsp; &nbsp;��������
	  
	  <input name="member" type="checkbox" id="member" value="1" <%if tmp_Ifmember = 1 then response.write("checked") end if%>/> 
	  
	  </td>
	</tr>
	<tr id="strdiv" <% if tmp_Ifimg = 0 then response.write("style=display:none;") else response.write("style=display:;") end if %>>
	  <td>ͼƬ·��</td>
	  <td colspan="3" style="text-align:left;">
	  <input name="img_path" type="text" id="img_path" value="<%=tmp_imgpath%>" style="width:70%;" />
	  <input name="Submit11" type="button" class="button_style" onClick="window.open('../upload/uploadaction.asp?reform=news&item=img_path&savepath=uploadfiles/News','','status=no,scrollbars=no,top=20,left=110,width=420,height=165')" value="�ϴ�ͼƬ">
	  </td>
	</tr>
	<tr id="strurl" <% if tmp_Ifurl = 0 then response.write("style=display:none;") else response.write("style=display:;") end if %>>
	  <td>ͼƬ·��</td>
	  <td colspan="3" style="text-align:left;">
	  <input name="urlpath" type="text" id="urlpath" value="<%=tmp_urlpath%>" style="width:98%;" />
	  </td>
	</tr>
	<tr>
    <td colspan="4" style="border:0px;">
<iframe ID="eWebEditor1" src="../eWebEditor/ewebeditor.asp?id=content&style=js_type" frameborder="0" scrolling="no" width="100%" HEIGHT="400"></iframe>	</td>
    <input name="content" type="hidden" id="content" value="<%=Server.HTMLEncode(tmp_Content)%>"> 
	</tr>
</table>
</form>
</body>
</html>
<%
If Request.Form("action")="edit" then
	Dim str_channelID		'���Ŵ���
	Dim str_title		'���ű���
	Dim str_subtitle
	Dim str_author		'��������
	Dim str_source		'������Դ
	Dim str_editor		'���ű༭
	Dim if_member		'�Ƿ��Ա����
	Dim if_img			'�Ƿ�ͼƬ����
	Dim img_path		'����ͼƬ·��
	Dim str_info		'������Ϣ
	Dim str_key
	Dim if_top
	dim if_url
	dim str_urlpath
	dim int_num
	
	str_channelID = Request.Form("Channel")
	str_title = Request.Form("title")
	str_subtitle = Request.Form("subtitle")
	str_source = Request.Form("sourceLink")
	str_editor = Request.Form("editor")
	str_author = Request.Form("author")
	str_Content = Request.Form("Content")
	str_key = request.form("key")
	str_urlpath = request.form("urlpath")
	int_num = request.form("num")
	if str_title="" or str_Content ="" then
		response.Write "<script language='javascript'>alert('����д��������Ϣ!\n\n����!');histroy.back();</script>"
		response.End()
	end if
	
	'��ȡ��Ŀ������
	Dim tmp_Channel,tmp_Depth,tmp_IndexID
	
		sql="select * from News_Channel where id="&str_channelID
		rs.open sql,scn,1,1
		tmp_Channel = rs("Channel")
		tmp_PID = rs("PID")
		tmp_Depth = rs("Depth")
		'tmp_IndexID = rs("OrderID")
		rs.close
		
		
	
	'��������
		If_Img = request.Form("Img")
		Img_Path = request.Form("Img_path")
		If_member = request.Form("member")
		if_top = request.form("hot")
		if_url = request.form("ifurl")
		
		if If_img="" or Img_Path="" then
			If_img = 0
			Img_path = ""
		end if
		
		if If_url="" or str_urlpath="" then
			If_url = 0
			str_urlpath = ""
		end if
		if If_member="" then
			If_member = 0
		end if
	
		if if_top = "" then
			if_top = 0
		end if
		if int_num ="" then
			int_num=0
		end if
		
	
	sql="select * from News_Info where NID="&tmp_nid
	rs.open sql,scn,1,3
	
	rs("Channel") = tmp_channel
	rs("PID") = str_channelID
	
	rs("Title") = str_title
	rs("subTitle") = str_subtitle
	rs("Author") = str_author
	rs("Content") = str_content
	rs("SourceLink") = str_source
	rs("Editor") = str_editor
	rs("IfImg") = If_img
	rs("ImgPath") = Img_Path
	rs("IsMember") = If_Member
	rs("key") = str_key
	rs("IfTop") = If_Top
	rs("Ifurl") = If_url
	rs("urlpath") = str_urlpath
	rs("replynum") = int_num
	rs.update
	rs.close
	set rs=nothing
	
	Response.Write("<script language='javascript'>alert('�����޸����!\n\n���ȷ������');window.location.href='list_news.asp';</script>")
	Response.End()
end if
%>