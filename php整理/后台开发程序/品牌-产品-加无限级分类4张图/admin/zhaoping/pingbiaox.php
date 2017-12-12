<?php 
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");
$id=$_GET['id'];
//echo $id;
if($_GET['act'] == "edit"){

$sql = "select * from pingbiao where id =$id ";
//echo $sql;
$rows = $db->getOne($sql);
}
$zhiwei=$wy->get_one("select * from zhiwei where id = '$rows[zid]'");

//回复
if($_POST["Submit"])
{
		$content=$_POST["content"];
		$db->query("INSERT INTO `reply` (`l_id`, `content`, `xianshi`, `times`) VALUES ('$id', '$content', '0', '$date');");
		$js->Alert("回复成功");
		$js->Gotoxx("liuyanbj.php?id=$id&act=edit");
}
//删除回复
if($_GET["de"]==1)
{
	
	$db->query("delete from reply where id = '$_GET[did]'");
	$js->Alert("删除成功");
	$js->Gotoxx("liuyanbj.php?id=$id&act=edit");
}
//修改回复
if($_POST["update"])
{
	$content=$_POST["content1"];
	$db->query("update reply set content='$content' where id = '$_POST[upid]'");
	$js->Alert("修改成功");
	$js->Gotoxx("liuyanbj.php?id=$id&act=edit");
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
<span class="action-span"><a onclick="javascript:history.go(-1)" href="#" >应聘列表</a></span>
<span class="action-span1">招聘管理</span><span id="search_id" class="action-span1"> - 应聘人详细信息 </span>
<div style="clear:both"></div>
</h1>

<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">

            <div class="main-div">
              <table width="100%" style="border-collapse:collapse;" id="general-table">
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">应聘职位：&nbsp;&nbsp;</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><?php echo $zhiwei["title"]?></td>
                </tr>
                <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">姓　名：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[name];?>
                 </td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">性 别：&nbsp;&nbsp;</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><?=$rows[sex];?></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">年龄：&nbsp;&nbsp;</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><?=$rows[nl];?></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">学历：&nbsp;&nbsp;</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><?=$rows[xueli];?></td>
                </tr>

                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">Email：&nbsp;&nbsp;</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><?=$rows[email];?></td>
                </tr>
				
				 <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">电话：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[tel];?>
                 </td>
                </tr>
				 <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">工作经验：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[jingli];?>
                 </td>
                </tr>
                <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">自我介绍：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[jieshao]?>
                 </td>
                </tr>
                <tr> 
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">时间：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[times]?>
                 </td>
                </tr>
                  <tr>
                    <td class="label">&nbsp;</td>
                    <td align="left"><input name="button2" type="button" class="button" id="button2" value="返回" onclick="javascript:history.go(-1)" /></td>
                  </tr>
              </table>
        </div>            </form>
</body>
</html>

