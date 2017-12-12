<?php 	
	require '../../include/init.php';
 	require_once("../session.php"); 
	if($_POST["Submit"])
	{
		foreach($_POST as $key => $val)
		{
			$$key=$val;	
		}	
		$pwd=md5($pwd);
		$sql="insert into admin_user (username,passwd,quanxian) values('$name','$pwd','1')";
		if($db->query($sql))
		{
			$js->Alert("添加成功");	
			$js->Gotoxx("admin_user.php");
		}
		else
		{
			$js->Alert("添加失败");	
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>

<link href="../wlgr/wlgr.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="../css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script src="../js/jquery-1.4.min.js" type="text/javascript"></script>
		<script src="../js/jquery_reg.js" type="text/javascript"></script>
		<script src="../js/jquery.validationEngine.js" type="text/javascript"></script>
		<script>	
		$(document).ready(function() {
			$("#formID").validationEngine()
		});
	</script>	

</head>
<body>
<h1>
<span class="action-span"><a href="admin_user.php">管理员列表</a></span>
<span class="action-span1">管理员管理</span><span id="search_id" class="action-span1"> - 添加子管理员 </span>
<div style="clear:both"></div>
</h1>
<form id="formID" name="form1" method="post" action="">
  <div class="main-div">
  <table width="100%" id="general-table">
    <tr>
      <td  class="label">用户名</td>
      <td>
        <input type="text" name="name" value="" size="25" id="name" class="validate[required,ajax[ajaxName]]" />
      </td>
    </tr>
      <tr>
        <td class="label">密码</td>
        <td>
 			<input name="pwd" type="password" id="password1" size="25"  class="validate[required,length[6,18]]"/>
       	</td>
      </tr>
          <tr>
        <td class="label">重复密码</td>
        <td>
 			<input name="cfpwd" type="password" id="password2" size="25"  class="validate[required,length[6,18],confirm[password1]]" />
       	</td>
      </tr>
      <tbody id="0">
      </tbody>
        <tbody id="1" style="display:none">
    </tbody>
  
      <tbody id="2" style="display:none">
    </tbody>
  
      <tbody id="3" style="display:none">
    </tbody>
    <tr>
      <td class="label">&nbsp;</td>
      <td>
        <input type="submit" value=" 确定 " name="Submit" class="button" />
        <input type="reset" value=" 重置 " class="button" />
        <input type="hidden" name="act" value="insert" />
        <input type="hidden" name="id" value="" />
        </td>
    </tr>
 </table>
</div>
</form>
</body>
</html>