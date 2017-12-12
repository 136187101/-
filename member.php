<?php
session_start();
$num_awt=$_SESSION['authcode'];//验证码
	require_once("include/global.php");
	if($_POST[sub])
		{
		$sj=date('Y-m-d H:i:s');
		$db->update("insert into users (Email,pwd,zcsj) values('$email','$pwd','$sj')");
		$js->Alert("注册成功");
		$js->Goto("");
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>


<link rel="stylesheet" type="text/css" href="css/css.css"/>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/member.js"></script>


</head>
<body>
<form id="form1" name="form1" method="post" action="?act=sum" onsubmit="yan();return false;">
<?php require_once("top.php")?>
<div class="member_top"><img src="img/images/member_03.jpg" width="927" height="37" /></div>
<div class="member_zh">
	<div class="member_zh_top">
    	<h3>驴小二网欢迎您的注册</h3>
        <p><a href="#">使用手机号码注册</a>，安全方便且完全免费</p>
    </div>
    <div class="member_zh_zh"><span class="zcbj1">1.填写注册信息</span><span class="zcbj2">2.注册成功</span></div>
    <div class="member_zh_bom">
    	<ul>
        	<li>
            <span style=" float:left; display:block; position:relative; top:5px;">Email地址：</span>
        	 <input name="email" type="text" class="shur" id="email" onmousemove="className='shur1'" onmouseout="className='shur'"  />
             <div id="jieguo" class="jieguo"></div>
              <input name="sub" type="hidden" value="提交" />
       	  </li>
            <li>
            <span style=" float:left; display:block; margin-left:7px; position:relative; top:5px;">登陆密码：</span>
              <input name="pwd" type="password" class="shur" id="pwd"  onmousemove="className='shur1'" onmouseout="className='shur'"/>
              <div id="jieguo1" class="jieguo"></div>
          </li>
            <li>
            <span style=" float:left; display:block; margin-left:7px; position:relative; top:5px;">确认密码：</span>
              <input name="cfpwd" type="password" class="shur" id="cfpwd" onmousemove="className='shur1'" onmouseout="className='shur'" />
              <div id="jieguo2" class="jieguo"></div>
          </li>
            <li>
            <span style=" float:left; display:block; margin-left:19px; _margin-left:15px; position:relative; top:5px;">验证码：</span>
            <input name="num_dcg" type="text" class="shur" id="num_dcg" onmousemove="className='shur1'" onmouseout="className='shur'" />
            <div id="jieguo3" class="jieguo"></div><span id="usid"></span>
          </li>
            <li class="yanzheng">
            <img src="admin/houtai/yzm/coedos_one.php" width="70" height="24" alt="" style=" cursor:hand; float:left;" onClick="uiy.src='admin/houtai/yzm/coedos_one.php?'+Math.random();" id="uiy" />
				<span style="position:relative; top:5px; float:left; display:block;">看不清？</span>
                <span style="position:relative; top:5px; cursor:hand; color:#355e8c; float:left; display:block;" onClick="uiy.src='admin/houtai/yzm/coedos_one.php?'+Math.random();" >换张图</span>
             </li>
            <li class="yanzheng"><input name="sub" type="image" src="img/images/tjzc_06.jpg" /></li>
            <li class="yanzheng"><input type="checkbox" name="checkbox" id="checkbox" style="position:relative; top:1px;" />
            <a href="#" >我已阅读并同意《驴小二网交易条款》和《驴小二网社区条款》</a></li>
        </ul>
    </div>
</div> 
<?php require_once("bottmo.php")?>
</form>
</body>
</html>