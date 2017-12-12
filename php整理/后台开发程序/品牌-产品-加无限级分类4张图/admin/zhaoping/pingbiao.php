<?php
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");
				$mys=10;
				$rs=$db->query("select * from pingbiao order  by times desc");
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

				$rs=$db->query("select * from pingbiao order  by times desc limit $myys,$mys");
$rows=$db->fetch_array($rs);
if($_GET['act'] == "del"){
$id=$_GET['id'];
$sql = "delete from pingbiao where id = $id";
$db->query($sql);
$js->Gotoxx("pingbiao.php");
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
<span class="action-span1">招聘管理</span><span id="search_id" class="action-span1"> - 应聘表 </span>
<div style="clear:both"></div>
</h1>

<form id="form1" name="form1" method="post" action="">
  <div class="list-div" id="listDiv">
    <table width="100%" cellpadding="3" cellspacing="1" id="listTable">
    <tr>
      <th width="4%">序号</th>
      <th width="9%">应聘职位</th>
      <th width="5%">姓　名</th>
      <th width="5%">性　别</th>
      <th width="16%">Email</th>
      <th width="8%">学历</th>
      <th width="8%">年龄</th>
      <th width="11%">电话</th>
      <th width="15%">时间</th>
      <th width="19%">操作</th>
    </tr>
    <?php 
		  $f=$db->fetch_nums($rs);
		  if($f==0)
		 	{
				echo "<td colspan='10'align='center' style='color:#F00; font-size:12px;'>暂没有信息</td>";	
				exit();
			}
		  $i=1;
		  foreach($rows as $rs){
		  ?>
    <tr>
      <td class="first-cell"><?=$i?></td>
      <td><?php 
			$zhiwei=$wy->get_one("select * from zhiwei where id = '$rs[zid]'");
			echo $zhiwei["title"];
			
			?></td>
      <td align="center"><?=$rs[name]?></td>
      <td align="center"><?=$rs[sex]?></td>
      <td align="center"><?=$rs[email]?></td>
      <td align="center"><?=$rs[xueli]?></td>
      <td align="center"><?=$rs[nl]?></td>
      <td align="center"><?=$rs[tel]?></td>
      <td align="center"><?=$rs[times]?></td>
      <td align="center"><a href="pingbiaox.php?act=edit&amp;id=<?=$rs[id]?>">查看</a>&nbsp; &nbsp; <a href="?act=del&amp;id=<?=$rs[id]?>&amp;PB_page=<?=$_GET["PB_page"];?>" onclick="if(confirm('确定要删除吗？')){return true}else{return false;}">删除</a></td>
    </tr>
    <?php 
		   $i++;
		   }
		   ?>
    <tr>
      <td align="right" nowrap="nowrap" colspan="12"><!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
        <div id="turn-page">
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
        </div></td>
    </tr>
  </table>
</div>
</form>


</body>
</html>
