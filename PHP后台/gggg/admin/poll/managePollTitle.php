<?php
require_once("../../include/global.php");
require_once("../session.php");
if($act == "del"){
	$sql = "delete from pollTitle where id = $id";
	$db->setQuery($sql);
	$db->query();
	$sql = "delete from pollitem where tid = $id";
	$db->setQuery($sql);
	$db->query();
	$js->Goto("managePollTitle.php?msg=".urlencode('删除成功'));
}elseif($act == "choose"){
	$db->setQuery("update polltitle set `show`=0");
	$db->query();
	$sql = "update polltitle set `show`=1 where id=$id";
	$db->setQuery($sql);
	$db->query();
	$js->Goto("managePollTitle.php?msg=".urlencode('选择完成'));
}
$sql = "select a.*,(select sum(poll) from pollitem where tid= a.id) as pollnum from pollTitle as a order by pollnum desc";
$db->setQuery($sql);
$result = $db->loadObjectList();
if($Submit=="提交"){
	$sql ="INSERT INTO pollTitle(title,pollType) values('$title','$pollType')";
	$db->setQuery($sql);
	if($db->query()){
		$js->Goto("managePollTitle.php?msg=".urlencode("添加成功"));
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
                <td width="37%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                    <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[投票管理]-[<a href="managePollTitle.php">投票管理项目</a>]</td>
                  </tr>
                </table></td>
                <td align="right">&nbsp;</td>
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
			<table width="80%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CDEAFB">
    <tr>
      <td width="184" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">投票的名称</td>
      <td width="127" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">投票类型</td>
      <td width="80" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">总票数</td>
      <td width="210" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">操作</td>
    </tr>
    <?php

    for($i=0;$i<count($result);$i++){
    ?>
    <tr>
      <td height="22" align="center" bgcolor="#FFFFFF"><?=$result[$i]->title?></td>
      <td height="22" align="center" bgcolor="#FFFFFF"><?php echo $result[$i]->pollType ? '多选' : '单选';?></td>
      <td height="22" align="center" bgcolor="#FFFFFF"><?=$result[$i]->pollnum?></td>
      <td height="22" align="center" bgcolor="#FFFFFF"><a href="managePollItem.php?tid=<?=$result[$i]->id?>">项目管理</a>
       |
         <?php
       if(!$result[$i]->show){
       ?>
         <a href="managePollTitle.php?act=choose&amp;id=<?=$result[$i]->id?>">选择</a>
         <?php
       }else{
       ?>
<font color="#FF0000">&radic;</font>
<?php }?>|<a href="editPollTitle.php?id=<?=$result[$i]->id?>"><img src="../images/edt.gif" width="16" height="16" border="0" />编辑</a>|<a href="managePollTitle.php?act=del&id=<?=$result[$i]->id?>" onclick="return ConfirmDelBig();"><img src="../images/del.gif" width="16" height="16" border="0" />删除</a></td>
    </tr>
    <?php
    }
    ?>
    <tr>
      <td colspan="4" align="left" bgcolor="#FFFFFF">&nbsp;<input type="text" name="title" />
      <input type="radio" name="pollType" value="1" checked />
      多选
      <input type="radio" name="pollType" value="0" />
      单选
      <input type="submit" name="Submit" class="anniu" value="提交" /></td>
    </tr>
  </table>
            <?=$kong?></td>
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
