<?php 
@header('Content-type: text/html;charset=utf-8');

require '../../include/init.php';
require_once("../session.php");

if($_GET[act] == "edit"){
$sql = $query = "select * from zhifu where id = $id";
$rows = $db->getOne($sql);

}


if($_POST[Submit] == "修改"){
				
$query = "update zhifu set yinhang='$_POST[yinhang]',users='$_POST[users]',name='$_POST[name]',px='$_POST[px]' where id=$id";
			if($db->query($query)){
			$js->alert("修改成功");
			$js->Gotoxx("zhifugl.php?PB_page=$PB_page");
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
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[支付方式管理]-[管理]-[编辑]</td>
                      </tr>
                  </table></td>
                  <td width="54%">&nbsp;</td>
                </tr>
            </table></td>
            <td width="16">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center"><table width="80%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">修改支付方式</td>
                </tr>
              <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">开户行：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><input name="yinhang" type="text" id="yinhang" size="50" value="<?=$rows[yinhang]?>"/></td>
                </tr>
                 
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">账号：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="users" type="text" id="users" size="50" value="<?=$rows[users]?>"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">收款人：&nbsp;&nbsp;</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="name" type="text" id="name" size="50" value="<?=$rows[name]?>"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="<?=$rows[px]?>" size="5"/></td>
                </tr>
                <tr>
                  <td height="20" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit"  class="button" id="Submit" value="修改" />                    
                    &nbsp;&nbsp;
                  <input name="Submit22" type="button" class="button" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
                </tr>
            </table></td>
            <td width="8" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35">&nbsp;</td>
            <td>&nbsp;</td>
            <td width="16">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>

