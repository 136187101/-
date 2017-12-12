<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?php
	$fp=fopen("temp.txt","a");
	fputs($fp,"\n锄禾日当午");
	echo "写入成功";
?>