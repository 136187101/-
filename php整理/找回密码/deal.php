<?php
session_start();
header('Content-type: text/html;charset=utf-8');
$num_awt=$_SESSION['authcode'];//验证码
require_once("../include/global.php");
require_once("../include/smtp.php");
$act=$_GET["act"];

function file_useffile($filelj,$width,$height,$d){
	if($d == 1){
		$picname = "x";
	}else{
		$picname = "";
	}
	$xfilej=substr($filelj,15,200);
	$fileljp="..".$filelj;
	$image=$fileljp;//图片路径
	$img=getimagesize($image);//载入图片的函数   得到图片的信息
	switch($img[2]){//判断图片的类型
		case 1:
			$im=@imagecreatefromgif($image);//载入图片，创建新图片
		break;
		case 2:
			$im=@imagecreatefromjpeg($image);
		break;
		case 3:
			$im=@imagecreatefrompng($image);
		break;
	}
	$width_y=$img[0];
	$height_y=$img[1];
	if($width_y>$height_y){//如果宽大于高
		$width_y_y=$height_y;
		$height_y_y=$height_y;
		$jq_x=($width_y-$height_y)/2;
		$jq_y=0;
	}else if($width_y<$height_y){//如果宽小于高
		$height_y_y=$width_y;
		$width_y_y=$width_y;
		$jq_x=0;
		$jq_y=($height_y-$width_y)/2;
	}else if($width_y=$height_y){//如果宽小于高
		$width_y_y=$width_y;
		$height_y_y=$height_y;
		$jq_x=0;
		$jq_y=0;
	}
	$newim=imagecreatetruecolor($width,$height); //剪切图片第一步，建立新图像 x就是宽 ，y就是高//图片大小
	imagecopyresampled($newim,$im,0,0,$jq_x,$jq_y,$width,$height,$width_y_y,$height_y_y);//这个函数不失真
	imagejpeg($newim, "../admin/userpic/".$picname.$xfilej, 100);//加个100可以更清晰
}


function file_group_h400($filelj,$width,$height){
	
		$xfilej=substr($filelj,15,200);
		
		$fileljp="..".$filelj;//相对路径
		$image=$fileljp;//图片路径
		$img=getimagesize($image);//载入图片的函数   得到图片的信息
		switch($img[2]){//判断图片的类型
			case 1:
				$im=@imagecreatefromgif($image);//载入图片，创建新图片
			break;
			case 2:
				$im=@imagecreatefromjpeg($image);
			break;
			case 3:
				$im=@imagecreatefrompng($image);
			break;
		}
		$width_y=$img[0];
		$height_y=$img[1];

			$width_y_y=$width_y;
			$height_y_y=400;
			$jq_x=0;
			$jq_y=10;
			
		$newim=imagecreatetruecolor($width,$height); //剪切图片第一步，建立新图像 x就是宽 ，y就是高//图片大小
		imagecopyresampled($newim,$im,0,0,$jq_x,$jq_y,$width,$height,$width_y_y,$height_y_y);//这个函数不失真
		imagejpeg($newim, "../admin/userpic/".$xfilej, 100);//加个100可以更清晰
	}
//---------------------------------------------------------------------GD库图片截取---规定的宽和高 长方形

