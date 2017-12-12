<?php
	$fp=fopen("temp.txt","r");
	$str=fread($fp,filesize("temp.txt"));
	echo $str;
?>