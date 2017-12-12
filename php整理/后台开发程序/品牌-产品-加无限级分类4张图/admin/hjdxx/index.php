<?php 
require '../../include/init.php';
require_once("../session.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站后台管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="Text/Javascript" language="JavaScript">
<!--

if (window.top != window)
{
  window.top.location.href = document.location.href;
}

//-->
</script>

<frameset rows="76,*" framespacing="0" border="0">
  <frame src="top.php" id="header-frame" name="header-frame" frameborder="no" scrolling="no" border="0" bordercolor="#00FF00">
  <frameset cols="176, 6, *" framespacing="0" border="0" id="frame-body">
    <frame src="menu.php" id="menu-frame" name="menu-frame" frameborder="no" scrolling="yes">
    <frame src="drag.html" id="drag-frame" name="drag-frame" frameborder="no" scrolling="no">
    <frame src="main.php" id="main-frame" name="main-frame" frameborder="no" scrolling="yes">
  </frameset>
</frameset><noframes></noframes>
  <frameset rows="0, 0" framespacing="0" border="0">
  <frame src="http://api.ecshop.com/record.php?mod=login&url=http%3A%2F%2Fshengshishop.com%2F" id="hidd-frame" name="hidd-frame" frameborder="no" scrolling="no">
  </frameset>
</head>
<body>
</body>
</html>