switch($act){
	case "reg":
		$ip=$_SERVER["REMOTE_ADDR"];
		$user_fullname=trim($_POST["user_fullname"]);
		$user_email=trim($_POST["user_email"]);
		$user_password=$_POST["user_password"];
		$password_md5=md5($user_password);//用md5加密码
		$zjwlgr_password=$password_md5.$user_password.$password_md5;//找回密码时用
		$md5_id = substr($password_md5,0,11);//建立会员推广链接后缀
		$num_dcg=$_POST["num_dcg"];
		$hidde=$_POST["hidde"];
		$yaoqing=$_POST["yaoqing"];
		$re=$_POST["re"];//被谁邀请的字符串
		$data_ymd=date("Ymd",time());
		//=------------------------------------------------------------------接收所有字段
		$sql_email=$db->query("select * from reg where user_email='$email'");
		$num_email=$db->num_rows($sql_email);
		//----------------------------------------------------------------查询邮箱是否被占用
		$sql_ip=$db->query("select * from user_ip where ip='$ip' and TO_DAYS(now())-TO_DAYS(time_at)<=1");
		$num_ip=$db->num_rows($sql_ip);
		//------------------------------------------------------------------查询此IP注册的次数
		$sql_yaoqing = $db->query("select * from yaoqing where yaoqing='$yaoqing'");//邀请码
		$num_yaoqing = $db->num_rows($sql_yaoqing);//邀请码
		//------------------------------------------------------------------查邀请码有没有被用过
		if($num_yaoqing == 0){//邀请码
			$js->Alert("您输入的邀请码已使用或错误！");//邀请码
			$js->Back();//邀请码
		}elseif($hidde!=$data_ymd){
			$js->Alert("请通过本站注册页面进行注册");
			$js->Goto("reg.php");
		}elseif($num_ip>=20){
			$js->Alert("您的IP为：".$ip."，您今天已经注册过20次了，请明天在来注册！");
			$js->Goto("/index.php");
		}elseif($num_dcg!=$num_awt){
			$js->Alert("验证码输入错误！");
			$js->Back();
		}elseif($num_email!=0){
			$js->Alert("您注册的邮箱已被占用，请更换！");
			$js->Back();
		}else{
			$db->update("INSERT INTO `reg` (`id` ,`user_fullname` ,`user_email` ,`user_password` ,`zjwlgr_password` ,`ci` ,`ip` ,`md5_id_us` ,`time_aa` ,`time_ar` ,`time_at` )VALUES (NULL , '$user_fullname', '$user_email', '$password_md5', '$zjwlgr_password', '1', '$ip', '$re', NOW( ), NOW( ), NOW( ) );");
			$uid=$db->insert_id();
			$md5_id_uid = $md5_id.$uid;//建立会员推广链接后缀
			$db->update("update reg set md5_id='$md5_id_uid' where id='$uid'");
			setcookie("uidd",$uid,time()+3600*5,"/");
			//setcookie("uidd",$uid,time()+3600*5,"/","geekshop.cc");
			$db->update("INSERT INTO `user_ip` (`id` ,`ip` ,`time_at` )VALUES (NULL , '$ip', NOW( ) );");//添加注册者IP
			$db->update("update yaoqing set uid='$uid' where yaoqing='$yaoqing'");//邀请码
			//$js->Alert("恭喜您注册成功！");
			$js->Goto("/user_index.php");
		}
	break;
	
	case "login":
		$user_session_email=$_POST["user_session_email"];
		$user_session_password=$_POST["user_session_password"];
		$password_md5=md5($user_session_password);//用md5加密
		$user_session_remember_me=$_POST["user_session_remember_me"];
		$laiurl=$_POST["laiurl"];//来源URL
		//=------------------------------------------------------------------接收所有字
		if($user_session_remember_me == 1){
			$autologin = 99999;
		}else{
			$autologin = 1;
		}
		$sql=$db->query("select * from reg where user_email='$user_session_email' and user_password='$password_md5'");
		$num=$db->num_rows($sql);
		$rs=$db->fetch_array($sql);
		$uid=$rs["id"];
		if($num==0){
			$js->Alert("邮箱地址或密码不正确！");
			$js->Back();
		}else if($rs["duan"] == 1){
			$js->Alert("您的帐号已被停用，请联系管理员！");
			$js->Back();
		}else{
			setcookie("uidd",$uid,time()+3600*$autologin,"/");//,"geekshop.cc"
//setcookie("uidd",$uid,time()+3600*$autologin,"/","geekshop.cc");//
			$db->update("update reg set ci=ci+1,time_ar=now() where user_email='$user_session_email' and user_password='$password_md5'");
			$js->Goto("/c_ghdd.php");
			/*$laisuburl=$laiurl;
			if(substr($laisuburl,-15)=="/user/login.php"){//如果登陆页面跳到会员中心首页
				echo "zj";
			}else{
				echo $laiurl;
			}*/
			
			
		}
	break;
	
	case "die":
		setcookie("uidd","",time()-3600,"/");
		//setcookie("uidd","",time()-3600,"/","geekshop.cc");
		$js->Goto("/");
	break;
	
	case "retrieve":
		$user_email=$_POST["user_email"];
		//$username=$_POST["username"];
		//=------------------------------------------------------------------接收所有字
		$sql_email=$db->query("select * from reg where user_email='$user_email'");
		$num_email=$db->num_rows($sql_email);
		//$sql_username=$db->query("select * from reg where username='$username'");
		//$num_username=$db->num_rows($sql_username);
		//$sql_e_u=$db->query("select * from reg where email='$email' and username='$username'");
		//$num_e_u=$db->num_rows($sql_e_u);
		//----------------------------------------------------------------查询邮箱、昵称是否存
		$rs_e_u=$db->fetch_array($sql_email);
		$password_wj=$rs_e_u["zjwlgr_password"];
		$password_wjd=substr($password_wj,32,100);//07b1c70ec2300f854fa54a0e459836f9
		$password_wjf=substr($password_wjd,0,-32);
		//-----------------------------------------------------------------得到md5加密前密码
		if($num_email==0){
			$js->Alert("您输入的邮箱地址不存在！");
			$js->Back();
		}else{
			#########################################
			$webmeme=TITLE;
			$mailbody="<HTML><HEAD><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
			$mailbody=$mailbody."</HEAD><BODY><p>".$username."您好！欢迎您在".TITLE."注册会员！<br><br>";
			$mailbody=$mailbody." 您找回的密码是：".$password_wjf."，请您牢记密码。<br><br>";
			$mailbody=$mailbody." <a href='".$zj->sys_con("con_url")."user_login.php' target='_blank'>点击登录</a> </p>";
			$mailbody=$mailbody."</BODY></HTML>";
			//$mailbody= iconv("UTF-8","GB2312", "$mailbody"); 
			##########################################
			$smtpserver = "smtp.sina.com";//SMTP服务器
			$smtpserverport =25;//SMTP服务器端口
			$smtpusermail = 'zjwlgr@sina.com'; //SMTP服务器的用户邮箱
			$smtpemailto = $user_email;//发送给谁
			$fromname= "=?UTF-8?B?".base64_encode($webmeme)."?=";//自定义发件人，靠
			$smtpuser = "zjwlgr";//SMTP服务器的用户帐号
			$smtppass = "47782906";//SMTP服务器的用户密码
			$mailsubject = "=?UTF-8?B?".base64_encode($webmeme."会员密码找回")."?=";//邮件主题
			$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
			##########################################
			$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
			$smtp->debug = false;//TRUE;//是否显示发送的调试信息
			$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype, $fromname);
			$js->alert("密码已发送到您的邮箱，请您进快修改密码！");
			$js->goto("/user_login.php");
		}
	break;
	
	case "ymc":
		$profile_gender = $_POST["profile_gender"];//性别
		$profile_birthday_1i = $_POST["profile_birthday_1i"];
		$profile_birthday_2i = $_POST["profile_birthday_2i"];
		$profile_birthday_3i = $_POST["profile_birthday_3i"];
		$profile_hometown = $_POST["profile_hometown"];
		$profile_desc = $_POST["profile_desc"];
		$profile_renren_name = $_POST["profile_renren_name"];
		$profile_weibo_name = $_POST["profile_weibo_name"];
		$profile_website = $_POST["profile_website"];
		$user_place_id = $_POST["user_place_id"];
		$profile_interesting_fact = $_POST["profile_interesting_fact"];
		$user_pic = $_POST["user_pic"];//头像
		
		
		if($_FILES["user_pic"]["name"]==""){
			//$user_file=$rs_reg["user_filed"];
		}else{
			$user_file=upload("user_pic","/admin/userpic/",array(".gif",".jpg",".jpeg",".png"),"2000000");
			file_useffile($user_file,80,80,1);//剪切图片
			file_useffile($user_file,600,600,2);//剪切图片
			file_group_h400($user_file,600,400);//在来一次101*118的
			
			$user_filex = "/admin/userpic/x".substr($user_file,15,35);//得到小图片路径
			
			$rs_reg = $db->get_one("select user_filed,user_filex from reg where id='$cookie_uid'");
			$newslistd=$rs_reg["user_filed"];
			$newslistx=$rs_reg["user_filex"];
			$root=$_SERVER['DOCUMENT_ROOT'];
			$root.=$newslistd;
			@unlink($root);
			$root2=$_SERVER['DOCUMENT_ROOT'];
			$root2.=$newslistx;
			@unlink($root2);
				
				
			$db->update("update reg set user_filed='$user_file',user_filex='$user_filex' where id='$cookie_uid'");
		}
		
		//=------------------------------------------------------------------接收所有字段
		$sql_user_zl = $db->query("select id from user_zl where uid='$cookie_uid'");
		$num_user_zl = $db->num_rows($sql_user_zl);
		if($num_user_zl == 0){
			$db->update("INSERT INTO `user_zl` (`id` ,`profile_gender` ,`profile_birthday_1i` ,`profile_birthday_2i` ,`profile_birthday_3i` ,`profile_hometown` ,`profile_desc` ,`profile_renren_name` ,`profile_weibo_name` ,`profile_website` ,`profile_interesting_fact` ,`user_place_id` ,`job_vocation` ,`job_employer_name` ,`ob_title_name` ,`profiles_school_school_name` ,`profiles_school_year_1i` ,`profiles_school_degree` ,`profiles_school_major` ,`uid` ,`time_at` )VALUES (NULL , '$profile_gender', '$profile_birthday_1i', '$profile_birthday_2i', '$profile_birthday_3i', '$profile_hometown', '$profile_desc', '$profile_renren_name', '$profile_weibo_name', '$profile_website', '$profile_interesting_fact', '$user_place_id', '$job_vocation', '$job_employer_name', '$ob_title_name', '$profiles_school_school_name', '$profiles_school_year_1i', '$profiles_school_degree', '$profiles_school_major', '$cookie_uid', NOW( ) );");
		}else{
			$db->update("update user_zl set profile_gender='$profile_gender', profile_birthday_1i='$profile_birthday_1i', profile_birthday_2i='$profile_birthday_2i', profile_birthday_3i='$profile_birthday_3i', profile_hometown='$profile_hometown', profile_desc='$profile_desc', profile_renren_name='$profile_renren_name', profile_weibo_name='$profile_weibo_name', profile_website='$profile_website', profile_interesting_fact='$profile_interesting_fact', user_place_id='$user_place_id' where uid='$cookie_uid'");
		}
		
		$js->Goto("/user_ymc.php");
		
	
	break;
	
		case "ymc2":
		$job_vocation = $_POST["job_vocation"];
		$job_employer_name = $_POST["job_employer_name"];
		$ob_title_name = $_POST["ob_title_name"];
		$profiles_school_school_name = $_POST["profiles_school_school_name"];
		$profiles_school_year_1i = $_POST["profiles_school_year_1i"];
		$profiles_school_degree = $_POST["profiles_school_degree"];
		$profiles_school_major = $_POST["profiles_school_major"];
		//=------------------------------------------------------------------接收所有字段
		$sql_user_zl = $db->query("select id from user_zl where uid='$cookie_uid'");
		$num_user_zl = $db->num_rows($sql_user_zl);
		if($num_user_zl == 0){
			$db->update("INSERT INTO `user_zl` (`id` ,`profile_gender` ,`profile_birthday_1i` ,`profile_birthday_2i` ,`profile_birthday_3i` ,`profile_hometown` ,`profile_desc` ,`profile_renren_name` ,`profile_weibo_name` ,`profile_website` ,`profile_interesting_fact` ,`user_place_id` ,`job_vocation` ,`job_employer_name` ,`ob_title_name` ,`profiles_school_school_name` ,`profiles_school_year_1i` ,`profiles_school_degree` ,`profiles_school_major` ,`uid` ,`time_at` )VALUES (NULL , '$profile_gender', '$profile_birthday_1i', '$profile_birthday_2i', '$profile_birthday_3i', '$profile_hometown', '$profile_desc', '$profile_renren_name', '$profile_weibo_name', '$profile_website', '$profile_interesting_fact', '$user_place_id', '$job_vocation', '$job_employer_name', '$ob_title_name', '$profiles_school_school_name', '$profiles_school_year_1i', '$profiles_school_degree', '$profiles_school_major', '$cookie_uid', NOW( ) );");
		}else{
			$db->update("update user_zl set job_vocation='$job_vocation', job_employer_name='$job_employer_name', ob_title_name='$ob_title_name', profiles_school_school_name='$profiles_school_school_name', profiles_school_year_1i='$profiles_school_year_1i', profiles_school_degree='$profiles_school_degree', profiles_school_major='$profiles_school_major' where uid='$cookie_uid'");
		}
		
		$js->Goto("/user_ymc2.php");
		
	
	break;
	
	case "rjyq":
		$jid = $_GET["jid"];
		$content = htmlspecialchars($_POST["content"]);
		
		if($zj->user_pay_list($cookie_uid,$jid) == 1){
			$db->update("INSERT INTO `hxz`.`jc_mssg` (`id` ,`jid` ,`uid` ,`content` ,`time_at` ,`duan` )VALUES (NULL , '$jid', '$cookie_uid', '$content', NOW( ) , '1');");
			//$js->Alert("提交成功！");
			$js->Goto("../c_ghdd_x.php?id=$jid#cgg");
		}else{
			$js->Alert("参加了聚餐的人才可以留言！");
			$js->Goto("../c_ghdd_x.php?id=$jid#cgg");
		}
		
		
	break;
	
	case "userpl":
		$uid = $_POST["uid"];
		$content = htmlspecialchars($_POST["content"]);
		if($zj->user_pay_haoyou($uid,$cookie_uid)){
			$db->update("INSERT INTO `user_pl` (`id` ,`uid` ,`puid` ,`content` ,`time_at` ,`duan` )VALUES (NULL , '$cookie_uid', '$uid', '$content', NOW( ) , '0');");
			$js->Goto("../user_user_index.php?uid=$uid#cgg");
		}else{
			$js->Alert("您不是他的好友，不能提交评论！");
			$js->Goto("../user_user_index.php?uid=$uid#cgg");
		}
		
	break;
	
	case "ymc3":
		$job_vo1 = $_POST["job_vo1"];
		$job_vo2 = $_POST["job_vo2"];
		$job_vo3 = $_POST["job_vo3"];
		$sql_user_zl = $db->query("select id from user_zl where uid='$cookie_uid'");
		$num_user_zl = $db->num_rows($sql_user_zl);
		if($num_user_zl == 0){
			$db->update("INSERT INTO `user_zl` (`id` ,`job_vo1` ,`job_vo2` ,`job_vo3` ,`uid` ,`time_at` )VALUES (NULL , '$job_vo1', '$job_vo2', '$job_vo3', '$cookie_uid', NOW( ) );");
		}else{
			$db->update("update user_zl set job_vo1='$job_vo1', job_vo2='$job_vo2', job_vo3='$job_vo3' where uid='$cookie_uid'");
		}
		$js->Goto("/user_ymc3.php");
	break;
	
	case "xiayig":
		$id = $_GET["id"];
		$rs = $db->get_one("select id from ddt_main where id<'$id' order by id desc limit 0,1");
		$idd = $rs["id"];
		if($idd == ""){
			$rfs = $db->get_one("select id from ddt_main order by id desc limit 0,1");
			$idd = $rfs["id"];
		}
		$js->Goto("../md_content.php?id=$idd");
	break;
	
	case "ddtlkd":
	
		if($cookie_uid=="" || $cookie_uid=="deleted"){
			//$js->Alert("当前您没有登录或超时，请返回登录！");
			$js->Goto("/user_login.php");
			die();
		}
	
		$add_comment = $_POST["add_comment"];
		$did = $_POST["did"];
		$rs_did = $db->get_one("select title from ddt_main where id='$did'");
		$ddt_main_title = $rs_did["title"];
		$db->update("INSERT INTO `ddt_lkd` (
`id` ,
`did` ,
`uid` ,
`content` ,
`time_at` 
)
VALUES (
'', '$did', '$cookie_uid', '$add_comment', NOW( ) 
);
");
$dkid=$db->insert_id();
//-=---------------------------------------------------------------------------------------
	$sql_uid = $db->query("select uid from ddt_lkd where uid<>'$cookie_uid' and did='$did' group by uid");
	while($rs_uid = $db->fetch_array($sql_uid)){
		$sql_ddt_txing = $db->query("select * from ddt_txing where uid='".$rs_uid["uid"]."' and did='$did' and typepage='d' and duan='0'");
		$num_ddt_txing = $db->num_rows($sql_ddt_txing);
		if($num_ddt_txing == 0){
			$db->update("INSERT INTO `ddt_txing` (`id` ,`typepage` ,`dkid` ,`did` ,`uid` ,`content` ,`duan` ,`ci` ,`time_at` )VALUES (NULL , 'd', '$dkid', '$did', '".$rs_uid["uid"]."', '', '0', '1', NOW( ) );");
		}else{
			$db->update("update ddt_txing set ci=ci+1 where uid='".$rs_uid["uid"]."' and did='$did' and typepage='d' and duan='0'");
		}
	}
