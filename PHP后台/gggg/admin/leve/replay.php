<?php
require_once("../../include/global.php");
require_once("../session.php");
if($Submit == "回复"){
	$sql = "insert into replay(replayContent,replayTime,leaveId,username) values('$replayContent','".time()."','$hid','".$_SESSION["user_name"]."')";
	$db->setQuery($sql);
	$db->query();
	$js->alert("回复成功");
	$js->Goto("gl_leve.php?act=hui&id=$hid");
}
$query = "select * from `leave` where id=$hid";
$db->setQuery($query);
$row = $db->loadObject();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" charset="utf-8" src="../editubb/kindeditor.js"></script>
  <script type="text/javascript">
    KE.show({
        id : 'content2',
        cssPath : '/admin/editubb/index.css',
        items : [
        'undo', 'redo', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
        'removeformat', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
        'insertunorderedlist']
    });
  </script>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[留言板]-[留言管理]-[回复]</td>
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
            <td align="center"><table width="90%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">留言人: <font color="red">
                    <?=$row->name?>
                  </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.go(-1);">返回</a></td>
                </tr>
                <tr>
                  <td width="8%" height="20" align="right" bgcolor="#FFFFFF"></a>留言标题:&nbsp;</td>
                  <td width="92%" align="left" bgcolor="#FFFFFF">&nbsp;
                    <?=$row->leaveTitle?></td>
                </tr>
                <tr>
                  <td height="20" align="right" valign="top" bgcolor="#FFFFFF">留言内容:&nbsp;</td>
                  <td align="left" bgcolor="#FFFFFF">&nbsp;
                    <?=$row->leaveContent?></td>
                </tr>
            </table>
              <table width="90%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">回复内容</td>
                </tr>
                <tr>
                  <td colspan="2" align="right" bgcolor="#FFFFFF">
				<script type="text/javascript">
					KE.show({
						id : 'content2',
						cssPath : '/admin/editubb/index.css',
						items : [
						'undo', 'redo', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
						'removeformat', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist']
					});
				</script>
				  <textarea id="content2" name="replayContent" style="width:100%;height:100px;visibility:hidden;"></textarea>
				  <input name="Submit" type="submit" class="anniu" id="Submit" value="回复" /></td>
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

