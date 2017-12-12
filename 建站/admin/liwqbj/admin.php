<?php   session_start();
include '../../include/init.php';
if($_GET[act]=='login'){
    if(isset($_POST['submit'])){
	    $username = $_POST['username'];
		$passwd = md5($_POST['passwd']);
		$codename = $_POST['codename'];

		if(empty($username)|empty($passwd)){
		   // msg('用户名或密码不能为空!','?act=login',3);
		   $js->Alert('用户名或密码不能为空!');
			$js->Goto('login.php');
			exit;
		}
		
		if (strtolower($codename)!=strtolower($_SESSION['code'])){ $js->Alert('验证码输入不正确!');$js->Goto('login.php');}  // msg("验证码输入不正确!");
		

		if(login($username,$passwd)){
		    $lifeTime = 3 * 3600;
		    $_SESSION['adminname'] =$username;
			//msg('登录成功!','index.php',2);
			//$js->Alert('登录成功!');
			$js->Goto('index.php');
		}else{
           // msg('登录失败!','?act=login',2);	
		   	
		 $js->Alert('用户名和密码错误!');
			$js->Goto('login.php');
	 	}  
    }

}else{
		//$smarty->display('admin/login.htm');
		$js->Goto('login.php');
	 }

function login($username,$passwd){
    global $db;
	$sql ="SELECT * FROM `admin_user` WHERE `username`='$username' AND `passwd`='$passwd'";
	$info =$db->getOne($sql);
	$_SESSION["uid"]=$info[uid];
	if(empty($info)){
	    return false;
	}
	return true;
}
?>
