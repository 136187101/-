<?php 
	require_once("../../inc/anquan.php");
	require_once("../../inc/conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/css.css"/>
<title>无标题文档</title>
<style type="text/css">
.STYLE1 {	color: #e1e2e3;
	font-size: 12px;
}
.STYLE10 {color: #000000; font-size: 12px; }
.STYLE19 {	color: #344b50;
	font-size: 12px;
}
.STYLE21 {	font-size: 12px;
	color: #3b6375;
}
.STYLE22 {	font-size: 12px;
	color: #295568;
}
.STYLE6 {color: #000000; font-size: 12; }
a{ color:#295568;}
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="3%" height="19" valign="bottom"><div align="center"><img src="../images/tb.gif" width="14" height="14" /></div></td>
                  <td width="97%" valign="bottom"><span class="STYLE1"> 管理员信息</span></td>
                </tr>
              </table></td>
              <td><div align="right"><span class="STYLE1">&nbsp;</span><span class="STYLE1"> &nbsp;</span></div></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
        <tr>
          <td height="20" bgcolor="d3eaef" class="STYLE6"><div align="center">管理员账号</div>  </td>
          <td width="31%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center">管理员注册IP</div></td>
          <td width="30%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center">注册时间</div></td>
        </tr>
        <?php
	$name=$_SESSION["name"];
	$sql="select * from admin_users where admin_users='$name'";
	$rs=mysql_query($sql);
	$rows=mysql_fetch_array($rs)
?>
        <tr>
          <td height="20" bgcolor="#FFFFFF" class="STYLE6">          
          <div align="center"><?php echo $rows["admin_users"]?></div> </td>
          <td height="20" align="left" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $rows["admin_ip"]?></div> </td>
            <td height="20" align="left" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $rows["admin_time"]?></div> </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>