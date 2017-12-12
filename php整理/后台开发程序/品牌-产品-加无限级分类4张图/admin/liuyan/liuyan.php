<?php
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");


				$mys=10;
				$rs=$db->query("select * from tiyan");
				 $zts=mysql_num_rows($rs);
				if($zts==0)
				{
					$zts=1;	
				}		
				
				$zys=ceil($zts/$mys);

				$dqy=$_GET[dqy];
				if($dqy=="" || $dqy<1)
				{
					$dqy=1;	
				}
				if($dqy>$zys)
				{
					$dqy=$zys;	
				}
				

				$myys=($dqy-1)*$mys;

				$rs=$db->query("select * from tiyan  limit $myys,$mys");
$rows=$db->fetch_array($rs);
if($_GET['act'] == "del"){
$id=$_GET['id'];
$sql = "delete from tiyan where id = $id";
$db->query($sql);
$js->Gotoxx("liuyan.php");
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
<span class="action-span1">与设计师互动体验</span><span id="search_id" class="action-span1">  </span>
<div style="clear:both"></div>
</h1>

<form id="form1" name="form1" method="post" action="">
  <div class="list-div" id="listDiv">
    <table width="100%" border="0" cellpadding="3" cellspacing="1" id="listTable">
    <tr>
      <th>序号</th>
      <th>姓　名</th>
      <th>改造面积（影音室）</th>
      <th>电话</th>
      <th>时间</th>
      <th>操作</th>
    </tr>
         <?php 
		  $f=$db->fetch_nums($rs);
		  if($f==0)
		 	{
				echo "<td colspan='10'align='center' style='color:#F00; font-size:12px;'>暂没有留言</td>";	
				exit();
			}
		  $i=1;
		  foreach($rows as $rs){
		  ?>
    <tr>
      <td class="first-cell"><?=$i?></td>
      <td><?=$rs[name]?></td>
      <td align="center"><?=$rs[mianji]?></td>
      <td align="center"><?=$rs[tel]?></td>
      <td align="center"><?=$rs[times]?></td>
      <td align="center">&nbsp; &nbsp; <a href="?act=del&amp;id=<?=$rs[id]?>&amp;PB_page=<?=$_GET["PB_page"];?>" onclick="if(confirm('确定要删除该留言吗？')){return true}else{return false;}">删除</a></td>
    </tr>
      <?php 
		   $i++;
		   }
		   ?>
    <tr>
      <td align="right" nowrap="nowrap" colspan="6"><!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
        
          <table width="95%" border="0" align="center"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" class="ye">
            <tr style="border:1px #bfd8e0 solid;">
              <td width="65%" height="28" align="left" bgcolor="#F9FCFD"><span class="STYLE4">&nbsp;&nbsp;共有
                  <?=$zts?>
条记录，当前第
<?=$dqy?>
/
<?=$zys?>
页</span></td>
              <td width="30%" align="right" bgcolor="#F9FCFD">【<a href="?dqy=1">首页</a>】【<a href="?dqy=<?php echo $dqy-1;?>">上一页</a>】【<a href="?dqy=<?php echo $dqy+1;?>">下一页</a>】【<a href="?dqy=<?php echo $zys;?>">末页</a>】</td>
            </tr>
          </table>
        </td>
    </tr>
  </table>
</div>
</form>


</body>
</html>
