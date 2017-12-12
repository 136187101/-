<?php
if($_GET["act"] == "logout"){
   @session_start(); 
   session_destroy(); 
  echo "<script>alert('退出成功');location.href ='/admin/xcty.html'</script>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD>
<TITLE>用户登录</TITLE>


<LINK href="css/User_Login.css" type=text/css rel=stylesheet>

<META content="MSHTML 6.00.6000.16674" name=GENERATOR><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></HEAD>


<BODY id=userlogin_body>
<DIV></DIV>
<form name="myform" action="admin.php?act=login" method="post">
<DIV id=user_login>
<DL>
  <DD id=user_top>
  <UL>
    <LI class=user_top_l></LI>
    <LI class=user_top_c></LI>
    <LI class=user_top_r></LI></UL>
  <DD id=user_main>
  <UL>
    <LI class=user_main_l></LI>
    <LI class=user_main_c>
    <DIV class=user_main_box>
    <UL>
      <LI class=user_main_text>用户名： </LI>
      <LI class=user_main_input><input class="TxtUserNameCssClass" id="username"  maxLength="20" value="" name="username"> 
      </LI></UL>
    <UL>
      <LI class=user_main_text>密 码： </LI>
      <LI class=user_main_input><input class="TxtPasswordCssClass" id="passwd "
      type="password" name="passwd"> 
      </LI></UL>
    <UL>
      <LI class=user_main_text>验证码： </LI>
      <LI class=user_main_input><input name="codename" type="text" class="yzm" id="textfield3"  size="6" maxlength="4"/>
      </LI><li>&nbsp;<img src="verifyCode.php" onClick="this.src='verifyCode.php?'+new Date().getTime()" title="点击刷新"></li></UL></DIV></LI>
    <LI class=user_main_r><input name="submit" type="submit" class="button" id="Submit" value="登 陆" style="background:url(images/user_botton.gif); background-repeat:no-repeat; height:122px; width:111px; border:0px;"></LI></UL>
  <DD id=user_bottom>
  <UL>
    <LI class=user_bottom_l></LI>
    <LI class=user_bottom_c></LI>
    <LI class=user_bottom_r></LI></UL></DD></DL></DIV><SPAN id=ValrUserName 
style="DISPLAY: none; COLOR: red"></SPAN><SPAN id=ValrPassword 
style="DISPLAY: none; COLOR: red"></SPAN><SPAN id=ValrValidateCode 
style="DISPLAY: none; COLOR: red"></SPAN>
<DIV id=ValidationSummary1 style="DISPLAY: none; COLOR: red"></DIV>

<DIV></DIV>

</form></BODY></HTML>
