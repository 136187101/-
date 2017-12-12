<?php 
	require_once("../inc/conn.php");
	require_once("../inc/anquan.php");
	$_dl=$_GET["dl"];
	if($_POST["Submit"])
	{
		$xlb_name=$_POST["xlb_name"];
		$sql="insert into books_xlb(xlb_name,xlb_dydl) values('$xlb_name','$_dl')";
		mysql_query($sql);
		$js -> Alert("添加成功");
		$js -> Goto("gllb.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../houtai/css/css.css"/>
<?php
	
?>
<title>无标题文档</title>
<script language="javascript">
	function yan()
	{
		var xlb_name=document.form1.xlb_name.value;
		if(xlb_name=="")
		{
			alert("类别不能为空");
			document.form1.xlb_name.focus();
			return false;
		}		
	}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="" onsubmit="return yan()">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="2%" height="19" valign="bottom"><div align="center"><img src="../houtai/images/tb.gif" width="14" height="14" /></div></td>
                  <td width="94%" valign="bottom" class="STYLE1">添加类别</td>
                </tr>
              </table></td>
              <td></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>
      <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
        <tr>
          <td width="28%" height="20" bgcolor="#d3eaef" class="STYLE10"><div align="center">添加类别</div></td>
          </tr>
      </table>
      </td>
    </tr>
    <tr>
      <td height="30"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <th height="25" colspan="2" bgcolor="#FFFFFF">&nbsp;</th>
        </tr>
        <tr>
          <td width="101" height="25" align="right" bgcolor="#FFFFFF">类别名称：</td>
          <td width="199" height="25" bgcolor="#FFFFFF"><input class="shuru" type="text" name="xlb_name" id="xlb_name" /></td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit" class="anniu" id="button" value="提交" />
            &nbsp;&nbsp;
            <input name="button2" type="reset" class="anniu" id="button2" onclick="window.location.href='gllb.php'" value="返回" /></td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
      <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
        <tr>
          <td width="28%" height="20" bgcolor="#d3eaef" class="STYLE10"></td>
        </tr>
      </table>
  </table>
</form>
</body>
</html>