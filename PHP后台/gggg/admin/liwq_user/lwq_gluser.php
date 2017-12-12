<?php 
require_once("../../include/global.php");
require_once("../session.php");
	if($_SESSION["user_id"] == 1){
    $sql = "select * from lwq_user";
	}else{
	$sql = "select * from lwq_user where admin = 0";	
	}
	$db->setQuery($sql);
	$row = $db->loadObjectList();
 if($_GET["act"] == "del"){
	if($_SESSION["user_id"]==$_GET["idd"]){
	$js->Alert("当前管理员不能删除！");
	$js->Goto("lwq_gluser.php");
	}else{
	$sql = "delete from lwq_user where id =".$_GET["idd"];
	$db->setQuery($sql);
	$db->query();
	$js->Alert("删除成功！");
	$js->Goto("lwq_gluser.php");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script src="../js/huanse.js"></script>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[系统管理]-[管理员管理]</td>
              </tr>
            </table></td>
            <td width="54%">&nbsp;</td>
          </tr>
        </table></td>
        <td width="16"><img src="../images/tab_07.gif" width="16" height="30" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" background="../images/tab_12.gif">&nbsp;</td>
        <td align="center"><table width="60%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
          <tr>
            <td width="5%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="STYLE1">序号</span></td>
            <td width="31%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">管理员名称</td>
            <td width="25%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">时间</td>
            <td width="39%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF" class="STYLE1">基本操作</td>
          </tr>
		  <?php 
		  $i=1;
		  foreach($row as $rs){
		  ?>		  
          <tr>
            <td height="20" align="center" bgcolor="#FFFFFF"><?=$i?></td>
            <td height="20" align="center" bgcolor="#FFFFFF">
			<?php if($rs->id == $_SESSION["id"]){?>
			<font color="#CF2B0E"><?=$rs->username?></font>
			<?php }else{?>
			<?=$rs->username?>
			<?php }?>
			</td>
            <td height="20" align="center" bgcolor="#FFFFFF"><?=date("Y-m-d",$rs->times)?></td>
            <td height="20" align="center" bgcolor="#FFFFFF">
            <?php if($_SESSION["user_id"] == "1"){?>
           <a href="lwq_qxuser.php?id=<?=$rs->id?>"><img src="../images/tjsy.png" width="16" height="16" border="0" />权限分配</a>
			<?php }?>
			<a href="lwq_edituser.php?id=<?=$rs->id?>"><img src="../images/edt.gif" width="16" height="16" border="0" />编辑</a>
			<a href="lwq_gluser.php?act=del&amp;idd=<?=$rs->id?>" onclick="return ConfirmDelBig();"><img src="../images/del.gif" width="16" height="16" border="0" />删除</a>
			</td>
          </tr>
		   <?php 
		   $i++;
		   }?> 
        </table></td>
        <td width="8" background="../images/tab_15.gif">&nbsp;</td>
      </tr>
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

