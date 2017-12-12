<?php 
require_once("include/init.php");
if($_POST['usersname']){
include './index/config.inc.php';
include './index/client.php';
require_once("include/init.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$usersname = '';
	if(!empty($_POST['activation']) && ($activeuser = uc_get_user($_POST['activation']))) {
		list($uid, $usersname) = $activeuser;
	} else {
		if(uc_get_user($_POST['usersname']) && !$db->result_first("SELECT uid FROM {$tablepre}members WHERE username='$_POST[usersname]'")) {
			//判断需要注册的用户如果是需要激活的用户，则需跳转到登录页面验证
			echo '该用户无需注册，请激活该用户<br><a href="'.$_SERVER['PHP_SELF'].'?example=login">继续</a>';
			
		}

		$uid = uc_user_register($_POST['usersname'], $_POST['pwd'], $_POST['email']);
		if($uid <= 0) {
			if($uid == -1) {
				echo "<script language=javascript>alert('用户名不合法')</script>";
			} elseif($uid == -2) {
				echo "<script language=javascript>alert('包含要允许注册的词语')</script>";
			} elseif($uid == -3) {
				echo "<script language=javascript>alert('用户名已经存在')</script>";
			} elseif($uid == -4) {
				echo "<script language=javascript>alert('Email 格式有误')</script>";
			} elseif($uid == -5) {
				echo "<script language=javascript>alert('Email 不允许注册')</script>";
			} elseif($uid == -6) {
				echo "<script language=javascript>alert('Email已经被注册')</script>";
			} else {
				echo "<script language=javascript>alert('未定义')</script>";
			}
			echo "<script language=javascript>location.href = '/Registr.php'</script>";
		} else {
			$usersname = $_POST['usersname'];
		}
	}
	if($usersname) {
	//$db->query("INSERT INTO dadecommon_member (uid,username,admin) VALUES ('$uid','$usersname','0')");
	//$db->query("INSERT INTO {$tablepre}members (uid,username,admin) VALUES ('$uid','$usersname','0')");
	$sex=$_POST['sex'];
	$job=$_POST['job'];
	$baby=$_POST['baby'];
	$babyage=$_POST['babyage'];
	$qq=$_POST['qq'];
	$tel=$_POST['tel'];
	/*echo "INSERT INTO {$tablepre}members (uid,username,sex,job,baby,babyage,qq,tel,question) VALUES ('$uid','$usersname','$sex','$job','$baby','$babyage','$qq','$tel','$question')";
	$question=$_POST['bth'].",".$_POST['ts'].",".$_POST['bash'].",".$_POST['qt'].",";
		$db->query("INSERT INTO dadeucenter_members (uid,username,sex,job,baby,babyage,qq,tel,question) VALUES ('$uid','$usersname','$sex','$job','$baby','$babyage','$qq','$tel','$question')");
		$db->query("INSERT INTO dadecommon_member (uid,username,sex,job,baby,babyage,qq,tel,question) VALUES ('$uid','$usersname','$sex','$job','$baby','$babyage','$qq','$tel','$question')");*/
		
		//注册成功，设置 Cookie，加密直接用 uc_authcode 函数，用户使用自己的函数
		/*$sql="update dadecommon_member set sex=$sex,job,baby=$baby,babyage=$babyage,qq=$qq,tel=$tel,question=$question where uid=$uid";
		$db->setQuery($sql);
		$db->query();*/
				$sql="update dadeucenter_members set sex='$sex',job='$job',baby='$baby',babyage='$babyage',qq='$qq',tel='$tel',question='$question' where uid=$uid"; echo $sql;
		//$db->setQuery($sql);
		$db->query($sql);
		setcookie('Example_auth', uc_authcode($uid."\t".$usersname, 'ENCODE'));
		//echo "<script language=javascript>alert('您已注册成功！')</script>";
  //echo "<script language=javascript>location.href = '/bbs'</script>";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/dade.css"/>
<script language="javascript" src="js/users.js"></script>

<title>大德正堂_注册</title>
</head>

<body>
<?php
	require_once("inc/top.php");
?>
<div class="erj_img">
<a href="<?php echo $hjd->Adver(17,url)?>" target="_blank"><img src="<?php echo $hjd->Adver(17,image)?>"  width="969" height="152"  /></a>
</div>
<div class="main">
	  <div class="zhuce">
        <div class="news_top" >
        				<img src="images/hongbiao_13.jpg" width="4" height="18" style="float:left; margin-left:15px; margin-top:8px;" />
			<p class="weizhi"><strong>当前位于： <a href="main.php">首页</a>> </strong>注册</p>
        </div>

                    <form id="form2" name="form2" method="post" action="" onSubmit="return submits();">
                      <table width="700" border="0" cellspacing="0" cellpadding="0" class="regis">
                      
                        <tr>
                          <td width="243" height="30" align="right" valign="top"><span class="zc_tx">用户名：</span></td>
                          <td width="456" height="50">
                          <input type="text" name="usersname" id="usersname"  class="zc_shuru" onBlur="check(this.value)" />
                          <p style=" position:relative; top:5px;" id="smg1">6-16位字符英文、数字组成</p>
                          </td>
                        </tr>
                        <tr>
                          <td height="30" align="right" valign="top"><span class="zc_tx">密码：</span></td>
                          <td height="50" valign="middle">
                          	<input type="password" name="pwd" id="pwd" class="zc_shuru" onBlur="pwdfu(this.value)" />
                            <p style=" position:relative; top:5px;" id="pwds">6-16位字符英文、数字组成</p>
                          </td>
                        </tr>
                        <tr>
                          <td height="30" align="right" valign="top"><span class="zc_tx">重复密码：</span></td>
                          <td height="50">
                          	<input type="password" name="cf_pwd" id="cf_pwd" class="zc_shuru" onBlur="cfpwd(this.value)" />
                            <p style=" position:relative; top:5px;" id="cfpwds">请再次输入密码</p>
                          </td>
                        </tr>
                        <tr>
                          <td height="30" align="right">性别：</td>
                          <td height="50">
                          		<input name="sex" type="radio" id="radio" value="1" checked="checked"/>
                          		男
								&nbsp;
								<input type="radio" name="sex" id="radio2" value="2" />
								女
                          </td>
                        </tr>
                        <tr>
                          <td height="30" align="right">职业：</td>
                          <td height="50">
                         	 <input type="text" name="job" id="job"  class="zc_shuru"/></td>
                        </tr>
                        <tr>
                          <td height="30" align="right">孩子：</td>
                          <td height="50">
                          		<input name="baby" type="radio" id="radio" value="1" checked="checked"/>
                          		男&nbsp;
<input type="radio" name="baby" id="radio2" value="2" />
女
                          </td>
                        </tr>
                        <tr>
                          <td height="30" align="right" valign="top"><span class="zc_tx">孩子年龄：</span></td>
                          <td height="50">
                         	 <input name="babyage" type="text"  class="zc_shuru" id="babyage" onBlur="babyage1(this.value)" />
                            <p style=" position:relative; top:5px;" id="hznl">&nbsp;&nbsp;</p>
                          </td>
                          <td width="1"></td>
                        </tr>
                        <tr>
                          <td height="50" align="right" valign="top"><span class="zc_tx">邮箱：</span></td>
                          <td height="50">
                   	       <input type="text" name="email" id="email"  class="zc_shuru" onBlur="emailf(this.value)" />
                             <p style=" position:relative; top:5px;" id="emails">输入您的邮箱</p>
                          </td>
                        </tr>
                        <tr>
                          <td height="30" align="right" valign="top"><span class="zc_tx">QQ：</span></td>
                          <td height="50">
                         	 <input type="text" name="qq" id=""  class="zc_shuru" onBlur="qq1(this.value)" />
                             <p style=" position:relative; top:5px;" id="qqx">&nbsp;&nbsp;</p>
                          </td>
                        </tr>
                        <tr>
                          <td height="30" align="right" valign="top"><span class="zc_tx">联系电话：</span></td>
                          <td height="50">
                         	 <input type="text" name="tel" id=""  class="zc_shuru" onBlur="telf(this.value)" />
                             <p style=" position:relative; top:5px;" id="telxs">&nbsp;&nbsp;</p>
                          </td>
                        </tr>
                        <tr>
                          <td height="30" align="right"><p>您在家庭教育中遇到的问题与困惑（选择）： </p></td>
                          <td height="50"><input name="bth" type="checkbox" id="bth" value="1" />
孩子不听话
  <input name="ts" type="checkbox" id="ts" value="1" />
孩子挑食
<input name="bash" type="checkbox" id="bash" value="1" />
孩子不爱说话
<input name="qt" type="checkbox" id="checkbox4" value="1" />
其他</td>
                        </tr>
                        
                        
                        <tr>
                          <td height="30" align="right">&nbsp;</td>
                          <input name="" type="hidden" value="" />
                          <td height="50"><input type="image" name="imageField" id="imageField" src="images/zc_an_03.jpg" title="提交" /></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center">&nbsp;</td>
                        </tr>
                      </table>
                    </form>
      
      </div>
	  <!--右侧1-->
	  <?php require_once("inc/right.php");?>
  </div>
<?php require_once("inc/bottom.php");?>
</body>
</html>