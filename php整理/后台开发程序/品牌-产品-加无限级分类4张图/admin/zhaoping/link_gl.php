<?php
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");

$sql = "select * from zhiwei order by px desc";
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
$sql = "delete from zhiwei where id = $id";

$db->query($sql);
$js->Gotoxx("?PB_page=$PB_page");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
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
<h1>
<span class="action-span"><a href="link_tj.php">添加职位</a></span>
<span class="action-span1">招聘管理</span><span id="search_id" class="action-span1"> - 职位列表 </span>
<div style="clear:both"></div>
</h1>
<div class="list-div" id="listDiv">
  <table width="100%" cellpadding="3" cellspacing="1" id="listTable">
    <tr>
      <th width="9%">序号</th>
      <th width="17%">职位</th>
      <th width="6%">应聘人数</th>
      <th width="19%">时间</th>
      <th width="15%">排序</th>
      <th width="34%">操作</th>
    </tr>
    <?php 
		  $i=1;
		  foreach($jian as $rs){
		  ?>
    <tr>
      <td class="first-cell"><?=$i?></td>
      <td align="center"><?=$rs[title]?></td>
      <td align="center"><?php 
				$yp=$wy->query("select * from pingbiao where zid = '$rs[id]'");
				echo $wy->num_rows($yp);
			?></td>
      <td align="center"><?=$rs[times];?></td>
      <td align="center"><?=$rs[px]?></td>
      <td align="center"><a href="link_up.php?act=edit&amp;id=<?=$rs[id]?>&amp;PB_page=<?=$_GET["PB_page"];?>">编辑</a>&nbsp; &nbsp; <a href="?act=del&amp;id=<?=$rs[id]?>&amp;PB_page=<?=$_GET["PB_page"];?>" onclick="return ConfirmDelBig();">删除</a></td>
    </tr>
    <?php 
		   $i++;
		   }
		   ?>
    <tr>
      <td align="right" nowrap="nowrap" colspan="8"><!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
        <div id="turn-page">
          <table width="95%" border="0" align="center"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" class="ye">
            <tr style="border:1px #bfd8e0 solid;">
              <td width="65%" height="28" align="left" bgcolor="#F9FCFD"><span class="STYLE4">共有
                  <?=$zong?>
条记录，当前第
<?=$_GET["PB_page"];?>
/
<?=$liwqbjpage->totalpage?>
页</span></td>
              <td width="30%" align="right" bgcolor="#F9FCFD"><?=$liwqbjpage->show(3)?></td>
            </tr>
          </table>
        </div></td>
    </tr>
  </table>
</div>
</body>
</html>
