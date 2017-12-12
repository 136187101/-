<?php header("Content-Type:text/html; charset=utf-8");
require_once("../../include/global.php");
require_once("../include/function.php");
date_default_timezone_set('PRC');
$euid = $_GET["euid"];

$sql = $db->query("select id,image,content,time_at from im_list where uid='$euid' and euid='$cookie_xsuid' and duan='0'");
while($rs = $db->fetch_array($sql)){
	$db->update("update im_list set duan='1' where id='".$rs["id"]."'");//更新为已查看过的
	if(!empty($rs["image"])){
		$impicnoe = "<div class=\"image116\"><img src=\"".$rs["image"]."\" /></div>";
	}else{
		$impicnoe = "";
	}
	$imtime = date("y-m-d H:i:s",$rs["time_at"]);
	$imcontent = $rs["content"].$impicnoe;
	$immeent .= $imtime."}IM{".$imcontent."]IM[";  //  分割符号得变一下
}
	
	$immeent = substr($immeent,0,-4);
	if(empty($immeent)){
		$ret_urn = 0;
	}else{
		$ret_urn = $immeent;
	}
	
	echo $ret_urn;
	
?>