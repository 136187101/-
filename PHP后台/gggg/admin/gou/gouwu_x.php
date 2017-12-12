<?php 
require_once("../../include/global.php");
require_once("../session.php");
if($act=="deal"){
	$sql = "update buy set state=1 where id=$id";
	$db->setQuery($sql);
	$db->query();
}
if($act=="deal1"){
	$sql = "update buy set state=2 where id=$id";
	$db->setQuery($sql);
	$db->query();
}
if($act=="deal2"){
	$sql = "update buy set state=3 where id=$id";
	$db->setQuery($sql);
	$db->query();
}
$query = "select * from buy where id=$id";
$db->setQuery($query);
$row = $db->loadObject();
$query = "select a.*,b.title,b.jiage,b.jifen,b.image from belong a left join product b on a.pid=b.id where a.bid=".$row->id;
$db->setQuery($query);
$rows = $db->loadObjectList();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<script>
function ConfirmDelBig()
{
   if(confirm("此用户将处于，未付款进行中状态"))
     return true;
   else
     return false;
}
function ConfirmDelBig1()
{
   if(confirm("此用户将处于，已付款进行中状态"))
     return true;
   else
     return false;
}
function ConfirmDelBig2()
{
   if(confirm("您确定此用户已经付款了吗？"))
     return true;
   else
     return false;
}
</script>
<style type="text/css">
<!--
.STYLE7 {	font-size: 12px;
	color: #033d61; text-decoration:none
}
-->
</style>
</head>
<body>
<form id="form1" name="form1" method="post" action="" onsubmit="return liwq();">
  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="12" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                  <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[会员管理]-[<a href="../lianxi/gl_lianxi.php" target="liwqbj2" class="STYLE7">订单信息管理</a>]-[<?=$row->name?>]</td>
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
          <td align="center"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
  <tr>
    <td height="22" colspan="6" background="../images/bg.gif"><?=$row->id?>号订单</td>
  </tr>
  <tr>
    <td width="13%" height="22" align="right" bgcolor="#FFFFFF">订单人姓名：</td>
    <td width="18%" height="22" align="center" valign="middle" bgcolor="#FFFFFF"> &nbsp;<?=$row->nickname?></td>
    <td width="17%" align="right" bgcolor="#FFFFFF">订单人手机号：</td>
    <td width="19%" align="center" bgcolor="#FFFFFF"> &nbsp;<?=$row->tel?></td>
    <td width="12%" align="right" bgcolor="#FFFFFF">订单人QQ：</td>
    <td width="21%" align="center" bgcolor="#FFFFFF"> &nbsp;<?=$row->QQ?></td>
  </tr>
  <tr>
    <td height="22" align="right" bgcolor="#FFFFFF">订单状态：</td>
    <td height="22" align="center" valign="middle" bgcolor="#FFFFFF">
	<font color="red">
	<?php 
		if($row->state == 0){
		echo "<font color='red'>未付款</font>";
		}elseif($row->state == 1){
		echo "<font color='red'>未付款进行中</font>";
		}elseif($row->state == 2){
		echo "<font color='red'>已付款进行中</font>";
		}elseif($row->state ==3){
		echo "<font color='red'>订单成功</font>";
		}
	?>
	</font>	</td>
    <td height="22" align="right" bgcolor="#FFFFFF">订单人EMAIL：</td>
    <td height="22" align="center" bgcolor="#FFFFFF"> &nbsp;<?=$row->email?></td>
    <td height="22" align="right" bgcolor="#FFFFFF">订单时间：</td>
    <td height="22" align="center" bgcolor="#FFFFFF"> &nbsp;<?=date("Y-m-d ",$row->btime)?></td>
  </tr>
  <tr>
    <td height="22" align="right" bgcolor="#FFFFFF">送货日期：</td>
    <td height="22" align="center" valign="middle" bgcolor="#FFFFFF">&nbsp;<?=$row->post_date?></td>
    <td height="22" align="right" bgcolor="#FFFFFF">送货时间：</td>
    <td height="22" align="center" bgcolor="#FFFFFF">&nbsp;<?=$row->post_time?></td>
    <td height="22" align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="22" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" align="right" bgcolor="#FFFFFF">订单人居住地：</td>
    <td height="22" align="center" valign="middle" bgcolor="#FFFFFF">&nbsp;<?=$row->zhuzhi?></td>
    <td height="22" align="right" bgcolor="#FFFFFF">配送方式<strong>：</strong></td>
    <td height="22" align="center" bgcolor="#FFFFFF">&nbsp;<?=$row->post?></td>
    <td height="22" align="right" bgcolor="#FFFFFF">支付方式<strong>：</strong></td>
    <td height="22" align="center" bgcolor="#FFFFFF"> &nbsp;<?=$row->bank?></td>
  </tr>
  <tr>
    <td height="22" colspan="6" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp; 送货地址：&nbsp; &nbsp;</td>
    </tr>
	  <tr>
	    <td height="22" colspan="6" align="left" bgcolor="#FFFFFF" style="padding-left:90px; padding-right:10px; line-height:20px;"><?=$row->dizhi?></td>
	    </tr>
	  <tr>
	    <td height="22" colspan="6" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp; 送回说明：</td>
	    </tr>
	  <tr>
    <td height="22" colspan="6" align="left" bgcolor="#FFFFFF" style="padding-left:90px; padding-right:10px; line-height:20px;"><?=$row->shuoming?></td>
    </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#FFFFFF">
	
	<table width="90%" border="0" cellpadding="0" cellspacing="1" bgcolor="#B5D6E6" style="margin:5px;">
      <tr>
        <td width="9%" height="22" align="center" background="../images/bg.gif">产品图片</td>
        <td width="34%" height="22" align="center" background="../images/bg.gif">产品名称</td>
        <td width="20%" height="22" align="center" background="../images/bg.gif">产品价格</td>
        <td width="19%" height="22" align="center" background="../images/bg.gif">产品数量</td>
        <td width="18%" height="22" align="center" background="../images/bg.gif">小计</td>
      </tr>
	<?php
	$sum = 0;
	foreach($rows as $rs){
	$xiaoji=$rs->jiage*$rs->num;
	?>  
      <tr>
        <td height="22" align="center" bgcolor="#FFFFFF"><img src="<?=$rs->image?>" width="40" height="40" style="border:#CCCCCC groove 2px;"/></td>
        <td align="center" bgcolor="#FFFFFF"><?=$rs->title?></td>
        <td align="center" bgcolor="#FFFFFF">￥<?=$rs->jiage?> 元 </td>
        <td height="22" align="center" bgcolor="#FFFFFF"><?=$rs->num?>个</td>
        <td height="22" align="center" bgcolor="#FFFFFF">￥<?=$xiaoji?>元</td>
      </tr>
	<?php
		$sum +=$rs->num*$rs->jifen;
		$sum1 +=$rs->num*$rs->jiage;
	}	
	?>  
      <tr>
        <td height="22" colspan="5" align="right" bgcolor="#FFFFFF">价格总计：<font color="red"><?php echo $sum1?></font>&nbsp;元&nbsp;&nbsp;&nbsp;积分总计：<font color="red"><?php echo $sum?></font> 分&nbsp;&nbsp;邮递费用<font color="red"><?php if($row->post == "平邮"){
					echo "0";}elseif($row->post == "EMS快递"){ 
					echo "20";}elseif($row->post == "顺丰快递"){
					echo "10";}elseif($row->post == "宅急送"){ 
					echo "15";}
					?></font>元 </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="25" colspan="6" align="center" valign="middle" bgcolor="#FFFFFF">
	<?php if($row->state == 0){?>
    <a href="?act=deal&id=<?=$row->id?>" onclick="return ConfirmDelBig();">处理未付款订单</a>
    <?php }elseif($row->state == 1){?>
	<a href="?act=deal1&id=<?=$row->id?>" onclick="return ConfirmDelBig1();">处理未付款进行中订单</a>
	<?php }elseif($row->state == 2){?>
	<a href="?act=deal2&id=<?=$row->id?>" onclick="return ConfirmDelBig2();">处理已付款进行中订单</a>
	<?php }?>	 
	&nbsp;
	<a href="gouwu_gl.php">返回</a></td>
  </tr>
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
</form>
</body>
</html>
