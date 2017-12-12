<?php 
header('Content-type: text/html;charset=utf-8');
require_once("../../include/global.php");
require_once("../include/function.php");
$imlidt = $_POST["imlidt"];
$zsd = $_POST["zsd"];
$imweb_time = 61;//大于这个秒数，判断不在线
//----------------------------------------------------------------------------------------------------接收
if(!empty($zsd)){
	$rszsd = $db->get_one("select banben,kemu,banji from zsd_main where id='$zsd'");
	$where_L = " where banben='".$rszsd["banben"]."' and kemu='".$rszsd["kemu"]."' and banji='".$rszsd["banji"]."'";
}else{
	$where_L = "";
}
//-----------------------------------------------------------------------------------------//得到本科目，本班级的老师
$sql_tols = $db->query("select xid from laoshi".$where_L." limit 30");
while($rs_tols = $db->fetch_array($sql_tols)){
	$xid .= $rs_tols["xid"].",";
}
$xid_arr = explode(",",$xid);
$xid_arr = array_filter($xid_arr,"delEmpty");
$xid = implode(",",$xid_arr);
if($xid == ""){$xid = 0;}
//-----------------------------------------------------------------------------------------//得到老师ID号
if($imlidt == 64){

	$sql_xues = $db->query("select id,xname,user_file,imtime from xues_main where id in($xid) order by imtime desc");
	$num_xues = $db->num_rows($sql_xues);
	while($rs_xues = $db->fetch_array($sql_xues)){
		if(web_im_time_act($rs_xues["imtime"],$imweb_time) < $imweb_time){
			$imzaixa = "<span title=\"在线\"></span>";
		}else{
			$imzaixa = "";
		}
		$userlist .= "<li><img src=\"".user_file_all($rs_xues["user_file"])."\" width=\"36\" title=\"".$rs_xues["xname"]."\" _i=\"".$rs_xues["id"]."\" class=\"jqueryclick\" />".$imzaixa."</li>";		
	}
	if($num_xues == 0){$userlist = "<font color=#000>&nbsp;&nbsp;暂无老师</font>";}
	$to_dijosn = "<div class=\"chat_list_one\"><ul>".$userlist."</ul></div>";
	echo $to_dijosn;
	
}elseif($imlidt == 178){
	//--------------------------------------------------------------------------------------------------------------	
	$sql_xues = $db->query("select id,xname,user_file,imtime from xues_main where id in($xid) order by imtime desc");
	$num_xues = $db->num_rows($sql_xues);
	$zaix = 0;
	while($rs_xues = $db->fetch_array($sql_xues)){
		if(web_im_time_act($rs_xues["imtime"],$imweb_time) < $imweb_time){
			$imzaixa = "<font title=\"在线\"></font>";
			$zaix++;
		}else{
			$imzaixa = "";
		}
		$userlist2 .= "<li _i=\"".$rs_xues["id"]."\" class=\"jqueryclick\"><span class=\"left\">".$imzaixa."<img src=\"".user_file_all($rs_xues["user_file"])."\" title=\"".$rs_xues["xname"]."\" /></span><span class=\"right\">".$rs_xues["xname"]."</span></li>";
		// 消信提示 <span class=\"span3\">1</span>
	}
	if($num_xues == 0){$userlist2 = "<font color=#000>暂无老师</font>";}
	//--------------------------------------------------------------------------------------------------------------
	$sql_im_list = $db->query("select distinct euid from im_list where uid='$cookie_xsuid'");
	while($rs_im_list = $db->fetch_array($sql_im_list)){
		$euid_H .= $rs_im_list["euid"].",";
	}
	$euid_H = substr($euid_H,0,-1);
	if($euid_H == ""){$euid_H = 0;}
	$sql_zuij = $db->query("select id,xname,user_file,imtime from xues_main where id in($euid_H) order by imtime desc");
	$num_zuij = $db->num_rows($sql_zuij);
	$zaix1 = 0;
	while($rs_zuij = $db->fetch_array($sql_zuij)){
		if(web_im_time_act($rs_zuij["imtime"],$imweb_time) < $imweb_time){
			$imzaixa1 = "<font title=\"在线\"></font>";
			$zaix1++;
		}else{
			$imzaixa1 = "";
		}
		$userlist1 .= "<li _i=\"".$rs_zuij["id"]."\" class=\"jqueryclick\"><span class=\"left\">".$imzaixa1."<img src=\"".user_file_all($rs_zuij["user_file"])."\" title=\"".$rs_zuij["xname"]."\" /></span><span class=\"right\">".$rs_zuij["xname"]."</span></li>";
		// 消信提示 <span class=\"span3\">1</span>
	}
	if($num_zuij == 0){$userlist1 = "<font color=#000>暂无最近联系人</font>";}
	//--------------------------------------------------------------------------------------------------------------
	
	
	$to_dijosn2 = "<dl><img src=\"/im/img/bottom.gif\" />步步学老师[".$zaix."/".$num_xues."]</dl><ul>".$userlist2."</ul>";
	$to_dijosn2 .= "<dl><img src=\"/im/img/bottom.gif\" />最近联系人[".$zaix1."/".$num_zuij."]</dl><ul>".$userlist1."</ul>";	
	echo "<div class=\"im_userlist\">".$to_dijosn2."</div>";
	
	
	
	

}

web_im_time($db,$cookie_xsuid);
?>