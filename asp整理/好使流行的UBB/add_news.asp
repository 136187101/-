<%@LANGUAGE="VBSCRIPT" CODEPAGE="936"%>
<!--#include file="../conn.asp"-->
<!--#include file="../Admin_ChkPurview.asp"-->
<!--#Include file="../inc/function.asp"-->
<%
dim channelid
channelid=cint(request("id"))

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
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
function OpenWindow(theURL,winName,features){
	window.open(theURL,winName,features);
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
<button class="button_style" onmouseout="this.className='button_style'" onmouseover="this.className='button_style_on'" onclick="location.href='list_news.asp';">��&nbsp; &nbsp; ��</button>
<table border="0" cellspacing="0" cellpadding="0" id="main">
  <tr>
    <td>��&nbsp;&nbsp;��</td>
    <td colspan="3" style="text-align:left;">
	<input name="action" type="hidden" id="action" value="add">
	<input name="title" type="text" id="title" style="width:98%;" />
	</td>
  </tr>
  <tr>
    <td>������</td>
    <td colspan="3" style="text-align:left;">
	<input name="subtitle" type="text" id="subtitle" style="width:98%;" />
	</td>
  </tr>
  <tr>
    <td>��&nbsp;&nbsp;��</td>
    <td style="text-align:left;">
	<select name="channel" id="channel" style=" width:98%;">
				<option value="">��ѡ��...</option>
				<% call listnav(channelid) %>
	</select>	</td>
    <td >��Դ/����</td>
    <td style="text-align:left;"><input name="sourceLink" type="text" id="sourceLink" style="width:96%;" value="������"/></td>
  </tr>
  <!--
  <tr>
    <td width="20%">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</td>
    <td width="30%" style="text-align:left;"><input name="author" type="text" id="author" style="width:96%;" /></td>
    <td width="20%">�༭/˵��</td>
    <td width="30%" style="text-align:left;"><input name="editor" type="text" id="editor" style="width:96%;" /></td>
  </tr>
  -->
  <tr>
    <td width="20%">�ؼ���(;)</td>
    <td width="30%" style="text-align:left;"><input name="key" type="text" id="key" style="width:96%;" value="" /></td>
    <td width="20%">����</td>
    <td width="30%" style="text-align:left;"><input name="num" type="text" id="num" style="width:30%;" value="0" size="10" />
      ����Խ��Խǰ</td>
  </tr>
  <tr>
	  <td>�������</td>
	  <td colspan="3" style="text-align:left;">
	   
	  <input onclick="document.all.strdiv.style.display=(this.checked?'':'none')" type="checkbox" name="img" id="checkstr" value="1" />
	  ͼƬ����
	  <!--
	  &nbsp; &nbsp; 
	  <input name="top" type="checkbox" id="top" value="1" />
	  �ö�����--> 
	  &nbsp; &nbsp;
	  <input name="hot" type="checkbox" id="hot" value="1" />
	  �Ƽ�����
	  
	  
	  <!--
	  &nbsp; &nbsp; 
	  <input name="top" type="checkbox" id="top" value="1" />
	  �ö�����-->
&nbsp; &nbsp;
<input name="ifurl" type="checkbox" id="ifurl" value="1" onclick="document.all.strurl.style.display=(this.checked?'':'none')" />
��������&nbsp; &nbsp; <input name="member" type="checkbox" id="member" value="1" />
	  <!--<input name="member" type="checkbox" id="member" onclick="document.all.strlevel.style.display=(this.checked?'':'none')" value="1" />-->��������</td>
    </tr>
	<tr id="strdiv" style="display:none ">
	  <td>ͼƬ·��</td>
	  <td colspan="3" style="text-align:left;">
	  <input name="img_path" type="text" id="img_path" style="width:70%;" />
	  <input name="Submit11" type="button" class="button_style" onClick="window.open('../upload/uploadaction.asp?reform=news&item=img_path&savepath=uploadfiles/News','','status=no,scrollbars=no,top=20,left=110,width=420,height=165')" value="�ϴ�ͼƬ">
	  </td>
	</tr>
	<tr id="strurl" style="display:none;">
	  <td>���ӵ�ַ</td>
	  <td colspan="3"><div align="left"><span style="text-align:left;">
	    <input name="urlpath" type="text" id="urlpath" style="width:98%;" value="http://" />
	  </span></div></td>
	</tr>
	<tr>
    <td colspan="4" style="border:0px;">
<iframe ID="eWebEditor1" frameborder="0" scrolling="no" width="100%" HEIGHT="25"></iframe>	</td>
    <input type="hidden" name="Content" id="content" value="�˴��޸���������"/>
	</tr>
</table>
</form>
</body>
</html>
<%
If Request.Form("action")="add" then
	Dim str_channelID		'���Ŵ���
	Dim str_title		'���ű���
	Dim str_subtitle    '���Ÿ�����
	Dim str_author		'��������
	Dim str_source		'������Դ
	Dim str_editor		'���ű༭
	Dim if_member		'�Ƿ��Ա����
	Dim if_img			'�Ƿ�ͼƬ����
	Dim img_path		'����ͼƬ·��
	Dim str_info		'������Ϣ
	Dim str_key     '�������
	Dim if_top
	Dim if_url
	DIm str_urlpath
	DIm int_num
	
	str_channelID = Request.Form("Channel")
	str_title = ReqStr("title")
	str_subtitle = ReqStr("subtitle")
	str_source = ReqStr("sourceLink")
	str_editor = ReqStr("editor")
	str_author = ReqStr("author")
	str_key = ReqStr("key")
	str_Content = Request.Form("Content")
	str_urlpath = request.form("urlpath")
	int_num = request.form("num")
	if str_title="" or str_Content ="" then
		response.Write "<script language='javascript'>alert('����д��������Ϣ!\n\n����!');window.location.href='add_news.asp';</script>"
		response.End()
	end if
	
	'��ȡ��Ŀ������
	Dim tmp_Channel,tmp_Depth,tmp_IndexID
	
		sql="select * from News_Channel where id="&str_channelID
		rs.open sql,scn,1,1
		tmp_Channel = rs("Channel")
		tmp_PID = rs("PID")
		tmp_Depth = rs("Depth")
		'tmp_IndexID = rs("orderID")
		rs.close
		
		'if tmp_PID = 0 then
			'response.Write "<script language='javascript'>alert('��վ��Ŀ¼���������Ϣ!\n\n����!');window.location.href='add_news.asp';/script>"
			'response.End()
		'end if
	'Response.Write tmp_parentID&tmp_name&tmp_fullid	
	
	'��������
		If_Img = ReqStr("Img")
		Img_Path = ReqStr("Img_path")
		If_member = ReqStr("member")
		If_top = ReqStr("Hot")
		if_url = reqstr("ifurl")
		
		if If_img="" or Img_Path="" then
			If_img = 0
			Img_path = ""
		end if
		if if_url="" or str_urlpath="" then
			if_url = 0
			str_urlpath = ""
		end if
		if If_member="" then
			If_member = 0
		end if
	'	
		if if_top = "" then
			if_top = 0
		end if
		if int_num = "" then
			int_num=0
		end if
	
	sql="select * from News_Info where (NID is Null)"
	rs.open sql,scn,1,3
	rs.addnew
	
	rs("Channel") = tmp_channel
	rs("PID") = str_channelID
	
	rs("Title") = str_title
	rs("subTitle") = str_subtitle
	rs("Author") = str_author
	rs("Content") = str_content
	rs("SourceLink") = str_source
	rs("JoinDate") = date()
	rs("Editor") = str_editor
	rs("IfImg") = If_img
	rs("ImgPath") = Img_Path
	rs("IfTop") = If_Top
	rs("key") = str_key
	rs("IsMember") = If_member
	rs("ifurl") = if_url
	rs("urlpath") = str_urlpath
	rs("replynum") = int_num
	rs("Hits")=1
	rs.update
		'TmpID ��ȡ��Ϣ��ID���
	Tmp_ID=rs("NID")
	Dim tmp_year,temp_month,tmp_day
		tmp_year = Year(Date())
		tmp_month = Month(Date())
		tmp_day = Day(Date())
		
		if len(tmp_month)=1 then
			tmp_month = "0"&tmp_month
		end if
		if len(tmp_day)=1 then
			tmp_day = "0"&tmp_day
		end if
	rs("indexID")=tmp_PID&tmp_Year&tmp_Month&tmp_Day&tmpID
	rs.update
	rs.close
	set rs=nothing
	
	Response.Write("<script language='javascript'>alert('����������!\n\n���ȷ������');window.location.href='add_news.asp';</script>")
	Response.End()
end if
%>