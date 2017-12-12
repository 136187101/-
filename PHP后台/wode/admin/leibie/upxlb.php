<?php 
	require_once("../inc/conn.php");
	require_once("../inc/anquan.php");	
	$id=$_GET["id"];
	$dydl=$_GET["dydl"];
	$sql_xlb="select * from books_xlb where xlb_id ='$id'";
	$rs_xlb=mysql_query($sql_xlb);
	$rows_xlb=mysql_fetch_array($rs_xlb);
	if($_POST["Submit"])
	{
		$xlb_name=$_POST["xlb_name"];
		$dlb_name=$_POST["dalei"];
		$xlb_px=$_POST["xlb_px"];
		$sql="update books_xlb set xlb_name='$xlb_name',xlb_dydl='$dlb_name',xlb_px='$xlb_px' where xlb_id=$id";
		mysql_query($sql);
		$js -> Alert("修改成功");
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
		var dl_name=document.form1.dl_name.value;
		if(dl_name=="")
		{
			alert("类别不能为空");
			document.form1.dl_name.focus();
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
      <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
        <tr>
          <td width="28%" height="20" bgcolor="#d3eaef" class="STYLE10"><div align="center">添加类别</div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="30"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:50px;">
        <tr>
          <th height="25" colspan="2" bgcolor="#FFFFFF">修改书籍类别</th>
        </tr>
        <tr>
          <td width="86" height="25" align="right" bgcolor="#FFFFFF">类别名称：</td>
          <td width="214" height="25" bgcolor="#FFFFFF"><input class="shuru" type="text" name="xlb_name" id="xlb_name" value="<?php echo $rows_xlb["xlb_name"]?>" /></td>
        </tr>
        <tr>
          <td height="25" align="center" bgcolor="#FFFFFF">所属大类</td>
          <td width="214" height="25" bgcolor="#FFFFFF"><select name="dalei" id="dalei">
            <?php
        	$sql_dl="select * from boods_dl";
			$rs_dl=mysql_query($sql_dl);
			while($rows_dl=mysql_fetch_array($rs_dl))
			{
		?>
            <option value="<?php echo $rows_dl[0]?>"<?php if($rows_dl[0]==$dydl){echo "selected";}?>><?php echo $rows_dl[1]?></option>
            <?php			
			}
		
		?>
          </select>
            <a href="add_dl.php">添加大类</a></td>
        </tr>
        <tr>
          <td height="25" align="right" bgcolor="#FFFFFF">排序：</td>
          <td height="25" align="left" bgcolor="#FFFFFF"><input name="xlb_px" type="text" class="shuru" id="textfield" value="<?php echo $rows_xlb["xlb_px"]?>" /></td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit" class="anniu" id="button" value="提交" />
            &nbsp;
            <input name="button2" type="reset" class="anniu" id="button2" onclick="window.location.href='gllb.php'" value="返回" /></td>
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