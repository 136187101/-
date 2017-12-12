<?php
session_start();
/*以下属于JQUERY-validationEngine接受的参数*/
$validateValue = $_POST['validateValue'];//获取post参数：文本框值 
$validateId = $_POST['validateId'];//获取post参数：文本框ID 
$validateError = $_POST['validateError'];
$arrayToJs = array(); //定义json返回数组，顺序必须为validateId、validateError、returnValue 
$arrayToJs[0] = $validateId; //id
$arrayToJs[1] = $validateError; 
//$arrayToJs[2]: true 返回正确 false 返回错误


	if($_SESSION["authcode"]==$validateValue)
	{
	$arrayToJs[2]="true";	
	}
	else
	{
	$arrayToJs[2]="false";	
	}


echo '{"jsonValidateReturn":'.json_encode($arrayToJs).'}';




?>