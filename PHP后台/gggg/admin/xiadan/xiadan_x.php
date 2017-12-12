<?php
require_once("../../include/global.php");
require_once("../session.php");
$sql = "select * from zxxd where id = $id";
$db->setQuery($sql);
$xiadan = $db->loadobject();
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
            <td width="51%" valign="middle"><table width="100%" height="25" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[在线下单管理]-[下单详细]</td>
              </tr>
            </table></td>
            <td width="49%">&nbsp;</td>
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
        <td><table width="70%" border="0" align="center" cellpadding="0" cellspacing="1" >
          <tr>
            <td height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><font color="red"><?=$xiadan->names?></font>的下单详细信息</td>
            </tr>
          <tr>
            <td height="20" align="left" bgcolor="#FFFFFF">
			<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="b5d6e6">

              <tr>
                <td width="16%" height="30" align="right">公司名称：</td>
                <td width="84%"><?=$xiadan->Company?></td>
              </tr>
              <tr>
                <td height="30" align="right">电话好吗：</td>
                <td><?=$xiadan->tel?></td>
              </tr>
              <tr>
                <td height="30" align="right">地 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</td>
                <td><?=$xiadan->add?></td>
              </tr>
              <tr>
                <td height="30" align="right">电子邮件：</td>
                <td><?=$xiadan->email?></td>
              </tr>
              <tr>
                <td height="30" align="right">网&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</td>
                <td><?=$xiadan->website?></td>
              </tr>
              <tr>
                <th height="30" align="right">项目描述：</th>
                <td><?php
				$sdfsdf = $xiadan->checkbox;
				echo $sdfsdf;
				?></td>
              </tr>
              <tr>
                <td height="30" align="right">原语言：</td>
                <td><?=$xiadan->sl?></td>
              </tr>
              <tr>
                <th height="30" align="right">目标语言：</th>
                <td>
				<?php
				$sdfsdf = $xiadan->fuxian;
				echo $sdfsdf;
				?>
				
				</td>
              </tr>
              <tr>
                <td height="30" align="right">上传文件：</td>
                <td>&nbsp;&nbsp;<a href="<?=$xiadan->file?>">下载文件</a></td>
              </tr>
              <tr>
                <td height="30" align="right">其他要求：</td>
                <td><?=$xiadan->MailContent?></td>
              </tr>
              <tr>
                <td height="30" align="right">&nbsp;</td>
                <td align="right"><input type="button" name="Submit" value="返回" onclick="location.href='xiadan_gl.php'"/></td>
              </tr>
            </table></td>
            </tr>
        </table>
	</td>
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
<script src="../js/tu.js"  language="javascript"></script>
</body>
</html>
