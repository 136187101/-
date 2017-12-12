<?php
require_once("../../include/init.php");
/*以下属于JQUERY-validationEngine接受的参数*/
$validateValue = $_POST['validateValue'];//获取post参数：文本框值 
$validateId = $_POST['validateId'];//获取post参数：文本框ID 
$validateError = $_POST['validateError'];
$arrayToJs = array(); //定义json返回数组，顺序必须为validateId、validateError、returnValue 
$arrayToJs[0] = $validateId; //id
$arrayToJs[1] = $validateError; 
//$arrayToJs[2]: true 返回正确 false 返回错误

//进行过滤
$check = eregi('Administrator|Guest|Admin|ShadoWin|\'|\/\*|\*|\.\.\/|\.\/|Shadowwin|Sdw-stuff|network|cloudq|server|Cloud-q|root|Bin|adm|sync|test|shutdown|user|sdw|halt|net|rdp|Clq|ueb|Ma7|Win7|mail|news|uucp|operator|games|gopher|ftp|nobody|nscd|vcsa|pcap|ntp|oprofile|mailnull|smmsp|apache|rpc|rpcuser|nfsnobody|sshd|dbus|avahi|haldaemon|avahi-autoipd|xfs|gdm|sabayon|mysq|cloud|Backup OPerators|Guests|Network Configuration Operators|Power Users|Remote Desktop Users|Cryptographic Operators|Distributed COM Users|Event Log Readers|IIS_IUSRS   Internet|Network Configuration Operators|Performance Log Users|Performance Monitor Users|Replicator|HomeUsers|system|Everyone|Authenticated Users|Interactive|Network|Creator Owner|Anonymous Logon',$validateValue);     // 
/*end*/
if($check)
{
	$arrayToJs[2] = "false";
}
else
{
	$rs=$db->query("select * from admin_user where username = '$validateValue'");
	if($hjd->num_rows($rs)==0)
	{
	$arrayToJs[2]="true";	
	}
	else
	{
	$arrayToJs[2]="false";	
	}
		
}


echo '{"jsonValidateReturn":'.json_encode($arrayToJs).'}';




?>