<?php 
require_once("../../include/global.php");
require_once("../session.php");
$sql = "select * from lwq_user where id = $id";
$db->setQuery($sql);
$rows = $db->loadObject();
if($Submit == "确定"){
	if(is_array($_POST[quanxian])){
		$quanxian = implode("|",$_POST[quanxian]);	
	}else{
		$quanxian = $_POST[quanxian];
	}
$sql = "update lwq_user set quanxian = '$quanxian' where id = $id";
$db->setQuery($sql);
$db->query();
$js->alert("成功分配");
$js->goto("?id=$id");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script src="../js/huanse.js"></script>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<style>
.fenpei{width:120px; height:30px; float:left;}
</style>
</head>
<body>
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
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[系统管理]-[管理员管理]-[权限分配]</td>
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
        <td align="center">
        <form id="form1" name="form1" method="post" action="">
        <table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
          <tr>
            <td height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><font color="#FF0000"><?=$rows->username?>&nbsp;&nbsp;&nbsp;分配权限</font></td>
            </tr>
          <tr>
            <td height="20" align="left" bgcolor="#FFFFFF">
            	<div style="width:auto; height:50px; margin-top:20px;">
                	<ul>
                    	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="1" <? if(strstr($rows->quanxian,"1")){ echo "checked";}?>  />系统管理</li>
                    	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="2" <? if(strstr($rows->quanxian,"2")){ echo "checked";}?>  />栏目管理
</li>
                     	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="3" <? if(strstr($rows->quanxian,"3")){ echo "checked";}?>  />在线下单管理</li>
                    	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="4" <? if(strstr($rows->quanxian,"4")){ echo "checked";}?>  />生成静态管理
</li>
                     	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="5" <? if(strstr($rows->quanxian,"5")){ echo "checked";}?>  />类别项目管理</li>
                    	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="6" <? if(strstr($rows->quanxian,"6")){ echo "checked";}?>  />留言板管理
</li>
                      	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="7" <? if(strstr($rows->quanxian,"7")){ echo "checked";}?>  />订单管理</li>
                    	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="8" <? if(strstr($rows->quanxian,"8")){ echo "checked";}?>  />会员管理
                      	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="9" <? if(strstr($rows->quanxian,"9")){ echo "checked";}?>  />投票管理</li>
                    	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="10" <? if(strstr($rows->quanxian,"10")){ echo "checked";}?>  />友情链接
                      	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="11" <? if(strstr($rows->quanxian,"11")){ echo "checked";}?>  />焦点图片管理</li>
                    	<li class="fenpei"><input name="quanxian[]" type="checkbox" id="quanxian[]" value="12" <? if(strstr($rows->quanxian,"12")){ echo "checked";}?>  />基本信息管理
</li>
                   </ul>
                </div>
            	<div style="width:auto; height:30px; text-align:center; margin-top:20px;">
            	  <input type="submit" name="Submit" id="Submit" class="anniu" value="确定" />&nbsp;&nbsp;&nbsp;
            	  <input type="button" name="fan" id="fan" class="anniu" value="返回" onclick="location.href='lwq_gluser.php';"/>
                </div>
              </td>
            </tr>
        </table>
        </form>
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
</body>
</html>

