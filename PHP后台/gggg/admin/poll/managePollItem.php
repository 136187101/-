<?php
require_once("../../include/global.php");
require_once("../session.php");
if(!$tid) die('参数错误');
if($act == "del"){
	$sql = "delete from pollitem where id=$id";
	$db->setQuery($sql);
	$db->query();
	$js->Goto("managePollItem.php?tid=$tid&msg=".urlencode("删除成功"));
}
$sql = "select title from pollTitle where id=$tid";
$db->setQuery($sql);
$pollTitle = $db->loadResult();
$sql = "select * from pollitem where tid=$tid";
$db->setQuery($sql);
$result = $db->loadObjectList();
if($Submit == "提交"){
	$sql = "insert into pollitem(tid,pollitem) values('$tid','$pollitem')";
	$db->setQuery($sql);
	if($db->query()){
		$js->Goto("managePollItem.php?tid=$tid&msg=".urlencode("添加成功"));
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<script src="../js/huanse.js"></script>
<script src="../js/tancu.js"></script>
</head>
<body>
	<div align="center"><font color="Red"><?=urldecode($msg);?></font></div>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="14" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tr>
                  <td width="53%" valign="middle"><table width="73%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                      <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[投票管理]-[<a href="managePollTitle.php">投票管理项目</a>]</td>
                    </tr>
                  </table></td>
                  <td width="47%" align="right">&nbsp;</td>
              </tr>
            </table></td>
            <td width="12"><img src="../images/tab_07.gif" width="16" height="30" /></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <form id="form1" name="form1" method="post" action="">	
          <tr>
            <td width="9" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center">
			<table width="80%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CDE9FC">
    <tr>
      <td height="22" colspan="3" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><?=$pollTitle?></td>
    </tr>
    <tr>
      <td width="323" height="22" align="center" bgcolor="#FFFFFF">项目名称</td>
      <td width="98" height="22" align="center" bgcolor="#FFFFFF">票数</td>
      <td width="178" height="22" align="center" bgcolor="#FFFFFF">操作</td>
    </tr>
	<?php
	foreach($result as $row){
	?>
    <tr>
      <td height="22" align="center" bgcolor="#FFFFFF"><?=$row->pollitem?></td>
      <td height="22" align="center" bgcolor="#FFFFFF"><?=$row->poll?></td>
      <td height="22" align="center" bgcolor="#FFFFFF"><a href="editPollItem.php?id=<?=$row->id?>&amp;tid=<?=$tid?>"><img src="../images/edt.gif" width="16" height="16" border="0" />编辑</a>&nbsp;| <a href="managePollItem.php?act=del&amp;id=<?=$row->id?>&amp;tid=<?=$tid?>" onclick="return ConfirmDelBig();"><img src="../images/del.gif" width="16" height="16" border="0" />删除</a></td>
    </tr>
	<?php
	}
	?>
    <tr>
      <td height="22" colspan="3" align="left" bgcolor="#FFFFFF"><input name="pollitem" type="text" id="pollitem" />
      <input type="submit" name="Submit" class="anniu" value="提交" />
      &nbsp; <input name="fanhui" type="button" class="anniu" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
    </tr>
  </table>
			</td>
            <td width="8" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
	</form>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35"><img src="../images/tab_18.gif" width="12" height="35" /></td>
            <td>&nbsp;</td>
            <td width="16"><img src="../images/tab_20.gif" width="16" height="35" /></td>
          </tr>
      </table></td>
    </tr>
  </table>
</body>
</html>
