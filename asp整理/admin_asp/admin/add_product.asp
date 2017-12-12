<!--#include file="../inc/conn.asp"-->
<!--#include file="anquan.asp"-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<link href="wlgr.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
.biao{width:200px; height:17px; border:1px solid #999999;}
-->
</style>





<script charset="utf-8" src="wushuang/kindeditor.js"></script>
		<script>
			KE.show({
				id : 'content1',
				cssPath : './index.css'
			});
</script>






</head>

<body>
<form name="form1" method="post" action="" onSubmit="return wlgr();">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B4CBE5">
    <tr>
      <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e7e7e7">
        <tr>
          <td height="25" colspan="2" align="center" bgcolor="#B4CBE5"><strong class="bai">添加产品</strong></td>
        </tr>
        <tr>
          <td width="129" height="24" align="right" bgcolor="#FFFFFF">产品名称:</td>
          <td width="568" bgcolor="#FFFFFF" style="padding-left:6px;"><input name="proname" type="text" class="kuang" id="proname"></td>
        </tr>
        <tr>
          <td height="24" align="right" bgcolor="#FFFFFF">上传图片:</td>
          <td bgcolor="#FFFFFF" style="padding-left:6px;"><iframe src="upload.asp" width="100%" height="30" frameborder="0" scrolling="no"></iframe></td>
        </tr>
        <tr>
          <td height="24" align="right" bgcolor="#FFFFFF">产品内容:</td>
          <td bgcolor="#FFFFFF" style="padding-left:6px;">&nbsp;</td>
        </tr>
        <tr>
          <td height="24" colspan="2" align="center" bgcolor="#FFFFFF"><textarea id="content1" name="content1" style="width:700px;height:300px;visibility:hidden;"></textarea></td>
          </tr>
        <tr>
          <td height="32" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit" class="input0" value="提交">&nbsp;&nbsp;
            <input name="Submit2" type="reset" class="input0" value="重置"></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
<%
if request.Form("submit")="提交" then

	proname = request.Form("proname")
	ltu=session("SaveFileName1")
	content1 = request.Form("content1")
	
	
	
	
	response.Write(ltu&"<br />"&proname&"<br />"&content1)
end if

%>