//-=---------------------------------------------------------------------------------------
	$js->Goto("../md_content.php?id=$did#dfdf");
	
	break;
	
	case "huihui":
	
		if($cookie_uid=="" || $cookie_uid=="deleted"){
			//$js->Alert("当前您没有登录或超时，请返回登录！");
			$js->Goto("/user_login.php");
			die();
		}
		
		$add_comment = $_POST["add_comment"];
		$did = $_POST["did"];//回复ID
		$id = $_POST["id"];//问题ID
		$db->update("INSERT INTO `ddt_hui` (
`id` ,
`did` ,
`kid` ,
`uid` ,
`content` ,
`time_at` 
)
VALUES (
NULL , '$id', '$did', '$cookie_uid', '$add_comment', NOW( ) 
);

");
$dkid=$db->insert_id();


		//-=---------------------------------------------------------------------------------------
	$sql_uid = $db->query("select uid from ddt_hui where uid<>'$cookie_uid' and did='$id' and kid='$did' group by uid");
	while($rs_uid = $db->fetch_array($sql_uid)){
		/*$sql_ddt_txing = $db->query("select * from ddt_txing where uid='".$rs_uid["uid"]."' and did='$id' and typepage='y' and dkid='$did' and duan='0'");
		$num_ddt_txing = $db->num_rows($sql_ddt_txing);
		if($num_ddt_txing == 0){*/
			$db->update("INSERT INTO `ddt_txing` (`id` ,`typepage` ,`dkid` ,`did` ,`uid` ,`zuid` ,`content` ,`duan` ,`ci` ,`time_at` )VALUES (NULL , 'y', '$did', '$id', '".$rs_uid["uid"]."', '$cookie_uid', '', '0', '1', NOW( ) );");
		/*}else{
			$db->update("update ddt_txing set ci=ci+1 where uid='".$rs_uid["uid"]."' and did='$id' and typepage='y' and dkid='$did' and duan='0'");
		}*/
	}
//-=---------------------------------------------------------------------------------------

		
		$js->Goto("../md_lkd.php?did=$did&id=$id#dfdf");
	break;
	
	
}




?>