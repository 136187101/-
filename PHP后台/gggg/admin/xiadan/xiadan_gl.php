<?php
require_once("../../include/global.php");
require_once("../session.php");
$sql = "select * from zxxd order by times desc";
$pagepre = 15;
$db->setQuery($sql);
$zong = $db->num_rows();
	  if($zong == ""){
	  $kong = "<div style='padding-top:5px;'>当前还没有任何记录</div>";
	  $zong = 1 ;
	  }
	$liwqbjpage=new liwqpage(array('total'=>$zong,'perpage'=>$pagepre));
	$db->setQuery($sql,$liwqbjpage->offset(),$pagepre);
	if($_GET["PB_page"] == ""){
	$_GET["PB_page"]= 1;
	}
$jian = $db->loadObjectList();
$rst = $db->loadobject();

if($act == "del"){
$sql = "delete from zxxd where id = $id";
$db->setquery($sql);
$db->query();
$js->goto("?PB_page=$PB_page");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script src="../js/huanse.js"  language="javascript"></script>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" height="25" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="45%" valign="middle"><table width="100%" height="25" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[在线下单管理]-[下单管理]</td>
              </tr>
            </table></td>
            <td width="55%">&nbsp;</td>
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
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
          <tr>
            <td width="4%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="STYLE1">序号</span></td>
            <td width="11%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">姓名</td>
            <td width="18%" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">公司名称</td>
            <td width="22%" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">网址</td>
            <td width="18%" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">电子邮件</td>
            <td width="14%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">时间</td>
            <td width="13%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF" class="STYLE1">基本操作</td>
          </tr>
          <?php 
		  $i=1;
		  foreach($jian as $rs){
		  ?>
          <tr>
            <td height="20" align="center" bgcolor="#FFFFFF"><?=$i?></td>
            <td height="20" align="center" bgcolor="#FFFFFF"><?=$rs->names?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$rs->Company?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$rs->website?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$rs->email?></td>
            <td align="center" bgcolor="#FFFFFF"><?=date("Y-m-d",$rs->times);?></td>
            <td height="20" align="center" bgcolor="#FFFFFF">
                    <a href="xiadan_x.php?id=<?=$rs->id?>">查看详细</a>&nbsp;
                  <a href="?act=del&amp;id=<?=$rs->id?>&amp;PB_page=<?=$_GET["PB_page"];?>" onclick="return ConfirmDelBig();"><img src="../images/del.gif" width="16" height="16" border="0" />删除</a></td>
          </tr>
          <?php 
		   $i++;
		   }?>
        </table>
        <?=$kong?></td>
        <td width="8" background="../images/tab_15.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="35"><img src="../images/tab_18.gif" width="12" height="35" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="STYLE4">&nbsp;&nbsp;共有 <?=$zong?> 条记录，当前第 <?=$_GET["PB_page"];?>/<?=$liwqbjpage->totalpage?> 页</td>
            <td align="right"><?=$liwqbjpage->show(3)?></td>
          </tr>
        </table></td>
        <td width="16"><img src="../images/tab_20.gif" width="16" height="35" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
<script src="../js/tu.js"  language="javascript"></script>
</body>
</html>
