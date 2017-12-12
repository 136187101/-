<?php
require_once("../../include/global.php");
require_once("../session.php");
$sql = "select * from pollTitle where id=$id";
$db->setQuery($sql);
$row = $db->loadObject();
if($Submit=="提交"){
	$sql = "update pollTitle set title='$title',pollType='$pollType' where id=$id";
	$db->setQuery($sql);
	if($db->query()){
		$js->Goto("managePollTitle.php?msg=".urlencode("修改成功"));
	}
}
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
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tr>
                  <td width="53%" valign="middle"><table width="73%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                      <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[投票管理]-[<a href="managePollTitle.php">投票管理项目</a>]</td>
                    </tr>
                  </table></td>
                  <td width="47%" align="right">&nbsp;</td>
              </tr>
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
			<table width="60%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CDEAFA">
  <tr>
    <td height="22" colspan="2" align="center" background="../images/bg.gif">编辑投票栏目</td>
  </tr>
  <tr>
    <td width="199" height="22" align="right" bgcolor="#FFFFFF">标题:&nbsp; </td>
    <td width="388" height="22" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" value="<?=$row->title?>"/></td>
  </tr>
  <tr>
    <td height="22" align="right" bgcolor="#FFFFFF">类型:&nbsp; </td>
    <td height="22" align="left" bgcolor="#FFFFFF">
	<?php 
	if($row->pollType){
	?>
	<input type="radio" name="pollType" value="0" />
      单选
    <input type="radio" name="pollType" value="1" checked="checked" />
        多选
		<?php
		}else{
		?>
	<input type="radio" name="pollType" value="0" checked="checked"/>
      单选
    <input type="radio" name="pollType" value="1" />
        多选
		<?php
		}
		?>
	</td>
  </tr>
  <tr>
    <td height="22" colspan="2" align="center" bgcolor="#FFFFFF">
      <input type="submit" name="Submit" class="anniu" value="提交" />
      &nbsp; 
      <input name="fanhui" type="button" class="anniu" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/>

    </td>
  </tr>
</table>
			</td>
            <td width="8" background="../images/tab_15.gif">&nbsp;</td>
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
