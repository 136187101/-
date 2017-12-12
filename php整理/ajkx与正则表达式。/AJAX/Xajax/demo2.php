<?php
	require_once("xajax_core/xajaxAIO.inc.php");
	$xajax=new xajax();
	function helloWorld($user)
	{
		$text="Hello,$user";
		$objResponse=new xajaxResponse();
		$objResponse->assign("hello","innerHTML",$text);
		return $objResponse;
	}
	$xajax->registerFunction("helloWorld");
	$xajax->processRequest();
	echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<html>
<head>
<title>无标题文档</title>
<?php
		$xajax->printJavascript();
?>
<script language="javascript">
	function sayHello()
	{
		var u=document.forms[0].username.value;
		xajax_helloWorld(u);
		return false;
	}
</script>
</head>

<body>
<div id="hello"></div><br<br />
<form>
	<input type="text" name="username" />
	<button onclick="sayHello()">Hello</button>
</form>
</body>
</html>
