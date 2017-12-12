<?php
require_once('../mainfile.php');
global $db;
$validateValue = $_POST['validateValue'];
$validateId = $_POST['validateId'];
$validateError = $_POST['validateError'];

$sql = "select * from ".$clean['table_prefix']."user where username = '$validateValue'";

$rt = $db->sql_query($sql);
$numn = $db->sql_numrows($rt);

$arrayToJs = array();
$arrayToJs[0] = $validateId;
$arrayToJs[1] = $validateError;



$check = eregi('Administrator|Guest|Admin|ShadoWin|\'|\/\*|\*|\.\.\/|\.\/|Shadowwin|Sdw-stuff|network|cloudq|server|Cloud-q|root|Bin|adm|sync|test|shutdown|user|sdw|halt|net|rdp|Clq|ueb|Ma7|Win7|mail|news|uucp|operator|games|gopher|ftp|nobody|nscd|vcsa|pcap|ntp|oprofile|mailnull|smmsp|apache|rpc|rpcuser|nfsnobody|sshd|dbus|avahi|haldaemon|avahi-autoipd|xfs|gdm|sabayon|mysq|cloud|Backup OPerators|Guests|Network Configuration Operators|Power Users|Remote Desktop Users|Cryptographic Operators|Distributed COM Users|Event Log Readers|IIS_IUSRS   Internet|Network Configuration Operators|Performance Log Users|Performance Monitor Users|Replicator|HomeUsers|system|Everyone|Authenticated Users|Interactive|Network|Creator Owner|Anonymous Logon',$validateValue);     // 进行过滤

if($check){
	for($x=0; $x<1000000; $x++){
		if($x == 990000){
			$arrayToJs[2] = "false";
			echo '{"jsonValidateReturn":'.json_encode($arrayToJs).'}';		//返回阵列误差
		}
	}
}else{
	if(!$numn){	
		$arrayToJs[2] = "true";
		echo '{"jsonValidateReturn":'.json_encode($arrayToJs).'}';			// 随着成功返回数组
	}else{
		for($x=0;$x<1000000;$x++){
			if($x == 990000){
				$arrayToJs[2] = "false";
				echo '{"jsonValidateReturn":'.json_encode($arrayToJs).'}';		//返回阵列误差
			}
		}
	}
}
?>
