<?php header("Content-Type:text/html; charset=utf-8");
require_once("../../include/global.php");
require_once("../include/function.php");

$sql = $db->query("select uid from im_list where euid='$cookie_xsuid' and duan='0'");
$rs = $db->fetch_array($sql);
	if(empty($rs)){
		echo 0;
	}else{
		$uid = $rs["uid"];
		$rs_xsmain = $db->get_one("select user_file from xues_main where id='$uid'");
		$user_file = user_file_all($rs_xsmain["user_file"]);//会员头像
		echo $uid."}".$user_file;
	}
?>