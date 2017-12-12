<?php
	$fp=fopen("temp.txt","w");
	fwrite($fp,"锄禾日当午");
	fclose($fp);
	echo "文件写入成功";
?>