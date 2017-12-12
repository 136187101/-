<?php
require_once("../../include/global.php");
require_once("../session.php");
if($Submit == "提交"){
	$sql = "update lwq_xinxi set title='$title',sou_name='$sou_name',tel='$tel',chuanzhen='$chuanzhen',email='$email',rexian='$rexian',lianxi='$lianxi',seo_title='$seo_title',seo_gjci='$seo_gjci',seo_type='$seo_type',dibu='$dibu',times='".time()."' where id = 1";
	$db->setQuery($sql);
		$db->query();
		$js->Alert("提交成功");
		$js->Goto("lwq_xinxi.php");
	}
	$sql = "select * from lwq_xinxi where id = 1";
	$db->setQuery($sql);
	$xinxi_yi = $db->loadobject();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
<script type="text/javascript" charset="utf-8" src="../editubb/kindeditor.js"></script>
<script language=javascript type="text/javascript"> 
    KE.show({
        id : 'content6',
        cssPath : '../editubb/index.css',
        items : [
        'undo', 'redo','justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'title', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'strikethrough', 'link', 'unlink', 'removeformat', 'specialchar', 'emoticons',]
    });
	KE.show({
        id : 'content7',
        cssPath : '../editubb/index.css',
        items : [
        'undo', 'redo','justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'title', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'strikethrough', 'link', 'unlink', 'removeformat', 'specialchar', 'emoticons',]
    });
</script>

</head>
<body>
<form id="form1" name="form1" method="post" action="" onsubmit="return liwq();">
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
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[系统管理]-[基本信息]</td>
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
            <td align="center"><table width="97%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">网站基本信息</td>
                </tr>
                <tr>
                  <td width="14%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">网站标题：&nbsp;&nbsp;</span></td>
                  <td width="86%" height="20" align="left" bgcolor="#FFFFFF">
                  <input name="title" type="text" id="title" style="width:300px; height:15px;" class="input_liwq" value="<?=$xinxi_yi->title?>"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">电话：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <input name="tel" type="text" id="tel" style="width:300px; height:15px;" class="input_liwq" value="<?=$xinxi_yi->tel?>"/>                  </td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">传真：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="chuanzhen" type="text" id="sou_name" style="width:300px; height:15px;" class="input_liwq" value="<?=$xinxi_yi->chuanzhen?>"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">邮箱：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="email" type="text" id="sou_name" style="width:300px; height:15px;" class="input_liwq" value="<?=$xinxi_yi->email?>"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">服务热线：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="rexian" type="text" id="sou_name" style="width:300px; height:15px;" class="input_liwq" value="<?=$xinxi_yi->rexian?>"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">seo标题：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <input name="seo_title" type="text" id="seo_title" style="width:300px; height:15px;" value="<?=$xinxi_yi->seo_title?>"/>
                  </td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">seo关键词：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <textarea name="seo_gjci" cols="45" rows="5" id="seo_gjci"><?=$xinxi_yi->seo_gjci?></textarea>
                  </td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">seo描述：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <textarea name="seo_type" id="seo_type" cols="45" rows="5"><?=$xinxi_yi->seo_type?></textarea>
                  </td>
                </tr>
                <tr style="display:none;">
                  <td height="20" align="right" bgcolor="#FFFFFF">最新公告：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="lianxi" id="content6" style="width:100%; height:200px; visibility:hidden"><?=stripslashes($xinxi_yi->lianxi);?></textarea></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">底部信息：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="dibu" id="content7" style="width:100%; height:200px;"><?=stripslashes($xinxi_yi->dibu);?></textarea></td>
                </tr>
                <tr>
                  <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit" class="anniu" id="Submit" value="提交"/>
                    &nbsp;&nbsp;
                    <input name="Submit22" type="button" class="anniu" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
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
</body>
</html>

