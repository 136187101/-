<?php 
require '../../include/init.php';
require_once("../session.php");
$fuid=$_GET["fuid"];
//读取链接父类
$rs_linkf=$hjd->get_one("select * from d_linkfl where id = '$fuid'");

if($Submit == "提交"){
			
	$date=date("Y-m-d H:i:s");
		
			$query = "INSERT INTO ziliaofl(title,px,times)VALUES('$_POST[title]','$_POST[px]','$date')";
			if($db->query($query)){
			$js->Alert("添加成功");
			$js->Goto("zlfl_gl.php");
			}
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
<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="Navitable">
          <tr>
            <td width="12" height="30">&nbsp;</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"></div></td>
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[<strong>资料分类</strong>管理]-[<strong>资料分类</strong>添加]</td>
                      </tr>
                  </table></td>
                  <td width="54%">&nbsp;</td>
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
            <td align="center"><table width="80%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><strong>添加资料分类</strong></td>
                </tr> 
                <tr>
                  <td width="9%" height="24" align="right" bgcolor="#FFFFFF">名称：&nbsp;&nbsp;</td>
                  <td width="91%" height="24" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="30" /></td>
                </tr>
                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="0" size="5"/></td>
                </tr>
                <tr>
                  <td height="24" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit"  class="anniu" id="Submit" value="提交" />                    
                    &nbsp;&nbsp;
                  <input name="Submit22" type="button" class="anniu" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
                </tr>
            </table></td>
            <td width="8" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35"></td>
            <td>&nbsp;</td>
            <td width="16"></td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
