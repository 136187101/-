<?php 
@header('Content-type: text/html;charset=utf-8');

require '../../include/init.php';
require_once("../session.php");

if($Submit == "提交"){
			$query = "INSERT INTO bandrfl(fuid,title,px,times)VALUES('$fuid','$_POST[title]','$_POST[px]','$date')";
			if($db->query($query)){
			$js->Alert("添加成功");
			$js->Gotoxx("pinpai.php?fuid=$fuid");
			}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
</head>
<body>
<h1>
<span class="action-span"><a href="pinpai.php">品牌分类列表</a></span>
<span class="action-span1">品牌分类管理</span><span id="search_id" class="action-span1"> - 添加品牌分类 </span>
<div style="clear:both"></div>
</h1>

<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <div class="main-div">
    <table width="100%" id="general-table">

                <tr>
                  <td height="24"  class="label" bgcolor="#FFFFFF">名称：&nbsp;&nbsp;</td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="30" /></td>
                </tr>
                <tr>
                  <td height="24"  class="label" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="0" size="5"/></td>
                </tr>
				
      <tr>
        <td class="label">&nbsp;</td>
        <td><input name="Submit" type="submit"  class="button" id="Submit" value="提交" />
          <input type="reset" value=" 重置 " class="button" />
</td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
