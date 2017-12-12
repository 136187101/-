<?php 
require '../../include/init.php';
require_once("../session.php");
//删除管理员
if($_GET["de"]==1)
{
	$id=$_GET[id];
	$db->query("delete  from admin_user where uid = '$id'");
	$js->Goto("admin_user.php");	
	
}

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/skin.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php

$rs =$db->query("SELECT * FROM `admin_user`");

?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="Navitable">
      <tr>
        <td width="12" height="30">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                    <td width="95%"><span class="STYLE3">你当前的位置</span>：[管理员管理]</td>
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
        <td align="center"><table width="60%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" >
          <tr>

            <td width="31%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><strong>管理员名称</strong></td>
            <td width="39%" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">权限</td>
            <td width="39%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><strong>基本操作</strong></td>
          </tr>
		  
          <?php
          while($rows=$hjd->fetch_array($rs))
		  {
		  ?>
          <tr>
            <td height="20" align="center" bgcolor="#FFFFFF">
			<font color="#CF2B0E"><?=$rows[username]?></font>
			</td>
            <td align="center" bgcolor="#FFFFFF">
            <?php
            	//权限
				if($rows["quanxian"]==0)
				{
					echo "超级管理员";	
				}
				else
				{
					echo "普通管理员";	
				}
			?>
            </td>
            <td height="20" align="center" bgcolor="#FFFFFF">
			<a href="admin_edit.php?id=<?=$rows[uid]?>">编辑</a>
           	<?php
            	if($rows["quanxian"]!=0)
		  		{
			?>
			 | <a onclick="if(confirm('确定要删除该管理员吗？请慎重操作')){}else{return false;}" href="admin_user.php?de=1&id=<?php echo $rows[uid]?>">删除</a>
			<?php		
				}
			?>
			</td>
          </tr>
		  <?php
		  }
		  ?>

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
</body>
</html>

