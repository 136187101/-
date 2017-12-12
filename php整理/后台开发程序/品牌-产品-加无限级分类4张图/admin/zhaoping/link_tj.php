<?php 
@header('Content-type: text/html;charset=utf-8');

require '../../include/init.php';
require_once("../session.php");

if($Submit == "提交"){
 $conetnt=stripslashes($_POST[content]);
			$query = "INSERT INTO zhiwei(title,content,times,px)VALUES('$_POST[title]','$conetnt','$date','$_POST[px]')";
			if($db->query($query)){
			$js->Alert("添加成功");
			$js->Gotoxx("link_gl.php");
			}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
	<script charset="utf-8" src="../hjd_Ub/kindeditor.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
			});
		});
	</script>


</head>
<body>
<h1>
<span class="action-span"><a href="link_gl.php">职位列表</a></span>
<span class="action-span1">招聘管理</span><span id="search_id" class="action-span1"> - 添加职位 </span>
<div style="clear:both"></div>
</h1>
<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <div class="maindi">
    <table width="100%" id="general-table">
      <tr>
        <td width="9%" height="24" class="label" bgcolor="#FFFFFF"><span class="table_title">名称：&nbsp;&nbsp;</span></td>
        <td width="91%" height="24" align="left"bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="30" /></td>
      </tr>
                <tr>
                  <td height="24" class="label" bgcolor="#FFFFFF"><span class="table_title">内容：&nbsp;&nbsp;</span></td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><textarea name="content" style="width:90%;height:400px;visibility:hidden;"></textarea></td>
                </tr>
      <tr>
        <td height="24"  class="label" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
        <td height="24" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px2" value="0" size="5"/></td>
      </tr>
      <tr>
        <td class="label">&nbsp;</td>
        <td><input name="Submit" type="submit"  class="button" id="Submit3" value="提交" />
          <input name="Submit2" type="button" class="button" id="Submit4" value="返回" onclick='javascript:history.go(-1)';/></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
