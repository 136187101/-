<?php header("Content-Type:text/html; charset=utf-8");
require_once("../../include/global.php");
require_once("../include/function.php");
date_default_timezone_set('PRC');

	$image = $_POST["image"];
	$content = IM_t2h($_POST["content"]);
	$zsdid = $_POST["zsdid"];
	$euid = $_POST["euid"];
if($euid != "")	{

	//--------------------------------------------------------替换表情
	$sql_face=$db->query("select facename,facefile from face");
	while($rs_face=$db->fetch_array($sql_face)){
		$facename=$rs_face["facename"];
		$facefile=$rs_face["facefile"];
		$content = str_replace($facename," <img src=\"".$facefile."\" class=\"IM_face_22\" />",$content);
	}//--------------------------------------------------------替换表情
	
	$db->update("INSERT INTO `im_list` (`id` ,`uid` ,`euid` ,`image` ,`content` ,`zsdid` ,`time_at`)VALUES (NULL ,  '$cookie_xsuid',  '$euid',  '$image',  '$content',  '$zsdid',  '".time()."');");
	
	if(!empty($image)){
		$impicnoe = "<div class=\"image116\"><img src=\"".$image."\" /></div>";
	}else{
		$impicnoe = "";
	}
	
	echo $content.$impicnoe."「IM」".date("y-m-d H:i:s",time());
	
	//echo "{ image : \"".$impicnoe."\" , content : \"".$content."\" , zsdid : \"".$zsdid."\" , euid : \"".$cookie_xsuid ."\"}";
	
}
?>