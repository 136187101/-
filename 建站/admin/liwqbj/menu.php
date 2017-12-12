<?php  require_once("../session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head id="Head1" runat="server">
<title>后台管理</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<frameset rows="70,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="admin_top.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset cols="180,*" frameborder="no" border="0" framespacing="0">
    <frame src="left.php" name="menu" scrolling="yes" frameborder="0" noresize="noresize" id="menu" title="leftFrame" />
    <frame src="right.php" name="sys_main" id="sys_main" title="mainFrame" />
  </frameset>
</frameset>
<noframes>
<body>
</body>
</noframes></html>