<?php  		
require_once("../session.php"); 
date_default_timezone_set('PRC');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css"/>
<style type="text/css">
#header-div {
background:url(images/top_bj_02.jpg) #448300 repeat-x;
  border-bottom: 0px solid #F00;
}

#logo-div {
  height: 50px;
  float: left;
}

#license-div {
  height: 50px;
  float: left;
  text-align:center;
  vertical-align:middle;
  line-height:50px;
}

#license-div a:visited, #license-div a:link {
  color: #EB8A3D;
}

#license-div a:hover {
  text-decoration: none;
  color: #EB8A3D;
}

#submenu-div {
  height: 50px;
}

#submenu-div ul {
  margin: 0;
  padding: 0;
  list-style-type: none;
}

#submenu-div li {
  float: right;
  padding: 0 10px;
  margin: 3px 0;
  border-left: 1px solid #FFF;
}

#submenu-div a:visited, #submenu-div a:link {
  color: #108a10;
  text-decoration: none;
}

#submenu-div a:hover {
  color: #108a10;
}

#loading-div {
  clear: right;
  text-align: right;
  display: block;
}

#menu-div {
  background:url(images/nvg_bj_14.jpg) repeat-x;
  font-weight: bold;
  height: 24px;
  line-height:24px;
}

#menu-div ul {
  margin: 0;
  padding: 0;
  list-style-type: none;
}

#menu-div li {
  float: left;
  border-right: 1px solid #406400;
  border-left:1px solid #73b549;
}

#menu-div a:visited, #menu-div a:link {
  display:block;
  padding: 0 20px;
  text-decoration: none;
  color: #fff;
 background:url(images/nvg_libj_03.jpg) repeat-x;
}

#menu-div a:hover {
  color: #fff;
 background:url(images/jgbj_03.jpg) repeat-x;
}

#submenu-div a.fix-submenu{clear:both; margin-left:5px; padding:3px 10px;background:url(images/anniu_06.jpg) no-repeat; color:#ffffff; width:68px; height:21px;}
#submenu-div a.fix-submenu:hover{padding:3px 10px; *padding:3px 10px; color:#ffffff; background:url(images/anniu_06.jpg) no-repeat;}
#submenu-div a.fix-submenu1{clear:both; margin-left:5px; padding:3px 10px; background:url(images/anniu_08.jpg) no-repeat; color:#ffffff;}
#submenu-div a.fix-submenu1:hover{padding:3px 10px;  background:url(images/anniu_08.jpg) no-repeat;color:#ffffff;}
#menu-div li.fix-spacel{width:30px; border-left:none;}
#menu-div li.fix-spacer{border-right:none;}
</style>
<script language=JavaScript>
function logout(){
	if (confirm("您确定要退出控制面板吗？"))
	top.location = "login.php?act=logout";
	return false;
}
</script>
</head>
<body style="border:1px solid #448300">
<div id="header-div">
  <div id="logo-div" style="bgcolor:#000000;"><img src="images/logo.jpg" alt="" /></div>
  <div id="license-div" style="bgcolor:#000000;"></div>
  <div id="submenu-div">
    <ul>
      
       <li><a href="javascript:window.top.frames['main-frame'].document.location.reload();window.top.frames['header-frame'].document.location.reload()">刷新</a>		<li><a href="javascript:history.go(1);">前进</a></li>
      <li><a href="javascript:history.go(-1);">后退</a></li>
      
    </li>
     
      
    </ul>
    <div id="send_info" style="padding: 5px 10px 0 0; clear:right;text-align: right; color: #FF9900;width:40%;float: right;">
     <?php
		$h=date('G');
		if ($h<11) echo '早上好';
		else if ($h<13) echo '中午好';
		else if ($h<17) echo '下午好';
		else echo '晚上好';
		?>，尊敬的"<b><?=$_SESSION['adminname']?></b>"管理员,欢迎您登陆使用！ <a  target="_self" onClick="logout();" href="#" ><img src="images/anniu_08.jpg" style="border:none;" width="44" height="21" /></a>
    </div>
        <div id="load-div" style="padding: 5px 10px 0 0; text-align: right; color: #FF9900; display: none;width:40%;float:right;"><img src="images/top_loader.gif" width="16" height="16" alt="正在处理您的请求..." style="vertical-align: middle" /> 正在处理您的请求...</div>
  </div>
</div>
<div id="menu-div">
  <ul>
    <li class="fix-spacel">&nbsp;</li>
    <li><a href="main.php" target="main-frame">起始页</a></li>
    <li><a href="../xitong/sys.php" target="main-frame">网站设置</a></li>
    <li><a href="../essay/essay_lei.php?fuid=0" target="main-frame">栏目管理</a></li>
  </ul>
  <br class="clear" />
</div>
</body>
</html>