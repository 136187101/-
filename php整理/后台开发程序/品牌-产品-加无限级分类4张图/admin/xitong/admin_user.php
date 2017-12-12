<?php 
require '../../include/init.php';
require_once("../session.php");
//删除管理员
if($_GET["de"]==1)
{
	$id=$_GET[id];
	$db->query("delete  from admin_user where uid = '$id'");
	$js->Gotoxx("admin_user.php");	
	
}

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php

$rs =$db->query("SELECT * FROM `admin_user`");

?>
<h1>
<span class="action-span"><a href="add_admin.php">添加子管理员</a></span>
<span class="action-span1">管理员管理</span><span id="search_id" class="action-span1"> - 管理员列表 </span>
<div style="clear:both"></div>
</h1>
<div class="list-div" id="listDiv">
  <table width="100%" cellpadding="3" cellspacing="1" id="listTable">
  <tr>
    <th>管理员名称</th>
    <th>权限</th>
    <th>操作</th>
  </tr>
          <?php
          while($rows=$hjd->fetch_array($rs))
		  {
		  ?>
    <tr>
    <td class="first-cell"><font color="#CF2B0E"><?=$rows[username]?></font></td>
    <td>
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
    <td align="center">
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
      <tr>
      <td align="right" nowrap="true" colspan="6">
        <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ --></td>
    </tr>
  </table>
</div>
</body>
</html>

