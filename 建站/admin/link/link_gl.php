<?php
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");

$sql = "select * from link order by px desc";
$pagepre = 8;
$num=$db->setQuery($sql);
$zong = $db->fetch_nums($num);
	  if($zong == ""){
	  $kong = "<div style='padding-top:5px;'>当前还没有任何记录</div>";
	  $zong = 1 ;
	  }

	$liwqbjpage=new liwqpage(array('total'=>$zong,'perpage'=>$pagepre));
	$fetch=$db->setQuery($sql,$liwqbjpage->offset(),$pagepre);
	if($_GET["PB_page"] == ""){
	$_GET["PB_page"]= 1;
	}
	
$jian = $db->fetch_array($fetch);
$rst = $db->fetch_object($fetch);


if($act == "del"){
$sql = "delete from link where id = $id";

$db->query($sql);
$js->goto("?PB_page=$PB_page");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/skin.css" rel="stylesheet" type="text/css">
<script>
function ConfirmDelBig()
{
   if(confirm("确定要删除吗？一旦删除不能恢复！"))
     return true;
   else
     return false;
	 
}


</script>

</head>
<body>

<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <form id="form1" name="form1" method="post" action=""><tr>
    <td height="30" background="../images/tab_05.gif"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="Navitable">
      <tr>
        <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="2%" height="26"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
              <td width="48%"><strong><span style="background:url(tpl/images/th_bg.gif);  padding-left:10px; border:none;"><a href="link_tj.php">添加友情链接</a></span></strong></td>
              <td width="50%" align="right"><span class="STYLE3">你当前的位置</span>：[<strong><a href="link_tj.php">友情链接</a></strong>管理]
<?=$row_zilei?></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" background="../images/tab_12.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
          <tr>
            <td width="3%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">序号</td>
          <td width="10%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">logo图</td>
            <td width="17%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">名称</td>
            <td width="23%" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">连接地址</td>
            <td width="15%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">时间</td>
            <td width="6%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">排序</td>
            <td width="16%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">基本操作</td>
          </tr>
          <?php 
		  $i=1;
		  foreach($jian as $rs){
		  ?>
          <tr>
            <td height="20" align="center" bgcolor="#FFFFFF"><?=$i?></td>
            <td height="20" align="center" bgcolor="#FFFFFF"><img src="<?="../../".$rs[image]?>" width="120" height="50"  /></td>
            <td align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;<?=$rs[title]?></td>
            <td height="20" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;<?=$rs[http]?></td>
            <td align="center" bgcolor="#FFFFFF"><?=date("Y-m-d",$rs[times]);?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$rs[px]?></td>
            <td height="20" align="center" bgcolor="#FFFFFF">
                    <a href="link_up.php?act=edit&amp;id=<?=$rs[id]?>&PB_page=<?=$_GET["PB_page"];?>">编辑</a>&nbsp; &nbsp;
                    <a href="?act=del&amp;id=<?=$rs[id]?>&PB_page=<?=$_GET["PB_page"];?>" onclick="return ConfirmDelBig();">删除</a></td>
          </tr>
          <?php 
		   $i++;
		   }
		   ?>
        </table>
        <?=$kong?></td>
        <td width="8" background="../images/tab_15.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="35">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="STYLE4">&nbsp;&nbsp;共有 <?=$zong?> 条记录，当前第 <?=$_GET["PB_page"];?>/<?=$liwqbjpage->totalpage?> 页</td>
            <td align="right"><?=$liwqbjpage->show(3)?></td>
          </tr>
        </table></td>
        <td width="16">&nbsp;</td>
      </tr>
    </table></td>
  </tr></form>
</table>

</body>
</html>
