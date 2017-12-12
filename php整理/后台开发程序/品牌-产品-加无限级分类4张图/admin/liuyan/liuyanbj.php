<?php 
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");
switch($type){
	case '0':
	$title="在线留言";
	$contit="留言内容";
	break;
	case '1':
	$title="投诉信息";
	$contit="投诉内容";
	break;
	case '2':
	$title="改进建议";
	$contit="建议内容";
	break;
	}

$id=$_GET['id'];
//echo $id;
if($_GET['act'] == "edit"){

$sql = "select * from liuyan where id =$id ";
//echo $sql;
$rows = $db->getOne($sql);
}

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
<span class="action-span"><a onclick="javascript:history.go(-1)" >留言列表</a></span>
<span class="action-span1"><?=$title?>管理</span><span id="search_id" class="action-span1"> - 查看留言 </span>
<div style="clear:both"></div>
</h1>

<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
<div class="main-div">
    <table width="100%" style="border-collapse:collapse;" id="general-table">
                <tr>
                  <td width="11%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">姓　名：&nbsp;&nbsp;</span></td>
                  <td width="89%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[name];?>
                 </td>
                </tr>

                <tr>
                  <td width="11%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">Email：&nbsp;&nbsp;</span></td>
                  <td width="89%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[email];?>
                 </td>
                </tr>
				
				 <tr>
                  <td width="11%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">电话：&nbsp;&nbsp;</span></td>
                  <td width="89%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[dianhua];?>
                 </td>
                </tr>
                <tr>
                  <td width="11%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">主  题：&nbsp;&nbsp;</span></td>
                  <td width="89%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[zhuti]?>
                 </td>
                </tr>

                <tr>
                  <td width="11%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title"><?php echo $contit?>：&nbsp;&nbsp;</span></td>
                  <td width="89%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[neirong]?>
                 </td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">时间：&nbsp;&nbsp;</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><?=$rows[shijian]?></td>
                </tr>
                    <td class="label">&nbsp;</td>
                    <td><input name="button" type="button" class="button" id="button" value="返回" onclick="javascript:history.go(-1)" /></td>
                  </tr>
              </table>
  </div>
</form>
</body>
</html>

