<?php header("Content-Type:text/html; charset=utf-8");
require_once("../../include/global.php");
require_once("../include/function.php");
require_once("../include/pageclass.php");
date_default_timezone_set('PRC');
$euid = $_GET["euid"];
$page = $_GET["page"];

$canshu=$euid;
$pageno_ajax=$page;
$pagesize=11;//每页多少条
$sql=$db->query("select id from im_list where uid='$euid' and euid='$cookie_xsuid' UNION ALL select id from im_list where uid='$cookie_xsuid' and euid='$euid'");
$numn=$db->num_rows($sql);//得到总条数
$pa=new page_wlgr($numn,$pagesize,$pageno_ajax);//实例化
$toto=$pa->totoo();//开始的条数
$sql = $db->query("(select id,uid,image,content,duan,time_at from im_list where uid='$euid' and euid='$cookie_xsuid') UNION ALL (select id,uid,image,content,duan,time_at from im_list where uid='$cookie_xsuid' and euid='$euid') ORDER BY id ASC LIMIT ".$toto.",".$pagesize);
while($rs = $db->fetch_array($sql)){
	if($rs["duan"] == 0 && $rs["uid"] == $euid){//如果是新信息，变为已读信息（别人发给我的）
		$db->update("update im_list set duan='1' where id='".$rs["id"]."'");//更新为已查看过的
	}
	if(!empty($rs["image"])){
		$impicnoe = "<div class=\"image116\"><img src=\"".$rs["image"]."\" /></div>";
	}else{
		$impicnoe = "";
	}
	
	$imtime = date("y-m-d H:i:s",$rs["time_at"]);
	$imcontent = $rs["content"].$impicnoe;
	
	if($rs["uid"] == $euid){
		$t_w .= immsglist_1($imtime,$imcontent);//他给我发的
	}else{
		$t_w .= immsglist_2($imtime,$imcontent);//我给他发的
	}
	
}


	echo $t_w."{[-IM]-}".$pa->jks($canshu);





function immsglist_1($imtime1,$imcontent1){
	$funmeib1 = "<div class=\"chat_msg_list1\"><div class=\"chat_l1_time\">".$imtime1."</div><div class=\"chat_qp1\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"3\" height=\"3\"><img src=\"/im/img/bgv_r2_c2.gif\" width=\"3\" height=\"3\" /></td><td height=\"3\" background=\"/im/img/bgv_r2_c6.gif\"></td><td width=\"3\" height=\"3\"><img src=\"/im/img/bgv_r2_c8.gif\" width=\"3\" height=\"3\" /></td></tr><tr><td background=\"/im/img/bgv_r4_c2.gif\"></td><td class=\"tdfuck\">".$imcontent1."</td><td background=\"/im/img/bgv_r6_c8.gif\"></td></tr><tr><td width=\"3\" height=\"3\"><img src=\"/im/img/bgv_r8_c2.gif\" width=\"3\" height=\"3\" /><img src=\"/im/img/bgt3.gif\" class=\"chat_xxj\" width=\"9\" height=\"13\" /></td><td height=\"3\" background=\"/im/img/bgv_r8_c4.gif\"></td><td width=\"3\" height=\"3\"><img src=\"/im/img/bgv_r8_c8.gif\" width=\"3\" height=\"3\" /></td></tr></table></div></div>";
	return $funmeib1;
}
//................................................屏风
function immsglist_2($imtime2,$imcontent2){
	$funmeib2 = "<div class=\"chat_msg_list2\"><div class=\"chat_l1_time\">".$imtime2."</div><div class=\"chat_qp1\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"3\" height=\"3\"><img src=\"/im/img/bgvf_r2_c2.gif\" width=\"3\" height=\"3\" /></td><td height=\"3\" background=\"/im/img/bgvf_r2_c6.gif\"></td><td width=\"3\" height=\"3\"><img src=\"/im/img/bgvf_r2_c8.gif\" width=\"3\" height=\"3\" /></td></tr><tr><td background=\"/im/img/bgvf_r6_c2.gif\"></td><td class=\"tdfuck\">".$imcontent2."</td><td background=\"/im/img/bgvf_r4_c8.gif\"></td></tr><tr><td width=\"3\" height=\"3\"><img src=\"/im/img/bgvf_r8_c2.gif\" width=\"3\" height=\"3\" /></td><td height=\"3\" background=\"/im/img/bgvf_r8_c4.gif\"></td><td width=\"3\" height=\"3\"><img src=\"/im/img/bgv3.gif\" class=\"chat_xxj\" width=\"9\" height=\"13\" /><img src=\"/im/img/bgvf_r8_c8.gif\" width=\"3\" height=\"3\" /></td></tr></table></div></div>";
	return $funmeib2;
}
?>