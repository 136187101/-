<?php
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");
				$mys=10;
				$rs=$db->query("select * from liuyan");
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

				$rs=$db->query("select * from liuyan limit $myys,$mys");
$rows=$db->fetch_array($rs);
if($_GET['act'] == "del"){
$id=$_GET['id'];
$sql = "delete from liuyan where id = $id";
$db->query($sql);
$js->goto("liuyan.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/skin.css" rel="stylesheet" type="text/css">

</head>
<body>
<form id="form1" name="form1" method="post" action="">
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"></td>
        <td><table width="100%" height="25" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="30%" valign="middle"><table width="100%" height="25" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%"><span class="STYLE3">你当前的位置</span>：[留言板管理]-[管理]</td>
              </tr>
            </table></td>
            <td width="70%">&nbsp;</td>
          </tr>
        </table></td>
        <td width="16"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" background="../images/tab_12.gif">&nbsp;</td>
        <td>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
          <tr>
            <td width="1%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">序号</td>
            <td width="2%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">姓　名</td>
            <td width="2%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">性　别</td>
            <td width="4%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">Email</td>
            <td width="5%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">主  题</td>

            <td width="8%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">留言内容</td>
            <td width="8%" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">电话</td>
            <td width="4%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">时间</td>
            <td width="5%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">基本操作</td>
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
            <td height="20" align="center" bgcolor="#FFFFFF"><?=$i?></td>
            <td height="20" align="center" bgcolor="#FFFFFF"><?=$rs[name]?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$rs[xingbie]?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$rs[email]?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$rs[zhuti]?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $hjd->SubTitle($hjd->pregstring($rs[neirong]),20);?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$rs[dianhua]?></td>
             <td align="center" bgcolor="#FFFFFF"><?=$rs[shijian]?></td>
            <td height="20" align="center" bgcolor="#FFFFFF">
                    <a href="liuyanbj.php?act=edit&amp;id=<?=$rs[id]?>&amp;">查看</a>&nbsp; &nbsp;
                  <a href="?act=del&amp;id=<?=$rs[id]?>&amp;PB_page=<?=$_GET["PB_page"];?>" onclick="if(confirm('确定要删除该留言吗？')){return true}else{return false;}">删除</a>
             </td>
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
        <td width="12" height="35"></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="STYLE4">&nbsp;&nbsp;共有 <?=$zts?> 条记录，当前第 <?=$dqy?>/<?=$zys?> 页</td>
            <td align="right">【<a href="?dqy=1">首页</a>】【<a href="?dqy=<?php echo $dqy-1;?>">上一页</a>】【<a href="?dqy=<?php echo $dqy+1;?>">下一页</a>】【<a href="?dqy=<?php echo $zys;?>">末页</a>】</td>
          </tr>
        </table></td>
        <td width="16"></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>


</body>
</html>
