<?php
 require_once("../../inc/anquan.php");
 require_once("../../inc/conn.php");
 if($_POST["Submit"])
 {
	$users=$_SESSION["name"];

	$jpwd=$_POST["jpwd"];
	$sql_c="select * from admin_users where admin_users ='$users' and admin_pwd ='$jpwd'";
	$rs_c=mysql_query($sql_c);
	if(mysql_num_rows($rs_c)!=0)
	{
	$pwd=$_POST["pwd"];
	$sql="update admin_users  set admin_pwd = '$pwd'";
	mysql_query($sql);
	echo " <script language='javascript'>alert('修改密码成功');window.location.href='ckadmin.php'</script>";
	}
	else
	 {
		$js -> Alert("用户名或密码错误");
		$js -> Goto("uppwd.php");
	}
}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/css.css"/>
<title>无标题文档</title>
<script language="javascript">
	function yan()
	{
		var  pwd=document.form1.pwd.value;
		var cfpwd=document.form1.cfpwd.value;
		if(pwd=="")
		{
			alert("密码不能为空");
			document.form1.pwd.focus();	
			return false;
		}
		if(cfpwd=="")
		{
			alert("重复密码不能为空");
			document.form1.cfpwd.focus();
			return false;
		}
		if(cfpwd!=pwd)
		{
			alert("两次密码输入不一致！")
			document.form1.cfpwd.select();
			return false;	
		}
		
		
		
		
	}
</script>
<script language="javascript">
function check(name)
{
	
	if(name=="")
	{
		usid.innerHTML="";
		return;
	}
	//获得XMLHttpRequest对象
	var request;
	if(window.ActivexObject)
		request=new ActiveXObject("Microsoft.XMLHttp");
	else
		request=new XMLHttpRequest();
	//建立与服务器的链接
	request.open("GET","panduan.php?name="+name);
	//连接
	request.send();
	//回调函数
	request.onreadystatechange=function()
	{
		if(request.readyState==4&&request.status==200)
		{
			temp=request.responseText;
			pd="";
			if(temp==1){
				usid.innerHTML="<span style=color:#F00>用户名已经存在</span>";
				pd = false;
			}
			else
			{
				usid.innerHTML="";	
			}
		}
	}
	if(pd==false)
	{
		return false;	
	}
	else
	{
		return true;	
	}
}
function zhengyan()
{
	if(yan()==false)
	{
		return false;	
	}	
	
}
</script>
<style type="text/css">
.STYLE1 {color: #e1e2e3;
	font-size: 12px;
}
.STYLE10 {color: #000000; font-size: 12px; }
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="" onsubmit="return zhengyan()">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="2%" height="19" valign="bottom"><div align="center"><img src="../images/tb.gif" width="14" height="14" /></div></td>
                  <td width="94%" valign="bottom" class="STYLE1">修改密码</td>
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
          <td width="28%" height="20" bgcolor="#d3eaef" class="STYLE10"><div align="center">修改密码</div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="30"><table width="306" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td width="75" height="25" align="right" bgcolor="#FFFFFF">旧密码：</td>
          <td width="231" height="25" bgcolor="#FFFFFF"><input type="jpwd" class="shuru" name="jpwd" id="textfield2" /></td>
        </tr>
        <tr>
          <td width="75" height="25" align="right" bgcolor="#FFFFFF">新密码：</td>
          <td width="231" height="25" bgcolor="#FFFFFF"><input type="password" class="shuru" name="pwd" id="textfield2" /></td>
        </tr>
        <tr>
          <td height="25" align="right" bgcolor="#FFFFFF">重复新密码：</td>
          <td height="25" bgcolor="#FFFFFF"><input type="password" class="shuru" name="cfpwd" id="textfield3" /></td>
        </tr>
        <tr>
          <td height="25" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit" class="anniu" id="button" value="提交" />
            &nbsp;
<input name="button2" type="reset" class="anniu" id="button2" value="取消" /></td>
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