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




</head>

<body>
<form name="form1" method="post" action="" onSubmit="return wlgr();">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B4CBE5">
    <tr>
      <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e7e7e7">
        <tr>
          <td height="25" colspan="2" align="center" bgcolor="#B4CBE5"><strong class="bai">添加新闻</strong></td>
        </tr>
        <tr>
          <td width="129" height="24" align="right" bgcolor="#FFFFFF">标题:</td>
          <td width="568" bgcolor="#FFFFFF" style="padding-left:6px;"><input name="zjwlgrusername" type="text" class="kuang" id="zjwlgrusername"></td>
        </tr>
        <tr>
          <td height="24" align="right" bgcolor="#FFFFFF">内容:</td>
          <td bgcolor="#FFFFFF" style="padding-left:6px;">&nbsp;</td>
        </tr>
        <tr>
          <td height="24" colspan="2" align="center" bgcolor="#FFFFFF"><iframe ID="eWebEditor1" src="zjwlgrxtwvfwlgr/eWebEditor/ewebeditor.asp?id=content&style=js_type" frameborder="0" scrolling="no" width="100%" HEIGHT="400"></iframe>
    <input type="hidden" name="Content" id="content" value="此处修改新闻内容"/></td>
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
