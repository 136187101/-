<?php
	if(file_exists("temp.txt"))
	{
		unlink("temp.txt");
		echo "删除成功";
	}
	else
		echo "文件不存在";
?>