<?php
 require_once("../../inc/conn.php");
 if($_POST["Submit"])
 {
	$names=$_POST["usersname"];
	$sql="select * from admin_users where admin_users='$names'";
	$rs=mysql_query($sql);
	if(mysql_num_rows($rs)!=0)
	{
			$js -> Alert("用户名已被占用");
			$js -> Goto("addgl.php");
	}
	else
	{
	$users=$_POST["usersname"];
	$pwd=$_POST["pwd"];
	$ip=$_SERVER['REMOTE_ADDR'];
	$sj= date('Y-m-d H:i:s');
	$sql="insert into admin_users (admin_users,admin_pwd,admin_ip,admin_time) values ('$users','$pwd','$ip','$sj')"	;
	mysql_query($sql);
	echo " <script language='javascript'>alert('添加管理员成功');window.location.href='ckadmin.php'</script>";
	}
}

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/css.css"/>
<title>无标题文档</title>
<style type="text/css">
.STYLE1 {	color: #e1e2e3;
	font-size: 12px;
}
.STYLE10 {color: #000000; font-size: 12px; }
.STYLE19 {	color: #344b50;
	font-size: 12px;
}
.STYLE21 {	font-size: 12px;
	color: #3b6375;
}
.STYLE22 {	font-size: 12px;
	color: #295568;
}
.STYLE6 {color: #000000; font-size: 12; }
a{ color:#295568;}
</style>
<script language="javascript">
	function yan()
	{
		var users=document.form1.users.value;
		var  pwd=document.form1.pwd.value;
		var cfpwd=document.form1.cfpwd.value;
		if(users=="")
		{
			alert("用户名不能为空");
			document.form1.users.focus();
			return false;	
		}
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




function check(name)
{
		if(name=="")
		{
			return false;	
		}
		var http_request = false;
		var names = encodeURI(name); //这里UTF-8下要用encodeURI 否则在IE浏览器上出现乱码。
		//var value = encodeURIComponent(value);
        if (window.ActiveXObject){    /*在IE下初始化XMLHttpRequest对象 */
                try{
                        //新版本的 Internet Explorer
                        http_request= new ActiveXObject("Msxml2.XMLHTTP");
                }catch (oldIE){
                        try {
                                //较老版本的 Internet Explorer
                                http_request= new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (failed){
                                        // 还是创建失败 =.=|||
                                        http_request= false;
                                }             
                }
			} else if (window.XMLHttpRequest){    /*在Firefox下初始化XMLHttpRequest对象 */
					http_request= new XMLHttpRequest();
			}
			if(!http_request){
					alert("创建ajax失败！"); 
					return false;
			   }
		url = "panduan.php?name="+names;
		if (http_request)
		{
			http_request.open("GET", url, true);	
			http_request.onreadystatechange = liwqbj;    //指定响应方法
			http_request.setRequestHeader('If-Modified-Since','0'); 
			http_request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			http_request.send(null);
		}
		function liwqbj(){
				if(http_request.readyState < 4)
				{
					document.getElementById("usid").innerHTML="<img src=/admin/houtai/images/load.gif />";
				}

				if (http_request.readyState == 4 ) {
					if (http_request.status == 200) {
						Text = http_request.responseText;
						if(Text == "1")
						{
							document.getElementById("usid").innerHTML='用户名已存在';
							return false;
						}
						else
						{
							document.getElementById("usid").innerHTML='用户名可以使用';
							return true;
						}
					} else {
						alert('您请求的页面发现错误');
					}
				}
		}
}
function yanzhen(){
	if(yan() == false)
	{
		 return false;
	}
}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="" onsubmit="return yanzhen()">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="2%" height="19" valign="bottom"><div align="center"><img src="../images/tb.gif" width="14" height="14" /></div></td>
                  <td width="94%" valign="bottom" class="STYLE1">添加管理员</td>
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
          <td width="28%" height="20" bgcolor="#d3eaef" class="STYLE10"><div align="center">添加管理员</div></td>
          </tr>
      </table>
      </td>
    </tr>
    <tr>
      <td height="30">
      <table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="98" height="25" align="right" bgcolor="#FFFFFF">用户名：</td>
  <td width="302" height="25" bgcolor="#FFFFFF"><input class="shuru" onblur="return check(this.value)" type="text" name="usersname" id="textfield"/><span id="usid"></span></td>
        </tr>
        <tr>
          <td height="25" align="right" bgcolor="#FFFFFF">密码：</td>
          <td height="25" bgcolor="#FFFFFF"><input type="password" class="shuru" name="pwd" id="textfield2" /></td>
        </tr>
        <tr>
          <td height="25" align="right" bgcolor="#FFFFFF">重复密码：</td>
          <td height="25" bgcolor="#FFFFFF"><input type="password" class="shuru" name="cfpwd" id="textfield3" /></td>
        </tr>
        <tr>
          <td height="25" colspan="1" align="left" bgcolor="#FFFFFF">&nbsp;</td>
		<td><input type="submit" name="Submit" id="button" value="提交" class="anniu" />
&nbsp;&nbsp;
<input type="reset" name="button2" id="button2" value="取消" class="anniu" /></td>
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