<?php
	if(!(file_exists("admin")&&is_dir("admin")))
	{
		mkdir("admin");
	}
	if(!(file_exists("admin/text.txt") && is_file("admin/text.txt")))
	{
		$fp=fopen("admin/text.txt","w");
		for($i=1;$i<=10;$i++)
			fputs($fp,"{$i}:锄禾日当午\n");
		fclose($fp);
		echo "写入成功";
	}
?>