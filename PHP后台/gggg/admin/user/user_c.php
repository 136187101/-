<?php
require_once("../../include/global.php");
require_once("../session.php");
$sql = "select * from user where uid = $uid";
$db->setQuery($sql);
$user = $db->loadObject();
$sql = "select * from user where uid = $uid";
$db->setQuery($sql);
$lwq = $db->loadObject();
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
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="14" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
            <td width="926"><table width="100%" border="0" cellspacing="0" cellpadding="0">
               		  <form id="form2" name="form2" method="get" action="?PB_page=<?=$_GET["PB_page"];?>&yidlei=<?=$_GET["yidlei"]?>&sou=<?=$_GET["sou"]?>" onsubmit="return checkSubmit();">
			    <tr>
                  <td width="37%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[会员管理]-[会员管理项目]</td>
                      </tr>
                  </table></td>
                  <td align="right">&nbsp;</td>
                  <input type="hidden" name="Submit" value="搜索"  />
                  </tr>
				</form>
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
<table width="50%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CDEAFB" style=" margin-top:20px;">
  <tr>
    <td height="24" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span style="color:red">
      <?=$lwq->username?>
    </span>：会员详细资料</td>
    </tr>
  <tr>
    <td height="24" align="left" bgcolor="#FFFFFF">编号[
      <?=$user->uid?>
      ]</td>
    <td height="24" bgcolor="#FFFFFF" style="color:red">&nbsp;</td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#FFFFFF">个人签名&nbsp;</td>
    <td height="24" align="center" bgcolor="#FFFFFF" style="color:red"><?=$user->sightml?></td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#FFFFFF">自我介绍&nbsp;</td>
    <td height="24" bgcolor="#FFFFFF" style="color:red"><?=$user->bio?></td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#FFFFFF">来自&nbsp;</td>
    <td height="24" bgcolor="#FFFFFF" style="color:red"><?=$user->location?></td>
  </tr>
  <tr>
    <td height="24" align="right" bgcolor="#FFFFFF">个人网站&nbsp;</td>
    <td height="24" bgcolor="#FFFFFF" style="color:red"><?=$user->site?></td>
  </tr>
  <tr>
    <td width="27%" height="24" align="right" bgcolor="#FFFFFF">QQ&nbsp;</td>
    <td width="73%" height="24" bgcolor="#FFFFFF" style="color:red"><?=$user->qq?></td>
  </tr>
  <tr>
    <td width="27%" height="24" align="right" bgcolor="#FFFFFF">ICQ&nbsp;</td>
    <td width="73%" height="24" bgcolor="#FFFFFF" style="color:red"><?=$user->icq?></td>
  </tr>
  <tr>
    <td width="27%" height="24" align="right" bgcolor="#FFFFFF">Yahoo&nbsp;</td>
    <td width="73%" height="24" bgcolor="#FFFFFF" style="color:red"><?=$user->yahoo?></td>
  </tr>
  <tr>
    <td width="27%" height="24" align="right" bgcolor="#FFFFFF">支付宝账号&nbsp;</td>
    <td width="73%" height="24" bgcolor="#FFFFFF" style="color:red"><?=$user->alipay?></td>
  </tr>
  <tr>
    <td width="27%" height="24" align="right" bgcolor="#FFFFFF">阿里旺旺&nbsp;</td>
    <td width="73%" height="24" bgcolor="#FFFFFF" style="color:red"><?=$user->taobao?></td>
  </tr>
  <tr>
    <td width="27%" height="24" align="right" bgcolor="#FFFFFF">MSN&nbsp;</td>
    <td width="73%" height="24" bgcolor="#FFFFFF" style="color:red"><?=$user->msn?></td>
  </tr>
<tr>
    <td height="24" colspan="2" align="right" bgcolor="#FFFFFF">
	<a href="user_gl.php">返回..</a></td>
  </tr>
</table>
            <?=$kong?></td>
            <td width="9" background="../images/tab_15.gif">&nbsp;</td>
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
